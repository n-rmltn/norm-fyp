<aside class="aside bg-white">

    <div class="simplebar-wrapper">
        <div data-pixr-simplebar>
            <div class="pb-6">
                <!-- Mobile Logo-->
                <div class="d-flex d-xl-none justify-content-between align-items-center border-bottom aside-header">
                    <a class="navbar-brand lh-1 border-0 m-0 d-flex align-items-center" href="./index.html">
                        <div class="d-flex align-items-center">
                            <svg class="f-w-5 me-2 text-primary d-flex align-self-center lh-1"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 203.58 182">
                                <path
                                    d="M101.66,41.34C94.54,58.53,88.89,72.13,84,83.78A21.2,21.2,0,0,1,69.76,96.41,94.86,94.86,0,0,0,26.61,122.3L81.12,0h41.6l55.07,123.15c-12-12.59-26.38-21.88-44.25-26.81a21.22,21.22,0,0,1-14.35-12.69c-4.71-11.35-10.3-24.86-17.53-42.31Z"
                                    fill="currentColor" fill-rule="evenodd" fill-opacity="0.5" />
                                <path
                                    d="M0,182H29.76a21.3,21.3,0,0,0,18.56-10.33,63.27,63.27,0,0,1,106.94,0A21.3,21.3,0,0,0,173.82,182h29.76c-22.66-50.84-49.5-80.34-101.79-80.34S22.66,131.16,0,182Z"
                                    fill="currentColor" fill-rule="evenodd" />
                            </svg>
                            <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">App</span>
                        </div>
                    </a>
                    <i
                        class="ri-close-circle-line ri-lg close-menu text-muted transition-all text-primary-hover me-4 cursor-pointer"></i>
                </div>
                <!-- / Mobile Logo-->

                <ul class="list-unstyled mb-6">

                    <!-- Dashboard Menu Section-->
                    <li class="menu-section mt-2">Menu</li>
                    <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                    <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                    <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                    <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                    </rect>
                                    <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </span>
                            <span class="menu-link">
                                Dashboard
                            </span></a></li>
                    <!-- / Dashboard Menu Section-->

                    <!-- Pages Menu Section-->
                    <li class="menu-section mt-4">Products</li>
                    <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                            data-bs-toggle="collapse" data-bs-target="#collapseMenuItemPages" aria-expanded="false"
                            aria-controls="collapseMenuItemPages">
                            <span class="menu-icon">
                                <svg enable-background="new 0 0 520 520" viewBox="0 0 520 520"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path fill="currentColor"
                                            d="m481.734 100.063h-158.331l-43.111-70.397c-2.727-4.452-7.571-7.166-12.792-7.166h-119.235c-21.099 0-38.265 17.166-38.265 38.266v65.51 229.184c0 21.1 17.166 38.266 38.265 38.266h261.735 71.734c21.1 0 38.266-17.166 38.266-38.266v-217.13c0-21.101-17.166-38.267-38.266-38.267z" />
                                        <path fill="currentColor" opacity=".5"
                                            d="m80 355.459v-229.184h-41.734c-21.1 0-38.266 17.166-38.266 38.266v294.693c0 21.1 17.166 38.266 38.266 38.266h333.469c21.1 0 38.266-17.166 38.266-38.266v-35.51h-261.736c-37.641.001-68.265-30.623-68.265-68.265z" />
                                    </g>
                                </svg>
                            </span>
                            <span class="menu-link">Products</span></a>
                        <div class="collapse" id="collapseMenuItemPages">
                            <ul class="submenu">
                                <li><a href="{{ route('product') }}">Product List</a></li>
                                <li><a href="{{ route('orders') }}">Orders</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- / Pages Menu Section-->
                    @if(Auth::user()->is_admin)
                        <!-- Users Menu Section-->
                        <li class="menu-section mt-4">User Management</li>
                        <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                data-bs-toggle="collapse" data-bs-target="#collapseMenuItemUsers" aria-expanded="false"
                                aria-controls="collapseMenuItemUsers">
                                <span class="menu-icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                        style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <path fill="currentColor" opacity=".5" d="M155.327,57.142c-51.531,0-93.454,44.45-93.454,99.086c0,54.636,41.923,99.086,93.454,99.086s93.455-44.45,93.455-99.086
                                               C248.782,101.592,206.859,57.142,155.327,57.142z" />

                                        <path fill="currentColor" d="M367.798,71.321c-0.211,0-0.425,0.001-0.636,0.002c-21.626,0.179-41.826,9.31-56.878,25.713
                                               c-14.788,16.113-22.829,37.37-22.644,59.854c0.186,22.484,8.577,43.605,23.628,59.473c15.17,15.991,35.265,24.773,56.651,24.773
                                               c0.215,0,0.43-0.001,0.646-0.002c21.626-0.179,41.826-9.311,56.878-25.713c14.788-16.113,22.829-37.37,22.644-59.855
                                               C447.702,108.972,411.747,71.321,367.798,71.321z" />

                                        <path fill="currentColor"
                                            d="M371.74,257.358h-7.76c-36.14,0-69.12,13.74-94.02,36.26c6.23,4.78,12.16,9.99,17.78,15.61
                                               c16.58,16.58,29.6,35.9,38.7,57.42c8.2,19.38,12.88,39.8,13.97,60.83H512v-29.87C512,320.278,449.08,257.358,371.74,257.358z" />

                                        <path fill="currentColor" opacity=".5"
                                            d="M310.35,427.478c-2.83-45.59-25.94-85.69-60.43-111.39c-25.09-18.7-56.21-29.77-89.92-29.77h-9.34
                                               C67.45,286.319,0,353.768,0,436.978v17.88h310.65v-17.88C310.65,433.788,310.55,430.618,310.35,427.478z" />

                                    </svg>
                                </span>
                                <span class="menu-link">Users</span></a>
                            <div class="collapse" id="collapseMenuItemUsers">
                                <ul class="submenu">
                                    <li><a href="{{ route('profile.users') }}">User Listing</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- / Users Menu Section-->
                        <!-- Database Menu Section -->
                        <li class="menu-section mt-4">Data Management</li>
                        <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                data-bs-toggle="collapse" data-bs-target="#collapseMenuItemUI" aria-expanded="false"
                                aria-controls="collapseMenuItemUI">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
                                        <path opacity="0.5"
                                            d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
                                        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
                                    </svg>
                                </span>
                                <span class="menu-link">Admin</span></a>
                            <div class="collapse" id="collapseMenuItemUI">
                                <ul class="submenu">
                                    <li><a href="{{ route('product.brands') }}">Brands</a></li>
                                    <li><a href="{{ route('product.category') }}">Categories</a></li>
                                    <li><a href="{{ route('product.spec') }}">Specs</a></li>
                                    <li><a href="{{ route('product.compatibility') }}">Compatibility</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- / Database Menu Section -->
                    @endif
                </ul>
            </div>
        </div>
    </div>

</aside>