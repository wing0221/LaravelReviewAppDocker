@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
      @include('layouts/_left_menu')
      @include('layouts/_noscript')
      <div id="content" class="col-lg-10 col-sm-10">
        @include('layouts/_breadcrumbs_list')
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <!-- タイトル -->
                    <div class="box-header well" data-original-title="">
                        <h2>アイテム一覧</h2>
                        <div><a href="/item/create" class="btn btn-default">新規作成</a></div>
                    </div>
                    <!-- コンテンツ -->
                    <div class="box-content">
                    {{--  検索機能 --}}
                        @csrf
                        <div class="control-group">
                          <form action="{{ route('item.index') }}" method="GET" class="form-inline">
                            <div class="form-group">
                              <input type="text" name="keyword" placeholder="キーワードを入力" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">検索</button>
                          </form>
                        </div>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">サムネイル</th>
                              <th class="text-center">名称</th>
                              <th class="text-center">メーカー</th>
                              <th class="text-center">詳細</th>
                              <th class="text-center">日付</th>
                              <th class="text-center">お気に入り登録</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                              <td>
                                <a href="/item/{{ $item->id }}/edit">{{ $item->id }}</a>
                              </td>
                              <td>
                                <img src="data:image/png;base64, {{ base64_encode($item->image) }}" width="64" height="64" class="item_img">
                              </td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->maker }}</td>
                              <td>{{ $item->content }}</td>
                              <td>{{ $item->created_at }}</td>
                              <td class="center-block">@include('layouts/_favorite-items-button')</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- <div><div>{{ $items->links() }}</div></div> --}}
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