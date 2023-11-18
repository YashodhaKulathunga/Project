<!DOCTYPE html>
<html>

<head>
    <title>Calculate Distance Between Two Points</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([0, 0], 2); // Set initial map view

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Function to calculate distance between two points using Haversine formula
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3; // Earth radius in meters
            const φ1 = lat1 * Math.PI / 180;
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            const distance = R * c; // Distance in meters
            return distance;
        }

        // Example coordinates for two points
        var point1 = {
            lat: 40.7128,
            lon: -74.0060
        }; // New York City
        var point2 = {
            lat: 34.0522,
            lon: -118.2437
        }; // Los Angeles

        // Add markers for the two points
        L.marker([point1.lat, point1.lon]).addTo(map).bindPopup('Point 1 - New York City');
        L.marker([point2.lat, point2.lon]).addTo(map).bindPopup('Point 2 - Los Angeles');

        // Calculate and display distance between the points
        var distance = calculateDistance(point1.lat, point1.lon, point2.lat, point2.lon);
        console.log('Distance between the points:', distance.toFixed(2), 'meters');
    </script>

</body>

</html>