<?php
include('config.php');
include('lib.php');
$link = opendb();
$sql ="ALTER TABLE `dk_users` ADD `avatarid` VARCHAR( 255 ) DEFAULT '0' NOT NULL";
if(mysql_query($sql)) { echo "avatar table added"; } else { echo"Error: ".mysql_error(); }
unset($query);

?>
