<div class="navbar navbar-default" role="navigation">
    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/rose.png') }}" alt="Image" class="hidden-xs"/>
            <span>トイズネット</span>
        </a>
        <div class="btn-group pull-right">
        @if (Auth::check())            
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">{{ Auth::user()->name }}</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('dashboard') }}">マイページ</a>
                </li>
                <li class="divider"></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                </li>
            </ul>
        @else
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">ゲスト</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('login') }}">ログイン</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('register') }}">ユーザ登録</a></li>
            </ul>
        @endif                
        </div>
        @csrf
        <form action="{{ route('review.index') }}" method="GET" class="navbar-search pull-right">
        <div class="form-group">
            <input type="text" name="keyword" placeholder="レビューを検索" class="form-control">
        </div>
        </form>
    </div>
</div>  