<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateingRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Rateing;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RateingController extends Controller
{
                    use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('rateing');
    }
    public function index()
    {


        return view('admin.rateing.index');
    }


    public function data()
    {
        $rateing = Rateing::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($rateing)

            ->make(true);
    }
    /**
     * Show the form for crateing a new resource.
     */
    public function create()
    {
        return view('admin.rateing.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RateingRequest $request)
    {



        $rateing = Rateing::create($request->all());
        if ($request->hasFile('photo')) {

            $rateing->setImageAttribute([$request->file('photo'),'photo']);
            $rateing->save();
        }




        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('rateing.index');



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $rateing = Rateing::findOrFail($id);
        return view('admin.rateing.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RateingRequest  $request,$id)
    {
        $rateing = Rateing::findOrFail($id);

        $rateing->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            $rateing = Rateing::findOrFail($id);

            if ($rateing->photo) {
                Storage::disk('rateing')->delete($rateing->photo);
            }
            $rateing->setImageAttribute([$request->file('photo'),'photo']);
            $rateing->save();
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('rateing.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $rateing = Rateing::findOrFail($value);
    if ($rateing->photo) {
        Storage::disk('rateing')->delete($rateing->photo);
    }
    $rateing->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('rateing.index');
    }
}
