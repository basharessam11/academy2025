@extends('teacher.layout.app')

@section('page', 'Create Product')


@section('contant')













    {{-- @dd($errors) --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <form action="{{ route('questions2.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">

                    <!-- Add Question -->
                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- Question Card -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Questions') !!}</h5>
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
                                    {{-- Description (Arabic) --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Questions') !!} </label>
                                        <textarea class="form-control" name="question_text" placeholder="اكتب هنا">{{ old('question_text') }}</textarea>

                                    </div>


                                    {{-- Question Type --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Questions Type') !!}</label>
                                        <select required class="form-select " value="{{ old('type') }}" name="type"
                                            id="questionType">
                                            <option value="">اختر نوع السؤال</option>
                                            <option value="1">اختيار من متعدد</option>
                                            <option value="2">أكمل</option>
                                            <option value="3">إجابة نصية (كود)</option>
                                        </select>

                                    </div>

                                    {{-- Multiple Choice Options --}}
                                    <div class="mb-3" id="mcq-options" style="display: none;">


                                        {{-- ##################################################################### --}}
                                        <label class="form-label"> {!! __('admin.Questions 1') !!}</label>

                                        <div class="input-group mb-2">

                                            <div class="input-group-text">
                                                <input checked class="form-check-input mt-0" type="radio" name="status"
                                                    value="1">
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

                                    <input type="hidden" name="exam_id" value="{{ $exam_id }}">

                                    {{-- Submit Button --}}
                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>

                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- app-ecommerce -->
            </form>
        </div>

        {{-- JavaScript to show/hide MCQ options --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const questionType = document.getElementById('questionType');
                const mcqOptions = document.getElementById('mcq-options');

                questionType.addEventListener('change', function() {
                    if (this.value === '1') {
                        mcqOptions.style.display = 'block';
                    } else {
                        mcqOptions.style.display = 'none';
                    }
                });
            });
        </script>
















    @endsection

    @section('footer')
        <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


    @endsection
