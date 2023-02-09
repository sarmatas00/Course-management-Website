<?php include 'db.php'; ?> 
<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
        <?php
            $id = $_GET['id'];
            $sql = "SELECT login,role FROM users WHERE id='" . $id . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $login = $row['login'];
                $role = $row['role'];
            }
        ?>
        <input type="text" value="<?=$id?>" name="id" hidden/>
            
        <p>
              <span>Email: </span><input type="email" name="login" value="<?=$login?>" required />
            </p>
            <p>
            <fieldset>
                <legend>Τύπος χρήστη:</legend>
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

