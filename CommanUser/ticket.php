<?php
session_start();
$tktID = $_GET['var1'];
$seatNO = $_GET['var2'];
$gndr = $_GET['var3'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  echo ("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ticket_reservation WHERE Ticket_ID = '$tktID' AND SeatNO = '$seatNO'";
$result = mysqli_query($conn, $sql);

if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
// got the OTP code from Database
$refrenceKey = $row['RefrenceNO'];
$gender = $row['Gender'];
$Date = $row['Date'];
$Time = $row['Time'];
$Uid = $row['UserID'];
$ShID = $row['Shedule_ID'];
include('phpqrcode/qrlib.php');
// how to save PNG codes to server

$tempDir = "QRIMAGES/";
$codeContents = $refrenceKey;

// we need to generate filename somehow, 
// with md5 or with database ID used to obtains $codeContents...
$fileName = $tktID . $seatNO . '.png';

$pngAbsoluteFilePath = $tempDir . $fileName;
$urlRelativeFilePath = $tempDir . $fileName;

// generating
if (!file_exists($pngAbsoluteFilePath)) {
  QRcode::png($codeContents, $pngAbsoluteFilePath);
} else {
  echo '<hr />';
}

$imagePath = './QRIMAGES/' . $tktID . $seatNO . '.png';
$imagePath2 = './Images/Banner/bgtkt.png';


if (file_exists($imagePath)) {
  $imageData = file_get_contents($imagePath);
  $base64Image = base64_encode($imageData);
} else {
  echo 'Image file not found.';
}
if (file_exists($imagePath2)) {
  $imageData2 = file_get_contents($imagePath2);
  $base64Image2 = base64_encode($imageData2);
} else {
  echo 'Image file not found.';
}

require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Journey Ease</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IM+Fell+French+Canon:400i|Montserrat:300,400,500" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/ticket.css" />
    <style>
    body {
        background-color: #f3c001;
        font-family: "Montserrat", "Helvetica Neue", "Open Sans", "Arial";
        font-weight: 300;
        padding: 30%;
      }
      .container-fluid {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
        width: 100%;
      }
      .ticket {
        border-radius: 4px;
        display: inline-block;
        max-width: 320px;
        text-align: left;
        text-transform: uppercase;
        width: 100%;
        margin-left: 5rem;

      }
      .ticket.dark {
        background-color: #161616;
        color: white;
      }
      .ticket.light {
        background-color: white;
        color: #161616;
      }
      .ticket.light .ticket-body {
        border-color: #161616;
      }
      .ticket-head {
        background-position: center;
        background-size: cover;
        border-radius: 4px 4px 0 0;
        color: white;
        height: 140px;
        position: relative;
      }
      .ticket-head .from-to {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
        font-size: 24px;
        font-weight: 600;
        width: 100%;
        z-index: 2;
      }
      .ticket-head .icon {
        display: inline-block;
        margin: 0 40px;
        transform: rotate(135deg) translate(25%, 25%);
      }
      .ticket-body {
        border-bottom: 1px dashed white;
        padding: 15px 45px;
        position: relative;        
      }
      .centerdiv{
        display: flex; 
        justify-content: center; 
        align-items: center; 
      }
      .ticket-body p {
        color: #a2a2a2;
        font-size: 12px;
      }
      .ticket-body .flight-info {
        margin-top: 15px;
      }
      .ticket-body .flight-date {
        font-size: 12px;
        margin-top: 15px;
      } 
      .disclaimer {
        color: #a2a2a2;
        font-family: "IM Fell French Canon";
        font-size: 14px;
        font-style: italic;
        line-height: 1.25;
        padding: 15px 25px;
        text-transform: none;
      }
      .layer {
        -webkit-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -ms-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        background-color: rgba(0, 0, 0, 0.4);
        border-radius: 4px 4px 0 0;
        height: 100%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 1;
      }
      p,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        margin: 0;
        padding: 0;
      }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="col">
            <div class="ticket light">
                <div class="ticket-head text-center" style="
                            background-image:url(' . 'data:image/jpeg;base64,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' . ');
                        ">
                    <div class="layer"></div>
                </div>
                <div class="ticket-body centerdiv">
                    <div class="flight-info row">
                        <div class="col-xs-6">
                            <p>Passenger</p>
                            <h4>' . $Uid . '</h4>
                            </div>
                            <div class="col-xs-6">
                                <p>Shedule</p>
                                <h4>' . $ShID . '</h4>
                                </div>
                            </div>
        
                            <div class="flight-info row">
                                <div class="col-xs-6">
                                    <p>Gender</p>
                                    <h4>' . $gndr . '</h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <p>Seat No</p>
                                        <h4>' . $seatNO . '</h4>
                                        </div>
                                    </div>
                                    <div class="flight-date">' . $Date . 'AT' . $Time . '</div>
                                    <div class="text-center">
                                        <img src="data:image/png;base64,' . $base64Image . '" alt="">
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <div class="disclaimer">
                                            Disclaimer: Keep this ticket safe. when you arrive to departure scann QR code to cunductor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </body>
                    
                    </html>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'potraite');
$dompdf->render();
$dompdf->stream();
