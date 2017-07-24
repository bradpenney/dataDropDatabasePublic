<!-- SEARCH BY ROOM -->
<div class="single search">
  <h2>Search Voice Drops By Room Number</h2>

  <!-- Form for Searching by Room Number -->
  <form method="POST">
    <input type="TEXT" name="roomSearch" placeholder="ex. &quot;B203&quot;"/><br />
    <input type="SUBMIT" name="roomVoiceSubmit" value="Search for Voice Drops By Room Number" />
  </form>

  <?php

  $dropCount = 0;  // counts how many drops per room

  // Check to see if Rom for Searching By Room Number has been submitted
  if(isset($_POST['roomVoiceSubmit'])){

    // Get the value from form
    $roomSearch = $db->real_escape_string($_POST['roomSearch']);

    // Query the database
    $resultSet = $db->query("SELECT * FROM $campusVoiceDrops WHERE roomNum = '$roomSearch' ORDER BY voiceDrop ASC");

    // if results exist
    if($resultSet->num_rows > 0){
      echo 'The drops in ' . $roomSearch . ' include: <br /><br />';
      // while results exist, iterate and echo each.  Also add 1 to count
      while($rows = $resultSet->fetch_assoc()){
        $whichRack = $rows['rackLocation'];
        $dropCount += 1;
        echo $rows['voiceDrop'] . ', Demarc Port '. $rows['demarcPort'] . ', Room Number ' . $rows['roomNum'] . ', Phone Number ' . $rows['phoneNum'] . '. <br />';
      } // end while
      // output count total
      echo '<p>The drops in Room ' . $roomSearch . ' connect to Rack '. $whichRack .'.</p>';
      echo '<p>There are <strong>' . $dropCount . '</strong> drop(s) in ' . $roomSearch . '. </p>';
    // no results, output message to user
    }else {
      echo "!! Sorry, no results match your query. !!";
    } // end else
  } // end if results exist
  ?>
</div>
