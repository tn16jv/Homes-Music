#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistics</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <script src="Script/sortTable.js"></script>
</head>
<body>

<?php
include_once("header.html");
?>

<?php
include "PHP/databaseAccess.php";
$conn = connectDB();

$sql = "SELECT dates, rating, nav_ease, comments from feedback";
$result = $conn->query($sql);
$count = 10;
if ($result->num_rows > 0 && $count > 0) {      // Retrieve the first 10 rows of the table
    echo "<table id='myTable'><tr><th onclick='sortTable(0)'>Date</th><th onclick='sortTable(1)'>Rating</th>
<th onclick='sortTable(2)'>Navigation Ease</th><th onclick='sortTable(3)'>Comments</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["dates"]. "</td><td>". $row["rating"]. "</td><td>". $row["nav_ease"]. "</td>
            <td>". $row["comments"] ."</td><br>";
    }
    $count = $count - 1;
}
$conn->close(); // Close connection
?>
</body>
</html>
