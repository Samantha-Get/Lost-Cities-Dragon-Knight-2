<?php
$template = <<<THEVERYENDOFYOU



<head>
<title>{{title}}</title>
<style type="text/css">
body {
  background-image: url(images/background.jpg);
  color: black;
  font: 11px verdana;
}
table {
  border-style: none;
  padding: 0px;
  font: 11px verdana;
}
td {
  border-style: none;
  padding: 3px;
  vertical-align: top;
}
td.top {
  border-bottom: solid 2px black;
}
td.left {
  width: 150px;
  border-right: solid 2px black;
}
td.right {
  width: 150px;
  border-left: solid 2px black;
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
  font: 10px verdana;
}
.highlight {
  color: red;
}
.light {
  color: #999999;
}
.title {
  border: solid 1px black;
  background-color: #eeeeee;
  font-weight: bold;
  padding: 5px;
  margin: 3px;
}
.copyright {
  border: solid 1px black;
  background-color: #eeeeee;
  font: 10px verdana;
}
</style>
</head>
<body>

<center><br>
{{seenby}}<br><br>
<b>{{name}}</b>&nbsp; {{level}}<br>
{{monsterimg}}<br>
{{monsterid}} {{monster}} {{id}}<br><br>
{{hitpoints}}<br>
{{damage}}<br>
</center>

<img src=\"images/monsters/".$userrow["currentmonster"].".png\" />
{{monstername}}
{{currentmonsterhp}} Hitpoints
{{attackpower}}
{{strength}}
{{charname}}
{{monstername}}
{{monsterlevel}}
{{monsterseenby}}

</body>
</html>
THEVERYENDOFYOU;
?>