<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
$userID =  $_SESSION["userid"];

echo $userID;

$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($serverName, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// getting row count for ticket id
$query = "SELECT COUNT(*) as count FROM ticket_reservation WHERE Status = 'Unpaid' AND UserID = '$userID' ";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
$row = mysqli_fetch_assoc($result);
// got the counts of the row
$count = $row['count'];
$amount = 2000 * $count;
// getting Ticket_ID from Database
$sql2 = "SELECT Ticket_ID FROM ticket_reservation WHERE status = 'Unpaid' AND UserID = '$userID' LIMIT 1";
$result2 = $conn->query($sql2);
if ($result2) {
    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        // got the Ticket ID
        $ticketID = $row['Ticket_ID'];
    }
} else {
    echo "Error executing the query: " . $conn->error;
}

$otp = mt_rand(100000, 999999);
$email = $_POST['emailadd'];
$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNO'];
$expMonth = $_POST['expMonth'];
$expYear = $_POST['expYear'];
$cvv = $_POST['cvv'];
$status = 'UnPaid';
$paymentID = '';

$sql = "SELECT MAX(Payment_ID) AS max_payment_id FROM income_payment";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $maxPaymentID = $row['max_payment_id'];
    if ($maxPaymentID) {
        // Extract the numeric part of the last Payment_ID
        $numericPart = (int)substr($maxPaymentID, 3);
        // Increment it to get the new Payment_ID
        $numericPart++;
        $paymentID = 'PAY' . str_pad($numericPart, 4, '0', STR_PAD_LEFT);
    } else {
        // No existing records, start with 'PAY0001'
        $paymentID = 'PAY0001';
    }
}

// sent otp to customer

// Insert the data into the database
$sql = "INSERT INTO income_payment (Payment_ID, Ticket_ID, User_ID, Email, CardName, CardNumber, ExpMonth, ExpYear, CVV, Amount, OTP, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssssssssssss", $paymentID, $ticketID, $userID, $email, $cardName, $cardNumber, $expMonth, $expYear, $cvv, $amount, $otp, $status);

    if ($stmt->execute()) {
        // Send email
        require './mail/Exception.php';
        require './mail/PHPMailer.php';
        require './mail/SMTP.php';

        $mail = new PHPMailer(true);

        // Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'maheng907@gmail.com'; // SMTP username
        $mail->Password = 'saxf fnjw bzhq izej'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('maheng907@gmail.com');
        $mail->addAddress($email); // Add a recipient
        // Name is optional

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Journey Ease Verification OTP';
        $message = "Dear " . $cardName . "You Booked seats through our system <br><br> That is Total cost of " .  $amount . "Rupees will deduct from your debit card <br><br> This Your OTP pin  " . $otp . " You can complete your payment using this OTP number<br><br> Don't share this with anyone";
        $mail->Body = $message;

        try {
            $mail->send();
            $_SESSION['payID'] = $paymentID;
            header("Location: varifyOTP.php");
            exit(); // Ensuring script stops here
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
