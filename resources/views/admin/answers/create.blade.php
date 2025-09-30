@extends('admin.layout.app')

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
                                    <h5 class="card-title m-0">{!! __('admin.Add Exam') !!}</h5>
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

                                    <form action="{{ route('answers.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3 g-3">

                                            {{-- Customer --}}
                                            <div class="col-md-12">

                                                <label class="form-label">{!! __('admin.Customer') !!}</label>

                                                <select name="customer_id[]" class="form-select select2" multiple>

                                                    @foreach ($customers as $customer)
                                                        {{-- @dd($customer->group) --}}
                                                        <option value="{{ $customer->id }}">
                                                            {{ $customer->name . ' / ' . $customer->phone . ' / ' . $customer->group->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
<input type="hidden" name="exam_id"  value="{{ request('exam_id')??0 }}">

                                            {{-- Submit Button --}}
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="submit"
                                                    class="btn btn-primary">{!! __('admin.Submit') !!}</button>
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
