<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Geolocation</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script>
        var map = null;
        var busMarker = null;
        var userMarker = null;

        function getLocation() {
            if (navigator.geolocation) {
                var options = {
                    enableHighAccuracy: true, // Request high accuracy
                    maximumAge: 0 // Force fresh location data
                };

                navigator.geolocation.getCurrentPosition(showPosition, handleError, options);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var Latitude = position.coords.latitude;
            var Longitude = position.coords.longitude;
            console.log("Latitude: " + Latitude);
            console.log("Longitude: " + Longitude);
            document.cookie = `Latitude=${Latitude}`;
            document.cookie = `Longitude=${Longitude}`;

            if (map === null) {
                createMap(Latitude, Longitude);
            } else {
                updateMapView(Latitude, Longitude);
            }
        }

        function createMap(Latitude, Longitude) {
            map = L.map("map").setView([6.987847, 81.057530], 13);

            var mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
            L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
                attribution: "JourneyEase; " + mapLink + ", contribution",
                maxZoom: 21,
            }).addTo(map);

            createMarkers(Latitude, Longitude);
        }

        function createMarkers(Latitude, Longitude) {
            var busIcon = L.icon({
                iconUrl: "img/bus-svgrepo-com.svg",
                iconSize: [30, 30],
            });
            var userIcon = L.icon({
                iconUrl: "img/user-svgrepo-com.svg",
                iconSize: [30, 30],
            });

            if (busMarker) map.removeLayer(busMarker);
            if (userMarker) map.removeLayer(userMarker);

            busMarker = L.marker([6.987847, 81.057530], {       
                icon: busIcon,
            }).addTo(map);

            userMarker = L.marker([Latitude, Longitude], {
                icon: userIcon,
            }).addTo(map);
        }

        function updateMapView(Latitude, Longitude) {
            if (map) {
                createMarkers(Latitude, Longitude);
            }
        }

        function handleError(error) {
            console.log("Error getting location: " + error.message);
        }

        setInterval(getLocation, 500);
    </script>

    <div id="map" style="width: 100%; height: 100vh"></div>
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

</body>

</html>