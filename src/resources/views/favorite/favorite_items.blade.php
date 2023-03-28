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
              <h2>{{ __('お気に入り') }}</h2>
            </div>
            <div class="box-content">
              <div class="row">
                @foreach ($LoggedInUserFavoriteItems as $LoggedInUserFavoriteItem)
                @include('layouts/_itemcard', 
                            [
                                'isNew' => false,
                                'name' => $LoggedInUserFavoriteItem->name,
                                'item_id' => $LoggedInUserFavoriteItem->item_id,
                                'image' => $LoggedInUserFavoriteItem->image,
                                'created_at' => $LoggedInUserFavoriteItem->created_at
                            ])  
                @endforeach
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
