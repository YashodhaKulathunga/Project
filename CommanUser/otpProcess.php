<?php
session_start();
$paymentID = $_SESSION['payID'];

$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($serverName, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM income_payment WHERE Payment_ID = '$paymentID'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);

$otp = $row['OTP'];
$userID = $row['User_ID'];
$userOTP = $_POST['otp'];

if ($otp == $userOTP) {
    $userID = $_SESSION["userid"];
    $seatNo = $_SESSION["seatNoforNitification"];
    $gender = $_SESSION["GendeforNotification"];
    $date = $_SESSION["Dateforntification"];

    // Construct message for the notification
    $message = "Your Booked a seat through Journey Ease your seat no is $seatNo for a $gender passenger  on $date ";

    // Insert data into the notification table
    $insertQuery = "INSERT INTO notification (User_ID, message, Status) VALUES ('$userID', '$message', 'Unseen')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if (!$insertResult) {
        die("Notification insertion failed: " . mysqli_error($conn));
    }

    // Redirect to generateTicket.php after successful notification insertion
    header("Location: generateTicket.php");
} else {
    $otpm = 2;
    $_SESSION['otpm'] = $otpm;
    header("Location: verifyOTP.php");
}
