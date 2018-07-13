<?php
// Does not need the #!/usr/bin/php-cgi, as it will be called by .php files with that at the top
// Provides function for the webpages to access a database.

function connectDB()
{
    // Setup a config file named project.ini in the root with the login information for MySQL.
    $iniFile = parse_ini_file("project.ini");
    $servername = $iniFile['servername'];
    $username = $iniFile['username'];
    $password = $iniFile['password'];
    $conn = new mysqli($servername, $username, $password, "tn16jv");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>