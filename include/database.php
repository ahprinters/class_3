<?php

include_once "config.php";

$conn = mysqli_connect($host, $username, $password, $dbname);
echo "Database Connected";