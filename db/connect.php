<?php

$db = new mysqli('127.0.0.1', 'dataDropsUser', '', 'dataDropsPublic');

if($db->connect_errno){
  die('Sorry, there has been a database connection error.');
}

?>
