<?php // explore.php :: Handles all map exploring, chances to fight, etc.

function move() {
    
    global $userrow, $controlrow;
    
    if ($userrow["currentaction"] == "Fighting") { header("Location: index.php?do=fight"); die(); }
	if ($userrow["currentaction"] == "Barried") { header("Location: users.php?do=register"); die(); }
    $latitude = $userrow["latitude"];
    $longitude = $userrow["longitude"];
	
	
	if (isset($_POST["northwest_x"])) { $latitude++; $longitude--; if ($latitude > $controlrow["gamesize"]) { $latitude = $controlrow["gamesize"]; } }
	if (isset($_POST["north_x"])) { $latitude++; if ($latitude > $controlrow["gamesize"]) { $latitude = $controlrow["gamesize"]; } }
	if (isset($_POST["northeast_x"])) { $latitude++; $longitude++; if ($latitude > $controlrow["gamesize"]) { $latitude = $controlrow["gamesize"]; } }
	if (isset($_POST["west_x"])) { $longitude--; if ($longitude < ($controlrow["gamesize"]*-1)) { $longitude = ($controlrow["gamesize"]*-1); } }
	if (isset($_POST["east_x"])) { $longitude++; if ($longitude > $controlrow["gamesize"]) { $longitude = $controlrow["gamesize"]; } }
	if (isset($_POST["southwest_x"])) { $latitude--; $longitude--; if ($latitude < ($controlrow["gamesize"]*-1)) { $latitude = ($controlrow["gamesize"]*-1); } }
	if (isset($_POST["south_x"])) { $latitude--; if ($latitude < ($controlrow["gamesize"]*-1)) { $latitude = ($controlrow["gamesize"]*-1); } }
	if (isset($_POST["southeast_x"])) { $latitude--; $longitude++; if ($latitude < ($controlrow["gamesize"]*-1)) { $latitude = ($controlrow["gamesize"]*-1); } }
	
	
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// START EIGHT WAY NAVIGATION
// START EIGHT WAY NAVIGATION
// START EIGHT WAY NAVIGATION
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

   if (isset($_POST["south_west"])) 
	{ 
		$latitude--; 
	    if ($latitude < ($controlrow["gamesize"]*-1)) 
		{   
			$latitude = ($controlrow["gamesize"]*-1); 
		}
		
		$longitude--; 
		if ($longitude < ($controlrow["gamesize"]*-1)) 
		{ 
			$longitude = ($controlrow["gamesize"]*-1);  
		}
	}

	
    if (isset($_POST["south_east"])) 
	{ 
		$latitude--; 
	    if ($latitude < ($controlrow["gamesize"]*-1)) 
		{   
			$latitude = ($controlrow["gamesize"]*-1); 
		}
		
		$longitude++; 
		if ($longitude > $controlrow["gamesize"]) 
		{ 
			$longitude = $controlrow["gamesize"]; 
		}
	}
	
    if (isset($_POST["north_west"])) 
	{ 
		$latitude++; 
		if ($latitude > $controlrow["gamesize"]) 
		{ 
			$latitude = $controlrow["gamesize"]; 
		}
		
		$longitude--; if ($longitude < ($controlrow["gamesize"]*-1)) 
		{ 
			$longitude = ($controlrow["gamesize"]*-1); 
		}
	}


    if (isset($_POST["north_east"])) 
	{ 
		$latitude++; 
		if ($latitude > $controlrow["gamesize"]) 
		{ 
			$latitude = $controlrow["gamesize"]; 
		}
		
		$longitude++; 
		if ($longitude > $controlrow["gamesize"]) 
		{ 
			$longitude = $controlrow["gamesize"]; 
		}	
	}
	
	

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END EIGHT WAY NAVIGATION
// END EIGHT WAY NAVIGATION
// END EIGHT WAY NAVIGATION
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN SKELETON RIDDLE RANDOM PART ONE
// BEGIN SKELETON RIDDLE RANDOM PART ONE
// BEGIN SKELETON RIDDLE RANDOM PART ONE
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$leiakirst = rand(2,2000); //Possibility to find the chest Random 2-2000
if ($leiakirst == 2) {
$query  = "SELECT kirst FROM dk_users";
$result = mysql_query($query);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{    $kirst=$row['kirst'];  if ($kirst == 0) {

	$vorm="<table width=100%><tr><td><center><h3 class=title>Exploring - Skeletons Sighted</h3></td></tr></table>

<blockquote><blockquote><br /><center><img src='images/background/magic/skeleton-001.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Skeletons Sighted off in the Distance' title='Exploring - Skeletons Sighted off in the Distance'></center>

<br>While walking on a slowly disappearing path, under a not so disappearing hot golden sun overhead. You see though the sweat dripping from your forehead into your red stringing eyes, what seems to be bones of one of more skeletons off in the east. The Bones seem to be scattered near a big rock, which is casting a eerie noon time shadow over them.

<br><br>Do you want to move closer? They may have left some tools or weapons that may be useful to you, or they may be just another pile of bones. Which you have seem dozens of times in the Land of the Lost Cities.

<br><br><br><center><form method=POST><input type=submit name=jah value=Yes Get Closer class=myButton2>&nbsp;&nbsp;&nbsp;<input type=submit name=ei value=No Continue Exploring class=myButton2></form></center></blockquote></blockquote><br><br>";

	display($vorm, "Skeletons Sighted off in the Distance");
	die(); } } } //Code end
	

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END SKELETON RIDDLE RANDOM PART ONE
// END SKELETON RIDDLE RANDOM PART ONE
// END SKELETON RIDDLE RANDOM PART ONE
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEING RANDOM LOCATION TELEPORT
// BEING RANDOM LOCATION TELEPORT
// BEING RANDOM LOCATION TELEPORT
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telv
// WITHIN 100-100 South-North and 100-100 West-East of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telv = rand(1,1000); //Random Chance of Teleport being Used 1-X
$l = rand(100,-100);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-100,100); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telv == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Light Blue Teleport 20 S/W Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001A.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been slowly walking through a very dense forest area. The forest is dense with giant tree roots springing forth in fantastic shapes and sizes. Forming weird twisted dark passages intervening with your path in these other worldly forests.

<br><br>&nbsp;&nbsp;As you continue on your path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Light Blue in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight through this defense group of Trees. Your only choice is to turn around and lose days of travel time. As you take in your surroundings you see that your only choice is to move forward. As you cross the Glowing Light Blue Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Light Blue Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvhundredfifty
// WITHIN 1-20 North and 1-20 East of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvhundredfifty = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(120,-120);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-120,120); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvhundredfifty == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Red Teleport 20 NE Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001B.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been slowly walking through a waist high Marsh area. The marsh is dense with giant jungle roots springing forth in fantastic shapes and sizes. Forming weird twisted dark passages intervening with your path in these other worldly marshes.

<br><br>&nbsp;&nbsp;As you continue on your path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Blue in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight through the dirty waist high waters, your only choice is to turn around and lose days of travel time. You see that your only choice is to move forward, as you cross the Glowing Blue Symbol, your head spins and you feel yourself passing out. When spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Blue Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvhundred
// WITHIN 1-20 S/N and 1-20 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvhundred = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-120,120);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-120,120); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvhundred == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Orange Teleport 20 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001C.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a very rocky and barren area. This barren land is hot with few places with shadows to hide from the ever burning Sun above. You slowly move forward very so often tripping over rocks that are scattered as far as eye can see.

<br><br>&nbsp;&nbsp;As you continue on your sun baked path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Orange in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight through a large grouping of rocks or I should say Boulders. Your only choice is to turn around and lose days of travel time or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Orange Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Orange Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvfifty 
// WITHIN 1-50 S/N and 1-50 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvfifty = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-50,150);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-150,50); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvfifty == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Yellow Teleport 50 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001D.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a Beautiful Grasslands area. The large acreage of Grassland extends as far as the eye can manage. Seeming to go on forever.

<br><br>&nbsp;&nbsp;As you continue on your small dirt path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Purple in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight ahead. Your only choice is to turn around and lose your way through the Tall Grasslands or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Purple Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Purple Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvfifteen 
// WITHIN 1-100 S/N and 1-100 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvfifteen = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-100,100);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-100,100); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvfifteen == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Green Teleport 100 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001E.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a Beautiful Grasslands area. The large acreage of Grassland extends as far as the eye can manage. Seeming to go on forever.

<br><br>&nbsp;&nbsp;As you continue on your small dirt path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Yellow in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight ahead. Your only choice is to turn around and lose your way through the Tall Grasslands or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Purple Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Yellow Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvhunfifty 
// WITHIN 1-150 S/N and 1-150 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvhunfifty = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-150,150);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-150,150); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvhunfifty == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Blue Teleport 150 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001F.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a Beautiful Grasslands area. The large acreage of Grassland extends as far as the eye can manage. Seeming to go on forever.

<br><br>&nbsp;&nbsp;As you continue on your small dirt path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Yellow in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight ahead. Your only choice is to turn around and lose your way through the Tall Grasslands or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Purple Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Yellow Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvhuntwo
// WITHIN 1-200 S/N and 1-200 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvhuntwo = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-200,200);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-200,200); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvhuntwo == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Purple Teleport 200 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001G.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a Beautiful Grasslands area. The large acreage of Grassland extends as far as the eye can manage. Seeming to go on forever.

<br><br>&nbsp;&nbsp;As you continue on your small dirt path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Yellow in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight ahead. Your only choice is to turn around and lose your way through the Tall Grasslands or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Purple Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Yellow Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvhuntwofifty
// WITHIN 1-210 S/N and 1-210 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvhuntwofifty = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-210,210);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-210,210); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvhuntwofifty == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Yellow-Orange Teleport 200 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/telesymbol-001H.png align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a Beautiful Grasslands area. The large acreage of Grassland extends as far as the eye can manage. Seeming to go on forever.

<br><br>&nbsp;&nbsp;As you continue on your small dirt path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Yellow in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight ahead. Your only choice is to turn around and lose your way through the Tall Grasslands or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Purple Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Yellow Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM LOCATION TELEPORT $telvlimit
// WITHIN 240-249 S/N and 240-249 E/W of - Capital City.
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$telvlimit = rand(1,2000); //Random Chance of Teleport being Used 1-X
$l = rand(-240,249);  //Random Latitude from X to X you will be Transported to. -X for South X for North
$lo = rand(-240,249); //Random Longitude from X to X you will be Transported to. -X for West X for East
	if ($telvlimit == 1) {
	doquery("UPDATE {{table}} SET $action latitude=$l, longitude=$lo WHERE id='".$userrow["id"]."' LIMIT 1", "users");

$telpage = "<table width=100%><tr><td><center><h3 class=title>You Find a Magic Spin Teleport 240-250 All Disc<h3><center>

<table width=800>
  <tr>
     <td><blockquote><blockquote>&nbsp;&nbsp; ".$userrow["charname"]." You were at <b>Latitude ".$userrow["latitude"]." Longitude ".$userrow["longitude"]."</b>! Where in the Lands are I now? What happened? As your head stops spinning you try to remember what went on in the past few hours.<br><br><img src=images/background/magic/spinning.gif align=right alt=Random Magic Teleport Symbol>&nbsp;&nbsp;You have been walking through a Beautiful Grasslands area. The large acreage of Grassland extends as far as the eye can manage. Seeming to go on forever.

<br><br>&nbsp;&nbsp;As you continue on your small dirt path, you come upon a very small clearing. In the middle of the clearing is a strange symbol that seems to Glow Yellow in the shadows of the night time stars. You have heard rumors in old Myths of the Lost Cities than these glowing symbols could be one of the forgotten Tele-Porting Circles, leading to one of the lost cities of generations ago, at best. At worse it could be a Teleport symbol, that is seldom talked about. These Teleport symbols are said to whisk you off into the unknown part of the Lost Lands. 

<br><br>&nbsp;&nbsp;Sadly the path you are on only points straight ahead. Your only choice is to turn around and lose your way through the Tall Grasslands or as you take in your surroundings you see the only choice is to move forward. As you cross the Glowing Purple Symbol, your head spins and you feel yourself passing out. When the spinning stops, you discover yourself in a totally different location.

<br><br>&nbsp;&nbsp;You realize that Glowing Yellow Disc is a dangerous Teleport Symbol not leading to a Lost City {as a Tele-Porting Circles would], but to a strange part of the Vast Lands of the Lost Cities frontier. Your instinct suggest you to leave you Teleport landing area as fast as you can. Who knows what dangers maybe lurking around here.</blockquote></blockquote></td>
  </tr>
</table>

</center></td></tr></table> ";  display($telpage, "You Find a Magic Teleport");
 die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END RANDOM LOCATION TELEPORT 
// END RANDOM LOCATION TELEPORT 
// END RANDOM LOCATION TELEPORT 
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN NATURE EVENTS
// BEGIN NATURE EVENTS
// BEGIN NATURE EVENTS
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// START MY RANDOM FALLING TREES
// ////////////////////////////////////////////////////////////////

 $vv6imalus = rand(1,800); //Random Chance
 
if ($vv6imalus == 1 && $userrow["magicringsid"] != 1501) {  //magicringsid = 1501

    $milline = rand(1,8); //Slot item to leave behind
    $elu = rand(3,15); //Hurt Points Taken
    $palju = $userrow["currenthp"] - $elu;

     $query  = "SELECT slot1id, slot2id, slot3id, slot4id, slot5id, slot6id, slot7id, slot8id, slot1name, slot2name, slot1name, slot4name, slot5name, slot6name, slot7name, slot8name FROM dk_users WHERE id='$userrow[id]'";

      $result = mysql_query($query);

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{    
$slot1id=$row['slot1id']; 
$slot2id=$row['slot2id']; 
$slot3id=$row['slot3id']; 
$slot4id=$row['slot4id']; 
$slot5id=$row['slot5id']; 
$slot6id=$row['slot6id']; 
$slot7id=$row['slot7id']; 
$slot8id=$row['slot8id']; 

$slot1name=$row['slot1name']; 
$slot2name=$row['slot2name']; 
$slot3name=$row['slot3name'];
$slot4name=$row['slot4name']; 
$slot5name=$row['slot5name']; 
$slot6name=$row['slot6name'];
$slot7name=$row['slot7name']; 
$slot8name=$row['slot8name'];


// ////////////////////////////////////////////////////////////////
// START MILLINE 1
// ////////////////////////////////////////////////////////////////

if ($milline=="1") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Falling Trees Branches<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree01.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>As you were walking through the forest, suddenly with no notice at all. A huge tree falls upon you. Luckily you were not hurt to seriously.  But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>You were trapped by some of the larger Limbs and Branch's. You spend the better part of day light digging and crawling your way from below the rumble of broken tree parts. You discover as you merge from massive tree limbs you may have lost an item you were carrying in your inventory Pack. Your lost item was <font color='#008000'><b>$slot1name</b></font>, which will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                doquery("UPDATE {{table}} 
                SET slot1id='0',slot1name='None' WHERE id=".$userrow["id"], "users");
                doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }


// ////////////////////////////////////////////////////////////////
// END MILLINE 1
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// START MILLINE 2
// ////////////////////////////////////////////////////////////////

elseif ($milline=="2") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Falling Trees Limbs<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree02.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>As you were walking through the forest, suddenly with no notice at all. A huge tree falls upon you. Luckily you were not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>You were trapped by some of the larger Limbs and Branch's. You spend the better part of day light digging and crawling your way from below the rumble of broken tree parts. You discover as you merge from massive tree limbs you may have lost an item you were carrying in your inventory Pack. Your lost item was <font color='#008000'><b>$slot2name</b></font>, which will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot2id='0',slot2name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 2
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START MILLINE 3
// ////////////////////////////////////////////////////////////////

elseif ($milline=="3") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Rumble of Falling Rocks<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree03.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>Exploring near the cliff walls of the nearby forest, you hear a loud rumble - you look up and see rocks of all sizes coming down around you. Luckily you were not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>Trapped by some smaller rocks, you spend the night climbing and digging out of the rumble. You discover as you merge from the rock slide you may have lost an item you were carrying in your inventory Pack. Your lost item was <font color='#008000'><b>$slot3name</b></font>, which will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot3id='0',slot3name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 3
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START MILLINE 4
// ////////////////////////////////////////////////////////////////

elseif ($milline=="4") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Falling Cliff Rocks <h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree03.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>Exploring near the cliff walls of the nearby forest, you hear a loud rumble - you look up and see rocks of all sizes coming down around you. Luckily you were not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>Trapped by some smaller rocks, you spend the night climbing and digging out of the rumble. You discover as you merge from the rock slide you may have lost an item you were carrying in your inventory Pack. Your lost item was <font color='#008000'><b>$slot4name</b></font>, which will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot4id='0',slot4name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 4
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START MILLINE 5
// ////////////////////////////////////////////////////////////////

elseif ($milline=="5") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Storm Water Tides<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree05.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>Exploring the coastline of this strange new world, a sudden storm hits and the waves grow in height and quickly overwhelm you. Luckily you were not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>With the new morning light, you take stock of yourself, as you recover from massive waves you may have lost an item you were carrying in your inventory Pack. Your lost item was <font color='#008000'><b>$slot5name</b></font>, which will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot5id='0',slot5name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 5
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START MILLINE 6
// ////////////////////////////////////////////////////////////////

elseif ($milline=="6") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Massive Storm Waves<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree05.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>Exploring the coastline of this strange new world, a sudden storm hits and the waves grow in height and quickly overwhelm you. Luckily you were not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>With the new morning light, you take stock of yourself, as you recover from massive waves you may have lost an item you were carrying in your inventory Pack. Your lost item was <font color='#008000'><b>$slot6name</b></font>, which will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot6id='0',slot6name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 6
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START MILLINE 7
// ////////////////////////////////////////////////////////////////

elseif ($milline=="7") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Hot Sands and Near Death<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree07.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>You have been walking for a long long time, the thirst and heat has scrambled you mind. You fall into a deep coma and near death. Luckily after a few hours you wake up dazed and found some water near, not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>As you rest and gain your strength, You discover you may have lost an item you were carrying in your inventory Pack. If so, Your lost item was <font color='#008000'><b>$slot7name</b></font>, will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot7id='0',slot7name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 7
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START MILLINE 8
// ////////////////////////////////////////////////////////////////

elseif ($milline=="8") { 
$page="<table width=100%><tr><td><center><h3 class=title>Exploring - Hot Sands and No Water<h3></center><tr><td>

<center><table width=450><tr><td><img src='images/deadtree/DeadTree07.png' border='3' align='center' width='450'></td></tr>
<tr><td><br>You have been walking for a long long time, the thirst and heat has scrambled you mind. You fall into a deep coma and near death. Luckily after a few hours you wake up dazed and found some water near, not hurt to seriously. But Fortune may have saved your life, but you lost <font color='#008000'><b>$elu Hit Points</b></font> leaving you with <font color='#008000'>$palju Hit Points</font> out of your <font color='#008000'>Maximum Hit Points of ".$userrow["maxhp"]."</font>.

<br><br>As you rest and gain your strength, You discover you may have lost an item you were carrying in your inventory Pack. If so, Your lost item was <font color='#008000'><b>$slot8name</b></font>, will be missed greatly.</td></tr>

<tr><td><br><br><center><a href=index.php class=myButton2>Continue exploring</a></center></td></tr></table>
</td></tr></table></center><br><br>"; 

                 doquery("UPDATE {{table}} SET slot8id='0',slot8name='None' WHERE id=".$userrow["id"], "users"); 
                 doquery("UPDATE {{table}} SET currenthp='$palju' WHERE id=".$userrow["id"], "users");  }

// ////////////////////////////////////////////////////////////////
// END MILLINE 8
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// DISPLAY PAGE for Falling Trees
// ////////////////////////////////////////////////////////////////

display($page, "Nature Events");
die();
}  }

