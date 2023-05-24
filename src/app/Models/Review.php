<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    public static function getReviews(): Builder
    {
        return Review::latest()
            ->join('items', 'reviews.item_id', '=', 'items.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select(
                'reviews.title',
                'reviews.user_id',
                'reviews.content',
                'reviews.evaluation',
                'reviews.created_at',
                'items.name as item_name',
                'users.name as user_name'
            )
            ->orderBy('reviews.created_at', 'desc');        
    }

    public static function getUserReviews($id): Collection
    {
        return Review::getReviews()
            ->where('reviews.user_id', '=', $id)
            ->get();
    }

    public static function getLatestThreeReviews(): Collection
    {
        return Review::getReviews()
            ->limit(3)
            ->get();
    }

    public static function searchReviewsByKeyword($keyword): Collection
    {
        //TODO キーワーど検索 
        return Review::getReviews()
            ->limit(3)
            ->get();
    }
    

    public static function inputReview(Request $request): void
    {
        $review = new review();
        $review->user_id = $request->user_id;
        // item_nameを元にitem_idを持ってくる
        $item_id = DB::table('items')
            ->select('items.id')
            ->where('name', '=', $request->item_name)
            ->get();

        $review->item_id = $item_id[0]->id;
        $review->evaluation = $request->evaluation;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->save();
    }
}
