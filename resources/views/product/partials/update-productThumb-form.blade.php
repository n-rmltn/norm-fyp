<section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<form method="post" action="{{ route('product.updateThumb', ['id' => $product->id])}}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="card mb-4">
        <div class="card-header justify-content-between align-items-center d-flex">
            <h6 class="card-title m-0">{{ __('Product Thumbnail') }}</h6><br>
        </div>
        <div class="card-body">
            <div class="mb-3">
                @if ($product->product_cart_image_name !== null)
                <img src="{{ asset('assets/images/product/'.$product->product_cart_image_name) }}"
                            class="card-img-top" alt="Cart Images">
                @endif
            </div>
            <div class="mb-3">
                <x-input-label for="product_cart_image_name" class="form-label" :value="__('Product Thumbnail')" />
                <input class="form-control" type="file" id="product_cart_image_name" name="product_cart_image_name">
            </div>
            <div class="flex items-center gap-4">
            <button class="btn btn-primary">
                @if ($product->product_cart_image_name !== null)
                {{('Replace') }}
                @else
                {{('Add') }}
                @endif
            </button>
            </div>

            @if (session('status') === 'productThumb-updated')
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
</section>
