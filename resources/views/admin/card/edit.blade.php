 @extends('admin.layout.app')

 @section('page', 'Create Product')


 @section('contant')








     {{-- @dd($errors) --}}
     <!-- Content wrapper -->
     <div class="content-wrapper">

         <!-- Content -->

         <div class="container-xxl flex-grow-1 container-p-y">




             <form action="{{ route('card.update', $card->id) }}" method="post" enctype="multipart/form-data">
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
                                     <h5 class="card-tile mb-0">{!! __('admin.Edit Card') !!} </h5>
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

                                     {{-- نوع الوسائط --}}
                                     <div class="mb-3">
                                         <label class="form-label">{{ __('admin.Type') }}</label>
                                         <select class="form-control" name="type" id="type">
                                             @if ($card->type == 1)
                                                 <option selected value="1">{{ __('admin.Video') }}</option>
                                             @else
                                                 <option selected value="2">{{ __('admin.Photo') }}</option>
                                             @endif


                                         </select>
                                         @error('type')
                                             <div class="alert alert-danger mt-2">{{ $message }}</div>
                                         @enderror
                                     </div>

                                     {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}


                                     @if ($card->type == 1)
                                         {{-- روابط الفيديو --}}
                                         <div id="video-input" class="mb-3">
                                             <label class="form-label">{{ __('admin.Url Video') }}</label>
                                             <div id="video-url-wrapper">
                                                 <div class="input-group mb-2">
                                                     <input type="url" name="url" value="{{ $card->url }}"
                                                         class="form-control" placeholder="https://example.com/video.mp4">

                                                 </div>
                                             </div>

                                             @error('url')
                                                 <div class="alert alert-danger mt-2">{{ $message }}</div>
                                             @enderror
                                         </div>





                                         <iframe
                                             src="https://www.youtube.com/embed/{{ getYouTubeID($card->url) }}?rel=0&showinfo=0&controls=1"
                                             style="width: 100%; height:500px" frameborder="0"
                                             allow="autoplay; encrypted-media" allowfullscreen
                                             oncontextmenu="return false;">
                                         </iframe>
                                         <br>
                                         <div class="mb-3">
                                             <label class="form-label">{{ __('admin.Photo') }}</label>
                                             <div id="video-url-wrapper">
                                                 <div class="input-group mb-2">
                                                     <input type="file" multiple name="photo1" onchange="readURL(this);"
                                                         value="{{ $card->photo1 }}" class="file form-control">



                                                 </div>
                                             </div>


                                         </div>
                                         <br>
                                         <div class="row last">
                                             <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                 @php
                                                     $filePath = asset('images/' . $card->photo);
                                                     $fileExtension = pathinfo($card->photo, PATHINFO_EXTENSION);
                                                 @endphp

                                                 <a target="_blank" href="{{ $filePath }}">
                                                     @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                                         <img id="blah"
                                                             style="width: 100%; height: 100%; padding: 5px;"
                                                             src="{{ $filePath }}" alt="your image" />
                                                     @elseif(in_array(strtolower($fileExtension), ['mp4', 'avi', 'mov', 'mkv']))
                                                         <video style="width: 100%; height: 100%; padding: 5px;" controls>
                                                             <source src="{{ $filePath }}"
                                                                 type="video/{{ strtolower($fileExtension) }}">
                                                             Your browser does not support the video tag.
                                                         </video>
                                                     @else
                                                         <span>نوع الملف غير مدعوم</span>
                                                     @endif
                                                 </a>
                                             </div>
                                            </div>



                                             <br>
                                         @else
                                             <div>
                                                 <br>
                                                 <label class="form-label">{!! __('admin.Photo') !!}</label>
                                                 <input type="file" multiple name="photo" onchange="readURL(this);"
                                                     value="{{ $card->photo }}" class="file form-control">

                                                 @error('photo')
                                                     <br>
                                                     <div class="alert alert-danger">{{ $message }}</div>
                                                     <br>
                                                 @enderror


                                                 <br>
                                                 <div class="row last">
                                                     <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                         @php
                                                             $filePath = asset('images/' . $card->photo);
                                                             $fileExtension = pathinfo(
                                                                 $card->photo,
                                                                 PATHINFO_EXTENSION,
                                                             );
                                                         @endphp

                                                         <a target="_blank" href="{{ $filePath }}">
                                                             @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                                                 <img id="blah"
                                                                     style="width: 100%; height: 100%; padding: 5px;"
                                                                     src="{{ $filePath }}" alt="your image" />
                                                             @elseif(in_array(strtolower($fileExtension), ['mp4', 'avi', 'mov', 'mkv']))
                                                                 <video style="width: 100%; height: 100%; padding: 5px;"
                                                                     controls>
                                                                     <source src="{{ $filePath }}"
                                                                         type="video/{{ strtolower($fileExtension) }}">
                                                                     Your browser does not support the video tag.
                                                                 </video>
                                                             @else
                                                                 <span>نوع الملف غير مدعوم</span>
                                                             @endif
                                                         </a>
                                                     </div>



                                                 </div>

                                                 {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}

                                     @endif




                                     <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!} </button>
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

     @php
         function getYouTubeID($url)
         {
             preg_match(
                 '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S+\/\S+\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                 $url,
                 $matches,
             );
             return $matches[1] ?? '';
         }
     @endphp

 @endsection
