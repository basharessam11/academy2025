<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\StripeTrait;
use App\Models\Booking;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class BookingController extends Controller
{
    use PaypalTrait;
    use StripeTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $paid = Booking::where('type', '1')->count();
        $pending = Booking::where('type', '2')->count();
        $failed = Booking::where('type', '3')->count();
        $cancelled = Booking::where('type', '4')->count();
        return view('teacher.booking.index',get_defined_vars());

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



    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {


        $bookingExists = Booking::where(['date' => $request->date,'course_id' => $request->course_id, 'time' => $request->time])->exists();

        $course = Courses::where(['id' => $request->course_id])->first();

        if ($bookingExists) {


             session()->flash('error', __('admin.This appointment is already booked.'));

             return redirect()->back();
        } else {



$ip = request()->ip();
 $response = Http::get("http://ip-api.com/json/{$ip}");
 if ($response->successful()) {
     $data = $response->json();
     $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
     if ($country == 'Egypt') {
         $price= $course->price+$course->tax;
     } else {
        $price= $course->price1+$course->tax1;
     }
 } else {
    $price= $course->price1+$course->tax1;
 }


            $data = $request->all();
            $data['total'] = $price;
            $book=Booking::create($data);
            $book->country  =$country;
            $book->save();


            if ($request->payment==1) {
                return$this->Paypal($price,'booking_success','booking_cancel');
             }else{
                return$this->Stripe($price,'booking_success','booking_cancel');
             }


        }



    }



    public function success(Request $request)
    {
        $customer_id = Auth::guard('teacher')->user()->id;
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
