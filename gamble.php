<?php

// Simple Gamble Mod By DarkGrave

function gamble() {
	global $userrow, $numqueries;

	$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.<br />", "Error"); }

		if (isset($_POST['subgamble'])) {

			$guess = $_POST['choice'];
			$winner = (rand()%10);

		if ($guess == $winner){

			$silverwin = intval($_POST['bet']) * 5;
			$newsilver = $userrow['silver'] + $silverwin;

				doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

		       $title = '{{innsname}} Gambling Hall 3 Cups Winner';
			$page = "<center><h3 class='title'>{{innsname}} Gambling Hall 3 Cups</h3></center>";
		   $page .= "<br /><br /><center><blockquote>Congratulations! May all your guesses be true. <b>You Gain  ".$silverwin." Silver Coins</b>.</center><br /><br />";
           $page .= "<br /><br /><center><a href=\"index.php?do=gamble\" class=\"myButton2\">Gamble Again</a>&nbsp;&nbsp;<a href=\"index.php?do=banksilver\" class=\"myButton2\">Silver Bank</a>&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></center>";

		  } else {
			
			$silverloss = intval($_POST['bet']);
			$newsilver = $userrow['silver'] - intval($_POST['bet']);

				doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

		       $title = '{{innsname}} Gambling Hall 3 Cups';
	$page = "<center><h3 class='title'>{{innsname}} Gambling Hall 3 Cups</h3></center>";
    $page .= "<br /><br /><br /><center><blockquote>You guessed wrong. <b>You Lose ".$silverloss." Silver Coins</b>.<br /><br />";
    $page .= "<a href=\"index.php?do=gamble\" class=\"myButton2\">Gamble Again</a>&nbsp;&nbsp;<a href=\"index.php?do=banksilver\" class=\"myButton2\">Silver Bank</a>&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></center>";
                 }

		} else {
            
            $title = '{{innsname}} Gambling Hall 3 Cups';
			$page = "<center><h3 class='title'>{{innsname}} Gambling Hall 3 Cups</h3></center>";
		    $page .= "<br /><center><blockquote>Pick a number and input your bet.<BR>The outcome could be a win or loss. Game Odds One out of Three.<br />You will increase your bet Five Fold if you win.</blockquote></center><br />";
			$page .= "<form action=\"index.php?do=gamble\" method=\"post\">";
			$page .= "<center><table width=\"60%\">";
			$page .= "<tr>";
			$page .= "<td width=\"20%\" style=\"text-align: center;\">";
			$page .= "1";
			$page .= "<br />";
			$page .= "<input type=\"radio\" name=\"choice\" value=\"1\" id=\"1\" />";
			$page .= "</td><td width=\"20%\" style=\"text-align: center;\">";
			$page .= "2";
			$page .= "<br />";
			$page .= "<input type=\"radio\" name=\"choice\" value=\"2\" id=\"2\" />";
			$page .= "</td><td width=\"20%\" style=\"text-align: center;\">";
			$page .= "3";
			$page .= "<br />";
			$page .= "<input type=\"radio\" name=\"choice\" value=\"3\" id=\"3\" />";
			$page .= "</td>";
			$page .= "</tr>";
			$page .= "</td>";
			$page .= "</tr>";
			$page .= "</table></center>";
			$page .= "<blockquote><center>";
            $page .= "Your Bet in Silver Coins: <input type=text name=bet><br /><br />";
            $page .= "<input type=\"submit\" value=\"BET\" name=\"subgamble\" class=\"myButton2\">";
            $page .= "</center></blockquote>";
			$page .= "</form >";
			
			
    $page .= "<br /><br /><center><a href=\"index.php?do=banksilver\" class=\"myButton2\">Silver Bank</a>&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></center>";


		}

	display($page, $title);

}
?>