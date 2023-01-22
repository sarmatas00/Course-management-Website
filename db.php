<?php

// Connect to the database
$servername = "localhost";
$username = "csdDB";
$password = "123456";
$dbname = "csd";



$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




?>