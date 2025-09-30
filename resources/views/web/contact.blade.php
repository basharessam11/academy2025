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
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item">Pages</li>
                                <li class="breadcrumb-item">{!! __('web.contact_us') !!}</li>
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
                    <h1 class="mb-0">{!! __('web.contact_us') !!}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Help Details -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8 mx-auto">
                    <div class="support-wrap">
                        <h5>{!! __('web.contact_us') !!}</h5>

                        <form id="contactForm" action="{{ route('contact.store') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="input-block  col-md-6">
                                    <label>{!! __('web.name') !!}</label>
                                    <input name="name" type="text" class="form-control"
                                        placeholder="{!! __('web.name') !!}">
                                </div>
                                <div class="input-block col-md-6">
                                    <label>{!! __('web.email') !!}</label>
                                    <input name="email" type="text" class="form-control"
                                        placeholder="{!! __('web.email') !!}">
                                </div>
                                <div class="input-block col-md-6">
                                    <label>{!! __('web.phone') !!}</label>
                                    <input name="phone" type="text" class="form-control"
                                        placeholder="{!! __('web.phone') !!}">
                                </div>
                                <div class="input-block col-md-6">
                                    <label>{!! __('web.subject') !!}</label>
                                    <input name="subject" type="text" class="form-control"
                                        placeholder="{!! __('web.subject') !!}">
                                </div>
                                <div class="input-block col-md-12">
                                    <label>{!! __('web.message') !!}</label>
                                    <textarea name="message" class="form-control" placeholder="{!! __('web.message') !!}" rows="4"></textarea>
                                </div>
                                <div class="input-block col-md-3">
                                    <button class="btn btn-submit">{!! __('web.send_message') !!} </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Help Details -->
@endsection
