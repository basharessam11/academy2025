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
                                <li class="breadcrumb-item">Privacy Policy</li>
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
                    <h1 class="mb-0">Privacy Policy</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Help Details -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-content">

                        @if (App::isLocale('en'))
                            <p>{!! $policy->description_en !!}</p>
                        @else
                            <p>{!! $policy->description_ar !!}</p>
                        @endif


                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Help Details -->
@endsection
