<?php


function banksilver() {
	global $userrow, $numqueries;

	$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>The Money Exchange Silver Transactions - Cheating Error</h3></center>Cheat attempt detected.<br />Get a life, loser.<br />", "Error"); }

		if (isset($_POST['banksilver'])) {
			$title = "The Money Exchange Silver Transactions";

			if ($_POST['withdraw']) {
				if ($_POST['withdraw'] <= 0) 
					$page = "<center><h3 class='title'>The Money Exchange Silver Transactions - Incorrect Error</h3></center><center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You must enter an amount above 0!</h4><br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";

                    elseif(!is_numeric($_POST["withdraw"])) 
                    $page = "<center><h3 class='title'>The Money Exchange Silver Transactions - Withdraw Input Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback><center>You have invalid characters in your withdraw field.</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>"; 

				elseif ($_POST['withdraw'] > $userrow['banksilver'])
					$page = "<center><h3 class='title'>The Money Exchange Silver Transactions - Withdraw Silver Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback><center>You <b>DO NOT</b> have that many Silver Coins in your Bank Account!</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>"; 
				else {
				
					$newbanksilver=$userrow['banksilver'] - intval($_POST['withdraw']);
					$newsilver = $userrow['silver'] + intval($_POST['withdraw']);
					$newsilverbank = $userrow['silverbank'] - intval($_POST['withdraw']);
					doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET silverbank='$newsilverbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET banksilver='$newbanksilver'", "users");
					
					$page = "<center><h3 class='title'>The Money Exchange Silver Transactions</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You withdrew $_POST[withdraw] Silver Coins from the {{towncityname}} Silver Bank.</center>";

					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}

			} elseif ($_POST['deposit']) {
				if ($_POST['deposit'] <= 0) 
			$page = "<center><h3 class='title'>The Money Exchange Silver Transactions - Deposit Error - Above 0</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You must enter an amount above 0!</h4></center><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";

           elseif(!is_numeric($_POST["deposit"])) 
           $page = "<center><h3 class='title'>The Money Exchange Silver Transactions - Deposit Error - Invalid Character</h3></center><br><br><center><h4 class=questback>You have invalid characters in your deposit field.</h4><br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>"; 

				elseif ($_POST['deposit'] > $userrow['silver'])
					$page = "<center><h3 class='title'>The Money Exchange Silver Transactions - Deposit Error - Need More Coins</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>You <b>DO NOT</b> have that many Silver Coins!</h4><br><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				else {
				
					$newbanksilver=$userrow['banksilver'] + intval($_POST['deposit']);
					$newsilver = $userrow['silver'] - intval($_POST['deposit']);
					$newsilverbank = $userrow['silverbank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET silverbank='$newsilverbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET banksilver='$newbanksilver'", "users");
					
					$page = "<center><h3 class='title'>The Money Exchange Silver Transactions</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>>You have deposited $_POST[deposit] Silver Coins in the {{towncityname}} Silver Bank.</h4></center>";
					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}
			}
		} else {
			$title = "The Money Exchange Silver Transactions";
			$page .= "<center><h3 class='title'>The Money Exchange Silver Transactions</h3></center>";
			$page .= "<br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br><br><br><center><h4 class=questback>center>Your {{towncityname}} Silver Bank account currently holds $userrow[silverbank] Silver Coins. You have the following options:</h4></span><br><br>";
			$page .= "<form action=index.php?do=banksilver method=post><br />";
			$page .= "Silver:&nbsp;&nbsp;<input type=text value=$userrow[silver] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=banksilver class=myButton2></form>";
			$page .= "<form action=index.php?do=banksilver method=post><br />";
			$page .= "Silver Bank:&nbsp;&nbsp;<input type=text value=$userrow[silverbank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=banksilver class=myButton2></form>";
			$page .= "<form action=index.php?do=sendsilver method=post><br />";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender /><br />";
			$page .= "<input type=submit value=Transfer name=sendsilver class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=silversent>&nbsp;&nbsp;Silver</span><br>&nbsp;&nbsp;Coins to Character:&nbsp;&nbsp;<input name=reciever type=text></form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />";
			$page .= "<br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";
				}
            
	display($page, $title);
    
}

?>