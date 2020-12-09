<?php 

//Mod by Fantasia Reformatted by Michael "Archangel" McCart


function jail() { 

$page = "<center><h3 class=\"title\">The users below are Temporarily or Permanently Banned.<h3></center>\n<br /><br />\n";
$page .= "<center><table align=\"center\" height=\"1036\" width=\"800\" border=\"0\" background=\"images/background/jail/Capital Crossroads.jpg\" bordercolor=\"#FF8040\" cellpadding=\"0\" cellspacing=\"0\">";
$topquery = doquery("SELECT * FROM {{table}} WHERE authlevel=2", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"35%\">&nbsp; </td><td width=\"30%\"><br /><br /><br /><br /><br /><center><h3 class=\"title\"><b>$rank &nbsp; &nbsp; &nbsp; <a href=\"index.php?do=onlinechar:".$toprow["id"]."\"><b>".$toprow["charname"]."</b></a></b><h3></center></td><td width=\"35%\">&nbsp; </td></tr>\n";
        $rank++;


    }
    $page .= "</table></center>\n<br /><br />";
    $page .= "<center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center>";
    display($page, "Jail");

}
