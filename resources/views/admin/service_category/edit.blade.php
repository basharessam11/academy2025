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




             <form action="{{ route('service_category.update', $service_category->id) }}" method="post"
                 enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
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
                                     <h5 class="card-tile mb-0">{!! __('admin.Edit Languages') !!} </h5>
                                 </div>
                                 <div class="card-body">

                                     {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $service_category->title_ar }}" placeholder="Product title"
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
                                             value="{{ $service_category->title_en }}" placeholder="Product title"
                                             name="title_en" aria-label="Product title">




                                         @error('title_en')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}


                                     {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                     <div>
                                         <br>
                                         <label class="form-label">{!! __('admin.Photo') !!}</label>
                                         <input type="file" multiple name="photo" onchange="readURL(this);"
                                             value="{{ $service_category->photo }}" class="file form-control">

                                         @error('photo')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             <br>
                                         @enderror


                                         <br>
                                         <div class="row last">
                                             <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                 <a target="_blank"
                                                     href="{{ asset('images') }}/{{ $service_category->photo }}">
                                                     <img id="blah" style="width: 100%;height: 100%;padding: 5px;"
                                                         src="{{ asset('images') }}/{{ $service_category->photo }}"
                                                         alt="your image" /></a>
                                             </div>



                                         </div>



                                         {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}



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




 @endsection

 @section('footer')
     <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


 @endsection
