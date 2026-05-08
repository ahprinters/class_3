উদাহরণ ১: SaaS Project Management App

ধরো তুমি Trello, Asana, ClickUp টাইপ একটি project management software বানাচ্ছো।

এখানে user plan অনুযায়ী feature আলাদা:

Plan	Features
Free	Task list, basic board
Pro	Task list, board, calendar, reports
Enterprise	Everything + team management + audit logs
Project Structure
project-management-app/
│
├── index.php
├── subscription.php
└── features/
    ├── task-list.php
    ├── kanban-board.php
    ├── calendar.php
    ├── reports.php
    ├── team-management.php
    └── audit-logs.php
features/task-list.php
<h3>Task List</h3>
<p>You can create and manage basic tasks.</p>

features/kanban-board.php
<h3>Kanban Board</h3>
<p>You can organize tasks by To Do, Doing, and Done columns.</p>

features/calendar.php
<h3>Calendar View</h3>
<p>You can view tasks by deadline and schedule.</p>

features/reports.php
<h3>Advanced Reports</h3>
<p>You can see productivity and project progress reports.</p>

features/team-management.php
<h3>Team Management</h3>
<p>You can manage users, roles, and departments.</p>

features/audit-logs.php
<h3>Audit Logs</h3>
<p>You can track who changed what and when.</p>

subscription.php
<?php

$user_plan = "pro";

$plan_features = [
    "free" => [
        "task-list",
        "kanban-board"
    ],

    "pro" => [
        "task-list",
        "kanban-board",
        "calendar",
        "reports"
    ],

    "enterprise" => [
        "task-list",
        "kanban-board",
        "calendar",
        "reports",
        "team-management",
        "audit-logs"
    ]
];

?>
index.php
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
Output যদি $user_plan = "pro" হয়
Project Management Dashboard

Task List
You can create and manage basic tasks.

Kanban Board
You can organize tasks by To Do, Doing, and Done columns.

Calendar View
You can view tasks by deadline and schedule.

Advanced Reports
You can see productivity and project progress reports.
এখানে Advanced Concept কী?

এখানে subscription plan অনুযায়ী আলাদা module load হচ্ছে।

মানে:

Free user সব feature পাবে না
Pro user কিছু advanced feature পাবে
Enterprise user সব premium feature পাবে

এটাই real SaaS application-এর core idea।

Real Life Analogy

ধরো একটি gym membership আছে।

Membership	Access
Basic	Gym equipment
Premium	Gym + swimming pool
VIP	Gym + pool + personal trainer + spa

Software subscription system-ও একইভাবে কাজ করে।