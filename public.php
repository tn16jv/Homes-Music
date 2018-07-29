#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/player.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Script/sortTable.js"></script>
    <script src="Script/filterTable.js"></script>
</head>
<body>

<?php
include_once("header.html");
?>

<div id="searchArea">
    <input id="searchInput" type="text" placeholder="Search Songs by Name, Album, Artist...">
</div>

<?php
include "PHP/databaseAccess.php";
$conn = connectDB();
include "PHP/playerModal.php";

$sql = "SELECT * from song_collection WHERE public =TRUE";
$result = $conn->query($sql);

echo "<div>Click on the table headers to sort by each category.</div>";

echo "<table id='myTable'><tr><th onclick='sortTable(0)'>File Name</th><th onclick='sortTable(1)'>Song Name</th>
<th onclick='sortTable(2)'>Album</th><th onclick='sortTable(3)'>Artist</th><th onclick='sortTable(4)'>User</th></tr>";
while($row = mysqli_fetch_array($result))       // Iterates across all rows of the table, with $row as enumeration
{
    $fileName = rawurlencode($row["file_name"]);
    // Only fileName needs to be urlencoded. Its usage in a link <a></a> may be broken in PHP by a '
    echo "<tbody id='searchTable'>";
    echo "<tr><td><form method=\"POST\"><input name='user' type='hidden' value={$row["username"]}>
        <button type=\"submit\" value=$fileName name=\"playSongPublic\">". $row["file_name"] ."</button></form></td><td class='tableText'>"
        . $row["song_name"]. "</td><td class='tableText'>". $row["album"]. "</td><td class='tableText'>". $row["artist"]. "</td>";

    echo "<td>". $row['username'] ."</td>";
    echo "</tbody>";
}
?>
</body>
</html>