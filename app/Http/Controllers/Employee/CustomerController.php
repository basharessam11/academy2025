<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{








    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $query = Customer::query();

        // البحث بالاسم أو رقم الهاتف
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('group_id') &&$request->group_id  !=0) {
            $query->where('group_id', $request->group_id);
        }
        // البحث بالتاريخ من - إلى
        if ($request->filled('from_date') && $request->filled('to_date') && $request->from_date <= $request->to_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // ترتيب الأحدث أولًا وعرض عدد الحجوزات والمجموع الكلي
        $customers = $query->orderBy('created_at', 'desc')
            ->withCount('booking')
            ->withSum('booking', 'total')
            ->paginate(20)
            ->appends($request->query());
            $groups = Group::all();
        return view('employee.customer.index', get_defined_vars());
    }



    public function data()
    {
        $customer = Customer::with('country:id,name', 'orders', 'booking') // إذا كنت تستخدم علاقة مع جدول الطلبات
        ->withCount('orders')
        ->withSum('orders', 'total')
        ->withCount('booking')
        ->withSum('booking', 'total')
        ->orderBy('created_at', 'desc')
        ->get(['id', 'name', 'phone', 'photo', 'country_id', 'photo']);



        return DataTables::of($customer)

            ->make(true);
    }



    /**
     * Display the specified resource.
     */
    public function show(  $id)
    {
        $customer =Customer::findOrFail($id);

    $count1 = $customer->booking->count();
    $total1 = $customer->booking->sum('total');



    $booking =$customer->booking;
    $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
    $country = Country::all();

    $bookings = Booking::with([
        'customer:id,name,phone,photo',
        'course:id,title_ar,title_en,photo'
    ])->where('customer_id', $id)->paginate(10); // عرض 10 سجلات لكل صفحة


    return view('employee.customer.show',get_defined_vars());

    }





  public function create()
    {
        $countries = Country::all(); // جلب الدول
        $groups = Group::all();
        return view('employee.customer.create',  get_defined_vars());

    }

    // معالجة التسجيل
    public function store(CustomerRequest  $request)
    {


 // return $request;
 $request->validate([
    'password' => 'required|string|min:8|confirmed',

]);

         // return $request;

         $customer = Customer::create($request->except('photo','password_confirmation'));
          if ($request->hasFile('photo')) {
             $customer->setImageAttribute([$request->file('photo')]);
             $customer->save();
         }

            $customer->password = Hash::make($request->password);

            $customer->save();

            return redirect()->route('customer1.index')->with('success', __('admin.Created Successfully')) ;




    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $countries = Country::all(); // جلب الدول
        $groups = Group::all();
        $customer = Customer::findOrFail($id);
        return view('employee.customer.edit',get_defined_vars());

    }













    public function getorder($id)
    {

        $booking = Booking::with([
            'customer:id,name,phone,photo',
            'course:id,title_ar,title_en,photo',

 ])
 ->orderBy('created_at', 'desc')
 ->where('customer_id',$id)->get( );

        return DataTables::of($booking)

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
    return view('employee.customer.show2',get_defined_vars());

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

        return view('employee.customer.show3',get_defined_vars());

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
        return view('employee.customer.show4',get_defined_vars());

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


    public function update(CustomerRequest $request,$id)
    {

        // return $request;
        $customer = Customer::findOrFail($id);
        $customer->update($request->except('photo'));
         if ($request->hasFile('photo')) {

            if ($customer->photo) {
                Storage::disk('customer')->delete($customer->photo);
            }
            $customer->setImageAttribute([$request->file('photo')]);
            $customer->save();
        }

        return redirect()->back()->with('success',__('admin.Updated Successfully'));

    }
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $customer = Customer::findOrFail($value);
    if ($customer->photo) {
        Storage::disk('customer')->delete($customer->photo);
    }
    $customer->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('customer1.index');
    }

}
