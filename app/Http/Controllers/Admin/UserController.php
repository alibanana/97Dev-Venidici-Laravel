<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use DB;

use App\Models\User;
use App\Models\UserDetail;

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
            $users_status_list = ['active', 'suspended'];
            if (!in_array($request->filter, $users_status_list)) {
                $url = route('admin.users.index', request()->except('filter'));
                return redirect($url);    
            }
            $users = $users->where('status', $request->filter);
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.users.index', request()->except('search'));
                return redirect($url);
            } else {
                $userDetails = UserDetail::select(DB::raw('user_id as id'), 'telephone', 'referral_code', 'occupancy');
                $users = $users->joinSub($userDetails, 'details', function ($join) {
                    $join->on('users.id', '=', 'details.id');
                });
                
                $search = $request->search;

                $users = $users->where(function ($query) use ($search) {
                    $query->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['email', 'like', "%".$search."%"]])
                    ->orWhere([['telephone', 'like', "%".$search."%"]])
                    ->orWhere([['referral_code', 'like', "%".$search."%"]])
                    ->orWhere([['occupancy', 'like', "%".$search."%"]]);
                });
            }
        }

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

                $users = $users->get();
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

        $users_stars_data = [];
        foreach ($users as $user) {
            $users_usable_stars[$user->id] = Helper::getUsableStars($user);
        }
        
        return view('admin/users', compact('users', 'users_data', 'users_usable_stars'));
    }

    public function add_stars(Request $request){
        $user_detail = UserDetail::where('user_id',$request->user_id)->first();
        $user = User::findOrFail($request->user_id);
        Helper::addStars($user,$request->stars,'Venidici');
        $user_detail->total_stars += $request->stars;
        $user_detail->save();

        $message = $request->stars.' Stars has been added to '.$user_detail->user->name;

        return redirect()->route('admin.users.index')->with('message', $message);
    }
}
