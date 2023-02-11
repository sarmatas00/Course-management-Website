<?#βοηθητικο script για την πιστοποιηση ενος χρηστη που κανει συνδεση στη σελιδα?>

<?php include 'db.php'?>
<?php 

 
session_start();


if (isset($_POST['uname']) && isset($_POST['password'])) {              #παιρνω username και password

    function validate($data){                                           #μορφοποιηση απο τυχον ειδικους χαρακτηρες
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {                                        #αν δεν εχει εισαχθει ονομα
        header("Location: index.php?error=User Name is required");
        exit();

    }else if(empty($pass)){                                     #αν δεν εχει εισαχθει κωδικος
        header("Location: index.php?error=Password is required");
        exit();
    }else{

        $sql = "SELECT * FROM users WHERE login='$uname' AND password='$pass'";             #ελεγχουμε αν υπαρχει στη βαση χρηστης με τετοιο ονομα και κωδικο
        $result = mysqli_query($conn, $sql);                                    
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['login'] === $uname && $row['password'] === $pass) {
            #επιτυχης συνδεση, βαζουμε στο νεο session τα στοιχεια του χρηστη που μολις συνδεθηκε
                $_SESSION['user_name'] = $row['login'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                header("Location: index.php");
                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password '$uname'");
                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password");
            exit();

        }

    }

}else{

    
    // header("Location: index.php?error=Incorect User name or password");
    // exit();

}