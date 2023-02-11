<?php
#βασικο script που χειριζεται σχεδον ολη την αλληλεπιδραση με την βαση για καθε λειτουργια της σελιδας

include 'db.php'; 


if (isset($_POST['uploadHome'])) {              #ανεβασμα εργασιας
    $filename = $_FILES['file']['name'];
    $goals = $_POST['goals'];
    $needs = $_POST['needs'];
    $date = $_POST['date'];
    

    #τοποθεσια του αρχειου στον σερβερ (φακελος uploads)
    $destination = 'uploads/' . $filename;

    #παιρνουμε το file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['doc', 'docx'])) {                               #πρεπει να ειναι αρχειο doc η docx
        echo "Το αρχειο πρεπει να ειναι .doc ή .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) {                            #το αρχειο να μην ειναι πολυ μεγαλο
        echo "Πολυ μεγαλο αρχειο";
    } else {
        #μεταφορα του προσωρινου αρχειου στην ζητουμενη τοποθεσια
        if (move_uploaded_file($file, $destination)) {
            #προσθηκη νεας εργασιας στην βαση, με description το ονομα του αρχειου στον φακελο
            $sql = "INSERT INTO homework (goals,description,needs,date) VALUES ('$goals','$filename','$needs','$date')";
            if (mysqli_query($conn, $sql)) {
                $sql2="SELECT COUNT(*) from homework";                          #αριθμος εργασιων στη βαση
                $result2 = mysqli_query($conn, $sql2);
                $row=mysqli_fetch_array($result2);
                $dateNow= date('Y-m-d H:i:s');
                $context = 'Υποβλήθηκε η εργασία ' . $row[0];
                $text = 'Η ημερομηνία παράδοσης της εργασίας είναι ' . $date;
                $location = 'homework';
            
                newAnnouncement($dateNow, $context, $text, $location, $conn);           #καθε φορα που προστιθεται νεα εργασια, προστιθεται και ανακοινωση
            }
        } else {
            echo "Error";
        }
    }
}



#ανεβασμα νεου εγγραφου στη βαση
if (isset($_POST['submit'])) { 
    $filename = $_FILES['file']['name'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    

    #τοποθεσια αρχειου εγγραφου
    $destination = 'uploads/' . $filename;

    #παιρνουμε το file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    #προσωρινο μερος αποθηκευσης
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['doc', 'docx'])) {
        echo "Το αρχειο πρεπει να ειναι της μορφης .doc η .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { 
        echo "Το αρχειο ειναι πολυ μεγαλο";
    } else {
        #μεταφορα προσωρινου αρχειου στην ζητουμενη τοποθεσια
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO documents (title,text,filename) VALUES ('$title','$text','$filename')";
            if (mysqli_query($conn, $sql)) {
                echo "Επιτυχης ανεβασμα";
                header('Location: documents.php');
                exit;
            }
        } else {
            echo "Error";
        }
    }
}


#ληψη εργασιας απο την βαση
if (isset($_GET['file_id']) && isset($_GET['page'])) {
    $id = $_GET['file_id'];

    #φερνουμε την συγκεκριμενη εργασια απο τη βαση
    $sql = "SELECT * FROM homework WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['description'];          #ονομα αρχειου στον φακελο uploads

    if (file_exists($filepath)) {                       #αν υπαρχει το αρχειο το κατεβαζει τοπικα
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['filename']));
        readfile('uploads/' . $file['filename']);

        exit;
    }

}


#ληψη εγγραφου απο την βαση
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    #φερνουμε το συγκεκριμενο εγγραφο απο τη βαση
    $sql = "SELECT * FROM documents WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['filename'];                 #ονομα αρχειου στον φακελο uploads

    if (file_exists($filepath)) {                           #αν υπαρχει το αρχειο το κατεβαζει τοπικα
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['filename']));
        readfile('uploads/' . $file['filename']);

        exit;
    }

}


