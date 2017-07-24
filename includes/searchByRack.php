<!-- SEARCH BY RACK -->
<div class="single search">
  <h2>Search for Data Drops by Rack</h2>

  <!-- Form to Search By Rack-->
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
    <input type="SUBMIT" name="rack_submit" value="Search By Rack" />
  </form>
  <?php

  // Counter for rack ports used
  $rackPortCount = 0;

  // check to see if Form to Search By Drop Number has been submitted
  if(isset($_POST['rack_submit'])){

    // Get values from form
    $rack_location = $db->real_escape_string($_POST['rack_location']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE rack_location = '$rack_location' AND switch_name != '0' ORDER BY switch_name, switch_port ASC");

    // If results exist, iterate & echo
    if($resultSet->num_rows > 0){
      echo 'The data rack in ' . $rack_location . ' contains: <br /><br />';
      // Loop over results and echo each on a separate line
      while($rows = $resultSet->fetch_assoc()){
        $rackPortCount += 1;
        echo 'Switch ' . $rows['switch_name'] . ', Port ' . $rows['switch_port']. ', Data Drop ' . $rows['drop_num'] . ', VLAN ' . $rows['vlan'] . ', Room ' . $rows['room_num'] . '.<br />';
        echo 'Last updated ' . $rows['date_updated'] . '<br /><br />';
      } // end if results
      echo 'Rack ' . $rack_location . ' has <strong>' . $rackPortCount . '</strong> connected ports. <br />';
      echo 'If a Data Drop is inactive (not connected), it is excluded from this list.';
    // If no results, show error message to user
    }else {
      echo "!! Sorry, no results match your query !!";
    }  // end else
  } // end if submitted
  ?>
</div>
