<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\DB;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():view
    {
        // dd(Item::getLatestItemsWithFavorites(10));
        return view('item/index', [
            // 'items' => Item::getLatestItemsWithFavorites(10)
            'items' => Item::getLatestItemsWithFavorites(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        $item = new Item();
        return view('item/create',[
            'item' => $item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        Item::putItem($request);
        return redirect('/item');       
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つItemの情報を取得
        $item = Item::findOrFail($id);
        // 取得した値をビュー「book/edit」に渡す
        return view('item/edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request,$id)
    {
        $item = Item::findOrFail($id);
        $item->image = $request->image;
        $item->name = $request->name;
        $item->maker = $request->maker;
        $item->content = $request->content;
        $item->save();
        return redirect("/item");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::destroyItem($id);
        return redirect("/item");
    }
    public function search(Request $request)
    {
        return redirect("/item");
    }
}
