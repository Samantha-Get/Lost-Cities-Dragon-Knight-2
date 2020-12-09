<?php

function expforgold() { 
global $userrow, $numqueries; 
$townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns"); 
if (mysql_num_rows($townquery) != 1) { 
display("Cheat attempt detected.<br /><br />Get a life, loser.<br /><br />", "Error"); }

$page .= "<center><h3 class=\"title\">Local Experience Exchange<h3></center>";

 if (isset($_POST['expforsilver'])) { 
 $title = "Exchange"; if ($_POST['expexchange']) 
 
 { if ($_POST['expexchange'] <= 0) 
 $page = "<center><h3 class=\"title\">Local Experience Exchange<h3><br><br><br>Exchange Rate Add: 1 Experience Point for 1 Silver Coin.<br /><i>(You must enter a number of 1 or greater, or an error message will appear)</i></center><br><br><center><h4 class='questback'>You dont have that much Silver Coins on hand!</h4></center><blockquote><br /><br /><br /><center><a href=index.php?do=exchange class=myButton2>Exchange</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></center>";
 
 elseif ($_POST['expexchange'] > $userrow['silver'])
 $page = "<center><h3 class=\"title\">Local Experience Exchange<h3><br><br><br>Exchange Rate Add: 1 Experience Point for 1 Silver Coin.<br /><i>(You must enter a number of 1 or greater, or an error message will appear)</i></center><br><br><center><h4 class='questback'>You dont have that much Silver Coins on hand!</h4></center><blockquote><br /><br /><br /><center><a href=index.php?do=exchange class=myButton2>Exchange</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></center>";
  
 else { $newsilver = $userrow['silver'] - intval($_POST['expexchange']); 
 $newexperience = $userrow['experience'] + intval($_POST['expexchange']);
 doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
 doquery("UPDATE {{table}} SET experience='$newexperience' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
  
  $page = "<center><h3 class=\"title\">Local Experience Exchange<h3></center><br>";
  $page .= "<table align=\"center\" border=\"0\" background=\"images/background/city/exchange.png\" height=\"865\" width=\"700\"><tr><td><table align=\"center\" width=\"60%\"><tr><td nowrap=\"flag\">";	
  $page .= "<br /><br /><center><h4 class='questback'>You exchanged <span style=\"color: #92E4FF;\">$_POST[expexchange]</span> Silver Coins for <span style=\"color: #92E4FF;\">$_POST[expexchange]</span> Experience Points.</center></h4><br />"; 
  $page .= "<br /><br /><br /><center><a href=index.php?do=exchange class=myButton2>Exchange</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></center><br /></td></tr></table></td></tr></table>"; } } }

 else { $title = "Experience Exchange"; 
 $page .= "<table align=\"center\" border=\"0\" background=\"images/background/city/exchange.png\" height=\"865\" width=\"700\"><tr><td>";	
 $page .= "<table align=\"center\" width=\"60%\"><tr><td nowrap=\"flag\"><h4 class='questback'><div align=\"center\">You have <span style=\"color: #92E4FF;\">$userrow[silver]</span> Silver Coins."; 
 $page .= "<form action=index.php?do=exchange method=post><br />";
 $page .= "You must enter an amount above 0!<br><br>Number of Experience Points Wanted:<br /><br /><input type=text name=expexchange></h4>&nbsp;&nbsp;"; 
 $page .= "<center><input type=submit value=Exchange Silver for Experience name=expforsilver class=myButton2></center></form></div>"; 
 $page .= "<br /><br /><div align=\"center\"><a href=index.php class=myButton2>Town Square</a>&nbsp;&nbsp;<a href=index.php?do=exchange class=myButton2>Exchange</a></div></blockquote><br /></td></tr></table></td></tr></table>"; } 
 display($page, $title); } 

?>