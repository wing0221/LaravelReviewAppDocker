@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
    <div class="row">
        @include('layouts/_left_menu')
        @include('layouts/_noscript')
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
        </div>
    </div>
@include('layouts/_footer')
</div><!--/.fluid-container-->
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])
    {{-- @extends('item/_layout')
    @section('content')
    @include('item/_form', ['target' => 'store'])
    @endsection --}}