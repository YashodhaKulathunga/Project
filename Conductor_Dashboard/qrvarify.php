<?php
// Establish database connection (replace these variables with your actual database credentials)
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

// Get the reference key from the AJAX request
$reference_key = $_POST['reference_key'];

// Prepare SQL statement to prevent SQL injection
$sql = "SELECT * FROM ticket_reservation WHERE 	RefrenceNO = ?";
$stmt = $conn->prepare($sql);

// Check for errors in preparing the statement
if ($stmt === false) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}

// Bind parameters and execute the statement
if (!$stmt->bind_param("s", $reference_key)) {
    echo "Error binding parameters: " . $stmt->error;
    exit;
}

if (!$stmt->execute()) {
    echo "Error executing statement: " . $stmt->error;
    exit;
}

// Get result set
$result = $stmt->get_result();

// Check if rows were returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seatNo = $row['SeatNO'];
        $gender = $row['Gender'];

        // Display success message along with SeatNO and Gender details
        echo 'Ticket verified successfully!<br>';
        echo 'Seat Number: ' . $seatNo . '<br>';
        echo 'Gender: ' . $gender . '<br>';
    }
} else {
    // Reference key does not exist in the database
    echo 'Invalid ticket!';
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();
