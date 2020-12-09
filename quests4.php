<?php  // quests.php controls handling of all advanced quests.

// Copy, paste and change the whole quest function to create more, add rooms what ever.

// THIS STARTS QUEST 4 THE TOWER CASTLE

FUNCTION quest4() {
global $userrow, $numqueries;

if (isset($_POST['building'])) {
 
if (isset($_POST['building'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Great Round Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-1.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have entered the Tower Castle! You find a Stone spiraling Staircase covering half of the Great Round Room Wall.<br /><br />In the middle of the room there is a hexagonal Table with Six chairs around it and some plates on it. Candles are burning as are the Torches on the Walls.<br /><br />A little strange there is no one around with such a clean and well stocked room. Do you wish to explore the Tower Castle more or Return to Adventuring?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room1 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave the Tower' name=move class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle");  
} 

}

if (isset($_POST['room1'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Weapons Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-2.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>This seems to be a well stocked weapons room. Surely for use of the defenders of this Tower. Its a great selection of weapons for any Castle Defender. But your weapons are better for your use and better crafted by some of the finest metal workers around.<br /><br />This room is empty of guards. Do you climb the Stair well Up or Down?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room2 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=building class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
}


if (isset($_POST['room2'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Lower Bunk Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-3.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You are on the Third Floor find yourself in a Bunk Room. Quarters for the Defenders of the Tower? The many beds do not seem they have been slept in recently. No sign of any Guards. Do you wish to go Down the Stairs of Up the Stairs?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room3 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room1 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
}


if (isset($_POST['room3'])) { 
$newattackpower = rand(2,3); // Sets the Attack Power Points gained when Quest Completed
$newdefensepower = rand(2,3); // Sets the Defense Power Points gained when Quest Completed
$newmaxhp = rand(5,10); // Raises the Max Hit Points gained when Quest Completed
$newstrength = rand(1,3); // Sets the Strength Points gained when Quest Completed
$newdexterity = rand(1,3); // Sets the Dexterity Points gained when Quest Completed
$newgold = rand(5,100); // Sets the Gold Coins gained when Quest Completed
$newexp = rand(5,100);// Sets the Experience Points gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength-'$newstrength', dexterity=dexterity-'$newdexterity', attackpower=attackpower-'$newattackpower', defensepower=defensepower-'$newdefensepower', maxhp=maxhp-'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");
 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Upper Bunk Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-4.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>A Upper Bunk Room. But Wait? There are two defender in the room who are alerted to your presence.<br /><br />They come at you from different directions with weapons at the ready. You strike first, killing the near by attacker. You take some damage [<font color=#FFF934><b>- $newattackpower Attack Power Pts</b></font>, <font color=#FFF934><b>- $newdefensepower Defense Power Pts</b></font> and <font color=#FFF934><b>- $newmaxhp Hit Pts</b></font>], but are still able to fight.<br /><br />The second guard charges at you and lunges with his Weapon, you dodge the main attack, but he turns around and slices you arm. You make quick order of it and dispatch the guard with one hit. Your injury results in lose of [<font color=#FFF934><b>- $newstrength Strength Pts</b></font>, <font color=#FFF934><b>- $newdexterity Dexterity Pts</b></font> and <font color=#FFF934><b>- $newmaxhp Hit Pts</b></font>]<br /><br />For your fighting ability you Gain: <font color=#FFF934><b>$newgold Gold Coins</b></font> and <font color=#FFF934><b>$newexp Experience Pts</b></font>]</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room4 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room8 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
} 

if (isset($_POST['room4'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Weapons and Storage</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-5.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have climbed many Stone Steps and come to what appears to be a Weapons and General Storage Room. A whole lot of weapons to choice from, but again nothing that matches you current Defensive or Offensive Weapons. So its time to move on!</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room5 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room7 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
} 

if (isset($_POST['room5'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Castle Lords Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-7.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "This is indeed the Room for the Lord of this Tower Castle. As with the rest of this Tower no one is around. This has to be one of the nicest rooms you have ever been. No time to rest and admire, time to move on.</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room6 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room4 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
} 

if (isset($_POST['room6'])) { 
$newexp = rand(50,175);// Sets the Experience Points gained when Quest Completed
$newgold = rand(5,125); // Sets the Gold Coins gained when Quest Completed
$newsilver = rand(7,55); // Sets the Silver Coins gained when Quest Completed
$newcopper = rand(3,40); // Sets the Copper Coins gained when Quest Completed
$newgoldbonus = rand(1,2); // Sets the Gold Bonus gained when Quest Completed
$newexpbonus = rand(1,2); // Sets the Experience Bonus gained when Quest Completed
$newmaxhp = rand(8,10); // Raises the Max Hit Points gained when Quest Completed
$newmaxmp = rand(3,8); // Raises the Max Magic Points gained when Quest Completed
$newmaxtp = rand(3,8); // Raises the Max Travel Points gained when Quest Completed
$newstrength = rand(3,5); // Sets the Strength Points gained when Quest Completed
$newdexterity = rand(3,5); // Sets the Dexterity Points gained when Quest Completed
$newattackpower = rand(3,5); // Sets the Attack Power Points gained when Quest Completed
$newdefensepower = rand(3,5); // Sets the Defense Power Points gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity+'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");

$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Rescue the Princess</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-8.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You hear a loud rumble of rocks falling. The crumbling rocks cover the Stairs that is Block going Up or Down the Stairwall.<br /><br />A quick look around the room you spot a young Princess sleeping on her Bed. The room around you is surround with Royal Furniture of all types, quite the fitting room for a Royal young Lady.<br /><br />There is a large Globe type object in the middle of the Room. Glazing into it seems to be a Star Field or Some Magical Item.<br /><br />You find a note on the Bed that Reads: <i>Thank you great warrior for risking you life to rescue the Princess of Athens. To wake the Princess you must kiss her softly on the lips. This room was purposely designed to trap anyone who tries to rescue here. The Only way to save the Princess and yourself is to Jump into the Transport Circle and be transported out of the Tower Castle.</i></h4><br /><br />
<div align=center><h4 class='questback'>
<b><font color=#FFF934>$newgold</font> Gold Coins</b>, 
<b><font color=#FFF934>$newsilver</font> Silver Coins</b>, 
<b><font color=#FFF934>$newcopper</font> Copper Coins</b>.<br />
<b><font color=#FFF934><b>$newexp</font> Experience Pts</b>, 
<b><font color=#FFF934>$newgoldbonus</font> Gold Bonus Pts</b>,  
<b><font color=#FFF934>$newexpbonus</font> Experience Bonus Pts</b>.<br />
<b><font color=#FFF934>$newmaxhp</font> Max. HPs Pts</b>,  
<b><font color=#FFF934>$newmaxmp</font> Max. MPs Pts</b>, 
<b><font color=#FFF934>$newmaxtp</font> Max. TPs Pts</b>, 
<b><font color=#FFF934>$newstrength</font> Strength Pts</b>.<br />
<b><font color=#FFF934>$newdexterity</font> Dexterity Pts</b>, 
<b><font color=#FFF934>$newattackpower</font> Attack Power Pts</b> and
<b><font color=#FFF934>$newdefensepower</font> Defense Power Pts</b>.</h4></div><br /><br />";
$page .= "<div align=center><form action=index.php?do=move method=post><input type=submit value='Kiss and Jump' name=move class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
} 






if (isset($_POST['room7'])) {  
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Upper Bunk Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-6.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>The Upper Bunk Room again. Just laying around are the two Castle Defenders [and allot <font color=#FF0000><b>Blood!</b></font>] that attacked you earlier. There is nothing more of interest to you in this Room.<br /><br />Go up the Stairways or Down?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room4 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room8 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
} 

if (isset($_POST['room8'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Lower Bunk Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-3.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You are on the Third Floor find yourself in a Bunk Room. Quarters for the Defenders of the Tower? The many beds do not seem they have been slept in recently. No sign of any Guards. Do you wish to go Down the Stairs of Up the Stairs?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room7 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room9 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
}

if (isset($_POST['room9'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Weapons Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-2.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>This seems to be a well stocked weapons room. Surely for use of the defenders of this Tower. Its a great selection of weapons for any Castle Defender. But your weapons are better for your use and better crafted by some of the finest metal workers around.<br /><br />This room is empty of guards. Do you climb the Stair well Up or Down?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room8 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest4 method=post><input type=submit value='Down the Stairway' name=room10 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle"); 
}

if (isset($_POST['room10'])) { 
$page = "<table width=100%><tr><td class=title align=center>The Tower Castle - Great Round Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/Tower-Room-1.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have entered the Tower Castle! You find a Stone spiraling Staircase covering half of the Great Round Room Wall.<br /><br />In the middle of the room there is a hexagonal Table with Six chairs around it and some plates on it. Candles are burning as are the Torches on the Walls.<br /><br />A little strange there is no one around with such a clean and well stocked room. Do you wish to explore the Tower Castle more or Return to Adventuring?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest4 method=post><input type=submit value='Up the Stairway' name=room9 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave the Tower' name=move class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "The Tower Castle");  
} 


}
// THIS ENDS QUEST 4 THE TOWER CASTLE

?>