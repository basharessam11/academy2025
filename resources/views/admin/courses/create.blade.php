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



            <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
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
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Online Sessions') !!}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-6">

                                        {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 ">
                                            <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                            <input type="text" class="form-control" required id="ecommerce-courses-name"
                                                value="{{ old('title_ar') }}" placeholder="{!! __('admin.Title_ar1') !!}"
                                                name="title_ar" aria-label="courses title">




                                            @error('title_ar')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                        {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12">
                                            <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                            <input type="text" class="form-control" required id="ecommerce-courses-name"
                                                value="{{ old('title_en') }}" placeholder=" {!! __('admin.Title_en1') !!}"
                                                name="title_en" aria-label="courses title">




                                            @error('title_en')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}




                                        {{-- -------------------------------------------------------------- meta_description_ar-------------------------------------------------------------------- --}}
                                        <div class="mb-3">
                                            <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                            <input type="text" class="form-control" required id="ecommerce-product-name"
                                                value="{{ old('meta_description_ar') }}"
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
                                            <input type="text" class="form-control" required id="ecommerce-product-name"
                                                value="{{ old('meta_description_en') }}"
                                                placeholder="{!! __('admin.Meta_Description_en1') !!}" name="meta_description_en"
                                                aria-label="Product title">



                                            @error('meta_description_en')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end Meta_Description_en-------------------------------------------------------------------- --}}








                                    </div>


                                    <div class="row g-6">

                                        {{-- --------------------------------------------------------------  overview_ar-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 ">
                                            <br>

                                            <label class="form-label">
                                                {!! __('admin.Overview_ar') !!}
                                            </label>


                                            <textarea class=" form-control" name="overview_ar" placeholder="اكتب هنا ">{{ old('overview_ar') }}</textarea>




                                            @error('overview_ar')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end overview_ar-------------------------------------------------------------------- --}}

                                        {{-- --------------------------------------------------------------  overview_en-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 ">
                                            <br>
                                            <label class="form-label">{!! __('admin.Overview_en') !!}</label>
                                            <textarea class=" form-control" name="overview_en" placeholder="اكتب هنا ">{{ old('overview_en') }}</textarea>



                                            @error('overview_en')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end overview_en-------------------------------------------------------------------- --}}
                                    </div>

                                    <br>

                                    {{-- -------------------------------------------------------------- price-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Price') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">EGP</span>
                                            <input type="number" class="form-control price" value="{{ old('price') }}"
                                                name="price" placeholder="{!! __('admin.Price') !!}"
                                                aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                        @error('price')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end price-------------------------------------------------------------------- --}}


                                    {{-- -------------------------------------------------------------- Price Online-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Price Online') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">EGP</span>
                                            <input type="number" class="form-control price_online"
                                                value="{{ old('price_online') }}" name="price_online"
                                                placeholder="{!! __('admin.Price Online') !!}"
                                                aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>



                                        @error('price_online')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end Price Online-------------------------------------------------------------------- --}}

                                    {{-- Status --}}
                                    <div class="col-md-12">
                                        <label class="form-label">{{ __('admin.Status') }}</label>
                                        <select name="status" class="form-select" required>
                                            <option value="1">نشط</option>
                                            <option value="0">غير نشط</option>

                                        </select>
                                    </div>

                                    {{-- -------------------------------------------------------------- discount_rate-------------------------------------------------------------------- --}}
                                    {{-- <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Rate') !!}</label>

                                        <div class="input-group">
                                            <span class="input-group-text">%</span>
                                            <input type="text" class="form-control discount_rate"
                                                value="{{ old('discount_rate') }}" name="discount_rate" maxlength="3"
                                                max="100" min="0" placeholder="0"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>



                                        @error('discount_rate')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div> --}}

                                    {{-- --------------------------------------------------------------end discount_rate-------------------------------------------------------------------- --}}




                                    {{--
                                    <script>
                                        $(document).ready(function() {
                                            $('.price').on('keyup', function() {
                                                $(".discount").val(0);
                                                $(".discount_rate").val(0);
                                            })


                                            $('.discount').on('keyup', function() {
                                                var price = $('.price').val();
                                                var discount = $(this).val();
                                                var discount_rate = $('.discount_rate').val();
                                                $(".discount_rate").val((discount / price) * 100);
                                            })



                                            $('.discount_rate').on('keyup', function() {
                                                var price = $('.price').val();
                                                var discount_rate = $(this).val();
                                                var discount = $('.discount').val();

                                                $(".discount").val((price * discount_rate) / 100);
                                            })

                                        });
                                    </script>
 --}}




                                    {{-- -------------------------------------------------------------- discount_date-------------------------------------------------------------------- --}}
                                    {{-- <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Discount Expire Date') !!}</label>

                                        <div class="input-group">

                                            <input type="date" class="form-control discount_date" name="discount_date"
                                                value="{{ old('discount_date') }}" min="{{ now()->format('Y-m-d') }}"
                                                placeholder="{!! __('admin.Discount Expire Date') !!}"
                                                aria-label="Amount (to the nearest dollar)">


                                        </div>



                                        @error('discount_date')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div> --}}

                                    {{-- --------------------------------------------------------------end discount_date-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- Tax-------------------------------------------------------------------- --}}
                                    {{-- <div class="mb-3">
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



                                    </div> --}}

                                    {{-- --------------------------------------------------------------end tax-------------------------------------------------------------------- --}}








                                    <div class="row g-6">


                                        <div>
                                            <br>
                                            <label class="form-label">{!! __('admin.Description') !!} </label>

                                            <div class="row2" id="row_item2">




                                            </div>


                                            @error('Item')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <input class="btn btn-primary" onclick="additem2()"
                                                value="{!! __('admin.Add Another Description') !!}">


                                        </div>





                                        <script>
                                            additem2()

                                            function additem2() {

                                                var item = ` <div class="  option-row2 row">
<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Title_ar') !!}</label>
<input required type="text" id="form-repeater "   name="title_ar2[]" class="form-control" placeholder="Enter  " />
</div>


<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Description_ar') !!}</label>
<textarea class=" form-control" name="description_ar2[]" placeholder="اكتب هنا ">{{ old('description_ar1') }}</textarea>
</div>


<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Title_en') !!}</label>
<input required type="text" id="form-repeater "   name="title_en2[]" class="form-control" placeholder="Enter  " />
</div>


<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Description_en') !!}</label>
<textarea class=" form-control" name="description_en2[]" placeholder="اكتب هنا ">{{ old('description_en1') }}</textarea>
</div>


<div class="mb-3 col-2">
<label class="form-label invisible" for="form-repeater-1-2">Not visible</label>

<button type="button" class="btn btn-danger remove-option2">{!! __('admin.Delete') !!}</button>
</div>
</div>
<hr>
`;

                                                $('#row_item2').append(item);

                                            }
                                            $(document).on('click', '.remove-option2', function() {
                                                $(this).closest('.option-row2').remove(); // حذف السطر بالكامل
                                            });
                                        </script>

                                    </div>


                                    {{-- --------------------------------------------------------------  Item-------------------------------------------------------------------- --}}
                                    {{-- <div>
                                        <br>
                                        <label class="form-label"> {!! __('admin.Item') !!}</label>

                                        <div class="row" id="row_item">




                                        </div>


                                        @error('Item')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <input class="btn btn-primary" onclick="additem()"
                                            value="{!! __('admin.Add Another Item') !!}">


                                    </div>





                                    <script>
                                        additem()

                                        function additem() {

                                            var item = ` <div class="  option-row1 row">
<div class="mb-3 col-5 ">
  <label class="form-label">{!! __('admin.Name_ar') !!}</label>
  <input required type="text" id="form-repeater "   name="name_ar1[]" class="form-control" placeholder="Enter  " />
</div>



<div class="mb-3 col-5 ">
  <label class="form-label">{!! __('admin.Name_en') !!}</label>
  <input required type="text" id="form-repeater "   name="name_en1[]" class="form-control" placeholder="Enter  " />
</div>




<div class="mb-3 col-2">
<label class="form-label invisible" for="form-repeater-1-2">Not visible</label>

<button type="button" class="btn btn-danger remove-option1">{!! __('admin.Delete') !!}</button>
</div>
</div>
<hr>
`;

                                            $('#row_item').append(item);

                                        }
                                        $(document).on('click', '.remove-option1', function() {
                                            $(this).closest('.option-row1').remove(); // حذف السطر بالكامل
                                        });
                                    </script> --}}
                                    {{-- --------------------------------------------------------------end item-------------------------------------------------------------------- --}}
                                    {{-- -------------------------------------------------------------- video-------------------------------------------------------------------- --}}
                                    {{-- <br>
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Video') !!}</label>
                                        <input type="url" class="form-control" required id="ecommerce-courses-name"
                                            value="{{ old('video') }}" placeholder="{!! __('admin.Url Video') !!}"
                                            name="video" aria-label="video ">




                                        @error('video')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div> --}}

                                    {{-- --------------------------------------------------------------end video-------------------------------------------------------------------- --}}

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


                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                        <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!} </button>
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
