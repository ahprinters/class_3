<?php
$user_plan = 'pro';

$allowed_plans = ['free', 'pro', 'enterprise'];
if (in_array($user_plan, $allowed_plans)) {
    include 'features/' . $user_plan . '.php';
} else {
    echo "Invalid Plan.";
}




?>