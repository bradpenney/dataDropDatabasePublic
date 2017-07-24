<!-- UPDATE RECORD -->
<div id="updateRecord" class="single">
  <h2>Update Data Drop</h2>

  <!-- Form to Select Record to Update -->
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
    <input type="SUBMIT" name="update_search" value="Search For Data Drop to Update" />
  </form>

  <?php

  $updateFormDisplay = "none";  // using CSS, hide Form to Submit Update

  // Check to see if Form to Select Record to Update is Submitted
  if(isset($_POST['update_search'])){

    // Get the value from form
    $updateDropSearch = $db->real_escape_string($_POST['drop_search']);
    $updateRackLocation = $db->real_escape_string($_POST['rack_location']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE drop_num = '$updateDropSearch' AND rack_location = '$updateRackLocation'");

    // If results exist
    if($resultSet->num_rows > 0){
      // make update forms visible
      $updateFormDisplay = "block";  // Using CSS, show Form to Submit Update

      // loop over results and assign to variables, which are displayed in form
      while($rows = $resultSet->fetch_assoc()){
        $updateSearchID =  $rows['id'];
        $updateSearchDropNum = $rows['drop_num'];
        $updateSearchRackLocation = $rows['rack_location'];
        $updateSearchSwitchName = $rows['switch_name'];
        $updateSearchPortNumber = $rows['switch_port'];
        $updateVlan = $rows['vlan'];
        $updateSearchRoomNumber = $rows['room_num'];
        $updateSearchDateUpdated = $rows['date_updated'];
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
    $drop_number = $db->real_escape_string($_POST['drop_number']);
    $switch_number = $db->real_escape_string($_POST['switch_number']);
    $port_number = $db->real_escape_string($_POST['port_number']);
    $rack_location = $db->real_escape_string($_POST['rack_location']);
    $vlan = $db->real_escape_string($_POST['vlan']);
    $room_number = $db->real_escape_string($_POST['room_number']);

    // SQL Query which sets new values based on ID#.  ID does not change - is displayed but not editable.
    if($insert = $db->query("UPDATE $campusDataDrops SET drop_num='$drop_number', switch_port='$port_number', switch_name='$switch_number', room_num='$room_number', vlan='$vlan', date_updated=NOW() WHERE id=$id")) {
      echo "The record was successfully updated! <br /><br />";
    // Error thrown if update unsuccessful.
    } else {
      echo "There was an error in updating the record.  Please contact support. <br /><br />";
    }
  }
  ?>

  <!-- Form to Submit Update -->
  <form style="display: <?php echo $updateFormDisplay; ?>" method="POST">
    <label for="id">Drop ID #: </label>
    <input type="TEXT" name="id" value="<?php echo $updateSearchID; ?>" readonly /><span class="example"> ** Readonly ** </span><br />
    <label for="drop_number">Drop Number: </label>
    <input type="TEXT" name="drop_number" value="<?php echo $updateSearchDropNum; ?>"/><br />
    <label for="rack_location">Rack Location: </label>
    <input type="TEXT" name="rack_location" value="<?php echo $updateSearchRackLocation; ?>"/><br />
    <label for="switch_number">Switch Number: </label>
    <input type="TEXT" name="switch_number" value="<?php echo $updateSearchSwitchName; ?>"/><br />
    <label for="port_number">Port Number: </label>
    <input type="TEXT" name="port_number" value="<?php echo $updateSearchPortNumber; ?>" /><br />
    <label for="vlan">VLAN: </label>
    <input type="TEXT" name="vlan" value="<?php echo $updateVlan; ?>" /><span class="example"> ** If Trunk Line, write &quot;Trunk&quot; ** </span><br />
    <label for="room_number">Room Number: </label>
    <input type="TEXT" name="room_number" value="<?php echo $updateSearchRoomNumber; ?>"/><br />
    <input type="SUBMIT" name="update_record" value="Update Data Drop" />
  </form>
</div>
