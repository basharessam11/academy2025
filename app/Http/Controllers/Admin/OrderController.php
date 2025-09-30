<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\StripeTrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Pro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class OrderController extends Controller
{
    use PaypalTrait;
    use StripeTrait;
    public function index()
    {

        $paid = Order::where('payment', '1')->count();
        $pending = Order::where('payment', '2')->count();
        $failed = Order::where('payment', '3')->count();
        $cancelled = Order::where('payment', '4')->count();
        return view('admin.order.index',['paid'=>$paid,'pending'=>$pending,'failed'=>$failed,'cancelled'=>$cancelled,]);
    }

    public function data()
    {


        $order = Order::with([
            'customer:id,name,phone,photo',



        ])->orderBy('created_at', 'desc')->get();

        return DataTables::of($order)



          ->make(true);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ip = request()->ip();
        $response = Http::get("http://ip-api.com/json/{$ip}");
        // return$request;
        $customer_id = Auth::guard('customer')->user()->id;

        // جلب جميع العناصر المرتبطة بالعميل
        $carts = Cart::where(['customer_id' => $customer_id])->get();

        $total = 0;
        $tax = 0;

         foreach ($carts as $cart) {
            if ($response->successful()) {
                $data = $response->json();
                $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                if ($country == 'Egypt') {
                    $total += $cart->product->price * $cart->quantity;
                    $tax += $cart->product->tax * $cart->quantity;
                 } else {
                    $total += $cart->product->price1 * $cart->quantity;
                    $tax += $cart->product->tax1 * $cart->quantity;
                 }
            } else {
                $total += $cart->product->price1 * $cart->quantity;
                    $tax += $cart->product->tax1 * $cart->quantity;
             }

        }
//   return $total.'<br>'.$price ;
             $order = Order::create([
                'customer_id' => $customer_id,
                'subtotal'    => $total,
                'discount'    => 0,
                'tax'         => $tax,
                'total'       => ($total+$tax),
                'payment'     => '4',
                'country'     => $country,


            ]);

             foreach ($carts as $key => $cart) {

                if ($response->successful()) {
                    $data = $response->json();
                    $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                    if ($country == 'Egypt') {

                        $price=$cart->product->price;
                    } else {

                        $price=$cart->product->price1;
                    }
                } else {

                        $price=$cart->product->price1;
                }


                //
                Order_Pro::create([
                     'order_id' => $order->id,
                     'product_id' => $cart->product_id,
                     'count' => $cart->quantity,
                     'price' => $price,
                     'discount' =>0,
                     'total' => $price*$cart->quantity,


                     'customer_id' => Auth::guard('customer')->user()->id,
                     'country'     => 'egypt',
                ]);



    }



    if ($request->payment==1) {
        return$this->Paypal(($total+$tax),'order_success','order_cancel');
     }else{
        return$this->Stripe(($total+$tax),'order_success','order_cancel');
     }
    }











    public function success(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        Order::where('customer_id', $customer_id)->latest()->first()->update(['payment' => 1]);

         Cart::where(['customer_id' => $customer_id])->delete();
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
        Order::where('customer_id', $customer_id)->latest()->first()->update(['payment' => 4]);
        session()->flash('error', __('admin.Sorry, we were unable to complete your payment. There may be an issue with your payment details or the payment method selected. Please check your details and try again.'));
        return redirect()->route('index');
    }
















    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {



        $date = Carbon::parse($order->created_at)->format('M d, Y, h:i A (ET)');

        return view('admin.order.show',get_defined_vars());
    }
    public function getorder($id)
    {

        $order = Order_Pro::with([
            'product:id,title_en,title_ar,photo,price,price1',




        ])->where('order_id',$id)->get();

        return DataTables::of($order)

            ->make(true);


        // $order = Order_Pro::where('order_id',$id)->get( );



        // return DataTables::of($order)

        //     ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request)
    {

        $ex = explode(',', $request->id);

 Order_Pro::whereIn('order_id', $ex)->delete();

 Order::whereIn('id', $ex)->delete();

 session()->flash('success', __('admin.Deleted Successfully'));

 return redirect()->route('order');


    }
}
