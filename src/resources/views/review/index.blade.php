@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
    <div class="row">
        @include('layouts/_left_menu')
        @include('layouts/_noscript')
        <div id="content" class="col-lg-10 col-sm-10">
        {{ Breadcrumbs::render('review') }}
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>レビュー一覧</h2>
                </div>
                <div class="box-content">
                    <div class="row">
                       @if( count($reviews) == 0 )
                            <div class="alert alert-success">
                                {{ "検索結果が見つかりせんでした。別のキーワードをお試しください。" }}
                            </div>
                        @else                        
                            @foreach($reviews as $review)
                            @include('layouts/_reviewcard', 
                                        [
                                            'isNew' => false,
                                            'title' => $review->title,
                                            'item_name'=> $review->item_name,
                                            'evaluation'=> $review->evaluation,
                                            'content'=> $review->content,
                                            'user_id' => $review->user_id,
                                            'user_name' => $review->user_name,
                                            'created_at' => $review->created_at 
                                        ])
                            @endforeach
                        @endif
                    </div>
                    <div><div>{{ $reviews->links() }}</div></div>
                </div>
            </div>
        </div><!--/span-->
    </div>
@include('layouts/_footer')
</div><!--/.fluid-container-->
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])