Example 1: Mini Blog System — Controller, Model, View আলাদা করা

এটি একটি ছোট MVC-style example। এখানে index.php একা সব কাজ করছে না। Database, Model, Controller, View আলাদা file-এ রাখা হয়েছে।

Project Structure
blog-app/
│
├── index.php
├── config.php
│
├── core/
│   └── database.php
│
├── models/
│   └── Post.php
│
├── controllers/
│   └── PostController.php
│
└── views/
    └── post-list.php

config.php
<?php

return [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'blog_db'
];


core/database.php
<?php

$config = require __DIR__ . '/../config.php';

$conn = mysqli_connect(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['database']
);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

এখানে database.php file চালানোর জন্য config.php অবশ্যই দরকার। তাই এখানে:

$config = require __DIR__ . '/../config.php';

ব্যবহার করা হয়েছে।

models/Post.php
<?php

function getAllPosts($conn) {
    $sql = "SELECT id, title, body FROM posts ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    $posts = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
    }

    return $posts;
}

controllers/PostController.php
<?php

require __DIR__ . '/../models/Post.php';

function showPosts($conn) {
    $posts = getAllPosts($conn);

    require __DIR__ . '/../views/post-list.php';
}

এখানে PostController.php-এর জন্য Post.php model file বাধ্যতামূলক। কারণ getAllPosts() function model file-এর ভিতরে আছে। তাই model file missing হলে controller কাজ করবে না।

views/post-list.php
<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
</head>
<body>

<h2>All Blog Posts</h2>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <div style="border:1px solid #ddd; padding:10px; margin-bottom:10px;">
            <h3><?php echo $post['title']; ?></h3>
            <p><?php echo $post['body']; ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>

</body>
</html>

index.php
<?php

require __DIR__ . '/core/database.php';
require __DIR__ . '/controllers/PostController.php';

showPosts($conn);
এখানে require কেন important?

index.php চালাতে অবশ্যই দরকার:

require __DIR__ . '/core/database.php';
require __DIR__ . '/controllers/PostController.php';

কারণ database connection না থাকলে post show করা যাবে না। Controller না থাকলে page load করার logic থাকবে না।

তাই এখানে include দিলে ভুল হতে পারে। কারণ file missing হলেও warning দিয়ে page আংশিকভাবে চলতে পারে। কিন্তু এই system-এ file missing হলে application বন্ধ হওয়াই ভালো।