<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\UserHelper;

use App\Models\User;

class CandidateController extends Controller
{
    private const INDEX_ROUTE = 'admin.job-portal.candidates.index';
    private const AVAILABLE_FILTERS = ['not_updated', 'pending', 'approved'];
    private const FILTER_NOT_UPDATED = 'not_updated';
    private const FILTER_PENDING = 'pending';
    private const FILTER_APPROVED = 'approved';

    // Shows the admin job portal's candidates list page.
    public function index(Request $request) {
        $users = User::where('isCandidate', true);

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
            } elseif ($request->filter == self::FILTER_NOT_UPDATED) {
                // Case #1 - Users have no candidateDetail object yet.
                // Case #2 - Users have candidateDetail object but all candidateDetail.candidateDetailChanges
                //           are cancelled.

                // $users = $users->doesntHave('candidateDetail')
                //     ->orWhereDoesntHave('candidateDetail.candidateDetailChanges');
            } elseif ($request->filter == self::FILTER_PENDING) {
                // Case #1 - Users have candidateDetail.candidateDetailChanges objects which status are pending (currently).

                // $users = $users->whereDoesntHave('candidateDetail.candidateDetailChanges', function (Builder $query) {
                //     $query->where('status', 'pending');
                // });
            } elseif ($request->filter == self::FILTER_APPROVED) {
                // Case #1 - Users candidateDetail.candidateDetailChanges objects are all approved. 
            }
        }
        
        $users = $users->with('userDetail')->get();
        $userIdAndCandidateStatusMap = $this->generateMapOfUserIdAndCandidateStatus($users);

        return view('admin/job-portal/candidates', compact('users', 'userIdAndCandidateStatusMap'));
    }

    private function generateMapOfUserIdAndCandidateStatus($users) {
        return $users->mapWithKeys(function ($user) {
            if (UserHelper::isCandidateNotUpdated($user)) {
                return [$user->id => 'not_updated'];
            } elseif (UserHelper::isCandidatePending($user)) {
                return [$user->id => 'pending'];
            } else {
                return [$user->id => 'approved'];
            }
        });
    }

    // Shows the candidate's detail page.
    public function showCandidate(){
        return view('admin/job-portal/candidate-profile');
    }

    // Shows the candidate's changes detail page.
    public function showCandidateChange(){
        return view('admin/job-portal/candidate-profile');
    }
}
