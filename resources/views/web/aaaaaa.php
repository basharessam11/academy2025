@php
    use App\Models\Setting;
    $locale = App::currentLocale();
    $settings = Setting::find(1);
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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Courses</li>
                                <li class="breadcrumb-item" aria-current="page">All Courses</li>
                                <li class="breadcrumb-item" aria-current="page">The Complete Web Developer Course 2.0</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->


    <!-- Inner Banner -->
    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instructor-wrap border-bottom-0 m-0">
                        <div class="about-instructor align-items-center">
                            <div class="abt-instructor-img">
                                <a href="instructor-profile.html"><img
                                        src="{{ asset('images') }}/{{ $courses->user->photo != null ? $courses->user->photo : 'no-image.png' }}"
                                        alt="img" class="img-fluid"></a>
                            </div>
                            <div class="instructor-detail me-3">
                                <h5><a href="instructor-profile.html">
                                        @if (App::isLocale('en'))
                                            {!! $courses->user->name_en !!}
                                        @else
                                            {!! $courses->user->name_ar !!}
                                        @endif
                                    </a></h5>
                                <p>Instructor</p>
                            </div>
                            @php
                                $averageRating = round($courses->review()->avg('rate'), 1);
                                $totalReviews = $courses->review()->count();
                                $fullStars = floor($averageRating); // عدد النجوم الممتلئة
                                $halfStar = $averageRating - $fullStars >= 0.5; // هل يوجد نصف نجمة؟
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // عدد النجوم الفارغة

                                if (App::isLocale('en')) {
                                    $slug = $courses->slug_en;
                                } else {
                                    $slug = $courses->slug_ar;
                                }
                            @endphp


                            <div class="rating mb-0">
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star filled"></i>
                                @endfor
                                @if ($halfStar)
                                    <i class="fas fa-star-half-alt filled"></i>
                                @endif

                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor

                                <span
                                    class="d-inline-block average-rating"><span>{{ number_format($averageRating, 1) }}</span>
                                    ({{ $totalReviews }})</span>
                            </div>
                        </div>
                        <span class="web-badge mb-3">WEB DEVELPMENT</span>
                    </div>
                    <h2>
                        @if (App::isLocale('en'))
                            {!! $courses->title_en !!}
                        @else
                            {!! $courses->title_ar !!}
                        @endif
                    </h2>
                    <p>
                        @if (App::isLocale('en'))
                            {!! $courses->overview_en !!}
                        @else
                            {!! $courses->overview_ar !!}
                        @endif
                    </p>
                    <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                        <div class="cou-info">
                            <img src="{{ asset('web') }}/build/img/icon/icon-01.svg" alt="">
                            <p>12+ Lesson</p>
                        </div>
                        <div class="cou-info">
                            <img src="{{ asset('web') }}/build/img/icon/timer-icon.svg" alt="">
                            <p>9hr 30min</p>
                        </div>
                        <div class="cou-info">
                            <img src="{{ asset('web') }}/build/img/icon/people.svg" alt="">
                            <p>32 students enrolled</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Inner Banner -->

    <!-- Course Content -->
    <section class="page-content course-sec">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">

                    <!-- Overview -->
                    <div class="card overview-sec">
                        <div class="card-body">
                            <h5 class="subs-title">Overview</h5>

                            @foreach ($courses->coursesDescription as $item)
                                <h6>
                                    @if (App::isLocale('en'))
                                        {!! $item->title_en !!}
                                    @else
                                        {!! $item->title_ar !!}
                                    @endif
                                </h6>
                                <p>
                                    @if (App::isLocale('en'))
                                        {!! $item->description_en !!}
                                    @else
                                        {!! $item->description_ar !!}
                                    @endif
                                </p>
                            @endforeach



                        </div>
                    </div>
                    <!-- /Overview -->

                    {{-- <!-- Course Content -->
                    <div class="card content-sec">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="subs-title">Course Content</h5>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <h6>92 Lectures 10:56:11</h6>
                                </div>
                            </div>
                            <div class="course-card">
                                <h6 class="cou-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseOne"
                                        aria-expanded="false">In which areas do you operate?</a>
                                </h6>
                                <div id="collapseOne" class="card-collapse collapse" style="">
                                    <ul>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.1
                                                Introduction to the User Experience Course</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.2
                                                Exercise: Your first design challenge</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.3
                                                How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.3
                                                How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.5
                                                How to use text layers effectively</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-card">
                                <h6 class="cou-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#course2" aria-expanded="false">The
                                        Brief</a>
                                </h6>
                                <div id="course2" class="card-collapse collapse" style="">
                                    <ul>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.1 Introduction to the User Experience Course
                                            </p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.2 Exercise: Your first design challenge</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.3 How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.3 How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.5 How to use text layers effectively</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-card">
                                <h6 class="cou-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#course3"
                                        aria-expanded="false">Wireframing Low Fidelity</a>
                                </h6>
                                <div id="course3" class="card-collapse collapse" style="">
                                    <ul>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.1 Introduction to the User Experience Course
                                            </p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.2 Exercise: Your first design challenge</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.3 How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.3 How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture1.5 How to use text layers effectively</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-card">
                                <h6 class="cou-title mb-0">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#coursefour"
                                        aria-expanded="false">Type, Color & Icon Introduction</a>
                                </h6>
                                <div id="coursefour" class="card-collapse collapse" style="">
                                    <ul>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture4.1 Introduction to the User Experience Course
                                            </p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture4.2 Exercise: Your first design challenge</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture4.3 How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture4.4 How to solve the previous exercise</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                        <li>
                                            <p><img src="{{ asset('web') }}/build/img/icon/play.svg" alt=""
                                                    class="me-2">Lecture4.5 How to use text layers effectively</p>
                                            <div>
                                                <a href="javascript:;">Preview</a>
                                                <span>02:53</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Course Content --> --}}
                    {{-- @dd($courses->user) --}}
                    <!-- Instructor -->
                    <div class="card instructor-sec">
                        <div class="card-body">
                            <h5 class="subs-title">About the instructor</h5>
                            <div class="instructor-wrap">
                                <div class="about-instructor">
                                    <div class="abt-instructor-img">
                                        <a href="instructor-profile.html"><img
                                                src="{{ asset('images') }}/{{ $courses->user->photo != null ? $courses->user->photo : 'no-image.png' }}"
                                                alt="img" class="img-fluid"></a>
                                    </div>
                                    <div class="instructor-detail">
                                        <h5><a href="instructor-profile.html">
                                                @if (App::isLocale('en'))
                                                    {!! $courses->user->name_en !!}
                                                @else
                                                    {!! $courses->user->name_ar !!}
                                                @endif
                                            </a></h5>
                                        <p>Instructor</p>
                                    </div>
                                </div>

                                <div class="rating">
                                    @php
                                        $averageRating = round($courses->review()->avg('rate'), 1);
                                        $totalReviews = $courses->review()->count();
                                        $fullStars = floor($averageRating); // عدد النجوم الممتلئة
                                        $halfStar = $averageRating - $fullStars >= 0.5; // هل يوجد نصف نجمة؟
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // عدد النجوم الفارغة

                                    @endphp
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star filled"></i>
                                    @endfor
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt filled"></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    <span
                                        class="d-inline-block average-rating"><span>{{ number_format($averageRating, 1) }}</span>
                                        ({{ $totalReviews }}) Instructor Rating</span>

                                </div>
                            </div>
                            <div class="course-info d-flex align-items-center">
                                <div class="cou-info">
                                    <img src="{{ asset('web') }}/build/img/icon/play.svg" alt="">
                                    <p>5 Courses</p>
                                </div>
                                <div class="cou-info">
                                    <img src="{{ asset('web') }}/build/img/icon/icon-01.svg" alt="">
                                    <p>12+ Lesson</p>
                                </div>
                                <div class="cou-info">
                                    <img src="{{ asset('web') }}/build/img/icon/icon-02.svg" alt="">
                                    <p>9hr 30min</p>
                                </div>
                                <div class="cou-info">
                                    <img src="{{ asset('web') }}/build/img/icon/people.svg" alt="">
                                    <p>270,866 students enrolled</p>
                                </div>
                            </div>
                            @if (App::isLocale('en'))
                                {!! $courses->user->overview_en !!}
                            @else
                                {!! $courses->user->overview_ar !!}
                            @endif
                        </div>
                    </div>
                    <!-- /Instructor -->


                    <!-- Reviews -->
                    <div class="card review-sec">
                        <div class="card-body">

                            @foreach ($reviews as $key => $review)
                                <h5 class="subs-title">{{ __('web.reviews') }}</h5>
                                <div class="instructor-wrap">
                                    <div class="about-instructor">
                                        <div class="abt-instructor-img">
                                            <a href="instructor-profile.html"><img
                                                    src="{{ asset('images') }}/{{ $review->customer->photo != null ? $review->customer->photo : 'no-image.png' }}"
                                                    alt="img" class="img-fluid"></a>
                                        </div>
                                        <div class="instructor-detail">
                                            <h5><a href="instructor-profile.html">
                                                    {!! $review->customer->name !!}
                                                </a></h5>
                                            <p>student</p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        @php
                                            $averageRating = round($review->avg('rate'), 1);
                                            $totalReviews = $review->count();
                                            $fullStars = floor($averageRating); // عدد النجوم الممتلئة
                                            $halfStar = $averageRating - $fullStars >= 0.5; // هل يوجد نصف نجمة؟
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // عدد النجوم الفارغة

                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt filled"></i>
                                        @endif

                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor

                                        <span
                                            class="d-inline-block average-rating"><span>{{ number_format($averageRating, 1) }}</span>
                                            ({{ $totalReviews }})
                                        </span>

                                    </div>
                                </div>
                                <p class="rev-info">“ {{ $review->review }}“</p>
                            @endforeach

                        </div>
                    </div>
                    <!-- /Reviews -->

                    <!-- Comment -->
                    <div class="card comment-sec">
                        <div class="card-body">
                            <h5 class="subs-title">{{ __('web.rating') }}</h5>
                            <form action="{{ route('courses-review.store') }}" method="post">
                                @csrf
                                @method('post')
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="rating rate">
                                            <i class="fas fa-star  " data-value="1"></i>
                                            <i class="fas fa-star  " data-value="2"></i>
                                            <i class="fas fa-star  " data-value="3"></i>
                                            <i class="fas fa-star  " data-value="4"></i>
                                            <i class="fas fa-star  " data-value="5"></i>
                                        </div>
                                        <input type="hidden" id="rating-value" name="rate" value="">
                                        <br>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="input-block">
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="{{ __('web.name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block">
                                            <input required type="email" class="form-control" name="email"
                                                placeholder="{{ __('web.email') }}">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $courses->id }}" name="course_id"
                                    class="form-control">
                                <div class="input-block">
                                    <textarea required rows="4" class="form-control" name="review" placeholder="{{ __('web.reviews') }}"></textarea>
                                </div>
                                <div class="submit-section">
                                    <button class="btn submit-btn" type="submit">{{ __('web.submit_review') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Comment -->

                </div>

                <div class="col-lg-4">
                    <div class="sidebar-sec">

                        <!-- Video -->
                        <div class="video-sec vid-bg">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{!! $courses->video !!}" class="video-thumbnail" data-fancybox="">
                                        <div class="play-icon">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                        <img class=""
                                            src="{{ asset('images') }}/{{ $courses->photo != null ? $courses->photo : 'no-image.png' }}"
                                            alt="">
                                    </a>

                                    <div class="video-details">

                                        <br>
                                        <br>

                                        <div class="course-fee">
                                            <a href="checkout.html"
                                                class="btn btn-enroll w-100 b-2">{{ __('web.booking_now') }}</a>
                                        </div>
                                        <br>
                                        <br>

                                        <div class="row gx-2">

                                            <h5 class="text-center">{{ __('web.share') }}</h5>


                                            <div class="col-md-3">
                                                <a class="btn btn-wish w-100"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('courses_details', $courses->slug_en)) }}"
                                                    target="_blank">
                                                    <i class='bx bxl-facebook'></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="btn btn-wish w-100"
                                                    href="https://twitter.com/intent/tweet?url={{ urlencode(route('courses_details', $courses->slug_en)) }}&text={{ urlencode($courses->title) }}"
                                                    target="_blank">
                                                    <i class='bx bxl-twitter'></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="btn btn-wish w-100"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('courses_details', $courses->slug_en)) }}"
                                                    target="_blank">
                                                    <i class='bx bxl-instagram'></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="btn btn-wish w-100"
                                                    href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('courses_details', $courses->slug_en)) }}&title={{ urlencode($courses->title) }}&summary={{ urlencode($courses->description) }}"
                                                    target="_blank">
                                                    <i class='bx bxl-linkedin'></i>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Video -->

                        <!-- Include -->
                        <div class="card include-sec">
                            <div class="card-body">
                                <div class="cat-title">
                                    <h4>Includes</h4>
                                </div>
                                <ul>
                                    <li><img src="{{ asset('web') }}/build/img/icon/import.svg" class="me-2"
                                            alt=""> 11 hours
                                        on-demand video</li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/play.svg" class="me-2"
                                            alt=""> 69 downloadable
                                        resources</li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/key.svg" class="me-2"
                                            alt=""> Full lifetime
                                        access</li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/mobile.svg" class="me-2"
                                            alt=""> Access on
                                        mobile and TV</li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/cloud.svg" class="me-2"
                                            alt=""> Assignments
                                    </li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/teacher.svg" class="me-2"
                                            alt=""> Certificate
                                        of Completion</li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Include -->

                        <!-- Features -->
                        <div class="card feature-sec">
                            <div class="card-body">
                                <div class="cat-title">
                                    <h4>Includes</h4>
                                </div>
                                <ul>
                                    <li><img src="{{ asset('web') }}/build/img/icon/users.svg" class="me-2"
                                            alt=""> Enrolled:
                                        <span>32 students</span>
                                    </li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/timer.svg" class="me-2"
                                            alt=""> Duration:
                                        <span>20 hours</span>
                                    </li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/chapter.svg" class="me-2"
                                            alt=""> Chapters:
                                        <span>15</span>
                                    </li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/video.svg" class="me-2"
                                            alt=""> Video:<span>
                                            12 hours</span></li>
                                    <li><img src="{{ asset('web') }}/build/img/icon/chart.svg" class="me-2"
                                            alt=""> Level:
                                        <span>Beginner</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Features -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Pricing Plan -->
@endsection
