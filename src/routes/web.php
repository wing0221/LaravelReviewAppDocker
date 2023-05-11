<?php

use App\Models\Item;
use App\Http\Controllers\Mypage\FavoriteItemController;
use App\Http\Controllers\Mypage\FavoriteReviewController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

//TopPageのルーティング
Route::get('/', [RootController::class, 'index'])
    ->name('root');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//ログイン時のみのルーティング
Route::middleware('auth')->group(function () {
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    
    // favorite_items
    Route::get(
                '/favorite-items',
                 [FavoriteItemController::class, 
                 'logged_in_user_favorite_items']
                 )
        ->name('favoriteitems.logged-in-user-favorite-items');
    Route::resource('/favorite-items', FavoriteItemController::class)
        ->only(['store', 'destroy']);

    // favorite_reviews
    // Route::get(
    //             '/favorite-items',
    //              [FavoriteItemController::class, 
    //              'logged_in_user_favorite_items']
    //              )
    //     ->name('favoriteitems.logged-in-user-favorite-items');
    // Route::resource('/favorite-items', FavoriteItemController::class)
        // ->only(['store', 'destroy']);
});

//Itemのルーティング
Route::resource('item', ItemController::class);
Route::get('item/search',[ItemController::class,'keyword_search'])
    ->name('item.search');
    

//reviewのルーティング
Route::resource('review', ReviewController::class);

require __DIR__.'/auth.php';
