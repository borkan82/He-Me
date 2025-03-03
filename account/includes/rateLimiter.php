<?php

// Define the limit and time window
$limit = 5; // max 5 requests
$timeWindow = 60; // in seconds (1 minute)

// Get the user's IP address
$userIP = $_SERVER['REMOTE_ADDR'];

// Define a path for storing user request data
$dataFile = RATE_LOG."rate_limit_{$userIP}.txt";
//var_dump($dataFile);exit;
// Check if a record exists for this user
if (file_exists($dataFile)) {
    $data = file_get_contents($dataFile);
    $userData = json_decode($data, true);

    // Filter out requests older than the time window
    $currentTime = time();
    $userData = array_filter($userData, function($timestamp) use ($currentTime, $timeWindow) {
        return ($currentTime - $timestamp) <= $timeWindow;
    });

    // Count remaining requests in the time window
    if (count($userData) >= $limit) {
        // If the limit is exceeded, block the request
        header('HTTP/1.1 429 Too Many Requests');
        die("Rate limit exceeded. Try again later.");
    }
} else {
    // Initialize an empty array for a new user
    $userData = [];
}

// Add the current request timestamp
$userData[] = time();

// Save the updated data back to the file
file_put_contents($dataFile, json_encode($userData));

// Allow the user to access the page
// JUST CONTINUE TO CODE EXECUTION