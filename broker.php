<?php

function broker() { // START OF FUNCTION
global $userrow, $controlrow, $numqueries;
$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
$townrow = mysql_fetch_array($townquery);

$page = "<center><h3 class=\"title\">Town Pawn Broker</h3></center>";
$page .= "<br /><br /><div align=\"center\"><table width=\"690\" height=\"690\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\broker.jpg\" cellspacing=\"0\"><tr><td><table width=\"90%\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"4\"><tr><td>";
$page .= "<br><br><img src=\"images/npc/Millard Town Broker.png\" align=\"left\" width=\"200\" height=\"251\" title=\"Millard Town Broker\" alt=\"Millard Town Broker\" border=\"0\">";
$page .= "<br /><center><h3 class=\"title\">The Pawn Broker Shop</h3></center><br /><center> <table border=\"0\" align=\"center\"  width=\"80%\" cellpadding=\"2\" cellspacing=\"4\"><tr><td>&nbsp;</td><td align=\"left\" cellpadding=\"2\" cellspacing=\"4\"><h4 class='titlebroker'>You find <b>The Pawn Broker Shop</b>, at the end of a dark ally, in the old part of town. You spot that the <b>Pawn Broker</b> is still in his shop, and its well past dusk. Without looking up he greets you quietly as you enter the shop.<br /><br /> <b>The Pawn Broker asks:</b> Tell me what you have to sell. I will give you good Gold Coins for its value and we will both be happy.<br /><br /><b>You reply:</b> How much will you give me for this item? <br /><br /><b>The Pawn Broker replies:</b> Let me look at it so I can give you a fair price.</b>.</h4></td><td>&nbsp;</td></tr></table>
<br /></center>";


$page .= "<div align=\"center\"><br /><form action=\"index.php?do=confirm\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Appraise this Item\" class=\"myButton2\"><br /><br /><br /><select name=\"slot\">
<option value=\"1\">Slot 1: ".$userrow["slot1name"]."</option>
<option value=\"2\">Slot 2: ".$userrow["slot2name"]."</option>
<option value=\"3\">Slot 3: ".$userrow["slot3name"]."</option>
<option value=\"4\">Slot 4: ".$userrow["slot4name"]."</option>
<option value=\"5\">Slot 5: ".$userrow["slot5name"]."</option>
<option value=\"6\">Slot 6: ".$userrow["slot6name"]."</option>
<option value=\"7\">Slot 7: ".$userrow["slot7name"]."</option>
<option value=\"8\">Slot 8: ".$userrow["slot8name"]."</option></select></form><br /></div>";
$page .= "</div></td></tr></table></td></tr></table>";
$page .= "<br /><br /><div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div><br /></div>";
display($page, "broker"); } // END OF FUNCTION

function confirm() { // START OF THE CONFIRM FUNCTION
global $userrow, $controlrow, $numqueries;
$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
$townrow = mysql_fetch_array($townquery);
$dropquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["dropcode"]."' LIMIT 1", "drops");
$droprow = mysql_fetch_array($dropquery);
if (isset($_POST["submit"])) { 
$slot = $_POST["slot"];
$slotquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["slot".$slot."id"]."' LIMIT 1", "drops");
$slotrow = mysql_fetch_array($slotquery);
$drop = $slotrow["id"];
doquery("UPDATE {{table}} SET dropcode='$drop' WHERE id='".$userrow["id"]."' LIMIT 1", "users");


if ($userrow["slot".$slot."name"] == "None") { 
display("<center><h3 class=\"title\">Town Pawn Broker</h3></center>
<br /><br /><div align=\"center\"><table width=\"690\" height=\"690\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\broker.jpg\" cellspacing=\"0\"><tr><td><table width=\"90%\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"4\"><tr><td><br><br><img src=\"images/npc/Millard Town Broker.png\" align=\"left\" width=\"200\" height=\"251\" title=\"Millard Town Broker\" alt=\"Millard Town Broker\" border=\"0\"><br /><center><h3 class=\"title\">The Pawn Broker Shop</h3></center>
<br /><center><table border=\"0\" align=\"center\"  width=\"80%\" cellpadding=\"2\" cellspacing=\"4\"><tr><td>&nbsp;</td><td align='left'><h4 class='titlebroker'><b>The Pawn Broker states:</b> You need first to choose a item to sell.</h4><br /><br /><div align=center><a href=index.php?do=broker class=myButton2>Back to Pawn Broker</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></div></td><td>&nbsp;</td></tr></table></td></tr></table></td></tr></table><br /></center>","Error"); }


