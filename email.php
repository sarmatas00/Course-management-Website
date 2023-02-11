<?php
#script που στελνει email στους καθηγητες, οταν καποιος χρησιμοποιησει την φορμα επικοινωνιας

include 'db.php';


if (isset($_POST['send'])) {                    #ληψη κειμενων επικοινωνιας
    session_start();
    $name = $_POST['name'];
    $context = $_POST['context'];
    $text = $_POST['text'];


    $sql = 'SELECT * FROM users';
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($users as $item):                                 #για καθε χρηστη στη βαση                  
        
            if($item['role']=='tutor'){                         #αν ειναι καθηγητης
                $email = $item['login'];
                $headers = "From: '$name'";
                mail($email, $context, $text, $headers);            #στελνουμε mail τα περιεχομενα της φορμας επικοινωνιας
            }
    endforeach;
        

    header('Location: communication.php');                      #ανακατευθυνση πισω στην σελιδα επικοινωνιας
    exit;
}