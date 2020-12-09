<?php // index.php :: Primary program script, evil alien overlord, you decide.

if (file_exists('install.php')) { die("Please delete <b>install.php</b> from your Dragon Knight directory before continuing."); }
include('lib.php');
include('cookies.php');

$link = opendb();
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);



// Login (or verify) if not logged in.
$userrow = checkcookies();
if ($userrow == false) { 
    if (isset($_GET["do"])) {
        if ($_GET["do"] == "verify") { header("Location: users.php?do=verify"); die(); }
    }
    header("Location: login.php?do=login"); die(); 
}
// Close game.
if ($controlrow["gameopen"] == 0) { display("<blockquote><blockquote>&nbsp;&nbsp;The game is currently closed for maintanence.<br>dk3133v3 is in the Middle of a major upgrade which will take quite awhile to finish as my knowledge of php is very limited.<br><br>&nbsp;&nbsp;Please check back in a few weeks.</blockquote></blockquote>","Game Closed"); die(); }
// Force verify if the user isn't verified yet.
if ($controlrow["verifyemail"] == 1 && $userrow["verify"] != 1) { header("Location: users.php?do=verify"); die(); }
// Block user if he/she has been banned.
if ($userrow["authlevel"] == 2) { die("Your account has been blocked. Please try back later."); }


// Start resource
	if($userrow["wood"] ) { $wood = '$userrow["wood"]'; }  
	if($userrow["fish"] ) { $fish = '$userrow["fish"]'; }
// End resources
// start profession     

    if($userrow["woodskill"] >= 1) { $status1 = 'WoodCutter'; } 
    if($userrow["fishskill"] >= 1) { $status1 = 'Fisher'; } 

    doquery("UPDATE {{table}} SET status1='$status1' WHERE id='".$userrow["id"]."' ", "users"); 

// End proffesion



