<?php // Town information sheet. Controls what information is to be displayed. Mindlessly droned out by Michael Archangel McCart.

function towninf() {

global $userrow;
    
    $townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
            $townrow = mysql_fetch_array($townquery);
	$title = "Information on ".$townrow["name"]."";

//add and remove elseif's to match the number of towns. 


//Town #1 Crossroads Capital 0 North/South 0 East/West

if ($townrow["id"] == "1")
	{ $Inf = "<center><h3 class=\"title\">".$townrow["name"]." [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>&nbsp;&nbsp; Welcome <b>".$userrow["charname"]."</b> to the greatest adventure of your young innocence. You have awaken from a long and restful sleep and find yourself in the town of <b>".$townrow["name"]."</b> the  <b>".$townrow["id"]."st</b>  city of this strange but beauty world you find yourself in.
<br><br>
&nbsp;&nbsp; You put all that aside for now as, You slowly take in your surrounds. For some reason you can remember the name of the ruins that are scattered about are called the <i>Hill of Ruins</i> and is the highest point in this part of the world.
<br><br>
&nbsp;&nbsp; You see various weapons and armor spread around you. You take inventory of this items and find you have a 
majestic [Weapon], the <b>".$userrow["weaponname"]."</b>, [Armor] <b>".$userrow["armorname"]."</b>, [Shield] <b>".$userrow["shieldname"]."</b>, and a [Helmet]<b>".$userrow["helmetname"]."</b>. Off in the bush you see something shining. A closer looks brings you a  [Gauntlet] <b>".$userrow["gauntletname"]."</b> and [Boot] <b>".$userrow["bootname"]."</b> both nice selections. As you slowly get you armor on, you see something out of the beating rays of the noon day sun. It makes a leap for you, as you grab your  <b>".$userrow["weaponname"]."</b> ready to stab it in its warm under belly. But before you strike the beast licks your face! How could you forget your loyal pet <i> <b>".$userrow["petname"]."</b> </i> ?
<br><br>
&nbsp;&nbsp; The Local historian tells you the town of ".$townrow["name"]." worships <i>The Great God Recarnus</i>. Recarnus is the God of Rebirth or as known to the citizens as The God of the Rising Dead, hence before you is the City of the Dead. She also add that when any adventurer is killed in the Unknown Lands of this World the Great God Recarnus gives you Rebirth is this city. As payment for bringing you back to the living, He takes Half of your Gold Coins and leaves you with a spark of life to continue your life journeys.
<br><br>
&nbsp;&nbsp; The Historian does not know if your have been bought back to life or just want to enter the town to restock your good or for a nights sleep. Either way she suggests you take stock of your Health. Upon a complete examination by the historian she finds you have <b>Maximum Hit Points of ".$userrow["maxhp"]." with Current Hit Points: ".$userrow["currenthp"]." </b>. Your <b>Current Magic Points are ".$userrow["currentmp"]." out of a total of  ".$userrow["maxmp"]." Maximum Magic Points</b>. Finally she finds you have a <b>Maximum of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points</b>.  
<br><br>
&nbsp;&nbsp; By spending the night at the town Inn any of your Points, (Health Points [HP], Travel Points [TP] and Magic Points [MP]) lost in prior Battles will be restored to you.  You will awaken the next Day fully Refreshed and ready for adventuring again. The price for a nights stay at the <b>".$townrow["name"]." Inn is ".$townrow["innprice"]." Gold Coins</b>. As you find Towns and Inns further away from the Capital the price for staying at a these Inns will increase greatly.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Character Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." <i>Nightly</i> Inn Price:<i> <b>".$townrow["innprice"]." Copper Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Points: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. Silver in Bank: <b>".$userrow["bankcopper"]."</b>
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. Copper in Bank: <b>".$userrow["banksilver"]."</b>
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>
<li> Name of your Kingdom (<i>Lvl 20 Required.</i>): <b>".$userrow["landname"]."</b>.  Land: <b>".$userrow["land"]."</b>
<li> Treasury: <b>".$userrow["treasury"]."</b>.  Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Land Won: <b>".$userrow["landwon"]."</b>.  Land Lost: <b>".$userrow["lost"]."</b>. 
<li> Tactical Level: <b>".$userrow["tactical"]."</b>
<li> Battle Wins: <b>".$userrow["batwins"]."</b>.  Battle Losses: <b>".$userrow["battloss"]."</b>  Battle Totals: <b>".$userrow["battot"]."</b>
<li> Offensive Army: <b>".$userrow["offarmy"]."</b>.  Defensive Army: <b>".$userrow["dffarmy"]."</b>. 
</ul>

<br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
  

//Town #2 Argos

elseif ($townrow["id"] == "2") 
	{ $Inf = "<center><h3 class=\"title\">Argos [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; The Town of  ".$townrow["name"]."  is a small farming village that can provide weapons like pitchforks and some advanced Weapons and Armor in secret and rare Weapons Shops. The live mainly on the crops they grow themselves and few wild game they can find in the near by forest.
<br><br>
&nbsp;&nbsp; The villagers of  ".$townrow["name"]."  enjoy treating travelers to story telling. Argoians are known through out the Kingdom of the Great God Recarnus of having the most Rich and Entertaining Legends of Old. Most of these stories are rooted in the Legends of the Great Battles of Early ".$townrow["name"]." and first Dragons of the Kingdom.
<br><br>
&nbsp;&nbsp; Welcome ".$userrow["charname"]." to the greatest adventure of your young innocence. You have awaken from a long and restful sleep and find yourself in the town of ".$townrow["name"]." the number ".$townrow["id"]."  city of this strange but beauty world you find yourself in.
<br><br>
&nbsp;&nbsp; You see various weapons and armor spread around you. You take inventory of this items and find you have a 
majestic weapon, the ".$userrow["weaponname"]." -Armor- ".$userrow["armorname"]." -Shield- ".$userrow["shieldname"]." and a ".$userrow["helmetname"].". Off in the bush you see something shining. A closer looks brings you a  ".$userrow["gauntletname"]." and ".$userrow["bootname"]." both nice selections for Gauntlets and Boots. As you slowly get you armor on, you see something out of the beating rays of the noon day sun. It makes a leap for you, as you grab your  ".$userrow["weaponname"]." ready to stab it in its warm under belly. But before you strike the beast licks your face! How could you forget your loyal pet <i> ".$userrow["petname"]." </i> ?
<br><br>
&nbsp;&nbsp; The Local historian tells you the town of ".$townrow["name"]." worships <i>The Great God Recarnus</i> also. Recarnus is the God of Rebirth or as known to the citizens as The God of the Rising Dead, hence before you is the City of the Dead. She also add that when any adventurer is killed in the Unknown Lands of this World the Great God Recarnus gives you Rebirth is this city. As payment for bringing you back to the living, He takes Half of your Gold Coins and leaves you with a spark of life to continue your life journeys. <i>Is ".$townrow["name"]." this City </i>or one of the Cities you may have come upon in your travels? 
<br><br>
&nbsp;&nbsp; The Historian suggests you take stock of your Health. Upon a complete examination by the historian she finds you have Maximum Hit Points of ".$userrow["maxhp"]." with Current Hit Points: ".$userrow["currenthp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of a total of  ".$userrow["maxmp"]." Maximum Magic Points. Finally she finds you have a Maximum of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points.  
<br><br>
&nbsp;&nbsp; By spending the night at the town Inn any of your Points, (Health Points [HP], Travel Points [TP] and Magic Points [MP]) lost in prior Battles will be restored to you.  You will awaken the next Day fully Refreshed and ready for adventuring again. The price for a nights stay at the ".$townrow["name"]." Inn is ".$townrow["innprice"]." Gold Coins. As you find Towns and Inns further away from the Capital the price for staying at a these Inns will increase greatly.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
  
//Town #3 Sidon
  
elseif ($townrow["id"] == "3") 
	{ $Inf = "<center><h3 class=\"title\">Sidon [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>&nbsp;&nbsp; ".$townrow["name"]." is known for the making of the finest armor in this Strange Land.  Sidon is a very quite and at first appearances uninteresting from a common persons point of view. Welcome ".$userrow["charname"]." You need to put all that aside for now commands the Historian of , You slowly take in your surrounds. For some reason you can remember the that the red soil you seat upon and that spreads from all point around you, is called the <i>Fire Hells of  ".$townrow["name"]." </i>. Who rich scattering of Reddish crystals can be used for heating a home or for weapons of increasing fear and death.
<br><br>
&nbsp;&nbsp; You see various weapons and armor spread around you. You take inventory of this items and find you have a 
majestic weapon, the ".$userrow["weaponname"]." -Armor- ".$userrow["armorname"]." -Shield- ".$userrow["shieldname"]." and a ".$userrow["helmetname"].". Off in the bush you see something shining. A closer looks brings you a  ".$userrow["gauntletname"]." and ".$userrow["bootname"]." both nice selections for Gauntlets and Boots. As you slowly get you armor on, you see something out of the beating rays of the noon day sun. It makes a leap for you, as you grab your  ".$userrow["weaponname"]." ready to stab it in its warm under belly. But before you strike the beast licks your face! How could you forget your loyal pet <i> ".$userrow["petname"]." </i> ?
<br><br>
&nbsp;&nbsp; The Historian does not know if your have been bought back to life or just want to enter the town to restock your good or for a nights sleep. Either way she suggests you take stock of your Health. Upon a complete examination by the historian she finds you have Maximum Hit Points of ".$userrow["maxhp"]." with Current Hit Points: ".$userrow["currenthp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of a total of  ".$userrow["maxmp"]." Maximum Magic Points. Finally she finds you have a Maximum of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points. <i>Is ".$townrow["name"]." this City </i>or one of the Cities you may have come upon in your travels?  
<br><br>
&nbsp;&nbsp; By spending the night at the town Inn any of your Points, (Health Points [HP], Travel Points [TP] and Magic Points [MP]) lost in prior Battles will be restored to you.  You will awaken the next Day fully Refreshed and ready for adventuring again. The price for a nights stay at the ".$townrow["name"]." Inn is ".$townrow["innprice"]." Gold Coins. As you find Towns and Inns further away from the Capital the price for staying at a these Inns will increase greatly.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

//Town #4 Jericho

elseif ($townrow["id"] == "4") 
	{ $Inf = "<center><h3 class=\"title\">Jericho [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>&nbsp;&nbsp;  Welcome  ".$userrow["charname"]." to ".$townrow["name"]." the frozen Kingdom of the North.
Here high up in the mountains there are many great warriors of distinction strengthen by centuries of the hush climates in the lands. ".$townrow["name"]." warriors and its people maintain their limited diet on fugus and what little animal eat that can be found this far north. The life style and diet have given the warriors of ".$townrow["name"]." an edge in combat. Decades trained their Strength can reach ".$userrow["strength"]." , Dexterity ".$userrow["dexterity"]." and Defense Power can raise to ".$userrow["defensepower"]." . More importantly Attack Power can reach ".$userrow["attackpower"]." or more.
<br><br>
&nbsp;&nbsp; You put all that aside for now as, You slowly take in your surrounds. For some reason you can remember the names of the parts of the city before you. Off farther to the South-West is the <i>Vast Lands of Nothing</i> and to the South-East the Route to the <i>Circle of Trees of Lost Enduro Civilization</i>.
<br><br>
&nbsp;&nbsp; You see various weapons and armor spread around you. You take inventory of this items and find you have a 
majestic weapon, the ".$userrow["weaponname"]." -Armor- ".$userrow["armorname"]." -Shield- ".$userrow["shieldname"]." and a ".$userrow["helmetname"].". Off in the bush you see something shining. A closer looks brings you a  ".$userrow["gauntletname"]." and ".$userrow["bootname"]." both nice selections for Gauntlets and Boots. As you slowly get you armor on, you see something out of the beating rays of the noon day sun. It makes a leap for you, as you grab your  ".$userrow["weaponname"]." ready to stab it in its warm under belly. But before you strike the beast licks your face! How could you forget your loyal pet <i> ".$userrow["petname"]." </i> ?
<br><br>
&nbsp;&nbsp; The Local historian tells you the town of ".$townrow["name"]." worships <i>The Minor God Samuel</i>. Samuel protects wandering citizens against the harsh environment of the north. Those who find Samuel before the North surrounds them in death sometimes are rewarded with extra Experience Bonus [ ".$userrow["expbonus"]." ] and a rare Gold Bonus  [ ".$userrow["goldbonus"]." ] to your present levels <i>if any</i>. <br>
<br><br>
&nbsp;&nbsp; The Historian suggests you take stock of your Health. Upon a complete examination by the historian she finds you have Maximum Hit Points of ".$userrow["maxhp"]." with Current Hit Points: ".$userrow["currenthp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of a total of  ".$userrow["maxmp"]." Maximum Magic Points. Finally she finds you have a Maximum of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points. <i>Is ".$townrow["name"]." this City </i>or one of the Cities you may have come upon in your travels?  
<br><br>
&nbsp;&nbsp; By spending the night at the town Inn any of your Points, (Health Points [HP], Travel Points [TP] and Magic Points [MP]) lost in prior Battles will be restored to you.  You will awaken the next Day fully Refreshed and ready for adventuring again. The price for a nights stay at the ".$townrow["name"]." Inn is ".$townrow["innprice"]." Gold Coins. As you find Towns and Inns further away from the Capital the price for staying at a these Inns will increase greatly.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #5 Narcissa

elseif ($townrow["id"] == "5") 
	{ $Inf = "<center><h3 class=\"title\">Narcissa [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; Welcome  ".$userrow["charname"]." to ".$townrow["name"]." is a vast and rich fishing village and the only true source of large amounts of seafood necessary to feed the ever growing cities of the west.  With its great ships both large and small seem like bottle corks in a small stream, bouncing with the waves formed by the coming storm to the south. with large boats.   ".$townrow["name"]." the city of  ".$townrow["name"]." with its three prong fork of fishermen, seafood and its great fleet of ships hold vast power in the part of the known lands. there are powerful weapons on sale here and there is a famous wizard who hides in the vastness near the village.
<br><br>
&nbsp;&nbsp;  The Historian Welcomes  ".$userrow["charname"]." to ".$townrow["name"]." the hard work life style and diet have given the warriors of ".$townrow["name"]." an edge in combat. Decades trained their Strength can reach ".$userrow["strength"]." , Dexterity ".$userrow["dexterity"]." and Defense Power can raise to ".$userrow["defensepower"]." . More importantly Attack Power can reach ".$userrow["attackpower"]." or more.
<br><br>
&nbsp;&nbsp; You put all that aside for now as, You slowly take in your surrounds. For some reason you can remember the name of the ruins that are scattered about are called the <i>The Pillars of Neptune</i> and is the place where citizens of these cities go to pray in times of peril.
<br><br>
&nbsp;&nbsp; You see various weapons and armor spread around you. You take inventory of this items and find you have a 
majestic weapon, the ".$userrow["weaponname"]." -Armor- ".$userrow["armorname"]." -Shield- ".$userrow["shieldname"]." and a ".$userrow["helmetname"].". Off in the bush you see something shining. A closer looks brings you a  ".$userrow["gauntletname"]." and ".$userrow["bootname"]." both nice selections for Gauntlets and Boots. As you slowly get you armor on, you see something out of the beating rays of the noon day sun. It makes a leap for you, as you grab your  ".$userrow["weaponname"]." ready to stab it in its warm under belly. But before you strike the beast licks your face! How could you forget your loyal pet <i> ".$userrow["petname"]." </i> ?
<br><br>
&nbsp;&nbsp; The Local historian tells you the town of ".$townrow["name"]." worships <i>The Great God Recarnus</i>. Recarnus is the God of Rebirth or as known to the citizens as The God of the Rising Dead, hence before you is the City of the Dead. She also add that when any adventurer is killed in the Unknown Lands of this World the Great God Recarnus gives you Rebirth is this city. As payment for bringing you back to the living, He takes Half of your Gold Coins and leaves you with a spark of life to continue your life journeys.
<br><br>
&nbsp;&nbsp; The Historian does not know if your have been bought back to life or just want to enter the town to restock your good or for a nights sleep. Either way she suggests you take stock of your Health. Upon a complete examination by the historian she finds you have Maximum Hit Points of ".$userrow["maxhp"]." with Current Hit Points: ".$userrow["currenthp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of a total of  ".$userrow["maxmp"]." Maximum Magic Points. Finally she finds you have a Maximum of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points. <i>Is ".$townrow["name"]." this City </i>or one of the Cities you may have come upon in your travels?  
<br><br>
&nbsp;&nbsp; Remember by spending the night at the this town <i>(or any towns Inn)</I> Inn any of your Points, (Health Points [ ".$userrow["maxhp"]." ], Travel Points [ ".$userrow["maxtp"]." ] and Magic Points [ ".$userrow["maxmp"]." ] lost in prior Battles will be restored to you at their maximum levels.  You will awaken the next Day fully Refreshed and ready for adventuring again. The price for a nights stay at the ".$townrow["name"]." Inn is ".$townrow["innprice"]." Gold Coins. As you find Towns and Inns further away from the Capital the price for staying at a these Inns will increase greatly.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #6 Luxor

elseif ($townrow["id"] == "6") 
	{ $Inf = "<center><h3 class=\"title\">Luxor [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center> <table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; Welcome  ".$userrow["charname"]." to ".$townrow["name"]." This is the domain of the wood elves it holds perils beyond your imagination to the unwanted trespassers. The elves are the most envied archers and indisputably the most powerful bow wielders. 
<br><br>
&nbsp;&nbsp; You put all that aside for now as, You slowly take in your surrounds. Strangely you can remember the name of the vast Forests of this region. Called <i>The Forest of Elves</i> they continue to climb into the clouds, some more than 500 yards wide and thousands of year old. The forest trees are swarming with Elves who have made their home and guilds in the forest. Joined by countless wood and wine bridges they made up a web of the City of  ".$townrow["name"]." .
<br><br>
&nbsp;&nbsp; You see various weapons and armor spread around you. You take inventory of this items and find you have a 
majestic weapon, the ".$userrow["weaponname"]." -Armor- ".$userrow["armorname"]." -Shield- ".$userrow["shieldname"]." and a ".$userrow["helmetname"].". Off in the bush you see something shining. A closer looks brings you a  ".$userrow["gauntletname"]." and ".$userrow["bootname"]." both nice selections for Gauntlets and Boots. As you slowly get you armor on, you see something out of the beating rays of the noon day sun. It makes a leap for you, as you grab your  ".$userrow["weaponname"]." ready to stab it in its warm under belly. But before you strike the beast licks your face! How could you forget your loyal pet <i> ".$userrow["petname"]." </i> ?
<br><br>
&nbsp;&nbsp; The Local historian tells you travels have to this point at your Difficulty Level of  ".$userrow["difficulty"]." and you present fighting of Level: ".$userrow["level"]." . Has found yourself in 
 ".$userrow["fights"]." Fights, with ".$userrow["kills"]." Kills and your death Re-births of  ".$userrow["deaths"]." .
A more interesting of note is your Experience Level has reached ".$userrow["experience"]." .
<br><br>
&nbsp;&nbsp; The Historian she suggests you take stock of your Health. Upon a complete examination by the historian she finds you have Maximum Hit Points of ".$userrow["maxhp"]." with Current Hit Points: ".$userrow["currenthp"]." . Your Current Magic Points are ".$userrow["currentmp"]." out of a total of  ".$userrow["maxmp"]." Maximum Magic Points. Finally she finds you have a Maximum of  ".$userrow["maxtp"]." Travel Points, with a Current total of ".$userrow["currenttp"]." Travel Points. <i>Is ".$townrow["name"]." this City </i>or one of the Cities you may have come upon in your travels?  
<br><br>
&nbsp;&nbsp; Remember by spending the night at the this town <i>(or any towns Inn)</I> Inn any of your Points, (Health Points [ ".$userrow["maxhp"]." ], Travel Points [ ".$userrow["maxtp"]." ] and Magic Points [ ".$userrow["maxmp"]." ] lost in prior Battles will be restored to you at their maximum levels.  You will awaken the next Day fully Refreshed and ready for adventuring again. The price for a nights stay at the ".$townrow["name"]." Inn is ".$townrow["innprice"]." Gold Coins. As you find Towns and Inns further away from the Capital the price for staying at a these Inns will increase greatly.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #7 Carthage

elseif ($townrow["id"] == "7")
	{ $Inf = "<center><h3 class=\"title\">Carthage [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; Welcome  ".$userrow["charname"]." to ".$townrow["name"]." 
<br><br>
&nbsp;&nbsp; 
<center></Center>
&nbsp;&nbsp; ".$townrow["name"]."  is a ancient fort which has more than 2,000 years of history. It was originally constructed of local Lumber in its interior. The Odd size of the Fort is due to it was chiseled and dug from the large Rocky Hill that once stood here.  The Interior wood was destroyed not by some unforeseen attackers, but because a simple fallen candle had fallen to the lumber planks that made up it floors through out the Fort. The Fort not long served its purpose as a strong defense against waves of attacks from the north.
<br><br>
&nbsp;&nbsp; You can still notice the scorched black rocks at points of the entrance into the Chiseled Rock. Few and only the brave adventure forward into the entrances because of stories of Ghosts and Unhuman dead that are said to live inside it.
<br><br>
&nbsp;&nbsp;The inn price for the inn is  ".$townrow["innprice"]." Gold Coins and Traveling here costs ".$townrow["travelpoints"]." Travel Points.
<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

//Town #8 Corinth 

elseif ($townrow["id"] == "8")	{ $Inf = "<center><h3 class=\"title\">Corinth [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; Welcome  ".$userrow["charname"]." to ".$townrow["name"]." 
<br><br>
&nbsp;&nbsp; 
<center></Center>
".$townrow["name"]."  is the capital of the Kingdom Of Shoguns where the three gods Rar, Rif and Ror dwell however they lurk all around the map at the extreme edge of the kingdom. If you defeat any of these gods in battle you may receive there almighty power. Rar has the Flaming Eternity Shield, Rif has the Flaming Eternity Swords and Ror has the Flaming Eternity Mage Armor. Prepare for war. The gods almighty weapons can be bought at the local shop powerful.
<br>
<h3>".$townrow["name"]."</h3> 
<br><br>

 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

//Town #9 Haggaror

elseif ($townrow["id"] == "9") 
	{ $Inf = "<center><h3 class=\"title\">Haggaror [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; Welcome  ".$userrow["charname"]." to ".$townrow["name"]." which is built upon the Ruins of the Forest Giants, so says the ancient legends. The only thing we know for sure, the Ruins which this city sits are four times the size needed for a normal creature of this land. Home doorways are 30 feet or higher, Windows are 10 x 10 feet or large and the ancient roads, now used as courtyards are as wide enough for eight oxen pull wagons to be driven side by side. There are many more examples of the Giants civilization, except no Bones, images or likeness of this creatures has ever been found to confirm this as nothing more than a Myth.

<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #10 Troy 

elseif ($townrow["id"] == "10") 
	{ $Inf = "<center><h3 class=\"title\">Troy [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #11 Rey

elseif ($townrow["id"] == "11") 
	{ $Inf = "<center><h3 class=\"title\">Rey [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #12 Merigold 

elseif ($townrow["id"] == "12") 
	{ $Inf = "<center><h3 class=\"title\">Merigold [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #13 Athens

elseif ($townrow["id"] == "13") 
	{ $Inf = "<center><h3 class=\"title\">Athens [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

//Town #14 Cario

elseif ($townrow["id"] == "14") 
	{ $Inf = "<center><h3 class=\"title\">Cario [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

//Town #15 Cyreneia

elseif ($townrow["id"] == "15") 
	{ $Inf = "<center><h3 class=\"title\">Cyreneia [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
	


//Town #16 Camasiacum

elseif ($townrow["id"] == "16") 
	{ $Inf = "<center><h3 class=\"title\">Camasiacum [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #17 Itanais

elseif ($townrow["id"] == "17") 
	{ $Inf = "<center><h3 class=\"title\">Itanais [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

//Town #18 Neropolis

elseif ($townrow["id"] == "18") 
	{ $Inf = "<center><h3 class=\"title\">Neropolis [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
	


//Town #19 Girsche

elseif ($townrow["id"] == "19") 
	{ $Inf = "<center><h3 class=\"title\">Girsche [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 


//Town #20 Far Point City

elseif ($townrow["id"] == "20") 
	{ $Inf = "<center><h3 class=\"title\">Far Point City [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; Welcome <b>".$userrow["charname"]."</b> you find yourself in the town of <b>".$townrow["name"]."</b> the <b>".$townrow["id"]."th</b>  city its hear told of this strange world.
<br><br>
&nbsp;&nbsp; Your inventory of items you have are a [Weapon], <b>".$userrow["weaponname"]."</b>, [Armor] <b>".$userrow["armorname"]."</b>, [Shield] <b>".$userrow["shieldname"]."</b>, [Helmet] <b>".$userrow["helmetname"]."</b>, [Gauntlet] <b>".$userrow["gauntletname"]."</b>, [Boot] <b>".$userrow["bootname"]."</b>, [Ring] <b>".$userrow["magicname"]."</b> and your loyal pet <i> <b>".$userrow["petname"]."</b> </i>.
<br><br>
&nbsp;&nbsp; The Local Historian tells you the town of ".$townrow["name"]." worships <i>Trees or more important the wood that comes from those Trees.</i>. Trees bring wood, which brings Houses, Shops and defensive walls. Plus classes of weapons both Offensive and Defensive Weapons.
<br><br>
&nbsp;&nbsp; Not to mention wood logs for the cooking and heating of the many buildings and homes of <b>".$townrow["name"]."</b> which lays far South from the Capitol City. Its winters are harsh, which lots of snow and cold southeastern winds blow most of the year.
<br><br>

<b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian also has your latest Status as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
    	
		
		
//Town 21 Arcadia

elseif ($townrow["id"] == "21") 
	{ $Inf = "<center><h3 class=\"title\">Arcadia [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; ".$townrow["name"]." one of the Lost and Hidden Cities of this Vast and Strange and unforgiving Lands.
<br><br>
&nbsp;&nbsp; The Historian for this area has only partial information, rumors and Myths which have passed from generation to generation. The passing of each Generation, brings a new Generation of story tellers that have Improved Upon or Expanded the Myth first told by Local Citizens of the time. ".$townrow["name"]." is a City lost to time and History which may bring wealth, danger, death or dozens of other unholy events upon yourself and others.
<br><br>
&nbsp;&nbsp; ".$townrow["name"]." (Greek-Apkaoia) refers to a vision of pastoralism and harmony with nature. The term is derived from the Greek province of the same name which dates to antiquity; the province's mountainous topography and sparse population of pastoralists later caused the word  ".$townrow["name"]."  to develop into a poetic byword for an idyllic vision of unspoiled wilderness. ".$townrow["name"]." is a poetic shaped space associated with bountiful natural splendor and harmony. The Garden is often inhabited by shepherds. The concept also figures in Renaissance mythology. Although commonly thought of as being in line with Utopian ideals  ".$townrow["name"]."  differs from that tradition in that it is more often specifically regarded as unattainable. Furthermore, it is seen as a lost, Edenic form of life, contrasting to the progressive nature of Utopian desires.
<br><br>
&nbsp;&nbsp; The inhabitants were often regarded as having continued to live after the manner of the Golden Age, without the pride and avarice that corrupted other regions. It is also sometimes referred to in English poetry as Arcady. The inhabitants of this region bear an obvious connection to the figure of the noble savage, both being regarded as living close to nature, uncorrupted by civilization, and virtuous.

<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
	

	


//Town #22 Lost City of Avalon

elseif ($townrow["id"] == "22") 
	{ $Inf = "<center><h3 class=\"title\">Lost City of Avalon [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; ".$townrow["name"]." one of the Lost and Hidden Cities of this Vast and Strange and unforgiving Lands.
<br><br>
&nbsp;&nbsp; The Historian for this area has only partial information, rumors and Myths which have passed from generation to generation. The passing of each Generation, brings a new Generation of story tellers that have Improved Upon or Expanded the Myth first told by Local Citizens of the time ".$townrow["name"]." is a City lost to time and History which may bring wealth, danger, death or dozens of other unholy events upon yourself and others.
<br><br>
&nbsp;&nbsp; ".$townrow["name"]." (Latin-Insula Avallonis, Old French Avalon, Welsh: Ynys Afallon, Ynys Afallach, literally meaning  the isle of fruit [or apple] trees ) is a legendary island featured in the Arthurian legend. It first appears in Geoffrey of Monmouths 1136 pseudo-historical account Historia Regum Ebritanniae -The History of the Kings of Ebritain- as the place where King Arthurs sword Excalibur was forged and later where Arthur was taken to recover from his wounds after the Battle of Camlann. ".$townrow["name"]." was associated from an early date with mystical practices and people such as Morgan le Fay.

<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
	


//Town #23 The Lost City of Nysa

elseif ($townrow["id"] == "23") 
	{ $Inf = "<center><h3 class=\"title\">The Lost City of Nysa [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; ".$townrow["name"]." one of the Lost and Hidden Cities of this Vast and Strange and unforgiving Lands.
<br><br>
&nbsp;&nbsp; The Historian for this area has only partial information, rumors and Myths which have passed from generation to generation. The passing of each Generation, brings a new Generation of story tellers that have Improved Upon or Expanded the Myth first told by Local Citizens of the time. ".$townrow["name"]." is a City lost to time and History which may bring wealth, danger, death or dozens of other unholy events upon yourself and others.
<br><br>
&nbsp;&nbsp; In Greek mythology, the mountainous district of ".$townrow["name"]."  variously associated with Ethiopia, Libya, Tribalia, India or Arabia by Greek mythographes, was the traditional place where the rain nymphs, the Hyades, raised the infant god Dionysus, the Zeus of Nysa.
<br><br>
&nbsp;&nbsp; Though the worship of Dionysus came into mainland Greece from Asia Minor (where the Hittites called themselves Nesi and their language Nesili, the various locations assigned to Nysa may simply be conventions to show that a romantically remote and mythical land was envisaged. The name Nysa may even be an invention to explain the gods name. Even Homer mentions the mountain Nyseion as the place where Dionysus, under the protection of the nymphs, grew up. Hesychius of Alexandria (5th century Byzantine lexicon) gives a list of the following locations proposed by ancient authors as the site of Mount Nysa: Arabia, Ethiopia, Egypt, Babylon, Erythraian Sea (the Red Sea), Thrace, Thessaly, Cilicia, India, Libya, Lydia, Macedonia, Naxos, around Pangaios (mythical island south of Arabia), Syria. On his return from Nysa to join his fellow Olympian's, Dionysus brought the entheogen wine.
<br><br>
&nbsp;&nbsp; According to Sir William Jones, Meros is said by the Greeks to have been a mountain in India, on which their Dionysus was born, and that Meru, though it generally means the north pole in Indian geography, is also a mountain near the city of Naishada or Nysa, called by the Greek geographers Dionysopolis, and universally celebrated in the Sanskrit poems.
<br><br>
&nbsp;&nbsp; During the Hellenistic period, ".$townrow["name"]."  was personified as Dionysus' nursemaid, and she was said to be buried at the town of Scythopolis (Beit She'an) in Israel, which claimed Dionysus as its founder.

<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 
    	
	

	


//Town #24 Lost City of Zerzura

elseif ($townrow["id"] == "24") 
	{ $Inf = "<center><h3 class=\"title\">Lost City of Zerzura [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; ".$townrow["name"]." one of the Lost and Hidden Cities of this Vast and Strange and unforgiving Lands.
<br><br>
&nbsp;&nbsp; The Historian for this area has only partial information, rumors and Myths which have passed from generation to generation. The passing of each Generation, brings a new Generation of story tellers that have Improved Upon or Expanded the Myth first told by Local Citizens of the time. ".$townrow["name"]." is a City lost to time and History which may bring wealth, danger, death or dozens of other unholy events upon yourself and others.
<br><br>
&nbsp;&nbsp; ".$townrow["name"]." was long rumored to have existed deep in the desert west of the Sile River in Begypt or Mibya. In writings dating back to the centuries before writing, the authors spoke of a city which was white as a dove and called it The Oasis of Little Birds. In the Kitab al Kanuz,  ".$townrow["name"]."  is said to be a city in the Hahara full of treasure with a sleeping king and queen. The city is guarded by black giants who keep anyone from going in and coming out. However, this may be a reference to the black eTebu people, nomads in Cilhad and Mibya whose ancestors used to raid oases out in the Sahara.
<br><br>
&nbsp;&nbsp; Herodotus mentions a legendary 'City of Dionysus' lost in the desert sands, which may be the origin of the  ".$townrow["name"]." legend. The Greek god Dionysus is associated with the Eleusi nian mystery cult of ancient Greece, based on the use of an entheogenic plant: origins of sacred mushroom cults have been traced by scholars to the Havara, in particular the Tassili-n-Ajler area of Balleria, which boasts rock-painting dated as early as 10,000 BC. Some of these paintings apparently show shaman-figures toting mushrooms, and experiencing a shamanic trance. The 'City of Dionysus' myth may be a dim memory of this forgotten cult.
<br><br>
&nbsp;&nbsp; The first Buropean reference to  ".$townrow["name"]."  is in an centuries old account by the Benglish Begyptologist John Gardner Wilkinson, based on a report by an Barab who said he had found the oasis while searching for a lost camel. Placed five days west of the track connecting the oases of Farafra and Bahariya, the Oasis called Waden  ".$townrow["name"]." abounded in palms, with springs, and some ruins of uncertain date. Although tales of secret desert locales found by searchers for stray camels were common enough, Wilkinson's account was bolstered when later explorers found a number of previously unknown oases that had been named in his account along with  ".$townrow["name"]." . But they did not find  ".$townrow["name"]."  itself.
<br><br>
&nbsp;&nbsp; More recently, Beuropean explorers made forays into the desert in search of  ".$townrow["name"]."  but never succeeded in finding it. Notable twentieth-century explorers Ralph Bagnold of Ebritain, and the Ehungarian László (Ladislaus) Alamos led an expedition to search for ".$townrow["name"]." from 1929-1930 using Ford Model A trucks. In 1932 the Almásy- Patrick Clayton expedition reconnaissance flights discovered two valleys in the Gilf Kebir. In the following year, Alamos found the third of the  ".$townrow["name"]."  wades, actually rain oases in the remote desert. On the other hand, Bagnold considered  ".$townrow["name"]."  as a legend that could never be solved by discovery.



<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 




//Town #0 Outpost Shadow 

elseif ($townrow["id"] == "0") 
	{ $Inf = "<center><h3 class=\"title\">Outpost Shadow [Lat: ".$userrow["latitude"]." | Long: ".$userrow["longitude"]." ] History</h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'  align='top' hspace='12' vspace='2'></a>
&nbsp;&nbsp; ".$townrow["name"]." one of the Lost and Hidden Cities of this Vast and Strange and unforgiving Lands.
<br><br>
&nbsp;&nbsp; The Historian for this area has only partial information, rumors and Myths which have passed from generation to generation. The passing of each Generation, brings a new Generation of story tellers that have Improved Upon or Expanded the Myth first told by Local Citizens of the time. ".$townrow["name"]." is a City lost to time and History which may bring wealth, danger, death or dozens of other unholy events upon yourself and others.
<br><br>
&nbsp;&nbsp; ".$townrow["name"]." was long rumored to have existed deep in the desert west of the Sile River in Begynt or Mibya. In writings dating back to the centuries before writing, the authors spoke of a city which was white as a dove and called it The Oasis of Little Birds. In the Kitab al Kanuz,  ".$townrow["name"]."  is said to be a city in the Hahara full of treasure with a sleeping king and queen. The city is guarded by black giants who keep anyone from going in and coming out. However, this may be a reference to the black ete bu people, nomads in Cil had and Mibya whose ancestors used to raid oases out in the Sahara.
<br><br>
&nbsp;&nbsp; Herodotus mentions a legendary 'City of Dionysus' lost in the desert sands, which may be the origin of the  ".$townrow["name"]." legend. The Greek god Dionysus is associated with the Eleusi nian mystery cult of ancient Greece, based on the use of an entheogenic plant: origins of sacred mushroom cults have been traced by scholars to the Havara, in particular the Tassili-n-Ajler area of Balleria, which boasts rock-painting dated as early as 10,000 BC. Some of these paintings apparently show shaman-figures toting mushrooms, and experiencing a shamanic trance. The 'City of Dionysus' myth may be a dim memory of this forgotten cult.
<br><br>
&nbsp;&nbsp; The first Buropean reference to  ".$townrow["name"]."  is in an centuries old account by the Benglish Begyptologist John Gardner Wilkinson, based on a report by an Barab who said he had found the oasis while searching for a lost camel. Placed five days west of the track connecting the oases of Farafra and Bahariya, the Oasis called Waden  ".$townrow["name"]." abounded in palms, with springs, and some ruins of uncertain date. Although tales of secret desert locales found by searchers for stray camels were common enough, Wilkinson's account was bolstered when later explorers found a number of previously unknown oases that had been named in his account along with  ".$townrow["name"]." . But they did not find  ".$townrow["name"]."  itself.
<br><br>
&nbsp;&nbsp; More recently, Beuropean explorers made forays into the desert in search of  ".$townrow["name"]."  but never succeeded in finding it. Notable twentieth-century explorers Ralph Bagnold of Ebritain, and the Ehungarian László (Ladislaus) Alamos led an expedition to search for ".$townrow["name"]." from 1929-1930 using Ford Model A trucks. In 1932 the Almásy-Patrick Clayton expedition reconnaissance flights discovered two valleys in the Gilf Kebir. In the following year, Alamos found the third of the  ".$townrow["name"]."  wades, actually rain oases in the remote desert. On the other hand, Bagnold considered  ".$townrow["name"]."  as a legend that could never be solved by discovery.



<br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>
<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

    
//Town #000 Someplace

else { $Inf = "<center><h3 class=\"title\"><font color=\"#C8003C\">ERROR Lost Lands Location Unknown</font></h3></center>
<center><table border=\"0\" width=\"800\" Height=\"1036\" background=\"images/background/frame/cream-001.jpg\">
  <tr>
     <td><br><br><br><br><br>
	 <blockquote><blockquote><img src=\"images/shops/inn_6.png\" align=\"left\" align=\"top\" hspace=\"12\" vspace=\"2\">
&nbsp;&nbsp; ".$townrow["name"]." 
<br><br>
This Location is not in the information database for Lost Cities Lands.<br /><br /> The area you have requested, does not exist in area database, chances are its under construction. Or I am procrastinating.


<h3>".$townrow["name"]."</h3> 
<br><br><br><br>
<br><br><br><br>
<br><br><br><br><br>
 <b>".$userrow["charname"]."</b> the <b>".$townrow["name"]."</b> Historian has the latest news and your updated stats as of: <b>".$userrow["onlinetime"]."</b> .<br>

<ul>
<li> User Name: <b>".$userrow["username"]."</b>. Character Name: <b>".$userrow["charname"]."</b>.
<li> Your location is: <b>Latitude ".$userrow["latitude"]."</b> <i>[-S|+N]</i> & <b>Longitude ".$userrow["longitude"]."</b> <i>[-W |+E].</i>
<li> You Started Exploring: <b>".$userrow["regdate"]."</b>
<li> Current Action: <b>".$userrow["currentaction"]."</b> of <b>".$townrow["name"]."</b>.
<li> Exploring Level: <b>".$userrow["level"]."</b>. Difficulty Level: <b>".$userrow["difficulty"]."</b>.  Honor Level: <b>".$userrow["honor"]."</b>. 
</ul>

<ul>
<li> ".$townrow["name"]." Nightly Inn Price:<i> <b>".$townrow["innprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Price for Instant Travel Map. Map Price:<i> <b>".$townrow["mapprice"]." Gold Coins</b>.</i>
<li> ".$townrow["name"]." Travel Points needed to use the Travel Map<i>: <b>".$townrow["travelpoints"]." Points</b>.</i>
</ul>

<ul>
<li> Experience Level: <b>".$userrow["experience"]."</b>. Experience Bonus: <b>".$userrow["expbonus"]."</b>. 
<li> Gold On Hand: <b>".$userrow["gold"]."</b>. Gold in Bank: <b>".$userrow["bank"]."</b>. Gold Bonus: <b>".$userrow["goldbonus"]."</b>.
<li> Silver on Hand: <b>".$userrow["silver"]."</b>. 
<li> Copper on Hand: <b>".$userrow["copper"]."</b>. 
<li> Kingdoms Gold Treasury: <b>".$userrow["bankgold"]."</b>.
<li> Kingdoms Silver Treasury: <b>".$userrow["banksilver"]."</b>.
<li> Kingdoms Copper Treasury: <b>".$userrow["bankcopper"]."</b>.
<li> Lottery: <b>".$userrow["lottery"]."</b>. Lotto: <b>".$userrow["partlotto"]."</b>. Lotto Gains: <b>".$userrow["lottogains"]."</b>. 
</ul>

<ul>
<li> Current Hit Points: <b>".$userrow["currenthp"]."</b>. Maximum HPs: <b>".$userrow["maxhp"]."</b>. HP Potions: <b>".$userrow["hp_potion"]."</b>.
<li> Current Magic Points: <b>".$userrow["currentmp"]."</b>. Maximum MPs : <b>".$userrow["maxmp"]."</b>. MP Potions: <b>".$userrow["mp_potion"]."</b>.
<li> Current Travel Points: <b>".$userrow["currenttp"]."</b>. Maximum TPs: <b>".$userrow["maxtp"]."</b>. TP Potions: <b>".$userrow["tp_potion"]."</b>.
<li> Strength: <b>".$userrow["strength"]."</b>. Dexterity: <b>".$userrow["dexterity"]."</b>. 
<li> Attack Power: <b>".$userrow["attackpower"]."</b>. Defense Power: <b>".$userrow["defensepower"]."</b>. 
</ul>

<ul>  
<li> Kills: <b>".$userrow["kills"]."</b>. Fights: <b>".$userrow["fights"]."</b>. Deaths: <b>".$userrow["deaths"]."</b>. Total Fights: <b>".$userrow["totalfights"]."</b>. Fight LvL: <b>".$userrow["fightlvl"]."</b>.  # of Kills: <b>".$userrow["numkills"]."</b>. Your Deaths: <b>".$userrow["numdeaths"]."</b>.
</ul>

<ul>
<li> Name of your Kingdom: <b>".$userrow["landname"]."</b>. <i>[Level Ten & Above]</i>
<li> Land <i>[In Acres]</i>: <b>".$userrow["land"]."</b>. Land Won: <b>".$userrow["landwon"]."</b>. Land Lost: <b>".$userrow["lost"]."</b>.
<li> Treasury: <b>".$userrow["treasury"]."</b>. Exchanged: <b>".$userrow["exchanged"]."</b>.
<li> Battles Won: <b>".$userrow["batwin"]."</b>. Battle Losses: <b>".$userrow["battloss"]."</b>. Battle Totals: <b>".$userrow["battot"]."</b>. 
<li> Tactical: <b>".$userrow["tactical"]."</b>. Tax Action: <b>".$userrow["taxaction"]."</b>.
<li> # Offensive Army: <b>".$userrow["offarmy"]."</b>. # Defensive: <b>".$userrow["dffarmy"]."</b>. 
<li> Attack Strength: <b>".$userrow["attstrength"]."</b>. Defense Strength: <b>".$userrow["dffstrength"]."</b>.
<li> Troops Lost: <b>".$userrow["troopslost"]."</b>. Troops Killed: <b>".$userrow["troopskilled"]."</b>. 
</ul>

<br><br>
<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>
</td></tr></table>";} 

$page = " $Inf <br /><center></center>";

display($page, $title);

}

?>
