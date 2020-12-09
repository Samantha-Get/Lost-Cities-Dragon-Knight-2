<?php


function bankexchange() {
	global $userrow, $numqueries;

	$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>Money Exchange Transactions - Cheating Error</h3></center><blockquote><b>Cheat attempt detected.<br />Get a life, loser.</b></blockquote><br />", "Error"); }

		if (isset($_POST['bankexchange'])) {
			$title = "Money Exchange";

			if ($_POST['withdraw']) {
				if ($_POST['withdraw'] <= 0) 
					$page = "<center><h3 class='title'>Money Exchange Transactions - Incorrect Error</h3></center><blockquote><blockquote><center><b><br><br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_withdraw.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><br><br><blockquote><blockquote><font color=\"#FFFFFF\"><b>You must enter an amount above 0!</b></font><br><br><b><div align=\"center\"><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></div></blockquote></blockquote><br /><br /></td></tr></table></center>";
                    elseif(!is_numeric($_POST["withdraw"])) 
                    $page = "<center><h3 class='title'>Money Exchange Transactions - Withdraw Input Error</h3></center><br><br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_withdraw.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><blockquote><blockquote><br><br><center><font color=\"#FFFFFF\"><b>You have invalid characters in your withdraw field</b>.</font><br /><br><div align=\"center\"><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></div></blockquote></blockquote></td></tr></table></center>"; 
				elseif ($_POST['withdraw'] > $userrow['bank'])
					$page = "<center><h3 class='title'>Money Exchange Transactions - Withdraw Gold Error</h3></center><br><br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_withdraw.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><blockquote><blockquote><br><br><center><font color=\"#FFFFFF\"><b>You dont have that much gold in the bank!</b></font><br /><br><div align=\"center\"><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></div></blockquote></blockquote></td></tr></table></center>"; 
				else {
					$newbankgold=$userrow['bankgold'] - intval($_POST['withdraw']);
					$newgold = $userrow['gold'] + intval($_POST['withdraw']);
					$newbank = $userrow['bank'] - intval($_POST['withdraw']);
					doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bank='$newbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankgold='$newbankgold'", "users");
					$page = "<center><h3 class='title'>Gold Bank Transactions</h3><br><br /><blockquote><blockquote><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_withdraw.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><br /><br /><blockquote><font color=\"#FFFFFF\"><b>You withdrew $_POST[withdraw] Gold Coins from the {{towncityname}} Gold Bank</b>.</font></center>";
					$page .= "<center><br /><br><b><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></blockquote></td></tr></table></center>";
				}

			} elseif ($_POST['deposit']) {
				if ($_POST['deposit'] <= 0) 
			$page = "<center><h3 class='title'>Money Exchange Transactions - Deposit Error - Above 0</h3><br><br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_deposit.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><blockquote><blockquote><font color=\"#FFFFFF\"><b>You must enter an amount above 0!</font></b></center><center><br><br><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></blockquote></blockquote></td></tr></table></center>";
           elseif(!is_numeric($_POST["deposit"])) 
           $page = "<center><h3 class='title'>Money Exchange Transactions - Deposit Error - Invalid Character</h3></center><blockquote><blockquote><br><br><center><font color=\"#FFFFFF\"><b>You have invalid characters in your deposit field. </font></b><br /><br><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br>
<br><a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></blockquote></blockquote>"; 
				elseif ($_POST['deposit'] > $userrow['gold'])
					$page = "<center><h3 class='title'>Money Exchange Transactions - Deposit Error - Need More Coins</h3><br><br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_deposit.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><br /><blockquote><blockquote><font color=\"#FFFFFF\"><b>You do not have that many Gold Coins!</font></b><br><br /><div align=\"center\"><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></div></blockquote></blockquote><br><br></td></tr></table></center>";
				else {
					$newbankgold=$userrow['bankgold'] + intval($_POST['deposit']);
					$newgold = $userrow['gold'] - intval($_POST['deposit']);
					$newbank = $userrow['bank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bank='$newbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankgold='$newbankgold'", "users");
					$page = "<center><h3 class='title'>Money Exchange Transactions</h3><br><br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank_deposit.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><br><br><br /><br /><blockquote><blockquote><font color=\"#FFFFFF\"><b>You have deposited $_POST[deposit] Gold Coins in the {{towncityname}} Gold Bank.</font></b></center>";
					$page .= "<center><br><br><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></blockquote></blockquote></td></tr></table></center>";
				}
			}
		} else {
			$title = "Gold Bank Transactions";
			$page .= "<center><h3 class='title'>Money Exchange Transactions</h3></center>";
			$page .= "<br><center><table align=\"center\" border=\"2\" background=\"images/background/city/bank.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"548\" height=\"964\"><tr><td><center><blockquote><blockquote><br><br><br><font color=\"#FFFFFF\"><b>Your {{towncityname}} Gold bank account currently holds $userrow[bank] Gold Coins. You have the following options:</font></span><br><br>";
			$page .= "<font color=\"#FFFFFF\"><form action=index.php?do=bank method=post><br />";
			$page .= "Gold:&nbsp;&nbsp;<input type=text value=$userrow[gold] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=bank class=myButton2></form><br />";
			$page .= "<form action=index.php?do=bank method=post><br />";
			$page .= "Gold Bank:&nbsp;&nbsp;<input type=text value=$userrow[bank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=bank class=myButton2></form><br />";
			$page .= "<form action=index.php?do=sendgold method=post><br />";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender /><br />";
			$page .= "<input type=submit value=Transfer name=sendgold class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=goldsent>&nbsp;&nbsp;Gold</span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coins to Character:&nbsp;&nbsp;</b></font><input name=reciever type=text></form>&nbsp;&nbsp;&nbsp;&nbsp;<br />";
			$page .= "<br><br><b><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></b></center></blockquote></blockquote></td></tr></table></center>";
				}
            
	display($page, $title);
    
}

?>