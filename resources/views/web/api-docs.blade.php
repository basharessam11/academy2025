@php
    use App\Models\Setting;
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

    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h1 class="mb-0">Academy API Documentation</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Banner -->

    <style>
        body {
            font-family: 'Cairo', Arial, sans-serif;
            background: #f7f7f7;
        }

        .api-docs {

            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px #0001;
            padding: 40px;
        }

        .api-docs h1,
        .api-docs h2 {
            color: #1a237e;
        }

        code,
        pre {
            background: #f0f0f0;
            border-radius: 6px;
            padding: 10px;
            display: block;
            overflow-x: auto;
            font-size: 14px;
            line-height: 1.5;
        }

        .endpoint {
            background: #e3f2fd;
            border-right: 5px solid #1976d2;
            margin: 32px 0;
            padding: 20px;
            border-radius: 6px;
        }

        .endpoint h3 {
            margin-top: 0;
        }

        .note {
            color: #666;
            font-size: 0.95em;
        }

        /* اللوجو في النص */
        .header-link {
            display: block;
            text-align: center;
            margin-bottom: 30px;
        }

        .header-link img {
            height: 60px;
            width: auto;
        }
    </style>

    <div class="page-content">
        <div class="container">
            <div class="api-docs">

                <p>مرحبًا بك في صفحة التوثيق الرسمية لواجهات برمجة التطبيقات الخاصة بمشروع الأكاديمية.</p>
                <hr>

                <!-- Endpoint 1 -->
                <div class="endpoint">
                    <h3>1. جلب جميع العملاء</h3>
                    <b>GET</b> <code>{{ url('/api/customers') }}</code>
                    <br>
                    <p>يعيد جميع العملاء من جدول Temp.</p>
                    <pre dir="ltr">response:
[
  {
    "id": 34,
    "name": "مصطفي السيد",
    "email": "basharessam33@gmail.com",
    "password": "$2y$12$...",
    "status": "1",
    "phone": "01064696893",
    "age": 22,
    "photo": null,
    "deleted_at": null,
    "created_at": "2024-12-11T20:30:03.000000Z",
    "updated_at": "2025-03-11T18:37:35.000000Z"
  }
]</pre>
                </div>

                <!-- Endpoint 2 -->
                <div class="endpoint">
                    <h3>2. إضافة عميل جديد</h3>
                    <b>POST</b> <code>{{ url('/api/customers/post') }}</code>
                    <br>

                    <p>إنشاء عميل جديد مع التحقق من صحة البيانات.</p>
                    <b>المعطيات المطلوبة:</b>
                    <ul>
                        <li>name (نص، مطلوب)</li>
                        <li>email (بريد إلكتروني، مطلوب)</li>
                        <li>password (نص، مطلوب، 6 أحرف على الأقل)</li>
                        <li>phone (نص، مطلوب)</li>
                        <li>age (عدد صحيح، مطلوب)</li>
                        <li>status (0 أو 1، اختياري)</li>
                    </ul>
                    <br>
                    <pre dir="ltr">response:
{
  "name": "مصطفي السيد",
  "email": "basharessam33@gmail.com",
  "password": 123456789,
  "phone": "01064696893",
  "age": 22
}</pre>
                </div>

                <hr>
                <h2>ملاحظات</h2>
                <ul>
                    <li>جميع الاستجابات بصيغة JSON.</li>
                </ul>
                <hr>

                <p class="note">لأي استفسار أو مشاكل في استخدام الـ API يرجى التواصل مع فريق التطوير.</p>
                <p class="note" dir="ltr">
                    <script data-cfasync="false" src="{{ asset('web') }}/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
                    </script>
                    <script>
                        document.write(new Date().getFullYear())
                    </script> {{ $settings->name }}. All rights
                    reserved.
                    <a href="https://www.facebook.com/basharessam11" target="_blank" class="footer-link fw-bolder"> © made
                        with by bashar essam❤️
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
