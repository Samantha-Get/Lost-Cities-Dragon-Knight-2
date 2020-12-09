<?php 
include('lib.php'); 
$link = opendb();
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);
ob_start("ob_gzhandler");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><? echo $controlrow["gamename"]; ?> Help</title>
<style type="text/css">

body {
  background-image: url(images/background.jpg);
  color: black;
  font: 11px verdana;
}
table {
  border-style: none;
  padding: 0px;
  font: 11px verdana;
}
td {
  border-style: none;
  padding: 3px;
  vertical-align: top;
}
td.top {
  border-bottom: solid 2px black;
}
td.left {
  width: 150px;
  border-right: solid 2px black;
}
td.right {
  width: 150px;
  border-left: solid 2px black;
}
a {
    color: #663300;
    text-decoration: none;
    font-weight: bold;
}
a:hover {
    color: #330000;
}
.small {
  font: 10px verdana;
}
.highlight {
  color: red;
}
.light {
  color: #999999;
}
.title {
  border: solid 1px black;
  background-color: #eeeeee;
  font-weight: bold;
  padding: 5px;
  margin: 3px;
}
.copyright {
  border: solid 1px black;
  background-color: #eeeeee;
  font: 10px verdana;
}
</style>
</head>
<body>
<a name="top"></a>
<h1><? echo $controlrow["gamename"]; ?> Help</h1>
[ <a href="index.php">Return to the game</a> ]

<br /><br /><hr />

<h3><? echo $controlrow["gamename"]; ?> Table of Contents <b>Currently being Updated 07/04/2018</b></h3>
<ul>
<li /><a href="#intro">Introduction</a>
<li /><a href="#classes">Character Classes</a>
<li /><a href="#difficulties">Difficulty Levels</a>
<li /><a href="#intown">Playing The Game: In Town</a>
<li /><a href="#exploring">Playing The Game: Exploring & Fighting</a>
<li /><a href="#status">Playing The Game: Status Panels</a>
<li /><a href="#items">Spoilers: Items & Drops</a>
<li /><a href="#monsters">Spoilers: Monsters</a>
<li /><a href="#spells">Spoilers: Spells</a>
<li /><a href="#levels">Spoilers: Levels</a>
<li /><a href="#credits">Credits</a>
</ul>

<hr />

<h3><a name="intro"></a>Introduction (Original)</h3>
Firstly, I'd like to say thank you for playing my game. The <i>Dragon Knight</i> game engine is the result of several months of 
planning, coding and testing. The original idea was to create a web-based tribute to the NES game, <i>Dragon 
Warrior</i>. In its current iteration, only the underlying fighting system really resembles that game, as almost 
everything else in DK has been made bigger and better. But you should still recognize bits and pieces as stemming
from <i>Dragon Warrior</i> and other RPGs of old.<br /><br />
This is the first game I've ever written, and it has definitely been a positive experience. It got difficult at
times, admittedly, but it was still a lot of fun to write, and even more fun to play. And I hope to use this
experience so that if I ever want to create another game it will be even better than this one.<br /><br />
If you are a site administrator, and would like to install a copy of DK on your own server, you may visit the
<a href="http://dragon.se7enet.com/dev.php" target="_new">development site</a> for <i>Dragon Knight</i>. This page 
includes the downloadable game source code, as well as some other resources that developers and administrators may
find valuable.<br /><br />
Once again, thanks for playing!<br /><br />
<i>Jamin Seven</i><br />
<i>Dragon Knight creator</i><br />
<a href="http://www.se7enet.com" target="_new">My Homepage</a><br />
<a href="http://dragon.se7enet.com/dev.php" target="_new">Dragon Knight Homepage</a><br ><br />
[ <a href="#top">Top</a> ]<br />

