<?php
include 'db.php'; 


if (isset($_POST['uploadHome'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['file']['name'];
    $goals = $_POST['goals'];
    $needs = $_POST['needs'];
    $date = $_POST['date'];
    

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['doc', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO homework (goals,description,needs,date) VALUES ('$goals','$filename','$needs','$date')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";

                $sql2="SELECT COUNT(*) from homework";
                $result2 = mysqli_query($conn, $sql2);
                $row=mysqli_fetch_array($result2);
                $dateNow= date('Y-m-d H:i:s');
                $context = 'Υποβλήθηκε η εργασία ' . $row[0];
                $text = 'Η ημερομηνία παράδοσης της εργασίας είναι ' . $date;
                $location = 'homework';
            
                newAnnouncement($dateNow, $context, $text, $location, $conn);
                // header('Location: homework.php');
                // exit;
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}




if (isset($_POST['submit'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['file']['name'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['doc', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO documents (title,text,filename) VALUES ('$title','$text','$filename')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header('Location: documents.php');
                exit;
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}


// Downloads files
if (isset($_GET['file_id']) && isset($_GET['page'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM homework WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['description'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['filename']));
        readfile('uploads/' . $file['filename']);

        // // Now update downloads count
        // $newCount = $file['downloads'] + 1;
        // $updateQuery = "UPDATE documents SET downloads=$newCount WHERE id=$id";
        // mysqli_query($conn, $updateQuery);
        exit;
    }

}


if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM documents WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['filename'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['filename']));
        readfile('uploads/' . $file['filename']);

        // // Now update downloads count
        // $newCount = $file['downloads'] + 1;
        // $updateQuery = "UPDATE documents SET downloads=$newCount WHERE id=$id";
        // mysqli_query($conn, $updateQuery);
        exit;
    }

}



if (isset($_POST['upload'])) { // if save button on the form is clicked
    
    $date= date('Y-m-d H:i:s');
    $context = $_POST['context'];
    $text = $_POST['text'];
    $location = 'announcement';

    newAnnouncement($date, $context, $text, $location, $conn);
    
}


if (isset($_POST['uploadUser'])) { // if save button on the form is clicked
    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (login,password,role) VALUES ('$login','$password','$role')";
    if (mysqli_query($conn, $sql)) {
        echo "File uploaded successfully";
        header('Location: users.php');
        exit;
    }
    else {
        echo "Failed to upload file.";
    }
    
}


function newAnnouncement($date,$context,$text,$location,$conn){
    $sql = "INSERT INTO announcements (date,context,text) VALUES ('$date','$context','$text')";
    if (mysqli_query($conn, $sql)) {
        echo "File uploaded successfully";
        header('Location:' . $location . '.php');
        exit;
    }
    else {
        echo "Failed to upload file.";
    }
}



if (isset($_POST['updateAnn'])) { // if save button on the form is clicked
    
    $id = $_POST['id'];
    $context = $_POST['context'];
    $text = $_POST['text'];
    $sql = "UPDATE announcements SET context='$context' ,text='$text' WHERE id='$id'";
    echo $sql;
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header('Location: announcement.php');
                exit;
            }
        else {
            echo "Failed to upload file.";
        }
}


if (isset($_POST['updateDoc'])) { // if save button on the form is clicked
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $sql = "UPDATE documents SET title='$title' ,text='$text' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header('Location: documents.php');
                exit;
            }
        else {
            echo "Failed to upload file.";
        }
}


if (isset($_POST['updateUser'])) { // if save button on the form is clicked
    
    $id = $_POST['id'];
    $login = $_POST['login'];
    $role = $_POST['role'];
    $sql = "UPDATE users SET login='$login' ,role='$role' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header('Location: users.php');
                exit;
            }
        else {
            echo "Failed to upload file.";
        }
}



if (isset($_POST['updateHome'])) { // if save button on the form is clicked
    
    $id = $_POST['id'];
    $goals = $_POST['goals'];
    $needs = $_POST['needs'];
    $date = $_POST['date'];
    $sql = "UPDATE homework SET goals='$goals' ,needs='$needs' ,date='$date' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";

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
            echo "Failed to upload file.";
        }
}

?>