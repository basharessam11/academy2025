<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Mail\NewBlogNotification;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogDescription;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{

     use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('blog');
    }
    public function index(Request $request)
    {
       $blogs = Blog::with(['category:id,title_ar,title_en'])
    ->when($request->search, function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('title_ar', 'like', '%' . $request->search . '%')
              ->orWhere('title_en', 'like', '%' . $request->search . '%');
        });
    })
    ->when($request->from_date && $request->to_date, function ($query) use ($request) {
        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->appends($request->query());

        return view('admin.blog.index',get_defined_vars());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = BlogCategory::all();
        return view('admin.blog.create',get_defined_vars());
    }

    public function store(BlogRequest $request)
    {
//   return$request;
        $blog = Blog::create($request->except('photo','title_ar1','title_en1','description_ar1','description_en1',));
        if ($request->hasFile('photo')) {

            $blog->setImageAttribute([$request->file('photo'),'photo']);
            $blog->save();
        }

#############################BlogDescription#########################################

if (!empty($request->description_ar1)) {


    foreach ($request->description_ar1 as $key => $value) {


        BlogDescription::create([
            'blog_id'          => $blog->id,

            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End BlogDescription#########################################
        // event(new SendMail($blog,'blog'));



    session()->flash('success', __('admin.Created Successfully'));
    return redirect()->route('blog.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $categorys = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest  $request,$id)
    {

//    return$request;

        $blog = Blog::findOrFail($id);
        $blog->update($request->except('photo','title_ar1','title_en1','description_ar1','description_en1',));
        if ($request->hasFile('photo')) {

            if ($blog->photo) {
                Storage::disk('blog')->delete($blog->photo);
            }
             $blog->setImageAttribute([$request->file('photo'),'photo']);

            $blog->save();
        }


#############################BlogDescription#########################################

if (!empty($request->description_ar1)) {

    BlogDescription::where('blog_id', $blog->id)->delete();
    foreach ($request->description_ar1 as $key => $value) {


        BlogDescription::create([
            'blog_id'          => $blog->id,

            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End BlogDescription#########################################







    session()->flash('success',  __('admin.Updated Successfully'));
            return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $blog = Blog::find($value);
    if ($blog->photo) {
        Storage::disk('blog')->delete($blog->photo);
    }
    $blog->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('blog.index');
    }
}

