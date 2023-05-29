<div class="box-header well" data-original-title="">
    <h2>{{ $review->item_name }}</h2>
</div>
<div class="container ops-main">
    <div class="row mt-5">
        <BR>
        <div class="col-md-8 col-md-offset-1">
            <div class="form-group">
                <label>サムネイル</label>
            </div>
            <div class="form-group">
                <label for="content">詳細</label>
                <div>{{ $review->content }}</div>
            </div>
            <h6 class="text-right">
                <span class="glyphicon glyphicon-user"></span>
                <a href="{{ route('profile.show_other',$review->user_id)}}">
                    <span>{{ $review->user_name }}</span>
                </a>
                <span>　</span>{{ $review->created_at }}
            </h6>
        </div>
    </div>
</div>