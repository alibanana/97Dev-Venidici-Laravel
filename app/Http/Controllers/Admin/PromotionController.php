<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;   

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        $promotions = new Promotion;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $promotions = $promotions->orderBy('created_at', 'desc');
            } else {
                $promotions = $promotions->orderBy('created_at');
            }
        } else {
            $promotions = $promotions->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.promotions.index', request()->except('search'));
                return redirect($url);
            } else {
                $promotions = $promotions->where('code', 'like', "%".$request->search."%");
            }
        }

        $promotions = $promotions->get();

        return view('admin/promotion/index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/promotion/create');
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
            'code'          => 'required|unique:promotions',
            'type'          => 'required',
            'promo_for'     => 'required',
            'discount'      => 'required',
            'start_date'    => 'required|date_format:Y-m-d',
            'finish_date'   => 'required|date_format:Y-m-d',
        ]);
    

        $promotion = new Promotion();
        $promotion->code            = $validated['code'];
        $promotion->type            = $validated['type'];
        $promotion->promo_for       = $validated['promo_for'];
        $promotion->discount        = $validated['discount'];
        $promotion->isActive        = 1;
        $promotion->start_date      = $validated['start_date'];
        $promotion->finish_date     = $validated['finish_date'];
        $promotion->save();

        $message = 'New promotion (' . $promotion->code . ') has been added to the database.';

        return redirect()->route('admin.promotions.index')->with('message', $message);
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
        $promotion = Promotion::findOrFail($id);

        return view('admin/promotion/update', compact('promotion'));
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
            'code'          => 'required',
            'type'          => 'required',
            'promo_for'     => 'required',
            'discount'      => 'required',
            'start_date'    => 'required|date_format:Y-m-d',
            'finish_date'   => 'required|date_format:Y-m-d',
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->code        = $validated['code'];
        $promotion->type        = $validated['type'];
        $promotion->promo_for   = $validated['promo_for'];
        $promotion->discount    = $validated['discount'];
        $promotion->start_date  = $validated['start_date'];
        $promotion->finish_date = $validated['finish_date'];

        
        $promotion->save();

        if ($promotion->wasChanged()) {
            $message = 'promotion (' . $promotion->code . ') has been updated.';
        } else {
            $message = 'No changes was made to promotion (' . $promotion->code . ')';
        }

        return redirect()->route('admin.promotions.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        $message = 'promotion (' . $promotion->code . ') has been deleted.';
        
        return redirect()->route('admin.promotions.index')->with('message', $message);
    }

    public function donations_index(Request $request) {
        $promotions = new Promotion;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $promotions = $promotions->orderBy('created_at', 'desc');
            } else {
                $promotions = $promotions->orderBy('created_at');
            }
        } else {
            $promotions = $promotions->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.donations.index', request()->except('search'));
                return redirect($url);
            } else {
                $promotions = $promotions->where('code', 'like', "%".$request->search."%");
            }
        }

        $promotions = $promotions->where('promo_for','charity')->get();

        return view('admin/donations', compact('promotions'));
    }
}
