<?php  // available quests script
if (file_exists('quest_install.php')) { die("Please delete <b>quest_install.php</b> from your Dragon Knight directory before continuing."); }

function displayQuests()
{
	global $userrow;
	
	$townquery = doquery("SELECT id FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { display("Cheat attempt detected.<br /><br />Get a life, loser.", "ERROR"); }
	$townrow = mysql_fetch_array($townquery);

	$questsquery = "SELECT DISTINCT id, name, min_level, max_level, begin_text, reward_exp, reward_gold, reward_silver, reward_copper, drop_id ";
	$questsquery .= "FROM {{table1}} WHERE " . $userrow["level"] . " >= min_level ";
	$questsquery .= "AND " . $userrow["level"] . " <= max_level AND town_id = '" . $townrow["id"] . "' ";
	$questsquery .= "AND id NOT IN (SELECT quest_id FROM {{table2}} WHERE user_id = '" .$userrow["id"] ."') ";
	$questsquery .= "AND (pre_id = 0 OR pre_id IN (SELECT quest_id FROM {{table2}} WHERE quest_id = pre_id ";
	$questsquery .= "AND user_id = '" . $userrow["id"] . "' AND STATUS = '1'))";

	$result = doquery2($questsquery, "quests", "questprogress");
	$rows = mysql_num_rows($result);
	$page = "<table width=\"100%\"><tr><td><center><h3 class=\"title\">Available Quests</h3></center><br /></td></tr>\n";
	$page .= "<tr><td><br /><br /><center><table width=\"500\"><tr><td>";
	if ($rows == 0)
	{
		$page .= "There are no available quests at the moment.  Try back later.<br /><br />";
		//$page .= "<a href=\"index.php\">Back to Town</a>";
	}
	else
	{
		$i=0;
		$page .= "<ul>";
		while($i < $rows)
		{
			$name = mysql_result($result,$i,"name");
			$id = mysql_result($result,$i,"id");
			$page .= "<li><a href=\"index.php?do=viewquest&id=" . $id . "\">" . $name . "</a></li>";
			$i++;
		}
		$page .= "</ul>";
	}
	$page .= "</td></tr></table></center><br /><center><a href='index.php' class='myButton2'>Town Square</a></center></td></tr></table>";
	$title = "Quests";
	display($page,$title);
}

function viewQuest()
{
	global $userrow;

	// make sure an id was passed in
	if (!isset($_GET["id"])) {
		display("<table width=\"100%\"><tr><td>No id passed in!</td.</tr></table>","ERROR");
		die();
	}

	$questid = explode(":",$_GET["id"]);
	$id = $questid[0];

	// make sure id passed in is valid
	if (isNaN($id))
	{
		display("<table width=\"100%\"><tr><td>Invalid quest id!</td></tr></table>","ERROR");
		die();
	}
	
	// make sure player is in town and get town info to use later
	$townquery = doquery("SELECT id FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { 
		display("<table width=\"100%\"><tr><td>Cheat attempt detected.<br /><br />Get a life, loser.</td></tr></table>", "ERROR");
		die();
	}
	$townrow = mysql_fetch_array($townquery);

	// retrieve quest info.  only retrieve it if the player is in the town where the quest is available and the is eligible for the quest.
	//$questquery = doquery("SELECT * from {{table}} where id = " . $id,"quests");
	$questquery = "SELECT DISTINCT id, name, min_level, max_level, begin_text, reward_exp, reward_gold, reward_silver, reward_copper, drop_id ";
	$questquery .= "FROM {{table1}} WHERE id = " . $id . " AND " . $userrow["level"] . " >= min_level ";
	$questquery .= "AND " . $userrow["level"] . " <= max_level AND town_id = '" . $townrow["id"] . "' ";
	$questquery .= "AND id NOT IN (SELECT quest_id FROM {{table2}} WHERE user_id = '" .$userrow["id"] ."') ";
	$questquery .= "AND (pre_id = 0 OR pre_id IN (SELECT quest_id FROM {{table2}} WHERE quest_id = pre_id ";
	$questquery .= "AND user_id = '" . $userrow["id"] . "' AND STATUS = '1'))";

	$result = doquery2($questquery, "quests", "questprogress");
	$rows = mysql_num_rows($result);
	if (mysql_num_rows($result) != 1) { 
		display("<table width=\"100%\"><tr><td>Quest info not found!</td></tr></table>","Error");
		die();
	}

	$title = "Quest Details";
	$name = mysql_result($result,0,"name");
	$text = mysql_result($result,0,"begin_text");
	$rewardexp = mysql_result($result,0,"reward_exp");
	$rewardgold = mysql_result($result,0,"reward_gold");
	$rewardsilver = mysql_result($result,0,"reward_silver");
	$rewardcopper = mysql_result($result,0,"reward_copper");
	$dropid = mysql_result($result,0,"drop_id");
	$dropname = "";
	$dropbonus1 = "";
	$dropbonus2 = "";
	$dropinfo = "";
	if ($dropid != 0)
	{
		$dropquery = doquery("SELECT * FROM {{table}} WHERE id = '" . $dropid . "'","drops");
		$droprow = mysql_fetch_array($dropquery);
		
		$attributearray = array("maxhp"=>"Max HP",
                            "maxmp"=>"Max MP",
                            "maxtp"=>"Max TP",
                            "defensepower"=>"Defense Power",
                            "attackpower"=>"Attack Power",
                            "strength"=>"Strength",
                            "dexterity"=>"Dexterity",
                            "expbonus"=>"Experience Bonus",
                            "goldbonus"=>"Gold Bonus",
                            "silverbonus"=>"Silver Bonus",
                            "copperbonus"=>"Copper Bonus");


		$attribute1 = explode(",",$droprow["attribute1"]);
    		$dropbonus1 = $attributearray[$attribute1[0]];
   		if ($attribute1[1] > 0) { $dropbonus1 .= " +" . $attribute1[1]; } else { $dropbonus1 .= $attribute1[1]; }
		if ($droprow["attribute2"] != "X") { 
        		$attribute2 = explode(",",$droprow["attribute2"]);
        		$dropbonus2 = $attributearray[$attribute2[0]];
        		if ($attribute2[1] > 0) { $dropbonus2 .= " +" . $attribute2[1]; } else { $dropbonus2 .= $attribute2[1]; }
    		}		
		$dropname = $droprow["name"];

		$dropinfo = $droprow["name"] . ": " . $dropbonus1;
		if ($dropbonus2 != "")
		{
			$dropinfo .= ", ".$dropbonus2;
		}
	}

	$pagearray = array();
	$pagearray["questname"] = $name;
	$pagearray["questtext"] = nl2br($text);
	$pagearray["rewardexp"] = $rewardexp;
	$pagearray["rewardgold"] = $rewardgold;
	$pagearray["rewardsilver"] = $rewardsilver;
	$pagearray["rewardcopper"] = $rewardcopper;
	if ($dropinfo == "") { $dropinfo = "None"; }
	$pagearray["dropinfo"] = $dropinfo;
	$pagearray["questid"] = $id;

	// Finalize page and display it.
   	$template = gettemplate("viewquest");
    	$page = parsetemplate($template,$pagearray);
		

	display($page,$title);


}

function acceptQuest()
{

	global $userrow;

	// make sure an id was passed in
	if (!isset($_GET["id"])) {
		display("<table width=\"100%\"><tr><td>No id passed in!</td.</tr></table>","ERROR");
		die();
	}

	$questid = explode(":",$_GET["id"]);
	$id = $questid[0];

	// make sure id passed in is valid
	if (isNaN($id))
	{
		display("<table width=\"100%\"><tr><td>Invalid quest id!</td></tr></table>","ERROR");
		die();
	}
	
	// make sure player is in town and get town info to use later
	$townquery = doquery("SELECT id FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) != 1) { 
		display("<table width=\"100%\"><tr><td>Cheat attempt detected.<br /><br />Get a life, loser.</td></tr></table>", "ERROR");
		die();
	}
	$townrow = mysql_fetch_array($townquery);

	// retrieve quest info.  only retrieve it if the player is in the town where the quest is available and the is eligible for the quest.
	//$questquery = doquery("SELECT * from {{table}} where id = " . $id,"quests");
	$questquery = "SELECT DISTINCT id, objective_lat, objective_long ";
	$questquery .= "FROM {{table1}} WHERE id = " . $id . " AND " . $userrow["level"] . " >= min_level ";
	$questquery .= "AND " . $userrow["level"] . " <= max_level AND town_id = '" . $townrow["id"] . "' ";
	$questquery .= "AND id NOT IN (SELECT quest_id FROM {{table2}} WHERE user_id = '" .$userrow["id"] ."') ";
	$questquery .= "AND (pre_id = 0 OR pre_id IN (SELECT quest_id FROM {{table2}} WHERE quest_id = pre_id ";
	$questquery .= "AND user_id = '" . $userrow["id"] . "' AND STATUS = '1'))";
	$result = doquery2($questquery, "quests", "questprogress");
	$rows = mysql_num_rows($result);
	if (mysql_num_rows($result) != 1) { 
		display("<table width=\"100%\"><tr><td>You can not accept this quest right now.</td></tr></table>","Error");
		die();
	}

	// everything appears valid, insert the record
	$user_id = $userrow["id"];
	$quest_id = $id;
	$quest_lat = mysql_result($result,0,"objective_lat");
	$quest_long = mysql_result($result,0,"objective_long");
	

	$query = doquery("INSERT INTO {{table}} SET id='',user_id='".$user_id."',quest_id='".$quest_id."',status='0',latitude='".$quest_lat."',longitude='".$quest_long."'", "questprogress") or die(mysql_error());

	$page = "<table width=\"100%\"><tr><td><h3 class=\"title\">Available Quests</h3></td></tr></table>";
	$page .= "<br /><br /><center><table width=\"500\"><tr><td>";
	$page .= "You have accepted the quest, and it has been added to your quest log.<br /><br />";
	$page .= "You may now return to the <a href=\"index.php\" class=\"myButton2\">Town Square</a> or go back to the <a href=\"index.php?do=getquests\" class=\"myButton2\">Quest List</a>";
	$page .= "</td></tr></table></center>";
	display($page,"Quest Accepted");

}


?>
