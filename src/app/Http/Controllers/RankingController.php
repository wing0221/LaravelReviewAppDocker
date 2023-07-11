<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Item;
use App\Models\Ranking;
use App\Models\Review;
use Illuminate\View\View;
use Illuminate\Http\Request;
/**
 * RootControllerクラス
 *
 * アプリケーションのトップページのコントローラークラス
 *
 * @package App\Http\Controllers
 */
class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): view
    {
        if($request->input('month') === NULL){
            $request->merge(['month' => '2023-07']);
        }
        $request->merge(['order' => '2']);
        
        $item = Item::getCombinedSearchAndDateTimePaginate($request);
        // アイテムのジャンル取得
        $genres = Genre::getGenres();
        // アイテムのメーカー取得
        $makers = Item::getMakers();
        // アイテムの作成月取得
        $months = Item::getItemCreateMonths();

        return view('ranking.index', [
            'items' => $item,
            'months' => $months,
            'pageMonth' => date('Y年m月', strtotime($request->input('month')))
        ]);
    }
}
