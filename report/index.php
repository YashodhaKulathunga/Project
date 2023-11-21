<?php
session_start();

//calling mpdf library
require_once __DIR__ . '/vendor/autoload.php';

// Initialize variables
$date = "";
$arrivaltime = "";
$departuretime = "";
$busnumber = "";

// Check if "export" parameter is set and generate PDF if so

if (isset($_GET["export"])) {

  $currentDateTime = date("Y-m-d H:i:s");

  $mpdf = new \Mpdf\Mpdf();
  $filename = "report.pdf";
  $html = "
  <div>
  <p><p><strong>Report generated Date and Time: </strong>$currentDateTime</p></p>
  </div>
  <div>
  <p><strong>Journey Information</strong></p>
  </div>
  <table style='border-collapse: collapse; width: 100%;'>
  <tr>
     <th style='border: 1px solid black;'>Bus Number</th>
     <th style='border: 1px solid black;'>Date of Journey</th>
     <th style='border: 1px solid black;'>Arrival Time of the Journey</th>
     <th style='border: 1px solid black;'>Departure Time of the Journey</th>
  </tr>
  <tr>
     <td style='border: 1px solid black;'>{$_SESSION['busnumber']}</td>
     <td style='border: 1px solid black;'>$currentDateTime</td>
     <td style='border: 1px solid black;'>{$_SESSION['arrivaltime']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['departuretime']}</td>
  </tr>
</table>
<div>
<p><strong>Staff Information</strong></p>
</div>
<table style='border-collapse: collapse; width: 100%;'>
  <tr>
     <th style='border: 1px solid black;'>Bus Number</th>
     <th style='border: 1px solid black;'>Conductor ID</th>
  </tr>
  <tr>
     <td style='border: 1px solid black;'>{$_SESSION['busnumber']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['conductorid']}</td>
  </tr>
</table>
<div>
<p><strong>Fuel Expense</strong></p>
</div>
<table style='border-collapse: collapse; width: 100%;'>
  <tr>
     <th style='border: 1px solid black;'>Bus Number</th>
     <th style='border: 1px solid black;'>Date</th>
     <th style='border: 1px solid black;'>Fuel Expenses</th>
     
  </tr>
  <tr>
     <td style='border: 1px solid black;'>{$_SESSION['busnumber']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['datefuel']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['fuelexpense']}</td>
  </tr>
</table>
<div>
<p><strong>Other Expenses</strong></p>
</div>
<table style='border-collapse: collapse; width: 100%;'>
  <tr>
     <th style='border: 1px solid black;'>Bus Number</th>
     <th style='border: 1px solid black;'>Date</th>
     <th style='border: 1px solid black;'>Expense</th>
     <th style='border: 1px solid black;'>Cost</th>
  </tr>
  <tr>
     <td style='border: 1px solid black;'>{$_SESSION['busnumber']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['date']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['expense']}</td>
     <td style='border: 1px solid black;'>{$_SESSION['cost']}</td>
  </tr>
</table>
";
  $mpdf->WriteHTML($html);
  $mpdf->Output($filename, 'D');
  exit;
}

// Database connection 
$host = "localhost";
$dbname = "db1";
$dbuser = "root";
$dbpw = "";

try {
  $dsn = "mysql:host=$host;dbname=$dbname";
  $pdo = new PDO($dsn, $dbuser, $dbpw);

  // Set PDO attributes, such as error mode and character set if needed.
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $exc) {
  die("Error in database connection: " . $exc->getMessage());
}

//check if the user clicked the generate report button

?>
<!---connection ends-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Generation</title>
  <!--bootstrap and CSS links-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!--js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!--font awesome link-->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ from another stylesheet---------->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <!--report styling-->
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f3c001;
    }

    header {
      background-color: #ffffff;
      color: #140505;
      text-align: center;
      padding: 1rem;
    }

    main {
      max-width: 800px;
      margin: 0 auto;
      padding: 2rem;
    }

    section {
      margin-bottom: 1.5rem;
      border-radius: 5px;
      background-color: #fff;
      padding: 1.5rem;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
    }

    h3 {
      margin-top: 0;
      border-bottom: 2px solid #000032;
      padding-bottom: 0.5rem;
    }

    strong {
      font-weight: bold;
    }

    footer {
      text-align: center;
      padding: 1rem;
      background-color: #007bff;
      color: #fff;
    }


  </style>
</head>

