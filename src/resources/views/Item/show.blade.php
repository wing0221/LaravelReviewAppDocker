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
             @include('item/_content')           
          </div>
        </div>
      </div>
      <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>{{ $item->name }}のレビュー一覧</h2>
                </div>
                    <div class="box-content ">
                        <div class="row center" >
                            @if(count($ItemReviews) == 0)
                            <div class="alert alert-success box col-md-8">
                              {{ "このアイテムへのレビューはまだありません。" }}
                            </div>
                            @endif
                            @foreach($ItemReviews as $ItemReview)
                            @include('layouts/_reviewcard', 
                                        [
                                            'isNew' => false,
                                            'title' => $ItemReview->title,
                                            'item_name'=> $ItemReview->item_name,
                                            'evaluation'=> $ItemReview->evaluation,
                                            'content'=> $ItemReview->content,
                                            'user_id' => $ItemReview->user_id,
                                            'user_name' => $ItemReview->user_name,
                                            'created_at' => $ItemReview->created_at 
                                        ])
                            @endforeach
                          </div>
                      <div class="container">
                          <div class="row center">
                            <a class="btn btn-success" href="{{ route('review.create_item_id',$item->id) }}">
                              <i class="glyphicon glyphicon-pencil"></i>
                            レビューを投稿する
                            </a>
                          </div>
                      </div>
                      <!-- content end -->
                  </div>
                </div>
            </div>
        </div>
      </div><!--/row-->
    </div><!--/fluid-row-->
    </div><!--/fluid-row-->
  </div><!--/.fluid-container-->
</div>
@include('layouts/_footer')
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])