<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/database.php';

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function set_flash($key, $value)
{
    $_SESSION['flash'][$key] = $value;
}

function get_flash($key)
{
    if (!isset($_SESSION['flash'][$key])) {
        return null;
    }
    $value = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $value;
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_input()
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
}

function is_logged_in()
{
    return !empty($_SESSION['user_id']);
}

function current_user()
{
    global $pdo;

    if (!is_logged_in()) {
        return null;
    }

    if (!empty($_SESSION['user'])) {
        return $_SESSION['user'];
    }

    $stmt = $pdo->prepare('SELECT id, name, email, created_at FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        session_destroy();
        return null;
    }

    $_SESSION['user'] = $user;
    return $user;
}

function require_guest()
{
    if (is_logged_in()) {
        redirect('dashboard.php');
    }
}

function require_auth()
{
    if (!is_logged_in()) {
        set_flash('info', 'Please login first.');
        redirect('login.php');
    }
}
