<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teacher.customer.index');
    }

    public function data()
    {
        $customer_id = Auth::guard('teacher')->user()->id;
        $customer = Customer::with('country:id,name', 'orders', 'booking') // إذا كنت تستخدم علاقة مع جدول الطلبات
        ->withCount('orders')
        ->withSum('orders', 'total')
        ->withCount('booking')

        ->withSum('booking', 'total')
        ->where('id',$customer_id)
        ->orderBy('created_at', 'desc')
        ->get(['id', 'name', 'phone', 'country_id', 'photo']);



        return DataTables::of($customer)

            ->make(true);
    }


    public function show($id)
    {
        $customer =Customer::findOrFail($id);

        $customer_id = Auth::guard('customer')->user()->id;

        if ($id == $customer_id) {








    $count = $customer->orders->count();
    $total = $customer->orders->sum('total');
    $count1 = $customer->booking->count();
    $total1 = $customer->booking->sum('total');



    $order =$customer->order;
    $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
    $country = Country::all();

    return view('teacher.customer.show',get_defined_vars());
}else{
    abort(404);
}

    }
    public function getorder($id)
    {

        $order = Order::where('customer_id',$id)->get( );



        return DataTables::of($order)

            ->make(true);
    }
     /**
     * Display the specified resource.
     */
    public function show2($id)
    {
        // $recentDevices = recent_devices::where('customer_id',$id)->orderBy('activity_time', 'desc')->get();

        $customer =Customer::findOrFail($id);

    $count = $customer->orders->count();
    $total = $customer->orders->sum('total');

    $count1 = $customer->booking->count();
    $total1 = $customer->booking->sum('total');



    $order =$customer->order;
    $country = Country::all();
    $order =$customer->order;
    $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
    return view('teacher.customer.show2',get_defined_vars());

    }


     /**
     * Display the specified resource.
     */
    public function show3($id)
    {
        $customer =Customer::findOrFail($id);

        $count = $customer->order->count();
        $total = $customer->order->sum('total');

        $order =$customer->order;


        $address =$customer->address;
        $visa =$customer->visa;
        $country = Country::all();
        $order =$customer->order;
        $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');

        return view('teacher.customer.show3',get_defined_vars());

    }


     /**
     * Display the specified resource.
     */
    public function show4($id)
    {
        $customer =Customer::findOrFail($id);

        $count = $customer->orders->count();
        $total = $customer->orders->sum('total');

        $order =$customer->order;
        $country = Country::all();
        $order =$customer->order;
        $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
        return view('teacher.customer.show4',get_defined_vars());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatepass(Request $request )
    {
        // return $request;
        $request->validate([
            'newPassword' => 'required|string|min:8|confirmed',

        ]);


          $customer = Customer::where("id",$request->id);
        $customer->update([
            'password'=>Hash::make($request->newPassword)
        ]);


    session()->flash('success',  __('admin.Updated Successfully'));

        return redirect()->back(); // يمكنك إعادة توجيه المستخدم إلى الصفحة السابقة
    }


    public function update(Request $request,$id)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers,phone,' . $id,  // تجاهل رقم الهاتف نفسه أثناء التحديث
            'email' => 'email|unique:customers,email,' . $id, // تجاهل البريد الإلكتروني نفسه أثناء التحديث
            'country_id' => 'required|exists:countries,id',
        ]);
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->back()->with('success',__('admin.Updated Successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
