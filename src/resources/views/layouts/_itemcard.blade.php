<div class="box col-md-4">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <div class="box-icon">
                @if($isNew == true)
                <div class="label-info label label-default">New!</div>
                @endif
            </div>
            <h2>
                <i class="glyphicon glyphicon-list-alt"></i>
                {{ $name }}
            </h2>
        </div>
        <div class="box-content">
            <div class="text-left">{{ $item_id }}</div>
            {{-- <div class="text-left">{{ $image }}</div> --}}
            <img src="data:image/png;base64, {{ base64_encode($image) }}" width="200" class="item_img">
            <span>　</span>
            <h6 class="text-right">{{ $created_at }}</h6>
        </div>
    </div>
</div>