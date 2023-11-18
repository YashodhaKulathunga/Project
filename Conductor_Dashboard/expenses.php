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
                <?php
                //require_once('../Classes/DbConnector.php');
                require_once('../Classes/Conductor.php');

                //use classes\DbConnector;
                use classes\Conductor;


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  if (isset($_POST['submit1'])) {
                    if (empty($_POST['Bus_ID']) || empty($_POST['date']) || empty($_POST['travel_in_km']) || empty($_POST['fuel_in_liter']) || empty($_POST['expences'])) {
                      echo '<div class="alert alert-danger" role="alert">Please Fill all feilds.</div>';
                    } else {
                      $Bus_ID = $_POST['Bus_ID'];
                      $date = $_POST['date'];
                      $travel_in_km = $_POST['travel_in_km'];
                      $fuel_in_liter = $_POST['fuel_in_liter'];
                      $expences = $_POST['expences'];

                      $update = new Counductor(null, null, null, null, null, null, null, null, null);
                      if ($update->fuel($Bus_ID, $date, $travel_in_km,  $fuel_in_liter, $expences)) {
                        echo '<div class="alert alert-success">Updated!!</div>';
                      } else {
                        echo '<div class="alert alert-danger" role="alert">Bus_Id is not found in the database..</div>';
                      }
                    }
                  } elseif (isset($_POST['submit'])) {
                    //echo '<div class="alert alert-danger" role="alert">Fill the form throught Submit Button.</div>';
                    if (empty($_POST['date']) || empty($_POST['expence_item']) || empty($_POST['expence_rp']) || empty($_POST['Bus_ID'])) {
                      //echo '<div class="alert alert-danger" role="alert">Please Fill all feilds.</div>';
                      $errors[] = "Please Fill all feilds";
                    } else {
                      $date = $_POST['date'];
                      $expence_item = $_POST['expence_item'];
                      $expence_rp = $_POST['expence_rp'];
                      $Bus_ID = $_POST['Bus_ID'];

                      $item = new Counductor(null, null, null, null, null, null, null, null, null);
                      if ($item->expence($date, $expence_item,  $expence_rp, $Bus_ID)) {
                        //echo '<div class="alert alert-success">Updated!!</div>';
                        $success = 'Fuel expence Added Successfully';
                      } else {
                        //echo '<div class="alert alert-danger" role="alert">Bus_Id is not found in the database..</div>';
                        $errors[] = "Bus_Id is not found in the database.";
                      }
                    }
                  } else {
                    //echo '<div class="alert alert-danger" role="alert">Fill the form throught Submit Button.</div>';
                    $errors[] = "Fill the form throught Submit Button.";
                  }
                }/*else{
                echo '<div class="alert alert-danger" role="alert">Submit the form through post method.</div>';
              }*/

                ?>

                <form action="<?php echo $_SERVER["PHP_SELF"]; ?> " method="POST">

                  <div class="text-center mb-4">
                    <img class="icon-inside-form" src="./icons/fuel-gas-station-svgrepo-com.svg">
                  </div>
                  <!--div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Enter Total amount for Fuel</h3>
                  </div-->

                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Bus ID</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="Bus_ID" id="validationCustom01" class="form-control form-control-lg" placeholder="Bus ID" />
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Date</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="date" class="form-control mt-3" name="date" placeholder="Appoint Date" aria-label="Departure Date" aria-describedby="basic-addon1">
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Travel In Km</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="travel_in_km" class="form-control form-control-lg" placeholder="Travel in Km" />
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Liters of Fuel</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="fuel_in_liter" id="validationCustom01" class="form-control form-control-lg" placeholder="Liters of Fuel" />
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Expence of Fuel in Rupees</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" id="expences" name="expences" class="form-control form-control-lg" placeholder="Expence of Fuel in Rupees" />
                  </div>



                  <!--div class="text-center mb-4">
                    <input type="number" name="Fuel" class="form-control form-control-lg" placeholder="Fuel Price in RS." />
                  </div-->

                  <div class="text-center mb-4">
                    <button class="btn-Checkout-form" name="submit1">
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
                <?php
                if (isset($errors) && count($errors) > 0) {
                  foreach ($errors as $error_msg) {
                    echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                  }
                }
                if (isset($success)) {
                  echo '<div class="alert alert-success">' . $success . '</div>';
                }
                ?>
                <?php
                // require_once('./Classes/DbConnector.php');
                //require_once('../Classes/Conductor.php');


                // use classes\DbConnector;

                /* if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['submit'])){
            if (empty($_POST['date']) || empty($_POST['expence_item']) || empty($_POST['expence_rp']) || empty($_POST['Bus_ID'])){
                echo '<div class="alert alert-danger" role="alert">Please Fill all feilds.</div>';
            }else{
                $date = $_POST['date'];
                $expence_item = $_POST['expence_item'];
                $expence_rp = $_POST['expence_rp'];
                $Bus_ID = $_POST['Bus_ID'];

                $item= new Counductor(null, null, null, null, null, null, null,null,null);
                if($item->expence($date, $expence_item,  $expence_rp ,$Bus_ID)){
                    echo '<div class="alert alert-success">Updated!!</div>';
                }else{
                    echo '<div class="alert alert-danger" role="alert">Bus_Id is not found in the database..</div>';
                }

            }

        }else {
                echo '<div class="alert alert-danger" role="alert">Fill the form throught Submit Button.</div>';
            }

   // }else {
            //echo '<div class="alert alert-danger" role="alert">Fill the form throught POST method.</div>';
        }*/






                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?> " method="POST">
                  <div class="text-center mb-4">
                    <img class="icon-inside-form" src="./icons/money-send-svgrepo-com.svg">
                  </div>


                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Bus ID</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="Bus_ID" id="validationCustom01" class="form-control form-control-lg" placeholder="Bus ID" />
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Date</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="date" class="form-control mt-3" name="date" placeholder="Appoint Date" aria-label="Departure Date" aria-describedby="basic-addon1">
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Expence Item</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="text" name="expence_item" id="validationCustom01" class="form-control form-control-lg" placeholder="Expence Item" />
                  </div>
                  <div class="text-center mb-4">
                    <h3 class="title-for-expense-form">Amount of other Expence</h3>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="number" id="inputseats" name="expence_rp" class="form-control form-control-lg" placeholder="Other Price in RS." />
                  </div>


                  <div class="text-center mb-4">
                    <button class="btn-Checkout-form" name="submit">
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