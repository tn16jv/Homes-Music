#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collection</title>
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
session_start();
if (!isset($_SESSION['user'])) {
    die ("<p>Not logged in</p>");
}
?>

<div id="searchArea">
    <input id="searchInput" type="text" placeholder="Search Songs by Name, Album, Artist...">
</div>

<?php
include "PHP/databaseAccess.php";
$conn = connectDB();
include "PHP/removeSong.php";
include "PHP/playerModal.php";

$sql = "SELECT * from song_collection WHERE username ='" . $_SESSION['user'] . "'";
$result = $conn->query($sql);

echo "<div>Click on the table headers to sort by each category.</div>";

echo "<table id='myTable'><tr><th onclick='sortTable(0)'>File Name</th><th onclick='sortTable(1)'>Song Name</th>
<th onclick='sortTable(2)'>Album</th><th onclick='sortTable(3)'>Artist</th><th onclick='sortTable(4)'>Status</th><th></th></tr>";

while($row = mysqli_fetch_array($result))       // Iterates across all rows of the table, with $row as enumeration
{
    $fileName = rawurlencode($row["file_name"]);
    // Only fileName needs to be urlencoded. Its usage in a link <a></a> may be broken in PHP by a '
    echo "<tbody id='searchTable'>";
    echo "<tr><td><form method=\"POST\"><button type=\"submit\" value=$fileName name=\"playSong\">".$row["file_name"]."</button></form></td><td class='tableText'>"
        . $row["song_name"]. "</td><td class='tableText'>". $row["album"]. "</td><td class='tableText'>". $row["artist"]. "</td>";

    if ($row['public']) {
        echo "<td><form method=\"POST\"><button class='privateButton' type=\"submit\" value=\"public\" name=\"makePrivate\">Public</button>
        <input name='fileName' type='hidden' value={$fileName}></form></td>";
    } else {
        echo "<td><form method=\"POST\"><button type=\"submit\" value=\"private\" name=\"makePublic\">Private</button>
        <input name='fileName' type='hidden' value={$fileName}></form></td>";
    }

    echo "<td><form method=\"POST\"><button class='removeButton' type=\"submit\" value=$fileName name=\"removeSong\">Remove</button></form></td></tr>";
    echo "</tbody>";
}
?>
</body>
</html>

