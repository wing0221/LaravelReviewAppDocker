<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Review;
use Illuminate\View\View;

/**
 * RootControllerクラス
 *
 * アプリケーションのトップページのコントローラークラス
 *
 * @package App\Http\Controllers
 */
class RootController extends Controller
{
    /**
     * トップページの表示
     *
     * 最新のアイテム３件と最新のレビュー３件を取得して、ビューに渡して表示する
     *
     * @return \Illuminate\View\View トップページのビュー
     */
    public function index(): View
    {
        // 最新のレビュー３件を取得する
        $latestThreeReviews = Review::getLatestThreeReviews();
        // 最新のアイテム３件を取得する
        $latestThreeItems = Item::getLatestThreeItems();
        return view('/index', [
            'latestThreeReviews' => $latestThreeReviews,
            'latestThreeItems' => $latestThreeItems,
        ]);
    }
}
