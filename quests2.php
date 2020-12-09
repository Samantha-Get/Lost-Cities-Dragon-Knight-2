<?php  // quests.php controls handling of all advanced quests.

// Copy, paste and change the whole quest function to create more, add rooms what ever.

// THIS STARTS QUEST 2 THE CAVE
FUNCTION quest2() {
global $userrow, $numqueries;

if (isset($_POST['building'])) {
 
if (isset($_POST['building'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - Cave Entrance Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomOne.png' align='center' width='797' height='797' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have entered the Cave, its opened into a larger area. The Cave passage leads Northeast and Northwest. You seem nothing of interest, but the Cave has been used recently, very recently. There are torches blazing away and lighting the area with light.<br /><br />";
$page .= "Both of the Northeastern and Northwestern Passages seem similar. Which path do you want to take?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Enter Northwest Passage' name=room1 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest2 method=post><input type=submit value='Enter Northeast Passage' name=room8 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave Cave' name=move class=myButton2></form></div><br /><br /></td></tr></table></div></td></tr></table></div>";
display($page, "Cave");      
} 

}

if (isset($_POST['room1'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Northwestern Passage</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomSeventeen.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>Not much of interest here. The Cave passage leads to the North. Another to the East. With Passage will you take, The Northern Passage or the Eastern?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room2 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest2 method=post><input type=submit value='Eastern Passage' name=building class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Cave"); }


if (isset($_POST['room2'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - Slime Pool Passage</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomSixteen.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "The Cave passage winds through the Cave System. You come upon a quite pond of slime and old water, not drinkable so you must continue your journey. Do you wish to the Northern or Southern Passage?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room3 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room1 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Cave"); }


if (isset($_POST['room3'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - Dog Leg East</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomFirthteen.png' align='center' width='799' height='796' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>Interesting passage it goes north for a while then jogs to the East. Which leads further into the Cave system. Proceed to the Eastern Passage or Southern Passage?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Eastern Passage' name=room4 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room2 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 

if (isset($_POST['room4'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Twisting Passage</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomFourteen.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You are in a cave tunnel twisting through the mountain. There is a large are in front of you that contains a huge stone pillar in the middle. A detailed search of this are reveals nothing.<br /><br />You can go back to the Western Passage or Proceed to the Eastern, Where will you exploring take you?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Western Passage' name=room3 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='Eastern Passage' name=room5 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 

if (isset($_POST['room5'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Hub</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomFour.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "This seems to be the Hub of the Cave system, With branches leading North and South, and One leading back to the Twisting Passage.<br /><br />";
$page .= "Want do you want to do? Proceed West to The Twisting Passage, South to The Coffin Passage or North to The Passage of Many Turns?</h4><br /><br /><div align='center'><form action=index.php?do=quest2 method=post><input type=submit value='[N] The Passage of Many Turns' name=room9 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='[S] The Coffin Passage' name=room7 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='[W] The Twisting Passage' name=room4 class=myButton2></form><br /></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room6'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - NOT USED</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomFour.png' align='center' width='747' height='750' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "Leaving the Eastern Hallway you Enter a large room, which a Large Long Table with seating for Ten. There is nothing else in the room. There is only one Door leading out of the Room, the one you came through. Do you wish to Return to the Eastern Hallway?</h4><br /><br />";
$page .= "<div align='center'><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room7 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room3 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='Back to Twisting Passage' name=room4 class=myButton2></form><br /></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room7'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Coffin Passage</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomThree.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You enter part of the cave system that contain two large areas. You exploring the smaller of the two and find nothing, exploring the large area you find a Coffin, with skeleton foot prints leading away from the coffin. Strange indeed!<br /><br />There is a solid steel door on the Eastern Wall, but it seems locked from the other side. The Door is to strong for you to break through.<br /><br />Proceed back to the Hub or Continue South?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room8 class=myButton2></form><br />";
$page .= "<form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room5 class=myButton2></form></div></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 

if (isset($_POST['room8'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Three Dog Legs</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomTwo.png' align='center' width='702' height='704' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "This long passage has three different dog legs. Nothing different here, much like other parts of the Cave. You Must Continue onward. Which way do you desire?</h4><br /><br /><div align=center>";
$page .= "<form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room7 class=myButton2></form><br />";
$page .= "<form action=index.php?do=quest2 method=post><input type=submit value='Western Passage' name=building class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room9'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Passage of Many Turns</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomFive.png' align='center' width='751' height='751' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You enter a long twisting and turning passage, with many interesting features. Sadly nothing of value to you. So you must continue your Journey.<br /><br />";
$page .= "Do you wish to proceed to The Cave Hub or use the Northern Passage?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room10 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='To The Cave Hub' name=room5 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 

if (isset($_POST['room10'])) { 
$newstrength = rand(1,3); // Sets the Strength Points gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength-'$newstrength', dexterity=dexterity+'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users"); 

$page = "<table width=100%><tr><td class=title align=center>Cave - Entrance to Lava Bridge</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomSix.png' align='center' width='752' height='752' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><div align=center><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You enter a Huge Cavern filled with a Lava Pool and a Stone Bridge leading to the opposite Passage. The Stone Bridge is ancient, well beyond recent History. The Bridge is starting to crumble, no doubt from the centuries of Lava and the Heat it must bear. The air in this chamber is burning Hot and strings your lungs.<br /><br />The heat is almost unbearable and its draining you strength bit by bit, making it hard to move and breath. What to do, do you wish to proceed to the other end of the bridge?<br /><br /><div align=center>The Heat snaps your Strength. You Lose <font color=#FFF934><b>- $newstrength Strength</b></font> Points!</h4></div><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room11 class=myButton2></form><br /><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room9 class=myButton2></form><br />";
$page .= "</td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 



if (isset($_POST['room11'])) { 
$newattackpower = rand(1,2); // Sets the Attack Power Points gained when Quest Completed
$newdefensepower = rand(1,2); // Sets the Defense Power Points gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity+'$newdexterity', attackpower=attackpower-'$newattackpower', defensepower=defensepower-'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users"); 

$page = "<table width=100%><tr><td class=title align=center>Cave - The Lava Bridge</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomSeven.png' align='center' width='799' height='794' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><div align=center><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "A massive Cavern filled with boiling Lava spanning the whole Cavern. The Heat from the Lava is breaking down your health. Its is hard to move on any further, but you must or you will surely meet your death here.<br /><br />";
$page .= "Continue to the Northern part of the Bridge or the Southern?<br /><br /><div align=center>From complete exhaustion you are not fully able to weld Offensive Weapons or Defensive items. You Lose <font color=#FFF934><b>- $newattackpower Attack Power</b></font> and
<font color=#FFF934><b>- $newdefensepower Defense Power Points</b></font>.</h4></div><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Proceed North on Bridge' name=room12 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Proceed South on Bridge' name=room10 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room12'])) { 
$newstrength = rand(1,2); // Sets the Strength Points gained when Quest Completed
$newdexterity = rand(1,2); // Sets the Dexterity Points gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity+'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");

$page = "<table width=100%><tr><td class=title align=center>Cave - The Living Area</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomEight.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><div align=center><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You stumble upon a Cave area that seems to be a living area for someone or something. The room is maintained in proper order and seems to have been used no to long ago. This could be the reason all the Cave System Passages have lit torches. You feel very tired from you recent adventures. You lay down for a while.<br /><br />You waken fresh and feel better.<div align=center>You feel great and gain <font color=#FFF934><b>$newstrength Strength</b></font> and 
<font color=#FFF934><b>$newdexterity Dexterity</b></font> from your brief sleep.</div.<br /><br /></h4><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='South to Lava Bridge' name=room11 class=myButton2></form><br />";
$page .= "<form action=index.php?do=quest2 method=post><input type=submit value='East Passage' name=room13 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room13'])) { 
$newgold = rand(25,100); // Sets the Gold Coins gained when Quest Completed

$page = "<table width=100%><tr><td class=title align=center>Cave - Northern Rim of Lava Pool</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomNine.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><div align=center><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You enter an area that seem to be the Northern Rim of a large Lava Pool. It is a little warm in here, about the temperature of the more tropical regions of this world. You find an old broken table. Exploring the small extension to the north reveals a mining cart with a small amount of Gold in it.<br /><br /><div align=center>The Gold from the Mining Cart nets you <font color=#FFF934><b>$newgold Gold Coins.</b></font></div>";
$page .= "You can either go to the Eastern or Southern Passage, what is your choice?</h4><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room14 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Eastern Passage' name=room12 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room14'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - Eastern Rim of Lava Pool</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomTen.png' align='center' width='797' height='793' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You have reached the Eastern Rim of the huge Lava Pool. You can hear and feel the Heat coming off the lava pool. Nothing you can not handle, but maybe its time to move on.<br /><br />";
$page .= "As with most Passage you have only Two Choices here, go through the Northern Passage or the Southern Passage?</h4><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room13 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room15 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room15'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - Southeastern Rim of Lava Pool</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomEleven.png' align='center' width='798' height='793' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "Finally you have found the Southwestern Rim on the Huge Lava Pool. The Heat is strong, but bare able as much as some of the other Passages in this Cave System. Time to move on and find a better Passages.<br /><br />You have your normal choices, either North or South.";
$page .= "</h4><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room14 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room16 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


if (isset($_POST['room16'])) { 
$page = "<table width=100%><tr><td class=title align=center>Cave - The Southern Passage</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomTwelven.png' align='center' width='799' height='797' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "Nothing outstanding about this passage, time to push on.";
$page .= "</h4><br /><br /><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Northern Passage' name=room15 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Southern Passage' name=room17 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 



if (isset($_POST['room17'])) { 
$newexp = rand(5,25);// Sets the Experience Points gained when Quest Completed
$newgold = rand(5,25); // Sets the Gold Coins gained when Quest Completed
$newsilver = rand(7,10); // Sets the Silver Coins gained when Quest Completed
$newcopper = rand(3,10); // Sets the Copper Coins gained when Quest Completed
$newgoldbonus = rand(1,2); // Sets the Gold Bonus gained when Quest Completed
$newexpbonus = rand(1,2); // Sets the Experience Bonus gained when Quest Completed
$newdexterity = rand(1,2); // Sets the Dexterity Points gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity-'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");

$page = "<table width=100%><tr><td class=title align=center>Cave - Treasure Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/cave-RoomThridteen.png' align='center' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You have entered a open cave location. Seems to be worth exploring. Before you get a chance to explore this Cave area, you hear a thunderous sound behind you. Quickly you run then jump to safety around the stone pillar to the south. You alive but sustained some injuries.<br /><br />You search and find Coins of all types, which you will gladly add to your bounty. More importantly you found a letter that tells anyone who finds it to use the ladder to find you freedom. The way back through the Cave Passages is to dangerous to use. The ladder you discovered leads to surface and out of this vast Cave System.<br /><br />";
$page .= "<b>Wait! You Gain:</b> <br /><br /><div align=center>
<b><font color=#FFF934>$newexp Experience Pts</font></b>, 
<b><font color=#FFF934>$newgold Gold</font></b>, 
<b><font color=#FFF934>$newsilver Silver</font></b> and, 
<b><font color=#FFF934>$newcopper Copper Coins</font></b>.<br />
<b>Plus <font color=#FFF934>$newgoldbonus Gold Bonus Pts</b>,
<b<font color=#FFF934>$newexpbonus Experience Bonus Pts</font></font></b><br /><br />and Lost
<b><font color=#FFF934>- $newdexterity Dexterity</b></font> from your injuries.</h4></div><br /><br />

<div align=center><form action=index.php?do=move method=post><input type=submit value='Climb the Ladder' name=move class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Cave"); 
} 


}
// THIS ENDS QUEST 2 THE CAVE

?>