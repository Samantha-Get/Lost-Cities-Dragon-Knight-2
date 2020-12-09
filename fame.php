<?php // fame.php hall of fame tables

require_once('lib.php');

//include('login.php');
include('cookies.php');
$link = opendb();
$userrow = checkcookies();

$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);

$menu = $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Character Hall of Fame Top 75</h3></center></td></tr></table><br><br>";
$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";
$page .= "<center><a href='index.php'>Return to the Game</a><br></center>";

if ($userrow == false) {
	//die("X");
    if (isset($_GET["do"])) {
        if ($_GET["do"] == "verify") { header("Location: users.php?do=verify"); die(); }
    }
    header("Location: login.php?do=login"); die();
}

if (isset($_GET["do"])) {
	$do = explode(":",$_GET["do"]);

	if ($do[0] == "vault") { dovault(); }	

    elseif ($do[0] == "main") { main($do[1]); }
	elseif ($do[0] == "mage") { mage($do[1]); }
    elseif ($do[0] == "barbarian") { barbarian($do[1]); }
    elseif ($do[0] == "bard") { bard($do[1]); }
    elseif ($do[0] == "cleric") { cleric($do[1]); }
    elseif ($do[0] == "ranger") { ranger($do[1]); }
    elseif ($do[0] == "sorceress") { sorceress($do[1]); }
    elseif ($do[0] == "warrior") { warrior($do[1]); }
    elseif ($do[0] == "rogue") { rogue($do[1]); }
    elseif ($do[0] == "druid") { druid($do[1]); }
    elseif ($do[0] == "paladin") { paladin($do[1]); }
    elseif ($do[0] == "necromancer") { necromancer($do[1]); }
    elseif ($do[0] == "priest") { priest($do[1]); }
    elseif ($do[0] == "reaper") { reaper($do[1]); }
    elseif ($do[0] == "assassin") { assassin($do[1]); }
    elseif ($do[0] == "inquisitor") { inquisitor($do[1]); }
    elseif ($do[0] == "warlord") { warlord($do[1]); }
    elseif ($do[0] == "cultist") { cultist($do[1]); }
    elseif ($do[0] == "wizard") { wizard($do[1]); }
    elseif ($do[0] == "drow") { drow($do[1]); }
    elseif ($do[0] == "shadow") { shadow($do[1]); }
    elseif ($do[0] == "imp") { imp($do[1]); }
    elseif ($do[0] == "fighter") { fighter($do[1]); }
	elseif ($do[0] == "monk") { monk($do[1]); }
    elseif ($do[0] == "kobold") { kobold($do[1]); }
    elseif ($do[0] == "dark-knight") { dark-knight($do[1]); }	
    elseif ($do[0] == "succubus") { succubus($do[1]); }
    elseif ($do[0] == "battlemaster") { battlemaster($do[1]); }	
    elseif ($do[0] == "deathseeker") { deathseeker($do[1]); }
	elseif ($do[0] == "demon") { demon($do[1]); }
    elseif ($do[0] == "seer") { seer($do[1]); }
	elseif ($do[0] == "angel") { angel($do[1]); }
    elseif ($do[0] == "dragonkin") { dragonkin($do[1]); }
	elseif ($do[0] == "wanderer") { wanderer($do[1]); }
    elseif ($do[0] == "whipmaster") { whipmaster($do[1]); }
	elseif ($do[0] == "alchemist") { alchemist($do[1]); }
    elseif ($do[0] == "scholar") { scholar($do[1]); }
	elseif ($do[0] == "royal-guard") { royal-guard($do[1]); }
    elseif ($do[0] == "zarclax") { zarclax($do[1]); }
	elseif ($do[0] == "tinkerer") { tinkerer($do[1]); }
    elseif ($do[0] == "elemental-fire") { elemental-fire($do[1]); }
	elseif ($do[0] == "elemental-water") { elemental-water($do[1]); }
    elseif ($do[0] == "elemental-wind") { elemental-wind($do[1]); }
	elseif ($do[0] == "elemental-earth") { elemental-earth($do[1]); }
    elseif ($do[0] == "elemental-air") { elemental-air($do[1]); }
	elseif ($do[0] == "dragonslayer") { dragonslayer($do[1]); }
    elseif ($do[0] == "knight") { knight($do[1]); }
	elseif ($do[0] == "demonkin") { demonkin($do[1]); }
    elseif ($do[0] == "orc") { orc($do[1]); }
	elseif ($do[0] == "stoneman") { stoneman($do[1]); }
    elseif ($do[0] == "andriod") { andriod($do[1]); }
	elseif ($do[0] == "gypsie") { gypsie($do[1]); }
} 

