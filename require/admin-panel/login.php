<?php
session_start();

if (isset($_POST['login'])) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

<form method="POST">
    <button type="submit" name="login">Login as Admin</button>
</form>

</body>
</html>