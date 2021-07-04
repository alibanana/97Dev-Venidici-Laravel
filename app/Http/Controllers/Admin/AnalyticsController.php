<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CourseType;
use App\Models\Course;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Admin AnalyticsController Class.
|
| Description:
| This controller is responsible in handling the admin's analytics pages.
|--------------------------------------------------------------------------
*/
class AnalyticsController extends Controller
{
    // Shows the admin Online Courses Analytics page.
    public function onlineCourseIndex(Request $request) {
        $courses = CourseType::where('type', 'Course')->firstOrFail()->courses();
        $coursesCollection = $courses->get();

        $totalCourseSoldCount = $this->calculateTotalCourseSold($coursesCollection);
        $totalRevenue = $this->calculateTotalRevenue($coursesCollection);
        $individualCourseSoldData = $this->getIndividualTotalOnlineCourseSold($coursesCollection);

        if ($request->has('sort')) {
            if ($request['sort'] == "alpha") {
                $courses = $courses->orderBy('title');
            } elseif ($request['sort'] == "alpha_desc") {
                $courses = $courses->orderBy('title', 'desc');
            } else {
                $url = route('admin.analytics.online-course.index', request()->except('sort'));
                return redirect($url);
            }
        } else {
            $courses = $courses->orderBy('title');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.analytics.online-course.index', request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;
                $courses = $courses->where([
                        ['title', 'like', "%".$search."%"],
                        ['subtitle', 'like', "%".$search."%"],
                    ]);
            }
        }

        $show_options = [10, 25, 50, 100, "All"];

