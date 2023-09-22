<?php

namespace App;


class CustomerDashboard
{
    private FinanceManager $financeManager;
    private const TRANSACTION = 1;
    private const DEPOSIT = 2;
    private const WITHDRAW = 3;
    private const BALANCE = 4;
    private const TRANSFER = 5;
    private const EXIT_APP = 6;

    private array $options = [
        self::TRANSACTION => "Show My Transactions",
        self::DEPOSIT => "Deposit Money",
        self::WITHDRAW => "Withdraw Money",
        self::BALANCE => "Show Current Balance",
        self::TRANSFER => "Transfer Money",
        self::EXIT_APP => "Exit"
    ];

    public function __construct()
    {
        $this->financeManager = new FinanceManager(new FileStorage());
    }

    public function dashboard(string $email): void
    {
        while (true) {
            foreach ($this->options as $option => $label) {
                printf("%d. %s\n", $option, $label);
            }

            $choice = intval(readline("Enter your option: "));

            switch ($choice) {
                case self::TRANSACTION:
                    $this->financeManager->userTransactions($email);
                    break;
                case self::DEPOSIT:
                    $amount = (float)trim(readline("Enter amount: "));
                    $this->financeManager->deposit($amount, $email);
                    break;
                case self::WITHDRAW:
                    $amount = (float)trim(readline("Enter amount: "));
                    $this->financeManager->withdraw($amount, $email);
                    break;
                case self::BALANCE:
                    $this->financeManager->currentBalance($email);
                    break;
                case self::TRANSFER:
                    $toEmail = trim(readline("Enter Email Account: "));
                    $amount = (float)trim(readline("Enter Amount: "));
                    $this->financeManager->balanceTransfer($amount, $toEmail, $email);
                    break;
                case self::EXIT_APP:
                    return;
                default:
                    echo "Invalid option\n";
            }
        }
    }
}
