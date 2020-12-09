<?php // towns.php :: Handles all actions you can do in town.

function inn() { // Staying at the inn resets all expendable stats to their max values.
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["gold"] < $townrow["innprice"]) { display("You do not have enough gold to stay at this Inn tonight.<br /><br />You may return to <a href=\"index.php\">town</a>, or use the direction buttons on the left to start exploring.", "Inn"); die(); }
    
    if (isset($_POST["submit"])) {
        
        $newgold = $userrow["gold"] - $townrow["innprice"];
        $query = doquery("UPDATE {{table}} SET gold='$newgold',currenthp='".$userrow["maxhp"]."',currentmp='".$userrow["maxmp"]."',currenttp='".$userrow["maxtp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        $title = "Inn";
        $page = "You wake up feeling refreshed and ready for action.<br /><br />You may return to <a href=\"index.php\">town</a>, or use the direction buttons on the left to start exploring.";
        
    } elseif (isset($_POST["cancel"])) {
        
        header("Location: index.php"); die();
         
    } else {
        
        $title = "Inn";
        $page = "Resting at the inn will refill your current HP, MP, and TP to their maximum levels.<br /><br />\n";
        $page .= "A night's sleep at this Inn will cost you <b>" . $townrow["innprice"] . " gold</b>. Is that ok?<br /><br />\n";
        $page .= "<form action=\"index.php?do=inn\" method=\"post\">\n";
        $page .= "<input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" />\n";
        $page .= "</form>\n";
        
    }    
		
    display($page, $title);
}






// START STORE TWO
// START STORE TWO
// START STORE TWO
// START STORE TWO




function loja() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist = explode(",",$townrow["itemslist2"]);
    $querystring = "";
    foreach($itemslist as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items");
    $page = "Buying weapons will increase your Attack Power. Buying armor and shields will increase your Defense Power.<br /><br />Click an item name to purchase it.<br /><br />The following items are available at this town:<br /><br />\n";
    $page .= "<table width=\"80%\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; } else  { $attrib = "Defense Power:"; }
        $page .= "<tr><td width=\"4%\">";
        if ($itemsrow["type"] == 1) { $page .= "<img src=\"images/icon_weapon.gif\" alt=\"weapon\" /></td>"; }
        if ($itemsrow["type"] == 2) { $page .= "<img src=\"images/icon_armor.gif\" alt=\"armor\" /></td>"; }
        if ($itemsrow["type"] == 3) { $page .= "<img src=\"images/icon_shield.gif\" alt=\"shield\" /></td>"; }
        if ($userrow["weaponid"] == $itemsrow["id"] || $userrow["armorid"] == $itemsrow["id"] || $userrow["shieldid"] == $itemsrow["id"]) {
            $page .= "<td width=\"32%\"><span class=\"light\">".$itemsrow["name"]."</span></td><td width=\"32%\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span></td><td width=\"32%\"><span class=\"light\">Already purchased</span></td></tr>\n";
        } else {
            if ($itemsrow["special"] != "X") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
            $page .= "<td width=\"32%\"><b><a href=\"index.php?do=loja2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</b></td><td width=\"32%\">$attrib <b>".$itemsrow["attribute"]."</b></td><td width=\"32%\">Price: <b>".$itemsrow["buycost"]." gold</b></td></tr>\n";
        }
    }
    $page .= "</table><br />\n";
    $page .= "If you've changed your mind, you may also return back to <a href=\"index.php\">town</a>.\n";
    $title = "Buy Items";
    
    display($page, $title);
    
}

function loja2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist2"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    
    if ($userrow["gold"] < $itemsrow["buycost"]) { display("You do not have enough gold to buy this item.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=buy\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Items"); die(); }
    
    if ($itemsrow["type"] == 1) {
        if ($userrow["weaponid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Weapons Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }
    } elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }
    } elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Shield Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }
    }
    
    $title = "Buy Items";
    display($page, $title);
   
}

