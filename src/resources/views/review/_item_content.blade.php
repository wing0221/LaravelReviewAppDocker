<div class="box-header well" data-original-title="">
    <h2>{{ $item->name }}</h2>
    <h2 class="pull-right">評価：@include('layouts/_evaluation-stars',['evaluation' => $item->average_evaluation])({{ round((double)$item->average_evaluation,2) }})</h2>
</div>
<div class="container ops-main">
    <div class="row mt-5">
        <BR>
        <div class="col-md-8 col-md-offset-1">
            <div class="form-group center">
                <img src="{{ $item->image }}" width="50%" class="item_img">
            </div>
            <div class="form-group">
                <label for="content">詳細</label>
                <div>{{ $item->content }}</div>
            </div>
            <div>　</div>
        </div>
    </div>
</div>