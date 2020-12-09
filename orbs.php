<?php

/*
Orb's v1.0

Script made by ErRoR

You may edit this script any way you like.

*/
if (file_exists('install_orbs_tables.php')) { die("Please delete <b>install_orbs_tables.php</b> from your Dragon Knight directory before continuing."); }
include "config.php";


function orbs() {
global $userrow, $numqueries;





if (isset($_POST['take'])) {
if($userrow['orbsrestart'] == 0){display("Sorry dude but you cant collect anymore orb's today!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }

$userorbs = $userrow["orbs"] + 2;
doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
doquery("UPDATE {{table}} SET orbsrestart='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");



/////////
///Orbs Collected
/////////


$page = '<center>';
$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
$page .= 'You have collected your 2 orbs today sucessfully<br><p>';
$page .= '</center><a href=\'index.php\'>Back to town</a>';
display($page, "Orb's");

}

if (isset($_POST['trade'])) {

$page = '<center>';
$page .= '<h3 class="title">.::Orb\'s::.</h3>';
$page .= '<h2><table bgcolor=grey border="5"s><tr>';
$page .= '<td><form action=index.php?do=orbs method=post><input type=submit value="Trade" name=trade1></td><td> 2 Orb\'s to 5 Gold</td></tr><tr>';
$page .= '<td><input type=submit value="Trade" name=trade2></td><td> 14 Orb\'s to +2 HP</td></tr><tr>';
$page .= '<td><input type=submit value="Trade" name=trade3></td><td> 14 Orb\'s to +2 MP</td></tr><tr>';
$page .= '<td><input type=submit value="Trade" name=trade4></td><td> 14 Orb\'s to +2 TP</td></tr><tr>';
$page .= '<td><input type=submit value="Trade" name=trade5></td><td> 22 Orb\'s to +2 Strength</td></tr><tr>';
$page .= '<td><input type=submit value="Trade" name=trade6></td><td> 22 Orb\'s to +2 Dexterity</form></td></tr>';
$page .= '</table></h2>';
$page .= '</center><a href=\'index.php\'>Back to town</a>';
display($page, "Orb's");

////////////
///Tradeing stuff
////////////

}else{
	if (isset($_POST['trade1'])) {
	if($userrow['orbs'] < 2){display("You dont have enough orb's to trade!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }
	
	$userorbs = $userrow["orbs"] - 2;
	doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

	$usergold = $userrow["gold"] + 5;
	doquery("UPDATE {{table}} SET gold='$usergold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

	$page = '<center>';
	$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
	$page .= 'You have sucessfully traded your 2 Orb\'s to 5 Gold<br><p>';
	$page .= '</center><a href=\'index.php\'>Back to town</a> or <a href=\'index.php?do=orbs\'>Back to trade</a>';
	display($page, "Orb's");
	}
	else{
		if (isset($_POST['trade2'])) {
		if($userrow['orbs'] < 14){display("You dont have enough orb's to trade!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }
		
		$userorbs = $userrow["orbs"] - 14;
		doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

		$userhp = $userrow["maxhp"] + 2;
		doquery("UPDATE {{table}} SET maxhp='$userhp' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

		$page = '<center>';
		$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
		$page .= 'You have sucessfully traded your 14 Orb\'s to +2 max HP<br><p>';
		$page .= '</center><a href=\'index.php\'>Back to town</a> or <a href=\'index.php?do=orbs\'>Back to trade</a>';
		display($page, "Orb's");
		}
		else{
			if (isset($_POST['trade3'])) {
			if($userrow['orbs'] < 14){display("You dont have enough orb's to trade!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }

			$userorbs = $userrow["orbs"] - 14;
			doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

			$usermp = $userrow["maxmp"] + 2;
			doquery("UPDATE {{table}} SET maxmp='$usermp' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

			$page = '<center>';
			$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
			$page .= 'You have sucessfully traded your 14 Orb\'s to +2 max MP<br><p>';
			$page .= '</center><a href=\'index.php\'>Back to town</a> or <a href=\'index.php?do=orbs\'>Back to trade</a>';
			display($page, "Orb's");
			}
			else{
				if (isset($_POST['trade4'])) {
				if($userrow['orbs'] < 14){display("You dont have enough orb's to trade!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }

				$userorbs = $userrow["orbs"] - 14;
				doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

				$usertp = $userrow["maxtp"] + 2;
				doquery("UPDATE {{table}} SET maxtp='$usertp' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

				$page = '<center>';
				$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
				$page .= 'You have sucessfully traded your 14 Orb\'s to +2 TP<br><p>';
				$page .= '</center><a href=\'index.php\'>Back to town</a> or <a href=\'index.php?do=orbs\'>Back to trade</a>';
				display($page, "Orb's");
				}
				else{
					if (isset($_POST['trade5'])) {
					if($userrow['orbs'] < 22){display("You dont have enough orb's to trade!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }

					$userorbs = $userrow["orbs"] - 22;
					doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

					$userstrength = $userrow["strength"] + 2;
					doquery("UPDATE {{table}} SET strength='$userstrength' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
		
					$page = '<center>';
					$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
					$page .= 'You have sucessfully traded your 22 Orb\'s to +2 Strength<br><p>';
					$page .= '</center><a href=\'index.php\'>Back to town</a> or <a href=\'index.php?do=orbs\'>Back to trade</a>';
					display($page, "Orb's");
					}
					else{
						if (isset($_POST['trade6'])) {
						if($userrow['orbs'] < 22){display("You dont have enough orb's to trade!<br><a href=\"index.php?\">Back to town</a>", "Orb's"); die(); }
						$userorbs = $userrow["orbs"] - 22;
						doquery("UPDATE {{table}} SET orbs='$userorbs' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

						$userdexterity = $userrow["dexterity"] + 2;
						doquery("UPDATE {{table}} SET dexterity='$userdexterity' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

						$page = '<center>';
						$page .= '<h3 class="title">.::Orb\'s::.</h3></center>';
						$page .= 'You have sucessfully traded your 22 Orb\'s to +2 Dexterity<br><p>';
						$page .= '</center><a href=\'index.php\'>Back to town</a> or <a href=\'index.php?do=orbs\'>Back to trade</a>';
						display($page, "Orb's");
						}
					}
				}
			}
		}
	}
}
				

/////////
///First PAGE LAYOUT
/////////


$page = '<center>';
$page .= '<h3 class="title">.::Orb\'s::.</h3>';
$page .='<h3>Collect your orbs here</H3><br><i>You can get only 2 orbs per day</i><br><p>';
$page .= '<form action=index.php?do=orbs method=post>';
$page .= '<input type=submit value="Take whats mine" name=take><p>or<p>';
$page .= '<input type=submit value="Trade orb\'s" name=trade>';
$page .= '</center><a href=\'index.php\'>Back to town</a>';

	display($page, "Orb's");







}


	
?>
