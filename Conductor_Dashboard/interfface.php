<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codunctor Intercface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mx-auto">
                <div class="row ticketGenarator">
                    <div class="col text-center ticketGenarator mt-5">
                        <div class="card text-center text-light mb-3 bg-success" style="width: 18rem">
                            <div class="card-body">
                                <form method="POST" action="printticket.php">
                                    <div class="row">
                                        <div class="col">
                                            <label for="from" class="form-label">From:</label>
                                            <select name="from_location" class="form-select form-select-sm bg-info text-light" aria-label="Large select example">
                                                <option selected>Badulla</option>
                                                <option value="Badulla">Badulla</option>
                                                <option value="Kandy">Kandy</option>
                                                <option value="Colombo">Colombo</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="to" class="form-label">To:</label>
                                            <select name="to_location" class="form-select form-select-sm bg-warning text-light" aria-label="Large select example">
                                                <option selected>Colombo</option>
                                                <option value="Badulla">Badulla</option>
                                                <option value="Kandy">Kandy</option>
                                                <option value="Colombo">Colombo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary">Issue Ticket</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- location sos -->
                <div class="row">
                    <div class="col-6">
                        <div class="card text-center" style="width: 8rem;">
                            <div class="card-body">
                                <small style="font-size: 10px;">Current Location : </small>
                                <label>location 1</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card text-center" style="width: 8rem;">
                            <div class="card-body">
                                <small style="font-size: 10px;">Next Location :</small>
                                <label>location 2</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <button class="btn btn-danger" style="width: 8rem; height: 4rem;">SOS</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-warning" style="width: 8rem; height: 4rem;">Update Situation</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-center">
                        <button class="btn btn-primary">Go To Dashboard</button>
                    </div>
                </div>
                <!-- location sos -->
                <!--QR part-->
                <div class="row QRcard mt-3">
                    <div class="col QRcard mt-2">
                        <div class="card text-center mb-3 bg-danger" style="width: 18rem">
                            <div class="card-body">
                                <h5 class="card-title text-light">Varify the Tickets</h5>
                                <p class="card-text">

                                    <!--Qr Pop Up Start-->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info QrScanerButton" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <div class="col text-center">
                                            <div class="row mt-2 mb-0">
                                                <h4 style="color: #fff;">Scan QR</h4>
                                            </div>
                                            <div class="row text-center qrIcon mt-0 mb-lg-0">
                                                <div class="col">
                                                    <ion-icon name="scan-circle-outline"></ion-icon>
                                                </div>
                                            </div>
                                        </div>
                                    </button>

                                    <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-warning text-light">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Scan QR Code</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!--QR Code Intergration Start-->
                                                <script src="./js/qr.js"></script>
                                                <style>
                                                    .result {
                                                        background-color: green;
                                                        color: #fff;
                                                        padding: 20px;
                                                    }
                                                </style>


                                                <div class="row">
                                                    <div class="col">
                                                        <div style="width: auto;" id="reader"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col" style="padding:30px;">
                                                        <h4>SCAN RESULT</h4>
                                                        <div id="result">Result Here</div>
                                                    </div>
                                                </div>


                                                <script type="text/javascript">
                                                    function onScanSuccess(qrCodeMessage) {
                                                        document.getElementById('result').innerHTML = '<span class="result">' + qrCodeMessage + '</span>';
                                                    }

                                                    function onScanError(errorMessage) {
                                                        //handle scan error
                                                    }

                                                    var html5QrcodeScanner = new Html5QrcodeScanner(
                                                        "reader", {
                                                            fps: 10,
                                                            qrbox: 250
                                                        });
                                                    html5QrcodeScanner.render(onScanSuccess, onScanError);
                                                </script>
                                                <!--QR code Scanner Intergration End-->
                                                </p>
                                                <a href="#" class="btn btn-success">Issue Ticket</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</body>

</html>