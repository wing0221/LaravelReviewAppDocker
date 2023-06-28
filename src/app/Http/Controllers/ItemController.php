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
    public function index(Request $request):view
    {

        if(null !== $request->input('keyword'))
        {
            $item = Item::WhereNameOrContent($request->input('keyword'));
        } elseif(null !== $request->input('sort')) {
            $item = Item::getOrderChangeItems($request->input('sort'));
        } elseif(null !== $request->input('genre_select')){
            $item = Item::getWhereGenreItems($request->input('genre_select'));
        }else{
            $item = Item::getOrderChangeItems();
        }
        $genres = Genre::getGenres();

        return view('review/item_index', [
            'items' => $item,
            'genres' => $genres
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::getItemWithFavoritesAndEvaluationAverage($id);
        $itemReviews = Review::getItemReviews($id);
        return view('review/item_show', 
                    ['item' => $item[0],
                     'ItemReviews' => $itemReviews,
                    ]);   
    }
}
