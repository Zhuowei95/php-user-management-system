<?php
session_start();
require_once __DIR__ . '/autoload.php';

function redirect(string $path): void
{
    header("Location: {$path}");
    exit;
}

function requireLogin(): void
{
    if (!isset($_SESSION['current_user'])) {
        redirect('login.php');
    }
}
