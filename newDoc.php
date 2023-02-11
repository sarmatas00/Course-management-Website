<?#φορμα προσθηκης νεου εγγραφου?>


<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
            
            <p>
            <span>Τίτλος: </span><input type="text" name="title" required />
            </p>
            <p>
              <span>Περιγραφή: </span><input type="text" name="text" required />
            </p>
            <input type="file" name="file">

            <input type="submit" name="submit" value="Upload">
          </form>