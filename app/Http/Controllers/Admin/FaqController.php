<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{

                use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('faq');
    }
    public function index()
    {
        return view('admin.faq.index');
    }

    public function data()
    {
        $service = Faq::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(FaqRequest $request)
    {


        // if (Faq::count() >= 4) {
        //     session()->flash('error', 'لا يمكن إضافة أكثر من 4 عناصر!');
        //     return redirect()->route('faq.index');
        // }
         Faq::create($request->all());





         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('faq.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $faq = Faq::find($id);
        return view('admin.faq.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest  $request,$id)
    {
        $faq = Faq::find($id);
        $faq->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Faq::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('faq.index');
    }
}