function loja3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist2"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    
    if ($userrow["gold"] < $itemsrow["buycost"]) { display("You do not have enough gold to buy this item.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=buy\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Items"); die(); }
    
    if ($itemsrow["type"] == 1) { // weapon
    	
    	// Check if they already have an item in the slot.
        if ($userrow["weaponid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newattack = $userrow["attackpower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', weaponid='$newid', weaponname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");
        
    } elseif ($itemsrow["type"] == 2) { // Armor

    	// Check if they already have an item in the slot.
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newdefense = $userrow["defensepower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', armorid='$newid', armorname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

    } elseif ($itemsrow["type"] == 3) { // Shield

    	// Check if they already have an item in the slot.
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newdefense = $userrow["defensepower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', shieldid='$newid', shieldname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");        
    
    }
    
    display("<br><br><Blockquote>Thank you for purchasing this item.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=loja\">Shield Shop</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, or use the direction function</blockquote> loja() { // Displays a list of available items for purchase.

}




// END STORE TWO
// END STORE TWO
// END STORE TWO
// END STORE TWO










//  ORIGINAL STORE


function loja() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist = explode(",",$townrow["itemslist2"]);
    $querystring = "";
    foreach($itemslist as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items");
    $page = "Buying weapons will increase your Attack Power. Buying armor and shields will increase your Defense Power.<br /><br />Click an item name to purchase it.<br /><br />The following items are available at this town:<br /><br />\n";
    $page .= "<table width=\"80%\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; } else  { $attrib = "Defense Power:"; }
        $page .= "<tr><td width=\"4%\">";
        if ($itemsrow["type"] == 1) { $page .= "<img src=\"images/icon_weapon.gif\" alt=\"weapon\" /></td>"; }
        if ($itemsrow["type"] == 2) { $page .= "<img src=\"images/icon_armor.gif\" alt=\"armor\" /></td>"; }
        if ($itemsrow["type"] == 3) { $page .= "<img src=\"images/icon_shield.gif\" alt=\"shield\" /></td>"; }
        if ($userrow["weaponid"] == $itemsrow["id"] || $userrow["armorid"] == $itemsrow["id"] || $userrow["shieldid"] == $itemsrow["id"]) {
            $page .= "<td width=\"32%\"><span class=\"light\">".$itemsrow["name"]."</span></td><td width=\"32%\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span></td><td width=\"32%\"><span class=\"light\">Already purchased</span></td></tr>\n";
        } else {
            if ($itemsrow["special"] != "X") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
            $page .= "<td width=\"32%\"><b><a href=\"index.php?do=loja2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</b></td><td width=\"32%\">$attrib <b>".$itemsrow["attribute"]."</b></td><td width=\"32%\">Price: <b>".$itemsrow["buycost"]." gold</b></td></tr>\n";
        }
    }
    $page .= "</table><br />\n";
    $page .= "If you've changed your mind, you may also return back to <a href=\"index.php\">town</a>.\n";
    $title = "Buy Items";
    
    display($page, $title);
    
}











function loja2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist2"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    
    if ($userrow["gold"] < $itemsrow["buycost"]) { display("You do not have enough gold to buy this item.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=buy\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Items"); die(); }
    
    if ($itemsrow["type"] == 1) {
        if ($userrow["weaponid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Weapon Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }
    } elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Armor Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }
    } elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Shield Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }
	

	// Added extra Item 4 - Pet
	
     } if ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Pet Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }

	// End Item 4 - Pet
	

	// Added extra Item 5 - helmet
	
     } if ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Helmet Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }

	// End Item  5 - Helmet
	

	// Added extra Item 6 - Gauntlet
	
     } if ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Guanlet Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }

	// End Item  6 - Gauntlet
	

	// Added extra Item 7 - boot
	
     } if ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            $page = "If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." gold. Is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        } else {
            $page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Boot Shop<h3></center></td></tr></table><br /><br />You are buying the ".$itemsrow["name"].", is that ok?<br /><br /><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
        }

	// End Item  7 - Boot
	
		
		
    }
    
    $title = "Buy Items";
    display($page, $title);
   
}



