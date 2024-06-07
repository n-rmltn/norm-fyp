<section>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">{{ __('Update Password') }}</h6><br>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <x-input-label for="update_password_current_password" class="form-label" :value="__('Current Password')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')"/>
                </div>
                <div class="mb-3">
                    <x-input-label for="update_password_password" class="form-label" :value="__('New Password')" />
                    <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')"/>
                </div>
                <div class="mb-3">
                    <x-input-label for="update_password_password_confirmation" class="form-label" :value="__('Confirm Password')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"/>
                </div>
            <button class="btn btn-primary">{{('Change Password') }}</button>
            
            @if (session('status') === 'password-updated')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                </svg>
                <div class="alert alert-primary d-flex align-items-center mb-4" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                    <use xlink:href="#info-fill" /></svg>
                    <div>
                        {{ __('Password Changed') }}
                    </div>
                </div>
            </div>
            @endif
            </div>
        </div>
    </form>
</section>
