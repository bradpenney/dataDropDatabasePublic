<!-- DELETE RECORD -->
<div class="single">
  <h2>Delete a Voice Drop</h2>

  <!-- Form to Select Record to delete -->
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
    </select>
    <label for="voiceDrop">Voice Drop Number: </label>
    <input type="TEXT" name="voiceDrop" placeholder="ex. &quot;V001&quot;"/></br>
    <input type="SUBMIT" name="deleteVoiceDrop" value="Search For Voice Drop to Delete" />
  </form>

  <?php

  $deleteFormDisplay = "none";  // using CSS, hide Form to Submit delete

  // Check to see if Form to Select Record to delete is Submitted
  if(isset($_POST['deleteVoiceDrop'])){

    // Get the value from form
    $deleteVoiceDrop = $db->real_escape_string($_POST['voiceDrop']);
    $deleteRackLocation = $db->real_escape_string($_POST['rackLocation']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusVoiceDrops WHERE voiceDrop = '$deleteVoiceDrop' AND rackLocation = '$deleteRackLocation'");

    // If results exist
    if($resultSet->num_rows > 0){
      // make delete forms visible
      $deleteFormDisplay = "block";  // Using CSS, show Form to Submit delete

      // loop over results and assign to variables, which are displayed in form
      while($rows = $resultSet->fetch_assoc()){
        $deleteVoiceDropID =  $rows['id'];
        $deleteVoiceDrop = $rows['voiceDrop'];
        $deleteRackLocation = $rows['rackLocation'];
        $deleteDemarcPort = $rows['demarcPort'];
        $deleteRoomNumber = $rows['roomNum'];
        $deleteDateUpdated = $rows['dateUpdated'];
        $deletePhoneNumber = $rows['phoneNum'];
      }

    // If no results, give error message
    }else {
      echo "!! Sorry, no results match your query !! <br /><br />";
    }
  }

  // user clicks delete record buton
  if(isset($_POST['delete_record'])){

    // Get the deleted values from the form
    $id = ($_POST['id']);

    // SQL Query which sets new values based on ID#.  ID does not change - is displayed but not editable.
    if($insert = $db->query("DELETE FROM $campusVoiceDrops WHERE $campusVoiceDrops . id=$id")) {
      echo "The record was successfully deleted! <br /><br />";
    // Error thrown if delete unsuccessful.
    } else {
      echo "There was an error in updating the record.  Please contact support. <br /><br />";
    }
  }
  ?>

  <!-- Form to Submit delete -->
  <form style="display: <?php echo $deleteFormDisplay; ?>" method="POST">
    <label for="id">Voice Drop ID #: </label>
    <input type="TEXT" name="id" value="<?php echo $deleteVoiceDropID; ?>" readonly /><span class="example"> ** Readonly ** </span><br />
    <label for="voiceDrop">Voice Drop Number: </label>
    <input type="TEXT" name="voiceDrop" value="<?php echo $deleteVoiceDrop; ?>"/><br />
    <label for="rackLocation">Rack Location: </label>
    <input type="TEXT" name="rack_location" value="<?php echo $deleteRackLocation; ?>"/><br />
    <label for="port_number">Demarc Port: </label>
    <input type="TEXT" name="demarcPort" value="<?php echo $deleteDemarcPort; ?>" /><br />
    <label for="roomNumber">Room Number: </label>
    <input type="TEXT" name="roomNumber" value="<?php echo $deleteRoomNumber; ?>"/><br />
    <label for="phoneNumber">Phone Number: </label>
    <input type="TEXT" name="phoneNumber" value="<?php echo $deletePhoneNumber; ?>"/><br />
    <input type="SUBMIT" name="delete_record" value="Delete Voice Drop" />
  </form>
</div>
