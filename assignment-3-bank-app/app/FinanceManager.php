<?php

namespace App;

use App\Auth\Auth;
use App\Auth\Customer;

class FinanceManager
{
    private array $transactions;
    private array $customers;
    private FileStorage $fileStorage;
    public function __construct(FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
        $this->transactions = $this->fileStorage->load(Transaction::getModelName());
        $this->customers = $this->fileStorage->load(Customer::getModelName());
    }
    public function deposit(float $amount, string $email)
    {
        $deposit = new Deposit();
        $deposit->setAmount($amount);
        $deposit->setEmail($email);
        $deposit->type;

        $this->transactions[] = $deposit;

        $this->saveTransaction();
        printf("--------------------------------\n");
        printf("Your Deposit Successfully\n");
        printf("--------------------------------\n");
    }

    public function withdraw(float $amount, string $email)
    {
        if ($this->remainingBalance($email) < $amount) {
            printf("--------------------------------\n");
            printf("Insufficient balance!\n");
            printf("--------------------------------\n");
            return;
        }
        $withdraw = new Withdraw();
        $withdraw->setAmount($amount);
        $withdraw->setEmail($email);
        $withdraw->type;
        $this->transactions[] = $withdraw;

        $this->saveTransaction();
        printf("--------------------------------\n");
        printf("Your Withdraw Successfully\n");
        printf("--------------------------------\n");
    }

    public function balanceTransfer(float $amount, string $toEmail, string $fromEmail)
    {
        // if (!in_array($toEmail, $this->customers)) {
        //     printf("--------------------------------\n");
        //     printf("Account Not Found!\n");
        //     printf("--------------------------------\n");
        //     return;
        // }
        if ($this->remainingBalance($fromEmail) < $amount) {
            printf("--------------------------------\n");
            printf("Insufficient balance!\n");
            printf("--------------------------------\n");
            return;
        }
        $balance_transfer = new BalanceTransfer();
        $balance_transfer->setAmount($amount);
        $balance_transfer->setEmail($toEmail);
        $balance_transfer->setFromEmail($fromEmail);
        $balance_transfer->type;
        $this->transactions[] = $balance_transfer;

        $this->saveTransaction();
        printf("--------------------------------\n");
        printf("Amount Transfer Successfully From Your Account To This Account : %s\n", $toEmail);
        printf("--------------------------------\n");
    }

    public function saveTransaction()
    {
        $this->fileStorage->save(Transaction::getModelName(), $this->transactions);
    }

    public function currentBalance(string $email)
    {
        $current_balance = $this->remainingBalance($email);
        printf("--------------------------------\n");
        printf("Your Current Balance = %d\n", $current_balance);
        printf("--------------------------------\n");
    }

    public function remainingBalance(string $email)
    {
        $deposit = 0;
        $withdraw = 0;
        $transfer_balance = 0;
        foreach ($this->transactions as $transaction) {
            if ($transaction->getEmail() === $email && $transaction->type === TransactionType::DEPOSIT) {
                $deposit += $transaction->getAmount();
            }
            // else if ($transaction->getFromEmail() ?? $transaction->getFromEmail() === $email && $transaction->type === TransactionType::TRANSFER) {
            //     $transfer_balance += $transaction->getAmount();
            // }
            if ($transaction->getEmail() === $email && $transaction->type === TransactionType::WITHDRAW) {
                // $total = $transaction->getAmount() + $transfer_balance;
                $withdraw += $transaction->getAmount();
            }
        }
        $balance = $deposit - $withdraw;
        return $balance;
    }

    public function userTransactions(string $email)
    {
        printf("--------------------------------\n");
        foreach ($this->transactions as $transaction) {
            if ($transaction->getEmail() === $email) {
                printf("%s - %d\n", $transaction->type->name, $transaction->getAmount());
            }
        }
        printf("--------------------------------\n");
    }

    public function allTransactions(): void
    {
        printf("--------------------------------\n");
        foreach ($this->transactions as $transaction) {
            printf("%s - %d\n", $transaction->type->name, $transaction->getAmount());
        }
        printf("--------------------------------\n");
    }

    public function allUsers(): void
    {
        printf("--------------------------------\n");
        printf("---------- User List -----------\n");
        printf("--------------------------------\n");
        foreach ($this->customers as $customer) {
            printf("user name : %s\nEmail : %s\n", $customer->getName(), $customer->getEmail());
            printf("--------------------------------\n");
        }
    }
}
