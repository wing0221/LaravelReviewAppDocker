<div class="box col-md-4">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <div class="box-icon">
                @if($isNew == true)
                <div class="label-info label label-default">New!</div>
                @endif
            </div>
            <h2>
                <i class="glyphicon glyphicon-th"></i> 
                {{ $title }}
            </h2>
        </div>
        <div class="box-content">
            <div class="text-left">
            {{ $item_id }}
            <span>　　　</span>
            {{ $evaluation }}
            </div>
            <div class="text-left">{{ $content }}</div>
            <span>　</span>
            <h6 class="text-right">{{ $user_id }}<span>　</span>
            {{ $created_at }}</h6>
        </div>
    </div>
</div>