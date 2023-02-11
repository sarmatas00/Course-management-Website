<?#τροποποιηση χρηστη?>

<?php include 'db.php'; ?> 
<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
        <?php
            $id = $_GET['id'];
            $sql = "SELECT login,role,name FROM users WHERE id='" . $id . "'";               #βρισκω τον χρηστη και αποθηκευω τα τωρινα στοιχεια του
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $login = $row['login'];
                $role = $row['role'];
                $name = $row['name'];
            }
        ?>
        <input type="text" value="<?=$id?>" name="id" hidden/>                  <?#id χρηστη για χρηση στη συνεχεια?>
            
            <p>
              <span>Email: </span><input type="email" name="login" value="<?=$login?>" required />          <?#τροποποιηση email?>
            </p>
            <p>
              <span>Ονοματεπωνυμο: </span><input type="text" name="name" value="<?=$name?>" required />          <?#τροποποιηση ονοματος?>
            </p>
            <p>
            <fieldset>
                <legend>Τύπος χρήστη:</legend>                      <?#τροποποιηση ειδους χρηστη, με την τιμη που ειχε αρχικα να ειναι προεπιλεγμενη?>
                <div>
                    <input type="radio" name="role" value="student" <?php if($role=='student'){?>checked<?php }?> />
                    <label >Φοιτητής</label>
                    <input type="radio" name="role" value="tutor" <?php if($role=='tutor'){?>checked<?php }?> />
                    <label >Καθηγητής</label>
                </div>
            </fieldset>
            </p>
            <input type="submit" name="updateUser" value="Update">
          </form>

