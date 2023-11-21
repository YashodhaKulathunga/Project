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
                        <?php
                        if (isset($_SESSION["name"])) {
                            $userID = $_SESSION["userid"];
                            $sql = "SELECT COUNT(*) AS unread_notifications FROM notification WHERE User_ID = ? AND Status = 'Unseen'";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $userID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $unreadNotifications = $row['unread_notifications'];
                            if ($unreadNotifications > 0) {
                                echo '<a data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <ion-icon name="notifications-outline" class="NAVLINKSICON" style="position: absolute; margin-left:-2rem;"></ion-icon>
                                <span class="badge bg-danger" style="position: relative; margin-top: -5rem;">' . $unreadNotifications . '</span>
                        </a>';
                            } else {
                                echo '<a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <ion-icon name="notifications-outline" class="NAVLINKSICON"></ion-icon>
                        </a>';
                            }
                        } else {
                            echo '<a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <ion-icon name="notifications-outline" class="NAVLINKSICON"></ion-icon>
                        </a>';
                        }
                        ?>
                        <a href="./profile.php"><ion-icon name="person-outline" class="NAVLINKSICON"></ion-icon></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="modal fade" style="margin-top: 6.5rem; margin-left: 25rem; position: fixed;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #f3c001;">
                    <div class="modal-body">
                        <div class="row">
                            <h3>Unseen Notifications</h3>
                            <?php
                            $userID = $_SESSION["userid"]; // Assuming you have stored the user ID in session
                            $query = "SELECT * FROM notification WHERE User_ID = '$userID' AND Status = 'Unseen'";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="card mt-1" style="background-color: #000032; color: #f3c001;">
                                            <div class="card-body">
                                                ' . $row['message'] . '
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo "<p>No unseen notifications</p>";
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <h3>Seen Notifications</h3>
                            <?php
                            $userID2 = $_SESSION["userid"]; // Assuming you have stored the user ID in session
                            $query2 = "SELECT * FROM notification WHERE User_ID = '$userID2' AND Status = 'Seen'";
                            $result = mysqli_query($conn, $query2);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="card mt-1" style="background-color: #000032; color: #f3c001;">
                                            <div class="card-body">
                                                ' . $row['message'] . '
                                            </div>
                                        </div>';
                                }
                                $updateQuery = "UPDATE notification SET Status = 'Seen' WHERE User_ID = '$userID' AND Status = 'Unseen'";
                                $updateResult = mysqli_query($conn, $updateQuery);
                                if (!$updateResult) {
                                    echo "Failed to update notification status: " . mysqli_error($conn);
                                }
                            } else {
                                echo "<p>No Seen notifications</p>";
                            }
                            ?>
                        </div>
                        <div class="row mt-2">
                            <div class="d-flex justify-content-center align-item-center">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Nav bar End-->

    <div class="container px-2 pv-2 h-screen items-center w-screen booked-Tickets-Table">
        <div class="flex flex-center text-center text-white heading mb-2">
            <h1 style="color: #000032;">Track your Booked Tickets</h1>
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
                        $shid = $row['Shedule_ID'];
                        $link = './trackbussingle.php?var1=' . urlencode($shid);
                        echo '<tr>';
                        echo '<td>' . $row['Ticket_ID'] . '</td>';
                        echo '<td>' . $row['SeatNO'] . '</td>';
                        echo '<td>
                        <div class="row">                        
                        <div class="col">
                        <a href="' . $link . '">
                            <button type="submit" class="w-100 btn btn-lg btn-find-busses" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="button1">
                                Track Bus
                            </button>
                        </a>
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