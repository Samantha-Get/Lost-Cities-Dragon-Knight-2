<?php
include('config.php');
include('lib.php');
$link = opendb();
$sql ="ALTER TABLE `dk_users` ADD `classimg` VARCHAR( 255 ) DEFAULT '0' NOT NULL";
if(mysql_query($sql)) { echo "classimg table added"; } else { echo"Error: ".mysql_error(); }
unset($query);

?>
