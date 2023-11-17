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

<body style="background-color: #f3c001">
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
                  <div class="col col-nav-div">
                    <a href="./qrcode.php"><img class="iconImage" src="./icons/qrcode-viewfinder-svgrepo-com.svg" /></a>
                  </div>
                  <div class="col col-nav-div-active">
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
        <div class="row ticketGenarator nextDiv">
          <div class="col text-center ticketGenarator mt-5">
            <div class="text-center text-light mb-3" style="
                  background-color: #000032;
                  width: 18rem;
                  padding: 5%;
                  border-radius: 5px;
                ">
              <div class="card-body mb-2">
                <form action="process_payment.php" method="POST">
                  <div class="text-center mb-4">
                    <img class="icon-inside-form" src="./icons/fuel-gas-station-svgrepo-com.svg">
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Enter Total amount for Fuel</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="number" name="Fuel" class="form-control form-control-lg" placeholder="Fuel Price in RS." />
                  </div>

                  <div class="text-center mb-4">
                    <button class="btn-Checkout-form">
                      Add Expence
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row ticketGenarator nextDiv">
          <div class="col text-center ticketGenarator mt-5">
            <div class="text-center text-light mb-3" style="
                  background-color: #000032;
                  width: 18rem;
                  padding: 5%;
                  border-radius: 5px;
                ">
              <div class="card-body mb-2">
                <form action="process_payment.php" method="POST">
                  <div class="text-center mb-4">
                    <img class="icon-inside-form" src="./icons/money-send-svgrepo-com.svg">
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Amount of other Expence</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="number" name="Fuel" class="form-control form-control-lg" placeholder="Other Price in RS." />
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Description</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="number" name="Fuel" class="form-control form-control-lg" placeholder="Description" />
                  </div>

                  <div class="text-center mb-4">
                    <button class="btn-Checkout-form">
                      Add Expence
                    </button>
                  </div>
                </form>
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