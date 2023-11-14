<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking System</title>
</head>

<body>
    <h2>Select Date Range to Find Available Buses</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required>

        <button type="submit">Search Buses</button>
    </form>
</body>

</html>

<?php
// Database connection parameters
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

// Establish the database connection
$connection = mysqli_connect($serverName, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Query to retrieve available buses within the specified date range
    $query = "
        SELECT b.*
        FROM buses b
        LEFT JOIN bookings bk ON b.bus_id = bk.bus_id_fk
        WHERE (
            bk.booking_id IS NULL 
            OR (
                bk.booking_start_date > '$end_date' 
                OR bk.booking_end_date < '$start_date'
            )
        )
    ";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Display available buses
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Bus ID: " . $row['bus_id'] . "<br>";
        echo "Bus Name: " . $row['bus_name'] . "<br>";
        echo "Total Seats: " . $row['total_seats'] . "<br>";
        // Add other bus information
        echo "<br>";
    }
}

// Close the database connection
mysqli_close($connection);
?>