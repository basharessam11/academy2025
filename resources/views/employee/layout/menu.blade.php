<!-- Menu -->
@php
    use App\Models\Setting;
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






        <!-- Products end -->
        {{-- <li class="menu-item   ">
            <a href="{{ route('booking2.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-calendar'></i>

                <div class="text-truncate"> {!! __('admin.Bookings') !!}</div>
            </a>
        </li>
        <li class="menu-item   ">
            <a href="{{ route('meeting2.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-video'></i>

                <div class="text-truncate">{!! __('admin.Meetings') !!}</div>
            </a>
        </li> --}}




        {{-- ############################## Bookings ################################# --}}

        <li class="menu-item   {{ Request::route()->getName() == 'booking2.index' ? 'active' : '' }}">
            <a href="{{ route('booking2.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-calendar'></i>


                <div class="text-truncate">{!! __('admin.Bookings') !!}</div>
            </a>
        </li>

        {{-- ############################## End Bookings ################################# --}}






        {{-- ############################## Customers & Groups Dropdown ################################# --}}


        <li class="menu-item  {{ Request::route()->getName() == 'customer1.index' ? 'active' : '' }} ">
            <a href="{{ route('customer1.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-user'></i>


                <div class="text-truncate"> {!! __('admin.Customers') !!}</div>
            </a>
        </li>


        <li class="menu-item  {{ Request::route()->getName() == 'group1.index' ? 'active' : '' }} ">
            <a href="{{ route('group1.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-group'></i>


                <div class="text-truncate"> {!! __('admin.Groups') !!}</div>
            </a>
        </li>





        {{-- ############################## End Customers & Groups Dropdown ################################# --}}




        <!-- Order end -->
        <li class="menu-item  {{ Request::route()->getName() == 'user2.index' ? 'active open' : '' }} ">
            <a href="{{ route('user2.index') }}" class="menu-link">

                <i class="bx bx-user me-1"></i>

                <div class="text-truncate">{!! __('admin.Account') !!}</div>
            </a>
        </li>




        <!-- Order start -->
        <!-- Logout start -->

        <li class="menu-item   ">
            <a href="{{ route('user2.logout') }}" class="menu-link">

                <i class="bx bx-power-off me-2"></i>

                <div class="text-truncate">{!! __('admin.Logout') !!}</div>
            </a>
        </li>


        <!-- Logout end -->




    </ul>
    </li>
    <!-- Products end -->




    </ul>



</aside>
<!-- / Menu -->
