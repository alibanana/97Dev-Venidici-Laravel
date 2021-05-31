<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\KrestProgram;
use App\Models\Krest;
use Illuminate\Support\Facades\Auth;

class KrestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        $programs = KrestProgram::all();
        if(Auth::check()) {
            $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
            $transactions = Notification::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0],
                
            ]
            )->orderBy('created_at', 'desc')->get();            
            return view('client/for-corporate/krest', compact('cart_count','transactions','informations','programs'));
        } else {
            $transactions=null;
            $cart_count=0;
            return view('client/for-corporate/krest', compact('cart_count','transactions','informations','programs'));
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
        $validated = $request->validate([
            'name'              => 'required',
            'email'             => 'required',
            'telephone'         => 'required',
            'company'           => 'required',
            'krest_program_id'  => 'required',
            'subject'           => 'required',
            'message'           => 'required'
        ]);

        $krest                      = new Krest;
        $krest->name                = $validated['name'];
        $krest->email               = $validated['email'];
        $krest->telephone           = $validated['telephone'];
        $krest->company             = $validated['company'];
        $krest->krest_program_id    = $validated['krest_program_id'];
        $krest->subject             = $validated['subject'];
        $krest->message             = $validated['message'];
        $krest->save();

        return redirect()->back()->with('message', 'Thank you! We will get back to you as soon as possible.');
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
