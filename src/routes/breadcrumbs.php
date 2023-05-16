<?php

//パンくずリスト　https://poppotennis.com/posts/laravel-breadcrumbs

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('トップページ', route('root'));
});

// Home > Item
Breadcrumbs::for('item', function ($trail) {
    $trail->parent('home');
    $trail->push('おもちゃ', route('item.index'));
});

// Home > Item
Breadcrumbs::for('review', function ($trail) {
    $trail->parent('home');
    $trail->push('レビュー', route('review.index'));
});