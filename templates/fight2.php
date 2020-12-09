<?php
$template = <<<THEVERYENDOFYOU
<center><table width="98%"><tr><td><h3 class="title"><center>Fighting</center></h3></td></tr></table></center>

<center><br /><blockquote>
<table width="80%"><tr><td width="15%">
{{monsterimg}}
</td><td width="85%">
You are fighting a <a href="javascript:openwiki('.$dwood_monsterid.')">{{monstername}}</a> with {{monsterhp}}
<br />

$page .= "You have $userrow[gold] Gold Coins.<br />";
<br />{{name}} 
<br />{{exp}} experience. {{warnexp}} 
<br />You gain {{gold}} gold. {{warngold}}
<br />{{level}}
<br />{{attackpower}}
<br />{{defensepower}}
<br />{{currenthp}}
<br />{{currentmp}}
<br />{currenttp}}
<br />
The {{monstername}} taunts you with:&nbsp; $fighttalk[$ra]<br />
$persondamage<br />
You reply back to {{monstername}}:&nbsp; $backtalk[$rb]<br />
{{yourturn}}<br />
{{monsterturn}}
{{command}}
</td></tr></table>
</blockquote></center><br />
THEVERYENDOFYOU;
?>