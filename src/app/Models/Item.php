<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\boolean;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Item extends Model
{
    protected static $parPage = 10;

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
    
    public static function WhereNameOrContent(Request $request)
    {
        // 検索キーワード
        $search = $request->input('keyword');

        $userId = auth()->id();
        return DB::table('items')
            ->where('content', 'LIKE', "%${search}%")
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

    public static function putItem(ItemRequest $request)
    {
        $file = $request->file('image');
        $binaryData = file_get_contents($file->getRealPath());// ファイルのバイナリデータを取得
        $item = new Item();
        $item->image = $binaryData;
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

    public static function destroyItem($id):bool
    {
        try {
            $item = Item::findOrFail($id);
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
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
    
}
