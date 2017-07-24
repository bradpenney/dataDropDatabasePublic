<!-- SEARCH BY PORT -->
<div class="single search">
  <h2>Search for Data Drops by Port Number</h2>

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
    <label for="portNumber">Port Number: </label>
    <input type="TEXT" name="portNumber" placeholder="ex. &quot;37&quot;"><br />
    <input type="SUBMIT" name="port_submit" value="Search Data Drops by Port Number" />
  </form>
  <?php

  // check to see if Form to Search By Drop Number has been submitted
  if(isset($_POST['port_submit'])){

    // Get values from form
    $switch_number = $db->real_escape_string($_POST['switch_number']);
    $rack_location = $db->real_escape_string($_POST['rack_location']);
    $portNumber = $db->real_escape_string($_POST['portNumber']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE switch_name = '$switch_number' AND rack_location = '$rack_location' AND switch_port = '$portNumber'");

    // If results exist, iterate & echo
    if($resultSet->num_rows > 0){
      // Loop over results and echo each on a separate line
      while($rows = $resultSet->fetch_assoc()){
        $portCountBySwitch += 1;
        $dt = new DateTime($rows['date_updated']);
        echo 'Data Drop ' . $rows['drop_num'] . ', Room ' . $rows['room_num'] . ', VLAN ' . $rows['vlan'] . '. ' .  $dt->format('Y-m-d') . '.</p>';
      } // end while
    // If no results, show error message to user
    }else {
      echo "!! Sorry, no results match your query !!";
    }  // end else
  } // end if submitted
  ?>
</div>
