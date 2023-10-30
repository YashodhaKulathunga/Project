<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var accuracy = position.coords.accuracy;
                    var coords = new google.maps.LatLng(latitude, longitude);
                    var mapOptions = {
                        zoom: 15,
                        center: coords,
                        mapTypeControl: true,
                        navigationControlOptions: {
                            style: google.maps.NavigationControlStyle.SMALL
                        },
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    var capa = document.getElementById("capa");
                    capa.innerHTML = "latitude: " + latitude + ", longitude: " + ", accuracy: " + accuracy;

                    map = new google.maps.Map(document.getElementById("mapContainer"), mapOptions);
                    var marker = new google.maps.Marker({
                        position: coords,
                        map: map,
                        title: "ok"
                    });

                },
                function error(msg) {
                    alert('Please enable your GPS position feature.');
                }, {
                    maximumAge: 10000,
                    timeout: 5000,
                    enableHighAccuracy: true
                });
        } else {
            alert("Geolocation API is not supported in your browser.");
        }
    </script>

</body>

</html>