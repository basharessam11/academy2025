@php
    use App\Models\Setting;
    use App\Models\Meta;
    $locale = App::currentLocale();
    $settings = Setting::find(1);
    $page = Route::currentRouteName();
    $meta = Meta::first();

    $metaData = $meta->getMeta($page, $locale);

@endphp


<!DOCTYPE html>
<html lang="{{ $locale }}">
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
    <meta name="keywords"
        content="تعلم البرمجة من الصفر, كورسات برمجة شاملة, أكاديمية Tech Bridge, دورة Full Stack, برمجة الويب, تطوير مواقع احترافية, تعلم HTML و CSS, JavaScript و jQuery, AJAX و Bootstrap, تعلم PHP و MySQL, كورس Laravel للمبتدئين, احتراف OOP PHP, GitHub للمبرمجين, كورس العمل الحر للمبرمجين, كيف تصبح مبرمجًا ناجحًا, كورسات برمجة أونلاين, تطوير التطبيقات, أساسيات البرمجة, مشاريع برمجية حقيقية, أفضل دورات البرمجة, شهادة معتمدة في البرمجة, تعلم البرمجة بطريقة عملية, وظائف برمجة للمبتدئين, كيف تحصل على أول مشروع برمجي">









    @if ($page == 'courses_details')
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
    @elseif ($page == 'blog_details')
        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}
        </title>
        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        <meta name="description"
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
    @else
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
        <meta property="og:title" content="{{ $settings->default_title }}">
        <meta property="og:description" content="{{ $settings->default_description }}">
        <meta property="og:image" content="{{ asset('images/' . ($settings->photo ?? 'no-image.png')) }}">
    @endif








    <!-- تحديد اللغة -->
    <meta http-equiv="content-language" content="{{ $locale }}">

    <!-- أيقونة الموقع (Favicon) -->
    <link rel="icon" type="image/png"
        href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

    <!-- Canonical URL لمنع تكرار المحتوى -->
    <link rel="canonical" href="{{ route('home') }}">















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


<!-- Adsense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1628060343533989"
        crossorigin="anonymous"></script>


</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper log-wrap">
        <div class="row">
            <!-- Login Banner -->
            <div class="col-md-6 login-bg">
                <div class="owl-carousel login-slide owl-theme">
                    <div class="welcome-login">
                        <div class="login-banner">
                            <img src="{{ asset('web') }}/build/img/login-img.png" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>{{ __('web.Welcome To Tech Bridge') }}</h2>
                            <p>
                                {{ __('web.We at Tech Bridge believe that learning programming is the key to the future. Join us today and start your journey to mastery in the world of technology.') }}
                            </p>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /Login Banner -->
            <div class="col-md-6 login-wrap-bg">
                <!-- Login -->
                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="w-100">
                            <div class="img-logo">
                                <img src="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}"
                                    class="img-fluid" alt="Logo">
                                <div class="back-home">
                                    <a href="{{ route('index') }}">Back to Home</a>
                                </div>
                            </div>
                            <h1>{!! __('admin.login_d') !!}</h1>
                            <form class="space-y-4" method="POST" action="{{ route('customer.login1') }}">
                                @csrf






                                <div class="input-block">
                                    <label class="form-control-label">{!! __('web.email') !!}</label>
                                    <input type="email" class="form-control" placeholder="admin@example.com"
                                        name="email" id="email">
                                    <div class="text-danger pt-2">
                                    </div>
                                </div>
                                <div class="input-block">
                                    <label class="form-control-label">{!! __('web.password') !!}</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" placeholder="12345678"
                                            name="password" id="password">
                                        <span class="feather-eye-off toggle-password"></span>
                                        <div class="text-danger pt-2">
                                        </div>
                                    </div>
                                </div>


                                <div class="d-grid">
                                    <!-- Displaying Errors -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <button class="btn btn-primary btn-start"
                                        type="submit">{!! __('web.login') !!}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /Login -->

            </div>

        </div>
    </div>
    <!-- /Main Wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('web') }}/build/js/jquery-3.7.1.min.js"></script>


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


    <!-- Custom JS -->
    <script src="{{ asset('web') }}/build/js/script.js"></script>

    <script src="{{ asset('web') }}/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="56c426cbe3a2db6228fee3b8-|49" defer></script>

</body>


<!-- Mirrored from dreamslms.dreamstechnologies.com/laravel/public/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 03 Feb 2025 14:41:18 GMT -->

</html>
