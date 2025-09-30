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
                                    <h5 class="card-title m-0">{!! __('admin.Color') !!}</h5>
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


                                    <form action="{{ route('color.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-6 col-md-6">
                                            <label class="form-label mb-0" for="color">{!! __('admin.color_header') !!}</label>
                                            <input style="height: 50px" type="color" class="form-control"
                                                value="{{ $color->color_header ?? '#000000' }}" placeholder="Select Color"
                                                name="color_header" aria-label="Select Color">
                                        </div>

                                        <br>

                                        <!-- Color Selection -->
                                        <div class="col-6 col-md-6">
                                            <label class="form-label mb-0" for="color">{!! __('admin.background_color') !!}</label>
                                            <input style="height: 50px" type="color" class="form-control"
                                                value="{{ $color->background_color ?? '#000000' }}"
                                                placeholder="Select Color" name="background_color"
                                                aria-label="Select Color">
                                        </div>

                                        <br>


                                        <!-- Color Selection -->
                                        <div class="col-6 col-md-6">
                                            <label class="form-label mb-0" for="color">{!! __('admin.color_h') !!}</label>
                                            <input style="height: 50px" type="color" class="form-control"
                                                value="{{ $color->color_h ?? '#000000' }}" placeholder="Select Color"
                                                name="color_h" aria-label="Select Color">
                                        </div>

                                        <br>
                                        <!-- Color Selection -->
                                        <div class="col-6 col-md-6">
                                            <label class="form-label mb-0" for="color">{!! __('admin.Text color') !!}</label>
                                            <input style="height: 50px" type="color" class="form-control"
                                                value="{{ $color->color ?? '#000000' }}" placeholder="Select Color"
                                                name="color" aria-label="Select Color">
                                        </div>

                                        <br>


                                        <!-- Submit Button -->
                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
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
