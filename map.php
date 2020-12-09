<?php  // map.php :: Players Map script created by ZDMaster. RUSSIA, Volgodonsk.
require_once('lib.php'); 
include('cookies.php'); 
$link = opendb(); 
$userrow = checkcookies();
if ($userrow == false) { display("The players map is for registered players only.", "Map"); die(); }
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);

// Close game.
if ($controlrow["gameopen"] == 0) { display("The game is currently closed for maintanence. Please check back later.","Game Closed"); die(); }
// Force verify if the user isn't verified yet.
if ($controlrow["verifyemail"] == 1 && $userrow["verify"] != 1) { header("Location: users.php?do=verify"); die(); }
// Block user if he/she has been banned.
if ($userrow["authlevel"] == 2) { die("Your account has been blocked. Please try back later."); }


?>
<html>
<head>
<title>Map</title>
<meta name="description" content="Archangel Michaels Players Map">
<meta http-equiv="refresh" content="10";URL="map.php">

</head>
<body background="images/map.gif">
<?

$usersquery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' ORDER BY id", "users");
while ($usersrow = mysql_fetch_array($usersquery)) {
$brx = $controlrow["gamesize"] - 3 + $usersrow["longitude"];    
$bry = $controlrow["gamesize"] - 3 - $usersrow["latitude"];    
    
    echo "<img src=\"images/dot.gif\" alt=\"".$usersrow["charname"]."\"; style=\"position: absolute; border: 0px; left: $brx px; top: $bry px;\">;\n";
}
?>
</body>
</html>
