<?php include 'db.php'; ?> 
<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
        <?php
            $id = $_GET['id'];
            $sql = "SELECT context,text FROM announcements WHERE id='" . $id . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $context = $row['context'];
                $text = $row['text'];
            }
        ?>
        <input type="text" value="<?=$id?>" name="id" hidden/>
            
            <p>
              <span>Θέμα: </span><input type="text" name="context" value="<?=$context?>" required />
            </p>
            <p>
              <span>Κείμενο: </span><input type="text" name="text" value="<?=$text?>" required />
            </p>
            <input type="submit" name="update" value="Update">
          </form>


