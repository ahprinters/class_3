<?php

require __DIR__ . '/../models/Post.php';

function showPosts($conn) {
    $posts = getAllPosts($conn);

    require __DIR__ . '/../views/post-list.php';
}