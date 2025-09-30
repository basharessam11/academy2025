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
                        <h5 class="card-title"> {!! __('admin.Exam') !!}</h5>

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

                                <div class="dt-buttons btn-group flex-wrap"> <button
                                        class="btn btn-secondary add-new btn-danger de me-3" tabindex="0"
                                        aria-controls="products-table" type="button" data-bs-toggle="modal"
                                        data-bs-target="#basicModal2" style="display:none"><span><i
                                                class="bx bx-trash"></i><span
                                                class="d-none d-sm-inline-block">{{ __('admin.Delete') }}
                                            </span></span></button>




                                </div>
                            </div>
                        </div>
                        {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}


                    </div>





















                    <table id="products-table" class="table border-top dataTable no-footer dtr-column">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>

                                <th>{{ __('admin.Customer') }}</th>
                                <th class="text-nowrap">{{ __('admin.Customer ID') }}</th>
                                <th>{{ __('admin.Groups') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.Time') }}</th>
                                <th>{{ __('admin.Rate') }}</th>

                                <th class="text-nowrap">{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customerexam as $key => $customer)
                                <tr>
                                    <td class="  dt-checkboxes-cell">
                                        <input type="checkbox" value="{{ $customer->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">
                                    </td>

                                    <td class="  dt-checkboxes-cell">
                                        <input type="checkbox" value="{{ $customer->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                            <div class="avatar-wrapper">
                                                @if ($customer->customer->photo != null)
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2">
                                                            <img class="img-fluid"
                                                                src="{{ asset('images/' . $customer->customer->photo) }}"
                                                                style="height: 100%; width: 100%; object-fit: cover; border-radius: 50%;"
                                                                alt="photo">

                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- عرض أول حرفين من الاسم عند عدم وجود صورة -->
                                                    @php
                                                        $nameInitials = mb_substr(
                                                            $customer->customer->name,
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
                                                <a href="{{ route('customer.show', $customer->customer->id) }}">
                                                    <span class="fw-medium">{{ $customer->customer->name }}</span>
                                                </a>
                                                <small
                                                    class="text-muted text-nowrap">{{ $customer->customer->phone }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>#{{ $customer->customer->id }}</td>
                                    <td>{{ $customer->customer->group->title }}</td>

                                    <td>{{ optional($customer->updated_at)->format('Y-m-d h:i:s a') ?? '-' }}</td>

                                    <td>{{ $customer->time }}</td>

                                    @php
                                        $questions = \App\Models\Questions::where('exam_id', $exam_id)->count();
                                        $answers = \App\Models\Answers::where([
                                            'exam_id' => $exam_id,
                                            'customer_id' => $customer_id,
                                            'customer_exams_id' => $customer->id,
                                            'status' => 1,
                                        ])->count();

                                        $averageScore = $questions > 0 ? ($answers / $questions) * 100 : 0;
                                    @endphp
                                    <td>
                                        @if ($averageScore >= 50)
                                            <span class="text-success">%{{ number_format($averageScore, 1) }}</span>
                                        @elseif ($averageScore > 0)
                                            <span class="text-danger">%{{ number_format($averageScore, 1) }}</span>
                                        @else
                                            <span class="text-danger">لم تظهر بعد</span>
                                        @endif
                                    </td>


                                    <td>
                                        <div class="d-flex align-items-center  ">
                                            <a
                                                href="{{ route('answers.show1', [$exam_id, $customer_id, $customer->id]) }}">
                                                <i class='bx bxs-show fs-4'></i>

                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mx-2">
                        {{ $customerexam->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}

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
                        <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="Delete">{{ __('admin.Delete') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ route('customerexam2.destroy', 0) }}">
                                @method('delete')
                                @csrf
                                <div id="name" class=" col mb-3">

                                    {{ __('admin.Are you sure you want to delete?') }}
                                </div>
                                <input class="val" type="hidden" name="id">


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            data-i18n="Close">{{ __('admin.Close') }}</button>
                        <button type="submit" class="btn btn-danger" data-i18n="Delete">{{ __('admin.Delete') }}</button>
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
