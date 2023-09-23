<?php

namespace App;


class AdminDashboard
{
    private FinanceManager $financeManager;
    private const TRANSACTION = 1;
    private const USER_TRANSACTION = 2;
    private const CUSTOMERS = 3;
    private const EXIT_APP = 4;

    private array $options = [
        self::TRANSACTION => "All Transactions",
        self::USER_TRANSACTION => "User Transactions",
        self::CUSTOMERS => "All Customers",
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
                    $this->financeManager->allTransactions();
                    break;
                case self::USER_TRANSACTION:
                    $email = trim(readline("Enter Email: "));
                    $this->financeManager->userTransactions($email);
                    break;
                case self::CUSTOMERS:
                    $this->financeManager->allUsers();
                    break;
                case self::EXIT_APP:
                    return;
                default:
                    echo "Invalid option\n";
            }
        }
    }
}