<h3><a name="intro"></a>Introduction to <? echo $controlrow["gamename"]; ?></h3>
&nbsp;&nbsp;&nbsp;Thank you to Jamin Seven for making <i>Dragon Knight</i> open source for us all. My modified version of <i>Dragon Knight</i> is called <? echo $controlrow["gamename"]; ?>. In this version of the game has been heavily modified from the original game. Mostly using the Mods available from the <i>Dragon Knight</i> <a href="http://dragon.se7enet.com/dev.php" target="_new">development site</a>. 
<br /><br />&nbsp;&nbsp;&nbsp;There are some really good mods there, and there are also many more than don't work as well at they should, or even at all.
If you making your own modified version of the original <i>Dragon Knight</i> or <? echo $controlrow["gamename"]; ?> that you back up your php pages after each change. AND don't forget to back up you SQL files each time you make a change! I can't state hope important this is, I have been to close to have the game to its present point,
more than once to find out a little error in the php page or SQL forced me to restart from scratch!
<br /><br />&nbsp;&nbsp;&nbsp;You will find almost every MOD available on the Development Site in this modified version, <? echo $controlrow["gamename"]; ?>, plus about
two dozen of my own enhancements or enlargement of those original Mods.
<br /><br />&nbsp;&nbsp;&nbsp;This has been a 3 year project for me so far, 2010 to 2011 & 2016 thru 2018. Parts of <? echo $controlrow["gamename"]; ?> which are not fully flushed out will be noted in other areas of this help file.
<br /><br />&nbsp;&nbsp;&nbsp;I am not ready to release the coded pages or the SQL file to the public yet. But if you have made major improvements to the Kingdom Mod (Available on the <a href="http://dragon.se7enet.com/dev.php" target="_new">development site</a>) that has been added to this game, I am willing to trade a Major Upgraded Kingdom Mod for my code and SQL files. I am not trying to hold my files hostage, it just I want a major upgrade to the Kingdom Mod before I do.
<br />Michael Archangel McCart
<br />Lost Cities creator
<br /><a href="http://www.michaelmccart.com" target="_new">My Homepage</a><br />
<br /><a href="http://http://michaelmccart.com/dk3134/login.php?do=login" target="_new"><? echo $controlrow["gamename"]; ?> Homepage</a>
<br /><br />[ <a href="#top">Top</a> ]
<br />



<h3><a name="classes"></a>Character Classes in <? echo $controlrow["gamename"]; ?></h3>
&nbsp;&nbsp;&nbsp;There are 53 different character classes in <? echo $controlrow["gamename"]; ?>. The main differences between the classes are what spells you get
access to, the speed with which you level up, and the amount of HP/MP/strength/dexterity you gain per level. 
<br /><br />&nbsp;&nbsp;&nbsp;For more detailed information about the characters, You can view the Levels table at the bottom of this page to
get that information.<br /><br />

