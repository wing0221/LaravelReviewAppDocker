<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\RootController;
use App\Models\Item;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Tests\TestCase;

class RootControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePageDisplaysLatestReviewsAndItems(): void
    {
        $this->withoutExceptionHandling();

        // トップページにアクセス
        $response = $this->get(route('root'));

        $response->assertStatus(200); // レスポンスステータスが正常かどうかを検証

        $response->assertViewIs('.index'); // 正しいビューが表示されているかを検証

        $response->assertViewHas('latestThreeReviews'); // 特定の変数がビューに渡されているかを検証
        $response->assertViewHas('latestThreeItems'); // 特定の変数がビューに渡されているかを検証
    }
}