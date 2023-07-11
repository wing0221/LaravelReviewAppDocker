<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Item;
use App\Models\Review;
use App\Models\DB;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): view
    {
        $item = Item::getCombinedSearchPaginate($request);
        $genres = Genre::getGenres();
        $makers = Item::getMakers();

        return view('review/item_index', [
            'items' => $item,
            'genres' => $genres,
            'makers' => $makers,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::getItemWithFavoritesAndEvaluationAverage($id);
        $itemReviews = Review::getItemReviews($id);
        return view(
            'review/item_show',
            [
                'item' => $item[0],
                'ItemReviews' => $itemReviews,
            ]
        );
    }
}
