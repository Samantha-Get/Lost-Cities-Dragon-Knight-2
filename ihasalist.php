<?php

print "<center><a href=\"admin.php\">Back to Admin</a><center>";
print "<center><a href=\"index.php\">Back to Game</a><center>";

include("config.php");
extract($dbsettings);

if (isset($_GET["do"]))
{
    $do = explode(":",$_GET["do"]);
    if ($do[0] == "drops") display("drops");
    if ($do[0] == "items") display("items");
    if ($do[0] == "monsters") display("monsters");
}
else
{
	print "<h2>Picture</h2>";
	print "<li /><a href=\"ihasalist.php?do=drops\">View Drops</a>";
	print "<li /><a href=\"ihasalist.php?do=items\">View Items</a>";
	print "<li /><a href=\"ihasalist.php?do=monsters\">View Monsters</a>";
	print "<li /><a href=\"ihasalist.php?do=npcs\">View NPCS</a>";
	print "<li /><a href=\"ihasalist.php?do=npc\">View NPC</a>";
}

function display($table)
{
	include("config.php");
	extract($dbsettings);
	
	print "<a href=\"ihasalist.php\">Go back to choose a list</a><br /><br >";
	
	$connectID = mysql_connect($server,$user,$pass);
	
	mysql_select_db($name,$connectID);
	
	$myDataID = mysql_query("select name from ".$prefix."_$table",$connectID);
	
	print "<table border=1>";
	
	print "<tr style=\"font-weight:bold; text-align:center;\"><td>ID #</td><td>Name</td><td>Picture uploaded?</td></tr>";
	
	$id = 0;
	
	while ($row = mysql_fetch_row($myDataID))
	{
		$id++;
		
		print "<tr>";
		
		$rowname = $row[0];
		
		//foreach ($row as $Matthew_Hlavac_the_Elegant)
			//$rowname = $Matthew_Hlavac_the_Elegant;
		
		print "<td style=\"text-align:center;\">".$id."</td><td style=\"text-align:center;\">".$rowname."</td>";
		
		if (file_exists("images/$table/".$id.".png"))
			print "<td style=\"text-align:center;\">Yes</td>";
		else
			print "<td style=\"text-align:center;\">No</td>";
		
		print "</tr>";
	}
	
	print "</table>";
	
	print "<br /><a href=\"ihasalist.php\">Go back to choose a list</a>";
	
    display($page, "Check Images");
    
}

?>