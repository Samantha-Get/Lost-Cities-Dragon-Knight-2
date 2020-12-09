<?php
error_reporting(8);
define('DK_LOADED', '1');
if (file_exists('install_casino.php')) { die("Please delete the <b>install_casino.php</b> file from your Dragon Knight directory before continuing."); }
include('lib.php');
include('cookies.php');
$link = opendb();
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);
$userrow = checkcookies();
if ($userrow == false) { 
    if (isset($_GET["do"])) {
        if ($_GET["do"] == "verify") { header("Location: users.php?do=verify"); die(); }
    }
    header("Location: login.php?do=login"); die(); 
}
if ($controlrow["gameopen"] == 0) { display("The game is currently closed for maintanence. Please check back later.","Game Closed"); die(); }
if ($controlrow["verifyemail"] == 1 && $userrow["verify"] != 1) { header("Location: users.php?do=verify"); die(); }
if ($userrow["authlevel"] == 2) { die("Your account has been blocked. Please try back later."); }
//Town Stuff
$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
$townrow = mysql_fetch_array($townquery);

if (isset($_GET["do"])) {
    $do = explode(":",$_GET["do"]);
	if ($do[0] == "view") { view(); }
	elseif ($do[0] == "past") { past(); }
	elseif ($do[0] == "view2") { view2(); }
	elseif ($do[0] == "select") { select(); }
    elseif ($do[0] == "challenge") { challenge($do[1]); }
	elseif ($do[0] == "challenge2") { challenge2(); }
	elseif ($do[0] == "retract") { retract($do[1]); }
    elseif ($do[0] == "create") { create_bet(); }
} else { select(); }

function select() {//Select a game.
	global $userrow, $numqueries;
	$query7 = "SELECT * FROM dk_casino WHERE id!='".$userrow["id"]."' AND active='1' ORDER BY bet_id ASC";
	$result = @mysql_query ($query7); // Run the query.
	$num = mysql_num_rows ($result);
	// Fetch and print all the records.
	// Table header.
	$page .= '<center><h3 class="title">Select a Game</h3></center>';
	$page .= '<center><table align="center" cellspacing="3" cellpadding="1" width="65%">';
	$page .= '<tr><td><br><br>Both <b>Coin Flip</b> and  <b>Stone, Parchment, Sword</b> are Two-Player Games. You place your bets and another Player Challenges your bet(s). You can Retract you Selection (or bet) anytime, before it is Challenged by another player. If you win the bet you will double your money, Lose and twice what you originally bet will be lost. </td></tr>';
	$page .= '<tr><td align="center"><br><br><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp; <a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a>&nbsp; &nbsp; &nbsp; <a href="index.php" class="myButton2">Town Square</a></td></tr>';
	$page .= '</table>';
	$page .= '</center>';
	display($page, "Casino -- Select Game");
}


