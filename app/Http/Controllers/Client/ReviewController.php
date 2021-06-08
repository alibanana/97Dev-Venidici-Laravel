<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
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
    public function store(Request $request)
    {
        $input = $request->all();

        $validated = Validator::make($input,[
            'rating' => 'required'
        ]);
        

        if($validated->fails() && $request->action == "completed_course") return redirect()->back()->withErrors($validated);
        if($validated->fails() && $request->action == "course_detail_review") return redirect('/online-course/'.$request->course_id.'#review-section')->with('review_message','Tidak bisa review kosong.')->withErrors($validated);

        $reviews = Review::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['course_id', '=', $request->course_id],
                
            ]
        )->get();

        if(count($reviews) != 0)
        {
            if($request->action == "completed_course")
                return redirect()->back()->with('review_message_double','Anda sudah mereview course ini');
            else
                return redirect('/online-course/'.$request->course_id.'#review-section')->with('review_message','Anda sudah mereview course ini');
        }
        else
        {
            $review = Review::create([
                'user_id'       => auth()->user()->id,
                'course_id'     => $request->course_id,
                'review'        => $request->rating,
                'description'   => $request->description
            ]);
        }
        if($review){
            if($request->action == "completed_course")
                return redirect()->back()->with('review_message','Review berhasil dimasukkan');
            else
                return redirect('/online-course/'.$request->course_id.'#review-section')->with('review_message','Review berhasil dimasukkan');
        }
        else{
            if($request->action == "completed_course")
                return redirect()->back()->with('review_message','Oops.. an error has occured');
            else
                return redirect('/online-course/'.$request->course_id.'#review-section')->with('review_message','Oops.. an error has occured');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
