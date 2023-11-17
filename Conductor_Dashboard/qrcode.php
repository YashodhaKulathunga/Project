<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Codunctor Intercface</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/index.css" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<script>
  var map = null;

  function getLocation() {
    if (navigator.geolocation) {
      var options = {
        enableHighAccuracy: false, // Request high accuracy
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
<iframe id="updatelocationframe" style="display: none;"></iframe>
<script>
  function openAndCloseSecondPage() {
    // Get a reference to the hidden iframe
    var iframe = document.getElementById('updatelocationframe');

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

<body style="background-color: #f3c001">
  <div class="container-fluid backgroudCI">
    <div class="d-flex justify-content-center">
      <div class="mx-auto">
        <div class="d-flex justify-content-center">
          <div class="cidashnavbar">
            <div class="row">
              <div class="text-center">
                <h1 class="titleUsername">Welcome User</h1>
              </div>
            </div>
            <div class="row text-center">
              <div class="navbarforci">
                <div class="row navigationDiv" style="background-color: #000032">
                  <div class="col col-nav-div">
                    <a href="./home.php"><img class="iconImage" src="./icons/ticket-svgrepo-com.svg" /></a>
                  </div>
                  <div class="col col-nav-div-active">
                    <a href="./qrcode.php"><img class="iconImage" src="./icons/qrcode-viewfinder-svgrepo-com.svg" /></a>
                  </div>
                  <div class="col col-nav-div">
                    <a href="./expenses.php"><img class="iconImage" src="./icons/money-check-dollar-pen-svgrepo-com.svg" /></a>
                  </div>
                  <div class="col col-nav-div">
                    <a href="./profile.php"><img class="iconImage" src="./icons/profile-1336-svgrepo-com.svg" /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row QRcard">
          <div class="col QRcard mt-2">
            <div class="card text-center mb-3" style="background-color: #000032; width: 18rem; height: 20rem; padding: 5%; border-radius: 5px; color: #f3c001;">
              <div class="card-body">
                <h5 class="card-title">Varify the Tickets</h5>
                <p class="card-text">

                  <!--Qr Pop Up Start-->
                  <!-- Button trigger modal -->
                  <button type="button" class="qrcodeButton" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="col text-center">
                      <div class="row mt-2 mb-0">
                        <h4 class="qrbutton-text">Scan QR</h4>
                      </div>
                      <div class="row text-center qrIcon mt-0 mb-lg-0">
                        <div class="col">
                          <ion-icon name="scan-circle-outline"></ion-icon>
                        </div>
                      </div>
                    </div>
                  </button>

                  <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" style="width: 18rem;">
                    <div class="modal-content bg-warning text-light">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #000032;">Scan QR Code</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!--QR Code Intergration Start-->
                        <script src="./js/qr.js"></script>
                        <style>
                          .result {
                            background-color: green;
                            color: #fff;
                            padding: 20px;
                          }
                        </style>


                        <div class="row">
                          <div class="col">
                            <div style="width: auto;" id="reader"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col" style="padding:30px;">
                            <h4 style="color: #000032;">SCAN RESULT</h4>
                            <div style="color: #000032;" id="result">Result Here</div>
                          </div>
                        </div>


                        <script type="text/javascript">
                          function onScanSuccess(qrCodeMessage) {
                            document.getElementById('result').innerHTML = '<span class="result">' + qrCodeMessage + '</span>';
                          }

                          function onScanError(errorMessage) {
                            //handle scan error
                          }

                          var html5QrcodeScanner = new Html5QrcodeScanner(
                            "reader", {
                              fps: 10,
                              qrbox: 250
                            });
                          html5QrcodeScanner.render(onScanSuccess, onScanError);
                        </script>
                        <a href="#" class="btn" style="background-color: #000032; color: #f3c001;">Issue Ticket</a>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="cidashFooter">
          <div class="row">
            <div class="text-center">
              <h1 class="titleUsername">Journey Ease</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>