<?php
$template = <<<THEVERYENDOFYOU
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>{{title}}</title>

<style type="text/css">
/*<![CDATA[*/
body {
  background-image: url(images/background.jpg);
  color: black;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
}

td, input, select, textarea {
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
  font-weight: Normal;
   }
   
input, select, textarea {
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
  border-style:outset;
  border-color:#eeeeee;
  color:#000000;
}

table {
  border-style: none;
  padding: 0px;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
}

td {
  border-style: none;
  padding: 1px;
  vertical-align: top;
}

td.top {
  border-bottom: solid 1px black;
}

td.left {
  width: 200px;
  border-right: solid 1px black;
}

td.right {
  width: 200px;
  border-left: solid 1px black;
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
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 9px; 
}

.highlight {
  color: red;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
}

.light {
  color: #6a6a6a;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
}


.copyright {
  border: solid 0px black;
  background-color: #ffffff;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 9px; 
}

.title {
  border: solid 1px black;
  background-color: #ffffff;
  font-weight: bold;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 12px; 
  padding: 1px;
  margin: 1px;
}


.myButton2 {
        -moz-box-shadow: 1px 2px 0px 0px #899599;
        -webkit-box-shadow: 1px 2px 0px 0px #899599;
        box-shadow: 1px 2px 0px 0px #899599;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #bab1ba));
        background:-moz-linear-gradient(top, #ededed 5%, #bab1ba 100%);
        background:-webkit-linear-gradient(top, #ededed 5%, #bab1ba 100%);
        background:-o-linear-gradient(top, #ededed 5%, #bab1ba 100%);
        background:-ms-linear-gradient(top, #ededed 5%, #bab1ba 100%);
        background:linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#bab1ba',GradientType=0);
        background-color:#ededed;
        -moz-border-radius:7px;
        -webkit-border-radius:7px;
        border-radius:7px;
        border:1px solid #d6bcd6;
        display:inline-block;
        cursor:pointer;
        color:#000000;
        font-family:Verdana;
        font-size:10px;
        padding:2px 12px;
        text-decoration:none;
        text-shadow:0px 1px 0px #e1e2ed;
}
.myButton2:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bab1ba), color-stop(1, #ededed));
        background:-moz-linear-gradient(top, #bab1ba 5%, #ededed 100%);
        background:-webkit-linear-gradient(top, #bab1ba 5%, #ededed 100%);
        background:-o-linear-gradient(top, #bab1ba 5%, #ededed 100%);
        background:-ms-linear-gradient(top, #bab1ba 5%, #ededed 100%);
        background:linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bab1ba', endColorstr='#ededed',GradientType=0);
        background-color:#bab1ba;
}
.myButton2:active {
        position:relative;
        top:1px;
}


 #map {
	width: 501px;
	height: 501px;
	background-image: url(images/map.gif);
} 

        .TFtable{
                width:94%; 
                border-collapse:collapse; 
        }
        .TFtable td{ 
                padding:7px; border:#000000 1px solid;
        }
        /* provide some minimal visual accomodation for IE8 and below */
        .TFtable tr{
                background: #C0C0C0;
        }
        /*  Define the background color for all the ODD background rows  */
        .TFtable tr:nth-child(odd){ 
                background: #EBEBEB;
        }
        /*  Define the background color for all the EVEN background rows  */
        .TFtable tr:nth-child(even){
                background: #DEDEDE;
        }
        

.tooltip {
  border-bottom: 1px dotted #000000;
  color: #000000; outline: none;
  cursor: help; text-decoration: none;
  position: relative;
}
.tooltip span {
  margin-left: -999em;
  position: absolute;
}
.tooltip:hover span {
  font-family: Calibri, Tahoma, Geneva, sans-serif;
  position: absolute;
  left: 1em;
  top: 2em;
  z-index: -100;
  margin-left: 0;
  width: 10px;
  /* height: 152px; */
  border-radius: 5px 5px
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 5px 5px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 5px 5px rgba(0, 0, 0, 0.1);
}
.tooltip:hover img {
  border: 0;
  margin: -60px 0 0 -35px;
  float: right;
  position: absolute;
}
.tooltip:hover em {
  font-family: Candara, Tahoma, Geneva, sans-serif;
  font-size: 1.2em;
  font-weight: bold;
  display: block;
  padding: 0.2em 0 0.6em 0;
}



.critical { background: #FFCCAA; border: 2px solid #FF3334; }
.help { background: #9FDAEE; border: 2px solid #2BB0D7; }
.info { background: #9FDAEE; border: 2px solid #2BB0D7; }
.warning { background: #FFFFAA; border: 2px solid #FFAD33; }

/* .classic { background-image: url(images/items/paper300x152.png); }  */
.classic { padding: 0.8em 1em; }
.custom { padding: 0.5em 0.8em 0.8em 2em; }
* html a:hover { background: transparent; }

/*]]>*/
</style>
<style type="text/css">
/*<![CDATA[*/
 div.c2 {text-align: left; padding: 3px;}
 td.c1 {text-align:right; vertical-align:middle;}
 div.c3 {text-align:center; vertical-align:middle;}
/*]]>*/
</style>

<script type="text/javascript">
//<![CDATA[


function openmappopup(){
var popurl="index.php?do=showmap"
winpops=window.open(popurl,"","width=520,height=520,scrollbars")
}

function openwiki(monster){
var popurl="index.php?do=showmonster&id=" + monster
winpops=window.open(popurl,"","width=320,height=100,scrollbars")
}

function openrespopup(){
var popurl="index.php?do=resources"
winpops=window.open(popurl,"","width=220,height=440,noscrollbars")
}

function opencharpopup(){
var popurl="index.php?do=showchar"
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
}

function openmappopup(){
var popurl="index.php?do=showmap"
winpops=window.open(popurl,"","width=520,height=520,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no")
}

function openquestlogpopup(){
var popurl="index.php?do=questlog"
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
}

function openchatpopup(){
var popurl="index.php?do=babblebox"
winpops=window.open(popurl,"","width=300,height=400,scrollbars")
}

//]]>
</script>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
<table width="100%" border="1" cellpadding="2" cellspacing="2">
<tr valign="top">
<td width="100%"><center><h3 class='title'>Welcome {{charname}} your Stats as of {{onlinetime}}</h3></center></td>
</tr>
</table></h3>
 
<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title">Character</td>
<td width="33%" class="title">Profile</td>
<td width="33%" class="title">Gold & Banking</td>
</tr>
<tr valign="top">

<td width="33%" align="left">
Name: <span style="color: #0080FF;">{{charname}}</span><br />
Last Seen: <span style="color: #0080FF;">{{lastseen}}</span><br />
Ranking:  <span style="color: #0080FF;">{{id}}</span><br />
Level: <span style="color: #0080FF;">{{level}}</span><br />
Character Class: <span style="color: #0080FF;">{{charclass}}</span><br />
Difficulty Level: <span style="color: #0080FF;">{{difficulty}}</span><br />
Social Status: <span style="color: #0080FF;">{{status}}</span><br />
Profession: <span style="color: #0080FF;">{{status1}}</span><br />
Alignment: <span style="color: #0080FF;">{{charalign}}</span><br /><br />
</td>


<td width="33%" align="left">
<br />
Character Name: <b><span style="color: #0080FF;">{{charname}}</span><br />
User Name: <span style="color: #0080FF;">{{username}}</span></b><br /><br /><br /><br /><br /><br />
<div align="center"><a href="index.php" class="myButton2">Town Square</a></div><br />
</td>

<td width="33%" align="left">
Gold in Bank: <span style="color: #0080FF;">{{bank}}</span><br />
Gold on Hand: <span style="color: #0080FF;">{{gold}}</span><br />
Gold Bonus: <span style="color: #0080FF;">{{goldbonus}}</span><br /><br />

Silver in Bank: <span style="color: #0080FF;">{{silverbank}}</span><br />
Silver on Hand: <span style="color: #0080FF;">{{silver}}</span><br />
Silver Bonus: <span style="color: #0080FF;">{{silverbonus}}</span><br /><br />

Copper in Bank: <span style="color: #0080FF;">{{copperbank}}</span><br />
Copper on Hand: <span style="color: #0080FF;">{{copper}}</span><br />
Copper Bonus: <span style="color: #0080FF;">{{copperbonus}}</span><br /><br />
</td>

</tr>
</table>
</div>

<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">User Avatar</td>
<td width="33%" class="title" align="center">Character Stats</td>
<td width="33%" class="title" align="center">Portions</td>
</tr>

<tr valign="top">
<td width="33%" align="center"><br /><center><img src="{{avatarid}}" height="150" width="150" /></center></td>

<td width="33%" align="left"><table border="1" width="100%">
<tr>
<td width="80%" nowrap>
Character Class: <span style="color: #0080FF;">{{charclass}}</span><br /> 
Social Status: <span style="color: #0080FF;">{{status}}</span><br />
Profession: <span style="color: #0080FF;">{{status1}}</span><br />
Alignment: <span style="color: #0080FF;">{{charalign}}</span><br />
Difficulty Level: <span style="color: #0080FF;">{{difficulty}}</span><br />
Current Level: <span style="color: #0080FF;">{{level}}</span><br />
Honor: <span style="color: #0080FF;">{{honor}}</span><br />
Tactical: <span style="color: #0080FF;">{{tactical}}</span><br />
</td>
</tr><tr>
<td colspan="2" width="100%" nowrap>Register Date: <span style="color: #0080FF;">{{regdate}}</span><br />
Last Online: <span style="color: #0080FF;">{{onlinetime}}</span><br />
</td>
</tr></table></td>

<td width="33%" align="left">HP Potions: <span style="color: #0080FF;">{{hp_potion}}</span><br />
MP Potions: <span style="color: #0080FF;">{{mp_potion}}</span><br />
TP Potions: <span style="color: #0080FF;">{{tp_potion}}</span><br />
Orbs: <span style="color: #0080FF;">{{orbs}}</span><br /><br />
<a href='index.php?do=inn'>Hit Points</a>: {{currenthp}} / <span style="color: #0080FF;">{{maxhp}}</span><br />
<a href='index.php?do=buypotions'>Magic Points</a>: {{currentmp}} / <span style="color: #0080FF;">{{maxmp}}</span><br />
<a href='index.php?do=maps'>Travel Points</a>: {{currenttp}} / <span style="color: #0080FF;">{{maxtp}}</span><br /><br />
</td>
</tr>
</table>
</div>


<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title">Skills & Abilities</td>
<td width="33%" class="title">Experience Facts</td>
<td width="33%" class="title">Fight & Kills</td>
</tr>

<tr valign="top">
<td width="33%" align="left">
Skill Points: {{skills}}<br />
Strength: {{strength}}<br />
Dexterity: {{dexterity}}<br />
Attack Power: {{attackpower}}<br />
Defense Power: {{defensepower}}
</td>
<td width="33%" align="left">
Current Level: <span style="color: #0080FF;">{{level}}</span> <br />
Exp. Pts Now: <span style="color: #0080FF;">{{experience}}</span><br />
<!-- Exp. Pts Needed: <span style="color: #0080FF;">{{expneed}}</span><br /> -->
Exp. Total to Gain Next Lvl: <span style="color: #0080FF;">{{nextlevel}}</span><br />
Exp. Bonus: <span style="color: #0080FF;">{{expbonus}}</span><font color="#FF0000">*</font><br />
<font color="#FF0000">*</font><spanclass="copyright">Gained thru Weapons & Events</span><br /><br />
</td>
<td width="33%" align="left">
Career Kills: <span style="color: #0080FF;">{{numkills}}</span><br /> 
Career Deaths: <span style="color: #0080FF;">{{numdeaths}}</span><br /> 
Monster Fights: <span style="color: #0080FF;">{{fights}}</span><br /> 
Total Fights: <span style="color: #0080FF;">{{totalfights}}</span><br /> 
Monster Kills: <span style="color: #0080FF;">{{kills}}</span><br /> 
Player Deaths: <span style="color: #0080FF;">{{deaths}}</span>
</td>
</tr>
</table>
</div>

<center>
<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title">Profession</td>
<td width="33%" class="title">Inventory: Attack</td>
<td width="33%" class="title">Inventory: Defense</td>
</tr>

<tr valign="top">
<td width="33%" align="left">

<br />
Wood Cutter<br />
Wood: <span style="color: #0080FF;">{{wood}}</span></b>&nbsp;&nbsp;<br /><img src="images/items/misc/Wood.png" /><br /><br />
Fisherman<br />
Fish: <span style="color: #0080FF;">{{fish}}</span></b>&nbsp;&nbsp;<br /><img src="images/items/misc/Fish.png" /><br /><br />
</td>
<td width="33%" align="left">


<table border="1" width="100%" align="left">
<tr>
<td><img src="imag/{{weaponname}}.png" alt="Weapon" title="Weapon" /></td></tr><tr>
<td width="100%">Weapon: {{weaponname}}</td></tr><tr>
<td><img src="imag/{{rangeweaponsname}}.png" alt="Range & Throwing" title="Range & Throwing" /></td></tr><tr>
<td width="100%">Range Weapons: {{rangeweaponsname}}</td></tr><tr>
<td><img src="imag/{{gauntletname}}.png" alt="Gauntlet" title="Guantlets" /></td></tr><tr>
<td width="100%">Gauntlet: {{gauntletname}}</td></tr><tr>
<td><img src="imag/{{petname}}.png" alt="Pet" title="Pet" /></td></tr><tr>
<td width="100%">Pet: {{petname}}</td></tr><tr>
</table><br />


</td>
<td width="33%" align="left">


<table border="1" width="100%" align="left">
<tr>
<td><img src="imag/{{armorname}}.png" alt="Armor" title="Armor" /></td></tr><tr>
<td width="100%">Armor: {{armorname}}</td></tr><tr>
<td><img src="imag/{{shieldname}}.png" alt="Shield" title="Shield" /></td></tr><tr>
<td width="100%">Shield: {{shieldname}}</td></tr><tr>
<td><img src="imag/{{helmetname}}.png" alt="Helmet" title="Helmet" /></td></tr><tr>
<td width="100%">Helmet: {{helmetname}}</td></tr><tr>
<td><img src="imag/{{bootname}}.png" alt="Boot" title="Boot" /></td></tr><tr>
<td width="100%">Boot: {{bootname}}</td></tr>
<td><img src="imag/{{magicringsname}}.png" alt="Magic Rings" title="Magic Rings" /></td></tr><tr>
<td width="100%">Magic Rings: {{magicringsname}}</td></tr>
</table><br />

</td>
</tr>
</table>
</div>



<center>
<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title">Drop Inventory</td>
<td width="33%" class="title">Kingdom Status</td>
<td width="33%" class="title">Character Profile</td>
</tr>


<tr valign="top">
<td width="33%" align="left">

<center><table width="200" border="1" cellpadding="4" cellspacing="4">
  <tr>
  <td width="100" nowrap align="center"><img src="images/drops/{{slot1name}}.png" width="44" width="44" alt="{{slot1name}}" title="{{slot1name}}" /></td>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot2name}}.png" width="44" width="44" alt="{{slot2name}}" title="{{slot2name}}" /></td>
  </tr><tr>
     <td class="copyright" align="center">{{slot1name}}</td>
     <td class="copyright" align="center">{{slot2name}}</td>
  </tr><tr>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot3name}}.png" width="44" width="44" alt="{{slot3name}}" title="{{slot3name}}" /></td>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot4name}}.png" width="44" width="44" alt="{{slot4name}}" title="{{slot4name}}" /></td>
  </tr><tr>
     <td class="copyright" align="center">{{slot3name}}</td>
     <td class="copyright" align="center">{{slot4name}}</td>
  </tr><tr>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot5name}}.png" width="44" width="44" alt="{{slot5name}}" title="{{slot5name}}" /></td>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot6name}}.png" width="44" width="44" alt="{{slot6name}}" title="{{slot6name}}" /></td>
  </tr><tr>
     <td class="copyright" align="center">{{slot5name}}</td>
     <td class="copyright" align="center">{{slot6name}}</td>
  </tr>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot7name}}.png" width="44" width="44" alt="{{slot7name}}" title="{{slot7name}}" /></td>
     <td width="100" nowrap align="center"><img src="images/drops/{{slot8name}}.png" width="44" width="44" alt="{{slot8name}}" title="{{slot8name}}" /></td>
  </tr><tr>
     <td class="copyright" align="center">{{slot7name}}</td>
     <td class="copyright" align="center">{{slot8name}}</td>
  </tr>
</table></center><br>

</td>


<td width="33%" align="left">
Name of Your Kingdom: <span style="color: #0080FF;">{{landname}}</span><br /> 
Your Honor: <span style="color: #0080FF;">{{honor}}</span><br /> 
Tactical Score: <span style="color: #0080FF;">{{tactical}}</span><br /> 
Kingdom Treasury: <span style="color: #0080FF;">{{treasury}} Gold Coins</span><br />
Tax Action: <span style="color: #0080FF;">{{taxaction}}</span><br /><br /><br /> 

Land Owned: <span style="color: #0080FF;">{{land}} Acres</span><br /> 
Land Won in Battle: <span style="color: #0080FF;">{{landwon}} Acres</span><br />
Land Lost in Battle: <span style="color: #0080FF;">{{lost}} Acres</span><br /><br />
 
Attack Action: <span style="color: #0080FF;">{{attackaction}}</span><br />
Offensive Army: <span style="color: #0080FF;">{{offarmy}} Troops</span><br /> 
Defense Army: <span style="color: #0080FF;">{{dffarmy}} Troops</span><br />
Attack Strength: <span style="color: #0080FF;">{{attstrength}} Troops</span><br />
Defense Strength: <span style="color: #0080FF;">{{dffstrength}} Troops</span><br /><br />

Battles Won: <span style="color: #0080FF;">{{batwins}}</span><br /> 
Battles Lost: <span style="color: #0080FF;">{{battloss}}</span><br /> 
Battle Totals: <span style="color: #0080FF;">{{battot}}</span><br />
Rival Troops Killed: <span style="color: #0080FF;">{{troopskilled}}</span><br /> 
Your Troops Lost: <span style="color: #0080FF;">{{troopslost}}</span><br /> 
Lost Troops: <span style="color: #0080FF;">{{lost}}</span><br /><br />

Exchanged: <span style="color: #0080FF;">{{exchanged}}</span><br /><br />
</td>

<td width="33%" align="left">
Real Name: {{realname}}<br /><br />
Email Address: {{publicemail}}<br /><br />
Msn Messenger: {{msn}}<br /><br />
Icq Uim: {{icq}}<br /><br />
Aim Screen Name: {{aim}}<br /><br />
Yahoo! Messenger ID: {{yahoo}}<br /><br />
Googletalk: {{googletlk}}<br /><br /><!-- 
Website 1: <a href="{{website1}}">{{website1}}</a><br /><br />
Website 2: <a href="{{website2}}">{{website2}}</a><br /><br /> -->
Hobbies: {{hobbies}}<br />
</td>

</tr>
</table>
</div>
<!-- 

<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">Max Attack Power</td>
<td width="33%" class="title" align="center">Max Dexterity</td>
<td width="33%" class="title" align="center">Max Strength</td>
</tr>

<tr valign="top">
<td width="33%" align="left">
Max Attack Power: <span style="color: #0080FF;">{{maxattackpower}}</span><br />
Max Strength: <span style="color: #0080FF;">{{maxstrength}}</span><br>
Max Brawn: <span style="color: #0080FF;">{{maxbrawn}}</span><br>
Max Combat: <span style="color: #0080FF;">{{maxcombat}}</span><br>
Max Survival: <span style="color: #0080FF;">{{maxsurvival}}</span><br>
Max Toughness: <span style="color: #0080FF;">{{maxtoughness}}</span><br></td>

<td width="33%" align="left">
Max Dexterity: <span style="color: #0080FF;">{{maxdexterity}}</span><br>
Max Agility: <span style="color: #0080FF;">{{maxagility}}</span><br>
Max Awareness: <span style="color: #0080FF;">{{maxawareness}}</span><br>
Max Charisma: <span style="color: #0080FF;">{{maxcharisma}}</span><br>
Max Coordination: <span style="color: #0080FF;">{{maxcoordination}}</span><br>
Max Diplomacy: <span style="color: #0080FF;">{{maxdiplomacy}}</span><br>
Max Perception: <span style="color: #0080FF;">{{maxperception}}</span><br>
</td>

<td width="33%" align="left">
Max Strength: <span style="color: #0080FF;">{{maxstrength}}</span><br>
Max Enchantment: <span style="color: #0080FF;">{{maxenchantment}}</span><br>
Max energy: <span style="color: #0080FF;">{{maxenergy}}</span><br>
Max Heroism: <span style="color: #0080FF;">{{maxheroism}}</span><br>
Max Intimidate: <span style="color: #0080FF;">{{maxintimidate}}</span><br>
Max Stealth: <span style="color: #0080FF;">{{maxstealth}}</span><br>
Max Willpower: <span style="color: #0080FF;">{{maxwillpower}}</span><br>
</td>
</tr>
</table>
</div>




<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">Max DefensePower</td>
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
</tr>

<tr valign="top">
<td width="33%" align="left">
Max Defensepower: <span style="color: #0080FF;">{{maxdefensepower}}</span><br />
Max Dexterity: <span style="color: #0080FF;">{{maxdexterity}}</span><br>
Max Constitution: <span style="color: #0080FF;">{{maxconstitution}}</span><br>
Max Intelligence: <span style="color: #0080FF;">{{maxintelligence}}</span><br>
Max Knowledge: <span style="color: #0080FF;">{{maxknowledge}}</span><br>
Max Wisdom: <span style="color: #0080FF;">{{maxwisdom}}</span><br></td>
<td width="33%" align="left">&nbsp;</td>
<td width="33%" align="left">&nbsp;</td>
</tr>
</table>
</div>


<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
</tr>

<tr valign="top">
<td width="33%" align="left">&nbsp;</td>
<td width="33%" align="left">&nbsp;</td>
<td width="33%" align="left">&nbsp;</td>
</tr>
</table>
</div> -->


<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">User Potions</td>
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
</tr>

<tr valign="top">
<td><a title="$userrow[hp_potion] HP Potion(s)" href="index.php?do=potion:1">HP</a>&nbsp;&nbsp;
<a title="$userrow[mp_potion] MP Potion(s)" href="index.php?do=potion:2">MP</a>&nbsp;&nbsp;
<a title="$userrow[tp_potion] TP Potion(s)" href="index.php?do=potion:3">TP</a><br /></td>
<td width="33" align="left">&nbsp;</td>
<td width="33%" align="left">&nbsp;</td>
</tr>
</table>


<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
</tr>

<tr valign="top">
<td width="33%" align="left">&nbsp;</td>
<td width="33%" align="left">&nbsp;</td>
<td width="33%" align="left">&nbsp;</td>
</tr>
</table>
</div></center>


<br />
<br />
</html>
THEVERYENDOFYOU;
?>