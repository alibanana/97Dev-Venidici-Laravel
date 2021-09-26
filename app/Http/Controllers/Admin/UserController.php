<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use DB;
use Carbon\Carbon;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuspendEmail;

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
    private static String $INDEX_ROUTE = 'admin.users.index';
    private static Array $AVAILABLE_FILTERS = ['active', 'suspended', 'birthday-today', 'admin', 'super-admin', 'normal-user'];
    private static Array $USERS_STATUS_LIST = ['active', 'suspended'];
    private static Array $USERS_ROLE_LIST = ['admin', 'super-admin', 'normal-user'];

    // Shows the Admin Users Page 
    public function index(Request $request) {
        // Filter hiring-partners from users list.
        $users = User::where('user_role_id', '!=', 4);

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
            if (!in_array($request->filter, self::$AVAILABLE_FILTERS)) {
                $url = route(self::$INDEX_ROUTE, request()->except('filter'));
                return redirect($url);    
            }

            if (in_array($request->filter, self::$USERS_STATUS_LIST))
                $users = $users->where('status', $request->filter);
            elseif (in_array($request->filter, self::$USERS_ROLE_LIST)){
                if($request->filter == 'admin')
                    $users = $users->where('user_role_id', 2);
                elseif($request->filter == 'super-admin')
                    $users = $users->where('user_role_id', 3);
                elseif($request->filter == 'normal-user')
                    $users = $users->where('user_role_id', 1);
            }
            else {
                $userDetails = UserDetail::select(DB::raw('user_id as id'), 'birthdate');

                $users = $users->joinSub($userDetails, 'details', function ($join) {
                    $join->on('users.id', '=', 'details.id');
                })->whereMonth('birthdate', Carbon::now()->format('m'))
                    ->whereDay('birthdate', Carbon::now()->format('d'));
            }
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route(self::$INDEX_ROUTE, request()->except('search'));
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
                return redirect(route(self::$INDEX_ROUTE, request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(route(self::$INDEX_ROUTE, request()->except(['search', 'page'])));
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

        $users_usable_stars = [];
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

        return redirect()->route(self::$INDEX_ROUTE)->with('message', $message);
    }

    // Set user's status to opposite.
    public function setStatusToOpposite($id) {
        $user = User::findOrFail($id);
        
        if ($user->status == 'active'){
            $user->status = 'suspended';
            $message = 'User (' . $user->name . ') has been suspended.';
        } else {
            $user->status = 'active';
            $message = 'User (' . $user->name . ') has been reinstated.';
        }

        $user->save();
        Mail::to($user->email)->send(new SuspendEmail($user));
        
        return redirect()->route(self::$INDEX_ROUTE)->with('message', $message);
    }

    // Set user's status to opposite.
    public function setRoleToOpposite($id) {
        $user = User::findOrFail($id);
        
        // if normal user
        if ($user->user_role_id == 1){
            $user->user_role_id = 2;
            $message = 'User (' . $user->name . ') has been changed to admin.';
        } else {
            $user->user_role_id = 1;
            $message = 'User (' . $user->name . ') has been reinstated to user.';
        }

        $user->save();
        
        return redirect()->route(self::$INDEX_ROUTE)->with('message', $message);
    }
}
