@extends('teacher.layout.app')

@section('page', 'Teacher')


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

                </div>
                <div class="card-datatable table-responsive">
                    <table id="products-table" class="datatables-order table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{!! __('admin.Customers') !!}</th>
                                <th>{!! __('admin.Meeting Name') !!}</th>
                                <th>{!! __('admin.Start Time') !!}</th>

                                <th>{!! __('admin.Meeting') !!}</th>


                                {{-- <th>status</th> --}}
                                {{-- <th>method</th> --}}
                                {{-- <th>actions</th> --}}
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
            $(document).ready(function() {


                $('#products-table').DataTable({
                    processing: true,

                    ajax: '{{ route('meeting2.data') }}',
                    columns: [{
                                data: "id"
                            },

                            {
                                data: "customer"
                            },

                            {
                                data: "topic"
                            },
                            {
                                data: "start_at"
                            },



                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }




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
        <a href="{{ route('teacher.show2', '') }}/` + s.customer.id + `">

        <span class="fw-medium">${customerName}</span>
      </a>
      <small class="text-muted text-nowrap">${s.customer.phone}</small>
    </div>
  </div>`;

                                return list;


                            }
                        }

                        ////////////2//////////////

                        ///////////3////////////
                        , {
                            targets: 3,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                // console.log(s)
                                return '<span class="text-nowrap">' + s.topic +
                                    "</span>";


                            }
                        }

                        ////////////3//////////////
                        ///////////4////////////
                        , {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                // console.log(s)
                                return '<span class="text-nowrap"> ' + s.start_at +
                                    "</span>";


                            }
                        }

                        ////////////4//////////////
                        ///////////5////////////
                        , {
                            targets: 5,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                return `
    <div class="d-inline-block text-nowrap">
        <a target="_blank" href="${s.start_url}">
            <button class="btn btn-sm btn-icon">
                <i class='bx bxs-video'></i>
            </button>
        </a>
        <button class="btn btn-sm btn-icon copy-btn" onclick="copyToClipboard('${s.join_url}')">
            <i class='bx bx-copy'></i>
        </button>
    </div>
`;


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
                        searchPlaceholder: "{!! __('admin.Search') !!} ",
                        info: "{!! __('admin.Displaying _START_ to _END_ of _TOTAL_ entries') !!}"
                    },
                    buttons: [



                        {
                            text: '<i class="bx bx-trash"></i><span class="d-none d-sm-inline-block">{!! __('admin.Delete') !!} </span>',
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

            function copyToClipboard(text) {
                navigator.clipboard.writeText(text)
            }
        </script>

    @endsection
