<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Meeting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jubaer\Zoom\Facades\Zoom;
use Yajra\DataTables\Facades\DataTables;

class MeetingController extends Controller
{
    use MeetingZoomTrait;

    public function index()
    {

        return view('teacher.meeting.index'  );
    }
    public function data()
    {

        $meeting = Meeting::with([
            'customer:id,name,phone,photo',

 ])->orderBy('created_at', 'desc')

 ->get(['id','topic','start_at','join_url','start_url','customer_id'] );

        return DataTables::of($meeting)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($customer_id,$booking_id)
    {
        return view('teacher.meeting.create',get_defined_vars() );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  
        $meeting = $this->createMeeting($request);
        $user_id = Auth::guard('teacher')->check()
        ? Auth::guard('teacher')->user()->id
        : Auth::user()->id;


        //   return$meeting['data'] ;
             Meeting::create([

                'booking_id' => $request->booking_id,
                'user_id' => $user_id,
                'customer_id' => $request->customer_id,

                'meeting_id' => $meeting['data']['id'],
                'topic' => $request->topic,
                'start_at' => $request->start_at,
                'duration' => $meeting['data']['duration'],

                'start_url' => $meeting['data']['start_url'],
                'join_url' =>$meeting['data']['join_url'],
            ]);

            session()->flash('success',  __('admin.Created Successfully'));
            return redirect()->route('meeting2.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $zoom = Setting::findOrFail(1);
        return view('teacher.zoom.index',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'ZOOM_CLIENT_KEY' => 'required|string',
            'ZOOM_CLIENT_SECRET' => 'required|string',
            'ZOOM_ACCOUNT_ID' => 'required|string',
        ]);

        $zoom = Setting::findOrFail(1);
        $zoom->update($request->all());



        return redirect()->route('meeting.edit')->with('success', __('admin.Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $ex = explode(',',$request->id);

        foreach ($ex as $key => $value) {
           $meeting_id = Meeting::findOrFail($value);
              Zoom::deleteMeeting($meeting_id->meeting_id);

            $meeting_id->delete();
        }
        session()->flash('success', __('admin.Deleted Successfully'));
      return redirect()->back();


    }
}
