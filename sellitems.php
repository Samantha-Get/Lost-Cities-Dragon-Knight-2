<?php  // sellitems.php 

function sellitems(){
global $userrow, $numqueries;


// GET USER ITEMS
// $item1=$userrow['slot1name'];
// $item2=$userrow['slot2name'];
// $item3=$userrow['slot3name'];
// Some people have more than 3 slots so i added 5 more just incase.
// $item4=$userrow['slot4name'];
// $item5=$userrow['slot5name'];
// $item6=$userrow['slot6name'];
// $item7=$userrow['slot7name'];
// $item8=$userrow['slot8name'];
// Equipment
$item9=$userrow['weaponname'];
$item10=$userrow['armorname'];
$item11=$userrow['shieldname'];
$item12=$userrow['helmetname'];
$item13=$userrow['gauntletname'];
$item14=$userrow['bootname'];
$item15=$userrow['petname'];
$item16=$userrow['rangeweaponsname'];
$item17=$userrow['magicringsname'];

									
					// Sell Item 9 - Weapons
					
						if (isset($_POST['sell9'])){
						if($userrow['weaponid'] == 0 && $userrow['weaponname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><h4 class='titlebroker'>You can not sell what you do not have. <b>Please select an item</b> next time.</h4><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

						$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item9' LIMIT 1", "items");
						$itemsrow = mysql_fetch_array($itemsquery);
						$sellcost=$itemsrow["buycost"] / 2;
						$newgold=$userrow['gold'] + $sellcost;
						doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
						doquery("UPDATE {{table}} SET weaponid='0', weaponname='0'  WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item9</b> for <b>$sellcost Gold Coins</b>.<h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}						

					// Sell Item 10 - Armor
					
							if (isset($_POST['sell10'])){
							if($userrow['armorid'] == 0 && $userrow['armorname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><h4 class='titlebroker'>You can not sell what you do not have. <b>Please select an item</b> next time.</h4><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

							$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item10' LIMIT 1", "items");
							$itemsrow = mysql_fetch_array($itemsquery);
							$sellcost=$itemsrow["buycost"] / 2;
							$newgold=$userrow['gold'] + $sellcost;
							doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
							doquery("UPDATE {{table}} SET armorid='0', armorname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item10</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			
										
					// Sell Item 11 - Shields
					
								if (isset($_POST['sell11'])){
								if($userrow['shieldid'] == 0 && $userrow['shieldname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><span class='tooltip2'>You can not sell what you do not have. <b>Please select an item</b> next time.</span><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

								$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item11' LIMIT 1", "items");
								$itemsrow = mysql_fetch_array($itemsquery);
								$sellcost=$itemsrow["buycost"] / 2;
								$newgold=$userrow['gold'] + $sellcost;
								doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
								doquery("UPDATE {{table}} SET shieldid='0', shieldname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item11</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

								
					// Sell Item 12 - Helmets
					
								if (isset($_POST['sell11'])){
								if($userrow['helmetid'] == 0 && $userrow['helmetname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><span class='tooltip2'>You can not sell what you do not have. <b>Please select an item</b> next time.</span><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

								$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item12' LIMIT 1", "items");
								$itemsrow = mysql_fetch_array($itemsquery);
								$sellcost=$itemsrow["buycost"] / 2;
								$newgold=$userrow['gold'] + $sellcost;
								doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
								doquery("UPDATE {{table}} SET helmetid='0', helmetname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item12</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

	
										
					// Sell Item 13 - Gauntlet
					
								if (isset($_POST['sell11'])){
								if($userrow['gauntletid'] == 0 && $userrow['gauntletname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><span class='tooltip2'>You can not sell what you do not have. <b>Please select an item</b> next time.</span><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

								$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item13' LIMIT 1", "items");
								$itemsrow = mysql_fetch_array($itemsquery);
								$sellcost=$itemsrow["buycost"] / 2;
								$newgold=$userrow['gold'] + $sellcost;
								doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
								doquery("UPDATE {{table}} SET gauntletid='0', gauntletname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item13</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

										
					// Sell Item 14 - Boot
					
								if (isset($_POST['sell14'])){
								if($userrow['bootid'] == 0 && $userrow['bootname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><span class='tooltip2'>You can not sell what you do not have. <b>Please select an item</b> next time.</span><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

								$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item14' LIMIT 1", "items");
								$itemsrow = mysql_fetch_array($itemsquery);
								$sellcost=$itemsrow["buycost"] / 2;
								$newgold=$userrow['gold'] + $sellcost;
								doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
								doquery("UPDATE {{table}} SET bootid='0', bootname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");


$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item14</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

										
					// Sell Item 15 - Pet
					
								if (isset($_POST['sell15'])){
								if($userrow['petid'] == 0 && $userrow['petname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><span class='tooltip2'>You can not sell what you do not have. <b>Please select an item</b> next time.</span><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}

								$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item15' LIMIT 1", "items");
								$itemsrow = mysql_fetch_array($itemsquery);
								$sellcost=$itemsrow["buycost"] / 2;
								$newgold=$userrow['gold'] + $sellcost;
								doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
								doquery("UPDATE {{table}} SET petid='0', petname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item15</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

	
	// Sell Item 16 - rangeweapons
	
					
	if (isset($_POST['sell16'])){
	if($userrow['rangeweaponsid'] == 0 && $userrow['rangeweaponsname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><h4 class='titlebroker'>You can not sell what you do not have. <b>Please select an item</b> next time.</h4><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}


	$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item16' LIMIT 1", "items");
	$itemsrow = mysql_fetch_array($itemsquery);
	$sellcost=$itemsrow["buycost"] / 2;
	$newgold=$userrow['gold'] + $sellcost;

doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
doquery("UPDATE {{table}} SET rangeweaponsid='0', rangeweaponsname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
							
$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item16</b> for <b>$sellcost Gold Coins</b>.</h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

	
	
	// Sell Item 17 - magicrings
		
					
if (isset($_POST['sell17'])){
if($userrow['magicringsid'] == 0 && $userrow['magicringsname'] == 0) {display("<center><h3 class='title'>Sell Items</h3></center><br><br>
<div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br><h4 class='titlebroker'>You can not sell what you do not have. <b>Please select an item</b> next time.</h4><br><br><a href='index.php?do=sellitems' class='myButton2'>Back</a></td></tr></table></td></tr></table></div><br><br>", "Sell Items");}


	$itemsquery = doquery("SELECT * FROM {{table}} WHERE name='$item17' LIMIT 1", "items");
	$itemsrow = mysql_fetch_array($itemsquery);
	$sellcost=$itemsrow["buycost"] / 2;
	$newgold=$userrow['gold'] + $sellcost;
	
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
	doquery("UPDATE {{table}} SET magicringsid='0', magicringsname='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
							
$page .= '<center><h3 class="title">Item Sold</h3></center>';
$page .="<br><div align=center><table width='690' height='896' align='center' border='0' cellpadding='0' background='images\background\city\sellitems.jpg' cellspacing='0'><tr><td><table width='85%' align='center' border='0' cellpadding='4' cellspacing='4'><tr><td align='center'><br><br>";
$page .="<h4 class='titlebroker'>You have sold your <b>$item17</b> for <b>$sellcost Gold Coins</b></h4>";
$page .="<br><br><div align='center'><a href='index.php' class='myButton2'>Back To Town</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=sellitems' class='myButton2'>Sell Item</a></div>";
$page .="</td></tr></table></td></tr></table></div>";
display($page, "Sell Items");
}			

								
								
$page .= '<center><h3 class="title">Sell Items</h3></center>';
	$page .="<br><div align=center><table width=\"690\" height=\"896\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\sellitems.jpg\" cellspacing=\"0\"><tr><td><table width=\"90%\" align=\"center\" border=\"0\" cellpadding=\"4\" cellspacing=\"4\"><tr><td align=\"center\"><br><br><h4 class='titlebroker'>Sell your old Equipment for half the original purchase price.</h4></div><br><br>";
	$page .= "<div align=center><form action=index.php?do=sellitems method='post'><br><br>";
	$page .="<table class='TFtable'><tr>";

	$page .="<td colspan=\"2\"><h4 class='titlebroker'><div align=\"center\">Your Equipment:</div></h4></td></tr><tr>";
	$page .="<td>$item9</h4></td><td><input type=submit value=Sell name=sell9 class='myButton2'><br><br></td></tr><tr>";
	$page .="<td><span class='tooltip2'>$item10</span></td><td><input type=submit value=Sell name=sell10 class='myButton2'><br><br></td></tr><tr>";
	$page .="<td><span class='tooltip2'>$item11</span></td><td><input type=submit value=Sell name=sell11 class='myButton2'><br><br></td></tr>";
	$page .="<td><span class='tooltip2'>$item12</span></td><td><input type=submit value=Sell name=sell12 class='myButton2'><br><br></td></tr>";
	$page .="<td><span class='tooltip2'>$item13</span></td><td><input type=submit value=Sell name=sell13 class='myButton2'><br><br></td></tr>";
	$page .="<td><span class='tooltip2'>$item14</span></td><td><input type=submit value=Sell name=sell14 class='myButton2'><br><br></td></tr>";
	$page .="<td><span class='tooltip2'>$item15</span></td><td><input type=submit value=Sell name=sell15 class='myButton2'><br><br></td></tr>";
	$page .="<td><span class='tooltip2'>$item16</span></td><td><input type=submit value=Sell name=sell16 class='myButton2'><br><br></td></tr>";
	$page .="<td><span class='tooltip2'>$item17</span></td><td><input type=submit value=Sell name=sell17 class='myButton2'><br><br></td></tr>";
		$page .="</table></td></tr></table><br><br><div align=\"center\"><a href='index.php?do=inn' class='myButton2'>Town Inn</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?do=bank' class='myButton2'>Town Bank</a></div></div></td></tr></table>";
	$page .= "</form><br><br>";
display($page, "Sell Items");


}
?>
