@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')

    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->


        {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


        @if (session('success'))
            <br>
            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif



        @if ($errors->any())
            <br>

            <div class="alert alert-danger">
                <ul>
                    {{-- @dd($errors) --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}
        <div class="container-xxl flex-grow-1 container-p-y">




            <div
                class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-4 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1">
                        {{ __('admin.Customer ID') }} #{{ $customer->id }}
                    </h4>
                    <p class="mb-0">
                        {{ $date }}
                    </p>
                </div>
                {{-- <button type="button" class="btn btn-label-danger delete-customer">Delete Customer</button> --}}
            </div>


            <div class="row">
                <!-- Customer-detail Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- Customer-detail Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="customer-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2 rounded-circle bg-label-primary text-white d-flex justify-content-center align-items-center"
                                            style="height: 110px; width: 110px; overflow: hidden;">
                                            <img class="img-fluid"
                                                src="{{ $customer->photo ? asset('images/' . $customer->photo) : asset('images/user.png') }}"
                                                style="height: 100%; width: 100%; object-fit: cover; border-radius: 50%;"
                                                alt="User avatar">
                                        </div>
                                    </div>
                                    <div class="customer-info text-center">
                                        <h4 class="m-2">{{ $customer->name }}</h4>
                                        <small>{{ __('admin.Customer ID') }} #{{ $customer->id }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="d-flex justify-content-around flex-wrap mt-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i
                                                class='bx bxs-book-alt bx-sm'></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $count }}</h5>
                                        <span>{{ __('admin.Orders') }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i
                                                class='bx bx-dollar bx-sm'></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">${{ $total }}</h5>
                                        <span>{{ __('admin.Total') }} </span>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="d-flex justify-content-around flex-wrap mt-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i
                                                class='bx bxs-calendar-alt bx-sm '></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $count1 }}</h5>
                                        <span>{{ __('admin.Bookings') }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial rounded bg-label-primary"><i
                                                class='bx bx-dollar bx-sm'></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">EGP {{ $total1 }}</h5>
                                        <span>{{ __('admin.Total') }} </span>
                                    </div>
                                </div>
                            </div>

                            <div class="info-container">
                                <small
                                    class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">{{ __('admin.DETAILS') }}</small>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">{{ __('admin.Username:') }}</span>
                                        <span>{{ $customer->name }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">{{ __('admin.Type:') }}</span>
                                        <span>
                                            @if ($customer->user_type == 1)
                                                {{ __('admin.Male') }}
                                            @else
                                                {{ __('admin.Female') }}
                                            @endif
                                        </span>
                                    </li>

                                    <li class="mb-3">
                                        <span class="fw-medium me-2">{{ __('admin.Status:') }}</span>
                                        @if ($customer->status == 1)
                                            <span class="badge bg-label-success">{{ __('admin.Active') }}</span>
                                        @elseif ($customer->status == 2)
                                            <span class="badge bg-label-danger">{{ __('admin.Disactive') }}</span>
                                        @endif

                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">{{ __('admin.Contact:') }}</span>
                                        <span>{{ $customer->phone }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">{{ __('admin.Email') }}:</span>
                                        <span>{{ $customer->email }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">{{ __('admin.Country:') }}</span>
                                        <span>{{ $customer->country->name }}</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                        data-bs-toggle="modal">{{ __('admin.Edit Details') }}</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Customer-detail Card -->

                </div>
                <!--/ Customer Sidebar -->


                <!-- Customer Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Customer Pills -->
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">


                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('customer.show') ? 'active' : '' }}"
                                href="{{ route('customer.show', $customer->id) }}">
                                <i class="bx bx-user me-1"></i>{{ __('admin.Overview') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('customer.show2') ? 'active' : '' }}"
                                href="{{ route('customer.show2', $customer->id) }}">
                                <i class="bx bx-lock-alt me-1"></i>{{ __('admin.Security') }}
                            </a>
                        </li>


                    </ul>
                    <!--/ Customer Pills -->








                    @yield('contant1')


                </div>
                <!--/ Customer Content -->
            </div>


            {{-- ######################################################  Modal ######################################################################## --}}



            <!-- Modal -->
            {{-- ######################################################  Edit User ######################################################################## --}}
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3>{{ __('admin.Edit User Information') }}</h3>

                            </div>
                            <form class="row g-3" action="{{ route('customer.update', $customer->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12 col-md-12">
                                    <label class="form-label" for="modalEditUserFirstName">{{ __('admin.Name') }}</label>
                                    <input type="text" id="modalEditUserFirstName" name="name"
                                        value="{{ $customer->name }}" class="form-control"
                                        placeholder="{{ __('admin.Name') }}" />
                                </div>





                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserPhone">{{ __('admin.Phone') }} </label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                        <input type="text" id="modalEditUserPhone" name="phone"
                                            class="form-control phone-number-mask" value="{{ $customer->phone }}"
                                            placeholder="202 555 0111">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label " for="modalEditUserStatus">{{ __('admin.Status') }}
                                    </label>
                                    <select name="status" required class="form-select statususer"
                                        aria-label="Default select example">
                                        <option value="">Status</option>
                                        <option value="1">{{ __('admin.Active') }}</option>
                                        <option value="2">{{ __('admin.Inactive') }} </option>
                                        {{-- <option value="3">{{ __('admin.Suspended') }} </option> --}}
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label "
                                        for="modalEditUserCountry">{{ __('admin.Country') }}</label>
                                    <select required name="country_id" class="select2 form-select countryuser"
                                        data-allow-clear="true">
                                        <option value="">{{ __('admin.Select') }}</option>
                                        @foreach ($country as $country1)
                                            <option @if ($customer->country_id == $country1->id) {{ 'selected' }} @endif
                                                value="{{ $country1->id }}">
                                                {{ $country1->name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserPhone">{{ __('admin.Email') }} </label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                        <input type="text" id="modalEditUserPhone" name="email"
                                            class="form-control phone-number-mask" value="{{ $customer->email }}"
                                            placeholder="email">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <label class="form-label">{!! __('admin.Photo') !!} </label>
                                    <input type="file" multiple name="photo" onchange="readURL(this);"
                                        value="{{ $customer->photo }}" class="file form-control">

                                    @error('photo')
                                        <br>
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        <br>
                                    @enderror


                                    <br>
                                    <div class="row last">
                                        <div class="col-md-3 mb-3 position-relative" data-index="0">
                                            <a target="_blank" href="{{ asset('images') }}/{{ $customer->photo }}">
                                                <img id="blah" style="width: 100%;height: 100%;padding: 5px;"
                                                    src="{{ asset('images') }}/{{ $customer->photo }}"
                                                    alt="your image" /></a>
                                        </div>



                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-3 me-1">{{ __('admin.Submit') }}</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">{{ __('admin.Close') }} </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Edit User Modal -->
            {{-- ###################################################### End Edit User ######################################################################## --}}





















            {{-- ###################################################### End Modal ######################################################################## --}}
        </div>
        <!-- / Content -->








    @endsection

    @section('footer')
        <script>
            $(document).ready(function() {
                $('.countryuser').val('{{ $customer->country->id }}');
                $('.statususer').val({{ $customer->status }});

            });
        </script>

        {{-- <script src="{{asset('admin')}}/js/modal-edit-user.js"></script>x --}}
        {{-- <script src="{{asset('admin')}}/js/modal-enable-otp.js"></script> --}}
        {{-- <script src="{{asset('admin')}}/js/app-ecommerce-customer-detail.js"></script> --}}
        {{-- <script src="{{asset('admin')}}/js/app-user-view-security.js"></script> --}}
    @endsection
