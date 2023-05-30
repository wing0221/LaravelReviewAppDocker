<div class="box-header well" data-original-title="">
    <h2>レビュー品登録</h2>
</div>
<div class="container ops-main">
    <div class="row mt-5">
        <div class="col-md-8 col-md-offset-1">
            
            {{-- エラーメッセージ --}}
            @include('review/_item_error_message')

            {{-- $targetの中身でリクエストを変える --}}
            @if($target == 'store')
            <form action="/item" method="post" enctype="multipart/form-data">
            @elseif($target == 'update')
            <form action="/item/{{ $item->id }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
            @endif
            {{-- TODO 確認画面を追加 --}}
                <div>　</div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <div class="form-group">
                    <label for="name">アイテム名</label>
                    <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                </div>
                <div class="form-group">
                    <label for="maker">メーカー</label>
                    <input type="text" class="form-control" name="maker" value="{{ $item->maker }}">
                </div>
                <div class="form-group">
                    <label for="image">サムネイル</label>
                    <input type="file" name="image" onchange="previewImage(event)" accept="image/jpeg, image/png">
                    <img id="preview" src="" alt="" width="64" height="64" >
                </div>
                <script>
                    function previewImage(event) {
                        // input要素から選択されたファイルを取得
                        const input = event.target;
                        if (input.files && input.files[0]) {
                            // FileReaderオブジェクトを作成
                            const reader = new FileReader();
                            // ファイルが読み込まれたときに実行する処理を定義
                            reader.onload = function(e) {
                                // 選択された画像を表示するimg要素を取得
                                const preview = document.getElementById('preview');
                                // FileReaderが読み込んだファイルをimg要素のsrc属性に設定
                                preview.src = e.target.result;
                            }
                            // ファイルを読み込む
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            // ファイルが選択されていない場合、画像を消去する
                            const preview = document.getElementById('preview');
                            preview.src = "";
                        }
                    }
                </script>
                <div class="form-group">
                    <label for="content">詳細</label>
                    <input type="text" class="form-control" name="content" value="{{ $item->content }}">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/item">戻る</a>
            </form>
            <div>　</div>
        </div>
    </div>
</div>