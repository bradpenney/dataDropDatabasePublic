<!-- DELETE RACK -->
<div id="delete" class="single light warning">
  <span class="warningText">!! EXTREME CAUTION !! <br /> Deleting a Rack also deletes the data &amp; voice drops!</span>
  <h2>Delete Data Rack</h2>

  <!-- Form to Select Rack to Delete -->
  <form method="POST">
    <label for="rack_location">Rack Location: </label>
    <select name="rack_location">
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
    <input type="SUBMIT" name="delete_rack" value="Delete Data Rack" />
  </form>

  <?php

  // Check to see if Form to Select Record to delete is Submitted
  if(isset($_POST['delete_rack'])){

    // Get the value from form
    $deleteRackLocation = $db->real_escape_string($_POST['rack_location']);

    if($deleteRack = $db->query("DELETE FROM $campusRacks WHERE $campusRacks . rackLocation = '$deleteRackLocation'")) {
      echo "The rack was successfully deleted! <br />";
      if ($deleteRackRecords = $db->query("DELETE FROM $campusDataDrops WHERE $campusDataDrops . rack_location = '$deleteRackLocation'")) {
        echo "The data drop records were successfully deleted! <br />";
      // Error thrown if delete unsuccessful.
      } else {
        echo "There was an error in deleting the data drops of the rack.  Please contact support. <br /><br />";
      }
      if ($deleteVoiceRecords = $db->query("DELETE FROM $campusVoiceDrops WHERE $campusVoiceDrops . rackLocation = '$deleteRackLocation'")) {
        echo "The voice drop records were successfully deleted! <br /><br />";
      // Error thrown if delete unsuccessful.
      } else {
        echo "There was an error in deleting the voice drop records of the rack.  Please contact support. <br /><br />";
      }

    } else {
      echo "There was an error in deleting the data rack.  Please contact support. <br /></br>";
    }
  }

  ?>
</div>
