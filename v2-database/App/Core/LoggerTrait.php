<?php
namespace App\Core;

use App\Repositories\ActivityLogRepository;

trait LoggerTrait
{
    public function logActivity(string $message, ?int $userId = null): void
    {
        $repository = new ActivityLogRepository();
        $repository->create($message, $userId);
    }
}
