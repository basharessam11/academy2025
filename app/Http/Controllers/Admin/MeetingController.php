<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
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

                    use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('meeting');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب الاجتماعات مع بيانات المستخدم المحددة، مع التصفح (pagination)
        $meetings = Meeting::with([
            'user:id,name_en,phone,photo', // تحديد الحقول المطلوبة فقط من جدول المستخدم
        ])
        ->orderBy('created_at', 'desc') // ترتيب النتائج حسب تاريخ الإنشاء
        ->paginate(10, ['id', 'topic', 'start_at', 'join_url', 'start_url', 'user_id']); // التصفح (pagination) مع تحديد الحقول المطلوبة

        // إرسال المتغيرات إلى الـ View
        return view('admin.meeting.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( )
    {
        return view('admin.meeting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return$request;
        $meeting = $this->createMeeting($request);
        $user_id = Auth::guard('teacher')->check()
        ? Auth::guard('teacher')->user()->id
        : Auth::user()->id;


        //   return$meeting['data'] ;
             Meeting::create([


                'user_id' => $user_id,


                'meeting_id' => $meeting['data']['id'],
                'topic' => $request->topic,
                'start_at' => $request->start_at,
                'duration' => $meeting['data']['duration'],

                'start_url' => $meeting['data']['start_url'],
                'join_url' =>$meeting['data']['join_url'],
            ]);

            session()->flash('success',  __('admin.Created Successfully'));
            return redirect()->route('meeting.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $zoom = Setting::findOrFail(1);
        return view('admin.zoom.index',get_defined_vars());
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
