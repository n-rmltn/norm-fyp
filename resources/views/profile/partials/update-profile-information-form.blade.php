<section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<!-- User Details-->
<form method="post" action="{{ route('profile.update', ['id' => $user->id])}}">
    @csrf
    @method('put')

    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center d-flex">
            <h6 class="card-title m-0">{{ __('User Information') }}</h6><br>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="form-label" :messages="$errors->get('name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="email" class="form-label" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="form-control mb-2" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="form-label" :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <x-input-label for="phone" class="form-label" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="phone" class="form-control mb-2" :value="old('phone', $user->phone)" required autocomplete="phone" />
                <x-input-error class="form-label" :messages="$errors->get('phone')" />
            </div>
                <div class="mb-3">
                    <x-input-label for="address_1" class="form-label" :value="__('Address 1')" />
                    <x-text-input id="address_1" name="address_1" type="text" class="form-control" :value="old('address_1', $user->address_1)" autofocus autocomplete="address_1" />
                    <x-input-error class="form-label" :messages="$errors->get('address_1')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="address_2" class="form-label" :value="__('Address 2')" />
                    <x-text-input id="address_2" name="address_2" type="address_2" class="form-control mb-2" :value="old('address_2', $user->address_2)" autocomplete="address_2" />
                    <x-input-error class="form-label" :messages="$errors->get('address_2')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="city" class="form-label" :value="__('City')" />
                    <x-text-input id="city" name="city" type="city" class="form-control mb-2" :value="old('city', $user->city)"  autocomplete="city" />
                    <x-input-error class="form-label" :messages="$errors->get('city')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="state" class="form-label" :value="__('State')" />
                        <select class="form-select" id="update-state" name="state">
                            <option @if($user->state === null) selected @endif>Select State</option>
                            <option value="Johor" @if($user->state === 'Johor') selected @endif>Johor</option>
                            <option value="Kedah" @if($user->state === 'Kedah') selected @endif>Kedah</option>
                            <option value="Kelantan" @if($user->state === 'Kelantan') selected @endif>Kelantan</option>
                            <option value="Malacca" @if($user->state === 'Malacca') selected @endif>Malacca</option>
                            <option value="Negeri Sembilan" @if($user->state === 'Negeri Sembilan') selected @endif>Negeri Sembilan</option>
                            <option value="Pahang" @if($user->state === 'Pahang') selected @endif>Pahang</option>
                            <option value="Penang" @if($user->state === 'Penang') selected @endif>Penang</option>
                            <option value="Perak" @if($user->state === 'Perak') selected @endif>Perak</option>
                            <option value="Perlis" @if($user->state === 'Perlis') selected @endif>Perlis</option>
                            <option value="Sabah" @if($user->state === 'Sabah') selected @endif>Sabah</option>
                            <option value="Sarawak" @if($user->state === 'Sarawak') selected @endif>Sarawak</option>
                            <option value="Selangor" @if($user->state === 'Selangor') selected @endif>Selangor</option>
                            <option value="Terengganu" @if($user->state === 'Terengganu') selected @endif>Terengganu</option>
                            <option value="Kuala Lumpur" @if($user->state === 'Kuala Lumpur') selected @endif>Kuala Lumpur</option>
                            <option value="Labuan" @if($user->state === 'Labuan') selected @endif>Labuan</option>
                            <option value="Putrajaya" @if($user->state === 'Putrajaya') selected @endif>Putrajaya</option>
                        </select>
                    <x-input-error class="form-label" :messages="$errors->get('state')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="postal" class="form-label" :value="__('Postal Code')" />
                    <x-text-input id="postal" name="postal" type="postal" class="form-control mb-2" :value="old('postal', $user->postal)" autocomplete="postal" />
                    <x-input-error class="form-label" :messages="$errors->get('postal')" />
                </div>
            <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{('Save') }}</button>

            @if (session('status') === 'profile-updated')

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
                        {{ __('Saved') }}
                    </div>
                </div>
            </div>
            @endif
            </div>
            
        </div>
    </div>
<!-- / User Details-->

    </form>
</section>
