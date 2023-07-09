<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Item extends Model
{
    protected static $parPage = 10;

    // アイテムページの表示用
    public static function getCombinedSearchPaginate(request $request): LengthAwarePaginator
    {
        $items = Item::getItemsWithFavoritesAndEvaluationAverage();
        $items = Item::CombinedSearchBuilder($items,$request);
        $items = Item::builderPagenate($items);
        return $items;
    }

    //ランキングページの表示用
     public static function getCombinedSearchAndDateTimePaginate(request $request): LengthAwarePaginator
    {
        $nowMonth = \Carbon\Carbon::parse($request->input('month'));
        $now = Carbon::now();
        // dd($nowDay);

        $items = Item::getItemsWithFavoritesAndEvaluationAverage();
        $items = Item::CombinedSearchBuilder($items,$request);
        $items = Item::itemDateTimeBuilder($items,
                                           $nowMonth,
                                           $now);
        $items = Item::builderPagenate($items);
        return $items;
    }   
    //評価平均クエリ作成用
    public static function averageEvaluationExpression(): Expression
    {
        return DB::raw(
                        'IF(AVG(reviews.evaluation) IS NULL, "0",AVG(reviews.evaluation)) as average_evaluation'
                    );
    }

    //コメント数クエリ作成用
    public static function countReviewsExpression(): Expression
    {
        return DB::raw(
                        'IF(count(reviews.id) IS NULL, "0",count(reviews.id)) as count_reviews'
                    );
    }

    //お気に入り登録クエリ作成用
    public static function isFavoriteExpression(): Expression
    {
        return DB::raw(
                        "IF(favorite_items.created_at IS NULL, FALSE, TRUE) as is_favorite"
                    );
    }

    public static function getItemWithFavoritesAndEvaluationAverage($id): Collection
    {
        return Item::getItemsWithFavoritesAndEvaluationAverage()
            ->where('items.id', $id)
            ->get();
    }

    public static function getItemsWithFavoritesAndEvaluationAverage(): Builder
    {
        $userId = auth()->id();
        return DB::table('items')
            ->leftjoin('reviews', 'items.id', '=', 'reviews.item_id')
            ->leftjoin('genres', 'items.genre_id', '=', 'genres.id')
            ->leftJoin('favorite_items', function ($join) use ($userId) {
                $join->on('items.id', '=', 'favorite_items.item_id')
                    ->where('favorite_items.user_id', $userId);
            })
            ->select(
                'items.id',
                'items.name',
                'items.image',
                'items.maker',
                'items.genre_id',
                'genres.name as genre_name',
                'items.content',
                'items.created_at',
                Item::averageEvaluationExpression(),
                Item::countReviewsExpression(),
                Item::isFavoriteExpression()
            )
            ->groupBy(
                'items.id',
                'items.name',
                'items.image',
                'items.maker',
                'items.genre_id',
                'genre_name',
                'items.content',
                'items.created_at',
                'is_favorite'
            );
    }


    public static function getLatestItems(): LengthAwarePaginator
    {
        return Item::latest()
            ->select('items.*')
            ->paginate(Item::getpage());
    }

    //
    public static function getLatestItemsWithFavorites(): LengthAwarePaginator
    {
        $userId = auth()->id();
        return DB::table('items')
            ->leftJoin('favorite_items', function ($join) use ($userId) {
                $join->on('items.id', '=', 'favorite_items.item_id')
                    ->where('favorite_items.user_id', $userId);
            }) //お気に入り登録情報を結合
            ->select(
                'items.*',
                DB::raw(
                    "IF(favorite_items.created_at IS NULL, FALSE, TRUE) 
                             as is_favorite"
                )
            ) //お気に入り登録をしているか否かのフラグをつける
            ->paginate(Item::$parPage);
    }

    public static function getItemNameAll(): Collection
    {
        return  DB::table('items')
            ->select(
                'items.id',
                'items.name'
            )
            ->get();
    }

    public static function getMakers(): Collection
    {
        return  DB::table('items')
            ->select(
                'items.maker',
            )
            ->distinct()
            ->orderBy('items.maker', 'asc')
            ->get();
    }
    

    // 複合検索
    public static function CombinedSearchBuilder(Builder $builder,Request $request): Builder
    {
        $itemName = $request->input('name');
        $averageEvaluationMin = $request->input('average_evaluation_min');
        $averageEvaluationMax = $request->input('average_evaluation_max');
        $itemMaker = $request->input('maker');
        $itemGenre = $request->input('genre');
        $order = $request->input('order');
    
        // 名前検索
        if (null !== $itemName) {
            $builder =  $builder->where('items.content', 'LIKE', "%${itemName}%");
        }
        // 評価平均以上検索
        if (null !== $averageEvaluationMin) {
            $builder =  $builder->havingRaw('IFNULL(AVG(reviews.evaluation), 0) >= ?', [$averageEvaluationMin]);
        }
        // 評価平均以下検索
        if (null !== $averageEvaluationMax) {
            $builder =  $builder->havingRaw('IFNULL(AVG(reviews.evaluation), 0) <= ?', [$averageEvaluationMax]);
        }
        // メーカー検索
        if (null !== $itemMaker) {    
            $builder =  $builder->where('items.maker', $itemMaker);
        }
        // ジャンル検索
        if (null !== $itemGenre ) {
            $builder =  $builder->where('genres.name', $itemGenre);          
        }
        // 並び替え
        if (null !== $order) { 
             $builder = Item::OrderChangeItems($builder,$order);   
        }else{
            $builder = Item::OrderChangeItems($builder,"0");   
        }

        return $builder;
    }
     // 期間指定
    public static function itemDateTimeBuilder(Builder $builder,Carbon $startDate,Carbon $endDate): Builder
    {
        if (null !== $startDate and null !== $endDate ) { 
            $startCarbon = Carbon::parse($startDate);
            $endCarbon = Carbon::parse($endDate);
            $builder = $builder->whereBetween('items.created_at', [$startDate, $endDate]);
        }
        return $builder;
    }   
    // 複合検索ページネーター
    public static function builderPagenate(Builder $builder): LengthAwarePaginator
    {
        return $builder->paginate(Item::$parPage);
    }

    // 並び替え
    public static function OrderChangeItems(Builder $itemBuilder, String $order = "0"): Builder
    {
        if ($order == "0")// 作成日の新しい順
        {
            return $itemBuilder->orderBy('items.created_at', 'desc');
        } 
        elseif ($order  == "1")// 作成日の古い順
        {
            return $itemBuilder->orderBy('items.created_at', 'asc');
        }
        elseif ($order  == "2")// 評価がいい順
        {
            return $itemBuilder->orderBy('average_evaluation', 'desc');
        }
        elseif ($order  == "3")// 評価が悪い順
        {
            return $itemBuilder->orderBy('average_evaluation', 'asc');
        }
        elseif ($order  == "4")// コメント数が多い順
        {
            return $itemBuilder->orderBy('count_reviews', 'desc');
        } 
        elseif ($order  == "5")// コメント数が少ない順
        {
            return $itemBuilder->orderBy('count_reviews', 'asc');
        }
    }

    public static function getLatestThreeItems(): Collection
    {
        return Item::latest()
            ->take(3)
            ->get();
    }

    // itemの作成月リストを取得
    public static function getItemCreateMonths(): Collection
    {
        $months = DB::table('items')
            ->select(DB::raw(
                    'CONCAT(YEAR(created_at), "年", MONTH(created_at), "月") AS month,
                    CONCAT(YEAR(created_at), "-", LPAD(MONTH(created_at), 2, "0")) AS month_value')
                    )
            ->orderBy('month_value', 'desc')
            ->distinct()
            ->get();

        return $months;
    }
    
    public static function getLoggedInUserFavoriteItems(): LengthAwarePaginator
    {
        $userId = auth()->id();
        return Item::latest()
            ->join('favorite_items', 'favorite_items.item_id', '=', 'items.id')
            ->where('user_id', $userId)
            ->select('items.*')
            ->paginate(Item::$parPage);
    }

    // 指定idのアイテムを削除する
    public static function destroyItem($id): bool
    {
        try {
            DB::beginTransaction();

            Review::where('item_id', $id)->delete();
            Item::findOrFail($id)->delete();

            DB::commit();
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    // s3用

    public static function putS3(UploadedFile $file): String
    {
        $path = Storage::disk('s3')->putFile('item_image', $file, 'public');
        $image_path = Storage::disk('s3')->url($path);

        return $image_path;
    }


    public static function putItem(ItemRequest $request)
    {
        // s3へファイルをアップロードし、ファイルのフルパスを取得
        $file = $request->file('image');
        $image_path = Item::putS3($file);

        // DBへ記録
        $item = new Item();
        $item->image = $image_path;
        $item->name = $request->name;
        $item->maker = $request->maker;
        $item->genre_id = $request->genre;
        $item->content = $request->content;
        $item->save();
    }

    public static function updateItem(ItemRequest $request, $id)
    {
        // s3へファイルをアップロードし、ファイルのフルパスを取得
        $file = $request->file('image');
        $image_path = Item::putS3($file);

        // TODO フォーム入力なしの財の処理
        // DBへ記録
        $item = Item::find($id);
        $item->image = $image_path;
        $item->name = $request->name;
        $item->maker = $request->maker;
        $item->genre_id = $request->genre;
        $item->content = $request->content;
        $item->save();
    }
}
