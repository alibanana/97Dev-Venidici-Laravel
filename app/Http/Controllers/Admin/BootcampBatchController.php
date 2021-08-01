<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BootcampBatch;
use Illuminate\Support\Facades\Validator;

class BootcampBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id)
    {

        $validator = Validator::make($request->all(), [
            'date'         => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'batch-page'])->withErrors($validator);

        $validated = $validator->validate();

        $new_batch = new BootcampBatch;
        $new_batch->course_id   = $course_id;
        $new_batch->date        = $validated['date'];
        $new_batch->save();

        $message = 'New Batch (' . $new_batch->date . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'batch-page');
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
        $validator = Validator::make($request->all(), [
            'date'         => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'batch-page'])->withErrors($validator);

        $validated = $validator->validate();


        $batch = BootcampBatch::findOrFail($id);
        $batch->date        = $validated['date'];
        
        $batch->save();

        if ($batch->wasChanged()) {
            $message = 'Batch (' . $batch->date . ') has been updated.';
        } else {
            $message = 'No changes was made to Batch (' . $batch->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $batch->course_id)
            ->with('message', $message)
            ->with('page-option', 'batch-page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = BootcampBatch::findOrFail($id);
        $batch->delete();

        $message = 'Batch (' . $batch->date . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $batch->course_id)
            ->with('message', $message)
            ->with('page-option', 'batch-page');
    }
}
