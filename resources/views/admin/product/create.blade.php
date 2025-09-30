@extends('admin.layout.app')

@section('page', 'Create Product')


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



            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
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
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Product') !!}</h5>
                                </div>
                                <div class="card-body">

                                    {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                        <input type="text" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('title_ar') }}" placeholder=" {!! __('admin.Title_ar1') !!}"
                                            name="title_ar" aria-label="Product title">




                                        @error('title_ar')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                        <input type="text" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('title_en') }}" placeholder=" {!! __('admin.Title_en1') !!}"
                                            name="title_en" aria-label="Product title">




                                        @error('title_en')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}



                                    {{-- --------------------------------------------------------------  overview_ar-------------------------------------------------------------------- --}}
                                    <div>
                                        <label class="form-label">{!! __('admin.Overview_ar') !!}</label>


                                        <textarea id="textarea" class=" form-control" name="overview_ar" placeholder="اكتب هنا ">{{ old('overview_ar') }}</textarea>




                                        @error('overview_ar')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end overview_ar-------------------------------------------------------------------- --}}

                                    {{-- --------------------------------------------------------------  overview_en-------------------------------------------------------------------- --}}
                                    <div>
                                        <br>
                                        <label class="form-label">{!! __('admin.Overview_en') !!}</label>
                                        <textarea id="textarea" class=" form-control" name="overview_en" placeholder="اكتب هنا ">{{ old('overview_en') }}</textarea>



                                        @error('overview_en')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end overview_en-------------------------------------------------------------------- --}}
                                    <br>
                                    {{-- -------------------------------------------------------------- quantity-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Quantity') !!} </label>
                                        <input type="number" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('quantity') }}" placeholder="{!! __('admin.Quantity') !!}"
                                            name="quantity" aria-label="quantity">




                                        @error('quantity')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end quantity-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- price-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Price_ar') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">EGP</span>
                                            <input type="number" class="form-control" value="{{ old('price') }}"
                                                name="price" placeholder="{!! __('admin.Price_ar1') !!}"
                                                aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                        @error('price')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end price-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- Tax-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Tax_ar') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">EGP</span>
                                            <input type="number" class="form-control" value="{{ old('tax') }}"
                                                name="tax" placeholder="{!! __('admin.Tax_ar1') !!}"
                                                aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                        @error('tax')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end tax-------------------------------------------------------------------- --}}




                                    {{-- -------------------------------------------------------------- price-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Price_en') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" value="{{ old('price1') }}"
                                                name="price1" placeholder="{!! __('admin.Price_en1') !!}"
                                                aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                        @error('price1')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end price-------------------------------------------------------------------- --}}



                                    {{-- -------------------------------------------------------------- tax-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Tax_en') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" value="{{ old('tax1') }}"
                                                name="tax1" placeholder="{!! __('admin.Tax_en1') !!}"
                                                aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                        @error('tax1')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end tax-------------------------------------------------------------------- --}}




                                    {{-- --------------------------------------------------------------  description_ar-------------------------------------------------------------------- --}}
                                    <div>
                                        <label class="form-label">{!! __('admin.Description_ar') !!}</label>


                                        <textarea id="textarea" class=" form-control" name="description_ar" placeholder="اكتب هنا ">{{ old('description_ar') }}</textarea>




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

                                        <textarea id="textarea" class=" form-control" name="description_en" placeholder="اكتب هنا ">{{ old('description_en') }}</textarea>


                                        @error('description_en')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end description_en-------------------------------------------------------------------- --}}


                                    {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                    <div>
                                        <br>
                                        <label class="form-label">{!! __('admin.Photo') !!}</label>
                                        <input type="file" multiple name="photo" onchange="readURL(this);"
                                            value="{{ old('photo') }}" class="file form-control">

                                        @error('photo')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            <br>
                                        @enderror


                                        <br>
                                        <div class="row last">


                                        </div>


                                        {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}




                                        <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
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
    <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


@endsection
