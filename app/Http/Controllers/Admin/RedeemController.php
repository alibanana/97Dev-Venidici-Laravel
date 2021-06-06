<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Redeem; 
class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redeems = new Redeem;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $redeems = $redeems->orderBy('created_at', 'desc');
            } else {
                $redeems = $redeems->orderBy('created_at');
            }
        } else {
            $redeems = $redeems->orderBy('created_at', 'desc');
        }

        $redeems = $redeems->get();

        return view('admin/redeem/index', compact('redeems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/redeem/create');

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
            'stars'          => 'required',
            'type'          => 'required',
            'promo_for'     => 'required',
            'discount'      => 'required',
        ]);
    

        $redeem = new Redeem();
        $redeem->stars            = $validated['stars'];
        $redeem->type            = $validated['type'];
        $redeem->promo_for       = $validated['promo_for'];
        $redeem->discount        = $validated['discount'];
        $redeem->save();

        $message = 'New redeem rule has been added to the database.';

        return redirect()->route('admin.redeems.index')->with('message', $message);
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
        $redeem = Redeem::findOrFail($id);

        return view('admin/redeem/update', compact('redeem'));
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
            'stars'          => 'required',
            'type'          => 'required',
            'promo_for'     => 'required',
            'discount'      => 'required',
        ]);

        $redeem = Redeem::findOrFail($id);
        $redeem->stars        = $validated['stars'];
        $redeem->type        = $validated['type'];
        $redeem->promo_for   = $validated['promo_for'];
        $redeem->discount    = $validated['discount'];

        
        $redeem->save();

        if ($redeem->wasChanged()) {
            $message = 'redeem rule (' . $redeem->discount . ') has been updated.';
        } else {
            $message = 'No changes was made to redeem (' . $redeem->discount . ')';
        }

        return redirect()->route('admin.redeems.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $redeem = Redeem::findOrFail($id);
        $redeem->delete();

        $message = 'Redeem Rule has been deleted.';
        
        return redirect()->route('admin.redeems.index')->with('message', $message);
    }
}
