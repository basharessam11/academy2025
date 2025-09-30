@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">





            <!-- Order List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">


                    <div class="card-header">
                        <h5 class="card-title"> {!! __('admin.Lectures') !!}</h5>

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


                    </div>
                    <div id="products-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header d-flex border-top rounded-0 flex-wrap py-md-0">


                            {{-- -------------------------------------------------------------- Filter-------------------------------------------------------------------- --}}



                            <form method="GET" action="{{ route('lecture.index') }}">
                                <div class="row g-2 mb-4"> <!-- أضف g-2 لزيادة المسافات -->

                                    <!-- البحث -->
                                    <div class="col-12 col-md-6 col-lg-5 d-flex align-items-end">


                                        <input type="search" name="search" value="{{ request('search') }}"
                                            class="form-control " placeholder="بحث " aria-controls="products-table">
                                    </div>
                                    @canany(['delete lecture'])
                                        <div class="col-12 col-md-6 col-lg-5">
                                            <label class="form-label">{!! __('admin.Groups') !!}</label>
                                            <select name="group_id" class="form-select select2">
                                                <option value="0">اختر الجروب</option>
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group->id }}"
                                                        {{ request('group_id') == $group->id ? 'selected' : '' }}>
                                                        {{ $group->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endcanany


                                    <!-- زر البحث -->
                                    <div class="col-12 col-md-6 col-lg-2 d-flex align-items-end">
                                        <button type="submit"
                                            class="btn btn-primary w-100 mt-4">{!! __('admin.Submit') !!}</button>
                                    </div>

                                </div>
                            </form>










                            {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}





                            {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}

                            <div class="d-flex justify-content-start justify-content-md-end align-items-baseline">
                                <div
                                    class="dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0">

                                    <div class="dt-buttons btn-group flex-wrap">
                                        @canany(['delete lecture'])
                                            <button class="btn btn-secondary add-new btn-danger de me-3" tabindex="0"
                                                aria-controls="products-table" type="button" data-bs-toggle="modal"
                                                data-bs-target="#basicModal2" style="display:none"><span><i
                                                        class="bx bx-trash"></i><span
                                                        class="d-none d-sm-inline-block">{{ __('admin.Delete') }}
                                                    </span></span></button>
                                        @endcanany


                                        @canany(['create lecture'])
                                            <a href="{{ route('lecture.create') }}">
                                                <button class="btn btn-secondary add-new btn-primary ms-2" tabindex="0"
                                                    aria-controls="products-table" type="button" data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasEcommerceCategoryList"><span><i
                                                            class="bx bx-plus me-0 me-sm-1"></i>{!! __('admin.Add Lecture') !!}</span></button>

                                            </a>
                                        @endcanany









                                    </div>
                                </div>
                            </div>
                            {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}


                        </div>


                    </div>




















                    <table id="products-table" class="table border-top dataTable no-footer dtr-column">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{{ __('admin.Name') }}</th>
                                <th>{{ __('admin.Groups') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th class="text-nowrap">{{ __('admin.Date') }}</th>
                                <th class="text-nowrap">{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lectures as $lecture)
                                <tr>
                                    <td class="  dt-checkboxes-cell">
                                        <input type="checkbox" value="{{ $lecture->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">
                                    </td>
                                    <td class="  dt-checkboxes-cell">
                                        <input type="checkbox" value="{{ $lecture->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">
                                    </td>
                                    <td> {{ $lecture->name }} </td>


                                    <td>{{ $lecture->group->title }}</td>


                                    <td>
                                        @if ($lecture->status == 1)
                                            <h6 class="mb-0 w-px-100 text-success">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>مفعل
                                            </h6>
                                        @else
                                            <h6 class="mb-0 w-px-100 text-danger">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>غير مفعل
                                            </h6>
                                        @endif

                                    </td>

                                    <td>{{ optional($lecture->created_at)->format('Y-m-d') ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @canany(['edit lecture'])
                                                <a href="{{ route('lecture.edit', $lecture->id) }}">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                            @endcanany


                                            <a href="{{ route('lecture.show', $lecture->id) }}">

                                                <i class='bx bxs-show fs-4 ms-2'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mx-2">
                        {{ $lectures->links('vendor.pagination.bootstrap-5') }}
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
        {{-- -------------------------------------------------------------- Delete-------------------------------------------------------------------- --}}

        <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="Delete">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ route('lecture.destroy', 0) }}">
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
                        <button type="submit" class="btn btn-danger" data-i18n="Delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- --------------------------------------------------------------end Delete-------------------------------------------------------------------- --}}



    @endsection

    @section('footer')
        <!-- Page JS -->


    @endsection
