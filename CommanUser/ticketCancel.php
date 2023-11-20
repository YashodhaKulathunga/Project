<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['ref'])) {
    $referenceNo = $_GET['ref'];

    // Fetch the data to be moved to ticket_cancellation table
    $select_sql = "SELECT * FROM ticket_reservation WHERE RefrenceNO = '$referenceNo'";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Copy the row data to ticket_cancellation table
        $insert_sql = "INSERT INTO ticket_cancellation (Shedule_ID, SeatNO, Gender, Ticket_ID, Price, Date, Time, RefrenceNO, UserID, Payment_ID, Status) VALUES ('" . $row['Shedule_ID'] . "', '" . $row['SeatNO'] . "', '" . $row['Gender'] . "', '" . $row['Ticket_ID'] . "', '" . $row['Price'] . "', '" . $row['Date'] . "', '" . $row['Time'] . "', '" . $row['RefrenceNO'] . "', '" . $row['UserID'] . "','" . $row['Payment_ID'] . "','Canceled')";

        if ($conn->query($insert_sql) === TRUE) {
            // Once data is copied, update status in ticket_reservation table
            $update_sql = "UPDATE ticket_reservation SET status = 'Cancelled' WHERE RefrenceNO = '$referenceNo'";
            if ($conn->query($update_sql) === TRUE) {
                // If status is updated, remove the row from ticket_reservation table
                $delete_sql = "DELETE FROM ticket_reservation WHERE RefrenceNO = '$referenceNo'";
                if ($conn->query($delete_sql) === TRUE) {
                    $conn->close();
                    header("Location: bookedTickets.php");
                    exit();
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error updating status: " . $conn->error;
            }
        } else {
            echo "Error inserting record into ticket_cancellation: " . $conn->error;
        }
    } else {
        echo "No record found for the given reference number.";
    }
} else {
    echo "No reference number found in the URL.";
}
