@forelse ($product as $prod)
    <tr>
        <td>
            <div class="d-flex justify-content-start align-items-start">
                @if ($prod->product_cart_image_name !== null)
                    <div class="avatar avatar-xs me-3 flex-shrink-0">
                        <picture>
                            <img class="f-w-10 rounded-circle"
                                src="{{ asset('/assets/images/product/' . $prod->product_cart_image_name) }}"
                                alt="Product Image">
                        </picture>
                    </div>
                @else
                    <button
                        class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($prod->product_name, 0, 1)) }}</button>
                @endif
                <div>
                    <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                        {{ $prod->product_name }}
                    </p>
                    <span class="d-block text-muted">{{ $prod->brand->product_brand_name }}</span>
                    @if ($prod->product_spec_id !== null)
                        <span class="d-block text-muted">{{ $prod->spec->product_spec_name }}</span>
                    @endif
                </div>
            </div>
        </td>
        <td>{{ $prod->category->product_category_name }}</td>
        <td class="text-muted"> RM {{ $prod->product_base_price }}</td>
        <td class="text-muted">
            @if ($prod->product_availability === 0)
                <span class="badge rounded-pill bg-dark-faded text-dark">Unavailable</span>
            @elseif ($prod->product_availability === 1 && $prod->product_quantity == 0)
                <span class="badge rounded-pill bg-danger-faded text-danger">Out of stock</span>
            @elseif ($prod->product_availability === 1 && $prod->product_quantity > 0 && $prod->product_quantity <= 5)
                <span class="badge rounded-pill bg-warning-faded text-warning">Low in stock</span>
            @elseif ($prod->product_availability === 1 && $prod->product_quantity > 5)
                <span class="badge rounded-pill bg-success-faded text-success">Available</span>
            @endif
        </td>
        <td>
            <div class="d-flex align-items-center">
                <span class="small text-muted">{{ $prod->product_quantity }}</span>
            </div>
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                    id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-line"></i>
                </button>
                <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                    @if(Auth::user()->is_admin)
                        <li><a class="dropdown-item" href="{{ route('product.show', $prod->id) }}">Edit product</a></li>
                    @endif
                    @if ($prod->product_availability === 1 && $prod->product_quantity >= 0 && $prod->product_quantity < 6)
                        <li><a class="dropdown-item" href="#">Request more</a></li>
                    @endif
                    <li><a class="dropdown-item" href="#" onclick="addToComparison({{ $prod->id }})">Add to
                            comparison</a></li>
                </ul>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-muted">No product found</td>
    </tr>
@endforelse