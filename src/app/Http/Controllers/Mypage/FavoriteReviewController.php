<?php

declare(strict_types=1);

namespace App\Http\Controllers\Mypage;

use App\Models\Mypage\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


class FavoriteReviewController extends Controller
{
    public function show(): view
    {
        return view('favorite/favorite', [
            'Reviews' => Favorite::getLoggedInUserFavoriteReviews()
        ]);
    }
}
