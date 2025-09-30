<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Mail\NewBlogNotification;
 use App\Models\Product;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
                    use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('product');
    }
    public function index()
    {
        return view('admin.product.index');
    }

    public function data()
    {
        $product = Product::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($product)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    public function store(ProductRequest $request)
    {


        $product = Product::create($request->all());
        if ($request->hasFile('photo')) {

            $product->setImageAttribute([$request->file('photo')]);
            $product->save();
        }

        event(new SendMail($product,'product'));


        session()->flash('success', __('admin.Created Successfully'));
                return redirect()->route('product.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $product = Product::findOrFail($id);
        return view('admin.product.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest  $request,$id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->except('photo'));
        if ($request->hasFile('photo')) {

            if ($product->photo) {
                Storage::disk('product')->delete($product->photo);
            }
            $product->setImageAttribute([$request->file('photo')]);
            $product->save();
        }



        session()->flash('success',  __('admin.Updated Successfully'));
                return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $product = Product::find($value);
    if ($product->photo) {
        Storage::disk('product')->delete($product->photo);
    }
    $product->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('product.index');
    }
}
