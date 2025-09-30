@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')




    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">





            <div class="row g-4">


                @include('admin.layout.menu-slider')
                <!-- Options -->
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <!-- Store Details Tab -->
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Page Banner') !!}</h5>
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


                                    <form action="{{ route('page.update', 1) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('post')



                                        <!-- Photo -->
                                        <div class="col-12 col-md-12">
                                            <label class="form-label mb-0" for="photo">{!! __('admin.Page Banner') !!}</label>
                                            <input type="file" class="form-control" id="photo" name="photo_about"
                                                aria-label="Store Photo"><br>
                                            <img style="width: 120px;height:auto"
                                                src="{{ asset('images') }}/{{ $settings->photo_about != null ? $settings->photo_about : 'no-image.png' }}"
                                                alt="">
                                        </div>
                                        <br>
                                        <!-- Photo -->
                                        <div class="col-12 col-md-12">
                                            <label class="form-label mb-0" for="photo">{!! __('admin.Photo Services') !!}</label>
                                            <input type="file" class="form-control" id="photo" name="photo_services"
                                                aria-label="Store Photo"><br>
                                            <img style="width: 120px;height:auto"
                                                src="{{ asset('images') }}/{{ $settings->photo_services != null ? $settings->photo_services : 'no-image.png' }}"
                                                alt="">
                                        </div>
                                        <br>
                                        <!-- Photo -->
                                        <div class="col-12 col-md-12">
                                            <label class="form-label mb-0" for="photo">{!! __('admin.Photo Products') !!}</label>
                                            <input type="file" class="form-control" id="photo" name="photo_products"
                                                aria-label="Store Photo"><br>
                                            <img style="width: 120px;height:auto"
                                                src="{{ asset('images') }}/{{ $settings->photo_products != null ? $settings->photo_products : 'no-image.png' }}"
                                                alt="">
                                        </div>
                                        <br>
                                        <!-- Photo -->
                                        <div class="col-12 col-md-12">
                                            <label class="form-label mb-0" for="photo">{!! __('admin.Photo FAQ') !!}</label>
                                            <input type="file" class="form-control" id="photo" name="photo_faq"
                                                aria-label="Store Photo"><br>
                                            <img style="width: 120px;height:auto"
                                                src="{{ asset('images') }}/{{ $settings->photo_faq != null ? $settings->photo_faq : 'no-image.png' }}"
                                                alt="">
                                        </div>

                                        <br>
                                        <!-- Photo -->
                                        <div class="col-12 col-md-12">
                                            <label class="form-label mb-0" for="photo">{!! __('admin.Photo Contact') !!}</label>
                                            <input type="file" class="form-control" id="photo" name="photo_contact"
                                                aria-label="Store Photo"><br>
                                            <img style="width: 120px;height:auto"
                                                src="{{ asset('images') }}/{{ $settings->photo_contact != null ? $settings->photo_contact : 'no-image.png' }}"
                                                alt="">
                                        </div>


                                        <br>


                                        <div class="d-flex justify-content-end gap-3">

                                            <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}
                                            </button>
                                        </div>
                                </div>

                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- /Options -->
        </div>





        @endsection

        @section('footer')

            <!-- Page JS -->
            <script src="{{ asset('admin') ?? '' }}/js/app-ecommerce-settings.js"></script>

        @endsection
