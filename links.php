<?php
#η αριστερη πλευρα της σελιδας με τα links που οδηγουν στις υπολοιπες
#το συμπεριλαμβανουμε σε ολες τις σελιδες
 include 'db.php'; ?> 

<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {                  #αν εχει επιτυχως συνδεθει καποιος χρηστης

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Αρχική</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="heading1">
      <h1>ΑΝΤΙΚΕΙΜΕΝΟΣΤΡΑΦΗΣ ΠΡΟΓΡΑΜΜΑΤΙΣΜΟΣ</h1>
    </div>

    <div class="container">
      <div class="leftBox">
        <a href="index.php">Αρχική Σελίδα</a>
        <a href="announcement.php">Ανακοινώσεις</a>
        <a href="communication.php">Επικοινωνία</a>
        <a href="documents.php">Έγγραφα Μαθήματος</a>
        <a href="homework.php">Εργασίες</a>
        <?php if ($_SESSION['role']=='tutor') {?>
          <a href="users.php">Χρήστες</a>
        <?php } ?>
        <a href="logout.php" class="logout">Log Out</a>

      </div>
      <div class="rightBox">

      <?php 

}else{
 include 'validate.php'                             #αν δεν εχει κανει συνδεση καποιος χρηστης
                                                    #εμφανιζεται το login page στον χρηστη
  ?>
  <!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Αρχική</title>
    <link rel="stylesheet" href="login.css" />

</head>

<body>

     <form action="validate.php" method="post" class="login">

        <h2>ΠΙΣΤΟΠΟΙΗΣΗ</h2>
        <input type="email" name="uname" placeholder="Email"><br>

        <input type="password" name="password" placeholder="Password"><br> 

        <button type="submit">Login</button>

     </form>

</body>

</html>
<?php

     exit();

}

 ?> 