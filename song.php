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

function getContentType($fileName) {
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    switch ($ext) {
        case "mp3":
            return "Content-Type: audio/mpeg";
            break;
        case "wav":
            return "Content-Type: audio/wav";
            break;
        case "ogg":
            return "Content-Type: application/ogg";
            break;
    }
}

if (isset($_GET['fileName'])) {
    verifyAccess($_GET['user'], rawurldecode($_GET['fileName']));

    $filePath = "music_collection/" . $_GET['user'] . "/" . $_GET['fileName'];
    $absolutePath = rawurldecode($filePath);

    //header("Content-Type: audio/mpeg, audio/x-wav, application/ogg");
    header(getContentType($_GET['fileName']));
    header('Content-length: ' . filesize($absolutePath));
    header('Content-Disposition: filename="' . $_GET['fileName']);  // don't need to urldecode, it's automatic
    header('Cache-Control: no-cache');
    header('Accept-Ranges: bytes');
    header("Content-Transfer-Encoding: chunked");
    $song = readfile($absolutePath);//your song directory

    echo "<audio id=\"player\" controls autoplay><source src='" . $song . "'></audio>";

    ob_clean();
    flush();
}
?>
</body>
</html>
