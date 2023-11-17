<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Get Nearest Town</title>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Function to find the nearest town name from latitude and longitude
        async function getNearestTownName(latitude, longitude) {
            const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`;

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();

                if (response.ok) {
                    return data.address?.town || data.address?.city || 'Town/City name not found';
                } else {
                    return 'Failed to retrieve data';
                }
            } catch (error) {
                console.error('Error:', error);
                return 'Error occurred while fetching data';
            }
        }

        // Example coordinates
        const latitude = 7.472617; // Replace with your latitude
        const longitude = 80.350589; // Replace with your longitude

        // Call the function with example coordinates and log the result
        getNearestTownName(latitude, longitude)
            .then(nearestTown => {
                console.log('Nearest Town:', nearestTown);
            })
            .catch(err => {
                console.error('Error occurred:', err);
            });
    </script>
</head>

<body>
    <!-- Your HTML content here -->
</body>

</html>