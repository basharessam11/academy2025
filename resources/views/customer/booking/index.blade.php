@extends('customer.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">




            <!-- Order List Widget -->

            <!-- Order List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">


                    <div class="card-header">
                        <h5 class="card-title"> {!! __('admin.Bookings') !!}</h5>

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




















                    <table id="products-table" class="datatables-products table border-top dataTable no-footer dtr-column">
                        <thead>
                            <tr>

                                <th></th>
                                <th>{!! __('admin.Customers') !!}</th>
                                <th>{!! __('admin.Online Sessions') !!}</th>


                                <th>{!! __('admin.Date') !!}</th>

                                <th>{!! __('admin.Invoice') !!}</th>
                                <th>{!! __('admin.Booking type') !!}</th>
                                <th>{!! __('admin.Installment') !!}</th>

                                <th>{!! __('admin.Total') !!}</th>

                                <th>{!! __('admin.Paid Amount') !!}</th>
                                <th>{!! __('admin.Discount') !!}</th>
                                <th>{!! __('admin.Remaining Amount') !!}</th>
                                {{-- <th>{!! __('admin.Note') !!}</th> --}}
                                {{-- <th class="text-lg-center">{!! __('admin.Actions') !!}</th> --}}
                                {{-- <th>{!! __('admin.Meeting') !!}</th> --}}

                                {{-- <th>status</th> --}}
                                {{-- <th>method</th> --}}
                                {{-- <th>actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($expenses) --}}


                            @foreach ($bookings as $booking)
                                <tr class="odd">

                                    <td class="  dt-checkboxes-cell">

                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-start align-items-center customer-name">
                                            <div class="avatar-wrapper">
                                                @if ($booking->customer->photo != null)
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2">
                                                            <img class="img-fluid"
                                                                src="{{ asset('images/' . $booking->customer->photo) }}"
                                                                style="height: 100%; width: 100%; object-fit: cover; border-radius: 50%;"
                                                                alt="User avatar">

                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- عرض أول حرفين من الاسم عند عدم وجود صورة -->
                                                    @php
                                                        $nameInitials = mb_substr(
                                                            $booking->customer->name,
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
                                                <a href="{{ route('customer1.show2', $booking->customer->id) }}">
                                                    <span class="fw-medium">{{ $booking->customer->name }}</span>
                                                </a>
                                                <small
                                                    class="text-muted text-nowrap">{{ $booking->customer->phone }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center blog-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar me-2 rounded-2 bg-label-secondary">
                                                    <a href="{{ asset('images/' . $booking->course->photo) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('images/' . $booking->course->photo) }}"
                                                            class="rounded-2">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-body text-nowrap mb-0">
                                                    @if (App::isLocale('en'))
                                                        {{ $booking->course->title_en }}
                                                    @else
                                                        {{ $booking->course->title_ar }}
                                                    @endif

                                                </h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td><span
                                            class="text-nowrap">{{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}</span>
                                    </td>
                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center blog-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar me-2 rounded-2 bg-label-secondary">
                                                    <a href="{{ asset('images/' . $booking->photo) }}" target="_blank">
                                                        <img src="{{ asset('images/' . $booking->photo) }}"
                                                            class="rounded-2">
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        @if ($booking->type == 1)
                                            <h6 class="mb-0 w-px-100 text-danger">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>اوفلاين
                                            </h6>
                                        @else
                                            <h6 class="mb-0 w-px-100 text-success">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>اونلاين
                                            </h6>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($booking->installment == 1)
                                            <h6 class="mb-0 w-px-100 text-primary">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة اولي
                                            </h6>
                                        @elseif ($booking->installment == 2)
                                            <h6 class="mb-0 w-px-100 text-secondary">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة ثانية
                                            </h6>
                                        @elseif ($booking->installment == 3)
                                            <h6 class="mb-0 w-px-100 text-success">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة ثالثة
                                            </h6>
                                        @elseif ($booking->installment == 4)
                                            <h6 class="mb-0 w-px-100 text-danger">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة رابعة
                                            </h6>
                                        @elseif ($booking->installment == 5)
                                            <h6 class="mb-0 w-px-100 text-warning">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة خامسة
                                            </h6>
                                        @elseif ($booking->installment == 6)
                                            <h6 class="mb-0 w-px-100 text-info">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة سادسة
                                            </h6>
                                        @elseif ($booking->installment == 7)
                                            <h6 class="mb-0 w-px-100 text-dark">
                                                <i class="bx bxs-circle fs-tiny me-2"></i>دفعة سابعة
                                            </h6>
                                        @endif

                                    </td>
                                    <td><span>EGP {{ $booking->price }}</span></td>
                                    <td><span>EGP {{ $booking->total }}</span></td>
                                    <td><span>EGP {{ $booking->discount }}</span></td>
                                    <td><span>EGP {{ $booking->remaining }}</span></td>

                                    {{-- <td><span>{{ $booking->note }}</span></td> --}}

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mx-2">
                        {{ $bookings->links('vendor.pagination.bootstrap-5') }}
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

                                ],


                                responsive: {
                                    details: {
                                        display: $.fn.dataTable.Responsive.display.modal({
                                            header: function(row) {
                                                return 'تفاصيل ';
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
                            <form method="POST" action="{{ route('booking.destroy', 0) }}">
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