if (isset($_GET["do"])) {
   
     $do = explode(":",$_GET["do"]);
			

	
//  START OF SET SOCIAL STATUS
	if($userrow["level"] <= 0)  { $status = 'No Status'; }
	if($userrow["level"] >= 0)  { $status = 'Slave'; }
	if($userrow["level"] >= 2)  { $status = 'Free Slave'; }
	if($userrow["level"] >= 3)  { $status = 'Peasant'; }
    if($userrow["level"] >= 4)  { $status = 'Castle Peasant'; } 
	if($userrow["level"] >= 5)  { $status = 'Free Person'; }
	if($userrow["level"] >= 6)  { $status = 'Latini'; }
	if($userrow["level"] >= 7)  { $status = 'Plebeian'; }
	if($userrow["level"] >= 8)  { $status = 'FreeBorn'; }
	if($userrow["level"] >= 9)  { $status = 'Common Citizen'; }
	if($userrow["level"] >= 10)  { $status = 'Castle Lord'; }
	if($userrow["level"] >= 11)  { $status = 'Vulgus'; }
	if($userrow["level"] >= 12)  { $status = 'Full Citizen'; }
	if($userrow["level"] >= 13)  { $status = 'Concilium Plebis'; }
    if($userrow["level"] >= 14)  { $status = 'Lord Marquis'; }
    if($userrow["level"] >= 15)  { $status = 'Lord Baron'; }
	if($userrow["level"] >= 16)  { $status = 'Domus'; }
	if($userrow["level"] >= 17)  { $status = 'Junian'; }
	if($userrow["level"] >= 18)  { $status = 'Augusta'; }
	if($userrow["level"] >= 19)  { $status = 'Citizen'; }
    if($userrow["level"] >= 20)  { $status = 'Kingdom Maker'; } // Level when you can have a Kingdom
	if($userrow["level"] >= 21)  { $status = 'Counsellor'; }
    if($userrow["level"] >= 22)  { $status = 'Junian Elder'; } 
	if($userrow["level"] >= 23)  { $status = 'Elderman'; }
    if($userrow["level"] >= 24)  { $status = 'Statesman'; }
    if($userrow["level"] >= 25)  { $status = 'Elder Statesman'; } 
    if($userrow["level"] >= 26)  { $status = 'Senior Statesman'; }  
    if($userrow["level"] >= 27)  { $status = 'Prime Citizen'; }  
    if($userrow["level"] >= 28)  { $status = 'Plebiscite'; } 
    if($userrow["level"] >= 29)  { $status = 'Concilium Plebis'; } 
    if($userrow["level"] >= 30)  { $status = 'Baron'; } 
    if($userrow["level"] >= 31)  { $status = 'Land Baron'; }  
    if($userrow["level"] >= 32)  { $status = 'Humiliore'; }  
    if($userrow["level"] >= 33)  { $status = 'Governor'; } 
    if($userrow["level"] >= 34)  { $status = 'Praetor'; } 
    if($userrow["level"] >= 35)  { $status = 'Censor'; } 
	if($userrow["level"] >= 40)  { $status = 'Marquis'; } 
	if($userrow["level"] >= 41)  { $status = 'Maecena'; } 
    if($userrow["level"] >= 45)  { $status = 'Curule Magistracy'; } 
    if($userrow["level"] >= 46)  { $status = 'Equite'; } 
    if($userrow["level"] >= 50)  { $status = 'Mater Castrorum'; } 
    if($userrow["level"] >= 55)  { $status = 'Curule Aedile '; }
	if($userrow["level"] >= 60)  { $status = 'Lord Duke'; }
    if($userrow["level"] >= 63)  { $status = 'Noble'; } 
    if($userrow["level"] >= 65)  { $status = 'Senator'; } 
    if($userrow["level"] >= 66)  { $status = 'Honestiore'; } 
	if($userrow["level"] >= 70)  { $status = 'Clarissimae'; } 
    if($userrow["level"] >= 75)  { $status = 'Marquiser Conquestor'; } 
    if($userrow["level"] >= 80)  { $status = 'Magistrate'; }
    if($userrow["level"] >= 81)  { $status = 'Patrician'; }  
    if($userrow["level"] >= 83)  { $status = 'Patres'; } 
    if($userrow["level"] >= 85)  { $status = 'Lord King'; }
    if($userrow["level"] >= 90)  { $status = 'Consul'; } 
    if($userrow["level"] >= 93)  { $status = 'Emperor'; }
    if($userrow["level"] >= 95)  { $status = 'Lord Emperor'; }
	if($userrow["level"] >= 99)  { $status = 'Prime One'; } 	 
	
	
    doquery("UPDATE {{table}} SET status='$status' WHERE id='".$userrow["id"]."' ", "users"); 
//  END OF SET SOCIAL STATUS		
    
        
	// Town functions.  
	
     
	// Inn.
    if ($do[0] == "inn") { include('towns.php'); inn(); }  
		
	// Church & Magic House
	elseif ($do[0] == "church") {include('towns.php'); church(); }
	elseif ($do[0] == "magichouse") {include('towns.php'); magichouse(); }
	elseif ($do[0] == "tac") {include('index.php'); tac(); }
	elseif ($do[0] == "tac") {include('towns.php'); tac(); }
    elseif ($do[0] == "tac") { include('showchar.php'); tac(); }
   
    // Buy War Items
    elseif ($do[0] == "buy") { include('towns.php'); buy(); }
    elseif ($do[0] == "buy2") { include('towns.php'); buy2($do[1]); }
    elseif ($do[0] == "buy3") { include('towns.php'); buy3($do[1]); }	
	
	elseif ($do[0] == "loja") { include('towns.php'); loja(); }
	elseif ($do[0] == "loja2") { include('towns.php'); loja2($do[1]); }
    elseif ($do[0] == "loja3") { include('towns.php'); loja3($do[1]); }

	elseif ($do[0] == "amro") { include('towns.php'); amro(); }
	elseif ($do[0] == "amro2") { include('towns.php'); amro2($do[1]); }
	elseif ($do[0] == "amro3") { include('towns.php'); amro3($do[1]); }

	elseif ($do[0] == "pxcu") { include('towns.php'); pxcu(); }
	elseif ($do[0] == "pxcu2") { include('towns.php'); pxcu2($do[1]); }
	elseif ($do[0] == "pxcu3") { include('towns.php'); pxcu3($do[1]); }

	elseif ($do[0] == "hzrt") { include('towns.php'); hzrt(); }
	elseif ($do[0] == "hzrt2") { include('towns.php'); hzrt2($do[1]); }
	elseif ($do[0] == "hzrt3") { include('towns.php'); hzrt3($do[1]); }

	elseif ($do[0] == "ghmk") { include('towns.php'); ghmk(); }
	elseif ($do[0] == "ghmk2") { include('towns.php'); ghmk2($do[1]); }
	elseif ($do[0] == "ghmk3") { include('towns.php'); ghmk3($do[1]); }

	elseif ($do[0] == "bmnn") { include('towns.php'); bmnn(); }
	elseif ($do[0] == "bmnn2") { include('towns.php'); bmnn2($do[1]); }
	elseif ($do[0] == "bmnn3") { include('towns.php'); bmnn3($do[1]); }

	elseif ($do[0] == "weaa") { include('towns.php'); weaa(); }
	elseif ($do[0] == "weaa2") { include('towns.php'); weaa2($do[1]); }
	elseif ($do[0] == "weaa3") { include('towns.php'); weaa3($do[1]); }
	

	// Training functions.
    elseif ($do[0] == "train") { include('train.php'); train(); }
	
	// Wiki	
	elseif ($do[0] == "showmonster") { showwiki(); }
    
	// Sell and Drop.
    elseif ($do[0] == "sell") { include('towns.php'); sell(); }
    elseif ($do[0] == "sellitems") { include('sellitems.php'); sellitems(); }
	elseif ($do[0] == "selldrop") { include('broker.php'); selldrop(); }
	elseif ($do[0] == "confirm") { include('broker.php'); confirm(); }
    
	// Maps.                    
    elseif ($do[0] == "maps") { include('towns.php'); maps(); }
    elseif ($do[0] == "maps2") { include('towns.php'); maps2($do[1]); }
    elseif ($do[0] == "maps3") { include('towns.php'); maps3($do[1]); }
   
    // Bank and Broker.
	elseif ($do[0] == "bank") { include('bank_mod.php'); bank(); }
	elseif ($do[0] == "banksilver") { include('banksilver_mod.php'); banksilver(); }
	elseif ($do[0] == "bankcopper") { include('bankcopper_mod.php'); bankcopper(); }
    elseif ($do[0] == "sendgold") { sendgold(); }
    elseif ($do[0] == "robb") { include('robbbank.php'); robb(); }
	elseif ($do[0] == "broker") { include('broker.php'); broker(); }
    
	// Go to town and town inf.
	elseif ($do[0] == "towninf") { include('towninf.php'); towninf(); }
	elseif ($do[0] == "gotown") { include('towns.php'); travelto($do[1]); }
	
	//  MANAGE LAND STUFF
    elseif ($do[0] == "land") { include('kingdoms.php'); land(); }
    elseif ($do[0] == "collect") { include('kingdoms.php'); collect(); }
    elseif ($do[0] == "attack") { include('kingdoms.php'); attack(); }
    elseif ($do[0] == "editland") { include('kingdoms.php'); editland(); }
    elseif ($do[0] == "treasury") { include('kingdoms.php'); treasury(); }

    // Misc functions.
    elseif ($do[0] == "verify") { header("Location: users.php?do=verify"); die(); }
    elseif ($do[0] == "babblebox") { babblebox(); }
    elseif ($do[0] == "ninja") { ninja(); }
    elseif ($do[0] == "sock") { sock(); }
    elseif ($do[0] == "land") { land(); }
    elseif ($do[0] == "collect") { collect(); }
    elseif ($do[0] == "vote") { vote(); }
    elseif ($do[0] == "secret") { include('towns.php'); secret($do[1]); }
    elseif ($do[0] == "secret2") { include('towns.php'); secret2($do[1]); }
	elseif ($do[0] == "enter_map") { include('enter_map.php'); enter_map(); }
	
	// Potions
    elseif ($do[0] == "buypotions") { buy_potions(); }
    elseif ($do[0] == "potion") { use_potion($do[1]); }
    elseif ($do[0] == "potion") { include('charinfo.php'); potion(); }
    elseif ($do[0] == "potion") { include('towns.php'); broker(); }

	// Rohh and Broker
    elseif ($do[0] == "robb") { include('robbbank.php'); robb(); }
	elseif ($do[0] == "broker") { include('broker.php'); broker(); }
    
	// Lists and Top Ten
	elseif ($do[0] == "topten") { include('towns.php'); topten(); }
    elseif ($do[0] == "listusers") { include('towns.php'); listusers(); }
	elseif ($do[0] == "toprich") { include('towns.php'); toprich(); }
	elseif ($do[0] == "viewmembers") { include('viewmembers.php'); viewmembers(); }
    
	// Gambling.
    elseif ($do[0] == "gamble") { include('gamble.php'); gamble(); }
    elseif ($do[0] == "gamble5") { include('gamble5.php'); gamble5(); }
	
	// Loteri.
    elseif ($do[0] == "loteri") { include('loteri.php'); loteri(); }	
    elseif ($do[0] == "loteri10") { include('loteri10.php'); loteri10(); }	
    elseif ($do[0] == "loteri50") { include('loteri50.php'); loteri50(); }	
    elseif ($do[0] == "loteri100") { include('loteri100.php'); loteri100(); }
	
	// Dice.
	elseif ($do[0] == "dice") { include('dice.php'); dice(); }
	elseif ($do[0] == "dicingbet") { include('dice.php'); dicingbet(); }	
	elseif ($do[0] == "dice1") { include('dice1.php'); dice1(); }
	elseif ($do[0] == "dicingbet1") { include('dice1.php'); dicingbet1(); }	
	elseif ($do[0] == "dice2") { include('dice2.php'); dice2(); }
	elseif ($do[0] == "dicingbet2") { include('dice2.php'); dicingbet2(); }	
	elseif ($do[0] == "dice3") { include('dice3.php'); dice3(); }
	elseif ($do[0] == "dicingbet3") { include('dice3.php'); dicingbet3(); }		
	elseif ($do[0] == "dice4") { include('dice4.php'); dice4(); }
	elseif ($do[0] == "dicingbet4") { include('dice4.php'); dicingbet4(); }	
   
    // Skill.
    elseif ($do[0] == "skills") { include('towns.php'); skills(); }
    
	// News.
    elseif ($do[0] == "oldernews") { include('oldernews.php'); oldernews(); }
	
	// Start resource
 	elseif ($do[0] == "woodcut") {include('towns.php'); woodcut(); }
 	elseif ($do[0] == "sellwood") {include('towns.php'); sellwood(); }
 	elseif ($do[0] == "un") {include('towns.php'); un(); }
	elseif ($do[0] == "fish") {include('towns.php'); fish(); }
	elseif ($do[0] == "ranger") {include('towns.php'); ranger(); }
 	elseif ($do[0] == "sellfish") {include('towns.php'); sellfish(); }
 	elseif ($do[0] == "market") {include('towns.php'); market(); }
	elseif ($do[0] == "resources") { resources(); }
	// End resource
		      	
	// Clan Functions
    elseif ($do[0] == "clans") { include('clan.php'); clans(); }
    elseif ($do[0] == "leave") { include('clan.php'); leave(); }
    elseif ($do[0] == "create") { include('clan.php'); create(); }
    elseif ($do[0] == "rank") { include('clan.php'); rank($do[1]); }
    elseif ($do[0] == "kick") { include('clan.php'); kick($do[1]); }
    elseif ($do[0] == "yes") { include('clan.php'); yes($do[1]); }
    elseif ($do[0] == "use") { include('clan.php'); application($do[1]); }
    elseif ($do[0] == "no") { include('clan.php'); no($do[1]); }

	// Exploring functions.
    elseif ($do[0] == "move") { include('explore.php'); move(); }
    elseif ($do[0] == "move") { include('exploremap.php'); move(); }
	
    // Fighting functions.
    elseif ($do[0] == "fight") { include('fight.php'); fight(); }
    elseif ($do[0] == "victory") { include('fight.php'); victory(); }
    elseif ($do[0] == "drop") { include('fight.php'); drop(); }
    elseif ($do[0] == "dead") { include('fight.php'); dead(); } 

    // Start PVP
	elseif ($do[0] == "mainfight") { include('pvpfight.php'); mainfight(); }
	elseif ($do[0] == "pvpfight") { include('pvpfight.php'); pvpfight(); }
	elseif ($do[0] == "pvpfight2") { include('pvpfight.php'); pvpfight2(); }
	elseif ($do[0] == "pvpfight3") { include('pvpfight.php'); pvpfight3($do[1]); }
	elseif ($do[0] == "pvpfight4") { include('pvpfight.php'); pvpfight4($do[1]); }
     //End PVP	

	
	 // Questing functions.
    elseif ($do[0] == "quest") { include('quest.php'); quest(); }
    elseif ($do[0] == "questvictory") { include('quest.php'); questvictory(); }
    elseif ($do[0] == "questdrop") { include('quest.php'); questdrop(); }
    elseif ($do[0] == "getquests") { include('quests_available.php'); displayQuests(); }
    elseif ($do[0] == "viewquest") { include('quests_available.php'); viewQuest(); }
    elseif ($do[0] == "acceptquest") { include('quests_available.php'); acceptQuest(); }
    elseif ($do[0] == "questlog") { questLog(); }
    elseif ($do[0] == "showquest") { showQuestLog(); }
	
	//  Jail
	elseif ($do[0] == "jail") { include('jail.php'); jail(); }
	
	//  Char Functions
    elseif ($do[0] == "editinfo") { include('charinfo.php'); editinfo(); }	
	elseif ($do[0] == "avatar") { include('charinfo.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('showchar.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('towns.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('leftnav.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('rightnav.php'); avatar(); } 
    elseif ($do[0] == "showchar") { showchar(); }
    elseif ($do[0] == "showchar") { include('towns.php'); showchar(); }
    elseif ($do[0] == "onlinechar") { onlinechar($do[1]); }
    elseif ($do[0] == "onlinechar") { include('towns.php'); onlinechar(); }
    elseif ($do[0] == "showmap") { showmap(); }
	elseif ($do[0] == "showmonster") { showwiki(); }
	elseif ($do[0] == "avatar") { rightnav(); }
    elseif ($do[0] == "avatar") { avatar(); }

	// Check Images Functions
    elseif ($do[0] == "ihasalist") { include('towns.php'); ihasalist(); }
	  	
	// Training functions
	elseif ($do[0] == "gym") { include('towns.php'); gym (); }
	
	// Spells.
    elseif ($do[0] == "spell") { include('heal.php'); healspells($do[1]); }
	
	// Hall of Fame
    elseif ($do[0] == "hof") { include('hof.php'); hof($do[1]); }
    elseif ($do[0] == "richestbygold") { include('hof.php'); richestbygold($do[1]); }
    elseif ($do[0] == "richestbybank") { include('hof.php'); richestbybank(); }
    elseif ($do[0] == "highesthp") { include('hof.php'); highesthp(); }
    elseif ($do[0] == "highesttp") { include('hof.php'); highesttp(); }
    elseif ($do[0] == "highestmp") { include('hof.php'); highestmp(); }
    elseif ($do[0] == "highestlevel") { include('hof.php'); highestlevel(); }
    elseif ($do[0] == "highestxp") { include('hof.php'); highestxp(); }
    elseif ($do[0] == "higheststr") { include('hof.php'); higheststr(); }
    elseif ($do[0] == "highestdef") { include('hof.php'); highestdef(); }
    elseif ($do[0] == "highestdex") { include('hof.php'); highestdex(); }
    elseif ($do[0] == "highestatk") { include('hof.php'); highestatk(); }
    elseif ($do[0] == "highestdifficulty") { include('hof.php'); highestdifficulty(); }
    elseif ($do[0] == "highestregdate") { include('hof.php'); highestregdate(); }
    elseif ($do[0] == "highestonlinetime") { include('hof.php'); highestonlinetime(); }
    elseif ($do[0] == "highestexpbonus") { include('hof.php'); highestexpbonus(); }
    elseif ($do[0] == "highestgoldbonus") { include('hof.php'); highestgoldbonus(); }
    elseif ($do[0] == "highestfightlvl") { include('hof.php'); highestfightlvl(); }
    elseif ($do[0] == "highestkills") { include('hof.php'); highestkills(); }
    elseif ($do[0] == "highestdeaths") { include('hof.php'); highestdeaths(); }
    elseif ($do[0] == "highesttotalfights") { include('hof.php'); highesttotalfights(); }
	// End Hall of Fame 
	
	// Exchange Functions
	elseif ($do[0] == "exchange") { include('exchange.php'); expforgold(); 
	elseif ($do[0] == "exchange") { include('exchange.php'); expforsilver(); }
	
    // My functions
	elseif ($do[0] == "form") { include('towns.php'); form (); }
	elseif ($do[0] == "form2") { include('towns.php'); form2 (); }
	
    elseif ($do[0] == "guilds") { include('towns.php'); guilds(); }
    elseif ($do[0] == "showwiki") { include('rightnav.php'); wiki(); }
    elseif ($do[0] == "wiki") { include('leftnav.php'); wiki(); }
    elseif ($do[0] == "wiki") { include('onlinechar.php'); wiki(); }
    elseif ($do[0] == "showwiki") { include('towns.php'); wiki(); }
	
    // NPC functions.
	elseif ($do[0] == "npclist") { include('npc.php'); npclist(); }
    elseif ($do[0] == "npc") { include('npc.php'); npc($do[1]); }
    elseif ($do[0] == "npcanswer1") { include('npc.php'); npcanswer($do[1],1); }
    elseif ($do[0] == "npcanswer2") { include('npc.php'); npcanswer($do[1],2); }
    elseif ($do[0] == "npcanswer3") { include('npc.php'); npcanswer($do[1],3); }
    elseif ($do[0] == "npcanswer4") { include('npc.php'); npcanswer($do[1],4); }
    elseif ($do[0] == "npcanswer5") { include('npc.php'); npcanswer($do[1],5); }
	
	
	
	// Town functions.	   

} else { donothing(); }

function donothing() {
    
    global $userrow, $page, $title;

    if ($userrow["currentaction"] == "In Town") {
        $page = dotown();
        $title = "In Town";
    } elseif ($userrow["currentaction"] == "Exploring") {
        $page = doexplore();
        $title = "Exploring";
    } elseif ($userrow["currentaction"] == "Fighting")  {
        $page = dofight();
        $title = "Fighting";
    } elseif ($userrow["currentaction"] == "Quest Event") {
        $page = doquest();
        $title = "Quest Event";
    }
    
    display($page, $title);
    
}
// End Donothing


// Start Resources
function resources() {
    
    global $userrow, $controlrow;
    
    // Format various userrow stuffs.
    $userrow["experience"] = number_format($userrow["experience"]);
    $userrow["gold"] = number_format($userrow["gold"]);
    if ($userrow["expbonus"] > 0) { 
        $userrow["plusexp"] = "<span class=\"light\">(+".$userrow["expbonus"]."%)</span>"; 
    } elseif ($userrow["expbonus"] < 0) {
        $userrow["plusexp"] = "<span class=\"light\">(".$userrow["expbonus"]."%)</span>";
    } else { $userrow["plusexp"] = ""; }
    if ($userrow["goldbonus"] > 0) { 
        $userrow["plusgold"] = "<span class=\"light\">(+".$userrow["goldbonus"]."%)</span>"; 
    } elseif ($userrow["goldbonus"] < 0) { 
        $userrow["plusgold"] = "<span class=\"light\">(".$userrow["goldbonus"]."%)</span>";
    } else { $userrow["plusgold"] = ""; }	
    if ($userrow["silverbonus"] > 0) { 
        $userrow["plussilver"] = "<span class=\"light\">(+".$userrow["silverbonus"]."%)</span>"; 
    } elseif ($userrow["silverbonus"] < 0) { 
        $userrow["plussilver"] = "<span class=\"light\">(".$userrow["silverbonus"]."%)</span>";
    } else { $userrow["plussilver"] = ""; }	
    if ($userrow["copperbonus"] > 0) { 
        $userrow["pluscopper"] = "<span class=\"light\">(+".$userrow["copperbonus"]."%)</span>"; 
    } elseif ($userrow["copperbonus"] < 0) { 
        $userrow["pluscopper"] = "<span class=\"light\">(".$userrow["copperbonus"]."%)</span>";
    } else { $userrow["pluscopper"] = ""; }
    
    $levelquery = doquery("SELECT ". $userrow["charclass"]."_exp FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels");
    $levelrow = mysql_fetch_array($levelquery);
    if ($userrow["level"] < 300) { $userrow["nextlevel"] = number_format($levelrow[$userrow["charclass"]."_exp"]); } else { $userrow["nextlevel"] = "<span class=\"light\">None</span>"; }

    if ($userrow["charclass"] == 1) { $userrow["charclass"] = $controlrow["class1name"]; }
    elseif ($userrow["charclass"] == 2) { $userrow["charclass"] = $controlrow["class2name"]; }
    elseif ($userrow["charclass"] == 3) { $userrow["charclass"] = $controlrow["class3name"]; }
    elseif ($userrow["charclass"] == 4) { $userrow["charclass"] = $controlrow["class4name"]; }
    elseif ($userrow["charclass"] == 5) { $userrow["charclass"] = $controlrow["class5name"]; }
    elseif ($userrow["charclass"] == 6) { $userrow["charclass"] = $controlrow["class6name"]; }
    elseif ($userrow["charclass"] == 7) { $userrow["charclass"] = $controlrow["class7name"]; }
    elseif ($userrow["charclass"] == 8) { $userrow["charclass"] = $controlrow["class8name"]; }
    elseif ($userrow["charclass"] == 9) { $userrow["charclass"] = $controlrow["class9name"]; }
    elseif ($userrow["charclass"] == 10) { $userrow["charclass"] = $controlrow["class10name"]; }
    elseif ($userrow["charclass"] == 11) { $userrow["charclass"] = $controlrow["class11name"]; }
    elseif ($userrow["charclass"] == 12) { $userrow["charclass"] = $controlrow["class12name"]; }
    elseif ($userrow["charclass"] == 13) { $userrow["charclass"] = $controlrow["class13name"]; }
    elseif ($userrow["charclass"] == 14) { $userrow["charclass"] = $controlrow["class14name"]; }
    elseif ($userrow["charclass"] == 15) { $userrow["charclass"] = $controlrow["class15name"]; }
    elseif ($userrow["charclass"] == 16) { $userrow["charclass"] = $controlrow["class16name"]; }
    elseif ($userrow["charclass"] == 17) { $userrow["charclass"] = $controlrow["class17name"]; }
    elseif ($userrow["charclass"] == 18) { $userrow["charclass"] = $controlrow["class18name"]; }
    elseif ($userrow["charclass"] == 19) { $userrow["charclass"] = $controlrow["class19name"]; }
    elseif ($userrow["charclass"] == 20) { $userrow["charclass"] = $controlrow["class20name"]; }
    elseif ($userrow["charclass"] == 21) { $userrow["charclass"] = $controlrow["class21name"]; }	
    elseif ($userrow["charclass"] == 22) { $userrow["charclass"] = $controlrow["class22name"]; }
    elseif ($userrow["charclass"] == 23) { $userrow["charclass"] = $controlrow["class23name"]; }
    elseif ($userrow["charclass"] == 24) { $userrow["charclass"] = $controlrow["class24name"]; }
    elseif ($userrow["charclass"] == 25) { $userrow["charclass"] = $controlrow["class25name"]; }
    elseif ($userrow["charclass"] == 26) { $userrow["charclass"] = $controlrow["class26name"]; }
    elseif ($userrow["charclass"] == 27) { $userrow["charclass"] = $controlrow["class27name"]; }
    elseif ($userrow["charclass"] == 28) { $userrow["charclass"] = $controlrow["class28name"]; }
    elseif ($userrow["charclass"] == 29) { $userrow["charclass"] = $controlrow["class29name"]; }
    elseif ($userrow["charclass"] == 30) { $userrow["charclass"] = $controlrow["class30name"]; }
    elseif ($userrow["charclass"] == 31) { $userrow["charclass"] = $controlrow["class31name"]; }	
    elseif ($userrow["charclass"] == 32) { $userrow["charclass"] = $controlrow["class32name"]; }
    elseif ($userrow["charclass"] == 33) { $userrow["charclass"] = $controlrow["class33name"]; }
    elseif ($userrow["charclass"] == 34) { $userrow["charclass"] = $controlrow["class34name"]; }
    elseif ($userrow["charclass"] == 35) { $userrow["charclass"] = $controlrow["class35name"]; }
    elseif ($userrow["charclass"] == 36) { $userrow["charclass"] = $controlrow["class36name"]; }
    elseif ($userrow["charclass"] == 37) { $userrow["charclass"] = $controlrow["class37name"]; }
    elseif ($userrow["charclass"] == 38) { $userrow["charclass"] = $controlrow["class38name"]; }
    elseif ($userrow["charclass"] == 39) { $userrow["charclass"] = $controlrow["class39name"]; }
    elseif ($userrow["charclass"] == 40) { $userrow["charclass"] = $controlrow["class40name"]; }
    elseif ($userrow["charclass"] == 41) { $userrow["charclass"] = $controlrow["class41name"]; }	
    elseif ($userrow["charclass"] == 42) { $userrow["charclass"] = $controlrow["class42name"]; }
    elseif ($userrow["charclass"] == 43) { $userrow["charclass"] = $controlrow["class43name"]; }
    elseif ($userrow["charclass"] == 44) { $userrow["charclass"] = $controlrow["class44name"]; }
    elseif ($userrow["charclass"] == 45) { $userrow["charclass"] = $controlrow["class45name"]; }
    elseif ($userrow["charclass"] == 46) { $userrow["charclass"] = $controlrow["class46name"]; }
    elseif ($userrow["charclass"] == 47) { $userrow["charclass"] = $controlrow["class47name"]; }
    elseif ($userrow["charclass"] == 48) { $userrow["charclass"] = $controlrow["class48name"]; }
    elseif ($userrow["charclass"] == 49) { $userrow["charclass"] = $controlrow["class49name"]; }
    elseif ($userrow["charclass"] == 50) { $userrow["charclass"] = $controlrow["class50name"]; }
    elseif ($userrow["charclass"] == 51) { $userrow["charclass"] = $controlrow["class51name"]; }
    elseif ($userrow["charclass"] == 52) { $userrow["charclass"] = $controlrow["class52name"]; }


    //  START CHARACTER ALIGNMENT ARRAY
    if ($userrow["charalign"] == 1) { $userrow["charalign"] = $controlrow["align1name"]; }
    elseif ($userrow["charalign"] == 2) { $userrow["charalign"] = $controlrow["align2name"]; }
    elseif ($userrow["charalign"] == 3) { $userrow["charalign"] = $controlrow["align3name"]; }
    elseif ($userrow["charalign"] == 4) { $userrow["charalign"] = $controlrow["align4name"]; }
    elseif ($userrow["charalign"] == 5) { $userrow["charalign"] = $controlrow["align5name"]; }
    elseif ($userrow["charalign"] == 6) { $userrow["charalign"] = $controlrow["align6name"]; }
    elseif ($userrow["charalign"] == 7) { $userrow["charalign"] = $controlrow["align7name"]; }
    //  END CHARACTER ALIGNMENT ARRAY
	
    if ($userrow["difficulty"] == 1) { $userrow["difficulty"] = $controlrow["diff1name"]; }
    elseif ($userrow["difficulty"] == 2) { $userrow["difficulty"] = $controlrow["diff2name"]; }
    elseif ($userrow["difficulty"] == 3) { $userrow["difficulty"] = $controlrow["diff3name"]; }
    elseif ($userrow["difficulty"] == 4) { $userrow["difficulty"] = $controlrow["diff4name"]; }
    elseif ($userrow["difficulty"] == 5) { $userrow["difficulty"] = $controlrow["diff5name"]; }
    elseif ($userrow["difficulty"] == 6) { $userrow["difficulty"] = $controlrow["diff6name"]; }
    elseif ($userrow["difficulty"] == 7) { $userrow["difficulty"] = $controlrow["diff7name"]; }
    elseif ($userrow["difficulty"] == 8) { $userrow["difficulty"] = $controlrow["diff8name"]; }
    elseif ($userrow["difficulty"] == 9) { $userrow["difficulty"] = $controlrow["diff9name"]; }
    elseif ($userrow["difficulty"] == 10) { $userrow["difficulty"] = $controlrow["diff10name"]; }
    elseif ($userrow["difficulty"] == 11) { $userrow["difficulty"] = $controlrow["diff11name"]; }
    
    $spellquery = doquery("SELECT id,name FROM {{table}}","spells");
    $userspells = explode(",",$userrow["spells"]);
    $userrow["magiclist"] = "";
    while ($spellrow = mysql_fetch_array($spellquery)) {
        $spell = false;
        foreach($userspells as $a => $b) {
            if ($b == $spellrow["id"]) { $spell = true; }
        }
        if ($spell == true) {
            $userrow["magiclist"] .= $spellrow["name"]."<br />";
        }
    }
    if ($userrow["magiclist"] == "") { $userrow["magiclist"] = "None"; }
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    
    $charsheet = gettemplate("resources");
    $page = $xml . gettemplate("minimal");
    $array = array("content"=>parsetemplate($charsheet, $userrow), "title"=>"Character Information");
    echo parsetemplate($page, $array);
    die();
    
}
// End Resources







// Start Potions

function use_potion($type)
{
  global $userrow, $numqueries;
  
  if($type == 1)
  {
    $current = "currenthp"; $max = "maxhp"; $type = "hp_potion"; if($userrow["hp_potion"] == 0){ 
	$page = "<center><h3 class='title'>Using a Potion<h3><br /><br /><b>You Do Not Have Enough Hit Potions.
	<br /><br /><a href='index.php' class='myButton2'>Town Square</a></b></center>"; $die = true; }
  }
  
  if($type == 2)
  {
    $current = "currentmp"; $max = "maxmp"; $type = "mp_potion"; if($userrow["mp_potion"] == 0){  
	$page .= "<center><h3 class='title'>Using a Potion<h3><br /><br /><b>You Do Not Have Enough Magic Potions.
	<br /><br /><a href='index.php' class='myButton2'>Town Square</a></b></center>"; $die = true; }
  }
  
  if($type == 3)
  {
    $current = "currenttp"; $max = "maxtp"; $type = "tp_potion"; if($userrow["tp_potion"] == 0){  
	$page .= "<center><h3 class='title'>Using a Potion<h3><br /><br /><b>You Do Not Have Enough Travel Potions.
	<br /><br /><a href='index.php' class='myButton2'>Town Square</a></b></center>"; $die = true; }
  }
  
  if($die == false)
  {
    if($userrow["currentaction"] == "Fighting")
    {
      $page = "<center><h3 class='title'>Using a Potion<h3></center>
	  <br /><br /><Blockquote><b>Twinkie Winks and Sugar Canes! The Monster Snatches The Potion From You Before You Can Drink It
	  <br /><br /><a href='index.php' class='myButton2'>Town Square</a></b></Blockquote>";
      $die = true;
      doquery("UPDATE {{table}} SET `$type` = `$type` - '1' WHERE `id` = '".$userrow["id"]."'", "users");
    }
    
    if($userrow[$current] == $userrow[$max] && $die == false)
    {
      $page = "<center><h3 class='title'>Using a Potion<h3></center>
	  <br /><br /><Blockquote><b>You don not need to use this Potion, You are at your maximum.
	  <br /><br /><a href='index.php' class='myButton2'>Town Square</a></b></Blockquote>";
      $die = true;
    }
    
    if($die == false)
    {	  
      $page = "<center><h3 class='title'>Using a Potion<h3>
	  <br /><br /><Blockquote><b>You Successfully Used A Potion.
	  <br /><br /><a href='index.php' class='myButton2'>Town Square</a></b></Blockquote></center>";
      $toheal = floor($userrow[$max] / 3);
      $new = $userrow[$current] + $toheal;
      if($new > $userrow[$max]){ $new = $userrow[$max]; }
      doquery("UPDATE {{table}} SET `$type` = `$type` - '1', `$current` = '$new' WHERE `id` = '".$userrow["id"]."'", "users");
    }
  }
  
  display($page, "Potions");
}

function buy_potions()
{
  
  global $userrow;
  
  $townquery = doquery("SELECT name,innprice FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
  if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "Error"); }
  
  $hp_multiplyer = 2.20;
  $mp_multiplyer = 2.10;
  $tp_multiplyer = 2.50;
  
  $hp_price = pow($userrow["level"], $hp_multiplyer);
  $mp_price = pow($userrow["level"], $mp_multiplyer);
  $tp_price = pow($userrow["level"], $tp_multiplyer);
  
  $type = $_GET['buy'];
  
  if($type == 1)
  {
    $price = $hp_price;
    if($price > $userrow["gold"])
	{ 
	$page = "<center><h3 class='title'>Potion Shop<h3><BR /><BR />
	<Blockquote><b>You do not have the Gold to buy a Hit Potion.</b><br /></Blockquote></center>"; $die = true; }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `hp_potion` = `hp_potion` + '1', `gold` = `gold` - '$price' WHERE `id` = '".$userrow["id"]."'", "users");
	  $page = "<center><h3 class='title'>Potion Shop<h3></center>
	  <center><Blockquote><b>You Successfully Bought A Hit Potion.</b><br /></Blockquote></center>";
    }
  }
  
  if($type == 2)
  {
    $price = $mp_price;
    if($price > $userrow["gold"]){ 
	$page = "<center><h3 class='title'>Potion Shop<h3></center>
	  <center><Blockquote><b>You do not have the Gold to buy a Magic Potion.</b><br /></Blockquote></center>"; $die = true; }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `mp_potion` = `mp_potion` + '1', `gold` = `gold` - '$price' WHERE `id` = '".$userrow["id"]."'", "users");
	  $page = "<center><h3 class='title'>Potion Shop<h3></center></center><Blockquote><b>You Successfully Bought A Magic Potion.</b><br /></center></Blockquote>";
    }
  }
  
  if($type == 3)
  {
    $price = $tp_price;
    if($price > $userrow["gold"]){ 
	$page = "<center><h3 class='title'>Potion Shop<h3></center><center><Blockquote><b>You do not have the Gold to buy a Travel Potion.</b><br /></Blockquote></center>"; $die = true; }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `tp_potion` = `tp_potion` + '1', `gold` = `gold` - '$price' WHERE `id` = '".$userrow["id"]."'", "users");
	  $page = "<center><h3 class='title'>Potion Shop<h3></center><b><center><Blockquote><b>You Successfully Bought A Travel Potion.</b><br /></Blockquote></center>";
    }
  }
  
  
  
  $userrow = checkcookies();
  $page .= "<center><h3 class='title'>What Magic Potion to you want the School to Brew?<h3></center>";
  $page .= "<table align='center' border='0' background='images/background/magic/magic-001.png' cellpadding='0' cellspacing='0' height='914' width='800'><tr><td>";

  $page .= "<center><br><br><br><br><br><br><br><br><br><br><br><form method='post'><table border='0' width='610'>
  <tr>
     <td height='152' width='340'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td border='0' background='images/background/magic/paper300x152.png' height='152' width='300'><br><center>
	 <h5><b>Buy Hit Points Potion Bottles
	 <br>Price per Spell: ".number_format($hp_price)." Gold Coins
	 <br>Presently you have: ".number_format($userrow["hp_potion"])." Potions
	 <br><img src='images/items/potion-red.png' alt='Hit Points Potion'/>
	 <br><a href='index.php?do=buypotions&buy=1' class='myButton2'>Buy</a></h5> 
	 </center></td> 
  </tr>
  <tr>
     <td border='0' background='images/background/magic/paper300x152.png' height='152' width='300'><br><center>
	 <h5><b>Buy Magic Points Potion Bottles
	 <br>Price per Spell: ".number_format($mp_price)." Gold Coins
	 <br>Presently you have: ".number_format($userrow["mp_potion"])." Potions
	 <br><img src='images/items/potion-green.png' alt='Magic Points Potion'/>
	 <br><a href='index.php?do=buypotions&buy=2' class='myButton2'>Buy</a></h5>
	 </center></td>
     <td height='152' width='340'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
     <td height='152' width='340'>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td border='0' background='images/background/magic/paper300x152.png' height='152' width='300'><br><center>
	 <h5><b>Buy Travel Points Potion Bottles
	 <br>Price per Spell: ".number_format($tp_price)." Gold Coins
	 <br>Presently you have: ".number_format($userrow["tp_potion"])." Potions
	 <br><img src='images/items/potion-blue.png' alt='Travel Points Potion'/>
	 <br><a href='index.php?do=buypotions&buy=3' class='myButton2'>Buy</a></h5>
	 </center></td>
  </tr>
  <tr>
  <td colspan='2'><br><br><center><a href='index.php?do=towninf' class='myButton2'>Back To Town</a></b></center></td>
  </tr>
  </table></td>
  </tr>
  </table></center>";
  
  display($page, "Potion Store");
  
}


// End Potions

function dotown() { // Spit out the main town page.
    
    global $userrow, $controlrow, $numqueries;
    
    $townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
    if (mysql_num_rows($townquery) == 0) { display("There is an error with your user account, or with the town data. Please try again.","Error"); }
    $townrow = mysql_fetch_array($townquery);
    
    // News box. Grab latest news entry and display it. Something a little more graceful coming soon maybe.
    if ($controlrow["shownews"] == 1) { 
        $newsquery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 1", "news");
        $newsrow = mysql_fetch_array($newsquery);
        $townrow["news"] = "<table width=\"98%\"><tr><td><center><h3 class=\"title\">Latest News</h3></center></td></tr><tr><td>\n";
        $townrow["news"] .= "<span class=\"light\">[".prettydate($newsrow["postdate"])."]</span><br />".nl2br($newsrow["content"]);
        $townrow["news"] .= "</td></tr></table>\n";
    } else { $townrow["news"] = ""; }
    
    // Who's Online. Currently just members. Guests maybe later.
    if ($controlrow["showonline"] == 1) {
        $onlinequery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-1800)."' ORDER BY charname", "users");
        $townrow["whosonline"] = "<table width=\"98%\"><tr><td><center><h3 class=\"title\">Who's Online</h3></center></td></tr><tr><td>\n";
        $townrow["whosonline"] .= "There are <b>" . mysql_num_rows($onlinequery) . "</b> user(s) online within the last 30 minutes: ";
        while ($onlinerow = mysql_fetch_array($onlinequery)) { $townrow["whosonline"] .= "<a href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a>" . ", "; }
        $townrow["whosonline"] = rtrim($townrow["whosonline"], ", ");
        $townrow["whosonline"] .= "</td></tr>\n";

$townrow["whosonline"] .= "<tr><td><center><h3 class=\"title\">Top 10 Richest Fighters</h3></center></td></tr>";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 10", "users");
$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
$townrow["whosonline"] .= "<tr><td><b>$rank.&nbsp;</b><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a> &nbsp;&nbsp;Gold: <b>".number_format($toprow["gold"])."</b></td></tr>\n";
$rank++;
    }
    $townrow["whosonline"] .= "</table>\n";


}
  else { $townrow["whosonline"] = ""; }
    
    if ($controlrow["showbabble"] == 1) {
        $townrow["babblebox"] = "<table width=\"98%\"><tr><td><center><h3 class=\"title\">Babble Box</h3></center></td></tr><tr><td>\n";

$townrow["babblebox"] .= "<div style=\"border: 0px;\" id=\"chat\"></div>";
$townrow["babblebox"]  .= "<center><input type=\"text\" id=\"babble\" size=\"100\" maxlength=\"120\" /><br /><input type=\"button\" onclick=\"babble();\" id=\"submit\" value=\"Babble\"  class=\"myButton2\" /> <input type=\"button\" id=\"reset\" value=\"Clear\" class=\"myButton2\" /></center>";

        $townrow["babblebox"] .= "</td></tr></table>\n";
        

    } else { $townrow["babblebox"] = ""; }
    
    $page = gettemplate("towns");
    $page = parsetemplate($page, $townrow);
    
    return $page;
    
}

