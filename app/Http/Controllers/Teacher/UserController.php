<?php

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::guard('teacher')->check()
        ? Auth::guard('teacher')->user()->id
        : Auth::user()->id;
        $user = User::findOrfail($user_id);
        return view('teacher.user.index',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        if (!empty($request->password)) {

            $user->password = Hash::make($request->password);

        }

         $user->update($request->except('photo', 'password'));


if ($request->hasFile('photo')) {

    if ($user->photo) {
        Storage::disk('user')->delete($user->photo);
    }
    $user->setImageAttribute([$request->file('photo')]);
    $user->save();
}


return redirect()->back()->with('success',__('admin.Updated Successfully'));

    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('login');
    }

}
