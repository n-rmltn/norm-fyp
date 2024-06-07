<x-app-layout>
    <!-- Breadcrumbs-->

    <!-- Content-->
    <section class="container-fluid">

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">Product Listing</h6>
            </div>
            <div class="card-body">

                <!-- User listing Actions-->

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="search-form"
                            class="bg-light rounded px-3 py-1 flex-shrink-0 d-flex align-items-center"
                            action="javascript:void(0);" method="get">
                            <input id="productsearch-input" class="form-control border-0 bg-transparent px-0 py-2 me-5 fw-bolder" type="search"
                            name="search" placeholder="Search" aria-label="Search" onkeyup="getSearchProduct(this.value)">
                            <button class="btn btn-link p-0 text-muted" type="submit"><i
                                    class="ri-search-2-line"></i></button>
                        
                        <div class="dropdown px-3">
                            <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-bar-chart-horizontal-line"></i>
                            </button>
                            <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                <li class="">
                                    <select class="form-control me-2" name="category">
                                        <option value="">Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" @if(request('category') == $cat->id) selected
                                            @endif>
                                                {{ $cat->product_category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                                <li class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="availabilityCheckbox"
                                            name="availability" value="1">
                                        <label class="form-check-label" for="availabilityCheckbox"
                                            checked>Available</label>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="lowStockCheckbox"
                                            name="lowStock" value="1" @if(request('lowStock')) checked @endif>
                                        <label class="form-check-label" for="lowStockCheckbox">Low Stock</label>
                                    </div>
                                </li>
                            </ul>
                            </form>
                        </div>
                    </div>
                    

                    @if(Auth::user()->is_admin)
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm btn-primary" href="{{ route('product.create') }}"><i
                                    class="ri-add-circle-line align-bottom"></i> Add Product</a>
                        </div>
                    @endif
                </div>
                <!-- User listing Actions-->

                <!-- User Listing Table-->
                <div class="table-responsive">
                    <table class="table m-0 table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Availability</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="product-list">

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
                                                <span
                                                    class="d-block text-muted">{{ $prod->brand->product_brand_name }}</span>
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
                                            <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                type="button" id="dropdownOrder-0" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-more-2-line"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                                @if(Auth::user()->is_admin)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('product.show', $prod->id) }}">Edit product</a></li>
                                                @endif
                                                    <li><a class="dropdown-item" href="{{ route('orders.create', $prod->id) }}">Request more</a></li>
                                                @if ($prod->product_category_id == 1 || $prod->product_category_id == 2 || $prod->product_category_id == 3)
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="addToComparison({{ $prod->id }})">Add to comparison
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">No product found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /User Listing Table-->
                <nav>
                    <ul class="pagination justify-content-end mt-3 mb-0">
                        {!! $product->links('vendor.pagination.pagination') !!}
                    </ul>
                </nav>
            </div>
        </div>

        @include('layouts.partials.footer')

        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->

    </section>
    <script>
        function addToComparison(productId) {
            $.ajax({
                url: '/comparison/' + productId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert('Product added to comparison list');
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 422) {
                        var errorMessage = xhr.responseJSON.error;
                        alert(errorMessage);
                    } else {
                        alert('Failed to add product to comparison list');
                    }
                }
            });
        };

        function getSearchProduct(query) {
            const category = $('select[name="category"]').val();
            const availability = $('input[name="availability"]').is(':checked') ? 1 : 0;
            const lowStock = $('input[name="lowStock"]').is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('product.search') }}',
                type: 'GET',
                data: {
                    search: query,
                    category: category,
                    availability: availability,
                    lowStock: lowStock
                },
                success: function (data) {
                    $('#product-list').html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    console.error("Status: ", status);
                    console.error("Response: ", xhr.responseText);
                }
            });
        };

        $('select[name="category"], input[name="availability"], input[name="lowStock"]').change(function () {
            getSearchProduct($('#productsearch-input').val());
        });
    </script>

    <!-- / Content-->
</x-app-layout>