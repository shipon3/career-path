#!/usr/bin/env php
<?php

use App\BankApp;

require "vendor/autoload.php";

$bank_app = new BankApp();
$bank_app->run();
