#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<body>
<?php
session_start();

function denyAccess() {
    die("<p>Denied access. Song is private and you are not logged in as the owner.</p>");
}

function verifyAccess($userName, $songName) {
    include("PHP/databaseAccess.php");
    $conn = connectDB();

    $songName = mysqli_real_escape_string($conn, $songName);
    $command = "SELECT * FROM song_collection WHERE file_name='". $songName ."' AND username='". $userName ."'";
    $result = mysqli_query($conn, $command);
    $row = mysqli_fetch_assoc($result);

    if ($row['public'] == false) {
        if (!isset($_SESSION['user'])) {
            denyAccess();
        } elseif ($row['username'] != $_SESSION['user']) {
            denyAccess();
        }
    }
}

if (isset($_GET['fileName'])) {
    verifyAccess($_GET['user'], rawurldecode($_GET['fileName']));

    $filePath = "music_collection/" . $_GET['user'] . "/" . $_GET['fileName'];
    $absolutePath = rawurldecode($filePath);

    //header("Content-Type: audio/mpeg, audio/x-wav, application/ogg");
    header("Content-Type: audio/mpeg");
    header('Content-length: ' . filesize($absolutePath));
    $song = file_get_contents($absolutePath);//your song directory

    echo "<audio id=\"player\" controls autoplay><source src='" . $song . "'></audio>";

    ob_clean();
    flush();
}
?>
</body>
</html>
