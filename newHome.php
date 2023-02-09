<?php include 'links.php'; ?> 


<form action="upload.php" method="post" enctype="multipart/form-data">
            <p>
              <span>Στόχοι: </span><input type="text" name="goals" required />
              <br><label for="goals">Παραθέστε τους στόχους της εργασίας χωρισμένους με κομμα (,)</label>
            </p>
            <p>
              <span>Εκφώνηση: </span><input type="file" name="file">
            </p>
            <p>
              <span>Παραδοτέα: </span><input type="text" name="needs" required />
              <br><label for="needs">Παραθέστε τα παραδοτέα της εργασίας χωρισμένα με κομμα (,)</label>
            </p>
            <p>
              <span>Ημερομηνία παράδοσης: </span><input type="date" name="date" required />
            </p>
            <input type="submit" name="uploadHome" value="Upload">
          </form>