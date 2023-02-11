<?php #σελιδα ανακοινωσεων?>

<?php include 'links.php'; ?> 

<?php
$sql = 'SELECT * FROM announcements';                      #ολες οι ανακοινωσεις απο την βαση
$result = mysqli_query($conn, $sql);
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if ($_SESSION['role']=='tutor') {?>                   <?#αν εχει συνδεθει tutor γινεται ορατη η προσθηκη ανακοινωσης?>
  <a href="newAnnouncement.php">Προσθήκη νέας ανακοινώσης</a>
  <hr>

<?php } $i=1;?>

<?php if (empty($announcements)): ?>                          αν δεν υπαρχουν ανακοινωσεις εμφανιζεται το αναλογο μηνυμα
  <h2 class="heading2">Δεν υπαρχουν ανακοινωσεις</h2>
  <?php endif; ?>


  <?php foreach ($announcements as $item):                      #για καθε ανακοινωση της βασης
     ?>
    
    

   <h2 class="heading2">Ανακοίνωση <?php echo $i++; ?></h2>         <?php #με το i απαριθμουμε τις ανακοινωσεις?>
      <?php if ($_SESSION['role']=='tutor') {                        #αν ειναι καθηγητης, ανοιγουν οι επιλογες της τροποποιησης και διαγραφης
         $id=$item['id']?>
        
        <span>[<a href='delAnnouncement.php?id=<?=$id?>'>διαγραφή</a>]</span>             <?php #περναμε το id της ανακοινωσης προς διαγραφη?>
        <span>[<a href='editAnnouncement.php?id=<?=$id?>'>επεξεργασία</a>]</span>
      <?php }?>


        <div class="content">                 <?php #εμφανιση ανακοινωσης?>
          <p><span>Ημερομηνία: </span><?php echo date_format(date_create($item['date']),' l jS F Y'); ?></p>
          <p><span>Θέμα: </span><?php echo $item['context']; ?></p>
          <p><?php echo $item['text']; ?></p>
        </div>
        <hr />
  <?php endforeach; ?>

        <a href="#top" id="up">&lt;top&gt;</a>              <?php #επιλογη top που παει στην αρχη της σελιδας?>
      </div>
    </div>
  </body>
</html>
 