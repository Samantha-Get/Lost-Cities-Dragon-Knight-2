<?php // index.php :: Primary program script, evil alien overlord, you decide.

if (file_exists('install.php')) { die("Please delete install.php from your Lost Cities directory before continuing."); }
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
if ($controlrow["gameopen"] == 0) { display("<blockquote><blockquote>&nbsp;&nbsp;The game is currently closed for maintanence. Please check back later.</blockquote></blockquote>","Game Closed"); die(); }
// Force verify if the user isn't verified yet.
if ($controlrow["verifyemail"] == 1 && $userrow["verify"] != 1) { header("Location: users.php?do=verify"); die(); }
// Block user if he/she has been banned.
if ($userrow["authlevel"] == 2) { die("Your account has been blocked. Please try back later."); }
if (isset($_GET["do"])) {
   
     $do = explode(":",$_GET["do"]);
	
// START OF UPDATE SOCIAL STATUS TITLE DISPLAY
	if($userrow["level"] <= 0)  { $status = 'No Status'; }
	if($userrow["level"] >= 1)  { $status = 'Slave'; }
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
    if($userrow["level"] >= 20)  { $status = 'Kingdom Lord'; } // Level when you can have a Kingdom
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
    $lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
    $lordsrow = mysql_fetch_array($lordsquery); 
    doquery("UPDATE {{table}} SET status='$status' WHERE id='".$lordsrow["id"]."' ", "lords");
// END OF UPDATE SOCIAL STATUS TITLE DISPLAY

// START OF SET LORDS TABLE INITIAL STATS
// THIS POPULATES AND SETS THE LORDS TABLE UPON BECOMMING A LORD
    if ($userrow["level"] == 20) { //SET THIS # TO THE SAME LEVEL # AS BECOMMING A LORD
    if ($userrow["setstats"] == 0) { //THIS CHECKS TO SEE IF INITIAL LORD STATS NEED TO BE SET
    if ($userrow["charalign"] == 1) { $honor = '14'; $alignment = 'Lawfull Good'; }//Lawfull Good set honor stat
    if ($userrow["charalign"] == 2) { $honor = '12'; $alignment = 'Chaotic Good'; }//Chaotic Good set honor stat
    if ($userrow["charalign"] == 3) { $honor = '10'; $alignment = 'Neutral Good'; }//Neutral Good set honor stat
    if ($userrow["charalign"] == 4) { $honor = '8'; $alignment = 'Neutral'; }//Neutral set honor stat
    if ($userrow["charalign"] == 5) { $honor = '6'; $alignment = 'Neutral Evil'; }//Neutral Evil set honor
    if ($userrow["charalign"] == 6) { $honor = '4'; $alignment = 'Chaotic Evil'; }//Chaotic Evil set honor
    if ($userrow["charalign"] == 7) { $honor = '2'; $alignment = 'Lawful Evil'; }//Lawful Evil set honor	
	
    if ($userrow["charclass"] == 1) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 2) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 3) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 4) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 5) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 6) { $tactical = '5'; }//Sorcerer set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 7) { $tactical = '10'; }//Warrior set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 8) { $tactical = '2'; }//Rogue set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 9) { $tactical = '4'; }//Druid set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 10) { $tactical = '12'; }//Paladin set tactical stat add or remove classes as needed
	
    if ($userrow["charclass"] == 11) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 12) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 13) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 14) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 15) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 16) { $tactical = '5'; }//Sorcerer set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 17) { $tactical = '10'; }//Warrior set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 18) { $tactical = '2'; }//Rogue set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 19) { $tactical = '4'; }//Druid set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 20) { $tactical = '12'; }//Paladin set tactical stat add or remove classes as needed
	
    if ($userrow["charclass"] == 21) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 22) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 23) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 24) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 25) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 26) { $tactical = '5'; }//Sorcerer set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 27) { $tactical = '10'; }//Warrior set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 28) { $tactical = '2'; }//Rogue set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 29) { $tactical = '4'; }//Druid set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 30) { $tactical = '12'; }//Paladin set tactical stat add or remove classes as needed
	
    if ($userrow["charclass"] == 31) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 32) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 33) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 34) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 35) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 36) { $tactical = '5'; }//Sorcerer set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 37) { $tactical = '10'; }//Warrior set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 38) { $tactical = '2'; }//Rogue set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 39) { $tactical = '4'; }//Druid set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 40) { $tactical = '12'; }//Paladin set tactical stat add or remove classes as needed
	
    if ($userrow["charclass"] == 41) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 42) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 43) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 44) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 45) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 46) { $tactical = '5'; }//Sorcerer set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 47) { $tactical = '10'; }//Warrior set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 48) { $tactical = '2'; }//Rogue set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 49) { $tactical = '4'; }//Druid set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 50) { $tactical = '12'; }//Paladin set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 51) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 52) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
	
    if ($userrow["charclass"] == 53) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 54) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 55) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 56) { $tactical = '5'; }//Sorcerer set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 57) { $tactical = '10'; }//Warrior set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 58) { $tactical = '2'; }//Rogue set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 59) { $tactical = '4'; }//Druid set tactical stat add or remove classes as needed	
    if ($userrow["charclass"] == 60) { $tactical = '12'; }//Paladin set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 61) { $tactical = '7'; }//Mage set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 62) { $tactical = '6'; }//Barbarian set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 63) { $tactical = '3'; }//Bard set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 64) { $tactical = '8'; }//Cleric set tactical stat add or remove classes as needed
    if ($userrow["charclass"] == 65) { $tactical = '13'; }//Ranger set tactical stat add or remove classes as needed
	
	
    $id = $userrow["id"];
    $lordname = $userrow["charname"];
    doquery("INSERT INTO {{table}} SET id='$id', lordname='$lordname', alignment='$alignment', tactical='$tactical', honor='$honor', land='20', offarmy='20', dffarmy='20', treasury='50' ", "lords");
    doquery("UPDATE {{table}} SET setstats='1' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); } }
// END OF SET LORDS TABLE INITIAL STATS
        
	// Town functions.  
	
     
	// Inn.
    if ($do[0] == "inn") { include('towns.php'); inn(); }  
	
	// 

		
	// Church & Magic House
	elseif ($do[0] == "church") {include('towns.php'); church(); }
	elseif ($do[0] == "magichouse") {include('towns.php'); magichouse(); }
	elseif ($do[0] == "tac") {include('index.php'); tac(); }
	elseif ($do[0] == "tac") {include('towns.php'); tac(); }
    elseif ($do[0] == "tac") { include('showchar.php'); tac(); }
   
    // Buy War Items
	elseif ($do[0] == "gym") { include('towns.php'); gym(); }
		
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

	elseif ($do[0] == "wea1") { include('towns.php'); wea1(); }
	elseif ($do[0] == "wea12") { include('towns.php'); wea12($do[1]); }
	elseif ($do[0] == "wea13") { include('towns.php'); wea13($do[1]); }

	elseif ($do[0] == "wea2") { include('towns.php'); wea2(); }
	elseif ($do[0] == "wea22") { include('towns.php'); wea22($do[1]); }
	elseif ($do[0] == "wea23") { include('towns.php'); wea23($do[1]); }
	
	// Contact functions.
	elseif ($do[0] == "contact") { include('contact.php'); contactadmin(); }
	
	// Training functions.
    elseif ($do[0] == "strtrain") { include('strtrain.php'); strtrain(); }
    elseif ($do[0] == "dextrain") { include('dextrain.php'); dextrain(); }
    elseif ($do[0] == "atttrain") { include('atttrain.php'); atttrain(); }
    elseif ($do[0] == "deftrain") { include('deftrain.php'); deftrain(); }
    elseif ($do[0] == "train") { include('train.php'); train(); }
	
	
	 // Friends
	elseif ($do[0] == "liste_amis") {include('amis.php'); liste_amis(); }
	elseif ($do[0] == "amis") { include('amis.php'); amis($do[1]); }
	elseif ($do[0] == "supprimer_amis") { include('amis.php'); supprimer_amis($do[1]); }
    
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
    elseif ($do[0] == "sendgold") { sendgold(); }
    elseif ($do[0] == "rob") { include('robbank.php'); robb(); }
    elseif ($do[0] == "robb") { include('robbbank.php'); robb(); }
	elseif ($do[0] == "banksilver") { include('banksilver_mod.php'); banksilver(); }
    elseif ($do[0] == "sendsilver") { sendsilver(); }
    elseif ($do[0] == "robsilver") { include('robbanksilver.php'); robbsilver(); }
    elseif ($do[0] == "robbsilver") { include('robbbanksilver.php'); robbsilver(); }	
	elseif ($do[0] == "bankcopper") { include('bankcopper_mod.php'); bankcopper(); }
    elseif ($do[0] == "sendcopper") { sendcopper(); }
    elseif ($do[0] == "robcopper") { include('robbbankcopper.php'); robbcopper(); }
    elseif ($do[0] == "robbcopper") { include('robbbankcopper.php'); robbcopper(); }	
	elseif ($do[0] == "broker") { include('broker.php'); broker(); }
   
    // Bank Gold Silver Copper.
	elseif ($do[0] == "bankgsc") { include('bank_gsc.php'); bankgsc(); }	
    elseif ($do[0] == "sendgoldgsc") { sendgoldgsc(); }
    elseif ($do[0] == "sendsilvergsc") { sendsilvergsc(); }
    elseif ($do[0] == "sendcoppergsc") { sendcoppergsc(); }
    
	// Go to town and town inf.
	elseif ($do[0] == "towninf") { include('towninf.php'); towninf(); }
	elseif ($do[0] == "gotown") { include('towns.php'); travelto($do[1]); }
	elseif ($do[0] == "viewgraveyard") { include('towns.php'); viewgraveyard(); }
	
// START OF KINGDOMS FUNCTIONS
    elseif ($do[0] == "land") { include('kingdoms.php'); land(); }
    elseif ($do[0] == "collect") { include('kingdoms.php'); collect(); }
    elseif ($do[0] == "attack") { include('kingdoms.php'); attack(); }
    elseif ($do[0] == "treasury") { include('kingdoms.php'); treasury(); }
    elseif ($do[0] == "editland") { include('kingdoms.php'); editland(); }
    elseif ($do[0] == "lords") { include('kingdoms.php'); lords(); }
// END OF KINGDOMS FUNCTIONS

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
    elseif ($do[0] == "loteri5") { include('loteri5.php'); loteri5(); }	
    elseif ($do[0] == "loteri10") { include('loteri10.php'); loteri10(); }	
    elseif ($do[0] == "loteri") { include('loteri.php'); loteri(); }	
    elseif ($do[0] == "loteri50") { include('loteri50.php'); loteri50(); }	
    elseif ($do[0] == "loter75") { include('loteri75.php'); loteri75(); }	
    elseif ($do[0] == "loteri100") { include('loteri100.php'); loteri100(); }	
	
	// Lottery5.
	elseif ($do[0] == "lottery_presentation") { include('lottery5.php'); lottery_presentation();}
	elseif ($do[0] == "lottery_participation") { include('lottery5.php'); lottery_participation();}
	elseif ($do[0] == "lottery_results") { include('lottery5.php'); lottery_results();}
	elseif ($do[0] == "lottery_update") { include('lottery5.php'); lottery_update();}
	elseif ($do[0] == "history_lottery") { include('lottery5.php'); history_lottery();}
	
	// Lottery.
	elseif ($do[0] == "lottery_presentation") { include('lottery.php'); lottery_presentation();}
	elseif ($do[0] == "lottery_participation") { include('lottery.php'); lottery_participation();}
	elseif ($do[0] == "lottery_results") { include('lottery.php'); lottery_results();}
	elseif ($do[0] == "lottery_update") { include('lottery.php'); lottery_update();}
	elseif ($do[0] == "history_lottery") { include('lottery.php'); history_lottery();}
	
	// Lottery100.
	elseif ($do[0] == "lottery_presentation100") { include('lottery100.php'); lottery_presentation100();}
	elseif ($do[0] == "lottery_participation100") { include('lottery100.php'); lottery_participation100();}
	elseif ($do[0] == "lottery_results100") { include('lottery100.php'); lottery_results100();}
	elseif ($do[0] == "lottery_update100") { include('lottery100.php'); lottery_update100();}
	elseif ($do[0] == "history_lottery100") { include('lottery100.php'); history_lottery100();}	
	
	// Lottery250.
	elseif ($do[0] == "lottery_presentation250") { include('lottery75.php'); lottery_presentation250();}
	elseif ($do[0] == "lottery_participation250") { include('lottery75.php'); lottery_participation250();}
	elseif ($do[0] == "lottery_results75") { include('lottery75.php'); lottery_results250();}
	elseif ($do[0] == "lottery_update75") { include('lottery75.php'); lottery_update250();}
	elseif ($do[0] == "history_lottery75") { include('lottery75.php'); history_lottery250();}
	
	// Lottery500.
	elseif ($do[0] == "lottery_presentation500") { include('lottery500.php'); lottery_presentation500();}
	elseif ($do[0] == "lottery_participation500") { include('lottery500.php'); lottery_participation500();}
	elseif ($do[0] == "lottery_results500") { include('lottery500.php'); lottery_results500();}
	elseif ($do[0] == "lottery_update500") { include('lottery500.php'); lottery_update500();}
	elseif ($do[0] == "history_lottery500") { include('lottery500.php'); history_lottery500();}
	
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
	elseif ($do[0] == "dice5") { include('dice5.php'); dice5(); }
	elseif ($do[0] == "dicingbet5") { include('dice5.php'); dicingbet5(); }	
   
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
 elseif ($do[0] == "resources") { include('towns.php'); resources(); }
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
    elseif ($do[0] == "join") { include('clan.php'); join($do[1]); }

	// Exploring functions.
    elseif ($do[0] == "move") { include('explore.php'); move(); }
    elseif ($do[0] == "move") { include('exploremap.php'); move(); }
	
    // Field functions.
    elseif ($do[0] == "field") { include('fields.php'); visitfield(); }
    // Fight monsters fixed on field
    elseif ($do[0] == "field") { include('fixedmonster.php'); fixedmonster(); }
    elseif ($do[0] == "field") { include('fightspawn.php'); fightmonster(); }
    elseif ($do[0] == "fixedmonster") { include('fixedmonster.php'); fixedmonster(); }
    elseif ($do[0] == "fightmonster") { include('fightspawn.php'); fightmonster(); }
	
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
    elseif ($do[0] == "showchar") { showchar(); }
    elseif ($do[0] == "showchar") { include('towns.php'); showchar(); }
    elseif ($do[0] == "onlinechar") { onlinechar($do[1]); }
    elseif ($do[0] == "onlinechar") { include('towns.php'); onlinechar(); }
	
	// ShowMap
    elseif ($do[0] == "showmap") { showmap(); }
	
	// Wiki	
	elseif ($do[0] == "showmonster") { showwiki(); }
	
	// Avatar	
	elseif ($do[0] == "avatar") { include('charinfo.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('showchar.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('towns.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('leftnav.php'); avatar(); } 	
	elseif ($do[0] == "avatar") { include('rightnav.php'); avatar(); } 
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
	elseif ($do[0] == "exchange") { include('exchange.php'); expforgold(); } 
	elseif ($do[0] == "exchange") { include('exchange.php'); expforsilver(); } 
	elseif ($do[0] == "exchange") { include('exchange.php'); expforcopper(); } 
	
	// Exchange Functions
	elseif ($do[0] == "exchangecopper") { include('exchangecopper.php'); expforgold(); } 
	elseif ($do[0] == "exchangecopper") { include('exchangecopper.php'); expforsilver(); } 
	elseif ($do[0] == "exchangecopper") { include('exchangecopper.php'); expforcopper(); } 
	
    // My functions
	elseif ($do[0] == "form") { include('towns.php'); form (); }
	elseif ($do[0] == "form2") { include('towns.php'); form2 (); }	
    elseif ($do[0] == "guilds") { include('towns.php'); guilds(); }

    // NPC functions.
	elseif ($do[0] == "npclist") { include('npc.php'); npclist(); }
    elseif ($do[0] == "npc") { include('npc.php'); npc($do[1]); }
    elseif ($do[0] == "npcanswer1") { include('npc.php'); npcanswer($do[1],1); }
    elseif ($do[0] == "npcanswer2") { include('npc.php'); npcanswer($do[1],2); }
    elseif ($do[0] == "npcanswer3") { include('npc.php'); npcanswer($do[1],3); }
    elseif ($do[0] == "npcanswer4") { include('npc.php'); npcanswer($do[1],4); }
    elseif ($do[0] == "npcanswer5") { include('npc.php'); npcanswer($do[1],5); }
    elseif ($do[0] == "npcanswer6") { include('npc.php'); npcanswer($do[1],6); }
    elseif ($do[0] == "npcanswer7") { include('npc.php'); npcanswer($do[1],7); }
    elseif ($do[0] == "npcanswer8") { include('npc.php'); npcanswer($do[1],8); }
    elseif ($do[0] == "npcanswer9") { include('npc.php'); npcanswer($do[1],9); }
    elseif ($do[0] == "npcanswer10") { include('npc.php'); npcanswer($do[1],10); }
	
    // NPC II functions.
	elseif ($do[0] == "npc2list") { include('npc2.php'); npc2list(); }
    elseif ($do[0] == "npc2") { include('npc2.php'); npc2($do[1]); }
    elseif ($do[0] == "npc2answer1") { include('npc2.php'); npc2answer($do[1],1); }
    elseif ($do[0] == "npc2answer2") { include('npc2.php'); npc2answer($do[1],2); }
    elseif ($do[0] == "npc2answer3") { include('npc2.php'); npc2answer($do[1],3); }
    elseif ($do[0] == "npc2answer4") { include('npc2.php'); npc2answer($do[1],4); }
    elseif ($do[0] == "npc2answer5") { include('npc2.php'); npc2answer($do[1],5); }
    elseif ($do[0] == "npc2answer6") { include('npc2.php'); npc2answer($do[1],6); }
    elseif ($do[0] == "npc2answer7") { include('npc2.php'); npc2answer($do[1],7); }
    elseif ($do[0] == "npc2answer8") { include('npc2.php'); npc2answer($do[1],8); }
    elseif ($do[0] == "npc2answer9") { include('npc2.php'); npc2answer($do[1],9); }
    elseif ($do[0] == "npc2answer10") { include('npc2.php'); npc2answer($do[1],10); }
    elseif ($do[0] == "npc2answer11") { include('npc2.php'); npc2answer($do[1],11); }
    elseif ($do[0] == "npc2answer12") { include('npc2.php'); npc2answer($do[1],12); }
    elseif ($do[0] == "npc2answer13") { include('npc2.php'); npc2answer($do[1],13); }
    elseif ($do[0] == "npc2answer14") { include('npc2.php'); npc2answer($do[1],14); }
    elseif ($do[0] == "npc2answer15") { include('npc2.php'); npc2answer($do[1],15); }
    elseif ($do[0] == "npc2answer16") { include('npc2.php'); npc2answer($do[1],16); }
    elseif ($do[0] == "npc2answer17") { include('npc2.php'); npc2answer($do[1],17); }
    elseif ($do[0] == "npc2answer18") { include('npc2.php'); npc2answer($do[1],18); }
    elseif ($do[0] == "npc2answer19") { include('npc2.php'); npc2answer($do[1],19); }
    elseif ($do[0] == "npc2answer20") { include('npc2.php'); npc2answer($do[1],20); }
	
    // Others
    elseif ($do[0] == "orbs") { include('orbs.php'); orbs(); }
    elseif ($do[0] == "contact") { include('contact.php'); contact(); }
	
	// Start resource
	if($userrow["wood"] ) { $wood = '$userrow["wood"]'; }  
	if($userrow["fish"] ) { $fish = '$userrow["fish"]'; }
	// End resources

	// start profession     
    if($userrow["woodskill"] >= 1) { $status1 = 'WoodCutter'; } 
    if($userrow["fishskill"] >= 1) { $status1 = 'Fisher'; } 
	// End  profession
	
	// THIS STARTS THE ADVANCED QUESTS FUNCTIONS - TO ADD 6 QUESTS
    elseif ($do[0] == "quest1") { include('quests.php'); quest1(); }
    elseif ($do[0] == "quest2") { include('quests2.php'); quest2(); }
    elseif ($do[0] == "quest3") { include('quests3.php'); quest3(); }
    elseif ($do[0] == "quest4") { include('quests4.php'); quest4(); }
    elseif ($do[0] == "quest5") { include('quests5.php'); quest5(); }
    elseif ($do[0] == "quest6") { include('quests6.php'); quest6(); }
	// THIS ENDS THE ADVANCED QUESTS FUNCTIONS - TO ADD 6 QUESTS
	
	// Town
	 elseif ($do[0] == "exchange") { include('exchange.php'); expforgold(); }
	 elseif ($do[0] == "exchange") { include('exchange.php'); expforsilver(); }
	doquery("UPDATE {{table}} SET status1='$status1' WHERE id='".$userrow["id"]."' ", "users");  

	
	// Town functions.	   

} else { donothing(); }

function donothing() {
    
    global $userrow, $page, $title;

    if ($userrow["currentaction"] == "In Town") {
        $page = dotown();
        $title = "In Town";
    } 
	elseif ($userrow["currentaction"] == "Exploring") {
        $page = doexplore();
        $title = "Exploring";
    }
	elseif ($userrow["currentaction"] == "Fighting")  {
        $page = dofight();
        $title = "Fighting";		
    } 
	elseif ($userrow["currentaction"] == "Barried")  {
    $page = doregister();
    $title = "Barried";
	}
	elseif ($userrow["currentaction"] == "Quest Event") {
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
    elseif ($userrow["charclass"] == 53) { $userrow["charclass"] = $controlrow["class53name"]; }
    elseif ($userrow["charclass"] == 54) { $userrow["charclass"] = $controlrow["class54name"]; }
    elseif ($userrow["charclass"] == 55) { $userrow["charclass"] = $controlrow["class55name"]; }
    elseif ($userrow["charclass"] == 56) { $userrow["charclass"] = $controlrow["class56name"]; }
    elseif ($userrow["charclass"] == 57) { $userrow["charclass"] = $controlrow["class57name"]; }
    elseif ($userrow["charclass"] == 58) { $userrow["charclass"] = $controlrow["class58name"]; }
    elseif ($userrow["charclass"] == 59) { $userrow["charclass"] = $controlrow["class59name"]; }
    elseif ($userrow["charclass"] == 60) { $userrow["charclass"] = $controlrow["class60name"]; }
    elseif ($userrow["charclass"] == 61) { $userrow["charclass"] = $controlrow["class61name"]; }	
    elseif ($userrow["charclass"] == 62) { $userrow["charclass"] = $controlrow["class62name"]; }
    elseif ($userrow["charclass"] == 63) { $userrow["charclass"] = $controlrow["class63name"]; }
    elseif ($userrow["charclass"] == 64) { $userrow["charclass"] = $controlrow["class64name"]; }
    elseif ($userrow["charclass"] == 65) { $userrow["charclass"] = $controlrow["class65name"]; }

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
	$page = "<center><h3 class='title'>Using a Potion</h3><br /><br />You Do Not Have Enough Hit Potions.
	<br /><br /><a href='index.php' class='myButton2'>Back to Exploring</a></center><br />"; $die = true; }
  }
  
  if($type == 2)
  {
    $current = "currentmp"; $max = "maxmp"; $type = "mp_potion"; if($userrow["mp_potion"] == 0){  
	$page .= "<center><h3 class='title'>Using a Potion</h3><br /><br />You Do Not Have Enough Magic Potions.
	<br /><br /><a href='index.php' class='myButton2'>Back to Exploring</a></center><br />"; $die = true; }
  }
  
  if($type == 3)
  {
    $current = "currenttp"; $max = "maxtp"; $type = "tp_potion"; if($userrow["tp_potion"] == 0){  
	$page .= "<center><h3 class='title'>Using a Potion</h3><br /><br />You Do Not Have Enough Travel Potions.
	<br /><br /><a href='index.php' class='myButton2'>Back to Exploring</a></center><br />"; $die = true; }
  }
  
  if($die == false)
  {
    if($userrow["currentaction"] == "Fighting")
    {
      $page = "<center><h3 class='title'>Using a Potion</h3></center>
	  <br /><br /><Blockquote>The Monster Snatches The Potion From You Before You Can Drink It
	  <br /><br /><a href='index.php' class='myButton2'>Back to Exploring</a></Blockquote><br /><br />";
      $die = true;
      doquery("UPDATE {{table}} SET `$type` = `$type` - '1' WHERE `id` = '".$userrow["id"]."'", "users");
    }
    
    if($userrow[$current] == $userrow[$max] && $die == false)
    {
      $page = "<center><h3 class='title'>Using a Potion</h3></center>
	  <br /><br /><Blockquote>You don not need to use this Potion, You are at your maximum.
	  <br /><br /><a href='index.php' class='myButton2'>Back to Adventuring</a></Blockquote><br />v";
      $die = true;
    }
    
    if($die == false)
    {	  
      $page = "<center><h3 class='title'>Using a Potion</h3>
	  <br /><br /><Blockquote>You Successfully Used A Potion.<br /><br /><a href='index.php' class='myButton2'>Back</a></Blockquote></center><br /><br />";
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
	$page = "<center><h3 class='title'>Hit Points Potions - Gold</h3></center><br />
	  <center><Blockquote>You do not have enough <b>Gold</b> Coins to buy a Hit Potion.<br /><br /></Blockquote></center>"; $die = true; }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `hp_potion` = `hp_potion` + '1', `gold` = `gold` - '$price' WHERE `id` = '".$userrow["id"]."'", "users");
	   $page = "<center><h3 class='title'>Hit Points Potions - Gold</h3></center>
  <br /><center> 
  <table border='0' align='center'  width='75%' cellpadding='2' cellspacing='4'>
  <tr>
     <td><img src='images/items/potion-red.png' title='Hit Points Potion' alt='Hit Points Potions'/></td>
     <td align='center'><h4 class='titlepotion'>You Successfully Bought A <b>Hit Potion</b> with <b><i>Gold Coins</i></b>.</h4></td>
     <td>&nbsp;&nbsp;<img src='images/items/potion-red.png' title='Hit Points Potion' alt='Hit Points Potions'/></td>
  </tr>
</table>
<br /></center>";
    }
  }

    
  if($type == 2)
  {
    $price = $mp_price;
    if($price > $userrow["silver"]){ 
	$page = "<center><h3 class='title'>Magic Points Potions - Silver</h3></center><br />
	  <center><Blockquote>You do not have enough <b>Silver</b> Coins to buy a Magic Potion.<br /><br /></Blockquote></center>"; $die = true; }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `mp_potion` = `mp_potion` + '1', `silver` = `silver` - '$price' WHERE `id` = '".$userrow["id"]."'", "users");
	   $page = "<center><h3 class='title'>Magic Points Potions - Silver</h3></center>
  <br /><center> 
  <table border='0' align='center'  width='75%' cellpadding='2' cellspacing='4'>
  <tr>
     <td><img src='images/items/potion-green.png' title='Magic Points Potion' alt='Magic Points Potions'/></td>
     <td align='center'><h4 class='titlepotion'>You Successfully Bought A <b>Magic Potion</b> with <b><i>Silver Coins</i></b>.</h4></td>
     <td>&nbsp;&nbsp;<img src='images/items/potion-green.png' title='Magic Points Potion' alt='Magic Points Potions'/></td>
  </tr>
</table>
<br /></center>";
    }
  }
  
  
  if($type == 3)
  {
    $price = $tp_price;
    if($price > $userrow["copper"]){ 
	$page = "<center><h3 class='title'>Travel Points Potions - Copper</h3></center><br /><center><Blockquote>You do not have enough <b>Copper Coins</b> to buy a Travel Potion.<br /></Blockquote></center><br />"; $die = true; }
    
    if($die == false)
    {
      doquery("UPDATE {{table}} SET `tp_potion` = `tp_potion` + '1', `copper` = `copper` - '$price' WHERE `id` = '".$userrow["id"]."'", "users");
	   $page = "<center><h3 class='title'>Travel Points Potions - Copper</h3></center>
  <br /><center> 
  <table border='0' align='center'  width='75%' cellpadding='2' cellspacing='4'>
  <tr>
     <td><img src='images/items/potion-blue.png' title='Travel Points Potion' alt='Travel Points Potions'/></td>
     <td align='center'><h4 class='titlepotion'>You Successfully Bought A <b>Travel Potion</b> with <b><i>Copper Coins</i></b>.</h4></td>
     <td>&nbsp;&nbsp;<img src='images/items/potion-blue.png' title='Travel Points Potion' alt='Travel Points Potions'/></td>
  </tr>
</table>
<br /></center>";
    }
  }
  
  
  
  $userrow = checkcookies();
  $page .= "<center><h3 class='title'>What Wizards Potions to you want the Magic School to Brew?</h3></center>";
  $page .= "<table align='center' border='0' background='images/background/magic/magic-001.jpg' cellpadding='0' cellspacing='0' height='914' width='800'><tr><td>";

  $page .= "<center><br><br><br><br><br><br><br><br><br><br><br><form method='post'><table border='0' width='610'>
  
 
  
  <tr>
  <td>&nbsp;&nbsp;<br><br></td>
  <td>&nbsp;&nbsp;<br><br></td>
  </tr>
  
  <tr>
     <td height='152' width='340'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td border='0' background='images/background/magic/paper300x152.png' height='152' width='300'><center>
	 <br><br>Buy <b>Hit Points</b> Potion Bottles
	 <br>Price per Spell: ".number_format($hp_price)." <b><i>Gold Coins</i></b>
	 <br>Presently you have: ".number_format($userrow["hp_potion"])." Potions
	 <br><img src='images/items/potion-red.png' title='Hit Points Potion' alt='Hit Points Potion'/>
	 <br><a href='index.php?do=buypotions&buy=1' class='myButton2'>Buy</a> 
	 </center></td> 
  </tr>
  
  <tr>
  <td>&nbsp;&nbsp;<br><br></td>
  <td>&nbsp;&nbsp;<br><br></td>
  </tr>
  
  <tr>
     <td border='0' background='images/background/magic/paper300x152.png' height='152' width='300'><center>
	 <br><br>Buy <b>Magic Points</b> Potion Bottles
	 <br>Price per Spell: ".number_format($mp_price)." <b><i>Silver Coins</i></b>
	 <br>Presently you have: ".number_format($userrow["mp_potion"])." Potions
	 <br><img src='images/items/potion-green.png' title='Magic Points Potion' alt='Magic Points Potion'/>
	 <br><a href='index.php?do=buypotions&buy=2' class='myButton2'>Buy</a>
	 </center></td>
     <td height='152' width='340'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  
  <tr>
  <td>&nbsp;&nbsp;<br><br></td>
  <td>&nbsp;&nbsp;<br><br></td>
  </tr>
  
  <tr>
     <td height='152' width='340'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td border='0' background='images/background/magic/paper300x152.png' height='152' width='300'><center>
	 <br><br>Buy <b>Travel Points</b> Potion Bottles
	 <br>Price per Spell: ".number_format($tp_price)." <b><i>Copper Coins</i></b>
	 <br>Presently you have: ".number_format($userrow["tp_potion"])." Potions
	 <br><img src='images/items/potion-blue.png' title='Travel Points Potion' alt='Travel Points Potion'/>
	 <br><a href='index.php?do=buypotions&buy=3' class='myButton2'>Buy</a>
	 </center></td>
  </tr>
  <tr>
  <td colspan='2'><br><br><center><a href='index.php?do=towninf' class='myButton2'>Town Square</a></center></td>
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
        $townrow["news"] .= "<span class=\"light\">[".prettydate($newsrow["postdate"])."]</span>&nbsp;&nbsp;".nl2br($newsrow["content"]);
        $townrow["news"] .= "</td></tr></table>\n";
    } else { $townrow["news"] = ""; }
	
// Who's Online. Currently just members. Guests maybe later.

    if ($controlrow["showonline"] == 1) {

	    $onlinequery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-604801)."' ORDER BY charname", "users");
		
        $onlinequery1 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-604800)."' && UNIX_TIMESTAMP(onlinetime) <= '".(time()-172899)."' ORDER BY charname", "users");
        $onlinequery2 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-172800)."' && UNIX_TIMESTAMP(onlinetime) <= '".(time()-86399)."' ORDER BY charname", "users");
        $onlinequery3 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-86400)."' && UNIX_TIMESTAMP(onlinetime) <= '".(time()-3599)."' ORDER BY charname", "users");
        $onlinequery4 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-3600)."' && UNIX_TIMESTAMP(onlinetime) <= '".(time()-899)."' ORDER BY charname", "users");
        $onlinequery5 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-900)."' && UNIX_TIMESTAMP(onlinetime) <= '".(time()-599)."' ORDER BY charname", "users");
        $onlinequery6 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-600)."' && UNIX_TIMESTAMP(onlinetime) <= '".(time()-299)."' ORDER BY charname", "users");
        $onlinequery7 = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-300)."' ORDER BY charname", "users");

        $townrow["whosonline"] = "<table width=\"100%\"><tr><td class=\"title\" align=\"center\">Online Users</td></tr><tr><td>\n";
		
        $townrow["whosonline"] .= "<font color=\"#000000\" size=\"1\">There are " . mysql_num_rows($onlinequery) . " users online within the last:</font>&nbsp;&nbsp;&nbsp;<font color=\"#000000\" size=\"1\">7 Days</font>, <font color=\"#888888\" size=\"1\">2 Days</font>, <font color=\"#804040\" size=\"1\">24 Hours</font>, <font color=\"#7605FF\" size=\"1\">1 Hour</font>, <font color=\"red\" size=\"1\">15 Minutes</font>, <font color=\"green\" size=\"1\">10 Minutes</font>, <font color=\"blue\" size=\"1\">5 Minutes</font>:<br />";

