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

function outputFeedback($conn) {
    $sql = "SELECT * FROM feedback ORDER BY RAND() LIMIT 10";   // Randomly selects 10 user feedbacks
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {      // Loop through associative array
        echo "<table id='myTable'><tr><th onclick='sortTable(0)'>Date</th><th onclick='sortTable(1)'>Rating</th>
        <th onclick='sortTable(2)'>Navigation Ease</th><th onclick='sortTable(3)'>Comments</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>". $row["dates"]. "</td><td>". $row["rating"]. "</td><td>". $row["nav_ease"]. "</td>
            <td>". $row["comments"] ."</td></tr>";
        }
        echo "</table>";
    }
}

function outputSongStats($conn) {
    $sql = "SELECT COUNT(*) FROM song_collection";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $keys = array_keys($row);
    echo ("<p>Songs uploaded: " .$row[$keys[0]]. "</p>");
}

function outputAlbumStats($conn) {
    $sql = "SELECT COUNT(DISTINCT album) FROM song_collection";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $keys = array_keys($row);
    echo ("<p>Number of albums: " .$row[$keys[0]]. "</p>");
}

function outputArtistStats($conn) {
    $sql = "SELECT COUNT(DISTINCT artist) FROM song_collection";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $keys = array_keys($row);
    echo ("<p>Number of artists: " .$row[$keys[0]]. "</p>");
}

outputFeedback($conn);
outputSongStats($conn);
outputAlbumStats($conn);
outputArtistStats($conn);
$conn->close(); // Close connection
?>

<?php
include_once("footer.html");
?>
</body>
</html>
