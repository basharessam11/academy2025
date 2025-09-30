@extends('customer.layout.app')

@section('page', 'Create Product')


@section('contant')








    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}




    {{-- @dd($errors) --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <form action="{{ route('exam1.show', $exam_id) }}?customer_exams_id={{ request('customer_exams_id') }}"
                method="post" enctype="multipart/form-data">

                @csrf

                <div class="app-ecommerce">

                    <!-- Add Question -->
                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- Question Card -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{!! __('admin.Exam') !!}</h5>

                                    <br>
                                    {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}
                                    <div class="container mt-4">
                                        <!-- div لعرض الوقت -->
                                        <div class="p-3 text-white bg-primary rounded text-center" id="timerDiv"
                                            style="font-size: 24px; font-weight: bold;">
                                            00:00:00
                                        </div>

                                        <!-- input لإظهار نفس الوقت -->

                                    </div>

                                    <script>
                                        const STORAGE_KEY = 'exam_timer_start';

                                        // دالة لحساب الوقت المنقضي بالثواني
                                        function getElapsedSeconds(startTimestamp) {
                                            return Math.floor((Date.now() - startTimestamp) / 1000);
                                        }

                                        // دالة لبدء العداد
                                        function startTimer(startTimestamp) {
                                            const timerDiv = document.getElementById('timerDiv');
                                            const timerInput = document.getElementById('timerInput');

                                            setInterval(() => {
                                                const elapsed = getElapsedSeconds(startTimestamp);

                                                // حساب الساعات والدقائق والثواني
                                                const hours = String(Math.floor(elapsed / 3600)).padStart(2, '0');
                                                const minutes = String(Math.floor((elapsed % 3600) / 60)).padStart(2, '0');
                                                const seconds = String(elapsed % 60).padStart(2, '0');

                                                // دمج الوقت في صيغة h:i:s
                                                const timeString = `${hours}:${minutes}:${seconds}`;

                                                // تحديث الـ div والـ input بالوقت
                                                timerDiv.textContent = timeString;
                                                timerInput.value = timeString;
                                            }, 1000);
                                        }

                                        // عند تحميل الصفحة
                                        window.onload = function() {
                                            let startTimestamp = localStorage.getItem(STORAGE_KEY);

                                            if (!startTimestamp) {
                                                startTimestamp = Date.now();
                                                localStorage.setItem(STORAGE_KEY, startTimestamp);
                                            } else {
                                                startTimestamp = parseInt(startTimestamp);
                                            }

                                            startTimer(startTimestamp);
                                        };
                                    </script>




                                    @if (session('success'))
                                        <div id="success-message"
                                            class="alert alert-success alert-dismissible fade show text-center"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div id="danger-message"
                                            class="alert alert-danger alert-dismissible fade show text-center"
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

                                </div>
                                <div class="card-body">
                                    {{-- Description (Arabic) --}}
                                    <div class="mb-3">


                                        <h5>{{ $question->question_text }}</h5>

                                        @if ($question->type == 1)
                                            {{-- Multiple Choice Options --}}
                                            <div class="mb-3" id="mcq-options">
                                                <div class="row">
                                                    @foreach ($options as $key => $option)
                                                        <div class="col-md-6 mt-3">


                                                            {{-- ##################################################################### --}}


                                                            <div class="input-group mb-2">

                                                                <div class="input-group-text">
                                                                    {{-- @dd($answer2) --}}
                                                                    <input
                                                                        {{ $answer2 == null && $key == 0 ? 'checked' : '' }}
                                                                        {{ $answer2 != null && $answer2->answer == $option->name ? 'checked' : '' }}
                                                                        class="form-check-input mt-0" type="radio"
                                                                        name="answer" value="{{ $option->name }}">

                                                                </div>
                                                                <span class="ms-2 mr-2">{{ $option->name }}</span>
                                                            </div>
                                                            {{-- ##################################################################### --}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <textarea minlength="1" name="answer" class="form-control">{{ $answer2 != null ? $answer2->answer : '' }}</textarea>
                                        @endif

                                        <input type="hidden" value="{{ $index + 1 }}" name="index">
                                        <input type="hidden" value="{{ $question->type }}" name="type">
                                        <input type="hidden" value="{{ $question->id }}" name="question_id">
                                        <input type="hidden" id="timerInput" name="time"
                                            class="form-control mt-3 text-center" readonly>

                                    </div>

                                    <br>
                                    {{-- أزرار التنقل بين الأسئلة --}}
                                    <div class="d-flex justify-content-between">
                                        @if ($index > 0)
                                            <button type="submit" name="index" value="{{ $index - 1 }}"
                                                class="btn btn-secondary" id="previousBtn">السابق</button>
                                        @endif

                                        @if ($index < $questions->count() - 1)
                                            <button type="submit" name="index" value="{{ $index + 1 }}"
                                                class="btn btn-primary" id="nextBtn">التالي</button>
                                        @else
                                            <button type="submit" name="action" value="finish" class="btn btn-success"
                                                id="finishBtn">إنهاء الاختبار</button>
                                        @endif
                                    </div>

                                    {{-- التحقق باستخدام jQuery --}}
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            const STORAGE_KEY = 'exam_timer_start'; // تعريف مفتاح الـ storage
                                            const $textarea = $('textarea[name="answer"]');

                                            const $nextBtn = $('#nextBtn');
                                            const $finishBtn = $('#finishBtn');
                                            $finishBtn.click(function() {
                                                localStorage.removeItem(STORAGE_KEY); // مسح الوقت من localStorage
                                                startTimer(Date.now()); // إعادة تعيين الوقت وبدء التايمر من جديد
                                            });
                                            // وظيفة لتفعيل/تعطيل الأزرار
                                            function toggleButtons() {
                                                if ($textarea.val().trim() === "") {
                                                    // تعطيل الأزرار إذا كان textarea فارغًا

                                                    $nextBtn.prop('disabled', true);
                                                    $finishBtn.prop('disabled', true);
                                                } else {
                                                    // تمكين الأزرار إذا كان textarea يحتوي على نص

                                                    $nextBtn.prop('disabled', false);
                                                    $finishBtn.prop('disabled', false);
                                                }
                                            }

                                            // عند تحميل الصفحة أو عند إدخال نص في الـ textarea
                                            toggleButtons();

                                            // التحقق كلما تم تعديل محتوى textarea
                                            $textarea.on('input', function() {
                                                toggleButtons();
                                            });
                                        });
                                    </script>





                                </div> <!-- card-body -->
                            </div> <!-- card -->









                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- app-ecommerce -->
            </form>
        </div>
    </div>




    <script>
        let examFinished = false;
        let tabSwitchCount = 0;
        const maxTabSwitches = 2; // عدد المرات المسموح بها لتغيير التبويب

        document.getElementById('finishBtn')?.addEventListener('click', function() {
            examFinished = true;
        });

        // تحذير عند محاولة الخروج


        // منع زر الرجوع
        history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            history.go(1);
        };

        // راقب تغيير التبويب
        document.addEventListener('visibilitychange', function() {


            console.log(document.hidden)
            if (document.hidden && !examFinished) {
                tabSwitchCount++;
                if (tabSwitchCount >= maxTabSwitches) {
                    alert("❌ تم إنهاء الاختبار بسبب الخروج المتكرر من التبويب.");
                    window.location.href = "{{ route('exam1.index') }}"; // أنشئ هذا الراوت أو عدّله
                } else {
                    alert("⚠️ لا تخرج من تبويب الامتحان! سيتم إنهاء الاختبار إذا كررت ذلك.");
                }
            }
        });
    </script>









@endsection

@section('footer')



@endsection
