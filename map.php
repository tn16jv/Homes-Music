#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Map</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
</head>
<body>

<?php
include_once("header.html");
?>

<div id="map" style="width:100%;height:800px;"></div>
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
<footer>
    <p>Created by: ThaiBinh Nguyen</p>
    <p>Brock University</p>
    <p>2018</p>
</footer>
</body>
</html>
