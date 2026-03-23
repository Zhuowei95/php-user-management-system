<?php
require_once __DIR__ . '/../bootstrap.php';
requireLogin();

use App\Repositories\ActivityLogRepository;
use App\Repositories\UserRepository;

$message = '';
$type = '';
$users = [];
$logs = [];

try {
    $userRepository = new UserRepository();
    $logRepository = new ActivityLogRepository();

    if ($_SESSION['current_user']['role'] === 'Admin') {
        $users = $userRepository->all();
        $logs = $logRepository->latest();
    } else {
        $user = $userRepository->findById((int) $_SESSION['current_user']['id']);
        if ($user) {
            $users = [[
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'created_at' => $user['created_at'],
            ]];
        }
    }
} catch (Throwable $e) {
    $message = $e->getMessage();
    $type = 'error';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Dashboard</h2>
    <p>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </p>

    <div class="alert success">
        <strong>Name:</strong> <?= htmlspecialchars($_SESSION['current_user']['name']) ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($_SESSION['current_user']['email']) ?><br>
        <strong>Role:</strong> <?= htmlspecialchars($_SESSION['current_user']['role']) ?>
    </div>

    <?php if ($_SESSION['current_user']['role'] === 'Admin'): ?>
        <div class="alert info">Admin permission: you can see all registered users and recent activity logs stored in the database.</div>
    <?php else: ?>
        <div class="alert info">Regular user permission: you can only see your own database record.</div>
    <?php endif; ?>

    <?php if ($message !== ''): ?>
        <div class="alert <?= htmlspecialchars($type) ?>"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <h3><?= $_SESSION['current_user']['role'] === 'Admin' ? 'All Registered Users' : 'Your Profile Data' ?></h3>
    <?php if (empty($users)): ?>
        <p class="small">No user data available.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td><?= htmlspecialchars((string) $user['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php if ($_SESSION['current_user']['role'] === 'Admin'): ?>
        <h3>Latest Activity Logs</h3>
        <?php if (empty($logs)): ?>
            <p class="small">No activity logs stored yet.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $log['id']) ?></td>
                        <td><?= htmlspecialchars($log['name'] ?? 'System') ?></td>
                        <td><?= htmlspecialchars($log['message']) ?></td>
                        <td><?= htmlspecialchars((string) $log['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
