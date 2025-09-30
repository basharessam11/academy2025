@extends('teacher.layout.app')

@section('page', 'Edit Question')

@section('contant')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <form action="{{ route('questions2.update', $question->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- استخدم PUT لتحديث البيانات -->

                <div class="app-ecommerce">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{!! __('admin.Edit Question') !!}</h5>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Questions') !!}</label>
                                        <textarea class="form-control" name="question_text">{{ old('question_text', $question->question_text) }}</textarea>

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Questions Type') !!}</label>
                                        <select class="form-select" name="type" id="questionType">
                                            <option value="">اختر نوع السؤال</option>
                                            <option value="1"
                                                {{ old('type', $question->type) == 1 ? 'selected' : '' }}>اختيار من متعدد
                                            </option>
                                            <option value="2"
                                                {{ old('type', $question->type) == 2 ? 'selected' : '' }}>أكمل</option>
                                            <option value="3"
                                                {{ old('type', $question->type) == 3 ? 'selected' : '' }}>إجابة نصية (كود)
                                            </option>

                                        </select>

                                    </div>

                                    @if ($question->type == 1)

                                        <div class="mb-3" id="mcq-options"
                                            style="{{ $question->type == 1 ? 'display: block;' : 'display: none;' }}">
                                            @foreach ($question->options as $key => $option)
                                                <label class="form-label">
                                                    @if ($key + 1 == 1)
                                                        {!! __('admin.Questions 1') !!}
                                                    @elseif ($key + 1 == 2)
                                                        {!! __('admin.Questions 2') !!}
                                                    @elseif ($key + 1 == 3)
                                                        {!! __('admin.Questions 3') !!}
                                                    @elseif ($key + 1 == 4)
                                                        {!! __('admin.Questions 4') !!}
                                                    @endif

                                                </label>

                                                <div class="input-group mb-2">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="radio" name="status"
                                                            value="{{ $key + 1 }}"
                                                            {{ old('status', $option->status) == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    <input type="text" name="name[{{ $key }}]"
                                                        class="form-control" placeholder="Option {{ $key + 1 }}"
                                                        value="{{ old('name[' . $key . ']', $option->name) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        {{-- Multiple Choice Options --}}
                                        <div class="mb-3" id="mcq-options" style="display: none;">


                                            {{-- ##################################################################### --}}
                                            <label class="form-label"> {!! __('admin.Questions 1') !!}</label>

                                            <div class="input-group mb-2">

                                                <div class="input-group-text">
                                                    <input checked class="form-check-input mt-0" type="radio"
                                                        name="status" value="1">
                                                </div>
                                                <input type="text" name="name[]" class="form-control"
                                                    placeholder="الخيار الأول">
                                            </div>
                                            {{-- ##################################################################### --}}
                                            {{-- ##################################################################### --}}
                                            <label class="form-label"> {!! __('admin.Questions 2') !!}</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="status"
                                                        value="2">
                                                </div>
                                                <input type="text" name="name[]" class="form-control"
                                                    placeholder="الخيار الثاني">
                                            </div>
                                            {{-- ##################################################################### --}}
                                            {{-- ##################################################################### --}}
                                            <label class="form-label"> {!! __('admin.Questions 3') !!}</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="status"
                                                        value="3">
                                                </div>
                                                <input type="text" name="name[]" class="form-control"
                                                    placeholder="الخيار الثالث">
                                            </div>
                                            {{-- ##################################################################### --}}
                                            {{-- ##################################################################### --}}
                                            <label class="form-label"> {!! __('admin.Questions 4') !!}</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="status"
                                                        value="4">
                                                </div>
                                                <input type="text" name="name[]" class="form-control"
                                                    placeholder="الخيار  الرابع">
                                            </div>
                                            {{-- ##################################################################### --}}

                                        </div>




                                    @endif
                                    <input type="hidden" name="exam_id" value="{{ $question->exam_id }}">

                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const questionType = document.getElementById('questionType');
                const mcqOptions = document.getElementById('mcq-options');

                questionType.addEventListener('change', function() {
                    if (this.value == '1') {
                        mcqOptions.style.display = 'block';
                    } else {
                        mcqOptions.style.display = 'none';
                    }
                });
            });
        </script>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('admin/js/app-ecommerce-product-add.js') }}"></script>
@endsection
