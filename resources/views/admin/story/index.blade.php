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
                                    <h5 class="card-title m-0">{!! __('admin.Success Story') !!}</h5>
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

                                    <form action="{{ route('story.update', 1) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3 g-3">


                                            {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Title_ar') !!}</label>


                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $story->title_ar }}"
                                                    placeholder="{!! __('admin.Title_ar1') !!}" name="title_ar"
                                                    aria-label="Product title">

                                                @error('title_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $story->title_en }}"
                                                    placeholder="{!! __('admin.Title_en1') !!}" name="title_en"
                                                    aria-label="Product title">



                                                @error('title_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}


                                            {{-- --------------------------------------------------------------  description_ar-------------------------------------------------------------------- --}}
                                            <div>
                                                <label class="form-label">{!! __('admin.Description_ar') !!}</label>


                                                <textarea id="textarea" class=" form-control" name="description_ar" placeholder="اكتب هنا ">{{ $story->description_ar }}</textarea>




                                                @error('description_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end description_ar-------------------------------------------------------------------- --}}

                                            {{-- --------------------------------------------------------------  description_en-------------------------------------------------------------------- --}}
                                            <div>
                                                <br>
                                                <label class="form-label">{!! __('admin.Description_en') !!}</label>

                                                <textarea id="textarea" class=" form-control" name="description_en" placeholder="اكتب هنا ">{{ $story->description_en }}</textarea>


                                                @error('description_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end description_en-------------------------------------------------------------------- --}}


                                            {{-- -------------------------------------------------------------- video-------------------------------------------------------------------- --}}
                                            {{-- <br>
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Video') !!}</label>
                                                <input type="url" class="form-control" required
                                                    id="ecommerce-story-name" value="{{ $story->video }}"
                                                    placeholder="{!! __('admin.Url Video') !!}" name="video"
                                                    aria-label="video ">




                                                @error('video')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div> --}}

                                            {{-- --------------------------------------------------------------end video-------------------------------------------------------------------- --}}


                                            {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}



                                            {{--
                                            <div>
                                                <br>
                                                <label class="form-label">{!! __('admin.Photo') !!} </label>
                                                <input type="file" multiple name="photo" onchange="readURL(this);"
                                                    value="{{ $story->photo }}" class="file form-control">

                                                @error('photo')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    <br>
                                                @enderror


                                                <br>
                                                <div class="row last">
                                                    <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                        <a target="_blank"
                                                            href="{{ asset('images') }}/{{ $story->photo }}">
                                                            <img id="blah"
                                                                style="width: 100%;height: 100%;padding: 5px;"
                                                                src="{{ asset('images') }}/{{ $story->photo }}"
                                                                alt="your image" /></a>
                                                    </div>



                                                </div> --}}



                                            {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}
















                                        </div>
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
        </div>
    </div>
    <!-- /Content wrapper -->






@endsection

@section('footer')

    <!-- Page JS -->
    <script src="{{ asset('admin') }}/js/app-ecommerce-settings.js"></script>

@endsection
