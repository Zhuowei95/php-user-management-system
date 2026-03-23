<?php
session_start();
require_once __DIR__ . '/autoload.php';

use App\Services\UserStorage;

UserStorage::seedDemoUsers();
