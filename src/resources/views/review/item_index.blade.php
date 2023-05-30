@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'アイテム一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
      @include('layouts/_left_menu')
      @include('layouts/_noscript')
      <div id="content" class="col-lg-10 col-sm-10">
        {{ Breadcrumbs::render('item') }}
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <!-- タイトル -->
                    <div class="box-header well" data-original-title="">
                        <h2>アイテム一覧</h2>
                        {{-- {{ dd($evaluation_avg) }} --}}
                    </div>
                    <!-- コンテンツ -->
                    <div class="box-content">
                    {{--  検索機能 --}}
                        @csrf
                      <div class="box-center">
                        <div class="col-md-4">
                          <div class="control-group">
                            <label for="serach">検索</label>
                            <form action="{{ route('item.index') }}" method="GET" class="form-inline">
                              <div class="form-group">
                                <input type="text" name="keyword" placeholder="キーワードを入力" class="form-control">
                              </div>
                              <button type="submit" class="btn btn-primary">検索</button>
                            </form>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="control-group">
                            <label for="sort">並び替え</label>
                            <form action="{{ route('item.index') }}" method="GET" class="form-inline">
                              <div class="form-group">
                                <select class="form-control" id="sort" name="sort">
                                    <option value="1">新しい順</option>
                                    <option value="2">評価の高い順</option>
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary">並び替え</button>
                            </form>
                          </div>
                          <div>　</div>
                        </div>
                        {{-- 検索結果が見つからなかった場合はフラッシュメッセージを表示 --}}
                        @if( count($items) == 0 )
                          <div>　</div>
                        {{-- <div class="alert alert-success">
                            {{ "検索結果が見つかりせんでした。別のキーワードをお試しください。" }}
                        </div> --}}
                        @else
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                              {{-- <th class="text-center">ID</th> --}}
                              <th class="text-center">名称</th>
                              <th class="text-center">イメージ</th>
                              <th class="text-center">評価平均</th>
                              <th class="text-center">メーカー</th>
                              <th class="text-center">日付</th>
                              <th class="text-center">お気に入り登録</th>
                            </tr>
                            </thead>
                        @endif
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                              {{-- <td>{{ $item->id }}</td> --}}
                              <td>
                                <a href="/item/{{ $item->id }}">{{ $item->name }}</a>
                              </td>
                              <td>
                                <a href="/item/{{ $item->id }}">
                                <img src="data:image/png;base64, {{ base64_encode($item->image) }}" width="64" height="64" class="item_img">
                                </a>
                              </td>
                              <td>
                                  @include('layouts/_evaluation-stars',['evaluation' => $item->average_evaluation])
                                  ({{ round((double)$item->average_evaluation,2) }})
                              </td>
                              <td>{{ $item->maker }}</td>
                              <td>{{ $item->created_at }}</td>
                              <td class="center-block">@include('layouts/_favorite-items-button')</td>
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