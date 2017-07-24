<!-- SEARCH BY SWITCH -->
<div class="single search">
  <h2>Search for Data Drops by Switch</h2>

  <!-- Form to Search By Drop Number -->
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
    </select><br />
    <label for="switch_number">Switch Number: </label>
    <select name="switch_number">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
    </select><br />
    <input type="SUBMIT" name="switch_submit" value="Search for Data Drops by Switch" />
  </form>
  <?php

  // check to see if Form to Search By Drop Number has been submitted
  if(isset($_POST['switch_submit'])){

    // Get values from form
    $switch_number = $db->real_escape_string($_POST['switch_number']);
    $rack_location = $db->real_escape_string($_POST['rack_location']);

    // Counter for SwitchPorts Used
    $portCountBySwitch = 0;

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE switch_name = '$switch_number' AND rack_location = '$rack_location' ORDER BY switch_port ASC");

    // If results exist, iterate & echo
    if($resultSet->num_rows > 0){
      echo '<br />Switch ' . $switch_number . ' in Rack ' . $rack_location . ' has the following connections: <br /><br />';
      // Loop over results and echo each on a separate line
      while($rows = $resultSet->fetch_assoc()){
        $portCountBySwitch += 1;
        $dt = new DateTime($rows['date_updated']);
        echo '<p>Port ' . $rows['switch_port'] . ', Data Drop ' . $rows['drop_num'] . ', Room ' . $rows['room_num'] . ', VLAN ' . $rows['vlan'] . '. ' .  $dt->format('Y-m-d') . '.</p>';
      } // end while
      echo 'Switch ' . $switch_number . ' has <strong>' . $portCountBySwitch . '</strong> connected ports. <br />';
    // If no results, show error message to user
    }else {
      echo "!! Sorry, no results match your query !!";
    }  // end else
  } // end if submitted
  ?>
</div>
