#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<body>
<?php
if (isset($_POST['playSong'])) {
    error_reporting(E_ERROR);   // makes only error be reported
    $file= $_POST['playSong'];

    echo "<p>".rawurldecode($file)."</p>";
    $url = "song.php?user=" . $_POST['userName'] . "&fileName=" . rawurlencode($file);
    echo "<iframe id='theFrame' src='$url'></iframe>";
}
?>
<script>
    $("#theFrame").on("load", function() {
        var contents = $("#theFrame").contents();
        $(contents).find("audio").length ? iframeAlter("audio", contents) : iframeAlter("video", contents);
    });

    function iframeAlter(source, contents) {
        $(contents).find(source).on("ended", function(event) { // Add 'ended' listener to the audio source in the iframe
            next();
        });

        $(contents).find(source).css("width", "100%");

        $("#theFrame").css("height", "100px");
    }
</script>
</body>
</html>
