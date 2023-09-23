<?php

namespace App\Auth;

use App\Model\Model;

class Customer implements Model
{
    public static function getModelName(): string
    {
        return 'customers';
    }
}
