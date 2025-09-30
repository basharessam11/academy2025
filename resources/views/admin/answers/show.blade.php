@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">




            <!-- Order List Widget -->
            {{--
            <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $total }}</h3>
                                        <p class="mb-0"> {!! __('admin.Total') !!}</p>
                                    </div>
                                    <div class="avatar me-sm-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-calendar bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-4">
                            </div>
                            <div class="col-sm-6 col-lg-3">
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
                            <div class="col-sm-6 col-lg-3">
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
                            <div class="col-sm-6 col-lg-3">
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
            </div> --}}

            <!-- Order List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">


                    <div class="card-header">
                        <h5 class="card-title"> {!! __('admin.Answers') !!}</h5>

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









                    <table id="products-table" class="table border-top dataTable no-footer dtr-column">
                        <thead>
                            <tr>
                                <th></th>

                                <th>#</th>


                                <th>{{ __('admin.Questions') }}</th>

                                <th>{{ __('admin.Answer') }}</th>

                                <th>{{ __('admin.True Or False') }}</th>
                                <th>{{ __('admin.Questions Type') }}</th>

                                <th>{{ __('admin.Date') }}</th>


                                <th class="text-nowrap">{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($answers as $key => $answer)
                                <tr>

                                    <td class="  dt-checkboxes-cell">

                                    </td>
                                    <td class="  dt-checkboxes-cell">
                                        {{ $key + 1 }}
                                    </td>





                                    <td>{{ $answer->question->question_text }}</td>
                                    <td style="white-space: pre-wrap; font-family: monospace;" dir="ltr">
                                        <code>{!! htmlentities($answer->answer) !!}</code>
                                    </td>


                                    <td>
                                        @if ($answer->status == 1)
                                            <h6 class="mb-0 w-px-100 text-success true{{ $answer->id }}">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>إجابة صحيحة
                                            </h6>
                                        @else
                                            <h6 class="mb-0 w-px-100 text-danger true{{ $answer->id }}">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>إجابة خاطئة
                                            </h6>
                                        @endif

                                    </td>

                                    <td>
                                        @if ($answer->type == 1)
                                            <h6 class="mb-0 w-px-100 text-primary">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>اختر
                                            </h6>
                                        @elseif ($answer->type == 2)
                                            <h6 class="mb-0 w-px-100 text-secondary">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>اكمل
                                            </h6>
                                        @elseif ($answer->type == 3)
                                            <h6 class="mb-0 w-px-100 text-success">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>كود
                                            </h6>
                                        @endif

                                    </td>
                                    <td>{{ optional($answer->created_at)->format('Y-m-d h:i:s a') ?? '-' }}</td>



                                    <td>
                                        <div class="d-flex align-items-center ">

                                            <button
                                                class="btn btn-{{ $answer->status == 1 ? 'success' : 'danger' }} toggle-status-btn ms-2"
                                                data-id="{{ $answer->id }}">
                                                <i
                                                    class='bx bxs-{{ $answer->status == 1 ? 'check-circle' : 'x-circle' }}'></i>
                                            </button>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mx-2">
                        {{ $answers->links('vendor.pagination.bootstrap-5') }}
                    </div>


                    <script>
                        $(document).ready(function() {





                            $('.toggle-status-btn').click(function() {
                                let button = $(this);
                                let id = button.data('id');
                                console.log(id)
                                $.ajax({
                                    url: '{{ route('answers.toggleStatus') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        id: id
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            // أولًا، إحذف الكلاسات السابقة
                                            button.removeClass('btn-success btn-danger toggle-status-btn');

                                            // أضف الكلاس الجديد بناءً على الاستجابة
                                            button.addClass(response.new_status ?
                                                'btn btn-success toggle-status-btn' :
                                                'btn btn-danger toggle-status-btn');

                                            // تغيير الأيقونة بناءً على الحالة الجديدة
                                            button.html(response.new_status ?
                                                `<i class="bx bxs-check-circle"></i>` :
                                                `<i class="bx bxs-x-circle"></i>`);
                                            // تغيير الأيقونة بناءً على الحالة الجديدة
                                            $('.true' + id).html(response.new_status ?
                                                    ` <i class="bx bxs-circle fs-tiny me-2"></i>إجابة صحيحة` :
                                                    `<i class="bx bxs-circle fs-tiny me-2"></i>إجابة خاطئة`)
                                                .removeClass('text-danger text-success ').addClass(response
                                                    .new_status ?
                                                    'text-success' :
                                                    'text-danger');
                                        }

                                    }

                                });
                            });












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
                            <form method="POST" action="{{ route('customer.destroy', 0) }}">
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
