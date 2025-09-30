@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">




            <!-- Order List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> {!! __('admin.Meeting') !!}</h5>
                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">


                        {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                        @if (session('success'))
                            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div id="danger-message" class="alert alert-danger alert-dismissible fade show text-center"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    {{-- @dd($errors) --}}
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}


                    </div>
                    {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}

                    <div class="d-flex justify-content-start justify-content-md-end align-items-baseline">
                        <div
                            class="dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0">

                            <div class="dt-buttons btn-group flex-wrap">




                                          @canany(['delete meeting'])
                                            <button class="btn btn-secondary add-new btn-danger de me-3" tabindex="0"
                                                aria-controls="products-table" type="button" data-bs-toggle="modal"
                                                data-bs-target="#basicModal2" style="display:none"><span><i
                                                        class="bx bx-trash"></i><span
                                                        class="d-none d-sm-inline-block">{{ __('admin.Delete') }}
                                                    </span></span></button>
                                        @endcanany


                                        @canany(['create meeting'])
                                            <a href="{{ route('meeting.create') }}">
                                    <button class="btn btn-secondary add-new btn-primary ms-2" tabindex="0"
                                        aria-controls="products-table" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasEcommerceCategoryList"><span><i
                                                class="bx bx-plus me-0 me-sm-1"></i>{!! __('admin.Add Meeting') !!}</span></button>

                                </a>
                                        @endcanany







                            </div>
                        </div>
                    </div>
                    {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}


                </div>
                <div class="card-datatable table-responsive">
                    <table id="products-table" class="datatables-order table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{!! __('admin.User') !!}</th>
                                <th>{!! __('admin.Meeting Name') !!}</th>
                                <th>{!! __('admin.Start Time') !!}</th>

                                <th>{!! __('admin.Meeting') !!}</th>


                                {{-- <th>status</th> --}}
                                {{-- <th>method</th> --}}
                                {{-- <th>actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $meeting)
                                <tr class="odd">
                                    <td class="  dt-checkboxes-cell">
                                        <input type="checkbox" value="{{ $meeting->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">
                                    </td>
                                    <td class="  dt-checkboxes-cell">
                                        <input type="checkbox" value="{{ $meeting->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                            <div class="avatar-wrapper">
                                                {{-- @dd($meeting->user->photo) --}}
                                                @if ($meeting->user->photo != null)
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2">
                                                            <img class="img-fluid"
                                                                src="{{ asset('images/' . $meeting->user->photo) }}"
                                                                style="height: 100%; width: 100%; object-fit: cover; border-radius: 50%;"
                                                                alt="User avatar">

                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- عرض أول حرفين من الاسم عند عدم وجود صورة -->
                                                    @php
                                                        $nameInitials = mb_substr(
                                                            $meeting->user->name_en,
                                                            0,
                                                            2,
                                                            'UTF-8',
                                                        ); // استخراج أول حرفين
                                                    @endphp

                                                    <div class="avatar me-2">
                                                        <span class="avatar-initial rounded-circle bg-label-secondary">
                                                            {{ $nameInitials }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- معلومات العميل -->
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('user.show', $meeting->user->id) }}">
                                                    <span class="fw-medium">{{ $meeting->user->name_en }}</span>
                                                </a>
                                                <small class="text-muted text-nowrap">{{ $meeting->user->phone }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-nowrap">{{ $meeting->topic }}</span></td>
                                    <td><span class="text-nowrap">
                                            {{ \Carbon\Carbon::parse($meeting->start_at)->format('Y-m-d h:i:s A') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-inline-block text-nowrap">
                                            <a target="_blank" href="{{ $meeting->start_url }}">
                                                <button class="btn btn-sm btn-icon">
                                                    <i class="bx bxs-video"></i>
                                                </button>
                                            </a>
                                            <button class="btn btn-sm btn-icon copy-btn"
                                                onclick="copyToClipboard('{{ $meeting->join_url }}')">
                                                <i class="bx bx-copy"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mx-2">
                        {{ $meetings->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    <script>
                        $(document).ready(function() {
                            var table = $('#products-table').DataTable({
                                columnDefs: [{
                                        className: "control",
                                        searchable: false,
                                        orderable: false,
                                        responsivePriority: 2,
                                        targets: 0,
                                        render: function(t, e, s, a) {
                                            // console.log(s)
                                            return ""
                                        }

                                    },
                                    {
                                        targets: 1,

                                        checkboxes: {
                                            selectAllRender: '<input type="checkbox" onclick="data1(`all`)" class="all form-check-input">'
                                        },
                                        render: function(t, e, s, a) {
                                            // console.log(s[0])
                                            return s[0];
                                        },
                                        searchable: !1
                                    }
                                ],


                                responsive: {
                                    details: {
                                        display: $.fn.dataTable.Responsive.display.modal({
                                            header: function(row) {
                                                return 'تفاصيل ' + row.data()[
                                                    1]; // عرض اسم العميل في عنوان المودال
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
                                paging: false, // 🚫 إيقاف الباجيناشن
                                info: false, // 🚫 إخفاء "Showing X to Y of Z entries"
                                ordering: true,
                                searching: false
                            });
                        });
                    </script>
                </div>
            </div>


        </div>
        <!-- / Content -->


        <!-- group delete -->
        <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="Delete">{!! __('admin.Delete') !!}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ route('meeting.destroy', 0) }}">
                                @method('delete')
                                @csrf
                                <div id="name" class=" col mb-3">

                                    {!! __('admin.Are you sure you want to delete?') !!}

                                </div>
                                <input class="val" type="hidden" name="id">


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary"
                            data-bs-dismiss="modal">{!! __('admin.Close') !!}</button>
                        <button type="submit" class="btn btn-danger">{!! __('admin.Delete') !!}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- //////////////////////////////////////////////////////////////////////////// -->

    @endsection

    @section('footer')
        <!-- Page JS -->
        {{-- <script src="{{asset("admin")}}/js/app-ecommerce-order-list.js"></script> --}}
        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text)
            }
        </script>

    @endsection
