<?php

namespace App;

class BankApp
{
    private const LOGIN = 1;
    private const REGISTRATION = 2;
    private const EXIT_APP = 3;
    private Authentication $authentication;


    private array $options = [
        self::LOGIN => "Login",
        self::REGISTRATION => "Registration",
        self::EXIT_APP => "Exit"
    ];

    public function __construct()
    {
        $this->authentication = new Authentication(new FileStorage());
    }

    public function run(): void
    {
        while (true) {
            foreach ($this->options as $option => $label) {
                printf("%d. %s\n", $option, $label);
            }

            $choice = intval(readline("Enter your option: "));
            switch ($choice) {
                case self::LOGIN:
                    $email = trim(readline("Enter your email: "));
                    $password = trim(readline("Enter your password: "));
                    $this->authentication->login($email, $password);
                    break;
                case self::REGISTRATION:
                    $name = trim(readline("Enter your name: "));
                    $email = trim(readline("Enter your email: "));
                    $password = trim(readline("Enter your password: "));
                    $this->authentication->register($name, $email, $password);
                    break;
                case self::EXIT_APP:
                    return;
                default:
                    echo "Invalid option \n";
            }
        }
    }
}
