<?#σελιδα χρηστων που εμφανιζεται μονο για τους καθηγητες?>

<?php include 'links.php'; ?> 

<?php
$sql = 'SELECT * FROM users';                         #επιλεγουμε ολους τους χρηστες
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<a href="newUser.php">Προσθήκη νέου χρήστη</a>
<hr>
<?php
 $i=1;?>

<?php foreach ($users as $user):
     ?>
    
    

   <h3> <?php echo $i++; ?></h3>
      <?php $id=$user['id']?>
        
        <span>[<a href='delUser.php?id=<?=$id?>'>διαγραφή</a>]</span>               <?#επιλογες επεξεργασιας και διαγραφης?>
        <span>[<a href='editUser.php?id=<?=$id?>'>επεξεργασία</a>]</span>
      
        
          <p><span>Ονοματεπωνυμο: </span><?php echo $user['name']; ?></p>
          <p><span>Email: </span><?php echo $user['login']; ?></p>
          <p><span>Τύπος Λογαριασμού: </span><?php echo $user['role']; ?></p>
          
        
        <hr />
  <?php endforeach; ?>