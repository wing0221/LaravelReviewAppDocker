<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class Review extends Model
{
    use HasFactory;

    // この関数はReviewsモデルの基本形として使用する。
    // そのため本Modelでは原則この関数を呼び出すこと。   
    public static function getReviews(): Builder
    {
        return Review::latest()
            ->join('items', 'reviews.item_id', '=', 'items.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select(
                'reviews.title',
                'reviews.user_id',
                'reviews.content',
                'items.image',
                'reviews.evaluation',
                'reviews.created_at',
                'items.name as item_name',
                'users.name as user_name'
            )
            ->orderBy('reviews.created_at', 'desc');        
    }

    public static function getReview($id): Collection
    {
        return Review::getReviews()
            ->where('reviews.id', '=', $id)
            ->get();
    }

    public static function getUserReviews($id): Collection
    {
        return Review::getReviews()
            ->where('reviews.user_id', '=', $id)
            ->get();
    }
    
    public static function getItemReviews($id): Collection
    {
        return Review::getReviews()
            ->where('reviews.item_id', '=', $id)
            ->get();
    }

    // 最新3件を取得
    public static function getLatestThreeReviews(): Collection
    {
        return Review::getReviews()
            ->limit(3)
            ->get();
    }

    // 引数keywordをreviews.contentから探す
    public static function searchReviewsByKeyword($keyword): LengthAwarePaginator 
    {
        return Review::getReviews()
            ->where('reviews.content', 'LIKE', "%${keyword}%")
            ->paginate(10);
    }
    

    public static function inputReview(Request $request): void
    {
        $review = new review();
        $review->user_id = $request->user_id;
        $review->item_id = $request->item_id;
        $review->evaluation = $request->evaluation;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->save();
    }
}