#προσθηκη νεας ανακοινωσης στη βαση
if (isset($_POST['upload'])) { 
    
    $date= date('Y-m-d H:i:s');
    $context = $_POST['context'];
    $text = $_POST['text'];
    $location = 'announcement';                 #σελιδα ανακατευθυνσης

    newAnnouncement($date, $context, $text, $location, $conn);
    
}


#προσθηκη νεου χρηστη στη βαση
if (isset($_POST['uploadUser'])) { 
    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $name = $_POST['name'];

    $sql = "INSERT INTO users (login,password,role,name) VALUES ('$login','$password','$role','$name')";
    if (mysqli_query($conn, $sql)) {
        echo "Ο χρήστης προστεθηκε με επιτυχια";
        header('Location: users.php');                      #ανακατευθυνση στην σελιδα χρηστων
        exit;
    }
    else {
        echo "Error";
    }
    
}


#βοηθητικη συναρτηση για προσθηκη ανακοινωσης, που χρησιμοποιειται σε νεα ανακοινωση και νεα εργασια
function newAnnouncement($date,$context,$text,$location,$conn){
    $sql = "INSERT INTO announcements (date,context,text) VALUES ('$date','$context','$text')";
    if (mysqli_query($conn, $sql)) {
        echo "Επιτυχης προσθηκη ανακοινωσης";
        header('Location:' . $location . '.php');               #ανακατευθυνση ειτε στη σελιδα ανακοινωσεων ειτε στη σελιδα εργασιων
        exit;
    }
    else {
        echo "Error";
    }
}


#τροποποιηση ανακοινωσης
if (isset($_POST['updateAnn'])) { 
    
    $id = $_POST['id'];
    $context = $_POST['context'];
    $text = $_POST['text'];
    $sql = "UPDATE announcements SET context='$context' ,text='$text' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Επιτυχης τροποποιηση ανακοινωσης";
                header('Location: announcement.php');           #ανακατευθυνση στη σελιδα ανακοινωσεων
                exit;
            }
        else {
            echo "Error";
        }
}


#τροποποιηση εγγραφου
if (isset($_POST['updateDoc'])) { 
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $sql = "UPDATE documents SET title='$title' ,text='$text' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Επιτυχης τροποποιηση εγγραφου";
                header('Location: documents.php');          #ανακατευθυνση στη σελιδα εγγραφων
                exit;
            }
        else {
            echo "Error";
        }
}


#τροποποιηση χρηστη
if (isset($_POST['updateUser'])) { 
    
    $id = $_POST['id'];
    $login = $_POST['login'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $sql = "UPDATE users SET login='$login' ,role='$role', name='$name' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Επιτυχης τροποποιηση χρηστη";
                header('Location: users.php');          #ανακατευθυνση στη σελιδα χρηστων
                exit;
            }
        else {
            echo "Error";
        }
}


#τροποποιηση εργασιας
if (isset($_POST['updateHome'])) { 
    
    $id = $_POST['id'];
    $goals = $_POST['goals'];
    $needs = $_POST['needs'];
    $date = $_POST['date'];
    $sql = "UPDATE homework SET goals='$goals' ,needs='$needs' ,date='$date' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Επιτυχης τροποποιηση εργασιας";
                #επειτα προσθετουμε νεα ανακοινωση σχετικα με την τροποποιηση της εργασιας με τα νεα δεδομενα
                $sql2="SELECT COUNT(*) from homework";
                $result2 = mysqli_query($conn, $sql2);
                $row=mysqli_fetch_array($result2);
                $dateNow= date('Y-m-d H:i:s');
                $context = 'Έγινε τροποποίηση της εργασίας ' . $row[0];
                $text = 'Η ημερομηνία παράδοσης της εργασίας είναι ' . $date;
                $location = 'homework';
            
                newAnnouncement($dateNow, $context, $text, $location, $conn);
                
            }
        else {
            echo "Error";
        }
}

?>