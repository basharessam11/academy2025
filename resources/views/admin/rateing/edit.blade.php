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




             <form action="{{ route('rateing.update', $rateing->id) }}" method="post" enctype="multipart/form-data">
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
                                     <h5 class="card-tile mb-0">{!! __('admin.Edit Rateing') !!} </h5>
                                 </div>
                                 <div class="card-body">
                                     {{-- -------------------------------------------------------------- name-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Name') !!}</label>
                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $rateing->name }}" placeholder=" {!! __('admin.Name') !!}"
                                             name="name" aria-label="Product title">




                                         @error('name')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end name-------------------------------------------------------------------- --}}



                                     {{-- --------------------------------------------------------------  overview_ar-------------------------------------------------------------------- --}}
                                     <div>
                                         <label class="form-label">{!! __('admin.Review') !!}</label>


                                         <textarea   class=" form-control" name="review" placeholder="اكتب هنا ">{{ $rateing->review }}</textarea>




                                         @error('review')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end overview_ar-------------------------------------------------------------------- --}}
                                     {{-- -------------------------------------------------------------- Rate-------------------------------------------------------------------- --}}
                                     <div class="mb-3">
                                         <label class="form-label">{!! __('admin.Rateing') !!}</label>
                                         <input type="text" class="form-control" required id="ecommerce-product-name"
                                             value="{{ $rateing->rate }}" placeholder=" {!! __('admin.Rateing') !!}"
                                             name="rate" aria-label="Product title">




                                         @error('rate')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror



                                     </div>

                                     {{-- --------------------------------------------------------------end rate-------------------------------------------------------------------- --}}




                                     {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                     <div>
                                         <br>
                                         <label class="form-label">{!! __('admin.Photo') !!}</label>
                                         <input type="file" multiple name="photo" onchange="readURL(this);"
                                             value="{{ $rateing->photo }}" class="file form-control">

                                         @error('photo')
                                             <br>
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             <br>
                                         @enderror


                                         <br>
                                         <div class="row last">
                                             <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                 <a target="_blank" href="{{ asset('images') }}/{{ $rateing->photo }}">
                                                     <img id="blah" style="width: 100%;height: 100%;padding: 5px;"
                                                         src="{{ asset('images') }}/{{ $rateing->photo }}"
                                                         alt="your image" /></a>
                                             </div>



                                         </div>



                                         {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}

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
     <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


 @endsection
