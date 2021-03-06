<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helper\UserHelper;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\CandidateDetail;
use App\Models\CandidateDetailChange;
use App\Models\WorkExperience;
use App\Models\WorkExperienceChange;
use App\Models\Education;
use App\Models\EducationChange;
use App\Models\Achievement;
use App\Models\AchievementChange;
use App\Models\Hardskill;
use App\Models\HardskillChange;
use App\Models\Softskill;
use App\Models\SoftskillChange;
use App\Models\Interest;
use App\Models\InterestChange;

use App\Mail\CandidateProfileAcceptedMail;
use App\Mail\CandidateProfileRejectedMail;


class CandidateController extends Controller
{
    private const INDEX_ROUTE = 'admin.job-portal.candidates.index';
    private const AVAILABLE_FILTERS = ['not_updated', 'pending', 'approved'];
    private const FILTER_NOT_UPDATED = 'not_updated';
    private const FILTER_PENDING = 'pending';
    private const FILTER_APPROVED = 'approved';
    private const BOOTCAMP_COURSE_TYPE_ID = 3;

    // Shows the admin job portal's candidates list page.
    public function index(Request $request) {
        $users = User::where('isCandidate', true)
            ->with('candidateDetail', 'courses');

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
                $users = $users->whereIn('id', $this->getListOfNotUpdatedCandidateUserIds());
            } elseif ($request->filter == self::FILTER_PENDING) {
                $users = $users->whereIn('id', $this->getListOfPendingCandidateUserIds());
            } elseif ($request->filter == self::FILTER_APPROVED) {
                $users = $users->whereIn('id', $this->getListOfApprovedCandidateUserIds());
            }
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
                    ->orWhere([['email', 'like', "%".$search."%"]])
                    ->orWhere([['telephone', 'like', "%".$search."%"]]);
                });
            }
        }
        
        $users = $users->with('userDetail')->get();
        $userIdAndAdditionalUserDataMap = $this->generateMapOfUserIdAndAdditionalUserData($users);
        $userIdAndScoreMap = $this->generateMapOfUserIdAndScore($users);

        return view('admin/job-portal/candidates', compact('users', 'userIdAndAdditionalUserDataMap', 'userIdAndScoreMap'));
    }

    private function getListOfNotUpdatedCandidateUserIds() {
        return User::all()->map(function ($user) {
            if (UserHelper::isCandidateNotUpdated($user)) {
                return $user->id;
            }
        })->toArray();
    }

    private function getListOfPendingCandidateUserIds() {
        return User::all()->map(function ($user) {
            if (UserHelper::isCandidatePending($user)) {
                return $user->id;
            }
        })->toArray();
    }

    private function getListOfApprovedCandidateUserIds() {
        return User::all()->map(function ($user) {
            if (!UserHelper::isCandidateNotUpdated($user) && !UserHelper::isCandidatePending($user)) {
                return $user->id;
            }
        })->toArray();
    }

    private function generateMapOfUserIdAndAdditionalUserData($users) {
        return $users->mapWithKeys(function ($user) {
            $data = [];

            // Shows if candidate has updated its profile or theres a pending update.
            if (UserHelper::isCandidateNotUpdated($user)) {
                $data['candidateStatus'] = 'not_updated';
            } elseif (UserHelper::isCandidatePending($user)) {
                $data['candidateStatus'] = 'pending';
                $candidate_detail_change_id = CandidateDetailChange::where('candidate_detail_id', $user->candidateDetail->id)
                    ->select('id')
                    ->where('status', 'pending')
                    ->latest()
                    ->first()->id;
                $data['pendingCandidateDetailChangeId'] = $candidate_detail_change_id;
            } else {
                $data['candidateStatus'] = 'approved';
            }

            $data['isCandidateDetailEmpty'] = UserHelper::isCandidateDetailEmpty($user);
            
            return [$user->id => $data];
        });
    }

    private function generateMapOfUserIdAndScore($users) {
        return $users->mapWithKeys(function ($user) {
            if ($user->courses()->exists()) {
                $scores = $user->courses()
                    ->where('course_type_id', self::BOOTCAMP_COURSE_TYPE_ID)
                    ->get()->map(function ($course) {
                        return $course->pivot->score;
                    })->sortBy('score')->toArray();

                return [$user->id => $scores[0]];
            }
        });
    }

    // Shows the candidate's detail page.
    public function showCandidate($candidate_id){
        $candidate_detail = CandidateDetail::where('user_id', $candidate_id)
            ->with('user', 'workExperiences', 'educations', 'achievements', 'hardskills', 'softskills', 'interests')
            ->firstOrFail();

        $score = UserHelper::getHighestScoreFromCandidateDetail($candidate_detail);
        
        return view('admin/job-portal/candidate-profile', compact('candidate_detail', 'score'));
    }

    // Shows the candidate's changes detail page.
    public function showCandidateChange($candidate_detail_id) {
        $candidate_detail = CandidateDetail::where('id', $candidate_detail_id)
            ->with('user', 'educations', 'achievements', 'hardskills', 'softskills')
            ->firstOrFail();

        $score = UserHelper::getHighestScoreFromCandidateDetail($candidate_detail);

        $candidate_detail_change = CandidateDetailChange::where('candidate_detail_id', $candidate_detail_id)
            ->where('status', 'pending')
            ->with('candidateDetail', 'workExperienceChanges', 'educationChanges', 'achievementChanges', 'hardskillChanges',
                'softskillChanges', 'interestChanges')
            ->latest()
            ->first();

        $updatedWorkExperienceIds = UserHelper::getUpdatedWorkExperienceIds($candidate_detail_change);
        $work_experiences_not_updated = WorkExperience::where('candidate_detail_id', $candidate_detail->id)->get()
            ->filter(function ($workExperience) use ($updatedWorkExperienceIds) {
                return !in_array($workExperience->id, $updatedWorkExperienceIds);
            });

        $updatedEducationIds = UserHelper::getUpdatedEducationIds($candidate_detail_change);
        $educations_not_updated = Education::where('candidate_detail_id', $candidate_detail->id)->get()
            ->filter(function ($education) use ($updatedEducationIds) {
                return !in_array($education->id, $updatedEducationIds);
            });

        $updatedAchievementIds = UserHelper::getUpdatedAchievementIds($candidate_detail_change);
        $achievements_not_updated = Achievement::where('candidate_detail_id', $candidate_detail->id)->get()
            ->filter(function ($achievement) use ($updatedAchievementIds) {
                return !in_array($achievement->id, $updatedAchievementIds);
            });

        $updatedHardskillIds = UserHelper::getUpdatedHardskillIds($candidate_detail_change);
        $hardskills_not_updated = Hardskill::where('candidate_detail_id', $candidate_detail->id)->get()
            ->filter(function ($hardskill) use ($updatedHardskillIds) {
                return !in_array($hardskill->id, $updatedHardskillIds);
            });

        $updatedSoftskillIds = UserHelper::getUpdatedSoftskillIds($candidate_detail_change);
        $softskills_not_updated = Softskill::where('candidate_detail_id', $candidate_detail->id)->get()
            ->filter(function ($softskill) use ($updatedSoftskillIds) {
                return !in_array($softskill->id, $updatedSoftskillIds);
            });

        $updatedInterestIds = UserHelper::getUpdatedInterestIds($candidate_detail_change);
        $interests_not_updated = Interest::where('candidate_detail_id', $candidate_detail->id)->get()
            ->filter(function ($interest) use ($updatedInterestIds) {
                return !in_array($interest->id, $updatedInterestIds);
            });

        $isCandidateDetailNotUpdated = UserHelper::isCandidateNotUpdated($candidate_detail->user);

        return view('admin/job-portal/candidate-profile-change', compact('candidate_detail', 'score', 'candidate_detail_change', 'work_experiences_not_updated',
            'educations_not_updated', 'achievements_not_updated', 'hardskills_not_updated', 'softskills_not_updated', 'interests_not_updated',
            'isCandidateDetailNotUpdated'));
    }

    // Method to approve changes requested by user (candidate).
    public function approveChange(Request $request) {
        $validated = $request->validate([
            'candidate_detail_change_id' => 'required|integer'
        ]);
        
        $candidate_detail_change = CandidateDetailChange::where('id', $validated['candidate_detail_change_id'])
            ->where('status', 'pending')
            ->with('candidateDetail', 'workExperienceChanges', 'educationChanges', 'achievementChanges', 'hardskillChanges',
                'softskillChanges', 'interestChanges')
            ->firstOrFail();

        $this->updateCandidateDetail($candidate_detail_change);

        $message = 'Candidate Detail Changes for user (' . $candidate_detail_change->candidateDetail->user->name . ') has been approved!';

        Mail::to($candidate_detail_change->candidateDetail->user->email)->send(new CandidateProfileAcceptedMail($candidate_detail_change->candidateDetail->user->name));
        // create notification
        $notification = Notification::create([
            'user_id' => $candidate_detail_change->candidateDetail->user->id,
            'isInformation' => 1,
            'title' => 'Permintaan Perubahan Profilmu Diterima',
            'description' => 'Hi, '.$candidate_detail_change->candidateDetail->user->name.'. Permintaan perubahan profil bootcamp kamu telah diterima oleh admin',
            'link' => '/candidate-details/my-profile'
        ]);
        return redirect()->route(self::INDEX_ROUTE)->with('message', $message);
    }

    private function updateCandidateDetail(CandidateDetailChange $candidateDetailChange) {
        // Updates Candidate Detail.
        if (!UserHelper::isCandidateDetailChangeDataNull($candidateDetailChange)) {
            $candidateDetailData = $this->constructCandidateDetailDataAndUnlinkExistingCV($candidateDetailChange);
            CandidateDetail::where('id', $candidateDetailChange->candidate_detail_id)->update($candidateDetailData);
        }

        if ($candidateDetailChange->workExperienceChanges()->exists()) {
            foreach ($candidateDetailChange->workExperienceChanges as $workExperienceChange) {
                $this->processWorkExperienceChange($workExperienceChange);
            }
        }

        if ($candidateDetailChange->educationChanges()->exists()) {
            foreach ($candidateDetailChange->educationChanges as $educationChange) {
                $this->processEducationChange($educationChange);
            }
        }

        if ($candidateDetailChange->achievementChanges()->exists()) {
            foreach ($candidateDetailChange->achievementChanges as $achievementChange) {
                $this->processAchievementChange($achievementChange);
            }
        }

        if ($candidateDetailChange->hardskillChanges()->exists()) {
            foreach ($candidateDetailChange->hardskillChanges as $hardskillChange) {
                $this->processHardskillChange($hardskillChange);
            }
        }

        if ($candidateDetailChange->softskillChanges()->exists()) {
            foreach ($candidateDetailChange->softskillChanges as $softskillChange) {
                $this->processSoftskillChange($softskillChange);
            }
        }

        if ($candidateDetailChange->interestChanges()->exists()) {
            foreach ($candidateDetailChange->interestChanges as $interestChange) {
                $this->processInterestChange($interestChange);
            }
        }

        $candidateDetailChange->status = 'approved';
        $candidateDetailChange->save();
    }

    private function constructCandidateDetailDataAndUnlinkExistingCV(CandidateDetailChange $candidateDetailChange) {
        $data = [
            'preferred_working_location' => $candidateDetailChange['preferred_working_location'],
            'linkedin_link' => $candidateDetailChange['linkedin_link'],
            'whatsapp_number' => $candidateDetailChange['whatsapp_number'],
            'about_me_description' => $candidateDetailChange['about_me_description'],
            'experience_year' => $candidateDetailChange['experience_year'],
            'industry' => $candidateDetailChange['industry']
        ];

        // If candidateDetailChange have cv_file, unlink previous and include in update data.
        if ($candidateDetailChange->hasAttribute('cv_file') && !is_null($candidateDetailChange->cv_file)) {
            if ($candidateDetailChange->candidateDetail->hasAttribute('cv_file') && !is_null($candidateDetailChange->candidateDetail->cv_file))
                unlink($candidateDetailChange->candidateDetail->cv_file);
            $data['cv_file'] = $candidateDetailChange['cv_file'];
        }

        return $data;
    }

    private function processWorkExperienceChange(WorkExperienceChange $workExperienceChange) {
        $action = $workExperienceChange->action;
        if ($action == 'create' || $action == 'update') {
            $data = [
                'company' => $workExperienceChange->company,
                'job_position' => $workExperienceChange->job_position,
                'start_date' => $workExperienceChange->start_date,
                'end_date' => $workExperienceChange->end_date,
                'location' => $workExperienceChange->location
            ];

            if ($action == 'create') {
                $data['candidate_detail_id'] = $workExperienceChange->candidateDetailChange->candidate_detail_id;
                WorkExperience::create($data);
            } elseif ($action == 'update') {
                WorkExperience::where('id', $workExperienceChange->work_experience_id)->update($data);
            }
        } elseif ($action == 'delete') {
            $workExperienceChange->workExperience()->delete();
        }
    }

    private function processEducationChange(EducationChange $educationChange) {
        $action = $educationChange->action;
        if ($action == 'create' || $action == 'update') {
            $data = [
                'degree' => $educationChange->degree,
                'school' => $educationChange->school,
                'major' => $educationChange->major,
                'start_year' => $educationChange->start_year,
                'end_year' => $educationChange->end_year
            ];

            if ($action == 'create') {
                $data['candidate_detail_id'] = $educationChange->candidateDetailChange->candidate_detail_id;
                Education::create($data);
            } elseif ($action == 'update') {
                Education::where('id', $educationChange->education_id)->update($data);
            }
        } elseif ($action == 'delete') {
            $educationChange->education()->delete();
        }
    }

    private function processAchievementChange(AchievementChange $achievementChange) {
        $action = $achievementChange->action;
        if ($action == 'create' || $action == 'update') {
            $data = [
                'title' => $achievementChange->title,
                'location_of_event' => $achievementChange->location_of_event,
                'year' => $achievementChange->year
            ];

            if ($action == 'create') {
                $data['candidate_detail_id'] = $achievementChange->candidateDetailChange->candidate_detail_id;
                Achievement::create($data);
            } elseif ($action == 'update') {
                Achievement::where('id', $achievementChange->achievement_id)->update($data);
            }
        } elseif ($action == 'delete') {
            $achievementChange->achievement()->delete();
        }
    }

    private function processHardskillChange(HardskillChange $hardskillChange) {
        $action = $hardskillChange->action;
        if ($action == 'create' || $action == 'update') {
            $data = [
                'title' => $hardskillChange->title,
                'score' => $hardskillChange->score
            ];

            if ($action == 'create') {
                $data['candidate_detail_id'] = $hardskillChange->candidateDetailChange->candidate_detail_id;
                Hardskill::create($data);
            } elseif ($action == 'update') {
                Hardskill::where('id', $hardskillChange->hardskill_id)->update($data);
            }
        } elseif ($action == 'delete') {
            $hardskillChange->hardskill()->delete();
        }
    }

    private function processSoftskillChange(SoftskillChange $softskillChange) {
        $action = $softskillChange->action;
        if ($action == 'create' || $action == 'update') {
            $data = [
                'title' => $softskillChange->title,
                'score' => $softskillChange->score
            ];

            if ($action == 'create') {
                $data['candidate_detail_id'] = $softskillChange->candidateDetailChange->candidate_detail_id;
                Softskill::create($data);
            } elseif ($action == 'update') {
                Softskill::where('id', $softskillChange->softskill_id)->update($data);
            }
        } elseif ($action == 'delete') {
            $softskillChange->softskill()->delete();
        }
    }

    private function processInterestChange(InterestChange $interestChange) {
        $action = $interestChange->action;
        if ($action == 'create' || $action == 'update') {
            $data = [
                'title' => $interestChange->title
            ];

            if ($action == 'create') {
                $data['candidate_detail_id'] = $interestChange->candidateDetailChange->candidate_detail_id;
                Interest::create($data);
            } elseif ($action == 'update') {
                Interest::where('id', $interestChange->interest_id)->update($data);
            }
        } elseif ($action == 'delete') {
            $interestChange->interest()->delete();
        }
    }

    public function rejectChange(Request $request) {
        $validated = $request->validate([
            'candidate_detail_change_id' => 'required|integer'
        ]);

        $candidate_detail_change = CandidateDetailChange::where('id', $validated['candidate_detail_change_id'])
            ->where('status', 'pending')
            ->firstOrFail();

        $candidate_detail_change->status = 'cancelled';
        $candidate_detail_change->save();

        if ($candidate_detail_change->hasAttribute('cv_file') && !is_null($candidate_detail_change->cv_file)) {
            unlink($candidate_detail_change->cv_file);
        }
        
        $message = 'Candidate Detail Changes for user (' . $candidate_detail_change->candidateDetail->user->name . ') has been rejected!';

        Mail::to($candidate_detail_change->candidateDetail->user->email)->send(new CandidateProfileRejectedMail($candidate_detail_change->candidateDetail->user->name));
        // create notification
        $notification = Notification::create([
            'user_id' => $candidate_detail_change->candidateDetail->user->id,
            'isInformation' => 1,
            'title' => 'Permintaan Perubahan Profilmu Ditolak',
            'description' => 'Hi, '.$candidate_detail_change->candidateDetail->user->name.'. Permintaan perubahan profil bootcamp kamu telah ditolak oleh admin',
            'link' => '/candidate-details/my-profile'
        ]);
        return redirect()->route(self::INDEX_ROUTE)->with('message', $message);
    }
}
