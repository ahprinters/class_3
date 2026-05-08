<?php 

$config = require __DIR__ . '/../config.php';

$conn = new mysqli(
    $config['host'], 
    $config['username'], 
    $config['password'], 
    $config['database']
    );

    if(!$conn)
    {
        die("Database connection failed: " . mysqli_connect_error());
    }