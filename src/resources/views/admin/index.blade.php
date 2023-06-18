@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => '管理画面'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
    <div class="row">
        @include('layouts/_left_menu')
        @include('layouts/_noscript')
        <div id="content" class="col-lg-10 col-sm-10">
        {{-- {{ Breadcrumbs::render('admin') }} --}}
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>管理画面</h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="/item/create">新規作成</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box col-md-12">
            <div class="box-inner">
                <!-- タイトル -->
                <div class="box-header well" data-original-title="">
                    <h2>アイテム一覧　※名称を選択すると編集画面が開きます。</h2>
                    {{-- {{ dd($evaluation_avg) }} --}}
                </div>
                <!-- コンテンツ -->
                <div class="box-content">
                {{--  検索機能 --}}
                    @csrf
                    <div class="box-center">
                    <div class="col-md-4">
                    </div>
                    {{-- 検索結果が見つからなかった場合はフラッシュメッセージを表示 --}}
                    @if( count($items) == 0 )
                        <div>　</div>
                    @else
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            {{-- <th class="text-center">ID</th> --}}
                            <th class="text-center">id</th>
                            <th class="text-center">名称</th>
                            <th class="text-center">イメージ</th>
                            <th class="text-center">評価平均</th>
                            <th class="text-center">メーカー</th>
                            <th class="text-center">日付</th>
                            <th class="text-center">削除する</th>
                        </tr>
                        </thead>
                    @endif
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                            <a href="/item/{{ $item->id }}/edit">{{ $item->name }}</a>
                            </td>
                            <td>
                            <a href="/item/{{ $item->id }}">
                            <img src="{{ $item->image }}" width="64" height="64" class="item_img">
                            </a>
                            </td>
                            <td>
                                @include('layouts/_evaluation-stars',['evaluation' => $item->average_evaluation])
                                ({{ round((double)$item->average_evaluation,2) }})
                            </td>
                            <td>{{ $item->maker }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>削除</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div><div>{{ $items->links() }}</div></div>
                </div>
            </div>
        </div><!--/span-->
    </div>
@include('layouts/_footer')
</div><!--/.fluid-container-->
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])