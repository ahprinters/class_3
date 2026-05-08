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
