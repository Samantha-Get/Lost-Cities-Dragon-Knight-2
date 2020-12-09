<?php  

//  START OF THE TRAINING
function train() {
global $userrow;



  $strcost = ($userrow["strength"] * $userrow["strength"]);
  $dexcost = ($userrow["dexterity"]* $userrow["dexterity"]);
  $attcost = ($userrow["attackpower"] * $userrow["attackpower"]);
  $defcost = ($userrow["defensepower"] * $userrow["defensepower"]);


$title = "Attribute Training"; 



$page .= "<center><h3 class=\"title\">Attribute Training Camp</h3></center>\n"; 

$page .= "<center><table width=\"100%\"><tr><td align=\"center\">\n"; 
$page .= "<br><center><table border=\"1\" width=\"96%\" class=\"TFtable\">
  <tr>
     <td colspan=\"2\" width=\"100%\"><blockquote>Which attribute do you wish to improve, Strength, Dexterity, Attack Power or Defense Power ?</blockquote></td>
  </tr>
  <tr>
     <td align=\"center\"><form action=\"index.php?do=train\" method=\"post\"><input type=\"submit\" name=\"str\" value=\"Train\"  class=\"myButton2\" /></td>
     <td>&nbsp;&nbsp;&nbsp;It will cost $strcost Gold Coins to raise Strength from ".$userrow["strength"]." to ".($userrow["strength"] + 1).".</td>
  </tr>
  <tr>
     <td align=\"center\"><form action=\"index.php?do=train\" method=\"post\"><input type=\"submit\" name=\"dex\" value=\"Train\"  class=\"myButton2\" /></td>
     <td>&nbsp;&nbsp;&nbsp;It will cost $dexcost Gold Coins to raise Dexterity from ".$userrow["dexterity"]." to ".($userrow["dexterity"] + 1).".</td>
  </tr>
  <tr>
     <td align=\"center\"><form action=\"index.php?do=train\" method=\"post\"><input type=\"submit\" name=\"att\" value=\"Train\"  class=\"myButton2\" /></td>
     <td>&nbsp;&nbsp;&nbsp;It will cost $attcost Gold Coins to raise Attack from ".$userrow["attackpower"]." to ".($userrow["attackpower"] + 1).".</td>
  </tr>
  <tr>
     <td align=\"center\"><form action=\"index.php?do=train\" method=\"post\"><input type=\"submit\" name=\"def\" value=\"Train\" class=\"myButton2\" /></td>
     <td>&nbsp;&nbsp;&nbsp;It will cost $defcost Gold Coins to raise Defense from ".$userrow["defensepower"]." to ".($userrow["defensepower"] + 1).".</td>
  </tr>
  <tr>
     <td colspan=\"2\"><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></b></center></td>
  </tr>
</table></td></tr></table></center><br>";

display($page, "train"); 
}


  $strcost = ($userrow["strength"] * $userrow["strength"]);
  $dexcost = ($userrow["dexterity"]* $userrow["dexterity"]);
  $attcost = ($userrow["attackpower"] * $userrow["attackpower"]);
  $defcost = ($userrow["defensepower"] * $userrow["defensepower"]);
  

  
 if (isset($_POST['str'])) 
  {
    $cost = $strcost;
    if($cost > $userrow["gold"]){ $page = "<b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"/index.php?do=train\">Return to the Training Camp</a></b>"; $die = true;
display($page, "train"); }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `strength` = `strength` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<b>You Successfully trained strength.<br /><br /><a href=\"/index.php?do=train\">Return to Training Camp</a></b>";
display($page, "train"); 
    }
  }
  
 if (isset($_POST['dex']))
  {
    $cost = $dexcost;
    if($cost > $userrow["gold"]){ $page = "<b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"/index.php?do=train\">Return to Training</a></b>"; $die = true;
display($page, "train"); }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `dexterity` = `dexterity` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<b>You Successfully trained dexterity.<br /><br /><a href=\"/index.php?do=train\">Return to Training</a>/<b>";
display($page, "train"); 
    }
  }
  
 if (isset($_POST['att']))
  {
    $cost = $attcost;
    if($cost > $userrow["gold"]){ $page = "<b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"/index.php?do=train\">Return to Training</a></b>"; $die = true;
display($page, "train"); }
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `attackpower` = `attackpower` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<b>You Successfully trained attack.<br /><br /><a href=\"/index.php?do=train\">Return to Training</a></b>";
display($page, "train"); 
    }
  }


 if (isset($_POST['def']))
  {
    $cost = $defcost;
    if($cost > $userrow["gold"]){ $page = "<b>You Do Not Have Enough Gold Coins.<br /><br /><a href=\"/index.php?do=train\">Return to Training</a></b>"; $die = true; 
display($page, "train"); }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `defensepower` = `defensepower` + '1', `gold` = `gold` - '$cost' WHERE `id` = '".$userrow["id"]."'", "users");
      $page = "<b>You Successfully trained defense.<br /><br /><a href=\"/index.php?do=train\">Return to Training</a></b>";
display($page, "train"); 
    }
  }// END OF THE TRAINING

?>