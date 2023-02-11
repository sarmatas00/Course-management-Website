<?#σελιδα επικοινωνιας?>

<?php include 'email.php'; ?> 
<?php include 'links.php'; ?> 
<?php include 'db.php'; ?> 



        <h2 class="heading2">Αποστολή e-mail μέσω web φόρμας</h2>       
        <div class="content">
          <form action="email.php" method="post" enctype="multipart/form-data">     <?#η αποστολη μηνυματος μεσω φορμας, συνδεεται με το αναλογο script?>
            <p>
              <span>Αποστολέας: </span
              ><input type="text" name="name" required />
            </p>
            <p>
              <span>Θέμα: </span><input type="text" name="context" required />
            </p>
            <p>
              <span>Κείμενο: </span><input type="text" name="text" required />
            </p>
            <input type="submit" name="send" value="Send">
          </form>
        </div>
        <hr />
        <h2 class="heading2">Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
        <div class="content">
          <p>
            Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση
            ηλεκτρονικού ταχυδρομείου

            <?php $sql = 'SELECT * FROM users WHERE role="tutor"';                  #το συνολο των tutors απο την βαση?>
            <?php $result = $conn->query($sql);?>
            <?php $row = $result->fetch_assoc();?>
            <?php $mail=$row['login'];?>
            

            <a href="mailto:tutor@csd.auth.test.gr"><?=$mail?></a>       <?#εμφανιζω το mail του 1ου tutor ως παραδειγμα για την αποστολη mail απευθειας σε αυτον?>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
