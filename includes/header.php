<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="author" content="Brad Penney">

    <link rel="stylesheet" href="css/normalize.css">
		<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css">

    <title><?php echo $campusName; ?> Data &amp; Voice Drop Database</title>
  </head>
  <body>

    <?php

    // connect to MySQL database
    require './db/connect.php';

    ?>
    <header>
      <h1>
        <?php echo $campusName; ?> Data &amp; Voice Drop Database
      </h1>
      <p>
        <a <?php if($current == 'search') {echo 'class="current"';} ?> href="searchDataDrops.php">Search Data Drops</a> |
        <a <?php if($current == 'searchVoice') {echo 'class="current"';} ?> href="searchVoiceDrops.php">Search Voice Drops</a> |
        <a <?php if($current == 'manageData') {echo 'class="current"';} ?> href="manageDataDrops.php">Manage Data Drops</a> |
        <a <?php if($current == 'manageVoice') {echo 'class="current"';} ?> href="manageVoiceDrops.php">Manage Voice Drops </a> |
        <a <?php if($current == 'manageRacks') {echo 'class="current"';} ?> href="manageRacks.php">Manage Racks</a>
      </p>
    </header>
