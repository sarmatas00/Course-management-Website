<?#σελιδα εγγραφων?>

<?php include 'upload.php'; ?> 
<?php include 'links.php'; ?> 


<?php if ($_SESSION['role']=='tutor') {?>             <?#αν εχει συνδεθει καθηγητης μπορει να προσθεσει εγγραφο?>
  <a href="newDoc.php">Προσθήκη νέου εγγράφου</a>
  <hr>

<?php }?>


<?php
$sql = 'SELECT * FROM documents';                   #φερνουμε ολα τα εγγραφα απο βαση
$result = mysqli_query($conn, $sql);
$documents = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (empty($documents)): ?>                    <?#εμφανιζεται μηνυμα αν δεν υπαρχουν εγγραφα?>
  <h2 class="heading2">Δεν υπαρχουν εγγραφα</h2>
  <?php endif; ?>


  <?php foreach ($documents as $item): ?>           <?#για καθε εγγραφο, εμφανιση ?>
    

   <h2 class="heading2"><?php echo $item['title']; ?> </h2>
      <?php if ($_SESSION['role']=='tutor') {                     #αν καθηγητης, εμφανιζονται επιλογες διαγραφης και τροποποιησης
         $id=$item['id']?>
        
        <span>[<a href='delDoc.php?id=<?=$id?>'>διαγραφή</a>]</span>
        <span>[<a href='editDoc.php?id=<?=$id?>'>επεξεργασία</a>]</span>
      <?php }?>
        <div class="content">
          <p><span>Περιγραφή: </span><?php echo $item['text']; ?></p>
          <a href="documents.php?file_id=<?php echo $item['id'] ?>">Download</a>         <?php #κατεβασμα εγγραφου?>
        </div>
        <hr />
  <?php endforeach; ?>




        <a href="#top" id="up">&lt;top&gt;</a>                              <?#επιλογη top που παει στην αρχη της σελιδας?>
      </div>
    </div>
  </body>
</html>
