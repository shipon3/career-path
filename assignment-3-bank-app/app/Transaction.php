<?php

namespace App;

use App\Model\Model;

class Transaction implements Model
{
    public TransactionType $type;
    private float $amount;
    private string $email;
    public static function getModelName(): string
    {
        return 'transactions';
    }

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
