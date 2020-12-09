<?php
$template = <<<THEVERYENDOFYOU
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="msvalidate.01" content="482546814423A0298C2D356F3237C2CA" />
<meta name="application-name" content="Michael McCart"/>
<meta name="msapplication-TileColor" content="#8c6414"/>
<meta name="msapplication-notification" content="frequency=30;polling-uri=http://notifications.buildmypinnedsite.com/?feed=http://www.michaelmccart.com/rss.xml&amp;id=1;polling-uri2=http://notifications.buildmypinnedsite.com/?feed=http://www.michaelmccart.com/rss.xml&amp;id=2;polling-uri3=http://notifications.buildmypinnedsite.com/?feed=http://www.michaelmccart.com/rss.xml&amp;id=3;polling-uri4=http://notifications.buildmypinnedsite.com/?feed=http://www.michaelmccart.com/rss.xml&amp;id=4;polling-uri5=http://notifications.buildmypinnedsite.com/?feed=http://www.michaelmccart.com/rss.xml&amp;id=5; cycle=1"/>
<title>{{title}}</title>
<style type="text/css">
body {
  background-image: url(images/background.jpg);
  color: black;
  font: 12px verdana;
}
table {
  border-style: none;
  padding: 0px;
  font: 12px verdana;
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
    font-weight: normal;
}
a:hover {
    color: #330000;
}
.small {
  font: 10px verdana;
}
.highlight {
  color: green;
}
.light {
  color: #999999;
}
.title {
  border: solid 1px black;
  background-color: #eeeeee;
  font-weight: bold;
  font-family: Verdana, Trebuchet MS, Fantasy;
  padding: 1px;
  margin: 1px;
}

.titleblack {
  border: solid 1px white;
  background-color: #000000;
  font-family: Verdana, Trebuchet MS, Fantasy;
  padding: 1px;
  margin: 1px;
  text-decoration:none;
}


 #map {
	width: 501px;
	height: 501px;
	background-image: url(images/map.gif);
} 

.copyright {
  border: solid 1px black;
  background-color: #eeeeee;
  font: 10px verdana;
}

.titlestores {
  color: #663300;
  border: solid 1px white;
  background-color: #A55A4B; 
  font-weight:  normal;
  padding: 3px;
  margin: 1px;
}

.Whiteonblack {
  color: #FFFFFF;
  border: solid 1px white;
  background-color: #000000; 
  font-weight:  normal;
  padding: 3px;
  margin: 1px;
}

.imagetores {
  border: solid 1px white;
  padding: 3px;
  margin: 2px;
}
</style>
<script type="text/javascript">
//<![CDATA[
function openrespopup(){
var popurl="index.php?do=resources"
winpops=window.open(popurl,"","width=180,height=440,noscrollbars")
}

function opencharpopup(){
var popurl="index.php?do=showchar"
winpops=window.open(popurl,"","width=260,height=500,scrollbars")
}

function openmappopup(){
var popurl="index.php?do=showmap"
winpops=window.open(popurl,"","width=520,height=520,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no")
}

function openwiki(monster){
var popurl="index.php?do=showmonster&id=" + monster
winpops=window.open(popurl,"","width=300,height=260,noscrollbars")
}

function dropattributespopup(){
var popurl="Drop Attributes.html"
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
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
</head>
<body><center>
{{content}}
</center></body>
</html>
THEVERYENDOFYOU;
?>