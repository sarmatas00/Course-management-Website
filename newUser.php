<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
            
            <p>
              <span>Email: </span><input type="email" name="login" required />
            </p>
            <p>
              <span>Κωδικός: </span><input type="password" name="password" required />
            </p>
            <p>
            <fieldset>
                <legend>Τύπος χρήστη:</legend>
                <div>
                    <input type="radio" name="role" value="student" checked/>
                    <label >Φοιτητής</label>
                
                    <input type="radio" name="role" value="tutor" />
                    <label >Καθηγητής</label>
                
                </div>
            </fieldset>
            </p>
            <input type="submit" name="uploadUser" value="Upload">
          </form>