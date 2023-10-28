<?php
session_start();
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];


        $userId = $_SESSION["userid"];
        $sql = "UPDATE user SET Latitude = :latitude, Longitude = :longitude WHERE UserID = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
