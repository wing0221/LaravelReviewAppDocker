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
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">サムネイル</th>
                              <th class="text-center">名称</th>
                              <th class="text-center">メーカー</th>
                              <th class="text-center">詳細</th>
                              <th class="text-center">削除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                              <td>
                                <a href="/item/{{ $item->id }}/edit">{{ $item->id }}</a>
                              </td>
                              <td>
                                <img src="{{ asset($item->image) }}" width="64" height="64">
                              </td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->maker }}</td>
                              <td>{{ $item->content }}</td>
                              <td>
                                <form action="/item/{{ $item->id }}" method="post">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                                </form>
                              </td>
                            </tr>
                            @endforeach
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

{{-- @extends('item/_layout')
@section('content')
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">レビュー品一覧</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">サムネイル</th>
        <th class="text-center">名称</th>
        <th class="text-center">メーカー</th>
        <th class="text-center">詳細</th>
        <th class="text-center">削除</th>
      </tr>
      @foreach($items as $item)
      <tr>
        <td>
          <a href="/item/{{ $item->id }}/edit">{{ $item->id }}</a>
        </td>
        <td>
          <img src="{{ asset($item->image) }}" width="64" height="64">
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->maker }}</td>
        <td>{{ $item->content }}</td>
        <td>
          <form action="/item/{{ $item->id }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
      <!-- ページネーション -->
      <div class="flex justify-center mt-8">
            {{ $items->links() }}
      </div>
    </table>
    <div><a href="/item/create" class="btn btn-default">新規作成</a></div>
  </div>
</div>
@endsection --}}