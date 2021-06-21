<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helper\Helper;
use App\Helper\CourseHelper;

use App\Models\CourseCategory;
use App\Models\Hashtag;
use App\Models\CourseType;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\CourseFeature;
use App\Models\WokiCourseDetail;

/*
|--------------------------------------------------------------------------
| Admin WokiCourseController Class.
|
| Description:
| This controller is responsible in handling the admin's woki course pages
| and methods related to it.
|--------------------------------------------------------------------------
*/
class WokiCourseController extends Controller
{
    // Shows the Admin Woki Course page.
    public function index(Request $request) {
        $course_categories = CourseCategory::select('id', 'category')->get();
        $course_categories_category_flatten = $course_categories->map
            ->only(['category'])
            ->flatten()->toArray();

        $courses = CourseType::where('type', 'Woki')->firstOrFail()->courses();

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $courses = $courses->orderBy('created_at', 'desc');
            } else {
                $courses = $courses->orderBy('created_at');
            }
        } else {
            $courses = $courses->orderBy('created_at', 'desc');
        }

        if ($request->has('filter')) {
            if (!in_array($request->filter, $course_categories_category_flatten)) {
                $url = route('admin.woki-courses.index', request()->except('filter'));
                return redirect($url);
            }

            $filter = $request->filter;

            $courses = $courses->joinSub(CourseCategory::select('id', 'category'), 'course_categories', function ($join) use ($filter) {
                $join->on('courses.course_category_id', '=', 'course_categories.id')
                ->where('course_categories.category', 'like', "%".$filter."%");
            });
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.woki-courses.index', request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;

                $courses = $courses->where(function ($query) use ($search) {
                    $query->where([['title', 'like', "%".$search."%"]])
                    ->orWhere([['subtitle', 'like', "%".$search."%"]]);
                });
            }
        }

        $show_options = [10, 25, 50, 100, "All"];

        if ($request->has('show')) {
            if (!in_array($request->show, $show_options)) {
                return redirect(route('admin.woki-courses.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.woki-courses.index', request()->except(['search', 'page'])));
                }

                $courses = $courses->get();
                $courses_data_flag = 0;
            } else {
                $courses = $courses->paginate($request->show);
                $courses_data_flag = 1;
            }
        } else {
            $courses = $courses->paginate($show_options[0]);
            $courses_data_flag = 1;
        }

        if ($courses_data_flag == 0) {
            $courses_from = 1;
            $courses_count = $courses->count();
            $courses_to = $courses_count;
        } else {
            $courses_to_array = $courses->toArray();
            $courses_from = $courses_to_array['from'];
            $courses_to = $courses_to_array['to'];
            $courses_count = $courses_to_array['total'];
        }

        $show_options_without_all = array_splice($show_options, 0, count($show_options) - 1);
        $show_options_without_all_count = count($show_options_without_all);
        
        $courses_per_page_options = [$show_options_without_all[0]];

        $counter = 0;
        while ($counter < $show_options_without_all_count - 1) {
            $option = $show_options_without_all[$counter];
            if ($courses_count > $option) {
                $courses_per_page_options[] = $show_options_without_all[$counter + 1];
            }
            $counter++;
        }

        $courses_per_page_options[] = "All";

        $courses_data = [
            'per_page_options' => $courses_per_page_options,
            'from' => $courses_from,
            'to' => $courses_to,
            'total' => $courses_count
        ];

        return view('admin/woki/index', compact('course_categories', 'courses', 'courses_data'));
    }

    // Show Admin -> Woki Course Detail Page
    public function show(Request $request, $id) {
        $course = Course::findOrFail($id);

        if ($course->courseType->type == 'Course')
            return redirect()->route('admin.online-courses.show', $id); 

        $users = $course->users();

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $users = $users->orderBy('created_at', 'desc');
            } else {
                $users = $users->orderBy('created_at');
            }
        } else {
            $users = $users->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.woki-courses.show', $id, request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;

                $users = $users->where(function ($query) use ($search) {
                    $query->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['email', 'like', "%".$search."%"]]);
                });
            }
        }

        $users = $users->get();

        $total_earnings = 0; $course_sold = 0; $users_data = [];
        foreach($course->orders as $order) {
            $total_earnings += $order->price;
            $course_sold += $order->qty;
            if (!array_key_exists($order->invoice->user_id, $users_data)) {
                $users_data[$order->invoice->user_id]['invoice_id'] = $order->invoice->id;
                if ($order->withArtOrNo)
                    $users_data[$order->invoice->user_id]['qtyWithArt'] = $order->qty;
                else
                    $users_data[$order->invoice->user_id]['qtyWithoutArt'] = $order->qty;
            } else {
                if (array_key_exists('qtyWithArt', $users_data[$order->invoice->user_id]))
                    $users_data[$order->invoice->user_id]['qtyWithoutArt'] = $order->qty;
                else
                    $users_data[$order->invoice->user_id]['qtyWithArt'] = $order->qty;
            }
        }

        dd($users_data);

        return view('admin/woki/detail', compact('course', 'users', 'total_earnings', 'course_sold', 'users_data'));
    }

    // Shows Admin -> Create Woki Course Page.
    public function create() {
        $course_categories = CourseCategory::select('id', 'category')->get();
        $tags = Hashtag::all();

        return view('admin/woki/create', compact('course_categories', 'tags'));
    }

    // Stores new Woki Course in the database.
    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'subtitle' => 'required',
            'course_category_id' => 'required',
            'preview_video_link' => 'required|starts_with:https://www.youtube.com/embed/',
            'meeting_link' => 'required|starts_with:https://',
            'event_date' => 'required|date_format:Y-m-d|after:now',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'required',
            'requirements' => 'required|array|min:1',
            'features' => 'required|array|min:1',
            'hashtags' => 'required|array|min:1'
        ])->setAttributeNames([
            'course_category_id' => 'category',
            'preview_video_link' => 'video link'
        ])->validate();

        $course = new Course;
        $course->course_type_id = 2; // 2 karna Woki
        $course->course_category_id = $validated['course_category_id'];
        $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/woki-courses/');
        $course->preview_video = $validated['preview_video_link'];
        $course->title = $validated['title'];
        $course->subtitle = $validated['subtitle'];
        $course->description = $validated['description'];
        $course->save();

        foreach ($request->requirements as $requirement_value) {
            if ($requirement_value != "") {
                $new_requirement = new CourseRequirement;
                $new_requirement->course_id = $course->id;
                $new_requirement->requirement = $requirement_value;
                $new_requirement->save();
            }
        }

        foreach ($request->features as $feature_value) {
            if ($feature_value != "") {
                $new_feature = new CourseFeature;
                $new_feature->course_id = $course->id;
                $new_feature->feature = $feature_value;
                $new_feature->save();
            }
        }

        $added_hashtag_ids = [];
        foreach ($request->hashtags as $tag_id) {
            if (!in_array($tag_id, $added_hashtag_ids)) {
                $added_hashtag_ids[] = $tag_id;
            }
        }
        $course->hashtags()->attach($added_hashtag_ids);

        $wokiCourseDetail = new WokiCourseDetail;
        $wokiCourseDetail->course_id = $course->id;
        $wokiCourseDetail->meeting_link = $validated['meeting_link'];
        $wokiCourseDetail->event_date = $validated['event_date'];
        $wokiCourseDetail->start_time = $validated['start_time'];
        $wokiCourseDetail->end_time = $validated['end_time'];
        $eventDuration = Carbon::createFromFormat('H:i', $validated['start_time'])->diffInMinutes(Carbon::createFromFormat('H:i', $validated['end_time']));
        $wokiCourseDetail->event_duration = $eventDuration;
        $wokiCourseDetail->save();

        return redirect()->route('admin.woki-courses.index')->with('message', 'New Woki Course has been added!');
    }

    // Delete Woki Course from the database.
    public function destroy($id) {
        $result = CourseHelper::deleteById($id);
        return redirect()->route('admin.woki-courses.index')->with('message', $result['message']);
    }

    // Change the isFeatured status of the chosen Woki Course to its opposite.
    public function setIsFeaturedStatusToOpposite(Request $request, $id) {
        $result = CourseHelper::setIsFeaturedStatusToOppositeById($id);
        return redirect()->route('admin.woki-courses.index')->with('message', $result['message']);
    }

    // Change the public status of the chosen Woki Course to its opposite.
    public function setPublishStatusToOpposite(Request $request, $id) {
        $result = CourseHelper::setPublishStatusToOppositeById($id);
        return redirect()->route('admin.woki-courses.index')->with('message', $result['message']);
    }
}
