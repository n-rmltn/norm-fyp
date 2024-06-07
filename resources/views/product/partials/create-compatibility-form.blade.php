<section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<form method="post" action="{{ route('compatibility.create') }}">
    @csrf

    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center d-flex">
            <h6 class="card-title m-0">{{ __('Add Compatibility') }}</h6><br>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <x-input-label for="motherboard" class="form-label" :value="__('Spec Motherboard')" />
                <select id="motherboard" name="motherboard" class="form-control me-2">
                    <option value="">Select Motherboard</option>
                    @foreach($mobo as $mobo)
                        <option value="{{ $mobo->id }}">{{ $mobo->product_spec_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_spec_name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="cpu" class="form-label" :value="__('Spec Motherboard')" />
                <select id="cpu" name="cpu" class="form-control me-2">
                    <option value="">Select CPU</option>
                    @foreach($cpu as $cpu)
                        <option value="{{ $cpu->id }}">{{ $cpu->product_spec_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_spec_name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="ram" class="form-label" :value="__('Spec Motherboard')" />
                <select id="ram" name="ram" class="form-control me-2">
                    <option value="">Select RAM</option>
                    @foreach($ram as $ram)
                        <option value="{{ $ram->id }}">{{ $ram->product_spec_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_spec_name')" />
            </div>
            <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{('Add Compatibility') }}</button>

            </div>
            
        </div>
    </div>

    </form>
</section>
