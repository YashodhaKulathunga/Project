<?php
session_start();
$paymentID = $_SESSION['payIDEB'];

$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($serverName, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM income_payment_entirebus_booking WHERE Payment_ID = '$paymentID'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);

$otp = $row['OTP'];
$Ticket_ID = $row['Ticket_ID'];
$userID = $row['User_ID'];
$userOTP = $_POST['otp'];

if ($otp == $userOTP) {
    // Update income_payment_entirebus_booking table status to 'Paid'
    $updatePaymentQuery = "UPDATE income_payment_entirebus_booking SET Status = 'Paid' WHERE Payment_ID = '$paymentID'";
    $updatePaymentResult = mysqli_query($conn, $updatePaymentQuery);

    if (!$updatePaymentResult) {
        die("Update payment status failed: " . mysqli_error($conn));
    }


    $message = "You Booked a Bus.";
    $insertQuery = "INSERT INTO notification (User_ID, message, Status) VALUES ('$userID', '$message', 'Unseen')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if (!$insertResult) {
        die("Notification insertion failed: " . mysqli_error($conn));
    }

    header("Location: generateTicket.php");
} else {
    $otpm = 2;
    $_SESSION['otpm'] = $otpm;
    header("Location: varifyOTP_Entire_bus_Booking.php");
}
