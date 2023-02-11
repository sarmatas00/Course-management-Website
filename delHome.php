<?php
#διαγραφη εργασιας

include 'db.php';

$id = $_GET['id'];                      #το id που εχουμε περασει μεσω href


$sql = "DELETE FROM homework WHERE id='" . $id . "'";                   #sql για διαγραφη της αναλογης εργασιας
if (mysqli_query($conn, $sql)) {
    echo "Επιτυχης διαγραφη εργασιας";
    header('Location: homework.php');                                   #ανακατευθυνση στην σελιδα εργασιων
    exit;
} else {
    echo "Error" . mysqli_error($conn);
}

?>