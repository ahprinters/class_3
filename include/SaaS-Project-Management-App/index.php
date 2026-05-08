<?php
include __DIR__ . "/subscription.php";

echo "<h2>Project Management Dashboard</h2>";

if (isset($plan_features[$user_plan])) {

    foreach ($plan_features[$user_plan] as $feature) {

        $file = __DIR__ . "/features/$feature.php";

        if (file_exists($file)) {
            include $file;
        } else {
            echo "<p>Feature file missing: $feature</p>";
        }
    }

} else {
    echo "Invalid subscription plan.";
}

?>