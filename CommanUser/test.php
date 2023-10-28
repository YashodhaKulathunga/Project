<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <button onclick="getUserLocation()" href>hi</button>
    <script>
        function getUserLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    let a = document.getElementById("latitude");
                    a.innerHTML = latitude;

                    // Send the location data to the server using AJAX
                    $.ajax({
                        type: "POST",
                        url: "test2.php",
                        data: {
                            latitude: latitude,
                            longitude: longitude
                        },
                        success: function(response) {
                            console.log(latitude);
                            console.log(longitude);
                        },
                        error: function() {
                            console.error("Error updating location.");
                        }
                    });
                });
            }
        }

        // Call getUserLocation every 10 seconds
        setInterval(getUserLocation, 1000);
    </script>
    <label id="latitude"></label>
    <script>

    </script>

</body>

</html>