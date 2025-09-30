@php
    $locale = App::currentLocale();
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
                                <li class="breadcrumb-item">FAQ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Breadcrumb -->
    <div class="page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h1 class="mb-0">{!! __('web.home_faq') !!}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Help Details -->
    <div class="help-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="help-title">
                        <h1>{!! __('web.home_faq') !!}</h1>
                        <p>{!! __('web.faq_d') !!}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @for ($i = 0; $i < ceil($faqs->count() / 2); $i++)
                        <!-- Faq -->
                        <div class="faq-card">
                            <h6 class="faq-title">
                                <a class="collapsed" data-bs-toggle="collapse" href="#faq{{ $i }}"
                                    aria-expanded="false">
                                    @if (App::isLocale('en'))
                                        {!! $faqs[$i]->title_en !!}
                                    @else
                                        {!! $faqs[$i]->title_ar !!}
                                    @endif
                                </a>
                            </h6>
                            <div id="faq{{ $i }}" class="collapse">
                                <div class="faq-detail">
                                    <p>
                                        @if (App::isLocale('en'))
                                            {!! $faqs[$i]->description_en !!}
                                        @else
                                            {!! $faqs[$i]->description_ar !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endfor





                </div>

                <div class="col-lg-6">
                    @for ($i = ceil($faqs->count() / 2); $i < $faqs->count(); $i++)
                        <!-- Faq -->
                        <div class="faq-card">
                            <h6 class="faq-title">
                                <a class="collapsed" data-bs-toggle="collapse" href="#faq{{ $i }}"
                                    aria-expanded="false">
                                    @if (App::isLocale('en'))
                                        {!! $faqs[$i]->title_en !!}
                                    @else
                                        {!! $faqs[$i]->title_ar !!}
                                    @endif
                                </a>
                            </h6>
                            <div id="faq{{ $i }}" class="collapse">
                                <div class="faq-detail">
                                    <p>
                                        @if (App::isLocale('en'))
                                            {!! $faqs[$i]->description_en !!}
                                        @else
                                            {!! $faqs[$i]->description_ar !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endfor




                </div>
            </div>
        </div>
    </div>
    <!-- /Help Details -->
@endsection
