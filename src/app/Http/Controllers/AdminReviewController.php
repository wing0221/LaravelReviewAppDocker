<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Genre;
use App\Models\Item;
use App\Models\Review;
use App\Models\DB;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::getReviews()
                ->paginate(10);
        
        return view('admin/review_index', [
                    'reviews' => $reviews
                ]);
    }
     public function checke_toggle(Request $request):view
    {
        $idCollection = $request->input('id');
        Review::collectionChangeCheced($idCollection,$request->input('action'));
        $reviews = Review::getReviews()
                ->paginate(10);
        return view('admin/review_index', [
                    'reviews' => $reviews
                ]);
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        // $item = new Item();
        // $genres = Genre::getGenres();
        // return view('review/item_create',[
        //     'item' => $item,
        //     'genres' => $genres
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        // Item::putItem($request);
        // return redirect('/admin');       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $item = Item::findOrFail($id);
        // $genres = Genre::getGenres();
        // return view('review/item_edit', [
        //     'item' => $item,
        //     'genres' => $genres
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request,$id)
    {
        // Item::updateItem($request,$id);
        // return redirect("/admin");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        // Item::destroyItem($id);
        // return redirect("/admin");
    }
}
