#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add to Collection Done</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
</head>
<body>
<?php
include_once("header.html");
session_start();
ob_start();
?>
<?php
include "PHP/databaseAccess.php";
function checkFileType()
{
    $allowed = array('mp3', 'wav', 'wave', 'ogg');
    $filename = $_FILES['audio']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        die('Wrong filetype');
    }
}

if(isset($_POST['upload_song']) && $_POST['upload_song']=="Upload Song")    // Check if form filled properly
{
    checkFileType();
    $dir = "music_collection/" . $_SESSION['user'] . "/";   // Folder for songs in Project directory
    $safeFile = str_replace(array("#"), array(""), $_FILES['audio']['name']);  // shebangs can't be parsed by html
    $savePath = $dir.basename($safeFile);    // Where the song will be saved to on the server
    if (move_uploaded_file($_FILES['audio']['tmp_name'], $savePath))
    {
        echo 'Song added to collection!';
    }
} else {
    die("<p>Something's gone wrong. Perhaps the server's size limit for uploads is too low, or storage has been exceeded.</p>");
}

$conn = connectDB();

$id_start=filesize($savePath)-128;          // there are 128 reserved bits in mp3
$metadata = fopen($savePath, "r");  // accesses the metadata of the mp3
fseek($metadata, $id_start);
$tag = $artist = fread($metadata, 3);   // fread() reads the metadata in sequential order, with specified length
$safeFileName = mysqli_real_escape_string($conn, $safeFile);    // ensures safe handling of escape ' char
$title = mysqli_real_escape_string($conn, fread($metadata,30));
$artist = mysqli_real_escape_string($conn, fread($metadata, 30));
$album = mysqli_real_escape_string($conn, fread($metadata, 30));
fclose($metadata);

if (!empty($_POST['songTitle'])) {
    $title = $_POST['songTitle'];
}

if (!empty($_POST['artist'])) {
    $artist = $_POST['artist'];
}

if (!empty($_POST['album'])) {
    $album = $_POST['album'];
}

$command = "INSERT into song_collection(file_name, song_name, album, artist, username)
  VALUES('". $safeFileName ."', '". $title ."', '". $album ."', '". $artist ."', '". $_SESSION['user'] ."')";
$conn->query($command);     // Apply SQL query to the tn16jv database
$conn->close();
?>

<?php
include_once("footer.html");
?>
</body>
</html>
