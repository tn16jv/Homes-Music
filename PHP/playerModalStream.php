#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<body>
<?php
if (isset($_POST['playSong'])) {
    error_reporting(E_ERROR);   // makes only error be reported
    $file= $_POST['playSong'];
    header("Content-Type: audio/mpeg");
    $song = file_get_contents("PHP/6. Down.mp3");//your song directory

    echo "<div id='playerArea'>";
    echo "<p>".rawurldecode($file)."</p>";
    $url = "song.php?user=" . $_POST['userName'] . "&fileName=" . rawurlencode($file);
    echo "<iframe src='$url' height='100' width='500'></iframe>";
    echo "</div>";
}
?>
</body>
</html>
