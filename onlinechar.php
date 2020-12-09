<?php
$template = <<<THEVERYENDOFYOU


function onlinechar() { 

global $userrow;
    
    $townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
            $townrow = mysql_fetch_array($townquery);
	$title = "Character Status at ".$townrow["name"]."";


<table width="100%" border="1" cellpadding="2" cellspacing="2">
<tr valign="top">
<td width="100%"><center><h3 class='title'>Location: &nbsp;&nbsp; {{currentaction}} &nbsp;&nbsp; 
Latitude: &nbsp;&nbsp; {{latitude}} &nbsp;&nbsp; Longitude &nbsp;&nbsp; {{longitude}}</h3></center></td>
</tr>
</table></h3>
 
<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title">xxx Character</td>
<td width="33%" class="title">Profile</td>
<td width="33%" class="title">Gold & Banking</td>
</tr>
<tr valign="top">

<td width="33%" align="left">
<b>{{charname}}</b><br />
Class: {{charclass}}<br />  
Social Status: {{status}}<br />
Difficulty Level: {{difficulty}}<br />
Level: <span style="color: #168F09;">{{level}}</span>
</td>

<td width="33%" align="left">
Here is the character profile for<br />
<b>{{charname}}</b>.<br />
Currently: {{currentaction}}<br />
When you're finished, you can<br />
<a href="index.php">return to town</a>.<br />
</td>

<td width="33%" align="left">
Bank: <span style="color: #808070;">{{bank}}</span><br />
Gold: <span style="color: #808070;">{{gold}}</span><br />
Gold Bonus: <span style="color: #808070;">{{goldbonus}}</span><br />
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
<td width="80%" nowrap>Class: <span style="color: #4E63A2;">{{charclass}}</span><br /> 
Social Status: <span style="color: #4E63A2;">{{status}}</span><br />
Difficulty Level: <span style="color: #4E63A2;">{{difficulty}}</span><br />
Current Level: <span style="color: #4E63A2;">{{level}}</span><br />
Honor: <span style="color: #4E63A2;">{{honor}}</span>
</td>
</tr><tr>
<td colspan="2" width="100%" nowrap>Register Date: <span style="color: #4E63A2;">{{regdate}}</span><br />
Last Online: <span style="color: #4E63A2;">{{onlinetime}}</span><br />
Alignment: <span style="color: #4E63A2;">{{charalign}}</span>
</td>
</tr></table></td>

<td width="33%" align="left">HP Potions: <span style="color: #4E63A2;">{{hp_potion}}</span><br />
MP Potions: <span style="color: #4E63A2;">{{mp_potion}}</span><br />
TP Potions: <span style="color: #4E63A2;">{{tp_potion}}</span></td>
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
SP: {{skills}}<br />
Strength: {{strength}}<br />
Dexterity: {{dexterity}}<br />
Attack Power: {{attackpower}}<br />
Defense Power: {{defensepower}}
</td>
<td width="33%" align="left">
Experience: <span style="color: #168F09;">{{experience}}</span><br />
Game Experience Points Set for Next Level: <span style="color: #168F09;">{{nextlevel}}</span><br />
Experience Points You Need to Reach Next Level: <span style="color: #168F09;">{{expneed}}</span><br />
Experience Bonus: <span style="color: #168F09;">{{expbonus}}</span><br />
Current Level: <span style="color: #168F09;">{{level}}</span><br />
Experience Plus: <span style="color: #168F09;">{{plusexp}}</span><br />
</td>
<td width="33%" align="left">
Monster Fights: <span style="color: #168F09;">{{fights}}</span><br /> 
Total Fights: <span style="color: #168F09;">{{totalfights}}</span><br /> 
Monster Kills: <span style="color: #168F09;">{{kills}}</span><br /> 
Player Deaths: <span style="color: #168F09;">{{deaths}}</span>
</td>
</tr>
</table>
</div>

<center>
<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title">Character Status</td>
<td width="33%" class="title">Inventory: Attack</td>
<td width="33%" class="title">Inventory: Defense</td>
</tr>

<tr valign="top">
<td width="33%" align="left">
Hit Points: {{currenthp}} / <span style="color: #168F09;">{{maxhp}}</span><br />
Magic Points: {{currentmp}} / <span style="color: #168F09;">{{maxmp}}</span><br />
Travel Points: {{currenttp}} / <span style="color: #168F09;">{{maxtp}}</span><br />
<br>
<br>
<br>
<br>
<br>
<br>Honor: {{honor}} 

</td>
<td width="33%" align="left">


<table border="1" width="100%" align="left">
<tr>
<td><img src="imag/{{weaponname}}.png" alt="Weapon" title="Weapon" /></td></tr><tr>
<td width="100%">Weapon: {{weaponname}}</td></tr><tr>
<td><img src="imag/{{petname}}.png" alt="Pet" title="Pet" /></td></tr><tr>
<td width="100%">Pet: {{petname}}</td></tr><tr>
<td><img src="imag/{{gauntletname}}.png" alt="Gauntlet" title="Guantlets" /></td></tr><tr>
<td width="100%">Gauntlet: {{gauntletname}}</td></tr><tr>
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
<td width="33%" class="title">Drop Inventory</td>
<td width="33%" class="title">Character Profile</td>
</tr>


<tr valign="top">
<td width="33%" align="left">

<center><table width="174" border="1" cellpadding="4" cellspacing="0">
  <tr>
     <td width="87" nowrap class="copyright"><img src="images/drops/{{slot1name}}.png" height="66" width="87" alt="{{slot1name}}" title="{{slot1name}}" /></td>
     <td width="87" nowrap class="copyright"><img src="images/drops/{{slot2name}}.png" height="66" width="87" alt="{{slot2name}}" title="{{slot2name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot1name}}</td>
     <td class="copyright" align="center">{{slot2name}}</td>
  </tr>
  <tr>
     <td class="copyright"><img src="images/drops/{{slot3name}}.png" height="66" width="87" alt="{{slot3name}}" title="{{slot3name}}" /></td>
     <td class="copyright"><img src="images/drops/{{slot4name}}.png" height="66" width="87" alt="{{slot4name}}" title="{{slot4name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot3name}}</td>
     <td class="copyright" align="center">{{slot4name}}</td>
  </tr>
  <tr>
     <td class="copyright"><img src="images/drops/{{slot5name}}.png" height="66" width="87" alt="{{slot5name}}" title="{{slot5name}}" /></td>
     <td class="copyright"><img src="images/drops/{{slot6name}}.png" height="66" width="87" alt="{{slot6name}}" title="{{slot6name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot5name}}</td>
     <td class="copyright" align="center">{{slot6name}}</td>
  </tr>
  <tr>
     <td class="copyright"><img src="images/drops/{{slot7name}}.png" height="66" width="87" alt="{{slot7name}}" title="{{slot7name}}" /></td>
     <td class="copyright"><img src="images/drops/{{slot8name}}.png" height="66" width="87" alt="{{slot8name}}" title="{{slot8name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot7name}}</td>
     <td class="copyright" align="center">{{slot8name}}</td>
  </tr>
</table></center><br>

</td>


<td width="33%" align="left">&nbsp;&nbsp;&nbsp;</td>

<td width="33%" align="left">
<a href="index.php">Town</a><br />
Real Name: {{realname}}<br />
Email Address: {{publicemail}}<br />
Msn Messenger: {{msn}}<br />
Icq Uim: {{icq}}<br />
Aim Screen Name: {{aim}}<br />
Yahoo! Messenger ID: {{yahoo}}<br />
Googletalk: {{googletlk}}<br />
Website 1: <a href="{{website1}}">{{website1}}</a><br />
Website 2: <a href="{{website2}}">{{website2}}</a><br />
Hobbies: {{hobbies}}<br />
</td>

</tr>
</table>
</div>


<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">Gym Energy</td>
<td width="33%" class="title" align="center">Resources</td>
<td width="33%" class="title" align="center">&nbsp;&nbsp;</td>
</tr>

<tr valign="top">
<td width="33%" align="left">Gym Card Purchased: <span style="color: #168F09;">{{gympass}}</span><br />
Current Energy: <span style="color: #168F09;">{{currentenergy}}</span><br />
Max Energy: <span style="color: #168F09;">{{maxenergy}}</span><br /><br /></td>

<td width="33%" align="left">
<b>Wood: {{wood}}</b>&nbsp;&nbsp;<br /><img src="../dk3134/images/items/misc/Wood.png" /><br />
<b>Fish: {{fish}}</b>&nbsp;&nbsp;<br /><img src="../dk3134/images/items/misc/Fish.png" /><br /></td>

<td width="33%" align="left">&nbsp;&nbsp;
</td>
</tr>
</table>
</div>




<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">Kingdom Status</td>
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
</tr>
<tr valign="top">
<td width="33%" align="left">
<table width="100%">
<tr>
<td width="50%" nowrap><b>Honor: </b></td>
<td width="50%" nowrap><b><span style="color: #168F09;">{{honor}}</span></b></td>
</tr>
<tr>
<td><b>Offensive Troops:</b></td>
<td><b><span style="color: #168F09;">{{offarmy}}</span></b></td>
</tr>
<tr>
<td><b>Defensive Troops:</b></td>
<td><b><span style="color: #168F09;">{{dffarmy}}</span></b></td>
</tr>
<tr>
<td><b>Acres of Land:</b></td>
<td><b><span style="color: #168F09;">{{land}}</span></b></td>
</tr>
<tr>
<td><b>Tactical:</b></td>
<td><b><span style="color: #168F09;">{{tactical}}</span></b></td>
</tr>
<tr>
<td><b>Battle Win:</b></td>
<td><b><span style="color: #168F09;">{{batwins}}</span></b></td>
</tr>
<tr>
<td><b>Battle Loss:</b></td>
<td><b><span style="color: #168F09;">{{battloss}}</span></b></td>
</tr>
<tr>
<td><b>Battle Total:</b></td>
<td><b><span style="color: #168F09;">{{battot}}</span></b></td>
</tr>
<tr>
<td><b>Troops Killed:</b></td>
<td><b><span style="color: #168F09;">{{troopskilled}}</span></b></td>
</tr>
<tr>
<td><b>Troops Lost:</b></td>
<td><b><span style="color: #168F09;">{{troopslost}}</span></b></td>
</tr>
</table>
<td width="33%" align="left">&nbsp;&nbsp;
</td>
<td width="33%" align="left">&nbsp;</td>
</tr>
</table>
</div>


<div style=" text-align: center; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="95%" border="1" cellpadding="2" cellspacing="2" align="center">

<tr valign="top">
<td width="33%" class="title" align="center">Class Number Ref</td>
<td width="33%" class="title" align="center">&nbsp;</td>
<td width="33%" class="title" align="center">&nbsp;</td>
</tr>

<tr valign="top">
<td width="33%" align="left">
<center>
<table border=\"0\" width=\"100%\">
  <tr>
     <td align=\"left\" width=\"20%\">Class 1: Mage</td>
     <td align=\"left\" width=\"20%\">Class 2: Barbarian</td>
     <td align=\"left\" width=\"20%\">Class 3: Bard</td>
  </tr>
  <tr>
     <td align=\"left\" width=\"20%\">Class 4: Cleric</td>
     <td align=\"left\" width=\"20%\">Class 5: Ranger</td>
     <td align=\"left\" width=\"20%\">Class 6: Sorcerer</td>
  </tr>
  <tr>
     <td align=\"left\" width=\"20%\">Class 7: Warrior</td>
     <td align=\"left\" width=\"20%\">Class 8: Rogue</td>
     <td align=\"left\" width=\"20%\">Class 9: Druid</td>
  </tr>
  <tr>
     <td align=\"left\" width=\"20%\">&nbsp;&nbsp;&nbsp;</td>
     <td align=\"left\" width=\"20%\">Class 10: Paladin</td>
     <td align=\"left\" width=\"20%\">&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>

</center>
</td>
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
<td width="33%" align="left">When you're finished, <a href="index.php">Return to Town Square.</a>.<br /></td>
<td width="33%" align="left">&nbsp;</td>
</tr>
</table>
</div></center>


<br />
<br />
THEVERYENDOFYOU;
?>