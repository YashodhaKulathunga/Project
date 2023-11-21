<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleabt.css">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./js/index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body><!--Nav bar start-->

    <nav class="navbar navbar-expand-lg NAVBAR">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./Images/Logo.png" alt="Logo" width="100" height="69"
                    class="d-inline-block align-text-top" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto d-flex align-items-center" style="--bs-scroll-height: 100px">
                    <li class="nav-item align-items-center">
                        <div class="d-flex align-items-center">
                            <p class="SubPageTitle FIRST-NAVLINK">
                                About Us
                            </p>
                        </div>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="./commanUser.php"><ion-icon name="arrow-back-circle-outline"
                            class="mt-3 NAVLINKSICON"><span>go back</span>></ion-icon></a>
                </div>
            </div>
        </div>
    </nav>

    <!---Nav bar End-->

    <!--Niwandi Content Start-->
    <div class="heading mt-2">
        <p><b>Our aim is to provide long-distance travelers with the convenience
                of booking bus seats to anywhere in Sri Lanka from a single, centralized platform.</b></p>

    </div>
    <div class="container">
        <section class="about">
            <div class="about-image">
                <img src="about us bus.jpeg" alt="">
            </div>
            <div class="about-content">

                <p>At CityTravels, we are passionate about providing you with a seamless and hassle-free
                    bus ticket booking experience. Our mission is to connect travelers to their desired destinations
                    with comfort, safety, and efficiency. CityTravels is a revolutionary bus ticket booking platform,
                    established with a mission to provide travelers with a seamless and hassle-free experience.
                    Our extensive network of bus routes connects cities and towns across Sri Lanka,
                    offering easy online booking with flexible ticket options. We prioritize your safety and
                    comfort by partnering with reputable bus operators, and our real-time updates keep you informed
                    throughout your journey.<span id="dots">...</span><span id="more">
                        With 24/7 customer support and a dedicated team, we are committed to delivering delightful
                        travel experiences and invite you to join us on this exciting adventure.<br>

                        CityTravels is your convenient bus ticket booking platform, aiming to revolutionize the way
                        travelers book their journeys. Our user-friendly website and mobile app make booking easy,
                        while an extensive route network covers cities and towns throughout Sri Lanka. With a focus on
                        safety and comfort, we partner with reputable bus operators and
                        provide real-time updates on bus timings. Our commitment to excellent service is backed by
                        round-the-clock customer support, ensuring you have a memorable and worry-free travel
                        experience.
                        Join CityTravels today and discover the ease and convenience of bus ticket booking with
                        us!</span></p>

                <button onclick="myFunction()" id="myBtn" class="read-more">Read more</button>

                <script>
                    function myFunction() {
                        var dots = document.getElementById("dots");
                        var moreText = document.getElementById("more");
                        var btnText = document.getElementById("myBtn");

                        if (dots.style.display === "none") {
                            dots.style.display = "inline";
                            btnText.innerHTML = "Read more";
                            moreText.style.display = "none";
                        } else {
                            dots.style.display = "none";
                            btnText.innerHTML = "Read less";
                            moreText.style.display = "inline";
                        }
                    }
                </script>
            </div>
        </section>
    </div>
    <!--Niwandi content End-->
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
    <script>
        $(document).ready(function () {
            $('#myModal').modal('show');
        });
    </script>

    
</body>

</html>