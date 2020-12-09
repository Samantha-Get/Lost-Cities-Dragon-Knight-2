<?php ini_set('arg_separator.output','&amp;'); ?>
<?php
$template = <<<THEVERYENDOFYOU
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="msvalidate.01" content="482546814423A0298C2D356F3237C2CA" />
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
    font-weight: normal;;
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
                width:90%; 
                border-collapse:collapse; 
        }
        .TFtable td{ 
                padding:3px; border:#000000 1px solid;
        }
        /* provide some minimal visual accommodation for IE8 and below */
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
winpops=window.open(popurl,"","width=260,height=400,scrollbars")
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
<center><a name="top" id="top"></a>
<table cellspacing="0" width="90%"><tr>
<td class="top" colspan="3">
  <table width="100%"><tr><td><img src="images/logo.png" height="51" width="234" alt="{{dkgamename}}" title="{{dkgamename}}" border="0" /></td><td style="text-align:right; vertical-align:middle;">{{topnav}}</td></tr></table>
</td>
</tr><tr>
<td class="left" width="210" nowrap valign="top">{{leftnav}}</td>
<td class="middle">{{content}}<br />
<br />
<br />
<div class="c3"><a href="#top" class="myButton2">Top of Page</a></div>
<br /></td>
<td class="right" width="210" nowrap valign="top">{{rightnav}}</td>
</tr>
</table><br />
<br />

</div>
<br />
<table class="copyright" width="100%">
<tr>
<td align="center" class="copyright"><a href="http://dragon.se7enet.com/dev.php" target="_new">&copy; 2003-2006 by renderse7en</a></td>
<td align="center" class="copyright">Powered by Lost Cities&nbsp;&nbsp;{{version}}{{build}} &copy; 2010-2020 by ES_Archangel - Archangel Michael - Archangel Heaavenweb</td>
<td align="center" class="copyright"><a href="https://michaelmccart.com/" target="_new">MichaelMcCart.Com</a></td>
<td align="center" class="copyright">{{totaltime}} Sec. {{numqueries}} Queries</td>
</tr>
</table>

<br />

</html>
THEVERYENDOFYOU;
?>