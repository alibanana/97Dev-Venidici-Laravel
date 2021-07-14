<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampSchedule;

class BootcampScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = new BootcampSchedule;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $schedules = $schedules->orderBy('created_at', 'desc');
            } else {
                $schedules = $schedules->orderBy('created_at');
            }
        } else {
            $schedules = $schedules->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.schedules.index', request()->except('search'));
                return redirect($url);
            } else {
                $schedules = $schedules->where('name', 'like', "%".$request->search."%");
            }
        }

        $schedules = $schedules->get();

        return view('admin/bootcampschedule/index', compact('schedules'));
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
        $validated = $request->validate([
            'date_time' => 'required',
            'title'     => 'required',
            'detail'    => 'required',
        ]);

        $schedule = new BootcampSchedule();
        $schedule->course_id    = $id;
        $schedule->date_time    = $validated['date_time'];
        $schedule->title        = $validated['title'];
        $schedule->detail       = $validated['detail'];
        $schedule->save();

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
    // public function edit($id)
    // {
    //     $schedule = BootcampSchedule::findOrFail($id);

    //     return view('admin/bootcampschedule/update', compact('schedule'));
    // }

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
            'date_time' => 'required',
            'title'     => 'required',
            'detail'    => 'required',
        ]);
        $schedule = BootcampSchedule::findOrFail($id);
        $schedule->date_time    = $validated['date_time'];
        $schedule->title        = $validated['title'];
        $schedule->detail       = $validated['detail'];
        
        $schedule->save();

        if ($schedule->wasChanged()) {
            $message = 'Schedule (' . $schedule->title . ') has been updated.';
        } else {
            $message = 'No changes was made to Schedule (' . $schedule->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $schedule->course->id)
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
        $schedule = BootcampSchedule::where('course_id',$id)->first();
        $schedule->delete();

        $message = 'Schedule (' . $schedule->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'schedule-page');
    }
}
