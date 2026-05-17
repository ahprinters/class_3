<?php
require_once __DIR__ . '/../config/app.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../login.php');
}

$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';
$errors = [];
$_SESSION['old'] = ['email' => $email];

if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    $errors[] = 'Invalid security token. Please try again.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}
if ($password === '') {
    $errors[] = 'Password is required.';
}

if (!$errors) {
    $stmt = $pdo->prepare('SELECT id, name, email, password, created_at FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if (!$user || !password_verify($password, $user['password'])) {
        $errors[] = 'Invalid email or password.';
    }
}

if ($errors) {
    set_flash('errors', $errors);
    redirect('../login.php?tab=login');
}

session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];
$_SESSION['user'] = [
    'id' => $user['id'],
    'name' => $user['name'],
    'email' => $user['email'],
    'created_at' => $user['created_at'],
];

unset($_SESSION['old']);
set_flash('success', 'Login successful.');
redirect('../dashboard.php');
