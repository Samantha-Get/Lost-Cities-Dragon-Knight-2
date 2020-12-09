<?php
function fight0() {
global $userrow;

$fightlvl = $userrow["strength"] + $userrow["dexterity"]; 

$update = doquery("UPDATE {{table}} SET fightlvl='$fightlvl' WHERE id='".$userrow["id"]."' LIMIT 1","users"); // updates fighting level


$page .= "<table width=\"100%\" class=\"title\"><tr>
	<td><center><h3 class=\"title\">The Challenge Hall</h3></center></td></tr></table><br />";

$page.= "<a href=\"index.php?do=fight1\" class=\"myButton2\">Invitation to Challenge</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=fight2\" class=\"myButton2\">Accept Challenge</a>";

display($page, "The Challenge Hall"); }

// START Function FIGHT

function fight1() {
global $userrow, $numqueries;

if (isset($_POST['call'])) {
	$query = doquery("SELECT*FROM {{table}} WHERE charname='".$_POST['enemy']."' LIMIT 1", "users");
	$row = mysql_fetch_array($query);
	$maxbet = $userrow["experience"];
    $sum = $row["gold"] + $row["bank"] / 2;
	
if ($_POST['bet'] > $maxbet) { display("<b>Your bet is to high.<br />Max Bets is your Experience. Bets are Gold plus Bank / 2.<br /><br /><a href=\"index.php?do=fight1\" class=\"myButton2\">Try Again</a></b>", "Error"); die(); }

elseif ($_POST['bet'] > $userrow["gold"]) { display("<b>You dont have so much money.<br />Max Bets is your Experience. Bets are Gold plus Bank / 2.<br /><br /><a href=\"index.php?do=bank\" class="myButton2">Go to bank</a> or <a href=\"index.php?do=fight1\" class="myButton2">Try Again</a><b/>", "ERROR"); die(); }

elseif ($_POST['bet'] == "0") { display("<b>ERROR. Bet has to be bigger than 0.<br />Max Bets is your Experience. Bets are Gold plus Bank / 2.<br /><br /><a href=\"index.php?do=fight1\" class="myButton2">Try Again</a></b>", "ERROR"); die(); }

elseif ($_POST['enemy'] == "") { display("<b>Wrong charactername<br /><br /><a href=\"index.php?do=fight1\" class="myButton2">Go back</a></b>", "ERROR"); die(); }

 else {
$newgold2 = $userrow["gold"] - $_POST['bet'];
$fightlvl = $userrow["strength"] + $userrow["dexterity"]; 
doquery("INSERT INTO {{table}} SET id='', challenger='".$userrow["id"]."', bet='".$_POST['bet']."', charname='".$userrow["charname"]."', receiver='".$row["id"]."', fightlvl='$fightlvl'", "fight");

doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 

$page .= "<table width=\"100%\" class=\"title\"><tr>
	<td><center><h3 class=\"title\">Challenge</h3></center></td></tr></table><br />";

$page .= "<b>Royal Challenge Letter Sent.<br /><br /><a href=\"index.php\">Go to town.</a></b>"; } } 
else {
$maxbet = $userrow["experience"];
 			$page .= "<strong>Rival = opponents charname.<br />Bet = winner takes all</strong><br />";
			$page .= "<form action=index.php?do=fight1 method=post><br /><b>";
			$page .= "Rival: <input type=text name=enemy size=10><br />";
			$page .= "Maxbet is <strong>$$maxbet </strong><br />";
			$page .= "Bet:<input type=text name=bet size=10><br />";
			$page .= "<input type=submit value=Call name=call class=myButton2></form><b/><br /><br />"; 
	$page .= "<a href=\"index.php\" class="myButton2">Back to town</a>"; }
	
	
	display($page, "Challenge");
}


// END Function FIGHT





// START CHALLENGE

function fight2() {
	global $userrow, $numqueries;
    $page .= "<table width=\"100%\" class=\"title\"><tr>
	<td><center><h3 class=\"title\">Challenge</h3></center></td></tr></table><br />";
	
    $page .= "<center><table width=\"500\">
	<tr>
	<td>&nbsp;&nbsp;</td>
	<td width=\"200\"><strong>Challenger</strong></td>
	<td>&nbsp;&nbsp;</td>
	<td><strong>Bet</strong></td>
	<td>&nbsp;&nbsp;</td>
	</tr>"; 
 $query = doquery("SELECT*FROM {{table}} WHERE receiver='".$userrow["id"]."'", "fight");
 $rank = 1;
	while ($row = mysql_fetch_array($query)) {
	
	$page .= "<tr>
	<td><b>$rank</b></td>
	<td>".$row["charname"]."</td>
	<td >$".$row["bet"]."</td>
	<td><a href=\"index.php?do=fight3:".$row["id"]."\ class=\"myButton2\">[Take challenge]</a></td>
	<td><a href=\"index.php?do=fight4:".$row["id"]."\ class=\"myButton2\">[Deny]</a></td></tr>\n"; 
        
    $rank++;
	}
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"100%\" class=\"myButton2\" colspan=\"5\">No other Challenges await you.</td></tr>\n"; } // Which hopefully is not the case.
    $page .= "</table></center>";

