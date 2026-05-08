<?php

include __DIR__ . "/auth.php";
include __DIR__ . "/subscription.php";

include __DIR__ . "/layouts/header.php";

echo "<h2>Welcome, " . $current_user['name'] . "</h2>";
echo "<p>Role: " . $current_user['role'] . "</p>";
echo "<p>Plan: " . $current_user['plan'] . "</p>";
echo "<hr>";

$user_role = $current_user['role'];
$user_plan = $current_user['plan'];

if (isset($role_modules[$user_role]) && isset($plan_modules[$user_plan])) {

    $modules_to_load = array_merge(
        $role_modules[$user_role],
        $plan_modules[$user_plan]
    );

    $modules_to_load = array_unique($modules_to_load);

    foreach ($modules_to_load as $module) {

        $module_file = __DIR__ . "/modules/$module.php";

        if (file_exists($module_file)) {
            include $module_file;
            echo "<hr>";
        } else {
            echo "<p style='color:red;'>Module file missing: $module</p>";
        }
    }

} else {
    echo "<h3>Invalid user role or subscription plan.</h3>";
}

include __DIR__ . "/layouts/footer.php";

?>