<body>
  <form method="GET" action="index.php">
    <div class="container">
      <div class="row p-5 text-center">
        <h2>Generate Bus Journey Report</h2>

      </div>
      <div class="row">

        <div class='col-sm-4'>
          <select class="form-select form-select-lg mb-3" name="schedule" aria-label="Large select example">
            <option selected>Select a Schedule</option>
            <!--displaying schedules-->
            <?php
            $select_schedules = "SELECT * FROM schedule";
            $stmt = $pdo->query($select_schedules);
            while ($row_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $schedule = $row_data['Schedule_ID'];
              echo "<option value='$schedule'>$schedule</option>";
            }
            ?>
          </select>

        </div>

        <!--select the bus id-->
        <div class='col-sm-4'>
          <select class="form-select form-select-lg mb-3" name="busid" aria-label="Large select example">
            <option selected>Select a Bus ID</option>
            <!--displaying busID-->
            <?php
            $select_bus = "SELECT * FROM bus";
            $stmt = $pdo->query($select_bus);
            while ($row_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $busid = $row_data['Bus_ID'];
              echo "<option value='$busid'>$busid</option>";
            }
            ?>
          </select>

        </div>
        <!--button to generate the report-->
        <div class="col-sm-4">
          <button type="submit" class="btn btn-block" style="background-color: #000032; color: white; padding: 6px 8px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 0 2px 10px; cursor: pointer; border-radius: 6px;" name="generate">Generate Report</button>
        </div>
      </div>
    </div>
    <!--report generation part-->
    <?php
    if (isset($_GET["generate"])) {
      $schedule = $_GET["schedule"];
      $busid = $_GET["busid"];

      $searchschedule = "SELECT * FROM schedule WHERE Schedule_ID=?";
      $stmt = $pdo->prepare($searchschedule);
      $stmt->bindValue(1, $schedule);
      $stmt->execute();
      $row_data = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row_data) {
        $_SESSION['arrivaltime'] = $row_data["Arrival_Time"];
        $_SESSION['date'] = $row_data["Date"];
        $_SESSION['busnumber'] = $row_data["Bus_ID"];
        $_SESSION['departuretime'] = $row_data["Departure_Time"];

        $searchfuel = "SELECT * FROM fuel WHERE Bus_ID=?";
        $stmt = $pdo->prepare($searchfuel);
        $stmt->bindValue(1, $busid);
        $stmt->execute();
        $row_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row_data) {
          $_SESSION['fuelexpense'] = $row_data["Price"];
          $_SESSION['datefuel']=$row_data["Date"];
        }
        
        $searchcon="SELECT * FROM conductor WHERE Bus_ID=?";
        $stmt=$pdo->prepare($searchcon);
        $stmt->bindValue(1,$busid);
        $stmt->execute();
        $row_data=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row_data){
           $_SESSION['conductorid']=$row_data["Conductor_ID"];
        }
        
        $searchother = "SELECT * FROM expences WHERE Bus_ID=?";
        $stmt = $pdo->prepare($searchother);
        $stmt->bindValue(1, $busid);
        $stmt->execute();
        $row_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row_data){
           $_SESSION['busid']=$row_data["Bus_ID"];
           $_SESSION['date']=$row_data["Date"];
           $_SESSION['expense']=$row_data["Item"];
           $_SESSION['cost']=$row_data["Price"];
        }
        //generating Journey Information
        $html = "<main>
  <section>
          <h3>Journey Information</h3>
          <p><strong>Date of Journey: </strong>{$_SESSION['date']}</p>
          <p><strong>Arrival Time of the Journey: </strong>{$_SESSION['arrivaltime']}</p>
          <p><strong>Departure Time of the Journey: </strong>{$_SESSION['departuretime']}</p>
          <p><strong>Bus Number: </strong>{$_SESSION['busnumber']}</p>
  </section>
  </main>
  <main>
   <section>
   <h3>Staff Information</h3>
   <p><strong>Conductor ID:</strong>{$_SESSION['conductorid']}</p>
   </section>
   </main>
   <main>
   <section>
        <h3>Fuel Expenses</h3>
        <p><strong>Fuel Expenses: </strong>{$_SESSION['fuelexpense']}</p>
        <p><strong>Date:</strong>{$_SESSION['datefuel']}</p>
      </section>
   </main>
   <main>
   <section>
   <h3>Other Expenses</h3>
   <p><strong>Date:</strong>{$_SESSION['date']}</p>
   <p><strong>Expense:</strong>{$_SESSION['expense']}</p>

   </section>
   </main>

  <div class='col-sm-4' style='text-align: right;'>
    <button type='submit' class='btn btn-primary' style='background-color: #000032; color: white; padding: 6px 8px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 0 2px 10px; cursor: pointer; border-radius: 6px;' name='export' style='margin-right: -650px;'>Export PDF</button>
</div>
<form>";
        echo $html;
      } else {
        echo "Schedule not found.";
      }
    }
    ?>
  </form>
  <!--export PDF button-->
  </div>
</body>
<!--footer-->

</html>