<ul>
<li /><b><? echo $controlrow["class1name"]; ?></b><br />
<li /><b><? echo $controlrow["class2name"]; ?></b><br />
<li /><b><? echo $controlrow["class3name"]; ?></b><br />
<li /><b><? echo $controlrow["class4name"]; ?></b><br />
<li /><b><? echo $controlrow["class5name"]; ?></b><br />
<li /><b><? echo $controlrow["class6name"]; ?></b><br />
<li /><b><? echo $controlrow["class7name"]; ?></b><br />
<li /><b><? echo $controlrow["class8name"]; ?></b><br />
<li /><b><? echo $controlrow["class9name"]; ?></b><br />
<li /><b><? echo $controlrow["class10name"]; ?></b><br />
<li /><b><? echo $controlrow["class11name"]; ?></b><br />
<li /><b><? echo $controlrow["class12name"]; ?></b><br />
<li /><b><? echo $controlrow["class13name"]; ?></b><br />
<li /><b><? echo $controlrow["class14name"]; ?></b><br />
<li /><b><? echo $controlrow["class15name"]; ?></b><br />
<li /><b><? echo $controlrow["class16name"]; ?></b><br />
<li /><b><? echo $controlrow["class17name"]; ?></b>&nbsp;<font color="#FF0000">***</font>&nbsp;DO NOT USE CLASSES BELOW THIS CLASS. THEY ARE NOT FULLY COMPLETED YET.<br />
<li /><b><? echo $controlrow["class18name"]; ?></b><br />
<li /><b><? echo $controlrow["class19name"]; ?></b><br />
<li /><b><? echo $controlrow["class20name"]; ?></b><br />
<li /><b><? echo $controlrow["class21name"]; ?></b><br />
<li /><b><? echo $controlrow["class22name"]; ?></b><br />
<li /><b><? echo $controlrow["class23name"]; ?></b><br />
<li /><b><? echo $controlrow["class24name"]; ?></b><br />
<li /><b><? echo $controlrow["class25name"]; ?></b><br />
<li /><b><? echo $controlrow["class26name"]; ?></b><br />
<li /><b><? echo $controlrow["class27name"]; ?></b><br />
<li /><b><? echo $controlrow["class28name"]; ?></b><br />
<li /><b><? echo $controlrow["class29name"]; ?></b><br />
<li /><b><? echo $controlrow["class30name"]; ?></b><br />
<li /><b><? echo $controlrow["class31name"]; ?></b><br />
<li /><b><? echo $controlrow["class32name"]; ?></b><br />
<li /><b><? echo $controlrow["class33name"]; ?></b><br />
<li /><b><? echo $controlrow["class34name"]; ?></b><br />
<li /><b><? echo $controlrow["class35name"]; ?></b><br />
<li /><b><? echo $controlrow["class36name"]; ?></b><br />
<li /><b><? echo $controlrow["class37name"]; ?></b><br />
<li /><b><? echo $controlrow["class38name"]; ?></b><br />
<li /><b><? echo $controlrow["class39name"]; ?></b><br />
<li /><b><? echo $controlrow["class40name"]; ?></b><br />
<li /><b><? echo $controlrow["class41name"]; ?></b><br />
<li /><b><? echo $controlrow["class42name"]; ?></b><br />
<li /><b><? echo $controlrow["class43name"]; ?></b><br />
<li /><b><? echo $controlrow["class44name"]; ?></b><br />
<li /><b><? echo $controlrow["class45name"]; ?></b><br />
<li /><b><? echo $controlrow["class46name"]; ?></b><br />
<li /><b><? echo $controlrow["class47name"]; ?></b><br />
<li /><b><? echo $controlrow["class48name"]; ?></b><br />
<li /><b><? echo $controlrow["class49name"]; ?></b><br />
<li /><b><? echo $controlrow["class50name"]; ?></b><br />
<li /><b><? echo $controlrow["class51name"]; ?></b><br />
<li /><b><? echo $controlrow["class52name"]; ?></b><br />
</ul>

