@extends('admin.layout.app')

@section('page', 'تعديل بيانات العميل')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{!! __('admin.edit_customer') !!}</h5>
                        </div>
                        <div class="card-body">

                            {{-- Alerts --}}
                            @if (session('success'))
                                <div class="alert alert-success text-center">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- End Alerts --}}

                            <form action="{{ route('marketing.update', $marketing->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label class="form-label">{!! __('admin.full_name') !!}</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $marketing->name) }}" required>
                                        @error('name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Location -->
                                    <div class="col-md-6">
                                        <label class="form-label">{!! __('admin.location') !!}</label>
                                        <input type="text" class="form-control" name="location"
                                            value="{{ old('location', $marketing->location) }}" required>
                                        @error('location')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <label class="form-label">{!! __('admin.phone_call') !!}</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone', $marketing->phone) }}" required>
                                        @error('phone')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Contact Method -->
                                    <div class="col-md-6">
                                        <label class="form-label"> {!! __('admin.contact_method') !!}</label>
                                        <select name="contact_method" class="form-select" required>
                                            <option value="1" {{ $marketing->contact_method == 1 ? 'selected' : '' }}>
                                                {!! __('admin.whatsapp') !!}
                                                 </option>
                                            <option value="2" {{ $marketing->contact_method == 2 ? 'selected' : '' }}>
                                                {!! __('admin.phone_call') !!}
                                                 </option>
                                            <option value="3" {{ $marketing->contact_method == 3 ? 'selected' : '' }}>
                                                {!! __('admin.both_available') !!}
                                                 </option>
                                        </select>
                                        @error('contact_method')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Education -->
                                    <div class="col-md-6">
                                        <label class="form-label">{!! __('admin.education') !!}</label>
                                        <input type="text" class="form-control" name="education"
                                            value="{{ old('education', $marketing->education) }}" required>
                                        @error('education')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>



                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">{!! __('admin.save_changes') !!}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
