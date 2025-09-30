<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryReqest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ServiceCategoryController extends Controller
{
                        use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('service category');
    }
    public function index()
    {
        return view('admin.service_category.index');
    }

    public function data()
    {
        $service = ServiceCategory::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service_category.create');
    }

    public function store(ServiceCategoryReqest $request)
    {


        $service_category=ServiceCategory::create($request->all());


         if ($request->hasFile('photo')) {

            $service_category->setImageAttribute([$request->file('photo')]);
            $service_category->save();
        }


         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('service_category.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $service_category = ServiceCategory::find($id);
        return view('admin.service_category.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceCategoryReqest  $request,$id)
    {
        $service_category = ServiceCategory::find($id);
        $service_category->update($request->all());


        if ($request->hasFile('photo')) {

            if ($service_category->photo) {
                Storage::disk('ServiceCategory')->delete($service_category->photo);
            }
            $service_category->setImageAttribute([$request->file('photo')]);
            $service_category->save();
        }

        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('service_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $service = ServiceCategory::find($value);
    if ($service->photo) {
        Storage::disk('ServiceCategory')->delete($service->photo);
    }
    $service->delete();
}



        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('service_category.index');
    }
}
