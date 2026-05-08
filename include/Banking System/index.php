<?php
include "auth.php";

$allowed_roles = ['admin', 'manager', 'cashier', 'customer'];
if (in_array($user_role, $allowed_roles)) {
    include 'panels/' . $user_role . '.php';
} else {
    echo "Access denied.";
}   


?>