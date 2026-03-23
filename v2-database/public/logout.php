<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Services\AuthService;

try {
    $authService = new AuthService();
    $authService->logoutCurrentUser();
} catch (Throwable $e) {
    unset($_SESSION['current_user']);
}

redirect('index.php');
