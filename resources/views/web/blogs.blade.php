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

                        @foreach ($blogs as $key => $blog)
                            <div class="col-md-4 col-sm-12">
                                <!-- Blog Post -->
                                <div class="blog grid-modern">
                                    @php

                                        $date = \Carbon\Carbon::parse($blog->created_at);
                                        $formattedDate = $date->format('M d, Y'); // مثال: May 20, 2022

                                        if (App::isLocale('en')) {
                                            $slug = $blog->slug_en;
                                        } else {
                                            $slug = $blog->slug_ar;
                                        }
                                    @endphp



                                    <div class="instructors-widget blog-widget" style="height:  500px">
                                        <div class="instructors-img">
                                            <a href="{{ route('blog_details', $slug) }}">
                                                <img class="img-fluid" style="height: 304px"
                                                    alt="@if (App::isLocale('en')) {!! $blog->title_en !!}@else{!! $blog->title_ar !!} @endif"
                                                    src="{{ asset('images') }}/{{ $blog->photo != null ? $blog->photo : 'no-image.png' }}">
                                            </a>
                                        </div>

                                        <div class="instructors-content text-center">
                                            <h5><a href="{{ route('blog_details', $slug) }}">
                                                    @if (App::isLocale('en'))
                                                        {!! $blog->title_en !!}
                                                    @else
                                                        {!! $blog->title_ar !!}
                                                    @endif
                                                </a></h5>

                                            <p>{!! $blog->category->title_en !!}</p>
                                            <div class="student-count d-flex justify-content-center">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span>{{ $formattedDate }}</span>
                                            </div>
                                        </div>

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
                                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                </li>

                                <!-- Dynamically generated page numbers -->
                                @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                    <li class="page-item {{ $blogs->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next page -->
                                <li class="page-item next">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}">
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
