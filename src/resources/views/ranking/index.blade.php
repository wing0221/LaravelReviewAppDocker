@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'アイテム一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
      @include('layouts/_left_menu')
      @include('layouts/_noscript')
      <div id="content" class="col-lg-10 col-sm-10">
        {{ Breadcrumbs::render('ranking') }}
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <!-- タイトル -->
                    <div class="box-header well" data-original-title="">
                        <h2>本日登録されたアイテムのランキング</h2>
                    </div>
                    <!-- コンテンツ -->
                    <div class="box-content">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                              <th class="text-center">順位</th>
                              <th class="text-center">名称</th>
                              <th class="text-center">イメージ</th>
                              <th class="text-center">評価平均</th>
                              <th class="text-center">メーカー</th>
                              <th class="text-center">ジャンル</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                              <td>
                              <img src="{{ asset('images/kkrn_icon_oukan_1.png') }}" alt="Image" width="16" height="16"　class="hidden-xs"/>
                              {{ $item->rank }}
                              </td>                           
                              <td>
                                <a href="/item/{{ $item->id }}">{{ $item->name }}</a>
                              </td>
                              <td>
                                <a href="/item/{{ $item->id }}">
                                <img src="{{ $item->image }}" width="64" height="64"  class="item_img">
                                </a>
                              </td>
                              <td>
                                  @include('layouts/_evaluation-stars',['evaluation' => $item->average_evaluation])
                                  ({{ round((double)$item->average_evaluation,2) }})
                              </td>
                              <td>{{ $item->maker }}</td>
                              <td>{{ $item->genre_name}}</td>
                            </tr>
                            @endforeach
                            @include('layouts/_favorite-items-js')
                            </tbody>
                        </table>
                        <div><div>{{ $items->links() }}</div></div>
                    </div>
                </div>
            </div><!--/span-->
        </div>
    </div><!--/.fluid-container-->
  </div>
@include('layouts/_footer')
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])