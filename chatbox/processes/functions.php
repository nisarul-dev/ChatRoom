<?php
session_start();

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

// Setting up date and time

function get_sweet_time($current_timestamp) {
    $year_full = substr($current_timestamp, 0, 4);
    $year_short = substr($current_timestamp, 2, 2);
    $month = substr($current_timestamp, 5, 2);
    $dateObj   = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');
    $day = substr($current_timestamp, 8, 2);

    $hour = ltrim( substr("$current_timestamp", -8, 2), '0');
    $min = substr("$current_timestamp", -5, 2);

    // Printing Date
    if( $year_full == date("Y") && $month == date("m") && $day == date("d") ) {
        $date = "Today";
    } elseif( $year_full == date("Y") && $month == date("m") && $day == date("d")-1 ) {
        $date = "Yesterday";
    } else {
        $date = substr($monthName, 0, 3) . " " . $day ;
    }

    // Printing time
    if ($hour == 12) {
        $ampm = "AM";
    } elseif($hour > 12 ) {
        $hour -=12;
        $ampm = "PM";
    } elseif ($hour == 0) {
        $hour = 12;
        $ampm = "AM";
    } else {
        $ampm = "AM";
    }

    return $hour . ":" . $min . " " . $ampm . ", " . $date;
}


