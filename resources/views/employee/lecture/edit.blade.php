@extends('teacher.layout.app')

@section('page', 'Edit Lecture')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="customer_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{{ __('admin.Edit Lecture') }}</h5>
                                </div>
                                <div class="card-body">
                                    {{-- Alerts --}}
                                    @if (session('success'))
                                        <div class="alert alert-success text-center">{{ session('success') }}</div>
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

                                    <form action="{{ route('lecture2.update', $lecture->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3 g-3">
                                            {{-- Name --}}
                                            <div class="col-md-12">
                                                <label class="form-label">{{ __('admin.Name') }}</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', $lecture->name) }}" required>
                                            </div>

                                            {{-- Status --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Status') }}</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="1" {{ $lecture->status == 1 ? 'selected' : '' }}>نشط
                                                    </option>
                                                    <option value="2" {{ $lecture->status == 2 ? 'selected' : '' }}>غير
                                                        نشط</option>

                                                </select>
                                            </div>

                                            {{-- Groups --}}
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('admin.Groups') }}</label>
                                                <select name="group_id" class="form-select select2">
                                                    <option value="">اختر الجروب</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}"
                                                            {{ $lecture->group_id == $group->id ? 'selected' : '' }}>
                                                            {{ $group->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="row g-6">
                                                <div>
                                                    <br>
                                                    <label class="form-label">{{ __('admin.Files') }}</label>
                                                    <div class="row" id="row_item">
                                                        @foreach ($lecture->files as $index => $file)
                                                            <div class="option-row1 row">
                                                                <div class="col-md-3">
                                                                    <label
                                                                        class="form-label">{{ __('admin.Name') }}</label>
                                                                    <input type="text" class="form-control"
                                                                        name="name1[]"
                                                                        value="{{ old('name1.' . $index, $file->name) }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label
                                                                        class="form-label">{{ __('admin.Url Video') }}</label>
                                                                    <input type="url" class="form-control"
                                                                        name="url[]"
                                                                        value="{{ old('url.' . $index, $file->url) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label
                                                                        class="form-label">{{ __('admin.Type') }}</label>
                                                                    <select name="type[]" class="form-select">
                                                                        <option value="1"
                                                                            {{ $file->type == 1 ? 'selected' : '' }}>Video
                                                                        </option>
                                                                        <option value="2"
                                                                            {{ $file->type == 2 ? 'selected' : '' }}>PDF
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-2">
                                                                    <label class="form-label invisible">Remove</label>
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-option1 mt-4"><i
                                                                            class='bx bxs-trash'></i></button>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    </div>

                                                    <input class="btn btn-primary" onclick="additem()" type="button"
                                                        value="{{ __('admin.Add Another Description') }}">
                                                </div>

                                                <script>
                                                    function additem() {
                                                        var item = `
                                                    <div class="option-row1 row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('admin.Name') }}</label>
                                                            <input type="text" class="form-control" name="name1[]">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('admin.Url Video') }}</label>
                                                            <input type="url" class="form-control" name="url[]">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">{{ __('admin.Type') }}</label>
                                                            <select name="type[]" class="form-select">
                                                                <option value="1">Video</option>
                                                                <option value="2">PDF</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-2">
                                                            <label class="form-label invisible">Remove</label>
                                                            <button type="button" class="btn btn-danger remove-option1 mt-4"><i class='bx bxs-trash'></i></button>
                                                        </div>
                                                    </div><hr>`;
                                                        $('#row_item').append(item);
                                                    }

                                                    $(document).on('click', '.remove-option1', function() {
                                                        $(this).closest('.option-row1').remove();
                                                    });
                                                </script>

                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('admin.Submit') }}</button>
                                                </div>

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
