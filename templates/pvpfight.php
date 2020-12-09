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
	
if ($_POST['bet'] > $maxbet) { display("<br /><br /><blockquote>Your bet is to high. MAX BET - Your Gold Coins plus your Gold in your Bank Example You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "Error"); die(); }

elseif ($_POST['bet'] > $userrow["gold"]) { display("<br /><br /><blockquote>You dont have that much money.<br /><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Go to bank</a> or <a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "ERROR"); die(); }

elseif ($_POST['bet'] < "0") { display("<br /><br /><blockquote>ERROR. Bet has to be bigger than 0. MAX BET - Your Gold Coins plus your Gold in your Bank Example You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "ERROR"); die(); }

elseif ($_POST['bet'] == "0") { display("<br /><br /><blockquote>ERROR. Bet has to be bigger than 0. MAX BET - Your Gold Coins plus your Gold in your Bank [Example: You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "ERROR"); die(); }

elseif ($_POST['enemy'] == "") { display("<br /><br /><blockquote>Wrong Character Name MAX BET - Your Gold Coins plus your Gold in your Bank [Example: You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "ERROR"); die(); }

elseif ($_POST['enemy'] == $userrow['charname']) { display("<br /><br /><blockquote>You can not Challenge yourself. MAX BET - Your Gold Coins plus your Gold in your Bank [Example: You have 300 Gold Coins plus 55 Gold Coins in your Bank, your MAX BET can be up to 355 Gold Coins. Or your BET can be up to your Experience level. Meaning if you have 133 Experience Points you can bet 133 Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Go Back</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "ERROR"); die(); }

elseif ($_POST['bet'] > $sum) { display("<br /><br /><blockquote>Your Rival Kingdom does not have that much Gold Coins.<br /><br /><a href=\"index.php?do=pvpfight\" class=\"myButton2\">Try Again</a> or to <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>", "ERROR");

} else {

$newgold2 = $userrow["gold"] - $_POST['bet'];
$fightlvl = $userrow["strength"] + $userrow["dexterity"]; 
doquery("INSERT INTO {{table}} SET id='', challenger='".$userrow["id"]."', bet='".$_POST['bet']."', charname='".$userrow["charname"]."', receiver='".$row["id"]."', fightlvl='$fightlvl'", "fight");

doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 

$page .= "<table width=\"100%\" class=\"title\"><tr>
	<td><center><h3 class=\"title\">The Challenge Hall</h3></center></td></tr></table><br /><br />";

$page .= "Royal Challenge Letter Sent.<br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a>"; } } 
else {
$maxbet = $userrow["gold"];
 			$page .= "Rival = opponents charname.<br />Bet = Winner Takes All<strong></strong><br />";
			$page .= "<form action=index.php?do=pvpfight method=post><br />";
			$page .= "Rival: <input type=text name=enemy size=10><br />";
			$page .= "Maxbet is <strong>$$maxbet </strong><br />";
			$page .= "Bet:<input type=text name=bet size=10><br />";
			$page .= "<input type=submit value=Send Challenge name=call class=myButton2></form><br /><br />"; 
	$page .= "<a href=\"index.php\" class=\"myButton2\">Town Square</a>"; }
	
	
	display($page, "Challenge");
}




function pvpfight2() {
global $userrow, $numqueries;

$page .= "<table width=\"100%\"><tr>
	<td><center><h3 class=\"title\">The Challenges</h3></center></td></tr></table><br /><br />";
	  
	  
    $page .= "<center><blockquote><table width=\"500\">"; 
 $query = doquery("SELECT*FROM {{table}} WHERE receiver='".$userrow["id"]."'", "fight");
 $rank = 1;
	while ($row = mysql_fetch_array($query)) {
	 $page .= "<tr>
	 <td><b>ID: $rank</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><b>Challenger: ".$row["charname"]."</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td <b>Bet: $".$row["bet"]."</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><b><a href=\"index.php?do=pvpfight3:".$row["id"]."\" class=\"myButton2\">Accept Challenge</a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><b><a href=\"index.php?do=pvpfight4:".$row["id"]."\" class=\"myButton2\">Deny Challenge</a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n"; 
        
    $rank++;
	}
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"100%\" colspan=\"5\"><b>You have no Challenges.</b></tr></tr>\n"; } // 
    $page .= "</table>";

$page .= "<br /><br /><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></blockquote></center>";
	display($page, "Challenge");
}
 





 function pvpfight3($id) { // 
global $userrow, $numqueries;

 $query = doquery("SELECT*FROM {{table}} WHERE id='$id'", "fight");
$row = mysql_fetch_array($query);

 $vastanequery = doquery("SELECT*FROM {{table}} WHERE id='".$row["challenger"]."'", "users"); 
$vastanerow = mysql_fetch_array($vastanequery); // it is you rivals query...do not change it

if(isset($_POST['lose'])) {

//Sed letter to winner
$auto = "Automessage PvP";
$win = $row["bet"] * 2;
$title = "Victory";
$message = "You won duel against ".$userrow["charname"].". You won $".$win."";
doquery("INSERT INTO {{table}} SET UserFrom='".$userrow["charname"]."', UserTo='".$row["challenger"]."', Message='$message', Subject='$title', SentDate=NOW()", "mail");

//update tabel....winner
$newgold = $vastanerow["gold"] + $win;
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$row["challenger"]."'", "users");
//update table...looser
$newgold2 =$userrow["gold"] - $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."'", "users");
//what displays
$page.= "You lost this challenge. You lost $".$row["bet"]."<p><a href=\"index.php\">back to town</a>";
//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");
}  
 
if(isset($_POST['draw'])) {

//Send letter draw
$auto = "Automessage PvP";
$title = "Draw";
$message = "You had fight with ".$userrow["charname"]." and it was draw.";
doquery("INSERT INTO {{table}} SET UserFrom='".$userrow["charname"]."', UserTo='".$row["challenger"]."', Message='$message', Subject='$title', SentDate=NOW()", "mail");
//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");
$page.= "<a href=\"index.php\">Back to Town</a>";
} 


elseif(isset($_POST['won'])) {
//send lewtter
$win = $row["bet"] * 2;
$title = "Challenge defeat";
$message = "You were defeated by ".$userrow["charname"]." and u lost  $".$row["bet"]."";
doquery("INSERT INTO {{table}} SET UserFrom='".$userrow["charname"]."', UserTo='".$row["challenger"]."', Message='$message', Subject='$title', SentDate=NOW()", "mail");
//update table...looser
$newgold = $vastanerow["gold"] - $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$row["challenger"]."' ", "users");
//update tabel....winner
$newgold2 = $userrow["gold"] + $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."' ", "users");
//what displays
$page.= "You won! You got $".$row["bet"]."<p><a href=\"index.php\">Back to town</a>";
//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");

}


elseif($row["fightlvl"] > $userrow["fightlvl"]) //you lose
 { $page.= "<table>";
 $page.= "<tr><td><img src=\"images/classes/".$userrow["charclass"].".jpg\"></td><td>V.S</td><td><img src=\"images/classes/".$row["challenger"].".jpg\"></td></tr><tr>".$userrow["charname"]."</td><td></td><td>".$vastanerow["charname"]."</td></tr><tr></tr><tr><td>What a Pitty, you lose!</td></tr><tr><td><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='To main page' name=lose></td></tr></table>"; }

elseif($row["fightlvl"] == $userrow["fightlvl"]) //draw
 { $page.= "<table>";
 $page.= "<tr><td><img src=\"images/classes/".$userrow["charclass"].".jpg\"></td><td>V.S</td><td><img src=\"images/classes/".$row["challenger"].".jpg\"></td></tr><tr>".$userrow["charname"]."</td><td></td><td>".$vastanerow["charname"]."</td></tr><tr></tr><tr><td>Draw!</td></tr><tr><td><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='To main page' name=draw></td></tr></table>";
///GIVE Challenger BACK HIS GOLD
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

elseif($vastanerow["fightlvl"] == $userrow["fightlvl"]) //draw
 { $page.= "<table>";
 $page.= "<tr><td><img src=\"images/classes/".$userrow["charclass"].".jpg\"></td><td>V.S</td><td><img src=\"images/classes/".$row["challenger"].".jpg\"></td></tr><tr>".$userrow["charname"]."</td><td></td><td>".$vastanerow["charname"]."</td></tr><tr></tr><tr><td>Draw!</td></tr><tr><td><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='To main page' name=draw></td></tr></table>"; }


elseif($vastanerow["fightlvl"] < $userrow["fightlvl"]) //you won
 { $page.= "<table>";
 $page.= "<tr><td><img src=\"images/classes/".$userrow["charclass"].".jpg\"></td><td>V.S</td><td><img src=\"images/classes/".$row["challenger"].".jpg\"></td></tr><tr>".$userrow["charname"]."</td><td></td><td>".$vastanerow["charname"]."</td></tr><tr></tr><tr><td>You have WON this challenge!!</td></tr><tr><td><form action=index.php?do=pvpfight3:$id method=post><input type=submit value='Back to main page' name=won></td></tr></table>"; }

else { $page.="ERROR"; }
display($page, "Challenge"); 
}



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
$page .= "<strong>Challenge deleted</strong>";
$page .= "<p><a href=\"index.php?do=pvpfight2\">Back to challenge area</a>";

display($page, "Delete challenge");
}
function mainfight() {
global $userrow;
$fightlvl = $userrow["strength"] + $userrow["dexterity"]; 
$update = doquery("UPDATE {{table}} SET fightlvl='$fightlvl' WHERE id='".$userrow["id"]."' LIMIT 1","users"); // updates fighting level
$page.= "<a href=\"index.php?do=pvpfight\">Invite to challenge</a><p><a href=\"index.php?do=pvpfight2\">Take challenge</a>";
display($page, "Main challenge hall"); }

?>