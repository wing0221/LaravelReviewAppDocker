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
        $favorite = new FavoriteItem();
        $favorite->user_id = auth()->id();
        $favorite->item_id = $request->input('item_id');
        $favorite->save();
    }
    
    //TODO 途中
    public static function destroyLoggedInUserFavoriteItem($id):void
    {
        $user_id = auth()->id();
        FavoriteItem::where([
                        ['user_id', $user_id],
                        ['item_id', $id],
                    ])->delete();
    }
}
