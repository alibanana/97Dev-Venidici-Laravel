<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;  

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = new Notification;
    
            if ($request->has('sort')) {
                if ($request['sort'] == "latest") {
                    $notifications = $notifications->orderBy('created_at', 'desc');
                } else {
                    $notifications = $notifications->orderBy('created_at');
                }
            } else {
                $notifications = $notifications->orderBy('created_at', 'desc');
            }
    
            if ($request->has('search')) {
                if ($request->search == "") {
                    $url = route('admin.notifications.index', request()->except('search'));
                    return redirect($url);
                } else {
                    $notifications = $notifications->where('title', 'like', "%".$request->search."%");
                }
            }
    
            $notifications = $notifications->where('isInformation',1)->get();
        return view('admin/information/index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/information/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'link'          => 'required',
            'description'   => 'required'
        ]);

        $notification                   = new Notification();
        $notification->isInformation    = 1;
        $notification->title            = $validated['title'];
        $notification->description      = $validated['description'];
        $notification->link             = $validated['link'];
        $notification->save();

        $message = 'New notification (' . $notification->title . ') has been added to the database.';

        return redirect()->route('admin.informations.index')->with('message', $message);
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
        $notification = Notification::findOrFail($id);

        return view('admin/information/update',compact('notification'));
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
            'title'         => 'required',
            'link'          => 'required',
            'description'   => 'required'
        ]);

        $notification = Notification::findOrFail($id);
        $notification->title            = $validated['title'];
        $notification->description      = $validated['description'];
        $notification->link             = $validated['link'];

        
        $notification->save();

        if ($notification->wasChanged()) {
            $message = 'notification (' . $notification->title . ') has been updated.';
        } else {
            $message = 'No changes was made to notification (' . $notification->title . ')';
        }

        return redirect()->route('admin.informations.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        $message = 'notification (' . $notification->title . ') has been deleted.';
        
        return redirect()->route('admin.informations.index')->with('message', $message);
    }
}
