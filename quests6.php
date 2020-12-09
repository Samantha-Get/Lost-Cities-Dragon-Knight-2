<?php  // quests.php controls handling of all advanced quests.

// Copy, paste and change the whole quest function to create more, add rooms what ever.

// THIS STARTS QUEST 6 THE ADVENTURES INN
FUNCTION quest6() {
global $userrow, $numqueries;

if (isset($_POST['building'])) {
 
if (isset($_POST['building'])) { 
$newgold = rand(50,75); // Sets the Gold Coins gained when Quest Completed
$newsilver = rand(20,45); // Sets the Silver Coins gained when Quest Completed
$newcopper = rand(10,35); // Sets the Copper Coins gained when Quest Completed
$newexp = rand(500,800);// Sets the Experience Points gained when Quest Completed
$newmaxhp = rand(50,100); // Raises the Max Hit Points gained when Quest Completed
$newmaxmp = rand(50,100); // Raises the Max Magic Points gained when Quest Completed
$newmaxtp = rand(50,100); // Raises the Max Travel Points gained when Quest Completed
$l = rand(-250,250);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-250,250); //Random Longitude from X to X you will be Transported to. -X for West X for East

doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity+'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold-'$newgold', silver=silver-'$newsilver', copper=copper-'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");
 
$page = "<table width=100%><tr><td class=title align=center>The Adventures Inn</td></tr></table>";
$page .= "<br /><div align=center><table background='images/background/quests/quest-6-room.png' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><div align=center><table width='65%'><tr><td>";

$page .= "<br /><div align=center><h4 class='questback'><font color=#96DEFF>".$userrow["charname"]."</font> you were at <font color=#96DEFF>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</font> - Check your Map your New Locations is <font color=#96DEFF>Latitude $l Longitude $lo</font>.<br />You have entered The Adventure Inn. The Inn is full of Adventures and Visitors that you have ever seen in any of your travels. Truly Amazing.</h4><br />";

$page .= "<div align=center><h4 class='questback'>The smells of my different food whiff through the whole room. Making your stomach growl for something to eat. You find a place to sit and ask the Inn Maid to order a huge ham shank and milled bread. Having your fill of one of the best meals you have ever had.</h4><br /><br />";

$page .= "<div align=center><h4 class='questback'>You pay <font color=#96DEFF><b>- $newsilver</font> Silver Coins</b> for the food you have just wolfed down and leave <font color=#96DEFF><b>- $newcopper</font> Copper Coins</b> as a Tip for the Inn Maid.</h4><br />";

$page .= "<div align=center><h4 class='questback'>Having your stomach full and your spirits raised you feel tired and ask for a room for the night with a pleasure person. The Inn asks for <font color=#96DEFF><b>- $newgold</font> Gold Coins</b> for both the Room and the Pleasure.</h4><br />";

$page .= "<div align=center><h4 class='questback'>After your very pleasurable and deep sleep, the best you have had in months.</h4><br />";

$page .= "<div align=center><h4 class='questback'>Felling refreshed you Gain: <b><font color=#96DEFF>$newexp</font> Experience Points</b>, <b><font color=#96DEFF>$newmaxhp</font> Hit Points</b>, <b><font color=#96DEFF>$newmaxmp</font> Magic Points</b> and <b><font color=#96DEFF>$newmaxtp</font> Travel Points</b>.</h4><br />";

$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave The Adventures Inn' name=move class=myButton2></form></div></td></tr></table></td></tr></table></div>";           
display($page, "The Adventures Inn");       
} 

}


if (isset($_POST['room17'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - Treasure Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomThridteen.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You have entered a open cave location. Seems to be worth exploring. Before you get a chance to explore this Cave area, you hear a thunderous sound behind you. Quickly you run then jump to safety around the stone pillar to the south. You alive but sustained some injuries.<br /><br />You search and find Coins of all types, which you will gladly add to your bounty. More importantly you found a letter that tells anyone who finds it to use the ladder to find you freedom. The way back through the Cave Passages is to dangerous to use. The ladder you discovered leads to surface and out of this vast Cave System.<br /><br />";
$page .= "<b>Wait! You Gain:</b> <br /><br /><div align=center>
<b><font color=#96DEFF>$newexp Experience Pts</font></b>, 
<b><font color=#96DEFF>$newgold Gold</font></b>, 
<b><font color=#96DEFF>$newsilver Silver</font></b> and, 
<b><font color=#96DEFF>$newcopper Copper Coins</font></b>.<br />
<b>Plus <font color=#96DEFF>$newgoldbonus Gold Bonus Pts</b>,
<b<font color=#96DEFF>$newexpbonus Experience Bonus Pts</font></font></b><br /><br />and Lost
<b><font color=#96DEFF>- $newdexterity Dexterity</b></font> from your injuries.</h4></div><br /><br />
<div align=center><form action=index.php?do=move method=post><input type=submit value='Climb the Ladder' name=move class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


}
// THIS ENDS QUEST 6 THE ADVENTURES INN

?>