function main() {
global $controlrow, $userrow;
$query= doquery("SELECT * FROM {{table}} ORDER BY experience DESC LIMIT 100", "users");
$page = "<table width='96%' border='1'><tr><td><center><h3 class='title'>Hall of Records: First 100 Players</h3></center></td></tr></table><br />";


$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Records: First 100 Players
<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Character Name</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Class</th>
<th width=\"12%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Level</th>
<th width=\"12%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Experience</th>
<th width=\"12%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Gold</th>
<th width=\"12%\" style=\"background-color:#dddddd;\" class=\"small\">&nbsp;&nbsp;&nbsp;Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	 $row["gold"] = number_format($row["gold"]);
	 $row["bank"] = number_format($row["bank"]);
	 $row["experience"] = number_format($row["experience"]);
			
     if ($row["charclass"] == 1) { $row["charclass"] = $controlrow["class1name"]; }
    elseif ($row["charclass"] == 2) { $row["charclass"] = $controlrow["class2name"]; }
    elseif ($row["charclass"] == 3) { $row["charclass"] = $controlrow["class3name"]; }
    elseif ($row["charclass"] == 4) { $row["charclass"] = $controlrow["class4name"]; }
    elseif ($row["charclass"] == 5) { $row["charclass"] = $controlrow["class5name"]; }
    elseif ($row["charclass"] == 6) { $row["charclass"] = $controlrow["class6name"]; }
    elseif ($row["charclass"] == 7) { $row["charclass"] = $controlrow["class7name"]; }
    elseif ($row["charclass"] == 8) { $row["charclass"] = $controlrow["class8name"]; }
    elseif ($row["charclass"] == 9) { $row["charclass"] = $controlrow["class9name"]; }
    elseif ($row["charclass"] == 10) { $row["charclass"] = $controlrow["class10name"]; }
    elseif ($row["charclass"] == 11) { $row["charclass"] = $controlrow["class11name"]; }
    elseif ($row["charclass"] == 12) { $row["charclass"] = $controlrow["class12name"]; }
    elseif ($row["charclass"] == 13) { $row["charclass"] = $controlrow["class13name"]; }
    elseif ($row["charclass"] == 14) { $row["charclass"] = $controlrow["class14name"]; }
    elseif ($row["charclass"] == 15) { $row["charclass"] = $controlrow["class15name"]; }
    elseif ($row["charclass"] == 16) { $row["charclass"] = $controlrow["class16name"]; }
    elseif ($row["charclass"] == 17) { $row["charclass"] = $controlrow["class17name"]; }
    elseif ($row["charclass"] == 18) { $row["charclass"] = $controlrow["class18name"]; }
    elseif ($row["charclass"] == 19) { $row["charclass"] = $controlrow["class19name"]; }
    elseif ($row["charclass"] == 20) { $row["charclass"] = $controlrow["class20name"]; }
    elseif ($row["charclass"] == 21) { $row["charclass"] = $controlrow["class21name"]; }
    elseif ($row["charclass"] == 22) { $row["charclass"] = $controlrow["class22name"]; }
    elseif ($row["charclass"] == 23) { $row["charclass"] = $controlrow["class23name"]; }
    elseif ($row["charclass"] == 24) { $row["charclass"] = $controlrow["class24name"]; }
    elseif ($row["charclass"] == 25) { $row["charclass"] = $controlrow["class25name"]; }
    elseif ($row["charclass"] == 26) { $row["charclass"] = $controlrow["class26name"]; }
    elseif ($row["charclass"] == 27) { $row["charclass"] = $controlrow["class27name"]; }
    elseif ($row["charclass"] == 28) { $row["charclass"] = $controlrow["class28name"]; }
    elseif ($row["charclass"] == 29) { $row["charclass"] = $controlrow["class29name"]; }
    elseif ($row["charclass"] == 30) { $row["charclass"] = $controlrow["class30name"]; }
    elseif ($row["charclass"] == 31) { $row["charclass"] = $controlrow["class31name"]; }
    elseif ($row["charclass"] == 32) { $row["charclass"] = $controlrow["class32name"]; }
    elseif ($row["charclass"] == 33) { $row["charclass"] = $controlrow["class33name"]; }
    elseif ($row["charclass"] == 34) { $row["charclass"] = $controlrow["class34name"]; }
    elseif ($row["charclass"] == 35) { $row["charclass"] = $controlrow["class35name"]; }
    elseif ($row["charclass"] == 36) { $row["charclass"] = $controlrow["class36name"]; }
    elseif ($row["charclass"] == 37) { $row["charclass"] = $controlrow["class37name"]; }
    elseif ($row["charclass"] == 38) { $row["charclass"] = $controlrow["class38name"]; }
    elseif ($row["charclass"] == 39) { $row["charclass"] = $controlrow["class39name"]; }
    elseif ($row["charclass"] == 40) { $row["charclass"] = $controlrow["class40name"]; }
    elseif ($row["charclass"] == 41) { $row["charclass"] = $controlrow["class41name"]; }
    elseif ($row["charclass"] == 42) { $row["charclass"] = $controlrow["class42name"]; }
    elseif ($row["charclass"] == 43) { $row["charclass"] = $controlrow["class43name"]; }
    elseif ($row["charclass"] == 44) { $row["charclass"] = $controlrow["class44name"]; }
    elseif ($row["charclass"] == 45) { $row["charclass"] = $controlrow["class45name"]; }
    elseif ($row["charclass"] == 46) { $row["charclass"] = $controlrow["class46name"]; }
    elseif ($row["charclass"] == 47) { $row["charclass"] = $controlrow["class47name"]; }
    elseif ($row["charclass"] == 48) { $row["charclass"] = $controlrow["class48name"]; }
    elseif ($row["charclass"] == 49) { $row["charclass"] = $controlrow["class49name"]; }
    elseif ($row["charclass"] == 50) { $row["charclass"] = $controlrow["class50name"]; }
    elseif ($row["charclass"] == 51) { $row["charclass"] = $controlrow["class51name"]; }
    elseif ($row["charclass"] == 52) { $row["charclass"] = $controlrow["class52name"]; }

	if($row["authlevel"] == 1) { 
	$page .= ""; }
	elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table></div><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";    
    
    display($page, "Hall of Fame");
    
}



