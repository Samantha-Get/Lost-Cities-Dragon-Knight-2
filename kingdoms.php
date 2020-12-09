<?php  //  LAND KINGDOMS MOD

//  ORIGINAL SCRIPT POSTED BY Horsley IN THE DRAGON KNIGHT FORUMS  

//  REPAIRED, PACKAGED AND MODIFIED BY Lawrence B. McDonnell ( AKA: larou IN THE DRAGON KNIGHT FORUMS )
//  E-MAIL ME: Larry_McD@hotmail.com

//  IF YOU ARE HAVING ANY PROBLEMS WITH THIS MOD.
//  PLEASE E-MAIL ME ORE POST THE PROBLEM IN THE DRAGON KNIGHT FORUMS.
//  PLEASE USE AND MODIFY AT WILL TO FIT YOUR GAME.

//  START OF THE LAND FUNCTION 
function land() 
{ 
global $userrow, $townrow, $numqueries; 

// Sets the level to become a lord and own land and troops. 
// Set it at 1 under the level you want to become a lord. ( so 14 if you want them to be a lord at 15 )
if ($userrow["level"] <= 19) 
{ 
display("<table width=100%><tr><td class=title align=center>".$userrow["landname"]." - 20th Level Needed</td></tr></table><br><br>
<center><table border=\"0\" width=\"800\" height=\"1197\" background=\"images/background/kingdom/kingdom.png\"><tr><td><br><img src=\"images/npc/Foltest.png\" vspace=\"16\" hspace=\"16\" width=\"220\" height=\"300\" alt=\"Kingdom Lord\" title=\"Kingdom Lord\" border=\"0\" align=\"center\"></td><td>
<center><table border=\"0\" Height=\"1197\" width=\"80%\"><tr><td width=\"80%\"><br><br><br><br><div class=\"titleblack\"><font color=\"#FFFFFF\"><center><br><b>".$userrow["username"]."</b> you need to be a <b>20th Level Adventurer</b><br>to become the <b>Lord of a Kingdom</b>.<br>You are Currently a Level <b>".$userrow["level"]."</b> Explorer.</center>
<br><blockquote>At 20th level the King shall grant you the <b>Title of Lord Baron</b>. The Title of Lord Baron entitles you to a <b>Castle</b>. As well as a <b>20 acres of border land</b>. A standing army of <b>40 soldiers</b> [20 Defense & 20 Offensive Soldiers].
<br><br>In exchange for your Title and Holdings, you pledge to defend the frontier against the Kings foes. As well as to start building your own destiny to become a strong ally of the Kingdom.</blockquote></font></div><br><br><br></td></tr></table></td></tr></table><br><br><br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center>", "Error"); } 

$townquery = doquery("SELECT name FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns"); 

if (mysql_num_rows($townquery) != 1) 
{ 
display("<table width=100%><tr><td class=title align=center>".$userrow["landname"]." A Cheater</td></tr></table><br><br><div align=center><b>Cheat attempt detected</b>.<br><br><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>", "Error"); } 

$townrow = mysql_fetch_array($townquery); 

if (isset($_POST["buyland"])) { 

$landacres = $_POST['landacres']; 
$landacres = strip_tags($landacres); 

$total = $landacres * 100 + $userrow["level"]; // Sets the cost for 1 acre of land 
//  $total = $landacres * 100 + $userrow["level"]; // Sets the cost for 1 acre of land 
//  $defcost = ($userrow["defensepower"] * $userrow["level"] * 4 + $userrow["defensepower"]);

if ($landacres < 0) { 


$newgold = $userrow["gold"]; 

$page = "<table width=100%><tr><td class=title align=center>".$userrow["landname"]." - Cannot Purchase Negative Land</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You cannot buy negative land.<br><br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <a href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; } 

elseif ($userrow["gold"] < $total) { 

$newgold = $userrow["gold"]; 

$page = "<table width=100%><tr><td class=title align=center>".$userrow["landname"]." - No Gold to Purchase Land</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You do not have enough gold to buy that many acres.<br><br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <a href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; } 

elseif ($userrow["gold"] >= $total) { 

$newgold = $userrow["gold"] - $total; 
$newland = $userrow["land"] + $landacres; 

$page = "<table width=100%><tr><td class=title align=center>".$userrow["landname"]." - Land Purchased</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You bought <b>$landacres</b> acres of land.<br><br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a>"; 
$query = doquery("UPDATE {{table}} SET gold='$newgold', land=land+'$landacres' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); } } 

elseif (isset($_POST["submit"])) { 

$off = $_POST["off"]; 
$dff = $_POST["dff"]; 
$off = strip_tags($off); 
$dff = strip_tags($dff); 
$totalcost = ($off+$dff) * 10 + $userrow["level"];  // Sets the cost for 1 troop Plus your current Level.
$totalunits = $off+$dff; 
$landhold = $userrow["land"] * 5; // Sets the # of troops 1 acre of land will support
// Default: $landhold = $userrow["land"] * 10; // Sets the # of troops 1 acre of land will support


$threshold = date("U") - 3600 * 2; 
// default settings: $threshold = date("U") - 3600 * 6; 
$thetime = date("U"); 

if ($off<0||$dff<0) 
{ 

$newgold = $userrow["gold"]; 

$page = "<table width=100%><tr><td class=title align=center> ".$userrow["landname"]." - You cannot hire Negative Troops</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You <b>can not</b> buy negative troops.<br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($totalcost > $userrow["gold"]) 
{ 

$newgold = $userrow["gold"]; 

$page = "<table width=100%><tr><td class=title align=center> ".$userrow["landname"]." - No Gold to hire Troops</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You <b>do not</b> have enough gold to buy that many troops.<br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($totalunits > $landhold) 
{ 

$newgold = $userrow["gold"]; 

$page = "<table width=100%><tr><td class=title align=center> ".$userrow["landname"]." - More Land needs to be Purchased</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You <b>do not</b> have enough land to support that many troops.<br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($totalunits <= $landhold) 
{ 

$newgold = $userrow["gold"] - $totalcost; 
$newoff = $userrow["offarmy"] + $off; 
$newdff = $userrow["dffarmy"] + $dff; 

$page = "<table width=100%><tr><td class=title align=center><font color=\"#FFFFFF\"><b>".$userrow["landname"]." - Offensive Troops Hired</font></td></tr></table>\n"; 
$page .= "<center><table border=\"0\" width=\"800\" height=\"1197\" background=\"images/background/kingdom/kingdom.png\"><tr><td>\n";
$page .= "<center><table border=\"0\" Height=\"1197\" width=\"90%\"><tr>\n";
$page .= "<td><br><br><br><br><blockquote><div class=\"titleblack\"><blockquote><font color=\"#FFFFFF\"><center>You have hired Offensive Troops: <b>$off</b><br>You have hired Defensive Troops: <b>$dff</b><br><br><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></center></font></blockquote></div></blockquote></td>\n";
$page .= "</tr></table></center>\n";
$page .= "</td></tr></table></blockquote></center></font>\n";

$query = doquery("UPDATE {{table}} SET gold='$newgold', offarmy='$newoff', dffarmy='$newdff' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
} 
} 

elseif (isset($_POST["cancel"])) 
{ 
header ("Location: index.php"); 
die(); 
} 

else 
{ 

$attstrength = $userrow["offarmy"] * $userrow["tactical"]; 
$dffstrength = $userrow["dffarmy"] * $userrow["tactical"]; 

$landtroops = $userrow["offarmy"] +  $userrow["dffarmy"];
$arcestroops = $userrow["land"] *  5;
$supporttroops = $arcestroops - $landtroops;

doquery("update {{table}} SET attstrength='$attstrength', dffstrength='$dffstrength' WHERE id='".$userrow["id"]."' LIMIT 1", "users");


//  START OF THE LAND FUNCTION
//  START OF THE LAND FUNCTION


$title = "Land Management"; 

$page .= "<center><table border=\"0\" width=\"100%\"><tr><td><center><h3 class=\"title\"> ".$userrow["landname"]."</h3></center></td></tr></table>\n";

$page .= "<center><br><br><table border=\"0\" width=\"800\" height=\"1197\" background=\"images/background/kingdom/kingdom.png\"><tr><td>\n";

$page .= "<center><table border=\"0\" Height=\"1197\" width=\"85%\"><tr><td></td></tr>\n";

$page .= "<tr><td><br><br><div class=\"titleblack\"><blockquote><font color=\"#FFFFFF\"><center><i><b>Your advisors greets you in the Throne Room of your Castle as you enter.<br>Welcome <em>$userrow[status] $userrow[charname]</em><br>Here is your daily briefing of your Kingdom Holdings:</b></i></font></center></b></div></blockquote></td></tr>\n";

$page .= "<tr><td><div class=\"titleblack\"><blockquote><font color=\"#FFFFFF\"><center><div align=\"center\"><a href=index.php?do=treasury class=myButton2>Treasury</a></div><br>Castle Treasury <b>".$userrow["treasury"]." Gold Coins</b>.<br>Gold On Hand: <b>".$userrow["gold"]." Gold Coins</b>. Gold in Bank: <b>".$userrow["bank"]." Gold Coins</b>.</center><br>Purchasing Land & Hiring Soldiers Costs Gold Coins on Hand <b>NOT</b> Gold Coins in you Kingdom Treasury. Treasury Gold is from Taxes [and/or transfer from your Gold Coins on Hand. This Gold can be transfer to your personal Gold Holdings.</div></font></div></blockquote></td></tr>\n";

$page .= "<form action=\"index.php?do=land\" method=\"post\">\n"; 
$page .= "<tr><td><div class=\"titleblack\"><blockquote><font color=\"#FFFFFF\"><center><input type=\"submit\" name=\"buyland\" value=\"Purchase\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;<input type =\"text\" name=\"landacres\" size=\"6\" />&nbsp;&nbsp;Acres of Land.<br><br><div align=\"left\">Your current have: <b>".$userrow["land"]." Acres of Land</b>. Each Acre of Land will support food and resources for <b>5 Soldiers</b>. You may purchase Land at <b>100 Gold Coins per Acre</b>. Plus a additional [Based on your Current Level] Land Clearing Fee of <b>".$userrow["level"]."</b> Gold Coins. This fee is per transaction not per Acre. <br><br>Your current land holdings will support: <b>".$arcestroops."</b> Troops. You currently have <b>".$landtroops."</b> Troops and will support and additional <b>".$supporttroops."</b> Troops.</div></center></font></div></blockquote></td></tr>\n";

$page .= "<form action=\"index.php?do=land\" method=\"post\">\n";
$page .= "<tr><td><div class=\"titleblack\"><blockquote><font color=\"#FFFFFF\"><center><input type=\"submit\" name=\"submit\" value=\"Hire\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"off\" size=\"6\">&nbsp;&nbsp;&nbsp;Offensive Soldiers&nbsp;&nbsp;&nbsp;and/or&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"dff\" size=\"6\">&nbsp;&nbsp;&nbsp;Defensive Soldiers.<br><br><div align=\"left\">You currently command, <b>".$userrow["offarmy"]." Offensive</b>, and <b>".$userrow["dffarmy"]." Defensive Soldiers</b>. Each Soldier you hire will cost you <b>10 Gold Coins</b>, Plus a additional [Based on your Current Level] <b>".$userrow["level"]."</b> Gold Coins<b></b> fee for Clothing and Arms. This fee is per transaction not per Acre.<br><br>Your current land holdings will support: <b>".$arcestroops."</b> Troops. You currently have <b>".$landtroops."</b> Troops and will support and additional <b>".$supporttroops."</b> Troops.</div></center></font></div></blockquote></td></tr>\n";

$page .= "<tr><td><div class=\"titleblack\"><blockquote><font color=\"#FFFFFF\"><center><a href=index.php?do=attack class=myButton2>Attack your Enemies</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=towninf\" class=\"myButton2\">Town Square</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php?do=editland class=myButton2>Change Land/Castle Name</a></div></center></font></div></blockquote></td>\n";
$page .= "</tr><tr>\n";

$page .= "</table></center></td></tr></table></center></font>\n";
} 

display($page, "Land Management"); } 

//  END OF THE LAND FUNCTION 
//  END OF THE LAND FUNCTION 
//  END OF THE LAND FUNCTION 





//  START OF THE COLLECT LAND TAXES FUNCTION 
function collect() 
{ 
global $userrow, $battlerecordrow, $townrow, $numqueries; 

$townquery = doquery("SELECT name,timelimit FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (mysql_num_rows($townquery) != 1) 
{ 
display("<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Cheat Attempt</td></tr></table><br><br><br> 
<div align=center>Cheat attempt detected.<br><br><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>", "Error"); 
} 

$townrow = mysql_fetch_array($townquery); 

$thetime = date("U"); 
$timelimit = $thetime - 84600 * 1; 

if ($userrow["taxaction"] >= $timelimit) 
{ 
display("<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Tax Error</td></tr></table><br><br><br>
<div align=center>You have all ready collected tax from your land.<br>You may only collect your tax once a day.<br><br> 
<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>", "Collect Taxes"); 
die(); 
} 

if (isset($_POST["collect"])) 
{ 

$thetime = date("U"); 
$timelimit = $thetime - 84600 * 1; 

if ($userrow["taxaction"] > $timelimit) 
{ 

$thetime < $userrow["taxaction"]; 

$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Tax Error</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You may only collect your tax once a day.<br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($userrow["taxaction"] = $timelimit) 
{ 

$thetime <= $townrow["timelimit"]; 

$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Taxes Collected</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You have collected the tax from your land.<br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

$query = doquery("UPDATE {{table}} SET taxaction='$thetime',treasury=treasury+10*land WHERE id='".$userrow["id"]."' LIMIT 1", "users"); } 

elseif (isset($_POST["cancel"])) 
{ 
header("Location: index.php"); 
die(); 
} 

else 
{ 
$title = "Collect Taxes"; 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Collect Taxes</td></tr></table><br><br><br>"; 
$page .= "<br><br><div align=center><form action=\"index.php?do=collect\" method=\"post\">"; 
$page .= "<input type=\"submit\" name=\"collect\" value=\"Collect Taxes from your Subjects\" class=\"myButton2\"></form><br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 
display($page, "Collect Taxes"); 
} 
//  END OF THE COLLECT LAND TAXES FUNCTION 

//  START OF THE ATTACK ENEMY FUNCTION 
function attack() 
{ 

global $userrow, $numqueries; 

$townquery = doquery ("SELECT name,timelimit FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns"); 

if (mysql_num_rows($townquery) != 1) 
{ 
display("<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br> 
<div align=center>Cheat attempt detected.<br><br>Get a life, loser.</div>", "Error"); 
} 

$townrow = mysql_fetch_array($townquery); 

$thetime = date("U"); 
$timelimit = $thetime - 86400 * 1; 

if ($userrow["attackaction"] >= $timelimit) 
{ 
display("<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br> 

<div align=center><table width=65%><tr><td>Your Battle Captain says:
<br><br>My Lord $userrow[charname] Your offensive forces are battered. They are tired and need ample food, and to need at least a days rest before they may attack again.<br>In my humble opinion you should give his order as soon as possible, it will improve your troop morale greatly.

<br><br>You currently have <b>".$userrow["land"]."</b> Acres of Land.
<br>Tactical Level is: <b>".$userrow["tactical"]."</b>.
<br>Honor Level is: <b>".$userrow["honor"]."</b>.
<br>The armies Attack Strength is: <b>".$userrow["attstrength"]."</b>.
<br>The armies Defense strength stand at: <b>".$userrow["dffstrength"]."</b>.
<br>You currently command: <b>".$userrow["offarmy"]."</b> Offensive Troops. 
<br>And currently command: <b>".$userrow["dffarmy"]."</b> Defensive Troops.

<br><br>You have been in a total of <b>".$userrow["battot"]."</b> Battles. 
<br>Those Battles have resulted in <b>".$userrow["batwins"]."</b> Wins and ".$userrow["battloss"]." Battle Losses. 

<br><br>You have Won <b>".$userrow["landwon"]."</b> and Lost ".$userrow["lost"]." Acres of Land. 
<br>A total of <b>".$userrow["exchanged"]."</b> Acres of Land have been fought over.

<br><br>You have lost a total of <b>".$userrow["troopslost"]."</b> Troops and killed a total of <b>".$userrow["troopskilled"]."</b> Enemy Troops</td></tr></table></div>

<br><br><div align=center><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>", "Kingdom"); 
die(); 
} 

if (isset($_POST["attack"])) 
{ 

$thetime = date("U"); 
$timelimit = $thetime - 3600 * 1; 
$victimid = $_POST['victimid']; 
$victimid = strip_tags($victimid); 
$victimselect = "SELECT * from dk_users where id='$victimid'"; 
$victimselect2 = mysql_query($victimselect) or die ("Could not select Victim"); 
$victimselect3 = mysql_fetch_array($victimselect2); 
$minlim = 2 * $victimselect3["land"]; 
$attacklimit = "SELECT COUNT(*) as attname from dk_battlerecords where id='$vicitimselect3[id]'"; 
$attacklimit2 = mysql_query($attacklimit) or die ("Could not get limit"); 
$attacklimit3 = mysql_result($attacklimit2,0); 

if ($userrow["land"] > $minlim) 
{ 
$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br><br><br>";
$page .= "<div align=center>You cannot attack someone with less than half your land.<br><br>";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($userrow["attackaction"] > $timelimit) 
{ 

$thetime <= $userrow["timelimit"]; 

$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br><br><br>";
$page .= "<div align=center>You have attacked within the last hour.<br><br>";
$page .= "You can only take one of these actions in each 1-hour period.<br /><br />";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($userrow["id"] == $victimselect3["id"]) 
{ 
$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br><br><br>";
$page .= "<div align=center>You may not attack yourself.<br><br>";
$page .= "<A href='index.php?do=land' class='myButton2'>Manage Your Land</a>.</div>"; 
} 

elseif ($attacklimit3 >= 3) 
{ 
$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br><br><br>";
$page .= "<div align=center>That person has already been attacked 3 times since their last login. You may not attack them.<br><br>";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($victimselect3["land"] <= 0) 
{ 
$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br>";
$page .= "<div align=center>You cannot attack someone that has no land.<br><br>";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

elseif ($userrow["land"] < 1) 
{ 
$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br>";
$page .= "<div align=center>You can not attack someone if you have no land to attack from.<br><br>";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

$query = doquery("UPDATE {{table}} SET attackaction='$thetime' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 

$attscimod = $userrow["tactical"] / ($userrow["land"] * 10) + 1; 
$dffscimod = $victimselect3["tactical"] / ($victimselect3["land"] * 10) + 1; 

if ($userrow["honor"] > 50) 
{ 
$ahonormod=1.5; 
} 

else if ($userrow["honor"] > 25) 
{ 
$ahonormod=1.3; 
} 

else if ($userrow["honor"] > 10) 
{ 
$ahonormod = 1.1; 
} 

else { 
$ahonormod = 1; 
} 

if ($victimselect3["honor"] > 50) 
{ 
$dhonormod=1.5; 
} 

else if ($victimselect3["honor"] > 25) 
{ 
$dhonormod=1.3; 
} 

else if ($victimselect3["honor"] > 10) 
{ 
$dhonormod = 1.1; 
} 

else 
{ 
$dhonormod = 1; 
} 

$attstrength = $userrow["attstrength"] * 5 * $attscimod * $ahonormod; 
$dffstrength = $victimselect3["dffstrength"] * 5 * $dffscimod * $dhonormod; 

$attloss = round($dffstrength / 20); 
$dffloss = round($attstrength / 40); 

if ($attloss >= $userrow["offarmy"]) 
{ 
$attloss = $userrow["offarmy"]; 
} 

if ($dffloss >= $victimselect3["dffarmy"]) 
{ 
$dffloss = $victimselect3["dffarmy"]; 
} 

if ($attstrength > $dffstrength) 
{ 

$wonland = $victimselect3["land"] / 10; 
$wonland = round($wonland); 
$battlerecord = "INSERT into dk_battlerecords (id,attname,victimid,result,landlost) values('$userrow[id]','$userrow[charname]','$victimselect3[id]','lost','$wonland')"; 
mysql_query($battlerecord) or die ("Could not update records"); 
$honor = $userrow["honor"];
$tactical = $userrow["tactical"];
$batwins = $userrow["batwins"] +1;
$battloss = $userrow["battloss"] + 1;
$battot = $userrow["battot"] +1;
$exchanged = $userrow["exchanged"];
$landwon = $userrow["landwon"];
$lost = $userrow["lost"];
$troopskilled = $userrow["troopskilled"];
$troopslost = $userrow["troopslost"];

$updatestats1 = doquery("UPDATE {{table}} SET offarmy=offarmy-'$attloss', troopslost=troopslost+'$attloss', troopskilled=troopskilled+'$dffloss', land=land+'$wonland', batwins='$batwins', battot='$battot', tactical='$tactical'+1, honor='$honor'+1, exchanged=exchanged+'$wonland', landwon=landwon+'$wonland' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$updatestats2 = doquery("UPDATE {{table}} SET dffarmy=dffarmy-'$dffloss', troopskilled=troopskilled+'$attloss', troopslost=troopslost+'$dffloss', land=land-'$wonland', battloss='$battloss', battot='$battot', tactical='$tactical'-1, honor='$honor'-1, exchanged=exchanged+'$wonland', lost=lost+'$wonland' WHERE id='".$victimselect3["id"]."' LIMIT 1", "users"); 

$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br><br><br>"; 
$page .= "<div align=center>You have won the battle and captured <b>$wonland</b> acres of land,<br>"; 
$page .= "while loosing <b>$attloss</b> troops and killing <b>$dffloss</b> enemy troops <br><br>"; 
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 

else 
{ 

$honor = $userrow["honor"];
$tactical = $userrow["tactical"];
$batwins = $userrow["batwins"] +1;
$battloss = $userrow["battloss"] +1;
$battot = $userrow["battot"] +1;
$troopskilled = $userrow["troopskilled"];
$troopslost = $userrow["troopslost"];
$updatestats1 = doquery("UPDATE {{table}} SET offarmy=offarmy-'$attloss', troopslost=troopslost+'$attloss', troopskilled=troopskilled+'$dffloss', battloss='$battloss', battot='$battot', tactical='$tactical'-1, honor='$honor'-1 WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$updatestats2 = doquery("UPDATE {{table}} SET dffarmy=dffarmy-'$dffloss', troopskilled=troopskilled+'$attloss', troopslost=troopslost+'$dffloss', batwins='$batwins', battot='$battot', tactical='$tactical'+1, honor='$honor'+1 WHERE id='".$victimselect3["id"]."' LIMIT 1", "users"); 
$battlerecord = "INSERT into dk_battlerecords (id,attname,victimid,result,landlost) values('$userrow[id]','$userrow[charname]','$victimselect3[id]','won','0')"; 
mysql_query($battlerecord) or die ("Could not update records"); 

$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br><div align=center>";
$page .= "Your attack was unsuccessful and you lost <b>$attloss</b> while killing <b>$dffloss</b> of the enemy troops.<br><br>";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
} 
} 

else 
{ 
$id = $userrow["id"];
doquery("DELETE FROM dk_battlerecords WHERE id='$id' ", "battlerecords");
$title = "Kingdom"; 
$page = "<table width=100%><tr><td class=title align=center>War Room</td></tr></table><br>";

$page .= "<table width=65%><tr><td><div align=center>As you enter the war room your Battle Captain snaps smartly to attention and starts his report.<br>\n";
$page .= "Sir! you currently have ".$userrow["land"]." acres of land.<br>\n"; 
$page .= "your tactical level is ".$userrow["tactical"].", your honor level is ".$userrow["honor"]."<br><br>\n"; 
$page .= "You currently command.<br>".$userrow["offarmy"]." offensive,\n"; 
$page .= "and ".$userrow["dffarmy"]." defensive troops.<br>\n"; 
$page .= "Your army has ".$userrow["attstrength"]." for an attack strength<br>and ".$userrow["dffstrength"]." for a defense strength.<br><br>\n"; 
$page .= "You have been in a total of ".$userrow["battot"]." battles<br>\n"; 
$page .= "you have won ".$userrow["batwins"]." and lost ".$userrow["battloss"].".<br><br>\n"; 
$page .= "You have won ".$userrow["landwon"]." and lost ".$userrow["lost"]." acres of land.<br>\n";
$page .= "A total of ".$userrow["exchanged"]." acres of land have been fought over.<br><br>\n";
$page .= "You have lost a total of ".$userrow["troopslost"]." troops<br>\n";
$page .= "and killed a total of ".$userrow["troopskilled"]." enemy troops<br><br>\n";
$page .= "Type the ID# of the Lord, you wish to attack! Sir! [See the <a href='index.php?do=viewmembers'>Memberlist</a> for ID#s.<br><br>\n"; 
$page .= "<form action=\"index.php?do=attack\" method=\"post\">\n"; 
$page .= "<input type='text' name='victimid' size='2'><br><br>\n"; 
$page .= "<input type='submit' name='attack' value='Attack'></form></td></tr></table></div><br><br>\n";

$page .= "<div align=center><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>\n"; 
} 
display($page, "Attack your enemy"); 
} 
// END OF THE ATTACK ENEMY FUNCTION 

// START OF CHANGE YOUR LAND NAME FUNCTION
function editland() 
{ 

global $userrow, $numqueries; 
$townquery = doquery("SELECT name FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns"); 

if (isset($_POST['editland'])) 
{ 
$landname = $_POST['landname']; 
doquery("UPDATE {{table}} SET landname='$landname' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "Land Name Has Been Changed.<br><br><a href=\"index.php?do=land\" class=\"myButton2\">Manage your Land</a><br /><br />"; 
} 
$page =" <div align=center> <form action=index.php?do=editland method=post> 
<table width=100%><tr><td class=title align=center>Change Land/Castle Name</td></tr></table><br><br><br> 
<table align=center><tr><td><br><br> Land Name: </td><td><br><br><input type=text value=$userrow[landname] name=landname size=30></td></tr></table> 
<input type=submit value=Change name=editland class='myButton2'></form></div><br><br> 
<div align=center><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 
display($page, "Change Your Land Name"); 
} 
// END OF CHANGE YOUR LAND NAME FUNCTION 

// START OF THE TREASURY FUNCTION, MODIFIED BANK 
function treasury() 
{ 

global $userrow, $numqueries; 

$townquery = doquery("SELECT name FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns"); 

if (mysql_num_rows($townquery) != 1) 
{ 
display("Cheat attempt detected.<br><br>Get a life, loser.", "Error"); 
} 

if (isset($_POST['treasury'])) 
{ 
$title = "treasury Transactions"; 

$newgold = $userrow['gold'] + intval('".$_POST["withdraw"]."'); 
$newtreasury = $userrow['treasury'] - intval('".$_POST["withdraw"]."'); 

if ($_POST['withdraw']) 
{ 

if ($_POST['withdraw'] <= 0) 
$page = "You must enter an amount above 0!"; 

elseif (!is_numeric($_POST['withdraw'])) 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Withdraw Error</td></tr></table><br><br><br><div align=center>You have invalid characters in your withdraw field</div><br><br><div align=center><a href=index.php?do=treasury class='myButton2'>Treasury</a>&nbsp; &nbsp; &nbsp; <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 

elseif ($_POST['withdraw'] > $userrow['treasury']) 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Withdraw Error</td></tr></table><br><br><br><div align=center>You dont have that much gold in your treasury!<br><br><div align=center><a href=index.php?do=treasury class='myButton2'>Treasury</a>&nbsp; &nbsp; &nbsp; <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <a href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 

else 
{ 

$newgold = $userrow['gold'] + intval($_POST['withdraw']); 
$newtreasury = $userrow['treasury'] - intval($_POST['withdraw']); 
doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET treasury='$newtreasury' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Withdrew Coins</td></tr></table><br><br><br>"; 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Deposited Coins</td></tr></table><br><br><br>"; 
$page .= "<center><table border=0 width=800 height=1197 background=\"images/background/kingdom/kingdom.png\"><tr><td>\n";
$page .= "<br><br><br><div align=center><table width=60%><tr><td><center><h4 class=questback>You withdrew <span style=\"color: #92E4FF;\"><b>$_POST[withdraw]</b></span> Gold Coins in ".$userrow["landname"]." Treasury.</h4></center></td></tr></table>";
$page .= "<br /><br /><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href='index.php?do=land' class='myButton2'>Manage Your Land</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center></div>\n<br>"; 
} 
} 

elseif ($_POST['deposit']) 
{ 

if ($_POST['deposit'] <= 0) 
$page = "You must enter an amount above 0!"; 

elseif (!is_numeric($_POST["deposit"])) 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Deposit Error</td></tr></table><br><br><br><div align=center>You have invalid characters in your deposit field.</div><br><br><div align=center><a href=index.php?do=treasury class=myButton2>Treasury</a>&nbsp; &nbsp; &nbsp; <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <A href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 

elseif ($_POST['deposit'] > $userrow['gold']) 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Deposit Error</td></tr></table><br><br><br><div align=center>You dont have that much gold!<br><br><a href='index.php?do=treasury' class='myButton2'>Treasury</a>&nbsp; &nbsp; &nbsp; <a href='index.php' class='myButton2'>Town Square</a>&nbsp; &nbsp; &nbsp; <a href='index.php?do=land' class='myButton2'>Manage Your Land</a></div>"; 

else 
{ 
$newgold = $userrow['gold'] - intval($_POST['deposit']); 
$newtreasury = $userrow['treasury'] + intval($_POST['deposit']); 
doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET treasury='$newtreasury' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Deposited Coins</td></tr></table><br><br><br>"; 
$page .= "<center><table border=0 width=800 height=1197 background=\"images/background/kingdom/kingdom.png\"><tr><td>\n";
$page .= "<br><br><br><div align=center><table width=60%><tr><td><center><h4 class=questback>You deposited <span style=\"color: #92E4FF;\"><b>$_POST[deposit]</b></span> Gold Coins in ".$userrow["landname"]." Treasury.</h4></center></td></tr></table>";
$page .= "<br /><br /><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href='index.php?do=land' class='myButton2'>Manage Your Land</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center></div>\n<br>"; 
} 
} 
} 

else  
{ 
$title = "Treasury Transactions"; 
$page = "<table width=100%><tr><td class=title align=center>Treasury Of ".$userrow["landname"]." - Treasury Transactions</td></tr></table><br>"; 
$page .= "<center><table border=0 width=800 height=1197 background=\"images/background/kingdom/kingdom.png\"><tr><td>\n";
$page .= "<br><br><br><div align=center><table width=60%><tr><td><div align=center><h4 class=questback><span style=\"color: #92E4FF;\">$userrow[status] $userrow[username]</span> of $userrow[landname],<br>What would you like to do today?</h4><br />"; 


$page .= "<form action=index.php?do=treasury method=post><br />"; 
$page .= "<h4 class=questback><b>Deposit</b> <input type=text name=deposit><br />Gold Coins into Treasury.</h4>";  
$page .= "<input type=submit value=Proceed name=treasury class=myButton2></form>"; 

$page .= "<form action=index.php?do=treasury method=post><br />"; 
$page .= "<h4 class=questback><b>Withdraw</b> <input type=text name=withdraw><br />Gold Coins from Treasury.</h4>"; 
$page .= "<input type=submit value=Proceed name=treasury class=myButton2></form><br />"; 

$page .= "<h4 class=questback>You have <span style=\"color: #92E4FF;\">$userrow[treasury]</span> Gold Coins in your Treasury Account<br>and you have <span style=\"color: #92E4FF;\">$userrow[gold]</span> Gold Coins with you.</span></h4><br><br></td></tr></table></center>"; 
$page .= "<div align=center><a href=index.php?do=collect class=myButton2>Collect Land Taxes</a>&nbsp; &nbsp; <a href='index.php?do=land' class='myButton2'>Manage Your Land</a><br /><br />"; 
$page .= "<a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href='index.php?do=land' class='myButton2'>Manage Your Land</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center></div>\n<br>"; 

} 
display($page, "Treasury Transactions"); 
} 
// END OF THE TREASURY FUNCTION, MODIFIED BANK 

?>