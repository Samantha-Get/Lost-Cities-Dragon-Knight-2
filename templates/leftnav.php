<?php
$template = <<<THEVERYENDOFYOU
<!-- <script type="text/javascript">

	//initialize the 3 popup css class names - create more if needed
	var matchClass=['popup1','popup2','popup3'];
	//Set your 3 basic sizes and other options for the class names above - create more if needed
	// Edit Avatar
	var popup1 = 'width=520,height=520,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=20,top=20';
	// ShowChar
	var popup2 = 'width=250,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=20,top=20';
	// Questlog
	var popup3 = 'width=380,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=10,top=10';
	
	//When the link is clicked, this event handler function is triggered which creates the pop-up windows 
	function eventHandler() {
			var x = 0;
			var popupSpecs;
			//figure out what popup size, etc to apply to the click
			while(x < matchClass.length){
					if((" "+this.className+" ").indexOf(" "+matchClass[x]+" ") > -1){
						popupSpecs = matchClass[x];
						var popurl = this.href;
					}
			x++;
			}
		//Create a "unique" name for the window using a random number
		var popupName = Math.floor(Math.random()*10000001);
		//Opens the pop-up window according to the specified specs
		newwindow=window.open(popurl,popupName,eval(popupSpecs));
		return false;
	}

	//Attach the onclick event to all your links that have the specified CSS class names
	function attachPopup(){
		var linkElems = document.getElementsByTagName('a'),i;
		for (i in linkElems){
			var x = 0;
			while(x < matchClass.length){
				if((" "+linkElems[i].className+" ").indexOf(" "+matchClass[x]+" ") > -1){
					linkElems[i].onclick = eventHandler;
				}
			x++;
			}
		}
	}

	//Call the function when the page loads
	window.onload = function (){
	    attachPopup();
	}
</script> -->

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
<a name="top"></a>

<center><h3 class='title'>Location</h3></center>
<table width="100%">
   <tr><td>
   
<center>   
<table border="0" width="200">
  <tr>
     <td align="right">{{adminlink}}</td>
     <td>&nbsp;&nbsp;</td>
     <td align="left"><a href="index.php" class="myButton2">{{currentaction}}</a></td>
  </tr>
  <tr>
     <td align="right">Lat: <span style="color: #0080FF;">{{latitude}}</span></td>
     <td>&nbsp;&nbsp;</td>
     <td align="left">Long: <span style="color: #0080FF;">{{longitude}}</span></td>
  </tr>
  <tr>
     <td colspan="3" class="copyright"><center>{{currenttown}}</center></td>
  </tr>
</table>
 </center>
 
<center>
<table width=200 height=200 style="background-image:url('images/map.gif'); background-position: {{brx}}px {{bry}}px; background-repeat: no-repeat; border-width: 4px; border-spacing: 4px; border-style: inset; border-color: black; border-collapse: collapse;">
<tr>
<td width=100 height=100 style="border-width: 1px; padding: 0px; border-style: dashed; border-color: white;">
</td>
<td width=100 height=100 style="border-width: 1px; padding: 0px; border-style: dashed; border-color: white;">
</td>
</tr>
<tr>
<td width=100 height=100 style="border-width: 1px; padding: 0px; border-style: dashed; border-color: white;">
</td>
<td width=100 height=100 style="border-width: 1px; padding: 0px; border-style: dashed; border-color: white;">
</td>
</tr>
</table>
</center>

<center>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <form action="index.php?do=move" method="post">
<table border="0" width="100%" cellpadding="4" cellspacing="6">
  <tr>
     <td align="center"><input name="northwest_x" type="submit" class="myButton2" value="NW +-" /></td>
     <td align="center"><input name="north_x" type="submit" class="myButton2" value="N +" /></td>
     <td align="center"><input name="northeast_x" type="submit" class="myButton2" value="NE ++" /></td>
  </tr>
  <tr>
     <td align="center">&nbsp;<input name="west_x" type="submit" class="myButton2" value="W -" /></td>
     <td align="center"><a href="javascript:openmappopup()" class="myButton2">Map</a></td>
     <td align="center"><input name="east_x" type="submit" class="myButton2" value="E +" />&nbsp;</td>
  </tr>
  <tr>
     <td align="center"><input name="southwest_x" type="submit" class="myButton2" value="SW --" /></td>
     <td align="center"><input name="south_x" type="submit" class="myButton2" value="S -" /></td>
     <td align="center"><input name="southeast_x" type="submit" class="myButton2" value="SE -+" /></td>
  </tr>
  <tr>
     <td align="center" colspan="3"><a href="javascript:openquestlogpopup()" class="myButton2">Quest Log</a></td>
  </tr>
</table>
</form> 
</center>

</td></tr>
</table>
</center>

<center>
<a href="index.php?do=mainfight" class="myButton2">{{challenged}}</a>
<a href="mail.php" class="myButton2">{{mail}}</a><br><br>
</center>


