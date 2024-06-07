<x-app-layout>

    <!-- Content-->
    <section class="container-fluid">

        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">User Listing</h6>
            </div>
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="search-form"
                            class="bg-light rounded px-3 py-1 flex-shrink-0 d-flex align-items-center"
                            action="{{ route('profile.users') }}" method="get">
                            <input id="search-input"
                                class="form-control border-0 bg-transparent px-0 py-2 me-5 fw-bolder" type="search"
                                name="search" placeholder="Search" aria-label="Search"
                                onkeyup="getSearchUser(this.value)">
                            <button class="btn btn-link p-0 text-muted" type="submit"><i
                                    class="ri-search-2-line"></i></button>

                            <!-- Filter trigger -->
                            <div class="dropdown px-3">
                                <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                    type="button" id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-bar-chart-horizontal-line"></i>
                                </button>
                                <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                    <li class="">
                                        <select class="form-control me-2" name="state">
                                            <option value="">Select State</option>
                                            @foreach(['Johor', 'Kedah', 'Kelantan', 'Malacca', 'Negeri Sembilan', 'Pahang', 'Penang', 'Perak', 'Perlis', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya'] as $state)
                                                <option value="{{ $state }}" @if(request('state') == $state) selected @endif>
                                                    {{ $state }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li class="">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                name="admin" value="1" @if(request('admin')) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                    </div>
                    </form>
                    <!-- Filter -->
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('register') }}"><i
                                class="ri-add-circle-line align-bottom"></i> Add User</a>
                    </div>
                </div>
                <!-- User listing Actions-->

                <!-- User Listing Table-->
                <div class="table-responsive">
                    <table class="table m-0 table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>State</th>
                                <th>Joined</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="user-list">
                            @forelse ($users as $user => $val)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <button
                                                class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($val->name, 0, 1)) }}</button>
                                            <div>
                                                <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                                                    <span>{{ ucwords(trans($val->name)) }}</span>
                                                </p>
                                                <span class="d-block text-muted">{{ $val->email }}</span>
                                                <span class="d-block text-muted">{{ $val->phone }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($val->is_admin === 1)
                                        <td>Administrator</td>
                                    @else
                                        <td>User</td>
                                    @endif
                                    <td class="text-muted"><i class="ri-map-pin-line align-bottom"></i>
                                        @if ($val->state === null)
                                            Not Defined
                                        @else
                                            {{ $val->state }}
                                        @endif
                                    </td>
                                    <td class="text-muted">@if ($val->created_at === null)
                                        Not Defined
                                    @else
                                        {{ $val->created_at }}
                                    @endif
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
                                                        href="{{ route('profile.show', $val->id) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-white">No users in database</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /User Listing Table-->

                <nav>
                    <ul class="pagination justify-content-end mt-3 mb-0">
                        {!! $users->links('vendor.pagination.pagination') !!}
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

        function getSearchUser(query) {
            const state = $('select[name="state"]').val();
            const isAdmin = $('input[name="admin"]').is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('users.search') }}',
                type: 'GET',
                data: {
                    search: query,
                    state: state,
                    admin: isAdmin
                },
                success: function (data) {
                    $('#user-list').html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    console.error("Status: ", status);
                    console.error("Response: ", xhr.responseText);
                }
            });
        }

        $('select[name="state"], input[name="admin"]').change(function () {
            getSearchUser($('#search-input').val());
        });
    </script>
</x-app-layout>