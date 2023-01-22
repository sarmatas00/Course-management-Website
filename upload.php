<?php
include 'db.php'; 


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
    
    $context = $_POST['context'];
    $text = $_POST['text'];

    $sql = "INSERT INTO announcements (context,text) VALUES ('$context','$text')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header('Location: announcement.php');
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
    echo $sql;
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
                header('Location: documents.php');
                exit;
            }
        else {
            echo "Failed to upload file.";
        }
}

?>