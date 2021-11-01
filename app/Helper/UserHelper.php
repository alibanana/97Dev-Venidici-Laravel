<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\CandidateDetail;
use App\Models\CandidateDetailChange;
use Illuminate\Support\Facades\Auth;


class UserHelper {

    private const ADMIN_ROLE_IDS = [2, 3];
    private const HIRING_PARTNER_CANDIDATE_TABLE = 'hiring_partner_candidate';

    // Get lists of admins.
    public static function findAllAdmins() {
        return User::whereIn('user_role_id', self::ADMIN_ROLE_IDS)->get();
    }

    // Check if a candidate (user) has not been updated.
    public static function isCandidateNotUpdated($user) {
        return $user->isCandidate &&
            (!$user->candidateDetail()->exists() || 
                $user->candidateDetail->candidateDetailChanges()->where('status', '!=', 'cancelled')->get()->isEmpty());
    }

    // Check if a candidate (user) status is pending.
    public static function isCandidatePending($user) {
        return $user->isCandidate &&
            ($user->candidateDetail->candidateDetailChanges()->where('status', 'pending')->get()->isNotEmpty());
    }

    // Check if a user's candidate detail data is empty. Assumes that user is already a candidate
    // Returns true if candidateDetail does not exists yet.
    public static function isCandidateDetailEmpty(User $user) {
        if ($user->candidateDetail()->exists()) {
            $candidateDetail = $user->candidateDetail;
            return self::isCandidateDetailDataNull($candidateDetail);
        }
        return true;
    }

    public static function isRequiredCandidateDetailDataAndRelationshipEmpty($candidateDetail) {
        return self::isCandidateDetailDataNull($candidateDetail) ||
            self::isRequiredCandidateDetailRelationshipDataNull($candidateDetail);
    }

    private static function isCandidateDetailDataNull($candidateDetail) {
        return $candidateDetail->preferred_working_location == null ||
            $candidateDetail->linkedin_link == null ||
            $candidateDetail->whatsapp_number == null ||
            $candidateDetail->about_me_description == null ||
            $candidateDetail->experience_year == null ||
            $candidateDetail->industry == null ||
            $candidateDetail->cv_file == null;
    }
    
    private static function isRequiredCandidateDetailRelationshipDataNull($candidateDetail) {
        return $candidateDetail->workExperiences == null ||
            $candidateDetail->educations == null ||
            $candidateDetail->hardskills == null ||
            $candidateDetail->softskills == null;
    }

    public static function isCandidateDetailChangeDataAndRelationshipEmpty(CandidateDetailChange $candidateDetailChange) {
        return self::isCandidateDetailChangeDataNull($candidateDetailChange)
            && self::isRequiredCandidateDetailChangeRelationshipDataNull($candidateDetailChange);
    }

    public static function isCandidateDetailChangeDataNull(CandidateDetailChange $candidateDetailChange) {
        return $candidateDetailChange->preferred_working_location == null ||
            $candidateDetailChange->linkedin_link == null ||
            $candidateDetailChange->whatsapp_number == null ||
            $candidateDetailChange->about_me_description == null ||
            $candidateDetailChange->experience_year == null ||
            $candidateDetailChange->industry == null;
    }

    private static function isRequiredCandidateDetailChangeRelationshipDataNull(CandidateDetailChange $candidateDetailChange) {
        return !$candidateDetailChange->workExperienceChanges()->exists() &&
            !$candidateDetailChange->educationChanges()->exists() &&
            !$candidateDetailChange->achievementChanges()->exists() &&
            !$candidateDetailChange->hardskillChanges()->exists() &&
            !$candidateDetailChange->softskillChanges()->exists() &&
            !$candidateDetailChange->interestChanges()->exists();
    }

    // Method to check where a candidate has been hired.
    public static function isCandidateHired($candidate_id) {
        return DB::table(self::HIRING_PARTNER_CANDIDATE_TABLE)
            ->where('candidate_id', $candidate_id)
            ->where('status', 'accepted')
            ->orWhere('status', 'hired')
            ->count() > 0;
    }

    // Method to check if HiringPartner & Candidate has been mapped.
    public static function isHiringPartnerCandidateExists($hiring_partner_id, $candidate_id) {
        return DB::table(self::HIRING_PARTNER_CANDIDATE_TABLE)
            ->where('hiring_partner_id', $hiring_partner_id)
            ->where('candidate_id', $candidate_id)
            ->count() > 0;
    }

    // Method to contact Archived Candidate. Assumes that :
    //  - Candidate has not been hired by another HiringPartner
    //  - Candidate has been mapped to the given HiringPartner
    public static function contactCandidate(User $candidate, $hiring_partner_id) {
        $hiringPartnerCandidatePivot = $candidate->hiringPartners()
            ->where('hiring_partner_id', $hiring_partner_id)
            ->firstOrFail()->pivot;

        if ($hiringPartnerCandidatePivot->status == 'archived') {
            $hiringPartnerCandidatePivot->status = 'contacted';
            $hiringPartnerCandidatePivot->save();
        }
    }

