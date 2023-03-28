<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteReviewsSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('favorite_reviews')->insert([
                'user_id' => rand(1, 5),
                'review_id' => rand(1, 20),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
