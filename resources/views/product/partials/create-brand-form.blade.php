<section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<form method="post" action="{{ route('brands.create') }}">
    @csrf

    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center d-flex">
            <h6 class="card-title m-0">{{ __('Add Brand') }}</h6><br>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <x-input-label for="product_brand_name" class="form-label" :value="__('Brand Name')" />
                <x-text-input id="product_brand_name" name="product_brand_name" type="text" class="form-control" :value="old('product_brand_name')" required autofocus autocomplete="name" />
                <x-input-error class="form-label" :messages="$errors->get('product_brand_name')" />
            </div>
            <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{('Add Brand') }}</button>

            </div>
            
        </div>
    </div>

    </form>
</section>
