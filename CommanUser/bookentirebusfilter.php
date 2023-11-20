<?php
// Start or resume the session
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .date-picker {
            display: flex;
            justify-content: space-between;
            max-width: 300px;
            margin: 20px;
        }

        input {
            padding: 10px;
            font-size: 16px;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
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
                                    Select The Dates
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
    <div class="text-center" style="margin-top: 11.5rem;">
        <div class="row">
            <div class="col">
                <div class="container mt-5">
                    <div class="form-group">
                        <label for="dateRange">Select Date Range:</label>
                        <input type="text" class="form-control text-center bg-select-place-date" id="dateRange" />
                    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#dateRange').daterangepicker({
                            opens: 'center',
                            startDate: moment().subtract(0, 'days'),
                            endDate: moment()

                        }, function(start, end, label) {
                            console.log('Selected Date Range: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                        });
                    });
                </script>


            </div>
            <input type="hidden" id="start_date" name="start_date" value="">
            <input type="hidden" id="end_date" name="end_date" value="">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
            <script>
                $(document).ready(function() {
                    $('#dateRange').daterangepicker({
                        opens: 'center',
                        startDate: moment().subtract(0, 'days'),
                        endDate: moment()
                    }, function(start, end, label) {
                        // Clear existing cookies
                        document.cookie = "var1=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                        document.cookie = "var2=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

                        // Set cookies with the values of start and end
                        document.cookie = "var1=" + start.format('YYYY-MM-DD');
                        document.cookie = "var2=" + end.format('YYYY-MM-DD');

                        // Set the values of hidden input fields
                        $('#start_date').val(start.format('YYYY-MM-DD'));
                        $('#end_date').val(end.format('YYYY-MM-DD'));

                        console.log('Selected Date Range: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

                        // Make an AJAX request to update PHP variables
                        $.ajax({
                            type: 'POST',
                            url: 'update_variables.php',
                            data: {
                                var1: start.format('YYYY-MM-DD'),
                                var2: end.format('YYYY-MM-DD')
                            },
                            success: function(response) {
                                console.log('PHP variables updated successfully');
                                renderAndShowIframe('update_variables.php');
                            },
                            error: function(error) {
                                console.error('Error updating PHP variables');
                            }
                        });
                    });
                });

                function renderAndShowIframe(response) {
                    // Assuming the response contains the iframe URL
                    var iframeUrl = response;

                    // Create iframe element
                    var iframe = document.createElement('iframe');
                    iframe.src = iframeUrl;
                    iframe.width = '100%';
                    iframe.height = '400px';
                    iframe.style.display = 'none'; // Initially hide the iframe

                    // Append iframe to a container or body
                    document.body.appendChild(iframe);

                }
            </script>

        </div>
    </div>
    <?php
    // Function to get the value of a cookie or return null if it doesn't exist
    function getCookieValue($cookieName)
    {
        return isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : null;
    }

    // Check if the cookies var1 and var2 are set
    if (isset($_COOKIE['var1'])) {
        // Retrieve the values of var1 and var2 from the cookies
        $var1 = getCookieValue('var1');
        $var2 = getCookieValue('var2');

        // Check if the values have changed
        if ($_SESSION['var1'] !== $var1 || $_SESSION['var2'] !== $var2) {
            // Values have changed, update PHP session variables
            $_SESSION['var1'] = $var1;
            $_SESSION['var2'] = $var2;
        } else {
            // Database connection parameters
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "db1";

            // Establish the database connection
            $connection = mysqli_connect($host, $username, $password, $database);

            // Check the connection
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Set your date variables directly
            $start_date = $var1; // Replace with your actual start date
            $end_date = $var2;     // Replace with your actual end date

            // Query to retrieve available buses within the specified date range
            $query = "
                        SELECT b.*
                        FROM buses b
                        LEFT JOIN bookings bk ON b.bus_id = bk.bus_id_fk
                        WHERE (
                        bk.booking_id IS NULL 
                        OR (
                        bk.booking_start_date > '$end_date' 
                        OR bk.booking_end_date < '$start_date'
                        )
                        )   
                        ";

            // Execute the query
            $result = mysqli_query($connection, $query);
    ?>
            <div class="text-center" style="padding: 2rem;">
                <div class="row">
                    <?php

                    // Display available buses
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="col-3 mt-2">
                            <div class="text-center ">
                                <div class="text-center Choose-bus--container rounded-3">
                                    <h1 class="Heading-in-choose-shedule"><?php echo $row['bus_name']; ?></h1>

                                    <div class="text-center" style="padding: 10%;">
                                        <div class="text-center">
                                            <div class="row text-center" style="justify-content: center;">
                                                <img src="./busimages/img01.png" style="height: 9rem; width: 9rem;">
                                            </div>
                                        </div>

                                        <div class="row text-center">
                                            <div class="detils" style="padding: 3rem;">
                                                <h1 style="font-size: 1.5rem;">Bus ID: <?php echo $row['bus_id']; ?></h1>
                                                <h1 style="font-size: 1.5rem;">Bus Name: <?php echo $row['bus_name']; ?></h1>
                                                <h1 style="font-size: 1.5rem;">Total Seats: <?php echo $row['total_seats']; ?></h1>
                                                <h1 style="font-size: 1.5rem;">Details</h1>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 3rem;">
                                            <a href="./checkoutentirebus.php"><button type="button" class="btn button-choose-sear mt-2">Book Bus</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }

                    // Close the database connection
                    mysqli_close($connection);
                }
                ?>
                </div>
            </div>
        <?php
    } else {
        echo "Cookies not set!";
    }
        ?>

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
        <script>
            $(document).ready(function() {
                $('#myModal').modal('show');
            });
        </script>

        <!--Footer End-->
</body>

</html>