function view() { // View all Coin Flip active bets
	global $userrow, $numqueries;
	$query7 = "SELECT * FROM dk_casino WHERE id!='".$userrow["id"]."' AND active='1' AND type='0' ORDER BY bet_id ASC";
	$result = @mysql_query ($query7); // Run the query.
	$num = mysql_num_rows ($result);
	// Fetch and print all the records.
	if ($num > 0) {
	// Table header.
	$page .= '<center><h3 class="title">Current Bets - Coin Flip</h3></center>';
	$page .= '<br><center><table align="center" style="padding: 5px; border: 1px solid black;" cellspacing="3" cellpadding="1"><tr><td align="left"><b>Username</b></td><td align="left"><b>Amount</b></td><td align="left"><b>Challenge</b></td></tr>';
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$page .= '<tr><td align="left">'.stripslashes($row[2]).'</td><td align="left">'.number_format($row[3]).'</td><td align="left"><a href="casino.php?do=challenge:'. $row[0] .'">Challenge</a></td><td></form></td></tr>';
		} 
	$page .= '</table></center><br>'; // Close the table.
	mysql_free_result ($result); // Free up the resources.	
	
	} else { 	
	

	$page .= '<center><h3 class="title">Current Bets - Coin Flip</h3></center>';
	$page .= '<br><center><table style="padding: 5px; border: 1px solid black;" align="center" cellspacing="3" cellpadding="1"><tr><td align="left">There are no current bets.</td></tr>';
	$page .= '</table></center><br>'; // Close the table.

	}
	//Your stuff.
	// Fetch and print all the records.
	$query5 = "SELECT * FROM dk_casino WHERE id='".$userrow["id"]."' AND active='1' AND type='0' ORDER BY amount ASC";
	$result1 = @mysql_query ($query5); // Run the query.
	$num1 = mysql_num_rows ($result1);
	if ($num1 > 0) {
	// Table header.
	$page .= '<center>';
	$page .= '<h3 class="title">Your Current Bets</h3>';
	$page .= '<br><table align="center" style="padding: 1px; border: 1px solid black;" cellspacing="3" cellpadding="3" ><tr><td align="left"><b>Amount</b></td><td align="left"><b>Retract</b></td></tr>';
	while ($row = mysql_fetch_array($result1, MYSQL_NUM)) {
		$page .= '<tr><td align="left">'.number_format($row[3]).'</td><td align="left"><a href="casino.php?do=retract:'. $row[0] .'">Retract</a></td></tr>';
		} 
	$page .= '</table><br>'; // Close the table.
	
	} else { 
	
	$page .= '<h3 class="title">Your Current Bets</h3><br>';	
	$page .= '<table align="center" style="padding: 1px; border: 1px solid black;" cellspacing="3" cellpadding="1"><tr><td align="left">You have no current bets.</td></tr>';
	$page .= '</table><br><br>'; // Close the table.
	}
	$page .= '<form action="casino.php?do=create" method="post">';
	$page .= '<center>Make a bet for <input name="amount" size=9> Gold.  <input name="confirm" type="checkbox" value="c"><tiny>(confirm)</tiny></center><br><br>';
	$page .= '<center><input class="button" type="submit" name="create" value="Make Bet" class="myButton2"></center>';
	$page .= '</form>';	
	$page .= '</center>';
	$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
	header("Refresh: 15; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
	display($page, "Casino -- View Bets");
	}
	
