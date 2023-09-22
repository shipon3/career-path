<?php

namespace App;

class BalanceTransfer extends Transaction
{
    private string $fromEmail;
    public function __construct()
    {
        $this->type = TransactionType::TRANSFER;
    }

    public function setFromEmail(string $email): void
    {
        $this->fromEmail = $email;
    }

    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }
}
