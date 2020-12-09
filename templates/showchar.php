<?php
$template = <<<THEVERYENDOFYOU
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
  font-weight:normal;
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

<table width="100%">
<tr><td><center><h3 class='title'>Character</h3></center></td></tr><tr><td><br />

Name: <span style="color: #168F09;">{{charname}}</span><br /><br />
<center><img src="{{avatarid}}" height="100" width="100" /></center><br />
Ranking:  <span style="color: #168F09;">{{id}}</span><br />
Level: <span style="color: #168F09;">{{level}}</span><br />
Character Class: <span style="color: #168F09;">{{charclass}}</span><br />
Difficulty Level: <span style="color: #168F09;">{{difficulty}}</span><br />
Social Status: <span style="color: #168F09;">{{status}}</span><br />
Profession: <span style="color: #168F09;">{{status1}}</span><br />
Alignment: <span style="color: #168F09;">{{charalign}}</span><br /><br />
</td></tr></table>

<table width="100%"><tr><td>
<center><h3 class='title'>Monies</h3></center></td></tr><tr><td><br />
Bank: <span style="color: #168F09;">{{bank}}</span><br />
Gold: <span style="color: #168F09;">{{gold}}</span><br />
<!-- Orbs: <span style="color: #168F09;">{{orbs}}</span><br /> -->
Gold Bonus: <span style="color: #168F09;">{{goldbonus}}</span>
</td></tr></table><br />

<table width="100%"><tr><td>
<center><h3 class='title'>Character Stats</h3></center></td></tr><tr><td><br />
Hit Points: {{currenthp}} / <span style="color: #4E63A2;">{{maxhp}}</span><br />
Magic Points: {{currentmp}} / <span style="color: #4E63A2;">{{maxmp}}</span><br />
Travel Points: {{currenttp}} / <span style="color: #4E63A2;">{{maxtp}}</span><br />
Skill Points: {{skills}}<br />
Strength: {{strength}}<br />
Dexterity: {{dexterity}}<br />
Attack Power: {{attackpower}}<br />
Defense Power: {{defensepower}}
</td></tr></table><br />

<table width="100%"><tr><td>
<center><h3 class='title'>Experience Stats</h3></center></td></tr><tr><td><br />
Experience: <span style="color: #168F09;">{{experience}}</span><br />
Experience Pts for Next<br />
Level: <span style="color: #168F09;">{{nextlevel}}</span><br />
Experience Bonus: <span style="color: #168F09;">{{expbonus}}</span><br />
Exp Pts needed for next<br />Level: <span style="color: #168F09;">{{expneed}}</span><br /> 
Current Level: <span style="color: #168F09;">{{level}}</span><br />
Exp Plus: <span style="color: #168F09;">{{plusexp}}</span>
</td></tr></table><br />

<table width="100%"><tr><td>
<center><h3 class='title'>Fights</h3></center></td></tr><tr><td><br />
Career Kills: <span style="color: #8607A2;">{{numkills}}</span><br /> 
Career Deaths: <span style="color: #8607A2;">{{numdeaths}}</span><br /> 
Monster Fights: <span style="color: #8607A2;">{{fights}}</span><br /> 
Total Fights: <span style="color: #8607A2;">{{totalfights}}</span><br /> 
Monster Kills: <span style="color: #8607A2;">{{kills}}</span><br /> 
Player Deaths: <span style="color: #8607A2;">{{deaths}}</span>
</td></tr></table><br />

<table width="100%"><tr><td><center><h3 class='title'>Spells</h3></center></td></tr>
<tr><td><br />
{{magiclist}}
</td></tr></table><br />


<table width="100%">
<tr><td><center><h3 class='title'>Equipment</h3></center></td></tr><tr><td><br />
<table border="1" width="100%" align="left">
<tr>
<td><img src="imag/{{weaponname}}.png" alt="Weapon" title="Weapon" /></td></tr><tr>
<td width="100%">Weapon: {{weaponname}}</td></tr><tr>
<td><img src="imag/{{rangeweaponsname}}.png" alt="Range & Throwing" title="Range & Throwing" /></td></tr><tr>
<td width="100%">Range Weapons: {{rangeweaponsname}}</td></tr><tr>
<td><img src="imag/{{armorname}}.png" alt="Armor" title="Armor" /></td></tr><tr>
<td width="100%">Armor: {{armorname}}</td></tr><tr>
<td><img src="imag/{{shieldname}}.png" alt="Shield" title="Shield" /></td></tr><tr>
<td width="100%">Shield: {{shieldname}}</td></tr><tr>
<td><img src="imag/{{petname}}.png" alt="Pet" title="Pet" /></td></tr><tr>
<td width="100%">Pet: {{petname}}</td></tr><tr>
<td><img src="imag/{{helmetname}}.png" alt="Helmet" title="Helmet" /></td></tr><tr>
<td width="100%">Helmet: {{helmetname}}</td></tr><tr>
<td><img src="imag/{{gauntletname}}.png" alt="Gauntlet" title="Gauntlet" /></td></tr><tr>
<td width="100%">Gauntlet: {{gauntletname}}</td></tr><tr>
<td><img src="imag/{{bootname}}.png" alt="Boot" title="Boot" /></td></tr><tr>
<td width="100%">Boot: {{bootname}}</td></tr>
<td><img src="imag/{{magicringsname}}.png" alt="Magic Rings" title="Magic Rings" /></td></tr><tr>
<td width="100%">Magic Rings: {{magicringsname}}</td></tr>
</table></td></tr>
</table><br />


<table width="100%">
<tr><td><center><h3 class='title'>Inventory</h3></center></td></tr><tr><td><br />
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
</table></center><br><br><br><br>


</td></tr>
</table><br />
</html>
THEVERYENDOFYOU;
?>