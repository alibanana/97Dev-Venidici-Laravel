<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\KrestProgram;
use App\Models\Krest;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Models\Review;

class BootcampController extends Controller
{
    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $this->notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $this->informations = Notification::where('isInformation', 1)->orderBy('created_at','desc')->get();
        $this->transactions = Notification::where([   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0]
            ])->orderBy('created_at', 'desc')->get();
        $this->cart_count = Cart::with('course')->where('user_id', auth()->user()->id)->count();
    }

    public function index()
    {
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        $programs = KrestProgram::all();

        if (Auth::check()) {

            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            return view('client/for-public/bootcamp', compact('cart_count','transactions','informations','programs','notifications'));
            
        } else {
            return view('client/for-public/bootcamp', compact('programs'));
        }

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
        $reviews = Review::where('course_id',$id)->orderBy('created_at', 'desc')->get();


        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();

        if (Auth::check()) {

            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            return view('client/bootcamp/detail',compact('cart_count','transactions','informations','notifications','reviews'));

        } else {
            return view('client/bootcamp/detail',compact('reviews'));
        }

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
