<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\boolean;
use App\Models\Integer;
use App\Models\Review;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ItemRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Item extends Model
{
    protected static $parPage = 10;
    
    public static function getItemWithFavoritesAndEvaluationAverage($id) : Collection
    {
        return Item::getItemsWithFavoritesAndEvaluationAverage()
            ->where('items.id', $id)
            ->get();
        
    }

    public static function getItemsWithFavoritesAndEvaluationAverage() : Builder
    {
        $userId = auth()->id();
        return DB::table('items')
                ->leftjoin('reviews', 'items.id', '=', 'reviews.item_id')
                ->leftJoin('favorite_items', function ($join) use ($userId) {
                            $join->on('items.id', '=', 'favorite_items.item_id')
                                ->where('favorite_items.user_id', $userId);
                            })
                ->select('items.id',
                         'items.name',
                         'items.image',
                         'items.maker',
                         'items.content',
                         'items.created_at', 
                         DB::raw('IF(AVG(reviews.evaluation) IS NULL, "0",AVG(reviews.evaluation)) as average_evaluation'),
                         DB::raw("IF(favorite_items.created_at IS NULL, FALSE, TRUE) as is_favorite")
                         )
                ->groupBy('items.id',
                          'items.name',
                          'items.image',
                          'items.maker',
                          'items.content',
                          'items.created_at', 
                          'is_favorite'
                        );
    }
    // use HasFactory;
    public static function getLatestItems(): LengthAwarePaginator
    {
        return Item::latest()
            ->select('items.*')
            ->paginate(Item::getpage());
    }
    
    public static function getLatestItemsWithFavorites(): LengthAwarePaginator
    {
        $userId = auth()->id();
        return DB::table('items')
            ->leftJoin('favorite_items', function ($join) use ($userId) {
                $join->on('items.id', '=', 'favorite_items.item_id')
                    ->where('favorite_items.user_id', $userId);
            })//お気に入り登録情報を結合
            ->select('items.*', 
                    DB::raw("IF(favorite_items.created_at IS NULL, FALSE, TRUE) 
                             as is_favorite"
                           ))//お気に入り登録をしているか否かのフラグをつける
            ->paginate(Item::$parPage);
    }

    public static function getItemNameAll(): Collection
    {
        return  DB::table('items')
                    ->select('items.id',
                             'items.name')
                    ->get();
    }
    
    public static function WhereNameOrContent(String $search)
    {
        return Item::getItemsWithFavoritesAndEvaluationAverage()
            ->where('items.content', 'LIKE', "%${search}%")
            ->paginate(Item::$parPage);
    }

    public static function putS3(UploadedFile $file):String
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
        $item->content = $request->content;
        $item->save();
    }    
 
    public static function updateItem(ItemRequest $request,$id)
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
        $item->content = $request->content;
        $item->save();
    }    
    
    public static function getLatestThreeItems():Collection
    {
        return Item::latest()
                   ->take(3)
                   ->get();
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
    public static function getOrderChangeItems(String $order = "2"): LengthAwarePaginator
    {
        $OrderChangedItems = Item::getItemsWithFavoritesAndEvaluationAverage();
        if($order == "1"){
            $OrderChangedItems = $OrderChangedItems
                ->orderBy('items.created_at', 'desc')
                ->paginate(Item::$parPage);
        }elseif($order  == "2"){
            $OrderChangedItems = $OrderChangedItems
                ->orderBy('average_evaluation', 'desc')
                ->paginate(Item::$parPage);
        }elseif($order  == "3"){
            $OrderChangedItems = $OrderChangedItems
                ->orderBy('items.id', 'asc')
                ->paginate(Item::$parPage);
        }

        return $OrderChangedItems;
    }
    
    public static function destroyItem($id):bool
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
}
