<?php

$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'about', 'contact'];

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

include "pages/$page.php";

?>