<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('reviews', function (Blueprint $table) {
            //reviewsテーブルの定義
            $table->id();
            //usersテーブルとの外部キー制約
            $table->foreignId('user_id')->constrained('users');
            //itemsテーブルとの外部キー制約
            $table->foreignId('item_id')->constrained('items');
            $table->string('title');
            $table->string('content');
            $table->string('evaluation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
