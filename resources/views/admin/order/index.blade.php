@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <h4 class="py-3 mb-4">
                Order List
            </h4>

            <!-- Order List Widget -->
            <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $pending }}</h3>
                                        <p class="mb-0"> {!! __('admin.Pending Payment') !!}</p>
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
                                        <h3 class="mb-2">{{ $paid }}</h3>
                                        <p class="mb-0">{!! __('admin.Completed') !!}</p>
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
                                        <h3 class="mb-2">{{ $cancelled }}</h3>
                                        <p class="mb-0">{!! __('admin.Refunded') !!}</p>
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
                                        <h3 class="mb-2">{{ $failed }}</h3>
                                        <p class="mb-0">{!! __('admin.Failed') !!}</p>
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

            <!-- Order List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="products-table" class="datatables-order table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>

                                <th>{!! __('admin.Orders') !!}</th>
                                <th>{!! __('admin.Date') !!}</th>
                                <th>{!! __('admin.Customers') !!}</th>
                                <th>{!! __('admin.Payment') !!}</th>
                                <th>{!! __('admin.Total') !!}</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


        </div>
        <!-- / Content -->


        <!-- group delete -->
        <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1 ">{!! __('admin.Delete') !!}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ route('order.destroy', 0) }}">
                                @method('delete')
                                @csrf
                                <div id="name" class=" col mb-3">

                                    {!! __('admin.Are you sure you want to delete?') !!}
                                </div>
                                <input class="val" type="hidden" name="id">


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            data-i18n="Close">{!! __('admin.Close') !!}</button>
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
            $(document).ready(function() {

                var r = {
                        1: {
                            title: "Dispatched",
                            class: "bg-label-warning"
                        },
                        2: {
                            title: "Delivered",
                            class: "bg-label-success"
                        },
                        3: {
                            title: "Out for Delivery",
                            class: "bg-label-primary"
                        },
                        4: {
                            title: "Ready to Pickup",
                            class: "bg-label-info"
                        }
                    },
                    o = {
                        1: {
                            title: "{{ __('admin.Paid') }}",
                            class: "text-success"
                        },
                        2: {
                            title: "{{ __('admin.Pending') }}",
                            class: "text-warning"
                        },
                        3: {
                            title: "{{ __('admin.Failed') }}",
                            class: "text-danger"
                        },
                        4: {
                            title: "{{ __('admin.Cancelled') }}",
                            class: "text-secondary"
                        }
                    };
                $('#products-table').DataTable({
                    processing: true,

                    ajax: '{{ route('order.data') }}',
                    columns: [{
                                data: "id"
                            },

                            {
                                data: "id"
                            },
                            {
                                data: "order"
                            },
                            {
                                data: "date"
                            },
                            {
                                data: "customer"
                            },
                            {
                                data: "payment"
                            },

                            {
                                data: "total"
                            },






                        ]

                        ,
                    columnDefs: [{
                            className: "control",
                            searchable: !1,
                            orderable: !1,
                            responsivePriority: 2,
                            targets: 0,
                            render: function(t, e, s, a) {
                                // console.log(s)
                                return ""
                            }
                        }, {
                            targets: 1,
                            orderable: !1,
                            checkboxes: {
                                selectAllRender: '<input type="checkbox" class="all form-check-input">'
                            },
                            render: function(t, e, s, a) {
                                return '<input type="checkbox" value="' + s.id +
                                    '"   class="dt-checkboxes form-check-input" >'
                            },
                            searchable: !1
                        }

                        ///////////2////////////
                        //     , {
                        //         targets: 2,
                        //         responsivePriority: 1,
                        //         render: function(t, e, s, a) {

                        // // console.log(s)



                        //             var n = s.id;
                        //             return n;

                        //         }
                        //     }

                        ////////////2//////////////
                        ///////////2////////////
                        , {
                            targets: 2,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                return '<a href="order/' + s.id + '"><span class="fw-medium">#' + s
                                    .id + "</span></a>"

                            }
                        }

                        ////////////2//////////////

                        ///////////3////////////
                        , {
                            targets: 3,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                var n = new Date(s.created_at); // تحويل السلسلة إلى كائن Date
                                var a = s.created_at.substring(0,
                                    5); // إذا كنت تريد جزء معين من التاريخ

                                return '<span class="text-nowrap">' +
                                    n.toLocaleDateString("en-US", {
                                        month: "short",
                                        day: "numeric",
                                        year: "numeric"
                                    }) + ", " +
                                    n.toLocaleTimeString("en-US", {
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    }) +
                                    "</span>";


                            }
                        }

                        ////////////3//////////////
                        ///////////4////////////
                        , {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(e, t, s, o) {

                                var customerName = s.customer.name;
                                var initials = customerName.split(' ').map(name => name[0]).join('');
                                var colors = ['success', 'danger', 'warning', 'info', 'dark', 'primary',
                                    'secondary'
                                ];

                                var randomColor = colors[Math.floor(Math.random() * colors.length)];

                                var list = `
  <div class="d-flex justify-content-start align-items-center customer-name">
    <div class="avatar-wrapper">
      <!-- العنصر الذي يحتوي على الأحرف الأولى -->
      <div class="avatar-wrapper">
        <div class="avatar me-2">
          <span class="avatar-initial rounded-circle bg-label-${randomColor}">${initials}</span>
          </div>
          </div>

    </div>
    <!-- معلومات العميل -->
    <div class="d-flex flex-column">
      <a href="customer/${s.customer.id}">
        <span class="fw-medium">${customerName}</span>
      </a>
      <small class="text-muted text-nowrap">${s.customer.phone}</small>
    </div>
  </div>`;

                                return list;

                            }
                        }

                        ////////////4//////////////

                        ///////////5////////////
                        , {
                            targets: 5,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                a = s.payment, a = o[a];
                                return a ? '<h6 class="mb-0 w-px-100 ' + a.class +
                                    '"><i class="bx bxs-circle fs-tiny me-2"></i>' + a.title + "</h6>" :
                                    e


                            }

                        }

                        ////////////5//////////////

                        ///////////6////////////
                        , {
                            targets: 6,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {


                                return '$' + s.total


                            }

                        }

                        ////////////6//////////////

                        ///////////7////////////
                        // , {
                        //     targets: 7,
                        //     responsivePriority: 1,
                        //     render: function(t, e, s, a) {

                        //         var n = s.visa.method,
                        //             number = s.visa.number;
                        //         let numOfDigits = 10;
                        //         let numberString = number.toString();


                        //         let displayedDigits = numberString.substring(0, numOfDigits);

                        //         if (n == 1) {
                        //             var p = 'mastercard';
                        //         } else {
                        //             var p = 'paypal_logo';

                        //         }
                        //         var asset = "{{ asset('admin') }}";
                        //         return '<div class="d-flex align-items-center text-nowrap"><img src="' +
                        //             asset + "/img/icons/payments/" + p + '.png" alt="' + p +
                        //             '" class="me-2" width="16"><span><i class="bx bx-dots-horizontal-rounded"></i>' +
                        //             displayedDigits + "</span></div>"



                        //     }

                        // }

                        ////////////7//////////////

                        ///////////6////////////
                        //             , {
                        //                 targets: 6,
                        //                 responsivePriority: 1,
                        //                 render: function(t, e, s, a) {



                        //                     return `
                //    <div class="d-inline-block text-nowrap">
                //    <a  href="order/edit/` + s.id + `"    >
                //      <button class="btn btn-sm btn-icon">
                //        <i class="bx bx-edit"></i>
                //      </button></a>
                //    </div>`


                        //                 }

                        //             }

                        ////////////6//////////////



                        , {
                            targets: 1,

                            searchable: !1,
                            orderable: !1,

                        }

                    ],

                    order: [2, "desc"],
                    dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-md-0"<"me-5 ms-n2 pe-5"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0"lB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    lengthMenu: [10, 20, 50, 70, 100],
                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "{!! __('admin.Search') !!} ",
                        info: "{!! __('admin.Displaying _START_ to _END_ of _TOTAL_ entries') !!}"
                    },
                    buttons: [



                        {
                            text: '<i class="bx bx-trash"></i><span class="d-none d-sm-inline-block">حذف </span>',
                            className: "add-new btn btn-danger de me-3",
                            attr: {
                                "data-bs-toggle": "modal",
                                "data-bs-target": "#basicModal2",
                                "style": "display:none"
                            }
                        },




                    ],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(t) {
                                    return "Details of " + t.data().name
                                }
                            }),
                            type: "column",
                            renderer: function(t, e, s) {
                                s = $.map(s, function(t, e) {
                                    return "" !== t.title ? '<tr data-dt-row="' + t.rowIndex +
                                        '" data-dt-column="' + t.columnIndex + '"><td>' + t.title +
                                        ":</td> <td>" + t.data + "</td></tr>" : ""
                                }).join("");
                                return !!s && $('<table class="table"/><tbody />').append(s)
                            }
                        }
                    },


                });
            });
        </script>

    @endsection
