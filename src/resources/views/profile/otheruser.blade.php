@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
    @include('layouts/_left_menu')
    @include('layouts/_noscript')
    <div id="content" class="col-lg-10 col-sm-10">
      <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>{{ $user_data->name }}さんのプロフィール</h2>
                </div>
                <div class="box-content row">
                    <!-- content start -->
                    <div class="box col-md-8">
                        <div class="container">
                            <div class="row">
                                <div>このユーザーの紹介文はありません。</div>
                            </div>
                        </div>
                        <!-- content end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>{{ $user_data->name }}さんの投稿したレビュー</h2>
                </div>
                    <div class="box-content">
                        <div class="row">                            
                        @foreach ($user_reviews as $user_review)
                            @include('layouts/_reviewcard', 
                                        [
                                            'isNew' => false,
                                            'title' => $user_review->title,
                                            'item_name'=> $user_review->item_name,
                                            'evaluation'=> $user_review->evaluation,
                                            'content'=> $user_review->content,
                                            'user_id' => $user_review->user_id,
                                            'user_name' => $user_review->user_name,
                                            'created_at' => $user_review->created_at 
                                        ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div><!--/row-->
    </div><!--/fluid-row-->
  </div><!--/.fluid-container-->
</div>
@include('layouts/_footer')
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])