   @extends('customer.customer.app')

   @section('contant1')
       <!-- Invoice table -->
       <div class="card mb-4">
           <div class="card-header">
               <h5 class="card-title"> {!! __('admin.Bookings') !!}</h5>

           </div>
           <div class="table-responsive mb-3">

               <table id="products-table" class="datatables-products table border-top dataTable no-footer dtr-column">
                   <thead>
                       <tr>
                           <th></th>

                           <th>{!! __('admin.Online Sessions') !!}</th>


                           <th>{!! __('admin.Date') !!}</th>

                           <th>{!! __('admin.Invoice') !!}</th>
                           <th>{!! __('admin.Booking type') !!}</th>
                           <th>{!! __('admin.Installment') !!}</th>
                           <th>{!! __('admin.Total') !!}</th>

                           <th>{!! __('admin.Paid Amount') !!}</th>
                           <th>{!! __('admin.Remaining Amount') !!}</th>
                           <th>{!! __('admin.Note') !!}</th>
                           <th class="text-lg-center">{!! __('admin.Actions') !!}</th>
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
                                   <input type="checkbox" value="{{ $booking->id }}" onclick="data('dt-checkboxes')"
                                       class="dt-checkboxes form-check-input">
                               </td>



                               <td class="sorting_1">
                                   <div class="d-flex justify-content-start align-items-center blog-name">
                                       <div class="avatar-wrapper">
                                           <div class="avatar avatar me-2 rounded-2 bg-label-secondary">
                                               <a href="{{ asset('images/' . $booking->course->photo) }}" target="_blank">
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
                                                   <img src="{{ asset('images/' . $booking->photo) }}" class="rounded-2">
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
                               <td><span>EGP {{ $booking->remaining }}</span></td>

                               <td><span>{{ $booking->note }}</span></td>
                               <td>
                                   <div class="d-flex align-items-center justify-content-center">
                                       <a href="{{ route('booking.edit', $booking->id) }}">
                                           <i class="bx bx-edit"></i>
                                       </a>

                                       <a href="{{ route('invoice', $booking->id) }}">

                                           <i class='bx bxs-printer'></i>
                                       </a>
                                   </div>
                               </td>
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
                                           // + row.data()[
                                           //    1]; // عرض اسم العميل في عنوان المودال
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
   @endsection
