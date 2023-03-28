<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">マイページメニュー</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>マイページ</span>
                    </a>
                </li>
                <li>
                    <a href="＃">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <span>投稿したレビュー</span>
                    </a>
                </li>
                <li class="accordion">
                    <a href="#">
                        <i class="glyphicon glyphicon-star"></i>
                        <span>お気に入り</span>
                    </a>
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a 
                              class="ajax-link" 
                              href="{{ route('favoriteitems.logged-in-user-favorite-items') }}"
                              >
                            <i class="glyphicon glyphicon-heart-empty"></i>
                            <span>おもちゃ</span>
                            </a>
                        </li>
                        <li>
                            <a class="ajax-link" href="#">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            <span>レビュー</span>
                        </a>
                    </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>ユーザ情報の編集</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="glyphicon glyphicon-lock"></i>
                        <span>ログアウト</span>
                    </a>
                </li>
        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->