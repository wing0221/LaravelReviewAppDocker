<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Item;

class AdminController extends Controller
{
    public function index(): View
    {
        $item = Item::getOrderChangeItems("3");
        return view('/admin/index', [
            'items' => $item,
        ]);
    }
}
