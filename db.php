<?php
#συνδεση στη βαση δεδομενων


$servername = "webpagesdb.it.auth.gr:3306";
$username = "spiros";
$password = "12345678";
$dbname = "sarmatas";



$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {                       #αποτυχια συνδεσης
    die("Connection failed: " . mysqli_connect_error());
}




?>