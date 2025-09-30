@extends('admin.layout.app')
@section('page', 'إجابات الطلاب للامتحان رقم ' . $exam_id)

@section('contant')
    <div class="container">
        <h3>✅ الطلاب اللي اختبروا:</h3>
        <ul>
            @forelse($test  as $student)
                <li>{{ $student->name }}</li>
            @empty
                <li>لا يوجد طلاب قاموا بالاختبار</li>
            @endforelse
        </ul>

        <hr>

        <h3>❌ الطلاب اللي ما اختبروش:</h3>
        <ul>
            @forelse($notTest  as $student)
                <li>{{ $student->name }}</li>
            @empty
                <li>جميع الطلاب قاموا بالاختبار</li>
            @endforelse
        </ul>
    </div>
@endsection
