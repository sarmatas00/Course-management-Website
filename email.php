<?php
include 'db.php'; 


if (isset($_POST['send'])) { // if save button on the form is clicked
    session_start();
    $name = $_POST['name'];
    $context = $_POST['context'];
    $text = $_POST['text'];

    // $sql = "INSERT INTO emails (name,context,text) VALUES ('$name','$context','$text')";
    //         if (mysqli_query($conn, $sql)) {
    //             echo "File uploaded successfully";
    //             header('Location: communication.php');
    //         }
    //     else {
    //         echo "Failed to upload file.";
    //     }

    $email = $_SESSION['user_name'];
    $headers="From: '$name'";
    mail($email, $context, $text, $headers);
    header('Location: communication.php');
    exit;
    // exit;
    // // name of the uploaded file
    // $filename = $_FILES['file']['name'];
    

    // // destination of the file on the server
    // $destination = 'uploads/' . $filename;

    // // get the file extension
    // $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // // the physical file on a temporary uploads directory on the server
    // $file = $_FILES['file']['tmp_name'];
    // $size = $_FILES['file']['size'];

    // if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
    //     echo "You file extension must be .zip, .pdf or .docx";
    // } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
    //     echo "File too large!";
    // } else {
    //     // move the uploaded (temporary) file to the specified destination
    //     if (move_uploaded_file($file, $destination)) {
    //         $sql = "INSERT INTO documents (title,text,filename) VALUES ('bg','gg','$filename')";
    //         if (mysqli_query($conn, $sql)) {
    //             echo "File uploaded successfully";
    //             header('Location: documents.php');
    //         }
    //     } else {
    //         echo "Failed to upload file.";
    //     }
    // }
}
