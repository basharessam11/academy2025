<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionsRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\QuestionOptions;
use App\Models\Questions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionsController extends Controller
{
                    use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('questions');
    }
    public function index(Request $request)
    {

        $query = Questions::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('question_text', 'LIKE', "%{$search}%") ;

        }


$exam_id=$request->exam_id;
        $questions = $query->orderBy('created_at', 'desc')->where('exam_id',$exam_id)->paginate(10); // هنا يتم تفعيل التصفح



        return view('admin.questions.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($exam_id)
    {

        return view('admin.questions.create', get_defined_vars());
    }

    public function store( QuestionsRequest $request)
    {

 #############################Product###########################################

 $question = Questions::create([
     'question_text' => $request->question_text,
     'type' => $request->type,
     'exam_id'        => $request->exam_id,

 ]);
#############################End Product########################################

if ($request->has('name') &&  !empty($request->name[0])) {


#############################questions_select#########################################
foreach ($request->name as $key => $value) {

    if($request->status == ($key+1))
    {
        $status= 1 ;
    }else{
        $status= 0 ;
    }
    QuestionOptions::create([
        'status'              => $request->status == ($key+1) ? 1 :0,
        'question_id'        => $question->id,
        'name'    => $value,
    ]);
}
#############################End questions_select#########################################

}


         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('questions.index1', $request->exam_id);



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $question = Questions::find($id);
        return view('admin.questions.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionsRequest $request, $id)
    {
        // return $request;
         $question = Questions::findOrFail($id);



        if ($question->type == 1 && $request->type != 1) {

             QuestionOptions::where('question_id', $question->id)->delete();
        }else{
  ############################# تحديث اختيارات السؤال ###########################################
  if ($request->has('name') && !empty($request->name[0])) {
    QuestionOptions::where('question_id', $question->id)->delete();

    foreach ($request->name as $key => $value) {
       if ($request->status == ($key + 1)) {
           $status = 1;
       } else {
           $status = 0;
       }

       QuestionOptions::create([
           'status' => $status,
           'question_id' => $question->id,
           'name' => $value,
       ]);
   }
}
############################# End تحديث اختيارات السؤال ###########################################

        }


        ############################# تحديث السؤال ###########################################
        $question->update([
            'question_text' => $request->question_text,
            'type' => $request->type,

        ]);

//   return $question->type .'<br>'. $request->type ;


        ############################# End تحديث السؤال ########################################



        session()->flash('success', __('admin.Updated Successfully'));
        return redirect()->route('questions.index1', $request->exam_id);
    }



    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Questions::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->back();
    }
}