$page .= "<a href=\"index.php\" class=\"myButton2\">To Town Square</a>";
	display($page, "Challenge");
}
 
// END CHALLENGE





// START FUNCTION FIGHT3

function fight3($id) { // 
	global $userrow, $numqueries;

 	$query = doquery("SELECT*FROM {{table}} WHERE id='$id'", "fight");
	$row = mysql_fetch_array($query);

 	$vastanequery = doquery("SELECT*FROM {{table}} WHERE id='".$row["challenger"]."'", "users"); 
	$vastanerow = mysql_fetch_array($vastanequery); // it is you rivals query...do not change it

if (isset($_POST['lose'])) {

//Send letter to winner

$win = $row["bet"] * 2;
$title = "Victory";
$message = "<b>You won duel against ".$userrow["charname"].". You won $".$win."<b/>";

doquery("INSERT INTO {{table}} SET id='', owner='".$row["challenger"]."', sender='', message='$message', title='$title', date=NOW()", "mail");

//update table winner
$newgold = $vastanerow["gold"] + $win;
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$row["challenger"]."'", "users");

//update table lose
$newgold2 =$userrow["gold"] - $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."'", "users");

//what displays
$page.= "You lost this challenge. You lost $".$row["bet"]."<p><a href=\"index.php\" class="myButton2">To Town Square</a>";

//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");

}  
 
elseif (isset($_POST['win'])) {

//send letter
$win = $row["bet"] * 2;
$title = "Challenge defeat";

$message = "<b>You were defeated by ".$userrow["charname"]." and you lost  $".$row["bet"]."</b>";

doquery("INSERT INTO {{table}} SET id='', owner='".$row["challenger"]."', sender='', message='$message', title='$title', date=NOW()", "mail");

//update table lose
$newgold = $vastanerow["gold"] - $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$row["challenger"]."' ", "users");

//update table win
$newgold2 = $userrow["gold"] + $row["bet"];
$updatequery = doquery("UPDATE {{table}} SET gold='$newgold2' WHERE id='".$userrow["id"]."' ", "users");

//what displays
$page.= "<b>You won. You got $".$row["bet"]." Back to <a href=\"index.php\" class="myButton2">Town Square</a></b>";

//delete row from mysql
doquery("DELETE FROM {{table}} WHERE id='$id'", "fight");

}

// END FUNCTION FIGHT3




// START - You LOSE

elseif ($row["fightlvl"] > $userrow["fightlvl"]) { 
 	$page.= "<table>";
	$page.= "<tr>
		<td><img src=\"".$userrow["avatarid"]."\"></td>
		<td>V.S</td>
		<td><img src=\"".$vastanerow["avatarid"]."\"></td>
			</tr><tr>
		<td>".$userrow["charname"]."</td>
		<td>&nbsp;&nbsp;</td>
		<td>".$vastanerow["charname"]."</td>
			</tr><tr>
		<td colspan="3"><b>You have been defeated.</b></td>
			</tr><tr>
		<td><form action=index.php method=post><input type=submit value='To Town Square' name=lose class=myButton2></td>
</tr></table>"; }

// END - You LOSE



// START - You WON

elseif ($vastanerow["fightlvl"] < $userrow["fightlvl"]) //you won
 { 
 	$page.= "<table>";
 	$page.= "<tr>
 		<td><img src=\"".$userrow["avatarid"]."\"></td>
 		<td> <b>V.S</b> </td>
		<td><img src=\"".$vastanerow["avatarid"]."\"></td>
			</tr><tr>
		<td>".$userrow["charname"]."</td>
		<td>&nbsp;&nbsp;</td>
		<td>".$vastanerow["charname"]."</td>
			</tr><tr>
		<td colspan="3">You have won this challenge</td>
			</tr><tr>
		<td colspan="3"><form action=index.php method=post><input type=submit value='To Town Square' name=won class=myButton2></td>
</tr></table>"; }
else { $page.="ERROR"; }
display($page, "Challenge"); 
}

// END - You WON




// START Delete challenge

 function fight4($id) { // 
    	
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
$page .= "<p><a href=\"index.php?do=fight2\" class=\"myButton2\">Back to Challenge Area</a>";

display($page, "Delete challenge");
}

// END Delete challenge

?>



