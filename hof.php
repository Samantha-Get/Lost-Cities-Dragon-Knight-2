<?php 

//Mod by Fantasia - Reformaated to Match other DK Pages by Archangel 1-22-2017


function hof() { 
	$page .= "<center><h3 class=\"title\">Hall of Fame</h3></center>";	
    $page .= "<br><center><table border=\"1\" width=\"96%\" class=\"TFtable\"><tr>";
    $page .= "<td align='center' nowrap class='small'>Hit Points</td>";
    $page .= "<td align='center' nowrap class='small'>Travel Points</td>";
    $page .= "<td align='center' nowrap class='small'>Magic Points</td>";
    $page .= "<td align='center' nowrap class='small'>Experience</td>";
    $page .= "</tr><tr>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highesthp\">Hit Points</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highesttp\">Travel Hall</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestmp\">Magic Hall</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestxp\">Experience</a></b></td>";
    $page .= "</tr><tr>";
	$page .= "<td align='center' nowrap class='small'>The Richest</td>";
	$page .= "<td align='center' nowrap class='small'>+ Gold Bonus</td>";
	$page .= "<td align='center' nowrap class='small'>+ Bank Account</td>";
	$page .= "<td align='center' nowrap class='small'>+ EXP Bonus</td>";
    $page .= "</tr><tr>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=richestbygold\">Hall of the Rich</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestgoldbonus\">Bonus Hall: Gold</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=richestbybank\">Hall of Savings</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestexpbonus\">Bonus Hall: EXP</a></b></td>";
    $page .= "</tr><tr>";
	$page .= "<td align='center' nowrap class='small'>+ Level Hall</td>";
	$page .= "<td align='center' nowrap class='small'>Hall of Birth</td>";
	$page .= "<td align='center' nowrap class='small'>Adventuring +</td>";
	$page .= "<td align='center' nowrap class='small'>Difficulty +</td>";
    $page .= "</tr><tr>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestlevel\">+ Level Hall</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestregdate\">Hall of Births</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestonlinetime\">Adventuring +</a></b></td>";
	$page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestdifficulty\">Difficulty +</a></b></td>";
    $page .= "</tr><tr>";
    $page .= "<td align='center' nowrap class='small'>Fight Level</td>";
    $page .= "<td align='center' nowrap class='small'>No. of Kills</td>";
    $page .= "<td align='center' nowrap class='small'>Most Deaths</td>";
    $page .= "<td align='center' nowrap class='small'>Total Fights</td>";
    $page .= "</tr><tr>";
    $page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestfightlvl\">Fight Level</a></b></td>";	
    $page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestkills\">High Kills</a></b></td>";
    $page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highestdeaths\">Your Deaths</a></b></td>";
    $page .= "<td align='center' nowrap class='small'><b><a href=\"index.php?do=highesttotalfights\">Total Fights</a></b></td>";
	$page .= "</tr><tr>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "</tr><tr>";
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";	
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";
	$page .= "</tr><tr>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "<td align='center' nowrap class='small'>&nbsp;</td>";
    $page .= "</tr><tr>";
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";	
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";
    $page .= "<td align='center' nowrap class='small'><b>&nbsp;</b></td>";
    $page .= "</tr>";
    $page .= "</table></center>";
    $page .= "<br><br><center><b><a href=\"index.php\" class=\"myButton2\">Town Square</b></a></center>";
    
    display($page, "Hall of Fame");
}


//  highesttotalfights
function highesttotalfights() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Total Fights Top 50</h3></center></td></tr></table><br><br>";
$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Total Fights:<b> ".number_format($toprow["totalfights"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
//   highesttotalfights


//  highestdeaths
function highestdeaths() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Player Deaths Top 50</h3></center></td></tr></table><br><br>";
$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Player Deaths: <b>".number_format($toprow["deaths"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
//  highestdeaths





// highestfightlvl
function highestfightlvl() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Fighting Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  defensepower  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Fighting Level: <b>".number_format($toprow["fightlvl"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}


