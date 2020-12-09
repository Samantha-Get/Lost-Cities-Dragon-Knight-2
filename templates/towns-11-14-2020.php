<?php
$template = <<<THEVERYENDOFYOU

<script>
function openrespopup(){
var popurl="index.php?do=resources"
winpops=window.open(popurl,"","width=220,height=440,noscrollbars,resizable=no,toolbar=no,menubar=no,location=no,directories=no")
}

function openshowcharpopup(){
var popurl="index.php?do=showchar"
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
}

function openmappopup(){
var popurl="index.php?do=showmap"
winpops=window.open(popurl,"","width=520,height=520,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no")
}

function openrespopup(){
var popurl="index.php?do=resources"
winpops=window.open(popurl,"","width=250,height=360,noscrollbars")
}

function openwiki(monster){
var popurl="index.php?do=showmonster&id=" + monster
winpops=window.open(popurl,"","width=300,height=260,noscrollbars")
}

function openquestlogpopup(){
var popurl="index.php?do=questlog"
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
}

function openbabbleboxpopup(){
var popurl="index.php?do=babblebox"
winpops=window.open(popurl,"","width=400,height=600,scrollbars,resizable=no,toolbar=no,menubar=no,location=no,directories=no")
}

function opendrop_attributespopup(){
var popurl="drop_attributes.html"
winpops=window.open(popurl,"","width=400,height=600,scrollbars,resizable=no,toolbar=no,menubar=no,location=no,directories=no")
}
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(
	function()
	{
	$('#chat').load('index.php?do=babblebox&random='+(new Date()).getTime());
	var auto_refresh = setInterval(  function () {  $('#chat').load('index.php?do=babblebox&random='+(new Date()).getTime()).fadeIn("fast");  }, 1000);

	$('#submit').click(function(){
		var msg = document.getElementById('babble');
		$.post("index.php?do=babblebox",{babble: msg.value});
		msg.value = '';
	});

	$('#reset').click(function(){
		var msg = document.getElementById('babble');
		msg.value = '';
	});

	}
);

</script>


<table width="100%">
<tr><td><center><h2 class='title'>Welcome to {{name}}&nbsp;&nbsp;-&nbsp;&nbsp;Lat: {{latitude}}&nbsp;&nbsp;Long: {{longitude}}</h2></center></td></tr>
<tr><td>


<table width="100%">
<tr valign="top" style="top">
     <td align="left" valign="top" width="33%">
<ul>
Town Options: <!-- Comments  -->
<li /><a href='index.php?do=inn' title='{{innsname}}'>{{innsname}}</a>
<li /><a href='index.php?do=towninf' title='{{towninfname}}'>{{towninfname}}</a>
<li /><a href='index.php?do=getquests' title='{{questsname}}'>{{questsname}}</a>
<li /><a href='index.php?do=npclist' title='{{npclistname}}'>Question {{npclistname}}</a>

<br><br>Money:
<li /><a href='index.php?do=bank' title='Gold {{banksname}}'>Gold {{banksname}}</a>
<li /><a href='index.php?do=banksilver' title='Silver {{banksname}}'>Silver {{banksname}}</a>
<li /><a href='index.php?do=bankcopper' title='Copper {{banksname}}'>Copper {{banksname}}</a>
<li /><a href='index.php?do=robb' title='Robb Gold {{banksname}}'>Robb Gold {{banksname}}</a>

<br><br>{{warshopname}}
<br>{{warshopoffname}}:
<li /><a href='index.php?do=buy'>{{weaponshopname}}</a>
<li /><a href='index.php?do=wea1'>{{throwingshopname}}</a>
<li /><a href='index.php?do=ghmk'>{{gauntletname}}</a>
<li /><a href='index.php?do=pxcu'>{{petsname}}</a>
<br>{{warshopdefname}}:
<li /><a href='index.php?do=loja'>{{shieldsshopname}}</a>
<li /><a href='index.php?do=amro'>{{armorshopname}}</a>
<li /><a href='index.php?do=hzrt'>{{helmetname}}</a>
<li /><a href='index.php?do=bmnn'>{{bootshopname}}</a>
<li /><a href='index.php?do=wea2'>{{magicringshopname}}</a>

<br><br>Fighting & Prison:
<li /><a href='index.php?do=jail'>Prison</a><br>
<li /><a href='index.php?do=mainfight'>Challenge Arena</a>

<br><br>The Dead:
<li /><a href='index.php?do=viewgraveyard'>Visit Graveyard</a>
</ul>
</ul>
	 </td><td align="left" valign="top" width="33%">
	 
