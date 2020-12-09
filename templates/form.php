<?php


include("contact2.php");

function inn() { // Staying at the inn resets all expendable stats to their max values.
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
	$title = "Information on ".$townrow["name"]."";
    
    if ($userrow["gold"] < $townrow["innprice"]) { display("You do not have enough gold to stay at this Inn tonight.<br />You may return to <a href=\"index.php\"class=\"myButton2\">Town Square</a> or use the direction buttons on the left to start exploring.", "Inn"); die(); }
    
    if (isset($_POST["submit"])) {
        
        $newgold = $userrow["gold"] - $townrow["innprice"];
        $query = doquery("UPDATE {{table}} SET gold='$newgold',currenthp='".$userrow["maxhp"]."',currentmp='".$userrow["maxmp"]."',currenttp='".$userrow["maxtp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        $title = "Inn";
    }
    display($page, "form");
}


?>