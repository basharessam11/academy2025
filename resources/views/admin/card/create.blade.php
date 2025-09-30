@extends('admin.layout.app')

@section('page', 'Create Product')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <form action="{{ route('card.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('admin.Add Card') }}</h5>


                                </div>

                                <div class="card-body">
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

                                    {{-- نوع الوسائط --}}
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('admin.Type') }}</label>
                                        <select class="form-control" name="type" id="type"
                                            onchange="toggleInputFields()">
                                            <option value="2">{{ __('admin.Photo') }}</option>
                                            <option value="1">{{ __('admin.Video') }}</option>
                                        </select>
                                        @error('type')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- رفع الصور --}}
                                    <div id="image-input" class="mb-3">
                                        <label class="form-label">{{ __('admin.Photo') }}</label>
                                        <input type="file" name="photo[]" class="form-control" multiple>
                                        @error('photo.*')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- روابط الفيديو --}}
                                    <div id="video-input" class="mb-3" style="display: none;">
                                        <label class="form-label">{{ __('admin.Url Video') }}</label>
                                        <div id="video-url-wrapper">
                                            <div class="input-group mb-2">
                                                <input type="url" name="video_url[]" class="form-control"
                                                    placeholder="https://example.com/video.mp4">

                                                <input type="file" name="photo1[]" class="form-control  ms-2 mr-2">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeVideoField(this)">-</button>
                                            </div>
                                        </div>








                                        <button type="button" class="btn btn-secondary" onclick="addVideoField()">+
                                            {{ __('admin.Add Video') }}</button>
                                       
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{ __('admin.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        function toggleInputFields() {
            const type = document.getElementById("type").value;
            document.getElementById("image-input").style.display = (type == 2) ? "block" : "none";
            document.getElementById("video-input").style.display = (type == 1) ? "block" : "none";
        }

        function addVideoField() {
            const wrapper = document.getElementById('video-url-wrapper');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `

             <input type="url" name="video_url[]" required class="form-control"
                                                    placeholder="https://example.com/video.mp4">

                                                <input type="file" name="photo1[]" required class="form-control  ms-2 mr-2">
            <button type="button" class="btn btn-danger" onclick="removeVideoField(this)">-</button>
        `;
            wrapper.appendChild(div);
        }

        function removeVideoField(button) {
            button.parentElement.remove();
        }

        document.addEventListener('DOMContentLoaded', toggleInputFields);
    </script>

@endsection
