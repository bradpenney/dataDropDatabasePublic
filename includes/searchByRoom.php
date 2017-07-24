<!-- SEARCH BY ROOM -->
<div class="single search">
  <h2>Search Data Drops By Room Number</h2>

  <!-- Form for Searching by Room Number -->
  <form method="POST">
    <input type="TEXT" name="room_search" placeholder="ex. &quot;B203&quot;"/><br />
    <input type="SUBMIT" name="room_submit" value="Search By Room Number" />
  </form>

  <?php

  $dropCount = 0;  // counts how many drops per room

  // Check to see if Rom for Searching By Room Number has been submitted
  if(isset($_POST['room_submit'])){

    // Get the value from form
    $room_search = $db->real_escape_string($_POST['room_search']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE room_num = '$room_search' ORDER BY drop_num ASC");

    // if results exist
    if($resultSet->num_rows > 0){
      echo 'The drops in ' . $room_search . ' include: <br /><br />';
      // while results exist, iterate and echo each.  Also add 1 to count
      while($rows = $resultSet->fetch_assoc()){
        $whichRack = $rows['rack_location'];
        $dropCount += 1;
        echo $rows['drop_num'] . ', Switch '. $rows['switch_name'] . ', Port ' . $rows['switch_port'] . ', VLAN ' . $rows['vlan'] . '. <br />';
      } // end while
      // output count total
      echo '<p>The drops in Room ' . $room_search . ' connect to Rack '. $whichRack .'.</p>';
      echo '<p>There are <strong>' . $dropCount . '</strong> drop(s) in ' . $room_search . '. </p>';
    // no results, output message to user
    }else {
      echo "!! Sorry, no results match your query. !!";
    } // end else
  } // end if results exist
  ?>
</div>