if ($userrow["slot".$slot."name"] == "Empty") { 
display("<center><h3 class=\"title\">Town Pawn Broker</h3></center>
<br /><br /><div align=\"center\"><table width=\"690\" height=\"690\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\broker.jpg\" cellspacing=\"0\"><tr><td><table width=\"90%\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"4\"><tr><td><br><br><img src=\"images/npc/Millard Town Broker.png\" align=\"left\" width=\"200\" height=\"251\" title=\"Millard Town Broker\" alt=\"Millard Town Broker\" border=\"0\"><br /><center><h3 class=\"title\">The Pawn Broker Shop</h3></center>
<br /><center><table border=\"0\" align=\"center\"  width=\"80%\" cellpadding=\"2\" cellspacing=\"4\"><tr><td>&nbsp;</td><td align='left'><h4 class='titlebroker'><b>The Pawn Broker states:</b> You need first to choose a item to sell.</h4><br /><br /><div align=center><a href=index.php?do=broker class=myButton2>Back to Pawn Broker</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></div></td><td>&nbsp;</td></tr></table></td></tr></table></td></tr></table><br /></center>","Error"); }


if ($userrow["slot".$slot."id"] != 0) {
$page = "<center><h3 class=\"title\">Town Pawn Broker</h3></center>";
$page .= "<br /><br /><div align=\"center\"><table width=\"690\" height=\"690\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\broker.jpg\" cellspacing=\"0\"><tr><td><table width=\"90%\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"4\"><tr><td>";
$page .= "<br><br><img src=\"images/npc/Millard Town Broker.png\" align=\"left\" width=\"200\" height=\"251\" title=\"Millard Town Broker\" alt=\"Millard Town Broker\" border=\"0\">";
$page .= "<br /><center><h3 class=\"title\">The Pawn Broker Shop</h3></center><br /><center> <table border=\"0\" align=\"center\"  width=\"50%\" cellpadding=\"2\" cellspacing=\"4\"><tr><td>&nbsp;</td><td align='left'><h4 class='titlebroker'><b>The Pawn Broker asks</b> if you are selling the following item. I will give you <b>".$slotrow["cost"]." GCs</b> for it. Do you wish to sell it?
<br /><br /><img src=\"images/drops/".$slotrow["name"].".png\" align=\"left\" width=\"86\" height=\"66\" title=\"".$slotrow["name"]."\" alt=\"".$slotrow["name"]."\" border=\"0\">
<br /><br /><form action=\"index.php?do=selldrop\" method=\"post\"><select name=\"slot\"><option value=\"$slot\">".$slotrow["name"]."</option></select>
<br /><br /><br />
<br /><b>Attributes that will be subtracted</b>:
<br />&nbsp; ".$slotrow["attribute1"]." 
<br />&nbsp; ".$slotrow["attribute2"]."  
<br />&nbsp; ".$slotrow["attribute3"]."
<br><br><div align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Sell this Item\" class=\"myButton2\"></form><br /><br /><a href=index.php?do=broker class=myButton2>Pawn Broker</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></div>
<br />
</h4></td><td>&nbsp;</td></tr></table></td></tr></table></td></tr></table><br /></center>"; }
display($page, "Confirm"); } } // END OF THE CONFIRM FUNCTION


