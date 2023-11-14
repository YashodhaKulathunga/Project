<?php
$serevername = "localhost";
$dbUser = "root";
$dbpw = "";
$dbName = "db1";

$conn = mysqli_connect($serevername, $dbUser, $dbpw, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
