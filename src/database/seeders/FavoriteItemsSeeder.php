<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('favorite_items')->truncate();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('favorite_items')->insert([
                'user_id' => rand(1, 5),
                'item_id' => rand(1, 20),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
