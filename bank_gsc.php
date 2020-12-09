<?php


function bankgsc() {
	global $userrow, $numqueries;
	
	    // Bank Gold Silver Copper.
	    // elseif ($do[0] == "bankgsc") { include('bank_gsc.php'); bankgsc(); }	
	    // elseif ($do[0] == "sendgoldgsc") { sendgoldgsc(); }
	    // elseif ($do[0] == "sendsilvergsc") { sendsilvergsc(); }
	    // elseif ($do[0] == "sendcoppergsc") { sendcoppergsc(); }
	
	

	$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>The Money Exchange - Cheating Error</h3></center>Cheat attempt detected.<br />Get a life, loser.<br />", "Error"); }

		if (isset($_POST['bankgsc'])) {
			$title = "The Money Exchange Transactions";

			if ($_POST['withdraw']) {
				if ($_POST['withdraw'] <= 0) 
					$page = "<center><h3 class='title'>Gold Bank Transactions - Incorrect Error</h3></center><center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br>You must enter an amount above 0!<br><br><div align=\"center\"><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div><br /><br /></td></tr></table></center>";
                    elseif(!is_numeric($_POST["withdraw"])) 
                    $page = "<center><h3 class='title'>Gold Bank Transactions - Withdraw Input Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br><center>You have invalid characters in your withdraw field.<br /><br><div align=\"center\"><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div></td></tr></table></center>"; 
				    elseif ($_POST['withdraw'] > $userrow['bank'])
					$page = "<center><h3 class='title'>Gold Bank Transactions - Withdraw Gold Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br><center>You <b>DO NOT</b> have that much gold in the bank!<br /><br><div align=\"center\"><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div></td></tr></table></center>"; 

				    elseif ($_POST['withdraw'] > $userrow['banksilver'])
					$page = "<center><h3 class='title'>Silver Bank Transactions - Incorrect Error</h3></center><center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br>You must enter an amount above 0!<br><br><div align=\"center\"><a href=index.php?do=bank class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div><br /><br /></td></tr></table></center>";
				    elseif ($_POST['withdraw'] > $userrow['banksilver'])
                    $page = "<center><h3 class='title'>Silver Bank Transactions - Withdraw Input Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br><center>You have invalid characters in your withdraw field.<br /><br><div align=\"center\"><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div></td></tr></table></center>"; 
				    elseif ($_POST['withdraw'] > $userrow['banksilver'])
					$page = "<center><h3 class='title'>Silver Bank Transactions - Withdraw Silver Error GSC</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br><center>You <b>DO NOT</b> have that much silver in the bank!<br /><br><div align=\"center\"><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div></td></tr></table></center>"; 

				    elseif ($_POST['withdraw'] > $userrow['bankcopper'])
					$page = "<center><h3 class='title'>Copper Bank Transactions - Incorrect Error</h3></center><center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br>You must enter an amount above 0!<br><br><div align=\"center\"><a href=index.php?do=bank class=myButton2>Copper Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=banksilver class=myButton2>Silver Bank</a></center></div><br /><br /></td></tr></table></center>";
				    elseif ($_POST['withdraw'] > $userrow['bankcopper'])
                    $page = "<center><h3 class='title'>Copper Bank Transactions - Withdraw Input Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br><center>You have invalid characters in your withdraw field.<br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center>"; 
				    elseif ($_POST['withdraw'] > $userrow['bankcopper'])
					$page = "<center><h3 class='title'>Copper Bank Transactions - Withdraw Copper Error</h3></center><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br><br><center>You <b>DO NOT</b> have that much copper in the bank!<br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center>"; 


				else {
					$newbankgold=$userrow['bankgold'] - intval($_POST['withdraw']);
					$newgold = $userrow['gold'] + intval($_POST['withdraw']);
					$newbank = $userrow['bank'] - intval($_POST['withdraw']);
					doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bank='$newbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankgold='$newbankgold'", "users");
								
					$newbanksilver=$userrow['banksilver'] - intval($_POST['withdraw']);
					$newsilver = $userrow['silver'] + intval($_POST['withdraw']);
					$newsilverbank = $userrow['silverbank'] - intval($_POST['withdraw']);
					doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET silverbank='$newsilverbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET banksilver='$newbanksilver'", "users");
				
					$newbankcopper=$userrow['bankcopper'] - intval($_POST['withdraw']);
					$newcopper = $userrow['copper'] + intval($_POST['withdraw']);
					$newcopperbank = $userrow['copperbank'] - intval($_POST['withdraw']);
					doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET copperbank='$newcopperbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankcopper='$newbankcopper'", "users");
					
					
					$page = "<center><h3 class='title'>The Money Exchange</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br /><br /><h4 class=\"questback\">You withdrew $_POST[withdraw] Gold Coins from the {{towncityname}} Gold Bank.</h4></center>";
					$page .= "<center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center>";
				}

			} elseif ($_POST['deposit']) {
				if ($_POST['deposit'] <= 0) 
			$page = "<center><h3 class='title'>Gold Bank Transactions - Deposit Error - Above 0</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br>You must enter an amount above 0!</center><center><br><br><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></td></tr></table></center>";
           elseif(!is_numeric($_POST["deposit"])) 
           $page = "<center><h3 class='title'>Gold Bank Transactions - Deposit Error - Invalid Character</h3></center><br><br><center>You have invalid characters in your deposit field. <br /><br><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br>
<br><a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center>"; 
			elseif ($_POST['deposit'] > $userrow['gold'])
			$page = "<center><h3 class='title'>Gold Bank Transactions - Deposit Error - Need More Coins</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br />You <b>DO NOT</b> have that many Gold Coins!<br><br /><div align=\"center\"><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div><br><br></td></tr></table></center>";

			elseif ($_POST['deposit'] > $userrow['silver'])
			$page = "<center><h3 class='title'>Silver Bank Transactions - Deposit Error - Above 0</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br>You must enter an amount above 0!</center><center><br><br><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></td></tr></table></center>";
			elseif ($_POST['deposit'] > $userrow['silver'])
           $page = "<center><h3 class='title'>Silver Bank Transactions - Deposit Error - Invalid Character</h3></center><br><br><center>You have invalid characters in your deposit field. <br /><br><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br>
<br><a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center>"; 
			elseif ($_POST['deposit'] > $userrow['silver'])
			$page = "<center><h3 class='title'>Silver Bank Transactions - Deposit Error - Need More Coins</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br />You <b>DO NOT</b> have that many Silver Coins!<br><br /><div align=\"center\"><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=bankcopper class=myButton2>Copper Bank</a></center></div><br><br></td></tr></table></center>";

			elseif ($_POST['deposit'] > $userrow['copper'])
			$page = "<center><h3 class='title'>Copper Bank Transactions - Deposit Error - Above 0</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br>You must enter an amount above 0!</center><center><br><br><a href=index.php?do=bankcopper class=myButton2>Copper Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a><br /><br /><a href=index.php?do=bank class=myButton2>Gold Bank</a>&nbsp;&nbsp;<a href=index.php?do=banksilver class=myButton2>Silver Bank</a></center></td></tr></table></center>";
			elseif ($_POST['deposit'] > $userrow['copper'])
           $page = "<center><h3 class='title'>Copper Bank Transactions - Deposit Error - Invalid Character</h3></center><br><br><center>You have invalid characters in your deposit field. <br /><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center>"; 
			elseif ($_POST['deposit'] > $userrow['copper'])
			$page = "<center><h3 class='title'>Copper Bank Transactions - Deposit Error - Need More Coins</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br />You <b>DO NOT</b> have that many Copper Coins!<br><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center><br><br></td></tr></table></center>";


				else {

					$newbankgold=$userrow['bankgold'] + intval($_POST['deposit']);
					$newgold = $userrow['gold'] - intval($_POST['deposit']);
					$newbank = $userrow['bank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bank='$newbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankgold='$newbankgold'", "users");
				
					$newbanksilver=$userrow['banksilver'] + intval($_POST['deposit']);
					$newsilver = $userrow['silver'] - intval($_POST['deposit']);
					$newsilverbank = $userrow['silverbank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET silverbank='$newsilverbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET banksilver='$newbanksilver'", "users");
				
					$newbankcopper=$userrow['bankcopper'] + intval($_POST['deposit']);
					$newcopper = $userrow['copper'] - intval($_POST['deposit']);
					$newcopperbank = $userrow['copperbank'] + intval($_POST['deposit']);
					doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET copperbank='$newcopperbank' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
					doquery("UPDATE {{table}} SET bankcopper='$newbankcopper'", "users");	
					
					$page = "<center><h3 class='title'>The Money Exchange Deposit</h3><br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><br><br><br /><br /><h4 class=\"questback\">You have deposited $_POST[deposit] Gold Coins in the {{towncityname}} Gold Bank.</h4></center>";
			$page .= "<br><br><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></center>";
				}
			}
		} else {
			$title = "The Money Exchange Transactions";
			
			$page .= "<center><h3 class='title'>The Money Exchange Transactions</h3></center>";
			$page .= "<br><br><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=questback>Your {{towncityname}} <b>Bank Accounts</b> currently Holds:<br /><span style=\"color: #92E4FF;\">$userrow[bank] Gold</span>, <span style=\"color: #92E4FF;\">$userrow[silverbank] Silver</span> and <span style=\"color: #92E4FF;\">$userrow[copperbank] Copper</span> Coins.<br />Also you currently have <b>On Hand</b>:<br /><span style=\"color: #92E4FF;\">$userrow[gold] Gold</span>, <span style=\"color: #92E4FF;\">$userrow[silver] Silver</span> and <span style=\"color: #92E4FF;\">$userrow[copper] Copper</span> Coins.<br />You have the following options:</span></h4>";
			$page .= "<h4 class=questback><form action=index.php?do=bank method=post>";
			$page .= "Gold:&nbsp;&nbsp;<input type=text value=$userrow[gold] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=bank class=myButton2></form><br />";
			$page .= "<form action=index.php?do=bank method=post>";
			$page .= "Gold Bank:&nbsp;&nbsp;<input type=text value=$userrow[bank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=bank class=myButton2></form><br />";
			$page .= "<form action=index.php?do=sendgold method=post>";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender />";
			$page .= "<input type=submit value=Transfer name=sendgold class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=goldsent>&nbsp;&nbsp;Gold</span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coin{s} to Character:&nbsp;&nbsp;<input name=reciever type=text></form></h4>";

			$page .= "<h4 class=questback><form action=index.php?do=banksilver method=post>";
			$page .= "Silver:&nbsp;&nbsp;<input type=text value=$userrow[silver] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=banksilver class=myButton2></form>";
			$page .= "<form action=index.php?do=banksilver method=post><br />";
			$page .= "Silver Bank:<font color=\"#FF0000\">*</font>&nbsp;&nbsp;<input type=text value=$userrow[silverbank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=banksilver class=myButton2></form><br />";
			$page .= "<form action=index.php?do=sendsilver method=post>";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender />";
			$page .= "<input type=submit value=Transfer name=sendsilver class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=silversent>&nbsp;&nbsp;Silver</span><br>&nbsp;&nbsp;Coin{s} to Character:&nbsp;&nbsp;<input name=reciever type=text></form></h4>";

			$page .= "<h4 class=questback><form action=index.php?do=bankcopper method=post>";
			$page .= "Copper:&nbsp;&nbsp;<input type=text value=$userrow[copper] name=deposit>&nbsp;&nbsp;<input type=submit value=Deposit name=bankcopper class=myButton2></form>";
			$page .= "<form action=index.php?do=bankcopper method=post><br />";
			$page .= "Copper Bank<font color=\"#FF0000\">*</font>:&nbsp;&nbsp;<input type=text value=$userrow[copperbank] name=withdraw>&nbsp;&nbsp;<input type=submit value=Withdraw name=bankcopper class=myButton2></form><br />";
			$page .= "<form action=index.php?do=sendcopper method=post>";
			$page .= "<input name=sender type=hidden value=$userrow[charname] id=sender />";
			$page .= "<input type=submit value=Transfer name=sendcopper class=myButton2>&nbsp;&nbsp;<input type=text value=1 name=coppersent>&nbsp;&nbsp;Copper</span><br>&nbsp;&nbsp;Coin{s} to Character:&nbsp;&nbsp;<input name=reciever type=text></form></h4>";


			$page .= "<h4 class=questback><div align=\"center\"><a href=\"index.php?do=viewmembers\" target=\"_blank\"><span style=\"color: #92E4FF;\">View Character Names</span></a><br /><font color=\"#FF0000\">* BUG: Withdrawing Money from Silver & Copper DOES NOT Work.</font></div></h4>";

			$page .= "<br><center><a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=treasury class=myButton2>Kingdom Treasury</a><br><br><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>";      
				}
            
	display($page, $title);
    
}

?>