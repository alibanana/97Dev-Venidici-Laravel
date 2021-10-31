<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Axiom\Rules\StrongPassword;

use App\Helper\UserHelper;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\CandidateDetail;

class HiringPartnerController extends Controller
{
    private const HIRING_PARTNER_ROLE_ID = 4;
    
    private const INDEX_ROUTE = 'admin.job-portal.hiring-partners.index';
    private const VIEW_SAVED_CANDIDATES_ROUTE =
        'admin.job-portal.hiring-partners.view-saved-candidates';

    private const AVAILABLE_FILTERS = ['active', 'suspended'];
    private const USERS_STATUS_LIST = ['active', 'suspended'];
    private const AVAILABLE_OPTIONS = [10, 25, 50, 100, "All"];
    private const AVAILABLE_OPTIONS_WITHOUT_ALL = [10, 25, 50, 100];

    private const CONTACTED_CANDIDATES_AVAILABLE_FILTERS = ['archived', 'contacted', 'accepted', 'hired'];
    private const HIRING_PARTNER_CANDIDATE_STATUS_LIST = ['archived', 'contacted', 'accepted', 'hired'];
    private const CONTACTED_CANDIDATES_AVAILABLE_OPTIONS = [10, 25, 50, 100, "All"];
    private const CONTACTED_CANDIDATES_AVAILABLE_OPTIONS_WITHOUT_ALL = [10, 25, 50, 100];

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

    // Shows the admin hiring-partner saved candidate list view.
    public function viewSavedCandidates(Request $request, $id) {
        $hiringPartner = User::where('user_role_id', self::HIRING_PARTNER_ROLE_ID)
            ->where('id', $id)
            ->firstOrFail();

        $contactedCandidates = $hiringPartner->candidates()->with('candidateDetail');

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $contactedCandidates = $contactedCandidates->orderBy('hiring_partner_candidate.created_at', 'desc');
            } else {
                $contactedCandidates = $contactedCandidates->orderBy('hiring_partner_candidate.created_at');
            }
        } else {
            $contactedCandidates = $contactedCandidates->orderBy('hiring_partner_candidate.created_at', 'desc');
        }

        if ($request->has('filter')) {
            if (!in_array($request->filter, self::CONTACTED_CANDIDATES_AVAILABLE_FILTERS)) {
                $url = route(self::VIEW_SAVED_CANDIDATES_ROUTE,
                    array_merge(request()->except('filter'), ['id' => $id]));
                return redirect($url);
            }

            if (in_array($request->filter, self::HIRING_PARTNER_CANDIDATE_STATUS_LIST))
                $contactedCandidates = $contactedCandidates
                    ->where('hiring_partner_candidate.status', $request->filter);
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route(self::VIEW_SAVED_CANDIDATES_ROUTE,
                    array_merge(request()->except('search'), ['id' => $id]));
                return redirect($url);
            } else {
                $candidateDetails = CandidateDetail::select(DB::raw('user_id as id'), 'whatsapp_number');
                $contactedCandidates = $contactedCandidates->joinSub($candidateDetails, 'details', function ($join) {
                    $join->on('users.id', '=', 'details.id');
                });
                
                $search = $request->search;

                $contactedCandidates = $contactedCandidates->where(function ($query) use ($search) {
                    $query->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['email', 'like', "%".$search."%"]])
                    ->orWhere([['whatsapp_number', 'like', "%".$search."%"]]);
                });
            }
        }

        if ($request->has('show')) {
            if (!in_array($request->show, self::CONTACTED_CANDIDATES_AVAILABLE_OPTIONS)) {
                return redirect(route(self::VIEW_SAVED_CANDIDATES_ROUTE,
                    array_merge(request()->except(['search', 'page']), ['id' => $id])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(route(self::VIEW_SAVED_CANDIDATES_ROUTE,
                        array_merge(request()->except(['search', 'page']), ['id' => $id])));
                }

                $contactedCandidates = $contactedCandidates->get();
                $contactedCandidates_data_flag = 0;
            } else {
                $contactedCandidates = $contactedCandidates->paginate($request->show);
                $contactedCandidates_data_flag = 1;
            }
        } else {
            $contactedCandidates = $contactedCandidates->paginate(self::CONTACTED_CANDIDATES_AVAILABLE_OPTIONS[0]);
            $contactedCandidates_data_flag = 1;
        }

        if ($contactedCandidates_data_flag == 0) {
            $contactedCandidates_from = 1;
            $contactedCandidates_count = $contactedCandidates->count();
            $contactedCandidates_to = $contactedCandidates_count;
        } else {
            $contactedCandidates_to_array = $contactedCandidates->toArray();
            $contactedCandidates_from = $contactedCandidates_to_array['from'];
            $contactedCandidates_to = $contactedCandidates_to_array['to'];
            $contactedCandidates_count = $contactedCandidates_to_array['total'];
        }

        $show_options_without_all_count = count(self::CONTACTED_CANDIDATES_AVAILABLE_OPTIONS_WITHOUT_ALL);
        
        $contactedCandidates_per_page_options = [self::CONTACTED_CANDIDATES_AVAILABLE_OPTIONS_WITHOUT_ALL[0]];

        $counter = 0;
        while ($counter < $show_options_without_all_count - 1) {
            $option = self::CONTACTED_CANDIDATES_AVAILABLE_OPTIONS_WITHOUT_ALL[$counter];
            if ($contactedCandidates_count > $option) {
                $contactedCandidates_per_page_options[] = self::CONTACTED_CANDIDATES_AVAILABLE_OPTIONS_WITHOUT_ALL[$counter + 1];
            }
            $counter++;
        }

        $contactedCandidates_per_page_options[] = "All";

        $contactedCandidates_data = [
            'per_page_options' => $contactedCandidates_per_page_options,
            'from' => $contactedCandidates_from,
            'to' => $contactedCandidates_to,
            'total' => $contactedCandidates_count
        ];

        return view('admin/job-portal/contacted-candidates', compact('hiringPartner', 'contactedCandidates', 'contactedCandidates_data'));
    }

    // Method to handle Candidate Related Actions
    public function handleCandidateAction(Request $request) {
        $validated = $request->validate([
            'hiring_partner_id' => 'required|integer',
            'candidate_id' => 'required|integer',
            'action' => 'required' // contact, unarchive, approve, cancel
        ]);

        $hiringPartner = User::where('id', $validated['hiring_partner_id'])
            ->firstOrFail();

        $candidate = User::where('id', $validated['candidate_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        if ($validated['action'] == 'contact') {
            UserHelper::contactCandidate($candidate, $hiringPartner->id);
            $message = 'Candidate (' . $candidate->name . ') has been contacted through email.';
        } elseif ($validated['action'] == 'unarchive') {
            UserHelper::unarchiveCandidate($candidate, $hiringPartner->id);
            $message = 'Candidate (' . $candidate->name . ') has been removed from ('. $hiringPartner->companyName .') list.';
        } elseif ($validated['action'] == 'accept') {
            UserHelper::hireCandidate($candidate, $hiringPartner->id);
            $message = 'Candidate (' . $candidate->name . ') has successfully been accepted on ('. $hiringPartner->companyName .').';
        } elseif ($validated['action'] == 'cancel') {
            UserHelper::cancelCandidate($candidate, $hiringPartner->id);
            $message = 'Candidate (' . $candidate->name . ') status successfully has been updated from accepted to contacted.';
        }

        return redirect(route(self::VIEW_SAVED_CANDIDATES_ROUTE, $hiringPartner->id))->with('message', $message);
    }
}
