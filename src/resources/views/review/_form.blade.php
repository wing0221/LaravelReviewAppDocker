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
                    <label for="item-id">レビュー品</label>
                    <select class="form-control"  name="item_name">
                        @foreach ($item_names as $item_name)
                            <option>{{ $item_name->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- TODO 五つ星を押して入力するやつにする --}}
                <div class="form-group">
                <label for="evaluation">評価</label>
                <div>
                    <input type="radio" name="evaluation" value="1"> 1
                    <input type="radio" name="evaluation" value="2"> 2
                    <input type="radio" name="evaluation" value="3"> 3
                    <input type="radio" name="evaluation" value="4"> 4
                    <input type="radio" name="evaluation" value="5"> 5
                </div>
                </div>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control" name="title" value="{{ $review->title }}">
                </div>
                <div class="form-group">
                    <label for="content">詳細</label>
                    {{-- <input type="textarea" class="form-control" name="content" value="{{ $review->content }}"> --}}
                    <textarea rows="10" type="textarea" class="form-control" name="content" value="{{ $review->content }}"></textarea>
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/review">戻る</a>
            </form>
            <div>　</div>
        </div>
    </div>
</div>