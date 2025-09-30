@extends('teacher.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            {{-- <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">eCommerce /</span> Order Details
            </h4> --}}

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

                <div class="d-flex flex-column justify-content-center">
                    <h5 class="mb-1 mt-3">Order #{{ $order->id }} <span
                            class="badge bg-label-success me-2 ms-2">Paid</span> <span class="badge bg-label-info">Ready to
                            Pickup</span></h5>
                    <p class="text-body">{{ $date }} </p>
                </div>
                {{-- <div class="d-flex align-content-center flex-wrap gap-2">
                    <button class="btn btn-label-danger delete-order">Delete Order</button>
                </div> --}}
            </div>

            <!-- Order Details Table -->

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0">Order details</h5>
                            {{-- <h6 class="m-0"><a href=" javascript:void(0)">Edit</a></h6> --}}
                        </div>
                        <div class="card-datatable table-responsive">
                            <table id="products-table" class="datatables-order-details table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="w-50">products</th>
                                        <th class="w-25">price</th>
                                        <th class="w-25">qty</th>
                                        <th>total</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
                                <div class="order-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Subtotal:</span>
                                        <span class="text-heading">${{ $order->subtotal ?? 0 }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Discount:</span>
                                        <span class="text-heading mb-0">${{ $order->discount ?? 0 }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Tax:</span>
                                        <span class="text-heading">${{ $order->tax ?? 0 }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="w-px-100 mb-0">Total:</h6>
                                        <h6 class="mb-0">${{ $order->total ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <script>
                        $(document).ready(function() {
                            var r = {
                                1: {
                                    title: "Ready to  Pickup",
                                    class: "bg-label-info"
                                },
                                2: {
                                    title: "Dispatched",
                                    class: "bg-label-warning"
                                },
                                3: {
                                    title: "Delivered",
                                    class: "bg-label-success"
                                },
                                4: {
                                    title: "Out for delivery",
                                    class: "bg-label-primary"
                                }
                            };
                            $('#products-table').DataTable({
                                processing: true,

                                ajax: "{{ route('order1.getorder', $order->id) }}",
                                columns: [{
                                            data: " "
                                        },

                                        {
                                            data: "id"
                                        },
                                        {
                                            data: "product_name"
                                        },
                                        {
                                            data: "price"
                                        },
                                        {
                                            data: "qty"
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

                                            return ""
                                        }
                                    }, {
                                        targets: 1,
                                        orderable: !1,
                                        checkboxes: {
                                            selectAllRender: '<input type="checkbox" onclick="data1(`all`)" class="all form-check-input">'
                                        },
                                        render: function(t, e, s, a) {
                                            return '<input type="checkbox" value="' + s.id +
                                                '" onclick="data(`dt-checkboxes`)" class="dt-checkboxes form-check-input" >'
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
                                            console.log(s)


                                            if (s.product.photo != null) {
                                                var photo = s.product.photo;
                                            } else {
                                                var photo = 'no-image.png';
                                            }
                                            var list =
                                                '<div class="d-flex justify-content-start align-items-center product-name"><div class="avatar-wrapper"><div class="avatar avatar me-2 rounded-2 bg-label-secondary"><img src="{{ asset('images') }}/' +
                                                photo +
                                                '"   class="rounded-2"></div></div><div class="d-flex flex-column"><h6 class="text-body text-nowrap mb-0">' +
                                                s.product.title_en + '</h6> </div></div>';



                                            return list;


                                        }
                                    }

                                    ////////////2//////////////




                                    ///////////3////////////
                                    , {
                                        targets: 3,
                                        responsivePriority: 1,
                                        render: function(t, e, s, a) {


                                            return "<span>$" + s.price + "</span>"
                                        }
                                    }


                                    ////////////3//////////////
                                    ///////////4////////////
                                    , {
                                        targets: 4,
                                        responsivePriority: 1,
                                        render: function(t, e, s, a) {


                                            return '<span class="text-body">' + s.count +
                                                "</span>"
                                        }
                                    }


                                    ////////////4//////////////
                                    ///////////5////////////
                                    , {
                                        targets: 5,
                                        responsivePriority: 1,
                                        render: function(t, e, s, a) {


                                            return "<span >$" + s.total + "</span>"
                                        }
                                    }


                                    ////////////5//////////////




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
                                    searchPlaceholder: "Search ",
                                    info: "Displaying _START_ to _END_ of _TOTAL_ entries"
                                },
                                buttons: [{
                                    text: '<i class="bx bx-trash"></i><span class="d-none d-sm-inline-block">حذف </span>',
                                    className: "add-new btn btn-danger de me-3",
                                    attr: {
                                        "data-bs-toggle": "modal",
                                        "data-bs-target": "#basicModal2",
                                        "style": "display:none"
                                    }
                                }, ],
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









                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title m-0">Customer details</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center mb-4">
                                <div class="avatar me-2 cust_photo">

                                    <script>
                                        var customerName = "{{ $order->customer->name }}";

                                        var initials = customerName.split(' ').map(name => name[0]).join('');
                                        var colors = ['success', 'danger', 'warning', 'info', 'dark', 'primary',
                                            'secondary'
                                        ];

                                        var randomColor = colors[Math.floor(Math.random() * colors.length)];

                                        var list = `<span class="avatar-initial rounded-circle bg-label-${randomColor}">${initials}</span>`
                                        $('.cust_photo').html(list);
                                    </script>





                                </div>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('customer.show', $order->customer->id) }}"
                                        class="text-body text-nowrap">
                                        <h6 class="mb-0">
                                            {{ $order->customer->name }}</h6>
                                    </a>
                                    <small class="text-muted">Customer ID: #{{ $order->customer->id }}</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center mb-4">
                                <span
                                    class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                        class="bx bx-cart-alt bx-sm lh-sm"></i></span>
                                <h6 class="text-body text-nowrap mb-0">( {{ count($order->customer->order) }} ) Orders</h6>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h6>Contact info</h6>
                                <h6>
                                    {{-- <a href=" javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#editUser"> --}}
                                    <a href="{{ route('customer.show', $order->customer->id) }}">
                                        Edit</a>
                                </h6>
                            </div>

                            <p class=" mb-0">Mobile: <a
                                    href="tel:{{ $order->customer->phone }}">{{ $order->customer->phone }}</a></p>
                        </div>
                    </div>


                </div>
            </div>






        </div>
        <!-- / Content -->



    @endsection

    @section('footer')

        <!-- Page JS -->
        {{-- <script src="{{asset("admin")}}/js/app-ecommerce-order-details.js"></script> --}}
        <script src="{{ asset('admin') }}/js/modal-add-new-address.js"></script>
        <script src="{{ asset('admin') }}/js/modal-edit-user.js"></script>

    @endsection
