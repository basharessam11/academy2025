<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
  use HasCrudPermissions;



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', __('admin.You need to log in to submit a review.'));
        }


     $existingReview = BlogComment::where('blog_id', $request->blog_id)
     ->where('customer_id',  auth()->user()->id ?? 1)
     ->first();

if ($existingReview) {
return redirect()->back()->with('error', __('admin.You cannot make more than one review.'));
}


$ipAddress = $request->ip();
$data = $request->all();
$data['ip_address'] = $ipAddress;
$data['customer_id'] = auth()->user()->id ?? 1;

BlogComment::create($data);


return redirect()->back()->with('success', __('admin.Created Successfully'));
    }


}
