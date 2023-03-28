<?php

declare(strict_types=1);

namespace App\Models\Mypage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FavoriteItem extends Model
{
    use HasFactory;
    public static function getLoggedInUserFavoriteItems(int $perPage = 10): LengthAwarePaginator
    {
        $userId = auth()->id();

        if ($userId === null) {
            return null;
        }

        return FavoriteItem::latest()
                ->join('items', 'favorite_items.item_id', '=', 'items.id')
                ->where('user_id', $userId)
                ->select('items.*')
                ->paginate($perPage);
    }

    public static function storeLoggedInUserFavoriteItem(Request $request):void
    {
        // dd($request);
        $favorite = new FavoriteItem();
        $favorite->user_id = auth()->id();
        // $favorite->item_id = $request->item_id;
        $favorite->item_id = 2;
        $favorite->save();
    }
}
