<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\ArtSupply;

/*
|--------------------------------------------------------------------------
| Admin ArtSupplyController Class.
|
| Description:
| This controller is responsible in handling the admin's woki course -> art
| supplies and methods related to it.
|--------------------------------------------------------------------------
*/
class ArtSupplyController extends Controller
{
    // Shows the Admin Woki Course -> Art Supplies page.
    public function index(Request $request) {
        $artSupplies = new ArtSupply;

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.art-supplies.index', request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;

                $artSupplies = $artSupplies
                    ->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['description', 'like', "%".$search."%"]]);
            }
        }

        $artSupplies = $artSupplies->get();

        return view('admin/art-supply/index', compact('artSupplies'));
    }

    // Shows the Admin Create Art Supplies page.
    public function create() {
        return view('admin/art-supply/create');
    }

    // Stores new Art Supply in the database.
    public function store(Request $request) {
        $validated = $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required',
            'description' => 'required'
        ]);

        $artSupply = ArtSupply::create([
            'image' => Helper::storeImage($request->file('image'), 'storage/images/art-supplies/'),
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return redirect()->route('admin.art-supplies.index')->with('message', 'New Art Supply has been added to the database.');
    }

    // Shows the Admin Art Supplies page.
    public function edit($id) {
        $artSupply = ArtSupply::findOrFail($id);

        return view('admin/art-supply/update', compact('artSupply'));
    }

    // Update a specific Art Supply in the database.
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'image' => 'mimes:png,jpg,jpeg',
            'name' => 'required',
            'description' => 'required'
        ]);

        $artSupply = ArtSupply::findOrFail($id);
        $artSupply->name = $validated['name'];
        $artSupply->description = $validated['description'];

        if ($request->has('image')) {
            unlink($artSupply->image);
            $artSupply->image = Helper::storeImage($request->file('image'), 'storage/images/art-supplies/');
        }
        $artSupply->save();

        if ($artSupply->wasChanged())
            $message = 'Art Supply (' . $artSupply->name . ') has been changed in the database.';
        else
            $message = 'No changes was detected..';

        return redirect()->route('admin.art-supplies.index')->with('message', $message);
    }

    // Deletes an Art Supply from the database.
    public function destroy($id) {
        $artSupply = ArtSupply::findOrFail($id);

        unlink($artSupply->image);
        $artSupply->delete();

        $message = 'Art Supply (' . $artSupply->name . ') has been deleted from the database.';
        return redirect()->route('admin.art-supplies.index')->with('message', $message);
    }
}
