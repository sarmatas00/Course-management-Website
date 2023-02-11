<?#τροποποιηση εγγραφου?>

<?php include 'db.php'; ?> 
<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">          <?#φορμα τροποποιησης?>
        <?php
            $id = $_GET['id'];
            $sql = "SELECT title,text FROM documents WHERE id='" . $id . "'";       #βρισκω το εγγραφο και αποθηκευω τα προηγουμενα στοιχει του
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $title = $row['title'];
                $text = $row['text'];
            }
        ?>
        <input type="text" value="<?=$id?>" name="id" hidden/>              <?#id εγγραφου για να περασει στο post request?>
            
            <p>
              <span>Τίτλος: </span><input type="text" name="title" value="<?=$title?>" required />        <?#τροποποιηση τιτλου?>
            </p>
            <p>
              <span>Περιγραφή: </span><input type="text" name="text" value="<?=$text?>" required />         <?#τροποποιηση περιγραφης?>
            </p>
            <input type="submit" name="updateDoc" value="Update">
          </form>