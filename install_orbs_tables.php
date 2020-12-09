<?PHP
define('DK_LOADED', '1');
include('lib.php');
include('config.php');
$link = opendb();
$start = getmicrotime();
if (isset($_POST['submit'])) {

 $query = "ALTER TABLE dk_users ADD orbsrestart tinyint(1) default '1' NOT NULL";
 $query2 = "ALTER TABLE dk_users ADD orbs mediumint(8) default '0' NOT NULL";	
	mysql_query($query) or die("The installer failed.<br />MySQL reported ".mysql_error()."");
	mysql_query($query2) or die("The installer failed.<br />MySQL reported ".mysql_error()."");
	echo "Tables were installed sucessfully!";
} else {
	echo 'Install Orbs tabels?<br /><form action="install_orbs_tables.php" method="post"><input type="submit" name="submit" value="Install"></form>';
}
?>
