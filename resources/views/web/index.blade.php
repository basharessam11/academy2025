@extends('web.layouts.app')



@section('content')
    @php
        use App\Models\Setting;
        use App\Models\Meta;

        $locale = App::currentLocale();
        $settings = Setting::find(1);
        $meta = Meta::first();

    @endphp


    <!-- Home Banner -->
    <section class="home-slide d-flex align-items-center">
        <div class="container">
            <div class="row ">



                {{-- -------------------------------------------------------------- slider-------------------------------------------------------------------- --}}


                @foreach ($slider as $value)
                    <div class="col-md-7">
                        <div class="home-slide-face aos" data-aos="fade-up">
                            <div class="home-slide-text ">
                                <h5>
                                    @if (App::isLocale('en'))
                                        {!! $value->title_en !!}
                                    @else
                                        {!! $value->title_ar !!}
                                    @endif
                                </h5>
                                <h1>
                                    @if (App::isLocale('en'))
                                        {!! $value->title_en1 !!}
                                    @else
                                        {!! $value->title_ar1 !!}
                                    @endif
                                </h1>
                                <p>
                                    @if (App::isLocale('en'))
                                        <p>{!! $value->description_en !!}</p>
                                    @else
                                        <p>{!! $value->description_ar !!}</p>
                                    @endif
                                </p>
                            </div>

                            <div class="trust-user">
                                <p>
                                    @if (App::isLocale('en'))
                                        <p>{!! $value->description_en1 !!}</p>
                                    @else
                                        <p>{!! $value->description_ar1 !!}</p>
                                    @endif
                                </p>
                                <div class="trust-rating d-flex align-items-center">
                                    <div class="rate-head">
                                        <h2><span>{!! $value->counter !!}</span>+</h2>
                                    </div>
                                    <div class="rating d-flex align-items-center">
                                        <h2 class="d-inline-block average-rating">{!! number_format($value->rate, 1) !!}</h2>

                                        @for ($i = 1; $i <= $value->rate; $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex align-items-center">
                        <div class="girl-slide-img aos" data-aos="fade-up">
                            <img src="{{ asset('images') }}/{{ $value->photo != null ? $value->photo : 'no-image.png' }}"
                                alt="@if (App::isLocale('en')) {!! $value->title_en1 !!}@else{!! $value->title_ar1 !!} @endif">
                        </div>
                    </div>
                @endforeach

                {{-- -------------------------------------------------------------- end slider-------------------------------------------------------------------- --}}















            </div>
        </div>
    </section>



    {{-- -------------------------------------------------------------- counter-------------------------------------------------------------------- --}}


    <!-- /Home Banner -->
    <section class="section student-course">
        <div class="container">
            <div class="course-widget">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="course-full-width">
                            <div class="blur-border course-radius align-items-center aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img ms-3">
                                        <img src="{{ asset('web') }}/build/img/pencil-icon.svg"
                                            alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                    </div>
                                    <div class="course-inner-content ">
                                        <h4><span>{{ $settings->counter1 }}</span>+</h4>
                                        <p>{{ __('web.Online Sessions') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="course-full-width">
                            <div class="blur-border course-radius aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img ms-3">
                                        <img src="{{ asset('web') }}/build/img/cources-icon.svg"
                                            alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                    </div>
                                    <div class="course-inner-content">
                                        <h4><span>{{ $settings->counter2 }}</span>+</h4>
                                        <p>{{ __('web.STUDENTS ENROLLED') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="course-full-width">
                            <div class="blur-border course-radius aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img ms-3">
                                        <img src="{{ asset('web') }}/build/img/certificate-icon.svg"
                                            alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                    </div>
                                    <div class="course-inner-content">
                                        <h4><span>{{ $settings->counter3 }}</span>+</h4>
                                        <p>{{ __('web.Total Sessions') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="course-full-width">
                            <div class="blur-border course-radius aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img ms-3">
                                        <img src="{{ asset('web') }}/build/img/gratuate-icon.svg"
                                            alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                    </div>
                                    <div class="course-inner-content">
                                        <h4><span>{{ $settings->counter4 }}</span>+</h4>
                                        <p>{{ __('web.Online Students') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Banner -->
    {{-- -------------------------------------------------------------- end counter-------------------------------------------------------------------- --}}

    <!-- Top Categories -->
    <section class="section how-it-works">
        <div class="container">


            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <h2>{{ __('web.Top Languages') }}</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">
                            {{ __('web.Choose your path in the world of programming with Tech Bridge! We offer intensive training in the most in-demand programming languages, with a simple and practical approach.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel mentoring-course owl-theme aos" data-aos="fade-up">
                {{-- -------------------------------------------------------------- ServiceCategory-------------------------------------------------------------------- --}}

                @foreach ($ServiceCategory as $key => $cat)
                    <div class="feature-box text-center ">
                        <div class="feature-bg">
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <img src="{{ asset('images') }}/{{ $cat->photo != null ? $cat->photo : 'no-image.png' }}"
                                        alt="@if (App::isLocale('en')) {!! $cat->title_en !!}@else{!! $cat->title_ar !!} @endif">
                                </div>
                                <div class="feature-cont">
                                    <div class="feature-text">
                                        @if (App::isLocale('en'))
                                            <p>{!! $cat->title_en !!}</p>
                                        @else
                                            <p>{!! $cat->title_ar !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                {{-- -------------------------------------------------------------- ServiceCategory-------------------------------------------------------------------- --}}



            </div>
        </div>
    </section>
    <!-- /Top Categories -->


























    <!-- Feature Course -->
    <section class="section new-course">
        <div class="container">



            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <span>{{ __('web.What’s New') }}</span>
                    <h2>{{ __('web.Featured Courses') }}</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0" id="course">
                            {{ __('web.Looking for a standout course to start with? Browse our carefully selected courses designed to help you achieve your career goals.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="course-feature">
                <div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">


                    {{-- -------------------------------------------------------------- courses-------------------------------------------------------------------- --}}


                    @foreach ($courses as $key => $course)
                        @php
                            // للحصول على المتوسط (مثل التقييم العام)
                            $averageRating = $course->review->avg('rate');

                            // للحصول على العدد الإجمالي للتقييمات
                            $totalReviews = $course->review->count();
                            if (App::isLocale('en')) {
                                $slug = $course->slug_en;
                            } else {
                                $slug = $course->slug_ar;
                            }

                        @endphp
                        <div class="course-box trend-box">
                            <div class="course-box   aos" data-aos="fade-up">
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ route('courses_details', $slug) }}">
                                            <img class="img-fluid" style="height: 210px"
                                                alt="@if (App::isLocale('en')) {!! $course->title_en !!}@else{!! $course->title_ar !!} @endif"
                                                src="{{ asset('images') }}/{{ $course->photo != null ? $course->photo : 'no-image.png' }}">
                                        </a>

                                    </div>
                                    <div class="product-content">
                                        <div class="course-group d-flex">
                                            <div class="course-group-img d-flex">
                                                <a class="ms-2" href="{{ route('courses_details', $slug) }}"><img
                                                        src="{{ asset('images') }}/{{ $course->user->photo != null ? $course->user->photo : 'no-image.png' }}"
                                                        alt="@if (App::isLocale('en')) {!! $course->user->name_en . ' | ' . $course->user->meta_description_en !!}@else{!! $course->user->name_ar . '|' . $course->user->meta_description_ar !!} @endif"
                                                        class="img-fluid "></a>
                                                <div class="course-name">
                                                    <h4><a href="{{ route('courses_details', $slug) }}">
                                                            @if (App::isLocale('en'))
                                                                <p>{!! $course->user->name_en !!}</p>
                                                            @else
                                                                <p>{!! $course->user->name_ar !!}</p>
                                                            @endif
                                                        </a>
                                                    </h4>
                                                    <p>Instructor</p>
                                                </div>
                                            </div>
                                            <div class="course-share d-flex align-items-center justify-content-center">
                                                <a href="#"><i class="fa-regular fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <h3 class="title instructor-text"><a
                                                href="{{ route('courses_details', $slug) }}">
                                                @if (App::isLocale('en'))
                                                    {!! $course->title_en !!}
                                                @else
                                                    {!! $course->title_ar !!}
                                                @endif
                                            </a></h3>
                                        {{-- <div class="course-info d-flex align-items-center">
                                            <div class="rating-img d-flex align-items-center">
                                                <img   src="{{ asset('web') }}/build/img/icon/icon-01.svg" alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                                <p>{!! $course->user->lesson !!}+ Lesson</p>
                                            </div>
                                            <div class="course-view d-flex align-items-center">
                                                <img   src="{{ asset('web') }}/build/img/icon/icon-02.svg" alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                                <p>{!! $course->user->time !!}</p>
                                            </div>
                                        </div> --}}
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="rating m-0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($averageRating >= $i)
                                                        <i class="fas fa-star filled"></i> <!-- النجمة المملوءة -->
                                                    @elseif ($averageRating >= $i - 0.5)
                                                        <i class="fas fa-star-half-alt filled"></i>
                                                        <!-- النجمة النصف مملوءة -->
                                                    @else
                                                        <i class="fas fa-star"></i> <!-- النجمة الفارغة -->
                                                    @endif
                                                @endfor
                                                <span class="d-inline-block average-rating">
                                                    <span>{!! number_format($averageRating, 1) !!}</span> ({{ $totalReviews }})
                                                </span>
                                            </div>

                                            <div class="all-btn all-category d-flex align-items-center">
                                                <a href="{{ route('courses_details', $slug) }}"
                                                    class="btn btn-primary">BOOKING NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- --------------------------------------------------------------end courses-------------------------------------------------------------------- --}}




                </div>
            </div>
        </div>
    </section>
    <!-- /Feature Course -->

    <!-- Master Skill -->
    <section class="section master-skill" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="section-header aos" data-aos="fade-up">
                        <div class="section-sub-head">
                            <span>{{ __('web.about_us') }}</span>
                            <h2>{{ __('web.Tech Bridge – Your Gateway to the World of Technology') }}</h2>
                        </div>
                    </div>
                    <div class="section-text aos" data-aos="fade-up">
                        <p>{{ __('web.We are more than just an academy; we are a tech community dedicated to empowering programmers to build their future. With Tech Bridge, you will learn modern curricula, develop your skills through practical projects, and prepare yourself for strong competition in the job market.') }}
                        </p>
                    </div>
                    <div class="career-group aos" data-aos="fade-up">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box ms-2">
                                            <div class="certified-img ">
                                                <i class="fa-solid fa-rocket fa-2xl"
                                                    style="color: #f66962;font-size:40px"></i>

                                            </div>
                                        </div>
                                        <p>{{ __('web.about_d1') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box ms-2">
                                            <div class="certified-img ">

                                                <i class="fa-solid fa-users fa-2xl"
                                                    style="color: #f66962;font-size:40px"></i>
                                            </div>
                                        </div>
                                        <p>{{ __('web.about_d2') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box ms-2">
                                            <div class="certified-img ">
                                                <i class="fa-solid fa-laptop-code fa-2xl"
                                                    style="color: #f66962;font-size:40px"></i>

                                            </div>
                                        </div>
                                        <p>{{ __('web.about_d3') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box ms-2">
                                            <div class="certified-img ">
                                                <i class="fa-solid fa-briefcase fa-2xl"
                                                    style="color: #f66962;font-size:40px"></i>

                                            </div>
                                        </div>
                                        <p>{{ __('web.about_d4') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 d-flex align-items-end">
                    <div class="career-img aos" data-aos="fade-up">
                        <img src="{{ asset('web') }}/build/img/join.png" alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Master Skill -->

    {{-- <!-- Trending Course -->
    <section class="section trend-course">
        <div class="container">

            <!-- Feature Instructors -->
            <div class="feature-instructors">
                <div class="section-header aos" data-aos="fade-up">
                    <div class="section-sub-head feature-head text-center">
                        <h2>{{ __('web.Instructors') }}</h2>
                        <div class="section-text aos" data-aos="fade-up">
                            <p class="mb-0" id="Instructor">
                                {{ __('web.Your learning journey needs the right guidance! Our exceptional instructors will lead you to mastery through their expertise and interactive teaching methods') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel instructors-course owl-theme aos py-5" data-aos="fade-up">

                    {{-- --------------------------------------------------------------end Instructor-------------------------------------------------------------------- --}}

    {{-- @foreach ($users as $key => $user)
        <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
            <div class="card instructors-widget justify-content-center d-flex flex-column"
                style="width: 100%; max-width: 400px;">
                <div class="instructors-img">
                    <a>
                        <img   class="card-img-top" style="width: 100%; height: 300px"
                            alt="@if (App::isLocale('en')) {!! $user->name_en !!} @else {!! $user->name_ar !!} @endif"
                            src="{{ asset('images') }}/{{ $user->photo != null ? $user->photo : 'no-image.png' }}">
                    </a>
                </div>
                <div class="card-body text-center d-flex flex-column flex-grow-1">
                    <h5 class="card-title">
                        @if (App::isLocale('en'))
                            {!! $user->name_en !!}
                        @else
                            {!! $user->name_ar !!}
                        @endif
                    </h5>
                    <p class="card-text flex-grow-1">{!! $user->specialty !!} <i class="fa-solid fa-code"></i></p>
                </div>
            </div>
        </div>
    @endforeach --}}



    {{-- --------------------------------------------------------------end Instructor-------------------------------------------------------------------- --}}
    {{--
    </div>
    </div> --}}
    <!-- /Feature Instructors -->
    {{--
    </div>
    </section> --}}
    <!-- /Trending Course -->


    <!-- Gallary -->
    <section class="section latest-blog">

        <style>
            .instructors-img {
                position: relative;
                overflow: hidden;
                /* لتقييد الأيقونة داخل الصورة */
                transition: all 0.3s ease-in-out;
                /* لإضافة تأثيرات سلاسة */
            }

            .instructors-img img {
                width: 100%;
                /* لجعل الصورة تتكيف مع حجم الحاوية */
                transition: opacity 0.3s ease-in-out;
                /* لتغيير التعتيم عند التحويم */
            }

            .instructors-img:hover img {
                opacity: 0.7;
                /* تظليل الصورة عند التحويم */
            }

            .video-icon {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 50px;
                color: #333;
                z-index: 10;
                /* لضمان أن الأيقونة فوق الصورة */
                opacity: 0;
                /* تخفي الأيقونة بشكل افتراضي */
                transition: opacity 0.3s ease-in-out;
                /* جعل ظهور الأيقونة ناعماً */
            }

            .instructors-img:hover .video-icon {
                opacity: 1;
                /* إظهار الأيقونة عند التحويم */
            }
        </style>
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center mb-0">
                    <h2>{{ __('web.Media') }}</h2>

                </div>
            </div>
            <div class="owl-carousel blogs-slide owl-theme aos" data-aos="fade-up">
                {{-- --------------------------------------------------------------end reviews-------------------------------------------------------------------- --}}

                @foreach ($cards as $key => $card)
                    <div class="instructors-img position-relative">

                        @if ($card->type == 1)
                            <a href="#" data-bs-toggle="modal" class="show_modal"
                                data-url="https://www.youtube.com/embed/{{ getYouTubeID($card->url) }}?rel=0&showinfo=0&controls=1"
                                data-bs-target="#videoModal">
                            @else
                                <a href="{{ asset('images') }}/{{ $card->photo != null ? $card->photo : 'no-image.png' }}"
                                    target="_blank">
                        @endif


                        <img class="img-fluid" style="height: 304px" alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}"
                            src="{{ asset('images') }}/{{ $card->photo != null ? $card->photo : 'no-image.png' }}">

                        <!-- علامة الفيديو تظهر فقط إذا كان نوع المحتوى فيديو -->
                        @if ($card->type == 1)
                            <div class="video-icon position-absolute top-50 start-50 translate-middle">
                                <i class="fa fa-play" style="font-size: 50px; color: rgb(0, 0, 0);"></i>

                            </div>
                        @endif
                        </a>
                    </div>
                @endforeach


                {{-- --------------------------------------------------------------end reviews-------------------------------------------------------------------- --}}

            </div>
            <!-- الموديل الذي سيظهر عند الضغط على الزر -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="videoModalLabel">{{ __('admin.Video') }}</h5>
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



        </div>
        <div class="load-more text-center">
            <a href="{{ route('gallary') }}" class="btn btn-primary">{{ __('web.Show more') }}</a>
        </div>
    </section>
    <!-- /Gallary -->


    <!-- Users Love -->
    <section class="section user-love">
        <div class="container">
            <div class="section-header white-header  ">
                <div class="section-sub-head feature-head text-center">
                    <span>{{ __('web.Check out these reviews') }}</span>
                    <h2 id="Reviews">
                        {{ __("web.Don't just take our word for it – hear from our successful students who launched their careers with Tech Bridge! 🚀") }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /Users Love -->















    <!-- Say testimonial Four -->
    <section class="testimonial-four">
        <div class="review">
            <div class="container">
                <div class="testi-quotes">
                    <img src="{{ asset('web') }}/build/img/qute.png" alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                </div>
                <div class="mentor-testimonial lazy slider " data-sizes="50vw ">





                    {{-- --------------------------------------------------------------end reviews-------------------------------------------------------------------- --}}

                    @foreach ($reviews as $key => $review)
                        <div class="  justify-content-center">
                            <div class="testimonial-all d-flex justify-content-center"
                                style="height: 414px; postion:relative">
                                <div class="testimonial-two-head text-center align-items-center d-flex">
                                    <div class="testimonial-four-saying ">
                                        <div class="testi-right">
                                            <img src="{{ asset('web') }}/build/img/qute-01.png"
                                                alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                        </div>
                                        <p>{{ $review->review }}</p>

                                        <div class="four-testimonial-founder">
                                            <div class="fount-about-img">
                                                <a href="{{ route('index') }}#Reviews"><img
                                                        style="width: 75px;height:75px"
                                                        src="{{ asset('images') }}/{{ $review->customer->photo != null ? $review->customer->photo : 'user.png' }}"
                                                        alt="{{ $review->review }}" class="img-fluid"></a>
                                            </div>
                                            <h3><a href="{{ route('index') }}#Reviews">{{ $review->customer->name }}</a>
                                            </h3>
                                            <span>Student at Tech Bridge</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- --------------------------------------------------------------end reviews-------------------------------------------------------------------- --}}

                </div>
            </div>
        </div>
    </section>
    <!-- /Say testimonial Four -->



    <!-- Become An Instructor -->
    <section class="section become-instructors aos  ">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </section>























    <!-- /Become An Instructor -->

    <!-- Latest Blog -->
    <section class="section latest-blog">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center mb-0">
                    <h2>{{ __('web.Blogs') }} </h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">{{ __('web.Blogs_d') }}</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel blogs-slide owl-theme aos" data-aos="fade-up">
                {{-- --------------------------------------------------------------end reviews-------------------------------------------------------------------- --}}

                @foreach ($blogs as $key => $blog)
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
                @endforeach

                {{-- --------------------------------------------------------------end reviews-------------------------------------------------------------------- --}}

            </div>


            <div class="load-more text-center">
                <a href="{{ route('blogs') }}" class="btn btn-primary">{{ __('web.Show more') }}</a>
            </div>



        </div>
    </section>
    <!-- /Latest Blog -->
@endsection
