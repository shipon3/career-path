<?php

namespace App;

class Withdraw extends Transaction
{
    public function __construct()
    {
        $this->type = TransactionType::WITHDRAW;
    }
}
