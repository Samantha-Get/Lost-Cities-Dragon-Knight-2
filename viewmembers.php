<?php 

// Displays all banned players


function viewmembers() {

$page = "<center><h3 class='title'>Members List</h3></center>\n";
$page .= "<br />";

$topquery = doquery("SELECT * FROM {{table}} WHERE authlevel=1 OR authlevel=2 OR authlevel=0", "users");

$rank = 1;
$jobtitle = array (1 => "<b>Administrators</b>",2 => "<font color='red'><b>Banned</b></font>", 0 => "<b>Users</b>");
$lastjob="";
$tabopen= false;
while ($toprow = mysql_fetch_array($topquery)) {
				if ($jobtitle[$toprow["authlevel"]] != $lastjob)
				{
					if ($tabopen) {$page .='</table><br>';}
					$page .= '<font color="'.($toprow["authlevel"]==1 ? green:brown).'"><center>'.$jobtitle[$toprow["authlevel"]].'</center></font>';
					$page .= "<table width=\"75%\" align=center>";
					$tabopen = true;
					$lastjob = $jobtitle[$toprow["authlevel"]];
				}
				$page .= "<tr><td width=\"10%\"><b>$rank</b></td><td width=\"20%\">Username: <b>".$toprow["username"]."</b></td><td width=\"5%\"></td><td width=\"20%\">Character Name: <a href=\"index.php?do=onlinechar:".$toprow["id"]."\">".$toprow["charname"]."</a></td><td width=\"5%\"></td><td width=\"36%\">Last login: ".$toprow["onlinetime"]."</td></tr>\n";
        $rank++;
        
    }
    $page .= "</table>
					\n<br /><br />";
    $tabopen = false;
	$page .= "<div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Town Square</a></div>";
    display($page, "");

}
