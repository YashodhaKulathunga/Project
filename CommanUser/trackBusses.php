<?php
session_start();
$userID = $_SESSION["userid"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT
    tr.*,
    s.Schedule_ID AS Reservation_Schedule_ID,
    s.*,
    b.*,
    r.*
FROM
ticket_reservation AS tr
JOIN schedule AS s ON Schedule_ID = s.Schedule_ID
JOIN bus AS b ON s.Bus_ID = b.Bus_ID
JOIN route AS r ON s.Route_ID = r.Route_ID
WHERE
tr.UserID = '$userID'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ease Travels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./js/index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
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
            background-color: #dfff00;
        }

        .selected-woman {
            background-color: pink;
        }

        .selected-man {
            background-color: green;
        }
    </style>
</head>

<body>
    <!--Nav bar start-->
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg NAVBAR">
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <div class="row"><a class="navbar-brand " href="./commanUser.php"><img src="./Images/Logo.png" alt="Logo" width="100" height="69" class="d-inline-block align-text-top" /></a></div>
                        <div class="row">
                            <p class="NAVLINKSACTIVE">Welcome <?php echo $_SESSION["name"] ?> </p>
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll gap-4" style="--bs-scroll-height: 100px">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./commanUser.php">
                                <p class="NAVLINKS FIRST-NAVLINK">
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./bookedTickets.php">
                                <p class="NAVLINKS FIRST-NAVLINK">
                                    Booked Tickets
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./trackBusses.php">
                                <p class="NAVLINKSACTIVE FIRST-NAVLINK">
                                    Track Busses
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle NAVLINKS FIRST-NAVLINK" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Other Pages
                            </a>
                            <ul class="dropdown-menu dropdown-bg-navbar drop-down-list-bg">
                                <li class="navbar-list-tag"><a class="dropdown-item navbar-list-tag" href="#">About US</a></li>
                                <li><a class="dropdown-item navbar-list-tag" href="#">Contact Us</a></li>
                                <li><a class="dropdown-item navbar-list-tag" href="#">Terms and Conditions</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ion-icon name="notifications-outline" class="NAVLINKSICON"></ion-icon>
                        <ion-icon name="person-outline" class="NAVLINKSICON"></ion-icon>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!---Nav bar End-->

    <div class="accordion-for-trackBus">
        <div class="accordion" id="accordionExample">
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $tid = $row['Ticket_ID'];
                $sno = $row['SeatNO'];
                $date = $row['Date'];
                $stl = $row['Start_Location'];
                $dtl = $row['Destination_Of_Location'];
                $at = $row['Arrival_Time'];
                $bus = $row['Bus_Registration_Number'];

                echo $i;
                echo '<div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#col' . $i . '"
                    aria-expanded="false"
                    aria-controls="col' . $i . '"
                  >
                    <div class="row text-center" style="margin-left: 20%">
                      <div class="col">
                        <h6>Date : <strong>' . $date . '</strong></h6>
                      </div>
                      <div class="col">
                        <h6>Bus Route : <strong>' . $stl . ' - ' . $dtl . '</strong></h6>
                      </div>
                      <div class="col">
                        <h6>Bus Register No : <strong>' . $bus . '</strong></h6>
                      </div>
                      <div class="col">
                        <h6>Arraival Time : <strong>' . $at . '</strong></h6>
                      </div>
                    </div>
                  </button>
                </h2>
                <div
                  id="col' . $i . '"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionExample"
                >
                  <div class="accordion-body text-center">
                  <iframe
                     src="./trackbussingle.php"
                     width="100%"
                     height="300"
                     frameborder="0"
                     ></iframe>  
                 </div>
                </div>
              </div>';

                $i++;
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>


    </tbody>
    </table>
    </div>
    </div>
    <!--Footer Start-->
    <footer class="border-top footerbackground">
        <div class="row">
            <div class="col-12 col-md ">
                <span>
                    <img class="mb-2" src="images/logo2.jpg" alt="" width="24" height="19">
                </span>
                <span>
                    <p>Make Your Journy Easy</p>
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

    <!--Footer End-->
</body>

</html>