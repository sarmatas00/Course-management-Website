<?php
#διαγραφη ανακοινωσης

include 'db.php';

$id = $_GET['id'];                  #το id που εχουμε περασει μεσω href


$sql = "DELETE FROM announcements WHERE id='" . $id . "'";          #sql για διαγραφη της αναλογης ανακοινωσης
if (mysqli_query($conn, $sql)) {
    echo "Επιτυχης διαγραφη ανακοινωσης";
    header('Location: announcement.php');                           #ανακατευθυνση στην σελιδα ανακοινωσεων
    exit;
} else {
    echo "Error" . mysqli_error($conn);
}

?>