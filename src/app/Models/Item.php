<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\boolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Item extends Model
{
    // use HasFactory;
    public static function getLatestItemsWithFavorites(int $perPage = 10): LengthAwarePaginator
    {
        return Item::latest()
            ->join('favorite_items', 'favorite_items.item_id', '=', 'items.id')
            ->select('items.*')
            ->paginate($perPage);
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