function selldrop() { // START OF THE SELL DROP FUNCTION
global $userrow, $controlrow, $numqueries;
$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
$townrow = mysql_fetch_array($townquery);
if ($userrow["dropcode"] == 0) { 
header("Location: index.php");
die(); }
$dropquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["dropcode"]."' LIMIT 1", "drops");
$droprow = mysql_fetch_array($dropquery);
if (isset($_POST["submit"])) { 
$slot = $_POST["slot"];
if ($slot == 0) { 
display("<center><h3 class=title>Town Pawn Broker</h3></center><br /><br /><div align=center><table width=\"690\" height=\"690\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\broker.jpg\" cellspacing=\"0\"><tr><td><table width=85% align=center border=1 cellpadding=4 cellspacing=4><tr><td><img src=\"images/npc/Millard Town Broker.png\" align=\"left\" width=\"200\" height=\"251\" title=\"Millard Town Broker\" alt=\"Millard Town Broker\" border=\"0\"><br /><span style=\"font-family: Verdana; color:white; background-color:black; font-weight: normal; font-style: normal; text-decoration: none;\"><b>The Pawn Broker states:</b> You need to choose a item to sell.<br /><br /><br /><br /><div align=center><a href=index.php?do=broker class=myButton2>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></div></td></tr></table></td></tr></table>","Error"); }
if ($userrow["slot".$slot."id"] != 0) { 
$slotquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["slot".$slot."id"]."' LIMIT 1", "drops");
$slotrow = mysql_fetch_array($slotquery);
$old1 = explode(",",$slotrow["attribute1"]);
if ($slotrow["attribute2"] != "X") { 
$old2 = explode(",",$slotrow["attribute2"]); } 
else { 
$old2 = array(0=>"maxhp",1=>0); }
$new1 = explode(",",$droprow["attribute1"]);
if ($droprow["attribute2"] != "X") { 
$new2 = explode(",",$droprow["attribute2"]); } 
else { 
$new2 = array(0=>"maxhp",1=>0); }
$userrow[$old1[0]] -= $old1[1];
$userrow[$old2[0]] -= $old2[1];
if ($old1[0] == "strength") { 
$userrow["attackpower"] -= $old1[1]; }
if ($old1[0] == "dexterity") { 
$userrow["defensepower"] -= $old1[1]; }
if ($old2[0] == "strength") { 
$userrow["attackpower"] -= $old2[1]; }
if ($old2[0] == "dexterity") { 
$userrow["defensepower"] -= $old2[1]; }
if ($userrow["currenthp"] > $userrow["maxhp"]) { 
$userrow["currenthp"] = $userrow["maxhp"]; }
if ($userrow["currentmp"] > $userrow["maxmp"]) { 
$userrow["currentmp"] = $userrow["maxmp"]; }
if ($userrow["currenttp"] > $userrow["maxtp"]) { 
$userrow["currenttp"] = $userrow["maxtp"]; }
$refund = $slotrow["cost"];
$newgold = $userrow["gold"] + $refund;
$query = doquery("UPDATE {{table}} SET slot".$_POST["slot"]."name='Empty',slot".$_POST["slot"]."id='0',$old1[0]='".$userrow[$old1[0]]."',$old2[0]='".$userrow[$old2[0]]."',$new1[0]='".$userrow[$new1[0]]."',$new2[0]='".$userrow[$new2[0]]."',attackpower='".$userrow["attackpower"]."',defensepower='".$userrow["defensepower"]."',currenthp='".$userrow["currenthp"]."',currentmp='".$userrow["currentmp"]."',currenttp='".$userrow["currenttp"]."',gold='$newgold',dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); }

$page = "<center><h3 class=\"title\">Town Pawn Broker</h3></center>";
$page .= "<br /><br /><div align=\"center\"><table width=\"690\" height=\"690\" align=\"center\" border=\"0\" cellpadding=\"0\" background=\"images\background\city\broker.jpg\" cellspacing=\"0\"><tr><td><table width=\"90%\" align=\"center\" border=\"1\" cellpadding=\"4\" cellspacing=\"4\"><tr><td>";
$page .= "<br><br><img src=\"images/npc/Millard Town Broker.png\" align=\"left\" width=\"200\" height=\"251\" title=\"Millard Town Broker\" alt=\"Millard Town Broker\" border=\"0\">";
$page .= "<br /><center><h3 class=\"title\">The Pawn Broker Shop</h3></center><br /><center> <table border=\"0\" align=\"center\"  width=\"80%\" cellpadding=\"2\" cellspacing=\"4\"><tr><td>&nbsp;</td><td align='left'><h4 class='titlebroker'><img src=\"images/drops/".$slotrow["name"].".png\" align=\"left\" width=\"86\" height=\"66\" title=\"".$slotrow["name"]."\" alt=\"".$slotrow["name"]."\" border=\"0\"><br /><br /><b>The Pawn Broker</b> thanks you for selling him the<b> ".$slotrow["name"]." </b>for <b>".$slotrow["cost"]." Gold Coins</b>.</span><br /><br /><div align=center><a href=index.php?do=broker class=myButton2>Pawn Broker</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></h4></td><td>&nbsp;</td></tr></table></td></tr></table></td></tr></table>
<br /></center>";



display($page, "Sell Drop"); } } // END OF THE SELL DROP FUNCTION

?>