[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="difficulties"></a>Difficulty Levels <? echo $controlrow["gamename"]; ?></h3>
<i><? echo $controlrow["gamename"]; ?></i> includes the ability to play using one of 11 difficulty levels.
All monster statistics in the game are set at a base number. However, using a difficulty multiplier, certain statistics
are increased. The amount of hit points a monster has goes up, which means it will take longer to kill. But the amount
of experience and gold you gain from killing it also goes up. So the game is a little bit harder, but it is also more
rewarding. The following are the 11 difficulty levels and their statistic multiplier, which applies to the monster's
HP, experience drop, and gold drop.
<ul>
<li /><? echo $controlrow["diff1name"] . ": <b>" . $controlrow["diff1mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff2name"] . ": <b>" . $controlrow["diff2mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff3name"] . ": <b>" . $controlrow["diff3mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff4name"] . ": <b>" . $controlrow["diff4mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff5name"] . ": <b>" . $controlrow["diff5mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff6name"] . ": <b>" . $controlrow["diff6mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff7name"] . ": <b>" . $controlrow["diff7mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff8name"] . ": <b>" . $controlrow["diff8mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff9name"] . ": <b>" . $controlrow["diff9mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff10name"] . ": <b>" . $controlrow["diff10mod"] . "</b>"; ?>
<li /><? echo $controlrow["diff11name"] . ": <b>" . $controlrow["diff11mod"] . "</b>"; ?>
</ul>
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="intown"></a>Playing The Game: In Town <? echo $controlrow["gamename"]; ?></h3>
When you begin a new game, the first thing you see is the Town screen. Towns serve four primary functions: healing, buying items, buying maps, and displaying game information.<br /><br />
To heal yourself, click the "Rest at the Inn" link at the top of the town screen. Each town's Inn has a different price - some towns are cheap, others are expensive. No matter what town you're in, the Inns always serve the same function: they restore your current hit points, magic points, and travel points to their maximum amounts. Out in the field, you are free to use healing spells to restore your hit points, but when you run low on magic points, the only way to restore them is at an Inn.
<br /><br />Buying weapons and armor is accomplished through the appropriately-named "Buy Weapons/Armor" link. Not every item is available in every town, so in order to get the most powerful items, you'll need to explore some of the outer towns. Once you've clicked the link, you are presented with a list of items available in this town's store. To the left of each item is an icon that represents its type: weapon, armor or shield. The amount of attack/defense power, as well as the item's price, are displayed to the right of the item name.
<br /><br />You'll notice that some items have a red asterisk (<span class="highlight">*</span>) next to their names. These are items that come with special attributes that modify other parts of your character profile. See the Items & Drops table at the bottom of this page for more information about special items.
<br /><br />Maps are the third function in towns. Buying a map to a town places the town in your Travel To box in the left status panel. Once you've purchased a town's map, you can click its name from your Travel To box and you will jump to that town. Traveling this way costs travel points, though, and you'll only be able to visit towns if you have enough travel points.
<br /><br />The final function in towns is displaying game information and statistics. This includes the latest news post made by the game administrator, a list of players who have been online recently, and the Babble Box.<br /><br />
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="exploring"></a>Playing The Game: Exploring & Fighting <? echo $controlrow["gamename"]; ?></h3>
Once you're done in town, you are free to start exploring the world. Use the compass buttons on the left status panel to move around. The game world is basically a big square, divided into four quadrants. Each quadrant is <? echo $controlrow["gamesize"]; ?> spaces square. The first town is usually located at (0N,0E). Click the North button from the first town, and now you'll be at (1N,0E). Likewise, if you now click the West button, you'll be at (1N,1W). Monster levels increase with every 5 spaces you move outward from (0N,0E).
<br /><br />While you're exploring, you will occasionally run into monsters. As in pretty much any other RPG game, you and the monster take turns hitting each other in an attempt to reduce each other's hit points to zero. Once you run into a monster, the Exploring screen changes to the Fighting screen.
<br /><br />When a fight begins, you'll see the monster's name and hit points, and the game will ask you for your first command. You then get to pick whether you want to fight, use a spell, or run away. Note, though, that sometimes the monster has the chance to hit you first.
<br /><br />The Fight button is pretty straightforward: you attack the monster, and the amount of damage dealt is based on your attack power and the monster's armor. On top of that, there are two other things that can happen: an Excellent Hit, which doubles your total attack damage; and a monster dodge, which results in you doing no damage to the monster.
<br /><br />The Spell button allows you to pick an available spell and cast it. See the Spells list at the bottom of this page for more information about spells.
<br /><br />Finally, there is the Run button, which lets you run away from a fight if the monster is too powerful. Be warned, though: it is possible for the monster to block you from running and attack you. So if your hit points are low, you may fare better by staying around monsters that you know can't do much damage to you.<br /><br />
Once you've had your turn, the monster also gets his turn. It is also possible for you to dodge the monster's attack and take no damage.
<br /><br />The end result of a fight is either you or the monster being knocked down to zero hit points. If you win, the monster dies and will give you a certain amount of experience and gold. There is also a chance that the monster will drop an item, which you can put into one of the <strike>three</strike> eight <font color="#16BA00">[Modified in this Game]</font> inventory slots to give you extra points in your character profile. If you lose and die, half of your gold is taken away - however, you are given back a few hit points to help you make it back to town (for example, if you don't have enough gold to pay for an Inn, and need to kill a couple low-level monsters to get the money).
<br /><br />When the fight is over, you can continue exploring until you find another monster to beat into submission.
<br /><br />
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="status"></a>Playing The Game: Status Panels <? echo $controlrow["gamename"]; ?>></h3>
There are two status panels on the game screen: left and right.<br /><br />
The left panel includes your current location and play status (In Town, Exploring, Fighting), compass buttons for movement, and the Travel To list for jumping between towns. At the bottom of the left panel is also a list of game functions.
<br /><br />The right panel displays some character statistics, your inventory, and quick spells.<br /><br />
The Character section shows the most important character statistics. It also displays the status bars for your current hit points, magic points and travel points. These status bars are colored either green, yellow or red depending on your current amount of each stat. There is also a link to pop up your list of extended statistics, which shows more detailed character information.
<br /><br />The Fast Spells section lists any Heal spells you've learned. You may use these links any time you are in town or exploring to cast the heal spell. These may not be used during fights, however - you have to use the Spells box on the fight screen for that.
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="items"></a>Spoilers: Items & Drops <? echo $controlrow["gamename"]; ?></h3>
<a href="help_items.php">Click here</a> for the Items & Drops spoiler page.<br /><br />
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="monsters"></a>Spoilers: Monsters <? echo $controlrow["gamename"]; ?></h3>
<a href="help_monsters.php">Click here</a> for the Monsters spoiler page.<br /><br />
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="spells"></a>Spoilers: Spells <? echo $controlrow["gamename"]; ?></h3>
<a href="help_spells.php">Click here</a> for the Spells spoiler page.<br /><br />
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="levels"></a>Spoilers: Levels <? echo $controlrow["gamename"]; ?></h3>
<a href="help_levels.php">Click here</a> for the Levels spoiler page.<br /><br />
[ <a href="#top">Top</a> ]

<br /><br /><hr />

<h3><a name="credits"></a>Credits (Original)</h3>
<ul>
<li /><b>All program code and stock graphics for the game were created by Jamin Seven</b>.<br /><br />
<li />Major props go to a few people on the PHP manual site, for help with various chunks of code. The specific people are listed in the source code.<br /><br />
</ul>
<br /><br /><hr />

Please visit the following sites for more information (Original):<br />
<a href="http://www.se7enet.com" target="_new">Se7enet</a> (Jamin's homepage)<br />
<a href="http://dragon.se7enet.com/dev.php" target="_new">Dragon Knight</a> (official DK homepage)<br />
<a href="http://se7enet.com/forums" target="_new">Forums</a> (official DK forums)<br /><br />
All original coding and graphics for the <i>Dragon Knight</i> game engine are &copy; 2003-2005 by Jamin Seven.<br /><br />
[ <a href="#top">Top</a> ]
<br /><br /><hr />

<h3><a name="credits"></a>Credits <? echo $controlrow["gamename"]; ?></h3>
<ul>
<li /><b>All program code modifications or new additional code and graphics for the game are public domain or were created by Michael McCart</b>.<br /><br />
</ul>
<br /><br /><hr />

&nbsp;&nbsp;&nbsp;Please visit the following sites for more information <? echo $controlrow["gamename"]; ?>:<br />
All modifications or new additional code and graphics for the <? echo $controlrow["gamename"]; ?> game are &copy; 2016-2018 by Michael D McCart.<br />
<br /><a href="http://www.michaelmccart.com" target="_new">My Homepage</a><br />
<br /><a href="http://http://michaelmccart.com/dk3134/login.php?do=login" target="_new"><? echo $controlrow["gamename"]; ?> Homepage</a><br ><br />
[ <a href="#top">Top</a> ]
<br /><br />
<table class="copyright" width="100%">
<tr>
<td align="center" class="copyright"><a href="http://dragon.se7enet.com/dev.php" target="_new">&copy; 2003-2006 by renderse7en</a></td>
<td align="center" class="copyright">The Lost Cities Version {{version}}{{build}} &copy; 2010-2020 by ES_Archangel - Archangel Michael - Archangel Heaavenweb</td>
<td align="center" class="copyright"><a href="https://michaelmccart.com/" target="_new">MichaelMcCart.Com</a></td>
<td align="center" class="copyright">{{totaltime}} Sec. {{numqueries}} Queries</td>
</tr>
</table>
</body>
</html>