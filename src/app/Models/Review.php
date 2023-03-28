<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public static function getLatestThreeReviews():Collection
    {
        return Review::latest()
                     ->take(3)
                     ->get();
    }
}