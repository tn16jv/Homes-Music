#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/home.css" type="text/css" rel="stylesheet" />
    <link href="css/loginForm.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Script/loginForm.js"></script>
</head>
<body>

<?php
include_once("header.html");
session_start();
ob_start(); //Fixes any issues with headers being sent and then stopping the HTTP. Prominent with cookies and sessions.
?>

<div class="content_text">
    <p>Welcome to Home's Music!</p>
    <p>
        This website is a place to upload your music collection to play whenever and wherever you need it. You can also
        use this as an online backup to your music albums. However, media must be enabled in your browser (should be on
        by default).
    </p>
    <p>
        Note: uploading a second file with the same filename as a previous upload will just overwrite the previous file.
    </p>
</div>

<?php
include_once("PHP/loginForm.php");
?>

<?php
if (isset($_SESSION['user'])) {
    echo "Logged in as: \"" . $_SESSION['user'] . "\"";
}

$nextMonth = 30 * 60 * 24 * 60 + time();    // Cookie lasts for a month from now
setcookie('lastVisit', date("g:ia")." on ".date("F d Y"), $nextMonth);
if(isset($_COOKIE['lastVisit']))    // Checks the cookies list for lastVisit
{
    $last = $_COOKIE['lastVisit'];
    echo "<p>The last time your IP visited was ". $last ."</p>";
}
else
    echo "<p>Wow! This is the first time you visited!</p>";

if(count($_COOKIE) == 0)        // If cookies are disabled the cookies list will always be null
    echo "<p>You have your cookies disabled. Please enable them.</p>"
?>
<footer>
    <p>Created by: ThaiBinh Nguyen</p>
    <p>Brock University</p>
    <p>2018</p>
</footer>
</body>
</html>