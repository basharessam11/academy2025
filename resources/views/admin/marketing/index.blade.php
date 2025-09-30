@extends('admin.layout.app')

@section('page', 'Marketing Clients')

@section('contant')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Order List Widget -->

            <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">

                            <div class="col-sm-6 col-lg-4">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $month }}</h3>
                                        <p class="mb-0">{!! __('admin.Monthly') !!}</p>
                                    </div>
                                    <div class="avatar me-lg-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-double bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none">
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div
                                    class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                    <div>
                                        <h3 class="mb-2">{{ $today }}</h3>
                                        <p class="mb-0">{!! __('admin.Today') !!}</p>
                                    </div>
                                    <div class="avatar me-sm-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-wallet bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h3 class="mb-2">{{ $yesterday }}</h3>
                                        <p class="mb-0">{!! __('admin.Yesterday') !!}</p>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-error-alt bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marketing Clients Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{!! __('admin.Marketing') !!}</h5>

                    {{-- Alerts --}}
                    @if (session('success'))
                        <div id="success-message" class="alert alert-success alert-dismissible fade show text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div id="danger-message" class="alert alert-danger alert-dismissible fade show text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="card-body">


                    <div id="products-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header d-flex border-top rounded-0 flex-wrap py-md-0">

                            {{-- Filter --}}
                            <form method="GET" action="{{ route('marketing.index') }}">
                                <div class="row g-2 mb-4"> <!-- أضف g-2 لزيادة المسافات -->


                                    <!-- البحث العام -->
                                    <div class="col-12 col-md-6 col-lg-2 d-flex align-items-end">
                                        <input type="search" name="search" value="{{ request('search') }}"
                                            class="form-control" placeholder="بحث">
                                    </div>
                                    <!-- التاريخ من -->
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <label class="form-label">من</label>
                                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                                            class="form-control">
                                    </div>

                                    <!-- التاريخ إلى -->
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <label class="form-label">إلى</label>
                                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                                            class="form-control">
                                    </div>

                                    <!-- البحث بالصلاحيات -->
                                    <div class="col-12 col-md-6 col-lg-3 d-flex align-items-end">

                                        <select name="user_id" class="form-select  select2  " style="min-width: 200px;">
                                            <option value="all">الكل (كل المستخدمين)</option>

                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name_ar }}</option>
                                            @endforeach
                                            {{-- ضيف أي صلاحيات إضافية حسب النظام --}}
                                        </select>
                                    </div>

                                    <!-- زر البحث -->
                                    <div class="col-12 col-md-6 col-lg-2 d-flex align-items-end">
                                        <button type="submit"
                                            class="btn btn-primary w-100 mt-4">{!! __('admin.Submit') !!}</button>
                                    </div>

                                </div>
                            </form>

                            <!-- زر إضافة عميل -->
                            <div class="mb-3 text-end">
                                @if (auth()->user()->hasRole(['admin', 'marketing', 'marketing user']))
                                    <a href="{{ route('client.form', auth()->user()->id) }}" target="_blank"
                                        class="btn btn-success">
                                        <i class="bx bx-plus"></i> إضافة عميل
                                    </a>

                                    <a onclick="copyToClipboard('{{ route('client.form', auth()->user()->id) }}')"
                                        class="btn btn-success">
                                        <i class="bx bx-copy"></i>
                                    </a>
                                @endif

                                @canany(['delete marketing'])
                                    <button class="btn btn-secondary add-new btn-danger de me-3" tabindex="0"
                                        aria-controls="products-table" type="button" data-bs-toggle="modal"
                                        data-bs-target="#basicModal2" style="display:none"><span><i
                                                class="bx bx-trash"></i><span
                                                class="d-none d-sm-inline-block">{{ __('admin.Delete') }}
                                            </span></span></button>
                                @endcanany

                            </div>

                        </div>


                    </div>
                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="clients-table"
                            class="datatables-products table border-top dataTable no-footer dtr-column">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>#</th>
                                    <th>{!! __('admin.full_name') !!}</th>
                                    <th> {!! __('admin.location') !!}</th>
                                    <th> {!! __('admin.phone_call') !!}</th>
                                    <th> {!! __('admin.contact_method') !!}</th>
                                    <th> {!! __('admin.education') !!}</th>
                                    <th> {!! __('admin.marketer') !!}</th>
                                    @if (auth()->user()->hasRole(['admin', 'call center']))
                                        @canany(['create marketing'])
                                            <th> {!! __('admin.Note') !!}</th>
                                            <th> {!! __('admin.Status') !!}</th>
                                        @endcanany
                                    @endif
                                    <th class="text-center">{!! __('admin.Actions') !!}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $client->id }}"
                                                onclick="data('dt-checkboxes')" class="dt-checkboxes form-check-input">

                                        </td>
                                        <td>
                                            <input type="checkbox" value="{{ $client->id }}"
                                                onclick="data('dt-checkboxes')" class="dt-checkboxes form-check-input">

                                        </td>
                                        <td>{{ $clients->firstItem() + $loop->index }}</td>

                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->location }}</td>
                                        <td><a href="tel:{{ $client->phone }}">{{ $client->phone }}</a></td>
                                        <td>
                                            @if ($client->contact_method == 1)
                                                <span class="badge bg-success"><i class="bx bxl-whatsapp"></i>
                                                    واتساب</span>
                                            @elseif ($client->contact_method == 2)
                                                <span class="badge bg-primary"><i class="bx bx-phone"></i> مكالمة</span>
                                            @else
                                                <span class="badge bg-info"><i class="bx bx-chat"></i> كلاهما</span>
                                            @endif
                                        </td>
                                        <td>{{ $client->education }}</td>
                                        <td>{{ $client->user->name_ar ?? '-' }}</td>
                                        @if (auth()->user()->hasRole(['admin', 'call center']))
                                            @canany(['create marketing'])
                                                <td>{{ $client->note }}</td>
                                                <td>
                                                    @if ($client->status == 1)
                                                        <span class="badge bg-success"><i class="bx bx-chat"></i>
                                                            تم التواصل</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bx bx-chat"></i> لم يتم
                                                            التواصل</span>
                                                    @endif
                                                </td>
                                            @endcanany
                                        @endif
                                        <td>
                                            <div class="d-flex gap-2">
                                                @canany(['edit marketing'])
                                                    <a href="{{ route('marketing.edit', $client->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                @endcanany
                                                @if (auth()->user()->hasRole(['admin', 'call center']))
                                                    @canany(['create marketing'])
                                                        <button class="btn btn-sm btn-secondary note"
                                                            id="{{ $client->id }}" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#basicModal3">
                                                            <i class="bx bx-note"></i>
                                                        </button>
                                                    @endcanany
                                                @endif

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Pagination -->
                    <div class="row mx-2">
                        {{ $clients->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    <script>
                        $(document).ready(function() {
                            var table = $('#clients-table').DataTable({
                                columnDefs: [{
                                        targets: -1, // آخر عمود
                                        orderable: false, // 🚫 وقف الترتيب
                                        searchable: false // 🚫 وقف البحث عليه كمان
                                    }, {
                                        className: "control",
                                        searchable: false,
                                        orderable: false,
                                        responsivePriority: 2,
                                        targets: 0,
                                        render: function(t, e, s, a) {
                                            return "";
                                        }
                                    },
                                    {
                                        targets: 1,
                                        checkboxes: {
                                            selectAllRender: '<input type="checkbox" onclick="data1(`all`)" class="all form-check-input">'
                                        },
                                        render: function(t, e, s, a) {
                                            return s[0];
                                        },
                                        searchable: false
                                    }
                                ],
                                responsive: {
                                    details: {
                                        display: $.fn.dataTable.Responsive.display.modal({
                                            header: function(row) {
                                                return 'تفاصيل ' + row.data()[3]; // اسم العميل في العنوان
                                            }
                                        }),
                                        type: "column",
                                        renderer: function(api, rowIdx, columns) {
                                            var data = $.map(columns, function(col, i) {
                                                return col.title ?
                                                    `<tr><td><strong>${col.title}:</strong></td><td>${col.data}</td></tr>` :
                                                    '';
                                            }).join('');
                                            return data ? $('<table class="table"/>').append('<tbody>' + data +
                                                '</tbody>') : false;
                                        }
                                    }
                                },
                                paging: false, // 🚫 عشان تستخدم Pagination Laravel
                                info: false,
                                ordering: true,
                                searching: false
                            });
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
    {{-- -------------------------------------------------------------- Delete-------------------------------------------------------------------- --}}

    <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="{{ __('admin.Delete') }}">
                        {{ __('admin.Delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form method="POST" action="{{ route('marketing.destroy', 0) }}">
                            @method('delete')
                            @csrf
                            <div id="name" class=" col mb-3">

                                ﻫﻞ اﻧﺖ ﻣﺘﺄﻛﺪ ﻣﻦ اﻧﻚ ﺗﺮﻳﺪ اﻟﺤﺬﻑ؟

                            </div>
                            <input class="val" type="hidden" name="id">


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                        data-i18n="Close">Close</button>
                    <button type="submit" class="btn btn-danger"
                        data-i18n="{{ __('admin.Delete') }}">{{ __('admin.Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- --------------------------------------------------------------end Delete-------------------------------------------------------------------- --}}


    {{-- -------------------------------------------------------------- Delete-------------------------------------------------------------------- --}}

    <div class="modal fade" id="basicModal3" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="{{ __('admin.Note') }}">
                        {{ __('admin.Delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form method="POST" action="{{ route('marketing.note') }}">
                            @method('post')
                            @csrf
                            <div id="name" class=" col mb-3">

                                <textarea name="note" cols="30" rows="10" id="note2" class="form-control "
                                    placeholder="{{ __('admin.Note') }}"></textarea>


                            </div>
                            <input class="val2" type="hidden" name="id">


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                        data-i18n="{{ __('admin.Close') }}">{{ __('admin.Close') }}</button>
                    <button type="submit" class="btn btn-success"
                        data-i18n="{{ __('admin.Submit') }}">{{ __('admin.Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- --------------------------------------------------------------end Delete-------------------------------------------------------------------- --}}

    <script>
        $(".note").click(function() {
            var id = $(this).attr('id');
            $('.val2').val(id);
            $('#note2').val('');

        })
    </script>

@endsection

@section('footer')
    <!-- Page JS -->
    {{-- <script src="{{asset("admin")}}/js/app-ecommerce-order-list.js"></script> --}}
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // لو النسخ تم بنجاح
                alert("تم نسخ الرابط بنجاح ✅");
            }, function() {
                // لو حصل خطأ
                alert("فشل النسخ، برجاء المحاولة مرة أخرى ❌");
            });
        }
    </script>
@endsection
