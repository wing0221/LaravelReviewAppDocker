@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => '投稿承認画面'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
    <div class="row">
        @include('layouts/_left_menu_admin')
        @include('layouts/_noscript')
        <div id="content" class="col-lg-10 col-sm-10">
        {{-- {{ Breadcrumbs::render('admin') }} --}}
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>管理画面 *チェックボックスで選択したレビューに以下の処理を実行します</h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-8">
                        <form method="POST" action="admin_review">
                        @csrf
                        <button type="submit" name="action" value="APPROVED" class="btn btn-primary">承認する</button>
                        <button type="submit" name="action" value="PENDING" class="btn btn-danger">承認解除</button>
                        <button type="submit" name="action" value="REJECTED" class="btn btn-success">承認却下</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box col-md-12">
            <div class="box-inner">
                <!-- タイトル -->
                <div class="box-header well" data-original-title="">
                    <h2>レビュー一覧</h2>
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
                    @if( count($reviews) == 0 )
                        <div>　</div>
                    @else
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center">チェック</th>
                            <th class="text-center">承認状態</th>
                            <th class="text-center">タイトル</th>
                            <th class="text-center">アイテム名</th>
                            <th class="text-center">評価</th>
                            <th class="text-center">詳細</th>
                            <th class="text-center">ユーザー</th>
                            <th class="text-center">投稿日時</th>
                        </tr>
                        </thead>
                    @endif
                        <tbody>
                        @foreach($reviews as $review)
                        {{-- 承認済みかどうかで処理を分ける --}}
                        @if( $review->checked == 'PENDING')
                        <tr class="danger">
                        @elseif( $review->checked == 'APPROVED' )
                        <tr class="info">
                        @elseif( $review->checked == 'REJECTED' )
                        <tr class="warning">
                        @endif
                        <td><input type="checkbox" name="id[]" value="{{ $review->id }}"></td>
                        <td>
                        <div class="btn-group-toggle" data-toggle="buttons">
                        {{-- 承認済みかどうかで処理を分ける --}}
                        @if( $review->checked == 'PENDING' )
                        <label class="btn btn-warning btn-sm">
                            <input type="radio" name="approval" value="unapproved"> 承認待ち
                        </label>
                        @elseif( $review->checked == 'APPROVED' )
                        <label class="btn btn-info btn-sm">
                            <input type="radio" name="approval" value="approved" checked> 承認済み
                        </label>
                        @elseif( $review->checked == 'REJECTED' )
                        <label class="btn btn-secondary btn-sm">
                            <input type="radio" name="approval" value="approved" checked> 承認却下
                        </label>                        
                        @endif
                        </div>
                            </td>
                            <td>{{ $review->title }}</td>
                            <td>{{ $review->item_name }}</td>
                            <td>{{ $review->evaluation }}</td>
                            <td>{{ $review->content }}</td>
                            <td>{{ $review->user_name }}</td>
                            <td>{{ $review->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div><div>{{ $reviews->links() }}</div></div>
                    </form>
                </div>
            </div>
        </div><!--/span-->
    </div>
@include('layouts/_footer')
</div><!--/.fluid-container-->
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])

{{-- 
                            @include('layouts/_reviewcard', 
                                        [
                                            'isNew' => false,
                                            'title' => $review->title,
                                            'item_name'=> $review->item_name,
                                            'evaluation'=> $review->evaluation,
                                            'content'=> $review->content,
                                            'user_id' => $review->user_id,
                                            'user_name' => $review->user_name,
                                            'created_at' => $review->created_at 
                                        ]) --}}