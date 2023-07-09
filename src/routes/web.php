<?php

use App\Models\Item;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Mypage\FavoriteItemController;
use App\Http\Controllers\Mypage\FavoriteReviewController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

//TopPageのルーティング
Route::get('/', [RootController::class, 'index'])
    ->name('root');

Route::get('/dashboard',  [ProfileController::class, 'show_profile'])
    ->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// 他のユーザーのプロフィール
Route::get('/users/{id}', [ProfileController::class, 'show_other'])
    ->name('profile.show_other');
//Itemのルーティング
Route::resource('item', ItemController::class)
    ->only(['index', 'show']);

Route::get('ranking', [RankingController::class, 'index'])
    ->name('ranking.index');
    
    //reviewのルーティング
Route::resource('review', ReviewController::class)
    ->only(['index', 'show']);

//ログイン時のみのルーティング
Route::middleware('auth')->group(function () {
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // admin
    Route::resource('admin', AdminController::class)
        ->only(['index','create','store','edit','update','destroy'])
        ->middleware('admin');

    // review
    Route::resource('review', ReviewController::class)
        ->only(['store']);
    Route::get('review/create/{item_id}', [ReviewController::class, 'create_item_id'])
        ->name('review.create_item_id');
    // favorite_items
    Route::get(
        '/favorite-items',
        [
            FavoriteItemController::class,
            'logged_in_user_favorite_items'
        ]
    )
    ->name('favoriteitems.logged-in-user-favorite-items');

    Route::post('/favorite-items',
                [
                    FavoriteItemController::class,
                    'favorite_item_switch'
                ]
            );

    // favorite_reviews
    Route::get(
        '/favorite-reviews',
        [
            FavoritereviewController::class,
            'logged_in_user_favorite_reviews'
        ]
    )
        ->name('favoritereviews.logged-in-user-favorite-reviews');
    Route::resource('/favorite-reviews', FavoritereviewController::class)
        ->only(['store', 'destroy']);
});

require __DIR__ . '/auth.php';
