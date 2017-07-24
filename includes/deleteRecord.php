<!-- DELETE RECORD -->
<div class="single">
  <h2>Delete a Data Drop</h2>

  <!-- Form to Select Record to delete -->
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
    <label for="drop_search">Drop Number: </label>
    <input type="TEXT" name="drop_search" placeholder="ex. &quot;D001&quot;"/></br>
    <input type="SUBMIT" name="delete_search" value="Search For Data Drop to Delete" />
  </form>

  <?php

  $deleteFormDisplay = "none";  // using CSS, hide Form to Submit delete

  // Check to see if Form to Select Record to delete is Submitted
  if(isset($_POST['delete_search'])){

    // Get the value from form
    $deleteDropSearch = $db->real_escape_string($_POST['drop_search']);
    $deleteRackLocation = $db->real_escape_string($_POST['rack_location']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE drop_num = '$deleteDropSearch' AND rack_location = '$deleteRackLocation'");

    // If results exist
    if($resultSet->num_rows > 0){
      // make delete forms visible
      $deleteFormDisplay = "block";  // Using CSS, show Form to Submit delete

      // loop over results and assign to variables, which are displayed in form
      while($rows = $resultSet->fetch_assoc()){
        $deleteSearchID =  $rows['id'];
        $deleteSearchDropNum = $rows['drop_num'];
        $deleteSearchRackLocation = $rows['rack_location'];
        $deleteSearchSwitchName = $rows['switch_name'];
        $deleteSearchPortNumber = $rows['switch_port'];
        $deleteVlan = $rows['vlan'];
        $deleteSearchRoomNumber = $rows['room_num'];
        $deleteSearchDateUpdated = $rows['date_updated'];
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
    /*
    $drop_number = $db->real_escape_string($_POST['drop_number']);
    $switch_number = $db->real_escape_string($_POST['switch_number']);
    $port_number = $db->real_escape_string($_POST['port_number']);
    $rack_location = $db->real_escape_string($_POST['rack_location']);
    $room_number = $db->real_escape_string($_POST['room_number']);*/

    // SQL Query which sets new values based on ID#.  ID does not change - is displayed but not editable.
    if($insert = $db->query("DELETE FROM $campusDataDrops WHERE $campusDataDrops . id=$id")) {
      echo "The record was successfully deleted! <br /><br />";
    // Error thrown if delete unsuccessful.
    } else {
      echo "There was an error in updating the record.  Please contact support. <br /><br />";
    }
  }
  ?>

  <!-- Form to Submit delete -->
  <form style="display: <?php echo $deleteFormDisplay; ?>" method="POST">
    <label for="id">Drop ID #: </label>
    <input type="TEXT" name="id" value="<?php echo $deleteSearchID; ?>" readonly /><span class="example"> ** Readonly ** </span><br />
    <label for="drop_number">Drop Number: </label>
    <input type="TEXT" name="drop_number" value="<?php echo $deleteSearchDropNum; ?>"/><br />
    <label for="rack_location">Rack Location: </label>
    <input type="TEXT" name="rack_location" value="<?php echo $deleteSearchRackLocation; ?>"/><br />
    <label for="switch_number">Switch Number: </label>
    <input type="TEXT" name="switch_number" value="<?php echo $deleteSearchSwitchName; ?>"/><br />
    <label for="port_number">Port Number: </label>
    <input type="TEXT" name="port_number" value="<?php echo $deleteSearchPortNumber; ?>" /><br />
    <label for="vlan">VLAN: </label>
    <input type="TEXT" name="vlan" value="<?php echo $deleteVlan; ?>" /><br />
    <label for="room_number">Room Number: </label>
    <input type="TEXT" name="room_number" value="<?php echo $deleteSearchRoomNumber; ?>"/><br />
    <input type="SUBMIT" name="delete_record" value="Delete Data Drop" />
  </form>
</div>
