<?#φορμα προσθηκης νεας ανακοινωσης?>

<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
            
            <p>
              <span>Θέμα: </span><input type="text" name="context" required />
            </p>
            <p>
              <span>Κείμενο: </span><input type="text" name="text" required />
            </p>
            <input type="submit" name="upload" value="Upload">
          </form>