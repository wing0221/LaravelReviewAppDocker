<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\boolean;
use App\Http\Requests\ItemRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Item extends Model
{
    // use HasFactory;
    public static function getLatestItems(int $perPage = 10): LengthAwarePaginator
    {
        return Item::latest()
            ->select('items.*')
            ->paginate($perPage);
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
    
    // TODO この関数はSQLが未完成。
    // public static function getLatestItemsWithFavorites(int $perPage = 10): LengthAwarePaginator
    // {
    //     return Item::latest()
    //         ->join('favorite_items', 'favorite_items.item_id', '=', 'items.id')
    //         ->select('items.*')
    //         ->paginate($perPage);
    // }

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
            // $item->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public static function getLoggedInUserFavoriteItems(int $perPage = 10): LengthAwarePaginator
    {
        $userId = auth()->id();

        if ($userId === null) {
            return null;
        }
        return Item::latest()
                ->join('favorite_items', 'favorite_items.item_id', '=', 'items.id')
                ->where('user_id', $userId)
                ->select('items.*')
                ->paginate($perPage);
    }
}
