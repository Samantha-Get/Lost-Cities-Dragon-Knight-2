<?php
Function food mart () {
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
        
		if ($userrow["gas"] == 50) { display("Ur car dont have a no more space.<br /><br /> Go back to <a href=\"index.php\">town</a>.", "gas station"); die(); }
	    if ($userrow["gold"] < 5000) { display("U have no money.<br /><br />Go to <a href=\"index.php\">town</a>.", "gas station"); die();
    }
    
    if (isset($_POST["submit"])) {
        
        $gas = $userrow["gas"] +50 ;
        $query = doquery("UPDATE {{table}} SET bensiin='$bensi' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
		
		$newgold = $userrow["gold"] -5000 ;
        $query = doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        
		$title = "Bensiinijaam";
        $page .= "U buyed 50L refuel. Buy more <a href=\"index.php?do=gasstation\">Gas</a>.";
        $page .= "Or go <a href=\"index.php\">town</a>.";

} elseif (isset($_POST["cancel"])) {
        
        header("Location: index.php"); die();
         
    } else {
        
        $title = "Bensiinijaam";
        $page .= "<br /><br />\n";
		$page .= "In the gas station u can buy 50L gas for 1 thousand of money";
		$page .= "<form action=\"index.php?do=gasstation\" method=\"post\">\n";
		$page .= "<input type=\"submit\" name=\"submit\" value=\"Buy Gas\" /> <input type=\"submit\" name=\"cancel\" value=\"Town\" />\n";
        $page .= "</form><br/>\n";   
    }
    
    display($page, $title);
}

?>