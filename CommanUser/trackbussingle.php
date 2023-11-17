<?php
$shid = $_GET['var1'];
setcookie('shid', $_GET['var1'], time() + 3600, '/');
$shnew = $_COOKIE['shid'];

session_start();


?>
<!DOCTYPE html>
<html>

<head>
    <title>Geolocation<?php echo $shnew ?></title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="background-color: #f3c001;">

    <iframe id="getlocationframe" style="display: none;"></iframe>
    <script>
        function openAndCloseSecondPage() {
            // Get a reference to the hidden iframe
            var iframe = document.getElementById('getlocationframe');

            // Set the iframe's source to the second PHP page
            iframe.src = './getbuslocationfromdb.php';

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
    <!--Nav bar start-->
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg NAVBAR">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./Images/Logo.png" alt="Logo" width="100" height="69" class="d-inline-block align-text-top" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto d-flex align-items-center" style="--bs-scroll-height: 100px">
                        <li class="nav-item align-items-center">
                            <div class="d-flex align-items-center">
                                <p class="SubPageTitle FIRST-NAVLINK">
                                    Bus ID
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="./SeatSelection.php"><ion-icon name="arrow-back-circle-outline" class="mt-3 NAVLINKSICON"><span>go back</span>></ion-icon></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!---Nav bar End-->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script>
        var map = null;
        var busMarker = null;
        var userMarker = null;
        var latitudebus = null;
        var longitudebus = null;

        function getCookieValue(cookieName) {
            const name = cookieName + "=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const cookieArray = decodedCookie.split(';');

            for (let i = 0; i < cookieArray.length; i++) {
                let cookie = cookieArray[i];
                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(name) === 0) {
                    return cookie.substring(name.length, cookie.length);
                }
            }
            return "";
        }

        // Function to retrieve latitude and longitude values
        function retrieveCoordinates() {
            const latitudebus = getCookieValue('latitudebus');
            const longitudebus = getCookieValue('longitudebus');

            // Use latitude and longitude values as needed
            console.log("Latitude:", latitudebus);
            return latitudebus;
            return longitudebus;
            console.log("Longitude:", longitude);

            // You can perform any actions with latitude and longitude here
        }

        // Retrieve coordinates initially
        retrieveCoordinates();

        // Check for changes in the cookies every 5 seconds (you can change the interval as needed)
        setInterval(() => {
            retrieveCoordinates();
        }, 500); // 5 seconds interval


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
            const latitudebus = getCookieValue('latitudebus');
            const longitudebus = getCookieValue('longitudebus');
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

            busMarker = L.marker([getCookieValue('latitudebus'), getCookieValue('longitudebus')], {
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


        setInterval(createMarkers, 500);
        setInterval(getLocation, 500);
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="display: flex; justify-content: center; align-items: center; margin: 0 auto; margin-top: 9.5rem; ">
                    <div id="map" style="width: 98%; height: 70vh; border: 1rem solid #000032;"></div>
                    <iframe id="secondPageFrame" style="display: none;"></iframe>
                    <script>
                        function openAndCloseSecondPage() {
                            // Get a reference to the hidden iframe
                            var iframe = document.getElementById('secondPageFrame');

                            // Set the iframe's source to the second PHP page
                            iframe.src = './updatelocationtodb.php';

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
                </div>
            </div>
        </div>
    </div>



    <footer class="border-top footerbackground">
        <div class="row">
            <div class="col-12 col-md ">
                <span>
                    <img class="mb-2" src="images/logo2.jpg" alt="" width="125" height="87">
                </span>
                <span>
                    <p style="color: pink;">Make Your Journey Easy</p>

                </span>
                <small class="d-block mb-3 text-body-secondary">&copy; 2017–2023</small>
                <div class="row ">
                    <div class="container firstCol">
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="#">
                                <span class="coustomIcon SMLF">
                                    <ion-icon name="logo-facebook">
                                </span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="#">
                                <span class="coustomIcon SMLI">
                                    <ion-icon name="logo-instagram">
                                </span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="#">
                                <span class="coustomIcon SMLW">
                                    <ion-icon name="logo-whatsapp">
                                </span>
                            </a>
                        </div>
                        <div class="col ">
                            <a class="nav-link" aria-current="page" href="#">
                                <span class="coustomIcon SMLT">
                                    <ion-icon name="logo-twitter">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md">
                <h5 style="color: pink;"">Links</h5>
                <ul class=" list-unstyled text-small">
                    <li class="mb-1"><a class="nav-link" aria-current="page" href="#">
                            <span class="coustomIcon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="coustomText">
                                Home
                            </span>
                        </a>
                    </li>
                    <li class="mb-1"> <a class="nav-link" aria-current="page" href="aboutus.php">
                            <span class="coustomIcon">
                                <ion-icon name="accessibility-outline"></ion-icon>
                            </span>

                            <span class="coustomText">About Us </span></a>



                    </li>
                    <li class="mb-1">
                        <a class="nav-link" aria-current="page" href="Contactus.php">
                            <span class="coustomIcon">
                                <ion-icon name="headset-outline"></ion-icon>
                            </span>
                            <span class="coustomText">
                                Contact Us
                            </span>
                        </a>
                    </li>
                    </ul>
            </div>
            <div class="col-6 col-md">
                <h5 style="color: pink;">Policies</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="privacyPolicy.php">privacy Policy</a></li>
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="Terms.php">Terms & Conditions</a></li>
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="TicketPolicy.php">Ticket Policy</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5 style="color: pink;">Contact us</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none listtext" href="../contactus/index.php">
                            <span class="coustomIcon">
                                <ion-icon name="location-outline"></ion-icon>
                            </span>
                            <span class="coustomText listtext2">
                                No2, Passara Raod, Badulla.
                            </span>
                        </a>
                    </li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">
                            <span class="coustomIcon">
                                <ion-icon name="call-outline"></ion-icon>
                            </span>
                            <span class="coustomText listtext2">
                                +94123987456
                            </span>
                        </a>
                    </li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">
                            <span class="coustomIcon">
                                <ion-icon name="at-outline"></ion-icon>
                            </span>
                            <span class="coustomText listtext2">
                                EaseTravales@Bus.com
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!--Footer End-->
</body>

</html>