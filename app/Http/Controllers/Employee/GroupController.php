<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    public function index()
    {
        return view('employee.group.index');
    }

    public function data()
    {



        $groups = Group::withCount('customer')->orderBy('created_at', 'desc')->get();

        return DataTables::of($groups)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
             $user_id = Auth::guard('employee')->user()->id;
            $users = User::where('id',$user_id)->get(['id', 'name_ar', 'phone']);
        return view('employee.group.create',get_defined_vars());
    }

    public function store(GroupRequest $request)
    {

// return$request;
        // if (Group::count() >= 4) {
        //     session()->flash('error', 'لا يمكن إضافة أكثر من 4 عناصر!');
        //     return redirect()->route('group1.index');
        // }
         Group::create($request->all());





         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('group1.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $group = Group::find($id);
        return view('employee.group.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest  $request,$id)
    {
        $group = Group::find($id);
        $group->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('group1.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Group::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('group1.index');
    }
}
