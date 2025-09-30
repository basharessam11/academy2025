@php
    use App\Models\Setting;
    use App\Models\Meta;
    use App\Models\Visit;
    use Illuminate\Support\Facades\Http;
    use App\Models\Countries;
    $locale = App::currentLocale();
    $settings = Setting::find(1);
    $page = Route::currentRouteName();
    $meta = Meta::first();

    $metaData = $meta->getMeta($page, $locale);

    $ip_address = request()->ip();

    // لو السيرفر شغال خلف Cloudflare
    if (request()->header('CF-Connecting-IP')) {
        $ip_address = request()->header('CF-Connecting-IP');
    }

    try {
        $response = Http::timeout(5)->get("https://ipwhois.app/json/{$ip_address}");
        $country_code = strtolower($response->json('country_code')) ?? null;
    } catch (\Exception $e) {
        $country_code = null;
    }

    // البحث عن الدولة في جدول countries
    $country = $country_code ? Countries::where('code', $country_code)->first() : null;

    $country_id = $country ? $country->id : 66; // 66 = مصر مثلاً كـ default

    // التأكد إذا الزائر موجود قبل كده
    $visit = Visit::where('ip_address', $ip_address)->first();
    if ($page == 'blog_details' && isset($blog)) {
        $blog->increment('views');
    }
    if ($visit) {
        // نحدّث الدولة فقط بدون زيادة visit_count
        $visit->update([
            'country_id' => $country_id,
        ]);
    } else {
        // أول زيارة للـ IP

        $referer = request()->headers->get('referer');

        Visit::create([
            'referer' => $referer,
            'ip_address' => $ip_address,
            'visit_count' => 1, // أول مرة بس
            'country_id' => $country_id,
        ]);
    }

    $logo = asset('images/' . ($settings->photo ? $settings->photo : 'no-image.png'));
@endphp


<!DOCTYPE html>
<html lang="{{ $locale }}" @if (App::isLocale('ar')) {{ 'dir=rtl' }}  @else {{ 'dir=ltr' }} @endif>
{{-- <html> --}}


