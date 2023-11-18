<?php
session_start();
$userID = $_SESSION["userid"];
?>
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
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    var map = null;
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
      document.cookie = `Latitude=${Latitude}`;
      document.cookie = `Longitude=${Longitude}`;
      getNearestTownName(Latitude, Longitude)
        .then(nearestTown => {
          console.log('Nearest Town:', nearestTown);
          var townname = nearestTown;
          document.getElementById("currentLocation").innerHTML = townname;

        })
        .catch(err => {
          console.error('Error occurred:', err);
        });
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
                <h1 class="titleUsername">Welcome <?php echo $_SESSION["name"] ?></h1>
              </div>
            </div>
            <div class="row text-center">
              <div class="navbarforci">
                <div class="row navigationDiv" style="background-color: #000032">
                  <div class="col col-nav-div-active">
                    <a href="./home.php"><img class="iconImage" src="./icons/ticket-svgrepo-com.svg" /></a>
                  </div>
                  <div class="col col-nav-div">
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
        <div class="row ticketGenarator nextDiv">
          <div class="col text-center ticketGenarator mt-5">
            <div class="text-center text-light mb-3" style="
                  background-color: #000032;
                  width: 18rem;
                  padding: 5%;
                  border-radius: 5px;
                ">
              <div class="card-body">
                <form id="ticketForm" method="POST" action="printticket.php">
                  <!-- Your existing form fields -->
                  <div class="row">
                    <!-- From Location -->
                    <div class="col">
                      <label for="from" class="form-label">From:</label>
                      <select name="from_location" id="from_location" class="form-select form-select-sm" aria-label="Large select example" style="background-color: #f3c001; color: #000032">
                        <option selected>Badulla</option>
                        <option value="Bandarawela">Bandarawela</option>
                        <option value="Diyathalawa">Diyathalawa</option>
                        <option value="Haputale">Haputale</option>
                        <option value="Belihuloya">Belihuloya</option>
                        <option value="Balangoda">Balangoda</option>
                        <option value="Pelmadulla">Pelmadulla</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Ratnapura">Ratnapura</option>
                      </select>
                    </div>
                    <!-- To Location -->
                    <div class="col">
                      <label for="to" class="form-label">To:</label>
                      <select name="to_location" id="to_location" class="form-select form-select-sm" aria-label="Large select example" style="background-color: #f3c001; color: #000032">
                        <option selected>Badulla</option>
                        <option value="Bandarawela">Bandarawela</option>
                        <option value="Diyathalawa">Diyathalawa</option>
                        <option value="Haputale">Haputale</option>
                        <option value="Belihuloya">Belihuloya</option>
                        <option value="Balangoda">Balangoda</option>
                        <option value="Pelmadulla">Pelmadulla</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Ratnapura">Ratnapura</option>
                      </select>
                    </div>
                  </div>

                  <!-- Table to display ticket details -->
                  <div class="row mt-4">
                    <div class="text-center">
                      <div class="container">
                        <div class="table">
                          <div class="table-header">
                            <div class="header__item">Distance</div>
                            <div class="header__item">Price</div>
                            <div class="header__item">Duration</div>
                          </div>
                          <div class="table-content" id="ticketDetails">
                            <!-- Ticket details will be displayed here -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Submit button -->

                </form>
              </div>

              <script>
                // Function to calculate and display ticket details
                function generateTicketDetails() {
                  // Get the selected 'from' and 'to' locations
                  const fromLocation = document.getElementById('from_location').value;
                  const toLocation = document.getElementById('to_location').value;

                  // implementing new data set
                  const distancesToColombo = {
                    'Badulla': 214,
                    'Bandarawela': 184,
                    'Diyathalawa': 179,
                    'Haputale': 170,
                    'Belihuloya': 142,
                    'Balangoda': 130,
                    'Pelmadulla': 102,
                    'Ratnapura': 86,
                    'Colombo': 0
                  };

                  function calculateDistance(source, destination) {
                    if (source === destination) {
                      return '0Km';
                    } else if (distancesToColombo.hasOwnProperty(source) && distancesToColombo.hasOwnProperty(destination)) {
                      const distance = Math.abs(distancesToColombo[source] - distancesToColombo[destination]);
                      return distance.toString() + 'Km';
                    } else {
                      return 'Distance not available';
                    }
                  }

                  function calculatePrice(distance) {
                    const basePrice = 300;

                    return (basePrice + (distance * 10.28)).toFixed(0) + ' Rs'; // Adjust pricing logic as needed
                  }

                  function calculateDuration(distance) {
                    const baseDuration = 0; // Base duration for the route (in hours)
                    // Example duration calculation based on the given distances
                    return (baseDuration + distance / 40).toFixed(1) + ' Hour'; // Adjust duration logic as needed
                  }
                  const ticketData = {};

                  const stations = Object.keys(distancesToColombo);
                  for (let i = 0; i < stations.length; i++) {
                    for (let j = 0; j < stations.length; j++) {
                      const source = stations[i];
                      const destination = stations[j];
                      const route = `${source}-${destination}`;

                      const distance = calculateDistance(source, destination);
                      const price = calculatePrice(Math.abs(distancesToColombo[source] - distancesToColombo[destination]));
                      const duration = calculateDuration(Math.abs(distancesToColombo[source] - distancesToColombo[destination]));

                      ticketData[route] = {
                        distance,
                        price,
                        duration
                      };
                    }
                  }
                  // Example data for distance, price, and duration based on locations


                  // Create the key to access the ticket data based on the selected locations
                  const key = `${fromLocation}-${toLocation}`;

                  // Retrieve ticket details based on the selected locations
                  const {
                    distance,
                    price,
                    duration
                  } = ticketData[key] || {};

                  // Display ticket details in the table
                  const ticketDetailsElement = document.getElementById('ticketDetails');
                  if (distance && price && duration) {
                    ticketDetailsElement.innerHTML = `
                  <div class="table-row">
                  <div class="table-data" name="distance">${distance}</div>
                  <div class="table-data">${price}</div>
                  <div class="table-data">${duration}</div>
                  </div>
                  </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-2" style="background-color: #000032;">
                    <div class="col text-center" style="width: 2rem; background-color: #f3c001;">
                      <button type="submit" class="btn" style="background-color: #f3c001; color: #000032; width: 100%;">
                        Issue Ticket
                      </button>
                    </div>
                  </div>
                    <input type="hidden" id="hiddenDistance" name="distance" value="${distance}">
                    <input type="hidden" id="hiddenPrice" name="price" value="${price}">
                    <input type="hidden" id="hiddenDuration" name="duration" value="${duration}">
                </form>
              </div>`;
                  } else {
                    ticketDetailsElement.innerHTML = ''; // Clear table if no details found
                  }
                }

                // Add event listeners for change in dropdown selections
                document.getElementById('from_location').addEventListener('change', generateTicketDetails);
                document.getElementById('to_location').addEventListener('change', generateTicketDetails);

                // Call generateTicketDetails initially to display initial details
                generateTicketDetails();
               
              </script>
            </div>
          </div>
        </div>
        <!-- location sos -->
        <div class="row">
          <div class="col-6">
            <div class="text-center" style="
                  background-color: #000032;
                  width: 8rem;
                  padding: 15%;
                  border-radius: 5px;
                  color: #f3c001;
                ">
              <div class="card-body">
                <small style="font-size: 10px">Current Location : </small>
                <label id="currentLocation">location 1</label>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center" style="
                  background-color: #000032;
                  width: 8rem;
                  padding: 15%;
                  border-radius: 5px;
                  color: #f3c001;
                ">
              <div class="card-body">
                <small style="font-size: 10px">Next Location :</small>
                <label>location 2</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-6">
            <button class="btn btn-danger" style="width: 8rem; height: 4rem">
              SOS
            </button>
          </div>
          <div class="col-6">
            <button class="btn" style="
                  background-color: #000032;
                  width: 8rem;
                  height: 4rem;
                  padding: 5%;
                  border-radius: 5px;
                  color: #f3c001;
                ">
              Update Situation
            </button>
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