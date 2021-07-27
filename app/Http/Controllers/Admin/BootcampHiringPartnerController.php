<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampHiringPartner;

class BootcampHiringPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = new BootcampHiringPartner;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $partners = $partners->orderBy('created_at', 'desc');
            } else {
                $partners = $partners->orderBy('created_at');
            }
        } else {
            $partners = $partners->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.partners.index', request()->except('search'));
                return redirect($url);
            } else {
                $partners = $partners->where('name', 'like', "%".$request->search."%");
            }
        }

        $partners = $partners->get();

        return view('admin/bootcamphiringpartner/index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/bootcamphiringpartner/create');
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
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:5000',
        ]);

        $partner = new BootcampHiringPartner();
        $partner->course_id     = $id;
        $partner->image         = Helper::storeImage($request->file('image'), 'storage/images/hiring-partners/');
        $partner->save();

        $message = 'New partner (' . $partner->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'hiring-partner-page');
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
        //
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
            'image'         => 'required',
        ]);

        unlink($course->thumbnail);
        $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp/');
        

        $partner           = BootcampHiringPartner::findOrFail($id);
        $partner->image    = $validated['image'];
        
        
        $course->save();

        if ($partner->wasChanged()) {
            $message = 'partner (' . $partner->title . ') has been updated.';
        } else {
            $message = 'No changes was made to partner (' . $partner->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $partner->course->id)
            ->with('message', $message)
            ->with('page-option', 'hiring-partner-page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = BootcampHiringPartner::where('course_id',$id)->first();
        unlink($career->thumbnail);
        $career->delete();

        $message = 'partner (' . $partner->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'hiring-partner-page');
    }
    
}
