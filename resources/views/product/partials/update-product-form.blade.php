<section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<form method="post" action="{{ route('product.update', ['id' => $product->id])}}">
    @csrf
    @method('put')

    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center d-flex">
            <h6 class="card-title m-0">{{ __('Product Information') }}</h6><br>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <x-input-label for="product_name" class="form-label" :value="__('Product Name')" />
                <x-text-input id="product_name" name="product_name" type="text" class="form-control" :value="old('product_name', $product->product_name)" required autofocus autocomplete="name" />
                <x-input-error class="form-label" :messages="$errors->get('product_name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="product_brand_name" class="form-label" :value="__('Product Brand')" />
                <select id="product_brand_id" name="product_brand_id" class="form-control me-2">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if($brand->id == $product->product_brand_id) selected @endif>{{ $brand->product_brand_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_brand_id')" />
            </div>
            <div class="mb-3">
                <x-input-label for="product_category_name" class="form-label" :value="__('Product Category')" />
                <select id="product_category_id" name="product_category_id" class="form-control me-2" onchange="toggleSpecInput()">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $product->product_category_id) selected @endif>{{ $category->product_category_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_category_id')" />
            </div>
            <div class="mb-3 d-none" id="product_spec_container">
                <x-input-label for="product_spec_name" class="form-label" :value="__('Spec Name')" />
                <select id="product_spec_id" name="product_spec_id" class="form-control me-2">
                    <option value="null" >Select Spec</option>
                    @foreach($specs as $spec)
                        <option value="{{ $spec->id }}" @if($spec->id == $product->product_spec_id) selected @endif>{{ $spec->product_spec_name }}</option>
                    @endforeach
                    </select>
                <x-input-error class="form-label" :messages="$errors->get('product_spec_id')" />
            </div>
            <div class="mb-3">
                <x-input-label for="product_base_price" class="form-label" :value="__('Product Price')" />
                <x-text-input id="product_base_price" name="product_base_price" type="number" min="1" step="any" class="form-control" :value="old('product_base_price', $product->product_base_price)" required autofocus autocomplete="product_base_price" />
                <x-input-error class="form-label" :messages="$errors->get('product_base_price')" />
            </div>
            <div class="mb-3">
                <x-input-label for="product_quantity" class="form-label" :value="__('Product Quantity')" />
                <x-text-input id="product_quantity" name="product_quantity" type="number" min="0" oninput="validity.valid||(value='');" class="form-control" :value="old('product_quantity', $product->product_quantity)" required autofocus autocomplete="product_quantity" />
                <x-input-error class="form-label" :messages="$errors->get('product_quantity')" />
            </div>
            <div class="mb-3">
                <x-input-label for="product_description" class="form-label" :value="__('Product Description')" />
                <textarea id="product_description" name="product_description" type="text" rows="5" class="form-control" :value="old('product_description', $product->product_description)" required autofocus autocomplete="product_description">{{ $product->product_description }} </textarea>
                <x-input-error class="form-label" :messages="$errors->get('product_description')" />
            </div>
            <div class="mb-3 form-check form-switch">
                    <x-input-label for="product_availability" class="form-label" :value="__('Product Availability')" />
                    <input type="hidden" name="product_availability" value="0">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="product_availability" value="1" @if($product->product_availability === 1) checked @endif>
                    <x-input-error :messages="$errors->get('product_availability')"/>
                </div>
            <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{('Save') }}</button>
            </div>

            @if (session('status') === 'product-updated')
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

    </form>
    <script>
    function toggleSpecInput() {
        const categorySelect = document.getElementById('product_category_id');
        const specContainer = document.getElementById('product_spec_container');
        
        const specCategories = [1, 2, 3];

        if (specCategories.includes(parseInt(categorySelect.value))) {
            specContainer.classList.remove('d-none');
        } else {
            specContainer.classList.add('d-none');
        }
    }

    // Call toggleSpecInput on page load to set the correct state based on the initial category
    document.addEventListener('DOMContentLoaded', function() {
        toggleSpecInput();
    });
</script>
</section>
