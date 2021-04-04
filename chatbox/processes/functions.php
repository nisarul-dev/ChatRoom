<?php
$connection = mysqli_connect('localhost', 'root', '', 'chatroom');

$fun = "working";
// Custom Query Error
function custom_query_error($the_query) {
    global $connection;
    if(!$the_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
}

// Sanitizing Variables
function sanitizer($text) {
    global $connection;
    $text = filter_var($text, FILTER_SANITIZE_STRING);
    $text = trim($text);
    return $text = $connection->real_escape_string($text);
}