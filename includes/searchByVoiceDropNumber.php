<!-- SEARCH BY DROP NUMBER -->
<div class="single light">
  <h2>Search By Voice Drop Number</h2>

  <!-- Form to Search By Drop Number -->
  <form method="POST">
    <label for="rackLocation">Rack Location: </label>
    <select name="rackLocation">
      <?php
        // Query the RackLocations Table
        $selectRacks = $db->query("SELECT * FROM $campusRacks");
        // Display the results in a dropdown menu
        while ($row = $selectRacks->fetch_assoc()) {
            $id = $row['id'];
            $rackLocation = $row['rackLocation'];
            echo '<option value="'.$rackLocation.'">'.$rackLocation.'</option>';
        }
      ?>
    </select><br />
    <label for="voiceDrop">Voice Drop Number: </label>
    <input type="TEXT" name="voiceDrop" placeholder="ex. &quot;V001&quot;"/><br />
    <input type="SUBMIT" name="dropSearchSubmit" value="Search By Voice Drop Number" />
  </form>
  <?php

  // check to see if Form to Search By Drop Number has been submitted
  if(isset($_POST['dropSearchSubmit'])){

    // Get values from form
    $voiceDropSearch = $db->real_escape_string($_POST['voiceDrop']);
    $rackLocationSearch = $db->real_escape_string($_POST['rackLocation']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusVoiceDrops WHERE voiceDrop = '$voiceDropSearch' AND rackLocation = '$rackLocationSearch'");

    // If results exist, iterate & echo
    if($resultSet->num_rows > 0){
      // Loop over results and echo each on a separate line
      while($rows = $resultSet->fetch_assoc()){
        $dt = new DateTime($rows['date_updated']);
        echo 'Voice Drop ' . $rows['voiceDrop'] . ', Rack ' . $rows['rackLocation'] . ', Demarc Port ' . $rows['demarcPort'] . ', Room ' . $rows['roomNum'] . ', Phone Number ' . $rows['phoneNum'] . '<br />';
        echo 'Updated ' . $dt->format('Y-m-d') . '<br />';
      } // end if results
    // If no results, show error message to user
    }else {
      echo "!! Sorry, no results match your query !!";
    }  // end else
  } // end if submitted
  ?>
</div>
