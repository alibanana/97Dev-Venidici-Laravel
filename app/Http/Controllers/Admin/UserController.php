<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Admin PagesController Class.
|
| Description:
| This controller is responsible in handling the admin's users pages.
|--------------------------------------------------------------------------
*/ 
class UserController extends Controller
{
    // Shows the Admin Users Page 
    public function index(Request $request) {

        $users = new User;

        $show_options = [10, 25, 50, 100, "All"];

        if ($request->has('show')) {
            if (!in_array($request->show, $show_options)) {
                return redirect(route('admin.users.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.users.index', request()->except(['search', 'page'])));
                }

                $users = $users->all();
                $users_data_flag = 0;
            } else {
                $users = $users->paginate($request->show);
                $users_data_flag = 1;
            }
        } else {
            $users = $users->paginate($show_options[0]);
            $users_data_flag = 1;
        }

        if ($users_data_flag == 0) {
            $users_from = 1;
            $users_count = $users->count();
            $users_to = $users_count;
        } else {
            $users_to_array = $users->toArray();
            $users_from = $users_to_array['from'];
            $users_to = $users_to_array['to'];
            $users_count = $users_to_array['total'];
        }

        $show_options_without_all = array_splice($show_options, 0, count($show_options) - 1);
        $show_options_without_all_count = count($show_options_without_all);
        
        $users_per_page_options = [$show_options_without_all[0]];

        $counter = 0;
        while ($counter < $show_options_without_all_count - 1) {
            $option = $show_options_without_all[$counter];
            if ($users_count > $option) {
                $users_per_page_options[] = $show_options_without_all[$counter + 1];
            }
            $counter++;
        }

        $users_per_page_options[] = "All";

        $users_data = [
            'per_page_options' => $users_per_page_options,
            'from' => $users_from,
            'to' => $users_to,
            'total' => $users_count
        ];

        return view('admin/users', compact('users', 'users_data'));
    }
}
