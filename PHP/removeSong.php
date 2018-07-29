<?php
if (isset($_POST['removeSong'])) {
    error_reporting(E_ERROR);   // makes only error be reported
    foreach ($_POST as $name => $val)
    {
        //echo htmlspecialchars($name . ': ' . $val) . "          ";
    }
    try {
        $keys = array_keys($_POST);     // links for the associative array of $_POST
        $fileToRemove = rawurldecode($_POST[$keys[0]]);
        $safeFileToRemove = mysqli_real_escape_string($conn, $fileToRemove);    // makes sure ' doesn't make PHP escape.

        $remove = "DELETE FROM song_collection WHERE file_name='$safeFileToRemove'";
        $conn->query($remove);
        unlink("music_collection/" . $_SESSION['user'] . "/" . $fileToRemove);
    } catch (Exception $e) {
        echo "Removed from list but song file not found on server.";
    }
}

function alterPublic($conn, $isPublic) {
    // Booleans are not evaluated to "true" "false" strings in PHP.
    $booleanString = ($isPublic) ? "true" : "false";

    $keys = array_keys($_POST);
    $fileToChange = rawurldecode($_POST[$keys[1]]); // Value of filename is the second element of POST (hidden input tag)
    $safeFileToChange = mysqli_real_escape_string($conn, $fileToChange);

    $change = "UPDATE song_collection SET public=$booleanString WHERE file_name='$safeFileToChange'";
    $conn->query($change);
}

if (isset($_POST['makePrivate'])) {
    alterPublic($conn, false);
}
if (isset($_POST['makePublic'])) {
    alterPublic($conn, true);
}
?>