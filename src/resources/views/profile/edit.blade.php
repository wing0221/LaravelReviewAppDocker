@include('layouts/_HTML',['start' => true])
@include('layouts/_HEAD',['page_title' => 'レビュー一覧'])
<body>
@include('layouts/_topbar')
<div class="ch-container">
  <div class="row">
      @include('layouts/_left_menu_mypage')
      @include('layouts/_noscript')
      <div id="content" class="col-lg-10 col-sm-10">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2>{{ __('プロフィールを編集する') }}</h2>
                    </div>
                    <div class="box-content row">
                        <!-- content start -->
                        <div class="box col-md-8">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="bg-white rounded-lg shadow-sm p-4">
                                        @include('profile.partials.update-profile-information-form')
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-8 mx-auto mt-4">
                                            <div class="bg-white rounded-lg shadow-sm p-4">
                                            @include('profile.partials.update-password-form')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 mx-auto mt-4">
                                            <div class="bg-white rounded-lg shadow-sm p-4">
                                            @include('profile.partials.delete-user-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- content end -->
                        </div>
                    </div>
                </div>
            </div><!--/span-->
        </div>
    </div><!--/.fluid-container-->
  </div>
@include('layouts/_footer')
@include('layouts/_js_assets')
</body>
@include('layouts/_HTML',['start' => false])

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
