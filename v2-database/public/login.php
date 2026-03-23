<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Services\AuthService;

$message = '';
$type = '';

try {
    $authService = new AuthService();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($authService->authenticate($email, $password)) {
            redirect('dashboard.php');
        }

        $message = 'Invalid credentials.';
        $type = 'error';
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
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <p><a href="index.php">Back to home</a></p>

    <?php if ($message !== ''): ?>
        <div class="alert <?= htmlspecialchars($type) ?>"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
