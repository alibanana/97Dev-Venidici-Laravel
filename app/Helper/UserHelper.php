<?php

namespace App\Helper;

use App\Models\User;

class UserHelper {

    private const ADMIN_ROLE_IDS = [2, 3];

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
}