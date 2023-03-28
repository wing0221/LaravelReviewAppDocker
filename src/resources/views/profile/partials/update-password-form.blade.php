<section class="space-y-6">
    <header class="mb-4">
        <h2 class="text-lg font-bold">
            {{ __('パスワードの更新') }}
        </h2>

        <p class="text-gray-500 leading-tight">
            {{ __('セキュリティを確保するため、アカウントで使用しているパスワードは長く、ランダムなものであることを確認してください。') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">{{ __('現在のパスワード') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password">
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('新しいパスワード') }}</label>
            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('新しいパスワード（確認）') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="btn btn-primary">{{ __('パスワードを更新する') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('パスワードを更新しました。') }}</p>
            @endif
        </div>
    </form>
</section>
