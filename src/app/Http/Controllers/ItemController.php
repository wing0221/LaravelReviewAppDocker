<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('item/index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new Item();
        return view('item/create',compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $item = new Item();
        $item->image = $request->image;
        $item->name = $request->name;
        $item->maker = $request->maker;
        $item->content = $request->content;
        $item->save();

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
        return view('item/edit', compact('item'));
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
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect("/item");
    }
}
