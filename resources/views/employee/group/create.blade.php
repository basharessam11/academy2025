@extends('employee.layout.app')

@section('page', 'Create Product')


@section('contant')








    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}




    {{-- @dd($errors) --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <form action="{{ route('group1.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">

                    <!-- Add Product -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">




                    </div>

                    <div class="row">

                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- Product Information -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Group') !!}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                        <div class="col-md-6">
                                            <label class="form-label">{!! __('admin.Title') !!} </label>
                                            <input type="text" class="form-control" required id="ecommerce-product-name"
                                                value="{{ old('title') }}" placeholder="{!! __('admin.Title') !!}"
                                                name="title" aria-label="Product title">




                                            @error('title')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>
                                        <div class="col-md-6">

                                            <label class="form-label">{!! __('admin.User') !!}</label>

                                            <select name="user_id" class="form-select select2" required>
                                                <option value="" disabled selected>اختر</option>

                                                @foreach ($users as $user)
                                                    {{-- @dd($user->group) --}}
                                                    <option selected value="{{ $user->id }}">
                                                        {{ $user->name_ar . ' / ' . $user->phone }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}



                                        {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}

                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                </div>





                            </div>


            </form>
        </div>



        <!-- /Organize Card -->
    </div>
    <!-- /Second column -->
    </div>
    </div>
    </div>
    <!-- / Content -->



    </form>












@endsection

@section('footer')
    <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


@endsection
