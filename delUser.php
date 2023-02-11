<?php
#διαγραφη χρηστη

include 'db.php';

$id = $_GET['id'];                          #το id του χρηστη που εχουμε περασει μεσω href


$sql = "DELETE FROM users WHERE id='" . $id . "'";                  #sql για διαγραφη του αναλογου χρηστη
if (mysqli_query($conn, $sql)) {
    echo "Επιτυχης διαγραφη χρηστη";                                #ανακατευθυνση στην σελιδα χρηστων
    header('Location: users.php');
    exit;
} else {
    echo "Error" . mysqli_error($conn);
}

?>