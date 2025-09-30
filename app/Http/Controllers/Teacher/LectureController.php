<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureRequest;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Lecture;
use App\Models\LectureFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LectureController extends Controller
{
    public function index(Request $request )
    {
       $group_id = $request->group_id;


       $search = $request->query('search');


       $query = Lecture::query();
       $user_id =Auth::guard('teacher')->id();

       // فلترة حسب الجروب لو موجود
       if ($group_id) {
           $query->whereHas('group', function ($q) use ($group_id) {
               $q->where('group_id', $group_id);
           });
       }


       if (!empty($search)) {
           $query->where(function ($q) use ($search) {
               $q->where('name', 'LIKE', "%$search%") ;
           });
       }

        $lectures = $query->where('user_id',$user_id)->orderBy('created_at', 'desc')->paginate(10);


       $groups = Group::where('user_id',$user_id)->get(['id', 'title' ]);

//   return get_defined_vars();
        return view('teacher.lecture.index', get_defined_vars());
    }

    public function show($id)
    {
        $lectures = Lecture::findOrFail($id);
        return view('teacher.lecture.show', get_defined_vars());


    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $user_id =Auth::guard('teacher')->id();

        $groups = Group::where('user_id',$user_id)->get(['id', 'title' ]);

        return view('teacher.lecture.create',  get_defined_vars());

    }

    public function store(Request $request)
    {
//   return$request;

       $user_id =Auth::guard('teacher')->id();
foreach ($request->group_id as $key => $value) {
            // إنشاء المحاضرة
            $lecture = Lecture::create([
                'name' => $request->name,
                'status' => $request->status,
                'group_id' => $value,
                'user_id' => $user_id,
            ]);

            // إدخال الملفات المرتبطة
            if ($request->has('url') && is_array($request->url)) {
                foreach ($request->url as $index => $url) {
                    if (!empty($url)) {
                        LectureFile::create([
                            'lecture_id' => $lecture->id,
                            'url' => $url,
                            'name' => $request->name1[$index] ?? null,
                            'type' => $request->type[$index] ?? null,
                        ]);
                    }
                }
            }
}







         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('lecture2.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
$user_id =Auth::guard('teacher')->id();
$groups = Group::where('user_id',$user_id)->get(['id', 'title' ]);
        $lecture = Lecture::find($id);
        return view('teacher.lecture.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureRequest  $request,$id)
    {
        $lecture = Lecture::findOrFail($id);

        // تعديل بيانات المحاضرة نفسها
        $lecture->update([
            'name' => $request->name,
            'status' => $request->status,
            'group_id' => $request->group_id,
        ]);

        // حذف كل الملفات القديمة المرتبطة بالمحاضرة
        LectureFile::where('lecture_id', $lecture->id)->delete();

        // إدخال الملفات الجديدة
        if ($request->has('url') && is_array($request->url)) {
            foreach ($request->url as $index => $url) {
                if (!empty($url)) {
                    LectureFile::create([
                        'lecture_id' => $lecture->id,
                        'url' => $url,
                        'name' => $request->name1[$index] ?? null,
                        'type' => $request->type[$index] ?? null,
                    ]);
                }
            }
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('lecture2.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Lecture::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('lecture2.index');
    }
}
