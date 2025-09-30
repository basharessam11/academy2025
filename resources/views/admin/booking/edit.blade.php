@extends('admin.layout.app')

@section('page', 'Edit Booking')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Edit Booking') !!}</h5>
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

                                    <form action="{{ route('booking.update', $booking->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3 g-3">




                                            {{-- Note --}}
                                            <div class="col-md-12">

                                                <label class="form-label">{!! __('admin.Note') !!}</label>
                                                <textarea class="form-control" name="note" placeholder="اكتب هنا">{{ old('note', $booking->note) }}</textarea>
                                                @error('note')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>







                                            {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                            <div>
                                                <br>
                                                <label class="form-label">{!! __('admin.Photo') !!}</label>
                                                <input type="file" multiple name="photo" onchange="readURL(this);"
                                                    value="{{ $booking->photo }}" class="file form-control">

                                                @error('photo')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    <br>
                                                @enderror


                                                <br>
                                                <div class="row last">
                                                    <div class="col-md-3 mb-3 position-relative" data-index="0">
                                                        <a target="_blank"
                                                            href="{{ asset('images') }}/{{ $booking->photo }}">
                                                            <img id="blah"
                                                                style="width: 100%;height: 100%;padding: 5px;"
                                                                src="{{ asset('images') }}/{{ $booking->photo }}"
                                                                alt="your image" /></a>
                                                    </div>



                                                </div>



                                                {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}








                                                {{-- Submit Button --}}
                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="submit"
                                                        class="btn btn-primary">{!! __('admin.Edit Booking') !!}</button>
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
