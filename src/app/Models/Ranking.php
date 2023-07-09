<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Ranking extends Model
{
     public static function InputRankings():void
    {
        $targetDate = Carbon::create(2023, 6,28)->format('Y-m-d H:i:s');
        $items = Item::getItemsWithFavoritesAndEvaluationAverage()
            ->whereDate('items.created_at', $targetDate)
            ->orderBy('average_evaluation', 'desc')
            ->get();
        $count = 0;
        $ranking_data = [];
        foreach($items as $item) {
            $count++;
            $ranking_data[] = [
                "item_id" => $item->id,
                "rank" => $count,
                "average_evaluation" => $item->average_evaluation
            ];
        };
        DB::table('rankings')->insert($ranking_data);
    }

    // ランキングテーブルのデータ削除とデータ入力
    public static function DeleteAndInputRankings():void
    {
        DB::beginTransaction();
        try {
            Ranking::truncate();
            Ranking::InputRankings();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    // ランキングデータ取得
    public static function getRankings(): Builder
    {
        return DB::table('rankings')
               ->leftjoin('items', 'rankings.item_id', '=', 'items.id')
               ->leftjoin('genres', 'items.genre_id', '=', 'genres.id')
                ->select('items.id',
                         'items.name',
                         'items.image',
                         'items.maker',
                         'items.genre_id',
                         'genres.name as genre_name',
                         'items.content',
                         'rankings.rank', 
                         'rankings.created_at', 
                         'average_evaluation'
                         )
               ->orderBy('rank', 'asc');
    }
}
