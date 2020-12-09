<?php  

//  START OF THE TRAINING
function atttrain() {
global $userrow;

  $attcost = ($userrow["attackpower"] * $userrow["level"] * 4 + $userrow["attackpower"]);
  $dexcost = ($userrow["dexterity"] * $userrow["level"] * 4 + $userrow["dexterity"]);
  $strcost = ($userrow["strength"] * $userrow["level"] * 4 + $userrow["strength"]);
  $defcost = ($userrow["defensepower"] * $userrow["level"] * 4 + $userrow["defensepower"]);

$title = "Attribute Training Grounds"; 

$page .= "<center><h3 class=\"title\">Gold Attribute Training Grounds</h3></center><br>\n"; 

$page .= "<center><table width=\"100%\"><tr><td align=\"center\">\n"; 
$page .= "<center><table border=\"0\" width=\"96%\" class=\"TFtable\">

<tr><td colspan=\"2\" width=\"100%\" align=\"center\"><font color=\"#0080FF\">Which attribute do you want to improve?</font></td></tr>

<tr>
<td align=\"center\"><form action=\"index.php?do=atttrain\" method=\"post\"><input type=\"submit\" name=\"att\" value=\"Attack Power Training\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $attcost Gold Coins to raise Attack Power from ".$userrow["attackpower"]." to ".($userrow["attackpower"] + 1).".</td>
</tr>

<tr>
<td align=\"center\"><form action=\"index.php?do=atttrain\" method=\"post\"><input type=\"submit\" name=\"dex\" value=\"Dexterity Training\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $dexcost Gold Coins to raise Dexterity from ".$userrow["dexterity"]." to ".($userrow["dexterity"] + 1).".</td>
</tr>

<tr>
<td align=\"center\"><form action=\"index.php?do=atttrain\" method=\"post\"><input type=\"submit\" name=\"str\" value=\"Strength Training\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $strcost Gold Coins to raise Strength from ".$userrow["strength"]." to ".($userrow["strength"] + 1).".</td>
</tr>

<tr>
<td align=\"center\"><form action=\"index.php?do=atttrain\" method=\"post\"><input type=\"submit\" name=\"def\" value=\"Defense Power Training\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $defcost Gold Coins to raise Defense Power from ".$userrow["defensepower"]." to ".($userrow["defensepower"] + 1).".</td>
</tr>

<tr>
<td colspan=\"2\"><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

<tr>
<td colspan=\"2\"><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

<tr>
<td colspan=\"2\"><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

<tr>
<td colspan=\"2\"><center><a href=\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></td>
</tr>

<tr>
<td colspan=\"2\"><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
</table>
</td></tr></table>
</center>";

display($page, "{{towncityname}} Attribute Training Grounds"); }

  $attcost = ($userrow["attackpower"] * $userrow["level"] * 4 + $userrow["attackpower"]);
  $dexcost = ($userrow["dexterity"] * $userrow["level"] * 4 + $userrow["dexterity"]);
  $strcost = ($userrow["strength"] * $userrow["level"] * 4 + $userrow["strength"]);
  $defcost = ($userrow["defensepower"] * $userrow["level"] * 4 + $userrow["defensepower"]);

  
// Attackpower
  
 if (isset($_POST['att'])) {
    $cost = $attcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Gold Attack Power Attribute Training Grounds</h3><br><br><b>You Do Not Have Enough Gold Coins.</b><br /><br /><a href=\"index.php?do=atttrain\" class=\"myButton2\">Return to Training Grounds</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Attack Power Attribute Training Grounds"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `attackpower` = `attackpower` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Gold Attack Power Attribute Training Grounds</h3><br><br><b>Your training was successfull, you have increased your Attack Power attribute.<br />

<center><table width=\"100%\"><tr><td align=\"center\"><tr><td>
<center><table border=\"0\" width=\"96%\" class=\"TFtable\">

<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php?do=atttrain\" class=\"myButton2\">Gold Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=dextrain\" class=\"myButton2\">Silver Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=deftrain\" class=\"myButton2\">Copper Coins Training</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

</table>
</td></tr></table>

</center></center>";
display($page, "Attack Power Attribute Training Grounds"); } }


// Dexterity
  
 if (isset($_POST['dex'])) {
    $cost = $dexcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Gold Dexterity Attribute Training Grounds</h3><br><br><b>You Do Not Have Enough Gold Coins.</b><br /><br /><a href=\"index.php?do=atttrain\" class=\"myButton2\">Return to the Training Grounds</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Dexterity Attribute Training Grounds"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `dexterity` = `dexterity` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Gold Dexterity Attribute Training Grounds</h3><br><br><b>Your training was successfull, you have increased your Dexterity attribute.<br />

<center><table width=\"100%\"><tr><td align=\"center\"><tr><td>
<center><table border=\"0\" width=\"96%\" class=\"TFtable\">

<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php?do=atttrain\" class=\"myButton2\">Gold Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=dextrain\" class=\"myButton2\">Silver Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=deftrain\" class=\"myButton2\">Copper Coins Training</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

</table>
</td></tr></table>

</center></center>";
display($page, "Dexterity Attribute Training Grounds"); } }


// Strength
  
 if (isset($_POST['str'])) {
    $cost = $strcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Gold Strength Attribute Training Grounds</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=atttrain\" class=\"myButton2\">Return to Training Grounds</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Strength Attribute Training Grounds"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `strength` = `strength` + '1',  `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Gold Strength Attribute Training Grounds</h3><br><br><b>Your training was successfull, you have increased your Strength attribute.<br />

<center><table width=\"100%\"><tr><td align=\"center\"><tr><td>
<center><table border=\"0\" width=\"96%\" class=\"TFtable\">

<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php?do=atttrain\" class=\"myButton2\">Gold Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=dextrain\" class=\"myButton2\">Silver Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=deftrain\" class=\"myButton2\">Copper Coins Training</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

</table>
</td></tr></table>

</center></center>";
display($page, "Strength Attribute Training Grounds"); } }


// Defensepower
  
 if (isset($_POST['def'])) {
    $cost = $defcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Gold Defense Attribute Training School</h3><br><br><b>You Do Not Have Enough Gold Coins.</b><br /><br /><a href=\"index.php?do=atttrain\" class=\"myButton2\">Return to the Training Grounds</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Defense Attribute Training Grounds"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `defensepower` = `defensepower` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Gold Defense Attribute Training School</h3><br><br><b>Your training was successfull, you have increased your Defense attribute.<br />

<center><table width=\"100%\"><tr><td align=\"center\"><tr><td>
<center><table border=\"0\" width=\"96%\" class=\"TFtable\">

<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php?do=atttrain\" class=\"myButton2\">Gold Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=dextrain\" class=\"myButton2\">Silver Coins Training</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=deftrain\" class=\"myButton2\">Copper Coins Training</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>
<tr>
<td><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></td>
</tr>
<tr>
<td><center>&nbsp;&nbsp;&nbsp;</center></td>
</tr>

</table>
</td></tr></table>

</center></center>";
display($page, "Defense Attribute Training Grounds"); } }
  

  
  // END OF THE TRAINING

?>