function view2() { // View all Stone, Parchment, Sword active bets
	global $userrow, $numqueries;
	$query7 = "SELECT * FROM dk_casino WHERE id!='".$userrow["id"]."' AND active='1' AND type='1' ORDER BY bet_id ASC";
	$result = @mysql_query ($query7); // Run the query.
	$num = mysql_num_rows ($result);
	// Fetch and print all the records.
	if ($num > 0) {
	// Table header.
	$page = '<center>';
	$page .= '<h3 class="title">Current Bets - Stone, Parchment, Sword</h3><br>';
	$page .= '<table align="center" style="padding: 5px; border: 1px solid black;" cellspacing="3" cellpadding="1"><tr><td align="left"><b>Username</b></td><td align="left"><b>Amount</b></td><td align="left"><b>Choice</b></td><td>&nbsp;</td><td><tiny>(confirm)</tiny></td></tr>';
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$page .= '<form action="casino.php?do=challenge2" method=POST><tr><td align="left">'.stripslashes($row[2]).'</td><td align="center">'.number_format($row[3]).'</td><td align="left"><input name="id" type="hidden" value="'.$row[0].'"><select name="choice"><option value="stone" selected="selected">Stone</option><option value="parchment">Parchment</option><option value="sword">Sword</option></td><td><input name="submit" type="submit" value="Challenge"></td><td><input name="confirm" type="checkbox" value="confirm"></td><td></form></td></tr>';
		} 
	$page .= '</table><br><br><br>'; // Close the table.
	mysql_free_result ($result); // Free up the resources.	
	} else { 	
	$page = '<center>';
	$page .= '<h3 class="title">Current Bets - Stone, Parchment, Sword</h3><br>';
	$page .= '<table style="padding: 5px; border: 1px solid black;" align="center" cellspacing="3" cellpadding="1"><tr><td align="left">There are no current bets.</td></tr>';
	$page .= '</table><br>'; // Close the table.


	}
	//Your stuff.
	// Fetch and print all the records.
	$query5 = "SELECT * FROM dk_casino WHERE id='".$userrow["id"]."' AND active='1' AND type='1' ORDER BY amount ASC";
	$result1 = @mysql_query ($query5); // Run the query.
	$num1 = mysql_num_rows ($result1);
	if ($num1 > 0) {
	// Table header.
	$page .= '<center>';
	$page .= '<h3 class="title">Your Current Bets</h3><br>';
	$page .= '<table align="center" style="padding: 1px; border: 1px solid black;" cellspacing="3" cellpadding="3" ><tr><td align="left"><b>Amount</b></td><td align="left"><b>Retract</b></td></tr>';
	while ($row = mysql_fetch_array($result1, MYSQL_NUM)) {
	$page .= '<tr><td align="left">'.number_format($row[3]).'</td><td align="left"><a href="casino.php?do=retract:'. $row[0] .'">Retract</a></td></tr>';
		} 
	$page .= '</table><br><br><br>'; // Close the table.
	
	} else { 
	
	$page .= '<h3 class="title">Your Current Bets</h3><br>';	
	$page .= '<table align="center" style="padding: 1px; border: 1px solid black;" cellspacing="3" cellpadding="1"><tr><td align="left">You have no current bets.</td></tr>';
	$page .= '</table><br><br>'; // Close the table.
	}
	$page .= '<form action="casino.php?do=create" method="post">';
	$page .= '<table align="center">';
	$page .= '<tr><td><center>Make a bet for <input name="amount" size=9> Gold.  </center></td></tr>';
	$page .= '<tr><td><center>Choose: <select name="choice"><option value="stone" selected="selected">Stone</option><option value="parchment">Parchment</option><option value="sword">Sword</option></select>  <input name="confirm" type="checkbox" value="c"><tiny>(confirm)</tiny></td></tr>';
	$page .= '<tr><td><center><input class="button" type="submit" name="create" value="Make Bet" class="myButton2"></center></td></tr>';
	$page .= '</table>';
	$page .= '</form>';	
	$page .= '</center>';
	$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
	header("Refresh: 15; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
	display($page, "Casino -- View Bets");
	}

function create_bet() { //Create a bet.
	global $userrow, $numqueries;
	$refer = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/casino.php?do=view";
	if (isset($_POST['create']) AND (isset($_POST['confirm']))) {
		unset($_POST['confirm']);
		$query7 = "SELECT * FROM dk_casino WHERE id='".$userrow["id"]."' AND active='1'";
		$result = @mysql_query ($query7); // Run the query.
		$num = mysql_num_rows ($result);
		 if (is_numeric($_POST["amount"]) AND ($_POST['amount']  <= $userrow["gold"]) AND ($_POST['amount'] > 0) AND ($num < 10)) { //If the amount is numeric.
		 	$amount = $_POST['amount'];
			$newgold = $userrow['gold'] - intval($_POST['amount']);
			$id = $userrow["id"];
			$n = $userrow["username"];
			if ($_SERVER['HTTP_REFERER'] == $refer) { //If they came from the Coin Flip..
			doquery("INSERT INTO {{table}} (id, username, amount, type) VALUES ('$id', '$n', '$amount', '0')", "casino");
			doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");			
			header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
			
			} else { //If they came from Stone, Parchment, Sword
			
			$choice = $_POST["choice"];
			doquery("INSERT INTO {{table}} (id, username, amount, type, choice) VALUES ('$id', '$n', '$amount', '1', '$choice')", "casino");
			doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
			header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
			}
		} else {
		
				$page = '<center><h3 class="title">Bets - Error</h3></center>';
				$page .= '<center><br><br>';
				$page .= "Please enter an amount greater than 0<br>and at most equal to the amount of gold you have.<br>You may have no more than <b>10 bets</b> at a time.";
				$page .= '</center>';
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
		
			
				header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
		}
	} else {
		if ($_SERVER['HTTP_REFERER'] == $refer) { //If they came from the Coin Flip..
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
		} else {
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
		}
	}	
	display($page, "Casino -- Create Bet");
}

