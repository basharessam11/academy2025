<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CardController extends Controller
{


 use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('card');
    }





    public function index(Request $request)
    {

        $query = Card::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('note', 'LIKE', "%{$search}%") ;

        }


        if ($request->has('from_date') && $request->from_date != '') {
            $query->whereDate('created_at', '>=',  $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date != '') {
            $query->whereDate('created_at', '<=',  $request->to_date);
        }

        $cards = $query->orderBy('created_at', 'desc')->paginate(10); // هنا يتم تفعيل التصفح



        return view('admin.card.index', get_defined_vars());
    }


    public function create()
    {
        return view('admin.card.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardRequest $request)
    {


        //   return $request;
        if ($request->type ==2 && $request->hasFile('photo')) {

            foreach ($request->file('photo') as $file) {


                // إنشاء سجل جديد لكل ملف
                $card = Card::create([
                    'type' => $request->type,

                    'photo' =>  null
                ]);
                $card->setImageAttribute([$file]);
            }


        }

        if ($request->type == 1 && $request->video_url) {
            foreach ($request->video_url as $key=>$url) {
                if (!empty($url)) {
                    $card = Card::create([
                        'type' => $request->type,
                        'url' => $url,
                    ]);
                    if ($request->hasFile('photo1') ) {
                        $card->setImageAttribute([$request->file('photo1')[$key]]);
                        $card->save();
                    }

                }
            }
        }


        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('card.index');
    }




    public function edit( $id)
    {

        $card = Card::findOrFail($id);
        return view('admin.card.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CardRequest  $request,$id)
    {




        $card = Card::findOrFail($id);
        $card->update($request->except(['photo','photo1']) );

        if ($request->hasFile('photo1') ) {
            if ($card->photo) {
                Storage::disk('card')->delete($card->photo);
            }
            $card->setImageAttribute([$request->file('photo1')]);
            $card->save();
        }

        if ($request->hasFile('photo')) {
            $card = Card::findOrFail($id);

            if ($card->photo) {
                Storage::disk('card')->delete($card->photo);
            }
            $card->setImageAttribute([$request->file('photo')]);
            $card->save();
        }


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('card.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $card = Card::findOrFail($value);
    if ($card->photo) {
        Storage::disk('card')->delete($card->photo);
    }
    $card->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('card.index');
    }
}
