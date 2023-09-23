<?php

namespace App;

use App\Auth\Admin;
use App\Auth\AdminLogin;
use App\Auth\AdminRegistration;
use App\Auth\Auth;
use App\Auth\Customer;
use App\Auth\Login;
use App\Auth\Registration;

class Authentication
{
    private array $customers;
    private array $admins;
    private FileStorage $fileStorage;
    private CustomerDashboard $customerDashboard;
    private AdminDashboard $adminDashboard;

    public function __construct(FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
        $this->customerDashboard = new CustomerDashboard();
        $this->adminDashboard = new AdminDashboard();
        $this->customers = $this->fileStorage->load(Customer::getModelName());
        $this->admins = $this->fileStorage->load(Admin::getModelName());
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
    public function adminLogin(string $email, string $password): void
    {
        $login = new Login();

        foreach ($this->admins as $admin) {
            if ($admin->email === $email && $admin->password === $password) {
                $login->setEmail($email);
                $login->setPassword($password);
                $this->adminDashboard->dashboard($email);
                return;
            }
        }
        printf("Don't match\n");
    }
    public function register(string $name, string $email, string $password): void
    {
        $this->existEmail($this->customers, $email);
        $register = new Registration();
        $register->setName($name);
        $register->setEmail($email);
        $register->setPassword($password);
        $this->customers[] = $register;
        $this->saveCustomer(Customer::getModelName(), $this->customers);
        printf("Customer create successfully\n");
    }

    public function adminRegister(string $name, string $email, string $password): void
    {
        $this->existEmail($this->admins, $email);
        $register = new Registration();
        $register->setName($name);
        $register->setEmail($email);
        $register->setPassword($password);
        $this->admins[] = $register;
        $this->saveCustomer(Admin::getModelName(), $this->admins);
        printf("Admin create successfully\n");
    }

    public function saveCustomer(string $model, array $data): void
    {
        $this->fileStorage->save($model, $data);
    }

    public function existEmail(array $data, string $email): void
    {
        foreach ($data as $item) {
            if ($item->email == $email) {
                printf("Already exist this email\n");
                return;
            }
        }
        return;
    }
}
