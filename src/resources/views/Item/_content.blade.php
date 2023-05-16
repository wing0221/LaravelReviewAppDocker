<div class="box-header well" data-original-title="">
    <h2>おもちゃ詳細</h2>
</div>
<div class="container ops-main">
    <div class="row mt-5">
        <div class="col-md-8 col-md-offset-1">
            <div class="form-group">
                <label for="name">アイテム名</label>
                <div>{{ $item->name }}</div>
            </div>
            <div class="form-group">
                <label for="maker">メーカー</label>
                <div>{{ $item->maker }}</div>
            </div>
            <div class="form-group">
                <label>サムネイル</label>
            </div>
            <div class="form-group">
                <label for="content">詳細</label>
                <div>{{ $item->content }}</div>
            </div>
            <div>　</div>
        </div>
    </div>
</div>