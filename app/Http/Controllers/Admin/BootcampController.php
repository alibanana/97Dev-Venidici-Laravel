<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use App\Helper\CourseHelper;

use App\Models\CourseCategory;
use App\Models\CourseType;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\CourseFeature;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $course_categories = CourseCategory::select('id', 'category')->get();
        $course_categories_category_flatten = $course_categories->map
            ->only(['category'])
            ->flatten()->toArray();

        $courses = CourseType::where('type', 'Bootcamp')->firstOrFail()->courses();

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
                $url = route('admin.bootcamp.index', request()->except('filter'));
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
                $url = route('admin.bootcamp.index', request()->except('search'));
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
                return redirect(route('admin.bootcamp.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.bootcamp.index', request()->except(['search', 'page'])));
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

        return view('admin/bootcamp/index', compact('course_categories', 'courses', 'courses_data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course_categories = CourseCategory::select('id', 'category')->get();

        return view('admin/bootcamp/create', compact('course_categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'subtitle' => 'required',
            'course_category_id' => 'required',
            'preview_video_link' => 'required|starts_with:https://www.youtube.com/embed/',
            'description' => 'required',
            'requirements' => 'required|array|min:1',
        ])->setAttributeNames([
            'course_category_id' => 'category',
            'preview_video_link' => 'video link',
        ])->validate();

        $course = new Course;
        $course->course_type_id = 3; //3 seharusnya bootcamp
        $course->course_category_id = $validated['course_category_id'];
        $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp-courses/');
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

        return redirect()->route('admin.bootcamp.index')->with('message', 'New Online Course has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        if ($course->courseType->type == 'Bootcamp')
            return redirect()->route('admin.bootcamp.show', $id); 

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
                $url = route('admin.bootcamp.show', $id, request()->except('search'));
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

        $total_revenue = 0; $users_data = [];
        foreach($course->orders as $order) {
            if ($order->invoice->status == 'paid' || $order->invoice->status == 'completed') {
                $total_revenue += $order->qty * $order->price;
                $users_data[$order->invoice->user_id]['invoice_id'] = $order->invoice->id;
            }
        }

        return view('admin/bootcamp/detail', compact('course', 'users', 'total_revenue', 'users_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin/bootcamp/update');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Delete Online Course from the database.
    public function destroy($id) {
        $result = CourseHelper::deleteById($id);
        return redirect()->route('admin.bootcamp.index')->with('message', $result['message']);
    }

    // Change the isFeatured status of the chosen Online Course to its opposite.
    public function setIsFeaturedStatusToOpposite(Request $request, $id) {
        $result = CourseHelper::setIsFeaturedStatusToOppositeById($id);
        return redirect()->route('admin.bootcamp.index')->with('message', $result['message']);
    }

    // Change the public status of the chosen Online Course to its opposite.
    public function setPublishStatusToOpposite(Request $request, $id) {
        $result = CourseHelper::setPublishStatusToOppositeById($id);
        return redirect()->route('admin.bootcamp.index')->with('message', $result['message']);
    }
}
