<?php  

//  START OF THE TRAINING
function strtrain() {
global $userrow;

  $attcost = ($userrow["attackpower"] * $userrow["attackpower"] * $userrow["strength"]);
  $strcost = ($userrow["strength"] * $userrow["strength"] * $userrow["attackpower"]); 
  $echcost = ($userrow["currentenchantment"] * $userrow["currentenchantment"] + $userrow["strength"]);
  $enrcost = ($userrow["currentenergy"] * $userrow["currentenergy"] + $userrow["strength"]);
  $hrocost = ($userrow["currentheroism"] * $userrow["currentheroism"] + $userrow["strength"]);;
  $itmcost = ($userrow["currentintimidate"] * $userrow["currentintimidate"] + $userrow["strength"]);
  $sthcost = ($userrow["currentstealth"] * $userrow["currentstealth"] + $userrow["strength"]);
  $wprcost = ($userrow["currentwillpower"] * $userrow["currentwillpower"] + $userrow["strength"]);

$title = "Strength Attribute Training"; 

$page .= "<center><h3 class=\"title\">Strength Attribute Training Camp</h3></center><br>\n"; 

$page .= "<center><table width=\"100%\"><tr><td align=\"center\">\n"; 
$page .= "<center><table border=\"0\" width=\"96%\" class=\"TFtable\">

<tr><td colspan=\"2\" width=\"100%\" align=\"center\"><font color=\"#16BA00\">Which attribute do you wish to improve, Attackpower, Strength,<br>Enchantment, Energy, Heroism, Intimidate, Stealth or Willpower?</font></td></tr>

<tr><td align=\"center\"><form action=\"index.php?do=atttrain\" method=\"post\"><input type=\"submit\" name=\"att\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $attcost Gold Coins to raise Attackpower from ".$userrow["attackpower"]." to ".($userrow["attackpower"] + 1).".</td></tr>

<tr><td align=\"center\"><form action=\"index.php?do=strtrain\" method=\"post\"><input type=\"submit\" name=\"str\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $strcost Gold Coins to raise Strength from ".$userrow["strength"]." to ".($userrow["strength"] + 1).".</td></tr>


<tr><td align=\"center\"><form action=\"index.php?do=dextrain\" method=\"post\"><input type=\"submit\" name=\"agi\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $agicost Gold Coins to raise Agility from ".$userrow["currentagility"]." to ".($userrow["currentagility"] + 1).".</td></tr>


<tr><td align=\"center\"><form action=\"index.php?do=dextrain\" method=\"post\"><input type=\"submit\" name=\"awr\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $awrcost Gold Coins to raise Awareness from ".$userrow["currentawareness"]." to ".($userrow["currentawareness"] + 1).".</td></tr>




<tr><td align=\"center\"><form action=\"index.php?do=strtrain\" method=\"post\"><input type=\"submit\" name=\"hro\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $hrocost Gold Coins to raise Heroism from ".$userrow["currentheroism"]." to ".($userrow["currentheroism"] + 1).".</td></tr>



<tr><td align=\"center\"><form action=\"index.php?do=strtrain\" method=\"post\"><input type=\"submit\" name=\"itm\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $itmcost Gold Coins to raise Intimidate from ".$userrow["currentintimidate"]." to ".($userrow["currentintimidate"] + 1).".</td></tr>



<tr><td align=\"center\"><form action=\"index.php?do=strtrain\" method=\"post\"><input type=\"submit\" name=\"sth\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $sthcost Gold Coins to raise Stealth from ".$userrow["currentstealth"]." to ".($userrow["currentstealth"] + 1).".</td></tr>



<tr><td align=\"center\"><form action=\"index.php?do=strtrain\" method=\"post\"><input type=\"submit\" name=\"wpr\" value=\"Train\" class=\"myButton2\" /></td>
<td>&nbsp;&nbsp;&nbsp;It will cost $wprcost Gold Coins to raise Willpower from ".$userrow["currentwillpower"]." to ".($userrow["currentwillpower"] + 1).".</td></tr>



<tr><td colspan=\"2\"><center><a href=\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></td></tr>
</table>
</td></tr></table>
</center>";

display($page, "{{towncityname}} Strength Attribute Training"); }

  $attcost = ($userrow["attackpower"] * $userrow["attackpower"] * $userrow["strength"]);
  $strcost = ($userrow["strength"] * $userrow["strength"] * $userrow["attackpower"]); 
  $echcost = ($userrow["currentenchantment"] * $userrow["currentenchantment"] + $userrow["strength"]);
  $enrcost = ($userrow["currentenergy"] * $userrow["currentenergy"] + $userrow["strength"]);
  $hrocost = ($userrow["currentheroism"] * $userrow["currentheroism"] + $userrow["strength"]);;
  $itmcost = ($userrow["currentintimidate"] * $userrow["currentintimidate"] + $userrow["strength"]);
  $sthcost = ($userrow["currentstealth"] * $userrow["currentstealth"] + $userrow["strength"]);
  $wprcost = ($userrow["currentwillpower"] * $userrow["currentwillpower"] + $userrow["strength"]);
  
  
  
  //Attackpower
  
 if (isset($_POST['att'])) {
    $cost = $attcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Attackpower Attribute Training University</h3><br><br><b>You Do Not Have Enough Gold Coins.</b><br /><br /><a href=\"index.php?do=atttrain\" class=\"myButton2\">Return to Training University</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Attackpower Attribute Training University"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `attackpower` = `attackpower` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Attackpower Attribute Training University</h3><br><br><b>You Successfully trained Attackpower.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to Training University</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>";
display($page, "Attackpower Attribute Training University"); } }
  
  
//strength
  
 if (isset($_POST['str'])) {
    $cost = $strcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Attackpower Attribute Training University</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=atttrain\" class=\"myButton2\">Return to Training University</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Attackpower Attribute Training University"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `strength` = `strength` + '1', `attackpower` = `attackpower` + '1',  `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Attackpower Attribute Training University</h3><br><br><b>You Successfully trained Strength.<br /><br /><a href=\"index.php?do=strrain\" class=\"myButton2\">Return to Training University</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center><b>";
display($page, "Attackpower Attribute Training University"); } }


//Enchantment
//enchantment
//Enchantment
  
 if (isset($_POST['ech'])) {
    $cost = $echcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Enchantment Attribute Training</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center>"; $die = true;
display($page, "Strength Attribute Training"); }
    
    if($die == false) {
      doquery("UPDATE {{table}} SET `currentenchantment` = `currentenchantment` + '1', `strength` = `strength` + '1',  `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Successfully trained Enchantment.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center><b>";
display($page, "Strength Attribute Training"); } }


