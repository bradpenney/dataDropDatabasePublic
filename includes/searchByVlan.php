<!-- SEARCH BY ROOM -->
<div class="single search">
  <h2>Search Data Drops By VLAN</h2>

  <!-- Form for Searching by Room Number -->
  <form method="POST">
    <input type="TEXT" name="vlan" placeholder="ex. &quot;99&quot;"/><br />
    <input type="SUBMIT" name="vlan_submit" value="Search By VLAN" />
  </form>
  <p>
    Note: Search "Trunk" for Trunk Lines, not by numerical VLAN.
  </p>

  <?php

  $dropCount = 0;  // counts how many drops per room

  // Check to see if Rom for Searching By Room Number has been submitted
  if(isset($_POST['vlan_submit'])){

    // Get the value from form
    $vlan_search = $db->real_escape_string($_POST['vlan']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusDataDrops WHERE vlan = '$vlan_search' ORDER BY switch_name, drop_num, switch_port ASC");

    // if results exist
    if($resultSet->num_rows > 0){
      echo 'The drops in VLAN' . $vlan_search . ' include: <br /><br />';
      // while results exist, iterate and echo each.  Also add 1 to count
      while($rows = $resultSet->fetch_assoc()){
        $dropCount += 1;
        echo $rows['drop_num'] . ', Switch '. $rows['switch_name'] . ', Port ' . $rows['switch_port'] . ', Room '. $rows['room_num'] . '.<br />';
      } // end while
      // output count total
      echo '<p>There are <strong>' . $dropCount . '</strong> drop(s) in VLAN ' . $vlan_search . '. </p>';
    // no results, output message to user
    }else {
      echo "!! Sorry, no results match your query. !!";
    } // end else
  } // end if results exist
  ?>
</div>
