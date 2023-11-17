<?php
// Access latitude and longitude cookies if they exist
if (isset($_COOKIE['latitudebus']) && isset($_COOKIE['longitudebus'])) {
    $latitudebus = $_COOKIE['latitudebus'];
    $longitudebus = $_COOKIE['longitudebus'];

    // Use latitude and longitude values as needed
    echo "Latitude: $latitudebus, Longitude: $longitudebus";
} else {
    echo "Latitude and/or longitude cookies not set.";
}
