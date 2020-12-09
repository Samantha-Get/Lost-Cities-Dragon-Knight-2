<?php 

//Mod by Fantasia

function contactadmin() { 

$page = "<center><h3 class='title'>Contact Admin</h3></center><br /><br />

<blockquote><blockquote><center>If you need to Report a Bug, Abuse, or just need to contact an Admin, they are listed Below.</center>\n<br /><br />\n";
$page .= "<center><table width=\"65%\">";
$topquery = doquery("SELECT * FROM {{table}} WHERE authlevel=1", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\"><b>$rank</b></td><td align=\"left\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td><td align=\"right\"><b>".$toprow["email"]."</b></td></tr>\n";
        $rank++;
    }
	$page .= "</table></center>\n<br /><br />";
    $page .= "<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div></blockquote></blockquote><br /><br />";
    display($page, "Admin List");
}
?>
