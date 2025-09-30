<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\StripeTrait;
use App\Models\Booking;
use App\Models\Courses;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class BookingController extends Controller
{
    use PaypalTrait;
    use StripeTrait;
    /**
     * Display a listing of the resource.
     */

 use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('booking');
    }


     public function index(Request $request)
     {



         $month = Booking::whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year)
                         ->count(); // حجوزات الشهر الحالي

         $today = Booking::whereDate('created_at', Carbon::today())->count(); // حجوزات اليوم
         $yesterday = Booking::whereDate('created_at', Carbon::yesterday())->count(); // حجوزات الأمس


$query = Booking::with([
    'customer:id,name,phone,photo',
    'course:id,title_ar,title_en,photo'
]);

// 🔹 البحث بالكلمة (في الملاحظات، اسم العميل، رقم الهاتف، عنوان الدورة)
if ($request->filled('search')) {
    $search = $request->search;
    $query->where(function ($q) use ($search) {
        $q->whereHas('customer', function ($customerQuery) use ($search) {
            $customerQuery->where('name', 'LIKE', "%{$search}%")
                          ->orWhere('phone', 'LIKE', "%{$search}%");
        })
        ->orWhereHas('course', function ($courseQuery) use ($search) {
            $courseQuery->where('title_ar', 'LIKE', "%{$search}%")
                        ->orWhere('title_en', 'LIKE', "%{$search}%");
        })
        ->orWhere('note', 'LIKE', "%{$search}%"); // ✅ البحث في الملاحظات
    });
}


         // 🔹 البحث بالتاريخ من - إلى
         if ($request->filled('from_date') && $request->filled('to_date') && $request->from_date <= $request->to_date) {
             $query->whereBetween('created_at', [
                 Carbon::parse($request->from_date)->startOfDay(),
                 Carbon::parse($request->to_date)->endOfDay()
             ]);
              $total = Booking::whereBetween('created_at', [
                 Carbon::parse($request->from_date)->startOfDay(),
                 Carbon::parse($request->to_date)->endOfDay()
             ])->sum('total');
         } elseif ($request->filled('from_date')) {
             $query->whereDate('created_at', '>=', Carbon::parse($request->from_date)->startOfDay());

             $total = Booking::whereDate('created_at', '>=', Carbon::parse($request->from_date)->startOfDay())->sum('total');

         } elseif ($request->filled('to_date')) {
             $query->whereDate('created_at', '<=', Carbon::parse($request->to_date)->endOfDay());

             $total = Booking::whereDate('created_at', '<=', Carbon::parse($request->from_date)->startOfDay())->sum('total');


         }else{
            $total = Booking::sum('total');
         }


         if ($request->filled('type')  && $request->type != 0) {

            $query->where('type', $request->type) ;

        }


        if ($request->filled('installment') && $request->installment != 0) {
             $query->where('installment', $request->installment) ;

        }



         // 🔹 تنفيذ البحث مع التصفح (pagination) + ترتيب الأحدث أولاً
         $bookings = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());

         return view('admin.booking.index', compact('total', 'month', 'today', 'yesterday', 'bookings'));
     }



    public function data()
    {

        $booking = Booking::with([
            'customer:id,name,phone,photo',
            'course:id,title_ar,title_en,photo',

 ])
 ->orderBy('created_at', 'desc')
 ->get( );

        return DataTables::of($booking)

            ->make(true);
    }

    public function create()
    {
        $customers =Customer::get(['id','name','phone']);
        $courses =Courses::get(['id','title_ar','title_en']);

        return view('admin.booking.create',get_defined_vars());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {

// return$request;
        $bookingExists = Booking::where([ 'course_id' => $request->course_id, 'customer_id' => $request->customer_id ,'type' => $request->type])->exists();



        if ($bookingExists) {
            $booking = Booking::where([
                'course_id' => $request->course_id,
                'customer_id' => $request->customer_id,
                'type' => $request->type
            ])->latest('created_at')->first();


        if ($booking->remaining > 0 &&  $request->total <= ($booking->remaining-$request->discount) ) {

            $store=Booking::create($request->except('installment'));
            $store->price = $booking->price;
            $store->installment = $booking->installment+1;
            $store->remaining = ($booking->remaining-$request->total)-$request->discount;
            $store->discount = $request->discount;

            if ($request->hasFile('photo')) {

                $store->setImageAttribute([$request->file('photo')]);

            }
            $store->save();
            session()->flash('success', __('admin.Created Successfully'));
            return redirect()->route('booking.index');
        }else{

            if (($booking->remaining-$request->discount) == 0) {
$course = Courses::where(['id' => $request->course_id ])->first();
if ($request->type ==1) {
    $price = $course->price;
}else{
    $price = $course->price_online;
}

        if ($request->total <= $price) {
            $store=Booking::create($request->all());
            $store->price =  $price;
            $store->status =  $course->status;
            $store->remaining = ( $price - $request->total)-$request->discount;
            if ($request->hasFile('photo')) {

                $store->setImageAttribute([$request->file('photo')]);

            }
            $store->save();

            session()->flash('success', __('admin.Created Successfully'));
            return redirect()->route('booking.index');
        }else{
    session()->flash('error', __('admin.amount_exceeds_course_price'));


            return redirect()->back();

        }

            }else{
session()->flash('error', __('admin.amount_exceeds_course_price'));


            return redirect()->back();
            }

        }


        } else {
            $course = Courses::where(['id' => $request->course_id ])->first();
if ($request->type ==1) {
    $price = $course->price;
}else{
    $price = $course->price_online;
}

        if ($request->total <= $price) {
            $store=Booking::create($request->all());
            $store->price =  $price;
            $store->status =  $course->status;
            $store->remaining =  ($price - $request->total)-$request->discount;
            if ($request->hasFile('photo')) {

                $store->setImageAttribute([$request->file('photo')]);

            }
            $store->save();

            session()->flash('success', __('admin.Created Successfully'));
            return redirect()->route('booking.index');
        }else{

session()->flash('error', __('admin.amount_exceeds_course_price'));


            return redirect()->back();

        }
        }



    }








    public function edit( $id)
    {
        $customers =Customer::get(['id','name','phone']);
        $courses =Courses::get(['id','title_ar','title_en']);
        $booking = Booking::findOrFail($id);
        return view('admin.booking.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request  $request,$id)
    {

        $booking = Booking::findOrFail($id);

        $booking->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            $booking = Booking::findOrFail($id);

            if ($booking->photo) {
                Storage::disk('booking')->delete($booking->photo);
            }
            $booking->setImageAttribute([$request->file('photo')]);
            $booking->save();
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('booking.index');

    }




    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Booking::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('booking.index');
    }






    public function success(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        Booking::where('customer_id', $customer_id)->latest()->first()->update(['payment' => 1]);

         $request ;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        // dd($response);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            session()->flash('success', __('admin.Created Successfully'));
            return redirect()->route('index');
        } else {
            session()->flash('error', __('admin.Sorry, we were unable to complete your payment. There may be an issue with your payment details or the payment method selected. Please check your details and try again.'));
            return redirect()->route('index');

        }
    }

    public function cancel()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        Booking::where('customer_id', $customer_id)->latest()->first()->update(['payment' => 4]);
        session()->flash('error', __('admin.Sorry, we were unable to complete your payment. There may be an issue with your payment details or the payment method selected. Please check your details and try again.'));
        return redirect()->route('index');
    }



}
