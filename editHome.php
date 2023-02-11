<?#τροποποιηση εργαιας?>

<?php include 'db.php'; ?> 
<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">        <?#φορμα τροποποιησης?>
        <?php
            $id = $_GET['id'];
            $sql = "SELECT goals,needs,date FROM homework WHERE id='" . $id . "'";        #βρισκω την συγκεκριμενη εργασια και αποθηκευω τα στοιχεια της
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $goals = $row['goals'];
                $needs = $row['needs'];
                $date = $row['date'];
            }
        ?>
        <input type="text" value="<?=$id?>" name="id" hidden/>                <?#id εργασιας για να περασει στο post request?>
            
            <p>
              <span>Στόχοι : </span><input type="text" name="goals" value="<?=$goals?>" required />     <?#τροποποιηση στοχων εργασιας?>
              <br><label for="goals">Παραθέστε τους στόχους της εργασίας χωρισμένους με κομμα (,)</label>
            </p>
            <p>
              <span>Παραδοτέα: </span><input type="text" name="needs" value="<?=$needs?>" required />       <?#τροποποιηση παραδοτεων εργασιας?>
              <br><label for="needs">Παραθέστε τα παραδοτέα της εργασίας χωρισμένα με κομμα (,)</label>
            </p>
            <p>
              <span>Ημερομηνία παράδοσης: </span><input type="date" name="date" value="<?=$date?>" required />      <?#τροποιηση ημερομηνιας παραδοσης εργασιας?>
            </p>
            <input type="submit" name="updateHome" value="Update">
          </form>


          