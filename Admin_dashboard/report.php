<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    header {
      background-color: #007bff;
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
      background-color: #AEB1B0;
      padding: 1.5rem;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
    }

    h2 {
      margin-top: 0;
      border-bottom: 2px solid #007bff;
      padding-bottom: 0.5rem;
    }

    strong {
      font-weight: bold;
    }

    .btn {

      height: 40px;
      width: 200px;
      margin-top: 50px;
      color: #007bff;

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
  <header>
    <h1>Bus Journey Report</h1>
  </header>

  <main>
    <form>
      <section>
        
        <h2>Journey Information</h2>
        <p><strong>Date and Time of Journey:</strong> [Date and Time]</p>
        <p><strong>Route:</strong> Badulla to Colombo</p>
        <p><strong>Bus Number:</strong> [Bus ID]</p>
        <div class="col-4">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      </section>

      <section>
        <h2>Passenger and Revenue Metrics</h2>
        <p><strong>Total Passengers:</strong> [Passenger Count]</p>
        <p>
          <strong>Average Revenue per Passenger:</strong> [Revenue per
          Passenger]
        </p>
        <div class="col-4">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </section>

      <section>
        <h2>Fuel Expenses</h2>
        <p><strong>Fuel Expenses:</strong> [Fuel Expenses]</p>
        <table class="table table-bordered">
           <tr>
               <td>
                   <label>From Date </label>
               </td>
               <td>
                   <label>Bus ID </label>
               </td>
               <td></td>
           </tr>
           <tr>
            <td>
               <input type="date" name="date" id="date" class="form-control mt-3" placeholder="Appoint Date" aria-label="Departure Date" aria-describedby="basic-addon1">
            </td>
            <td>
              <input type="text" name="busId" id="busId" placeholder="BUS0000">
            </td>
            <td>
              <input  type="submit" name="pdf" id="pdf" value="PDF">
            </td>
           </tr>
        </table>
      </section>

      <section>
        <h2>Other Expenses</h2>
        <p><strong>Other Expenses:</strong> [Other Expenses]</p>
        <div class="col-4">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </section>

      <section>
        <h2>Staff Information</h2>
        <p><strong>Driver:</strong> [Driver Name & Driver ID]</p>
        <p><strong>Conductor:</strong> [Conductor Name & Conductor ID]</p>
        <div class="col-4">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </section>
    </form>
  </main>
</body>

</html>