function challenge($id) { //Take someone's bet.
	global $userrow, $controlrow;
	$query9 = doquery("SELECT * FROM {{table}} WHERE bet_id='$id' AND active='1'", "casino");
	$casinorow = mysql_fetch_array($query9);
	if (isset($casinorow["bet_id"]) AND ($casinorow["username"] !== $userrow["username"])) { //If the bet exists & not themselves
		if ($userrow["gold"] >= $casinorow["amount"]) {
			$newgold = $userrow["gold"] - $casinorow["amount"];
			doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."'", "users");
			$player1 = $casinorow["username"]; //The person who made the bet
			$player2 = $userrow["username"]; //The person challenging
			$now_seconds = date("s"); 
			$better = $casinorow["username"];
			$query8 = doquery("SELECT * FROM {{table}} WHERE username='$better'", "users");
			$betterrow = mysql_fetch_array($query8);
			if(($now_seconds - (2 * floor($now_seconds/2))) == 0) { // If it's an even number.
				$gold1 = $casinorow["amount"] * 2;
				$gold = $gold1 + $betterrow["gold"];
				
				// Loser's Grand Total Starts
				$amount = number_format($casinorow["amount"]);
				$user_total = number_format($userrow["total"]);
				$grand = number_format($user_total - $amount) ;
				doquery("UPDATE {{table}} SET total='$grand' WHERE username='$player2'", "users");
				
				//Winner's Grand Total Begins
				$user_total2 = number_format($betterrow["total"]);
				$grand2 = number_format($user_total2 + $amount) ;
				doquery("UPDATE {{table}} SET gold='$gold', total='$grand2' WHERE username='$player1'", "users");
				doquery("UPDATE {{table}} SET active='0', winner='$player1' WHERE bet_id='".$casinorow["bet_id"]."'", "casino"); //Make it inactive & set winner
				$page = '<center><h3 class="title">Current Bets - You Win</h3></center>';
				$page .= '<center><br><br>';
				$page .= "You Lose $amount Gold Coins";
				$page .= '</center>';
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
				header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
				
			} else { // If it is odd. 	
				
				$user = $userrow["gold"];
				$amount = $casinorow["amount"] * 2;
				$amount1 = number_format($amount);
				$gold = $amount + $user;
				
				//Loser's total starts
				$user_total = number_format($betterrow["total"]);
				$amount2 = number_format($casinorow["amount"]);
				$grand2 = number_format($user_total - $amount2) ;
				doquery("UPDATE {{table}} SET total='$grand2' WHERE username='$player1'", "users");
				
				//Winner's total starts
				$user_total2 = number_format($userrow["total"]);
				$grand = number_format($user_total2 + $amount2) ;
				doquery("UPDATE {{table}} SET gold='$gold', total='$grand' WHERE username='$player2'", "users");
				$page = '<center><h3 class="title">Current Bets - You Win</h3></center>';
				$page .= '<center><br><br>';
				$page .= "You win $amount1 Gold Coins";
				$page .= '</center>';
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
				doquery("UPDATE {{table}} SET active='0', winner='$player2' WHERE bet_id='".$casinorow["bet_id"]."'", "casino");
				header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
			}
		} else {
			$page = 'You do not have enough gold to take that bet!';
				header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
		}
	} else {
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
	}
	display($page, "Casino -- Take Bet");
}

