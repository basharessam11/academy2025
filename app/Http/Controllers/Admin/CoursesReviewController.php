<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses_ReviewRequest;
use App\Models\Courses_Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CoursesReviewController extends Controller
{

    public function __construct()
{
     $this->middleware('permission:view courses_review')->only(['index', 'show']);


     $this->middleware('permission:delete courses_review')->only(['destroy']);

 }
    public function index()
    {


 $startOfWeek = Carbon::now()->subWeek();

$sum = Courses_Review::where('created_at', '>=', $startOfWeek)->sum('rate');
$avg1 = Courses_Review::where('created_at', '>=', $startOfWeek)->avg('rate');
$avg = number_format($avg1, 2);
$count = Courses_Review::where('created_at', '>=', $startOfWeek)->count();
$count5 = Courses_Review::selectRaw('rate, count(*) as total')
    ->where('created_at', '>=', $startOfWeek)
    ->groupBy('rate')
    ->get();


    $startOfWeek = Carbon::now()->startOfWeek();
$endOfWeek = Carbon::now()->endOfWeek();


$sun = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 1')
    ->count();

$mon = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 2')
    ->count();

$tue = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 3')
    ->count();

$wed = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 4')
    ->count();

$thu = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 5')
    ->count();

$fri = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->whereRaw('DAYOFWEEK(created_at) = 6')
    ->count();

$sat = Courses_Review::whereBetween('created_at', [$startOfWeek, $endOfWeek])
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

$newReviewsCount = Courses_Review::whereBetween('created_at', [now()->subWeek(), now()])->count();

$previousWeekReviewsCount = Courses_Review::whereBetween('created_at', [  $startOfWeek, $endOfWeek])->count();


$percentageChange = 0;
if ($previousWeekReviewsCount > 0) {
    $percentageChange = (($newReviewsCount - $previousWeekReviewsCount) / $previousWeekReviewsCount) * 100;
}

return view('admin.courses_review.index',get_defined_vars());
    }

    public function data()
    {
        $review = Courses_Review::with([
            'course:id,title_en,title_ar,photo',
            'customer:id,name,email',
        ])->orderBy('created_at', 'desc')
        ->get(['id' ,'customer_id', 'rate', 'course_id','review','created_at']);



       return DataTables::of($review)

            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Courses_ReviewRequest $request)
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', __('admin.You need to log in to submit a review.'));
    }

     $existingReview = Courses_Review::where('course_id', $request->course_id)


                            ->where('customer_id',Auth::guard('customer')->id ?? 1)
                            ->first();

    if ($existingReview) {
        return redirect()->back()->with('error', __('admin.You cannot make more than one review.'));
    }


    $ipAddress = $request->ip();
    $data = $request->all();
    $data['ip_address'] = $ipAddress;
    $data['customer_id'] =Auth::guard('customer')->id ?? 1;

    Courses_Review::create($data);


    return redirect()->back()->with('success', __('admin.Created Successfully'));
}

public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Courses_Review::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('courses_review.index');
    }
}