<!-- Mirrored from dreamslms.dreamstechnologies.com/laravel/public/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 03 Feb 2025 14:36:32 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>




    <!-- تعريف الترميز -->
    <meta charset="UTF-8">

    <!-- متوافق مع الأجهزة المحمولة -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">



    <!-- الكلمات المفتاحية (لم تعد مؤثرة بشكل كبير في جوجل) -->







    @if ($page == 'courses_details')
        <meta name="keywords"
            content="TechBridge,اماكن تعليم برمجة في طنطا,تك بريدج, أكاديمية برمجة, كورسات برمجة, شركة برمجة في طنطا, اكاديمية برمجة في طنطا, كورسات في الغربية, سنتر برمجة, مركز كورسات, كرسات برمجة, أرشفة المواقع, برمجة مواقع, تعلم البرمجة">

        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ App::isLocale('en') ? $courses->title_en : $courses->title_ar }} </title>
        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        <meta name="description"
            content="{{ App::isLocale('en') ? $courses->meta_description_en : $courses->meta_description_ar }}">
        <!-- اسم الكاتب -->
        <meta name="author"
            content="@if (App::isLocale('en')) {!! $courses->user->name_en !!}@else{!! $courses->user->name_ar !!} @endif">
        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- تحسين السوشيال ميديا (Open Graph - Facebook, WhatsApp, Twitter, etc.) -->
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ App::isLocale('en') ? $courses->title_en : $courses->title_ar }}">
        <meta property="og:description"
            content="{{ App::isLocale('en') ? $courses->meta_description_en : $courses->meta_description_ar }}">
        <meta property="og:image" content="{{ asset('images/' . ($courses->photo ?? 'no-image.png')) }}">
        <meta property="og:site_name" content="{{ $settings->name }}">









        <!-- تحسين بيانات تويتر -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ App::isLocale('en') ? $courses->title_en : $courses->title_ar }}">
        <meta name="twitter:description"
            content="{{ App::isLocale('en') ? $courses->meta_description_en : $courses->meta_description_ar }}">
        <meta name="twitter:image" content="{{ asset('images/' . ($courses->photo ?? 'no-image.png')) }}">

        <meta name="twitter:site" content="{{ $settings->name }}">



        @php

            $meta_description = App::isLocale('en') ? $courses->meta_description_en : $courses->meta_description_ar;
        @endphp
        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ $settings->name }}",
  "url": "{{ url()->current() }}",
  "logo": "{{ $logo }}",
  "sameAs": [],
  "description": {!! json_encode($meta_description) !!}
}
</script>
    @elseif ($page == 'blog_details' && isset($blog))
        @php

            if (App::isLocale('en')) {
                $tags = json_decode($blog->tag_en, true);
            } else {
                $tags = json_decode($blog->tag_ar, true);
            }

        @endphp



        <meta name="keywords" content="@foreach ($tags as $tag){{ $tag['value'] . ',' }} @endforeach">

        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}
        </title>
        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        <meta name="dindexescription"
            content="{{ App::isLocale('en') ? $blog->meta_description_en : $blog->meta_description_ar }}">
        <!-- اسم الكاتب -->
        <meta name="author"
            content="@if (App::isLocale('en')) {!! $blog->user->name_en !!}@else{!! $blog->user->name_ar !!} @endif">
        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- تحسين بيانات المدونات -->
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}">
        <meta property="og:description"
            content="{{ App::isLocale('en') ? $blog->meta_description_en : $blog->meta_description_ar }}">
        <meta property="og:image" content="{{ asset('images/' . ($blog->photo ?? 'no-image.png')) }}">
        <meta property="og:site_name" content="{{ $settings->name }}">

        <!-- تحسين بيانات تويتر -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}">
        <meta name="twitter:description"
            content="{{ App::isLocale('en') ? $blog->meta_description_en : $blog->meta_description_ar }}">
        <meta name="twitter:image" content="{{ asset('images/' . ($blog->photo ?? 'no-image.png')) }}">
        <meta name="twitter:site" content="{{ $settings->name }}">
    @elseif ($page == 'contact')
        <meta name="keywords"
            content="TechBridge,اماكن تعليم برمجة في طنطا,تك بريدج, أكاديمية برمجة, كورسات برمجة, شركة برمجة في طنطا, اكاديمية برمجة في طنطا, كورسات في الغربية, سنتر برمجة, مركز كورسات, كرسات برمجة, أرشفة المواقع, برمجة مواقع, تعلم البرمجة">

        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ $metaData['title'] }} </title>

        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        <meta name="description" content="{{ $metaData['description'] }}">
        <!-- اسم الكاتب -->
        <meta name="author" content="{{ $settings->name }}">
        <!-- السماح أو منع محركات البحث من الأرشفة -->

        <meta name="robots" content="noindex, nofollow">
        <!-- القيم الافتراضية لباقي الصفحات -->
        <meta property="og:site_name" content="{{ $settings->name }}">
        <meta property="og:title" content="{{ $settings->name }} - {{ $metaData['title'] }}">
        <meta property="og:description" content="{{ $metaData['description'] }}">


        <!-- أيقونة الموقع (Favicon) -->
        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="shortcut icon"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

        <meta property="og:image:secure_url"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

        <meta property="og:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:type" content="image/jpeg">

        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ $settings->name }}",
  "url": "{{ url()->current() }}",
  "logo": "{{ asset('images/' . ($settings->photo ? $settings->photo : 'no-image.png')) }}",
  "sameAs": [],
  "description": {!! json_encode($metaData['description']) !!}
}
</script>
    @else
        <meta name="keywords"
            content="TechBridge,اماكن تعليم برمجة في طنطا,تك بريدج, أكاديمية برمجة, كورسات برمجة, شركة برمجة في طنطا, اكاديمية برمجة في طنطا, كورسات في الغربية, سنتر برمجة, مركز كورسات, كرسات برمجة, أرشفة المواقع, برمجة مواقع, تعلم البرمجة">

        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ $metaData['title'] }} </title>

        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        <meta name="description" content="{{ $metaData['description'] }}">
        <!-- اسم الكاتب -->
        <meta name="author" content="{{ $settings->name }}">
        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- القيم الافتراضية لباقي الصفحات -->
        <meta property="og:site_name" content="{{ $settings->name }}">
        <meta property="og:title" content="{{ $settings->name }} - {{ $metaData['title'] }}">
        <meta property="og:description" content="{{ $metaData['description'] }}">


        <!-- أيقونة الموقع (Favicon) -->
        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="shortcut icon"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

        <meta property="og:image:secure_url"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

        <meta property="og:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:type" content="image/jpeg">

        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ $settings->name }}",
  "url": "{{ url()->current() }}",
  "logo": "{{ asset('images/' . ($settings->photo ? $settings->photo : 'no-image.png')) }}",
  "sameAs": [],
  "description": {!! json_encode($metaData['description']) !!}
}
</script>
    @endif

    {{-- @dd($page) --}}






    <!-- تحديد اللغة -->
    <meta http-equiv="content-language" content="{{ $locale }}">

    <!-- أيقونة الموقع (Favicon) -->
    <link rel="icon" type="image/png"
        href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

    <!-- Canonical URL لمنع تكرار المحتوى -->
    <link rel="canonical" href="{{ url()->current() }}">









    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1628060343533989"
        crossorigin="anonymous"></script>























    <script src="{{ asset('web') }}/build/js/jquery-3.7.1.min.js"></script>



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/bootstrap.min.css">

    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/daterangepicker/daterangepicker.css">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/bootstrap-datetimepicker.min.css">

    <!-- Boxioons CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/boxicons/css/boxicons.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/fontawesome/css/all.min.css">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/feather.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/select2/css/select2.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/owl.theme.default.min.css">


    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/swiper/css/swiper.min.css">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/slick/slick-theme.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/feather/feather.css">

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/dropzone/dropzone.min.css">

    <!-- Aos CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/plugins/aos/aos.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/build/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <style>
        @media (max-width: 767.98px) {
            .des {
                display: block;
            }
        }

        @media (max-width: 991.98px) {
            .des {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .des {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header header-page">
            <div class="header-fixed">
                <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
                    <div class="container">
                        <div class="navbar-header">
                            <a id="mobile_btn">
                                <span class="bar-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                            <a href="{{ route('index') }}" class="navbar-brand logo">
                                <img src="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}"
                                    class="img-fluid" style="width:auto;height:54px" alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                            </a>
                            <ul
                                class="nav  header-navbar-rht des position-absolute {{ App::isLocale('ar') ? 'start-0' : 'end-0' }} me-2 ms-2">
                                <li class="{{ App::isLocale('ar') ? 'ms-2' : '' }}">
                                    @if (App::isLocale('en'))
                                        <a style=" min-width:50px" class="nav-link header-login"
                                            href="{{ route('language', 'ar') }}">
                                            ar
                                        </a>
                                    @else
                                        <a style="min-width:50px" class="nav-link header-login"
                                            href="{{ route('language', 'en') }}">
                                            en
                                        </a>
                                    @endif
                                </li>
                                <li class="nav-item ">
                                    <div>
                                        <a id="dark-mode-toggle1" class="dark-mode-toggle">
                                            <i class="fa-solid fa-moon"></i>
                                        </a>
                                        <a id="light-mode-toggle1" class="dark-mode-toggle">
                                            <i class="fa-solid fa-sun"></i>
                                        </a>
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <div class="main-menu-wrapper">
                            <div class="menu-header">
                                <a href="{{ route('index') }}" class="menu-logo">
                                    <img src="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}"
                                        class="img-fluid" style="width:auto;height:54px"
                                        alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                </a>
                                <a id="menu_close" class="menu-close">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                            <ul class="main-nav">
                                <li class="has-submenu   {{ request()->is('/') ? 'active' : '' }}">
                                    <a href="{{ route('index') }}">{{ __('web.home') }}</a>
                                </li>

                                <li class="has-submenu   {{ request()->is('#course') ? 'active' : '' }}">
                                    <a href="{{ route('index') }}#course">{{ __('web.courses') }}</a>
                                </li>

                                {{-- <li class="has-submenu   {{ request()->is('#Instructor') ? 'active' : '' }}">
                                    <a href="{{ route('index') }}#Instructor">{{ __('web.Instructors') }}</a>
                                </li> --}}

                                <li class="has-submenu   {{ request()->is('gallary') ? 'active' : '' }}">
                                    <a href="{{ route('gallary') }}">{{ __('web.Media') }}</a>
                                </li>

                                <li class="has-submenu   {{ request()->is('#Reviews') ? 'active' : '' }}">
                                    <a href="{{ route('index') }}#Reviews">{{ __('web.reviews') }}</a>
                                </li>

                                <li class="has-submenu   {{ request()->is('#about') ? 'active' : '' }}">
                                    <a href="{{ route('index') }}#about">{{ __('web.about_us') }}</a>
                                </li>

                                <li class="has-submenu   {{ request()->is('faq') ? 'active' : '' }}">
                                    <a href="{{ route('faq') }}">{{ __('web.faq') }}</a>
                                </li>

                                <li class="has-submenu   {{ request()->is('contact') ? 'active' : '' }}">
                                    <a href="{{ route('contact') }}">{{ __('web.contact_us') }}</a>
                                </li>





                                <li class="login-link">
                                    <a href="{{ route('customer.login') }}">{!! __('web.login') !!}</a>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav header-navbar-rht">
                            <li class="nav-item">
                                @if (App::isLocale('en'))
                                    <a href="{{ route('language', 'ar') }}">
                                        ar
                                    </a>
                                @else
                                    <a href="{{ route('language', 'en') }}">
                                        en
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item {{ App::isLocale('ar') ? 'ms-2' : '' }}">
                                <div>


                                    <a id="dark-mode-toggle" class="dark-mode-toggle  ">
                                        <i class="fa-solid fa-moon"></i>
                                    </a>
                                    <a id="light-mode-toggle" class="dark-mode-toggle ">
                                        <i class="fa-solid fa-sun"></i>
                                    </a>
                                </div>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link header-login"
                                    href="{{ route('customer.login') }}">{!! __('web.login') !!}</a>

                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- /Header -->

        {{-- ###################################################################content######################################################## --}}


        @yield('content')

        {{-- ###################################################################End content######################################################## --}}
        @if (session('success'))
            <script>
                $(document).ready(function() {
                    toastr.success("{{ session('success') }}", "نجاح", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 8000,
                        positionClass: "toast-bottom-left",
                    });
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                $(document).ready(function() {
                    toastr.error("{{ session('error') }}", "خطأ", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 8000,
                        positionClass: "toast-bottom-left",
                    });
                });
            </script>
        @endif

        @if ($errors->any())
            {{-- @dd($errors) --}}
            @foreach ($errors->all() as $error)
                <script>
                    $(document).ready(function() {
                        toastr.error("{{ $error }}", "خطأ", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 8000,
                            positionClass: "toast-bottom-left",
                        });
                    });
                </script>
            @endforeach
        @endif

        <!-- Footer -->
        <footer class="footer trend-course">

            <!-- Footer Top -->
            <div class="footer-top">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-6 col-md-6 d-flex justify-content-center flex-column">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img src="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}"
                                        alt="{!! App::isLocale('en') ? $meta->index_description_en : $meta->index_description_ar !!}">
                                </div>
                                <div class="footer-about-content">
                                    <p>
                                        {{ __('web.We at Tech Bridge believe that learning programming is the key to the future. Join us today and start your journey to mastery in the world of technology.') }}
                                    </p>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        {{-- <div class="col-lg-2 col-md-6 d-flex justify-content-center flex-column">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Instructor</h2>
                            <ul>
                                <li><a href="instructor-profile.html">Profile</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="instructor-list.html">Instructor</a></li>
                                <li><a href="instructor-dashboard.html"> Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-2 col-md-6 d-flex justify-content-center flex-column">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Student</h2>
                            <ul>
                                <li><a href="student-profile.html">Profile</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="students-list.html">Student</a></li>
                                <li><a href="student-dashboard.html"> Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div> --}}

                        <div class="col-lg-6 col-md-6 d-flex justify-content-center flex-column">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-contact ">
                                {{-- <h2 class="footer-title">{{ __('web.subscribe') }}</h2>
                            <div class="news-letter">

                                <form class="newsletter-form" action="{{ route('subscribe.store') }}"
                                    method="post">
                                    @csrf
                                    @method('post')

                                    <input type="email" class="form-control"
                                        placeholder="{!! __('web.email') !!}" name="email" required
                                        autocomplete="off">
                                    <br>
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit"
                                            class="form-control btn submit-btn">{{ __('web.subscribe_n') }}</button>
                                        <div id="validator-newsletter" class="form-result"></div>
                                    </div>

                                </form>

                            </div> --}}
                                <div class="footer-contact-info text-start">
                                    <div class="footer-address d-flex align-items-center">
                                        <img src="{{ asset('web') }}/build/img/icon/icon-20.svg" alt=""
                                            class="img-fluid">
                                        <p> {{ $settings->location }} </p>
                                    </div>
                                    <p class="d-flex align-items-center">
                                        <img src="{{ asset('web') }}/build/img/icon/icon-19.svg" alt=""
                                            class="img-fluid">
                                        <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center">
                                        <img style="width: 26px;"
                                            src="{{ asset('web') }}/build/img/icon/whatsapp.svg" alt=""
                                            class="img-fluid">
                                        <a href="https://wa.me/{{ $settings->phone }}">{{ $settings->phone }}</a>
                                    </p>
                                    <p class="mb-0 mt-2  -1 d-flex align-items-center">
                                        <img style="width: 20px;"
                                            src="{{ asset('web') }}/build/img/icon/fb-icon.svg" alt=""
                                            class="img-fluid  @if (App::isLocale('ar')) {{ 'ms-2' }} @endif ">
                                        <a target="_blank" href="{{ $settings->facebook }}"> {{ $settings->name }}
                                        </a>
                                    </p>
                                </div>

                            </div>
                            <!-- /Footer Widget -->

                        </div>

                    </div>
                </div>
            </div>
            <!-- /Footer Top -->


            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">

                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="privacy-policy">
                                    {{-- <ul>
                                    <li><a href="{{ route('terms') }}">Terms</a></li>
                                    <li><a href="{{ route('policy') }}">Privacy</a></li>
                                </ul> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="copyright-text">
                                    <p class="mb-0">&copy;
                                        <script data-cfasync="false" src="{{ asset('web') }}/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
                                        </script>
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> {{ $settings->name }}. All rights
                                        reserved.
                                        <a href="https://www.facebook.com/basharessam11" target="_blank"
                                            class="footer-link fw-bolder"> © made with by bashar essam❤️
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->

                </div>
            </div>
            <!-- /Footer Bottom -->

        </footer>
        <!-- /Footer -->
    </div>
    <!-- /Main Wrapper -->







    <!-- زر واتساب عائم -->
    <a href="https://wa.me/{{ $settings->phone }}" class="whatsapp-float" target="_blank"
        title="تواصل معنا على واتساب">
        <img src="{{ asset('images') }}/whatsapp.png" alt="WhatsApp">
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 47px;
            right: 33px;
            z-index: 1000;
            cursor: pointer;
        }

        .whatsapp-float img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }

        .whatsapp-float img:hover {
            transform: scale(1.1);
        }
    </style>





    <!-- jQuery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ asset('web') }}/build/js/bootstrap.bundle.min.js"></script>

    <!-- counterup JS -->
    <script src="{{ asset('web') }}/build/js/jquery.waypoints.js"></script>
    <script src="{{ asset('web') }}/build/js/jquery.counterup.min.js"></script>
    <!-- Swiper JS -->
    <script src="{{ asset('web') }}/build/plugins/swiper/swiper.min.js"></script>
    <!-- Slimscroll JS -->
    <script src="{{ asset('web') }}/build/js/jquery.slimscroll.min.js"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('web') }}/build/plugins/select2/js/select2.min.js"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('web') }}/build/js/owl.carousel.min.js"></script>

    <!-- Slick Slider -->
    <script src="{{ asset('web') }}/build/plugins/slick/slick.js"></script>

    <!-- Aos -->
    <script src="{{ asset('web') }}/build/plugins/aos/aos.js"></script>

    <!-- Ckeditor JS -->
    <script src="{{ asset('web') }}/build/js/ckeditor.js"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{ asset('web') }}/build/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

    <!-- Swiper Slider -->
    <script src="{{ asset('web') }}/build/plugins/swiper/js/swiper.min.js"></script>

    <!-- Feature JS -->
    <script src="{{ asset('web') }}/build/plugins/feather/feather.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('web') }}/build/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="{{ asset('web') }}/build/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Chart JS -->
    <script src="{{ asset('web') }}/build/plugins/apexchart/apexcharts.min.js"></script>
    <script src="{{ asset('web') }}/build/plugins/apexchart/chart-data.js"></script>

    <!-- Progress JS -->
    <script src="{{ asset('web') }}/build/js/circle-progress.min.js"></script>

    <!-- Dropzone JS -->
    <script src="{{ asset('web') }}/build/plugins/dropzone/dropzone.min.js"></script>

    <!-- Validation-->
    <script src="{{ asset('web') }}/build/js/validation.js"></script>

    <!-- Daterangepicker JS -->
    <script src="{{ asset('web') }}/build/js/moment.min.js"></script>
    <script src="{{ asset('web') }}/build/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Datepicker JS -->
    <script src="{{ asset('web') }}/build/js/moment.min.js"></script>
    <script src="{{ asset('web') }}/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Theme Settings Js -->
    <script src="{{ asset('web') }}/build/js/theme-script.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('web') }}/build/js/script.js"></script>

    <script src="{{ asset('web') }}/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="9d9fdcda5d1713fc8111f8e4-|49"></script>
    <script>
        $(document).ready(function() {
            $(".rate i").on("click", function() {
                const value = $(this).data("value");

                $(".rate i").removeClass("fas fa-star filled").addClass("fas fa-star");

                $(this).prevAll().addBack().removeClass("fas fa-star").addClass("fas fa-star filled");

                $("#rating-value").val(value);
            });


        });
    </script>
</body>


<!-- Mirrored from dreamslms.dreamstechnologies.com/laravel/public/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 03 Feb 2025 14:37:30 GMT -->

</html>
