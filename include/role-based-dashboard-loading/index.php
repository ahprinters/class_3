<?php
$user_role = 'admin';

// include 'dashboard/' . $user_role . '.php';

$allowed_roles = ['admin', 'teacher', 'student'];
if (in_array($user_role, $allowed_roles)) {
    include 'dashboard/' . $user_role . '.php';
} else {
    echo "Access denied.";
}


?>