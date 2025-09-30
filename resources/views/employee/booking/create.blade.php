@extends('employee.layout.app')

@section('page', 'Add Booking')

@section('contant')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Add Booking') !!}</h5>
                                </div>
                                <div class="card-body">

                                    {{-- Alerts --}}
                                    @if (session('success'))
                                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    {{-- End Alerts --}}

                                    <form action="{{ route('booking2.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3 g-3">

                                            {{-- Customer --}}
                                            <div class="col-md-6">

                                                <label class="form-label">{!! __('admin.Customer') !!}</label>
                                                <select name="customer_id" class="form-select select2">
                                                    <option value="">اختر</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">
                                                            {{ $customer->name . ' / ' . $customer->phone }}</option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Course --}}
                                            <div class="col-md-6">

                                                <label class="form-label">{!! __('admin.Course') !!}</label>
                                                <select name="course_id" class="form-select select2">
                                                    <option value="">اختر</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->title_ar }}</option>
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Total --}}
                                            <div class="col-md-6">

                                                <label class="form-label">{!! __('admin.Total') !!}</label>
                                                <input type="number" class="form-control" name="total"
                                                    value="{{ old('total') }}" placeholder="ادخل المبلغ">
                                                @error('total')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            {{-- discount --}}
                                            <div class="col-md-6">

                                                <label class="form-label">{!! __('admin.Discount') !!}</label>
                                                <input type="number" class="form-control" name="discount"
                                                    value="{{ old('discount') ?? 0 }}" placeholder="ادخل المبلغ">
                                                @error('discount')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            {{-- Payment --}}
                                            <div class="col-md-6">

                                                <label class="form-label">{!! __('admin.Booking type') !!}</label>
                                                <select name="type" class="form-select select2">
                                                    <option value="1">اوفلاين</option>
                                                    <option value="2" selected>اونلاين</option>

                                                </select>

                                                @error('type')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- Payment --}}
                                            <div class="col-md-6">

                                                <label class="form-label">{!! __('admin.Installment') !!}</label>
                                                <select name="installment" class="form-select select2">
                                                    <option value="1">دفعة اولي</option>
                                                    <option value="2">دفعة ثانية</option>
                                                    <option value="3">دفعة ثالثة</option>
                                                    <option value="4">دفعة رابعة</option>
                                                    <option value="5">دفعة خامسة</option>
                                                    <option value="6">دفعة سادسة</option>
                                                    <option value="7">دفعة سابعة</option>

                                                </select>

                                                @error('installment')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- --------------------------------------------------------------  Note-------------------------------------------------------------------- --}}

                                            <div class=" col-md-12 ">


                                                <label class="form-label">
                                                    {!! __('admin.Note') !!}
                                                </label>


                                                <textarea class=" form-control" name="note" placeholder="اكتب هنا ">{{ old('note') }}</textarea>




                                                @error('note')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end Note-------------------------------------------------------------------- --}}
                                            {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                            <div>

                                                <label class="form-label">{!! __('admin.Photo') !!}</label>
                                                <input type="file" name="photo" onchange="readURL(this);"
                                                    value="{{ old('photo') }}" class="file form-control">

                                                @error('photo')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    <br>
                                                @enderror


                                                <br>
                                                <div class="row last">


                                                </div>


                                                {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}


                                                {{-- Submit Button --}}
                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="submit"
                                                        class="btn btn-primary">{!! __('admin.Add Booking') !!}</button>
                                                </div>

                                            </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin/js/app-ecommerce-settings.js') }}"></script>
@endsection
