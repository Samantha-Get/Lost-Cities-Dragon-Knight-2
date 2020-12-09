<?php
include('config.php');
include('lib.php');
$link = opendb();
$sql ="ALTER TABLE `dk_users` ADD `charrace` VARCHAR( 255 ) DEFAULT '0' NOT NULL";
if(mysql_query($sql)) { echo "charrace table added"; } else { echo"Error: ".mysql_error(); }
unset($query);

?>
