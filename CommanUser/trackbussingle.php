<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn1 = new mysqli($serverName, $username, $password, $dbname);

// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}

session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Geolocation</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="map" style="width: 100%; height: 100vh"></div>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script>
        function getUserLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Send the location data to the server using AJAX
                    $.ajax({
                        type: "POST",
                        url: "trackbussingle.php",
                        data: {
                            latitude: latitude,
                            longitude: longitude
                        },
                        success: function(response) {
                            console.log("Location updated successfully.");
                        },
                        error: function() {
                            console.error("Error updating location.");
                        }
                    });
                });
            }
        }

        // Call getUserLocation every 10 seconds
        setInterval(getUserLocation, 10000);
    </script>
    <?php
    $uid = $_SESSION["userid"];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $sql1 = "UPDATE user SET Latitude = $latitude, 	Longitude = $longitude WHERE User_ID = '$uid'";
        $stmt = $conn1->prepare($sql1);

        if ($stmt) {
            if ($stmt->execute()) {
                $_SESSION['payID'] = $paymentID;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <script>
        var map = L.map("map").setView([6.987884, 81.057519], 10);
        mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
        L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
            attribution: "Leaflet &copy; " + mapLink + ", contribution",
            maxZoom: 18,
        }).addTo(map);

        var busIcon = L.icon({
            iconUrl: "img/bus-svgrepo-com.svg",
            iconSize: [30, 30],
        });
        var userIcon = L.icon({
            iconUrl: "img/user-svgrepo-com.svg",
            iconSize: [30, 30],
        });

        var marker = L.marker([6.987884, 81.057519], {
            icon: busIcon,
        }).addTo(map);
        var marker = L.marker([6.934545, 79.847117], {
            icon: userIcon,
        }).addTo(map);

        map.on("click", function(e) {
            L.Routing.control({
                    waypoints: [
                        L.latLng(6.987884, 81.057519),
                        L.latLng(6.934545, 79.847117),
                    ],
                })
                .addTo(map);
        });
    </script>
</body>

</html>