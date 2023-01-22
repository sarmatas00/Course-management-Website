<?php
include 'db.php';

$id = $_GET['id'];


$sql = "DELETE FROM documents WHERE id='" . $id . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header('Location: documents.php');
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>