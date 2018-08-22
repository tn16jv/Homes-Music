#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<body>
<?php
if (isset($_POST['playSong'])) {
    error_reporting(E_ERROR);   // makes only error be reported
    $file= $_POST['playSong'];
    $file2 = "src=%22music_collection%2F". $_POST['userName'] . "%2F" . $file ."%22";
    $file3 = rawurldecode($file2);

    echo "<div id='playerArea'>";
    echo "<p>".rawurldecode($file)."</p>";
    echo "<audio id=\"player\" controls autoplay><source ".$file3." type=audio/mp3></source></audio>";
    echo "</div>";
}

if (isset($_POST['playSongPublic'])) {
    error_reporting(E_ERROR);
    $keys = array_keys($_POST);

    $user = $_POST[$keys[0]];
    $file = $_POST[$keys[1]];
    $file2 = "src=%22music_collection%2F". $user . "%2F" . $file ."%22";
    $file3 = rawurldecode($file2);

    echo "<div id='playerArea'>";
    echo "<audio id=\"player\" controls autoplay><source ".$file3." type=audio/mp3></source></audio>";
    echo "<p>".rawurldecode($file)."</p>";
    echo "</div>";
}
?>
</body>
</html>
