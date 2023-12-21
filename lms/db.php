<?php

$servername = "localhost";
$dbusername = "root";
$password = "";
$database = "alhikmahdb";

// Create Connection
$conn = mysqli_connect($servername, $dbusername, $password, $database);

// Check Connection
if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}

?>