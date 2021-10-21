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
    private const HIRING_PARTNER_ROLE_ID = 4;
    
    private const INDEX_ROUTE = 'admin.job-portal.hiring-partners.index';

    private const AVAILABLE_FILTERS = ['active', 'suspended'];
    private const USERS_STATUS_LIST = ['active', 'suspended'];
    
    private const AVAILABLE_OPTIONS = [10, 25, 50, 100, "All"];
    private const AVAILABLE_OPTIONS_WITHOUT_ALL = [10, 25, 50, 100];

    // Shows the Admin Hiring-Partners List page.
    public function index(Request $request) {
        $users = User::where('user_role_id', self::HIRING_PARTNER_ROLE_ID);

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
            if (!in_array($request->filter, self::AVAILABLE_FILTERS)) {
                $url = route(self::INDEX_ROUTE, request()->except('filter'));
                return redirect($url);    
            }

            if (in_array($request->filter, self::USERS_STATUS_LIST))
                $users = $users->where('status', $request->filter);
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route(self::INDEX_ROUTE, request()->except('search'));
                return redirect($url);
            } else {
                $userDetails = UserDetail::select(DB::raw('user_id as id'), 'telephone');
                $users = $users->joinSub($userDetails, 'details', function ($join) {
                    $join->on('users.id', '=', 'details.id');
                });
                
                $search = $request->search;

                $users = $users->where(function ($query) use ($search) {
                    $query->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['companyName', 'like', "%".$search."%"]])
                    ->orWhere([['email', 'like', "%".$search."%"]])
                    ->orWhere([['telephone', 'like', "%".$search."%"]]);
                });
            }
        }

        if ($request->has('show')) {
            if (!in_array($request->show, self::AVAILABLE_OPTIONS)) {
                return redirect(route(self::INDEX_ROUTE, request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(route(self::INDEX_ROUTE, request()->except(['search', 'page'])));
                }

                $users = $users->get();
                $users_data_flag = 0;
            } else {
                $users = $users->paginate($request->show);
                $users_data_flag = 1;
            }
        } else {
            $users = $users->paginate(self::AVAILABLE_OPTIONS[0]);
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

        $show_options_without_all_count = count(self::AVAILABLE_OPTIONS_WITHOUT_ALL);
        
        $users_per_page_options = [self::AVAILABLE_OPTIONS_WITHOUT_ALL[0]];

        $counter = 0;
        while ($counter < $show_options_without_all_count - 1) {
            $option = self::AVAILABLE_OPTIONS_WITHOUT_ALL[$counter];
            if ($users_count > $option) {
                $users_per_page_options[] = self::AVAILABLE_OPTIONS_WITHOUT_ALL[$counter + 1];
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
        return redirect()->route(self::INDEX_ROUTE)->with('message', $message);
    }

    // Deletes a particular hiring-partner (user) from the database.
    public function destroy($id) {
        $user = User::where('user_role_id', self::HIRING_PARTNER_ROLE_ID)
            ->where('id', $id)
            ->firstOrFail();
        $user->delete();
        $message = 'Hiring-Partner (' . $user->name . ') has been deleted from the database!';
        return redirect()->route(self::INDEX_ROUTE)->with('message', $message);
    }

    // Shows the admin hiring-partner contacted candidate list view.
    public function viewContactedCandidates(Request $request, $id) {
        return view('admin/job-portal/contacted-candidates');
    }
}
