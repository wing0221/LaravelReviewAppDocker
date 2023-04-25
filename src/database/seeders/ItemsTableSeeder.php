<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        $imageFile = 'public/images/no_image.png'; // 保存する画像ファイルを指定する
        $binaryImage = file_get_contents(storage_path('app/' . $imageFile));
        // アイテムを20個作成する
        for ($i = 1; $i <= 20; $i++) {
            DB::table('items')->insert([
                'name' => "アイテム{$i}",
                'maker' => "メーカー{$i}",
                'image' => $binaryImage,
                'content' => "アイテム{$i}の説明文。",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
