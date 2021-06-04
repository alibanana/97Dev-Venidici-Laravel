<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter as News;
use Newsletter;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subscribers = new Newsletter;


        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $subscribers = $subscribers->orderBy('created_at', 'desc');
            } else {
                $subscribers = $subscribers->orderBy('created_at');
            }
        } else {
            $subscribers = $subscribers->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.newsletter.index', request()->except('search'));
                return redirect($url);
            } else {
                $subscribers = $subscribers->where('email', 'like', "%".$request->search."%");
            }
        }

        $subscribers = $subscribers->get();

        return view('admin/newsletter/index', compact('subscribers'));
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
        if(! Newsletter::isSubscribed($request->email)){
            Newsletter::subscribe($request->email);
            return redirect('/#newsletter-section')->with('success', 'Thank you for subscribing to our newsletter!');
        }
        return redirect('/#newsletter-section')->with('failure', 'Sorry you are already subscribed');
        // $validated = $request->validate([
        //     'email' => 'required',
        // ]);

        // $newsletter         = new Newsletter;
        // $newsletter->email  = $validated['email'];
        // $newsletter->save();

        // return redirect('/#newsletter-section')->with('newsletter_message', 'Thank you for subscribing to our newsletter!');
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
        
        $newsletter = Newsletter::findOrFail($id);

        $newsletter->delete();

        return redirect()->route('admin.newsletter.index')->with('message', 'Newsletter has been deleted from the database!');
    }
}
