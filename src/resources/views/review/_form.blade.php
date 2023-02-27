<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>レビューを投稿する</h2>
        </div>
    </div>
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
            {{-- TODO 画像アップロード可能にする --}}
            {{-- TODO 確認画面を追加 --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{-- TODO ログインUserのIDを自動入力し、hiddenで送信 --}}
                {{-- TODO リストから選択させる --}}
                <div class="form-group">
                    <label for="item_id">ユーザー</label>
                    <input type="text" class="form-control" name="user_id" value="{{ $review->user_id }}">
                </div>
                <div class="form-group">
                    <label for="item_id">レビュー品</label>
                    <input type="text" class="form-control" name="item_id" value="{{ $review->item_id }}">
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
        </div>
    </div>
</div>