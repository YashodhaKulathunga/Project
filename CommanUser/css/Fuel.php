<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href=" ./css/Fuel.css">
    <title>Fuel Expenses</title>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bus registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>




<body>

    <div class="container-fluid bg-dark text-light py-3">
        <div class="d-flex justify-content-center">
            <h1 class="display-6"> Fuel Expenses</h1>
        </div>
    </div>
    <section class="container my-2 bgdark w-50 text">
        <form action="Fuel.php",method="POST">

            <div class="col-md-8">
                <label for="validationCustom01" class="form-label">Bus ID</label>
                <input type="text" class="form-control" name="Bus_ID" id="Bus_ID" required>
            </div>


            <!--div class="col-md-4">
                <label for="inputState" class="form-label">Bus Category</label>
                <select id="inputState" class="form-select">
                    <option selected>AC</option>
                    <option> Non AC</option>

                </select>
            </div-->
            
          
            <div class="col-md-8">
                    <div class="input-group mb-10">
                        <span class="input-group-text mt-3" id="basic-addon1"> Date</span>
                        <input type="date" name="date" id="date" class="form-control mt-3" placeholder="Appoint Date"
                            aria-label="Departure Date" aria-describedby="basic-addon1">

                    </div>
                </div>
            

            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Travel in Kilometers</label>
                <input type="text" class="form-control"name="travel_in_km" id="travel_in_km">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Liters of Fuel</label>
                <input type="text"name="fuel_in_liter" id="fuel_in_liter" class="form-control" />
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Expence of Fuel in Rupees</label>
                <input type="text" id="expences" name="expences"class="form-control" />
            </div>

          

            <div class="col-8">
                <button type="submit"name="submit" class="btn btn-primary">Submit</button>
            </div>


        </form>

    </section>






</body>

</html>