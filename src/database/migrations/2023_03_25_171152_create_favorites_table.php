<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    public function up():void
    {
        Schema::create('favorite_items', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // 複合キーを設定
            $table->primary(['user_id', 'item_id']);
            $table->unique(['user_id', 'item_id']);
        });
    }

    public function down():void
    {
        Schema::dropIfExists('favorite_items');
    }
}
