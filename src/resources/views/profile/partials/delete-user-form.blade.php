<section class="my-5">
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('アカウント削除') }}
    </h2>

    <p class="mt-3 mb-0 text-muted">
      {{ __('アカウントを削除すると、そのアカウントに関連する全てのリソースやデータが永久に削除されます。') }}
    </p>
  </header>

 <button
    type="button" 
    class="btn btn-danger"
    data-toggle="modal" 
    data-target="#confirm-user-deletion"
    >
    {{ __('アカウントを削除する') }}
  </button>

  <div 
    class="modal fade" 
    id="confirm-user-deletion" 
    tabindex="-1" 
    role="dialog" aria-labelledby="confirm-user-deletion-label"
    aria-hidden="true"
    data-backdrop="static" 
    data-keyboard="false"
    >
    <div 
        class="modal-dialog modal-dialog-centered" role="document"
        >
      <form 
        method="post" 
        action="{{ route('profile.destroy') }}" class="modal-content"
        >
        @csrf
        @method('delete')

        <div class="modal-header">
          <h2 class="modal-title font-weight-bold" id="confirm-user-deletion-label">{{ __('アカウント削除') }}</h2>
        </div>

        <div class="modal-body">
          <p class="mt-3 mb-0 text-muted">{{ __('アカウントを削除してもよろしいですか？アカウントが削除されると、すべてのリソースやデータが永久に削除されます。アカウントを永久に削除するためには、パスワードを入力して確認してください。') }}</p>

          <div class="mt-4">
            <label for="password" class="sr-only">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" required>
            <div class="invalid-feedback">{{ $errors->userDeletion->first('password') }}</div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
        </div>
      </form>
      
    </div>
  </div>
</section>

{{-- !!!!!!!! tailwind ver !!!!!!!!!!!!!!--}}
    {{-- <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

<x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section> --}}
