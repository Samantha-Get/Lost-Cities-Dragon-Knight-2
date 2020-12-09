<?php
Function general store () {
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
        
		if ($userrow["food"] == 10) { display("Your food cart has no more room.<br /><br />Go back to <a href=\"index.php\">Town Square</a>.", "food mart"); die(); }
	    if ($userrow["gold"] < 20) { display("You have no more money to spend here.<br /><br />Back to <a href=\"index.php\">Town Square</a>.", "generalstore"); die();
    }
    
    if (isset($_POST["submit"])) {
        
        $food = $userrow["food"] +10 ;
        $query = doquery("UPDATE {{table}} SET bensiin='$bensi' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
		
		$newgold = $userrow["gold"] -20 ;
        $query = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        
		$title = "Bensiinijaam";
        $page .= "You have purchased 10 units of Hard Tat. Do you wish to purchase more? Back to the  <a href=\"index.php?do=generalstore\">General Store</a>.";
        $page .= "Or go <a href=\"index.php\">Town Square</a>.";

} elseif (isset($_POST["cancel"])) {
        
        header("Location: index.php"); die();
         
    } else {
        
        $title = "Bensiinijaam";
        $page .= "<br /><br />\n";
		$page .= "In the General Store you can buy 10 packs of Hard tat for 20 gold coins. Each movement takes one pack of hard tat. Example if you move 7 spaces - you will have used 7 packs of hard tat. If you run out of food you die!";
		$page .= "<form action=\"index.php?do=generalstore\" method=\"post\">\n";
		$page .= "<input type=\"submit\" name=\"submit\" value=\"Buy Food\" /> <input type=\"submit\" name=\"cancel\" value=\"Town\" />\n";
        $page .= "</form><br/>\n";      

	  
    }
    
    display($page, $title);
    
}

?>