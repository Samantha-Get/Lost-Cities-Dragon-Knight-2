<?php // towns.php :: Handles all actions you can do in town.


//  INN MAX Everything START

function inn() { // Staying at the inn resets all expendable stats to their max values.
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("<center><h3 class=\"title\">Bar and Inn<h3></center><br><br><blockquote><b>Cheat attempt detected.<br /><br />Get a life, loser.<br /><br />You may return to <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp;&nbsp;<a href=\"index.php?do=inn\" class=\"myButton2\">Bank</a><br /><br />or use the direction buttons on the left to start exploring.</b></blockquote>", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["gold"] < $townrow["innprice"]) { display("<center><h3 class=\"title\">Bar and Inn<h3></center><br><br><blockquote><b>You do not have enough gold to stay at this Inn tonight.<br /><br />You may return to <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp;&nbsp;<a href=\"index.php?do=bank\" class=\"myButton2\">Bank</a><br /><br />or use the direction buttons on the left to start exploring.</b></blockquote>", "Inn"); die(); }
    
    if (isset($_POST["submit"])) {
        
        $newgold = $userrow["gold"] - $townrow["innprice"];
        $query = doquery("UPDATE {{table}} SET gold='$newgold',currenthp='".$userrow["maxhp"]."',currentmp='".$userrow["maxmp"]."',currenttp='".$userrow["maxtp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        $title = "Inn";
		
		
$page = "<center><h3 class='title'>Bar and Inn<h3></center>";
		
        $page = "<table align=\"center\" border=\"0\" background=\"images/background/inn/{{innsname}}.png\" bordercolor=\"#FFFEBD\" cellpadding=\"0\" cellspacing=\"0\" width=\"800\" height=\"800\"><tr><td>";
		
        $page .= "<table align=\"center\" border=\"2\" cellpadding=\"4\" cellspacing=\"3\" width=\"800\"><tr><td>&nbsp;&nbsp;&nbsp;</td><td width=\"50%\" background=\"images/background/inn/inn-background.png\"><center><blockquote><br><h4><b><i>&nbsp;Resting at the  ".$townrow["name"]." ".$userrow["innsname"]." has raised your Current Hit Points: ".$userrow["currenthp"]." to Max. HPs of ".$userrow["maxhp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of ".$userrow["maxmp"]." Max. MPs. You have a Max. of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." TPs. </i></b></h4></blockquote></center>\n";
		
        $page .= "<center><blockquote><h4><b><i>You wake up feeling refreshed and ready for action.</i><br /><br /></b></h4></blockquote></center>\n";

        $page .= "<center><blockquote><b><a href=\"index.php\" class=\"myButton2\">Town Square</a></b></blockquote></center><br><br></td><td width=\"50%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td></tr></table>";

        $page .= "</h4></blockquote>\n";
        
    } elseif (isset($_POST["cancel"])) {        
        header("Location: index.php"); die();         
    } else {
        $title = "Inn";		

$page = "<center><h3 class='title'>Bar and Inn<h3></center>";
		
        $page = "<table align=\"center\" border=\"0\" background=\"images/background/inn/{{innsname}}.png\" bordercolor=\"#FFFEBD\" cellpadding=\"0\" cellspacing=\"0\" width=\"800\" height=\"800\"><tr><td>";
		
        $page .= "<table align=\"center\" border=\"2\" cellpadding=\"4\" cellspacing=\"3\" width=\"800\"><tr><td>&nbsp;&nbsp;&nbsp;</td><td width=\"50%\" background=\"images/background/inn/inn-background.png\"><br><br><center><blockquote><h4><b><i>&nbsp;Resting at the ".$townrow["name"]." ".$userrow["innsname"]." will refill your Current Hit Points: ".$userrow["currenthp"]." to Max. Hit Points of ".$userrow["maxhp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of ".$userrow["maxmp"]." Max. Magic Points. You have a Max. of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points. </i></b></h4></blockquote></center>\n";
		
        $page .= "<center><blockquote><h4><b><i>A nights sleep at this Inn will cost you&nbsp;" . $townrow["innprice"] . " Gold Coins. Is that fine with you ?</i><br /></b></h4></blockquote></center>\n";

        $page .= "<center><blockquote><b><form action=\"index.php?do=inn\" method=\"post\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp; <input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\"></form></b></blockquote></center><br /><br></td><td width=\"50%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td></tr></table>";
    }
    display($page, $title);
}

//  INN MAX Everything END


function gym() {
 global $userrow;
if ($userrow["gympass"] == 0) {
if ($userrow["gold"] <= 499) { $page .= "You do not have enough gold. Its cost is 500 gold to refill."; }
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
                        if ($userrow["gold"]<= 499) { $page .= "<font color='red'>You need 500 gold for this!</font>"; 
 			} else {
				doquery("UPDATE {{table}} SET gold=gold-500, gympass=1 WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
 		
	$page = "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>

	<br /><br /><b>At the cost of $goldlost Gold Coins. <font color=green>You have successfully bought a Training Token.
	<br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp; &nbsp;&nbsp;<a href='index.php' class='myButton2'>{{towncityname}} Town Square</a><br /><br />"; } }


	$page .= "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>

	<br /><br /><form action=\"index.php?do=gym\" method=\"post\">
	<br />You may buy a gym pass at a cost of 500 gold.
	<br /><br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"energy\" class=\"myButton2\">Buy Training Token<br />
	<br /><br /><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\" class=\"myButton2\">
	</form><br /><br />\n";
	
	display($page, "Training Area"); }

	elseif ($userrow["currentenergy"] == 0) {
	
	if ($userrow["gold"] <= 49) { $page .= "<center><h3 class='title'>{{towncityname}} Training Gym</h3></center>

	<br /><br />You do not have enough gold. Its cost is 50 Gold Coins to refill.
	<br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>{{towncityname}} Town Square</a><br /><br />"; }

 	if (isset($_POST["submit"])) {
        $choice = $_POST['choice'];
        $cost = $userrow['level']*2;

	doquery("UPDATE {{table}} SET gold=gold-50, currentenergy=maxenergy WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 

 	$page = "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>

	<br /><br /><b>At the cost of $goldlost Gold Coins. <font color=green>You have successfully refilled your energy!</b></font>
	<br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>{{towncityname}} Town Square</a><br /><br />"; }
	
	
	$page .= "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>

	<br /><form action=\"index.php?do=gym\" method=\"post\">
	<br />You may refill your energy at a cost of 50 Gold Coins.
	<br /><br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"energy\">Refill Energy
	<br /><br /><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\" class=\"myButton2\"></form><br /><br />\n";
	
		 display($page, "Training Area");
		 
} else {
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
  				$amount = $_POST['amount'];
                $trained = rand(1,5);
                $gained = ceil($trained*$amount+1);
                $goldlost = ceil($amount);
				
	if ($amount > $userrow["currentenergy"]) { $page .= "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>
	<br /><br /><font color='red'>You do not have that much Energy.</font>
	<br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>{{towncityname}} Town Square</a><br /><br />"; } 

	elseif ($amount == 0) { $page .= "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>
	<br /><br /><font color='red'>Enter an amount higher than 0!</font><br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>{{towncityname}} Town Square</a><br /><br />"; } 

	elseif (!is_numeric($amount)) { $page .= "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>
	<br /><br /><font color='red'>Enter an amount!</font>.<br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>{{towncityname}} Town Square</a><br /><br />"; } 
	
	else { doquery("UPDATE {{table}} SET $choice=$choice+$trained+$amount, currentenergy=currentenergy-$goldlost WHERE id='".$userrow["id"]."' LIMIT 1", "users");
 
 	$page = "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>
	<br /><br /><font color=green><b>At the cost of $goldlost Gold Coins.</font> You have successfully trained in the Training Area and gained $gained $choice.</b><br /><br /><a href='index.php?do=gym' class='myButton2'>{{towncityname}} Training Area</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php' {{towncityname}} Town Square</a><br /><br />"; } }


	$page .= "<center><h3 class='title'>{{towncityname}} Training Area</h3></center>
	<br /><form action=\"index.php?do=gym\" method=\"post\">
	<br />You currently can train <font color=green><b>".$userrow["currentenergy"]." times.</b></font> It takes 1 energy to train. You may refill your energy at a cost of 500 gold. Please choose an attribute:
	
	<br /><br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"strength\" CHECKED>Strength
	<br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"dexterity\" >Dexterity
	<br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"attackpower\">Attackpower
	<br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"defensepower\">Defensepower
	<br /><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxenergy\">Energy
	<br />
	How many skill points do you want to train?<br /><br />
	Amount: <INPUT TYPE=\"text\" NAME=\"amount\" SIZE=\"8\" MAXLENGTH=\"8\">
	<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend\" class=\"myButton2\"></form><br /><br />\n";
	
		 display($page, "{{towncityname}} Training Area"); } }
		 
		 
		 


?>