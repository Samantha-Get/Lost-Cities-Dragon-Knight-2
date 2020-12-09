<?php  // quests.php controls handling of all advanced quests.

// Copy, paste and change the whole quest function to create more, add rooms what ever.

// THIS STARTS QUEST 1 STONE BUILDING
FUNCTION quest1() {
global $userrow, $numqueries;

if (isset($_POST['building'])) {
 
if (isset($_POST['building'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Main Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-MainRoom.png' align='center' width='755' height='753' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have entered a Large Room, likely the Main Room of the building. There a huge round table in the middle of the room. That table Has some wooden chairs around it and a recently eaten meal.<br /><br />";
$page .= "There are smaller tables along the walls and a fireplace in one of its corners. This house seems to belong to someone that is not at home at the moment. There is nothing of interest to you in this room.<br /><br />";
$page .= "You made a decision to explore the rest of the house and hope the owner will not return anytime soon. There are Four Doors, one on the East Wall, and others on the West Wall and North Walls. On the South Wall the Door Leading out of the Stone Building. which one do you wish to try?<br /><br />";
$page .= "You check the East Door and it is locked, do you wish to smash open the door and enter the room? The Door on the North Wall is Open, do you enter the room? You check the West Door and it is unlocked, do you want to open the door and enter?</h4><br /><br /><div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Enter East Door' name=room1 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest1 method=post><input type=submit value='Enter North Door' name=room4 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest1 method=post><input type=submit value='Enter West Door' name=room3 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=move method=post><input type=submit value='Leave Building' name=move class=myButton2></form></div><br /><br /></td></tr></table></div></td></tr></table></div>";
display($page, "Stone Building");      
} 

}

      if (isset($_POST['room1'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Bedroom</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-BedRoom.png' align='center' width='755' height='753' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>This is obviously a bedroom. A big poster Bed is set against the South Wall. Small Tables sit on either side of the Bed and a Foot Locker at its end. You open the Foot Locker first and find some old blankets and pillows, nothing you need or want right now. Next you check the table drawers, finding old socks, bras and underwear, nothing you would wear in public.<br /><br />";
$page .= "There are two Door leading out of the room. One Leading to the Main Room on the West Wall. Another Door on the North Wall, the Door is unlocked, do you want to proceed? Or do you want to go back to the Main Room?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Enter North Door' name=room2 class=myButton2></form><br />";
$page .= "<br /><form action=index.php?do=quest1 method=post><input type=submit value='Leave to Main Room' name=building class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); }

if (isset($_POST['room2'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Lab</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-Lab.png' align='center' width='753' height='753' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have walked into a small Lab full of test tubes, coils, vials, bottles, pouches, bags and barrels. You search around and find some old pouches, bags and other items. But searching brings nothing of value or interest to you. Do you want to leave the room and return to the Bedroom?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Back to Bedroom' name=room1 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room3'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Cooking Area</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-CookingArea.png' align='center' width='754' height='750' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>You have walked into a small Cooking Area area. With a stove, cooking table and some storage shelves. After searching the room in detail, you realize there is nothing of value in this room.<br /><br />There is a Door on the East Wall leading to the Main room, that you just came through.</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Back to Main Room' name=building class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room4'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Long Hallway</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/hall-LongHallway.png' align='center' width='388' height='770' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='340'><tr><td><h4 class='questback'>";
$page .= "Leaving the Main Room you Enter a very long and wide Hallway with a stone face on all Walls. There are only Two Doors in the Hallway, One leading back to the Main Room and the other down the hall on the North Wall.<br /><br />";
$page .= "Want do you want to do? Go back to the Main Room or Enter the Door on the North Wall?</h4><br /><br /><div align='center'><form action=index.php?do=quest1 method=post><input type=submit value='Enter Northern Door' name=room5 class=myButton2></form><br /><form action=index.php?do=quest1 method=post><input type=submit value='Back to Main Room' name=building class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room5'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Library</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-Library.png' align='center' width='756' height='752' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You are in a Library with books covering most tables and shelves. There are several small tables in the room, most likely used to read books from the Huge Library. There are Three Doors, one on the East Wall, and others on the West and Southern Walls. On the South Wall the Door Leads out of library back to the Long Hallway. which one do you wish to try?<br /><br />";
$page .= "You check the Western Door and it is unlocked, do you wish enter this room? The Door on the Eastern Wall is Open, and seems to enter a long Hallway. Do you wish to enter the Eastern Hallway? Do you wish to return to the Long Hallway, from which you entered?</h4><br /><br /><div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Enter Western Door' name=room8 class=myButton2></form><br />";
$page .= "<form action=index.php?do=quest1 method=post><input type=submit value='Enter Eastern Hallway' name=room6 class=myButton2></form><br />";
$page .= "<form action=index.php?do=quest1 method=post><input type=submit value='Back to Long Hallway' name=room4  class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room6'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Eastern Hallway</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/hall-EasternHallway.png' align='center' width='770' height='388' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "Leaving the Library you Enter a another Long Hallway, which we will call the Eastern Hallway. This Hallway stretches for about 100 feet or more and like the other hallway 20 feet wide with a stone face on all Walls. There are Two Doors, one on the Eastern end of the Hallway leads back to the Library and one at the end of the Hall on the Eastern Wall. Which one do you wish to try?<br /><br />";
$page .= "Do you want to use the Door leading back to the Library? Or The Door on the Eastern Wall seem to be open, do you want to open the door and enter?</h4><br /><br /><div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Back to Library' name=room5 class=myButton2></form><br />";
$page .= "<form action=index.php?do=quest1 method=post><input type=submit value='Enter Eastern Door' name=room7 class=myButton2></form></div><br /><br /></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room7'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Meeting Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-MeetingRoom.png' align='center' width='755' height='750' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "Leaving the Eastern Hallway you Enter a large room, which a Large Long Table with seating for Ten. There is nothing else in the room. There is only one Door leading out of the Room, the one you came through. Do you wish to Return to the Eastern Hallway?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Back to Eastern Hallway' name=room6 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room8'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Study</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-Study.png' align='center' width='754' height='752' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "From the Eastern Hallway you enter the Study Room. A small room with a Wooden Desk in the middle and some Book Shelves Behind the desk. You search through some papers and the desk drawers and find nothing of interest. There are two Doors in the room. One leading back to the Library on the Eastern Wall and the other on the Western Wall. Which Door do you wish to use?<br /><br />";
$page .= "You check the Western Door and it is unlocked, do you want to open the door and enter?</h4><br /><br />";
$page .= "<div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Enter Western Door' name=room9 class=myButton2></form><br /><form action=index.php?do=quest1 method=post><input type=submit value='Back to Library' name=room5 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 

if (isset($_POST['room9'])) { 
$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Cellar</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-Cellarr.png' align='center' width='755' height='751' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><div align=center><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "The Door from the Study enters The Cellar. This is a small room, used to storage vegetables and other perishable goods. You search the room, eating some food as you search. Your belly may be full, but you find nothing of value. There are two Doors in the room. One leading back to the Study on the Eastern Wall one on the Western Wall. Which Door do you wish to use?<br /><br />";
$page .= "The Eastern Door is open, and opens back to the The Study. The Western Door is a small door with a Latch on it and it is unlatched and unlocked, do you want to crawl through this small door and enter the Room?</h4><br /><br /><div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Back to Study' name=room8 class=myButton2></form><br />";
$page .= "<div align=center><form action=index.php?do=quest1 method=post><input type=submit value='Enter Western Door' name=room10 class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 


if (isset($_POST['room10'])) { 
$newexp = rand(5,25);// Sets the Experience Points gained when Quest Completed
$newgold = rand(5,25); // Sets the Gold Coins gained when Quest Completed
$newsilver = rand(7,10); // Sets the Silver Coins gained when Quest Completed
$newcopper = rand(3,10); // Sets the Copper Coins gained when Quest Completed
$newgoldbonus = rand(1,2); // Sets the Gold Bonus gained when Quest Completed
$newexpbonus = rand(1,2); // Sets the Experience Bonus gained when Quest Completed

doquery("UPDATE {{table}} SET strength=strength+'$newstrength', dexterity=dexterity+'$newdexterity', attackpower=attackpower+'$newattackpower', defensepower=defensepower+'$newdefensepower', maxhp=maxhp+'$newmaxhp', maxmp=maxmp+'$newmaxmp', maxtp=maxtp+'$newmaxtp', goldbonus=goldbonus+'$newgoldbonus', expbonus=expbonus+'$newexpbonus', gold=gold+'$newgold', silver=silver+'$newsilver', copper=copper+'$newcopper', experience=experience+'$newexp' WHERE id='".$userrow["id"]."' ", "users");

$page = "<table width=100%><tr><td class=title align=center>Stone Building - The Storage Room</td></tr></table>";
$page .= "<br /><br /><div align=center><table background='images/background/quests/floorplan-StorageRoom.png' align='center' width='754' height='752' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
$page .= "You enter what looks like a common storage room. Old furniture and personal items are stacked from floor to ceiling, wall to wall. With a huge stack of debris, wood and dirt piled against the Western Wall. Suddenly the door that leads back to the Cellar slams shut behind you. You hear the Latch drop with a bang. You try to open the door and fail. Its just to strong of a door to break through. You are trapped in the Storage Room, surely you will die in a few days.<br /><br />";
$page .= "<b>Wait!</b> You see a gleam of light shining through the stacks of furniture and wooden boxes. You spend a great amount of time and effort to move them. To your surprise you finally uncover a wooden staircase leading upwards to a door. Do you wish to climb the stairs and use the Door? For discovering the Hidden Door you gain the following enhancements to your character:<br /><br /><div align=center>
<b><font color=#FFF934>$newexp Experience Points</b>,
<b>$newgold Gold</b>, 
<b>$newsilver Silver</b> and, 
<b>$newcopper Copper Coins</b>.<br />
<b>$newgoldbonus Gold Bonus Points</b>,
<b>$newexpbonus Experience Bonus Points</b>.</font></h4></div><br /><br />

<div align=center><form action=index.php?do=move method=post><input type=submit value='Leave Building' name=move class=myButton2></form></div></td></tr></table></td></tr></table></div>";
display($page, "Stone Building"); 
} 


}
// THIS ENDS QUEST 1 STONE BUILDING

?>