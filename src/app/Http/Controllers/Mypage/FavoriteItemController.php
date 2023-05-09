<?php

declare(strict_types=1);

namespace App\Http\Controllers\Mypage;

use App\Models\Mypage\FavoriteItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FavoriteItemController extends Controller
{
    public function logged_in_user_favorite_items(): view
    {
        return view('favorite/favorite_items', [
            'LoggedInUserFavoriteItems' => FavoriteItem::getLoggedInUserFavoriteItems()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        FavoriteItem::storeLoggedInUserFavoriteItem($request);
        return back();
    }

    public function destroy($id): RedirectResponse
    {
        // dd($id);
        FavoriteItem::destroyLoggedInUserFavoriteItem($id);
        return back();
    }
}
