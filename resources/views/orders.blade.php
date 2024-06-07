<x-app-layout>

    <!-- Content-->
    <section class="container-fluid">

        <!-- Middle Row Widgets-->
        <div class="row g-4 mb-4 mt-0">

            <!-- Latest Orders-->
            <div class="col-12">
                <div class="card mb-4 h-100">
                    <div class="card-header justify-content-between align-items-center d-flex">
                        <h6 class="card-title m-0">Orders</h6>
                    </div>
                    <div class="card-body">
                        <!-- User listing Actions-->

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <form class="bg-light rounded px-3 py-1 flex-shrink-0 d-flex align-items-center">
                                    <input class="form-control border-0 bg-transparent px-0 py-2 me-5 fw-bolder"
                                        id="ordersearch-input" type="search" placeholder="Search" aria-label="Search"
                                        onkeyup="getSearchOrder(this.value)">
                                    <button class="btn btn-link p-0 text-muted" type="submit"><i
                                            class="ri-search-2-line"></i></button>
                                    <div class="dropdown px-3">
                                        <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                            type="button" id="dropdownOrder-0" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ri-bar-chart-horizontal-line"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                            <li>
                                                <select class="form-control me-2" name="status">
                                                    <option value="">Status</option>
                                                    @foreach(['Pending', 'Accepted', 'Rejected', 'Cancelled'] as $status)
                                                        <option value="{{ $status }}" @if(request('status') == $status)
                                                        selected @endif>
                                                            {{ $status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- User listing Actions-->
                        <div class="table-responsive">
                            <table class="table m-0 table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Placed On</th>
                                        <th>Placed By</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="order-list">
                                    @forelse ($order as $o)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-start">
                                                    @if ($o->product->product_cart_image_name !== null)
                                                        <div class="avatar avatar-xs me-3 flex-shrink-0">
                                                            <picture>
                                                                <img class="f-w-10 rounded-circle"
                                                                    src="{{ asset('/assets/images/product/' . $o->product->product_cart_image_name) }}"
                                                                    alt="Product Image">
                                                            </picture>
                                                        </div>
                                                    @else
                                                        <button
                                                            class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($o->product->product_name, 0, 1)) }}</button>
                                                    @endif
                                                    <div>
                                                        <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                                                            {{ $o->product->product_name }}
                                                        </p>
                                                        <span
                                                            class="d-block text-muted">{{ $o->product->brand->product_brand_name }}</span>
                                                        @if ($o->product->product_spec_id !== null)
                                                            <span
                                                                class="d-block text-muted">{{ $o->product->spec->product_spec_name }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted">
                                                {{ $o->created_at }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $o->user->name }}
                                            </td>
                                            <td class="text-muted">{{ $o->order_quantity }}</td>
                                            <td class="text-muted">{{ $o->order_status }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                        type="button" id="dropdownOrder-0" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                                        @if (Auth::user()->id == $o->users_id && $o->order_status === 'Pending')
                                                            <li>
                                                                <form action="{{ route('orders.cancel', $o->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">Cancel
                                                                        Order</button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if (Auth::user()->is_admin && $o->order_status === 'Pending' && $o->order_status !== 'Cancelled')
                                                            <li>
                                                                <form action="{{ route('orders.accept', $o->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">Accept</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('orders.reject', $o->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">Reject</button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($o->order_status !== 'Pending' || $o->order_status === 'Cancelled')
                                                            <li><span class="dropdown-item text-muted">No action
                                                                    available</span></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted">No orders found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination justify-content-end mt-3 mb-0">
                                {!! $order->links('vendor.pagination.pagination') !!}
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
        function getSearchOrder(query) {
            const status = $('select[name="status"]').val();

            $.ajax({
                url: '{{ route('orders.search') }}',
                type: 'GET',
                data: {
                    search: query,
                    status: status
                },
                success: function (data) {
                    $('#order-list').html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    console.error("Status: ", status);
                    console.error("Response: ", xhr.responseText);
                }
            });
        };

        $('select[name="status"]').change(function () {
            getSearchOrder($('#ordersearch-input').val());
        });
    </script>
    <!-- / Content-->
</x-app-layout>