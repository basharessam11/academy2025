@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">



            <div class="row g-4">

                <!-- Options -->
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <!-- Store Details Tab -->
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Edit Employees') !!}</h5>
                                </div>
                                <div class="card-body">
                                    {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                                    @if (session('success'))
                                        <div id="success-message"
                                            class="alert alert-success alert-dismissible fade show text-center"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div id="danger-message"
                                            class="alert alert-danger alert-dismissible fade show text-center"
                                            role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif



                                    @if ($errors->any())
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

                                    <form action="{{ route('employees.update', $id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3 g-3">
                                            <!-- Name -->
                                            {{-- -------------------------------------------------------------- name_ar-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Name_ar') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $employees->name_ar }}"
                                                    placeholder=" {!! __('admin.Name_ar1') !!}" name="name_ar"
                                                    aria-label="Product name">




                                                @error('name_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end name_ar-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- name_en-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Name_en') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $employees->name_en }}"
                                                    placeholder=" {!! __('admin.Name_en1') !!}" name="name_en"
                                                    aria-label="Product name">




                                                @error('name_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end name_en-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- meta_description_ar-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name"
                                                    value="{{ $employees->meta_description_ar }}"
                                                    placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="meta_description_ar"
                                                    aria-label="Product title">

                                                @error('meta_description_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end meta_description_ar-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- Meta_Description_en-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name"
                                                    value="{{ $employees->meta_description_en }}"
                                                    placeholder="{!! __('admin.Meta_Description_en1') !!}" name="meta_description_en"
                                                    aria-label="Product title">



                                                @error('meta_description_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end Meta_Description_en-------------------------------------------------------------------- --}}


                                            {{-- -------------------------------------------------------------- phone-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Phone') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $employees->phone }}"
                                                    placeholder=" {!! __('admin.Phone') !!}" name="phone"
                                                    aria-label="Product name">




                                                @error('phone')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end phone-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- Country-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Country') !!}</label>
                                                <select id="mySelect" name="country_id" class="select2 form-select"
                                                    data-placeholder="Select Country">
                                                    <option value="" disabled selected>Select Country</option>
                                                    @foreach ($country as $country)
                                                        <option
                                                            @if ($country->id == $employees->country_id) {{ 'selected' }} @endif
                                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>




                                                @error('country')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end Country-------------------------------------------------------------------- --}}






                                            <!-- Email -->
                                            <div class="col-12 col-md-6">
                                                <label class="form-label mb-0"
                                                    for="email">{!! __('admin.Email') !!}</label>
                                                <input type="email" class="form-control" id="email"
                                                    value="{{ $employees->email }}" placeholder="johndoe@gmail.com"
                                                    name="email" aria-label="Email">
                                            </div>



                                            <!-- Password -->
                                            <div class="col-12 col-md-6">
                                                <label class="form-label mb-0"
                                                    for="password">{!! __('admin.Password') !!}</label>
                                                <input type="text" class="form-control" id="password" name="password"
                                                    placeholder="Enter a new password" aria-label="Password">
                                            </div>



                                            <!-- Photo -->
                                            <div class="col-12 col-md-12">
                                                <label class="form-label mb-0"
                                                    for="photo">{!! __('admin.Photo') !!}</label>
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    aria-label="Photo">
                                                <br>
                                                <img style="width: 120px;height:auto"
                                                    src="{{ asset('images') }}/{{ $employees->photo != null ? $employees->photo : 'no-image.png' }}"
                                                    alt="">
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="submit"
                                                class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Options -->

            </div>
        </div>
    </div>
    <!-- /Content wrapper -->






@endsection

@section('footer')

    <!-- Page JS -->
    <script src="{{ asset('admin') }}/js/app-ecommerce-settings.js"></script>

@endsection