        if ($request->has('show')) {
            if (!in_array($request->show, $show_options)) {
                return redirect(route('admin.analytics.online-course.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.analytics.online-course.index', request()->except(['search', 'page'])));
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

        return view('admin/analytics/online-course', compact('courses', 'courses_data', 'totalCourseSoldCount', 'totalRevenue', 'individualCourseSoldData'));
    }

    // Shows the admin Woki Course Analytics page.
    public function wokiCourseIndex(Request $request) {
        $courses = CourseType::where('type', 'Woki')->firstOrFail()->courses();
        $coursesCollection = $courses->get();

        // Get number of online-courses Sold.
        $totalCourseSoldCount = $this->calculateTotalCourseSold($coursesCollection);
        $totalRevenue = $this->calculateTotalRevenue($coursesCollection);
        $individualCourseSoldData = $this->getIndividualTotalWokiCourseSoldGroupByWithArtKit($coursesCollection);

        if ($request->has('sort')) {
            if ($request['sort'] == "alpha") {
                $courses = $courses->orderBy('title');
            } elseif ($request['sort'] == "alpha_desc") {
                $courses = $courses->orderBy('title', 'desc');
            } else {
                $url = route('admin.analytics.woki-course.index', request()->except('sort'));
                return redirect($url);
            }
        } else {
            $courses = $courses->orderBy('title');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.analytics.woki-course.index', request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;
                $courses = $courses->where([
                        ['title', 'like', "%".$search."%"],
                        ['subtitle', 'like', "%".$search."%"],
                    ]);
            }
        }

        $show_options = [10, 25, 50, 100, "All"];

        if ($request->has('show')) {
            if (!in_array($request->show, $show_options)) {
                return redirect(route('admin.analytics.woki-course.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.analytics.woki-course.index', request()->except(['search', 'page'])));
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

        return view('admin/analytics/woki-course', compact('courses', 'courses_data', 'totalCourseSoldCount', 'totalRevenue', 'individualCourseSoldData'));
    }

    // Method to calculate the total numeber of course sold from list of courses.
    private function calculateTotalCourseSold($courses) {
        return $courses->map(function ($course, $key) {
            /*
            | If CourseType == Woki :
            |  - Use logic from getTotalCourseSoldFromCourseObject($course) to get the total amount of course sold.
            | Else (if the courseType != Woki) :
            |  - Total number of course sold for that particular course will always be equal to the total
            |    number of users mapped to the course.
            */
            if ($course->courseType->type == 'Woki') {
                $totalWokiSoldData = $this->getTotalCourseSoldFromCourseObjectGroupByWithArtOrNo($course);
                return $totalWokiSoldData['withArtKit'] + $totalWokiSoldData['withoutArtKit'];
            }
            return count($course->users);
        })->sum();
    }

    // Method to calculate the total revenue from list of courses.
    private function calculateTotalRevenue($courses) {
        /*
        | Generate a list of course_ids from the list of course objects. Then crosscheck
        | the course_id of all the orders data and get the revenue (qty * price) for each
        | order object.
        */
        $course_ids = $this->getCourseIdsFromListOfCourse($courses);
        return Order::all()->map(function ($order) use ($course_ids) {
            if ($order->invoice->status == 'paid' || $order->invoice->status == 'completed') {
                if (in_array($order->course_id, $course_ids))
                    return $order->qty * $order->price;
            }
            return 0;
        })->sum();
    }

    // Method to retrive the courses' ids from a list of courses.
    private function getCourseIdsFromListOfCourse($courses) {
        return $courses->map(function ($course, $key) {
            return $course->id;
        })->toArray();
    }

    // Method to calculate the amount of online-courses sold for a particular online-course
    // from a list of online-courses.
    private function getIndividualTotalOnlineCourseSold($courses) {
        return $courses->mapWithKeys(function ($course) {
            return [
                $course->id => $this->getTotalCourseSoldFromCourseObjectGroupByWithArtOrNo($course)['withoutArtKit']
            ];
        })->toArray();
    }

    // Method to calculate the amount of woki-courses sold for a particular woki-course
    // from a list of woki-courses.
    private function getIndividualTotalWokiCourseSoldGroupByWithArtKit($courses) {
        return $courses->mapWithKeys(function ($course) {
            return [
                $course->id => $this->getTotalCourseSoldFromCourseObjectGroupByWithArtOrNo($course)
            ];
        })->toArray();
    }

    // Method to get the amount of course sold from a course object, separating
    // the number of sold courses with and without artKit.
    private function getTotalCourseSoldFromCourseObjectGroupByWithArtOrNo($course) {
        $course_id = $course->id;

        // Collect total amount of courses sold which will be grouped by users, invoices & withArtOrNo.
        $totalQuantityGroupByUsersAndInvoices = $course->users()->get()->map(function ($user) use ($course_id) {
            return $user->invoices()->where('status', 'paid')->orWhere('status', 'completed')->get()
                ->map(function ($invoice) use ($course_id) {
                    // Total orders quantity withArtOrNo == true.
                    $totalQuantityWithArtKit =
                        $invoice->orders()->where('course_id', $course_id)->where('withArtOrNo', 1)->get()
                            ->map(function ($order, $key) {
                                return $order->qty;
                            })->sum();
                    // Total orders quantity withArtOrNo == false.
                    $totalQuantityWithoutArtKit = 
                        $invoice->orders()->where('course_id', $course_id)->where('withArtOrNo', 0)->get()
                            ->map(function ($order, $key) {
                                return $order->qty;
                            })->sum();
                    return [
                        'withArtKit' => $totalQuantityWithArtKit,
                        'withoutArtKit' => $totalQuantityWithoutArtKit,
                    ];
                });
        });

        // Convert data to the correct format.
        $totalCourseSoldWithArtKit = 0; $totalCourseSoldWithoutArtKit = 0;
        foreach ($totalQuantityGroupByUsersAndInvoices as $userInvoicesData) {
            foreach ($userInvoicesData as $invoiceQuantityData) {
                $totalCourseSoldWithArtKit += $invoiceQuantityData['withArtKit'];
                $totalCourseSoldWithoutArtKit += $invoiceQuantityData['withoutArtKit'];
            }
        }

        return [
            'withArtKit' => $totalCourseSoldWithArtKit,
            'withoutArtKit' => $totalCourseSoldWithoutArtKit
        ];
    }
}
