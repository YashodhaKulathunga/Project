<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <script>
        function getUserLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    console.log(latitude);

                    // Send the location data to the server using AJAX             
                });
                
            }
        }

        // Call getUserLocation every 10 seconds
        setInterval(getUserLocation, 10000);
    </script>
</body>

</html>