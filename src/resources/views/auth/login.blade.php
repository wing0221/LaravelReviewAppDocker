@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
      @include('layouts/_noscript')
      <div class="row">
        <div class="row">
            <div class="col-md-12 center login-header">
                <h2>ログイン画面</h2>
            </div>
            <!--/span-->
        </div><!--/row-->
        <div class="row">
            <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                メールアドレスとパスワードを入力してください。
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            @csrf
                <fieldset>
                    {{-- E-mail --}}
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                        <x-text-input id="email" class="form-control" placeholder="E-mail" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <div class="clearfix"></div><br>
                    {{-- Password --}}
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <x-text-input id="password" class="form-control" placeholder="Password"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="pull-right">ユーザー登録がお済みで無い方は<a href="/register"class="text-primary">こちら</a></div>
                    <div class="clearfix"></div>

                    <div class="center">
                        <p class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ログイン') }}
                            </button>
                        </p>
                        <p class="col-md-6">
                            <script>
                                // ゲストユーザー情報をフォームに入力
                                function setFormValue() {
                                    var inputEmail = "gest@example.com";
                                    var inputPassword = "gestgestgestgest";
                                    var inputEmailElement = document.getElementById("email");
                                    var inputPasswordElement = document.getElementById("password");
                                    inputEmailElement.value = inputEmail;
                                    inputPasswordElement.value = inputPassword;
                                    }
                            </script>
                            <button onclick="setFormValue()" type="submit" class="btn btn-warning">
                                {{ __('ゲストログイン') }}
                            </button>
                        </p>
                    </div>
            </fieldset>
          </form>
        </div>
      </div><!--/row-->
    </div><!--/fluid-row-->
  </div><!--/.fluid-container-->
</div>
@include('layouts/_footer')
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])