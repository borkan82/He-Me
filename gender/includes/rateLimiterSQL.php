<?php

/**
 * CREATE TABLE rate_limits (
ip_address VARCHAR(45),    -- Store IPv4 or IPv6 addresses
request_time INT(11),      -- Timestamp of each request
PRIMARY KEY (ip_address, request_time)
);
 *
 */

// Database connection setup
$dsn = 'mysql:host=localhost;dbname=testdb';
$username = 'root';
$password = 'password';
$options = [];
$pdo = new PDO($dsn, $username, $password, $options);

// Define the rate limit and time window
$limit = 5;
$timeWindow = 60; // in seconds

// Get the user's IP address
$userIP = $_SERVER['REMOTE_ADDR'];
$currentTime = time();

// Delete old requests that are outside the time window
$stmt = $pdo->prepare("DELETE FROM rate_limits WHERE ip_address = :ip AND request_time < :time_limit");
$stmt->execute(['ip' => $userIP, 'time_limit' => $currentTime - $timeWindow]);

// Count the number of requests in the time window
$stmt = $pdo->prepare("SELECT COUNT(*) FROM rate_limits WHERE ip_address = :ip");
$stmt->execute(['ip' => $userIP]);
$requestCount = $stmt->fetchColumn();

if ($requestCount >= $limit) {
    // If the request limit is exceeded, block the request
    header('HTTP/1.1 429 Too Many Requests');
    die("Rate limit exceeded. Try again later.");
} else {
    // Log the current request
    $stmt = $pdo->prepare("INSERT INTO rate_limits (ip_address, request_time) VALUES (:ip, :request_time)");
    $stmt->execute(['ip' => $userIP, 'request_time' => $currentTime]);

    // Allow the user to access the page
    // JUST CONTINUE WITH CODE
}