// 69 Random non-combat statements

function doexplore() { // Just spit out a blank exploring page.
$explor = rand(1,15); // Default is 69


// $page="you are exploring, but don't see anything of great interest";}

// Woods

if ($explor == 1) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/1.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds you come upon another group of Trees, You see nothing of interest that demands your attention in this wildness of endless Woods.</td></tr></table>";}

if ($explor == 2) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/2.png' title='Random Woods'/></div>
<br>You continue your long Journey into the unknown. Only to come upon more mysterious and unexplorable blanklet of trees to explore!  You take careful notes of the unsurveyed woods that surrounds all before you.  Seeing nothing of interest you make a Travel Memo in you notebook and turn your attention to your travels.</td></tr></table>";}

if ($explor == 3) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/3.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 4) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/4.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 5) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/5.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 6) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/6.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 7) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/7.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 8) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/8.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 9) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/9.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 10) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/10.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 11) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/11.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 12) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/12.png' title='Random Woods'/></div>
<br>You continue your long Journey into the unknown. Only to come upon more mysterious and unexplorable blanklet of trees to explore!  You take careful notes of the unsurveyed woods that surrounds all before you.  Seeing nothing of interest you make a Travel Memo in you notebook and turn your attention to your travels.</td></tr></table>";}

if ($explor == 13) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/13.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 14) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/14.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

