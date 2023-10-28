<?php
// Replace with your database connection details
$host = 'localhost';
$dbname = 'db1';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
session_start();

$SHID = $_SESSION['SHID'];
$userID =  $_SESSION["userid"];


$bookedSeats = array();
$totalSeats = 54;
for ($i = 0; $i < $totalSeats; $i++) {
    $bookedSeats[] = null;
}
$query = "SELECT * FROM ticket_reservation WHERE Shedule_ID = '$SHID'";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookedSeats[] = $row['SeatNO'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ease Travels<?php echo $userID; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./js/index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        .Booked-child {
            position: relative;
            border: 0.1px;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            justify-content: center;
            align-items: center;
            padding: 0px;
            background-color: rgb(236, 11, 11);
            pointer-events: none;
        }

        .Booked-woman {
            position: relative;
            border: 0.1px;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            justify-content: center;
            align-items: center;
            padding: 0px;
            background-color: rgb(236, 11, 11);
            pointer-events: none;
        }

        .Booked-man {
            position: relative;
            border: 0.1px;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            justify-content: center;
            align-items: center;
            padding: 0px;
            background-color: rgb(236, 11, 11);
            pointer-events: none;
        }

        .Booked {
            position: relative;
            border: 0.1px;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            justify-content: center;
            align-items: center;
            padding: 0px;
            background-color: rgb(236, 11, 11);
            pointer-events: none;
        }

        .seat {
            position: relative;
            border: 0.1px;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            justify-content: center;
            align-items: center;
            padding: 0px;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .selected-child {
            background-color: #7DF9FF;
        }

        .selected-woman {
            background-color: #C70039;
        }

        .selected-man {
            background-color: #7CFC00;
        }
    </style>
</head>

<body class="bg-body-Seatselection">
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
                                    Select Seats
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="./commanUser.php"><ion-icon name="arrow-back-circle-outline" class="mt-3 NAVLINKSICON"><span>go back</span>></ion-icon></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!---Nav bar End-->
    <!--Body Part Starts-->
    <div class="seat-selection-page">
        <div class="row align-items-center5">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col calenderDiv">
                            <input type="date" class="calender" placeholder="Departure Date" aria-label="Departure Date" aria-describedby="basic-addon1" name="departure_date" id="departure_date">
                        </div>
                        <script>
                            function getCurrentDate() {
                                const today = new Date();
                                const year = today.getFullYear();
                                const month = String(today.getMonth() + 1).padStart(2, '0');
                                const day = String(today.getDate()).padStart(2, '0');
                                return `${year}-${month}-${day}`;
                            }
                            document.getElementById('departure_date').value = getCurrentDate();
                            document.getElementById('departure_date').min = getCurrentDate();
                        </script>
                    </div>
                    <br>
                    <div class="row">
                        <div class="genderSelectionDiv">
                            <select id="passengerCategory" class="passengerCategory">
                                <option value="child">Child</option>
                                <option value="woman">Woman</option>
                                <option value="man">Man</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-6">
                    <div class="SeatSelectionDiv">
                        <div class="busSeats">
                            <div class="row text-center">
                                <h3>Front</h3>
                            </div>
                            <div id="seatContainer">
                                <!--select seat row start-->
                                <?php
                                for ($i = 1; $i < 9; $i++) {
                                    $j = 5 * $i - 4;
                                ?>
                                    <div class="row mt-1">
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class=" <?php
                                                                    if (in_array($j, $bookedSeats)) {
                                                                        $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j;";
                                                                        $result2 = mysqli_query($connection, $qry2);
                                                                        $row2 = mysqli_fetch_assoc($result2);
                                                                        $gender = $row2["Gender"];
                                                                        echo "Booked-" . "$gender";
                                                                    } else {
                                                                        echo "seat";
                                                                    }
                                                                    ?>" data-seat-number="<?php echo $j; ?>">
                                                        <span>
                                                            <small class="seatNumber"><?php echo $j; ?></small>
                                                            <?php
                                                            if (in_array($j, $bookedSeats)) {
                                                                $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j;";
                                                                $result2 = mysqli_query($connection, $qry2);
                                                                $row2 = mysqli_fetch_assoc($result2);
                                                                $gender = $row2["Gender"];
                                                                if ($gender == "child") {
                                                                    echo '<img src="./Images/icons/child-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } elseif ($gender == "woman") {
                                                                    echo '<img src="./Images/icons/woman-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } else {
                                                                    echo '<img src="./Images/icons/man-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                }
                                                            } else {
                                                                echo '<img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="<?php
                                                                if (in_array($j + 1, $bookedSeats)) {
                                                                    $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j+1;";
                                                                    $result2 = mysqli_query($connection, $qry2);
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    $gender = $row2["Gender"];
                                                                    echo "Booked-" . "$gender";
                                                                } else {
                                                                    echo "seat";
                                                                }
                                                                ?>" data-seat-number="<?php echo $j + 1; ?>">
                                                        <span>
                                                            <small class="seatNumber"><?php echo $j + 1; ?></small>
                                                            <?php
                                                            if (in_array($j + 1, $bookedSeats)) {
                                                                $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j+1;";
                                                                $result2 = mysqli_query($connection, $qry2);
                                                                $row2 = mysqli_fetch_assoc($result2);
                                                                $gender = $row2["Gender"];
                                                                if ($gender == "child") {
                                                                    echo '<img src="./Images/icons/child-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } elseif ($gender == "woman") {
                                                                    echo '<img src="./Images/icons/woman-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } else {
                                                                    echo '<img src="./Images/icons/man-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                }
                                                            } else {
                                                                echo '<img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class=" <?php
                                                                    if (in_array($j + 2, $bookedSeats)) {
                                                                        $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j+2;";
                                                                        $result2 = mysqli_query($connection, $qry2);
                                                                        $row2 = mysqli_fetch_assoc($result2);
                                                                        $gender = $row2["Gender"];
                                                                        echo "Booked-" . "$gender";
                                                                    } else {
                                                                        echo "seat";
                                                                    }
                                                                    ?>" data-seat-number="<?php echo $j + 2; ?>">
                                                        <span>
                                                            <small class="seatNumber"><?php echo $j + 2; ?></small>
                                                            <?php
                                                            if (in_array($j + 2, $bookedSeats)) {
                                                                $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j+2;";
                                                                $result2 = mysqli_query($connection, $qry2);
                                                                $row2 = mysqli_fetch_assoc($result2);
                                                                $gender = $row2["Gender"];
                                                                if ($gender == "child") {
                                                                    echo '<img src="./Images/icons/child-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } elseif ($gender == "woman") {
                                                                    echo '<img src="./Images/icons/woman-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } else {
                                                                    echo '<img src="./Images/icons/man-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                }
                                                            } else {
                                                                echo '<img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="<?php
                                                                if (in_array($j + 3, $bookedSeats)) {
                                                                    $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j+3;";
                                                                    $result2 = mysqli_query($connection, $qry2);
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    $gender = $row2["Gender"];
                                                                    echo "Booked-" . "$gender";
                                                                } else {
                                                                    echo "seat";
                                                                }
                                                                ?>" data-seat-number="<?php echo $j + 3; ?>">
                                                        <span>
                                                            <small class="seatNumber"><?php echo $j + 3; ?></small>
                                                            <?php
                                                            if (in_array($j + 3, $bookedSeats)) {
                                                                $qry2 = "SELECT * FROM ticket_reservation  WHERE Shedule_ID = '$SHID' AND SeatNo = $j+3;";
                                                                $result2 = mysqli_query($connection, $qry2);
                                                                $row2 = mysqli_fetch_assoc($result2);
                                                                $gender = $row2["Gender"];
                                                                if ($gender == "child") {
                                                                    echo '<img src="./Images/icons/child-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } elseif ($gender == "woman") {
                                                                    echo '<img src="./Images/icons/woman-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                } else {
                                                                    echo '<img src="./Images/icons/man-svgrepo-com.svg" class="rounded Booked-Gender-Image" alt="...">';
                                                                }
                                                            } else {
                                                                echo '<img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1"></div>
                                    </div>
                                <?php } ?>
                                <!--Select select Row End -->
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <div class="row text-center">
                            <h3>Reer</h3>
                        </div>
                        <div class="row text-center ">
                            <div class="text-center displaySeatCatogery">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="text-center seatWithNumberSelectedByMale">
                                                <span>
                                                    <small class="seatNumber"></small>
                                                    <img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center seatWithNumberSelectedByFemale">
                                                <span>
                                                    <small class="seatNumber"></small>
                                                    <img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center seatWithNumberSelectedByChild">
                                                <span>
                                                    <small class="seatNumber"></small>
                                                    <img src="https://thenounproject.com/api/private/icons/661611/edit/?backgroundShape=SQUARE&backgroundShapeColor=%23000000&backgroundShapeOpacity=0&exportSize=752&flipX=false&flipY=false&foregroundColor=%23000000&foregroundOpacity=1&imageFormat=png&rotation=0" class="rounded seatImage" alt="...">
                                                </span>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td><small>Male</small></td>
                                        <td><small>Female</small></td>
                                        <td><small>Child</small></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="displayLables">
                            <div class="row">
                                <div class="SelectedSeatsLable">
                                    <p>Selected Seats:</p>
                                    <label id="selectedSeatsLabel"></label>
                                </div>
                                <div>
                                    <p>Total Price: <span id="totalPrice">0</span></p>

                                </div>
                            </div>
                        </div>
                        <script>
                            // JavaScript code here
                            const seatButtons = document.querySelectorAll('.seat');
                            const passengerCategorySelect = document.getElementById('passengerCategory');
                            const totalPriceDisplay = document.getElementById('totalPrice');
                            const selectedSeatsLabel = document.getElementById('selectedSeatsLabel');

                            let selectedSeats = {};

                            seatButtons.forEach((seatButton) => {
                                seatButton.addEventListener('click', () => {
                                    const seatNumber = seatButton.getAttribute('data-seat-number');
                                    const passengerCategory = passengerCategorySelect.value;

                                    if (selectedSeats[seatNumber]) {
                                        // Deselect the seat
                                        delete selectedSeats[seatNumber];
                                        seatButton.classList.remove(`selected-${passengerCategory}`);
                                    } else {
                                        // Select the seat
                                        selectedSeats[seatNumber] = passengerCategory;
                                        seatButton.classList.add(`selected-${passengerCategory}`);
                                    }

                                    // Update the total price (you can set your own pricing logic)
                                    const totalPrice = Object.keys(selectedSeats).length * 2000; // Assuming each seat costs $10
                                    totalPriceDisplay.textContent = totalPrice;

                                    // Generate reference numbers for selected seats
                                    const referenceNumbers = Object.entries(selectedSeats).map(([seat, ageGroup]) => {
                                        return `<?php echo $SHID ?>-${seat}-${ageGroup}-<?php echo $userID ?>`;
                                    });

                                    // Update the selected seats label
                                    selectedSeatsLabel.textContent = referenceNumbers.join(', ');
                                });
                            });
                        </script>


                        <div class="checkout mt-3">
                            <a href="checkout.php"><button class="w-100 btn btn-lg btn-find-busses" onclick="test()"> Proceed to Checkout</button></a>

                        </div>
                    </div>
                    <?php
                    $_SESSION['userID'] = $userID;
                    ?>
                    <script>
                        function test() {
                            const labelElement = document.getElementById('selectedSeatsLabel');
                            const labelText = labelElement.textContent;
                            const dataArray = labelText.split(',');
                            const SelectedSeatsArray = dataArray.map(item => item.trim());
                            console.log("clicked");

                            $.ajax({
                                url: "ticketRegistration.php",
                                method: 'POST',
                                data: {
                                    array: SelectedSeatsArray,
                                },
                                success: function(result) {
                                    console.log("success");
                                    $("#kkkkkk").html(result);
                                }
                            });

                        }
                    </script>
                    <br>
                </div>
            </div>
        </div>
        <!--Seat Select POP UP End-->
        <!--Body Part End-->
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Body Part End -->
    <!--Footer Start-->
    <footer class="border-top footerbackground">
        <div class="row">
            <div class="col-12 col-md ">
                <span>
                    <img class="mb-2" src="images/logo2.jpg" alt="" width="24" height="19">
                </span>
                <span>

                    <a href=>
                        <p>Make Your Journy Easy</p>
                    </a>
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
                <h5 style="color: white;">Links</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="nav-link" aria-current="page" href="#">
                            <span class="coustomIcon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="coustomText">
                                Home
                            </span>
                        </a>
                    </li>
                    <li class="mb-1"> <a class="nav-link" aria-current="page" href="#">
                            <span class="coustomIcon">
                                <ion-icon name="accessibility-outline"></ion-icon>
                            </span>
                            <span class="coustomText">
                                About Us
                            </span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a class="nav-link" aria-current="page" href="#">
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
                <h5>Policies</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="#">privacy Policy</a></li>
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="#">Terms & Conditions</a></li>
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="#">Ticket Policy</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Contact us</h5>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--Footer End-->
</body>

</html>