// mage
function mage() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=1 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Mage [1]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"96%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Mage [1]
<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"1%\" style=\"background-color:#dddddd;\" class=\"small\">Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Class</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Level</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Experience</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Gold</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 1) { $row["charclass"] = $controlrow["class1name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
$page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";  
    
    display($page, "Hall of Fame");    
}



// barbarian
function barbarian() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=2 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75:  Barbarian [2]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"96%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Barbarians [2]<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"1%\" style=\"background-color:#dddddd;\" class=\"small\">Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Class</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Level</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Experience</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Gold</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 2) { $row["charclass"] = $controlrow["class2name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
$page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";  
    
    display($page, "Hall of Fame");
    
}

// bard
function bard() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=3 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Bards [3]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Bards [3]<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"1%\" style=\"background-color:#dddddd;\" class=\"small\">Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Class</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Level</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Experience</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Gold</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 3) { $row["charclass"] = $controlrow["class3name"]; }


	 if($row["authlevel"] == 1) { 
	$page .= ""; }
	 elseif($row["charname"] == $userrow["charname"]) {
$page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";       
    
    display($page, "Hall of Fame");    
}


function cleric() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=4 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Cleric [4]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Cleric [4]<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"1%\" style=\"background-color:#dddddd;\" class=\"small\">Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Class</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Level</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Experience</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Gold</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 4) { $row["charclass"] = $controlrow["class4name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";        
    
    display($page, "Hall of Fame");
    
}



