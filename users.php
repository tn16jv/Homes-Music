#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

$usersQuery = "SELECT * FROM users WHERE online > 0 ";
$usersResult = mysqli_query($conn, $usersQuery);

$counter = 0;
while ($row = mysqli_fetch_assoc($usersResult)) {
    if (($row['active'] > 0) && ($time - $row['online'] < 3600)) {  // If they didn't log out and it's less than an hour
        $counter += 1;
        echo "<p>" . $row['username'] . "</p>";
    }
}
if ($counter == 0) {
    echo ("<p>No users online at the moment.</p>");
}
?>

<?php
include_once("footer.html");
?>
</body>
</html>
