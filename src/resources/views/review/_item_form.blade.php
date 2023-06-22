<div class="container ops-main">
    <div class="row mt-5">
        <div class="col-md-8 col-md-offset-1">
            
            {{-- エラーメッセージ --}}
            @include('review/_item_error_message')

            {{-- $targetの中身でリクエストを変える --}}
            @if($target == 'store')
            <form action="/admin" method="post" enctype="multipart/form-data">
            @elseif($target == 'update')
            <form action="/admin/{{ $item->id }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
            @endif
            {{-- TODO 確認画面を追加 --}}
                <div>　</div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <div class="form-group">
                    <label for="name">アイテム名</label>
                    <input type="text" class="form-control" id="formName" name="name" value="{{ $item->name }}">
                </div>
                <div class="form-group">
                    <label for="maker">メーカー</label>
                    <input type="text" class="form-control" id="formMaker" name="maker" value="{{ $item->maker }}">
                </div>
                <div class="form-group">
                    <label for="image">サムネイル</label>
                    <input type="file" id="formImage" name="image" value="{{ $item->image }}" onchange="previewImage(event)" accept="image/jpeg, image/png">
                    @if ($item->image === NULL)
                    <img id="preview"  src="https://review-app-packet.s3.ap-northeast-1.amazonaws.com/item_image/no_image.png" alt="" width="64" height="64" >
                    @else
                    <img id="preview" src="{{ $item->image }}" alt="" width="64" height="64" >
                    @endif
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
                                const modalImage = document.getElementById('modalImage');
                                // FileReaderが読み込んだファイルをimg要素のsrc属性に設定
                                preview.src = e.target.result;
                                modalImage.src = e.target.result;
                            }
                            // ファイルを読み込む
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            // ファイルが選択されていない場合、画像を消去する
                            const preview = document.getElementById('preview');
                            preview.src = "https://review-app-packet.s3.ap-northeast-1.amazonaws.com/item_image/no_image.png";
                        }
                    }
                </script>
                <div class="form-group">
                    <label for="content">詳細</label>
                    <textarea rows="10" type="textarea" id="formContent" class="form-control" name="content" >{{ $item->content }}</textarea>
                </div>
                {{-- モーダル --}}
                <!-- モーダルの設定 -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">登録</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">以下の内容で登録します。よろしければ登録ボタンを押してください。</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p class="text-muted">■アイテム名</p>
                                <p class="px-2" id="modalName"></p>
                            </div>
                            <div>
                                <p class="text-muted">■メーカー</p>
                                <p class="px-2" id="modalMaker"></p>
                            </div>
                            <div>
                                <p class="text-muted">■サムネイル</p>
                                <img id="modalImage" src="" alt="" width="64" height="64" >
                                {{-- <p class="px-2" id="modalImage"></p> --}}
                            </div>
                            <div>
                                <p class="text-muted">■詳細</p>
                                <p class="px-2" id="modalContent"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">登録</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <script>
                    // モーダル表示時の処理
                    $(function() {
                        $('#exampleModal').on('show.bs.modal', function () {
                            var name = $('#formName').val()
                            var maker = $('#formMaker').val()
                            var content = $('#formContent').val()
                            var modal = $(this)
                            modal.find('#modalName').text(name)
                            modal.find('#modalMaker').text(maker)
                            modal.find('#modalContent').text(content)
                        })
                        })
                    </script>
                {{-- モーダル --}}
                <a href="/admin">戻る</a>
            </form>
            <div>　</div>
        </div>
    </div>
</div>