    // Method to unarchive Archived/Contacted/Hired Candidate. Assumes that :
    //  - Candidate has not been hired by another HiringPartner
    //  - Candidate has been mapped to the given HiringPartner
    public static function unarchiveCandidate(User $candidate, $hiring_partner_id) {
        $hiringPartnerCandidatePivot = $candidate->hiringPartners()
            ->where('hiring_partner_id', $hiring_partner_id)
            ->firstOrFail()->pivot;

        if (in_array($hiringPartnerCandidatePivot->status, ['archived', 'contacted', 'hired'])) {
            $candidate->hiringPartners()->detach($hiring_partner_id);
        }
    }

    // Method to hire Archived Candidate. Assumes that :
    //  - Candidate has not been hired by another HiringPartner
    //  - Candidate has been mapped to the given HiringPartner
    public static function hireCandidate(User $candidate, $hiring_partner_id) {
        // Update pivot data of given candidate & hiring partner to 'accepted'.
        $hiringPartnerCandidatePivot = $candidate->hiringPartners()
            ->where('hiring_partner_id', $hiring_partner_id)
            ->firstOrFail()->pivot;

        if ($hiringPartnerCandidatePivot->status == 'contacted') {
            $hiringPartnerCandidatePivot->status = 'accepted';
            $hiringPartnerCandidatePivot->save();
    
            // Update all other pivot data of given candidate to 'hired'.
            $contactedHiringPartnerCandidatePivots =
                DB::table(self::HIRING_PARTNER_CANDIDATE_TABLE)
                    ->where('candidate_id', $candidate->id)
                    ->whereIn('status', ['archived', 'contacted'])
                    ->update(['status' => 'hired']);
        }
    }

    // Method to change Accepted Candidate status to Contacted. Assumes that :
    //  - Candidate has not been hired by another HiringPartner
    //  - Candidate has been mapped to the given HiringPartner
    public static function cancelCandidate(User $candidate, $hiring_partner_id) {
        $hiringPartnerCandidatePivot = $candidate->hiringPartners()
            ->where('hiring_partner_id', $hiring_partner_id)
            ->firstOrFail()->pivot;

        if ($hiringPartnerCandidatePivot->status == 'accepted') {
            // Update all other pivot data of given candidate to 'contacted'.
            $contactedHiringPartnerCandidatePivots =
                DB::table(self::HIRING_PARTNER_CANDIDATE_TABLE)
                    ->where('candidate_id', $candidate->id)
                    ->whereIn('status', ['accepted', 'hired'])
                    ->update(['status' => 'archived']);
        }
    }

    // Method to get list of updated work_experience_ids from a CandidateDetailChange object.
    public static function getUpdatedWorkExperienceIds($candidateDetailChange) {
        if (!is_null($candidateDetailChange)) {
            return $candidateDetailChange->workExperienceChanges()
                ->pluck('work_experience_id')->toArray();
        }
        return [];
    }

    // Method to get list of updated education_ids from a CandidateDetailChange object.
    public static function getUpdatedEducationIds($candidateDetailChange) {
        if (!is_null($candidateDetailChange)) {
            return $candidateDetailChange->educationChanges()
                ->pluck('education_id')->toArray();
        }
        return [];
    }

    // Method to get list of updated achievement_ids from a CandidateDetailChange object.
    public static function getUpdatedAchievementIds($candidateDetailChange) {
        if (!is_null($candidateDetailChange)) {
            return $candidateDetailChange->achievementChanges()
                ->pluck('achievement_id')->toArray();
        }
        return [];
    }

    // Method to get list of updated hardskill_ids from a CandidateDetailChange object.
    public static function getUpdatedHardskillIds($candidateDetailChange) {
        if (!is_null($candidateDetailChange)) {
            return $candidateDetailChange->hardskillChanges()
                ->pluck('hardskill_id')->toArray();
        }
        return [];
    }

    // Method to get list of updated softskill_ids from a CandidateDetailChange object.
    public static function getUpdatedSoftskillIds($candidateDetailChange) {
        if (!is_null($candidateDetailChange)) {
            return $candidateDetailChange->softskillChanges()
                ->pluck('softskill_id')->toArray();
        }
        return [];
    }

    // Method to get list of updated interest_ids from a CandidateDetailChange object.
    public static function getUpdatedInterestIds($candidateDetailChange) {
        if (!is_null($candidateDetailChange)) {
            return $candidateDetailChange->interestChanges()
                ->pluck('interest_id')->toArray();
        }
        return [];
    }

    // Method get highest score from candidateDetail object.
    public static function getHighestScoreFromCandidateDetail($candidateDetail) {
        return $candidateDetail->user->courses()->get()
            ->map(function ($course) {
                return $course->pivot->score;
            })->sortBy('score')->toArray()[0];
    }
}