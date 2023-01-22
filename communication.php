<?php include 'email.php'; ?> 
<?php include 'links.php'; ?> 


        <h2 class="heading2">Αποστολή e-mail μέσω web φόρμας</h2>
        <div class="content">
          <form action="email.php" method="post" enctype="multipart/form-data">
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
            <a href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a>
          </p>
        </div>
      </div>
    </div>
    <a href="logout.php">Log Out</a>
  </body>
</html>
