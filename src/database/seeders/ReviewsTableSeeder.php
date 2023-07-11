<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Fakerオブジェクトを作成
        // レビューを500件作成する
        for ($i = 1; $i <= 500; $i++) {
            $item_id = rand(1, 100);
            DB::table('reviews')->insert([
                'user_id' => rand(1, 20),
                'item_id' => $item_id,
                'title' => "アイテム{$item_id}のレビュー",
                'content' => "アイテム{$item_id}のレビュー文。",
                'evaluation' => rand(1, 5),
                'checked' => 'APPROVED',
                'created_at' => $faker->dateTimeBetween($startDate = '-6 month', $endDate = 'now'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-6 month', $endDate = 'now'),
            ]);
        }
    }
}


