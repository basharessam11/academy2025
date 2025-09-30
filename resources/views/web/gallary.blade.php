@php
use App\Models\Meta;
    $locale = App::currentLocale();
    $meta = Meta::first();

@endphp
@extends('web.layouts.app')



@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                <li class="breadcrumb-item">Pages</li>
                                <li class="breadcrumb-item">Blog Modern</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Blog Modern -->
    <section class="course-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">

                        @foreach ($cards as $key => $card)
                            <div class="col-md-4 col-sm-12">
                                <!-- Blog Post -->
                                <div class="blog grid-modern">
                                    <div class="blog-image">
                                        @if ($card->type == 1)
                                            <!-- If type is 1, display a button to open the video in the modal -->

                                            @if ($card->type == 1)
                                                <a href="#" data-bs-toggle="modal" class="show_modal"
                                                    data-url="https://www.youtube.com/embed/{{ getYouTubeID($card->url) }}?rel=0&showinfo=0&controls=1"
                                                    data-bs-target="#videoModal">
                                                @else
                                                    <a href="{{ asset('images') }}/{{ $card->photo != null ? $card->photo : 'no-image.png' }}"
                                                        target="_blank">
                                            @endif

                                            <img class="img-fluid" style="height: 400px"
                                                src="{{ asset('images') }}/{{ $card->photo != null ? $card->photo : 'no-image.png' }}"
                                                alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                            <div class="video-icon position-absolute top-50 start-50 translate-middle">
                                                <i class="fa fa-play" style="font-size: 50px; color: rgb(0, 0, 0);"></i>
                                            </div>
                                            </a>
                                        @else
                                            <!-- If type is not 1, display image -->
                                            <a target="_blank"
                                                href="{{ asset('images') }}/{{ $card->photo != null ? $card->photo : 'no-image.png' }}">
                                                <img class="img-fluid" style="height: 400px"
                                                    src="{{ asset('images') }}/{{ $card->photo != null ? $card->photo : 'no-image.png' }}"
                                                    alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!-- /Blog Post -->
                            </div>
                        @endforeach




                        <!-- الموديل الذي سيظهر عند الضغط على الزر -->
                        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="videoModalLabel">Video</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- مكان عرض الفيديو داخل الموديل -->
                                        <iframe id="videoFrame" width="100%" height="400" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- سكربت لتحميل الفيديو عند الضغط على الزر -->
                        <script>
                            // عند الضغط على الزر
                            $(".show_modal").click(function() {
                                var videoUrl = $(this).data('url'); // جلب الرابط من data-url
                                // console.log(videoUrl); // طباعة الرابط للتأكد

                                // تحديث رابط الفيديو داخل الـ iframe داخل الموديل
                                $("#videoFrame").attr("src", videoUrl);
                            });
                        </script>



                    </div>
                    <br>
                    <!-- pagination -->
                    <div class="row justify-content-center"> <!-- هذا يقوم بتوسيط العنصر داخل الصف -->
                        <div class="col-md-12">
                            <ul class="pagination lms-page d-flex justify-content-center">
                                <!-- Previous page -->
                                <li class="page-item prev">
                                    <a class="page-link" href="{{ $cards->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                </li>

                                <!-- Dynamically generated page numbers -->
                                @foreach ($cards->getUrlRange(1, $cards->lastPage()) as $page => $url)
                                    <li class="page-item {{ $cards->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next page -->
                                <li class="page-item next">
                                    <a class="page-link" href="{{ $cards->nextPageUrl() }}">
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- /pagination -->

                </div>
            </div>
        </div>
    </section>
    <!-- /Blog Modern -->
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
