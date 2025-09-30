@extends('web.layouts.app')

@section('content')
    @php
        use App\Models\Setting;
        $locale = App::currentLocale();
        $settings = Setting::find(1);

        $date = \Carbon\Carbon::parse($blog->created_at);
        $formattedDate = $date->format('M d, Y'); // مثال: May 20, 2022
        $slug = App::isLocale('en') ? $blog->slug_en : $blog->slug_ar;
    @endphp

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('web.home') }}</a></li>
                                <li class="breadcrumb-item">{!! __('web.Blog Details') !!}</li>
                                <li class="breadcrumb-item" aria-current="page">
                                    {{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Blog Details -->
    <section class="course-content">
        
        <!-- إعلان أعلى المقال -->
        <ins class="adsbygoogle"
            style="display:block; text-align:center; margin:20px 0;"
            data-ad-client="ca-pub-1628060343533989"
            data-ad-slot="3231735129"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

        <div class="row" style="padding: 50px;">
            <div class="col-lg-9 col-md-12" style="background-color: #fff">

                <!-- Blog Post -->
                <div class="blog">
                    <div class="blog-image mt-2" style="padding: 20px !important">
                        <a href="{{ asset('images') }}/{{ $blog->photo ?? 'no-image.png' }}">
                            <img class="img-fluid" style="height: 340px"
                                 src="{{ asset('images') }}/{{ $blog->photo ?? 'no-image.png' }}"
                                 alt="{{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}">
                        </a>
                    </div>

                    <div class="blog-info clearfix">
                        <div class="post-left">
                            <ul>
                                <li>
                                    <div class="post-author @if (App::isLocale('en')) ms-4 @endif">
                                        <a>
                                            <img src="{{ asset('images') }}/{{ $blog->user->photo ?? 'no-image.png' }}"
                                                 alt="{{ App::isLocale('en') ? $blog->user->name_en : $blog->user->name_ar }}">
                                            <span>{{ App::isLocale('en') ? $blog->user->name_en : $blog->user->name_ar }}</span>
                                        </a>
                                    </div>
                                </li>
                                <li><img class="img-fluid" src="{{ asset('web') }}/build/img/icon/icon-22.svg" alt="">{{ $formattedDate }}</li>
                                <li><img class="img-fluid" src="{{ asset('web') }}/build/img/icon/icon-23.svg" alt="">
                                    {{ App::isLocale('en') ? $blog->category->title_en : $blog->category->title_ar }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h1 class="blog-title mt-2" style="padding: 20px !important">
                        {{ App::isLocale('en') ? $blog->title_en : $blog->title_ar }}
                    </h1>

                    <!-- إعلان بعد العنوان -->
                    <ins class="adsbygoogle"
                        style="display:block; text-align:center; margin:20px 0;"
                        data-ad-client="ca-pub-1628060343533989"
                        data-ad-slot="3231735129"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

                    <div class="blog-content mt-2" style="padding: 20px !important">
                        @foreach ($blog->blogDescription as $item)
                            <h3>{{ App::isLocale('en') ? $item->title_en : $item->title_ar }}</h3>
                            <p style="font-size: 18px; color:black">
                                {!! App::isLocale('en') ? $item->description_en : $item->description_ar !!}
                            </p>
                        @endforeach
                    </div>

                    <!-- مشاركة -->
                    <div class="row gx-2">
                        <h5>{{ __('web.Share Blog') }}</h5>
                        <div class="col-md-1">
                            <a class="btn btn-wish w-100" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog_details', $blog->slug_en)) }}" target="_blank">
                                <i class='bx bxl-facebook'></i>
                            </a>
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-wish w-100" href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog_details', $blog->slug_en)) }}&text={{ urlencode($blog->title) }}" target="_blank">
                                <i class='bx bxl-twitter'></i>
                            </a>
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-wish w-100" href="https://www.instagram.com/" target="_blank">
                                <i class='bx bxl-instagram'></i>
                            </a>
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-wish w-100" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog_details', $blog->slug_en)) }}&title={{ urlencode($blog->title) }}&summary={{ urlencode($blog->description) }}" target="_blank">
                                <i class='bx bxl-linkedin'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Blog Post -->
            </div>

            <!-- Blog Sidebar -->
            <div class="col-lg-3 col-md-12 sidebar-right theiaStickySidebar">

                <!-- Recent Posts -->
                <div class="card post-widget blog-widget">
                    <div class="card-header">
                        <h4 class="card-title">Recent Posts</h4>
                    </div>
                    <div class="card-body">
                        <ul class="latest-posts">
                            @foreach ($recentblogs as $blog1)
                                @php
                                    $date = \Carbon\Carbon::parse($blog1->created_at);
                                    $formattedDate = $date->format('M d, Y');
                                    $slug = App::isLocale('en') ? $blog1->slug_en : $blog1->slug_ar;
                                @endphp

                                <li>
                                    <div class="post-thumb">
                                        <a href="{{ route('blog_details', $slug) }}">
                                            <img class="img-fluid"
                                                 src="{{ asset('images') }}/{{ $blog1->photo ?? 'no-image.png' }}"
                                                 alt="{{ App::isLocale('en') ? $blog1->title_en : $blog1->title_ar }}">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
                                            <a href="{{ route('blog_details', $slug) }}">
                                                {{ App::isLocale('en') ? $blog1->title_en : $blog1->title_ar }}
                                            </a>
                                        </h4>
                                        <p>
                                            <img class="img-fluid" src="{{ asset('web') }}/build/img/icon/icon-22.svg" alt="">
                                            {{ $formattedDate }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- إعلان جانبي -->
                <ins class="adsbygoogle"
                    style="display:block; text-align:center; margin:20px 0;"
                    data-ad-client="ca-pub-1628060343533989"
                    data-ad-slot="3231735129"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

                <!-- Tags -->
                <div class="card tags-widget blog-widget tags-card">
                    <div class="card-header">
                        <h4 class="card-title">{!! __('web.Tag:') !!}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="tags">
                            @php
                                $tags = App::isLocale('en') ? json_decode($blog->tag_en, true) : json_decode($blog->tag_ar, true);
                            @endphp
                            @foreach ($tags as $tag)
                                <li><a href="javascript:void(0);" class="tag">{{ $tag['value'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- إعلان أسفل التاجات -->
                <ins class="adsbygoogle"
                    style="display:block; text-align:center; margin:20px 0;"
                    data-ad-client="ca-pub-1628060343533989"
                    data-ad-slot="3231735129"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
            <!-- /Blog Sidebar -->
        </div>
    </section>
    <!-- /Blog Details -->
@endsection
