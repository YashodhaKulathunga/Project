<?php
session_start();
$userID =  $_SESSION["userid"];


$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($serverName, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// getting row count fot ticket id
$query = "SELECT COUNT(*) as count FROM ticket_reservation WHERE Status = 'Unpaid' AND 	UserID = '$userID' ";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
$row = mysqli_fetch_assoc($result);
// got the counts of the row
$count = $row['count'];
$amount = 2000 * $count;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Payment Form</title>
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-checkout-page">
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
                                    Book Entire Bus
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

    <!-- Check out -->
    <div class="checkout-fom-div">
        <div class="">
            <div class="checkout-form-final-entire-bus ">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3>Fill all the details below</h3>
                        <h1>Bus NO</h1>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-center" style="padding: 20%; margin-top:4.5rem;">
                                <img src="./busimages/img01.png" style="height: 350px; width: 350px;">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="text-center">
                                    <p class="choosePackagestitle">Choose your Packages</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <Button class="packagebtn text-center ">
                                        <div class="text-center Choose-package--container rounded-3">
                                            <div class="text-center">
                                                <div class="row mt-0 mb-0"><small>Per a Day</small></div>
                                                <div class="row text-center" style="justify-content: center; margin-top:0px; margin-bottom:0px;"><img src="./Images/icons/bus-stop-svgrepo-com (1).svg" style="height: 100px; width:100px;   "></div>
                                                <div class="row mt-0 mb-0">
                                                    <p class="choosePackagestitle mt-0 mb-0">100km</p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 20px;" class="mb-0 mt-0">Rs. 20000</p>
                                                    <small class="mt-0" style="font-size: 10px;">Rs. 25 per every extra 1km </small>
                                                </div>
                                            </div>
                                        </div>
                                    </Button>
                                </div>
                                <div class="col">
                                    <Button class="packagebtn text-center ">
                                        <div class="text-center Choose-package--container rounded-3">
                                            <div class="text-center">
                                                <div class="row mt-0 mb-0"><small>Per a Day</small></div>
                                                <div class="row text-center" style="justify-content: center; margin-top:0px; margin-bottom:0px;"><img src="./Images/icons/bus-stop-svgrepo-com (1).svg" style="height: 100px; width:100px;   "></div>
                                                <div class="row mt-0 mb-0">
                                                    <p class="choosePackagestitle mt-0 mb-0">300km</p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 20px;" class="mb-0 mt-0">Rs. 54000</p>
                                                    <small class="mt-0" style="font-size: 10px;">Rs. 20 per every extra 1km </small>
                                                </div>
                                            </div>
                                        </div>
                                    </Button>
                                </div>
                                <div class="col">
                                    <Button class="packagebtn text-center ">
                                        <div class="text-center Choose-package--container rounded-3">
                                            <div class="text-center">
                                                <div class="row mt-0 mb-0"><small>Per a Day</small></div>
                                                <div class="row text-center" style="justify-content: center; margin-top:0px; margin-bottom:0px;"><img src="./Images/icons/bus-stop-svgrepo-com (1).svg" style="height: 100px; width:100px;   "></div>
                                                <div class="row mt-0 mb-0">
                                                    <p class="choosePackagestitle mt-0 mb-0">500km</p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 20px;" class="mb-0 mt-0">Rs. 60000</p>
                                                    <small class="mt-0" style="font-size: 10px;">Rs. 15 per every extra 1km </small>
                                                </div>
                                            </div>
                                        </div>
                                    </Button>
                                </div>
                                <div class="col">
                                    <Button class="packagebtn text-center ">
                                        <div class="text-center Choose-package--container rounded-3">
                                            <div class="text-center">
                                                <div class="row mt-0 mb-0"><small>Per a Day</small></div>
                                                <div class="row text-center" style="justify-content: center; margin-top:0px; margin-bottom:0px;"><img src="./Images/icons/bus-stop-svgrepo-com (1).svg" style="height: 100px; width:100px;   "></div>
                                                <div class="row mt-0 mb-0">
                                                    <p class="choosePackagestitle mt-0 mb-0">800km</p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 20px;" class="mb-0 mt-0">Rs. 120000</p>
                                                    <small class="mt-0" style="font-size: 10px;">Rs. 10 per every extra 1km </small>
                                                </div>
                                            </div>
                                        </div>
                                    </Button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <span class="noteforcustomerpayment"><ion-icon name="cash-outline" class="iconinchoosepackage"></ion-icon>
                                        <p class="choosePackagennotes mt-2">You need to pay initial amount as 40% of your total amount</p>
                                    </span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center" style="padding-left: 20%; padding-right: 20%;">
                                    <p class="choosePackagestitle">Amount</p>
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <h3>Enter Your Email Address</h3>
                            </div>
                            <form action="process_payment.php" method="POST">
                                <div class="form-outline mb-4">
                                    <input type="text" name="emailadd" class="form-control form-control-lg" placeholder="Email Address" />
                                </div>
                                <div class="text-center mb-4">
                                    <h3>Enter Your Card Details</h3>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="cardName" class="form-control form-control-lg" placeholder="Card Holder's Name" />
                                </div>
                                <div class="row mb-4">
                                    <div class="col-4">
                                        <div class="form-outline">
                                            <input type="text" name="cardNO" class="form-control form-control-lg" placeholder="Card Number" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-outline">
                                            <input type="text" name="expMonth" class="form-control form-control-lg" placeholder="Exp.Month" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-outline">
                                            <input type="text" name="expYear" class="form-control form-control-lg" placeholder="Exp.Year" />
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-outline">
                                            <input type="password" name="cvv" class="form-control form-control-lg" placeholder="CVV" />
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <button class="btn-Checkout-form">
                                        Proceed
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Check out -->
    <!--Footer Start-->
    <footer class="border-top footerbackground">
        <div class="row">
            <div class="col-12 col-md ">
                <div class="row">
                    <span>
                        <img class="mb-2" src="./Images/Logo.png" alt="" width="125" height="87">
                    </span>
                    <span>
                        <p style="color: pink;">Make Your Journey Easy</p>

                    </span>
                    <small class="d-block mb-3 text-body-secondary">&copy; 2017–2023</small>
                </div>

                <div class="row " style="margin-top: -2rem;">
                    <div class="container firstCol">
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="https://www.facebook.com">
                                <span class="coustomIcon SMLF">
                                    <ion-icon name="logo-facebook">
                                </span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="https://www.instagram.com">
                                <span class="coustomIcon SMLI">
                                    <ion-icon name="logo-instagram">
                                </span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="https://www.whatsapp.com">
                                <span class="coustomIcon SMLW">
                                    <ion-icon name="logo-whatsapp">
                                </span>
                            </a>
                        </div>
                        <div class="col ">
                            <a class="nav-link" aria-current="page" href="https://www.twitter.com">
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
                    <li class="mb-1"><a class="nav-link" aria-current="page" href="commanUser.php">
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
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="privacyPolicy.php">privacy
                            Policy</a></li>
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="Terms.php">Terms &
                            Conditions</a></li>
                    <li class="mb-1"><a class="link text-decoration-none listtext" href="TicketPolicy.php">Ticket
                            Policy</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5 style="color: pink;">Contact us</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none listtext"
                            href="../contactus/index.php">
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