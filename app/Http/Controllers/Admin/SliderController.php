<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
                        use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('slider');
    }


    public function index()
    {


        return view('admin.slider.index');
    }


    public function data()
    {
        $slider = Slider::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($slider)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {


        if (Slider::all()->count() >= 1) {
            // إذا كان العدد 3 أو أكثر، أرسل رسالة خطأ
            session()->flash('error', __('admin.You cannot add more than 3 items!'));
            return redirect()->route('slider.index');
        }
        $slider = Slider::create($request->all());
        if ($request->hasFile('photo')) {

            $slider->setImageAttribute([$request->file('photo')]);
            $slider->save();
        }




        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('slider.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',['slider'=>$slider]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest  $request,$id)
    {
        $slider = Slider::findOrFail($id);

        $slider->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            $slider = Slider::findOrFail($id);

            if ($slider->photo) {
                Storage::disk('slider')->delete($slider->photo);
            }
            $slider->setImageAttribute([$request->file('photo')]);
            $slider->save();
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $slider = Slider::findOrFail($value);
    if ($slider->photo) {
        Storage::disk('slider')->delete($slider->photo);
    }
    $slider->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('slider.index');
    }
}
