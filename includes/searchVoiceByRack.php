<!-- SEARCH BY RACK -->
<div class="single search">
  <h2>Search for Voice Drops by Rack</h2>

  <!-- Form to Search By Rack-->
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
    <input type="SUBMIT" name="voiceRackSubmit" value="Search By Rack" />
  </form>
  <?php

  // Counter for rack ports used
  $rackPortCount = 0;

  // check to see if Form to Search By Drop Number has been submitted
  if(isset($_POST['voiceRackSubmit'])){

    // Get values from form
    $rackLocation = $db->real_escape_string($_POST['rackLocation']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusVoiceDrops WHERE rackLocation = '$rackLocation' ORDER BY voiceDrop ASC");

    // If results exist, iterate & echo
    if($resultSet->num_rows > 0){
      echo 'The data rack in ' . $rackLocation . ' contains: <br /><br />';
      // Loop over results and echo each on a separate line
      while($rows = $resultSet->fetch_assoc()){
        $rackPortCount += 1;
        echo 'Voice Drop ' . $rows['voiceDrop']. ', Demarc Drop ' . $rows['demarcDrop'] . ', Room ' . $rows['roomNum'] . ', Phone Number ' . $rows['phoneNum'] . '.<br />';
        echo 'Last updated ' . $rows['dateUpdated'] . '<br /><br />';
      } // end if results
      echo 'Rack ' . $rackLocation . ' has <strong>' . $rackPortCount . '</strong> connected voice ports. <br />';
      echo 'If a Voice Drop is inactive (not connected), it is excluded from this list.';
    // If no results, show error message to user
    }else {
      echo "!! Sorry, no results match your query !!";
    }  // end else
  } // end if submitted
  ?>
</div>
