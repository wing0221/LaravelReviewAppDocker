<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">メインメニュー</li>
                 <!-- ログイン状態でログインボタンをスイッチ-->
                @guest
                <li>
                    <a href="{{ route('register') }}">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>ユーザ登録</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}">
                        <i class="glyphicon glyphicon-lock"></i>
                        <span>ログイン</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>マイページ</span>
                    </a>
                </li>
                @endguest
                <li>
                    <a class="ajax-link" href="{{ route('review.index') }}">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <span>レビュー</span>
                    </a>
                </li>
                <li>
                    <a class="ajax-link" href="{{ route('item.index') }}">
                        <i class="glyphicon glyphicon-heart-empty"></i>
                        <span>おもちゃ</span>
                    </a>
                <li>
                <li>
                    <a class="ajax-link" href="#">
                        <i class="glyphicon glyphicon-signal"></i>
                        <span>ランキング</span>
                    </a>
                <li>
                <li>
                    <a class="ajax-link" href="#">
                        <i class="glyphicon glyphicon-search"></i>
                        <span>検索</span>
                    </a>
                </li>
                @auth
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="glyphicon glyphicon-lock"></i>
                        <span>ログアウト</span>
                    </a>
                </li>
                @endauth
        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->