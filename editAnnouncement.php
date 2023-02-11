<?#τροποποιηση ανακοινωσης?>

<?php include 'db.php'; ?> 
<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
        <?php
            $id = $_GET['id'];
            $sql = "SELECT context,text FROM announcements WHERE id='" . $id . "'";         #βρισκω την συγκεκριμενη ανακοινωση που θελει τροποποιηση
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $context = $row['context'];                                 #αποθηκευση των περιεχομενων της
                $text = $row['text'];
            }
        ?>
        <input type="text" value="<?=$id?>" name="id" hidden/>              <?#κρυφο input απλα για αποθηκευση του id της ανακοινωσης για να γινει post με την φορμα?>
            
            <p>
              <span>Θέμα: </span><input type="text" name="context" value="<?=$context?>" required />      <?#τροποποιηση παροντος θεματος?>
            </p>
            <p>
              <span>Κείμενο: </span><input type="text" name="text" value="<?=$text?>" required />         <?#τροποποιηση παροντος κειμενου?>
            </p>
            <input type="submit" name="updateAnn" value="Update">
          </form>


