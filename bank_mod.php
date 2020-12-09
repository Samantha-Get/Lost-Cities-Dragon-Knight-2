<?php


function bank() {
	global $userrow, $numqueries;

	$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>The Money Exchange Gold Transactions - Cheating Error</h3></center>Cheat attempt detected.<br />Get a life, loser.<br />", "Error"); }

		if (isset($_POST['bank'])) {
			$title = "The Money Exchange Gold Transactions";

			if ($_POST['withdraw']) {
				if ($_POST['withdraw'] <= 0) 
					$page = "<center><h3 class='title'>The Money Exchange Gold Transactions - Incorrect Error</h3></center><center><br><br><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You must enter an amount above 0!</h4><br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
                    elseif(!is_numeric($_POST["withdraw"])) 
                    $page = "<center><h3 class='title'>The Money Exchange Gold Transactions - Withdraw Input Error</h3></center><br><br><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You have invalid characters in your withdraw field.</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				elseif ($_POST['withdraw'] > $userrow['bank'])
					$page = "<center><h3 class='title'>The Money Exchange Gold Transactions - Withdraw Gold Error</h3></center><br><br><center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You <b>DO NOT</b> have that much gold in the bank!</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				else {
					$newbankgold=$userrow['bankgold'] - intval($_POST['withdraw']);
					$newgold = $userrow['gold'] + intval($_POST['withdraw']);
					$newbank = $userrow['bank'] - intval($_POST['withdraw']);
					doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bank='$newbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankgold='$newbankgold'", "users");
					
					$page = "<center><h3 class='title'>The Money Exchange Gold Transactions</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br /><br /><center><h4 class=\"questback\">You Withdrew: <span style=\"color: #92E4FF;\"><b>$_POST[withdraw]</b> Gold Coins</span><br>from The {{towncityname}} Money Exchange Bank.</h4></center><br><br><br>";
					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}

			} elseif ($_POST['deposit']) {
				if ($_POST['deposit'] <= 0) 
			$page = "<center><h3 class='title'>The Money Exchange Gold Transactions - Deposit Error - Above 0</h3><br><br><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You must enter an amount above 0!</h4></center><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
           elseif(!is_numeric($_POST["deposit"])) 
           $page = "<center><h3 class='title'>The Money Exchange Gold Transactions - Deposit Error - Invalid Character</h3></center><br><br><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You have invalid characters in your deposit field.</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				elseif ($_POST['deposit'] > $userrow['gold'])
					$page = "<center><h3 class='title'>The Money Exchange Gold Transactions - Deposit Error - Need More Coins</h3><br><br><center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You <b>DO NOT</b> have that many Gold Coins!</h4><br><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				else {
					$newbankgold=$userrow['bankgold'] + intval($_POST['deposit']);
					$newgold = $userrow['gold'] - intval($_POST['deposit']);
					$newbank = $userrow['bank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bank='$newbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankgold='$newbankgold'", "users");
					

					$page = "<center><h3 class='title'>The Money Exchange Gold Transactions</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br /><br /><center><h4 class=\"questback\">You Deposited: <span style=\"color: #92E4FF;\"><b>$_POST[deposit]</b> Gold Coins</span><br>from The {{towncityname}} Money Exchange Bank.</h4></center><br><br><br>";
					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";


				}
			}
		} else {
			$title = "The Money Exchange Gold Transactions";
			$page .= "<center><h3 class='title'>The Money Exchange Gold Transactions</h3></center>";
			$page .= "<br><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>Your {{towncityname}} Gold bank account currently holds $userrow[bank] Gold Coins. You have the following options:</h4></span><br><br>";
			$page .= "<form action=index.php?do=bank method=post><br />";
			$page .= "Gold:&nbsp;&nbsp;<input type=text value=$userrow[gold] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=bank class=myButton2></form><br />";
			$page .= "<form action=index.php?do=bank method=post><br />";
			$page .= "Gold Bank:&nbsp;&nbsp;<input type=text value=$userrow[bank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=bank class=myButton2></form><br />";
			$page .= "<form action=index.php?do=sendgold method=post><br />";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender /><br />";
			$page .= "<input type=submit value=Transfer name=sendgold class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=goldsent>&nbsp;&nbsp;Gold</span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coins to Character:&nbsp;&nbsp;<input name=reciever type=text></form>&nbsp;&nbsp;&nbsp;&nbsp;<br />";
			$page .= "<br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center>";
				}
            
	display($page, $title);
    
}

?>