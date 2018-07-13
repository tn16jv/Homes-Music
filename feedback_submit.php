#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Done</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
</head>
<body>
<?php
include_once("header.html");
?>
<section>
    Thank you for feedback!
</section>
<?php
include "PHP/databaseAccess.php";
$conn = connectDB();

date_default_timezone_set('US/Eastern');    // set to one timezone to avoid conflicting times
$unix_time = time();
$date = date("g:ia F d Y");         // Date in reg expression format: 1:39pm January 09 2018
$name = $conn->real_escape_string($_POST['Name']);
$email = $conn->real_escape_string($_POST['Email']);
$rating = $conn->real_escape_string($_POST['Rating']);
$nav_ease = $conn->real_escape_string($_POST['Navigation']);
$comments = $conn->real_escape_string($_POST['Comments']);
$command = "INSERT into feedback (unix_time, dates, username, email, rating, nav_ease, comments) 
VALUES('" . $unix_time . "','" . $date . "','" . $name . "','" . $email . "','" . $rating . "','" . $nav_ease . "','"
    . $comments . "')";

$conn->query($command);     // Apply SQL query to the tn16jv database
$conn->close();
?>
<footer>
    <p>Created by: ThaiBinh Nguyen</p>
    <p>Brock University</p>
    <p>2018</p>
</footer>
</body>
</html>
