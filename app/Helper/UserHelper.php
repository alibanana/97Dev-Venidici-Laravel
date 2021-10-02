<?php

namespace App\Helper;

use App\Models\User;

class UserHelper {

    private const ADMIN_ROLE_IDS = [2, 3];

    // Get lists of admins.
    public static function findAllAdmins() {
        return User::whereIn('user_role_id', self::ADMIN_ROLE_IDS)->get();
    }

}