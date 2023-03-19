<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // ユーザーを20人作成する
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => "ユーザー{$i}",
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'authority' => 'USER',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 管理者を1人作成する
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'authority' => 'ADMIN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

