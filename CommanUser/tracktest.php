<!DOCTYPE html>
<html>

<head>
    <title>Get User Location</title>
</head>

<body>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            let Latitude = position.coords.latitude;
            let Longitude = position.coords.longitude;
            console.log(Latitude);
            console.log(Longitude);
            document.cookie = `Latitude=${Latitude}`;
            document.cookie = `Longitude=${Longitude}`;
        }
        setInterval(getLocation, 1000);
        window.onload = getLocation;
    </script>
    <?php
    function getPreviousLocation()
    {
        $previousLocation = @file_get_contents("previous_location.txt");
        if ($previousLocation === false) {
            return ["Latitude" => null, "Longitude" => null];
        }
        return json_decode($previousLocation, true);
    }

    // Function to save the current latitude and longitude to a file
    function saveCurrentLocation($latitude, $longitude)
    {
        $data = ["Latitude" => $latitude, "Longitude" => $longitude];
        file_put_contents("previous_location.txt", json_encode($data));
    }

    // Get the current latitude and longitude from cookies
    $currentLatitude = isset($_COOKIE['Latitude']) ? $_COOKIE['Latitude'] : "Latitude cookie not set";
    $currentLongitude = isset($_COOKIE['Longitude']) ? $_COOKIE['Longitude'] : "Longitude cookie not set";

    // Get the previous latitude and longitude from the file
    $previousLocation = getPreviousLocation();

    if ($currentLatitude !== $previousLocation['Latitude'] || $currentLongitude !== $previousLocation['Longitude']) {
        // Replace with your actual database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db1";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Replace these variables with actual values
        $userID = 'USER0006';  // Replace with the user's ID
        $newLatitude = $currentLatitude;  // Replace with the new latitude value
        $newLongitude = $currentLongitude;  // Replace with the new longitude value

        // Update the Latitude and Longitude for the user
        $sql = "UPDATE user SET Latitude = $newLatitude, Longitude = $newLongitude WHERE User_ID = '$userID'";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
        saveCurrentLocation($currentLatitude, $currentLongitude);
    }
    ?>

    <script>
        // Function to refresh the page after a specified time interval
        function autoRefreshPage() {
            // Refresh the page after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                location.reload();
            }, 1000);

        }
        window.onload = autoRefreshPage;
    </script>


</body>

</html>