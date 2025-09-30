<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Expenses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ExpensesController extends Controller
{

            use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('expenses');
    }
    public function index(Request $request)
    {

        $query = Expenses::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('note', 'LIKE', "%{$search}%") ;

        }




         $month = Expenses::whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year)
                         ->count(); // حجوزات الشهر الحالي

         $today = Expenses::whereDate('created_at', Carbon::today())->count(); // حجوزات اليوم
         $yesterday = Expenses::whereDate('created_at', Carbon::yesterday())->count(); // حجوزات الأمس




         // 🔹 البحث بالتاريخ من - إلى
        if ($request->filled('from_date') && $request->filled('to_date') && $request->from_date <= $request->to_date) {

    $from = Carbon::parse($request->from_date)->startOfDay();
    $to = Carbon::parse($request->to_date)->endOfDay();

    $query->whereBetween('created_at', [$from, $to]);

    $total = Expenses::whereBetween('created_at', [$from, $to])->sum('price');

    } elseif ($request->filled('from_date')) {

    $from = Carbon::parse($request->from_date)->startOfDay();

    $query->whereDate('created_at', '>=', $from);

    $total = Expenses::whereDate('created_at', '>=', $from)->sum('price');

} elseif ($request->filled('to_date')) {

    $to = Carbon::parse($request->to_date)->endOfDay();

    $query->whereDate('created_at', '<=', $to);

    $total = Expenses::whereDate('created_at', '<=', $to)->sum('price');

} else {

    $total = Expenses::sum('price');
}




        $expenses = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());



        return view('admin.expenses.index', get_defined_vars());
    }



    public function create()
    {
        return view('admin.expenses.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpensesRequest $request)
    {



        $expenses = Expenses::create($request->all());
        if ($request->hasFile('photo')) {

            $expenses->setImageAttribute([$request->file('photo'),'photo']);
            $expenses->save();
        }




        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('expenses.index');



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $expenses = Expenses::findOrFail($id);
        return view('admin.expenses.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpensesRequest  $request,$id)
    {
        $expenses = Expenses::findOrFail($id);

        $expenses->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            $expenses = Expenses::findOrFail($id);

            if ($expenses->photo) {
                Storage::disk('expenses')->delete($expenses->photo);
            }
            $expenses->setImageAttribute([$request->file('photo'),'photo']);
            $expenses->save();
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $expenses = Expenses::findOrFail($value);
    if ($expenses->photo) {
        Storage::disk('expenses')->delete($expenses->photo);
    }
    $expenses->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('expenses.index');
    }
}
