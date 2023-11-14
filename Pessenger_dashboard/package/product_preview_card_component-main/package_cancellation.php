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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bus registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?PHP
        require_once('../../../Classes/packageC.php');

        use classes\packageC;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['submit'])) {
                    if (empty($_POST['Package_ID']) || empty($_POST['sendername']) || empty($_POST['type'])){
                        echo '<div class="alert alert-danger" role="alert">Please fill all fields.</div>';
                    }else{
                        $sendername = $_POST['sendername'];
                        $Package_ID=$_POST['Package_ID'];
                        $sendername=$_POST['type'];
                        $cancellation = new packageC(null,null,null,null,null,null,null,null);
                        if ($cancellation->package_cancellation($Package_ID,$sendername, $type)){
                            echo '<div class="alert alert-success">Delected!!</div>';
                        }else {
                            echo '<div class="alert alert-danger" role="alert">Bus_Id is not found in the database..</div>';
                        }
                    }

                } else {
                    echo '<div class="alert alert-danger" role="alert">Fill the form through Submit Button.</div>';
                }

            }else{
                 //echo '<div class="alert alert-danger" role="alert">Fill the form through POST method.</div>';
            }
            

?>
<body>
<div class="container-fluid bg-dark text-light py-3">
        <div class="d-flex justify-content-center">
            <h1 class="display-6">Package Cancellation</h1>
        </div>
    </div><br><br><br><br>

    <section class="container my-2 bgdark w-50 text">

        <form class="row g-3p-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">


            <div class="col-md-6">

                <label for="validationCustom01" class="form-label">Package Id</label>
                <input type="text" class="form-control" id="Package_ID" name="Package_ID" required>
            </div>

            <div class="col-md-6">

                <label for="validationCustom01" class="form-label">Sender's Name</label>
                <input type="text" class="form-control" id="sendername" name="sendername" required>
            </div>


            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Parcel Type</label>
                <input type="text" class="form-control" id="type" name="type" required>

            </div>
            <div class="col-12">
                    <button type="submit" class="btn btn-primary" value="submit" id="submit" name="submit">Cancel</button>
             </div>

</body>
</html>