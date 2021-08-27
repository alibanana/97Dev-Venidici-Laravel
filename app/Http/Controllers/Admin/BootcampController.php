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
use App\Models\BootcampCourseDetail;
use App\Models\CourseFeature;
use App\Models\Hashtag;
use App\Models\BootcampApplication;
use App\Models\Notification;

use App\Models\User;
use App\Models\UserDetail;

use App\Mail\BootcampFullRegistrationMail;
use Illuminate\Support\Facades\Mail;

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
        $tags = Hashtag::all();

        return view('admin/bootcamp/create', compact('course_categories','tags'));

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
            'meeting_link' => '',
            'what_will_be_taught' => 'required',
            'description' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'trial_date_end' => 'required',
            'hashtags' => 'required|array|min:1'

        ])->setAttributeNames([
            'course_category_id' => 'category',
        ])->validate();

        $course                     = new Course;
        $course->course_type_id     = 3; //3 seharusnya bootcamp
        $course->course_category_id = $validated['course_category_id'];
        $course->thumbnail          = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp-courses/');
        $course->title              = $validated['title'];
        $course->subtitle           = $validated['subtitle'];
        $course->description        = $validated['description'];
        $course->save();


        $added_hashtag_ids = [];
        foreach ($request->hashtags as $tag_id) {
            if (!in_array($tag_id, $added_hashtag_ids)) {
                $added_hashtag_ids[] = $tag_id;
            }
        }
        $course->hashtags()->attach($added_hashtag_ids);

        $bootcampCourseDetail                       = new BootcampCourseDetail;
        $bootcampCourseDetail->what_will_be_taught  = $validated['what_will_be_taught'];
        $bootcampCourseDetail->course_id            = $course->id;
        $bootcampCourseDetail->meeting_link         = $validated['meeting_link'];
        $bootcampCourseDetail->date_start           = $validated['date_start'];
        $bootcampCourseDetail->date_end             = $validated['date_end'];
        $bootcampCourseDetail->trial_date_end       = $validated['trial_date_end'];
        $bootcampCourseDetail->save();

        return redirect()->route('admin.bootcamp.index')->with('message', 'New Bootcamp has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($course->courseType->type == 'Woki') {
            return redirect()->route('admin.bootcamp.show', $id);
        }
        elseif($course->courseType->type == 'Course') {
            return redirect()->route('admin.bootcamp.show', $id);
        }

        $users = BootcampApplication::where('course_id',$id);

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $users = $users->orderBy('created_at', 'desc');
            } else {
                $users = $users->orderBy('created_at');
            }
        } else {
            $users = $users->orderBy('created_at', 'desc');
        }
        if ($request->has('filter')) {
            if ($request['filter'] == "ft_pending") {
                $users = $users->where('status', 'ft_pending');
            }
            elseif($request['filter'] == "ft_paid") {
                $users = $users->where('status', 'ft_paid');
            }
            elseif($request['filter'] == "ft_refunded") {
                $users = $users->where('status', 'ft_refunded');
            }
            elseif($request['filter'] == "ft_cancelled") {
                $users = $users->where('status', 'ft_cancelled');
            }
            elseif($request['filter'] == "waiting") {
                $users = $users->where('status', 'waiting');
            }
            elseif($request['filter'] == "approved") {
                $users = $users->where('status', 'approved');
            }
            elseif($request['filter'] == "denied") {
                $users = $users->where('status', 'denied');
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

    public function edit($id)
    {
        return view('admin/bootcamp/update');
    }

    // Archive (isDeleted -> true) Bootcamp Course from the database.
    public function archive($id) {
        $result = CourseHelper::makeIsDeletedTrueById($id);
        return redirect()->route('admin.bootcamp.index')->with('message', $result['message']);
    }

    // UnArchive (isDeleted -> false) Bootcamp Course from the database.wo
    public function unArchive($id) {
        $result = CourseHelper::makeIsDeletedFalseById($id);
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

    // Remove a syllabus from an existing Course's Section-Content.
    public function removeSyllabus($id) {
        $content = BootcampCourseDetail::where('course_id',$id)->first();

        if (!is_null($content->syllabus)) {
            unlink($content->syllabus);
            $content->syllabus = null;
            $content->save();
        }

        $message = 'Syllabus in Course (' . $content->course->title  . ') has been deleted from the database';

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'basic-informations');
    }

    public function changeApplicationStatus(Request $request, $id){
        $application = BootcampApplication::findOrFail($id);
        if($request->action == 'Approved' || $request->action == 'Upgrade')
        {
            $application->status = 'approved';
            $title = 'Selamat, pendaftaran Bootcamp kamu telah diterima!';
            $description = 'Hi, '.$application->name.'. Pendaftaran bootcamp '.$application->course->title.' kamu telah diterima. Click disini untuk melihat status';
            $user = User::findOrFail($application->user_id);
            if (!$user->courses->contains($application->course->id)) {
                $user->courses()->syncWithoutDetaching([$application->course->id]);
                if ($application->course->assessment()->exists()) {
                    $user->assessments()->syncWithoutDetaching([$application->course->assessment->id]);
                }
            }
            
        }
        elseif($request->action == 'Reject'){
            //kalau daftar full regis
            if($application->is_full_registration && !$application->is_trial){
                $application->status = 'denied';
            //kalau upgrade
            }else{
                $application->status = 'ft_paid';
                $application->is_full_registration = null;
            }
            $title = 'Ouch.. pendaftaran Bootcamp kamu telah ditolak!';    
            $description = 'Hi, '.$application->name.'. Pendaftaran bootcamp '.$application->course->title.' kamu telah ditolak.';    
        }
        elseif($request->action == 'Refund'){
            $application->status = 'ft_refunded';
            $description = 'Hi, '.$application->name.'. Pendaftaran bootcamp kamu telah berhasil di refund.';    

            $title = 'Pendaftaran Bootcamp kamu telah di refund!';    
        }
        
        $application->save();
        $notification_data = [
            'user_id' => $application->user_id,
            'isInformation' => 1,
            'title' => $title,
            'description' => $description,
            'link' => '/dashboard'
        ];

        // Create notification for user.
        Notification::create($notification_data);

        $message = 'Application for user (' . $application->name . ') has been changed';

        return redirect()->route('admin.bootcamp.show',$application->course_id)->with('message', $message);

    }

    public function syllabusRequests($course_id){
        $course = Course::findOrFail($course_id);
        return view('admin/bootcamp/syllabus-list', compact('course'));
    }
}
