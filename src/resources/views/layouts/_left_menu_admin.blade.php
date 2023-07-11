<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">管理者メニュー</li>
                 <!-- ログイン状態でログインボタンをスイッチ-->
                <li>
                    <a class="ajax-link" href="{{ route('admin.index') }}">
                        <i class="glyphicon glyphicon-heart-empty"></i>
                        <span>おもちゃ</span>
                    </a>
                <li>
                <li>
                    <a class="ajax-link" href="{{ route('admin_review.index') }}">
                        <i class="glyphicon glyphicon-signal"></i>
                        <span>レビュー</span>
                    </a>
                <li>
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
