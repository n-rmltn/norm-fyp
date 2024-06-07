<x-app-layout>

    <!-- Content-->
    <section class="container-fluid">

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">Product Compatibility</h6>
            </div>
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="search-form"
                            class="bg-light rounded px-3 py-1 flex-shrink-0 d-flex align-items-center"
                            action="javascript:void(0);" method="get">
                            <input id="compatibilitysearch-input"
                                class="form-control border-0 bg-transparent px-0 py-2 me-5 fw-bolder" type="search"
                                name="search" placeholder="Search" aria-label="Search"
                                onkeyup="getSearchComp(this.value)">
                            <button class="btn btn-link p-0 text-muted" type="submit"><i
                                    class="ri-search-2-line"></i></button>
                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('compatibility.create') }}"><i
                                class="ri-add-circle-line align-bottom"></i> Add Compatibility</a>
                    </div>
                </div>

                <!-- Brand Listing Table-->
                <div class="table-responsive">
                    <table class="table m-0 table-striped">
                        <thead>
                            <tr>
                                <th>Motherboard</th>
                                <th>CPU</th>
                                <th>RAM</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="compatibility-list">
                            @forelse ($compatibility as $comp => $val)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <div>
                                                <p class="text-muted fw-bolder mb-1 d-flex align-items-center lh-1">
                                                    <span>{{ ucwords(trans($val->motherboardSpec->product_spec_name)) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <div>
                                                <p class="text-muted fw-bolder mb-1 d-flex align-items-center lh-1">
                                                    <span>{{ ucwords(trans($val->cpuSpec->product_spec_name)) }}</span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <div>
                                                <p class="text-muted fw-bolder mb-1 d-flex align-items-center lh-1">
                                                    <span>{{ ucwords(trans($val->ramSpec->product_spec_name)) }}</span></p>
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
                                                        href="{{ route('compatibility.show', $val->id) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-white">No compatibility in database</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /Brands Listing Table-->

                <nav>
                    <ul class="pagination justify-content-end mt-3 mb-0">
                        {!! $compatibility->links('vendor.pagination.pagination') !!}
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

        function getSearchComp(query) {
            $.ajax({
                url: '{{ route('compatibility.search') }}',
                type: 'GET',
                data: { search: query },
                success: function (data) {
                    $('#compatibility-list').html(data);
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