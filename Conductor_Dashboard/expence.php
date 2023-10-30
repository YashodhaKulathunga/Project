<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href=" ./css/journey.css">
        <title>Other Expences</title>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="bus registration.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
              integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <?php
        
       // require_once('./Classes/DbConnector.php');
       require_once('../Classes/Conductor.php');
       use classes\Conductor;

       // use classes\DbConnector;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['submit'])){
            if (empty($_POST['date']) || empty($_POST['expence_item']) || empty($_POST['expence_rp']) || empty($_POST['Bus_ID'])){
                echo '<div class="alert alert-danger" role="alert">Please Fill all feilds.</div>';
            }else{
                $date = $_POST['date'];
                $expence_item = $_POST['expence_item'];
                $expence_rp = $_POST['expence_rp'];
                $Bus_ID = $_POST['Bus_ID'];

                $item= new Counductor(null, null, null, null, null, null, null,null,null);
                if($item->expence($date, $expence_item,  $expence_rp ,$Bus_ID)){
                    echo '<div class="alert alert-success">Updated!!</div>';
                }else{
                    echo '<div class="alert alert-danger" role="alert">Bus_Id is not found in the database..</div>';
                }

            }

        }else {
                echo '<div class="alert alert-danger" role="alert">Fill the form throught Submit Button.</div>';
            }

    }else {
            //echo '<div class="alert alert-danger" role="alert">Fill the form throught POST method.</div>';
        }
     
    
          






                    
        ?>

        <div class="container-fluid bg-dark text-light py-3">
            <div class="d-flex justify-content-center">
                <h1 class="display-6"> Other Expences</h1>
            </div>
        </div>
        <section class="container my-2 bgdark w-50 text">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?> " method="POST">

                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Bus_ID</label>
                    <input type="text" class="form-control" name="Bus_ID" id="validationCustom01" required>
                </div>


                <div class="col-md-8">
                    <div class="input-group mb-10">
                        <span class="input-group-text mt-3" id="basic-addon1"> Date</span>
                        <input type="date" class="form-control mt-3"name="date" placeholder="Appoint Date"
                               aria-label="Departure Date" aria-describedby="basic-addon1">

                    </div>
                </div>


                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Expence Item</label>
                    <input type="text" name="expence_item" class="form-control" id="inputmodel">
                </div>

                <div class="col-md-8">
                    <label for="inputPassword4" class="form-label">Expence in Rupees</label>
                    <input type="text" id="inputseats"name="expence_rp" class="form-control" />
                </div>


                <div class="col-8">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>


        </section>
    </body>
</html>