//energy
//Energy
//energy
  
 if (isset($_POST['enr'])) {
    $cost = $enrcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>"; $die = true;
display($page, "Strength Attribute Training"); }

    if($die == false) {
      doquery("UPDATE {{table}} SET `currentenergy` = `currentenergy` + '1', `strength` = `strength` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Successfully trained Energy.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>";
display($page, "Strength Attribute Training"); } }


//heroism
//Heroism
//heroism 

 if (isset($_POST['hro'])) {
    $cost = $hrocost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>"; $die = true; 
display($page, "Strength Attribute Training"); }
    
    if($die == false){
      doquery("UPDATE {{table}} SET `currentheroism` = `currentheroism` + '1', `strength` = `strength` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Successfully trained Heroism.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>";
display($page, "Strength Attribute Training"); }
  }

//intimidate
//Intimidate
//intimidate

 if (isset($_POST['itm'])) {
    $cost = $itmcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>"; $die = true; 
display($page, "Strength Attribute Training"); }
    
    if($die == false){
      doquery("UPDATE {{table}} SET `currentintimidate` = `currentintimidate` + '1', `strength` = `strength` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Successfully trained Intimidate.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>";
display($page, "Strength Attribute Training"); }
  }

//stealth
//Stealth
//stealth

 if (isset($_POST['sth'])) {
    $cost = $sthcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>"; $die = true; 
display($page, "Strength Attribute Training"); }
    
    if($die == false){
      doquery("UPDATE {{table}} SET `currentstealth` = `currentstealth` + '1', `strength` = `strength` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Successfully trained Stealth.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>";
display($page, "Strength Attribute Training"); }
  }
  

//willpower
//Willpower
//willpower

 if (isset($_POST['wpr'])) {
    $cost = $wprcost;
    if($cost > $userrow["gold"]){ $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>"; $die = true; 
display($page, "Strength Attribute Training"); }
    
    if($die == false){
      doquery("UPDATE {{table}} SET `currentwillpower` = `currentwillpower` + '1', `strength` = `strength` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<center><h3 class=\"title\">Strength Attribute Training</h3><br><br><b>You Successfully trained Willpower.<br /><br /><a href=\"index.php?do=strtrain\" class=\"myButton2\">Return to the Training Camp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href\"index.php\" class=\"myButton2\">{{towncityname}} Town Square</a></center></b>";
display($page, "Strength Attribute Training"); }
  }
   
  
  // END OF THE TRAINING

?>