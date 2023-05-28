@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー詳細'])
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
            @include('review/_content')           
          </div>
        </div>
      </div>
    </div><!--/fluid-row-->
  </div><!--/.fluid-container-->
</div>
@include('layouts/_footer')
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])