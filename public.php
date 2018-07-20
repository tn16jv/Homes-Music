#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collection</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/player.css" type="text/css" rel="stylesheet" />
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
include "PHP/playerModal.php";

$sql = "SELECT * from song_collection WHERE public =TRUE";
$result = $conn->query($sql);

echo "<table id='myTable'><tr><th onclick='sortTable(0)'>File Name</th><th onclick='sortTable(1)'>Song Name</th>
<th onclick='sortTable(2)'>Album</th><th onclick='sortTable(3)'>Artist</th><th onclick='sortTable(4)'>User</th></tr>";
while($row = mysqli_fetch_array($result))       // Iterates across all rows of the table, with $row as enumeration
{
    $fileName = rawurlencode($row["file_name"]);
    // Only fileName needs to be urlencoded. Its usage in a link <a></a> may be broken in PHP by a '
    echo "<tr><td><form method=\"POST\"><button type=\"submit\" value=$fileName name=\"playSong\">".$row["file_name"]."</button></form></td><td>"
        . $row["song_name"]. "</td><td>". $row["album"]. "</td><td>". $row["artist"]. "</td>";

    echo "<td>". $row['username'] ."</td>";
}
?>
</body>
</html>