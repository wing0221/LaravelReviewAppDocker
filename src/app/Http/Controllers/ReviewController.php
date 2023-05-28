<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index(Request $request)
    {

        // レビュー一覧を取得
        if(null !== $request->input('keyword'))
        {
            $reviews = Review::searchReviewsByKeyword($request->input('keyword'));
        } else {           
            $reviews = Review::getReviews()
            ->paginate(10);
        }

        return view('review/index', [
                    'reviews' => $reviews
                ]);
    }
    public function create()
    {
    }
    public function create_item_id($item_id)
    {
        $review = new Review();
        $item = Item::find($item_id);
        return view('review/create', [
            'review' => $review ,
            'item' => $item
        ]);    
    }
    public function store(ReviewRequest $request)
    {
        Review::inputReview($request);
        return redirect('/review');   
    }
    public function show(string $id)
    {
        $review = Review::getReview($id);
        //  dd($review);
        return view('review/show', [
            'review' => $review[0]
        ]);   
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
