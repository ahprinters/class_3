<?php

$role_modules = [
    "customer" => [
        "search-tour",
        "my-bookings"
    ],

    "hotel_owner" => [
        "manage-rooms",
        "booking-requests"
    ],

    "admin" => [
        "user-management",
        "payment-report"
    ]
];

$plan_modules = [
    "free" => [],

    "pro" => [
        "premium-analytics"
    ],

    "enterprise" => [
        "premium-analytics",
        "audit-logs"
    ]
];

?>