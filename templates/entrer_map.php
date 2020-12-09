<?php
$template = <<<THEVERYENDOFYOU
<head>
<title>{{title}}</title>
<style type="text/css">

body {
  background-image: url(images/background.jpg);
  color: black;
  font-family: Trebuchet MS, Verdana, Fantasy;
  font-size: 13px; 
}

td, input, select, textarea {
  font-family: Trebuchet MS, Verdana, Fantasy;
  font-size: 13px; 
  font-weight:bold;
   }
   
input, select, textarea {
  font-family: Trebuchet MS, Verdana, Fantasy;
  font-size: 13px; 
  border-style:outset;
  border-color:#eeeeee;
  color:#000000;
}

table {
  border-style: none;
  padding: 0px;
  font-family: Trebuchet MS, Verdana, Fantasy;
  font-size: 13px; 
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
  width: 180px;
  border-right: solid 1px black;
}

td.right {
  width: 180px;
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
  font-size: 10px; 
}

.highlight {
  color: red;
}

.light {
  color: #999999;
}

.copyright {
  border: solid 1px black;
  background-color: #eeeeee;
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 10px; 
}

.title {
  border: solid 1px black;
  background-color: #eeeeee;
  font-weight: bold;
  padding: 1px;
  margin: 1px;
}

.whiteonblack {
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
  font-style: normal;
  text-decoration: none;
  text-transform: none;
  font-variant: normal;
  color: #000000;
  background: #FFFFFF;
  text-align: center;
  padding-left: 3px;
  padding-right: 3px;
  padding-top: 3px;
  padding-bottom: 3px;
  border-left: 3px ridge #C0C0C0;
  border-right: 3px groove #C0C0C0;
  border-top: 3px groove #C0C0C0;
  border-bottom: 3px groove #C0C0C0;
  }

.blackonwhite{
  font-family: Verdana, Trebuchet MS, Fantasy;
  font-size: 11px; 
  font-style: normal;
  text-decoration: none;
  text-transform: none;
  font-variant: normal;
  color: #FFFFFF;
  background: #000000;
  text-align: center;
  padding-left: 3px;
  padding-right: 3px;
  padding-top: 3px;
  padding-bottom: 3px;
  border-left: 3px ridge #C0C0C0;
  border-right: 3px groove #C0C0C0;
  border-top: 3px groove #C0C0C0;
  border-bottom: 3px groove #C0C0C0;
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
	font-size:11px;
	padding:3px 14px;
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

</head>
<body>
{{content}}
</body>
</html>
THEVERYENDOFYOU;
?>
