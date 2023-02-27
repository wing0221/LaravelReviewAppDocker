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
                 ->get();
        return view('review/index', ['reviews' => $reviews]);
    }
    public function create()
    {
        //新規登録用のクラスをViewに渡す
        $review = new Review();
        return view('review/create',compact('review'));
    }
    public function store(Request $request)
    {
        $review = new review();
        $review->user_id = $request->user_id;
        $review->item_id = $request->item_id;
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
