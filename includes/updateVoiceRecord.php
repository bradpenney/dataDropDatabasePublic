<!-- UPDATE RECORD -->
<div id="updateRecord" class="single">
  <h2>Update Voice Drop</h2>

  <!-- Form to Select Record to Update -->
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
    <label for="dropNumber">Drop Number: </label>
    <input type="TEXT" name="dropNumber" placeholder="ex. &quot;V001&quot;"/></br>
    <input type="SUBMIT" name="updateVoiceDrop" value="Search For Voice Drop to Update" />
  </form>

  <?php

  $updateFormDisplay = "none";  // using CSS, hide Form to Submit Update

  // Check to see if Form to Select Record to Update is Submitted
  if(isset($_POST['updateVoiceDrop'])){

    // Get the value from form
    $updateVoiceDrop = $db->real_escape_string($_POST['dropNumber']);
    $updateRackLocation = $db->real_escape_string($_POST['rackLocation']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusVoiceDrops WHERE voiceDrop = '$updateVoiceDrop' AND rackLocation = '$updateRackLocation'");

    // If results exist
    if($resultSet->num_rows > 0){
      // make update forms visible
      $updateFormDisplay = "block";  // Using CSS, show Form to Submit Update

      // loop over results and assign to variables, which are displayed in form
      while($rows = $resultSet->fetch_assoc()){
        $updateVoiceID =  $rows['id'];
        $updateVoiceDrop = $rows['voiceDrop'];
        $updateRackLocation = $rows['rackLocation'];
        $updateDemarcPort = $rows['demarcPort'];
        $updateRoomNumber = $rows['roomNum'];
        $updatePhoneNumber = $rows['phoneNum'];
        $updateSearchDateUpdated = $rows['dateUpdated'];
      }

    // If no results, give error message
    }else {
      echo "!! Sorry, no results match your query !! <br /><br />";
    }
  }

  // user clicks update record buton
  if(isset($_POST['update_record'])){

    // Get the updated values from the form
    $id = ($_POST['id']);
    $voiceDropNumber = $db->real_escape_string($_POST['voiceDropNumber']);
    $rackLocation = $db->real_escape_string($_POST['rackLocation']);
    $demarcPort = $db->real_escape_string($_POST['demarcPort']);
    $roomNumber = $db->real_escape_string($_POST['roomNumber']);
    $phoneNumber = $db->real_escape_string($_POST['phoneNumber']);

    // SQL Query which sets new values based on ID#.  ID does not change - is displayed but not editable.
    if($insert = $db->query("UPDATE $campusVoiceDrops SET voiceDrop='$voiceDropNumber', demarcPort='$demarcPort', rackLocation='$rackLocation', roomNum='$roomNumber', phoneNum = '$phoneNumber', dateUpdated=NOW() WHERE id=$id")) {
      echo "The record was successfully updated! <br /><br />";
    // Error thrown if update unsuccessful.
    } else {
      echo "There was an error in updating the record.  Please contact support. <br /><br />";
    }
  }
  ?>

  <!-- Form to Submit Update -->
  <form style="display: <?php echo $updateFormDisplay; ?>" method="POST">
    <label for="id">Voice Drop ID #: </label>
    <input type="TEXT" name="id" value="<?php echo $updateVoiceID; ?>" readonly /><span class="example"> ** Readonly ** </span><br />
    <label for="voiceDropNumber">Voice Drop Number: </label>
    <input type="TEXT" name="voiceDropNumber" value="<?php echo $updateVoiceDrop; ?>"/><br />
    <label for="rackLocation">Rack Location: </label>
    <input type="TEXT" name="rackLocation" value="<?php echo $updateRackLocation; ?>"/><br />
    <label for="demarcPort">Demarc Port: </label>
    <input type="TEXT" name="demarcPort" value="<?php echo $updateDemarcPort; ?>"/><br />
    <label for="roomNumber">Room Number: </label>
    <input type="TEXT" name="roomNumber" value="<?php echo $updateRoomNumber; ?>"/><br />
    <label for="phoneNumber">Phone Number: </label>
    <input type="TEXT" name="phoneNumber" value="<?php echo $updatePhoneNumber; ?>" /><br />
    <input type="SUBMIT" name="update_record" value="Update Voice Drop" />
  </form>
</div>
