#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add to Collection</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
</head>
<body>

<?php
include_once("header.html");
session_start();

if (!isset($_SESSION['user'])) {
    die ("<p>Not logged in</p>");
}
?>

<form action="add_submit.php" method="post" enctype="multipart/form-data">
    <input type="file" name="audio" value="Song from hard disk"/>
    <input type="submit" name="upload_song" value="Upload Song"/>
</form>

<footer>
    <p>Created by: ThaiBinh Nguyen</p>
    <p>Brock University</p>
    <p>2018</p>
</footer>
</body>
</html>
