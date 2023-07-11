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
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="item_id" value="{{ $item->id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="item-name">レビューを投稿するアイテム</label>
                    <input type="text" id="formName" class="form-control" name="item_name" value="{{ $item->name }}" disabled>
                </div>
                {{-- TODO 五つ星を押して入力するやつにする --}}
                <div class="form-group">
                <label for="evaluation">評価<span class="badge badge-danger">必須</span></label>
                <div>
                    <input type="radio" id="formValuation" name="evaluation" value="1"> 1
                    <input type="radio" id="formValuation" name="evaluation" value="2"> 2
                    <input type="radio" id="formValuation" name="evaluation" value="3"> 3
                    <input type="radio" id="formValuation" name="evaluation" value="4"> 4
                    <input type="radio" id="formValuation" name="evaluation" value="5"> 5
                </div>
                </div>
                <div class="form-group">
                    <label for="title">タイトル<span class="badge badge-danger">5文字必須</span></label>
                    <input type="text" id="formTitle" class="form-control" name="title" value="{{ $review->title }}">
                </div>
                <div class="form-group">
                    <label for="content">詳細<span class="badge badge-danger">50文字必須</span></label>
                    <textarea rows="10" type="textarea" id="formContent" class="form-control" name="content" value="{{ $review->content }}"></textarea>
                </div>
                {{-- モーダル --}}
                <!-- モーダルの設定 -->
                <div class="text-danger">＊レビューは管理者の承認後、掲載されます。</div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">投稿</button>
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
                                <p class="text-muted">■評価</p>
                                <p class="px-2" id="modaleValuation"></p>
                            </div>
                            <div>
                                <p class="text-muted">■タイトル</p>
                                <p class="px-2" id="modalTitle"></p>
                            </div>
                            <div>
                                <p class="text-muted">■詳細</p>
                                <p class="px-2" id="modalContent"></p>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="submit" class="btn btn-primary">登録</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            {{-- <button type="button" class="btn btn-primary">OK</button> --}}
                        </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <script>
                    // モーダル表示時の処理
                    $(function() {
                        $('#exampleModal').on('show.bs.modal', function () {
                            var name = $('#formName').val()
                            var valuation = $('#formValuation').val()
                            var title = $('#formTitle').val()
                            var content = $('#formContent').val()
                            var modal = $(this)
                            modal.find('#modalName').text(name)
                            modal.find('#modalValuation').text(valuation)
                            modal.find('#modalTitle').text(title)
                            modal.find('#modalContent').text(content)
                        })
                        })
                    </script>
                {{-- モーダル --}}
                <a href="/review">戻る</a>
            </form>
            <div>　</div>
        </div>
    </div>
</div>