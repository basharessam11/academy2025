<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Marketing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketingController extends Controller
{
      use HasCrudPermissions;


public function __construct()
{
     $this->middleware('permission:view marketing')->only(['index', 'show']);

     $this->middleware('permission:edit marketing')->only(['edit', 'update']);

     $this->middleware('permission:delete marketing')->only(['destroy']);

 }

    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    // إحصائيات
    $month = Marketing::whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year)
                      ->when(!Auth::user()->can('create marketing'), function($q) {
                    // لو مفيش صلاحية إنشاء، عرض اللي يخص المستخدم فقط
                    $q->where('user_id', Auth::id());
                }) ->count(); // حجوزات الشهر الحالي

    $today = Marketing::whereDate('created_at', Carbon::today())->when(!Auth::user()->can('create marketing'), function($q) {
                    // لو مفيش صلاحية إنشاء، عرض اللي يخص المستخدم فقط
                    $q->where('user_id', Auth::id());
                })->count(); // حجوزات اليوم
    $yesterday = Marketing::whereDate('created_at', Carbon::yesterday())->when(!Auth::user()->can('create marketing'), function($q) {
                    // لو مفيش صلاحية إنشاء، عرض اللي يخص المستخدم فقط
                    $q->where('user_id', Auth::id());
                })->count(); // حجوزات الأمس

    // جلب السجلات مع user relation
    $query = Marketing::with('user:id,name_ar,name_en')
                ->when(!Auth::user()->can('create marketing'), function($q) {
                    // لو مفيش صلاحية إنشاء، عرض اللي يخص المستخدم فقط
                    $q->where('user_id', Auth::id());
                });

    // البحث بالاسم أو الهاتف
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    // البحث باليوزر
    if ($request->filled('user_id') && $request->user_id != 'all') {
        $query->where('user_id', $request->user_id);
    }

    // البحث بالتاريخ
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('created_at', [
            $request->from_date . " 00:00:00",
            $request->to_date . " 23:59:59"
        ]);
    } elseif ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    } elseif ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    // جلب النتائج مع ترتيب الصفحات
    $clients = $query->orderBy('created_at', 'desc')->paginate(10);

    // جلب جميع مستخدمي التسويق (للفلاتر)
 $users = User::when(Auth::user()->can('create marketing'), function($q) {
            $q->whereHas('roles', function ($q) {
                $q->where('name', 'marketing');
            });
        }, function($q) {
            $q->where('id', Auth::id());
        })->get(['id','name_ar','name_en']);

    return view('admin.marketing.index', compact('clients','users','month','today','yesterday'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create($user_id)
    {

         return view('web.marketing', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
  $request->validate([
        'name'           => 'required|string|max:255',
        'location'       => 'required|string|max:255',
        'phone'          => ['required', 'regex:/^[0-9]{10,11}$/'],
        'contact_method' => 'required|integer|in:1,2,3',
        'education'      => 'required|string|max:255',
        'user_id'        => 'required|exists:users,id',
    ], [
        'phone.regex' => 'رقم الهاتف يجب أن يكون مكون من 10 أو 11 رقم فقط',
    ]);

    // دمج الكود مع الرقم
    $fullPhone = $request->country . $request->phone;

    Marketing::create([
        'name'           => $request->name,
        'location'       => $request->location,
        'phone'          => $fullPhone,
        'contact_method' => $request->contact_method,
        'education'      => $request->education,
        'user_id'        => $request->user_id,
    ]);

    return redirect()->back()->with('success', 'تم التسجيل بنجاح');
}


    /**
     * Display the specified resource.
     */
    public function show(Marketing $marketing)
    {
        return view('admin.marketing.show', compact('marketing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Marketing $marketing)
{
    if (auth()->user()->hasRole(['admin','marketing'])) {
        // الادمن يقدر يشوف كل المستخدمين
        $users = User::get(['id', 'name_ar', 'name_en']);
    } else {
        // غير الادمن يشوف نفسه فقط
        $users = User::where('id', auth()->id())->get(['id', 'name_ar', 'name_en']);

        // حماية: يمنع تعديل أي سجل مش خاص به
        if ($marketing->user_id != auth()->id()) {
            abort(403, 'غير مصرح لك بتعديل هذا السجل');
        }
    }

    return view('admin.marketing.edit', compact('marketing', 'users'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marketing $marketing)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'phone'          => 'required|string|max:50',
            'contact_method' => 'required|integer|in:1,2,3',
            'education'      => 'required|string|max:255',

        ]);

        $marketing->update($request->all());

        return redirect()->route('marketing.index')->with('success', __('admin.Updated Successfully'));
    }





    public function note(Request $request)
    {
        // return $request;
        $request->validate([
            'note'           => 'required|string|max:255',
        ]);

         $marketing =Marketing::findOrFail($request->id);
        if ($marketing) {
             $marketing->update([
            'note'=>$request->note,
            'status'=>1,
        ]);
        }


        return redirect()->back()->with('success', __('admin.Updated Successfully'));
    }
    /**
     * Remove the specified resource from storage.
     */

        public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Marketing::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('marketing.index');
    }
}

