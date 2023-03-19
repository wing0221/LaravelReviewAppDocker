<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-3xl font-bold text-yellow-500">レビュー品登録</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            {{-- エラーメッセージ --}}
            @include('item/_error_message')

            {{-- $targetの中身でリクエストを変える --}}
            @if($target == 'store')
            <form action="/item" method="post">
            @elseif($target == 'update')
            <form action="/item/{{ $item->id }}" method="post">
                <input type="hidden" name="_method" value="PUT">
            @endif
            {{-- TODO 画像アップロード可能にする --}}
            {{-- TODO 確認画面を追加 --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="image">ユーザー</label>
                    <input type="text" class="form-control" name="image" value="{{ $item->image }}">
                </div>
                <div class="form-group">
                    <label for="image">サムネイル</label>
                    <input type="text" class="form-control" name="image" value="{{ $item->image }}">
                </div>
                <div class="form-group">
                    <label for="image">レビュー品/label>
                    <input type="text" class="form-control" name="image" value="{{ $item->image }}">
                </div>
                <div class="form-group">
                    <label for="image">評価</label>
                    <input type="text" class="form-control" name="image" value="{{ $item->image }}">
                </div>
                <div class="form-group">
                    <label for="image">タイトル</label>
                    <input type="text" class="form-control" name="image" value="{{ $item->image }}">
                </div>
                <div class="form-group">
                    <label for="image">詳細</label>
                    <input type="text" class="form-control" name="image" value="{{ $item->image }}">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/item">戻る</a>
            </form>
        </div>
    </div>
</div>