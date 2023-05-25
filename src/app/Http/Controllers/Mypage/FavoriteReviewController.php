<?php

declare(strict_types=1);

namespace App\Http\Controllers\Mypage;

use App\Models\Mypage\FavoriteReview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


class FavoriteReviewController extends Controller
{
    public function logged_in_user_favorite_reviews(): view
    {
        return view('favorite/favorite_reviews', [
            'LoggedInUserFavoritereviews' => FavoriteReview::getLoggedInUserFavoriteReviews()
        ]);
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     // dd($request);
    //     FavoriteReview::storeLoggedInUserFavoriteReview($request);
    //     return back();
    // }

    // public function destroy($id): RedirectResponse
    // {
    //     // dd($id);
    //     FavoriteReview::destroyLoggedInUserFavoriteReview($id);
    //     return back();
    // }
}
