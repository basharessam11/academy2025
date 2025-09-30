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
                                    <h5 class="card-title m-0">Zoom</h5>
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

                                    <form action="{{ route('meeting.update', 1) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3 g-3">
                                            <!-- ZOOM_CLIENT_KEY -->
                                            <div class="col-12 col-md-12">
                                                <label class="form-label mb-0" for="name"> CLIENT KEY</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ $zoom->ZOOM_CLIENT_KEY }}" placeholder="ZOOM_CLIENT_KEY"
                                                    name="ZOOM_CLIENT_KEY" aria-label="Name">
                                            </div>


                                            <!-- ZOOM_CLIENT_SECRET -->
                                            <div class="col-12 col-md-12">
                                                <label class="form-label mb-0" for="name"> CLIENT SECRET</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ $zoom->ZOOM_CLIENT_SECRET }}" placeholder="ZOOM CLIENT SECRET"
                                                    name="ZOOM_CLIENT_SECRET" aria-label="Name">
                                            </div>



                                            <!-- ZOOM_ACCOUNT_ID -->
                                            <div class="col-12 col-md-12">
                                                <label class="form-label mb-0" for="name"> ACCOUNT ID</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ $zoom->ZOOM_ACCOUNT_ID }}" placeholder="ZOOM_ACCOUNT_ID"
                                                    name="ZOOM_ACCOUNT_ID" aria-label="Name">
                                            </div>




                                        </div>

                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
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
