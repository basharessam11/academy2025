@extends('admin.layout.app')

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
            <form action="{{ route('exam.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="app-ecommerce">

                    <!-- Add Question -->
                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- Question Card -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Exam') !!}</h5>
                                </div>
                                <div class="card-body">
                                    {{-- Description (Arabic) --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title') !!} </label>

                                        <input type="text" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('title') }}" placeholder="{!! __('admin.Title') !!}" name="title"
                                            aria-label="Product title">
                                        @error('title')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>







                                    {{-- Submit Button --}}
                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>

                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- app-ecommerce -->
            </form>
        </div>













    @endsection

    @section('footer')
        <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


    @endsection
