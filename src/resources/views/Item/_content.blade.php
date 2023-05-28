<div class="box-header well" data-original-title="">
    <h2>{{ $item->name }}</h2>
</div>
<div class="container ops-main">
    <div class="row mt-5">
        <BR>
        <div class="col-md-8 col-md-offset-1">
            {{-- <div class="form-group">
                <label for="maker">メーカー</label>
                <div>{{ $item->maker }}</div>
            </div> --}}
            <div class="form-group center">
                <img src="data:image/png;base64, {{ base64_encode($item->image) }}" width="50%" class="item_img">
            </div>
            <div class="form-group">
                <label for="content">詳細</label>
                <div>{{ $item->content }}</div>
            </div>
            <div>　</div>
        </div>
    </div>
</div>