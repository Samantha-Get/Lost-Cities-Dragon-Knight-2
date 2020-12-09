<?php
$template = <<<THEVERYENDOFYOU
<head>
<meta name="msvalidate.01" content="482546814423A0298C2D356F3237C2CA" />
<title>{{title}}</title>
<style type="text/css">

body {
  background-image: url(images/background.jpg);
  color: black;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
}

td, input, select, textarea {
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
  font-weight: normal;
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
    font-weight:  normal;
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
	background-position:center center;
	background-repeat:no-repeat;
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
	
	
/*
Back to top button
*/
#back-top {
  position: fixed;
  bottom: 10px;
  margin-left: 20px;
  z-index:499;
  /*IE6 hack */
    _position: absolute;
    _top:expression(documentElement.scrollTop+body.scrollTop);
    _margin-top: 500px;

}
#back-top a,  #back-top-prev a {
  width: 50px;
  display: block;
  text-align: center;
  font: 11px/100% Arial, Helvetica, sans-serif;
  text-transform: uppercase;
  text-decoration: none;
  color: #bbb;
  /* background color transition */
  -webkit-transition: 1s;
  -moz-transition: 1s;
  transition: 1s;

}
#back-top a:hover, #back-top-prev a:hover {
  color: #000;
}
/* arrow icon (span tag) */
#back-top span#button , #back-top-prev span#button-prev {
  width: 50px;
  height: 50px;
  display: block;
  margin-bottom: 7px;
  background-position: center center;
  background-repeat: no-repeat;

  background-image: url('../images/up-arrow.png') ;
  opacity:0.8;
  filter:alpha(opacity = 80);
  /* rounded corners */
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  /* background color transition */
  -webkit-transition: 1s;
  -moz-transition: 1s;
  transition: 1s;
}
#back-top a:hover span#button, #back-top-prev a:hover span#button-prev {
  opacity:1;
  filter:alpha(opacity = 100);
}
#edit-scroll-to-top-preview {
  float:right;
  width:100%;
}

	
	
</style>

<script>

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


function openrespopup(){
var popurl="index.php?do=resources"
winpops=window.open(popurl,"","width=360,height=360,noscrollbars")
}


function openwiki(monster){
var popurl="index.php?do=showmonster&id=" + monster
winpops=window.open(popurl,"","width=300,height=260,noscrollbars")
}

function openquestlogpopup(){
var popurl="index.php?do=questlog"
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
}

function openchatpopup(){
var popurl="index.php?do=babblebox"
winpops=window.open(popurl,"","width=300,height=400,scrollbars")
}

</script>



<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body><center>
<table width="98%"><tr>
<td width="200" style="border-right: solid 1px black;">

<br />
<font color="#C8003C"> * Broken</font><br /><br />

<b>Lost Cities Administration:</b><br />
<a href="admin.php">Admin Home</a><br />
<a href="index.php">Game Home</a><br />
<b>Server Admin:</b><br />
<a href="admin.php?do=main">Server Settings</a><br />

<br />
<b>News - Babblebox - Forum</b><br />
<a href="admin.php?do=news">Add News Post</a><br />
<a href="admin.php?do=resetbabble">ReSet Babblebox</a><br />
<a href="admin.php?do=editforum">Edit Forum</a><br />

<br />
<b>User Admin:</b><br />
<a href="admin.php?do=users">Edit Users</a><br />
<a href="admin.php?do=delusers">Delete Users</a><br />

<br /><!-- Reset Stats / Reset  -->
<b>Orbs:</b><br />
<a href="admin.php?do=resetorbs">Reset Orbs</a><br />

<br />
<b>Kingdom Lords:</b><br />
<a href="admin.php?do=lords">Edit Lords</a><br />

<br />
<b>Items:</b><br />
<a href="admin.php?do=items">Edit Items</a><br />
<a href="admin.php?do=delitems">Delete Items</a><br />

<br />
<b>Towns:</b><br />
<a href="admin.php?do=addtown">Add New Town</a><br />
<a href="admin.php?do=towns">Edit Towns</a><br />
<a href="admin.php?do=deltowns">Delete Towns</a><br />

<br />
<b>Levels:</b><br />
<a href="admin.php?do=levels">Edit Levels</a><br />

<br />
<b>Monsters:</b><br />
<a href="admin.php?do=addmonster">Add New Monster</a><br />
<a href="admin.php?do=monsters">Edit Monsters</a><br />
<a href="admin.php?do=delmonsters">Delete Monsters</a><br />

<br />
<b>Drops:</b><br />
<a href="admin.php?do=adddrop">Add New Drop Item</a><br />
<a href="admin.php?do=drops">Edit Drops</a><br />
<a href="admin.php?do=deldrops">Delete Drops</a><br />
<br />
<b>Spells:</b><br />
<a href="admin.php?do=addspell">Add New Spell</a><br />
<a href="admin.php?do=spells">Edit Spells</a><br />
<a href="admin.php?do=delspells">Delete Spells</a><br />

<br />
<b>Quests:</b><br />
<a href="admin.php?do=quests">Edit Quests</a><br /> 
<a href="admin.php?do=addquest">Add Quest</a><br />

<br />
<b>NPCs - Local Villagers:</b><br />
<a href="admin.php?do=addnpc">Add NPC</a><br />
<a href="admin.php?do=npc">Edit NPC</a><br /> 
<b>NPCSs II - Villager Helpers:</b><br />
<a href="admin.php?do=addnpc2">Add NPC2s</a><br />
<a href="admin.php?do=npc2">Edit NPC2s</a><br />


<br />
<b>Game Fields:</b><br />
<a href="admin.php?do=addfield">Add New Game Field</a><br />
<a href="admin.php?do=fields">Edit Fields</a><br />


<br />
<b>Others:</b><br /><!-- Commment -->
<a href="ihasalist.php">Image Checks</a><font color="#C8003C"> *</font><br />

</td><td>
{{content}}
</td></tr></table></center>

<br /><br />
<div align="center">[ <a href="help.php" class="myButton2">Return to Help</a> | <a href="#top" class="myButton2">Top of Page</a> | <a href="index.php" class="myButton2">Game Home</a> ]</div>
<br /><br />
<table class="copyright" width="100%">
<tr>
<td align="center" class="copyright"><a href="http://dragon.se7enet.com/dev.php" target="_new">&copy; 2003-2006 by renderse7en</a></td>
<td align="center" class="copyright">The Lost Cities Version {{version}}{{build}} &copy; 2010-2021 by ES_Archangel - Archangel Michael - Archangel Heaavenweb</td>
<td align="center" class="copyright"><a href="https://michaelmccart.com/" target="_new">MichaelMcCart.Com</a></td>
<td align="center" class="copyright">{{totaltime}} Sec. {{numqueries}} Queries</td>
</tr>
</table>

</body>
</html>
THEVERYENDOFYOU;
?>