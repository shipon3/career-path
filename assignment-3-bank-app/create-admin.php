#!/usr/bin/env php
<?php

use App\AdminCreate;

require "vendor/autoload.php";

$create_admin = new AdminCreate();
$create_admin->run();