// ////////////////////////////////////////////////////////////////
// END MY RANDOM Magic Rings
// ////////////////////////////////////////////////////////////////



    
    $townquery = doquery("SELECT id FROM {{table}} WHERE latitude='$latitude' AND longitude='$longitude' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) > 0) {
        $townrow = mysql_fetch_array($townquery);
        include('towns.php');
        travelto($townrow["id"], false);
        die();
    }	

    $fieldquery = doquery("SELECT id,name,latitude,longitude,fieldmonster1id,fieldmonster2id FROM {{table}} WHERE latitude='$latitude' AND longitude='$longitude' LIMIT 1", "fields");
    if (mysql_num_rows($fieldquery) > 0) {
        $fieldrow = mysql_fetch_array($fieldquery);
        include('fields.php');
        visitfield($fieldrow["id"], false);
        die();
    }
	
    $questquery = doquery("SELECT quest_id FROM {{table}} WHERE latitude='$latitude' AND longitude='$longitude' AND user_id='".$userrow["id"]."' AND status='0' LIMIT 1", "questprogress");
    if (mysql_num_rows($questquery) > 0) {

        $quest = mysql_fetch_array($questquery);
        $action = "currentaction='Quest Event',";
        $updatequery = doquery("UPDATE {{table}} SET currentaction='Quest Event', currentquestid = '".$quest["quest_id"]."', currentfight='1', latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
	  header("Location: index.php");
        die();
    }

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
//END NATURE EVENTS
//END NATURE EVENTS
//END NATURE EVENTS
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN BEING MUGGED
// BEGIN BEING MUGGED
// BEGIN BEING MUGGED
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E1 - E10 Random Mugged Copper Coins
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E1.  Mugged Rand of 150 - Loss of 1 to 5 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,150);
if ($mugchance == 1) { // getting mugged 1 in 150
$copper = rand(1,5); // Lost of Copper 1 to 5 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-1.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E2.  Mugged Rand of 300 - Loss of 5 to 10 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,300);
if ($mugchance == 1) { // getting mugged 1 in 300
$copper = rand(5,10); // Lost of Copper 5 to 10 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-2.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E3.  Mugged Rand of 600 - Loss of 10 to 15 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,600);
if ($mugchance == 1) { // getting mugged 1 in 600
$copper = rand(10,15); // Lost of Copper 10 to 15 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-3.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E4.  Mugged Rand of 900 - Loss of 15 to 25 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,1500);
if ($mugchance == 1) { // getting mugged 1 in 900
$copper = rand(15,25); // Lost of Copper 15 to 25 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-4.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E5.  Mugged Rand of 1500 - Loss of 25 to 35 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,2900);
if ($mugchance == 1) { // getting mugged 1 in 1500
$copper = rand(25,35); // Lost of Copper 25 to 35 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-5.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E6.  Mugged Rand of 3000 - Loss of 35 to 50 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,3500);
if ($mugchance == 1) { // getting mugged 1 in 3000
$copper = rand(35,50); // Lost of Copper 35 to 50 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-6.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E7.  Mugged Rand of 5000 - Loss of 50 to 75 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,7000);
if ($mugchance == 1) { // getting mugged 1 in 5000
$copper = rand(50,75); // Lost of Copper 50 to 75 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-7.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E8.  Mugged Rand of 10000 - Loss of 75 to 125 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,14000);
if ($mugchance == 1) { // getting mugged 1 in 10000
$copper = rand(75,125); // Lost of Copper 75 to 125 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-8.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E9.  Mugged Rand of 20000 - Loss of 125 to 200 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,25000);
if ($mugchance == 1) { // getting mugged 1 in 20000
$copper = rand(125,200); // Lost of Copper 125 to 200 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-9.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E10.  Mugged Rand of 50000 - Loss of 200 to 500 Copper Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,80000);
if ($mugchance == 1) { // getting mugged 1 in 50000
$copper = rand(200,500); // Lost of Copper 200 to 500 Coins
if ($copper > $userrow["copper"])
$copper = $userrow["copper"];
doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$copper1 = number_format($copper);

$page = "<center><h3 class='title'>Exploring - Mugged of Copper Coins<h3></center>
<center><table background='images/random/E-10.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_minus.png' height='150' width='300' title='Copper Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$copper1 Copper Coins'/>$copper1 Copper Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E11 - E20 Random Mugged Silver Coins
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E11.  Mugged Rand of 150 - Loss of 1 to 5 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,150);
if ($mugchance == 1) { // getting mugged 1 in 150
$silver = rand(1,5); // Lost of Silver 1 to 5 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-11.png' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E12.  Mugged Rand of 300 - Loss of 5 to 10 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,300);
if ($mugchance == 1) { // getting mugged 1 in 300
$silver = rand(5,10); // Lost of Silver 5 to 10 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-12.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E13.  Mugged Rand of 600 - Loss of 10 to 15 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,900);
if ($mugchance == 1) { // getting mugged 1 in 600
$silver = rand(10,15); // Lost of Silver 10 to 15 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-13.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E14.  Mugged Rand of 900 - Loss of 15 to 25 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,1200);
if ($mugchance == 1) { // getting mugged 1 in 900
$silver = rand(15,25); // Lost of Silver 15 to 25 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-14.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E15.  Mugged Rand of 1500 - Loss of 25 to 35 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,2000);
if ($mugchance == 1) { // getting mugged 1 in 1500
$silver = rand(25,35); // Lost of Silver 25 to 35 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-15.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E16.  Mugged Rand of 3000 - Loss of 35 to 50 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,5000);
if ($mugchance == 1) { // getting mugged 1 in 3000
$silver = rand(35,50); // Lost of Silver 35 to 50 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-16.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E17.  Mugged Rand of 5000 - Loss of 50 to 75 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,8000);
if ($mugchance == 1) { // getting mugged 1 in 5000
$silver = rand(50,75); // Lost of Silver 50 to 75 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-17.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E18.  Mugged Rand of 10000 - Loss of 75 to 125 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,14000);
if ($mugchance == 1) { // getting mugged 1 in 10000
$silver = rand(75,125); // Lost of Silver 75 to 125 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-18.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E19.  Mugged Rand of 20000 - Loss of 125 to 200 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,25000);
if ($mugchance == 1) { // getting mugged 1 in 20000
$silver = rand(125,200); // Lost of Silver 125 to 200 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-19.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E20.  Mugged Rand of 50000 - Loss of 200 to 500 Silver Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,80000);
if ($mugchance == 1) { // getting mugged 1 in 50000
$silver = rand(200,500); // Lost of Silver 200 to 500 Coins
if ($silver > $userrow["silver"])
$silver = $userrow["silver"];
doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$silver1 = number_format($silver);

$page = "<center><h3 class='title'>Exploring - Mugged of Silver Coins<h3></center>
<center><table background='images/random/E-20.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_minus.png' height='150' width='300' title='Silver Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$silver1 Silver Coins'/>$silver1 Silver Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E21 - E30 Random Mugged Gold Coins
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E21.  Mugged Rand of 150 - Loss of 1 to 5 Gold Coins
// ////////////////////////////////////////////////////////////////


$mugchance = rand(1,150);
if ($mugchance == 1) { // getting mugged 1 in 150
$gold = rand(1,5); // Lost of Gold 1 to 5 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-21.png' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}


// ////////////////////////////////////////////////////////////////
// E22.  Mugged Rand of 300 - Loss of 5 to 10 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,500);
if ($mugchance == 1) { // getting mugged 1 in 300
$gold = rand(5,10); // Lost of Gold 5 to 10 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-22.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E23.  Mugged Rand of 600 - Loss of 10 to 15 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,900);
if ($mugchance == 1) { // getting mugged 1 in 600
$gold = rand(10,15); // Lost of Gold 10 to 15 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-23.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E24.  Mugged Rand of 900 - Loss of 15 to 25 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,1200);
if ($mugchance == 1) { // getting mugged 1 in 900
$gold = rand(15,25); // Lost of Gold 15 to 25 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-24.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E25.  Mugged Rand of 1500 - Loss of 25 to 35 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,2000);
if ($mugchance == 1) { // getting mugged 1 in 1500
$gold = rand(25,35); // Lost of Gold 25 to 35 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-25.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E26.  Mugged Rand of 3000 - Loss of 35 to 50 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,5000);
if ($mugchance == 1) { // getting mugged 1 in 3000
$gold = rand(35,50); // Lost of Gold 35 to 50 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-26.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E27.  Mugged Rand of 5000 - Loss of 50 to 75 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,7000);
if ($mugchance == 1) { // getting mugged 1 in 5000
$gold = rand(50,75); // Lost of Gold 50 to 75 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-27.png' cellpadding='0' cellspacing='0' width='300' height='150' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along the road and someone jumps in front for you and punched you in the face. As you were on the ground knocked out. The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse. You were lucky he did not check your right Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E28.  Mugged Rand of 10000 - Loss of 75 to 125 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,15000);
if ($mugchance == 1) { // getting mugged 1 in 10000
$gold = rand(75,125); // Lost of Gold 75 to 125 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-28.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were walking along exploring your surroundings, someone behind you clubs you and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse. You were lucky he did not check your underwear for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E29.  Mugged Rand of 20000 - Loss of 125 to 200 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,40000);
if ($mugchance == 1) { // getting mugged 1 in 20000
$gold = rand(125,200); // Lost of Gold 125 to 200 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-29.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// E30.  Mugged Rand of 50000 - Loss of 200 to 500 Gold Coins
// ////////////////////////////////////////////////////////////////

$mugchance = rand(1,80000);
if ($mugchance == 1) { // getting mugged 1 in 50000
$gold = rand(200,500); // Lost of Gold 200 to 500 Coins
if ($gold > $userrow["gold"])
$gold = $userrow["gold"];
doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$gold1 = number_format($gold);

$page = "<center><h3 class='title'>Exploring - Mugged of Gold Coins<h3></center>
<center><table background='images/random/E-30.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_minus.png' height='150' width='300' title='Gold Mugging' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were resting after exploring your vast surroundings, someone strikes you on the head with a rock. You are knocked out and you fall to the ground.  The Thief robs you of <font color='#C8003C' alt='$gold1 Gold Coins'/>$gold1 Gold Coins</font> from your Coin purse, while you were unable to act. You were lucky he did not check your left Boot for more coins.</td></tr></table></center>";
display($page, "You have been Mugged!");
die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END BEING MUGGED
// END BEING MUGGED
// END BEING MUGGED
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// START PLUS MONEY
// START PLUS MONEY
// START PLUS MONEY
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E31 - E40 Random Copper Coins Found
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E31.  Plus Copper Rand of 150 - Found 1 to 5 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance1 = rand(1,150); // Find random number between 1 and X
if ($copperchance1 == 1) { // If the random number is 1
$copper = rand(1,5); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET copper=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-31.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While walking along the road minding your own business you found <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E32.  Plus Copper Rand of 300 - Found 5 to 10 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance2 = rand(1,300); // Find random number between 1 and X
if ($copperchance2 == 1) { // If the random number is 1
$copper = rand(5,10); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-32.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you explore this vast and wild land, you happen to look down and find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E33.  Plus Copper Rand of 600 - Found 10 to 15 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance3 = rand(1,600); // Find random number between 1 and X
if ($copperchance3 == 1) { // If the random number is 1
$copper = rand(10,15); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-33.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />You briefly take a break from you long day of exploring and find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered behind a bush not more than two feet from you.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E34.  Plus Copper Rand of 900 - Found 15 to 25 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance4 = rand(1,900); // Find random number between 1 and X
if ($copperchance4 == 1) { // If the random number is 1
$copper = rand(15,25); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-34.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E35.  Plus Copper Rand of 1500 - Found 25 to 35 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance5 = rand(1,1500); // Find random number between 1 and X
if ($copperchance5 == 1) { // If the random number is 1
$copper = rand(25,35); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-35.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E36.  Plus Copper Rand of 3000 - Found 35 to 50 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance6 = rand(1,3000); // Find random number between 1 and X
if ($copperchance6 == 1) { // If the random number is 1
$copper = rand(35,50); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET copper=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-36.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While walking along the road minding your own business you found <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E37.  Plus Copper Rand of 5000 - Found 50 to 75 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance7 = rand(1,5000); // Find random number between 1 and X
if ($copperchance7 == 1) { // If the random number is 1
$copper = rand(50,75); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-37.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you explore this vast and wild land, you happen to look down and find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E38.  Plus Copper Rand of 10000 - Found 75 to 125 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance8 = rand(1,10000); // Find random number between 1 and X
if ($copperchance8 == 1) { // If the random number is 1
$copper = rand(75,125); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-38.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />You briefly take a break from you long day of exploring and find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered behind a bush not more than two feet from you.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E39.  Plus Copper Rand of 20000 - Found of 125 to 200 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance9 = rand(1,20000); // Find random number between 1 and X
if ($copperchance9 == 1) { // If the random number is 1
$copper = rand(125,200); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-39.png' width='300' height='150' cellpadding='0' cellspacing='0' border='4' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='0'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E40.  Plus Copper Rand of 50000 - Found 200 to 500 Copper Coins
// ////////////////////////////////////////////////////////////////

$copperchance10 = rand(1,50000); // Find random number between 1 and X
if ($copperchance10 == 1) { // If the random number is 1
$copper = rand(200,500); // Select a random number between 1 and X Copper Coins.
doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Copper Coins Found<h3></center>
<center><table background='images/random/E-40.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/copper_plus.png' height='150' width='300' title='Copper Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Copper Coins Found'/>$copper Copper Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Copper Coins...");
	die();
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E41 - E50 Random Found Silver Coins
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E41.  Plus Silver Rand of 150 - Found of 1 to 5 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance1 = rand(1,150); // Find random number between 1 and X
if ($silverchance1 == 1) { // If the random number is 1
$silver = rand(1,5); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET silver=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-41.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While walking along the road minding your own business you found <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E42.  Plus Silver Rand of 300 - Found of 5 to 10 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance2 = rand(1,300); // Find random number between 1 and X
if ($silverchance2 == 1) { // If the random number is 1
$silver = rand(5,10); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-42.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you explore this vast and wild land, you happen to look down and find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E43.  Plus Silver Rand of 600 - Found of 10 to 15 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance3 = rand(1,600); // Find random number between 1 and X
if ($silverchance3 == 1) { // If the random number is 1
$silver = rand(10,15); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-43.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />You briefly take a break from you long day of exploring and find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered behind a bush not more than two feet from you.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E44.  Plus Silver Rand of 900 - Found of 15 to 25 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance4 = rand(1,900); // Find random number between 1 and X
if ($silverchance4 == 1) { // If the random number is 1
$silver = rand(15,25); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-44.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E45.  Plus Silver Rand of 1500 - Found of 25 to 35 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance5 = rand(1,1500); // Find random number between 1 and X
if ($silverchance5 == 1) { // If the random number is 1
$silver = rand(25,35); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-45.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E46.  Plus Silver Rand of 3000 - Found of 35 to 50 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance6 = rand(1,3000); // Find random number between 1 and X
if ($silverchance6 == 1) { // If the random number is 1
$silver = rand(35,50); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET silver=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-46.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While walking along the road minding your own business you found <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E47.  Plus Silver Rand of 5000 - Found of 50 to 75 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance7 = rand(1,5000); // Find random number between 1 and X
if ($silverchance7 == 1) { // If the random number is 1
$silver = rand(50,75); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-47.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you explore this vast and wild land, you happen to look down and find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E48.  Plus Silver Rand of 10000 - Found of 75 to 125 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance8 = rand(1,10000); // Find random number between 1 and X
if ($silverchance8 == 1) { // If the random number is 1
$silver = rand(75,125); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-48.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />You briefly take a break from you long day of exploring and find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered behind a bush not more than two feet from you.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E49.  Plus Silver Rand of 20000 - Found of 125 to 200 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance9 = rand(1,20000); // Find random number between 1 and X
if ($silverchance9 == 1) { // If the random number is 1
$silver = rand(125,200); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-49.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E50.  Plus Silver Rand of 50000 - Found of 200 to 500 Silver Coins
// ////////////////////////////////////////////////////////////////

$silverchance10 = rand(1,50000); // Find random number between 1 and X
if ($silverchance10 == 1) { // If the random number is 1
$silver = rand(200,500); // Select a random number between 1 and X Silver Coins.
doquery("UPDATE {{table}} SET gold=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Silver Coins Found<h3></center>
<center><table background='images/random/E-50.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/silver_plus.png' height='150' width='300' title='Silver Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Silver Coins Found'/>$silver Silver Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Silver Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E41 - E50 Random Found Gold Coins
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E41.  Plus Gold Rand of 150 - 1 to 5 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance1 = rand(1,150); // Find random number between 1 and X
if ($goldchance1 == 1) { // If the random number is 1
$gold = rand(1,5); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-41.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While walking along the road minding your own business you found <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E42.  Plus Gold Rand of 300 - 5 to 10 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance2 = rand(1,300); // Find random number between 1 and X
if ($goldchance2 == 1) { // If the random number is 1
$gold = rand(5,10); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-42.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you explore this vast and wild land, you happen to look down and find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E43.  Plus Gold Rand of 600 - 10 to 15 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance3 = rand(1,600); // Find random number between 1 and X
if ($goldchance3 == 1) { // If the random number is 1
$gold = rand(10,15); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-43.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />You briefly take a break from you long day of exploring and find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered behind a bush not more than two feet from you.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E44.  Plus Gold Rand of 900 - 15 to 25 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance4 = rand(1,900); // Find random number between 1 and X
if ($goldchance4 == 1) { // If the random number is 1
$gold = rand(15,25); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-44.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E45.  Plus Gold Rand of 1500 - 25 to 35 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance5 = rand(1,1500); // Find random number between 1 and X
if ($goldchance5 == 1) { // If the random number is 1
$gold = rand(25,35); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-45.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E46.  Plus Gold Rand of 3000 - 35 to 50 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance6 = rand(1,3000); // Find random number between 1 and X
if ($goldchance6 == 1) { // If the random number is 1
$gold = rand(35,50); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-46.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While walking along the road minding your own business you found <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E47.  Plus Gold Rand of 5000 - 50 to 75 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance7 = rand(1,5000); // Find random number between 1 and X
if ($goldchance7 == 1) { // If the random number is 1
$gold = rand(50,75); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-47.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you explore this vast and wild land, you happen to look down and find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered on the road before you.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E48.  Plus Gold Rand of 10000 - 75 to 125 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance8 = rand(1,10000); // Find random number between 1 and X
if ($goldchance8 == 1) { // If the random number is 1
$gold = rand(75,125); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-48.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />You briefly take a break from you long day of exploring and find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered behind a bush not more than two feet from you.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E49.  Plus Gold Rand of 20000 - 125 to 200 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance9 = rand(1,20000); // Find random number between 1 and X
if ($goldchance9 == 1) { // If the random number is 1
$gold = rand(125,200); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-49.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E50.  Plus Gold Rand of 50000 - 200 to 500 Gold Coins
// ////////////////////////////////////////////////////////////////

$goldchance10 = rand(1,50000); // Find random number between 1 and X
if ($goldchance10 == 1) { // If the random number is 1
$gold = rand(200,500); // Select a random number between 1 and X Gold Coins.
doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	
$page = "<center><h3 class='title'>Exploring - Gold Coins Found<h3></center>
<center><table background='images/random/E-50.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/gold_plus.png' height='150' width='300' title='Gold Coins Found' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />As you sit down to eat a small snack before you continue your exploring you find <font color='#008000' alt='Gold Coins Found'/>$gold Gold Coins</font> scattered behind the rock you just sat on.</td></tr></table></center>";
	display($page, "You found some Gold Coins...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E51 - E54 Random Magic Points - Gains & Loss
// E51 - E54 Random Magic Points - Gains & Loss
// E51 - E54 Random Magic Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E51.  Random Magic Points of 2500 - Gain of 1-2 MPs
// ////////////////////////////////////////////////////////////////

$maxmpchance1 = rand(1,2500); // Find Random number between 1 and X.
if ($maxmpchance1 == 1) { // If the random number is 1
$maxmp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxmp=maxmp+$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxmp Magic Points Gained<h3></center>
<center><table background='images/random/E-51.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Magic Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Magic Potion. As you give the bottle a closer examination it has &copy; EG:MP-1/2 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Magic Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl. After a short period of time, you notice you have <span style='color: #008000;'>Gained $maxmp Magic Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E52.  Random Magic Points of 5000 - Gain of 1-3 MPs
// ////////////////////////////////////////////////////////////////

$maxmpchance2 = rand(1,5000); // Find Random number between 1 and X.
if ($maxmpchance2 == 1) { // If the random number is 1
$maxmp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxmp=maxmp+$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxmp Magic Points Gained<h3></center>
<center><table background='images/random/E-52.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Magic Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Magic Potion. As you give the bottle a closer examination it has &copy; EG:MP-1/3 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Magic Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl. After a short period of time, you notice you have <span style='color: #008000;'>Gained $maxmp Magic Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E53.  Random Magic Points of 2500 - Loss of 1-2 MPs
// ////////////////////////////////////////////////////////////////

$maxmpchance3 = rand(1,2500); // Find Random number between 1 and X.
if ($maxmpchance3 == 1) { // If the random number is 1
$maxmp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxmp=maxmp-$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxmp Magic Points Lost<h3></center>
<center><table background='images/random/E-53.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Magic Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Magic Potion. As you give the bottle a closer examination it has &copy; EL:MP-1/2 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Magic Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a heavy headed and then your stomach beings to roar with a deep moaning. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxmp Magic Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E54.  Random Magic Points of 5000 - Loss of 1-3 MPs
// ////////////////////////////////////////////////////////////////

$maxmpchance4 = rand(1,5000); // Find Random number between 1 and X.
if ($maxmpchance4 == 1) { // If the random number is 1
$maxmp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxmp=maxmp-$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxmp Magic Points Lost<h3></center>
<center><table background='images/random/E-54.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Magic Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Magic Potion. As you give the bottle a closer examination it has &copy; EL:MP-1/3 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Magic Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a heavy headed and then your stomach beings to roar with a deep goaning. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxmp Magic Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E55 - E58 Random Hit Points - Gains & Loss
// E55 - E58 Random Hit Points - Gains & Loss
// E55 - E58 Random Hit Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////



// ////////////////////////////////////////////////////////////////
// E55.  Random Hit Points of 2500 - Gain of 1-2 HPs
// ////////////////////////////////////////////////////////////////

$maxhpchance1 = rand(1,350); // Find Random number between 1 and X.
if ($maxhpchance1 == 1) { // If the random number is 1
$maxhp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxhp=maxhp+$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxhp Hit Points Gained<h3></center>
<center><table background='images/random/E-55.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Hit Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EG:HP-1/2 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl. After a short period of time, you notice you have <span style='color: #008000;'>Gained $maxhp Hit Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E56.  Random Hit Points of 5000 - Gain of 1-3 HPs
// ////////////////////////////////////////////////////////////////

$maxhpchance2 = rand(1,5000); // Find Random number between 1 and X.
if ($maxhpchance2 == 1) { // If the random number is 1
$maxhp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxhp=maxhp+$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxhp Hit Points Gained<h3></center>
<center><table background='images/random/E-56.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Hit Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EG:HP-1/3 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl. After a short period of time, you notice you have <span style='color: #008000;'>Gained $maxhp Hit Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E57.  Random Hit Points of 2500 - Loss of 1-2 HPs
// ////////////////////////////////////////////////////////////////

$maxhpchance3 = rand(1,2500); // Find Random number between 1 and X.
if ($maxhpchance3 == 1) { // If the random number is 1
$maxhp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxhp=maxhp-$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxhp Hit Points Lost<h3></center>
<center><table background='images/random/E-57.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Hit Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EL:HP-1/2 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a heavy headed and then your stomach beings to roar with a deep goaning. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxhp Hit Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E58.  Random Hit Points of 5000 - Loss of 1-3 HPs
// ////////////////////////////////////////////////////////////////

$maxhpchance4 = rand(1,5000); // Find Random number between 1 and X.
if ($maxhpchance4 == 1) { // If the random number is 1
$maxhp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxhp=maxhp-$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxhp Hit Points Lost<h3></center>
<center><table background='images/random/E-58.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Hit Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EL:HP-1/3 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a heavy headed and then your stomach beings to roar with a deep goaning. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxhp Hit Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E59 - E62 Random Travel Points - Gains & Loss
// E59 - E62 Random Travel Points - Gains & Loss
// E59 - E62 Random Travel Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E59.  Random Travel Points of 2500 - Gain of 1-2 TPs
// ////////////////////////////////////////////////////////////////

$maxtpchance1 = rand(1,2500); // Find Random number between 1 and X.
if ($maxtpchance1 == 1) { // If the random number is 1
$maxtp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxtp=maxtp+$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxtp Travel Points Gained<h3></center>
<center><table background='images/random/E-59.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Travel Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EG:HP-1/2 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl. After a short period of time, you notice you have <span style='color: #008000;'>Gained $maxtp Travel Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E60.  Random Travel Points of 5000 - Gain of 1-3 TPs
// ////////////////////////////////////////////////////////////////

$maxtpchance2 = rand(1,5000); // Find Random number between 1 and X.
if ($maxtpchance2 == 1) { // If the random number is 1
$maxtp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxtp=maxtp+$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxtp Travel Points Gained<h3></center>
<center><table background='images/random/E-60.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Travel Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EG:HP-1/3 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl. After a short period of time, you notice you have <span style='color: #008000;'>Gained $maxtp Travel Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E61.  Random Travel Points of 2500 - Loss of 1-2 TPs
// ////////////////////////////////////////////////////////////////

$maxtpchance3 = rand(1,2500); // Find Random number between 1 and X.
if ($maxtpchance3 == 1) { // If the random number is 1
$maxtp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxtp=maxtp-$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxtp Travel Points Lost<h3></center>
<center><table background='images/random/E-61.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Travel Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EL:HP-1/2 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a heavy headed and then your stomach beings to roar with a deep goaning. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxtp Travel Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E62.  Random Travel Points of 5000 - Loss of 1-3 TPs
// ////////////////////////////////////////////////////////////////

$maxtpchance4 = rand(1,5000); // Find Random number between 1 and X.
if ($maxtpchance4 == 1) { // If the random number is 1
$maxtp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET maxtp=maxtp-$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $maxtp Travel Points Lost<h3></center>
<center><table background='images/random/E-62.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/mp.png' height='150' width='300' title='Travel Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Hit Potion. As you give the bottle a closer examination it has &copy; EL:HP-1/3 Acme Elixir Corporation engraved on the bottom of it.<br><br>Could this actually be one of the Hit Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a heavy headed and then your stomach beings to roar with a deep goaning. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxtp Travel Points</span> from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E63 - E66 Random Strength Points - Gains & Loss
// E63 - E66 Random Strength Points - Gains & Loss
// E63 - E66 Random Strength Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E63.  Random Strength Points of 2500 - Gain of 1-2 STRs
// ////////////////////////////////////////////////////////////////

$strengthchance1 = rand(1,500); // Find Random number between 1 and X.
if ($strengthchance1 == 1) { // If the random number is 1
$strength = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET strength=strength+$strength WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $strength Points Gained<h3></center>
<center><table background='images/random/E-63.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/str.png' height='150' width='300' title='Strength Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Strength Potion. As you give the bottle a closer examination it has <i>&copy; EG:STR-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Strength Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gained $strength Strength Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E64.  Random Strength Points of 5000 - Gain of 1-3 STRs
// ////////////////////////////////////////////////////////////////

$strengthchance2 = rand(1,5000); // Find Random number between 1 and X.
if ($strengthchance2 == 1) { // If the random number is 1
$strength = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET strength=strength+$strength WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $strength Points Gained<h3></center>
<center><table background='images/random/E-64.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/str.png' height='150' width='300' title='Strength Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Strength Potion. As you give the bottle a closer examination it has <i>&copy; EG:STR-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Strength Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gained $strength Strength Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E65.  Random Strength Points of 2500 - Loss of 1-2 STRs
// ////////////////////////////////////////////////////////////////

$strengthchance3 = rand(1,2500); // Find Random number between 1 and X.
if ($strengthchance3 == 1) { // If the random number is 1
$strength = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET strength=strength-$strength WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $strength Points  Loss<h3></center>
<center><table background='images/random/E-65.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/str.png' height='150' width='300' title='Strength Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Strength Potion. As you give the bottle a closer examination it has <i>&copy; EL:STR-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Strength Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $strength Strength Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E66.  Random Strength Points of 5000 - Loss of 1-3 STRs
// ////////////////////////////////////////////////////////////////

$strengthchance4 = rand(1,5000); // Find Random number between 1 and X.
if ($strengthchance4 == 1) { // If the random number is 1
$strength = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET strength=strength-$strength WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $strength Points Loss<h3></center>
<center><table background='images/random/E-66.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/str.png' height='150' width='300' title='Strength Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Strength Potion. As you give the bottle a closer examination it has <i>&copy; EL:STR-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Strength Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $strength Strength Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E67 - E70 Random Dexterity Points - Gains & Loss
// E67 - E70 Random Dexterity Points - Gains & Loss
// E67 - E70 Random Dexterity Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E67.  Random Dexterity Points of 2500 - Gain of 1-2 DEXs
// ////////////////////////////////////////////////////////////////

$dexteritychance1 = rand(1,500); // Find Random number between 1 and X.
if ($dexteritychance1 == 1) { // If the random number is 1
$dexterity = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET dexterity=dexterity+$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $dexterity Points Gained<h3></center>
<center><table background='images/random/E-67.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Dexterity Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Dexterity Potion. As you give the bottle a closer examination it has <i>&copy; EG:STR-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Dexterity Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gained $dexterity Dexterity Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E68.  Random Dexterity Points of 5000 - Gain of 1-3 DEXs
// ////////////////////////////////////////////////////////////////

$dexteritychance2 = rand(1,5000); // Find Random number between 1 and X.
if ($dexteritychance2 == 1) { // If the random number is 1
$dexterity = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET dexterity=dexterity+$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $dexterity Points Gained<h3></center>
<center><table background='images/random/E-68.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Dexterity Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Dexterity Potion. As you give the bottle a closer examination it has <i>&copy; EG:STR-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Dexterity Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gained $dexterity Dexterity Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E69.  Random Dexterity Points of 2500 - Loss of 1-2 DEXs
// ////////////////////////////////////////////////////////////////

$dexteritychance3 = rand(1,2500); // Find Random number between 1 and X.
if ($dexteritychance3 == 1) { // If the random number is 1
$dexterity = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET dexterity=dexterity-$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $dexterity Points  Loss<h3></center>
<center><table background='images/random/E-69.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Dexterity Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Dexterity Potion. As you give the bottle a closer examination it has <i>&copy; EL:STR-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Dexterity Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $dexterity Dexterity Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E70.  Random Dexterity Points of 5000 - Loss of 1-3 DEXs
// ////////////////////////////////////////////////////////////////

$dexteritychance4 = rand(1,5000); // Find Random number between 1 and X.
if ($dexteritychance4 == 1) { // If the random number is 1
$dexterity = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET dexterity=dexterity-$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $dexterity Points Loss<h3></center>
<center><table background='images/random/E-70.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Dexterity Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Dexterity Potion. As you give the bottle a closer examination it has <i>&copy; EL:STR-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Dexterity Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $dexterity Dexterity Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E71 - E74 Random Attack Power Points - Gains & Loss
// E71 - E74 Random Attack Power Points - Gains & Loss
// E71 - E74 Random Attack Power Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E71.  Random Attack Power Points of 2500 - Gain of 1-2 ATTs
// ////////////////////////////////////////////////////////////////

$attackpowerchance1 = rand(1,2500); // Find Random number between 1 and X.
if ($attackpowerchance1 == 1) { // If the random number is 1
$attackpower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET attackpower=attackpower+$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $attackpower Points Gained<h3></center>
<center><table background='images/random/E-71.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Attack Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Attack Power Potion. As you give the bottle a closer examination it has <i>&copy; EG:ATT-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Attack Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gained $attackpower Attack Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E72.  Random Attack Power Points of 5000 - Gain of 1-3 ATTs
// ////////////////////////////////////////////////////////////////

$attackpowerchance2 = rand(1,5000); // Find Random number between 1 and X.
if ($attackpowerchance2 == 1) { // If the random number is 1
$attackpower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET attackpower=attackpower+$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $attackpower Points Gained<h3></center>
<center><table background='images/random/E-72.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Attack Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Attack Power Potion. As you give the bottle a closer examination it has <i>&copy; EG:ATT-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Attack Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gained $attackpower Attack Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E73.  Random Attack Power Points of 2500 - Loss of 1-2 ATTs
// ////////////////////////////////////////////////////////////////

$attackpowerchance3 = rand(1,2500); // Find Random number between 1 and X.
if ($attackpowerchance3 == 1) { // If the random number is 1
$attackpower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET attackpower=attackpower-$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $attackpower Points  Loss<h3></center>
<center><table background='images/random/E-73.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Attack Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Attack Power Potion. As you give the bottle a closer examination it has <i>&copy; EL:ATT-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Attack Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $attackpower Attack Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E74.  Random Attack Power Points of 5000 - Loss of 1-3 ATTs
// ////////////////////////////////////////////////////////////////

$attackpowerchance4 = rand(1,5000); // Find Random number between 1 and X.
if ($attackpowerchance4 == 1) { // If the random number is 1
$attackpower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET attackpower=attackpower-$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $attackpower Points Loss<h3></center>
<center><table background='images/random/E-74.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Attack Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Attack Power Potion. As you give the bottle a closer examination it has <i>&copy; EL:ATT-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Attack Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $attackpower Attack Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E75 - E78 Random Defense Power Points - Gains & Loss
// E75 - E78 Random Defense Power Points - Gains & Loss
// E75 - E78 Random Defense Power Points - Gains & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E75.  Random Defense Power Points of 2500 - Gain of 1-2 DEFs
// ////////////////////////////////////////////////////////////////

$defensepowerchance1 = rand(1,500); // Find Random number between 1 and X.
if ($defensepowerchance1 == 1) { // If the random number is 1
$defensepower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET defensepower=defensepower+$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $defensepower Points Gained<h3></center>
<center><table background='images/random/E-75.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Defense Power Potion. As you give the bottle a closer examination it has <i>&copy; EG:DEF-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Defense Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gain $defensepower Defense Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E76.  Random Defense Power Points of 5000 - Gain of 1-3 DEFs
// ////////////////////////////////////////////////////////////////

$defensepowerchance2 = rand(1,5000); // Find Random number between 1 and X.
if ($defensepowerchance2 == 1) { // If the random number is 1
$defensepower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET defensepower=defensepower+$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $defensepower Points Gained<h3></center>
<center><table background='images/random/E-76.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Defense Power Potion. As you give the bottle a closer examination it has <i>&copy; EG:DEF-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Defense Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #008000;'>Gain $defensepower Defense Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E77.  Random Defense Power Points of 2500 - Loss of 1-2 DEFs
// ////////////////////////////////////////////////////////////////

$defensepowerchance3 = rand(1,2500); // Find Random number between 1 and X.
if ($defensepowerchance3 == 1) { // If the random number is 1
$defensepower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET defensepower=defensepower-$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $defensepower Points  Loss<h3></center>
<center><table background='images/random/E-77.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Defense Power Potion. As you give the bottle a closer examination it has <i>&copy; EL:DEF-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Defense Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $defensepower Defense Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E78.  Random Defense Power Points of 5000 - Loss of 1-3 DEFs
// ////////////////////////////////////////////////////////////////

$defensepowerchance4 = rand(1,5000); // Find Random number between 1 and X.
if ($defensepowerchance4 == 1) { // If the random number is 1
$defensepower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
doquery("UPDATE {{table}} SET defensepower=defensepower-$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.

$page = "<center><h3 class='title'>Elixir Found - $defensepower Points Loss<h3></center>
<center><table background='images/random/E-78.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/dex.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br />While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Defense Power Potion. As you give the bottle a closer examination it has <i>&copy; EL:DEF-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Defense Power Elixirs you have heard so much about from speaking to the Cities Villagers? You are feel very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your chest, arm and legs seem to gain muscle mass. After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $defensepower Defense Power Points from drinking the Elixir.</td></tr></table></center>";
	display($page, "You find a Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E79 - E82 Random Combo Points HP/MP/TP - Gains & Loss
// E79 - E82 Random Combo Points HP/MP/TP - Gains & Loss
// E79 - E82 Random Combo Points HP/MP/TP - Gains & Loss
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E79.  Random Combo Points HP/MP/TP 5000 - Gain of 1-2 HP/MP/TPs
// ////////////////////////////////////////////////////////////////


$maxcombo3chance = rand(1,2000); // Find Random number between 1 and X.
if ($maxcombo3chance == 1) { // If the random number is 1
	$maxhp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxhp=maxhp+$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxmp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxmp=maxmp+$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxtp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxtp=maxtp+$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.	
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - $maxhp HPs | $maxmp MPs | $maxtp TPs Gained<h3></center>
<center><table background='images/random/E-79.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/3-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EG:HMT-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br />
<br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice a <span style='color: #008000;'>Gain of $maxhp Health {Hit} plus $maxmp Magic and $maxtp Travel Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E80.  Random Combo Points HP/MP/TP 10000 - Gain of 1-3 HP/MP/TPs
// ////////////////////////////////////////////////////////////////

$maxcombo3chance = rand(1,10000); // Find Random number between 1 and X.
if ($maxcombo3chance == 1) { // If the random number is 1
	$maxhp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxhp=maxhp+$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxmp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxmp=maxmp+$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxtp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxtp=maxtp+$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.	
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - $maxhp HPs | $maxmp MPs | $maxtp TPs Gained<h3></center>
<center><table background='images/random/E-80.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/3-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EG:HMT-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br />
<br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice a <span style='color: #008000;'>Gain of $maxhp Health {Hit} plus $maxmp Magic and $maxtp Travel Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E81.  Random Combo Points HP/MP/TP 5000 - Loss of 1-2 HP/MP/TPs
// ////////////////////////////////////////////////////////////////


$maxminuscomboc3hance = rand(1,1000); // Find Random number between 1 and X.
if ($maxminuscomboc3hance == 1) { // If the random number is 1
	$maxhp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxhp=maxhp-$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxmp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxmp=maxmp-$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxtp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxtp=maxtp-$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.	
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - - $maxhp HPs | - $maxmp MPs | - $maxtp TPs Lost<h3></center>
<center><table background='images/random/E-81.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/3-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EL:HMT-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxhp Health {Hit} plus $maxmp Magic and $maxtp Travel Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E82.  Random Combo Points HP/MP/TP 10000 - Loss of 1-3 HP/MP/TPs
// ////////////////////////////////////////////////////////////////

$maxminuscomboc3hance = rand(1,10000); // Find Random number between 1 and X.
if ($maxminuscombo3chance == 1) { // If the random number is 1
	$maxhp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxhp=maxhp-$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxmp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxmp=maxmp-$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxtp = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxtp=maxtp-$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.	
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - - $maxhp HPs | - $maxmp MPs | - $maxtp TPs Lost<h3></center>
<center><table background='images/random/E-82.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/3-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EL:HMT-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br /><br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice you have <span style='color: #C8003C;'>Lost $maxhp Health {Hit} plus $maxmp Magic and $maxtp Travel Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E83 - E86 Random Combo Points ATT/DEF/DEX/STR - Gains & Loss
// E83 - E86 Random Combo Points ATT/DEF/DEX/STR - Gains & Loss
// E83 - E86 Random Combo Points ATT/DEF/DEX/STR - Gains & Loss
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E83.  Random Combo Points ATT/DEF/DEX/STR 8000 - Gain of 1-2 ATT/DEF/DEX/STR
// ////////////////////////////////////////////////////////////////

$maxcombo4chance = rand(1,5000); // Find Random number between 1 and X.
if ($maxcombo4chance == 1) { // If the random number is 1
	$attackpower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET attackpower=attackpower+$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$defensepower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET defensepower=defensepower+$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$dexterity = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET dexterity=dexterity+$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.
	$strength = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET strength=strength+$strength WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - $attackpower Att | $defensepower Def | $dexterity Dex | $strength Str Gained<h3></center>
<center><table background='images/random/E-83.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/4-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EG:ADDS-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br />
<br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice a <span style='color: #008000;'>Gain of $attackpower Attack Power,  $defensepower Defense Power, $dexterity Dexterity and $strength Strength Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E84.  Random Combo Points ATT/DEF/DEX/STR 16000 - Gain of 1-3 ATT/DEF/DEX/STR
// ////////////////////////////////////////////////////////////////

$maxcombo4chance = rand(1,16000); // Find Random number between 1 and X.
if ($maxcombo4chance == 1) { // If the random number is 1
	$attackpower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET attackpower=attackpower+$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$defensepower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET defensepower=defensepower+$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$dexterity = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET dexterity=dexterity+$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.
	$strength = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET strength=strength+$strength WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - $attackpower Att | $defensepower Def | $dexterity Dex | $strength Str Gained<h3></center>
<center><table background='images/random/E-84.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/4-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EG:ADDS-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br />
<br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice a <span style='color: #008000;'>Gain of $attackpower Attack Power,  $defensepower Defense Power, $dexterity Dexterity and $strength Strength Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E85.  Random Combo Points ATT/DEF/DEX/STR 8000 - Loss of 1-2 ATT/DEF/DEX/STR
// ////////////////////////////////////////////////////////////////

$maxcombo4chance = rand(1,8000); // Find Random number between 1 and X.
if ($maxcombo4chance == 1) { // If the random number is 1
	$attackpower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET attackpower=attackpower-$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$defensepower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET defensepower=defensepower-$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$dexterity = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET dexterity=dexterity-$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.
	$strength = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET strength=strength-$strength WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - $attackpower Att | $defensepower Def | $dexterity Dex | $strength Str Gained<h3></center>
<center><table background='images/random/E-85.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/4-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EG:ADDS-1/2 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br />
<br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice a <span style='color: #C8003C;'>Loss of $attackpower Attack Power,  $defensepower Defense Power, $dexterity Dexterity and $strength Strength Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E86.  Random Combo Points ATT/DEF/DEX/STR 16000 - Loss of 1-3 ATT/DEF/DEX/STR
// ////////////////////////////////////////////////////////////////

$maxcombo4chance = rand(1,16000); // Find Random number between 1 and X.
if ($maxcombo4chance == 1) { // If the random number is 1
	$attackpower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET attackpower=attackpower-$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$defensepower = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET defensepower=defensepower-$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$dexterity = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET dexterity=dexterity-$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.
	$strength = rand(1,3); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET strength=strength-$strength WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Elixir Found - Elixir Found - $attackpower Att | $defensepower Def | $dexterity Dex | $strength Str Gained<h3></center>
<center><table background='images/random/E-86.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/4-combo.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>While you were exploring the Lost Lands and you stumble upon a full bottle of Elixir Combination Potion. As you give the bottle a closer examination it has <i>&copy; EG:ADDS-1/3 Acme Elixir Corporation</i> engraved on the bottom of it.<br><br>Could this actually be one of the Elixirs you have heard so much about from speaking to the Cities Villagers? You are feeling very lucky finding something so rare and valuable!<br />
<br />Giving caution to the wind, you drink all of the Elixir. You feel a little light headed and then your stomach beings to growl, your chest begins to pound, your arms and legs start shaking. Your muscles expand and contract, then... After a short period of time, you notice a <span style='color: #C8003C;'>Loss of $attackpower Attack Power,  $defensepower Defense Power, $dexterity Dexterity and $strength Strength Points.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E87 - E89 Random Combo Points Copper/Silver/Gold Coins - Gains
// E87 - E89 Random Combo Points Copper/Silver/Gold Coins - Gains
// E87 - E89 Random Combo Points Copper/Silver/Gold Coins - Gains
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E87.  Random Combo Points Copper/Silver/Gold 8000 - Gain of 1-10 Coins
// ////////////////////////////////////////////////////////////////

$maxcombomoneychance1 = rand(1,3000); // Find Random number between 1 and X.
if ($maxcombomoneychance1 == 1) { // If the random number is 1
	$gold = rand(1,10); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(1,10); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(1,10); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
		
$page = "<center><h3 class='title'>Treasure - $gold Gold | $silver Silver | $copper Copper Coins Found<h3></center>
<center><table background='images/random/E-87.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>After a long day of exploring the vast and wonderful, but dangerous Lost Lands you happen on a Treasure Chest with some shiny coins in it. Upon closer inspection you lay your hands on the coins for a <span style='color: #008000;'>Gain of $gold Gold, $silver Silver and $copper Copper Coins.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E88.  Random Combo Points Copper/Silver/Gold 10000 - Gain of 10-25 Coins
// ////////////////////////////////////////////////////////////////

$maxcombomoneychance2 = rand(1,10000); // Find Random number between 1 and X.
if ($maxcombomoneychance2 == 1) { // If the random number is 1
	$gold = rand(10,25); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(10,25); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(10,25); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
		
$page = "<center><h3 class='title'>Treasure - $gold Gold | $silver Silver | $copper Copper Coins Found<h3></center>
<center><table background='images/random/E-88.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>After a long day of exploring the vast and wonderful, but dangerous Lost Lands you happen on a Treasure Chest with some shiny coins in it. Upon closer inspection you lay your hands on the coins for a <span style='color: #008000;'>Gain of $gold Gold, $silver Silver and $copper Copper Coins.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E89.  Random Combo Points Copper/Silver/Gold 20000 - Gain of 25-50 Coins
// ////////////////////////////////////////////////////////////////

$maxcombomoneychance3 = rand(1,20000); // Find Random number between 1 and X.
if ($maxcombomoneychance3 == 1) { // If the random number is 1
	$gold = rand(25,50); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(25,50); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(25,50); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET gold=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
		
$page = "<center><h3 class='title'>Treasure - $gold Gold | $silver Silver | $copper Copper Coins Found<h3></center>
<center><table background='images/random/E-89.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>After a long day of exploring the vast and wonderful, but dangerous Lost Lands you happen on a Treasure Chest with some shiny coins in it. Upon closer inspection you lay your hands on the coins for a <span style='color: #008000;'>Gain of $gold Gold, $silver Silver and $copper Copper Coins.</span></td></tr></table></center>";
	display($page, "You find a Combo Elixir...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E90 - E92 Random Combo Points Copper/Silver/Gold Coins - Loss
// E90 - E92 Random Combo Points Copper/Silver/Gold Coins - Loss
// E90 - E92 Random Combo Points Copper/Silver/Gold Coins - Loss
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E90.  Random Combo Points Copper/Silver/Gold 8000 - Loss of 1-10 Coins
// ////////////////////////////////////////////////////////////////

$maxcombomoneychance4 = rand(1,8000); // Find Random number between 1 and X.
if ($maxcombomoneychance4 == 1) { // If the random number is 1
	$gold = rand(1,10); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(1,10); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(1,10); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
		
$page = "<center><h3 class='title'>Treasure - $gold Gold | $silver Silver | $copper Copper Coins Loss<h3></center>
<center><table background='images/random/E-90.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>After a long day of exploring the vast and wonderful, but dangerous Lost Lands you happen on a Treasure Chest with some shiny coins in it. Upon closer inspection you lay your hands on the coins for a <span style='color: #C8003C;'>Loss of $gold Gold, $silver Silver and $copper Copper Coins.</span></td></tr></table></center>";
	display($page, "You find a Treasure Chest...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E91.  Random Combo Points Copper/Silver/Gold 10000 - Loss of 10-25 Coins
// ////////////////////////////////////////////////////////////////

$maxcombomoneychance5 = rand(1,10000); // Find Random number between 1 and X.
if ($maxcombomoneychance5 == 1) { // If the random number is 1
	$gold = rand(10,25); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(10,25); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(10,25); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
		
$page = "<center><h3 class='title'>Treasure - $gold Gold | $silver Silver | $copper Copper Coins Loss<h3></center>
<center><table background='images/random/E-91.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycombominus.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>After a long day of exploring the vast and wonderful, but dangerous Lost Lands you happen on a Treasure Chest that seems to have a strange glow to it. Upon closer inspection you lay your hands on the Chest and proof! <span style='color: #C8003C;'>$gold Gold, $silver Silver and $copper Copper Coins disappear from your coin purse.</span></td></tr></table></center>";
	display($page, "You find a Treasure Chest...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E92.  Random Combo Points Copper/Silver/Gold 20000 - Loss of 25-50 Coins
// ////////////////////////////////////////////////////////////////

$maxcombomoneychance6 = rand(1,20000); // Find Random number between 1 and X.
if ($maxcombomoneychance6 == 1) { // If the random number is 1
	$gold = rand(25,50); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(25,50); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(25,50); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
		
$page = "<center><h3 class='title'>Treasure - $gold Gold | $silver Silver | $copper Copper Coins Loss<h3></center>
<center><table background='images/random/E-92.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycombominus.png' height='150' width='300' title='Defense Power Points Elixir' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>After a long day of exploring the vast and wonderful, but dangerous Lost Lands you happen on a Treasure Chest that seems to have a strange glow to it. Upon closer inspection you lay your hands on the Chest and proof! <span style='color: #C8003C;'>$gold Gold, $silver Silver and $copper Copper Coins disappear from your coin purse.</span></td></tr></table></center>";
	display($page, "You find a Treasure Chest...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// E93 - E94 Random Full Combo Points - Gain  & Loss
// E93 - E94 Random Full Combo Points - Gain  & Loss
// E93 - E94 Random Full Combo Points - Gain  & Loss
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E93.  Random Full Combo 8000 - Gain of 1-10 Coins - Gain of 1-2 Points - Gain of 1-2 Abilities
// ////////////////////////////////////////////////////////////////

$maxcomboallchance1 = rand(1,5000); // Find Random number between 1 and X.
if ($maxcomboallchance1 == 1) { // If the random number is 1

	$maxhp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxhp=maxhp+$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxmp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxmp=maxmp+$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxtp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxtp=maxtp+$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.	
	$attackpower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET attackpower=attackpower+$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$defensepower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET defensepower=defensepower+$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$dexterity = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET dexterity=dexterity+$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.
	$strength = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET strength=strength+$strength WHERE id=".$userrow["id"], "users"); // Update the variable.
	$gold = rand(1,10); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold+$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(1,10); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver+$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(1,10); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET copper=copper+$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.

$page = "<center><h3 class='title'>All Combo Gain - Coins | Points | Abilities<h3></center>
<center><table background='images/random/E-93.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/comboallplus.gif' height='150' width='300' title='All Combo Gain' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>Just walking along minding your surroundings when a Pulsing Glowing Blue Ball appear before you. The Blue Ball displays some unknown symbols in front of you which you do not understand. Suddenly you fell better than you have ever felt. Then you realize you are gaining <span style='color: #008000;'>$attackpower Attack,  $defensepower Defense, $dexterity Dexterity and $strength Strength</span> to your Abilities.
<br><br>Sitting and wondering how this could have happened. You notice the Blue Ball is still spinning above you. Then it feels like your coin purse is getting a little heavier. Upon closer inspection of your purse, you have gained <span style='color: #008000;'>$gold Gold, $silver Silver and $copper Copper Coins</span>. Now what else can happen?
<br><br>You soon find out! As your <span style='color: #008000;'>$maxhp Health {Hit} plus $maxmp Magic and $maxtp Travel Points.</span> increase!
</td></tr></table></center>";
	display($page, "You find a Blue Glowing Ball...");
	die();
}

// ////////////////////////////////////////////////////////////////
// E94.  Random Full Combo 8000 - Loss of 1-10 Coins - Loss of 1-2 Points - Loss of 1-2 Abilities
// ////////////////////////////////////////////////////////////////

$maxcomboallchance2 = rand(1,8000); // Find Random number between 1 and X.
if ($maxcomboallchance2 == 1) { // If the random number is 1

	$maxhp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxhp=maxhp-$maxhp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxmp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxmp=maxmp-$maxmp WHERE id=".$userrow["id"], "users"); // Update the variable.
	$maxtp = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)	
	doquery("UPDATE {{table}} SET maxtp=maxtp-$maxtp WHERE id=".$userrow["id"], "users"); // Update the variable.	
	$attackpower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET attackpower=attackpower-$attackpower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$defensepower = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET defensepower=defensepower-$defensepower WHERE id=".$userrow["id"], "users"); // Update the variable.
	$dexterity = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET dexterity=dexterity-$dexterity WHERE id=".$userrow["id"], "users"); // Update the variable.
	$strength = rand(1,2); // How many you can get. (rand(1,X); with X being how many you can get max.)
	doquery("UPDATE {{table}} SET strength=strength-$strength WHERE id=".$userrow["id"], "users"); // Update the variable.
	$gold = rand(1,10); // Select a random number between 1 and X Gold Coins.
	doquery("UPDATE {{table}} SET gold=gold-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	$silver = rand(1,10); // Select a random number between 1 and X Silver Coins.
	doquery("UPDATE {{table}} SET silver=silver-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	$copper = rand(1,10); // Select a random number between 1 and X Copper Coins.
	doquery("UPDATE {{table}} SET copper=copper-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.

$page = "<center><h3 class='title'>All Combo Loss - Coins | Points | Abilities<h3></center>
<center><table background='images/random/E-94.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/comboallminus.gif' height='150' width='300' title='All Combo Loss' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>Just walking along minding your surroundings when a Pulsing Glowing Blue Ball appear before you. The Blue Ball displays some unknown symbols in front of you which you do not understand. Suddenly you feel weak and then you realize your losing <span style='color: #C8003C;'>$attackpower Attack,  $defensepower Defense, $dexterity Dexterity and $strength Strength</span> from your Abilities.
<br><br>After resting for a moment you feel better, but not to your full self. The Blue Ball is still spinning above you. Then it feels like your coin purse is getting a little lighter. Upon closer inspection of the purse you have lost <span style='color: #C8003C;'>$gold Gold, $silver Silver and $copper Copper Coins</span> from your coin purse. Now what else can happen?
<br><br>You soon find out! As you lose <span style='color: #C8003C;'>$maxhp Health {Hit} plus $maxmp Magic and $maxtp Travel Points.</span>
</td></tr></table></center>";
	display($page, "You find a Blue Glowing Ball...");
	die();
}

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END Random Full Combo Points - Gain  & Loss
// END Random Full Combo Points - Gain  & Loss
// END Random Full Combo Points - Gain  & Loss
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN RANDOM BANK Dividend
// BEGIN RANDOM BANK Dividend
// BEGIN RANDOM BANK Dividend
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// E96.  Random Copper Interest 900 - Gain 10 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance1 = rand(1,900); // Find random number between 1 and X.
if ($interrestchance1 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET copperbank=copperbank+10 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Copper Banks<h3></center>
<center><table background='images/random/E-96.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>10 Coins</span> dividend on your Copper Bank Account. The Bank declared the dividend on all Copper Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you copper bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E97.  Random Silver Interest 900 - Gain 10 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance2 = rand(1,900); // Find random number between 1 and X.
if ($interrestchance2 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET silverbank=silverbank+10 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Silver Banks<h3></center>
<center><table background='images/random/E-97.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>10 Coins</span> dividend on your Silver Bank Account. The Bank declared the dividend on all Silver Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you silver bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E98.  Random Gold Interest 900 - Gain 10 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance3 = rand(1,900); // Find random number between 1 and X.
if ($interrestchance3 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET bank=bank+10 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Gold Banks<h3></center>
<center><table background='images/random/E-98.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>10 Coins</span> dividend on your Gold Bank Account. The Bank declared the dividend on all Gold Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you gold bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E99.  Random Copper Interest 2500 - Gain 25 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance1 = rand(1,2500); // Find random number between 1 and X.
if ($interrestchance1 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET copperbank=copperbank+25 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Copper Banks<h3></center>
<center><table background='images/random/E-99.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>25 Coins</span> dividend on your Copper Bank Account. The Bank declared the dividend on all Copper Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you copper bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E100.  Random Silver Interest 2500 - Gain 25 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance2 = rand(1,2500); // Find random number between 1 and X.
if ($interrestchance2 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET silverbank=silverbank+25 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Silver Banks<h3></center>
<center><table background='images/random/E-100.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>25 Coins</span> dividend on your Silver Bank Account. The Bank declared the dividend on all Silver Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you silver bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E101.  Random Gold Interest 2500 - Gain 25 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance3 = rand(1,2500); // Find random number between 1 and X.
if ($interrestchance3 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET bank=bank+25 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Gold Banks<h3></center>
<center><table background='images/random/E-101.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>25 Coins</span> dividend on your Gold Bank Account. The Bank declared the dividend on all Gold Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you gold bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E102.  Random Copper Interest 7500 - Gain 50 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance1 = rand(1,7500); // Find random number between 1 and X.
if ($interrestchance1 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET copperbank=copperbank+50 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Copper Banks<h3></center>
<center><table background='images/random/E-102.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>50 Coins</span> dividend on your Copper Bank Account. The Bank declared the dividend on all Copper Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you copper bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E103.  Random Silver Interest 7500 - Gain 50 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance2 = rand(1,7500); // Find random number between 1 and X.
if ($interrestchance2 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET silverbank=silverbank+50 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Silver Banks<h3></center>
<center><table background='images/random/E-103.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>50 Coins</span> dividend on your Silver Bank Account. The Bank declared the dividend on all Silver Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you silver bank account.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E104.  Random Gold Interest 7500 - Gain 50 Coin Dividend
// ////////////////////////////////////////////////////////////////
	
 	$interrestchance3 = rand(1,7500); // Find random number between 1 and X.
if ($interrestchance3 == 1) { // If the random number is 1.	
	doquery("UPDATE {{table}} SET bank=bank+50 WHERE id=".$userrow["id"], "users"); // Update the variable.
	
$page = "<center><h3 class='title'>Dividend Declared for Gold Banks<h3></center>
<center><table background='images/random/E-104.png' width='300' height='150' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'>
<tr><td><img src='images/random/moneycomboplus.png' height='150' width='300' title='Dividend Declared' border='4'/></td></tr></table>
<table width='300' height='150' border='0' cellpadding='0' cellspacing='0' style='border-width: 0px;'>
<tr valign='top'><td><br>You have gained a <span style='color: #008000;'>50 Coins</span> dividend on your Gold Bank Account. The Bank declared the dividend on all Gold Accounts as they continue to be rated favorably.</td></tr></table></center>";
	display($page, "You gain interest on you gold bank account.");
	die();
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END RANDOM Dividend
// END RANDOM Dividend
// END RANDOM Dividend
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN ROBB BANK GOLD
// BEGIN ROBB BANK GOLD
// BEGIN ROBB BANK GOLD
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// E105.  Random Robb Bank-2 UpTo 10-Gold Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank2 = rand(1,500); // Find random number between 1 and X.
	if ($robbbank2 == 1) { // If the random number is 1.
	$gold = rand(1,10); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// E106.  Random Robb Bank-3 UpTo 25-Gold Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank3 = rand(1,1000); // Find random number between 1 and X.
	if ($robbbank3 == 1) { // If the random number is 1.
	$gold = rand(1,25);  // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E107.  Random Robb Bank-4 UpTo 50-Gold Coins
// ////////////////////////////////////////////////////////////////	
		
	$robbbank4 = rand(1,2000); // Find random number between 1 and X.
	if ($robbbank4 == 1) { // If the random number is 1.
	$gold = rand(1,50); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E108.  Random Robb Bank-5 UpTo 100-Gold Coins
// ////////////////////////////////////////////////////////////////	
		
		
	$robbbank5 = rand(1,4000); // Find random number between 1 and X.
	if ($robbbank5 == 1) { // If the random number is 1.
	$gold = rand(1,100); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E108.  Random Robb Bank-6 UpTo 150-Gold Coins
// ////////////////////////////////////////////////////////////////
		
	$robbbank6 = rand(1,6000); // Find random number between 1 and X.
	if ($robbbank6 == 1) { // If the random number is 1.
	$gold = rand(1,150); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E109.  Random Robb Bank-7 UpTo 300-Gold Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank7 = rand(1,12000); // Find random number between 1 and X.
	if ($robbbank7 == 1) { // If the random number is 1.
	$gold = rand(1,300); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// E110.  Random Robb Bank-8 UpTo 600-Gold Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank8 = rand(1,25000); // Find random number between 1 and X.
	if ($robbbank8 == 1) { // If the random number is 1.
	$gold = rand(1,600); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET bank=bank-$gold WHERE id=".$userrow["id"], "users"); // Update the gold variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Gold Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$gold Gold Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Gold Coins.png' width='35' height='35' alt='Gold Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END ROBB BANK GOLD
// END ROBB BANK GOLD
// END ROBB BANK GOLD
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN ROBB BANK SILVER COINS
// BEGIN ROBB BANK SILVER COINS
// BEGIN ROBB BANK SILVER COINS
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
	

// ////////////////////////////////////////////////////////////////
// E111.  Random Robb Bank-9 UpTo 10-Silver Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank9 = rand(1,500); // Find random number between 1 and X.
	if ($robbbank9 == 1) { // If the random number is 1.
	$silver = rand(1,10); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// E112.  Random Robb Bank-10 UpTo 25-Silver Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank10 = rand(1,1000); // Find random number between 1 and X.
	if ($robbbank10 == 1) { // If the random number is 1.
	$silver = rand(1,25);  // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E113.  Random Robb Bank-11 UpTo 50-Silver Coins
// ////////////////////////////////////////////////////////////////	
		
	$robbbank11 = rand(1,2000); // Find random number between 1 and X.
	if ($robbbank11 == 1) { // If the random number is 1.
	$silver = rand(1,50); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E114.  Random Robb Bank-12 UpTo 100-Silver Coins
// ////////////////////////////////////////////////////////////////	
		
		
	$robbbank12 = rand(1,4000); // Find random number between 1 and X.
	if ($robbbank12 == 1) { // If the random number is 1.
	$silver = rand(1,100); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E115.  Random Robb Bank-13 UpTo 150-Silver Coins
// ////////////////////////////////////////////////////////////////
		
	$robbbank13 = rand(1,6000); // Find random number between 1 and X.
	if ($robbbank13 == 1) { // If the random number is 1.
	$silver = rand(1,150); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E116.  Random Robb Bank-14 UpTo 300-Silver Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank14 = rand(1,12000); // Find random number between 1 and X.
	if ($robbbank14 == 1) { // If the random number is 1.
	$silver = rand(1,300); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// E117.  Random Robb Bank-15 UpTo 600-Silver Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank15 = rand(1,25000); // Find random number between 1 and X.
	if ($robbbank15 == 1) { // If the random number is 1.
	$silver = rand(1,600); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET silverbank=silverbank-$silver WHERE id=".$userrow["id"], "users"); // Update the silver variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Silver Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$silver Silver Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Silver Coins.png' width='35' height='35' alt='Silver Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END ROBB BANK SILVER
// END ROBB BANK SILVER
// END ROBB BANK SILVER
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////



// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN ROBB BANK COPPER COINS
// BEGIN ROBB BANK COPPER COINS
// BEGIN ROBB BANK COPPER COINS
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// Lost #C8003C          Found #008000
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
	


// ////////////////////////////////////////////////////////////////
// E118.  Random Robb Bank-16 UpTo 10-Copper Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank16 = rand(1,500); // Find random number between 1 and X.
	if ($robbbank16 == 1) { // If the random number is 1.
	$copper = rand(1,10); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='55' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// E119.  Random Robb Bank-17 UpTo 25-Copper Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank17 = rand(1,1000); // Find random number between 1 and X.
	if ($robbbank17 == 1) { // If the random number is 1.
	$copper = rand(1,25);  // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='55' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E120.  Random Robb Bank-18 UpTo 50-Copper Coins
// ////////////////////////////////////////////////////////////////	
		
	$robbbank18 = rand(1,2000); // Find random number between 1 and X.
	if ($robbbank18 == 1) { // If the random number is 1.
	$copper = rand(1,50); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='55' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E121.  Random Robb Bank-19 UpTo 100-Copper Coins
// ////////////////////////////////////////////////////////////////	
		
		
	$robbbank19 = rand(1,4000); // Find random number between 1 and X.
	if ($robbbank19 == 1) { // If the random number is 1.
	$copper = rand(1,100); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='55' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E122.  Random Robb Bank-20 UpTo 150-Copper Coins
// ////////////////////////////////////////////////////////////////
		
	$robbbank20 = rand(1,6000); // Find random number between 1 and X.
	if ($robbbank20 == 1) { // If the random number is 1.
	$copper = rand(1,150); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='55' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}

// ////////////////////////////////////////////////////////////////
// E123.  Random Robb Bank-21 UpTo 300-Copper Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank21 = rand(1,12000); // Find random number between 1 and X.
	if ($robbbank21 == 1) { // If the random number is 1.
	$copper = rand(1,300); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='5' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// E124.  Random Robb Bank-22 UpTo 600-Copper Coins
// ////////////////////////////////////////////////////////////////
		
		
	$robbbank22 = rand(1,25000); // Find random number between 1 and X.
	if ($robbbank22 == 1) { // If the random number is 1.
	$copper = rand(1,600); // Select a random number between X which is the amount the user will lose.
	
	doquery("UPDATE {{table}} SET copperbank=copperbank-$copper WHERE id=".$userrow["id"], "users"); // Update the copper variable.
	doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // Update position.
	$page = "<center><h3 class='title'>Bank Robbed - Bandits Steal Copper Coins<h3></center><center><table border='1' width='60%'><tr>
	<td valign='top'><img src='images/items/falcon.png' alt='Letter Falcon'/></td><td align='justify' valign='top'>A falcon Messenger Bird, soars overhead and drops you a official bank note. The Note explains that Bank Robbers stole <b><font color='#C8003C'>$copper Copper Coins</font></b> from your Bank Account.</td>
	<td valign='top'><img src='images/drops/Copper Coins.png' width='55' height='55' alt='Copper Coins' border='0'></td></tr></table></center>";
	display($page, "You have learned robbers stole money from your Bank.");
	die();
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END ROBB BANK COPPER
// END ROBB BANK COPPER
// END ROBB BANK COPPER
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////



// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN FIGHTING CHANCE
// BEGIN FIGHTING CHANCE
// BEGIN FIGHTING CHANCE
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
	
	
	$chancetofight = rand(1,3); // Find random number between 1 and 5
    if ($chancetofight == 1) { 
        $action = "currentaction='Fighting', currentfight='1',";
    } else {
        $action = "currentaction='Exploring',";
    }	
	 
    $updatequery = doquery("UPDATE {{table}} SET $action latitude='$latitude', longitude='$longitude', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    header("Location: index.php");
    }

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END FIGHTING CHANCE	
// END FIGHTING CHANCE
// END FIGHTING CHANCE
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN TRAINING CAMP A
// BEGIN TRAINING CAMP A
// BEGIN TRAINING CAMP A
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$trainchance4 = rand(1,2000); // 1 in 1000 chance to find Campfire and Safety
if ($trainchance4 == 1) {
	
	global $userrow, $controlrow;
	 
	$exp = rand(500,1000); // generate experience
	$exp1 = number_format($exp); // make number look pretty with a comma
	if ($userrow["experience"] + $exp < 101202303) { $newexp = $userrow["experience"] + $exp; $warnexp = ""; // check if user has amxed out on experience
	} else { $newexp = $userrow["experience"]; $exp = 0; $warnexp = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table><br /><br /><br /><br />
			<Blockquote>You have maxed out your experience points.</Blockquote>"; } // warn user if they have maxed out on exp
	
	$levelquery = doquery("SELECT * FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels"); // grab next level info
	if (mysql_num_rows($levelquery) == 1) { $levelrow = mysql_fetch_array($levelquery); } // set next level info
	
	if ($userrow["level"] < 300) { // if user hasnt reached max level
		if ($newexp >= $levelrow[$userrow["charclass"]."_exp"]) { // if user has enough exp to level up
		$newhp = $userrow["maxhp"] + $levelrow[$userrow["charclass"]."_hp"]; // set new hp
		$newmp = $userrow["maxmp"] + $levelrow[$userrow["charclass"]."_mp"]; // set new mp
		$newtp = $userrow["maxtp"] + $levelrow[$userrow["charclass"]."_tp"]; // set new tp
		$newstrength = $userrow["strength"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdexterity = $userrow["dexterity"] + $levelrow[$userrow["charclass"]."_dexterity"]; // set new dex
		$newattack = $userrow["attackpower"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdefense = $userrow["defensepower"] + $levelrow[$userrow["charclass"]."_dexterity"]; // set new defense
		$newlevel = $levelrow["id"]; // set new level number
			
// START OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR TRAINING WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,5); // THIS # IS ADDED TO TACTICAL STAT FOR TRAINING LEVEL UP
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
			
			if ($levelrow[$userrow["charclass"]."_spells"] != 0) { // if user has learned a new spell
				$userspells = $userrow["spells"] . ",".$levelrow[$userrow["charclass"]."_spells"]; // grab new spell
				$newspell = "spells='$userspells',"; // set new spells
				$spelltext = "You have learned a new spell.<br />"; // inform user of new spell
			} else { $spelltext = ""; $newspell=""; } // no new spells learned
			
			
// START OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR Campfire and Safety WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,5); // THIS # IS ADDED TO TACTICAL STAT FOR Campfire and Safety
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON


			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampA.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br />You were walking threw the vast lands of the Lost Cities and came upon<br />a Campfire with a small group of Travels, who<br />offered you food and safety for the night.<br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />
			You have gained a level!<br /><br />
			You gain<b> ".$levelrow[$userrow["charclass"]."_hp"]." hit points,
			 ".$levelrow[$userrow["charclass"]."_mp"]." magic points,<br />
			 ".$levelrow[$userrow["charclass"]."_tp"]." travel points,
			 ".$levelrow[$userrow["charclass"]."_strength"]." strength,<br />
			 and ".$levelrow[$userrow["charclass"]."_dexterity"]." dexterity.
			<br />$spelltext</b><br />Continue <a href=\"index.php\">Exploring</a></td></tr></table></div></center></Blockquote></Blockquote>";
			$title = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table><div align='center'><table width='800' height ='800' background='images/background/map/trainingcampA.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br /><br /><br /><br /><br />Coagulations, a restful nights sleep has been refreshing.<br />You can Level Up!</td></tr></table></div></center></Blockquote></Blockquote>";
		} else { // no level up
			$newhp = $userrow["maxhp"]; // set hp
			$newmp = $userrow["maxmp"]; // set mp
			$newtp = $userrow["maxtp"]; // set tp
			$newstrength = $userrow["strength"]; // set strength
			$newdexterity = $userrow["dexterity"]; // set dex
			$newattack = $userrow["attackpower"]; // set attack
			$newdefense = $userrow["defensepower"]; // set defense
			$newlevel = $userrow["level"]; // set level
			$newspell = ""; // set spells
			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampA.jpg'><tr><td><center><Blockquote><Blockquote><br /><br /><br /><br />You were walking threw the vast lands of the Lost Cities and came upon<br />a Campfire with a small group of Travels, who<br />offered you food and safety for the night.<br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />";
			$page .= "Continue Exploring using direction buttons.<br /><br /></td></tr></table></div></center></Blockquote></Blockquote>";
		}

		$title = "Campfire";
	}

	$updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring',level='$newlevel',maxhp='$newhp',maxmp='$newmp',maxtp='$newtp',strength='$newstrength',
	dexterity='$newdexterity',attackpower='$newattack',defensepower='$newdefense', $newspell experience='$newexp'
	WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // update database
	
	display($page, $title); // display page
	
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END TRAINING CAMP A
// END TRAINING CAMP A
// END TRAINING CAMP A
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN TRAINING CAMP B
// BEGIN TRAINING CAMP B
// BEGIN TRAINING CAMP B
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$trainchance2 = rand(1,3000); // 1 in 1000 chance to find Campfire and Safety
if ($trainchance2 == 1) {
	
	global $userrow, $controlrow;
	 
	$exp = rand(1000,1500); // generate experience
	$exp1 = number_format($exp); // make number look pretty with a comma
	if ($userrow["experience"] + $exp < 101202303) { $newexp = $userrow["experience"] + $exp; $warnexp = ""; // check if user has amxed out on experience
	} else { $newexp = $userrow["experience"]; $exp = 0; $warnexp = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Bravo Discovered<h3></center></td></tr></table><br /><br /><br /><br />
			<Blockquote>You have maxed out your experience points.</Blockquote>"; } // warn user if they have maxed out on exp
	
	$levelquery = doquery("SELECT * FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels"); // grab next level info
	if (mysql_num_rows($levelquery) == 1) { $levelrow = mysql_fetch_array($levelquery); } // set next level info
	
	if ($userrow["level"] < 300) { // if user hasnt reached max level
		if ($newexp >= $levelrow[$userrow["charclass"]."_exp"]) { // if user has enough exp to level up
		$newhp = $userrow["maxhp"] + $levelrow[$userrow["charclass"]."_hp"]; // set new hp
		$newmp = $userrow["maxmp"] + $levelrow[$userrow["charclass"]."_mp"]; // set new mp
		$newtp = $userrow["maxtp"] + $levelrow[$userrow["charclass"]."_tp"]; // set new tp
		$newstrength = $userrow["strength"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdexterity = $userrow["dexterity"] + 				$levelrow[$userrow["charclass"]."_dexterity"]; // set new dex
		$newattack = $userrow["attackpower"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdefense = $userrow["defensepower"] + 			$levelrow[$userrow["charclass"]."_dexterity"]; // set new defense
		$newlevel = $levelrow["id"]; // set new level number
			
// START OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR TRAINING WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,5); // THIS # IS ADDED TO TACTICAL STAT FOR TRAINING LEVEL UP
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
			
			if ($levelrow[$userrow["charclass"]."_spells"] != 0) { // if user has learned a new spell
				$userspells = $userrow["spells"] . ",".$levelrow[$userrow["charclass"]."_spells"]; // grab new spell
				$newspell = "spells='$userspells',"; // set new spells
				$spelltext = "You have learned a new spell.<br />"; // inform user of new spell
			} else { $spelltext = ""; $newspell=""; } // no new spells learned
			
			
// START OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR Campfire and Safety WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,5); // THIS # IS ADDED TO TACTICAL STAT FOR Campfire and Safety
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON


			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Bravo Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampB.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br />You were walking along the road and found<br />a Campfire with a small group of Nomads, who<br />offered you food and safety for the night.<br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />
			You have gained a level!<br /><br />
			You gain<b> ".$levelrow[$userrow["charclass"]."_hp"]." hit points,
			 ".$levelrow[$userrow["charclass"]."_mp"]." magic points,<br />
			 ".$levelrow[$userrow["charclass"]."_tp"]." travel points,
			 ".$levelrow[$userrow["charclass"]."_strength"]." strength,<br />
			 and ".$levelrow[$userrow["charclass"]."_dexterity"]." dexterity.
			<br />$spelltext</b><br />Continue <a href=\"index.php\">Exploring</a></td></tr></table></div></center></Blockquote></Blockquote>";
			$title = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Bravo Discovered<h3></center></td></tr></table><div align='center'><table width='800' height ='800' background='images/background/map/trainingcampB.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br /><br /><br /><br /><br />Coagulations your long overdue rest paid off.<br />You can Level Up!</td></tr></table></div></center></Blockquote></Blockquote>";
		} else { // no level up
			$newhp = $userrow["maxhp"]; // set hp
			$newmp = $userrow["maxmp"]; // set mp
			$newtp = $userrow["maxtp"]; // set tp
			$newstrength = $userrow["strength"]; // set strength
			$newdexterity = $userrow["dexterity"]; // set dex
			$newattack = $userrow["attackpower"]; // set attack
			$newdefense = $userrow["defensepower"]; // set defense
			$newlevel = $userrow["level"]; // set level
			$newspell = ""; // set spells
			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Bravo Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampB.jpg'><tr><td><center><Blockquote><Blockquote><br /><br /><br /><br />You were walking through the woods<br />and found a Campfire with a small group of Nomads, who<br />offered you food and safety for the night.<br /><br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />";
			$page .= "Continue Exploring using direction buttons.<br /><br /></td></tr></table></div></center></Blockquote></Blockquote>";
		}

		$title = "Campfire";
	}

	$updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring',level='$newlevel',maxhp='$newhp',maxmp='$newmp',maxtp='$newtp',strength='$newstrength',
	dexterity='$newdexterity',attackpower='$newattack',defensepower='$newdefense', $newspell experience='$newexp'
	WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // update database
	
	display($page, $title); // display page
	
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END TRAINING CAMP B
// END TRAINING CAMP B
// END TRAINING CAMP B
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN TRAINING CAMP C
// BEGIN TRAINING CAMP C
// BEGIN TRAINING CAMP C
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////

$trainchance = rand(1,5000); // 1 in 5000 chance to find Campfire and Safety
if ($trainchance == 1) {
	
	global $userrow, $controlrow;
	 
	$exp = rand(1500,2000); // generate experience
	$exp1 = number_format($exp); // make number look pretty with a comma
	if ($userrow["experience"] + $exp < 101202303) { $newexp = $userrow["experience"] + $exp; $warnexp = ""; // check if user has amxed out on experience
	} else { $newexp = $userrow["experience"]; $exp = 0; $warnexp = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Charlie Discovered<h3></center></td></tr></table><br /><br /><br /><br />
			<Blockquote>You have maxed out your experience points.</Blockquote>"; } // warn user if they have maxed out on exp
	
	$levelquery = doquery("SELECT * FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels"); // grab next level info
	if (mysql_num_rows($levelquery) == 1) { $levelrow = mysql_fetch_array($levelquery); } // set next level info
	
	if ($userrow["level"] < 300) { // if user hasnt reached max level
		if ($newexp >= $levelrow[$userrow["charclass"]."_exp"]) { // if user has enough exp to level up
		$newhp = $userrow["maxhp"] + $levelrow[$userrow["charclass"]."_hp"]; // set new hp
		$newmp = $userrow["maxmp"] + $levelrow[$userrow["charclass"]."_mp"]; // set new mp
		$newtp = $userrow["maxtp"] + $levelrow[$userrow["charclass"]."_tp"]; // set new tp
		$newstrength = $userrow["strength"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdexterity = $userrow["dexterity"] + $levelrow[$userrow["charclass"]."_dexterity"]; // set new dex
		$newattack = $userrow["attackpower"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdefense = $userrow["defensepower"] + $levelrow[$userrow["charclass"]."_dexterity"]; // set new defense
		$newlevel = $levelrow["id"]; // set new level number
			
// START OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR TRAINING WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,6); // THIS # IS ADDED TO TACTICAL STAT FOR TRAINING LEVEL UP
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
			
			if ($levelrow[$userrow["charclass"]."_spells"] != 0) { // if user has learned a new spell
				$userspells = $userrow["spells"] . ",".$levelrow[$userrow["charclass"]."_spells"]; // grab new spell
				$newspell = "spells='$userspells',"; // set new spells
				$spelltext = "You have learned a new spell.<br />"; // inform user of new spell
			} else { $spelltext = ""; $newspell=""; } // no new spells learned
			
			
// START OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR Campfire and Safety WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,6); // THIS # IS ADDED TO TACTICAL STAT FOR Campfire and Safety
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON


			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Charlie Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampC.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br />You were walking along the road and found<br />a Campfire with a small group of Nomads, who<br />offered you food and safety for the night.<br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />
			You have gained a level!<br /><br />
			You gain ".$levelrow[$userrow["charclass"]."_hp"]." hit points,
			 ".$levelrow[$userrow["charclass"]."_mp"]." magic points,<br />
			 ".$levelrow[$userrow["charclass"]."_tp"]." travel points,
			 ".$levelrow[$userrow["charclass"]."_strength"]." strength,<br />
			 and ".$levelrow[$userrow["charclass"]."_dexterity"]." dexterity.
			<br />$spelltext<br />Continue <a href=\"index.php\">Exploring</a></td></tr></table></div></center></Blockquote></Blockquote>";
			$title = "<table width='100%'><tr><td><center><h3 class='title'>Exploring - Found a Campfire A<h3></center></td></tr></table><div align='center'><table width='800' height ='800' background='images/background/map/trainingcampC.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br /><br /><br /><br /><br />Coagulations your long overdue rest paid off.<br />You can Level Up!</td></tr></table></div></center></Blockquote></Blockquote>";
		} else { // no level up
			$newhp = $userrow["maxhp"]; // set hp
			$newmp = $userrow["maxmp"]; // set mp
			$newtp = $userrow["maxtp"]; // set tp
			$newstrength = $userrow["strength"]; // set strength
			$newdexterity = $userrow["dexterity"]; // set dex
			$newattack = $userrow["attackpower"]; // set attack
			$newdefense = $userrow["defensepower"]; // set defense
			$newlevel = $userrow["level"]; // set level
			$newspell = ""; // set spells
			$page = "<div align='center'><table width='100%'><tr><td><center><h3 class='title'>Training Camp Charlie Discovered<h3></center></td></tr></table>
<table width='800' height ='800' background='images/background/map/trainingcampC.jpg'><tr><td><center><Blockquote><Blockquote><br /><br /><br /><br />You were walking through the woods<br />and found a Campfire with a small group of Nomads, who<br />offered you food and safety for the night.<br /><br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />";
			$page .= "Continue Exploring using direction buttons.<br /><br /></td></tr></table></div></center></Blockquote></Blockquote>";
		}

		$title = "Campfire";
	}

	$updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring',level='$newlevel',maxhp='$newhp',maxmp='$newmp',maxtp='$newtp',strength='$newstrength',
	dexterity='$newdexterity',attackpower='$newattack',defensepower='$newdefense', $newspell experience='$newexp'
	WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // update database
	
	display($page, $title); // display page
	
}


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// END TRAINING CAMP C
// END TRAINING CAMP C
// END TRAINING CAMP C
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////
// BEGIN SKELETON RIDDLE RANDOM
// BEGIN SKELETON RIDDLE RANDOM
// BEGIN SKELETON RIDDLE RANDOM
// ////////////////////////////////////////////////////////////////
// ////////////////////////////////////////////////////////////////


// ////////////////////////////////////////////////////////////////
// START IMAGE 002 & 003 & 004
// ////////////////////////////////////////////////////////////////

if(isset($_POST['jah'])) {
     $vorm="<table width=100%><tr><td><center><h3 class=title>Exploring - Skeletons and Arrows Clue</h3></center></td></tr></table>

<center><table width=75%><tr><td>
<blockquote><blockquote><center><img src='images/background/magic/skeleton-002.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Skeletons and Arrows Clue' title='Exploring - Skeletons and Arrows Clue'></center>

<br>&nbsp;&nbsp;The skeletons seem to be arranged in a strange way. Well at least in a way a dying or recently killed person would not be laid out. It's to Hot in this Blazing Fire of a Sun to think straight.

<br><br><center><img src='images/background/magic/skeleton-003.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Resting from the Beating Sun' title='Exploring - Resting from the Beating Sun'></center>

<br>&nbsp;&nbsp;The Noon day Sun is like a chisel chipping away at you, you feel like your going to pass out. Before you do, you lean against a near by Rock and pass out into a long sleep. When you awake, you grab something to eat and wait for and hour or more for the Sun to fall to the west.

<br /><br /><center><img src='images/background/magic/skeleton-004.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Clue is Found' title='Exploring - Clue is Found'></center>

<br>&nbsp;&nbsp;As the last shivers of light start to disappear into the night. You stand up to relieve yourself and notice a Big White Arrow pointing down! You take notice of your surrounds, and spot other Rocks with Big White Arrows, all pointing to this Rock in front of you. It's time to decide if you want to spend a day or two of strength and limited supplies for digging? But what are you digging for? and how far do you have to dig?
</td></tr></table>

<br><br><br><center><form method=POST><input type=submit name=jah2 value=Yes class=myButton2>&nbsp;&nbsp;&nbsp;<input type=submit name=ei value=No class=myButton2></form></center></blockquote></blockquote><br><br>";
  display($vorm, "Skeletons!"); die();
   }
  elseif(isset($_POST['jah2'])) {
    doquery("UPDATE {{table}} SET kirst='1' WHERE id=".$userrow["id"], "users");
    $vorm="<table width=100%><tr><td><center><h3 class=title>Exploring - Digging for Something</h3></center></td></tr></table>

<center><table width='75%'><tr><td>
<blockquote><blockquote><br /><center><img src='images/background/magic/skeleton-005.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Digging for Something' title='Exploring - Digging for Something'></center>

<br>&nbsp;&nbsp;You have been digging for almost two days now. Your Supplies are getting low, water and food will only last for a couple more days. You question your own wisdom in taking on this vast project. When you could have arrived in the next town by now. Putting your day dreaming aside you turn your attention back to digging.

<br><br><center><img src='images/background/magic/skeleton-006.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - The Clue Explain' title='Exploring - The Clue Explain'></center>

<br>&nbsp;&nbsp;You hit a hard object. Getting on your knees, working with both of your hands, you begin to finish digging out the Object. Yes, it's a very Old and Large Worn Box. You open the Large Box expecting Gold, Jewels and rare Stones. Only to be disappointed to find a  Smaller Chest a leather bag containing old Bones (Just what you need) and a large piece of rolled hard Leather.

<br /><br />You try to open the lid on the Small Chest and it doesn't open, no matter how hard you try. Grabbing your pick axe you master all your strength for a noise deafening bang on the Chest. Nothing, not even a scratch, no mark of any kind! You sit down and examine the small chest more closely. It seem to be of some unknown metal you have not come across before. The Chest has a 10 rotating castors on it, with each castor have 26 slots with letters on them. Ah, a puzzle to solve!

<br /><br />Next, you unroll the hard Leather. Craved into the leather are instructions to open the Small Chest using all the bones and the 10 Castors on the small Chest.

<br><br><center><img src='images/background/magic/skeleton-007.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Entering a Code' title='Exploring - Entering a Code'></center>

<br>&nbsp;&nbsp;The Instructions read: 
<ul>
<li>1. Spread the bones in front of you.</li>
<li>2. The bones are used to make letters to <font color='#0C5A27'>Spell Two Words</font>, with <b>NO</b> Space between them. All letters are lower case. [Example: Pink Banana is NOT Correct. pinkbanana is the <b>CORRECT </b>way to Enter.</li>
<li>3. The Two Words will be rotated on the Castor and locked in. To enable the Small Chest to unlock.</li>
<li>4. There are <font color='#0C5A27'>10 Letters with a Space for a total of 10</font> Castor Slots.</li>
<li>5. Both of the Words ARE ALL LOWER CASE LETTERS.</li>
<li>6. <font color='#0C5A27'>All Bones MUST (Will) be used</font>. For Examples of Use, see image Below.</li>
<li>7. You MUST Entry your <font color='#0C5A27'>ANSWER in ALL LOWER CASE LETTERS</font>.</li>
<li>8. <font color='#0C5A27'>Hint</font>: The <font color='#0C5A27'>Second Word is Two Letters longer than the First Word</font>.</li>
<li>9. <font color='#0C5A27'>Hint</font>: The first Letter of the first word is a: <font color='#0C5A27'>L</font></li>
<li>10. <font color='#0C5A27'>Hint</font>: The second word contains two: <font color='#0C5A27'>I</font>'s</li>
<li>10. <font color='#0C5A27'>Hint</font>: There are NO SPACES between the two words.</li>
<li>12. Read the Instruction again! you don't look that smart!</li>
</ul>

<br><br><center><img src='images/background/magic/skeleton-008.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Entering a Code' title='Exploring - Entering a Code'></center>

</td></tr></table><br /><br /></center><center><i>NOT WORKING AT THE MOMENT. WORKING ON IT.</i><form method=POST><p><input type=text size=20 name=kood >&nbsp;&nbsp;&nbsp;<input type=submit name=sisestakood value=Open Chest class=myButton2></p></form></center> ";
    display($vorm, "You found a chest!"); die();
     }
elseif(isset($_POST['kood'])) {
doquery("UPDATE {{table}} SET kirst='1' WHERE id=".$userrow["id"], "users");
$kood=$_POST['kood'];
$vastus="lostcities";  //Game-Page Title
$kellelt=$userrow["id"];
$query  = "SELECT kirst FROM dk_users WHERE id='$kellelt'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{    $kirst=$row['kirst'];
if ($kood==$vastus && $kirst==0){
$newgold = $userrow["gold"] + 2000;  //Good part - reward
$newe = $userrow["experience"] + 1000;
doquery("UPDATE {{table}} SET gold='$newgold' WHERE id=".$userrow["id"], "users");
doquery("UPDATE {{table}} SET experience='$newe' WHERE id=".$userrow["id"], "users");
$vorm="<table width=100%><tr><td><center><h3 class=title>Exploring - Entering a Code</h3></center></td></tr></table>
<center><table width=75%><tr><td>
<blockquote><blockquote>
<center><img src='images/background/magic/skeleton-009.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Chest is Open' title='Exploring - Chest is Open'></center>

<br /><br />You hear a Loud <i>click!</i> and Chest Slowly Opens. Inside you find 2000 Gold Coins! Plus you gain 1000 experience points for completing this adventure.<br /><br /><br /><center><a href=index.php class=myButton2>Continue Exploring</a></center><br /><br /></blockquote></blockquote></center></td></tr></table><br /><br />";
display($vorm , "Treasure!"); die();
 } }

	if ($kood!==$vastus){	
	$vorm="<table width=100%><tr><td><center><h3 class=title>Exploring - Entering a Code</h3></center></td></tr></table>
<center><table width=75%><tr><td>
<blockquote><blockquote><center><img src='images/background/magic/skeleton-010.jpg' vspace='10' hspace='10' height='300' width='400' alt='Exploring - Entering a Code' title='Exploring - Entering a Code'></center>

<br /><br />No! No! No! The Code entered wasn't the correct one! There is no other way to open the Chest! All the hard work for nothing! Darn I wish I would have read the instructions twice and played more with my bones.

<br /><br />You spend another day at the site, putting it back in the condition you found it. After all if someone is tracking you or might be tracking you... ... Well let's just say, it's better to be safe and careful in this Lost Land of increasing danger.<br /><br /><br /><center><a href=index.php class=myButton2>Continue Exploring</a></center><br><br></blockquote></blockquote></center></td></tr></table><br /><br />";
display($vorm, "Chest!"); header("Location: index.php"); die();  }
     }


//END IMAGE 009 & 010

//END SKELETON RIDDLE RANDOM 
//END SKELETON RIDDLE RANDOM

//BEGIN TRAINING CAMP ALPHA
//BEGIN TRAINING CAMP ALPHA

$trainchance3 = rand(1,5000); // 1 in 5000 chance to find Campfire and Safety
if ($trainchance3 == 1) {
	
	global $userrow, $controlrow;
	 
	$exp = rand(2000,3000); // generate experience
	$exp1 = number_format($exp); // make number look pretty with a comma
	if ($userrow["experience"] + $exp < 101202303) { $newexp = $userrow["experience"] + $exp; $warnexp = ""; // check if user has amxed out on experience
	} else { $newexp = $userrow["experience"]; $exp = 0; $warnexp = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered</center></td></tr></table><br /><br /><br /><br />
			<Blockquote>You have maxed out your experience points.</Blockquote>"; } // warn user if they have maxed out on exp
	
	$levelquery = doquery("SELECT * FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels"); // grab next level info
	if (mysql_num_rows($levelquery) == 1) { $levelrow = mysql_fetch_array($levelquery); } // set next level info
	
	if ($userrow["level"] < 300) { // if user hasnt reached max level
		if ($newexp >= $levelrow[$userrow["charclass"]."_exp"]) { // if user has enough exp to level up
		$newhp = $userrow["maxhp"] + $levelrow[$userrow["charclass"]."_hp"]; // set new hp
		$newmp = $userrow["maxmp"] + $levelrow[$userrow["charclass"]."_mp"]; // set new mp
		$newtp = $userrow["maxtp"] + $levelrow[$userrow["charclass"]."_tp"]; // set new tp
		$newstrength = $userrow["strength"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdexterity = $userrow["dexterity"] + 				$levelrow[$userrow["charclass"]."_dexterity"]; // set new dex
		$newattack = $userrow["attackpower"] + $levelrow[$userrow["charclass"]."_strength"]; // set new strength
		$newdefense = $userrow["defensepower"] + 			$levelrow[$userrow["charclass"]."_dexterity"]; // set new defense
		$newlevel = $levelrow["id"]; // set new level number
			
// START OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR TRAINING WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,4); // THIS # IS ADDED TO TACTICAL STAT FOR TRAINING LEVEL UP
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR TRAINING CAMP MOD LEVEL UP KINGDOMS ADD ON
			
			if ($levelrow[$userrow["charclass"]."_spells"] != 0) { // if user has learned a new spell
				$userspells = $userrow["spells"] . ",".$levelrow[$userrow["charclass"]."_spells"]; // grab new spell
				$newspell = "spells='$userspells',"; // set new spells
				$spelltext = "You have learned a new spell.<br />"; // inform user of new spell
			} else { $spelltext = ""; $newspell=""; } // no new spells learned
			
			
// START OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON
// THIS SETS IT SO THE CHARACTER ONLY GAINS TACTICAL STATS FOR Campfire and Safety WHEN HE BECOMES A LORD
    if ($userrow["level"] >= 20) { // SET THIS # TO THE SAME LEVEL # AS BECOMING A LORD
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    $tactical = rand(1,4); // THIS # IS ADDED TO TACTICAL STAT FOR Campfire and Safety
    doquery("UPDATE {{table}} SET tactical=tactical+'$tactical' WHERE id='".$lordsrow["id"]."' ", "lords"); } // UPDATES THE LORDS TABLE
// END OF TACTICAL STATS GAIN FOR Campfire and Safety MOD TRAINED KINGDOMS ADD ON


			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampA.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br />You were walking along the road and found<br />a Campfire with a small group of Nomads, who<br />offered you food and safety for the night.<br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />
			You have gained a level!<br /><br />
			You gain ".$levelrow[$userrow["charclass"]."_hp"]." hit points,
			 ".$levelrow[$userrow["charclass"]."_mp"]." magic points,<br />
			 ".$levelrow[$userrow["charclass"]."_tp"]." travel points,
			 ".$levelrow[$userrow["charclass"]."_strength"]." strength,<br />
			 and ".$levelrow[$userrow["charclass"]."_dexterity"]." dexterity.
			<br />$spelltext<br />Continue <a href=\"index.php\">Exploring</a></td></tr></table></div></center></Blockquote></Blockquote>";
			$title = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table><div align='center'><table width='800' height ='800' background='images/background/map/trainingcampA.jpg'><tr><td><center><Blockquote><Blockquote><br><br><br /><br /><br /><br /><br /><br />Coagulations your long overdue rest paid off.<br />You can Level Up!</td></tr></table></div></center></Blockquote></Blockquote>";
		} else { // no level up
			$newhp = $userrow["maxhp"]; // set hp
			$newmp = $userrow["maxmp"]; // set mp
			$newtp = $userrow["maxtp"]; // set tp
			$newstrength = $userrow["strength"]; // set strength
			$newdexterity = $userrow["dexterity"]; // set dex
			$newattack = $userrow["attackpower"]; // set attack
			$newdefense = $userrow["defensepower"]; // set defense
			$newlevel = $userrow["level"]; // set level
			$newspell = ""; // set spells
			$page = "<table width='100%'><tr><td><center><h3 class='title'>Training Camp Alpha Discovered<h3></center></td></tr></table>
<div align='center'><table width='800' height ='800' background='images/background/map/trainingcampA.jpg'><tr><td><center><Blockquote><Blockquote><br /><br /><br /><br />You were walking through the woods<br />and found a Campfire with a small group of Nomads, who<br />offered you food and safety for the night.<br /><br />After a peaceful rest you gain $exp1<br />experience. $warnexp <br /><br />";
			$page .= "Continue Exploring using direction buttons.<br /><br /></td></tr></table></div></center></Blockquote></Blockquote>";
		}

		$title = "Campfire";
	}

	$updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring',level='$newlevel',maxhp='$newhp',maxmp='$newmp',maxtp='$newtp',strength='$newstrength',
	dexterity='$newdexterity',attackpower='$newattack',defensepower='$newdefense', $newspell experience='$newexp'
	WHERE id='".$userrow["id"]."' LIMIT 1", "users"); // update database
	
	display($page, $title); // display page
	
}


//END TRAINING CAMP ALPHA
//END TRAINING CAMP ALPHA


// THIS STARTS THE ADVANCED QUEST 1 STONE BUILDING
    $questchance = rand(1,1500);
    if ($questchance == 1) {  // Sets the start location of the quest
    $action = "currentaction='Exploring',";
    doquery("UPDATE {{table}} SET $action latitude='100', longitude='100', dropcode='5' WHERE id='".$userrow["id"]."' LIMIT 1", "users");// Sets were you leave the quest.
    $page = "<table width=100%><tr><td class=title align=center>The Stone Building</td></tr></table><br />";
    $page .= "<br /><div align=center><table background='images/background/quests/entrance-quest1.png' width='724' height='723' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'><font color=#96DEFF>".$userrow["charname"]."</font> you have come across a stone building that appears very ancient. It appears to have a working well and well maintained entrance. Perhaps at one time this was someone's home. It grabs your attention and begs you to explore.";
    $page .= "<br /><br />Do you wish to explore the Stone Building?</h4><br /><br /></td></tr></table>
	<form action=index.php?do=quest1 method=post><input type=submit value='Enter The Stone Building' name=building class=myButton2></form><br /><a href=index.php class=myButton2>Continue Exploring</a></td></tr></table></div></div>";
    display($page, "Stone Building"); die(); } 	
// THIS ENDS THE ADVANCED QUEST 1 STONE BUILDING


// THIS STARTS THE ADVANCED QUEST 2 CAVE
    $questchance = rand(1,1500);
    if ($questchance == 1) {  // Sets the start location of the quest or random number
    $action = "currentaction='Exploring',";
    doquery("UPDATE {{table}} SET $action latitude='130', longitude='130', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");// Sets were you leave the quest.
    $page = "<table width=100%><tr><td class=title align=center>The Cave</td></tr></table><br />";
    $page .= "<br /><div align=center><table background='images/background/quests/cave-Entrance-Quest2.png' width='679' height='675' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>A giant Cave looms before you <font color=#96DEFF>".$userrow["charname"]."</font>. Its dark and you are unable to see to far into it. There is a  collection of large rocks and rubble that obstructs the passage of the cave or mine, but does not seem it would be hard to clear. Unknown dangers may await you!<br /><br />Do you wish to explore the Cave?</h4><br /><br />";
    $page .= "</td></tr></table><div align=center><form action=index.php?do=quest2 method=post><input type=submit value='Enter The Cave' name=building class=myButton2></form><br /><b>or</b><br /><br /><a href=index.php class=myButton2>Continue Exploring</a></div></td></tr></table></div>";
    display($page, "Cave"); die(); } 
// THIS ENDS THE ADVANCED QUEST 2 CAVE


// THIS STARTS THE ADVANCED QUEST 3 HOUSE
    $questchance = rand(1,1500);
    if ($questchance == 1) {  // Sets the start location of the quest or random number
    $action = "currentaction='Exploring',";
    doquery("UPDATE {{table}} SET $action latitude='150', longitude='-130', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");// Sets were you leave the quest.
	    $page = "<table width=100%><tr><td class=title align=center>Outside The House</td></tr></table><br />";	
    $page .= "<br /><div align=center><table background='images/background/quests/House-Entrance-Quest3.png' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
    $page .= "After Days of traveling <font color=#96DEFF>".$userrow["charname"]."</font> come upon a House in the middle of the Woods. It seems safe enough for you to enter.<br /><br />Do you want to play it safe and continue exploring or Enter the Front Door to the House.</h4><br /><br />";
    $page .= "</td></tr></table><form action=index.php?do=quest3 method=post><input type=submit value='Enter The House' name=building class=myButton2></form><br /><a href=index.php class=myButton2>Continue Exploring</a></td></tr></table></div></div>";
    display($page, "House"); die(); } 
// THIS ENDS THE ADVANCED QUEST 3 HOUSE


// THIS STARTS THE ADVANCED QUEST 4 TOWER CASTLE
    $questchance = rand(1,1500);
    if ($questchance == 1) {  // Sets the start location of the quest or random number
    $action = "currentaction='Exploring',";
    doquery("UPDATE {{table}} SET $action latitude='-210', longitude='-210', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");// Sets were you leave the quest.
	    $page = "<table width=100%><tr><td class=title align=center>The Tower Castle</td></tr></table><br />";	
    $page .= "<br /><div align=center><table background='images/background/quests/tower-Entrance-Quest4.png' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
    $page .= "In the middle of nowhere <font color=#96DEFF>".$userrow["charname"]."</font> come upon a Tall Tower Castle! These Towers are normally built in frontier areas to protect local farmers and nearly by towns. You have see neither in your recent travels.<br /><br />Do you decide to take time from you exploring to discover the secrets of this Tower, or Continue on your travels?</h4><br /><br />";
    $page .= "</td></tr></table><form action=index.php?do=quest4 method=post><input type=submit value='Enter The Tower Castle' name=building class=myButton2></form><br /><a href=index.php class=myButton2>Continue Exploring</a></td></tr></table></div></div>";
    display($page, "Tower Castle"); die(); } 
// THIS ENDS THE ADVANCED QUEST 4 TOWER CASTLE


// THIS STARTS THE ADVANCED QUEST 5 WOODS
    $questchance = rand(1,2000000);
    if ($questchance == 1) {  // Sets the start location of the quest or random number
    $action = "currentaction='Exploring',";
    doquery("UPDATE {{table}} SET $action latitude='-210', longitude='-210', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");// Sets were you leave the quest.
	    $page = "<table width=100%><tr><td class=title align=center>The Castle in the Woods</td></tr></table><br />";	
    $page .= "<br /><div align=center><table background='images/background/quests/Woods-Entrance-Quest5.png' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
    $page .= "<font color=#96DEFF>".$userrow["charname"]."</font>, this much be the much rumored and infamous mythical Castle in the Woods. Said to be the greatest Castle ever built in this land, spanning several hundred feet deep and twice that for the width. Great indeed!<br /><br />Do you decide to take time from you exploring to discover the secrets of this Tower, or Continue on your travels?</h4><br /><br /><br /><br />";
    $page .= "</td></tr></table><form action=index.php?do=quest5 method=post><input type=submit value='Enter The Castle in the Woods' name=building class=myButton2></form><br /><a href=index.php class=myButton2>Continue Exploring</a></td></tr></table></div></div>";
    display($page, "Woods"); die(); } 
// THIS ENDS THE ADVANCED QUEST 5 WOODS


// THIS STARTS THE ADVANCED QUEST 6 ADVENTURES INN
    $questchance = rand(1,2000);
    if ($questchance == 1) {  // Sets the start location of the quest or random number
    $action = "currentaction='Exploring',";
	    $page = "<table width=100%><tr><td class=title align=center>Enter the Adventures Inn</td></tr></table><br />";	
    $page .= "<br /><div align=center><table background='images/background/quests/quest-6-entrance.png' width='800' height='800' cellpadding='0' cellspacing='0' border='0' bordercolor='#000000'><tr><td><br /><br /><br /><div align=center><table width='65%'><tr><td><h4 class='questback'>";
    $page .= "<div align=center>Welcome to the Adventures Inn <font color=#96DEFF>".$userrow["charname"]."</font>, where you can rest and relax before you continue your journey.</div></h4><br /><br /><br /><br />";
    $page .= "</td></tr></table><form action=index.php?do=quest6 method=post><input type=submit value='Enter The Adventures Inn' name=building class=myButton2></form><br /><br /><br /><a href=index.php class=myButton2>Continue Exploring</a></td></tr></table></div></div>";
    display($page, "Adventures Inn"); die(); } 
// THIS ENDS THE ADVANCED QUEST 6 ADVENTURES INN

?>