<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Customer;
use App\Models\CustomerExam;
use App\Models\Exams;
use App\Models\Group;
use App\Models\Questions;
use Illuminate\Http\Request;

class CustomerExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($exam_id ,$customer_id)
    {





      $customerexam = CustomerExam::where(['exam_id'=>$exam_id,'customer_id'=>$customer_id ])->orderBy('created_at', 'desc')->paginate(10);

        return view('teacher.answers.show2', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerExam $customerExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($exam_id)
    {
        $questionsCount = Questions::where('exam_id', $exam_id)->count();

        if ($questionsCount === 0) {
            session()->flash('error', 'لا يوجد أسئلة لهذا الامتحان.');
            return back();
        }

        $customerExams = CustomerExam::where('exam_id', $exam_id)->get();

        foreach ($customerExams as $exam) {
            $answersCount = Answers::where([
                'exam_id' => $exam_id,
                'customer_id' => $exam->customer_id,
                'customer_exams_id' => $exam->id,
                'status' => 1,
            ])->count();

            $rate = ($answersCount / $questionsCount) * 100;

            $exam->update(['rate' => $rate]);
        }

        session()->flash('success', 'تم تحديث النسب لجميع الطلاب بنجاح.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerExam $customerExam)
    {
        //
    }
}
