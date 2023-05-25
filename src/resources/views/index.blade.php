@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'トイズネット'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
    <div class="row">
        @include('layouts/_left_menu')
        @include('layouts/_noscript')
        <div id="content" class="col-lg-10 col-sm-10">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2>ようこそ、トイズネットへ！</h2>
                    </div>
                    <div class="box-content">
                        <div class="row">
                        <h3 class="box col-md-12">
                            品質と信頼性に拘り、あなたの最高の選択をサポートします。
                            素晴らしい商品体験のために、一緒に探求しましょう。
                        </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2>新着レビュー</h2>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            @foreach ($latestThreeReviews as $latestThreeReview)
                            @include('layouts/_reviewcard', 
                                        [
                                            'isNew' => true,
                                            'title' => $latestThreeReview->title,
                                            'item_name'=> $latestThreeReview->item_name,
                                            'evaluation'=> $latestThreeReview->evaluation,
                                            'content'=> $latestThreeReview->content,
                                            'user_id' => $latestThreeReview->user_id,
                                            'user_name' => $latestThreeReview->user_name,
                                            'created_at' => $latestThreeReview->created_at 
                                        ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2>新着アイテム</h2>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            @foreach ($latestThreeItems as $latestThreeItem)
                            @include('layouts/_itemcard', 
                                        [
                                            'isNew' => true,
                                            'name' => $latestThreeItem->name,
                                            'item_id' => $latestThreeItem->item_id,
                                            'image' => $latestThreeItem->image,
                                            'created_at' => $latestThreeItem->created_at
                                        ])  
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts/_footer')
</div><!--/.fluid-container-->
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts/_HEAD',['page_title' => 'Laravel'])
    <body class="antialiased">
    @include('layouts/_header')
    <ul>
        <li>リンク
            <ul>
                <li>ログイン</li>
                <li><a href="/review" class="btn btn-default">レビュー覧</a></li>
                <li><a href="/item" class="btn btn-default">レビュー対象物一覧</a></li>
                <li><a href="/review/create" class="btn btn-default">レビュー投稿<</a></li>
            </ul>
        </li>
    </ul>
    </body>
</html> --}}
