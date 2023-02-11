<?php
#διαγραφη εγγραφου

include 'db.php';

$id = $_GET['id'];                      #το id που εχουμε περασει μεσω href


$sql = "DELETE FROM documents WHERE id='" . $id . "'";              #sql για διαγραφη της αναλογης εγγραφου
if (mysqli_query($conn, $sql)) {
    echo "Επιτυχης διαγραφη εγγραφου";                              #ανακατευθυνση στην σελιδα εγγραφων
    header('Location: documents.php');
    exit;
} else {
    echo "Error " . mysqli_error($conn);
}

?>