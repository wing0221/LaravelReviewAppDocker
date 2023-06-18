<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Item;
// use Illuminate\Support\Facades\Storage;
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
        } else{
            $item = Item::getOrderChangeItems();
        }
        return view('review/item_index', [
            'items' => $item,
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

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        $item = new Item();
        return view('review/item_create',[
            'item' => $item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        Item::putItem($request);
        return redirect('/admin');       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('review/item_edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request,$id)
    {
        Item::updateItem($request,$id);
        return redirect("/admin");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::destroyItem($id);
        return redirect("/item");
    }
}
