<?php // towns.php :: Handles all actions you can do in town.


//  INN MAX Everything START

function inn() { // Staying at the inn resets all expendable stats to their max values.
    
    global $userrow, $numqueries;

    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("<center><h3 class=\"title\">Bar and Inn<h3></center><br><br><blockquote>Cheat attempt detected.<br /><br />Get a life, loser.<br /><br />You may return to <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp;&nbsp;<a href=\"index.php?do=inn\" class=\"myButton2\">Inn</a>&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br />or use the direction buttons on the left to start exploring.</blockquote>", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["copper"] < $townrow["innprice"]) { display("<center><h3 class=\"title\">Bar and Inn<h3></center><br><br><blockquote>You DO NOT have enough Copper Coins to stay at this Inn tonight.<br /><br />You may return to <a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp;&nbsp;<a href=\"index.php?do=bankcopper\" class=\"myButton2\">Copper Bank</a><br /><br />or use the direction buttons on the left to start exploring.</blockquote>", "Inn"); die(); }
    
    if (isset($_POST["submit"])) {
        
        $newcopper = $userrow["copper"] - $townrow["innprice"];
        $query = doquery("UPDATE {{table}} SET copper='$newcopper',currenthp='".$userrow["maxhp"]."',currentmp='".$userrow["maxmp"]."',currenttp='".$userrow["maxtp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        $title = "Inn";
		
		
$page = "<center><h3 class='title'>Bar and Inn<h3></center>";
		
        $page = "<table align=\"center\" border=\"0\" background=\"images/background/inn/{{innsname}}.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"0\" cellspacing=\"0\" width=\"800\" height=\"800\"><tr><td>";
		
        $page .= "<table align=\"center\" border=\"2\" cellpadding=\"4\" cellspacing=\"3\" width=\"800\"><tr><td>&nbsp;&nbsp;&nbsp;</td><td width=\"54%\" background=\"images/background/inn/inn-background.png\"><br><blockquote><blockquote><div align=\"center\">Welcome to ".$townrow["name"]." ".$userrow["innsname"]." </div><br>Resting at the  ".$townrow["name"]." ".$userrow["innsname"]." has raised your Current Hit Points ".$userrow["currenthp"]." to their Max. of ".$userrow["maxhp"]." . 

<br><br>Your Current Magic Points are now ".$userrow["currentmp"]." they have been restored to their Max. of  ".$userrow["maxmp"]." Magic Points.

<br><br>Sleeping at the Inn has restored your Travel Points to the Max. of  ".$userrow["maxtp"]." . They have been restored to their Current total of ".$userrow["currenttp"]." Travel Points. </blockquote></blockquote>\n";
		
        $page .= "<center><blockquote><blockquote>You wake up feeling refreshed and ready for action.<br /></blockquote></blockquote></center>\n";

        $page .= "<center><blockquote><a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></center><br></td><td width=\"50%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></td></tr></table></td></tr></table>";

        $page .= "</blockquote>\n";
        
    } elseif (isset($_POST["cancel"])) {        
        header("Location: index.php"); die();         
    } else {
        $title = "Inn";		

$page = "<center><h3 class='title'>Bar and Inn<h3></center>";
		
        $page = "<table align=\"center\" border=\"0\" background=\"images/background/inn/{{innsname}}.jpg\" bordercolor=\"#FFFEBD\" cellpadding=\"0\" cellspacing=\"0\" width=\"800\" height=\"800\"><tr><td>";
		
        $page .= "<table align=\"center\" border=\"2\" cellpadding=\"4\" cellspacing=\"3\" width=\"800\"><tr><td>&nbsp;&nbsp;&nbsp;</td><td width=\"55%\" background=\"images/background/inn/inn-background.png\">

<br><blockquote><blockquote><div align=\"center\">Welcome to ".$townrow["name"]." ".$userrow["innsname"]." </div><br>&nbsp;Resting at the ".$townrow["name"]." ".$userrow["innsname"]." will refill your Current Hit Points of ".$userrow["currenthp"].". To their Max. Hit Points of ".$userrow["maxhp"]." .

<br /><br />Your Magic Points are Currently ".$userrow["currentmp"]." the inn will increase them to their Max. of  ".$userrow["maxmp"]." Magic Points.

<br /><br />Current total of ".$userrow["currenttp"]." Travel Points will be increased to their Max. of  ".$userrow["maxtp"]." Travel Points, with a good night sleep. </blockquote></blockquote>\n";
		
        $page .= "<center><blockquote><blockquote>A nights sleep at this Inn will cost you&nbsp;<b>" . $townrow["innprice"] . " Copper Coins</b>. Is that fine with you ?<br /></blockquote></blockquote></center>\n";

        $page .= "<center><blockquote><form action=\"index.php?do=inn\" method=\"post\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp; <input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\"></form><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a><br><br><br></blockquote></center></td><td width=\"50%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td></tr></table>";
    }
    display($page, $title);
}

//  INN MAX Everything END


//RANGER MOD

function Ranger() { // Made by Fivelegend
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 

AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>Cheat attempt was Detected</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>Cheat attempt was detected!.<br /><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />", 
"Error"); }
$townrow = mysql_fetch_array($townquery);
if (isset($_POST['submit'])) {
header("Location: index.php?do=woodcut"); die();
} elseif (isset($_POST["cancel"])) {
header("Location: index.php?do=fish"); die();
} else {
$title = "Warden of the Protected Lands";
$page = "<center><h3 class='title'>Warden of the Protected Lands</h3></center>

<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>For what reason do you want wish to enter the lands protected by the Warden?<br><br><font color=\"#803159\">*</font> Both Woodcutting & Fishing takes Travel Points!<br>Once a choice is made it can not be changed.</center><br><br />\n";
$page .= "<center><form action=\"index.php?do=ranger\" method=\"post\">\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"WoodCutting\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Fishing\"  class=\"myButton2\"  /><br /><br /><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
$page .= "</form>\n";
}
display($page, $title);
}

//END RANGER MOD



//WOODCUTTING MOD

function woodcut() { // Made by Fivelegend
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 

AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>Cheat attempt was Detected</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>Cheat attempt was detected!</center><br /><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />", 
"Error"); }

$townrow = mysql_fetch_array($townquery);
if ( $userrow["currenttp"] <=3 ) { display("<center><h3 class='title'>Cheat attempt was Detected</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>You don't have enough TP points.</center><br /><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />", "Error"); }

if ( $userrow["woodskill"] ==0 ) { display("<center><h3 class='title'>Woodcutting Skill Needed</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>You DO NOT have this skill.<br />You can learn the Skill of Woodcutting at the University.<br /><br /><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a>", "Error"); }

