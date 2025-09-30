@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')




    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <!-- Product List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> {!! __('admin.Employees') !!}</h5>
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

                <!-- customers List Table -->
                <div class="card">

                    <div class="card-datatable table-responsive">
                        <table id="products-table"
                            class="datatables-products table border-top dataTable no-footer dtr-column">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>{{ __('admin.Employees') }}</th>
                                    <th class="text-nowrap">{{ __('admin.Customer ID') }}</th>
                                    <th>{{ __('admin.Country') }} </th>

                                    <th>{{ __('admin.Meeting') }}</th>
                                    <th>{{ __('admin.Actions') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>


            </div>
        </div>
        <!-- / Content -->





    @endsection

    @section('footer')
        <!-- Page JS -->
        {{-- <script src="{{asset("admin")}}/js/app-ecommerce-customer-all.js"></script> --}}
        <script>
            $(document).ready(function() {
                const countryCodes = {
                    "Afghanistan": "af",
                    "Albania": "al",
                    "Algeria": "dz",
                    "Andorra": "ad",
                    "Angola": "ao",
                    "Antigua and Barbuda": "ag",
                    "Argentina": "ar",
                    "Armenia": "am",
                    "Australia": "au",
                    "Austria": "at",
                    "Azerbaijan": "az",
                    "Bahamas": "bs",
                    "Bahrain": "bh",
                    "Bangladesh": "bd",
                    "Barbados": "bb",
                    "Belarus": "by",
                    "Belgium": "be",
                    "Belize": "bz",
                    "Benin": "bj",
                    "Bhutan": "bt",
                    "Bolivia": "bo",
                    "Bosnia and Herzegovina": "ba",
                    "Botswana": "bw",
                    "Brazil": "br",
                    "Brunei": "bn",
                    "Bulgaria": "bg",
                    "Burkina Faso": "bf",
                    "Burundi": "bi",
                    "Cabo Verde": "cv",
                    "Cambodia": "kh",
                    "Cameroon": "cm",
                    "Canada": "ca",
                    "Central African Republic": "cf",
                    "Chad": "td",
                    "Chile": "cl",
                    "China": "cn",
                    "Colombia": "co",
                    "Comoros": "km",
                    "Congo, Democratic Republic of the": "cd",
                    "Congo, Republic of the": "cg",
                    "Costa Rica": "cr",
                    "Croatia": "hr",
                    "Cuba": "cu",
                    "Cyprus": "cy",
                    "Czech Republic": "cz",
                    "Denmark": "dk",
                    "Djibouti": "dj",
                    "Dominica": "dm",
                    "Dominican Republic": "do",
                    "Ecuador": "ec",
                    "Egypt": "eg",
                    "El Salvador": "sv",
                    "Equatorial Guinea": "gq",
                    "Eritrea": "er",
                    "Estonia": "ee",
                    "Eswatini": "sz",
                    "Ethiopia": "et",
                    "Fiji": "fj",
                    "Finland": "fi",
                    "France": "fr",
                    "Gabon": "ga",
                    "Gambia": "gm",
                    "Georgia": "ge",
                    "Germany": "de",
                    "Ghana": "gh",
                    "Greece": "gr",
                    "Grenada": "gd",
                    "Guatemala": "gt",
                    "Guinea": "gn",
                    "Guinea-Bissau": "gw",
                    "Guyana": "gy",
                    "Haiti": "ht",
                    "Honduras": "hn",
                    "Hungary": "hu",
                    "Iceland": "is",
                    "India": "in",
                    "Indonesia": "id",
                    "Iran": "ir",
                    "Iraq": "iq",
                    "Ireland": "ie",
                    "Israel": "il",
                    "Italy": "it",
                    "Jamaica": "jm",
                    "Japan": "jp",
                    "Jordan": "jo",
                    "Kazakhstan": "kz",
                    "Kenya": "ke",
                    "Kiribati": "ki",
                    "Korea, North": "kp",
                    "Korea, South": "kr",
                    "Kuwait": "kw",
                    "Kyrgyzstan": "kg",
                    "Laos": "la",
                    "Latvia": "lv",
                    "Lebanon": "lb",
                    "Lesotho": "ls",
                    "Liberia": "lr",
                    "Libya": "ly",
                    "Liechtenstein": "li",
                    "Lithuania": "lt",
                    "Luxembourg": "lu",
                    "Madagascar": "mg",
                    "Malawi": "mw",
                    "Malaysia": "my",
                    "Maldives": "mv",
                    "Mali": "ml",
                    "Malta": "mt",
                    "Marshall Islands": "mh",
                    "Mauritania": "mr",
                    "Mauritius": "mu",
                    "Mexico": "mx",
                    "Micronesia": "fm",
                    "Moldova": "md",
                    "Monaco": "mc",
                    "Mongolia": "mn",
                    "Montenegro": "me",
                    "Morocco": "ma",
                    "Mozambique": "mz",
                    "Myanmar": "mm",
                    "Namibia": "na",
                    "Nauru": "nr",
                    "Nepal": "np",
                    "Netherlands": "nl",
                    "New Zealand": "nz",
                    "Nicaragua": "ni",
                    "Niger": "ne",
                    "Nigeria": "ng",
                    "North Macedonia": "mk",
                    "Norway": "no",
                    "Oman": "om",
                    "Pakistan": "pk",
                    "Palau": "pw",
                    "Palestine": "ps",
                    "Panama": "pa",
                    "Papua New Guinea": "pg",
                    "Paraguay": "py",
                    "Peru": "pe",
                    "Philippines": "ph",
                    "Poland": "pl",
                    "Portugal": "pt",
                    "Qatar": "qa",
                    "Romania": "ro",
                    "Russia": "ru",
                    "Rwanda": "rw",
                    "Saint Kitts and Nevis": "kn",
                    "Saint Lucia": "lc",
                    "Saint Vincent and the Grenadines": "vc",
                    "Samoa": "ws",
                    "San Marino": "sm",
                    "Sao Tome and Principe": "st",
                    "Saudi Arabia": "sa",
                    "Senegal": "sn",
                    "Serbia": "rs",
                    "Seychelles": "sc",
                    "Sierra Leone": "sl",
                    "Singapore": "sg",
                    "Slovakia": "sk",
                    "Slovenia": "si",
                    "Solomon Islands": "sb",
                    "Somalia": "so",
                    "South Africa": "za",
                    "South Sudan": "ss",
                    "Spain": "es",
                    "Sri Lanka": "lk",
                    "Sudan": "sd",
                    "Suriname": "sr",
                    "Sweden": "se",
                    "Switzerland": "ch",
                    "Syria": "sy",
                    "Taiwan": "tw",
                    "Tajikistan": "tj",
                    "Tanzania": "tz",
                    "Thailand": "th",
                    "Togo": "tg",
                    "Tonga": "to",
                    "Trinidad and Tobago": "tt",
                    "Tunisia": "tn",
                    "Turkey": "tr",
                    "Turkmenistan": "tm",
                    "Tuvalu": "tv",
                    "Uganda": "ug",
                    "Ukraine": "ua",
                    "United Arab Emirates": "ae",
                    "United Kingdom": "gb",
                    "United States": "us",
                    "Uruguay": "uy",
                    "Uzbekistan": "uz",
                    "Vanuatu": "vu",
                    "Vatican City": "va",
                    "Venezuela": "ve",
                    "Vietnam": "vn",
                    "Yemen": "ye",
                    "Zambia": "zm",
                    "Zimbabwe": "zw"
                };



                $('#products-table').DataTable({
                    processing: true,

                    ajax: '{{ route('employees.data') }}',
                    columns: [{
                                data: ""
                            },
                            {
                                data: "id"
                            },
                            {
                                data: "customer"
                            },
                            {
                                data: "customer_id"
                            },
                            {
                                data: "country"
                            },

                            {
                                data: "Session"
                            },
                            {
                                data: " "
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


                                @if (App::isLocale('en'))
                                    var customerName = s.name_en;
                                @else
                                    var customerName = s.name_ar;
                                @endif

                                var initials = customerName.split(' ').map(name => name[0]).join('');
                                var colors = ['success', 'danger', 'warning', 'info', 'dark', 'primary',
                                    'secondary'
                                ];
                                var randomColor = colors[Math.floor(Math.random() * colors.length)];

                                var avatarContent = s.photo ?
                                    `<img src="{{ asset('images') }}/${s.photo}" alt="${customerName}" class="avatar-img rounded-circle" />` :
                                    `<span class="avatar-initial rounded-circle bg-label-${randomColor}">${initials}</span>`;

                                var list = `
  <div class="d-flex justify-content-start align-items-center customer-name">
    <div class="avatar-wrapper">
      <div class="avatar me-2">
        ${avatarContent}
      </div>
    </div>

    <div class="d-flex flex-column">
      <a href="employees/${s.id}/edit">
        <span class="fw-medium">${customerName}</span>
      </a>
      <small class="text-muted text-nowrap">${s.phone}</small>
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



                                return "<span class='fw-medium text-heading'>#" + s.id + "</span>"

                            }
                        }

                        ////////////3//////////////
                        ///////////4////////////
                        , {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                // console.log(s)
                                var n = s.country.name;
                                var s = countryCodes[n] || 'XX';


                                return '<div class="d-flex justify-content-start align-items-center customer-country"><div>' +
                                    (s ? `<i class ="fis fi fi-${s} rounded-circle me-2 fs-3"></i>` :
                                        '<i class ="fis fi fi-xx rounded-circle me-2 fs-3"></i>') +
                                    "</div><div><span>" + n + "</span></div></div>"




                            }
                        }

                        ////////////4//////////////


                        ///////////5////////////
                        , {
                            targets: 5,
                            responsivePriority: 1,
                            orderable: 1,
                            render: function(t, e, s, a) {


                                // return `<div class='fw-medium text-heading'>$${s.orders.length > 0 ? s.orders[0].total.toFixed(2) : 0}</div>`
                                return `<div class='fw-medium text-heading'>${s.meeting_count}</div>`;




                            }
                        }

                        ////////////5//////////////


                        ///////////6////////////
                        , {
                            targets: 6,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {




                                var n = s.cat_id;

                                return `
                                        <div class="d-inline-block text-nowrap">
                                            <a href="employees/${s.id}/edit">
                                            <button class="btn btn-sm btn-icon">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                            </a>
                                        </div>`;

                            }
                        }

                        ////////////6//////////////



                        , {
                            targets: -1,

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





                        // {
                        //     extend: "collection",
                        //     className: "btn btn-label-secondary dropdown-toggle me-3",
                        //     text: '<i class="bx bx-export me-1"  ><span class="d-none d-sm-inline-block"  >إستخراج<span></i>',
                        //     buttons: [{
                        //         extend: "print",
                        //         text: '<i class="bx bx-printer me-2" ></i>Print',
                        //         className: "dropdown-item",
                        //         exportOptions: {
                        //             columns: [ 2, 3,4 ],
                        //             format: {
                        //                 body: function(t, e, s) {
                        //                     var a;
                        //                     return t.length <= 0 ? t : (t = $.parseHTML(t), a = "", $.each(t, function(t, e) {
                        //                         void 0 !== e.classList && e.classList.contains("product-name") ? a += e.lastChild.firstChild.textContent : void 0 === e.innerText ? a += e.textContent : a += e.innerText
                        //                     }), a)
                        //                 }
                        //             }
                        //         },
                        //         customize: function(t, e, s,a) {
                        //             $(t.document.body).css("color", a).css("border-color", e).css("background-color", s), $(t.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                        //         }
                        //     },   {
                        //         extend: "pdf",
                        //         text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                        //         className: "dropdown-item",
                        //         exportOptions: {
                        //             columns: [ 2, 3 ],
                        //             format: {
                        //                 body: function(t, e, s) {
                        //                     var a;
                        //                     return t.length <= 0 ? t : (t = $.parseHTML(t), a = "", $.each(t, function(t, e) {
                        //                         void 0 !== e.classList && e.classList.contains("product-name") ? a += e.lastChild.firstChild.textContent : void 0 === e.innerText ? a += e.textContent : a += e.innerText
                        //                     }), a)
                        //                 }
                        //             }
                        //         }
                        //     } ]
                        // },






                        {
                            text: '<i class="bx bx-plus me-0 me-sm-1"></i>{!! __('admin.Add Employees') !!} ',
                            className: "add-new btn btn-primary ms-2",

                            action: function() {
                                window.location.href = "{{ route('employees.create') }}"
                            }
                        }



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
                        <form method="POST" action="{{ route('employees.destroy', 0) }}">
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
