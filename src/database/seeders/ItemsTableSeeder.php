<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        // アイテムを20個作成する
        for ($i = 1; $i <= 100; $i++) {

            $maker_no = random_int(1,10);
            $genre_no = random_int(1,10);
            DB::table('items')->insert([
                'name' => "アイテム{$i}",
                'maker' => "メーカー{$maker_no}",
                'genre_id' => $genre_no,
                'image' => 'https://review-app-packet.s3.ap-northeast-1.amazonaws.com/item_image/no_image.png',
                'content' => "アイテム{$i}の説明文。",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
