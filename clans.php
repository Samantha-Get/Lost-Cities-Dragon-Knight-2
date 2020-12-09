<?php  
// Original Estonian Clan Mod made by tanel tähepõld --> doublet in DK forum
// Translated and some recoding by Larry McDonnell AKA: larou / Lord Antarius E-MAIL ME: Larry_McD@hotmail.com

function leave() { // You may kick yourself from the clan
global $userrow;
if(isset($_POST['yes'])) {

$page .= "<div align=center> You have been kicked from the clan!
<br><br><a href=\"index.php\" class=\"myButton2\">Town Square</a></div> ";

$query = doquery("SELECT * FROM {{table}} WHERE owner='".$userrow["id"]."' LIMIT 1", "clans");
while ($clanrow = mysql_fetch_array($query)) { 
$experience = $clanrow["experience"] - $userrow["level"]; }
$updatequery = doquery("UPDATE {{table}} SET experience='$experience' WHERE owner='".$userrow["id"]."' LIMIT 1", "clans");
$updateuserquery = doquery("UPDATE {{table}} SET clanid='0', memberstatus='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); }

elseif(isset($_POST['no'])) {
$page .= <<<END
<meta http-equiv="refresh" content="2;URL=index.php">
END;

$page .="<br><br><div align=center> You will be directed to the Main Page</div> "; }
else { 

$page .= "<br><div align=center>  Do you want to leave from this clan?  <br /><br /> Are you sure?<br><br></div> ";

$page .="<br><div align=center><form action=index.php?do=leave method=post><input type=submit value=Yes name=yes class=myButton2>&nbsp;&nbsp;&nbsp;<input type=submit value=No name=no class=myButton2></form></div><br><br>"; } 
display( 

$page, "<br><div align=center>Leaving the Clan</div><br><br>"); }

function create() { // In order to create a clan you must be 10th level
global $userrow;

if($userrow["level"] < 10) { display(" <div align=center>You haven't reach the required level to join a Clan.<br />You need to be at least a level 10.<br />To gain access to create a clan.
<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">Clan Hall</a>
<br><br><a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br><br>", "Error"); }

elseif (isset($_POST['create'])) {
if($_POST['name'] == "") { display(" <div align=center><br><br>You need to enter your Clan Name!<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">Back to Clan Hall</a></div><br /><br />", "Error"); }
else { 

$page.="<br><div align=center>Your clan has been successfully created.<br /><br /> <a href=\"index.php?do=clans\" class=\"myButton2\">Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br><br>";

$query = doquery("INSERT INTO {{table}} SET id='', name='".$_POST['name']."', logo='".$_POST['logo']."', owner='".$userrow["id"]."'", "clans");
//update user who have made a clan. clanleader --> clanleader, if clanleader is one, that means that you are the leader of this clan, and memberstatus --> memberstatus. if member status is 5 then in clan after your name there are displayed LEADER
$query2 = doquery("UPDATE {{table}} SET clanid='".$userrow["id"]."', clanleader='1', memberstatus='7' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); } }
else { 

$page .= "<br><br><div align=center> <form action=index.php?do=create method=post><br /> ";
$page .= "Clans name:&nbsp;&nbsp;&nbsp;<input type=text name=name size=30 max=30><br /><br /> ";
$page .= "Clans logo:&nbsp;&nbsp;&nbsp;<input type=text name=logo size=30 max=30><br /><br>";
$page .= "<input type=submit value=Create name=create></form><br /><br /> ";
$page .= "Return to the <a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br><br>"; }
display( 
$page, $title); }

function rank($id) { // Here you may change a members rank // boss, soldier, noobie ect.
global $userrow;   
if(isset($_POST['change'])) {
doquery("UPDATE {{table}} SET memberstatus='".$_POST['memberstatus']."' WHERE id='$id' LIMIT 1", "users");


$page .= "<center><h3 class=\"title\">Clan Members Rank Changed</h3></center><br /><br /><br /><br />";
$page .="<br><div align=center>Members rank has changed.<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br /><br />"; }
else { $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "users");
while ($row = mysql_fetch_array($query)) { 
$member = $row["charname"];


$page .= "<center><h3 class=\"title\">Change Clan Members Rank</h3></center><br /><br /><br /><br />";
$page .= "<div align=center><form action=index.php?do=rank:$id method=post><br />";
$page .= "$member's rank: <input type=text name=memberstatus size=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$page .= "<input type=submit value=Change name=change class='myButton2'></form><br /><br /><br />";


$page .= "Legend: 0 = Squire | 1 = Man-at-Arms | 2 = Bill-Man | 3 = Banneret Knight<br />4 = Bachelor Knight | 5 = Feudal Lord | 6 = Constable | 7 =Marshal";
$page .="<br><br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br /><br />"; } }
display( 
$page, "<div align=center>Change Clan Members Ranks</div>"); }

function kick($id) { // To kick a member from your clan
global $userrow;
$updatequery  = doquery("UPDATE {{table}} SET clanid='0', memberstatus='0', usemine='0' WHERE id='".$id."' LIMIT 1", "users");
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "users");
while ($row = mysql_fetch_array($query)) { 
$clanquery = doquery("SELECT*FROM {{table}} WHERE owner='".$userrow["id"]."' LIMIT 1", "clans");
while ($clanrow = mysql_fetch_array($clanquery)) {

$k = $row["level"] * 2;
$newexperience = $clanrow["experience"] - $k;
$experienceupdate = doquery("UPDATE {{table}} SET experience='$newexperience' WHERE owner='".$userrow["id"]."' LIMIT 1", "clans"); } }

$page .= "<div align=center>Member is kicked from your clan!<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br><br>";
display( 
$page, "<br><div align=center>Member kicked</div><br>"); }

function yes($id) { // To accept a member in your clan
global $userrow;
$usersquery = doquery("SELECT*FROM {{table}} WHERE id='$id' LIMIT 1", "users"); //you get exp for you clan when member unites
while ($usersrow = mysql_fetch_array($usersquery)) { 
$usersupdate = doquery("UPDATE {{table}} SET clanid='".$userrow["id"]."' WHERE id='".$usersrow["usersid"]."'", "users");//member accepted
$clanquery = doquery("SELECT*FROM {{table}} WHERE owner='".$userrow["id"]."' LIMIT 1", "clans");
while ($clanrow = mysql_fetch_array($clanquery)) { 
$k = $usersrow["experience"] * 2;
$newexperience1 = $clanrow["experience"] + $k; //new xp
$update = doquery("UPDATE {{table}} SET experience='$newexperience1' WHERE owner='".$userrow["id"]."' LIMIT 1", "clans");

$page .= "<br><div align=center>Members application was accepted <br /><br />Your clan has gained $k Experience. 
<br><br><br><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div> ";
$delete = doquery("DELETE FROM {{table}} WHERE id='$id'", "users"); } }
display( $page, "Application Accepted"); }

function no($id) { // If you dont accept member in to your clan
$page .= " <div align=center> Members application was deleted! <br /><br />";
$page .= " Return to your <a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div> ";
doquery("DELETE FROM {{table}} WHERE id='$id'", "users");
display( 
$page, " <div align=center> Application deleted </div> "); }

function application($id) { // To apply for a membership in a clan
global $userrow;

if($userrow["usemine"] == 1) { 
$page .= "<br/><br /><div align=center> You have already sent your application!<br/><br /><a href=\"index.php\" class=\"myButton2\">Town Square </a> </div> "; }
else { doquery("INSERT INTO {{table}} SET id='', clanid='$id', experience='".$userrow["level"]."', usersid='".$userrow["id"]."', usersname='".$userrow["charname"]."'", "users");
doquery("UPDATE {{table}} set usemine='1' WHERE id='".$userrow["id"]."'", "users");
$page .= " <div align=center> Your application was sent! <br /><br /> ";
$page .= "<a href=\"index.php?do=clans\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div> "; }
display( 
$page, " <div align=center> Application sent </div> "); }

function clans() { // Clans create // use
global $userrow;

if($userrow["clanid"] == 0) {
$page .= "<center><h3 class=\"title\">Create a Clan</h3></center><br /><br /> ";
$page .= "<div align=center><table cellpadding=\"0\" cellspacing=\"0\"><tr><td><a href=\"index.php?do=create\" class=\"myButton2\">Create A Clan?</a></td></tr></table></div><br/><br /> ";
$page .= "<div align=center><table cellpadding=\"0\" cellspacing=\"0\" style=\"border: solid 2px black\" width=\"70%\"> ";
$query = doquery("SELECT * FROM {{table}} ORDER BY experience DESC LIMIT 100", "clans");
$rank = 1;
while ($clanrow = mysql_fetch_array($query)) {
$page .= " <tr><td bgcolor=\"#ffffff\">&nbsp;&nbsp;$rank</td><td bgcolor=\"#ffffff\">&nbsp;&nbsp;".$clanrow["name"]."</a></td><td bgcolor=\"#ffffff\">&nbsp;&nbsp;Experience: ".$clanrow["experience"]."</td><td bgcolor=\"#ffffff\">&nbsp;&nbsp;<a href=\"index.php?do=use:".$clanrow["owner"]."\">Join</a></td></tr>\n";
$rank++; }
$page .= " </table>\n<br /><br /><br /><br />\n";
$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a></div> ";
$title = " <div align=center>Join this clan</div> "; }

elseif($userrow["clanleader"] == 0 & $userrow["clanid"] > 0 ) { // Normal clan member
$clanquery = doquery("SELECT logo FROM {{table}} WHERE owner='".$userrow["clanid"]."' LIMIT 1", "clans");
while ($clanrow = mysql_fetch_array($clanquery)) {
$logo = $clanrow["logo"]; }
$page .= "<center><h3 class=\"title\">Clans</h3></center><br /><br /> ";
$page .= " <div align=center><img src=\"$logo\"> "; // Display clan logo
$page .= " <form action=index.php?do=clans method=post> ";
$page .= " <table><tr><td><input type=submit value='Clan Info' name=clan></td><td><input type=submit value='Messages' name=messages></td><td><input type=submit value='Members' name=members></td><td><input type=submit value='Main page' name=tagasi></td></tr><tr><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></td></tr><tr></tr><tr> &nbsp;&nbsp;&nbsp;&nbsp; <a href=\"index.php?do=leave\" Leave from this clan! </a></td></tr></table> </div> "; }

elseif ($userrow["clanleader"] == 1) { // clan leader
$clanquery = doquery("SELECT logo FROM {{table}} WHERE owner='".$userrow["id"]."' LIMIT 1", "clans");
while ($clanrow = mysql_fetch_array($clanquery)) {

$logo = $clanrow["logo"]; }
$page .= "<center><h3 class=\"title\">Clan Information</h3></center><br /><br /> ";
$page .= "<div align=center><table border=\"0\" bgcolor=\"#000000\" cellpadding=\"0\" cellspacing=\"0\" style=\"outline-style:outset;\"><tr><td><div align=center><img src=\"$logo\"/></td></tr></table>";
$page .= " <br /><br /><form action=index.php?do=clans method=post> ";
$page .= " <table><tr><td><br /><br /><input type=submit value='Clan Info' name=clan class='myButton2'></td><td><br /><br /><input type=submit value='Messages' name=messages class='myButton2'></td><td><br /><br /><input type=submit value='Members' name=members class='myButton2'></td><td><br /><br /><input type=submit value='Leader Area' name=admin class='myButton2'></td><td><br /><br /><input type=submit value='Main page' name=tagasi class='myButton2'></td></tr><tr></tr><tr><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></td></tr></table><br /><br /> </div> "; }

if(isset($_POST['clan'])) {
$clanquery = doquery("SELECT*FROM {{table}} WHERE owner='".$userrow["clanid"]."' LIMIT 1", "clans");
while ($clanrow = mysql_fetch_array($clanquery)) {
$ownerquery = doquery("SELECT*FROM {{table}} WHERE id='".$clanrow["owner"]."' LIMIT 1", "users");
while ($ownerrow = mysql_fetch_array($ownerquery)) {
$page .="<div align=center><table border=\"0\"  width=\"65%\"><tr><td>Clan name:   ".$clanrow["name"]."</td>";
$page .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
$page .= "<td>Owner of Clan:   <a href=\"index.php?do=onlinechar:".$ownerrow["id"]."\">".$ownerrow["charname"]."</a></td>";
$page .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
$page .= "<td>Clan fame:   ".$clanrow["experience"]."</td></tr></table></div> "; } } }

if(isset($_POST['messages'])) {
$clanquery = doquery("SELECT * FROM {{table}} WHERE owner='".$clanrow["clanid"]."' LIMIT 1", "clans");
$newsquery = doquery("SELECT * FROM {{table}} WHERE clanid='".$userrow["clanid"]."' ORDER BY id DESC LIMIT 5", "users");
$rank = 1;
while ($newsrow = mysql_fetch_array($newsquery)) { 
$page .="<div align=center><table border=\"0\"  width=\"65%\"><tr><td>Rank:  $rank.</td>";
$page .= "<td>Subject:   ".$newsrow["subject"]."</td>";
$page .= "<td>Member:   <a href=\"index.php?do=onlinechar:".$newsrow["id"]."\">".$newsrow["charname"]."</a></td></tr></table></div>";
$rank++; } }


elseif(isset($_POST['addmessage'])) {
$page .= "<div align=center><form action=index.php?do=clans method=post>";
$page .= "Message:<br /><textarea name=\"subject\" rows=\"6\" cols=\"50\" max=50></textarea><br /><br /><input type=submit name=submit value='Submit'  class='myButton2'></div>"; }

elseif(isset($_POST['submit'])) {
$usersquery = doquery("SELECT * FROM {{table}} WHERE clanid='".$userrow["clanid"]."' LIMIT 1", "users");
$usersquery = doquery("UPDATE {{table}} SET subject='".$_POST['subject']."'", "users");
$page .= " <div align=center> Your message was added </div> "; }

elseif(isset($_POST['admin'])) {
$page .= " <div align=center> <form action=index.php?do=clans method=post>";
$page .= "<table><tr><td><input type=submit value='Clan settings' name=settings class='myButton2'></td><td></td><td><input type=submit value='Add message' name=addmessage class='myButton2'></td><td><input type=submit value='Ranks' name=ranks class='myButton2'></td><td><input type=submit value='Kick' name=kick class='myButton2'></td><td><input type=submit value='Applications' name=applications class='myButton2'></td></td></tr><tr></tr></table> </div> "; }

elseif(isset($_POST['applications'])) {
$page .= "<div align=center><table><tr><td><input type=submit value='Add message' name=addmessage class='myButton2'></td><td><input type=submit value='Ranks' name=ranks class='myButton2'></td><td><input type=submit value='Kick' name=kick class='myButton2'></td></tr></table> ";
$page .= " <table width=\"80%\">";
$query = doquery("SELECT * FROM {{table}} WHERE clanid='".$userrow["id"]."' ORDER BY id DESC LIMIT 100", "users");
$rank = 1;
while ($row = mysql_fetch_array($query)) {
$clanquery = doquery("SELECT * FROM {{table}} WHERE id='".$row["usersid"]."'", "users");
while ($clanrow = mysql_fetch_array($clanquery)) {
$page .= "<tr><td>Rank:   $rank</td><td>User Name:   <a href=\"index.php?do=onlinechar:".$row["usersid"]."\" class=\"myButton2\">".$row["usersname"]."</a></td><td>Level:   ".$clanrow["level"]."<td width=\"100%\"><a href=\"index.php?do=yes:".$row["id"]."\" class=\"myButton2\">[Yes]</a></td><td width=\"100%\"><a href=\"index.php?do=no:".$row["id"]."\" class=\"myButton2\">[No]</a></td></tr>\n";
$rank++; } }
if ($row = mysql_fetch_array($query) == 0) { 
$page .= " <tr><td width=\"100%\"><div align=center>You dont have any applications.</div></td></tr>\n"; }
$page .= " </table>\n<br /><br />\n </div> "; }

elseif(isset($_POST['settings'])) {
$page .= "<center><h3>Clan Settings</h3></center><br />";
$page .= "<div align=center><form action=index.php?do=clans method=post>"; 
$page .= "Clans Name:   <input type=text name=clanname size=40>&nbsp;&nbsp;&nbsp;";
$page .= "<input type=submit value='Change' name=name class='myButton2'><br /><br />";
$page .= "<br /><br />Clans Logo Address:  ";
$page .= "<input type=text name=clanlogo size=40>&nbsp;&nbsp;&nbsp;";
$page .= "<input type=submit value='Change' name=logo class='myButton2'><br />";
$page .= "<br />Your Logo should be 400w X 150h pixels in size<br>Logos larger that this size will result in deletation of Clan.<br /> ";

$page .= "<br />Use: http://yourdomain.com/yourlogo.png or<br /> ";
$page .= "<br />Use one of our preset Clan Logos:<br /> ";
$page .= "<br />Enter: images/clans/1.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/1.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/2.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/2.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/3.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/3.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/4.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/4.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/5.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/5.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/6.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/6.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/7.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/7.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/8.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/8.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/9.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/9.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/10.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/10.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/11.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/11.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";
$page .= "<br />Enter: images/clans/12.png in 'Clans Logo Address' box.<br /> ";
$page .= "<br /><img src=\"images/clans/12.png\" width=\"400\" height=\"150\" alt=\"Clan Logo\" border=\"0\" style=\"outline-style:outset;\"><br /> ";

$page .= "<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div>"; }

elseif(isset($_POST['name'])) {
$page .= "<div align=center><br />Clans Name Has Changed!<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div>";
doquery("UPDATE {{table}} SET name='".$_POST['clanname']."' WHERE owner='".$userrow["id"]."' LIMIT 1", "clans"); }

elseif(isset($_POST['logo'])) {
$page .= " <div align=center> <br /><br />Clans Logo Has Changed!<br /><br /><a href=\"index.php?do=clans\" class=\"myButton2\">The Clan Hall</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></div> ";
doquery("UPDATE {{table}} SET logo='".$_POST['clanlogo']."' WHERE owner='".$userrow["id"]."' LIMIT 1", "clans"); }

elseif(isset($_POST['ranks'])) {
$page .= "<div align=center> <form action=index.php?do=clans method=post>";
$page .= "<table><tr><td><input type=submit value='Add message' name=addmessage class='myButton2'></td><td><input type=submit value=Members name=members class='myButton2'></td><td><input type=submit value='Ranks' name=ranks class='myButton2'></td><td><input type=submit value=Kick name=kick class='myButton2'></td></td><td><input type=submit value='Main page' name=back class='myButton2'></td></tr><tr></tr></table><br /><br />";
$page .= "<table width=\"80%\">";
$query = doquery("SELECT * FROM {{table}} WHERE clanid='".$userrow["clanid"]."' ORDER BY memberstatus DESC LIMIT 1000", "users");
$rank = 1;

while ($row = mysql_fetch_array($query)) {
if($row["memberstatus"] == 0) { $status = "Squire"; } elseif($row["memberstatus"] == 1) { $status = "Man-at-Arms"; } elseif($row["memberstatus"] == 2) { $status = "Bill-Man"; } elseif($row["memberstatus"] == 3) { $status = "Banneret Knight"; } elseif($row["memberstatus"] == 4) { $status = "Bachelor Knight"; } elseif($row["memberstatus"] == 5) { $status = "Feudal Lord"; }  elseif($row["memberstatus"] == 6) { $status = "Constable"; }  elseif($row["memberstatus"] == 7) { $status = "Marshal"; }
$page .= "<tr><td>Rank:   $rank</td><td>Member:   <a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td><td>Level:   ".$row["level"]."</td><td> Rank: </td><td>Status:   $status</td><td><a href=\"index.php?do=rank:".$row["id"]."\" class=\"myButton2\">Change Rank</a></td></tr>\n ";
$rank++; }
$page .= "</table>\n<br /><br />\n </div> "; }

elseif(isset($_POST['members'])) {
$page .= " <div align=center> <table width=\"65%\">";
$membersquery = doquery("SELECT * FROM {{table}} WHERE clanid='".$userrow["clanid"]."' ORDER BY memberstatus DESC LIMIT 1000", "users");
$rank = 1;

while ($row = mysql_fetch_array($membersquery)) {
if($row["memberstatus"] == 0) { $status = "Squire"; } elseif($row["memberstatus"] == 1) { $status = "Man-at-Arms"; } elseif($row["memberstatus"] == 2) { $status = "Bill-Man"; } elseif($row["memberstatus"] == 3) { $status = "Banneret Knight"; } elseif($row["memberstatus"] == 4) { $status = "Bachelor Knight"; } elseif($row["memberstatus"] == 5) { $status = "Feudal Lord"; }  elseif($row["memberstatus"] == 6) { $status = "Constable"; }  elseif($row["memberstatus"] == 7) { $status = "Marshal"; }
$page .= "<tr><td>Rank:   $rank</td><td>Member:   <a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td><td>Level:   ".$row["level"]."</td><td>Rank:   $status</td></tr>\n";
$rank++; }
$page .= "</table>\n<br /><br />\n </div> "; }

elseif(isset($_POST['kick'])) {
$page .= " <div align=center> <form action=index.php?do=clans method=post>";
$page .= "<table width=\"80%\">";
$membersquery = doquery("SELECT * FROM {{table}} WHERE clanid='".$userrow["clanid"]."' ORDER BY memberstatus DESC LIMIT 1000", "users");
$rank = 1;
while ($membersrow = mysql_fetch_array($membersquery)) {

if($membersrow["clanleader"] == 1) {  $kick = "";  }
else { $kick =" <a href=\"index.php?do=kick:".$membersrow["id"]."\">[Kick member]</a>"; }
$page .= "<tr><td width=\"10%\">$rank</td><td width=\"50\"><a href=\"index.php?do=onlinechar:".$membersrow["id"]."\" class=\"myButton2\">".$membersrow["charname"]."</a></td></td><td>$status</td><td>$kick</td></tr>\n";
$rank++; }
$page .= "</table>\n<br /><br />\n </div> "; }
display( 
$page, "The Clans"); }

?>