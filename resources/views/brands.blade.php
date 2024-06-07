<x-app-layout>

    <!-- Content-->
    <section class="container-fluid">

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">Product Brands</h6>
            </div>
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="search-form"
                            class="bg-light rounded px-3 py-1 flex-shrink-0 d-flex align-items-center"
                            action="javascript:void(0);" method="get">
                            <input id="brandsearch-input"
                                class="form-control border-0 bg-transparent px-0 py-2 me-5 fw-bolder" type="search"
                                name="search" placeholder="Search" aria-label="Search"
                                onkeyup="getSearchBrand(this.value)">
                            <button class="btn btn-link p-0 text-muted" type="submit"><i
                                    class="ri-search-2-line"></i></button>
                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('brands.create') }}"><i
                                class="ri-add-circle-line align-bottom"></i> Add Brands</a>
                    </div>
                </div>

                <!-- Brand Listing Table-->
                <div class="table-responsive">
                    <table class="table m-0 table-striped">
                        <thead>
                            <tr>
                                <th>Brands</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="brand-list">
                            @forelse ($brands as $brand => $val)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <button
                                                class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($val->product_brand_name, 0, 1)) }}</button>
                                            <div>
                                                <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                                                    <span>{{ ucwords(trans($val->product_brand_name)) }}</span></p>
                                            </div>
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
                                                <li><a class="dropdown-item"
                                                        href="{{ route('brands.show', $val->id) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-white">No brands in database</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /Brands Listing Table-->

                <nav>
                    <ul class="pagination justify-content-end mt-3 mb-0">
                        {!! $brands->links('vendor.pagination.pagination') !!}
                    </ul>
                </nav>

            </div>
        </div>


        @include('layouts.partials.footer')


        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->
        <!-- / Footer-->

    </section>
    <!-- / Content-->
    <script>
        function getSearchBrand(query) {
            $.ajax({
                url: '{{ route('brands.search') }}',
                type: 'GET',
                data: { search: query },
                success: function (data) {
                    $('#brand-list').html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    console.error("Status: ", status);
                    console.error("Response: ", xhr.responseText);
                }
            });
        }
    </script>

</x-app-layout>