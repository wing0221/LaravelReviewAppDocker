<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Item;
use App\Models\Ranking;
use App\Models\Review;
use Illuminate\View\View;

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
     * トップページの表示
     *
     * 最新のアイテム３件と最新のレビュー３件を取得して、ビューに渡して表示する
     *
     * @return \Illuminate\View\View トップページのビュー
     */
    public function index():view
    {
        Ranking::DeleteAndInputRankings();
        $ranking = Ranking::getRankings()
                    ->paginate(10);
        // dd($ranking);

        return view('ranking.index', [
            'items' => $ranking,
        ]);
    }
}