function loja3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist2"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    
    if ($userrow["gold"] < $itemsrow["buycost"]) { display("You do not have enough gold to buy this item.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=buy\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Items"); die(); }
    
    if ($itemsrow["type"] == 1) { // weapon
    	
    	// Check if they already have an item in the slot.
        if ($userrow["weaponid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newattack = $userrow["attackpower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', weaponid='$newid', weaponname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");
        
    } elseif ($itemsrow["type"] == 2) { // Armor

    	// Check if they already have an item in the slot.
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newdefense = $userrow["defensepower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', armorid='$newid', armorname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

    } elseif ($itemsrow["type"] == 3) { // Shield

    	// Check if they already have an item in the slot.
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newdefense = $userrow["defensepower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', shieldid='$newid', shieldname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");        
    
    }
    
    display("<br><br><Blockquote>Thank you for purchasing this item.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=loja\">Shield Shop</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, or use the direction</blockquote> function loja() { // Displays a list of available items for purchase.

}



// Add Pet 4

     } if ($itemsrow["type"] == 4) { // Pet
    	
    	// Check if they already have an item in the slot.
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newattack = $userrow["attackpower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', petid='$newid', petname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// End Pet 4


// Add Helemt 5


     } if ($itemsrow["type"] == 5) { // helemt
    	
    	// Check if they already have an item in the slot.
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newattack = $userrow["attackpower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', helmetid='$newid', helmetname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");


// End Helemt 5



// Add Gauntlet 6

     } if ($itemsrow["type"] == 6) { // gauntlet
    	
    	// Check if they already have an item in the slot.
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newattack = $userrow["attackpower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', gauntletid='$newid', gauntletname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");


// End Gauntlet 6


// Add Boot 7

     } if ($itemsrow["type"] == 7) { // boot
    	
    	// Check if they already have an item in the slot.
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
        } else {
            $itemsrow2 = array("attribute"=>0,"buycost"=>0,"special"=>"X");
        }
        
        // Special item fields.
        $specialchange1 = "";
        $specialchange2 = "";
        if ($itemsrow["special"] != "X") {
            $special = explode(",",$itemsrow["special"]);
            $tochange = $special[0];
            $userrow[$tochange] = $userrow[$tochange] + $special[1];
            $specialchange1 = "$tochange='".$userrow[$tochange]."',";
            if ($tochange == "strength") { $userrow["attackpower"] += $special[1]; }
            if ($tochange == "dexterity") { $userrow["defensepower"] += $special[1]; }
        }
        if ($itemsrow2["special"] != "X") {
            $special2 = explode(",",$itemsrow2["special"]);
            $tochange2 = $special2[0];
            $userrow[$tochange2] = $userrow[$tochange2] - $special2[1];
            $specialchange2 = "$tochange2='".$userrow[$tochange2]."',";
            if ($tochange2 == "strength") { $userrow["attackpower"] -= $special2[1]; }
            if ($tochange2 == "dexterity") { $userrow["defensepower"] -= $special2[1]; }
        }
        
        // New stats.
        $newgold = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"];
        $newattack = $userrow["attackpower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', bootid='$newid', bootname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");


// End Boot 7

	
	    }
    
    display("<b>Thank you for purchasing this item.<br /><br />You may return to <a href=\"index.php\">Town Square</a> or the</b>, <br /><b><a href=\"index.php?do=buy\">Shop</a>,</b><br /><b> or use the direction buttons on the left to start exploring.</b>", "Buy Items");

}





// END BUY3
// END BUY3
// END BUY3
// END BUY3





function maps() { // List maps the user can buy.
    
    global $userrow, $numqueries;
    
    $mappedtowns = explode(",",$userrow["towns"]);
    
    $page = "Buying maps will put the town in your Travel To box, and it won't cost you as many TP to get there.<br /><br />\n";
    $page .= "Click a town name to purchase its map.<br /><br />\n";
    $page .= "<table width=\"90%\">\n";
    
    $townquery = doquery("SELECT * FROM {{table}} where hidden != '1' ORDER BY id", "towns");
    while ($townrow = mysql_fetch_array($townquery)) {
        
        if ($townrow["latitude"] >= 0) { $latitude = $townrow["latitude"] . "N,"; } else { $latitude = ($townrow["latitude"]*-1) . "S,"; }
        if ($townrow["longitude"] >= 0) { $longitude = $townrow["longitude"] . "E"; } else { $longitude = ($townrow["longitude"]*-1) . "W"; }
        
        $mapped = false;
        foreach($mappedtowns as $a => $b) {
            if ($b == $townrow["id"]) { $mapped = true; }
        }
        if ($mapped == false) {
            $page .= "<tr><td width=\"25%\"><a href=\"index.php?do=maps2:".$townrow["id"]."\">".$townrow["name"]."</a></td><td width=\"25%\">Price: ".$townrow["mapprice"]." gold</td><td width=\"50%\" colspan=\"2\">Buy map to reveal details.</td></tr>\n";
        } else {
            $page .= "<tr><td width=\"25%\"><span class=\"light\">".$townrow["name"]."</span></td><td width=\"25%\"><span class=\"light\">Already mapped.</span></td><td width=\"35%\"><span class=\"light\">Location: $latitude $longitude</span></td><td width=\"15%\"><span class=\"light\">TP: ".$townrow["travelpoints"]."</span></td></tr>\n";
        }
        
    }
    
    $page .= "</table><br />\n";
    $page .= "If you've changed your mind, you may also return back to <a href=\"index.php\">town</a>.\n";
    
    display($page, "Buy Maps");
    
}

function maps2($id) { // Confirm user's intent to purchase map.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,mapprice FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["gold"] < $townrow["mapprice"]) { display("You do not have enough gold to buy this map.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=maps\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Maps"); die(); }
    
    $page = "You are buying the ".$townrow["name"]." map. Is that ok?<br /><br /><form action=\"index.php?do=maps3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" /></form>";
    
    display($page, "Buy Maps");
    
}

function maps3($id) { // Add new map to user's profile.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,mapprice FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["gold"] < $townrow["mapprice"]) { display("You do not have enough gold to buy this map.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=maps\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Maps"); die(); }
    
    $mappedtowns = $userrow["towns"].",$id";
    $newgold = $userrow["gold"] - $townrow["mapprice"];
    
    $updatequery = doquery("UPDATE {{table}} SET towns='$mappedtowns',gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    
    display("Thank you for purchasing this map.<br /><br />You may return to <a href=\"index.php\">town</a>, <a href=\"index.php?do=maps\">store</a>, or use the direction buttons on the left to start exploring.", "Buy Maps");
    
}

function travelto($id, $usepoints=true) { // Send a user to a town from the Travel To menu.
    
    global $userrow, $numqueries;
    
    if ($userrow["currentaction"] == "Fighting") { header("Location: index.php?do=fight"); die(); }
    
    $townquery = doquery("SELECT name,travelpoints,latitude,longitude FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $townrow = mysql_fetch_array($townquery);
    
    if ($usepoints==true) { 
        if ($userrow["currenttp"] < $townrow["travelpoints"]) { 
            display("You do not have enough TP to travel here. Please go back and try again when you get more TP.", "Travel To"); die(); 
        }
        $mapped = explode(",",$userrow["towns"]);
        if (!in_array($id, $mapped)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    }
    
    if (($userrow["latitude"] == $townrow["latitude"]) && ($userrow["longitude"] == $townrow["longitude"])) { display("You are already in this town. <a href=\"index.php\">Click here</a> to return to the main town screen.", "Travel To"); die(); }
    
    if ($usepoints == true) { $newtp = $userrow["currenttp"] - $townrow["travelpoints"]; } else { $newtp = $userrow["currenttp"]; }
    
    $newlat = $townrow["latitude"];
    $newlon = $townrow["longitude"];
    $newid = $userrow["id"];
    
    // If they got here by exploring, add this town to their map.
    $mapped = explode(",",$userrow["towns"]);
    $town = false;
    foreach($mapped as $a => $b) {
        if ($b == $id) { $town = true; }
    }
    $mapped = implode(",",$mapped);
    if ($town == false) { 
        $mapped .= ",$id";
        $mapped = "towns='".$mapped."',";
    } else { 
        $mapped = "towns='".$mapped."',";
    }
    
    $updatequery = doquery("UPDATE {{table}} SET currentaction='In Town',$mapped currenttp='$newtp',latitude='$newlat',longitude='$newlon' WHERE id='$newid' LIMIT 1", "users");
    
    $page = "You have travelled to ".$townrow["name"].". You may now <a href=\"index.php\">enter this town</a>.";
    display($page, "Travel To");
    
}
    
function skills() {
 global $userrow;
 	if ($userrow["skills"] == 0) { $page .= "You do not have any skill points left! "; }	
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
  		$amount = $_POST['amount'];
 			if ($amount > $userrow["skills"]) { $page .= "<font color='green'>You do not have that many skill points!</font>"; 
			} elseif ($amount == 0) { $page .= "<font color='green'>Enter an amount higher than 0!</font>"; 
                        } elseif (!is_numeric($amount)) { $page .= "<font color='red'>Enter an amount!</font.";
                  	} else {
				doquery("UPDATE {{table}} SET $choice=$choice+$amount, skills=skills-$amount WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
 			$page = "<font color=green><b>You have succesfully spend skill points!</b></font><br /><br />";
 			}
		}
	$page .= "
	<form action=\"index.php?do=skills\" method=\"post\">
	<font size='4'><b>Skill points</b></font><br />
	Every time you raise a level, you get 2 skillpoints. You can spend them here.
	<br />
	You currently have <font color=green><b>".$userrow["skills"]." Skill Points.</b></font>. Please choose an attribute:<br />
	<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"strength\" CHECKED>Strength<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"dexterity\" >Dexterity<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"attackpower\">Attackpower<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"defensepower\">Defensepower<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxhp\" >Max. HP<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxmp\" >Max. MP<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxtp\" >Max. RP<br />
	<br />
	How many skill points do you want to spend? (+1 for every skill point): <br /><br />
	Amount: <INPUT TYPE=\"text\" NAME=\"amount\" SIZE=\"8\" MAXLENGTH=\"8\">
	<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\">
	</form>		
	\n<br /><br />\n<a href=index.php>Back to Town</a>";
	
		 display($page, "Skill points");
		 
}


function gym() {
 global $userrow;
if ($userrow["gympass"] == 0) {
if ($userrow["gold"] <= 1499) { $page .= "You do not have enough gold. Its cost is 1500 gold to refill. "; }
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
                        if ($userrow["gold"]<= 1499) { $page .= "<font color='red'>You need 1500 gold for this!</font>"; 
 			} else {
				doquery("UPDATE {{table}} SET gold=gold-6000, gympass=1 WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
 			$page = "<font color=green><b>At the cost of $goldlost gold..You have successfully bought a gym pass! Click <a class='g' href='index.php?do=gym'>here</a> to train</b></font><br /><br />";
 			}
		}
	$page .= "
	<form action=\"index.php?do=gym\" method=\"post\">
	<font size='4'><b>Train Skills</b></font><br />
	<br />
        You may buy a gym pass at a cost of 6000 gold.<br />
	<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"energy\">Buy gym pass<br />
	<br />
	<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\">
	</form>		
	\n<br /><br />\n";
	
		 display($page, "Gym Trainer");
}

elseif ($userrow["currentenergy"] == 0) {
if ($userrow["gold"] <= 999) { $page .= "You do not have enough gold. Its cost is 1000 gold to refill. "; }
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
                $cost = $userrow['level']*5;
				doquery("UPDATE {{table}} SET gold=gold-1000, currentenergy=maxenergy WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
 			$page = "<font color=green><b>At the cost of $goldlost gold..You have successfully refilled your energy! Click <a class='g' href='index.php?do=gym'>here</a> to train</b></font><br /><br />";
 			
		}
	$page .= "
	<form action=\"index.php?do=gym\" method=\"post\">
	<font size='4'><b>Train Skills</b></font><br />
	<br />
        You may refill your energy at a cost of 1000 gold.<br />
	<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"energy\">Refill Energy<br />
	<br />
	<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\">
	</form>		
	\n<br /><br />\n";
	
		 display($page, "Gym Trainer");
		 
} else {
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
  		$amount = $_POST['amount'];
                $trained = rand(1,9);
                $gained = ceil($trained*$amount+1);
                $goldlost = ceil($amount);
 			if ($amount > $userrow["currentenergy"]) { $page .= "<font color='red'>You do not have that much energy!</font>"; 
			} elseif ($amount == 0) { $page .= "<font color='red'>Enter an amount higher than 0!</font>"; 
                        } elseif (!is_numeric($amount)) { $page .= "<font color='red'>Enter an amount!</font.";
 			} else {
				doquery("UPDATE {{table}} SET $choice=$choice+$trained+$amount, currentenergy=currentenergy-$goldlost WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
 			$page = "<font color=green><b>At the cost of $goldlost gold..You have successfully trained in the gym and gained $gained $choice! Click <a class='g' href='index.php?do=gym'>here</a> to refill energy </b></font><br /><br />";
 			}
		}
	$page .= "
	<form action=\"index.php?do=gym\" method=\"post\">
	<font size='4'><b>Train Skills</b></font><br />
	<br />
	You currently can train <font color=green><b>".$userrow["currentenergy"]." times.</b></font> It takes 1 energy to train. You may refill your energy at a cost of 1000 gold. Please choose an attribute:<br />
	<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"strength\" CHECKED>Strength<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"dexterity\" >Dexterity<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"attackpower\">Attackpower<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"defensepower\">Defensepower<br />
	<INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxenergy\">Energy<br />
	<br />
	How many skill points do you want to train?: <br /><br />
	Amount: <INPUT TYPE=\"text\" NAME=\"amount\" SIZE=\"8\" MAXLENGTH=\"8\">
	<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\">
	</form>		
	\n<br /><br />\n";
	
		 display($page, "Gym Trainer");
		 
}
}


function topten() { // Top 10 list, based on user Experience

    
    $page = "<div class=\"small\">The Top 10 list shows the rank of the highest ranking players in the game. 
	Click a Character Name to view the stats for that character.</div>\n<br /><br />\n";
    
	$page .= "<table width=\"80%\">";
    
	 $topquery = doquery("SELECT * FROM dk_users ORDER BY experience DESC LIMIT 10", "users");
	$rank = 1;
    while ($toprow = mysql_fetch_array($topquery)) { 
        
	$page .= "<tr><td width=\"10%\"><b>$rank</b></td>
			<td width=\"50\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td>
			<td width=\"20%\">Level: <b>".$toprow["level"]."</b></td>
			<td width=\"20%\">Exp: <b>".number_format($toprow["experience"])."</b></td></tr>\n";

        $rank++;
    }
    $page .= "</table>\n<br /><br />\n";
    
	$page .= "When you're finished, you may <a href=\"index.php\">return to town.</a>";
    
	display($page, "Top 10 Users");

    }



function toprich() { // Top 10 Richest and Bankest Members

$page = "The Top 10 Rich List shows the richest players players in the game and the richest bankers in the game. Click a Character Name to view the stats for that character.\n<br /><br />\n";
$page .= "<center><b>Rich:</b></center>\n<br />\n";
$page .= "<table width=\"80%\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 10", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\"><b>$rank</b></td><td width=\"30\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td><td width=\"20%\">Gold: <b>".number_format($toprow["gold"])."</b></td></tr>\n";
        $rank++;


    }

    $page .= "</table>\n";

$page .= "<table width=\"80%\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  bank  DESC LIMIT 10", "users");

$page .= "\n<br />\n<center><b>Bank:</b></center>\n<br />\n";

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\"><b>$rank</b></td><td width=\"30\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td><td width=\"20%\">Bank: <b>".number_format($toprow["bank"])."</b></td></tr>\n";
        $rank++;

        
    }
    $page .= "</table>\n<br /><br />\n";
    $page .= "<center>Go back to <a href=index.php>Town.</a></center>";
    display($page, "Rikaste Spelare");
}
	
	

?>