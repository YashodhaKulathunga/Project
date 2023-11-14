<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

user-cst/20/027
-->
<html>

<head>

    <meta charset="UTF-8">
    <title>Package Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./package_booking.css">
    <title>Package Booking </title>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bus registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<body>
    <?php
    require_once('../../../Classes/packageC.php');

    use classes\packageC;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit']) && ($_POST['weight'] <= 5)) {


            if (empty($_POST['sendername']) || empty($_POST['receivername']) || empty($_POST['type']) || empty($_POST['location']) || empty($_POST['receiver_address']) || empty($_POST['tele']) || empty($_POST['weight'])) {
                echo '<div class="alert alert-danger" role="alert">Please fill all fields.</div>';
            } else {
                $sendername = $_POST['sendername'];
                $receivername = $_POST['receivername'];
                $type = $_POST['type'];
                $locaion = $_POST['location'];
                $receiver_address = $_POST['receiver_address'];
                $tele = $_POST['tele'];
                $weight = $_POST['weight'];

                $booking = new packageC($_POST['sendername'], $_POST['receivername'], $_POST['type'], $_POST['location'], $_POST['receiver_address'], $_POST['tele'], $_POST['weight']);
                if ($booking->package_booking($sendername, $receivername, $type, $locaion, $receiver_address, $tele, $weight)) {
                    if ($weight <= 1) {
                        $price = 200;
                    } elseif ($weight <= 1.5) {
                        $price = 250;
                    } elseif ($weight <= 2) {
                        $price = 400;
                    } elseif ($weight <= 3) {
                        $price = 500;
                    } elseif ($weight <= 4) {
                        $price = 600;
                    } else {
                        $price = 700;
                    }

                    echo '<div class="alert alert-success">Your package service is successfully updated.<br>Your Package price is Rs' . $price . '.</div>';
                 
                } else {
                    echo '<div class="alert alert-danger" role="alert">Check againe.</div>';
                }
            }
        } else {
            //echo '<div class="alert alert-danger" role="alert">Your package weight is maxium than 5Kg.</div>';
            echo '<script>
                        Swal.fire({
                           icon: "error",
                           title: "Oops...",
                           text: "Your package weight is maxium than 5Kg.!",
                         
                       });
                   </script>';
        }
    } else {
        //echo '<div class="alert alert-danger" role="alert">Fill the form through POST method.</div>';
    }
    ?>
    <script>
        // Add JavaScript code here
        // For example, you can use jQuery to show a modal when the form is successfully submitted
        // $(document).ready(function() {
        //     $("#successMessage").modal('show');
        // });
    </script>

    <div class="container-fluid bg-dark text-light py-3">
        <div class="d-flex justify-content-center">
            <h1 class="display-6">Package Booking</h1>
        </div>
    </div><br><br><br><br>

    <section class="container my-2 bgdark w-50 text">

        <form class="row g-3p-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">


            <div class="col-md-6">

                <label for="validationCustom01" class="form-label">Sender's Name</label>
                <input type="text" class="form-control" id="sendername" name="sendername" required>
            </div>

            <div class="col-md-6">

                <label for="validationCustom01" class="form-label">Receiver's Name</label>
                <input type="text" class="form-control" id="receivername" name="receivername" required>
            </div>


            <div class="col-md-8">
                <label for="validationCustom01" class="form-label">Parcel Type</label>
                <input type="text" class="form-control" id="type" name="type" required>

            </div>
            <div class="col-md-8">
                <label for="validationCustom01" class="form-label">Sender's Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="col-md-8">
                <label for="validationCustom01" class="form-label">Receiver's Location</label>
                <input type="text" class="form-control" id="receiver_address" name="receiver_address" required>

            </div>
            <div class="col-md-8">
                <label for="validationCustom02" class="form-label">Telephone Number</label>
                <input type="text" class="form-control" id="tele" name="tele" required><br>

            </div>
            <div class="col-md-8">
                <label for="validationCustom02" class="form-label">Weight(kg)</label>
                <input type="text" class="form-control" id="weight" name="weight" required><br>

            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Payment Method</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">

                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Credit Card
                    </label>
                </div><br>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" value="submit" id="submit" name="submit">Reserve</button>
                </div>



        </form>
    </section>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
</body>

</html>