if ( $userrow["fishskill"] ==1 ) { display("<center><h3 class='title'>Woodcutting Skill Needed</h3><br>
<br>
<center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>You have not learned the skill of Fishing yet.<br />Only those with Woodcutters skills may enter.<br /></center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br><br>", "Error"); }

if (isset($_POST['submit'])) {
if ( $_POST["ac"] == t1 ) {

	$wood = rand(1,25); 
$tp = rand(1,17);
$newwood = $userrow["wood"] + $wood;
$newtp = $userrow["currenttp"] - $tp;
}
elseif ( $_POST["ac"] == t2 ){

	$wood = rand(1,20); 
$tp = rand(1,14);
$newwood = $userrow["wood"] + $wood;
$newtp = $userrow["currenttp"] - $tp;
}
elseif ( $_POST["ac"] == t3 ){

	$wood = rand(1,10); 
$tp = rand(1,7);
$newwood = $userrow["wood"] + $wood;
$newtp = $userrow["currenttp"] - $tp;
}

elseif ( $_POST["ac"] == t4 ){

	$wood = rand(1,5); 
$tp = rand(1,3);
$newwood = $userrow["wood"] + $wood;
$newtp = $userrow["currenttp"] - $tp;
}

$query = doquery("UPDATE {{table}} SET wood='$newwood',currenttp='$newtp' WHERE id='".$userrow["id"]."' LIMIT 
1", "users");

$title = "Returned from the forest";
$page = "<center><h3 class='title'>Warden of the Lost Forests</h3></center><br>
<br>
<center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"></center>
<br />
<center>You have returned from the forest with <font color=\"#8E6C62\">$wood Woodcuts</font>.
<br>
<a href=\"index.php?do=woodcut\" class=\"myButton2\" />Back to forest</a>  
Or Sell Wood cuttings at <a href=\"index.php?do=market\" class=\"myButton2\" />Town Market</a>.</center><br><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>";

} elseif (isset($_POST["cancel"])) {

header("Location: index.php"); die();
} else {

$title = "Warden of the Lost Forests";
$page = "<center><h3 class='title'>Warden of the Lost Forests</h3></center><br>
<br>
<center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br> Do you want to go woodcutting in the forest?
<br>* Woodcutting takes Travel Points!</center>
<br><center><blockquote><blockquote>".$userrow["charname"]." you currently have<font color=\"#8E6C62\"> ".$userrow["wood"]." Cuts of Wood</font> & <font color=\"#B95337\">".$userrow["fish"]." Fresh Fish</font><br>with <font color=\"#9E8E52\">".$userrow["gold"]." Gold Coins</font> &  <font color=\"#9E8E52\">".$userrow["bank"]." Gold Coins</font> in the ".$townrow["name"]." Bank.
<br /><br />\n";
$page .= "<center><form action=\"index.php?do=woodcut\" method=\"post\">\n";
$page .= "
<input type=\"radio\" name=\"ac\" value=\"t1\" />120 Minutes<br />
<input type=\"radio\" name=\"ac\" value=\"t2\" /> 60 Minutes<br />
<input type=\"radio\" name=\"ac\" value=\"t3\" /> 30 Minutes<br />
<input type=\"radio\" name=\"ac\" value=\"t4\" /> 10 Minutes<br /><br />\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\"></blockquote></blockquote></center>\n";
$page .= "</form><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
}
display($page, $title);
}

//END WOODCUTTING MOD 


//MARKET WOOD MOD

function sellwood() { // 
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 
AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>Town Market</h3></center><br>
<br><center>Cheat attempt was detected!.
<br /><br /><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a>\n</center>
<br /><br />", "Error"); }

if ($userrow["wood"] <= 0 )
{ display("<center><h3 class='title'>Selling Wood</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\"></center><br>
<br><center>You DO NOT have enough wood to sell.<br /></center><br /><br /><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>", "Error"); }

$townrow = mysql_fetch_array($townquery);
if (isset($_POST['submit'])) {
$num = $_POST["sell"];
$gold = rand(1,50);
$newwood = $userrow["wood"] - $num;
$newgold = $userrow["gold"] + $gold;
$query = doquery("UPDATE {{table}} SET gold='$newgold',wood='$newwood' WHERE id='".$userrow["id"]."' LIMIT 1", 
"users");
$title = "Market";
$page = "<center><h3 class='title'>Town Market</h3></center><br>
<br>
<center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\"><br>You have sold $num woodcuts and received $gold Gold Coins.</center>
<br><center><a href=\"index.php?do=sellwood\" class=\"myButton2\">Sell Wood Cuttings at Market</a><br /><br /><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
} elseif (isset($_POST["cancel"])) {
header("Location: index.php?do=sellfish"); die();
} else {
$title = "Town Market";
$page = "<center><h3 class='title'>Town Market</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\"></center><br>
<br><center>Do you want to sell any of your Resource?
<br>* Wood cuttings and fish may be sold here.</center><br><br />\n";

$page .= "<center><form action=\"index.php?do=sellwood\" method=\"post\">\n";
$page .= "Amount: <input type=\"text\" name=\"sell\">\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Sell Wood\" class=\"myButton2\" />
&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"May be Later\" class=\"myButton2\"></center>\n";
$page .= "</form><br><center><a href=\"index.php?do=sellwood\" class=\"myButton2\">Sell Wood Cuttings at Market</a><br /><br /><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
}
display($page, $title);
}

//END MARKET WOOD MOD




//MAIN MARKET MOD

function market() { //
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 
AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) != 1) { display("Cheat attempt was detected!.<br /><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>", 
"Error"); }
$townrow = mysql_fetch_array($townquery);
if (isset($_POST['submit'])) {
header("Location: index.php?do=sellwood"); die();
} elseif (isset($_POST["cancel"])) {
header("Location: index.php?do=sellfish"); die();
} else {
$title = "Town Market";
$page = "<center><h3 class='title'>Town Market</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\" />
<br>Do you want to sell any of your resources ?<br>* Woodcuts and Fish are sold at the Market.</center><br /><br />\n";
$page .= "<center><form action=\"index.php?do=market\" method=\"post\">\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Sell WoodCuttings\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Sell Fish\" class=\"myButton2\" /></center>\n";
$page .= "</form><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
}
display($page, $title);
}
//END MAIN MARKET



//BEGIN SELL FISH


function sellfish() { // 
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 
AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (mysql_num_rows($townquery) != 1) { display("<center><h3 class=\"title\">Town Market</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\" /><br><br>Cheat attempt was detected!</center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br /><br />", "Error"); }

if ($userrow["fish"] <= 0 ) { display("<center><h3 class=\"title\">Town Market</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\" /><br><br>You DO NOT have enough fish to sell.</center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br /><br />", "Error"); }

$townrow = mysql_fetch_array($townquery);
if (isset($_POST['submit'])) {
$num = $_POST["sell"];
$gold = rand(1,50);
$newfish = $userrow["fish"] - $num;
$newgold = $userrow["gold"] + $gold;
$query = doquery("UPDATE {{table}} SET gold='$newgold', fish='$newfish' WHERE id='".$userrow["id"]."' LIMIT 1", 
"users");
$title = "Town Market";

$page = "<center><h3 class=\"title\">Town Market</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\" /></center><br><br /><center>You have sold <b>$num</b> fishes and received $gold Gold Coins<br><br><a href=\"index.php?do=sellfish\" class=\"myButton2\" />Back to Fish Market</a> Or go exploring using the directions.</center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";

} elseif (isset($_POST["cancel"])) {
header("Location: index.php?do=sellwood"); die();
} else {
$title = "Towns Market";

// $page = "<bgsound src=\"musiques/032-Church01.mid\" loop=2>\n";

$page .= "<center><h3 class='title'>Town Market</h3></center><br>
<br><center><img src=\"images/npc/Gernon.png\" alt=\"Merchant\" title=\"Merchant\" /></center><br><center><br> Do you want to sell any resource?<br>* Woodcuts and Fish are sold at the Market.</center><br><br />\n";
$page .= "<center><form action=\"index.php?do=sellfish\" method=\"post\" />\n";
$page .= "Amount: <input type=\"text\" name=\"sell\" />\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Sell fishes\" class=\"myButton2\" />
&nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"cancel\" value=\"Sell WoodCuttings\" class=\"myButton2\"></center>\n";
$page .= "</form><br><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
}
display($page, $title);
}

//END FISH MARKET



//Fishing


function fish() { //
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 

AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>Cheat attempt was Detected</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lake of Many Fish\" title=\"Warden of the Lake of Many Fish\"><br>Cheat attempt was detected!</center><br /><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />", 
"Error"); }

$townrow = mysql_fetch_array($townquery);
if ( $userrow["currenttp"] <=3 ) { display("<center><h3 class='title'>Cheat attempt was Detected</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lake of Many Fish\" title=\"Warden of the Lake of Many Fish\"><br>You DO NOT have enough Travel Points.</center><br /><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />", "Error"); }

if ( $userrow["fishskill"] ==0 ) { display("<center><h3 class='title'>Fishing Skill Needed</h3></center>
<br><center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lake of Many Fish\" title=\"Warden of the Lake of Many Fish\"><br>You DO NOT have this skill.<br />You can learn the Skill of Fishing at the University.<br /><br />Only those with Woodcutting skill may enter.<br /></center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a>", "Error"); }

if ( $userrow["woodskill"] ==1 ) { display("<center><h3 class='title'>Woodcutting Skill Needed</h3><br>
<br>
<center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lost Forests\" title=\"Warden of the Lost Forests\"><br>You DO NOT have this skill.<br />You can learn the Skill of Woodcutting at the University.<br /><br />Only those with Fishing skill may enter.<br /></center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br><br>", "Error"); }

if (isset($_POST['submit'])) {
if ( $_POST["ac"] == t1 ) {

	$fish = rand(1,25); 
$tp = rand(1,17);
$newfish = $userrow["fish"] + $fish;
$newtp = $userrow["currenttp"] - $tp;
}
elseif ( $_POST["ac"] == t2 ){

$fish = rand(1,20); 
$tp = rand(1,14);
$newfish = $userrow["wood"] + $fish;
$newtp = $userrow["currenttp"] - $tp;
}
elseif ( $_POST["ac"] == t3 ){

	$fish = rand(1,10); 
$tp = rand(1,7);
$newfish = $userrow["fish"] + $fish;
$newtp = $userrow["currenttp"] - $tp;
}

elseif ( $_POST["ac"] == t4 ){

$fish = rand(1,5); 
$tp = rand(1,3);
$newfish = $userrow["fish"] + $fish;
$newtp = $userrow["currenttp"] - $tp;
}

$query = doquery("UPDATE {{table}} SET fish='$newfish',currenttp='$newtp' WHERE id='".$userrow["id"]."' LIMIT 
1", "users");

$title = "Returned from the Lake of Many Fish";
$page = "<center><h3 class='title'>Warden of the Lake of Many Fish</h3></center><br>
<br>
<center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lake of Many Fish\" title=\"Warden of the Lake of Many Fish\"></center>
<br />
<center>You have returned from the lake with <font color=\"#8E6C62\">$fish Fish</font>.
<br>
<a href=\"index.php?do=fish\" class=\"myButton2\" />Back to Lake</a>  
Or Sell your Fish at the <a href=\"index.php?do=market\" class=\"myButton2\" />Town Market</a>.</center><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>";

} elseif (isset($_POST["cancel"])) {

header("Location: index.php"); die();
} else {

$title = "Warden of the Lake of Many Fish";
$page = "<center><h3 class='title'>Warden of the Lake of Many Fish</h3></center><br>
<br>
<center><img src=\"images/npc/Ronuald.png\" alt=\"Warden of the Lake of Many Fish\" title=\"Warden of the Lake of Many Fish\"><br> Do you want to go Fishing at the Lake of Many Fish?
<br>* Fishing takes Travel Points!</center>
<br><center><blockquote><blockquote>".$userrow["charname"]." you currently have<font color=\"#8E6C62\"> ".$userrow["wood"]." Cuts of Wood</font> & <font color=\"#B95337\">".$userrow["fish"]." Fresh Fish</font><br>with <font color=\"#9E8E52\">".$userrow["gold"]." Gold Coins</font> &  <font color=\"#9E8E52\">".$userrow["bank"]." Gold Coins</font> in the ".$townrow["name"]." Bank.
<br /><br />\n";
$page .= "<center><form action=\"index.php?do=fish\" method=\"post\">\n";
$page .= "
<input type=\"radio\" name=\"ac\" value=\"t1\" />120  Minutes<br />
<input type=\"radio\" name=\"ac\" value=\"t2\" /> 60 Minutes<br />
<input type=\"radio\" name=\"ac\" value=\"t3\" /> 30 Minutes<br />
<input type=\"radio\" name=\"ac\" value=\"t4\" /> 10 Minutes<br /><br />\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Go Fishing\" class=\"myButton2\">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"cancel\" value=\"Maybe Later\" class=\"myButton2\"></blockquote></blockquote></center>\n";
$page .= "</form><br><center><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=un\" class=\"myButton2\" />The University</a><br /><br /><a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center>\n";
}
display($page, $title);
}


//END FISHING MOD



//UNIVERSITY MOD

function un() { //
global $userrow, $numqueries;
    $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' 
AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (mysql_num_rows($townquery) != 1) { display("<center><h3 class='title'>University of Knowledge</h3></center><br>
<br><center><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" title=\"Scholar at the University\"></center><br><center>Cheat attempt was detected!.</center><br /><br />", "Error"); }

if ($userrow["woodskill"] == 1 ) { display("<center><h3 class='title'>University of Knowledge</h3></center><br>
<br><center><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" title=\"Scholar at the University\"></center><br><center>You have already acquired your Fishing skills from here.<br>Only one Skill can be learned<br><br><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />
<br />", "Error"); }

$townrow = mysql_fetch_array($townquery);
if ($userrow["fishskill"] == 1 ) { display("<center><h3 class='title'>University of Knowledge</h3></center><br>
<br><center><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" title=\"Scholar at the University\"></center><br><center>You have already acquired your Wood Cutting skills from here.<br>Only one Skill can be learned<br><br><a href=\"index.php?do=ranger\" class=\"myButton2\" />Wardens Office</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=towninf\" class=\"myButton2\" />The Town Gates</a></center><br />
<br />", "Error"); }

$townrow = mysql_fetch_array($townquery);
if ($userrow["gold"] < 3000 ) { display("<center><h3 class='title'>University of Knowledge</h3></center><br>
<br><center><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" title=\"Scholar at the University\"><br>You DO NOT have enough money to learn a skill at the University of Knowledge<BR>Wood or Fish skill cost 3000 Gold Coins.<br /><br /><br />When you do learn a Skill, remember Fishing or Cutting Wood<br />will cost you a Random Amount of Travel Points {TP} each time.</center><br /><br />", "Error"); }
if (isset($_POST['submit'])) {	
$tp = 500;
$auth = 1;
$newwoodskill = $userrow["woodskill"] + $auth;
$newgold = $userrow["gold"] - $tp;
$query = doquery("UPDATE {{table}} SET woodskill='$newwoodskill',gold='$newgold' WHERE id='".$userrow["id"]."' 
LIMIT 1", "users");

$title = "You have acquired new skills";
$page = "<center><h3 class='title'>University of Knowledge</h3></center><br>
<br><center><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" title=\"Scholar at the University\"></center><br><blockquote><blockquote>You have acquired new skills, now you can visit the Lost Forest. Your Wood Cuttings can be sold at the Market.</blockquote></blockquote><br><center><a href=\"index.php?do=woodcut\" class=\"myButton2\" />Go to the Lost Forest</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=market\" class=\"myButton2\" />Sell Woodcuts at Town Market</a>.</center>";
} elseif (isset($_POST["cancel"])) {
$tp = 500;
$auth = 1;
$newfishskill = $userrow["fishskill"] + $auth;
$newgold = $userrow["gold"] - $tp;
$query = doquery("UPDATE {{table}} SET fishskill='$newfishskill',gold='$newgold' WHERE id='".$userrow["id"]."' 

LIMIT 1", "users");
$title = "You have acquired new skills";
$page = "<center><h3 class='title'>University of Knowledge</h3></center>
<br><center><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" title=\"Scholar at the University\"><br><blockquote><blockquote><font color=red>Congratulations!</font>
You have acquired the Fishing skills, now you can visit the Lake of Many Fish. Your Fresh Fish may be sold at the Market.</blockquote></blockquote><br><center><a href=\"index.php?do=fish\" class=\"myButton2\" />Go to Lake of Many Fish</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=market\" class=\"myButton2\" />Sell Fish at Market</a>.</center>";

} else {
$title = "University of Knowledge";
$page = "<center><h3 class='title'>University of Knowledge</h3></center>
<br><div align=center><table width=55%><tr><td><blockquote><blockquote><img src=\"images/npc/Qroximus.png\" alt=\"Scholar at the University\" align=\"left\" title=\"Scholar at the University\"></td><td>&nbsp; &nbsp; &nbsp; &nbsp; </td><td><br /><br />Which of the following skills do you wish to learn at the $title? Knowledge of a Skill costs <b>3000 Gold Coins</b>.<br><br><i><b>Choose wisely, you can ONLY learn One Skill</b>.</i><br /><br />* Woodcutting will allow you to enter the forest and cut woods, then you can sell them at the market.<br>* Fishing will allow you to enter the Lake Forest and fish there, then you can sell them at the market. <br /><br />When you do learn a Skill, remember Fishing or Cutting Wood<br />will cost you a Random Amount of <b>Travel Points {TP}</b> each time.<br /><br /></blockquote></blockquote></td></tr></table></div><br><br>\n";
$page .= "<center><form action=\"index.php?do=un\" method=\"post\">\n";
$page .= "<input type=\"submit\" name=\"submit\" value=\"Learn woodcutting!\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Learn fishing!\"  class=\"myButton2\" /></center>\n";
$page .= "</form>\n";
}
display($page, $title);
}

//UNIVERSITY MOD






// START FUNCTION ONE

function buy() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("W 496 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist = explode(",",$townrow["itemslist"]);
    $querystring = "";
    foreach($itemslist as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items");
	
	
// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Weapons Shop Information</h3></center>\n";
	
	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/weaponshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring. Thank you for visiting. If you have changed your mind. You can return to the:</td></tr>
<tr><td colspan=\"2\"><br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | <br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Weapons Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	
 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=buy2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
// START BOTTOM OF PAGE CODE FOR SHOP 01
	
	$page .= "<center><h3 class=\"title\">Weapons Shop</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item that we hope will enhance your exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/weaponshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Weapons Shop</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 01
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function buy2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("W 617 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist"]);
    if (! in_array($id, $townitems)) { display("w 621 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Not at Required Level to Buy</h3></center><br /><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /><br /><a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | <a href=\"index.php?do=rina\">Magic Shop</a> | <a href=\"index.php?do=rinb\">Ring Shop</a> or use the direction buttons on the left to start exploring.</blockquote><br /><center><h3 class=\"title\">Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Need More Gold Coins</h3></center><br /><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /><br /><a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | <a href=\"index.php?do=rina\">Magic Shop</a> | <a href=\"index.php?do=rinb\">Ring Shop</a> or use the direction buttons on the left to start exploring.</blockquote><br /><center><h3 class=\"title\">Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>


<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
	    
	$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function buy3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("W 1025 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist"]);
    if (! in_array($id, $townitems)) { display("W 1028 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gauntlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gauntlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }




// START ITEM 1
    
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

// END ITEM 1
// START ITEM 2
        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 4
// START ITEM 5

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

// END ITEM 4
// START ITEM 5

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR Weapons ITEMS-1,2,3,4,5,6,7-8-9
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	

// END STORE-1 BUY-1 ITEMSLIST - BUY







// START STORE-2 SHIELDS - LOJA


   function loja() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Shields Line - 1496 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist2 = explode(",",$townrow["itemslist2"]);
    $querystring = "";
    foreach($itemslist2 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Shield Shop: Information</h3></center>\n";
	
	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/shieldshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Shield Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	

 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=loja2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
	
	$page .= "<center><h3 class=\"title\">Shield: Return to Locations</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/shieldshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Shield Shop: Return to Locations</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function loja2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Shields Line - 1620 Cheat attempt detected.<br /><br />1620 Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist2"]);
    if (! in_array($id, $townitems)) { display("Shields Line - 1624 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=loja\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
    } 		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 		
		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicrings"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function loja3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist2 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("S 2026 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist2"]);
    if (! in_array($id, $townitems)) { display("S 2029 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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


// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR Weapons ITEMS-1,2,3,4,5,6,7-8-9
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	
	
// END STORE-2 SHIELDS ITEMSLIST2 - LOJA







// START STORE-3 ARMOR-2 ITEMSLIST3 - AMRO amro

   function amro() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist3 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("A 2496 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist3 = explode(",",$townrow["itemslist3"]);
    $querystring = "";
    foreach($itemslist3 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items");

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Armor Shop: Information</h3></center>\n";
	
	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/armorshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Armor Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	
 
 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=amro2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
	
	$page .= "<center><h3 class=\"title\">Armor: Return to Locations</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/armorshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Armor Shop: Return to Locations</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function amro2($id) { // Confirm users intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist3 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("A 2619 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist3"]);
    if (! in_array($id, $townitems)) { display("A 2623 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 	

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 	

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 	

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 	

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 	

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid- SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center>";
        }
    } 	

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function amro3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist3 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("A 3102 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist3"]);
    if (! in_array($id, $townitems)) { display("A 3105 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gauntlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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


// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR SHOP SHIELD ITEMS
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	

// END STORE-3 ARMOR-2 ITEMSLIST3 - AMRO






// START STORE-4 PETS-4 ITEMSLIST4 - pxcu

   function pxcu() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist4 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("P 3571 Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist4 = explode(",",$townrow["itemslist4"]);
    $querystring = "";
    foreach($itemslist4 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Pet Shop: Information</h3></center>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/petshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Pet Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	
 
 
  
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=pxcu2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
		
		
// START BOTTOM OF PAGE CODE FOR SHOP 
	
	$page .= "<center><h3 class=\"title\">Pet: Return to Locations</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/petshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Pet Shop: Return to Locations</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function pxcu2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist4 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist4"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
                  $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
		$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
		$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
		$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
		$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	            
		$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
		$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid- SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	
		

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function pxcu3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist4 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist4"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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
        if ($itemsrow2["special"] 
		!= "X") {
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


// END ITEM 1
// START ITEM 2

        
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


// END ITEM 2
// START ITEM 3


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


// END ITEM 3
// START ITEM 4


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


// END ITEM 4
// START ITEM 5  HELMET


     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR SHOP PET ITEMS
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	


// END STORE-4 PETS-4 ITEMSLIST4 - pxcu





// START STORE-5 HELMET-5 ITEMSLIST5 - hzrt

   function hzrt() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist5 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist5 = explode(",",$townrow["itemslist5"]);
    $querystring = "";
    foreach($itemslist5 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Helmet Shop: Information</h3></center>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/helmetshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Helmet Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	


 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=hzrt2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
    $page .= "<center><h3 class=\"title\">Helmet Shop: Return to Locations</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/helmetshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Helmet Shop: Return to Locations</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function hzrt2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist5 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist5"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    
    if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Helmet Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /><a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Helmet Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }
    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
			

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		


// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>

<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 

<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.

<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.

<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.

<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
  
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
	
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>

<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>

<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		


// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />	
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center><br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}


// FUNCTION 2 END
// FUNCTION 3 START


function hzrt3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist5 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist5"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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
        if ($itemsrow2["special"] 
		!= "X") {
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

// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR HELMET SHIELD ITEMS
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	

	
	

// END STORE-5 HELMET ITEMSLIST-5 - hzrt





// START STORE-6 GAUNTLETS ITEMSLIST-6 ghmk



   function ghmk() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist6 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist6 = explode(",",$townrow["itemslist6"]);
    $querystring = "";
    foreach($itemslist6 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Gauntlets Shop: Information</h3></center>\n";
	
	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/gauntletshop.png\" alt=\"Gauntlet Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Gauntlets Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	
 

 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=ghmk2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
	
	$page .= "<center><h3 class=\"title\">Gauntlets: Return to Locations</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/gauntletshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Gauntlets Shop: Return to Locations</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function ghmk2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist6 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist6"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
$page = "<center><h3 class=\"title\">Selling you old Item</h3></center><blockquote><blockquote>If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." Gold Coins. So, Do we have a Deal? If not, just put back the item where you found it on your way out, this Shop has no more time for you.<br /><br /><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Deal\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Not Right Now\" class=\"myButton2\" /></form></blockquote></blockquote><center><h3 class=\"title\">Selling you old Item</h3></center>";
       
	    } else {
           
	$page = "<center><h3 class=\"title\">Buying a Item</h3></center><blockquote>You are buying the ".$itemsrow["name"].", is that the Item you want?<br /><br /><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Buying a Item</h3></center>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling you old Item</h3></center><blockquote>If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." Gold Coins. So, Do we have a Deal? If not, just put back the item where you found it on your way out, this Shop has no more time for you.<br /><br /><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Selling you old Item</h3></center>";
       
	    } else {
           
	$page = "<center><h3 class=\"title\">Buying a Item</h3></center><blockquote>You are buying the ".$itemsrow["name"].", is that the Item you want?<br /><br /><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Buying a Item</h3></center>";
        }
    } 	

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
			
            
	$page = "<center><h3 class=\"title\">Selling you old Item</h3></center><blockquote>If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." Gold Coins. So, Do we have a Deal? If not, just put back the item where you found it on your way out, this Shop has no more time for you.<br /><br /><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Selling you old Item</h3></center>";
       
	    } else {
           
	$page = "<center><h3 class=\"title\">Buying a Item</h3></center><blockquote>You are buying the ".$itemsrow["name"].", is that the Item you want?<br /><br /><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Buying a Item</h3></center>";
        }
    } 		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// START ITEM 9 ["magicringsid"] - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function ghmk3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist6 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist6"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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


// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR GAUNTLETS
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	

	

// END STORE-6 GAUNTLETS ITEMSLIST-6 ghmk






// START STORE-7 BOOT ITEMSLIST 7 - bmnn



function bmnn() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist7 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist7 = explode(",",$townrow["itemslist7"]);
    $querystring = "";
    foreach($itemslist7 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Boot Shop: Information</h3></center>\n";
	
	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/bootshop.png\" alt=\"Boot Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Boot Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	
  

 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=bmnn2:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
	
	$page .= "<center><h3 class=\"title\">Boot Shop: Return to Locations</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/bootshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Boot Shop: Return to Locations</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function bmnn2($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist7 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist7"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
$page = "<center><h3 class=\"title\">Selling you old Item</h3></center><blockquote><blockquote>If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." Gold Coins. So, Do we have a Deal? If not, just put back the item where you found it on your way out, this Shop has no more time for you.<br /><br /><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Deal\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Not Right Now\" class=\"myButton2\" /></form></blockquote></blockquote><center><h3 class=\"title\">Selling you old Item</h3></center>";
       
	    } else {
           
	$page = "<center><h3 class=\"title\">Buying a Item</h3></center><blockquote>You are buying the ".$itemsrow["name"].", is that the Item you want?<br /><br /><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Buying a Item</h3></center>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function bmnn3($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist7 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist7"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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


// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR Boots
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	

	

// END STORE-7 BOOT ITEMSLIST-7 - bmnn

// START STORE-8 WEAPON1 ITEMSLIST-8 - wea1 - Ranged & Throwing Weapons
// START STORE-8 WEAPON1 ITEMSLIST-8 - wea1 - Ranged & Throwing Weapons
// START STORE-8 WEAPON1 ITEMSLIST-8 - wea1 - Ranged & Throwing Weapons






function wea1() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist8 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist8 = explode(",",$townrow["itemslist8"]);
    $querystring = "";
    foreach($itemslist8 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Range & Throwing Weapons</h3></center>\n";
	
	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/rangeandthrowingshop.png\" alt=\"Weapons Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Range & Throwing Weapons</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	


    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=wea12:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
		
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
	
	$page .= "<center><h3 class=\"title\">Range Weapons</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/rangeandthrowingshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Range Weapons</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function wea12($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist8 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist8"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Range & Throwing Weapons - Required Level Not Meet</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may continue shopping, or return to:<br />The <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=wea1\">Range Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a>, <a href=\"index.php?do=wea2\">Magic Rings Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Range & Throwing Weapons - Required Level Not Meet</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Range & Throwing Weapons - Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from the <a href=\"index.php?do=bank\">Town Bank</a>.<br /><br />Thank you for visiting. You may continue shopping, or return to:<br />The <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=wea1\">Range Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a>, <a href=\"index.php?do=wea2\">Magic Rings Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Range & Throwing Weapons - Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
$page = "<center><h3 class=\"title\">Selling you old Item</h3></center><blockquote><blockquote>If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." Gold Coins. So, Do we have a Deal? If not, just put back the item where you found it on your way out, this Shop has no more time for you.<br /><br /><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Deal\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Not Right Now\" class=\"myButton2\" /></form></blockquote></blockquote><center><h3 class=\"title\">Selling you old Item</h3></center>";
       
	    } else {
           
	$page = "<center><h3 class=\"title\">Buying a Item</h3></center><blockquote>You are buying the ".$itemsrow["name"].", is that the Item you want?<br /><br /><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Buying a Item</h3></center>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
		
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 	

// START ITEM 9 magicringsid - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}

// FUNCTION 2 END
// FUNCTION 3 START

function wea13($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist8 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist8"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br />You may continue shopping, or return to:<br />The <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=wea1\">Range Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a>, <a href=\"index.php?do=wea2\">Magic Rings Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br />You may continue shopping, or return to:<br />The <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=wea1\">Range Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a>, <a href=\"index.php?do=wea2\">Magic Rings Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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


// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicringsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR Weapon1 wea1
    
	display("<center><h3 class=\"title\">Range Weapons Shop: Thank you for Visiting</h3></center><blockquote><br />We Hope Your Recent Purchase Enhances your Exploring. If you need a different item, select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> before continuing to: <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /><a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=wea1\">Range Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a>, <a href=\"index.php?do=wea2\">Magic Rings Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Range Weapons Shop: Thank you for Visiting</h3></center>", "Buy Items");

	    }
	


// END STORE-8 WEAPON1 ITEMSLIST-8 - wea1
// END STORE-8 WEAPON1 ITEMSLIST-8 - wea1
// END STORE-8 WEAPON1 ITEMSLIST-8 - wea1

// START STORE-9 WEAPON2 ITEMSLIST-9 - wea2 - Magic Rings
// START STORE-9 WEAPON2 ITEMSLIST-9 - wea2 - Magic Rings
// START STORE-9 WEAPON2 ITEMSLIST-9 - wea2 - Magic Rings




   function wea2() { // Displays a list of available items for purchase.
    
    global $userrow, $numqueries;
    
    $townquery = doquery("SELECT name,itemslist9 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    $itemslist9 = explode(",",$townrow["itemslist9"]);
    $querystring = "";
    foreach($itemslist9 as $a=>$b) {
        $querystring .= "id='$b' OR ";
    }
    $querystring = rtrim($querystring, " OR ");
    

    $itemsquery = doquery("SELECT * FROM {{table}} WHERE $querystring ORDER BY id", "items"); 

// START TOP OF PAGE CODE FOR SHOP 01
	
	$page = "<center><h3 class=\"title\">Magic Ring Shop: Information</h3></center>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/magicringshop.png\" alt=\"Magic Ring Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Magic Ring Shop: Items for Purchase</h3></center><br />\n";

// END TOP OF PAGE CODE FOR SHOP 01
	
  

 
    $page .= "<center><table width=\"96%\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
    while ($itemsrow = mysql_fetch_array($itemsquery)) {
		
        if ($itemsrow["type"] == 1) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 4) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 6) { $attrib = "Attack Power:"; }
		elseif ($itemsrow["type"] == 8) { $attrib = "Attack Power:"; }
		else  { $attrib = "Defense Power:"; }	
		
        $page .= "<tr><td width=\"10%\">";
if ($itemsrow["type"] == 1) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"weapon\" /></td>"; }
if ($itemsrow["type"] == 2) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"armor\" /></td>"; }
if ($itemsrow["type"] == 3) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"shield\" /></td>"; }
if ($itemsrow["type"] == 4) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"pet\" /></td>"; }
if ($itemsrow["type"] == 5) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"helmet\" /></td>"; }
if ($itemsrow["type"] == 6) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"gauntlet\" /></td>"; }
if ($itemsrow["type"] == 7) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"boot\" /></td>"; }
if ($itemsrow["type"] == 8) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"rangeweapons\" /></td>";}
if ($itemsrow["type"] == 9) { $page .= "<img src=\"imag/".$itemsrow["name"].".png\" alt=\"magicrings\" /></td>";}

     if ($userrow["weaponid"] == $itemsrow["id"]
     || $userrow["armorid"] == $itemsrow["id"]
     || $userrow["shieldid"] == $itemsrow["id"]
     || $userrow["petid"] == $itemsrow["id"]
     || $userrow["helmetid"] == $itemsrow["id"]
     || $userrow["gauntletid"] == $itemsrow["id"]
     || $userrow["bootid"] == $itemsrow["id"]
     || $userrow["rangeweaponsid"] == $itemsrow["id"]
     || $userrow["magicringsid"] == $itemsrow["id"])
{ 

$page .= "	  
      <td width=\"50\"><span class=\"light\">".$itemsrow["name"]."</span></td>
	  <td width=\"160\"><span class=\"light\">$attrib ".$itemsrow["attribute"]."</span><br>
	  <span class=\"light\">Purchased ".$itemsrow["buycost"]." GCs</span><br>
	  <span class=\"light\">Req Lvl: ".$itemsrow["level"]."</span></td>
     <td width=\"150\">
	 <span class=\"light\">S-1:&nbsp; ".$itemsrow["special"]."</span><br>
	 <span class=\"light\">S-2:&nbsp; ".$itemsrow["special2"]."</span><br>
	 <span class=\"light\">S-3:&nbsp; ".$itemsrow["special3"]."</span></td>
     <td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]." </span></td></tr>\n";
} else {
	if ($itemsrow["special"] != "-----") { $specialdot = "<span class=\"highlight\">&#42;</span>"; } else { $specialdot = ""; }
$page .= "
<td width=\"50\"><a href=\"index.php?do=wea22:".$itemsrow["id"]."\">".$itemsrow["name"]."</a>$specialdot</td>
<td width=\"160\">$attrib ".$itemsrow["attribute"]."<br>
Req Level: ".$itemsrow["level"]."<br>
GCs: ".$itemsrow["buycost"]." 
	<td width=\"150\"><font color=\"#5798FF\">S-1:&nbsp; ".$itemsrow["special"]."</font><br>
	<font color=\"#5798FF\">S-2:&nbsp; ".$itemsrow["special2"]."</font><br>
	<font color=\"#5798FF\">S-3:&nbsp; ".$itemsrow["special3"]."</font></td>
	<td width=\"40%\"><span class=\"light\">Description of ".$itemsrow["name"].": ".$itemsrow["description"]."</span></td></tr><tr>
	\n";
        }
    }
		
    $page .= "</table></center>\n";
		
// START BOTTOM OF PAGE CODE FOR SHOP 02
    $page .= "<center><h3 class=\"title\">Magic Rings</h3></center>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote>If you've bought a Item we hope it Enhances your Exploring or If short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a>.</blockquote>\n";

	$page .= "<blockquote><table border=\"0\" width=\"100%\"><tr><td align=\"left\" valign=\"middle\"><img src=\"images/shops/magicringshop.png\" alt=\"Items Shop\" border=\"0\"></td><td>
Purchasing Weapons, Range & Throwing Weapons, Gauntlets or Pets will increase your <font color=\"#168F09\">[Attack Attributes].</font> Buying Armor, Shields, Helmet, Boots or Magic Rings will increase your <font color=\"#4E63A2\">[Defense Attributes].</font>

<br /><br />The following items are available [From the List] below to purchase. If you've bought a Item we hope it Enhances your Exploring. Short on Gold Coins? You can withdraw funds from the <a href=\"index.php?do=bank\">Town Bank</a> or use the direction buttons on the left to start exploring.</td></tr>
<tr><td colspan=\"2\">Thank you for visiting. If you have changed your mind. You can return to the: 

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gaunlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></td></tr></table></blockquote>\n";

    $page .= "<center><h3 class=\"title\">Magic Rings</h3></center>\n";

// END BOTTOM OF PAGE CODE FOR SHOP 02
    $title = "Buy Items";
    
    display($page, $title);
}


// FUNCTION 1 END
// FUNCTION 2 START

// START CHEATING CODE

function wea22($id) { // Confirm user's intent to purchase item.
    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,itemslist9 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist9"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
	
	
// END CHEATING CODE
// START NOT ENOUGH GOLD COINS
    
    if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /><a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Need More Gold Coins</h3></center>", "Buy Items"); die(); }
    
    
// END NOT ENOUGH GOLD COINS
		
		
// END NOT ENOUGH MONEY
// START ITEM 1 - SELLING ITEMS AFTER PURCHASE

	
if ($itemsrow["type"] == 1) {
	if ($userrow["weaponid"] != 0) { 
	$itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["weaponid"]."' LIMIT 1", "items");
	$itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=buy3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 1 ["weaponid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
		
		
    		
	elseif ($itemsrow["type"] == 2) {
        if ($userrow["armorid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["armorid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
$page = "<center><h3 class=\"title\">Selling you old Item</h3></center><blockquote><blockquote>If you are buying the ".$itemsrow["name"].", then I will buy your ".$itemsrow2["name"]." for ".ceil($itemsrow2["buycost"]/2)." Gold Coins. So, Do we have a Deal? If not, just put back the item where you found it on your way out, this Shop has no more time for you.<br /><br /><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Deal\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"Not Right Now\" class=\"myButton2\" /></form></blockquote></blockquote><center><h3 class=\"title\">Selling you old Item</h3></center>";
       
	    } else {
           
	$page = "<center><h3 class=\"title\">Buying a Item</h3></center><blockquote>You are buying the ".$itemsrow["name"].", is that the Item you want?<br /><br /><form action=\"index.php?do=amro3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></blockquote><center><h3 class=\"title\">Buying a Item</h3></center>";
        }
    } 		

// END ITEM 2 ["armorid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 3) {
        if ($userrow["shieldid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["shieldid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=loja3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 3 ["shieldid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
		
	elseif ($itemsrow["type"] == 4) {
        if ($userrow["petid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["petid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=pxcu3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// END ITEM 4 ["petid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 5) {
        if ($userrow["helmetid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["helmetid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=hzrt3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		


// END ITEM 5 ["helmetid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 6) {
        if ($userrow["gauntletid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["gauntletid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=ghmk3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		


// END ITEM 6 ["gauntletid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 7) {
        if ($userrow["bootid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["bootid"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=bmnn3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 7 ["bootid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 8) {
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweapons"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea1:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea13:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		
		

// END ITEM 8 ["rangeweaponsid"] - SELLING ITEMS AFTER PURCHASE
// START ITEM 9 ["magicringsid"] - SELLING ITEMS AFTER PURCHASE
		
		
	elseif ($itemsrow["type"] == 9) {
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicrings"]."' LIMIT 1", "items");
            $itemsrow2 = mysql_fetch_array($itemsquery2);
			
            
	$page = "<center><h3 class=\"title\">Selling Your Old Item</h3></center><br />
<center><table border=\"0\" width=\"90%\"><tr>
     <td align=\"center\">Exchange<br />".$itemsrow2["name"]."</td>
     <td><img src=\"imag/".$itemsrow2["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
      <td align=\"center\">Purchase<br />".$itemsrow["name"]."</td>
     <td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<blockquote>
<br />If you are buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Then I will buy your old rusty <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. 
<br /><br />Originally you paid [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/1)."</font>] Gold Coins for the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> when it was new. Because of Cleaning, Restocking and Marketing of a used <font color=\"#0000EC\">".$itemsrow2["name"]."</font> My best offer is half of your Original Price, [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins. This is the Best price in <a href=\"index.php?do=towninf\">".$townrow["name"]."</a>.
<br /><br />Presently you have [<font color=\"#803159\">".$userrow["gold"]."</font>] Gold Coins and another [<font color=\"#803159\">".$userrow["bank"]."</font>] in the <a href=\"index.php?do=bank\">Town Bank</a>. Selling the <font color=\"#0000EC\">".$itemsrow2["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow2["buycost"]/2)."</font>] Gold Coins and buying the <font color=\"#04501A\">".$itemsrow["name"]."</font> for [<font color=\"#803159\">".ceil($itemsrow["buycost"]/1)."</font>] Gold Coins. Leaving you with [<font color=\"#803159\">".$userrow["bank"] = $userrow["gold"] + ceil($itemsrow2["buycost"]/2) - $itemsrow["buycost"]."</font>] Gold Coins.
<br><br>Your current weapon the, <font color=\"#0000EC\">".$itemsrow2["name"]."</font> is out of date and does not meet your Exploring Needs any more. You would be foolish not to purchase the <font color=\"#04501A\">".$itemsrow["name"]."</font>. So, Do we have a Deal? If not, just put back the <font color=\"#04501A\">".$itemsrow["name"]."</font> where you found it and be on your way, this Shop has no more time for you.
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Purchase Item\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No Thanks\" class=\"myButton2\" /></form><br /><a href=\"index.php?do=bank\" class=\"myButton2\">Town Bank</a></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Selling Your Old Item</h3></center><br>";
       
	    } else {
           
$page = "<center><h3 class=\"title\">Buying a New Item</h3></center><br><br><center><table border=\"0\" width=\"90%\"><tr>
<td align=\"center\">Purchase ".$itemsrow["name"]."</td>
<td><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /></td>
</tr></table></center>
<br><blockquote>You are buying the<font color=\"#803159\"> ".$itemsrow["name"]."</font> for <font color=\"#803159\">".ceil($itemsrow["buycost"]/1)." Gold Coins</font>, is that the Item you want? If you ever decide to sell it and will buy it for half the of your purchase price.</blockquote>
<br /><br /><center><form action=\"index.php?do=wea23:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\" /></form></center>
<br><br><center> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br /> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | 
<br /> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> |</center><br><br></blockquote><center><h3 class=\"title\">Buying a New Item</h3></center><br>";
        }
    } 		

// START ITEM 9 ["magicringsid"] - SELLING ITEMS AFTER PURCHASE
	
    $title = "Buy Items";
    display($page, $title);
}


// FUNCTION 2 END
// FUNCTION 3 START


function wea23($id) { // Update user profile with new item & stats.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }
    global $userrow;
    
    $townquery = doquery("SELECT name,itemslist9 FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $townrow = mysql_fetch_array($townquery);
    $townitems = explode(",",$townrow["itemslist9"]);
    if (! in_array($id, $townitems)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    
    $itemsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $itemsrow = mysql_fetch_array($itemsquery);
    

	if ($userrow["level"] < $itemsrow["level"]) { display("<center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center><blockquote>Item unavailable for you to purchase. You need to meet or exceed the level required for this Item. <br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Not at Required Level to Buy</h3></center>", "Buy Items"); die(); }

	if ($userrow["gold"] < $itemsrow["buycost"]) { display("<center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center><blockquote>You DO NOT have enough gold to buy this item. Short on Gold Coins? You can withdraw Gold Coins from your <a href=\"index.php?do=bank\">Bank</a>.<br /><br />Thank you for visiting. You may return to the:<br /> <a href=\"index.php\">Town Square</a>, <a href=\"index.php?do=buy\">Weapons Shop</a>, <a href=\"index.php?do=amro\">Armor Shop</a>, <a href=\"index.php?do=loja\">Shields Shop</a>, <a href=\"index.php?do=pxcu\">Pet Shop</a>, <a href=\"index.php?do=hzrt\">Helmet Shop</a>, <a href=\"index.php?do=ghmk\">Gaunlets Shop</a>, <a href=\"index.php?do=bmnn\">Boots Shop</a> or use the direction buttons on the left to start exploring.</blockquote><center><h3 class=\"title\">Weapons Shop: Need More Gold Coins</h3></center>", "Buy Items"); die(); }



    
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
        if ($itemsrow2["special"] 
		!= "X") {
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

// END ITEM 1
// START ITEM 2

        
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

// END ITEM 2
// START ITEM 3

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

// END ITEM 3
// START ITEM 4

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

// END ITEM 4
// START ITEM 5  HELMET

     } if ($itemsrow["type"] == 5) { // helmet
    	
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
        $newdefense = $userrow["defensepower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', helmetid='$newid', helmetname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 5
// START ITEM 6  GAUNTLET

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

// END ITEM 6
// START ITEM 7

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
        $newdefense = $userrow["defensepower"] + $itemsrow["attribute"] - $itemsrow2["attribute"];
        $newid = $itemsrow["id"];
        $newname = $itemsrow["name"];
        $userid = $userrow["id"];
        if ($userrow["currenthp"] > $userrow["maxhp"]) { $newhp = $userrow["maxhp"]; } else { $newhp = $userrow["currenthp"]; }
        if ($userrow["currentmp"] > $userrow["maxmp"]) { $newmp = $userrow["maxmp"]; } else { $newmp = $userrow["currentmp"]; }
        if ($userrow["currenttp"] > $userrow["maxtp"]) { $newtp = $userrow["maxtp"]; } else { $newtp = $userrow["currenttp"]; }
        
        // Final update.
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', bootid='$newid', bootname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 7
// START ITEM 8

     } if ($itemsrow["type"] == 8) { // weapon1
    	
    	// Check if they already have an item in the slot.
        if ($userrow["rangeweaponsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["rangeweaponsid"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', attackpower='$newattack', rangeweaponsid='$newid', rangeweaponsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END ITEM 8
// START ITEM 9

     } if ($itemsrow["type"] == 9) { // weapon2
    	
    	// Check if they already have an item in the slot.
        if ($userrow["magicringsid"] != 0) { 
            $itemsquery2 = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["magicrings"]."' LIMIT 1", "items");
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
        $updatequery = doquery("UPDATE {{table}} SET $specialchange1 $specialchange2 gold='$newgold', defensepower='$newdefense', magicringsid='$newid', magicringsname='$newname', currenthp='$newhp', currentmp='$newmp', currenttp='$newtp' WHERE id='$userid' LIMIT 1", "users");

// END weapon2	Item 9

	    }
	
// ENDING MENU FOR ITEMS
    
display("<center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3></center><blockquote><blockquote><br />

<center><table border=\"0\" width=\"600\"><tr>
<td width=\"25%\" align=\"center\"><img src=\"imag/".$itemsrow["name"].".png\" alt=\"Weapon\" title=\"Weapon\" /><br />".$itemsrow["name"]."</td>
<td>We Hope You Enjoy your Recent purchase of the ".$itemsrow["name"]." and it Enhances your Exploring for many years to come.<br><br>If you need a different type of Item, Please select One of our other fine Shops. If you are short on Gold Coins you can withdraw funds from your <a href=\"index.php?do=bank\">Bank</a> before continuing on.</td>
</tr></table></center>

<br><br><div align=\"center\"> | <a href=\"index.php\">Town Square</a> | <a href=\"index.php?do=towninf\">Town Gates</a> | <a href=\"index.php?do=buy\">Weapons Shop</a> | <a href=\"index.php?do=wea1\">Range Weapons Shop</a> | 
<br> | <a href=\"index.php?do=amro\">Armor Shop</a> | <a href=\"index.php?do=loja\">Shields Shop</a> | <a href=\"index.php?do=pxcu\">Pet Shop</a> | <br> | <a href=\"index.php?do=hzrt\">Helmet Shop</a> | <a href=\"index.php?do=ghmk\">Gauntlets Shop</a> | <a href=\"index.php?do=bmnn\">Boots Shop</a> | <a href=\"index.php?do=wea2\">Magic Rings Shop</a> | </div></blockquote></blockquote><br><br><center><h3 class=\"title\">Thank you for your Purchase of the ".$itemsrow["name"]."</h3>", "Buy Items");
	}	

	



// END STORE-9 WEAPON2 ITEMSLIST-9 - wea2 - Magic Rings
// END STORE-9 WEAPON2 ITEMSLIST-9 - wea2 - Magic Rings
// END STORE-9 WEAPON2 ITEMSLIST-9 - wea2 - Magic Rings
// START STORE-10 Magic ITEMSLIST-10 - rina - Magic
// START STORE-10 Magic ITEMSLIST-10 - rina - Magic
// START STORE-10 Magic ITEMSLIST-10 - rina - Magic



// Maps

function maps() { // List maps the user can buy.    
    global $userrow, $numqueries;    
    $mappedtowns = explode(",",$userrow["towns"]);    
    $page = "<center><h3 class=\"title\">Towns Maps</h3></center><br /><br><blockquote>Buying maps with <b>Copper Coins</b> will put the town in your<br />Travel To box, and will transport you there instantly for a set amount of Travel Points.<br /><br />\n";
    $page .= "Click a town name to purchase its map. You currently have <b><font color=\"#0080FF\">".$userrow["copper"]."</font> Copper Coins.</b><br /><br />\n";
    $page .= "<table width=\"98%\">\n";
    
	
	$townquery = doquery("SELECT * FROM {{table}} where hidden != '1' ORDER BY id", "towns");
    while ($townrow = mysql_fetch_array($townquery)) {
        
        if ($townrow["latitude"] >= 0) { $latitude = $townrow["latitude"] . "N,"; } else { $latitude = ($townrow["latitude"]*-1) . "S,"; }
        if ($townrow["longitude"] >= 0) { $longitude = $townrow["longitude"] . "E"; } else { $longitude = ($townrow["longitude"]*-1) . "W"; }
        
        $mapped = false;
        foreach($mappedtowns as $a => $b) {
            if ($b == $townrow["id"]) { $mapped = true; }
        }
        if ($mapped == false) {
            $page .= "<tr><td width=\"25%\"><a href=\"index.php?do=maps2:".$townrow["id"]."\">".$townrow["name"]."</a></td><td width=\"25%\">Price: ".$townrow["mapprice"]." <b>Copper Coins</b></td><td width=\"50%\" colspan=\"2\">Buy map to reveal details.</td></tr>\n";
        } else {
            $page .= "<tr><td width=\"25%\"><span class=\"light\">".$townrow["name"]."</span></td><td width=\"25%\"><span class=\"light\">Already mapped.</span></td><td width=\"35%\"><span class=\"light\">Location: $latitude $longitude</span></td><td width=\"15%\"><span class=\"light\">TP: ".$townrow["travelpoints"]."</span></td></tr>\n";
        }
            }
    $page .= "</table><br />\n";
    $page .= "<div align=\"center\"><br><br><a href=\"index.php\" class=\"myButton2\">Town Square</a><br><br></div>.</blockquote><br />.</blockquote>\n";
    display($page, "Buy Maps");
    }

function maps2($id) { // Confirm user's intent to purchase map.
    global $userrow, $numqueries;
    $townquery = doquery("SELECT name,mapprice FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["copper"] < $townrow["mapprice"]) { display("<center><h3 class=\"title\">Towns Maps</h3></center><br /><br><blockquote>You DO NOT have enough <b>Copper Coins</b> to buy this map.<br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp; &nbsp; &nbsp; <a href=\"index.php?do=maps\" class=\"myButton2\">Map Shop</a><br><br /></blockquote>", "Buy Maps"); die(); }
    
    $page = "<center><h3 class=\"title\">Towns Maps</h3></center><br /><div align=\"center\"><center><table border=\"0\" width=\"770\" height=\"1506\" background=\"images\background\city\maproom.jpg\"><tr><td><br><br><br><br><blockquote><img src=\"images/maps/".$id.".png\" width=\"250\" height=\"250\" hspace=\"16\" alt=\"".$userrow["towns"].".png\" border=\"0\" align=\"left\"></td><td><br /><br /><br /><br><br><br /><br><br><br><br><br><br><br><font color=\"#FFFFFF\">You are buying the Map to <b>".$townrow["name"]."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>for <b>".$townrow["mapprice"]." Copper Coins</b> is that ok?</font><br /><br /><form action=\"index.php?do=maps3:$id\" method=\"post\"><input type=\"submit\" name=\"submit\" value=\"Yes\" class=\"myButton2\"> <input type=\"submit\" name=\"cancel\" value=\"No\" class=\"myButton2\"></form></blockquote></td></tr></table></center></div>";
    display($page, "Buy Maps");      
}
    


function maps3($id) { // Add new map to user's profile.
    
    if (isset($_POST["cancel"])) { header("Location: index.php"); die(); }    
    global $userrow, $numqueries;    
    $townquery = doquery("SELECT name,mapprice FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $townrow = mysql_fetch_array($townquery);
    
    if ($userrow["copper"] < $townrow["mapprice"]) { display("<center><h3 class=\"title\">Towns Maps</h3></center><br /><br><blockquote>You DO NOT have enough <b>Silver Coins</b> to buy this map.<br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"index.php?do=maps\" class=\"myButton2\">Map Shop</a><br><br></blockquote>", "Buy Maps"); die(); }
    
    $mappedtowns = $userrow["towns"].",$id";
    $newcopper = $userrow["copper"] - $townrow["mapprice"];    
    $updatequery = doquery("UPDATE {{table}} SET towns='$mappedtowns', copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    
    display("<center><h3 class=\"title\">Towns Maps</h3></center><br /><br>
<center><table border=\"0\" width=\"770\" height=\"1506\"><tr>
     <td height=\"250\" width=\"250\"><img src=\"images/maps/".$id.".png\" width=\"250\" height=\"250\" alt=\"".$userrow["towns"].".png\" border=\"0\"></td>
     <td><blockquote>Thank you for purchasing the map to <b><font color=\"#0080FF\">".$townrow["name"]."</font></b> for <b><font color=\"#0080FF\">".$townrow["mapprice"]."</font> Copper Coins.</b><br /><br />
<br /><br /><center><a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br /><a href=\"index.php?do=maps\" class=\"myButton2\">Map Shop</a></center><br><br /></blockquote></td>
</tr>
</table></center><br />", "Buy Maps");
    
}

// Travel to Menu

function travelto($id, $usepoints=true) { // Send a user to a town from the Travel To menu.
    
    global $userrow, $numqueries;    
    if ($userrow["currentaction"] == "Fighting") { header("Location: index.php?do=fight"); die(); }    

if ($userrow["currentaction"] == "Barried") { header("Location: users.php?do=register"); die(); }

    $townquery = doquery("SELECT name,travelpoints,latitude,longitude FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $townrow = mysql_fetch_array($townquery);    
    if ($usepoints==true) { 
        if ($userrow["currenttp"] < $townrow["travelpoints"]) { 
            display("<center><h3 class=\"title\">Welcome to the Gates of ".$townrow["name"]."</h3></center><blockquote><center>You DO NOT have enough TPs to travel there, but here is a painting of what you are missing!<br />Please go back and try again when you get more TP. <font color=\"#D40000\"> ".$townrow["travelpoints"]." TPs Required for instant travel to ".$townrow["name"].".</font></blockquote></center>
<center><a href=\"index.php?do=towninf\"><img src=\"images/background/gate/".$townrow["name"].".jpg\" width=\"800\" height=\"800\" alt=\"Town Gates\" border=\"0\"></a></center>", "Travel To"); die(); 
        }
        $mapped = explode(",",$userrow["towns"]);
        if (!in_array($id, $mapped)) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
    }
    
    if (($userrow["latitude"] == $townrow["latitude"]) && ($userrow["longitude"] == $townrow["longitude"])) { display("<center><h3 class=\"title\">Welcome to the Gates of ".$townrow["name"]."</h3></center><center>
<a href=\"index.php?do=towninf\"><img src=\"images/background/gate/".$townrow["name"].".jpg\" width=\"800\" height=\"800\" alt=\"Town Gates\" border=\"0\"></a></center><div align=\"center\"><blockquote>You are already in this town. <a href=\"index.php\" class=\"myButton2\">Click here</a> to return to the main town screen.</blockquote></div>", "Travel To"); die(); }
    
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
    
    $page = "<center><h3 class=\"title\">Welcome to the Gates of ".$townrow["name"]."</h3></center><center>
<a href=\"index.php?do=towninf\"><img src=\"images/background/gate/".$townrow["name"].".jpg\" width=\"800\" height=\"800\" alt=\"Town Gates\" border=\"0\"></a></center>
.";
    display($page, "Travel To");
    }
    
	
	
	
	
function skills() {
 global $userrow;
 	if ($userrow["skills"] == 0) { 

	$page .= "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Skill Center - Points</h3></center></td></tr></table>";
 	$page .= "<div align=center><center><table width='55%'><tr><td>";
 	$page .= "<center><h4 class='questback'><span style=\"color: #92E4FF;\">You <b>DO NOT</b> have any Skill Points left!</span></h4></td></tr></table>";

 }	
 		if (isset($_POST["submit"])) {
                $choice = $_POST['choice'];
  		$amount = $_POST['amount'];
 			if ($amount > $userrow["skills"]) { $page .= "<center><table width='55%' align='center'><tr><td><center><h4 class='questback'><b>You <b>DO NOT</b> have that many Skill Points!</b></h4></center></td></tr></table><br /></center>"; 
			} elseif ($amount == 0) { $page .= "<div align='center'><table width='55%' align='center'><tr><td><center><h4 class='questback'><b>Enter an amount higher than 0!</b></h4></center></td></tr></table><br /></div>"; 
                        } elseif (!is_numeric($amount)) { $page .= "<div align='center'><table width='55%' align='center'><tr><td><center><h4 class='questback'>Enter an Amount!</h4></center></td></tr></table><br /></div>";
                  	} else {
				doquery("UPDATE {{table}} SET $choice=$choice+$amount, skills=skills-$amount WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
 			$page = "<br><br /><div align=\"center\"><b>You have successfully spend Skill Points!</b></div><br /><br />";
 			}
		}
	$page .= "<center><div align=center><table background='images/background/city/skillcenter.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><center><table width='55%'><tr><td><h4 class='questback'>
	<form action=\"index.php?do=skills\" method=\"post\">
	Skill points: Every time you raise a level, you get Skill Points. You can spend them here.
	<br /><br />
	You currently have&nbsp; &nbsp; <span style=\"color: #92E4FF;\"><b>".$userrow["skills"]." </b></span>&nbsp; &nbsp; Skill Points.<br />How many skill points do you want to spend? (+1 for every skill point). Please choose an attribute:<br />
	<br /><div align=\"center\">
	
<div style=\"text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;\"><center><table width=\"50%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\"><tr>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"strength\" CHECKED>Strength</td>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"dexterity\" >Dexterity</td>
</tr><tr>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"attackpower\">Attackpower</td>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"defensepower\">Defensepower</td>
</tr><tr>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxhp\" >Hit Points</td>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxmp\" >Magic Points</td>
</tr><tr>
<td><INPUT TYPE=\"radio\" NAME=\"choice\" VALUE=\"maxtp\" >Travel Points</td>
<td><br /></td>
</tr></table><br /><br />
	Amount: <INPUT TYPE=\"text\" NAME=\"amount\" SIZE=\"3\" MAXLENGTH=\"3\">
	<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Spend Skill Points\" class=\"myButton2\">
	</form></h4></center></div></div>
	\n<br />\n<center><br /><br /><a href=index.php class=myButton2>Town Square</a></center></td></tr></table></td></tr></table><br />";	
		 display($page, "Skill points");
		}
		
		

		


function topten() { // Top 10 list, based on user Experience
    $page = "
	<center><h3 class=\"title\">Top 10 List - Experience</h3></center><br /><br /><blockquote><blockquote>The Top 10 list shows<br> the rank of the highest ranking players in the game. Click a <br>Character Name to view the stats for that character.\n<br /><br />\n";
    $page .= "<table width=\"80%\">";
    $topquery = doquery("SELECT * FROM dk_users ORDER BY experience DESC LIMIT 10", "users");
	$rank = 1;
    while ($toprow = mysql_fetch_array($topquery)) { 
        
	$page .= "<tr><td width=\"10%\">$rank</td>
			<td width=\"50\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td>
			<td width=\"20%\">Level: ".$toprow["level"]."</td>
			<td width=\"20%\">Exp: ".number_format($toprow["experience"])."</td></tr>\n";

        $rank++;
    }
    $page .= "</table>\n<br /><br />\n";
    $page .= "<center>When you're finished, you may return to the<br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square.</a></center><br /><br /></blockquote></blockquote>";
    display($page, "Top 10 Users");
    }
	



function toprich() { // Top 10 Richest and Top Bank Members

$page = "<center><h3 class=\"title\">Top 10 Richest - Top Bank Members</h3></center><br /><br /><blockquote><blockquote>The Top 10 Rich List shows the richest players in the game and the richest bankers in the game. Click a Character Name to view the stats for that character.\n<br /><br />\n";
$page .= "<center>Rich:</center>\n<br />\n";
$page .= "<table width=\"80%\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 10", "users");
$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\">$rank</td><td width=\"30\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td><td width=\"20%\">Gold: ".number_format($toprow["gold"])."</td></tr>\n";
        $rank++;
    }

$page .= "<br /><br /></table></blockquote></blockquote>\n";

$page .= "<center><h3 class=\"title\">Bank</h3></center><br /><br /><blockquote><blockquote><table width=\"80%\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  bank  DESC LIMIT 10", "users");
$page .= "\n<br />\n<center>Bank:</center>\n<br />\n";

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\">$rank</td><td width=\"30\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td><td width=\"20%\">Bank: ".number_format($toprow["bank"])."</td></tr>\n";
        $rank++;
    }
    $page .= "</table>\n<br /><br />\n";
    $page .= "<center><a href=index.php class=myButton2>Town Square.</a></blockquote></blockquote></center>";
    display($page, "Top Bank Members");
}



//  START OF THE VIEW GRAVEYARD FUNCTION


function viewgraveyard () 
{ // Character Graveyard.

global $userrow, $controlrow, $gravesrow, $numqueries, $townsrow;

$page = "<table width=100%><tr><td class=title align=center>Graveyard</td></tr></table><br>"; 
$page .= "<table width=800 height=800 background=images/background/city/deadyard.jpg align=center><tr><td>";
$page .= "<br><br><br><br><center><font color=\"#FFFFFF\"><b>Here lies all the deceased citizens of the realm, may they rest in peace.</b></font></center><br>";
$page .= "<br><br><center><table width=75% align=center><tr><td width=5%><font color=\"#FFFFFF\">ID</td><td width=25%><font color=\"#FFFFFF\">Char Name</font></td><td width=35%><font color=\"#FFFFFF\">Date Of Birth</font></td><td width=35%><font color=\"#FFFFFF\">Date Of Death</font></center>";
$page .= " ";
$page .= " ";

$graveyardquery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 100", "graveyard");

$rank = 1;
while ($gravesrow = mysql_fetch_array($graveyardquery)) 
{ 

$page .= "<tr><td width=5%><font color=\"#FFFFFF\">".number_format($gravesrow["id"])."</font></td><td width=25%><a href=\"index.php?do=onlinechar:".$gravesrow["id"]."\"><font color=\"#FFFFFF\"><b>".$gravesrow["charname"]."</b></font></a></td><td width=35%><font color=\"#FFFFFF\">".$gravesrow["birthdate"]." </font></td><td width=35%><font color=\"#FFFFFF\">".$gravesrow["deathdate"]."</font></td></tr></table><br><br><br><br><div align=center><a href=\"index.php\" class=\"myButton2\">Town Square</a></td></tr></table></div><br><br>";
$rank++;
}

display($page, "Graveyard");
}

//  END OF THE VIEW GRAVEYARD FUNCTION

?>