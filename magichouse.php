<?php // towns.php :: Handles all actions you can do in town.


//  INN MAX Everything START

function inn() { // Staying at the inn resets all expendable stats to their max values.
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["gold"] < $townrow["innprice"]) { display("You do not have enough gold to stay at this Inn tonight.<br />You may return to <a href=\"index.php\">Town Square</a>, or use the direction buttons on the left to start exploring.", "Inn"); die(); }
    
    if (isset($_POST["submit"])) {
        
        $newgold = $userrow["gold"] - $townrow["innprice"];
        $query = doquery("UPDATE {{table}} SET gold='$newgold',currenthp='".$userrow["maxhp"]."',currentmp='".$userrow["maxmp"]."',currenttp='".$userrow["maxtp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        $title = "Inn";
		
$page .= "<center><h3 class=\"title\">Bar and Inn<h3></center>\n";
		
        $page = "<br /><table align=\"center\" border=\"2\" background=\"Town-Inn-Bar.gif\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"600\"><tr><td>";
		
        $page .= "<blockquote><h4 class=\"blackonwhite\">You wake up feeling refreshed and ready for action.</h4></blockquote>\n";
		
        $page .= "<blockquote><h4 class=\"blackonwhite\">You may return to the <a href=\"index.php\"><font color=\"#16BA00\">Town Square</font></a>, or use the direction buttons on the left to start exploring</h4></blockquote><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></td></tr></table>";

        $page .= "</h4></blockquote>\n";
        
    } elseif (isset($_POST["cancel"])) {        
        header("Location: index.php"); die();         
    } else {
        $title = "Inn";		

$page = "<center><h3 class='title'>Bar and Inn<h3></center>";
		
        $page = "<br /><table align=\"center\" border=\"2\" background=\"Town-Inn-Bar.gif\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"600\"><tr><td>";	
		
        $page .= "<blockquote><h4 class=\"blackonwhite\">Resting at the inn will refill your current HP [Health-Hit Points], MP [Magic Points], and TP [Travel Points] to their maximum levels.<br /></h4></blockquote>\n";
		
        $page .= "<br /><blockquote><h4 class=\"blackonwhite\">A night's sleep at this Inn will cost you&nbsp;" . $townrow["innprice"] . " Gold Coins. Is that fine with you ?<br /></h4></blockquote>\n";

        $page .= "<br /><br /><blockquote><form action=\"index.php?do=inn\" method=\"post\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value=\"Yes\" />&nbsp;&nbsp;&nbsp;&nbsp; <input type=\"submit\" name=\"cancel\" value=\"No\" /></form></h4></blockquote><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></td></tr></table>";
    }
    display($page, $title);
}

//  INN MAX Everything END



//  Church  MAX HP START

function church() { // Confession at the Church resets all Heath Points stats to their max values.
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,churchprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
	
    if ($userrow["gold"] < $townrow["churchprice"]) { display("<center><h3 class=\"title\">The Church</h3></center><center><blockquote>You do not have enough Gold Coins have your <br />Confession heard at this Church today.<br />You may return to the <a href=\"index.php\" class=\"myButton2\">Town Square</a> the <a href=\"index.php?do=inn\" class=\"myButton2\">Inn</a> <a href=\"index.php?do=church\" class=\"myButton2\">The Church</a> <br /><a href=\"index.php?do=magichouse\" class=\"myButton2\">Magic House</a> or use the direction buttons<br />on the left to start exploring.</blockquote></center><br /><br /><center><h3 class=\"title\">The Church</h3></center>", "church"); die(); }
	
if (isset($_POST["submit"])) {
        
        $newgold = $userrow["gold"] - $townrow["churchprice"];
        $query = doquery("UPDATE {{table}} SET gold='$newgold',currenthp='".$userrow["maxhp"]."' LIMIT 1", "users");
        $title = "Church";
		
$page .= "<center><h3 class=\"title\">The Church<h3></center>\n";

        $page = "<br /><table align=\"center\" border=\"2\" background=\"church01.gif\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"600\"><tr><td>";

        $page .= "<blockquote><h4 class=\"blackonwhite\">After confession at Church you feeling refreshed and ready for action.</h4></blockquote>\n";

        $page .= "<blockquote><h4 class=\"blackonwhite\">You may return to the <a href=\"index.php\" class=\"myButton2\"><font color=\"#16BA00\">Town Square</font></a>  the <a href=\"index.php?do=inn\" class=\"myButton2\">Inn</a> <a href=\"index.php?do=church\" class=\"myButton2\">The Church</a> <br /><a href=\"index.php?do=magichouse\" class=\"myButton2\">Magic House</a> or use the direction buttons<br />on the left to start exploring.<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></td></tr></table>";

        $page .= "</h4></blockquote></center>\n";		
        
    } elseif (isset($_POST["cancel"])) {        
        header("Location: index.php"); die();         
    } else {
        $title = "Church";		

$page = "<center><h3 class=\"title\">The Church</h3></center>";	
		
        $page = "<br /><table align=\"center\" border=\"2\" background=\"church02.gif\" bordercolor=\"#FFFEBD\" cellpadding=\"2\" cellspacing=\"2\" width=\"600\"><tr><td>";	
		
        $page .= "<blockquote><h4 class=\"blackonwhite\">Confession at the Church will refill your current HP [Health-Hit Points] to their maximum levels.<br /></h4></blockquote>\n";
		
        $page .= "<br /><blockquote><h4 class=\"blackonwhite\">Having your confession heard at the Church will cost you&nbsp;" . $townrow["innprice"] . " Gold Coins in the donation box. So do we ask for forgiviness ?<br /></h4></blockquote>\n";

        $page .= "<br /><br /><blockquote><form action=\"index.php?do=church\" method=\"post\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;&nbsp; <input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></h4></blockquote><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></td></tr></table>";
    }
    display($page, $title);
}

// END Church MAX HP END




// MAX MP START

function magichouse() { // Switch to the enchanter you make all your MAXMP for X Gold.
global $userrow, $numqueries;
$townquery = doquery("SELECT name,magichouseprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (mysql_num_rows($townquery) != 1) { display("You will be banned, cheating is not fair.", "Error"); }
$townrow = mysql_fetch_array($townquery);

if ($userrow["gold"] < $townrow["magichouseprice"]) { display("<bgsound src=\"sounds/029-Town07.mid\" loop=10><center><h3 class=\"title\">House of the Magician</h3></center><br /><br /><blockquote><center><img src=\"images/wizard.png\" alt=\"House of the Magician\" /></center><br><br><center><img src=\"images/npc/magician.png\" alt=\"Magician\" /></center><br>You need 3 Gold Pieces to get your Magic Points [MP]<br /><br />You may return to the <a href=\"index.php\" class=\"myButton2\">Town Square</a>, or use the menu on the left to continue on your adventure.</blockquote><br /><br /><center><h3 class=\"title\">House of the Magician</h3></center>", "Inn"); die(); }

if (isset($_POST['submit'])) {
$newgold = $userrow["gold"] - $townrow["magichouseprice"];
$query = doquery("UPDATE {{table}} SET gold='$newgold',currentmp='".$userrow["maxmp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$title = "Soigneur";
$page = "<bgsound src=\"musiques/029-Town07.mid\" loop=10><center><h3 class=\"title\">House of the Magician</h3></center><br /><br /><center><blockquote><img src=\"images/wizard.png\" alt=\"House of the Magician\" /></center><br><br><center><img src=\"images/npc/magician.png\" alt=\"Magician\" /></center><br><center>You may return to the <a href=\"index.php\" class=\"myButton2\">Town Square</a>, or use the menu on the left to continue on your adventure.</blockquote></center><br /><br /><center><h3 class=\"title\">House of the Magician</h3></center><br /><br />";
} elseif (isset($_POST["cancel"])) {
header("Location: index.php"); die();
} else {

$title = "Magicienne";
$page = "<bgsound src=\"musiques/029-Town07.mid\" loop=10><center><h3 class=\"title\">House of the Magician: Restore</h3></center><br /><br /><center><blockquote><img src=\"images/wizard.png\" alt=\"House of the Magician\" /></center><br><br><center><img src=\"images/npc/magician.png\" alt=\"Magician\" /></center><br><center>You need 3 Gold Pieces to get your MPs back</center><br /><br />\n";
$page .= "<center><form action=\"index.php?do=enchanteur\" method=\"post\">\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"submit\" name=\"cancel\" value=\"No\" />\n</center><br /><br /><center><h3 class=\"title\">House of the Magician: Restore: </h3></center><br /><br />";
$page .= "</form>\n";
}
display($page, $title);
}

// MAX MP END


?>
