<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
                        use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('service');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.service.index');
    }

    public function data()
    {
        $service = Service::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    public function store(ServiceRequest $request)
    {


        if (Service::count() >= 4) {
            session()->flash('error', __('admin.You cannot add more than 4 items!'));
            return redirect()->route('service.index');
        }
        $service = Service::create($request->all());
        if ($request->hasFile('photo')) {

            $service->setImageAttribute([$request->file('photo')]);
            $service->save();
        }




        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('service.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $service = Service::findOrFail($id);
        return view('admin.service.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest  $request,$id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->except('photo'));
        if ($request->hasFile('photo')) {

            if ($service->photo) {
                Storage::disk('service')->delete($service->photo);
            }
            $service->setImageAttribute([$request->file('photo')]);
            $service->save();
        }



        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $service = Service::find($value);
    if ($service->photo) {
        Storage::disk('service')->delete($service->photo);
    }
    $service->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('service.index');
    }
}

