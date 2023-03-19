<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // レビューを20件作成する
        for ($i = 1; $i <= 20; $i++) {
            DB::table('reviews')->insert([
                'user_id' => rand(1, 20),
                'item_id' => rand(1, 20),
                'title' => "アイテム{$i}のレビュー",
                'content' => "アイテム{$i}のレビュー文。",
                'evaluation' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


