<?php
$template = <<<THEVERYENDOFYOU
<table width="100%">
<tr><td><center><h3 class='title'>Character</h3></center></td></tr><tr><td>
<CENTER><b>{{charname}}</b><br />
<img src="{{avatarid}}" height="100" width="100" /><br />
Class: {{charclass}}<br />  
Social Status: {{status}}<br />
Difficulty Level: {{difficulty}}<br />
Level: <span style="color: #168F09;">{{level}}</span><br />
</td></tr></table><CENTER><br />

<table width="100%"><tr><td>
<center><h3 class='title'>Monies</h3></center></td></tr><tr><td>
Bank: <span style="color: #808070;">{{bank}}</span><br />
Gold: <span style="color: #808070;">{{gold}}</span><br />
Gold Bonus: <span style="color: #808070;">{{goldbonus}}</span>
</td></tr></table><br />

<table width="100%"><tr><td>
<center><h3 class='title'>Character Stats</h3></center></td></tr><tr><td>
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
<center><h3 class='title'>Experience Stats</h3></center></td></tr><tr><td>
Experience: <span style="color: #168F09;">{{experience}}</span><br />
Experience Pts for Next<br />
Level: <span style="color: #168F09;">{{nextlevel}}</span><br />
Experience Bonus: <span style="color: #168F09;">{{expbonus}}</span><br />
Exp Pts needed for next<br />Level: <span style="color: #168F09;">{{expneed}}</span><br /> 
Current Level: <span style="color: #168F09;">{{level}}</span>
</td></tr></table><br />

<table width="100%"><tr><td>
<center><h3 class='title'>Fights</h3></center></td></tr><tr><td>
Monster Fights: <span style="color: #8607A2;">{{fights}}</span><br /> 
Total Fights: <span style="color: #8607A2;">{{totalfights}}</span><br /> 
Monster Kills: <span style="color: #8607A2;">{{kills}}</span><br /> 
Player Deaths: <span style="color: #8607A2;">{{deaths}}</span>
</td></tr></table><br />

<table width="100%"><tr><td><center><h3 class='title'>Spells</h3></center></td></tr>
<tr><td>
{{magiclist}}
</td></tr></table><br />


<table width="100%">
<tr><td><center><h3 class='title'>Inventory</h3></center></td></tr><tr><td>
<table width="100%">
<tr><td><img src="imag/{{weaponname}}.png" alt="Weapon" title="Weapon" /></td>
<td width="100%">Weapon: {{weaponname}}</td></tr>
<tr><td><img src="imag/{{armorname}}.png" alt="Armor" title="Armor" /></td>
<td width="100%">Armor: {{armorname}}</td></tr>
<tr><td><img src="imag/{{shieldname}}.png" alt="Shield" title="Shield" /></td>
<td width="100%">Shield: {{shieldname}}</td></tr>
<tr><td><img src="imag/{{petname}}.png" alt="Pet" title="Pet" /></td>
<td width="100%">Weapon: {{petname}}</td></tr>
<tr><td><img src="imag/{{helmetname}}.png" alt="Helmet" title="Helmet" /></td>
<td width="100%">Helmet: {{helmetname}}</td></tr>
<tr><td><img src="imag/{{gauntletname}}.png" alt="Gauntlet" title="Gauntlet" /></td>
<td width="100%">Gauntlet: {{gauntletname}}</td></tr>
<tr><td><img src="imag/{{bootname}}.png" alt="Boot" title="Boot" /></td>
<td width="100%">Boot: {{bootname}}</td></tr>
</table><br />

<table width="100%">
<tr><td><center><h3 class='title'>Backpack Slots</h3></center></td></tr>

<table width="100%">
<tr><td>
<img src="images/drops/{{slot1name}}.png" height="24" width="24"> - {{slot1name}}<br />
<img src="images/drops/{{slot2name}}.png" height="24" width="24"> - {{slot2name}}<br />
<img src="images/drops/{{slot3name}}.png" height="24" width="24"> - {{slot3name}}<br />
<img src="images/drops/{{slot4name}}.png" height="24" width="24"> - {{slot4name}}<br />
<img src="images/drops/{{slot5name}}.png" height="24" width="24"> - {{slot5name}}<br />
<img src="images/drops/{{slot6name}}.png" height="24" width="24"> - {{slot6name}}<br />
<img src="images/drops/{{slot7name}}.png" height="24" width="24"> - {{slot7name}}<br />
<img src="images/drops/{{slot8name}}.png" height="24" width="24"> - {{slot8name}}<br /><br />
</td></tr>
</table><br />
</td></tr>
</table><br />
THEVERYENDOFYOU;
?>