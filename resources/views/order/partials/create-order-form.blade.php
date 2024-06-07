<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


    <form method="post" action="{{ route('orders.store', $product->id) }}">
        @csrf

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">{{ __('Request Product') }}</h6><br>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-start align-items-start">
                        @if ($product->product_cart_image_name !== null)
                            <div class="avatar avatar-xs me-3 flex-shrink-0">
                                <picture>
                                    <img class="f-w-10 rounded-circle"
                                        src="{{ asset('/assets/images/product/' . $product->product_cart_image_name) }}"
                                        alt="Product Image">
                                </picture>
                            </div>
                        @else
                            <button
                                class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($product->product_name, 0, 1)) }}</button>
                        @endif
                        <div>
                            <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                                {{ $product->product_name }}
                            </p>
                            <span class="d-block text-muted">{{ $product->brand->product_brand_name }}</span>
                            @if ($product->product_spec_id !== null)
                                <span class="d-block text-muted">{{ $product->spec->product_spec_name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-none">
                    <x-input-label for="product_id" class="form-label" :value="__('Product ID')" />
                    <x-text-input id="product_id" name="product_id" type="text" class="form-control"
                        :value="old('product_id', $product->id)" required autofocus autocomplete="name" />
                    <x-input-error class="form-label" :messages="$errors->get('product_id')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="order_quantity" class="form-label" :value="__('Order Quantity')" />
                    <x-text-input id="order_quantity" name="order_quantity" type="number" min="0"
                        oninput="validity.valid||(value='');" class="form-control" :value="old('order_quantity')"
                        required autofocus autocomplete="order_quantity" />
                    <x-input-error class="form-label" :messages="$errors->get('order_quantity')" />
                </div>
                <div class="flex items-center gap-4">
                    <button class="btn btn-primary">{{('Place Order') }}</button>

                </div>

            </div>
        </div>

    </form>
</section>