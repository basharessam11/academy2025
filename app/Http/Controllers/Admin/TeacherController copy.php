<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.teacher.index');
    }

    public function data()
    {
        $customer = User::with('country:id,name','meeting') // إذا كنت تستخدم علاقة مع جدول الطلبات

        ->withCount('meeting')

        ->orderBy('created_at', 'desc')
        ->where('role',2)
        ->get(['id', 'name_ar', 'name_en', 'phone', 'country_id', 'photo']);



        return DataTables::of($customer)

            ->make(true);
    }

    public function create()
    {
        $country = Country::all();

        return view('admin.teacher.create',  get_defined_vars());

    }

    public function store( UserRequest $request)
    {



        $user=User::create($request->except('photo','title_ar1','title_en1','description_ar1','description_en1'));
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        if ($request->hasFile('photo')) {

            $user->setImageAttribute([$request->file('photo')]);
            $user->save();
        }
        // $user->assignRole($request->input('roles_name'));
        // $user->assignRole('admin');
        // $user->assignRole(['Admin', 'Teacher']);

#############################UserDescription#########################################

if (!empty($request->title_ar1)) {


    foreach ($request->title_ar1 as $key => $value) {


        UserDescription::create([
            'user_id'          => $user->id,
            'title_ar'          => $request->title_ar1[ $key],
            'title_en'          => $request->title_en1[ $key],
            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End UserDescription#########################################


        return redirect()->route('teachers.index')->with('success', 'Teachers created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = Country::all();
        $teachers = User::FindOrFail($id);

        return view('admin.teacher.edit',  get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request,  $id)
    {


        $user = User::findOrFail($id);
         $user->update($request->except('photo', 'password','title_ar1','title_en1','description_ar1','description_en1'));

         if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }


        if ($request->hasFile('photo')) {

            if ($user->photo) {
                Storage::disk('setting')->delete($user->photo);
            }
            $user->setImageAttribute([$request->file('photo')]);
            $user->save();
        }
         $user->save();
#############################UserDescription#########################################

if (!empty($request->title_ar1)) {

    UserDescription::where('user_id', $user->id)->delete();
    foreach ($request->title_ar1 as $key => $value) {


        UserDescription::create([
            'user_id'          => $user->id,
            'title_ar'          => $request->title_ar1[ $key],
            'title_en'          => $request->title_en1[ $key],
            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End UserDescription#########################################
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $teacher = User::findOrFail($value);
    if ($teacher->photo) {
        Storage::disk('setting')->delete($teacher->photo);
    }
    $teacher->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->back();
    }
}