<ul>
Buy & Sell: <!-- Comments  -->
<li /><a href='index.php?do=maps'>{{buymapsname}} - Copper Coins</a>
<li /><a href='index.php?do=buypotions'>{{potionsname}}</a>
<li /><a href='index.php?do=sellitems'>{{sellitemsname}}</a>
<li /><a href='index.php?do=broker'>{{brokersname}}</a>

<br><br>Betting Houses:
<!-- <li /><a href='gamblingmenu.html'>Gambling Halls Menu</a> -->
<li /><a href='casino.php'>2 Player Games - Gold Coins</a>
<li /><a href='index.php?do=gamble'>3 Cups - Silver Coins</a>
<li /><a href='index.php?do=gamble5'>5 Cups - Silver Coins</a>
<li /><a href='index.php?do=loteri10'>Lotto 10 - Silver Coins</a>
<li /><a href='index.php?do=loteri'>Lotto 20 - Silver Coins</a>
<li /><a href='index.php?do=loteri50'>Lotto 50 - Gold Coins</a>
<li /><a href='index.php?do=loteri100'>Lotto 100 - Gold Coins</a>
<li /><a href='index.php?do=dicingbet4'>Dice 5 - Silver Coins</a>
<li /><a href='index.php?do=dicingbet3'>Dice 15 - Gold Coins</a>
<li /><a href='index.php?do=dicingbet'>Dice 30 - Gold Coins</a>
<li /><a href='index.php?do=dicingbet1'>Dice 50 - Gold Coins</a>
<li /><a href='index.php?do=dicingbet2'>Dice 100 - Gold Coins</a>

<br><br>Users Top Lists:
<li /><a href='index.php?do=viewmembers'>Memberlist</a>
<li /><a href='fame.php?do=main'>Character Fame</a>
<li /><a href='index.php?do=hof'>Hall of Fame</a>

<br><br>Training Grounds:
<li /><a href='index.php?do=atttrain' title='Gold Attibute Training'>Gold Attribute Training</a>
<li /><a href='index.php?do=dextrain' title='Silver Attibute Training'>Silver Attribute Training</a>
<li /><a href='index.php?do=deftrain' title='Copper Attibute Training'>Copper Attribute Training</a>
</ul>
 </td><td align="left" valign="top" width="33%">
	 

<ul>
News & Mail & Babble: <!-- Comments  -->
<li /><a href='mail.php' title='{{postofficename}}'>{{postofficename}}</a>
<li /><a href='forum.php'>{{forumsname}}</a>
<li /><a href='http://michaelmccart.com/dkbb/' target='_blank' title='Lost Cities Forum'>Lost Cities Forum</a>
<li /><a href='index.php?do=oldernews' title='{{newsname}}'>{{newsname}}</a>
<li /><a href="javascript:openbabbleboxpopup()">Babble Box</a>
<!-- <li /><a href='index.php?do=babblebox' class='popup4'>Babblebox</a>  -->

<br><br>Skills:
<li /><a href='index.php?do=skills'>Skill Points</a>
<li /><a href='index.php?do=exchange'>Buy Exp. Pts. - Silver Coins</a>

<br><br>Profession:
<li /><a href="index.php?do=un">University</a><br>
<li /><a href="index.php?do=ranger">Talk to Ranger</a><br>
<li /><a href="index.php?do=market">Market</a><br>
<li /><a href="javascript:openrespopup()">View Resources</a>

<br><br>Your Kingdom:
<br><div class="small"><font color="#C8003C">*</font> Requires Level 20</div>
<li /><a href='index.php?do=land'>Manage Your Land</a>
<!-- <li /><a href='index.php?do=clans'>Clans</a> -->

<br><br>Character Profile:
<li /><a href="index.php?do=editinfo">Edit Character Info</a>
<li /><a href="index.php?do=avatar">Edit Avatar</a>
<li /><a href="users.php?do=changepassword">Change Password</a>

<br><br>Help:
<li /><a href='index.php?do=npc2list' title='{{npc2listname}}'>Helpful {{npc2listname}}</a>
<li /><a href="index.php?do=contact" title="Contact Us">Contact Us</a>
</ul>

</ul>
</td></tr></table>

</td></tr>
<tr><td width="100%">
<center>
<table width="100%">
<tr valign="top">
<td width="50%"><font size="1">{{news}}</font></td>
<td width="50%"><font size="1">{{babblebox}}</font></td>
</tr>
<tr valign="top">
<td colspan="2" align="center" width="100%"><font size="1">{{whosonline}}</font><br>
<font size="1" color="#000000">Click a Character Name to view the stats for that character.</font></font></span></td>
</tr>
</table>
</div></center>
</td></tr>
</table>
THEVERYENDOFYOU;
?>