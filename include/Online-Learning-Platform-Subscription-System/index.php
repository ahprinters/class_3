
<?php

include __DIR__ . "/user-plan.php";

echo "<h2>Welcome, " . $current_user['name'] . "</h2>";

$user_subscription = $current_user['subscription'];

if (isset($subscription_modules[$user_subscription])) {

    foreach ($subscription_modules[$user_subscription] as $module) {

        $module_file = __DIR__ . "/modules/$module.php";

        if (file_exists($module_file)) {
            include $module_file;
        } else {
            echo "<p>Module not found: $module</p>";
        }
    }

} else {
    echo "No valid subscription found.";
}

?>