<!-- Insert Record -->
<div id="insertRecord" class="single light">
  <h2>Insert a New Voice Drop</h2>

  <!-- Form to Insert New Record -->
  <form method="POST">
    <label for="dropNumber">Voice Drop Number: </label>
    <input type="TEXT" name="dropNumber" placeholder="ex. &quot;V47&quot;"/><br />
    <label for="rackLocation">Rack Location: </label>
    <select name="rackLocation">
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
    <label for="demarcPort">Demarc Port: </label>
    <input type="TEXT" name="demarcPort" placeholder="ex. &quot;3&quot;"/><br />
    <label for="roomNumber">Room Number: </label>
    <input type="TEXT" name="roomNumber" placeholder="ex. &quot;B203&quot;"/><br />
    <label for="phoneNumber">Phone Number: </label>
    <input type="TEXT" name="phoneNumber" placeholder="ex. &quot;902-555-5555&quot;"/><br />
    <input type="SUBMIT" name="insertVoiceRecord" value="Insert New Voice Drop" />
  </form>

  <?php

  // Check to see if Insert New Record Form was submitted
  if(isset($_POST['insertVoiceRecord'])){
    // Get the value from form
    $dropNumber = $db->real_escape_string($_POST['dropNumber']);
    $demarcPort = $db->real_escape_string($_POST['demarcPort']);
    $phoneNumber = $db->real_escape_string($_POST['phoneNumber']);
    $rackLocation = $db->real_escape_string($_POST['rackLocation']);
    $roomNumber = $db->real_escape_string($_POST['roomNumber']);

    // SQL query to Insert the Data harvested from the form as a new record in the database
    if($insert = $db->query("INSERT INTO $campusVoiceDrops(voiceDrop, demarcPort, rackLocation, roomNum, phoneNum) VALUES('$dropNumber','$demarcPort','$rackLocation', '$roomNumber', '$phoneNumber')")) {
      echo "The new record was successfully created!";
    // If query fails, inform user.
    } else {
      echo "There was an error.  Please contact support.";
    }
  }
  ?>
</div>