while ($onlinerow = mysql_fetch_array($onlinequery1)) { $townrow["whosonline"] .= "<font color=\"#000000\" size=\"1\"><a style=\"color: #000000;\" href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
$townrow["whosonline"] .= "&nbsp;&nbsp;";

while ($onlinerow = mysql_fetch_array($onlinequery2)) { $townrow["whosonline"] .= "<font color=\"#888888\" size=\"1\"><a style=\"color: #888888;\" href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
$townrow["whosonline"] .= "&nbsp;&nbsp;";

while ($onlinerow = mysql_fetch_array($onlinequery3)) { $townrow["whosonline"] .= "<font color=\"#804040\" size=\"1\"><a style=\"color: #804040;\" href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
$townrow["whosonline"] .= "&nbsp;&nbsp;";

while ($onlinerow = mysql_fetch_array($onlinequery4)) { $townrow["whosonline"] .= "<font color=\"#7605FF\" size=\"1\"><a style=\"color: #7605FF;\" href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
$townrow["whosonline"] .= "&nbsp;&nbsp;";

while ($onlinerow = mysql_fetch_array($onlinequery5)) { $townrow["whosonline"] .= "<font color=\"red\" size=\"1\"><a style=\"color: red;\" href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
$townrow["whosonline"] .= "&nbsp;&nbsp;";

while ($onlinerow = mysql_fetch_array($onlinequery6)) { $townrow["whosonline"] .= "<font color=\"green\" size=\"1\"><a style=\"color: green;\" href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
$townrow["whosonline"] .= "&nbsp;&nbsp;";

while ($onlinerow = mysql_fetch_array($onlinequery7)) { $townrow["whosonline"] .= "<font color=\"blue\" size=\"1\"><a href=\"index.php?do=onlinechar:".$onlinerow["id"]."\" style=\"color: blue\">".$onlinerow["charname"]."</a></font>" . ", "; }

$townrow["whosonline"] = rtrim($townrow["whosonline"], ", ");
$townrow["whosonline"] .= "</td></tr></table></font>\n";

    } else { $townrow["whosonline"] = ""; }
	
//END Whos Online 

//START WHOS ONLINE #2

// Who's Online. Currently just members. Guests maybe later.
// if ($controlrow["showonline2"] == 1) {
// $onlinequery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-1)."' ORDER BY charname", "users");
// $townrow["whosonline2"] = "<table width=\"100%\"><tr><td class=\"title\" align=\"center\">Whos Online</td></tr><tr><td>\n";
// $townrow["whosonline2"] .= "<font color=\"#000000\">There is " . mysql_num_rows($onlinequery) . " user(s) online:</font> ";
// while ($onlinerow = mysql_fetch_array($onlinequery)) { $townrow["whosonline2"] .= "
// <a href=\"index.php?do=onlinechar:".$onlinerow["id"]."\">".$onlinerow["charname"]."</a></font>" . ", "; }
// $townrow["whosonline2"] = rtrim($townrow["whosonline2"], ", ");
// $townrow["whosonline2"] .= "</td></tr></table>\n";
// } else { $townrow["whosonline2"] = ""; } -->


//END WHOS ONLINE #2

    if ($controlrow["showbabble"] == 1) {
        $townrow["babblebox"] = "<table width=\"99%\"><tr><td class=\"title\" align=\"center\">Babble Box</td></tr><tr><td>\n";
        $townrow["babblebox"] .= "<iframe src=\"index.php?do=babblebox\" name=\"sbox\" width=\"100%\" height=\"150\" frameborder=\"0\" id=\"bbox\">Your browser does not support inline frames! The Babble Box will not be available until you upgrade to a newer Browers. <a href=\"http://www.mozilla.org\" target=\"_new\" class=\"myButton2\">Firefox</a>.</iframe>";
        $townrow["babblebox"] .= "</td></tr></table>\n";
    } else { $townrow["babblebox"] = ""; }

    
    $page = gettemplate("towns");
    $page = parsetemplate($page, $townrow);
    
    return $page;
    
}

//
//

function doexplore() { // Just spit out a blank exploring page or make Field page.
    
    // Exploring without a GET string is normally when they first log in, or when they've just finished fighting.

    global $userrow, $controlrow, $numqueries;

    if (($userrow["latitude"] == $fieldrow["latitude"]) && ($userrow["longitude"] == $fieldrow["longitude"])) {

    global $userrow, $controlrow, $numqueries;

   $fieldquery = doquery("SELECT id,name,longitude,latitude FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "fields");    
    $fieldrow = mysql_fetch_array($fieldquery);
    
    return $page;
}


// Correct root/index.php for random non-combat statements.
// 80 Random non-combat statements

$explor = rand(1,80);


// $page="you are exploring, but don't see anything of great interest";}


// Correct root/index.php for random non-combat statements.


if ($explor == 1) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/1.png' title='Woods' border='6'/></div>
<br>As you continue to explore your surrounds you come upon another group of Trees, You see nothing of interest that demands your attention of this wildness of endless trees.</td></tr></table></div>";}

if ($explor == 2) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/2.png' title='Unknown Journey' border='6'/></div>
<br>You continue your long Journey into the unknown. Only to come upon more mysterious and unexplored blanket of trees to explore!  You take careful notes of the unsurveyed woods that surrounds all before you.  Seeing nothing of interest you make a Travel Memo in you notebook and turn your attention to your travels.</td></tr></table></div>";}

if ($explor == 3) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/3.png' title='Paths and Clearing' border='6'/></div>
<br>More paths and another clearing, you could stay awhile, but I doubt this land offers much,</td></tr></table></div>";}

if ($explor == 4) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/4.png' title='Woods' border='6'/></div>
<br>You travel to a unique area. A small river runs through the land and lots of shade trees. Its a nice place to rest and take a bath.</td></tr></table></div>";}

if ($explor == 5) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/5.png' title='Woods' border='6'/></div>
<br>Many paths leading to a small clearing surrounded by trees. A nice place to camp an rest for awhile.</td></tr></table></div>";}

if ($explor == 6) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/6.png' title='Very Large Clearing' border='6'/></div>
<br>You spot a very large clearing in the middle of the woods. As with woods, all you can see is the trees.</td></tr></table></div>";}

if ($explor == 7) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/7.png' title='Woods' border='6'/></div>
<br>A nicer place you have found on you many travels. A small watering hold and beautiful trees are every where.</td></tr></table></div>";}

if ($explor == 8) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/8.png' title='Lots of Paths' border='6'/></div>
<br>Some many paths and some many ways to travel, so you can travel to your target area of this world.</td></tr></table></div>";}

if ($explor == 9) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/9.png' title='Woods' border='6'/></div>
<br>You come to a crossroads. Which way will you continue your journey.</td></tr></table></div>";}

if ($explor == 10) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/10.png' title='Swampy Land' border='6'/></div>
<br>A Swampy land with a larger river. To many insects to spend any time here, off to better lands.</td></tr></table></div>";}

if ($explor == 11) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/11.png' title='A Creek' border='6'/></div>
<br>Lucky you. Many paths and a creek! One of the most beautiful scenery you have seen in your many travels.</td></tr></table></div>";}

if ($explor == 12) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/12.png' title='Mysterious Woods' border='6'/></div>
<br>You continue your long Journey into the unknown. Only to come upon more mysterious and unexplored blanket of trees to explore!  You take careful notes of the unsurveyed woods that surrounds all before you.  Seeing nothing of interest you make a Travel Memo in you notebook and turn your attention to your travels.</td></tr></table></div>";}

if ($explor == 13) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/13.png' title='W to E Paths' border='6'/></div>
<br>You find a path leading West to East and many small paths forking from it. The choice is your, which way will you go.</td></tr></table></div>";}

if ($explor == 14) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/14.png' title='Woods' border='6'/></div>
<br>Your traveling on a path leading North and South, but any direction is available for you to explore.</td></tr></table></div>";}

if ($explor == 15) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/15.png' title='Woods' border='6'/></div>
<br>Nothing more than more and more of the same. Time to journey on.</td></tr></table></div>";}

if ($explor == 16) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/16.png' title='Standing Stones' border='6'/></div>
<br>You come upon a area with tall standing Stones forming somewhat of a circle. They are overgrown with bushes and weeds. You are unable to make out their use.</td></tr></table></div>";}

if ($explor == 17) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/17.png' title='Forbidding' border='6'/></div>
<br>You have entered another area of the world that is dark and forbidding. Time to move on.</td></tr></table></div>";}

if ($explor == 18) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/18.png' title='Dark and Dangerous' border='6'/></div>
<br>You enter a dark and dangerous area. Not a place you want to stay for long.</td></tr></table></div>";}

if ($explor == 19) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/19.png' title='Dead Forest' border='6'/></div>
<br>Another dark and mysterious place you have found. Time to more on.</td></tr></table></div>";}

if ($explor == 20) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/20.png' title='Strange Stones' border='6'/></div>
<br>As you continue to explore the landscape, you find a clearing of upright stones. You can not make out what use that might have had or do have.</td></tr></table></div>";}

if ($explor == 21) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/21.png' title='Rotten Growth' border='6'/></div>
<br>Old and rotten growth spreads around you. You haven't seen this much darken forest in your travels so far.</td></tr></table></div>";}

if ($explor == 22) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/22.png' title='Dead Forest' border='6'/></div>
<br>More of the dark forest, dead and deadly plants all around you. What has caused this to happen in such a wide area of this world.</td></tr></table></div>";}

if ($explor == 23) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/23.png' title='Many Choices' border='6'/></div>
<br>Paths leading Northwest, Southeast and Southwest. Many Choices to make.</td></tr></table></div>";}

if ($explor == 24) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/24.png' title='Dark Ruins' border='6'/></div>
<br>Not a place I wish to spend the night, time to move on and find better terrain.</td></tr></table></div>";}

if ($explor == 25) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/25.png' title='Dead Forest' border='6'/></div>
<br>More Strange upright Stones. You many have seem something like this is your travels.</td></tr></table></div>";}

if ($explor == 26) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/26.png' title='Dark Dead Forest' border='6'/></div>
<br>A Dark Dead Forest lays around you. To many areas of this world is cursed with these lands.</td></tr></table></div>";}


if ($explor == 27) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/27.png' title='Dark Places' border='6'/></div>
<br>A very dark and weird place, not a place I wish to spend the night, time to move on and find better terrain.</td></tr></table></div>";}

if ($explor == 28) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/28.png' title='Dead Forest' border='6'/></div>
<br>You stumble into a unremarkable landscape. Nothing to see or to explore.</td></tr></table></div>";}

if ($explor == 29) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/29.png' title='Dead Forest' border='6'/></div>
<br>Another path leading North and West. Nothing noticeable can be found.</td></tr></table></div>";}

if ($explor == 30) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/30.png' title='Pile of Clothes' border='6'/></div>
<br>Nothing surprises you any more. Off the side of the path you find a large pile of Clothes. The clothes are old, smell and ripped. You find nothing that is suitable for you and continue on your adventure. </td></tr></table></div>";}

if ($explor == 31) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/31.png' title='Large Forest' border='6'/></div>
<br>Entering a large forest area, but can be seen from you location and you decide to move one.</td></tr></table></div>";}

if ($explor == 32) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/32.png' title='Wrecked Boat' border='6'/></div>
<br>A strange setting unfolds before you. A wreck boat surround by red colored stones. You never seen anything like this before, plus what is a wreck boat or any boat for that matter during out here in the wild with the closest water weeks from here?</td></tr></table></div>";}

if ($explor == 33) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/33.png' title='Red Target' border='6'/></div>
<br>Are your eyes playing tricks on you? Is that a barrel with a huge red target on it? Fearing who ever has been here before, you quickly disappear before you become target practice yourself.</td></tr></table></div>";}

if ($explor == 34) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/34.png' title='Adventuring Ahead' border='6'/></div>
<br>As you continue your adventure into the unknown. You find a water well, the first you have came upon. You say to yourself what is a water well do out here in the middle of nothing. You decide not to drink from the well, not knowing if its foul or not.</td></tr></table></div>";}

if ($explor == 35) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/35.png' title='Large Palm Tree' border='6'/></div>
<br>You wander in a area that has palm trees growing, very strange. That is a impressive large palm tree in the middle or the clearing, but nothing else of interest.</td></tr></table></div>";}

if ($explor == 36) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/36.png' title='Flat Lands' border='6'/></div>
<br>As it stretches before you, a flat land that goes on for as far as you can see. More old ruins are seen off in the distance.</td></tr></table></div>";}

if ($explor == 37) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/37.png' title='Stone Ruins' border='6'/></div>
<br>You come to some ruins, some look like pieces of stone buildings, others could be parts of a massive road. These are very old ruins and have nothing of interest to you.</td></tr></table></div>";}

if ($explor == 38) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/38.png' title='Stables' border='6'/></div>
<br>More ruins this time they could have been part of a Stable or Slave Quarters. As with the others ruins, this is very old and anything that could have found for futher use is long gone.</td></tr></table></div>";}

if ($explor == 39) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/39.png' title='Palm Trees and Bushes' border='6'/></div>
<br>More Palm trees with many bushes in this section of the world. Nothing seen, nothing needed.</td></tr></table></div>";}

if ($explor == 40) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/40.png' title='Ruins' border='6'/></div>
<br>Rocky ground springs before us. Some trees to the North, just another area of the world to travel through.</td></tr></table></div>";}

if ($explor == 41) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/41.png' title='Tower Ruins' border='6'/></div>
<br>It seems you have found another pile of ruins from a circle building or a castle tower.</td></tr></table></div>";}

if ($explor == 42) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/42.png' title='Ruins' border='6'/></div>
<br>Not normal looking ruins. Around you are many flat craved stones covering the ground. They seem to be in not noticeable pattern. Interesting but nothing else.</td></tr></table></div>";}

if ($explor == 43) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/43.png' title='Flat Lands' border='6'/></div>
<br>It stretches you find some old ruins and plain ground before.</td></tr></table></div>";}

if ($explor == 44) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/44.png' title='Cliff and River' border='6'/></div>
<br>You enter an area that has a cliff to the South that drops down to a deep dark river below. The cliff can be climbed down, but easier directions to go are West, North or East. You must decide what path you will take.</td></tr></table></div>";}

if ($explor == 45) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/45.png' title='Circle Ruins' border='6'/></div>
<br>You have discovered more stone ruins. A strange circle of stone blocks that might have been a Round House or a Stone Tower. You find nothing else to give you a clue what this might have been used for.</td></tr></table></div>";}

if ($explor == 46) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/46.png' title='Ruins' border='6'/></div>
<br>Another Palm tree filled landscape. Some rocky land, it could have been once a shore on a long vanished sea or ocean.</td></tr></table></div>";}

if ($explor == 47) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/47.png' title='Ruins' border='6'/></div>
<br>A dense woods that has a smaller path going through it. A beautiful and wonderful place, but we have seen this before, I believe.</td></tr></table></div>";}

if ($explor == 48) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/48.png' title='Tall Cliffs' border='6'/></div>
<br>You came upon a tall cliffs to your north. Nothing different from what you have seen before.</td></tr></table></div>";}

if ($explor == 49) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/49.png' title='Small Path' border='6'/></div>
<br>A dense woods that has a smaller path going through it. A beautiful and wonderful place, but its time to move on.</td></tr></table></div>";}

if ($explor == 50) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/50.png' title='Unremarkable Place' border='6'/></div>
<br>A unremarkable place. You should continue your journey.</td></tr></table></div>";}

if ($explor == 51) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/51.png' title='Grasslands' border='6'/></div>
<br>Grassland, bushes and trees, what else is their in this land?</td></tr></table></div>";}

if ($explor == 52) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/52.png' title='Ruins' border='6'/></div>
<br>Stone road with very tall stone walls around it. Just some more old ruins, just a little different from the ones you have encounter before.</td></tr></table></div>";}

if ($explor == 53) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/53.png' title='Old Building' border='6'/></div>
<br>You came upon what looks like ruins from what was part of a larger city. Nothing of interest to be found here.</td></tr></table></div>";}

if ($explor == 54) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/54.png' title='Ruins' border='6'/></div>
<br>You found ruins that might have been part of a larger building or castle. You find wide stone stairs leading to a level stone blocks that has the foundation of a building.</td></tr></table></div>";}

if ($explor == 55) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/55.png' title='Stone Stairs' border='6'/></div>
<br>More stone ruins and nothing of interest to you or anyone else for a very long time.</td></tr></table></div>";}

if ($explor == 56) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/56.png' title='Massive Small Pond' border='6'/></div>
<br>Traveling on rough terrain you spot rocky stairs leading down to a small pond.</td></tr></table></div>";}

if ($explor == 57) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/57.png' title='Massive Dry Ravine' border='6'/></div>
<br>In front of you is a massive Dry Ravine, rocky and barren. It will take some time to travel through this dangerous terrain.</td></tr></table></div>";}

if ($explor == 58) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/58.png' title='Dry Ravine' border='6'/></div>
<br>A Rocky outcrop surrounded by trees to the South and East. You make note of your surrounding and move on.</td></tr></table></div>";}

if ($explor == 59) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/59.png' title='Tough Climbing' border='6'/></div>
<br>You are surrounded by Massive Cliffs On three sides. Looks like tough climbing if I go forth.</td></tr></table></div>";}

if ($explor == 60) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/60.png' title='Thick Woods' border='6'/></div>
<br>A thick dark woods confronts you to the west. You see nothing of interest and decide to move on.</td></tr></table></div>";}

if ($explor == 61) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/61.png' title='Dry Ravine' border='6'/></div>
<br>A Unfamiliar and pleasant part of the forest. Nothing of interesting here, time to more forward and explore more of this exciting and new world.</td></tr></table></div>";}

if ($explor == 62) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/62.png' title='Ancient Scars' border='6'/></div>
<br>A huge area of flat rocks with strange cravings or ancient scars. If you had more than you could examine it closer.</td></tr></table></div>";}

if ($explor == 63) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/63.png' title='Barren Lands' border='6'/></div>
<br>Your travels bring you to a barren land. Nothing much of interest to you or anyone for that matter. Its time for you to move on.</td></tr></table></div>";}

if ($explor == 64) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/64.png' title='Stange Cliffs' border='6'/></div>
<br>Wow, a very strange stone formation. It looks like it could have been craved out by some civilians a long time ago. The Size of this is very impressive!</td></tr></table></div>";}

if ($explor == 65) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/65.png' title='Palm Trees' border='6'/></div>
<br>Tropical plants and easy traveling. Nothing is sighted in this area, time to move on.</td></tr></table></div>";}

if ($explor == 66) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/66.png' title='Dry Ravine' border='6'/></div>
<br>Two large pile of boulders set in the middle of grassland. You do not have the energy to climb the boulders for a sight seeing trip.</td></tr></table></div>";}

if ($explor == 67) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/67.png' title='Dry Ravine' border='6'/></div>
<br>More rocky terrain with a scattering of small bushes, nothing to see here. </td></tr></table></div>";}

if ($explor == 68) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/68.png' title='Wet Ravine' border='6'/></div>
<br>You come upon a great body of water, there seems to be a stone path leading down to the water. Not needing a bath right now, you continue on.</td></tr></table></div>";}

if ($explor == 69) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/69.png' title='A River Below' border='6'/></div>
<br>A river below you and rocky terrain and a stone path leading below.</td></tr></table></div>";}

if ($explor == 70) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/70.png' title='Large Pit' border='6'/></div>
<br>You come upon a huge pit. Its a long way down and seen to have some bones scattered below. To deep to climb down, so you should go around.</td></tr></table></div>";}

if ($explor == 71) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/71.png' title='A Clearing' border='6'/></div>
<br>Your adventuring brings you to a clearing. A peaceful and pleasant area.</td></tr></table></div>";}

if ($explor == 72) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/72.png' title='N to S Roads' border='6'/></div>
<br>A wide stone road leads North to South. With unique and beautiful trees lining both sides. Almost like it was planned this why.</td></tr></table></div>";}

if ($explor == 73) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/73.png' title='Lost Stone Roads' border='6'/></div>
<br>More Ancient stone roads, some go on for a long distance, others just disappear after a few yards.</td></tr></table></div>";}

if ($explor == 74) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/74.png' title='Ancient Road' border='6'/></div>
<br>Your traveling on a ancient design that has two forks leading to the south. As with most of this old ruins, the stone roads lead to nowhere but more stone ruins.</td></tr></table></div>";}

if ($explor == 75) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/75.png' title='Lost Roads' border='6'/></div>
<br>You have come to a crossroads, four stone paved roads each leading in a different direction. You must choose you own path and continue forward.</td></tr></table></div>";}

if ($explor == 76) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/76.png' title='Lost Roads' border='6'/></div>
<br>Stone roads! Stone roads! Nothing but stone roads everywhere. Lets hope the next place we visit is different.</td></tr></table></div>";}

if ($explor == 77) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/77.png' title='Stone Roads' border='6'/></div>
<br>Your traveling on a stone road that leads North, East and West. South is still an option for travel, which way will you proceed?</td></tr></table></div>";}

if ($explor == 78) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/78.png' title='Lost Roads' border='6'/></div>
<br>The stone roads again appears in front of you, this time leading East, West and South. All good directions to further explore. But then again North is always an option to resume your travels. </td></tr></table></div>";}

if ($explor == 79) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/79.png' title='Lost Roads' border='6'/></div>
<br>Three paths and a old stone road. Which way to go and where do they lead to?</td></tr></table></div>";}

if ($explor == 80) {
$page="<div align='center'><table width='60' border='0' bordercolor='#000000'><tr>
<td align='left'><div align='center'><img src='images/random/80.png' title='North to South Road' border='6'/></div>
<br>This area you find yourself in has a stone road leading North and South. Not much different from the other roads you have found before.</td></tr></table></div>";}


// Bridges


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

function doregister() { // Redirect to Register.
    
    header("Location: users.php?do=register");
    
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
					$page .= "<tr><td align=\"center\">" .$name. "<br /></td></tr>";
					$page .= "<tr><td align=\"center\">" .$name2. "<br /></td></tr>";
					$page .= "<tr><td align=\"left\">" .$text. "<br /></td></tr>";
					$page .= "<tr><td align=\"center\">Rewards<br /></td></tr>";
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
    elseif ($userrow["charclass"] == 53) { $userrow["charclass"] = $controlrow["class53name"]; }
    elseif ($userrow["charclass"] == 54) { $userrow["charclass"] = $controlrow["class54name"]; }
    elseif ($userrow["charclass"] == 55) { $userrow["charclass"] = $controlrow["class55name"]; }
    elseif ($userrow["charclass"] == 56) { $userrow["charclass"] = $controlrow["class56name"]; }
    elseif ($userrow["charclass"] == 57) { $userrow["charclass"] = $controlrow["class57name"]; }
    elseif ($userrow["charclass"] == 58) { $userrow["charclass"] = $controlrow["class58name"]; }
    elseif ($userrow["charclass"] == 59) { $userrow["charclass"] = $controlrow["class59name"]; }
    elseif ($userrow["charclass"] == 60) { $userrow["charclass"] = $controlrow["class60name"]; }
    elseif ($userrow["charclass"] == 61) { $userrow["charclass"] = $controlrow["class61name"]; }
    elseif ($userrow["charclass"] == 62) { $userrow["charclass"] = $controlrow["class62name"]; }


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
	$userquery = doquery("SELECT * FROM {{table}} WHERE id='$id' OR charname='$id' LIMIT 1", "users");
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
    elseif ($userrow["charclass"] == 53) { $userrow["charclass"] = $controlrow["class53name"]; }
    elseif ($userrow["charclass"] == 54) { $userrow["charclass"] = $controlrow["class54name"]; }
    elseif ($userrow["charclass"] == 55) { $userrow["charclass"] = $controlrow["class55name"]; }
    elseif ($userrow["charclass"] == 56) { $userrow["charclass"] = $controlrow["class56name"]; }
    elseif ($userrow["charclass"] == 57) { $userrow["charclass"] = $controlrow["class57name"]; }
    elseif ($userrow["charclass"] == 58) { $userrow["charclass"] = $controlrow["class58name"]; }
    elseif ($userrow["charclass"] == 59) { $userrow["charclass"] = $controlrow["class59name"]; }
    elseif ($userrow["charclass"] == 60) { $userrow["charclass"] = $controlrow["class60name"]; }
    elseif ($userrow["charclass"] == 61) { $userrow["charclass"] = $controlrow["class61name"]; }
    elseif ($userrow["charclass"] == 62) { $userrow["charclass"] = $controlrow["class62name"]; }

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


    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "monsters");
    


function showwiki() { 
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    
    $page = $xml . gettemplate("wiki");
	
	$query = doquery("SELECT * FROM {{table}} WHERE id = '".$_GET[id]."'","monsters");
	$queryres = mysql_fetch_assoc($query);
	$u = mysql_fetch_array(doquery("SELECT username FROM {{table}} WHERE id = '".$queryres[seenby]."'","users"));
	
	if($u['username']){	$array["seenby"] = "Monster first discovered by <b>".$u['username']."</b>."; 
	$array["name"] = "Name: <b>".$queryres["name"]."</b>";
	$array["level"] = " (Level <b>".$queryres["level"]."</b>)";
	$array["title"] = "Monster Wiki - ".$queryres["name"];
	$array["hitpoints"] = "This monster has <b>".$queryres['maxhp']."</b> hitpoints.";
	$array["damage"] = "This monster has an attack range from <b>0</b> to <b>".$queryres['maxdam']."</b>.";
    $array["monsterimg"] = "<img src=\"images/monsters/".$u["currentmonster"].".png\" />";
	
	}else{
	
	$array["seenby"] = "<b>This monster hasn't been discovered Yet!<br>Congratulations</b>.";
	$array["name"] = "Name: <b>".$queryres["name"]."</b>";
	$array["level"] = " (Level <b>".$queryres["level"]."</b>)";
	$array["title"] = "Monster Wiki - ".$queryres["name"];
	$array["hitpoints"] = "Monster has <b>".$queryres['maxhp']."</b> hitpoints.";
	$array["damage"] = "Monster has an attack range from <b>0</b> to <b>".$queryres['maxdam']."</b>.";
    $array["monsterimg"] = "<img src=\"images/monsters/".$u["currentmonster"].".png\" />";
	}
	
	
	
	
    //$array = array("content"=>"Work in Progress<br>#RESSID = ".$_GET[id], "title"=>"Monster Wiki");
    echo parsetemplate($page, $array);
    die();
    
}

	

if ($do[0] == "makemap") { makemap(); }


/* function makemap() {
	global $userrow, $controlrow;
	$latitude = $userrow["latitude"];
	$longitude = $userrow["longitude"];
	$map = imageCreate(501,501);
	$magenta = ImageColorAllocate($map, 255, 0, 255);
	$red = imageColorAllocate($map, 211, 0, 0);
	ImageColorTransparent($map, $magenta);
	imageFilledEllipse($map, ($longitude + 250), (-$latitude + 250), 7, 7, $red);
	header("Content-type: image/png");
	imagePNG($map);
	imageDestroy($map);
} */


function makemap() {
	global $userrow, $controlrow;
	$latitude = $userrow["latitude"];
	$longitude = $userrow["longitude"];
	$map = imageCreate(501,501);
	$magenta = ImageColorAllocate($map, 255, 0, 255);
	$red = imageColorAllocate($map, 211, 0, 0);

	ImageColorTransparent($map, $magenta);
	imageFilledEllipse($map, ($longitude + 250), (-$latitude + 250), 10, 10, $red);
	
	$onlinequery = doquery("SELECT * FROM dk_users WHERE username <> '$userrow[username]' AND UNIX_TIMESTAMP(onlinetime) >= '".(time()-1000)."' ORDER BY username", "users");
	while ($row = mysql_fetch_array($onlinequery)) 
			{
					
					$blue = imagecolorallocate($map, 0, 180, 0);
					$black = imagecolorallocate($map, 254, 254, 254);
					$text = $row['username'];
					$addx = 6;	
					$xpos = $row['longitude'];
					for ($x=0;$x < strlen($text);$x++) {
						$char = $text[$x];
						
					imagechar($map, 2, ($xpos + 220), (-$row['latitude'] + 234), $char, $black);
					$xpos += $addx;
					}
					imageFilledEllipse($map, ($row['longitude'] + 250), (-$row['latitude'] + 250), 7, 7, $blue);
			}

	header("Content-type: image/png");
	imagePNG($map);
	imageDestroy($map);
}


function babblebox() {
    
    global $userrow;
    
    if (isset($_POST["babble"])) {
        $safecontent = makesafe($_POST["babble"]);
        $textsmilies = array(":p", ":)", ":(", ";)", "-.-");
        $imagesmilies = array("<img src=\"images/smilies/tongue.gif\">", "<img src=\"images/smilies/smile.gif\">", "<img src=\"images/smilies/frown.gif\">", "<img src=\"images/smilies/wink.gif\">", "<img src=\"images/smilies/mm.gif\">");
        $safecontent = str_replace($textsmilies, $imagesmilies, $safecontent);
        if ($safecontent == "" || $safecontent == " ") { //blank post. do nothing.
        } else { $insert = doquery("INSERT INTO {{table}} SET id='',posttime=NOW(),author='".$userrow["charname"]."',babble='$safecontent'", "babble"); }
        header("Location: index.php?do=babblebox");
        die();
    }
    
    $babblebox = array("content"=>"");
    $bg = 2;
    $babblequery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 10", "babble");
    while ($babblerow = mysql_fetch_array($babblequery)) {
        if ($bg == 1) { $new = "<div style=\"width:98%; background-color:#eeeeee;\">[".$babblerow["author"]."] ".$babblerow["babble"]."</div>\n"; $bg = 1; }

   else { $new = "<div style=\"width:98%; background-color:#ffffff;\"><a href=\"index.php?do=onlinechar:".$babblerow["author"]."\" target=conr_main_frame>".$babblerow["author"]."</a> ".stripslashes($babblerow["babble"])."</div>\n"; $bg = 2; } 
        $babblebox["content"] = $new . $babblebox["content"];
    }
    $babblebox["content"] .= "<center><form action=\"index.php?do=babblebox\" method=\"post\"><input type=\"text\" name=\"babble\" size=\"46\" maxlength=\"50\" /><br /><input type=\"submit\" name=\"submit\" value=\"Babble\" /> <input type=\"reset\" name=\"reset\" value=\"Clear\" /></form></center>";
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
    $page = $xml . gettemplate("babblebox");
    echo parsetemplate($page, $babblebox);
    die();

}


function ninja() {
    header("Location: http://www.michaelmccart.com/wolf3d/index.php");
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
        	if ($sender == "") { $errors++; $errorlist .= "The sender name is required.<br /><br />"; }
       		if (!is_numeric($goldsent)) { $errors++; $errorlist .= "The amount of gold sent needs to be a number.<br /><br />"; }			
			if ($goldsent == "") { $errors++; $errorlist .= "The amount of gold is required.<br /><br />"; }		
			if ($reciever == "") { $errors++; $errorlist .= "The receivers name is required.<br /><br />"; }		
			if ($goldsent > $maximumgold) { $errors++; $errorlist .= "You're trying to send more gold than what you have.<br /><br />"; }		
			if ($goldsent == "0") { $errors++; $errorlist .= "You need to send more gold than just zero.<br /><br />"; }		
			if ($reciever == $sender) { $errors++; $errorlist .= "There is no need to be sending gold to yourself.<br /><br />"; }		
			if (!$rec) { $errors++; $errorlist .= "Character name doesn't exist.<br /><br />"; }		
			if ($rec == $userrow[charname]) { $errors++; $errorlist .= "There is no need to be sending gold to yourself.<br /><br />"; }        
			if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET gold=gold-$goldsent WHERE charname='$sender'","users");
            $query2 = doquery("UPDATE {{table}} SET gold=gold+$goldsent WHERE charname='$reciever'","users");

			display("<h3 class='title'><center>The Money Exchange Gold Transaction Completed</h3></div><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=\"questback\">".$userrow["charname"]." you have successfully transferred <span style=\"color: #92E4FF;\">$goldsent</span> Gold Coins to the <span style=\"color: #92E4FF;\">$reciever</span>.<br /><br />You Currently have <span style=\"color: #92E4FF;\">$userrow[bank]</span> Gold in your Bank Account and <span style=\"color: #92E4FF;\">$userrow[gold]</span> Gold On Hand.</h4><br /><br /><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>","Send Gold");

        } else {
		
            display("<center><h3 class='title'>The Money Exchange Gold Transaction Errors</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br /><br /><center><h4 class=\"questback\"><b>Errors:</b></h4><br /><br /><i>$errorlist</i><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>", "Send Gold");

        }        
        
    } 
$page = <<<END
<h3 class="title"><div align="center">Send Gold to Other Players</h3></div><br /><br /><br />
<center>You can transfer gold to other users here.<br />
Example user name: Sir_James<br />
<i>You must enter a number greater than 1</i>.<br /><br /><br />
<div style=text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;><table width=40% border=0 cellpadding=1 cellspacing=1 style=border-width: 0px; background-color: #ffffff;>
<form method="post" action="index.php?do=sendgold">
<input name="sender" type="hidden" value="$userrow[charname]" id="sender" />
<tr><td width="30%">Gold Sending:</td><td><input name="goldsent" type="text" size="12" maxlength="12" /> Gold Coins.<br /></td></tr>
<tr><td width="30%">Receivers Name:</td><td><input name="reciever" type="text" size="20" /><br /><br /></td></tr>
<tr><td width="30%"><div align="center"><input class="myButton2" name="sendgold" type="submit" value="Submit" /></div>
</form>
<tr><td colspan="2"><br /><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center>></td></tr></table></div></center>
END;

display($page,"Send Gold");

}

function sendsilver() {

	global $userrow;
$maximumsilver = $userrow[gold];
 $checkquery = doquery("SELECT * FROM {{table}} WHERE charname='".$_POST['reciever']."' LIMIT 1", "users");
        $rec = mysql_fetch_assoc($checkquery);
if (isset($_POST["sendsilver"])) {
        
		extract($_POST);
		$errors = 0;
		$errorlist = "";
        	if ($sender == "") { $errors++; $errorlist .= "The sender name is required.<br /><br />"; }
       		if (!is_numeric($silversent)) { $errors++; $errorlist .= "The amount of silver sent needs to be a number.<br /><br />"; }			
			if ($silversent == "") { $errors++; $errorlist .= "The amount of silver is required.<br /><br />"; }		
			if ($reciever == "") { $errors++; $errorlist .= "The receivers name is required.<br /><br />"; }		
			if ($silversent > $maximumsilver) { $errors++; $errorlist .= "You're trying to send more silver than what you have.<br /><br />"; }		
			if ($silversent == "0") { $errors++; $errorlist .= "You need to send more silver than just zero.<br /><br />"; }		
			if ($reciever == $sender) { $errors++; $errorlist .= "There is no need to be sending silver to yourself.<br /><br />"; }		
			if (!$rec) { $errors++; $errorlist .= "Character name doesn't exist.<br /><br />"; }		
			if ($rec == $userrow[charname]) { $errors++; $errorlist .= "There is no need to be sending silver to yourself.<br /><br />"; }        
			if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET silver=silver-$silversent WHERE charname='$sender'","users");
            $query2 = doquery("UPDATE {{table}} SET silver=silver+$silversent WHERE charname='$reciever'","users");
				
			
			display("<h3 class='title'><center>The Money Exchange Silver Transaction Completed</h3></div><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=\"questback\">".$userrow["charname"]." you have successfully transferred <span style=\"color: #92E4FF;\">$silversent</span> Silver Coins to the <span style=\"color: #92E4FF;\">$reciever</span>.<br /><br />You Currently have <span style=\"color: #92E4FF;\">$userrow[silverbank]</span> Silver in your Bank Account and <span style=\"color: #92E4FF;\">$userrow[silver]</span> Silver On Hand.</h4><br /><br /><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>","Send Silver");

        } else {
		
            display("<center><h3 class='title'>The Money Exchange Silver Transaction Errors</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br /><br /><center><h4 class=\"questback\"><b>Errors:</b></h4><br /><br /><i>$errorlist</i><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>", "Send Silver");

        }        
        
    } 
$page = <<<END
<h3 class="title"><div align="center">Send Silver to Other Players</h3></div><br /><br /><br />
<center>You can transfer gold to other users here.<br />
Example user name: Sir_James<br />
<i>You must enter a number greater than 1</i>.<br /><br /><br />
<div style=text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;><table width=40% border=0 cellpadding=1 cellspacing=1 style=border-width: 0px; background-color: #ffffff;>
<form method="post" action="index.php?do=sendsilver">
<input name="sender" type="hidden" value="$userrow[charname]" id="sender" />
<tr><td width="30%">Silver Sending:</td><td><input name="silversent" type="text" size="12" maxlength="12" /> Silver Coins.<br /></td></tr>
<tr><td width="30%">Receivers Name:</td><td><input name="reciever" type="text" size="20" /><br /><br /></td></tr>
<tr><td width="30%"><div align="center"><input class="myButton2" name="sendsilver" type="submit" value="Submit" /></div>
</form>
<tr><td 
<tr><td colspan="2"><br /><br /><br /><center><a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></td></tr></table></div></center></center>
END;

display($page,"Send Silver");

}


  function sendcopper() {

	global $userrow;
$maximumcopper = $userrow[gold];
 $checkquery = doquery("SELECT * FROM {{table}} WHERE charname='".$_POST['reciever']."' LIMIT 1", "users");
        $rec = mysql_fetch_assoc($checkquery);
if (isset($_POST["sendcopper"])) {
        
		extract($_POST);
		$errors = 0;
		$errorlist = "";
        	if ($sender == "") { $errors++; $errorlist .= "The sender name is required.<br /><br />"; }
       		if (!is_numeric($coppersent)) { $errors++; $errorlist .= "The amount of copper sent needs to be a number.<br /><br />"; }			
			if ($coppersent == "") { $errors++; $errorlist .= "The amount of copper is required.<br /><br />"; }		
			if ($reciever == "") { $errors++; $errorlist .= "The receivers name is required.<br /><br />"; }		
			if ($coppersent > $maximumcopper) { $errors++; $errorlist .= "You're trying to send more copper than what you have.<br /><br />"; }		
			if ($coppersent == "0") { $errors++; $errorlist .= "You need to send more copper than just zero.<br /><br />"; }		
			if ($reciever == $sender) { $errors++; $errorlist .= "There is no need to be sending copper to yourself.<br /><br />"; }		
			if (!$rec) { $errors++; $errorlist .= "Character name doesn't exist.<br /><br />"; }		
			if ($rec == $userrow[charname]) { $errors++; $errorlist .= "There is no need to be sending copper to yourself.<br /><br />"; }        
			if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET copper=copper-$coppersent WHERE charname='$sender'","users");
            $query2 = doquery("UPDATE {{table}} SET copper=copper+$coppersent WHERE charname='$reciever'","users");
			
			display("<h3 class='title'><center>The Money Exchange Copper Transaction Completed</h3></div><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><center><h4 class=\"questback\">".$userrow["charname"]." you have successfully transferred <span style=\"color: #92E4FF;\">$coppersent</span> Copper Coins to the <span style=\"color: #92E4FF;\">$reciever</span>.<br /><br />You Currently have <span style=\"color: #92E4FF;\">$userrow[copperbank]</span> Copper in your Bank Account and <span style=\"color: #92E4FF;\">$userrow[copper]</span> Copper On Hand.</h4><br /><br /><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>","Send Copper");

        } else {
		
            display("<center><h3 class='title'>The Money Exchange Copper Transaction Errors</h3><br><br /><center><table align=\"center\" background=\"images/background/city/bankgsc.png\" width=\"800\" height=\"800\"><tr><td><table align=\"center\" width=\"30%\"><tr><td nowrap=\"flag\"><br /><br /><center><h4 class=\"questback\"><b>Errors:</b></h4><br /><br /><i>$errorlist</i><br /><br /><center><a href=index.php class=myButton2>Town Square</a>&nbsp; &nbsp;<a href=index.php?do=bankgsc class=myButton2>The Money Exchange</a>&nbsp;&nbsp;<a href=index.php?do=inn class=myButton2>Inn</a></center></td></tr></table></td></tr></table></center>","Send Copper");

        }        
        
    } 
$page = <<<END
<h3 class="title"><div align="center">Send Copper to Other Players</h3></div><br /><br /><br />
<center>You can transfer gold to other users here.<br />
Example user name: Sir_James<br />
<i>You must enter a number greater than 1</i>.<br /><br /><br />
<div style=text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;><table width=40% border=0 cellpadding=1 cellspacing=1 style=border-width: 0px; background-color: #ffffff;>
<form method="post" action="index.php?do=sendcopper">
<input name="sender" type="hidden" value="$userrow[charname]" id="sender" />
<tr><td width="30%">Copper Sending:</td><td><input name="coppersent" type="text" size="12" maxlength="12" /> Copper Coins.<br /></td></tr>
<tr><td width="30%">Receivers Name:</td><td><input name="reciever" type="text" size="20" /><br /><br /></td></tr>
<tr><td width="30%"><div align="center"><input class="myButton2" name="sendcopper" type="submit" value="Submit" /></div>
</form>
<tr><td 
<tr><td colspan="2"><br /><br /><br /><center><a href=index.php?do=bankcopper class=myButton2>Copper Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></td></tr></table></div></center></center>
END;

display($page,"Send Copper");

}



?>