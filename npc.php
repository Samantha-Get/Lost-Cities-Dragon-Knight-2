<?php 

/*
############### Modificated by ES_Archangel, Archangel_Michael, Archangel ###############
- Expanded database for the NPCs
- Modified New code for use with present database
- Fixed some spell errors
- Expanded Admin functions
- Expanded Admin menu options
- Reformatted to be easier to understand for customizing
- There can now be up to 10 custom questions and answers
*/
//Previous modificated by sLysdal & Fantasia - Original Source is from the "Town Information Mod".
//Original "TownInf2" Mod by Anman.

function npclist()
{
	global $userrow;
	
	$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
		$townrow = mysql_fetch_array($townquery);
	$title = "Talking to locals in ".$townrow["name"]."";
	
	if(mysql_num_rows($townquery) == 0) { display("Error!<br />You are not in a town", "Error"); die(); }
	
	$Inf = "<center><h3 class=\"title\">Local Villagers<h3></center><table align=\"center\" height=\"647\" width=\"800\" background='images/npc/npcback/blank.png'><tr><td><blockquote><blockquote><br /><br /><br /><br />
<a href=\"index.php\"><img align='left' src='images/shops/".$townrow["name"].".png'></a><b>&nbsp;&nbsp;&nbsp;&nbsp;Here you can see a list of the locals in<br>&nbsp;&nbsp;&nbsp;&nbsp; ".$townrow["name"]." that are willing to talk to you:</b><br /><br />";
		
	
	$npcquery = doquery("SELECT * FROM {{table}} WHERE town='".$townrow["id"]."'", "npcs");
		while($npcrow = mysql_fetch_array($npcquery))
		{
			$Inf .= "<b>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?do=npc:".$npcrow["id"]."\">".npcunescape($npcrow["name"])."</a></b><br />\n";
		}
		
	$page = " $Inf <br /><br /><center><a href=\"index.php\" class=\"myButton2\">Town Square</b></a></center></blockquote></blockquote></td></tr></table>";

	display($page, $title);
}

function npc($npcid)
{
	global $userrow;
	
	$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
		$townrow = mysql_fetch_array($townquery);
	$title = "Talking to locals in ".$townrow["name"]."";
	
	if(mysql_num_rows($townquery) == 0) { display("Error!<br />You are not in a town", "Error"); die(); }
	
	$npcquery = doquery("SELECT * FROM {{table}} WHERE town='".$townrow["id"]."' AND id='".$npcid."' LIMIT 1", "npcs");
		$npcrow = mysql_fetch_array($npcquery);
	
// STARTING SELECTING THE NPC TO TALK TOO
	$Inf = "<center><h3 class=\"title\">Select a Local Villager<h3></center><table align=\"center\" height=\"647\" width=\"800\" background='images/npc/npcback/blank.png'><tr><td><blockquote><blockquote><br />
		
	<br /><br /><img align='left' src='images/".$npcrow["image"]."'><b>
".npcunescape($npcrow["name"])."<br /></b>".npcunescape($npcrow["intro"])."<br /><center>";
	
	$npcquestionnum = $npcrow["questions"];
	for($i=1;$i<=$npcquestionnum;$i++)
	{
		$Inf .= "<form name=\"npcanswer\" action=\"index.php?do=npcanswer".$i.":".$npcrow["id"]."\" method=\"post\">
		<input type=\"submit\" name=\"npcanswer\" value=\"".$npcrow["question".$i]."\">
		</form>";
	}
	$Inf .= "<br /><br /><a href=index.php?do=npclist class=\"myButton2\">Ask Another Villager</a>&nbsp; &nbsp; <a href=index.php?do=npc:".$npcid." class=\"myButton2\">Ask Another Question</a>";
		$page = " $Inf <br /><br /><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></blockquote></blockquote></td></tr></table>";

	display($page, $title);
}


// END SELECTING THE NPC TO TALK TOO
	

function npcanswer($npcid, $qid)
{

		
	global $userrow;
	
	$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	$townrow = mysql_fetch_array($townquery);
	$title = "The Local Villager Answers in ".$townrow["name"]."";
		
		
	
	$Inf = "<center><h3 class=\"title\">The Local Villager Error<h3></center><br><br>
		<b>".npcunescape($npcrow["name"])."</b>
	<br>
	<img align='left' src='images/".$npcrow["image"]."'>".npcunescape($npcrow["intro"])."<br /><center>";
	
	
	$npcquery = doquery("SELECT * FROM {{table}} WHERE town='".$townrow["id"]."' AND id='".$npcid."' LIMIT 1", "npcs");
		$npcrow = mysql_fetch_array($npcquery);
	
	if(mysql_num_rows($npcquery) == 0) { display("Error!<br />Either you are not in a town, or your trying to talk with a NPC that doesn't exist", "Error"); die(); }
	
	$Inf = "<center><h3 class=\"title\">The Local Villager Answers<h3></center><table align=\"center\" height=\"647\" width=\"800\" background='images/npc/npcback/blank.png'><tr><td><blockquote><blockquote><br /><br /><br /><img align='left' src='images/".$npcrow["image"]."'>
	<br />
	<b>".npcunescape($npcrow["name"])."</b>
	<br /><br />
	".npcunescape($npcrow["answer".$qid.""])."<br /><blockquote><a href=index.php?do=npc:".$npcid." class=\"myButton2\">Ask Another Question</a>&nbsp; &nbsp; <a href=index.php?do=npclist class=\"myButton2\">Ask Another Villager</a>";
	
	$page = " $Inf <br /><br /><center><a href=\"index.php\" class=\"myButton2\">Town Square</a></center></blockquote></blockquote></td></tr></table>";
	
	display($page, $title);
}

function npcunescape($d)
{
    $d = str_replace("&lt;","<",$d);
    $d = str_replace("&gt;",">",$d);
    return $d;
}

?>