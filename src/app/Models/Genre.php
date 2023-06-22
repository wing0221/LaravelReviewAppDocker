<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
     public static function getGenres() : Collection
    {
        return DB::table('genres')
                ->select('id','name')
                ->get();
        
    }   
}