if ($explor == 15) {
$page="<table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/15.png' title='Random Woods'/></div>
<br>As you continue to explore your surrounds, you see nothing of interest but at the same time that we should be earnest to explore and learn all things! Sadly your is time limited. You need to turn your attention back to the endless journey.</td></tr></table>";}

// Dead Woods



// End of Random Exploring





    // Exploring without a GET string is normally when they first log in, or when they've just finished fighting.
    
$page = <<<END
<table width="100%">
<u>
<tr><td><center><h3 class="title">Exploring</h3></center></td></tr>
<tr><td>
$page
</td></tr>
</table>
END;

    return $page;
        
}


function dofight() { // Redirect to fighting.
    
    header("Location: index.php?do=fight");
    
}



function doquest() { // Redirect to questing.
    
    header("Location: index.php?do=quest");
    
}

function questLog() {

	global $userrow;
	
	$query = doquery2("SELECT DISTINCT a.id,a.name FROM {{table1}} a, {{table2}} b WHERE user_id = '".$userrow["id"]."' AND status = '0' AND a.id = b.quest_id","quests","questprogress");
	$rows = mysql_num_rows($query);
	$page = "<center><table width='200'><tr><td><center><h3 class='title'>Quest Log</h3></center></td></tr>";
	$page .= "<tr><td><center>";
	if ($rows == 0)
	{
		$page .= "Your quest log is currently empty.";
	} else {

		$i=0;
		while($i < $rows)
		{
			$name = mysql_result($query,$i,"name");
			$id = mysql_result($query,$i,"id");
			$page .= "<li><a href=\"index.php?do=showquest&id=" . $id . "\">" . $name . "</a></li>";
			$i++;
		}
	}
	$page .= "</center></td></tr></table></center>";
	$pagearray = array();
	$pagearray["content"] = $page;
	$pagearray["title"] = "Quest Log";
      
	// Finalize page and display it.
   	$template = gettemplate("minimal");
    	echo parsetemplate($template,$pagearray);
      die();
}

