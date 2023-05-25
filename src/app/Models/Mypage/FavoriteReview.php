<?php

namespace App\Models\Mypage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FavoriteReview extends Model
{
    use HasFactory;
    public static function getLoggedInUserFavoriteReviews(int $perPage = 10): LengthAwarePaginator
    {
        $userId = auth()->id();

        if ($userId === null) {
            return null;
        }

        return FavoriteReview::latest()
                ->join('reviews', 'favorite_reviews.review_id', '=', 'reviews.id')
                ->where('favorite_reviews.user_id', $userId)
                ->select('reviews.*')
                ->paginate($perPage);
    }

    // public static function storeLoggedInUserFavoriteItem(Request $request):void
    // {
    //     $favorite = new FavoriteItem();
    //     $favorite->user_id = auth()->id();
    //     $favorite->item_id = $request->input('item_id');
    //     $favorite->save();
    // }
    
    // //TODO 途中
    // public static function destroyLoggedInUserFavoriteItem($id):void
    // {
    //     $user_id = auth()->id();
    //     FavoriteItem::where([
    //                     ['user_id', $user_id],
    //                     ['item_id', $id],
    //                 ])->delete();
    // }
}
