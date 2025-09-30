@extends('customer.customer.app')

@section('contant1')
    <!-- Change Password -->
    <div class="card mb-4">
        <h5 class="card-header">{{ __('admin.Edit User Information') }}</h5>

        {{-- ######################################################  Alert ######################################################################## --}}



        @if (session('success'))
            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif



        @error('newPassword')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- ###################################################### End  Alert ######################################################################## --}}

        <div class="card-body">
            <form class="row g-3" action="{{ route('customer1.update', $customer->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">{{ __('admin.Name') }}</label>
                    <input type="text" id="modalEditUserFirstName" name="name" value="{{ $customer->name }}"
                        class="form-control" placeholder="{{ __('admin.Name') }}" />
                </div>





                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserPhone">{{ __('admin.Phone') }} </label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input type="text" id="modalEditUserPhone" name="phone" class="form-control phone-number-mask"
                            value="{{ $customer->phone }}" placeholder="202 555 0111">
                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <label class="form-label " for="modalEditUserCountry">{{ __('admin.Country') }}</label>
                    <select required name="country_id" class="select2 form-select countryuser" data-allow-clear="true">
                        <option value="">{{ __('admin.Select') }}</option>
                        @foreach ($country as $country1)
                            <option @if ($customer->country_id == $country1->id) {{ 'selected' }} @endif
                                value="{{ $country1->id }}">
                                {{ $country1->name }}</option>
                        @endforeach


                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserPhone">{{ __('admin.Email') }} </label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input type="text" id="modalEditUserPhone" name="email" class="form-control phone-number-mask"
                            value="{{ $customer->email }}" placeholder="email">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label">{!! __('admin.Photo') !!} </label>
                    <input type="file" multiple name="photo" onchange="readURL(this);" value="{{ $customer->photo }}"
                        class="file form-control">

                    @error('photo')
                        <br>
                        <div class="alert alert-danger">{{ $message }}</div>
                        <br>
                    @enderror


                    <br>
                    <div class="row last">
                        <div class="col-md-3 mb-3 position-relative" data-index="0">
                            <a target="_blank" href="{{ asset('images') }}/{{ $customer->photo }}">
                                <img id="blah" style="width: 100%;height: 100%;padding: 5px;"
                                    src="{{ asset('images') }}/{{ $customer->photo }}" alt="your image" /></a>
                        </div>



                    </div>
                </div>
                <div class="col-12 ">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('admin.Submit') }}</button>

                </div>
            </form>
        </div>
    </div>
    <!--/ Change Password -->








    <!-- Change Password -->
    <div class="card mb-4">
        <h5 class="card-header">{!! __('admin.Change Password') !!}</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('customer1.updatepass') }}">
                @method('post')
                @csrf
                <div class="alert alert-warning" role="alert">
                    {!! __('admin.Ensure that') !!}
                </div>



                <div class="row">
                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                        <label class="form-label" for="newPassword">{!! __('admin.New Password') !!}</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="newPassword" value="{{ old('newPassword') }}"
                                name="newPassword"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                        <label class="form-label" for="confirmPassword">{!! __('admin.Confirm New Password') !!}</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" name="newPassword_confirmation"
                                value="{{ old('newPassword_confirmation') }}" id="confirmPassword"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <button type="submit" class="btn btn-primary me-2">{!! __('admin.Change Password') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Change Password -->







    </div>
    <!-- / Content -->
@endsection
