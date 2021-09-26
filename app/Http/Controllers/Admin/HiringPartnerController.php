<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Axiom\Rules\StrongPassword;

use App\Models\User;
use App\Models\UserDetail;

class HiringPartnerController extends Controller
{
    private static String $INDEX_ROUTE = 'admin.job-portal.hiring-partners.index';
    private static Array $AVAILABLE_FILTERS = ['active', 'suspended'];
    private static Array $USERS_STATUS_LIST = ['active', 'suspended'];

    // Shows the Admin Hiring-Partners List page.
    public function index(Request $request) {
        $users = User::where('user_role_id', 4);

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
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route(self::$INDEX_ROUTE, request()->except('search'));
                return redirect($url);
            } else {
                $userDetails = UserDetail::select(DB::raw('user_id as id'), 'telephone');
                $users = $users->joinSub($userDetails, 'details', function ($join) {
                    $join->on('users.id', '=', 'details.id');
                });
                
                $search = $request->search;

                $users = $users->where(function ($query) use ($search) {
                    $query->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['email', 'like', "%".$search."%"]])
                    ->orWhere([['telephone', 'like', "%".$search."%"]]);
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

        return view('admin/job-portal/hiring-partners', compact('users', 'users_data'));
    }

    // Shows the Admin Create New Hiring-Partners page.
    public function create() {
        return view('admin/job-portal/hiring-partners-create');
    }

    // Create new user with user_role hiring partner.
    public function store(Request $request) {
        $validation_rules = [
            'name' => 'required',
            'email' => 'required',
            'companyName' => 'required'
        ];

        if (App::environment('production'))
            $validation_rules['password'] = ['required', new StrongPassword];
        else
            $validation_rules['password'] = ['required'];

        $validated = $request->validate($validation_rules);

        $user = User::create([
            'user_role_id' => 4, // set user role to hiring-partner.
            'name' => $validated['name'],
            'email' => $validated['email'],
            'companyName' => $validated['companyName'],
            'password' => Hash::make($validated['password'])
        ]);
        
        event(new Registered($user));

        $message = 'New Hiring-Partner (' . $user->email .') account has been created!';
        return redirect()->route(self::$INDEX_ROUTE)->with('message', $message);
    }
}
