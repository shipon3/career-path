<?php

namespace App;

use App\Auth\Auth;
use App\Auth\Login;
use App\Auth\Registration;

class Authentication
{
    private array $customers;
    private FileStorage $fileStorage;
    private CustomerDashboard $customerDashboard;

    public function __construct(FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
        $this->customerDashboard = new CustomerDashboard();
        $this->customers = $this->fileStorage->load(Auth::getModelName());
    }

    public function login(string $email, string $password): void
    {
        $login = new Login();

        foreach ($this->customers as $customer) {
            if ($customer->email === $email && $customer->password === $password) {
                $login->setEmail($email);
                $login->setPassword($password);
                $this->customerDashboard->dashboard($email);
                return;
            }
        }
        printf("Don't match\n");
    }
    public function register(string $name, string $email, string $password): void
    {
        $this->existEmail($email);
        $register = new Registration();
        $register->setName($name);
        $register->setEmail($email);
        $register->setPassword($password);
        $this->customers[] = $register;
        $this->saveCustomer();
        printf("Customer create successfully\n");
    }

    public function saveCustomer(): void
    {
        $this->fileStorage->save(Registration::getModelName(), $this->customers);
    }

    public function existEmail(string $email): void
    {
        foreach ($this->customers as $customer) {
            if ($customer->email == $email) {
                printf("Already exist this email\n");
                return;
            }
        }
        return;
    }
}
