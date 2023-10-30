<!DOCTYPE html>
<html>

<head>
    <title>First PHP Page</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
</head>

<body>
    <div id="map" style="width: 100%; height: 100vh"></div>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <iframe id="secondPageFrame" style="display: none;"></iframe>
    <script>
        function openAndCloseSecondPage() {
            // Get a reference to the hidden iframe
            var iframe = document.getElementById('secondPageFrame');

            // Set the iframe's source to the second PHP page
            iframe.src = './test2.php';

            // Close the iframe after 5 seconds
            setTimeout(function() {
                iframe.src = ''; // Clear the iframe's source
            }, 500); // Adjust the time (in milliseconds) as needed
        }

        // Call the function initially
        openAndCloseSecondPage();

        // Set up an interval to call the function every 5 seconds
        setInterval(openAndCloseSecondPage, 500); // Repeat every 5 seconds
    </script>
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

            document.addEventListener("DOMContentLoaded", function() {
                var map = L.map("map").setView([latitude, longitude], 10);
                mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
                L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
                    attribution: "JourneyEase; " + mapLink + ", contribution",
                    maxZoom: 21,
                }).addTo(map);

                var busIcon = L.icon({
                    iconUrl: "img/bus-svgrepo-com.svg",
                    iconSize: [30, 30],
                });
                var userIcon = L.icon({
                    iconUrl: "img/user-svgrepo-com.svg",
                    iconSize: [30, 30],
                });

                var marker = L.marker([latitude, longitude], {
                    icon: busIcon,
                }).addTo(map);
                var marker = L.marker([6.934545, 79.847117], {
                    icon: userIcon,
                }).addTo(map);

            });
        }
        setInterval(getLocation, 500);
        window.onload = getLocation;
    </script>
</body>

</html>