<div class="container ops-main">
    <div class="row mt-5">
        <div class="col-md-8 col-md-offset-1">
            {{-- $targetの中身でリクエストを変える --}}
            <form action="{{ route('item.index') }}" method="GET" enctype="multipart/form-data">
                <div>　</div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <div class="form-group">
                    <label for="name">アイテム名</label>
                    <input type="text" class="form-control" id="formName" name="name" >
                </div>
                <div class="form-group">
                    <label for="name">並び順</label>
                    <select class="form-control" id="order" name="order" value="0" >
                        <option value="0">新しい順</option>
                        <option value="1">古い順</option>
                        <option value="2">評価の高い順</option>
                        <option value="3">評価の低い順</option>
                        <option value="4">レビュー数の多い順</option>
                        <option value="5">レビュー数の少ない順</option>
                    </select>
                </div>
                {{-- 評価平均 --}}
                <div class="form-group">
                    <label for="customRange2" class="form-label" id="minLabel">評価平均</label>
                    <div><span id="minValue">0</span>以上</div>
                    <input type="range" class="form-range" min="0" max="5" id="minInput" name="average_evaluation_min" value="0">
                    <div>　</div>
                    <div><span id="maxValue">5</span>以下</div>
                    <input type="range" class="form-range" min="0" max="5" id="maxInput" name="average_evaluation_max" value="5">
                    <script>
                    const minValue = document.getElementById("minValue");
                    const minInput = document.getElementById("minInput");
                    const maxValue = document.getElementById("maxValue");
                    const maxInput = document.getElementById("maxInput");

                    minInput.addEventListener("input", function() {
                        minValue.textContent = minInput.value;
                    });
                    maxInput.addEventListener("input", function() {
                        maxValue.textContent = maxInput.value;
                    });
                    </script>
                </div>
                <div class="form-group">
                    <label for="maker">メーカー</label>
                    <select class="form-control" name="maker">>
                        <option value="" id="formGenre">未選択</option>
                        @foreach ($makers as $maker)
                        <option value="{{ $maker->maker }}" id="formGenre">{{ $maker->maker }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="genre">ジャンル</label>
                    <select class="form-control" name="genre">
                        <option value="" id="formGenre">未選択</option>
                        @foreach ($genres as $genre)
                        <option value="{{ $genre->name }}" id="formGenre">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
            <div>　</div>
        </div>
    </div>
</div>

