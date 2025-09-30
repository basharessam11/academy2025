<!-- Menu -->
@php
    use App\Models\Setting;

    $customer_id = Auth::guard('customer')->user()->id;

@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">

                <img style="width: 45px; height:auto"
                    src="{{ asset('images') }}/{{ Setting::find(1)->photo != null ? Setting::find(1)->photo : 'no-image.png' }}"
                    class="  ms-auto" alt="logo" width="30" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ Setting::find(1)->name }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">



        {{-- ################################################Bookings################################################################### --}}


        <!-- Products end -->
        <li class="menu-item   ">
            <a href="{{ route('booking1.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-calendar'></i>

                <div class="text-truncate"> {!! __('admin.Bookings') !!}</div>
            </a>
        </li>



        {{-- ################################################End Bookings################################################################### --}}




        {{-- ################################################exam################################################################### --}}


        {{-- @can('view teacher') --}}
        <li class="menu-item   {{ Request::route()->getName() == 'exam.index' ? 'active open' : '' }}">
            <a href="{{ route('exam1.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-calendar-check'></i>

                <div class="text-truncate">{!! __('admin.Exam') !!}</div>
            </a>
        </li>
        {{-- @endcan --}}
        {{-- ################################################End exam################################################################### --}}


        {{-- ################################################lectures################################################################### --}}


        {{-- @can('view teacher') --}}
        <li class="menu-item   {{ Request::route()->getName() == 'lectures.index' ? 'active open' : '' }}">
            <a href="{{ route('lecture1.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-calendar-check'></i>

                <div class="text-truncate">{!! __('admin.Lectures') !!}</div>
            </a>
        </li>
        {{-- @endcan --}}
        {{-- ################################################End lectures################################################################### --}}



        {{-- ################################################Settings################################################################### --}}
        <li class="menu-item  {{ Request::route()->getName() == 'customer1.index' ? 'active open' : '' }} ">
            <a href="{{ route('customer1.show2', $customer_id) }}" class="menu-link">

                <i class='menu-icon tf-icons bx bxs-cog'></i>
                <div class="text-truncate">{!! __('admin.Settings') !!}</div>
            </a>
        </li>

        {{-- ################################################End Settings################################################################### --}}



        {{-- ################################################Logout################################################################### --}}

        <li class="menu-item {{ Request::route()->getName() == 'customer.logout' ? 'active open' : '' }}">
            <a href="#" class="menu-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off me-2"></i>
                <div class="text-truncate">{!! __('admin.Logout') !!}</div>
            </a>
            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

        {{-- ################################################End Logout################################################################### --}}




    </ul>
    </li>
    <!-- Products end -->




    </ul>



</aside>
<!-- / Menu -->
