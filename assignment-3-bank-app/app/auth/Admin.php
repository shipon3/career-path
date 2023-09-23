<?php

namespace App\Auth;

use App\Model\Model;

class Admin implements Model
{
    public static function getModelName(): string
    {
        return 'admin';
    }
}
