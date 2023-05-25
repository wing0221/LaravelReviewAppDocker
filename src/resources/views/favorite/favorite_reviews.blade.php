@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
    @include('layouts/_left_menu_mypage') 
    @include('layouts/_noscript')
    <div id="content" class="col-lg-10 col-sm-10">
      <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>{{ __('お気に入りのレビュー一覧') }}</h2>
                </div>
                <div class="box-content row">
                    <!-- content start -->
                    <div class="box col-md-8">
                        <div class="container">
                            <div class="row">
                              @if(count($LoggedInUserFavoritereviews) == 0)
                              <div class="alert alert-success box col-md-8">
                                {{ "お気に入りのレビューはありません。" }}
                              </div>
                              @endif
                              @foreach($LoggedInUserFavoritereviews as $LoggedInUserFavoritereview)
                              @include('layouts/_reviewcard', 
                                          [
                                              'isNew' => false,
                                              'title' => $LoggedInUserFavoritereview->title,
                                              'item_name'=> $LoggedInUserFavoritereview->item_name,
                                              'evaluation'=> $LoggedInUserFavoritereview->evaluation,
                                              'content'=> $LoggedInUserFavoritereview->content,
                                              'user_id' => $LoggedInUserFavoritereview->user_id,
                                              'user_name' => $LoggedInUserFavoritereview->user_name,
                                              'created_at' => $LoggedInUserFavoritereview->created_at 
                                          ])
                              @endforeach
                            </div>
                        </div>
                        <!-- content end -->
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
