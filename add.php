#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add to Collection</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/loader.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <script>
        function loader() {
            document.getElementById('loader').style.display='block';
        }
        function uploadSubmit() {
            var audioFile = document.getElementsByName("audio")[0];

            if (audioFile.files.length !== 0) {
                loader();
                audioFile.setCustomValidity('');
            } else {
                audioFile.setCustomValidity("A file must be selected in order to upload.");
            }
        }
    </script>
</head>
<body>

<?php
include_once("header.html");
session_start();

if (!isset($_SESSION['user'])) {
    die ("<p>Not logged in</p>");
}
?>

<p>Currently supported audio formats: .mp3 .wav .ogg</p>
<form action="add_submit.php" method="post" enctype="multipart/form-data">
    <input type="file" name="audio" value="Song from hard disk">
    <input type="submit" name="upload_song" value="Upload Song" onclick="uploadSubmit()">

    <p>(Optional) Additional Info:</p>
    <div><input type="text" size="30" placeholder="Songname" name="songTitle"></div>
    <div><input type="text" size="30" placeholder="Album" name="album"></div>
    <div><input type="text" size="30" placeholder="Artist" name="artist"></div>
</form>
<div id="loader"></div>
<button onclick="uploadSubmit()"></button>

<?php
include_once("footer.html");
?>
</body>
</html>