function showQuestLog()
{
	global $userrow;

	$page = "<center><table width='200'><tr><td><center><h3 class='title'>Quest Log</h3></center></td></tr>";
	$page .= "<tr><td><center>";


	// make sure an id was passed in
	if (!isset($_GET["id"])) {
		$page .= "No id passed in!";
	}
	else
	{

		$questid = explode(":",$_GET["id"]);
		$id = $questid[0];

		// make sure id passed in is valid
		if (isNaN($id))
		{
			$page .= "Invalid ID passed in!";
		}
		else
		{

			// make sure player is on this quest...
			$query = doquery("SELECT * FROM {{table}} WHERE user_id = '" .$userrow["id"]. "' AND quest_id = '" .$id. "' LIMIT 1","questprogress");
			if (mysql_num_rows($query) != 1)
			{
				$page .= "You are not eligible to view the quest you have requested.";
			}
			else
			{
				// get quest info 
				$questresult = doquery("SELECT * FROM {{table}} WHERE id = '" .$id. "' LIMIT 1","quests");
				if (mysql_num_rows($questresult) != 1)
				{
					$page .= "Error looking up quest info!";
				}
				else
				{
					$questrow = mysql_fetch_array($questresult);
					$name = $questrow["name"];
					$text = nl2br($questrow["begin_text"]);
					$rewardexp = $questrow["reward_exp"];
					$rewardgold = $questrow["reward_gold"];
					$dropid = $questrow["drop_id"];
					$dropname = "";
					$dropbonus1 = "";
					$dropbonus2 = "";
					$dropinfo = "";

					if ($dropid != 0)
					{
						$dropquery = doquery("SELECT * FROM {{table}} WHERE id = '" . $dropid . "'","drops");
						$droprow = mysql_fetch_array($dropquery);
		
						$attributearray = array("maxhp"=>"Max HP",
                            						"maxmp"=>"Max MP",
                            						"maxtp"=>"Max TP",
                            						"defensepower"=>"Defense Power",
                            						"attackpower"=>"Attack Power",
                            						"strength"=>"Strength",
                            						"dexterity"=>"Dexterity",
                            						"expbonus"=>"Experience Bonus",
                            						"goldbonus"=>"Gold Bonus");


						$attribute1 = explode(",",$droprow["attribute1"]);
    						$dropbonus1 = $attributearray[$attribute1[0]] . " ";
   						if ($attribute1[1] > 0) { $dropbonus1 .= "+" . $attribute1[1]; } else { $dropbonus1 .= $attribute1[1]; }
						if ($droprow["attribute2"] != "X") { 
        						$attribute2 = explode(",",$droprow["attribute2"]);
        						$dropbonus2 = $attributearray[$attribute2[0]] . " ";
        						if ($attribute2[1] > 0) { $dropbonus2 .= "+" . $attribute2[1]; } else { $dropbonus2 .= $attribute2[1]; }
    						}		
						$dropname = $droprow["name"];

						$dropinfo = $droprow["name"] . ": " . $dropbonus1;
						if ($dropbonus2 != "")
						{
							$dropinfo .= ", ".$dropbonus2;
						}
					}

					$page .= "<table width=\"100%\">";
					$page .= "<tr><td align=\"center\"><b>" .$name. "</b><br /></td></tr>";
					$page .= "<tr><td align=\"center\"><b>" .$name2. "</b><br /></td></tr>";
					$page .= "<tr><td align=\"left\">" .$text. "<br /></td></tr>";
					$page .= "<tr><td align=\"center\"><b>Rewards</b><br /></td></tr>";
					$page .= "<tr><td align=\"center\">" .$rewardexp. " Experience</td></tr>";
					$page .= "<tr><td align=\"center\">" .$rewardgold. " Gold</td></tr>";
					if ($dropname != "")
					{
						$page .= "<tr><td align=\"center\">You will also receive:<br />" .$dropname. "<br /></td></tr>";
						$page .= "<tr><td align=\"center\">Stats granted by this item:<br />" .$dropbonus1;
						if ($dropbonus2 != "")
						{
							$page .= "<br />".$dropbonus2."<br/>";
						}
						$page .= "</td></tr>";
					}
					$page .= "</table>";					
				}
			}
		}
	}
	$page .= "</center></td></tr></table><a href='index.php?do=questlog'>Back to Quest Log</a></center>";
	$pagearray = array();
	$pagearray["content"] = $page;
	$pagearray["title"] = "Quest Log";
      
	// Finalize page and display it.
   	$template = gettemplate("minimal");
    	echo parsetemplate($template,$pagearray);
      die();
}





