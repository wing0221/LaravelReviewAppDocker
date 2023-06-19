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
    public function favorite_item_switch(Request $request): String
    {
        $item_id = $request->input('item_id');
        if($request->input('is_favorite') === "0"){
            FavoriteItem::storeLoggedInUserFavoriteItem($item_id);
        }elseif ($request->input('is_favorite') === "1") {
            FavoriteItem::destroyLoggedInUserFavoriteItem($item_id);
        }
        return $request->input('is_favorite');
    }
}
