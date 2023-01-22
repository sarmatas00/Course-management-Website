<?php include 'db.php'; ?> 

<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

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
      <h1>Αρχική</h1>
    </div>

    <div class="container">
      <div class="leftBox">
        <a href="index.php">Αρχική Σελίδα</a>
        <a href="announcement.php">Ανακοινώσεις</a>
        <a href="communication.php">Επικοινωνία</a>
        <a href="documents.php">Έγγραφα Μαθήματος</a>
        <a href="homework.php">Εργασίες</a>
      </div>
      <div class="rightBox">

      <?php 

}else{
 include 'validate.php'

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

     <form action="validate.php" method="post">

        <h2>Πιστοποίηση</h2>

        

        <label>Login</label>

        <input type="email" name="uname" placeholder="Email"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="Password"><br> 

        <button type="submit">Login</button>

     </form>

</body>

</html>
<?php

     exit();

}

 ?> 