//  highestkills
function highestkills() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Monster Deaths Top 50</h3></center></td></tr></table><br><br>";
$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Monsters Kills: <b>".number_format($toprow["kills"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
//  End highestkills


//  Highest Gold
function richestbygold() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Richest by Gold Top 50</h3></center></td></tr></table><br><br>";
$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  gold  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Gold: <b>".number_format($toprow["gold"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
//  End Highest Gold





//  Highest Gold Bonus
function highestgoldbonus() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Gold Bonus Top 50</h3></center></td></tr></table><br><br>";
$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  goldbonus  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Highest Gold Bonus: <b>".number_format($toprow["goldbonus"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
// End Highest Gold Bonus




//  Highest Exp Bonus
function highestexpbonus() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Experience Hall of Bonus Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  expbonus  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Highest Experience Bonus: <b>".number_format($toprow["expbonus"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
// End Highest Exp Bonus




//  Highest Online Time
function highestonlinetime() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Welcome to Adventuring Hall Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  onlinetime  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Highest Online Time: <b>".number_format($toprow["onlinetime"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
// End Highest Online Time




//  Highest Reg Date
function highestregdate() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Welcome to the Hall of Birth Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  regdate  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Birth Date: <b>".number_format($toprow["regdate"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
// End Highest Reg Date


  
//  Highest Difficulty
function highestdifficulty() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Welcome to the Hall of Difficulty Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  difficulty  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Difficulty Level: <b>".number_format($toprow["difficulty"])."</b></td></tr>\n";
        $rank++;
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}
// End Highest Difficulty



function richestbybank() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Saving Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  bank  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Bank: <b>".number_format($toprow["bank"])."</b></td></tr>\n";
        $rank++;     
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highesthp() { 
$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Highest Hit Points Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  maxhp  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Max HP: <b>".number_format($toprow["maxhp"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highesttp() { 
$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Travel Points Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  maxtp  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Max TP: <b>".number_format($toprow["maxtp"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highestmp() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Magic Points Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  maxmp  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Max MP: <b>".number_format($toprow["maxmp"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highestlevel() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of the Most Explored Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  level  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Level: <b>".number_format($toprow["level"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highestxp() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Experience Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  experience  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Experience: <b>".number_format($toprow["experience"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function higheststr() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Strength Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  strength  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Strength: <b>".number_format($toprow["strength"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highestdex() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Dexterity Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  dexterity  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Dexterity: <b>".number_format($toprow["dexterity"])."</b></td></tr>\n";
        $rank++;
            }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}




function highestatk() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Attack Power Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  attackpower  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Attack Power: <b>".number_format($toprow["attackpower"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}



function highestdef() { 

$page = "<table width='100%' border='1'><tr><td><center><h3 class='title'>Hall of Defense Top 50</h3></center></td></tr></table><br><br>";

$page .= "<div align=\"center\"><table class=\"TFtable\">";
$topquery = doquery("SELECT * FROM {{table}} ORDER BY  defensepower  DESC LIMIT 50", "users");

$rank = 1;
while ($toprow = mysql_fetch_array($topquery)) {
        $page .= "<tr><td width=\"10%\" nowrap align=\"center\" class=\"small\">$rank</td><td width=\"50%\" nowrap class=\"small\"><a href=\"index.php?do=onlinechar:".$toprow["id"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$toprow["charname"]."</a></td><td width=\"40%\" nowrap align=\"center\" class=\"small\">Defense Power: <b>".number_format($toprow["defensepower"])."</b></td></tr>\n";
        $rank++;        
    }
    $page .= "</table></div>\n<br /><br />";
    $page .= "<div align=\"center\"><blockquote><blockquote><br />Return to:";
    $page .= "<br /><br /><a href=\"index.php?do=hof\" class=\"myButton2\">Hall of Fame</a>";
    $page .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote></blockquote></div>";
    display($page, "Richest by Gold");
}

?>