function showchar() {
    
    global $userrow, $controlrow;
    
    // Format various userrow stuffs.
    $userrow["experience"] = number_format($userrow["experience"]);
    $userrow["gold"] = number_format($userrow["gold"]);
    if ($userrow["expbonus"] > 0) { 
        $userrow["plusexp"] = "<span class=\"light\">(+".$userrow["expbonus"]."%)</span>"; 
    } elseif ($userrow["expbonus"] < 0) {
        $userrow["plusexp"] = "<span class=\"light\">(".$userrow["expbonus"]."%)</span>";
    } else { $userrow["plusexp"] = ""; }
    if ($userrow["goldbonus"] > 0) { 
        $userrow["plusgold"] = "<span class=\"light\">(+".$userrow["goldbonus"]."%)</span>"; 
    } elseif ($userrow["goldbonus"] < 0) { 
        $userrow["plusgold"] = "<span class=\"light\">(".$userrow["goldbonus"]."%)</span>";
    } else { $userrow["plusgold"] = ""; }
    
    $levelquery = doquery("SELECT ". $userrow["charclass"]."_exp FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels");
    $levelrow = mysql_fetch_array($levelquery);
    if ($userrow["level"] < 300) { $userrow["nextlevel"] = number_format($levelrow[$userrow["charclass"]."_exp"]); } else { $userrow["nextlevel"] = "<span class=\"light\">None</span>"; }

    if ($userrow["charclass"] == 1) { $userrow["charclass"] = $controlrow["class1name"]; }
    elseif ($userrow["charclass"] == 2) { $userrow["charclass"] = $controlrow["class2name"]; }
    elseif ($userrow["charclass"] == 3) { $userrow["charclass"] = $controlrow["class3name"]; }
    elseif ($userrow["charclass"] == 4) { $userrow["charclass"] = $controlrow["class4name"]; }
    elseif ($userrow["charclass"] == 5) { $userrow["charclass"] = $controlrow["class5name"]; }
    elseif ($userrow["charclass"] == 6) { $userrow["charclass"] = $controlrow["class6name"]; }
    elseif ($userrow["charclass"] == 7) { $userrow["charclass"] = $controlrow["class7name"]; }
    elseif ($userrow["charclass"] == 8) { $userrow["charclass"] = $controlrow["class8name"]; }
    elseif ($userrow["charclass"] == 9) { $userrow["charclass"] = $controlrow["class9name"]; }
    elseif ($userrow["charclass"] == 10) { $userrow["charclass"] = $controlrow["class10name"]; }
    elseif ($userrow["charclass"] == 11) { $userrow["charclass"] = $controlrow["class11name"]; }
    elseif ($userrow["charclass"] == 12) { $userrow["charclass"] = $controlrow["class12name"]; }
    elseif ($userrow["charclass"] == 13) { $userrow["charclass"] = $controlrow["class13name"]; }
    elseif ($userrow["charclass"] == 14) { $userrow["charclass"] = $controlrow["class14name"]; }
    elseif ($userrow["charclass"] == 15) { $userrow["charclass"] = $controlrow["class15name"]; }
    elseif ($userrow["charclass"] == 16) { $userrow["charclass"] = $controlrow["class16name"]; }
    elseif ($userrow["charclass"] == 17) { $userrow["charclass"] = $controlrow["class17name"]; }
    elseif ($userrow["charclass"] == 18) { $userrow["charclass"] = $controlrow["class18name"]; }
    elseif ($userrow["charclass"] == 19) { $userrow["charclass"] = $controlrow["class19name"]; }
    elseif ($userrow["charclass"] == 20) { $userrow["charclass"] = $controlrow["class20name"]; }
    elseif ($userrow["charclass"] == 21) { $userrow["charclass"] = $controlrow["class21name"]; }	
    elseif ($userrow["charclass"] == 22) { $userrow["charclass"] = $controlrow["class22name"]; }
    elseif ($userrow["charclass"] == 23) { $userrow["charclass"] = $controlrow["class23name"]; }
    elseif ($userrow["charclass"] == 24) { $userrow["charclass"] = $controlrow["class24name"]; }
    elseif ($userrow["charclass"] == 25) { $userrow["charclass"] = $controlrow["class25name"]; }
    elseif ($userrow["charclass"] == 26) { $userrow["charclass"] = $controlrow["class26name"]; }
    elseif ($userrow["charclass"] == 27) { $userrow["charclass"] = $controlrow["class27name"]; }
    elseif ($userrow["charclass"] == 28) { $userrow["charclass"] = $controlrow["class28name"]; }
    elseif ($userrow["charclass"] == 29) { $userrow["charclass"] = $controlrow["class29name"]; }
    elseif ($userrow["charclass"] == 30) { $userrow["charclass"] = $controlrow["class30name"]; }
    elseif ($userrow["charclass"] == 31) { $userrow["charclass"] = $controlrow["class31name"]; }	
    elseif ($userrow["charclass"] == 32) { $userrow["charclass"] = $controlrow["class32name"]; }
    elseif ($userrow["charclass"] == 33) { $userrow["charclass"] = $controlrow["class33name"]; }
    elseif ($userrow["charclass"] == 34) { $userrow["charclass"] = $controlrow["class34name"]; }
    elseif ($userrow["charclass"] == 35) { $userrow["charclass"] = $controlrow["class35name"]; }
    elseif ($userrow["charclass"] == 36) { $userrow["charclass"] = $controlrow["class36name"]; }
    elseif ($userrow["charclass"] == 37) { $userrow["charclass"] = $controlrow["class37name"]; }
    elseif ($userrow["charclass"] == 38) { $userrow["charclass"] = $controlrow["class38name"]; }
    elseif ($userrow["charclass"] == 39) { $userrow["charclass"] = $controlrow["class39name"]; }
    elseif ($userrow["charclass"] == 40) { $userrow["charclass"] = $controlrow["class40name"]; }
    elseif ($userrow["charclass"] == 41) { $userrow["charclass"] = $controlrow["class41name"]; }	
    elseif ($userrow["charclass"] == 42) { $userrow["charclass"] = $controlrow["class42name"]; }
    elseif ($userrow["charclass"] == 43) { $userrow["charclass"] = $controlrow["class43name"]; }
    elseif ($userrow["charclass"] == 44) { $userrow["charclass"] = $controlrow["class44name"]; }
    elseif ($userrow["charclass"] == 45) { $userrow["charclass"] = $controlrow["class45name"]; }
    elseif ($userrow["charclass"] == 46) { $userrow["charclass"] = $controlrow["class46name"]; }
    elseif ($userrow["charclass"] == 47) { $userrow["charclass"] = $controlrow["class47name"]; }
    elseif ($userrow["charclass"] == 48) { $userrow["charclass"] = $controlrow["class48name"]; }
    elseif ($userrow["charclass"] == 49) { $userrow["charclass"] = $controlrow["class49name"]; }
    elseif ($userrow["charclass"] == 50) { $userrow["charclass"] = $controlrow["class50name"]; }
    elseif ($userrow["charclass"] == 51) { $userrow["charclass"] = $controlrow["class51name"]; }
    elseif ($userrow["charclass"] == 52) { $userrow["charclass"] = $controlrow["class52name"]; }


    //  START CHARACTER ALIGNMENT ARRAY
    if ($userrow["charalign"] == 1) { $userrow["charalign"] = $controlrow["align1name"]; }
    elseif ($userrow["charalign"] == 2) { $userrow["charalign"] = $controlrow["align2name"]; }
    elseif ($userrow["charalign"] == 3) { $userrow["charalign"] = $controlrow["align3name"]; }
    elseif ($userrow["charalign"] == 4) { $userrow["charalign"] = $controlrow["align4name"]; }
    elseif ($userrow["charalign"] == 5) { $userrow["charalign"] = $controlrow["align5name"]; }
    elseif ($userrow["charalign"] == 6) { $userrow["charalign"] = $controlrow["align6name"]; }
    elseif ($userrow["charalign"] == 7) { $userrow["charalign"] = $controlrow["align7name"]; }
    //  END CHARACTER ALIGNMENT ARRAY
        if ($userrow["difficulty"] == 1) { $userrow["difficulty"] = $controlrow["diff1name"]; }
    elseif ($userrow["difficulty"] == 2) { $userrow["difficulty"] = $controlrow["diff2name"]; }
    elseif ($userrow["difficulty"] == 3) { $userrow["difficulty"] = $controlrow["diff3name"]; }
    elseif ($userrow["difficulty"] == 4) { $userrow["difficulty"] = $controlrow["diff4name"]; }
    elseif ($userrow["difficulty"] == 5) { $userrow["difficulty"] = $controlrow["diff5name"]; }
    elseif ($userrow["difficulty"] == 6) { $userrow["difficulty"] = $controlrow["diff6name"]; }
    elseif ($userrow["difficulty"] == 7) { $userrow["difficulty"] = $controlrow["diff7name"]; }
    elseif ($userrow["difficulty"] == 8) { $userrow["difficulty"] = $controlrow["diff8name"]; }
    elseif ($userrow["difficulty"] == 9) { $userrow["difficulty"] = $controlrow["diff9name"]; }
    elseif ($userrow["difficulty"] == 10) { $userrow["difficulty"] = $controlrow["diff10name"]; }
    elseif ($userrow["difficulty"] == 11) { $userrow["difficulty"] = $controlrow["diff11name"]; }
    
    $spellquery = doquery("SELECT id,name FROM {{table}}","spells");
    $userspells = explode(",",$userrow["spells"]);
    $userrow["magiclist"] = "";
    while ($spellrow = mysql_fetch_array($spellquery)) {
        $spell = false;
        foreach($userspells as $a => $b) {
            if ($b == $spellrow["id"]) { $spell = true; }
        }
        if ($spell == true) {
            $userrow["magiclist"] .= $spellrow["name"]."<br />";
        }
    }
    if ($userrow["magiclist"] == "") { $userrow["magiclist"] = "None"; }
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    
    $charsheet = gettemplate("showchar");
    $page = $xml . gettemplate("minimal");
    $array = array("content"=>parsetemplate($charsheet, $userrow), "title"=>"Character Information");
    echo parsetemplate($page, $array);
    die();
    
}

