<?php

namespace App\Auth;

use App\Model\Model;

class Registration extends Auth
{
    private string $name;
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
