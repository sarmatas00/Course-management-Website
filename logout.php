<?php 
#τερματισμος session εαν ο χρηστης επιλεξει logout/ αποσυνδεση


session_start();

session_unset();

session_destroy();

header("Location: index.php");

exit;
?>