<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ReviewController extends Controller
{
    public function index()
    {
        // レビュー一覧を取得
        $reviews = DB::table('reviews')
                 ->join('users', 'users.id', '=', 'reviews.user_id')
                 ->join('items', 'items.id', '=', 'reviews.item_id')
                 ->select('reviews.*', 'users.name as user_name', 'items.name as item_name')
                 ->paginate(10);
        return view('review/index', ['reviews' => $reviews]);
    }
    public function create()
    {
        //新規登録用のクラスをViewに渡す
        $review = new Review();
        $item_names = DB::table('items')
                    ->select('items.name')
                    ->get();
        return view('review/create',
                    compact('review','item_names'));
    }
    public function store(Request $request)
    {
        $review = new review();
        $review->user_id = $request->user_id;
        // item_nameを元にitem_idを持ってくる
        $item_id = DB::table('items')
                    ->select('items.id')
                    ->where('name','=',$request->item_name)
                    ->get();
        $review->item_id = $item_id[0]->id;
        $review->evaluation = $request->evaluation;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->save();

        return redirect('/review');   
    }
    public function show(string $id): Response
    {
        //
    }
    public function edit(string $id): Response
    {
        //
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
