<?php require_once __DIR__ . '/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>User Profile</h2>
    <p><a href="index.php">Back to home</a></p>

    <?php if (!isset($_SESSION['current_user'])): ?>
        <div class="alert error">Please log in first.</div>
    <?php else: ?>
        <?php $isAdmin = $_SESSION['current_user']['role'] === 'Admin'; ?>
        <div class="alert success">
            <strong>Name:</strong> <?= htmlspecialchars($_SESSION['current_user']['name']) ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($_SESSION['current_user']['email']) ?><br>
            <strong>Role:</strong> <?= htmlspecialchars($_SESSION['current_user']['role']) ?>
        </div>

        <?php if ($isAdmin): ?>
            <div class="alert info">
                Admin permission: you can see all registered users in the current session and the activity log.
            </div>

            <h3>All Registered Users In Current Session</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
                <?php foreach (($_SESSION['users'] ?? []) as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <h3>Activity Log</h3>
            <?php if (!empty($_SESSION['activity_log'])): ?>
                <ul>
                    <?php foreach ($_SESSION['activity_log'] as $item): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="small">No activity recorded yet.</p>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert info">
                Regular user permission: you can only view your own profile. The registered user list and activity log are reserved for Admin.
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
