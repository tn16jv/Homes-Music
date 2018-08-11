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
    <script src="Script/ajaxRequestSong.js"></script>
    <script src="Script/shuffleLoopPlay.js"></script>
</head>
<body>

<?php
include_once("header.html");
?>

<div id="searchArea">
    <input id="searchInput" type="search" placeholder="Search Songs by Name, Album, Artist...">
    <button id="searchClear">Clear</button>
</div>
<div id="anArea"></div>
<div id="playerButtons">
    <button id="loopButton">Loop</button>
    <button id="shuffleButton">Shuffle</button>
    <button id="lastTrack">&laquo;</button>
    <button id="nextTrack">&raquo;</button>
</div>

<?php
include "PHP/databaseAccess.php";
$conn = connectDB();

$sql = "SELECT * from song_collection WHERE public =TRUE";
$result = $conn->query($sql);

echo "<p>Click on the table headers to sort by each category. Reclick Loop/Shuffle to play the altered table playlists.</p>";

echo "<table id='myTable'><thead><tr><th onclick='sortTable(0)'>File Name</th><th onclick='sortTable(1)'>Song Name</th>
<th onclick='sortTable(2)'>Album</th><th onclick='sortTable(3)'>Artist</th><th onclick='sortTable(4)'>User</th></tr></thead>";

echo "<tbody id='searchTable'>";
while($row = mysqli_fetch_array($result))       // Iterates across all rows of the table, with $row as enumeration
{
    $fileName = rawurlencode($row["file_name"]);
    $user = $row['username'];
    // Only fileName needs to be urlencoded. Its usage in a link <a></a> may be broken in PHP by a '
    echo "<tr><td><button name='playSong' value='$fileName' onclick='postSong(\"$user\", \"$fileName\")'>". $row["file_name"] ."</button></td>
<td class='tableText'>" . $row["song_name"]. "</td><td class='tableText'>". $row["album"]. "</td><td class='tableText'>". $row["artist"]. "</td>";

    echo "<td>". $row['username'] ."</td>";
}
echo "</tbody></table>";
?>
<?php
include_once("footer.html");
?>
</body>
</html>