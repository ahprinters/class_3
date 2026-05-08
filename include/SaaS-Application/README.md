উদাহরণ ২: SaaS Application (Subscription-Based Features)

এটা modern startup application-এ খুব common।

ধরো:

Free user
Pro user
Enterprise user

সবার feature আলাদা।

Project Structure
saas-app/
│
├── index.php
└── features/
    ├── free.php
    ├── pro.php
    └── enterprise.php


features/free.php
<h2>Free Plan</h2>

<ul>
    <li>Basic Dashboard</li>
    <li>Limited Storage</li>
</ul>
features/pro.php
<h2>Pro Plan</h2>

<ul>
    <li>Advanced Analytics</li>
    <li>Unlimited Storage</li>
</ul>
features/enterprise.php
<h2>Enterprise Plan</h2>

<ul>
    <li>Dedicated Server</li>
    <li>AI Reporting</li>
    <li>Priority Support</li>
</ul>
index.php
<?php

$user_plan = "pro";

$plans = ['free', 'pro', 'enterprise'];

if (in_array($user_plan, $plans)) {

    include "features/$user_plan.php";

} else {

    echo "Invalid Plan";
}

?>
Output
Pro Plan

• Advanced Analytics
• Unlimited Storage
এখানে কী শিখলে?

একই application:

different users
different features
different UI

show করছে।

Real World Examples 🚀

এমন architecture use হয়:

Platform	Example
Canva	Free vs Pro tools
Netflix	Different subscription features
ChatGPT	Free vs Plus
Dropbox	Storage limitation
Zoom	Meeting duration limits


Advanced Concept 🔥

এই ধরনের app-এ include ছাড়াও থাকে:

Middleware
Access control
Feature flags
API permission
Subscription validation


Multi-user system-এ include ব্যবহার হয়:

✅ User role separation
✅ Subscription features
✅ Dynamic dashboard
✅ Modular architecture
✅ Permission systems
✅ Enterprise applications


Professional Insight 💡

Real enterprise app-এ developerরা eventually move করে:

MVC architecture
Controllers
Middleware
Blade/Twig templates
Dependency Injection
Service Container

কারণ project বড় হলে plain include system hard হয়ে যায় manage করতে।