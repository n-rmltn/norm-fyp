<section>

    <form method="post" action="{{ route('profile.updateAdmin', ['id' => $user->id]) }}">
        @csrf
        @method('put')

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">{{ __('Administrator') }}</h6><br>
            </div>
            <div class="card-body">
                <div class="mb-3 form-check form-switch">
                    <x-input-label for="update_password_current_password" class="form-label" :value="__('Administrator Rights')" />
                    <input type="hidden" name="is_admin" value="0">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_admin" value="1" @if($user->is_admin) checked @endif onchange="this.form.submit()">
                    <x-input-error :messages="$errors->get('is_admin')"/>
                </div>
            
                @if (session('status') === 'rights-updated')
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
                            {{ __('Admin Rights Updated') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
</section>
