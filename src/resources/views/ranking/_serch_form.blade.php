<div class="container ops-main">
    <div class="row mt-5">
        <div class="col-md-8 col-md-offset-1">
            {{-- $targetの中身でリクエストを変える --}}
            <form action="{{ route('ranking.index') }}" method="GET" enctype="multipart/form-data">
                <div>　</div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <div class="form-group">
                    <label for="name">並び順</label>
                    <select class="form-control" id="month" name="month" value="0" >
                    @foreach($months as $month)
                        <option value="{{ $month->month_value }}">{{ $month->month }}</option>
                    @endforeach
                    </select>
                    
                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
            <div>　</div>
        </div>
    </div>
</div>