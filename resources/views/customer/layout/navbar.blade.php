<!-- Navbar -->




<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">











    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>


    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">




        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">

                    <span class="d-none d-md-inline-block text-muted">{!! Auth::guard('customer')->user()->name !!} </span>
                </a>
            </div>
        </div>
        <!-- /Search -->





        <ul class="navbar-nav flex-row align-items-center ms-auto">




            <!-- Language -->
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class='bx bx-globe bx-sm'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    @if (App::isLocale('en'))
                        <li>
                            <a class="dropdown-item" href="{{ route('language', 'ar') }}" data-language="ar"
                                data-text-direction="rtl">
                                <span class="align-middle">{!! __('admin.Arabic') !!}</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item" href="{{ route('language', 'en') }}" data-language="en"
                                data-text-direction="ltr">
                                <span class="align-middle">{!! __('admin.English') !!}</span>
                            </a>
                        </li>
                    @endif





                </ul>
            </li>
            <!-- /Language -->




            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class='bx bx-sm'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class='bx bx-sun me-2'></i>{!! __('admin.Light') !!} </span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="bx bx-moon me-2"></i>{!! __('admin.Dark') !!}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="bx bx-desktop me-2"></i>{!! __('admin.System') !!}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Style Switcher-->




        </ul>
    </div>


    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0"
            placeholder="{!! __('admin.Search...') !!}" aria-label="{!! __('admin.Search...') !!}">
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>


</nav>



<!-- / Navbar -->
