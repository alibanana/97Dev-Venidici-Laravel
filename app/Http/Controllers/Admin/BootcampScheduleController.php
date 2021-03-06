<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampSchedule;
use App\Models\BootcampScheduleDetail;
use Illuminate\Support\Facades\Validator;

class BootcampScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/bootcampschedule/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date_start'        => 'required',
            'date_end'          => 'required',
            'title'             => 'required',
            'subtitle'          => 'required',
            'schedule_details'  => 'required|array|min:1'
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'schedule-page'])->withErrors($validator);

        $validated = $validator->validate();

        $schedule = new BootcampSchedule();
        $schedule->course_id    = $id;
        $schedule->date_start   = $validated['date_start'];
        $schedule->date_end     = $validated['date_end'];
        $schedule->title        = $validated['title'];
        $schedule->subtitle     = $validated['subtitle'];
        $schedule->save();

        // Create Schedule Details
        foreach ($validated['schedule_details'] as $detail) {
            if ($detail != "") {
                $new_schedule_detail = new BootcampScheduleDetail();
                $new_schedule_detail->bootcamp_schedule_id  = $schedule->id;
                $new_schedule_detail->description           = $detail;
                $new_schedule_detail->save();
            }
            
        }

        $message = 'New Schedule (' . $schedule->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'schedule-page');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function edit($id)
        {
            $schedule = BootcampSchedule::findOrFail($id);

            return view('admin/bootcamp/update-bootcamp-schedules', compact('schedule'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date_start'    => 'required',
            'date_end'      => 'required',
            'title'         => 'required',
            'subtitle'      => 'required',
            'schedule_details'  => 'required|array|min:1'
        ]);

        $schedule = BootcampSchedule::findOrFail($id);
        $schedule->date_start   = $validated['date_start'];
        $schedule->date_end     = $validated['date_end'];
        $schedule->title        = $validated['title'];
        $schedule->subtitle     = $validated['subtitle'];
        $schedule->save();

        // Delete Schedule Details
        $schedule->bootcampScheduleDetails()->delete();
        // Create Schedule Details
        foreach ($validated['schedule_details'] as $detail) {
            if ($detail != "") {
                $new_schedule_detail = new BootcampScheduleDetail();
                $new_schedule_detail->bootcamp_schedule_id  = $schedule->id;
                $new_schedule_detail->description           = $detail;
                $new_schedule_detail->save();
            }
            
        }

        if ($schedule->wasChanged()) {
            $message = 'Schedule (' . $schedule->title . ') has been updated.';
        } else {
            $message = 'No changes was made to Schedule (' . $schedule->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $schedule->course_id)
            ->with('message', $message)
            ->with('page-option', 'schedule-page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = BootcampSchedule::findOrFail($id);
        $schedule->delete();

        $message = 'Schedule (' . $schedule->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $schedule->course_id)
            ->with('message', $message)
            ->with('page-option', 'schedule-page');
    }
}
