<?php  // quests.php controls handling of all advanced quests.

// Copy, paste and change the whole quest function to create more, add rooms what ever.

// THIS STARTS QUEST 5 THE WOODS
FUNCTION quest5() {
global $userrow, $numqueries;

if (isset($_POST['building'])) {
 
if (isset($_POST['building'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Entry</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Woods-Room-0.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>Having entering the Castle you find northing and nobody. Not even a cat or cobwebs, Like the place has never been lived in or use since it was built.</h4><br /><br />";

$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='North' name=room10 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='East' name=room2 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='West' name=room00 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave the Castle' name=move class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Woods");  
} 

}

if (isset($_POST['room1'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Second Floor - Front Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-1.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>Your Climb to the second floor revels, Some Furniture scatted around the room. This seems like some sort of a waiting Room. After searching the room you find not much of interest here.<br /><br />You do see another door leading to the West. Do you want to enter the Back Room or Go Down the Stairs?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='Enter Back Room' name=room2 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest5 method=post><input type=submit value='Go Down the Stairs' name=building class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); }


if (isset($_POST['room2'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Second Floor - Back Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-2.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You find yourself in large Room with many beds. You search each Bedroom partition and find nothing but empty beds.<br /><br />Except for the last bed you find a beautiful women laying on it. The woman beckons you closer. Do you wish to go closer to the women or leave back to the Front Room.</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='Back to Front Room' name=room1 class=myButton2></form>";
$page .= "<br /><form action=index.php?do=quest5 method=post><input type=submit value='Move Towards Woman' name=room3 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); }


if (isset($_POST['room3'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Women</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-3.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>The Beautiful Women invites you to come over to talk for a while.<br /><br />Do you accept the strange womans invitation? or Do you take the door back to the Front Room?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='Yes - Accept' name=room4 class=myButton2></form><br /><form action=index.php?do=quest5 method=post><input type=submit value='No - Return to Front Room' name=room1 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); 
} 

if (isset($_POST['room4'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Accepted Invitation</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-4.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have accepted the womans invitation and slowly move towards this beautiful wonder of this world. Suddenly the woman jumps out of bed and rushes you with a bottle in here hand.<br /><br />She strikes you over the head and you pass out!</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='An Hour Passes' name=room5 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); 
} 

if (isset($_POST['room5'])) { 
$newsilver = rand(25,100); // Sets the Silver Coins gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity-'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold-'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");

$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - You Awaken</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-5.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You very slowly wake up with a hurting and spinning head and a bump the size of a small apple on the back of your head.<br /><br />";
$page .= "You look around the Room and find no trace of the woman or the <b><font color=#FFF934>$newsilver Silver Coins</font></b>, She stole from you.<br /><br />You been a fool for one of the oldest tricks in the history of love. Well, Pick yourself up and head back to the Front Room.</h4><br /><br /><div align='center'><form action=index.php?do=quest5 method=post><input type=submit value='Return to Front Room' name=room6 class=myButton2></form><br /></div></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); 
} 

if (isset($_POST['room6'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Second Floor - Front Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-1.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>Your back in the Front Room, your head still hurts and your money purse is a little lighter.<br /><br />You decide its best to leave as soon as possible and go back down the Stairs.</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='Go Down the Stairs' name=room7 class=myButton2></form></div></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); }


if (isset($_POST['room7'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods - Entrance Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/House-Room-6.png' align='center' width='747' height='750' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "Your back in the Entrance Room, Do you want to repeat your Explorer Experience or Leave the House to clear your head? Have you gain any wisdom yet?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest5 method=post><input type=submit value='Up the Stairway' name=room1 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave the House' name=move class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Woods"); 
} 



}
// THIS ENDS QUEST 5 THE WOODS

?>