<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $userID = $_POST["UserID"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contactNo = $_POST["contactNO"];
        $owner = $_POST["owner"];
        $cvv = $_POST["cvv"];
        $cardNumber = $_POST["cardNumber"];
        $expiryMonth = $_POST["months"];
        $expiryYear = $_POST["years"];

        // Step 1: Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            echo ("Connection failed: " . $conn->connect_error);
        }
        // Step 3: Generate Ticket_ID automatically (as previously shown)
        $sql = "UPDATE randomuser
                SET Name = '$name', Email = '$email', ContactNO='$contactNo', Owner = '$owner', CVV = '$cvv', CardNumber = '$cardNumber', ExpiryMonth = '$expiryMonth', Expiryyear = '$expiryYear'
                WHERE RUserID = '$userID'";

        if ($conn->query($sql) === TRUE) {
            header("Location: http://localhost/Project01-JourneyEase/Source%20Files/CommanUser/generateTicket.php?var=$userID");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>

</html>