<?php
namespace App\Core;

trait LoggerTrait
{
    public function logActivity(string $message): void
    {
        if (!isset($_SESSION['activity_log'])) {
            $_SESSION['activity_log'] = [];
        }

        $_SESSION['activity_log'][] = date('Y-m-d H:i:s') . ' - ' . $message;
    }
}
