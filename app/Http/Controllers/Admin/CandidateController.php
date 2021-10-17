<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\UserHelper;

use App\Models\User;
use App\Models\CandidateDetail;
use App\Models\CandidateDetailChange;
use App\Models\WorkExperience;
use App\Models\Education;
use App\Models\Achievement;
use App\Models\Hardskill;
use App\Models\Softskill;
use App\Models\Interest;

class CandidateController extends Controller
{
    private const INDEX_ROUTE = 'admin.job-portal.candidates.index';
    private const AVAILABLE_FILTERS = ['not_updated', 'pending', 'approved'];
    private const FILTER_NOT_UPDATED = 'not_updated';
    private const FILTER_PENDING = 'pending';
    private const FILTER_APPROVED = 'approved';

    // Shows the admin job portal's candidates list page.
    public function index(Request $request) {
        $users = User::where('isCandidate', true)->with('candidateDetail');

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
        $userIdAndAdditionalUserDataMap = $this->generateMapOfUserIdAndAdditionalUserData($users);

        return view('admin/job-portal/candidates', compact('users', 'userIdAndAdditionalUserDataMap'));
    }

    private function generateMapOfUserIdAndAdditionalUserData($users) {
        return $users->mapWithKeys(function ($user) {
            $data = [];
            
            // Shows if candidateDetail relationship exists.
            if ($user->candidateDetail()->exists()) {
                $data['isCandidateDetailExists'] = true;
            } else {
                $data['isCandidateDetailExists'] = false;
            }

            // Shows if candidate has updated its profile or theres a pending update.
            if (UserHelper::isCandidateNotUpdated($user)) {
                $data['candidateStatus'] = 'not_updated';
            } elseif (UserHelper::isCandidatePending($user)) {
                $data['candidateStatus'] = 'pending';
            } else {
                $data['candidateStatus'] = 'approved';
            }
            
            return [$user->id => $data];
        });
    }

    // Shows the candidate's detail page.
    public function showCandidate(){
        return view('admin/job-portal/candidate-profile');
    }

    // Shows the candidate's changes detail page.
    public function showCandidateChange($candidate_detail_id){
        $candidate_detail = CandidateDetail::where('id', $candidate_detail_id)
            ->with('user', 'educations', 'achievements', 'hardskills', 'softskills')
            ->firstOrFail();

        $candidate_detail_change = CandidateDetailChange::where('candidate_detail_id', $candidate_detail_id)
            ->where('status', 'pending')
            ->with('candidateDetail', 'workExperienceChanges', 'educationChanges', 'achievementChanges', 'hardskillChanges',
                'softskillChanges', 'interestChanges')
            ->latest()
            ->first();

        $work_experiences_not_udpated = WorkExperience::where('candidate_detail_id', $candidate_detail_id)
            ->doesntHave('workExperienceChanges')
            ->get();

        $educations_not_updated = Education::where('candidate_detail_id', $candidate_detail_id)
            ->doesntHave('educationChanges')
            ->get();

        $achivements_not_updated = Achievement::where('candidate_detail_id', $candidate_detail_id)
            ->doesntHave('achievementChanges')
            ->get();
            
        $hardskills_not_updated = Hardskill::where('candidate_detail_id', $candidate_detail_id)
            ->doesntHave('hardskillChanges')
            ->get();
        
        $softskills_not_updated = Softskill::where('candidate_detail_id', $candidate_detail_id)
            ->doesntHave('softskillChanges')
            ->get();
        
        $interests_not_updated = Interest::where('candidate_detail_id', $candidate_detail_id)
            ->doesntHave('interestChanges')
            ->get();

        return view('admin/job-portal/candidate-profile-change', compact('candidate_detail', 'candidate_detail_change', 'work_experiences_not_udpated',
            'educations_not_updated', 'achivements_not_updated', 'hardskills_not_updated', 'softskills_not_updated', 'interests_not_updated'));
    }
}
