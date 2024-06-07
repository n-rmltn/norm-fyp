<x-app-layout>

    <!-- Content-->
    <section class="container-fluid">

        <!-- Page Title-->
        <h2 class="fs-3 fw-bold mb-2">Welcome back, {{ Auth::user()->name }} 👋</h2>
        <!-- / Page Title-->
        <!-- Top Row Widgets-->
        <!-- <div class="row g-4">
        <div class="col-12 col-sm-6 col-xxl-3">
            <div class="card h-100">
                <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                    <h6 class="card-title m-0 text-muted fs-xs text-uppercase fw-bolder tracking-wide">Total Sales</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-4 mb-3 mb-md-1">
                        <div class="col-12 col-md-6">
                            <p class="fs-3 fw-bold d-flex align-items-center"><span class="fs-9 me-1">RM</span> 567.99</p>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </div> -->
        <!-- / Top Row Widgets -->

        <!-- Middle Row Widgets-->
        <div class="row g-4 mb-4 mt-0">

            <!-- Latest Orders-->
            <div class="col-12">
                <div class="card mb-4 h-100">
                    <div class="card-header justify-content-between align-items-center d-flex">
                        <h6 class="card-title m-0">Low in stock</h6>
                    </div>
                    <div class="card-body">
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
                                                            <span
                                                                class="d-block text-muted">{{ $prod->spec->product_spec_name }}</span>
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
                                                    <span class="badge rounded-pill bg-danger-faded text-danger">Out of
                                                        stock</span>
                                                @elseif ($prod->product_availability === 1 && $prod->product_quantity > 0 && $prod->product_quantity <= 5)
                                                    <span class="badge rounded-pill bg-warning-faded text-warning">Low in
                                                        stock</span>
                                                @elseif ($prod->product_availability === 1 && $prod->product_quantity > 5)
                                                    <span
                                                        class="badge rounded-pill bg-success-faded text-success">Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="small text-muted">{{ $prod->product_quantity }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                        type="button" id="dropdownOrder-0" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                                        @if(Auth::user()->is_admin)
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('product.show', $prod->id) }}">Edit
                                                                    product</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('orders.create', $prod->id) }}">Request
                                                                more</a></li>
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
                        <nav>
                            <ul class="pagination justify-content-end mt-3 mb-0">
                                {!! $product->links('vendor.pagination.pagination') !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Latest Orders-->

        </div>
        <!-- / Middle Row Widgets-->

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
    </script>
    <!-- / Content-->
</x-app-layout>