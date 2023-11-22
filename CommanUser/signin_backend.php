<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to your MySQL database
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

    // Escape user inputs to prevent SQL injection
    $email = $_POST['uid'];
    $password = $_POST['pwd'];
    echo $email;
    echo $password;

    // Fetch user details from the database
    $sql = "SELECT * user WHERE Email = '" . $email . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the entered password with the hashed password stored in the database
        if ($password == $row['Password']) {
            // Password is correct
            $_SESSION["userid"] = $row['User_ID'];
            $_SESSION["username"] = $row['Name'];

            // Redirect based on user role
            $role = $row['role'];
            if ($role === 'passanger') {
                header("Location: user_interface.php");
                exit();
            } elseif ($role === 'conductor') {
                header("Location: conductor_dashboard.php");
                exit();
            } elseif ($role === 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                // Handle other roles if needed
                echo "Unknown role!";
            }
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your email.";
    }

    $conn->close();
}
