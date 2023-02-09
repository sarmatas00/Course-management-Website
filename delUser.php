<?php
include 'db.php';

$id = $_GET['id'];


$sql = "DELETE FROM users WHERE id='" . $id . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header('Location: users.php');
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>