#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Map</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <style>
        #map {
            position: relative;
            width: 99vw;
            left: calc(-50vw + 50.5%);
            height: calc(99vh - 110px); /* Makes height 99% of the viewport, subtracting the padding from the top menu */
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<?php
include_once("header.html");
?>

<div id="map"></div>
<script>
    function myMap() {
        var mapCanvas = document.getElementById("map");
        var mapOptions = {
            center: new google.maps.LatLng(43.117699, -79.247486),
            zoom: 15
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position: mapOptions.center});
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQF2Tk7lEZWPqjP-yC4UNrule8mRO8Svs&callback=myMap"></script>

<?php
include_once("footer.html");
?>
</body>
</html>
