<section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<form method="post" action="{{ route('spec.create') }}">
    @csrf

    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center d-flex">
            <h6 class="card-title m-0">{{ __('Add Spec') }}</h6><br>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <x-input-label for="product_category_name" class="form-label" :value="__('Spec Category')" />
                <select id="product_spec_cat" name="product_spec_cat" class="form-control me-2">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_category_name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="product_spec_name" class="form-label" :value="__('Spec Name')" />
                <x-text-input id="product_spec_name" name="product_spec_name" type="text" class="form-control" :value="old('product_spec_name')" required autofocus autocomplete="name" />
                <x-input-error class="form-label" :messages="$errors->get('product_spec_name')" />
            </div>
            <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{('Add Spec') }}</button>

            </div>
            
        </div>
    </div>

    </form>
</section>
