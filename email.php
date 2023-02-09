<?php
include 'db.php';


if (isset($_POST['send'])) { // if save button on the form is clicked
    session_start();
    $name = $_POST['name'];
    $context = $_POST['context'];
    $text = $_POST['text'];


    $sql = 'SELECT * FROM users';
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($announcements as $item):
        
            if($item['role']=='tutor'){
                $email = $item['login'];
                $headers = "From: '$name'";
                mail($email, $context, $text, $headers);
            }
    endforeach;
        

    header('Location: communication.php');
    exit;
}