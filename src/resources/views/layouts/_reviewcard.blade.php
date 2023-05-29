<div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <div class="box-icon">
                @if($isNew == true)
                <div class="label-info label label-default">New!</div>
                @endif
            </div>
            <h2>
                <i class="glyphicon glyphicon-th"></i> 
                {{ $item_name }} 
            </h2>
        </div>
        <div class="box-content">
            <div class="text-left">
                <h4 class="font-weight-bold">
                    {{ $title }}
                </h4>
                <div>
                @include('layouts/_evaluation-stars',['evalution' => $evaluation])
                </div>
            </div>
            <br>
            <div class="text-left">{{ $content }}</div>
            <span>　</span>
            <h6 class="text-right">
                <span class="glyphicon glyphicon-user"></span>
                <a href="{{ route('profile.show_other',$user_id)}}">
                    <span>{{ $user_name }}</span>
                </a>
                <span>　</span>{{ $created_at }}
            </h6>
        </div>
    </div>
</div>