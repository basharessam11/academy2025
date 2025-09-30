@extends('admin.layout.app')

@section('page', 'Edit Customer')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="customer_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{{ __('admin.Edit Customer') }}</h5>
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

                                    <form action="{{ route('customer.update', $customer->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3 g-3">
                                            {{-- Name --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Name') }}</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', $customer->name) }}" required>
                                            </div>

                                            {{-- Email --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Email') }}</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email', $customer->email) }}" required>
                                            </div>

                                            {{-- Phone --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Phone') }}</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone', $customer->phone) }}" required>
                                            </div>

                                            {{-- Country --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Country') }}</label>
                                                <select name="country_id" class="form-select" required>
                                                    <option value="">اختر</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ $customer->country_id == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Status --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Status') }}</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>
                                                        نشط</option>
                                                    <option value="2" {{ $customer->status == 2 ? 'selected' : '' }}>
                                                        غير نشط</option>
                                                    <option value="3" {{ $customer->status == 3 ? 'selected' : '' }}>
                                                        معلق</option>
                                                </select>
                                            </div>

                                            {{-- User Type --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Type:') }}</label>
                                                <select name="user_type" class="form-select">
                                                    <option value="1"
                                                        {{ $customer->user_type == 1 ? 'selected' : '' }}>ذكر</option>
                                                    <option value="2"
                                                        {{ $customer->user_type == 2 ? 'selected' : '' }}>انثى</option>
                                                </select>
                                            </div>

                                            {{-- Group --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Groups') }}</label>
                                                <select name="group_id" class="form-select select2">
                                                    <option value="">اختر الجروب</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}"
                                                            {{ $customer->group_id == $group->id ? 'selected' : '' }}>
                                                            {{ $group->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Photo --}}
                                            <div class="col-md-12">

                                                <br>
                                                <label class="form-label">{!! __('admin.Photo') !!} </label>
                                                <input type="file" multiple name="photo" onchange="readURL(this);"
                                                    value="{{ $customer->photo }}" class="file form-control">

                                                @error('photo')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    <br>
                                                @enderror


                                                <br>
                                                <div class="row last">
                                                    <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                        <a target="_blank"
                                                            href="{{ asset('images') }}/{{ $customer->photo }}">
                                                            <img id="blah"
                                                                style="width: 100%;height: 100%;padding: 5px;"
                                                                src="{{ asset('images') }}/{{ $customer->photo }}"
                                                                alt="your image" /></a>
                                                    </div>




                                                </div>

                                                {{-- Submit --}}
                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('admin.Add Customer') }}</button>
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
