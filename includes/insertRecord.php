<!-- Insert Record -->
<div id="insertRecord" class="single light">
  <h2>Insert a New Data Drop</h2>

  <!-- Form to Insert New Record -->
  <form method="POST">
    <label for="drop_number">Drop Number: </label>
    <input type="TEXT" name="drop_number" placeholder="ex. &quot;D101&quot;"/><br />
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
    </select><br />
    <label for="switch_number">Switch Number: </label>
    <input type="TEXT" name="switch_number" placeholder="ex. &quot;3&quot;"/><br />
    <label for="port_number">Port Number: </label>
    <input type="TEXT" name="port_number" placeholder="ex. &quot;34&quot;"/><br />
    <label for="vlan">VLAN: </label>
    <input type="TEXT" name="vlan" placeholder="ex. &quot;99&quot;" /><br />
    <label for="room_ number">Room Number: </label>
    <input type="TEXT" name="room_number" placeholder="ex. &quot;B203&quot;, blank if unknown"/><br />
    <input type="SUBMIT" name="insert_record" value="Insert New Data Drop" />
  </form>

  <?php

  // Check to see if Insert New Record Form was submitted
  if(isset($_POST['insert_record'])){
    // Get the value from form
    $drop_number = $db->real_escape_string($_POST['drop_number']);
    $switch_number = $db->real_escape_string($_POST['switch_number']);
    $port_number = $db->real_escape_string($_POST['port_number']);
    $vlan = $db->real_escape_string($_POST['vlan']);
    $rack_location = $db->real_escape_string($_POST['rack_location']);
    $room_number = $db->real_escape_string($_POST['room_number']);

    // SQL query to Insert the Data harvested from the form as a new record in the database
    if($insert = $db->query("INSERT INTO $campusDataDrops(drop_num, switch_port, switch_name, room_num, rack_location, vlan) VALUES('$drop_number','$port_number','$switch_number', '$room_number', '$rack_location', '$vlan')")) {
      echo "The new record was successfully created!";
    // If query fails, inform user.
    } else {
      echo "There was an error.  Please contact support.";
    }
  }
  ?>
</div>
