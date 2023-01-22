<?php include 'links.php'; ?> 

<?php
$sql = 'SELECT * FROM announcements';
$result = mysqli_query($conn, $sql);
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if ($_SESSION['role']=='tutor') {?>
  <a href="newAnnouncement.php">Προσθήκη νέας ανακοινώσης</a>
  <hr>

<?php }?>

<?php if (empty($announcements)): ?>
  <h2 class="heading2">Δεν υπαρχουν ανακοινωσεις</h2>
  <?php endif; ?>


  <?php foreach ($announcements as $item):
    $i=1; ?>
    
    

   <h2 class="heading2">Ανακοίνωση <?php echo $i++; ?></h2>
      <?php if ($_SESSION['role']=='tutor') {
         $id=$item['id']?>
        
        <span>[<a href='delAnnouncement.php?id=<?=$id?>'>διαγραφή</a>]</span>
        <span>[<a href='editAnnouncement.php?id=<?=$id?>'>επεξεργασία</a>]</span>
      <?php }?>


        <div class="content">
          <p><span>Ημερομηνία: </span><?php echo date_format(date_create($item['date']),' l jS F Y'); ?></p>
          <p><span>Θέμα: </span><?php echo $item['context']; ?></p>
          <p><?php echo $item['text']; ?></p>
        </div>
        <hr />
  <?php endforeach; ?>

        <a href="#top" id="up">&lt;top&gt;</a>
      </div>
    </div>
    <a href="logout.php">Log Out</a>
  </body>
</html>
