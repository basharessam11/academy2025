<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{

                            use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('story');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $story = Story::findOrfail(1);
        return view('admin.story.index',get_defined_vars());
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(StoryRequest $request, Story $story)
    {






        $story = Story::findOrFail(1);
        $story->update($request->except('photo'));
        if ($request->hasFile('photo')) {

            if ($story->photo) {
                Storage::disk('story')->delete($story->photo);
            }
            $story->setImageAttribute([$request->file('photo'),'photo']);
            $story->save();
        }



    session()->flash('success',  __('admin.Updated Successfully'));
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

}
