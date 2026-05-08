<?php

$app = require __DIR__ . '/../config/app.php';

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    jsonResponse(false, "Authorization token missing.");
}

$token = str_replace("Bearer ", "", $headers['Authorization']);

if ($token !== $app['api_token']) {
    jsonResponse(false, "Invalid API token.");
}