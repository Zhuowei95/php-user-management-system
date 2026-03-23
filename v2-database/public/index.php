<?php require_once __DIR__ . '/../bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Version 2 - Database User Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Version 2 - Database User Management</h1>
    <p class="small">This version supplements the base project by storing users and activity logs in a MySQL database.</p>

    <div class="alert info">
        <strong>Default admin account:</strong><br>
        Email: admin@example.com<br>
        Password: admin123
    </div>

    <div class="alert info">
        <strong>Permissions in Version 2:</strong><br>
        Admin can view all registered users and recent activity logs from the database.<br>
        Regular User can view only their own database record.
    </div>

    <p>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <a href="dashboard.php">Dashboard</a>
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
