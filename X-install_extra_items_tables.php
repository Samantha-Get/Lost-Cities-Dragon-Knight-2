<?PHP
define('DK_LOADED', '1');
include('lib.php');
include('config.php');
$link = opendb();
$start = getmicrotime();
if (isset($_POST['submit'])) {
 $query = "ALTER TABLE dk_users ADD `weapon1id` smallint(5) unsigned NOT NULL default '0',       
 $query2 = "ALTER TABLE dk_users ADD `weapon1name` varchar(30) NOT NULL default 'None',	
 $query3 = "ALTER TABLE dk_users ADD `weapon2id` smallint(5) unsigned NOT NULL default '0',       
 $query4 = "ALTER TABLE dk_users ADD `weapon2name` varchar(30) NOT NULL default 'None',	
 $query5 = "ALTER TABLE dk_users ADD `magicid` smallint(5) unsigned NOT NULL default '0',       
 $query6 = "ALTER TABLE dk_users ADD `magicname` varchar(30) NOT NULL default 'None',
 $query7 = "ALTER TABLE dk_users ADD `ringid` smallint(5) unsigned NOT NULL default '0',       
 $query8 = "ALTER TABLE dk_users ADD `ringname` varchar(30) NOT NULL default 'None';	
 	mysql_query($query) or die("The installer failed.<br />MySQL reported ".mysql_error()."");
	mysql_query($query2) or die("The installer failed.<br />MySQL reported ".mysql_error()."");
	echo "Tables were installed sucessfully!";
} else {
	echo 'Install Orbs tables?<br /><form action="install_orbs_tables.php" method="post"><input type="submit" name="submit" value="Install"></form>';
}
?>
