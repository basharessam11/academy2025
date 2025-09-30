<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $color = Setting::first();
        return view('admin.color.index',get_defined_vars());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $settings = Setting::find($id);

        $settings->update($request->all());

          return redirect()->route('color.index')->with('success',__('admin.Updated Successfully'));
    }



}
