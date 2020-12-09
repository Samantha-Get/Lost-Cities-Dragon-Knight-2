<?php


function bankcopper() {
	global $userrow, $numqueries;

	$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>The Money Exchange Copper Transactions - Cheating Error</h3></center>Cheat attempt detected.<br />Get a life, loser.<br />", "Error"); }

		if (isset($_POST['bankcopper'])) {
			$title = "The Money Exchange Copper Transactions";

			if ($_POST['withdraw']) {
				if ($_POST['withdraw'] <= 0) 
					$page = "<center><h3 class='title'>The Money Exchange Copper Transactions - Incorrect Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You must enter an amount above 0!</h4><br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";

                    elseif(!is_numeric($_POST["withdraw"])) 
                    $page = "<center><h3 class='title'>The Money Exchange Copper Transactions - Withdraw Input Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback><center>You have invalid characters in your withdraw field.</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>"; 

				elseif ($_POST['withdraw'] > $userrow['bankcopper'])
					$page = "<center><h3 class='title'>The Money Exchange Copper Transactions - Withdraw Copper Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback><center>You <b>DO NOT</b> have that many Copper Coins in your Bank Account!</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>"; 
				else {
				
					$newbankcopper=$userrow['bankcopper'] - intval($_POST['withdraw']);
					$newcopper = $userrow['copper'] + intval($_POST['withdraw']);
					$newcopperbank = $userrow['copperbank'] - intval($_POST['withdraw']);
					
					doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET copperbank='$newcopperbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankcopper='$newbankcopper'", "users");
					
					$page = "<center><h3 class='title'>The Money Exchange Copper Transactions</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You withdrew $_POST[withdraw] Copper Coins from the {{towncityname}} Copper Bank.</center>";

					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}

			} elseif ($_POST['deposit']) {
				if ($_POST['deposit'] <= 0) 
			$page = "<center><h3 class='title'>The Money Exchange Copper Transactions - Deposit Error - Above 0</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You must enter an amount above 0!</h4></center><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";

           elseif(!is_numeric($_POST["deposit"])) 
           $page = "<center><h3 class='title'>The Money Exchange Copper Transactions - Deposit Error - Invalid Character</h3></center><br><br><center><h4 class=questback>You have invalid characters in your deposit field.</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>"; 

				elseif ($_POST['deposit'] > $userrow['copper'])
					$page = "<center><h3 class='title'>The Money Exchange Copper Transactions - Deposit Error - Need More Coins</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You <b>DO NOT</b> have that many Copper Coins!</h4><br><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				else {
				
					$newbankcopper=$userrow['bankcopper'] + intval($_POST['deposit']);
					$newcopper = $userrow['copper'] - intval($_POST['deposit']);
					$newcopperbank = $userrow['copperbank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET copperbank='$newcopperbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankcopper='$newbankcopper'", "users");
					
					$page = "<center><h3 class='title'>The Money Exchange Copper Transactions</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>>You have deposited $_POST[deposit] Copper Coins in the {{towncityname}} Copper Bank.</h4></center>";
					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}
			}
		} else {
			$title = "The Money Exchange Copper Transactions";
			$page .= "<center><h3 class='title'>The Money Exchange Copper Transactions</h3></center>";
			$page .= "<br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br><br><br><center><h4 class=questback>center>Your {{towncityname}} Copper Bank account currently holds $userrow[copperbank] Copper Coins. You have the following options:</h4></span><br><br>";
			$page .= "<form action=index.php?do=bankcopper method=post><br />";
			$page .= "Copper:&nbsp;&nbsp;<input type=text value=$userrow[copper] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=bankcopper class=myButton2></form>";
			$page .= "<form action=index.php?do=bankcopper method=post><br />";
			$page .= "Copper Bank:&nbsp;&nbsp;<input type=text value=$userrow[copperbank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=bankcopper class=myButton2></form>";
			$page .= "<form action=index.php?do=sendcopper method=post><br />";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender /><br />";
			$page .= "<input type=submit value=Transfer name=sendcopper class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=coppersent>&nbsp;&nbsp;Copper</span><br>&nbsp;&nbsp;Coins to Character:&nbsp;&nbsp;<input name=reciever type=text></form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />";
			$page .= "<br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}
            
	display($page, $title);
    
}

?>