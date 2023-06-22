<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        // アイテムを20個作成する
        for ($i = 1; $i <= 10; $i++) {
            DB::table('genres')->insert([
                'name' => "ジャンル{$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