function onlinechar($id) {
    
    global $controlrow;
    $userquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "users");
    if (mysql_num_rows($userquery) == 1) { $userrow = mysql_fetch_array($userquery); } else { display("No such user.", "Error"); }
    
	
	    $result = mysql_query ("select unix_timestamp(onlinetime) from dk_users where id='$id' OR charname='$id'"); // get last online time
    $result2 = mysql_query ("select unix_timestamp()"); // get current time from mysql db
    $min = 60; $hour = 3600; $day = 86400; // time vars (in seconds)
    $start = mysql_result ($result, 0, 0); // set the last online time var
    $end = mysql_result ($result2, 0, 0); // set the current time var
    $diff = $end-$start; // how many seconds since the user has been online
    if ($diff == 0) { $userrow[lastseen] = "$userrow[charname] is currently $userrow[currentaction]."; } // is user currently online
    else { // if user isnt online, how long ago were they online
        $days = floor($diff/$day); // how many days can we divide this into
        $diff = $diff-($day*$days); // subtract days from the total time
        $hours = floor($diff/$hour); // how many hours can we divide this into
        $diff = $diff-($hour*$hours); //  subtract hours from the total time
        $minutes = floor($diff/$min); // how many minutes can we divide this into
        $diff = $diff-($min*$minutes); // subtract minutes from the total time
        $seconds = $diff;  // we should have less than 60 seconds left, so show the remainder as seconds
        if ($seconds == 1) { $s = second; } else { $s = seconds; } // dont pluralize seconds if only one second
        if ($minutes == 1) { $m = minute; } else { $m = minutes; } // dont pluralize minutes if only one minute
        if ($hours == 1) { $h = hour; } else { $h = hours; } // dont pluralize hours if only one hour
        if ($days == 1) { $d = day; } else { $d = days; } // dont pluralize days if only one day
        if ($days > 10000) { $userrow[lastseen] = "$userrow[charname] has not been seen."; } // check if user has been online since signing up
        else { $userrow[lastseen] = "$userrow[charname] was last seen $days $d, $hours $h, $minutes $m and $seconds $s ago and was $userrow[currentaction]."; } // spit out lastseen
    }

	
    // Format various userrow stuffs.
    $userrow["experience"] = number_format($userrow["experience"]);
    $userrow["gold"] = number_format($userrow["gold"]);
    if ($userrow["expbonus"] > 0) { 
        $userrow["plusexp"] = "<span class=\"light\">(+".$userrow["expbonus"]."%)</span>"; 
    } elseif ($userrow["expbonus"] < 0) {
        $userrow["plusexp"] = "<span class=\"light\">(".$userrow["expbonus"]."%)</span>";
    } else { $userrow["plusexp"] = ""; }
    if ($userrow["goldbonus"] > 0) { 
        $userrow["plusgold"] = "<span class=\"light\">(+".$userrow["goldbonus"]."%)</span>"; 
    } elseif ($userrow["goldbonus"] < 0) { 
        $userrow["plusgold"] = "<span class=\"light\">(".$userrow["goldbonus"]."%)</span>";
    } else { $userrow["plusgold"] = ""; }
    
    $levelquery = doquery("SELECT ". $userrow["charclass"]."_exp FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels");
    $levelrow = mysql_fetch_array($levelquery);
    $userrow["nextlevel"] = number_format($levelrow[$userrow["charclass"]."_exp"]);

    if ($userrow["charclass"] == 1) { $userrow["charclass"] = $controlrow["class1name"]; }
    elseif ($userrow["charclass"] == 2) { $userrow["charclass"] = $controlrow["class2name"]; }
    elseif ($userrow["charclass"] == 3) { $userrow["charclass"] = $controlrow["class3name"]; }
    elseif ($userrow["charclass"] == 4) { $userrow["charclass"] = $controlrow["class4name"]; }
    elseif ($userrow["charclass"] == 5) { $userrow["charclass"] = $controlrow["class5name"]; }
    elseif ($userrow["charclass"] == 6) { $userrow["charclass"] = $controlrow["class6name"]; }
    elseif ($userrow["charclass"] == 7) { $userrow["charclass"] = $controlrow["class7name"]; }
    elseif ($userrow["charclass"] == 8) { $userrow["charclass"] = $controlrow["class8name"]; }
    elseif ($userrow["charclass"] == 9) { $userrow["charclass"] = $controlrow["class9name"]; }
    elseif ($userrow["charclass"] == 10) { $userrow["charclass"] = $controlrow["class10name"]; }
    elseif ($userrow["charclass"] == 11) { $userrow["charclass"] = $controlrow["class11name"]; }
    elseif ($userrow["charclass"] == 12) { $userrow["charclass"] = $controlrow["class12name"]; }
    elseif ($userrow["charclass"] == 13) { $userrow["charclass"] = $controlrow["class13name"]; }
    elseif ($userrow["charclass"] == 14) { $userrow["charclass"] = $controlrow["class14name"]; }
    elseif ($userrow["charclass"] == 15) { $userrow["charclass"] = $controlrow["class15name"]; }
    elseif ($userrow["charclass"] == 16) { $userrow["charclass"] = $controlrow["class16name"]; }
    elseif ($userrow["charclass"] == 17) { $userrow["charclass"] = $controlrow["class17name"]; }
    elseif ($userrow["charclass"] == 18) { $userrow["charclass"] = $controlrow["class18name"]; }
    elseif ($userrow["charclass"] == 19) { $userrow["charclass"] = $controlrow["class19name"]; }
    elseif ($userrow["charclass"] == 20) { $userrow["charclass"] = $controlrow["class20name"]; }
    elseif ($userrow["charclass"] == 21) { $userrow["charclass"] = $controlrow["class21name"]; }	
    elseif ($userrow["charclass"] == 22) { $userrow["charclass"] = $controlrow["class22name"]; }
    elseif ($userrow["charclass"] == 23) { $userrow["charclass"] = $controlrow["class23name"]; }
    elseif ($userrow["charclass"] == 24) { $userrow["charclass"] = $controlrow["class24name"]; }
    elseif ($userrow["charclass"] == 25) { $userrow["charclass"] = $controlrow["class25name"]; }
    elseif ($userrow["charclass"] == 26) { $userrow["charclass"] = $controlrow["class26name"]; }
    elseif ($userrow["charclass"] == 27) { $userrow["charclass"] = $controlrow["class27name"]; }
    elseif ($userrow["charclass"] == 28) { $userrow["charclass"] = $controlrow["class28name"]; }
    elseif ($userrow["charclass"] == 29) { $userrow["charclass"] = $controlrow["class29name"]; }
    elseif ($userrow["charclass"] == 30) { $userrow["charclass"] = $controlrow["class30name"]; }
    elseif ($userrow["charclass"] == 31) { $userrow["charclass"] = $controlrow["class31name"]; }	
    elseif ($userrow["charclass"] == 32) { $userrow["charclass"] = $controlrow["class32name"]; }
    elseif ($userrow["charclass"] == 33) { $userrow["charclass"] = $controlrow["class33name"]; }
    elseif ($userrow["charclass"] == 34) { $userrow["charclass"] = $controlrow["class34name"]; }
    elseif ($userrow["charclass"] == 35) { $userrow["charclass"] = $controlrow["class35name"]; }
    elseif ($userrow["charclass"] == 36) { $userrow["charclass"] = $controlrow["class36name"]; }
    elseif ($userrow["charclass"] == 37) { $userrow["charclass"] = $controlrow["class37name"]; }
    elseif ($userrow["charclass"] == 38) { $userrow["charclass"] = $controlrow["class38name"]; }
    elseif ($userrow["charclass"] == 39) { $userrow["charclass"] = $controlrow["class39name"]; }
    elseif ($userrow["charclass"] == 40) { $userrow["charclass"] = $controlrow["class40name"]; }
    elseif ($userrow["charclass"] == 41) { $userrow["charclass"] = $controlrow["class41name"]; }	
    elseif ($userrow["charclass"] == 42) { $userrow["charclass"] = $controlrow["class42name"]; }
    elseif ($userrow["charclass"] == 43) { $userrow["charclass"] = $controlrow["class43name"]; }
    elseif ($userrow["charclass"] == 44) { $userrow["charclass"] = $controlrow["class44name"]; }
    elseif ($userrow["charclass"] == 45) { $userrow["charclass"] = $controlrow["class45name"]; }
    elseif ($userrow["charclass"] == 46) { $userrow["charclass"] = $controlrow["class46name"]; }
    elseif ($userrow["charclass"] == 47) { $userrow["charclass"] = $controlrow["class47name"]; }
    elseif ($userrow["charclass"] == 48) { $userrow["charclass"] = $controlrow["class48name"]; }
    elseif ($userrow["charclass"] == 49) { $userrow["charclass"] = $controlrow["class49name"]; }
    elseif ($userrow["charclass"] == 50) { $userrow["charclass"] = $controlrow["class50name"]; }
    elseif ($userrow["charclass"] == 51) { $userrow["charclass"] = $controlrow["class51name"]; }
    elseif ($userrow["charclass"] == 52) { $userrow["charclass"] = $controlrow["class52name"]; }


    //  START CHARACTER ALIGNMENT ARRAY
    if ($userrow["charalign"] == 1) { $userrow["charalign"] = $controlrow["align1name"]; }
    elseif ($userrow["charalign"] == 2) { $userrow["charalign"] = $controlrow["align2name"]; }
    elseif ($userrow["charalign"] == 3) { $userrow["charalign"] = $controlrow["align3name"]; }
    elseif ($userrow["charalign"] == 4) { $userrow["charalign"] = $controlrow["align4name"]; }
    elseif ($userrow["charalign"] == 5) { $userrow["charalign"] = $controlrow["align5name"]; }
    elseif ($userrow["charalign"] == 6) { $userrow["charalign"] = $controlrow["align6name"]; }
    elseif ($userrow["charalign"] == 7) { $userrow["charalign"] = $controlrow["align7name"]; }
    //  END CHARACTER ALIGNMENT ARRAY
        if ($userrow["difficulty"] == 1) { $userrow["difficulty"] = $controlrow["diff1name"]; }
    elseif ($userrow["difficulty"] == 2) { $userrow["difficulty"] = $controlrow["diff2name"]; }
    elseif ($userrow["difficulty"] == 3) { $userrow["difficulty"] = $controlrow["diff3name"]; }
    elseif ($userrow["difficulty"] == 4) { $userrow["difficulty"] = $controlrow["diff4name"]; }
    elseif ($userrow["difficulty"] == 5) { $userrow["difficulty"] = $controlrow["diff5name"]; }
    elseif ($userrow["difficulty"] == 6) { $userrow["difficulty"] = $controlrow["diff6name"]; }
    elseif ($userrow["difficulty"] == 7) { $userrow["difficulty"] = $controlrow["diff7name"]; }
    elseif ($userrow["difficulty"] == 8) { $userrow["difficulty"] = $controlrow["diff8name"]; }
    elseif ($userrow["difficulty"] == 9) { $userrow["difficulty"] = $controlrow["diff9name"]; }
    elseif ($userrow["difficulty"] == 10) { $userrow["difficulty"] = $controlrow["diff10name"]; }
    elseif ($userrow["difficulty"] == 11) { $userrow["difficulty"] = $controlrow["diff11name"]; }
    
    $charsheet = gettemplate("onlinechar");
    $page = parsetemplate($charsheet, $userrow);
    display($page, "Character Information");
    
}




