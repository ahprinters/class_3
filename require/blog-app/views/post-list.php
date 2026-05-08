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