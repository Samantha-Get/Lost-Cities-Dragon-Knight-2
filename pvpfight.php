<?php
//made by doublet
//for more information: admin@maffia.pri.ee
function pvpfight() {
global $userrow, $numqueries;

if (isset($_POST['call'])) {
	$query = doquery("SELECT*FROM {{table}} WHERE charname='".$_POST['enemy']."' LIMIT 1", "users");
	$row = mysql_fetch_array($query);
	$maxbet = $userrow["gold"];
    $sum = $row["gold"] + $row["bank"] / 2;
	
if ($_POST['bet'] > $maxbet) { display("<br /><br /><center>Your bet is to high. MAX BET - Your Gold Coins plus your Gold in your Bank Example You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins.<br />Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "Error"); die(); }

elseif ($_POST['bet'] > $userrow["gold"]) { display("<br /><br /><center>You <b>DO NOT</b> have that much money.<br /><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Go to bank</a> or <a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "ERROR"); die(); }

elseif ($_POST['bet'] < "0") { display("<br /><br /><center><span style=\"color: #FF0000;\">ERROR.</span> Bet has to be bigger than 0. <br />MAX BET - Your Gold Coins plus your Gold in your Bank Example<br />You have 300 Gold Coins plus 55 Gold Coins in your Bank,<br />your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level.<br />Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "ERROR"); die(); }

elseif ($_POST['bet'] == "0") { display("<br /><br /><center><span style=\"color: #FF0000;\">ERROR.</span> Bet has to be bigger than 0. MAX BET - Your Gold Coins plus your Gold in your Bank [Example: You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level.<br />Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "ERROR"); die(); }

elseif ($_POST['enemy'] == "") { display("<br /><br /><center><span style=\"color: #FF0000;\">ERROR.</span> Wrong Character Name MAX BET - Your Gold Coins plus your Gold in your Bank [Example: You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "ERROR"); die(); }

elseif ($_POST['enemy'] == $userrow['charname']) { display("<br /><br /><center><span style=\"color: #FF0000;\">ERROR.</span> You can not Challenge yourself. MAX BET - Your Gold Coins plus your Gold in your Bank [Example: You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "ERROR"); die(); }

elseif ($_POST['bet'] > $sum) { display("<br /><br /><center><span style=\"color: #FF0000;\">ERROR.</span> Your Rival Kingdom does not have that many Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Try Again</a> or to <a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a></center>", "ERROR");

} else {

$newgold2 = $userrow["gold"] - $_POST['bet'];
$fightlvl = $userrow["strength"] + $userrow["dexterity"]; 
doquery("INSERT INTO {{table}} SET id='', challenger='".$userrow["id"]."', bet='".$_POST['bet']."', charname='".$userrow["charname"]."', receiver='".$row["id"]."', fightlvl='$fightlvl'", "fight");

doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 

$page .= "<table width=\"100%\"><tr>
	<td><center><h3 class=\"title\">The Challenge Hall - Letter Sent</h3></center></td></tr></table><br /><br />";

$page .= "<br /><br /><div align=center><table background='images/background/city/challenge-hall-2.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><center><table width='45%'><tr><td><center><br /><br /><br /><img src=\"images/items/map-editor-icon-Mac.png\" width=\"128\" height=\"128\" alt=\"Royal Letter and Map to Rival\" border=\"0\"><br /><br /><h4 class='questback'>Royal Challenge Letter Sent.</h4><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; <a href=\"index.php?do=mainfight\" class=\"myButton2\">Main Challenge Hall</a></center></td></tr></table></td></tr></table>"; } } 
else {


$maxbet = $userrow["gold"];
	$page .= "<table width=\"100%\"><tr><td><center><h3 class=\"title\">The Challenge Hall - Challenge Opponents</h3></center></td></tr></table><center><br />";
 	$page .= "<br /><br /><div align=center><table background='images/background/city/challenge-hall--full-6.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><center><table width='55%'><tr><td>";
 	$page .= "<center><h4 class='questback'><span style=\"color: #92E4FF;\">Rival = Opponents Name</span>. Check the Members List<br />for name of other players your can Challenge.</h4><br /><a href=\"index.php?do=viewmembers\" class=\"myButton2\">Members List</a><br />";
	$page .= "<form action=index.php?do=pvpfight method=post><br />";
	$page .= "<h4 class='questback'>Enter Rivals Name:</h4> <input type=text name=enemy size=30><br />";
	$page .= "<h4 class='questback'>Maxbet is <span style=\"color: #92E4FF;\">$maxbet</span> Gold Coins.&nbsp; &nbsp; Bet:</h4><input type=text name=bet size=10>";
	$page .= "&nbsp; &nbsp; <input type=submit value=Send Challenge name=call class=myButton2></form></center><br />"; 
	$page .= "</td></tr></table><br /><br /><a href=\"index.php?do=mainfight\" class=\"myButton2\">Challenge Hall</a>&nbsp; &nbsp; <a href=\"index.php\" class=\"myButton2\">Town Square</a></center></td></tr></table>"; }
		
	display($page, "Challenge - Opponents");
}



function pvpfight2() {
global $userrow, $numqueries;

$page .= "<table width=\"100%\"><tr>
	<td><center><h3 class=\"title\">The Challenges</h3></center></td></tr></table><br /><br />";
		  
    $page .= "<center><br /><div align=center><table background='images/background/city/the-challenges-2.png' align='center' width='800' height='1600' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><br /><center><table width='80%'><tr><td>"; 
 $query = doquery("SELECT*FROM {{table}} WHERE receiver='".$userrow["id"]."'", "fight");
 $rank = 1;
	while ($row = mysql_fetch_array($query)) {
	 $page .= "<tr>
	 <td align=\"center\"><h4 class='questback'>ID: $rank</h4></td>
	 <td align=\"center\"><h4 class='questback'>Challenger: ".$row["charname"]."</h4></td>
	 <td align=\"center\"><h4 class='questback'>Gold Bet: <span style=\"color: #92E4FF;\">".$row["bet"]."</span></h4></td>
	 <td align=\"center\"><br /><br /><a href=\"index.php?do=pvpfight3:".$row["id"]."\" class=\"myButton2\">Accept Challenge</a></td>
	 <td align=\"center\"><br /><br /><a href=\"index.php?do=pvpfight4:".$row["id"]."\" class=\"myButton2\">Deny the  Challenge</a></td>\n"; 
        
    $rank++;
	}
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"100%\" colspan=\"5\"><center><h4 class='questback'>You have <b>No</b> Challenges.</h4></center></tr></tr>\n"; } // 
    $page .= "</table><br /><br />";

$page .= "<br /><br /><center><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; <a href=\"index.php?do=mainfight\" class=\"myButton2\">Main Challenge Hall</a><br /><br /></center></center></tr></tr></table>";
	display($page, "Challenge");
}
 
 

 function pvpfight3($id) { // 
global $userrow, $numqueries;

 $query = doquery("SELECT*FROM {{table}} WHERE id='$id'", "fight");
$row = mysql_fetch_array($query);

 $vastanequery = doquery("SELECT*FROM {{table}} WHERE id='".$row["challenger"]."'", "users"); 
$vastanerow = mysql_fetch_array($vastanequery); // it is you rivals query...DO NOT change it

if(isset($_POST['lose'])) {

//Sed letter to winner
$auto = "Automessage PvP";
$win = $row["bet"] * 2;
$title = "Challenge Hall - Challenge Victory";
$message = "<div align=center>You <b>Won</b> duel against ".$userrow["charname"].". You <b>Won</b> <font color=#0080FF>".$win." Gold Coins</font>.<br /><br /><a href=\"index.php?do=mainfight\" class=\"myButton2\">Main Challenge Hall</a>&nbsp; &nbsp; <a href=\"index.php?do=pvpfight2\" class=\"myButton2\">Challengers</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>";
doquery("INSERT INTO {{table}} SET UserFrom='".$userrow["charname"]."', UserTo='".$row["challenger"]."', Message='$message', Subject='$title', SentDate=NOW()", "mail");

//update table....winner
$newgold = $vastanerow["gold"] + $win;
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$row["challenger"]."'", "users");
//update table...looser
$newgold2 =$userrow["gold"] - $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."'", "users");


//what displays
$page.= "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Challenge Hall - Challenge Lost</h3></center></td></tr></table>";
$page.= "<br /><br /><div align=center>You <b>Lost</b> this challenge. You <b>Lost</b> <font color=#0080FF>".$row["bet"]." Gold Coins</font>.<br /><br /><a href=\"index.php?do=mainfight\" class=\"myButton2\">Main Challenge Hall</a>&nbsp; &nbsp; <a href=\"index.php?do=pvpfight2\" class=\"myButton2\">Challengers</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>";
//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");
}  
 


elseif(isset($_POST['won'])) {
//send letter
$win = $row["bet"] * 2;
$title = "Challenge defeat";
$message = "You were defeated by ".$userrow["charname"]." and u lost  $".$row["bet"]."";
doquery("INSERT INTO {{table}} SET UserFrom='".$userrow["charname"]."', UserTo='".$row["challenger"]."', Message='$message', Subject='$title', SentDate=NOW()", "mail");

//update table...looser
$newgold = $vastanerow["gold"] - $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$row["challenger"]."' ", "users");

//update table....winner
$newgold2 = $userrow["gold"] + $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."' ", "users");

//what displays
$page.= "<center><h3 class=\"title\">The Challenges Hall: You Win</h3></center><br><br><center>You <b>Won</b> the Challenge<br><br>Your Rival gives you <font color=#0008FF>".$row["bet"]." Gold Coins.</font><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\">Town Gates</a><br /><br /><a href=\"index.php?do=mainfight\" class=\"myButton2\">Main Challenge Hall</a><br /><br /></center><br />";

//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");

}




// START DRAW

elseif ($row["fightlvl"] == $userrow["fightlvl"]) { 

$page.= "<table width=\"100%\"><tr>
	<td><center><h3 class=\"title\">The Challenges Hall: Draw</h3></center></td></tr></table><br /><br /><center><table width=\"50%\">";
$page.= "<tr>
<td valign=\"middle\" align=\"center\"><img src=\"images/classes/".$userrow["charclass"].".png\"></td>
<td valign=\"middle\" align=\"center\"><b><center><h3>VS</h3></center></b></td>
<td valign=\"middle\" align=\"center\"><img src=\"images/classes/".$row["challenger"].".png\"></td>
</tr>
<tr>
<td valign=\"middle\" align=\"center\"><b>".$userrow["charname"]."</b></td>
<td valign=\"middle\" align=\"center\"><b><center><h3>You have fought to a <b>Draw</b>.</h3></center></b></td>
<td valign=\"middle\" align=\"center\"><b>".$vastanerow["charname"]."</b></td>
</tr>
<tr>
<td colspan=\"3\"><br /><center><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='Main Challenge Hall' name=draw class=\"myButton2\"></center></td>
</tr>
</table></center>";


// GIVE Challenger BACK HIS GOLD

$query = doquery("SELECT * FROM {{table}} WHERE id='$id'", "fight");
$row = mysql_fetch_array($query);
$bet = $row["bet"];
$challenger = $row["challenger"];
$query2= doquery("SELECT gold FROM {{table}} WHERE id='$challenger'", "users");
$qrow = mysql_fetch_array($query2);
$bet2 = $qrow["gold"];
$newgold = $bet2 + $bet;
$query3 = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='$challenger' LIMIT 1", "users");
}

elseif ($vastanerow["fightlvl"] < $userrow["fightlvl"]) { 
$page.= "<table width=\"100%\"><tr>
	<td><center><h3 class=\"title\">The Challenges Hall: Lost</h3></center></td></tr></table><br /><br /><center><table width=\"50%\">";
$page.= "<tr>
<td valign=\"middle\" align=\"center\"><img src=\"images/classes/".$row["challenger"].".png\"></td>
<td valign=\"middle\" align=\"center\"><b><center><h3>VS</h3></center></b></td>
<td valign=\"middle\" align=\"center\"><img src=\"images/classes/".$userrow["charclass"].".png\"></td>
</tr>
<tr>
<td valign=\"middle\" align=\"center\"><b>".$vastanerow["charname"]."</b></td>
<td valign=\"middle\" align=\"center\"><b><center><h3>You have fought to a <b>Lost</b>.</h3></center></b></td>
<td valign=\"middle\" align=\"center\"><b>".$userrow["charname"]."</b></td>
</tr>
<tr>
<td colspan=\"3\"><br /><center><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='Main Challenge Hall' name=lose class=\"myButton2\"></center></td>
</tr>
</table></center>"; }

//END DRAW


//START You Win

elseif($vastanerow["fightlvl"] < $userrow["fightlvl"]) { 
$page.= "<table width=\"100%\"><tr>
<td><center><h3 class=\"title\">The Challenges Hall: You Won</h3></center></td></tr></table><br /><br /><center><table width=\"50%\">";
$page.= "<tr>
<td valign=\"middle\" align=\"center\"><img src=\"images/classes/".$userrow["charclass"].".png\"></td>
<td valign=\"middle\" align=\"center\"><b><center><h3>VS</h3></center></b></td>
<td valign=\"middle\" align=\"center\"><img src=\"images/classes/".$row["challenger"].".png\"><br /></td>
</tr><tr>
<td valign=\"middle\" align=\"center\"><b>".$userrow["charname"]."</b></td>
<td valign=\"middle\" align=\"center\"><b><center><h3>You Won</h3></center></b></td>
<td valign=\"middle\" align=\"center\"><b>".$vastanerow["charname"]."</b></td>
</tr><tr>
<td colspan=\"3\"><br /><center>You Have fought your Rival and have been <b>Won</b>! You <b>Win</b> this Challenge. <br /><br /><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='Main Challenge Hall' name=won class=\"myButton2\"></td></tr></table></center>"; }

else { $page.="ERROR"; }
display($page, "Challenge"); 
}

//END You Win


function pvpfight4($id) { // 
    	
global $userrow, $numqueries, $vastanerow;
$query = doquery("SELECT * FROM {{table}} WHERE id='$id'", "fight");
$row = mysql_fetch_array($query);
$bet = $row["bet"];
$challenger = $row["challenger"];

$query2= doquery("SELECT gold FROM {{table}} WHERE id='$challenger'", "users");
$qrow = mysql_fetch_array($query2);
$bet2 = $qrow["gold"];

$newgold = $bet2 + $bet;
$query3 = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='$challenger' LIMIT 1", "users");
$query12 = doquery("DELETE FROM {{table}} WHERE id='$id'  LIMIT 1", "fight");
$page .= "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Challenge Hall - Deleted</h3></center></td></tr></table><br /><br /><center><h3>Challenge Deleted</h3>";
$page .= "<br /><br /><a href=\"index.php?do=mainfight\" class=\"myButton2\">Main Challenge Hall</a><br /><br /> <a href=\"index.php\" class=\"myButton2\">Town Square</a>";

display($page, "Delete challenge");
}



function mainfight() {
global $userrow;
$fightlvl = $userrow["strength"] + $userrow["dexterity"]; 
$update = doquery("UPDATE {{table}} SET fightlvl='$fightlvl' WHERE id='".$userrow["id"]."' LIMIT 1","users");

$page.= "<table width=\"100%\"><tr><td><center><h3 class=\"title\">The Main Challenge Hall</h3></center></td></tr></table>";

 	$page .= "<br /><br /><div align=center><table background='images/background/city/challenge-hall-8.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><center><table width='55%'><tr><td>";
$page.= "<br /><br /><center><img src=\"images/classes/".$userrow["charclass"].".png\"><br /><br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Send Challenge</a><br /><br /><a href=\"index.php?do=pvpfight2\" class=\"myButton2\">Check Challenges</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></td></tr></table></td></tr></table>";
display($page, "Main challenge hall"); }

?>