<center><h3 class='title'>Fast Spells</h3></center><br />
<center>{{magiclist}}</center>


<center><h3 class='title'>Fighting & Kills</h3></center>
<div align="left">
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Fight Level:</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{fightlvl}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Monster Kills:</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{kills}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Monster Fights:</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{fights}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Career Kills:</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{numkills}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Total Fights:</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{totalfights}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Player Deaths:</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{deaths}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Career Deaths:</span></td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{numdeaths}}</span></td>
</tr>
</table></div>


<center><h3 class='title'>Experience Points</h3></center>
<div align="left">
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Current Level:</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{level}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Exp. Pts Now:</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{experience}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Exp. Pts Needed:</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{expneed}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Exp. Total to Next Lvl:</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{nextlevel}}</span></td>
</tr>
<tr>
<td width="70%">&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;">Exp. Bonus:</td>
<td width="30%">&nbsp;&nbsp;<span style="color: #0080FF; font-size: 8pt;" text-align:right;">{{expbonus}}</span><font color="#FF0000">*</font></td>
</tr>
<tr>
<td colspan="2">&nbsp;&nbsp;<font color="#FF0000">*</font><span style="font-size: 7pt;" text-align:right;">Gained thru Weapons & Events</span></td>
</tr>
</table></div>



<center><h3 class='title'>Town Maps</h3></center>

<center><span style="font-size: 8pt;">{{currenttown}}</span><br />
<a href="index.php?do=maps" class="myButton2">Map Locations</a><br /><br />
<span style="font-family: verdana; font-weight: normal; font-style: normal; text-decoration: none; font-size: 7pt;">{{townslist}}</span></center><br />


<center><h3 class='title'>Inventory</h3></center>
<center><table border="1" cellpadding="1" cellspacing="2">
  <tr>
     <td width="33%" nowrap><img src="images/drops/{{slot1name}}.png" height="44" width="44" alt="{{slot1name}}" title="{{slot1name}}" /></td>
     <td width="33%" nowrap><img src="images/drops/{{slot2name}}.png" height="44" width="44" alt="{{slot2name}}" title="{{slot2name}}" /></td>
     <td width="33%" nowrap><img src="images/drops/{{slot3name}}.png" height="44" width="44" alt="{{slot3name}}" title="{{slot3name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot1name}}</td>
     <td class="copyright" align="center">{{slot2name}}</td>
     <td class="copyright" align="center">{{slot3name}}</td>
  </tr>
  <tr>
     <td><img src="images/drops/{{slot4name}}.png" height="44" width="44" alt="{{slot4name}}" title="{{slot4name}}" /></td>
     <td><a href="DropAttributes.html"><a href="javascript:opendrop_attributespopup()"><img src="images/drops/drops.png" height="44" width="44" alt="Attributes" title="Attributes" /></a></td>
     <td><img src="images/drops/{{slot5name}}.png" height="44" width="44" alt="{{slot5name}}" title="{{slot5name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot4name}}</td>
     <td class="copyright" align="center"><a href="javascript:opendrop_attributespopup()">Attributes</a></td>
     <td class="copyright" align="center">{{slot5name}}</td>
  </tr>
  <tr>
     <td><img src="images/drops/{{slot6name}}.png" height="44" width="44" alt="{{slot6name}}" title="{{slot6name}}" /></td>
     <td><img src="images/drops/{{slot7name}}.png" height="44" width="44" alt="{{slot7name}}" title="{{slot7name}}" /></td>
     <td><img src="images/drops/{{slot8name}}.png" height="44" width="44" alt="{{slot8name}}" title="{{slot8name}}" /></td>
  </tr>
  <tr>
     <td class="copyright" align="center">{{slot6name}}</td>
     <td class="copyright" align="center">{{slot7name}}</td>
     <td class="copyright" align="center">{{slot8name}}</td>
  </tr>
</table>
</center><br />

<center><h3 class='title'>Functions</h3></center>     
<div align="left">
<table width="80%" border="0" cellpadding="0" cellspacing="0" style="border-width: 0px;">
<tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="index.php">Town Square</a></td>
  </tr>
  <tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="javascript:openmappopup()">Show Map</a></td>
  </tr>
  <tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="javascript:openshowcharpopup()">Extended Stats</a></td>
  </tr>
  <tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="javascript:opendrop_attributespopup()">Drop Attributes</a></td>
  </tr>
  <tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="help.php">Help</a></td>
  </tr>
  <tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="index.php?do=contact">Contact Admin</a></td>
  </tr>
  <tr>
<td>&nbsp;&nbsp;<span style="font-size: 8pt; text-align:left;"><a href="login.php?do=logout">Log Out</a></td>
</tr>
</table></div>
<br />

{{adminlink}}<br />
{{moderatorlink}}<br />
</span>
<a href="#top" class="myButton2">Top of Page</a>
<br /><br />
THEVERYENDOFYOU;
?>