// ranger
function ranger() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=5 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Ranger [5]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Rangers [5]<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"1%\" style=\"background-color:#dddddd;\" class=\"small\">Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Class</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Level</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Experience</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Gold</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 5) { $row["charclass"] = $controlrow["class5name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";       
    
    display($page, "Hall of Fame");
    
}



// sorceress
function sorceress() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=6 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Sorceress [6] </h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Sorceress [6]<br />Click on a Character Name to view their Profiles</center></th>
</tr>
<tr>
<th width=\"1%\" style=\"background-color:#dddddd;\" class=\"small\">Rank</th>
<th width=\"20%\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Class</th>
<th width=\"2%\" style=\"background-color:#dddddd;\" class=\"small\">Level</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Experience</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Gold</th>
<th width=\"10%\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</th>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 6) { $row["charclass"] = $controlrow["class6name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";      
    
    display($page, "Hall of Fame");
    
}



// warrior
function warrior() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=7 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Warrior [7]</h3></center></td></tr></table><p>";


$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<td colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Warriors [7]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 7) { $row["charclass"] = $controlrow["class7name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}



// rogue
function rogue() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=8 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr>
 <td><center><h3 class='title'>Hall of Fame Top 75: Rogue [8]</h3></center></td></tr></table><p>";


$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<td colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Rogue [8]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 8) { $row["charclass"] = $controlrow["class8name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}




// druid
function druid() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=9 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Druid [9]</h3></center></td></tr></table><p>";


$page .= "<center>
<table border='1' width='96%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"96%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Druid [9]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 9) { $row["charclass"] = $controlrow["class9name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}

// paladin
function paladin() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=10 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Paladin [10]</h3></center></td></tr></table><p>";


$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Paladin [10]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 10) { $row["charclass"] = $controlrow["class10name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}



// Necromancer
function necromancer() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=11 ORDER BY experience DESC LIMIT 75", "users");
 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Necromancer [11]</h3></center></td></tr></table><p>";


$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";

$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Necromancer [11]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 11) { $row["charclass"] = $controlrow["class11name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}





// Priest
function priest() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=12 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Priest [12]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Priests [12]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 12) { $row["charclass"] = $controlrow["class12name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}






// reaper
function reaper() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=13 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Reaper [13]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Reaper [13]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 13) { $row["charclass"] = $controlrow["class13name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}



// Assassin
function assassin() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=14 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Assassin [14]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Assassin [14]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 14) { $row["charclass"] = $controlrow["class14name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}



// Inquisitor
function inquisitor() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=15 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Inquisitor [14]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Inquisitor [15]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 15) { $row["charclass"] = $controlrow["class15name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}













// Warlord
function warlord() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=16 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Warlord [16]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Warlord [16]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 16) { $row["charclass"] = $controlrow["class16name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}





// Cultist
function cultist() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=17 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Cultist [14]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Cultist [17]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 17) { $row["charclass"] = $controlrow["class17name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}




// Wizard
function wizard() {
global $controlrow, $userrow;

$query= doquery("SELECT * FROM {{table}} WHERE charclass=18 ORDER BY experience DESC LIMIT 75", "users");

 $page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fame Top 75: Wizards [14]</h3></center></td></tr></table><p>";

$page .= "<center>
<table border='1' width='80%' class='TFtable'>
  <tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=main\"><b>Main Hall</b></a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=mage\">Mage</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=barbarian\">Barbarian</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=bard\">Bard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cleric\">Cleric</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=ranger\">Ranger</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=sorceress\">Sorceress</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warrior\">Warrior</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=rogue\">Rogue</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=druid\">Druid</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=paladin\">Paladin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=necromancer\">Necromancer</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=priest\">Priest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=reaper\">Reaper</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=assassin\">Assassin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=inquisitor\">Inquisitor</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=warlord\">Warlord</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=cultist\">Cultist</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wizard\">Wizard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=drow\">Drow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=shadow\">Shadow</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=imp\">Imp</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=fighter\">Fighter</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=monk\">Monk</a></td>
   </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=kobold\">Kobold</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dark-knight\">Dark-Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=succubus\">Succubus</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=battlemaster\">Battlemaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=deathseeker\">Deathseeker</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demon\">Demon</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=seer\">Seer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=angel\">Angel</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonkin\">Dragonkin</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=wanderer\">Wanderer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=whipmaster\">Whipmaster</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=alchemist\">Alchemist</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=scholar\">Scholar</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=royal-guard\">Royal-Guard</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=zarclax\">Zarclax</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=tinkerer\">Tinkerer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-fire\">Elemental-Fire</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-water\">Elemental-Water</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-wind\">Elemental-Wind</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-earth\">Elemental-Earth</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=elemental-air\">Elemental-Air</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=dragonslayer\">Dragonslayer</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=knight\">Knight</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=demonkin\">Demonkin</a></td>
    </tr><tr> 
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=orc\">Orc</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=stoneman\">Stoneman</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=andriod\">Andriod</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=gypsie\">Gypsie</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=\">&nbsp;&nbsp;</a></td>
  </tr><tr>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=toprich\">Richest</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=combat\">Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=noncombat\">Non-Combat</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totalfights\">Total Fights</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"fame.php?do=totals\">Totals</a></td>
<td width='16%' align='center' nowrap class='small'><a href=\"index.php\"><b>Town Square</b></a></td>
  </tr>
</table></center><br>";


$page .= "<div align=\"center\"><table width=\"80%\"><tr><td style=\"padding:1px; background-color:black;\">
<table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
<tr>
<th colspan=\"7\" style=\"background-color:#dddddd;\"><center>Hall of Fame Top 75: Wizards [18]<br />Click on a Character Name to view their Profiles</center></td>
</tr>
<tr>
<td width=\"10%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Rank</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Character Name</td>
<td width=\"20%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Class</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Level</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Experience</td>
<td width=\"12%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Gold</td>
<td width=\"13%\" align=\"center\" style=\"background-color:#dddddd;\" class=\"small\">Banked Gold</td>
</tr>\n";

$count = 1;
$n=0;
while ($row = mysql_fetch_array($query)) {
$n += 1;

	    	$row["gold"] = number_format($row["gold"]);
	    	$row["bank"] = number_format($row["bank"]);
	    	$row["experience"] = number_format($row["experience"]);
     if ($row["charclass"] == 18) { $row["charclass"] = $controlrow["class18name"]; }

	 if($row["authlevel"] == 1) { 
	$page .= ""; }
elseif($row["charname"] == $userrow["charname"]) {
           $page .= "<tr>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:orange;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
}
		elseif ($count == 1) {
$page .= "<tr>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#ffffff;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 2;
		} else {
$page .= "<tr>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">$n</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\"><a href=\"index.php?do=onlinechar:".$row["id"]."\">".$row["charname"]."</a></td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["charclass"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["level"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["experience"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["gold"]."</td>
<td style=\"background-color:#eeeeee;\" align=\"center\" class=\"small\">".$row["bank"]."</td>
</tr>\n";
			$count = 1;
		}
	  }
    
    $page .= "</table></td></tr></table><br />";
$page .= "<br><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br />\n";     
    
    display($page, "Hall of Fame");    
}












?>