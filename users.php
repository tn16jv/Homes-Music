#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
</head>
<body>
<?php
include_once("header.html");
?>
<h2>Online: </h2>
<?php
include "PHP/databaseAccess.php";
$conn = connectDB();
$time = date('U')+50;

$usersQuery = "SELECT * FROM users where online > 0";
$usersResult = mysqli_query($conn, $usersQuery);
if (mysqli_num_rows($usersResult)==0) {
    echo ("<p>No users online at the moment.</p>");
} else {
    while ($row = mysqli_fetch_assoc($usersResult)) {
        echo "<p>" . $row['username'] . "</p>";
    }
}
?>
<footer>
    <p>Created by: ThaiBinh Nguyen</p>
    <p>Brock University</p>
    <p>2018</p>
</footer>
</body>
</html>
