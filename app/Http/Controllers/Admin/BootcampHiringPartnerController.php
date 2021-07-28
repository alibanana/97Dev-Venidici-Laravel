<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampHiringPartner;
use Illuminate\Support\Facades\Validator;

class BootcampHiringPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id)
    {
        if(BootcampHiringPartner::where('course_id',$course_id)->count() >= 6)
            return redirect()->back()
            ->with('message', 'Maksimum Quantity has been reached!')
            ->with('page-option', 'hiring-partner-page');

        $validator = Validator::make($request->all(), [
            'image'     => 'required|mimes:jpeg,jpg,png|max:5000',
        ]);

        $validated = $validator->validate();


        $partner = new BootcampHiringPartner();
        $partner->course_id     = $course_id;
        $partner->image         = Helper::storeImage($request->file('image'), 'storage/images/bootcamp/hiring-partners/');
        $partner->save();

        $message = 'New partner (' . $partner->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
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
        $validated = Validator::make($request->all(), [
            'image'     => 'mimes:jpeg,jpg,png|max:5000',
        ]);
        
        if ($validated->fails())
            return redirect()->back()->with(['page-option' => 'hiring-partner-page'])->withErrors($validated);


        $partner = BootcampHiringPartner::findOrFail($id);

        if ($request->has('image')) {
            unlink($partner->image);
            $partner->image = Helper::storeImage($request->file('image'), 'storage/images/bootcamp/hiring-partners/');
        }
        
        $partner->save();

        if ($partner->wasChanged()) {
            $message = 'Hiring Partner (' . $partner->image . ') has been updated.';
        } else {
            $message = 'No changes was made to partner (' . $partner->image . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $partner->course_id)
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
        $partner = BootcampHiringPartner::findOrFail($id);
        unlink($partner->image);
        $partner->delete();

        $message = 'Hiring Partner (' . $partner->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $partner->course_id)
            ->with('message', $message)
            ->with('page-option', 'hiring-partner-page');
    }
    
}
