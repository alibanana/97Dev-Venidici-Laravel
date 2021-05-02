<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\Hashtag;

/*
|--------------------------------------------------------------------------
| Admin HashtagController Class.
|
| Description:
| This controller is responsible in handling the admin's hashtag pages and
| methods related to it.
|--------------------------------------------------------------------------
*/
class HashtagController extends Controller
{
    // Shows the Admin Hashtag Page.
    public function index(Request $request) {
        $tags = Hashtag::withCount('courses');

        if ($request->has('sort')) {
            if ($request['sort'] == "alphabetical") {
                $tags = $tags->orderBy('hashtag');
            } else if ($request['sort'] == "course_count") {
                $tags = $tags->orderBy('courses_count', 'desc');
            }
        } else {
            $tags = $tags->orderBy('hashtag');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.hashtags.index', request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;

                $tags = $tags->where(function ($query) use ($search) {
                    $query->where([['hashtag', 'like', "%".$search."%"]])
                    ->orWhere([['color', 'like', "%".$search."%"]]);
                });
            }
        }

        $show_options = [10, 25, 50, 100, "All"];

        if ($request->has('show')) {
            if (!in_array($request->show, $show_options)) {
                return redirect(route('admin.hashtags.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.hashtags.index', request()->except(['search', 'page'])));
                }

                $tags = $tags->get();
                $tags_data_flag = 0;
            } else {
                $tags = $tags->paginate($request->show);
                $tags_data_flag = 1;
            }
        } else {
            $tags = $tags->paginate($show_options[0]);
            $tags_data_flag = 1;
        }

        if ($tags_data_flag == 0) {
            $tags_from = 1;
            $tags_count = $tags->count();
            $tags_to = $tags_count;
        } else {
            $tags_to_array = $tags->toArray();
            $tags_from = $tags_to_array['from'];
            $tags_to = $tags_to_array['to'];
            $tags_count = $tags_to_array['total'];
        }

        $show_options_without_all = array_splice($show_options, 0, count($show_options) - 1);
        $show_options_without_all_count = count($show_options_without_all);
        
        $tags_per_page_options = [$show_options_without_all[0]];

        $counter = 0;
        while ($counter < $show_options_without_all_count - 1) {
            $option = $show_options_without_all[$counter];
            if ($tags_count > $option) {
                $tags_per_page_options[] = $show_options_without_all[$counter + 1];
            }
            $counter++;
        }

        $tags_per_page_options[] = "All";

        $tags_data = [
            'per_page_options' => $tags_per_page_options,
            'from' => $tags_from,
            'to' => $tags_to,
            'total' => $tags_count
        ];

        return view('admin/hashtag/index', compact('tags', 'tags_data'));
    }

    // Shows the Admin Create New Hashtag Page.
    public function create() {
        return view('admin/hashtag/create');
    }

    // Store New Hashtag in the database.
    public function store(Request $request) {
        $validated = $request->validate([
            'hashtag' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'color' => 'required|string|max:7|starts_with:#'
        ]);

        $tag = new Hashtag;
        $tag->hashtag = $validated['hashtag'];
        $tag->image = Helper::storeImage($request->file('image'), 'storage/images/hashtags/');
        $tag->color = $validated['color'];
        $tag->save();

        return redirect()->route('admin.hashtags.index')->with('message', 'New Hashtag has been added!');
    }

    // Shows the Admin Update Hashtag Page.
    public function edit($id) {
        $tag = Hashtag::findOrFail($id);

        return view('admin/hashtag/update', compact('tag'));
    }

    // Update existing Hashtag in the database.
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'hashtag' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'color' => 'required|string|max:7|starts_with:#'
        ]);
        
        $tag = Hashtag::findOrFail($id);
        $tag->hashtag = $validated['hashtag'];
        $tag->color = $validated['color'];
        
        if ($request->has('image')) {
            unlink($tag->image);
            $tag->image = Helper::storeImage($request->file('image'), 'storage/images/hashtags/');
        }
        
        $tag->save();

        if ($tag->wasChanged()) {
            $message = 'Hashtag (' . $tag->hashtag . ') has been updated!';
        } else {
            $message = 'No changes was made to Hashtag (' . $tag->hashtag . ')';
        }

        return redirect()->route('admin.hashtags.index')->with('message', $message);
    }

    // Delete Hashtag from the database.
    public function destroy($id) {
        $tag = Hashtag::findOrFail($id);

        $course_ids = [];
        foreach ($tag->courses as $course) {
            $course_ids[] = $course->id;
        }
        
        $tag->courses()->detach($course_ids);
        unlink($tag->image);

        $tag->delete();

        return redirect()->route('admin.hashtags.index')->with('message', 'Hashtag has been deleted from the database!');
    }
}
