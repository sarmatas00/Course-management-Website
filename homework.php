<?php include 'upload.php'; ?> 
<?php include 'links.php'; ?> 

<?php if ($_SESSION['role']=='tutor') {?>
  <a href="newHome.php">Προσθήκη νέας εργασίας</a>
  <hr>

<?php } ?>

<?php
$sql = 'SELECT * FROM homework';
$result = mysqli_query($conn, $sql);
$homework = mysqli_fetch_all($result, MYSQLI_ASSOC);
$count=1;
?>

<?php if (empty($homework)): ?>
  <h2 class="heading2">Δεν υπαρχουν εργασιες</h2>
  <?php endif; ?>


  <?php foreach ($homework as $item): 
    ?>

        <h2 class="heading2">Εργασία <?php echo $count++?></h2>
        <?php if ($_SESSION['role']=='tutor') {
         $id=$item['id']?>
        
        <span>[<a href='delHome.php?id=<?=$id?>'>διαγραφή</a>]</span>
        <span>[<a href='editHome.php?id=<?=$id?>'>επεξεργασία</a>]</span>
      <?php }?>
                <div class="content">
                    <p><span>Στόχοι: </span>Οι στόχοι της εργασίας είναι <br>
                        <ol>

                            <?php $arr=explode(",",$item['goals']);
                            foreach($arr as $goal){?>
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
                            foreach($arr as $need){?>
                                <li><?php echo $need; ?></li>
                            <?php } ?>
                        </ol>
                    </p>
                    <p><span>Ημερομηνία Παράδοσης: </span><?php echo date_format(date_create($item['date']),' l jS F Y'); ?></p>

                    


                </div>
                <hr>
                
            <?php endforeach; ?>
                                        
            <a href="#top" id="up">&lt;top&gt;</a>
        </div>
    </div>
    
</body>
</html>
