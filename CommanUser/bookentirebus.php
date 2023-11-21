<?php
// Establish a database connection (Replace with your actual database connection code)
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn1 = new mysqli($serverName, $username, $password, $dbname);

// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}

session_start();

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
</head>

<body>
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
                                    Select The Bus You Want
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="./checkout.php"><ion-icon name="arrow-back-circle-outline" class="mt-3 NAVLINKSICON"><span>go back</span>></ion-icon></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!---Nav bar End-->
    <div class="text-center" style="padding: 2rem;">
        <div class="row">
            <div class="col-3">
                <div class="text-center " style="margin-top: 14.5rem; margin-left: 2.5rem;">
                    <div class="text-center Choose-bus--container rounded-3">
                        <h1 class="Heading-in-choose-shedule">Bus Name</h1>

                        <div class="text-center">
                            <div class="row">
                                <div class="col-3" style="padding: 3rem;">
                                    <img src="./busimages/img01.png" class="availablebusforbooking" style="height: 9rem; width: 9rem;">
                                </div>
                                <div class="col-9">
                                    <div class="detils" style="padding: 3rem;">
                                        <h1 style="font-size: 1.5rem;">bus seats count</h1>
                                        <h1 style="font-size: 1.5rem;">Type</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                    </div>
                                </div>
                                <div class="row" style="padding: 3rem;">
                                    <button type="button" class="btn button-choose-sear mt-2">Choose Seat</button>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="text-center " style="margin-top: 14.5rem; margin-left: 2.5rem;">
                    <div class="text-center Choose-bus--container rounded-3">
                        <h1 class="Heading-in-choose-shedule">Bus Name</h1>

                        <div class="text-center">
                            <div class="row">
                                <div class="col-3" style="padding: 3rem;">
                                    <img src="./busimages/img01.png" class="availablebusforbooking" style="height: 9rem; width: 9rem;">
                                </div>
                                <div class="col-9">
                                    <div class="detils" style="padding: 3rem;">
                                        <h1 style="font-size: 1.5rem;">bus seats count</h1>
                                        <h1 style="font-size: 1.5rem;">Type</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                    </div>
                                </div>
                                <div class="row" style="padding: 3rem;">
                                    <button type="button" class="btn button-choose-sear mt-2">Choose Seat</button>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="text-center " style="margin-top: 14.5rem; margin-left: 2.5rem;">
                    <div class="text-center Choose-bus--container rounded-3">
                        <h1 class="Heading-in-choose-shedule">Bus Name</h1>

                        <div class="text-center">
                            <div class="row">
                                <div class="col-3" style="padding: 3rem;">
                                    <img src="./busimages/img01.png" class="availablebusforbooking" style="height: 9rem; width: 9rem;">
                                </div>
                                <div class="col-9">
                                    <div class="detils" style="padding: 3rem;">
                                        <h1 style="font-size: 1.5rem;">bus seats count</h1>
                                        <h1 style="font-size: 1.5rem;">Type</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                    </div>
                                </div>
                                <div class="row" style="padding: 3rem;">
                                    <button type="button" class="btn button-choose-sear mt-2">Choose Seat</button>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="text-center " style="margin-top: 14.5rem; margin-left: 2.5rem;">
                    <div class="text-center Choose-bus--container rounded-3">
                        <h1 class="Heading-in-choose-shedule">Bus Name</h1>

                        <div class="text-center">
                            <div class="row">
                                <div class="col-3" style="padding: 3rem;">
                                    <img src="./busimages/img01.png" class="availablebusforbooking" style="height: 9rem; width: 9rem;">
                                </div>
                                <div class="col-9">
                                    <div class="detils" style="padding: 3rem;">
                                        <h1 style="font-size: 1.5rem;">bus seats count</h1>
                                        <h1 style="font-size: 1.5rem;">Type</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                        <h1 style="font-size: 1.5rem;">deatails</h1>
                                    </div>
                                </div>
                                <div class="row" style="padding: 3rem;">
                                    <button type="button" class="btn button-choose-sear mt-2">Choose Seat</button>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <script>
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    </script>

    <!--Footer End-->
</body>

</html>