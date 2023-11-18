<?php
session_start();

function getPreviousLocation()
{
    $previousLocation = @file_get_contents("previous_location.txt");
    if ($previousLocation === false) {
        return ["Latitude" => null, "Longitude" => null];
    }
    return json_decode($previousLocation, true);
}

function saveCurrentLocation($latitude, $longitude)
{
    $data = ["Latitude" => $latitude, "Longitude" => $longitude];
    file_put_contents("previous_location.txt", json_encode($data));
}

$currentLatitude = isset($_COOKIE['Latitude']) ? $_COOKIE['Latitude'] : "Latitude cookie not set";
$currentLongitude = isset($_COOKIE['Longitude']) ? $_COOKIE['Longitude'] : "Longitude cookie not set";

$previousLocation = getPreviousLocation();

if ($currentLatitude !== $previousLocation['Latitude'] || $currentLongitude !== $previousLocation['Longitude']) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conductorID = $_SESSION["userid"];

    $stmt = $conn->prepare("SELECT Schedule_ID FROM schedule WHERE Conductor_ID = ?");
    $stmt->bind_param("s", $conductorID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SHID = $row['Schedule_ID'];

        $sql = "UPDATE schedule SET Latitude = ?, Longitude = ? WHERE Schedule_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dds", $newLatitude, $newLongitude, $SHID);
        $newLatitude = $currentLatitude;
        $newLongitude = $currentLongitude;
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $conn->close();
            saveCurrentLocation($currentLatitude, $currentLongitude);
            echo "Location updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No schedule found for this Conductor_ID";
    }
}