function showmap() {
    
    global $userrow; 
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    
    $page = $xml . gettemplate("minimal"); $time = time();
    $array = array("content"=>"<div id=\"map\"><img src=\"index.php?do=makemap&time=$time\" alt=\"Map\" border=\"0\" /></div></center>", "title"=>"Map");
    echo parsetemplate($page, $array);
    die();
    
}


if ($do[0] == "makemap") { makemap(); }
function makemap() {
	global $userrow, $controlrow;
	$latitude = $userrow["latitude"];
	$longitude = $userrow["longitude"];
	$map = imageCreate(501,501);
	$magenta = ImageColorAllocate($map, 255, 0, 255);
	$red = imageColorAllocate($map, 211, 0, 0);
	ImageColorTransparent($map, $magenta);
	imageFilledEllipse($map, ($longitude + 250), (-$latitude + 250), 10, 10, $red);
	header("Content-type: image/png");
	imagePNG($map);
	imageDestroy($map);
}



function showwiki() { 
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    
    $page = $xml . gettemplate("wiki");
	$query = doquery("SELECT * FROM {{table}} WHERE id = '".$_GET[id]."'","monsters");
	$queryres = mysql_fetch_assoc($query);
	$u = mysql_fetch_array(doquery("SELECT username FROM {{table}} WHERE id = '".$queryres[seenby]."'","users"));
	if($u['username']){	$array["seenby"] = "First seen by <b>".$u['username']."</b>"; 
	$array["name"] = "Name: <b>".$queryres["name"]."</b>";
	$array["level"] = " (Level <b>".$queryres["level"]."</b>)";
	$array["title"] = "Monster Wiki - ".$queryres["name"];
	$array["hitpoints"] = "This monster has <b>".$queryres['maxhp']."</b> hitpoints.";
	$array["damage"] = "This monster has an attack range from <b>0</b> to <b>".$queryres['maxdam']."</b>.";

	// $array["monsterimg"] = "<img src=\"images/monsters/".$u["currentmonster"].".png\" />";
	$array["monsterimg"] = "<img src=\"images/monsters/".$userrow["currentmonster"].".png\" />
	
	
	}else{
	$array["seenby"] = "You confront a monster has not been Cataloged in your Discovery Tablet yet!";
	$array["name"] = "";
	$array["level"] = "";
	$array["title"] = "Not seen before monster";
	$array["hitpoints"] = "";
	$array["damage"] = "";
	$array["monsterimg"] = "<img src=\"images/monsters/".$u["currentmonster"].".png\" />";	
	}
	
	
	
	
    //$array = array("content"=>"Work in Progress<br>#RESSID = ".$_GET[id], "title"=>"Monster Wiki");
    echo parsetemplate($page, $array);
    die();
    
}



function babblebox() {
    
    global $userrow;
    
    if (isset($_POST["babble"])) {
        $safecontent = makesafe($_POST["babble"]);
        if ($safecontent == "" || $safecontent == " ") { //blank post. do nothing.
        } else { $insert = doquery("INSERT INTO {{table}} SET id='',posttime=NOW(),author='".$userrow["charname"]."',babble='$safecontent'", "babble"); }
        header("Location: index.php?do=babblebox");
        die();
    }
    
    $babblebox = array("content"=>"");
    $bg = 1;
    $babblequery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 20", "babble");
    while ($babblerow = mysql_fetch_array($babblequery)) {
        if ($bg == 1) { $new = "<div style=\"width:98%; background-color:#eeeeee;\">[<b>".$babblerow["author"]."</b>] ".$babblerow["babble"]."</div>\n"; $bg = 2; }
        else { $new = "<div style=\"width:98%; background-color:#ffffff;\">[<b>".$babblerow["author"]."</b>] ".stripslashes($babblerow["babble"])."</div>\n"; $bg = 1; } 
        $babblebox["content"] = $new . $babblebox["content"];
    }
    
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    $page = $xml . gettemplate("babblebox");
    echo parsetemplate($page, $babblebox);
    die();

}

function ninja() {
    header("Location: http://www.michaelmccart.com/images/items/misc/blackdice.png");
}

function sendgold() {

	global $userrow;
$maximumgold = $userrow[gold];
 $checkquery = doquery("SELECT * FROM {{table}} WHERE charname='".$_POST['reciever']."' LIMIT 1", "users");
        $rec = mysql_fetch_assoc($checkquery);
if (isset($_POST["sendgold"])) {
        
		extract($_POST);
		$errors = 0;
		$errorlist = "";
        	if ($sender == "") { $errors++; $errorlist .= "The sender name is required.<br />"; }
       		if (!is_numeric($goldsent)) { $errors++; $errorlist .= "The amount of gold sent needs to be a number.<br />"; }
		if ($goldsent == "") { $errors++; $errorlist .= "The amount of gold is required.<br />"; }
		if ($reciever == "") { $errors++; $errorlist .= "The receivers name is required.<br />"; }
		if ($goldsent > $maximumgold) { $errors++; $errorlist .= "You're trying to send more gold than what you have.<br />"; }
		if ($goldsent == "0") { $errors++; $errorlist .= "You need to send more gold than just zero.<br />"; }
		if ($reciever == $sender) { $errors++; $errorlist .= "There is no need to be sending gold to yourself."; }
		if (!$rec) { $errors++; $errorlist .= "Character name doesn't exist."; }
		if ($rec == $userrow[charname]) { $errors++; $errorlist .= "There is no need to be sending gold to yourself."; }
        
		if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET gold=gold-$goldsent WHERE charname='$sender'","users");
            $query2 = doquery("UPDATE {{table}} SET gold=gold+$goldsent WHERE charname='$reciever'","users");
				display("You have successfully transferred your money over.<br /><br /><a href=\"index.php\">Go back to town.</a>","Send Gold");
        } else {
            display("<b>Errors:</b><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.<br /><a href=\"index.php?do=sendgold\">Go back</a><br />", "Send Gold");
        }        
        
    } 
$page = <<<END
<b><u>Send Gold</u></b><br />
You can transfer gold to other users here.<br />
<table width="100%">
<form method="post" action="index.php?do=sendgold">
<input name="sender" type="hidden" value="$userrow[charname]" id="sender" />
<tr><td width="30%">Gold Sending:</td><td><input name="goldsent" type="text" size="12" maxlength="12" /> gold.<br /></td></tr>
<tr><td width="30%">Receivers Name:</td><td><input name="reciever" type="text" size="20" /><br /></td></tr>
<tr><td width="30%"><input name="sendgold" type="submit" value="Submit" />
</form>
<tr><td colspan="2"><a href="index.php">Go back</a></td></tr></table>
END;

display($page,"Send Gold");

}
?>