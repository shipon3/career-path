<?php

namespace App;


class Deposit extends Transaction
{
    public function __construct()
    {
        $this->type = TransactionType::DEPOSIT;
    }
}
