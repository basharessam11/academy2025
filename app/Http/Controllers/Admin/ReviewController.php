<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{

                    use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('review');
    }
    public function index()
    {


 $startOfWeek = Carbon::now()->subWeek();

$sum = Review::where('created_at', '>=', $startOfWeek)->sum('rate');
$avg1 = Review::where('created_at', '>=', $startOfWeek)->avg('rate');
$avg = number_format($avg1, 2);
$count = Review::where('created_at', '>=', $startOfWeek)->count();
$count5 = Review::selectRaw('rate, count(*) as total')
    ->where('created_at', '>=', $startOfWeek)
    ->groupBy('rate')
    ->get();


    $startOfWeek = Carbon::now()->startOfWeek();
$endOfWeek = Carbon::now()->endOfWeek();


$sun = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 1')
    ->count();

$mon = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 2')
    ->count();

$tue = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 3')
    ->count();

$wed = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 4')
    ->count();

$thu = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 5')
    ->count();

$fri = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 6')
    ->count();

$sat = Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 7')
    ->count();

 $days = [
    'sun'    => $sun,
    'mon'    => $mon,
    'tue'   => $tue,
    'wed' => $wed,
    'thu'  => $thu,
    'fri'    => $fri,
    'sat'  => $sat,
];

$newReviewsCount = Review::whereBetween('created_at', [now()->subWeek(), now()])->count();

$previousWeekReviewsCount = Review::whereBetween('created_at', [  $startOfWeek, $endOfWeek])->count();


$percentageChange = 0;
if ($previousWeekReviewsCount > 0) {
    $percentageChange = (($newReviewsCount - $previousWeekReviewsCount) / $previousWeekReviewsCount) * 100;
}

return view('admin.review.index',get_defined_vars());
    }

    public function data()
    {
        $review = Review::with([
            'product:id,title_en,title_ar,photo',
            'customer:id',

        ])->orderBy('created_at', 'desc') ->get(['id', 'name', 'email' , 'rate', 'product_id','customer_id', 'review','created_at']);



       return DataTables::of($review)

            ->make(true);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
{


     $existingReview = Review::where('product_id', $request->product_id)
                            ->where('customer_id',  auth()->user()->id ?? 1)
                            ->first();

    if ($existingReview) {
        return redirect()->back()->with('error', __('admin.You cannot make more than one review.'));
    }


    $ipAddress = $request->ip();
    $data = $request->all();
    $data['ip_address'] = $ipAddress;
    $data['customer_id'] = auth()->user()->id ?? 1;

    Review::create($data);


    return redirect()->back()->with('success', __('admin.Created Successfully'));
}



}
