<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Conductor Registration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="employee.css">

    <title>Add Conductor</title>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="employee .css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<?php
require_once('../Classes/Admin.php');
use classes\Admin;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        if (empty($_POST['Name']) || empty($_POST['email']) || empty($_POST['PhoneNo']) || empty($_POST['ID']) || empty($_POST['address']) || empty($_POST['CID'])) {
            echo '<div class="alert alert-danger" role="alert">Please fill all fields.</div>';
        } else {
            $Name = $_POST['Name'];
            $email = $_POST['email'];
            $PhoneNo = $_POST['PhoneNo'];
            $ID = $_POST['ID'];
            $address = $_POST['address'];
            $CID = $_POST['CID'];

            $Emp = new Admin(null, null, null, null, null, null);

            if ($Emp->EmpExists($CID)) {
                echo '<div class="alert alert-danger" role="alert">Conductor with ID ' . $CID . ' already exists.</div>';
            } else {
                if ($Emp->Emp_Registration($CID, $ID, $Name, $PhoneNo)) {
                    echo '<div class="alert alert-success" role="alert">Successfully Added.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Failed to add the bus.</div>';
                }
            }
        }
    }
}
?>


    <div class="container-fluid bg-dark text-light py-3">
        <div class="d-flex justify-content-center">
            <h1 class="display-6"> Conductor Registration</h1>
        </div>
    </div><br><br>
    <section class="container my-2 bgdark w-50 text">
        <form class="row g-3p-3" action="<?php echo $_SERVER["PHP_SELF"]; ?> " method="POST">
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Conductor ID</label>
                <input type="text" class="form-control" id="validationCustom01" name="CID" required>
            </div>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Bus ID</label>
                <input type="text" class="form-control" id="validationCustom01" name="ID" required>
            </div>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="Name">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Contact No</label>
                <input type="text" id="phone" class="form-control" data-mdb-input-mask="+48 999-999-999"
                    name="PhoneNo" />
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address"><br>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Add Conductor</button>
            </div>
        </form>
    </section>

</body>

</html>