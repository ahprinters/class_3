<?php
require_once __DIR__ . '/../config/app.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../login.php?tab=register');
}

$name = trim($_POST['name'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';
$passwordConfirmation = $_POST['password_confirmation'] ?? '';
$policyAccepted = isset($_POST['policy']);
$errors = [];

$_SESSION['old'] = ['name' => $name, 'email' => $email];

if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    $errors[] = 'Invalid security token. Please try again.';
}
if ($name === '' || strlen($name) > 100) {
    $errors[] = 'Please enter a valid name within 100 characters.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}
if (strlen($password) < 6) {
    $errors[] = 'Password must be at least 6 characters.';
}
if ($password !== $passwordConfirmation) {
    $errors[] = 'Password confirmation does not match.';
}
if (!$policyAccepted) {
    $errors[] = 'You must agree to the privacy policy.';
}

if (!$errors) {
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $errors[] = 'This email is already registered. Please login.';
    }
}

if ($errors) {
    set_flash('errors', $errors);
    redirect('../login.php?tab=register');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
$stmt->execute([$name, $email, $hashedPassword]);

unset($_SESSION['old']);
set_flash('success', 'Registration successful. Please login now.');
redirect('../login.php?tab=login');
