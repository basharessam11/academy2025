@extends('admin.layout.app')

@section('page', 'Create courses')


@section('contant')








    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




    {{-- @dd($errors) --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <form action="{{ route('meeting.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">

                    <!-- Add courses -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">




                    </div>

                    <div class="row">

                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- courses Information -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Meeting') !!}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-6">

                                        {{-- -------------------------------------------------------------- topic-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 ">
                                            <label class="form-label">{!! __('admin.Meeting Name') !!} </label>
                                            <input type="text" class="form-control" required id="ecommerce-courses-name"
                                                value="{{ old('topic') }}" placeholder=" {!! __('admin.Meeting Name') !!}"
                                                name="topic" aria-label="courses title">




                                            @error('topic')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end topic-------------------------------------------------------------------- --}}

                                        {{-- -------------------------------------------------------------- date and time-------------------------------------------------------------------- --}}
                                        <div class=" col-md-6">
                                            <br>

                                            <label class="form-label">{!! __('admin.Date And Time') !!}</label>
                                            <input type="datetime-local" class="form-control" required
                                                id="ecommerce-courses-name" value="{{ old('date and time') }}"
                                                placeholder="Date and Time" name="start_at" aria-label="Date and Time">





                                            @error('date and time')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end date and time-------------------------------------------------------------------- --}}
                                        {{-- -------------------------------------------------------------- duration-------------------------------------------------------------------- --}}
                                        <div class=" col-md-6 ">
                                            <br>

                                            <label class="form-label">{!! __('admin.Duration') !!} </label>
                                            <input type="text" class="form-control" required id="ecommerce-courses-name"
                                                value="{{ old('duration') }}" placeholder=" {!! __('admin.Duration') !!}"
                                                name="duration" aria-label="courses title">




                                            @error('duration')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end duration-------------------------------------------------------------------- --}}

                                        <div class=" col-md-6">
                                            <br>
                                            <br>
                                
                                            <button type="submit" class="btn btn-primary"
                                                >{!! __('admin.Submit') !!}</button>

                                        </div>



                                    </div>
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


@endsection
