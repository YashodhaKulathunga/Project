<?php
    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        // Now you can use $latitude and $longitude as needed.
        // For example, you can insert these values into a database.
        // Here's an example of how to insert them into a MySQL database:
        
        // Assuming you have a database connection established earlier
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db1";

        // Create a new connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert the latitude and longitude into a table called 'location'
        $sql = "INSERT INTO location (latitude, longitude) VALUES ('$latitude', '$longitude')";

        if ($conn->query($sql) === TRUE) {
            echo "Location data inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Latitude and longitude not provided in the POST request.";
    }