function challenge2() { //Rock, Paper, Scissors Challenge 
	global $userrow, $controlrow;
	$id = $_POST['id'];
	$choice = $_POST['choice'];
	$query9 = doquery("SELECT * FROM {{table}} WHERE bet_id='$id' AND active='1'", "casino");
	$casinorow = mysql_fetch_array($query9);
	if (isset($casinorow["bet_id"]) AND ($casinorow["username"] !== $userrow["username"]) AND (isset($_POST['confirm']))) { //If the bet exists & not themselves
		$choice2 = $casinorow["choice"];
		$better = $casinorow["username"];
		$query8 = doquery("SELECT * FROM {{table}} WHERE username='$better'", "users");
		$betterrow = mysql_fetch_array($query8);
		if ($userrow["gold"] >= $casinorow["amount"]) {
			$newgold = $userrow["gold"] - $casinorow["amount"];
			doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."'", "users");
			$player1 = $casinorow["username"]; //The person who made the bet
			$player2 = $userrow["username"]; //The person challenging
				if ($choice == 'Sword' AND $choice2 == 'parchment' OR $choice == 'parchment' AND $choice2 == 'stone' OR $choice == 'stone' AND $choice2 == 'Sword') { //If you win.
					$user = $userrow["gold"];
					$amount = $casinorow["amount"] * 2;
					$amount1 = number_format($amount);
					$gold = $amount + $user;
					
					//Loser's total starts
					$user_total = number_format($betterrow["total"]);
					$amount2 = number_format($casinorow["amount"]);
					$grand2 = number_format($user_total - $amount2) ;
					doquery("UPDATE {{table}} SET total='$grand2' WHERE username='$player1'", "users");
					
					//Winner's total starts
					$user_total2 = number_format($userrow["total"]);
					$grand = number_format($user_total2 + $amount2) ;
					doquery("UPDATE {{table}} SET gold='$gold', total='$grand' WHERE username='$player2'", "users");
				$page = '<center><h3 class="title">Current Bets - You Win</h3></center>';
				$page .= '<center><br><br>';
				$page .= "You win $amount1 Gold Coins";
				$page .= '</center>';
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
					doquery("UPDATE {{table}} SET active='0', winner='$player2' WHERE bet_id='".$casinorow["bet_id"]."'", "casino");
					header("Refresh: 10; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
				} elseif ($choice == $choice2) { //If it is a tie
				
					//Send Your gold back.
					$user = $userrow["gold"];
					$amount = $casinorow["amount"];
					$amount1 = number_format($amount);
					$gold = $amount + $user;
					doquery("UPDATE {{table}} SET gold='$gold' WHERE username='$player2'", "users");
					
					//Send the other person's gold back.
					$gold1 = $casinorow["amount"];
					$gold = $gold1 + $betterrow["gold"];
					doquery("UPDATE {{table}} SET gold='$gold' WHERE username='$player1'", "users");
				$page = '<center><h3 class="title">Current Bets - You Tie</h3></center>';
				$page .= '<center><br><br>';
				$page .= 'It\'s a tie!';
				$page .= '</center>';
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
					
					
					
					doquery("UPDATE {{table}} SET active='0', winner='none' WHERE bet_id='".$casinorow["bet_id"]."'", "casino");
					header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
				} else { // You lose.
					$gold1 = $casinorow["amount"] * 2;
					$gold = $gold1 + $betterrow["gold"];
					
					// Loser's Grand Total Starts
					$amount = number_format($casinorow["amount"]);
					$user_total = number_format($userrow["total"]);
					$grand = number_format($user_total - $amount) ;
					doquery("UPDATE {{table}} SET total='$grand' WHERE username='$player2'", "users");
					
					// 's Grand Total Begins
					$user_total2 = number_format($betterrow["total"]);
					$grand2 = number_format($user_total2 + $amount) ;
					doquery("UPDATE {{table}} SET gold='$gold', total='$grand2' WHERE username='$player1'", "users");
					doquery("UPDATE {{table}} SET active='0', winner='$player1' WHERE bet_id='".$casinorow["bet_id"]."'", "casino"); //Make it inactive & set winner
				$page = '<center><h3 class="title">Current Bets - You Win</h3></center>';
				$page .= '<center><br><br>';
				$page .= "You Lose $amount Gold Coins";
				$page .= '</center>';
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a><br><br><a href="casino.php?do=past" class="myButton2">Past Bets</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
					header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
				}
		} else {
			$page = 'You do not have enough gold to take that bet!';
				header("Refresh: 30; URL=http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
		}
	} else {
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");
	}
	display($page, "Casino -- Take Bet");
}
					
function retract($id) { // Take back a bet.
	global $userrow, $controlrow;
	$refer = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/casino.php?do=view2";
	$query9 = doquery("SELECT * FROM {{table}} WHERE bet_id='$id'", "casino");
	$casinorow = mysql_fetch_array($query9);
	if (isset($casinorow["bet_id"])) { // If the bet exists.
		$user_gold = $userrow["gold"];
		$amount = $casinorow["amount"];
		$gold = $amount + $user_gold;
		doquery("UPDATE {{table}} SET gold='$gold' WHERE username='".$userrow["username"]."'", "users");
		doquery("UPDATE {{table}} SET active='0' WHERE bet_id='$id' LIMIT 1", "casino"); //Delete it.
		doquery("DELETE FROM {{table}} WHERE bet_id='$id' LIMIT 1", "casino"); //Delete delete it.
		if ($_SERVER['HTTP_REFERER'] == $refer) {
			header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view2");  //Redirect to view2
			} else {
			header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
			}
	} else { //If there is no such bet.
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/casino.php?do=view");
	}
}
function past() { // View Your Past Bets
	global $userrow, $controlrow;
	$refer = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/casino.php?do=view2";
	$query = "SELECT * FROM dk_casino WHERE id='".$userrow["id"]."' AND active='0' AND winner!='none' ORDER BY bet_id ASC"; // Select all past bets.
	$result = @mysql_query ($query); // Run the query.
	$num = mysql_num_rows ($result);
	// Fetch and print all the records.
	if ($num > 0) {
	
	// Table header.
	$page = '<center>';
	$page .= '<center><h3 class="title">Past Bets</h3></center>';
	$page .= '<br><br><table align="center" style="padding: 5px; border: 1px solid black;" align="center" width= "30%" cellspacing="3" cellpadding="3"><tr><td align="left"><b>Winner</b></td><td align="left"><b>Amount</b></td></tr>';
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$page .= '<tr><td align="left">'.stripslashes($row[4]).'</td>   <td align="left">'.number_format($row[3]).'</td></tr>';
		} 
	$page .= '</table><br>'; // Close the table.
	
	
	mysql_free_result ($result); // Free up the resources.	
	} else { 	
	
	$page = '<center>';
	$page .= '<center><h3 class="title">Past Bets</h3></center>';
	$page .= '<br><br><center><table style="padding: 5px; border: 1px solid black;" align="center" width= "30%" cellspacing="3" cellpadding="1"><tr><td align="left">You have had no past bets.</td></tr>';
	$page .= '</table></center><br>'; // Close the table.
	}
	
	if ($userrow["total"] > 0) { //If their grand total is not negative
		$total = number_format($userrow["total"]);
		$page .= "<b><center>Grand Total: $total</center></b>";
		
	} else {
	
		$total = number_format($userrow["total"]);
		$page .= "<b><center>Grand Total: $total</center></b>";
	}
	
	if ($_SERVER['HTTP_REFERER'] == $refer) {
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
	
	} else {
	
				$page .= '<br><br><center><a href="casino.php?do=view" class="myButton2">Coin Flip</a>&nbsp; &nbsp; &nbsp;<a href="casino.php?do=view2" class="myButton2">Stone, Parchment, Sword</a>&nbsp; &nbsp; &nbsp;<a href="index.php" class="myButton2">Town Square</a></center>';
	
	}
	display($page, "Casino -- Past Bets");
}




?>	