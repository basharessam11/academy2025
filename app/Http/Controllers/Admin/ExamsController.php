<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Exams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
             use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('exam');
    }
    public function index(Request $request)
    {

        $query = Exams::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'LIKE', "%{$search}%") ;

        }



        $exams = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());



        return view('admin.exam.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.exam.create' );
    }

    public function store( Request $request)
    {
    //    return    $request;
 #############################Product###########################################
 $request->validate([
    'title' => 'required|string|max:255',
]);
$user_id =Auth::id();
  Exams::create(['title' => $request->title,'user_id' => $user_id,]);
#############################End Product########################################



         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('exam.index', $request->exam_id);



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $exam = Exams::find($id);
        return view('admin.exam.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // return $request;
         $exam = Exams::findOrFail($id);

        ############################# تحديث السؤال ###########################################
        $exam->update(['title' => $request->title,]);

//   return $exam->type .'<br>'. $request->type ;


        ############################# End تحديث السؤال ########################################



        session()->flash('success', __('admin.Updated Successfully'));
        return redirect()->route('exam.index');
    }



    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Exams::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->back();
    }
}
