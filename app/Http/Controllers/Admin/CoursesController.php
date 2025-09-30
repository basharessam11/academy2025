<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursesRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\BlogCategory;
use App\Models\Courses;
use App\Models\Courses_Item;
use App\Models\Courses_Time;
use App\Models\CoursesDescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CoursesController extends Controller
{
     use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('course');
    }
    public function index()
    {
        return view('admin.courses.index');
    }

    public function data()
    {
        $courses = Courses::with('user:id,name_ar,name_en,email')
        ->orderBy('created_at', 'desc')
        ->get(['id','title_en' , 'title_ar' , 'user_id', 'photo', 'price']);



        return DataTables::of($courses)

            ->make(true);





    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = BlogCategory::all();
        return view('admin.courses.create',get_defined_vars());
    }

    public function store(CoursesRequest $request)
    {



        $courses = Courses::create($request->except('photo','name_en1','name_ar1','description_ar1','description_en1','title_ar2','title_en2','description_ar2','description_en2'));

        $courses->price = floatval($request->price);
        $courses->price_online = floatval($request->price_online);
        $courses->save();
        if ($request->hasFile('photo')) {

            $courses->setImageAttribute([$request->file('photo')]);
            $courses->save();
        }






#############################Item#########################################

// if (!empty($request->name_en1)) {


// foreach ($request->name_en1 as $key => $value) {


//     Courses_Item::create([
//         'course_id'          => $courses->id,
//         'name_ar'          => $request->name_ar1[ $key],
//         'name_en'          => $request->name_en1[ $key],


//     ]);
// }
// }
#############################End Item#########################################






#############################CoursesDescription#########################################

if (!empty($request->title_ar2)) {


    foreach ($request->title_ar2 as $key => $value) {


        CoursesDescription::create([
            'course_id'          => $courses->id,
            'title_ar'          => $request->title_ar2[ $key],
            'title_en'          => $request->title_en2[ $key],
            'description_ar'          => $request->description_ar2[ $key],
            'description_en'          => $request->description_en2[ $key],

        ]);
    }
    }
    #############################End CoursesDescription#########################################







    session()->flash('success', __('admin.Created Successfully'));
    return redirect()->route('courses.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $categorys = BlogCategory::all();
        $courses = Courses::findOrFail($id);
        return view('admin.courses.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursesRequest  $request,$id)
    {



    // return $request;



        $courses = Courses::findOrFail($id);
        $courses->update($request->except('photo','name_en1','name_ar1','description_ar1','description_en1','title_ar2','title_en2','description_ar2','description_en2'));
        $courses->price = floatval($request->price);
        $courses->price_online = floatval($request->price_online);
        $courses->save();
        if ($request->hasFile('photo')) {

            if ($courses->photo) {
                Storage::disk('courses')->delete($courses->photo);
            }
            $courses->setImageAttribute([$request->file('photo')]);
            $courses->save();
        }
#############################Item#########################################

        // if (!empty($request->name_en1)) {

        //     Courses_Item::where('course_id', $id)->delete();
        //     foreach ($request->name_en1 as $key => $value) {


        //         Courses_Item::create([
        //             'course_id'          => $courses->id,
        //             'name_ar'          => $request->name_ar1[$key],
        //             'name_en'          => $request->name_en1[$key],


        //         ]);
        //     }
        //     }else {
        //         Courses_Item::where('course_id', $id)->delete();
        //     }
#############################End Item#########################################







#############################CoursesDescription#########################################

if (!empty($request->title_ar2)) {

    CoursesDescription::where('course_id', $id)->delete();
    foreach ($request->title_ar2 as $key => $value) {


        CoursesDescription::create([
            'course_id'          => $courses->id,
            'title_ar'          => $request->title_ar2[ $key],
            'title_en'          => $request->title_en2[ $key],
            'description_ar'          => $request->description_ar2[ $key],
            'description_en'          => $request->description_en2[ $key],

        ]);
    }
    }
    #############################End CoursesDescription#########################################








    session()->flash('success',  __('admin.Updated Successfully'));
            return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $courses = Courses::find($value);
    if ($courses->photo) {
        Storage::disk('courses')->delete($courses->photo);
    }
    $courses->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('courses.index');
    }
}

