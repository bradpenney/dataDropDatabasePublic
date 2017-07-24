<!-- Insert Rack-->
<div class="single">
  <h2>Insert a New Rack Location</h2>

  <!-- Form to Insert New Rack -->
  <form method="POST">
    <label for="rack_location">Rack Location: </label>
    <input type="TEXT" name="rack_location" placeholder="ex. &quot;B204&quot;"/><br />
    <label for="num_switches">Number of Switches: </label>
    <input type="TEXT" name="num_switches" placeholder="ex. &quot;3&quot;"/><br />
    <input type="SUBMIT" name="insert_rack" value="Insert New Rack Location" />
  </form>

  <?php

  // Check to see if Insert New Rack Form was submitted
  if(isset($_POST['insert_rack'])){
    // Get the value from form
    $rack_location = $db->real_escape_string($_POST['rack_location']);
    $num_switches = $db->real_escape_string($_POST['num_switches']);

    // SQL query to Insert the Data harvested from the form as a new record in the database
    if($insert = $db->query("INSERT INTO $campusRacks(rackLocation, numSwitches) VALUES('$rack_location','$num_switches')")) {
      echo "The new record was successfully created!";
    // If query fails, inform user.
    } else {
      echo "There was an error.  Please contact support.";
    }
  }
  ?>

</div>
