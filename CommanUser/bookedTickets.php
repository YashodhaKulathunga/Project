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
$sql = "SELECT * FROM ticket_reservation WHERE UserID = '$userID'";

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
                                <p class="NAVLINKSACTIVE FIRST-NAVLINK">
                                    Booked Tickets
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./trackBusses.php">
                                <p class="NAVLINKS FIRST-NAVLINK">
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
    <div class="container px-2 pv-2 h-screen items-center w-screen booked-Tickets-Table">
        <div class="flex flex-center text-center text-white heading mb-2">
            <h1 style="color: #000032;">Your booked Seats</h1>
        </div>
        <div class="text-center mt-4 table-for-tickets">
            <table class="table text-center table-for-tickets">
                <thead>
                    <tr class="table-row-class">
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Seat NO</th>
                        <th scope="col">Download Ticket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tid = $row['Ticket_ID'];
                        $sno = $row['SeatNO'];
                        echo '<tr>';
                        echo '<td>' . $row['Ticket_ID'] . '</td>';
                        echo '<td>' . $row['SeatNO'] . '</td>';
                        echo '<td>
                        <div class="row">
                        <div class="col text-center">
                          <a href="ticket.php?var1=' . $tid . '&var2=' . $sno . '">
                            <button
                              type="submit"
                              class="btn btn-lg btn-find-busses"
                              data-bs-toggle="modal"
                              data-bs-target="#staticBackdrop"
                              id="button1"
                            >
                              Download Ticket
                            </button>
                          </a>                        
                          <botton class="btn btn-lg btn-danger">Cancel</botton>
                        </div>
                      </div>
                            </td>';
                    }
                    mysqli_close($conn);
                    ?>


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