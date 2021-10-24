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

    public static function isCandidateDetailDataAndRelationshipEmpty(CandidateDetail $candidateDetail) {
        return self::isCandidateDetailDataNull($candidateDetail) ||
            self::isCandidateDetailRelationshipNull($candidateDetail);
    }

    private static function isCandidateDetailDataNull(CandidateDetail $candidateDetail) {
        return $candidateDetail->preferred_working_location == null ||
            $candidateDetail->linkedin_link == null ||
            $candidateDetail->whatsapp_number == null ||
            $candidateDetail->about_me_description == null ||
            $candidateDetail->experience_year == null ||
            $candidateDetail->industry == null ||
            $candidateDetail->cv_file == null;
    }
    
    private static function isCandidateDetailRelationshipNull(CandidateDetail $candidateDetail) {
        return !$candidateDetail->workExperiences()->exists() ||
            !$candidateDetail->educations()->exists() ||
            !$candidateDetail->achievements()->exists() ||
            !$candidateDetail->hardskills()->exists() ||
            !$candidateDetail->softskills()->exists() ||
            !$candidateDetail->interests()->exists();
    }

    public static function isCandidateDetailChangeDataNull(CandidateDetailChange $candidateDetailChange) {
        return $candidateDetailChange->preferred_working_location == null ||
            $candidateDetailChange->linkedin_link == null ||
            $candidateDetailChange->whatsapp_number == null ||
            $candidateDetailChange->about_me_description == null ||
            $candidateDetailChange->experience_year == null ||
            $candidateDetailChange->industry == null ||
            $candidateDetailChange->cv_file == null;
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

    // Method to hire Candidate to a HiringPartner. Assumes that :
    //  - Candidate has not been hired by another HiringPartner
    //  - Candidate has been mapped to the given HiringPartner
    public static function hireCandidate(User $candidate, $hiring_partner_id) {
        // Update pivot data of given candidate & hiring partner to 'accepted'.
        $hiringPartnerCandidatePivot = $candidate->hiringPartners()
            ->where('hiring_partner_id', Auth::user()->id)
            ->firstOrFail()->pivot;
        $hiringPartnerCandidatePivot->status = 'accepted';
        $hiringPartnerCandidatePivot->save();

        // Update all other pivot data of given candidate to 'hired'.
        $contactedHiringPartnerCandidatePivots =
            DB::table(self::HIRING_PARTNER_CANDIDATE_TABLE)
                ->where('candidate_id', $candidate_id)
                ->where('status', 'contacted')
                ->get();
        foreach ($contactedHiringPartnerCandidatePivots as $contactedHiringPartnerCandidatePivot) {
            $contactedHiringPartnerCandidatePivot->status = 'hired';
            $contactedHiringPartnerCandidatePivot->save();
        }
    }
}