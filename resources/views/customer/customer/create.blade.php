@extends('admin.layout.app')

@section('page', 'Add Customer')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="customer_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{{ __('admin.Add Customer') }}</h5>
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

                                    <form action="{{ route('customer.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3 g-3">
                                            {{-- Name --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Name') }}</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}" required>
                                            </div>

                                            {{-- Email --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Email') }}</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}" required>
                                            </div>


                                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                                <label class="form-label" for="newPassword">{!! __('admin.Password') !!}</label>
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="password" id="newPassword"
                                                        value="{{ old('password') }}" name="password"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                                <label class="form-label"
                                                    for="confirmPassword">{!! __('admin.Confirm Password') !!}</label>
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="password" name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}" id="confirmPassword"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>


                                            {{-- Phone --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Phone') }}</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone') }}" required>
                                            </div>


                                            {{-- Country --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Country') }}</label>
                                                <select name="country_id" class="form-select" required>
                                                    <option value="">اختر</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Status --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Status') }}</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="1">نشط</option>
                                                    <option value="2">غير نشط</option>
                                                    <option value="3">معلق</option>
                                                </select>
                                            </div>

                                            {{-- User Type --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Type:') }}</label>
                                                <select name="user_type" class="form-select">
                                                    <option value="1">ذكر</option>
                                                    <option value="2">انثي</option>
                                                </select>
                                            </div>
                                            {{-- Status --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Status') }}</label>
                                                <select name="group_id" class="form-select select2">
                                                    <option value="">اختر الجروب</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}"
                                                            {{ request('group_id') == $group->id ? 'selected' : '' }}>
                                                            {{ $group->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- Photo --}}
                                            <div class="col-md-12">
                                                <label class="form-label">{{ __('admin.Photo') }}</label>
                                                <input type="file" name="photo" class="form-control">
                                            </div>

                                            {{-- Submit Button --}}
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
