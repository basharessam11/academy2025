<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Answers;
use App\Models\Customer;
use App\Models\CustomerExam;
use App\Models\Exams;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('answers');
    }
     public function index(Request $request, $exam_id)
     {
        $group_id = $request->group_id;

        if (!$exam_id) {
            return redirect()->back()->with('error', 'يجب تحديد رقم الامتحان.');
        }

        $filter = $request->query('filter');
        $search = $request->query('search');

        // جلب تاريخ الإجابة باستخدام exam_id من جدول answers
        $exam = Exams::find($exam_id);

        $query = Customer::query();

        // فلترة الطلاب اللي اختبروا أو ما اختبروش
        if ($filter === 'notdone') {
            $query->whereDoesntHave('customerexam', function ($q) use ($exam_id) {
                $q->where('exam_id', $exam_id);
            });
        } else {
            $query->whereHas('customerexam', function ($q) use ($exam_id) {
                $q->where('exam_id', $exam_id);
            });
        }

        // فلترة حسب الجروب لو موجود
        if ($group_id) {
            $query->whereHas('group', function ($q) use ($group_id) {
                $q->where('group_id', $group_id);
            });
        }

        // البحث بالاسم أو رقم الهاتف
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%");
            });
        }

        // جلب العملاء مع تاريخ الإجابة على الامتحان
        $customers = $query->orderBy('created_at', 'desc')->paginate(10);


        $groups = Group::get(['id', 'title' ]);
        $customers1 = Customer::get(['id', 'name', 'phone', 'photo']);
//   return get_defined_vars();
         return view('admin.answers.index', get_defined_vars());
     }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $answers = Answers::where(['exam_id'=>$exam_id,'customer_id'=>$customer_id,'customer_exams_id'=>$customer_exams_id])->paginate(10);
        $customers =Customer::where('status',1)->where('group_id','!=',1)->get(['id','name','phone','group_id']);

        return view('admin.answers.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id =Auth::id();
        $data = collect($request->customer_id)->map(function ($customer_id) use ($request,$user_id) {
            return [
                'exam_id' => $request->exam_id,
                'customer_id' => $customer_id,
                'created_at' => now(),
            'user_id' => $user_id,
            ];
        })->toArray();

        CustomerExam::insert($data);
        session()->flash('success', __('admin.Created Successfully'));
       return to_route('answers.index1', $request->exam_id) ;

    }

    /**
     * Display the specified resource.
     */
    public function show($exam_id ,$customer_id,$customer_exams_id)
    {

         $answers = Answers::where(['exam_id'=>$exam_id,'customer_id'=>$customer_id,'customer_exams_id'=>$customer_exams_id])->paginate(30);

         return view('admin.answers.show', get_defined_vars());
    }


    public function toggleStatus(Request $request)
{
    $answer = Answers::findOrFail($request->id);
    $answer->status = !$answer->status;
    $answer->save();

    return response()->json(['success' => true, 'new_status' => $answer->status]);
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answers $answers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answers $answers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answers $answers)
    {
        //
    }
}
