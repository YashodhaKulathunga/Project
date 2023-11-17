<?php

// Establish connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get latitude and longitude from the database
function getLatLongFromDB($conn)
{
    $shnew = $_COOKIE['shid'];
    $query = "SELECT Latitude, Longitude FROM schedule WHERE Schedule_ID = '" . $shnew . "'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return [$row['Latitude'], $row['Longitude']];
    }

    return null;
}

// Function to set/update cookies
function setOrUpdateCookies($latitudebus, $longitudebus)
{
    if (!isset($_COOKIE['latitudebus']) || $_COOKIE['latitudebus'] !== $latitudebus) {
        setcookie('latitudebus', $latitudebus, time() + 3600, '/');
    }

    if (!isset($_COOKIE['longitudebus']) || $_COOKIE['longitudebus'] !== $longitudebus) {
        setcookie('longitudebus', $longitudebus, time() + 3600, '/');
    }
}

// Retrieve latitude and longitude from the database
list($newLatitudebus, $newLongitudebus) = getLatLongFromDB($conn);

// Check if cookies need to be updated
if ($newLatitudebus !== null && $newLongitudebus !== null) {
    setOrUpdateCookies($newLatitudebus, $newLongitudebus);
}

// Close the database connection
$conn->close();
