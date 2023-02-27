<?php

use App\Models\Item;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

//TopPageのルーティング
Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Itemのルーティング
Route::resource('item', ItemController::class);

//reviewのルーティング
Route::resource('review', ReviewController::class);

require __DIR__.'/auth.php';
