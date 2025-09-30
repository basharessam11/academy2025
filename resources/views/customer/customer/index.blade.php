@extends('customer.layout.app')

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
                        <h5 class="card-title"> {!! __('admin.Customers') !!}</h5>




















                        <table id="products-table" class="table border-top dataTable no-footer dtr-column">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>

                                    <th>{{ __('admin.Customer') }}</th>
                                    <th class="text-nowrap">{{ __('admin.Customer ID') }}</th>
                                    <th>{{ __('admin.Groups') }}</th>
                                    <th>{{ __('admin.Country') }}</th>

                                    <th>{{ __('admin.Bookings') }}</th>
                                    <th class="text-nowrap">{{ __('admin.Total') }}</th>
                                    <th class="text-nowrap">{{ __('admin.Date') }}</th>
                                    <th class="text-nowrap">{{ __('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="  dt-checkboxes-cell">
                                            <input type="checkbox" value="{{ $customer->id }}"
                                                onclick="data('dt-checkboxes')" class="dt-checkboxes form-check-input">
                                        </td>
                                        <td class="  dt-checkboxes-cell">
                                            <input type="checkbox" value="{{ $customer->id }}"
                                                onclick="data('dt-checkboxes')" class="dt-checkboxes form-check-input">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center customer-name">
                                                <div class="avatar-wrapper">
                                                    @if ($customer->photo != null)
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar me-2">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('images') }}/{{ $customer->photo != null ? $customer->photo : 'no-image.png' }}"
                                                                    style="height: 100%; width: 100%; object-fit: cover; border-radius: 50%;"
                                                                    alt="User avatar">

                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- عرض أول حرفين من الاسم عند عدم وجود صورة -->
                                                        @php
                                                            $nameInitials = mb_substr($customer->name, 0, 2, 'UTF-8'); // استخراج أول حرفين
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
                                                    <a href="{{ route('customer1.show2', $customer->id) }}">
                                                        <span class="fw-medium">{{ $customer->name }}</span>
                                                    </a>
                                                    <small class="text-muted text-nowrap">{{ $customer->phone }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>#{{ $customer->id }}</td>
                                        <td>{{ $customer->group->title }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center customer-country">
                                                <div><i
                                                        class="fis fi fi-{{ $customer->country->code }} rounded-circle me-2 fs-3"></i>
                                                </div>
                                                <div><span>{{ $customer->country->name }}</span></div>
                                            </div>
                                        </td>

                                        <td>{{ $customer->booking_count ?? 0 }}</td>
                                        <td>Egp {{ $customer->booking_sum_total ?? 0 }}</td>
                                        <td>{{ optional($customer->created_at)->format('Y-m-d') ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('customer1.show2', $customer->id) }}">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row mx-2">
                            {{ $customers->links('vendor.pagination.bootstrap-5') }}
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
        </div>
        <!-- / Content -->


    @endsection

    @section('footer')
        <!-- Page JS -->


    @endsection
