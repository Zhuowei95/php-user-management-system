<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Repositories\UserRepository;

$message = '';
$type = '';

try {
    $userRepository = new UserRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($name === '' || $email === '' || $password === '') {
            $message = 'All fields are required.';
            $type = 'error';
        } elseif ($userRepository->findByEmail($email)) {
            $message = 'This email is already registered.';
            $type = 'error';
        } else {
            $userRepository->create($name, $email, $password);
            $message = 'Registration successful. You can now log in.';
            $type = 'success';
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
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <p><a href="index.php">Back to home</a></p>

    <?php if ($message !== ''): ?>
        <div class="alert <?= htmlspecialchars($type) ?>"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
