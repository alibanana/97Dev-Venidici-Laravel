<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reviews = new Review;
    
            if ($request->has('sort')) {
                if ($request['sort'] == "latest") {
                    $reviews = $reviews->orderBy('created_at', 'desc');
                } else {
                    $reviews = $reviews->orderBy('created_at');
                }
            } else {
                $reviews = $reviews->orderBy('created_at', 'desc');
            }
    
            if ($request->has('search')) {
                if ($request->search == "") {
                    $url = route('admin.reviews.index', request()->except('search'));
                    return redirect($url);
                } else {
                    $reviews = $reviews->where('description', 'like', "%".$request->search."%");
                }
            }
    
            $reviews = $reviews->get();
        return view('admin/reviews',compact('reviews'));
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
        //
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
        $review = Review::findOrFail($id);
        $review->delete();

        $message = 'review (' . $review->description . ') has been deleted.';
        
        return redirect()->route('admin.reviews.index')->with('message', $message);
    }
}
