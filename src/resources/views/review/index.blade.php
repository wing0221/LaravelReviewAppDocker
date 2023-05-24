

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
                        @foreach($reviews as $review)
                        @include('layouts/_reviewcard', 
                                    [
                                        'isNew' => true,
                                        'title' => $review->title,
                                        'item_name'=> $review->item_name,
                                        'evaluation'=> $review->evaluation,
                                        'content'=> $review->content,
                                        'user_id' => $review->user_id,
                                        'user_name' => $review->user_name,
                                        'created_at' => $review->created_at 
                                    ])
                        @endforeach
                    </div>
                    {{-- <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">ユーザー</th>
                            <th class="text-center">レビュー品</th>
                            <th class="text-center">評価</th>        
                            <th class="text-center">タイトル</th>
                            <th class="text-center">詳細</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $review)
                        <tr>
                                    <td>
                            <a href="review/{{ $review->id }}/edit">{{ $review->id }}</a>
                            </td>
                            <td>{{ $review->user_name }}</td>
                            <td>{{ $review->item_name }}</td>
                            <td>{{ $review->evaluation }}</td>
                            <td>{{ $review->title }}</td>
                            <td>{{ $review->content }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table> --}}
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