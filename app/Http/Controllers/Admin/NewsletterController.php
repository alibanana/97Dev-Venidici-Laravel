<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Helper\MailchimpHelper;

use App\Models\Newsletter;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if(!MailchimpHelper::isSubscribed($request->email)){
            $response = MailchimpHelper::subscribe($request->email);
            if ($response['status'] == 'Success') {
                $validated = $request->validate([
                    'email' => 'required',
                ]);
    
                if (!Newsletter::where('email', $validated['email'])->first())
                    Newsletter::create(['email' => $validated['email']]);
                
                // Tambah 10 point
                if (auth()->check() && $request->email == auth()->user()->email) {
                    Helper::addStars(auth()->user(), 10, 'Subscribing to our newsletter');
                    return redirect('/#newsletter-section')->with('newsletter_message', 'Thank you for subscribing to our newsletter. Anda mendapatkan 10 stars!');
                }
                
                return redirect('/#newsletter-section')->with('newsletter_message', 'Thank you for subscribing to our newsletter!');
            } else
                return redirect('/#newsletter-section')->with('newsletter_info_message', 'Sorry, an error occured while subscribing your email!');
        }
        return redirect('/#newsletter-section')->with('newsletter_info_message', 'Sorry, you are already subscribed');

        // return redirect('/#newsletter-section')->with('newsletter_message', 'Thank you for subscribing to our newsletter!');
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
