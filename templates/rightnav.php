<?php
$template = <<<THEVERYENDOFYOU
<table><tr><td>

<a name="top"></a>
<center><h3 class='title'>Character</h3></center>

<span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;">
<table border="1" cellpadding="4" cellspacing="2" width="100%">
<tr><td>
<span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;">Name: <span style="color: #0080FF;">{{charname}}</span>&nbsp;&nbsp;ID: <span style="color: #0080FF;">{{id}}</span><br />
<!-- Last Seen: <span style="color: #0080FF;">{{lastseen}}</span><br /> -->
Char. Class: <span style="color: #0080FF;">{{charclass}}</span>&nbsp;&nbsp;Level: <span style="color: #0080FF;">{{level}}</span><br />
Diff. Level: <span style="color: #0080FF;">{{difficulty}}</span>&nbsp;&nbsp;Honor: <span style="color: #0080FF;">{{honor}}</span><br />
Social: <span style="color: #0080FF;">{{status}}</span>&nbsp;&nbsp;<br />
Profession: <span style="color: #0080FF;">{{status1}}</span>&nbsp;&nbsp;Tactical: <span style="color: #0080FF;">{{tactical}}</span><br />
Align: <span style="color: #0080FF;">{{charalign}}
</td></tr>
</table></span>

<center><table border="0" align="center" width="100%">
<tr><td align="center" valign="top" title="{{charname}}">{{classimg}}</td>
</tr></table></center>

<center><h3 class='title'>Character Status</h3></center>
<table border="1" cellpadding="4" cellspacing="2" width="100%">
<tr><td>
<span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=inn'>Hit Points</a>: {{currenthp}} / <span style="color: #0080FF;">{{maxhp}}</span><br />
<a href='index.php?do=buypotions'>Magic Points</a>: {{currentmp}} / <span style="color: #0080FF;">{{maxmp}}</span><br />
<a href='index.php?do=maps'>Travel Points</a>: {{currenttp}} / <span style="color: #0080FF;">{{maxtp}}</span><br />
</td></tr>
</table>

<center>{{statbars}}</center>
<br />



<center><h3 class='title'>Gold</h3></center>
<div align="left">
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align: left;"><a href='index.php?do=bankgsc'>Gold on Hand:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{gold}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Gold Bank:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{bank}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Total Gold:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{allmoney}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Gold Bonus:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{goldbonus}}<font color="#FF0000">*</font></span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=treasury'>Kingdom Treasury:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{treasury}}</span></td>
</tr>
</table></div>

<center><h3 class='title'>Silver</h3></center>
<div align="left">
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Silver on Hand:</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{silver}}</span></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Silver Bank:</a></span></td>
<td>&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{silverbank}}</span></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Total Silver:</a></span></td>
<td>&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{allsilvermoney}}</span></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Silver Bonus:</a></span></td>
<td>&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{silverbonus}}</span></td>
</tr>
</table></div>

<center><h3 class='title'>Copper</h3></center>
<div align="left">
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Copper on Hand:</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{copper}}</span></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Copper Bank:</a></span></td>
<td>&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{copperbank}}</span></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Total Copper:</a></span></td>
<td>&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{allcoppermoney}}</span></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=bankgsc'>Copper Bonus:</a></span></td>
<td>&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{copperbonus}}</span></td>
</tr>
</table></div>


<center><h3 class='title'>Major Abilities</h3></center>
<div align="left">
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=skills'>Attack Power:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{attackpower}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=skills'>Defense Power:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{defensepower}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=skills'>Dexterity:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{dexterity}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=skills'>Strength:</a></span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:right;">{{strength}}</span></td>
</tr>
<tr>
<td colspan="2">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href='index.php?do=skills'>Skill Points:</a></span></td>
</tr>
<tr>
<td colspan="2">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt; text-align:center;">{{skills}}</span></td>
</tr>
</table></div>



<!-- <div align="center">{{goldimg}}</div> -->

<center><h3 class='title'>Equipment</h3></center>
<br>


<table border="1" cellpadding="4" cellspacing="2" width="100%">
<tr>
<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=buy'>Weapon:</a><br> {{weaponname}}</span></td></tr><tr>
<td><img src="imag/{{weaponname}}.png" alt="{{weaponname}}" title="{{weaponname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=wea1'>Range Weapons:</a><br> {{rangeweaponsname}}</span></td></tr><tr>
<td><img src="imag/{{rangeweaponsname}}.png" alt="{{rangeweaponsname}}" title="{{rangeweaponsname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=ghmk'>Gauntlet:</a><br> {{gauntletname}}</span></td></tr><tr>
<td><img src="imag/{{gauntletname}}.png" alt="{{gauntletname}}" title="{{gauntletname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=pxcu'>Pet:</a><br>{{petname}}</span></td></tr><tr>
<td><img src="imag/{{petname}}.png" alt="{{petname}}" title="{{petname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=amro'>Armor:</a><br>{{armorname}}</span></td></tr><tr>
<td><img src="imag/{{armorname}}.png" alt="{{armorname}}" title="{{armorname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=loja'>Shield:</a><br>{{shieldname}}</span></td></tr><tr>
<td><img src="imag/{{shieldname}}.png" alt="{{shieldname}}" title="{{shieldname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=hzrt'>Helmet:</a><br>{{helmetname}}</span></td></tr><tr>
<td><img src="imag/{{helmetname}}.png" alt="{{helmetname}}" title="{{helmetname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=bmnn'>Boot:</a><br>{{bootname}}</span></td></tr>
<td><img src="imag/{{bootname}}.png" alt="{{bootname}}" title="{{bootname}}" /><br><br></td></tr><tr>

<td width="100%"><span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 8pt;"><a href='index.php?do=wea2'>Magic Rings:</a><br>{{magicringsname}}</span></td></tr>
<td><img src="imag/{{magicringsname}}.png" alt="{{magicringsname}}" title="{{magicringsname}}" /><br></td></tr><tr>
</table>
</span>
<br /><br />


<center><a href="#top" class="myButton2">Top of Page</a></center>
<br />

</td></tr>
</table>
</td></tr>
</table>
THEVERYENDOFYOU;
?>