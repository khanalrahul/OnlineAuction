<section>
    <header>
        <h2>
            {{ __('Delete Account') }}
        </h2>

        <p>
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</button>

    <div x-data="{ show: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }" 
         x-show="show" 
         x-on:keydown.escape="show = false"
         role="dialog">
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2>
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p>
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div>
                <label for="password" hidden>{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                />

                @error('password', 'userDeletion')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="button" x-on:click="show = false">
                    {{ __('Cancel') }}
                </button>

                <button type="submit">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</section>