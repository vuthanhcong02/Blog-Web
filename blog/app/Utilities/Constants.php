<?php

namespace App\Utilities;
class Constants{

    // User
    const USER_LEVEL_ADMIN = 'admin';
    const USER_LEVEL_CUSTOMER = 'user';
    const USER_LEVEL_MANAGER = 'manager';
    public static $user_level = [
        self::USER_LEVEL_ADMIN => 'Admin',
        self::USER_LEVEL_CUSTOMER => 'Nguời dùng',
        self::USER_LEVEL_MANAGER => 'Quản trị viên',
    ];

}
