<div class="container ops-main">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            {{-- エラーメッセージ --}}
            @include('review/_error_message')

            {{-- $targetの中身でリクエストを変える --}}
            @if($target == 'store')
            <form action="/review" method="post">
            @elseif($target == 'update')
            <form action="/review/{{ $review->id }}" method="post">
                <input type="hidden" name="_method" value="PUT">
            @endif
            {{-- TODO 確認画面を追加 --}}
                <div>　</div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{-- TODO ログインUserのIDを自動入力し、hiddenで送信 --}}
                <div class="form-group">
                    <label for="item_id">ユーザー</label>
                    <input type="text" class="form-control" name="user_id" value="{{ $review->user_id }}">
                </div>
                <div class="form-group">
                    <label for="item-id">レビュー品</label>
                    <select class="form-control"  name="item_name">
                        @foreach ($item_names as $item_name)
                            <option>{{ $item_name->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- TODO 五つ星を押して入力するやつにする --}}
                <div class="form-group">
                    <label for="evaluation">評価</label>
                    <input type="text" class="form-control" name="evaluation" value="{{ $review->evaluation }}">
                </div>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control" name="title" value="{{ $review->title }}">
                </div>
                <div class="form-group">
                    <label for="content">詳細</label>
                    {{-- <input type="textarea" class="form-control" name="content" value="{{ $review->content }}"> --}}
                    <textarea rows="10" type="textarea" class="form-control" name="content" value="{{ $review->content }}"></textarea>
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/review">戻る</a>
            </form>
            <div>　</div>
        </div>
    </div>
</div>