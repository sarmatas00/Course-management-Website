<?#σελιδα εργασιων?>

<?php include 'upload.php'; ?> 
<?php include 'links.php'; ?> 

<?php if ($_SESSION['role']=='tutor') {?>               <?#αν εχει συνδεθει καθηγητης, μπορει να προσθεσει εργασια?>
  <a href="newHome.php">Προσθήκη νέας εργασίας</a>
  <hr>

<?php } ?>

<?php
$sql = 'SELECT * FROM homework';                    #φερνω ολες τις εργασιες απο βαση
$result = mysqli_query($conn, $sql);
$homework = mysqli_fetch_all($result, MYSQLI_ASSOC);
$count=1;                                           #μετρητης για απαριθμηση εργασιων
?>

<?php if (empty($homework)): ?>                        <?#αναλογο μηνυμα αν δεν υπαρχουν εργασιες?>
  <h2 class="heading2">Δεν υπαρχουν εργασιες</h2>
  <?php endif; ?>


  <?php foreach ($homework as $item):                   #για καθε εργασια
    ?>

        <h2 class="heading2">Εργασία <?php echo $count++?></h2>
        <?php if ($_SESSION['role']=='tutor') {                         #επιλογες τροποποιησης και διαγραφης αν καθηγητης
         $id=$item['id']?>
        
        <span>[<a href='delHome.php?id=<?=$id?>'>διαγραφή</a>]</span>
        <span>[<a href='editHome.php?id=<?=$id?>'>επεξεργασία</a>]</span>
      <?php }?>
                <div class="content">
                    <p><span>Στόχοι: </span>Οι στόχοι της εργασίας είναι <br>
                        <ol>

                            <?php $arr=explode(",",$item['goals']);                     #οι στοχοι της εργασιας που εχουμε αποθηκευσει με κομμα σε μια μεταβλητη 
                            foreach($arr as $goal){?>                                   <?#παρουσιαζονται στην μορφη λιστας με καθε li εναν στοχο?>
                                <li><?php echo $goal; ?></li>
                            <?php } ?>
                        </ol>
                    </p>
                    <p><span>Εκφώνηση: <br></span>
                        Κατεβάστε την εκφώνηση της εργασίας από <a href="homework.php?file_id=<?php echo $item['id'] ?>&page='home'">εδώ</a>
                    </p>
                    <p><span>Παραδοτέα: </span><br>
                        <ol>
                            <?php $arr=explode(",",$item['needs']);                         
                            foreach($arr as $need){?>                                   <?#οι στοχοι της εργασιας που εχουμε αποθηκευσει με κομμα σε μια μεταβλητη?> 
                                <li><?php echo $need; ?></li>                           <?#παρουσιαζονται στην μορφη λιστας με καθε li εναν στοχο?>
                            <?php } ?>
                        </ol>
                    </p>
                    <p><span>Ημερομηνία Παράδοσης: </span><?php echo date_format(date_create($item['date']),' l jS F Y'); ?></p>

                    


                </div>
                <hr>
                
            <?php endforeach; ?>
                                        
            <a href="#top" id="up">&lt;top&gt;</a>                                      <?#επιλογη top που οδηγει στην κορυφη της σελιδας?>
        </div>
    </div>
    
</body>
</html>
