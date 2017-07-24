<!-- SEARCH BY DROP NUMBER -->
<div class="single light">
  <h2>Search By Data Drop Number</h2>

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
    <label for="drop_search">Drop Number: </label>
    <input type="TEXT" name="drop_search" placeholder="ex. &quot;D001&quot;"/><br />
    <input type="SUBMIT" name="drop_submit" value="Search By Drop Number" />
  </form>
  <?php

  // check to see if Form to Search By Drop Number has been submitted
  if(isset($_POST['drop_submit'])){

    // Get values from form
    $drop_search = $db->real_escape_string($_POST['drop_search']);
    $rack_location = $db->real_escape_string($_POST['rack_location']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE drop_num = '$drop_search' AND rack_location = '$rack_location'");

    // If results exist, iterate & echo
    if($resultSet->num_rows > 0){
      // Loop over results and echo each on a separate line
      while($rows = $resultSet->fetch_assoc()){
        $dt = new DateTime($rows['date_updated']);
        echo 'Data Drop ' . $rows['drop_num'] . ', Rack ' . $rows['rack_location'] . ', Switch ' . $rows['switch_name'] . ', Port ' . $rows['switch_port'] . ', VLAN ' . $rows['vlan'] . ', Room ' . $rows['room_num'] . '.<br />';
        echo 'Updated ' . $dt->format('Y-m-d') . '<br />';
      } // end if results
    // If no results, show error message to user
    }else {
      echo "!! Sorry, no results match your query !!";
    }  // end else
  } // end if submitted
  ?>
</div>
