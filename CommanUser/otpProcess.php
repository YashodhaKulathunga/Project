<?php
session_start();
$paymentID = $_SESSION['payID'];
echo $paymentID;

$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($serverName, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// getting row count fot ticket id
$query = "SELECT * FROM income_payment WHERE Payment_ID = '$paymentID'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
$row = mysqli_fetch_assoc($result);
// got the OTP code from Database
$otp = $row['OTP'];
$userID = $row['User_ID'];
$userOTP = $_POST['otp'];

if ($otp == $userOTP) {
    header("Location: generateTicket.php");
} else {
    $otpm = 2;

    $_SESSION['otpm'] = $otpm;

    header("Location: varifyOTP.php");
}
