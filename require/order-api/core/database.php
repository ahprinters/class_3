<?php 

$config = require __DIR__ . '/../config/app.php';

$conn = new mysqli(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

if (!$conn) {
    die("Database connection failed.");
}