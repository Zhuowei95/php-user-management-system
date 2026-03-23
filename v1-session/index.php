<?php require_once __DIR__ . '/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Version 1 - Session User Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Version 1 - Session Based User Management</h1>
    <p class="small">This version repeats the given task using PHP sessions for register, login, logout, and profile view.</p>

    <div class="alert info">
        <strong>Demo accounts:</strong><br>
        Admin: alice@example.com / admin123<br>
        Regular User: bob@example.com / user123
    </div>

    <div class="alert info">
        <strong>Permissions in Version 1:</strong><br>
        Admin can view all session users and the activity log.<br>
        Regular User can view only their own profile.
    </div>

    <p>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </p>

    <?php if (isset($_SESSION['current_user'])): ?>
        <div class="alert success">
            Logged in as <strong><?= htmlspecialchars($_SESSION['current_user']['name']) ?></strong>
            (<?= htmlspecialchars($_SESSION['current_user']['role']) ?>)
        </div>
    <?php else: ?>
        <div class="alert error">No active session.</div>
    <?php endif; ?>
</div>
</body>
</html>
