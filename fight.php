<?php // fight.php :: Handles all fighting action.

function fight() { // One big long function that determines the outcome of the fight.
    
    global $userrow, $controlrow;
    if ($userrow["currentaction"] != "Fighting") { display("Cheat XX attempt detected.<br /><br />Get a life, loser.", "Error"); }
    $pagearray = array();
    $playerisdead = 0;
    
    $pagearray["magiclist"] = "";
    $userspells = explode(",",$userrow["spells"]);
    $spellquery = doquery("SELECT id,name FROM {{table}}", "spells");
    while ($spellrow = mysql_fetch_array($spellquery)) {
        $spell = false;
        foreach ($userspells as $a => $b) {
            if ($b == $spellrow["id"]) { $spell = true; }
        }
        if ($spell == true) {
            $pagearray["magiclist"] .= "<option value=\"".$spellrow["id"]."\">".$spellrow["name"]."</option>\n";
        }
        unset($spell);
    }
    if ($pagearray["magiclist"] == "") { $pagearray["magiclist"] = "<option value=\"0\">None</option>\n"; }
    $magiclist = $pagearray["magiclist"];
    
    $chancetoswingfirst = 1;

    // First, check to see if we need to pick a monster.
    if ($userrow["currentfight"] == 1) {
        
        if ($userrow["latitude"] < 0) { $userrow["latitude"] *= -1; } // Equalize negatives.
        if ($userrow["longitude"] < 0) { $userrow["longitude"] *= -1; } // Ditto.
        $maxlevel = floor(max($userrow["latitude"]+5, $userrow["longitude"]+5) / 5); // One mlevel per five spaces.
        if ($maxlevel < 1) { $maxlevel = 1; }
        $minlevel = $maxlevel - 2;
        if ($minlevel < 1) { $minlevel = 1; }
        
        // Pick a monster.
        $monsterquery = doquery("SELECT * FROM {{table}} WHERE level>='$minlevel' AND level<='$maxlevel' ORDER BY RAND() LIMIT 1", "monsters");
        $monsterrow = mysql_fetch_array($monsterquery);
        $userrow["currentmonster"] = $monsterrow["id"];
        $userrow["currentmonsterhp"] = rand((($monsterrow["maxhp"]/5)*4),$monsterrow["maxhp"]);
        if ($userrow["difficulty"] == 2) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff2mod"]); }
        if ($userrow["difficulty"] == 3) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff3mod"]); }
        if ($userrow["difficulty"] == 4) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff4mod"]); }
        if ($userrow["difficulty"] == 5) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff5mod"]); }
        if ($userrow["difficulty"] == 6) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff6mod"]); }
        if ($userrow["difficulty"] == 7) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff7mod"]); }
        if ($userrow["difficulty"] == 8) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff8mod"]); }
        if ($userrow["difficulty"] == 9) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff9mod"]); }
        if ($userrow["difficulty"] == 10) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff10mod"]); }
        if ($userrow["difficulty"] == 11) { $userrow["currentmonsterhp"] = ceil($userrow["currentmonsterhp"] * $controlrow["diff11mod"]); }
        $userrow["currentmonstersleep"] = 0;
        $userrow["currentmonsterimmune"] = $monsterrow["immune"];
        
        $chancetoswingfirst = rand(1,10) + ceil(sqrt($userrow["dexterity"]));
        if ($chancetoswingfirst > (rand(1,7) + ceil(sqrt($monsterrow["maxdam"])))) { $chancetoswingfirst = 1; } else { $chancetoswingfirst = 0; }
        
        unset($monsterquery);
        unset($monsterrow);
    }
    
    // Next, get the monster statistics.
    $monsterquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["currentmonster"]."' LIMIT 1", "monsters");
    $monsterrow = mysql_fetch_array($monsterquery);
    $pagearray["monstername"] = $monsterrow["name"];
	
$monster_duskwood = $monsterrow['name'];
	$dwood_monsterid = $monsterrow['id'];
	if($monsterrow['seenby']==0){
		doquery("UPDATE {{table}} SET seenby = '".$userrow['id']."' WHERE id = '".$dwood_monsterid."'","monsters");
		$seennew = true;
	}
    $monster_duskwood = '<b><a href="javascript:openwiki('.$dwood_monsterid.')">'.$monster_duskwood.'</a></b>';
    
    // Do run stuff.
    if (isset($_POST["run"])) {

        $chancetorun = rand(4,10) + ceil(sqrt($userrow["dexterity"]));
        if ($chancetorun > (rand(1,5) + ceil(sqrt($monsterrow["maxdam"])))) { $chancetorun = 1; } else { $chancetorun = 0; }
        
        if ($chancetorun == 0) { 
            $pagearray["yourturn"] = "You tried to run away, but were blocked by the monster!<br /><br />";
            $pagearray["monsterhp"] = "Monster's HP: " . $userrow["currentmonsterhp"] . "<br /><br />";
            $pagearray["monsterturn"] = "";
            if ($userrow["currentmonstersleep"] != 0) { // Check to wake up.
                $chancetowake = rand(1,15);
                if ($chancetowake > $userrow["currentmonstersleep"]) {
                    $userrow["currentmonstersleep"] = 0;
                    $pagearray["monsterturn"] .= "$monster_duskwood has woken up and ready for battle.<br />";
                } else {
                    $pagearray["monsterturn"] .= "$monster_duskwood is still asleep.<br />";
                }
            }
            if ($userrow["currentmonstersleep"] == 0) { // Only do this if the monster is awake.
                $tohit = ceil(rand($monsterrow["maxdam"]*.5,$monsterrow["maxdam"]));
                if ($userrow["difficulty"] == 2) { $tohit = ceil($tohit * $controlrow["diff2mod"]); }
                if ($userrow["difficulty"] == 3) { $tohit = ceil($tohit * $controlrow["diff3mod"]); }
                if ($userrow["difficulty"] == 4) { $tohit = ceil($tohit * $controlrow["diff4mod"]); }
                if ($userrow["difficulty"] == 5) { $tohit = ceil($tohit * $controlrow["diff5mod"]); }
                if ($userrow["difficulty"] == 6) { $tohit = ceil($tohit * $controlrow["diff6mod"]); }
                if ($userrow["difficulty"] == 7) { $tohit = ceil($tohit * $controlrow["diff7mod"]); }
                if ($userrow["difficulty"] == 8) { $tohit = ceil($tohit * $controlrow["diff8mod"]); }
                if ($userrow["difficulty"] == 9) { $tohit = ceil($tohit * $controlrow["diff9mod"]); }
                if ($userrow["difficulty"] == 10) { $tohit = ceil($tohit * $controlrow["diff10mod"]); }
                if ($userrow["difficulty"] == 11) { $tohit = ceil($tohit * $controlrow["diff11mod"]); }
                $toblock = ceil(rand($userrow["defensepower"]*.75,$userrow["defensepower"])/4);
                $tododge = rand(1,125);
                if ($tododge <= sqrt($userrow["dexterity"])) {
                    $tohit = 0; $pagearray["monsterturn"] .= "You dodge $monster_duskwood attack. No hit damage has been made on you.<br />";
                    $persondamage = 0;
                } else {
                    $persondamage = $tohit - $toblock;
                    if ($persondamage < 1) { $persondamage = 1; }
                    if ($userrow["currentuberdefense"] != 0) {
                        $persondamage -= ceil($persondamage * ($userrow["currentuberdefense"]/100));
                    }
                    if ($persondamage < 1) { $persondamage = 1; }
                }
                $pagearray["monsterturn"] .= "The Monster attacks you for $persondamage damage.<br /><br />";
                $userrow["currenthp"] -= $persondamage;
                if ($userrow["currenthp"] <= 0) {
                    $newgold = ceil($userrow["gold"]/2);
                    $newsilver = ceil($userrow["silver"]/2);
                    $newcopper = ceil($userrow["copper"]/2);
                    $newhp = ceil($userrow["maxhp"]/4);
    				$newnumdeaths = $userrow["numdeaths"] + 1;
                    $updatequery = doquery("UPDATE {{table}} SET currenthp='$newhp',currentaction='In Town', currentmonster='0', currentmonsterhp='0',currentmonstersleep='0', currentmonsterimmune='0' , currentfight='0', latitude='0', longitude='0', gold='$newgold', numdeaths='$newnumdeaths', kills='$kills', silver='$newsilver', copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
                    $playerisdead = 1;
                }
            }
        }

        $updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        header("Location: index.php");
        die();
        
    // Do fight stuff.
    } elseif (isset($_POST["fight"])) {
        
        // Your turn.
        $pagearray["yourturn"] = "";		
        $tohit = ceil(rand($userrow["attackpower"]*.75,$userrow["attackpower"])/3);
        $toexcellent = rand(1,100);
        if ($toexcellent <= sqrt($userrow["strength"])) { $tohit *= 2; $pagearray["yourturn"] .= "Excellent hit!<br />"; }
        $toblock = ceil(rand($monsterrow["armor"]*.75,$monsterrow["armor"])/3);        
        $tododge = rand(1,150);
        if ($tododge <= sqrt($monsterrow["armor"])) { 
            $tohit = 0; $pagearray["yourturn"] .= "The monster is dodging your attack. No damage has been made to the monster.<br />"; 
            $monsterdamage = 0;
        } else {
            $monsterdamage = $tohit - $toblock;
            if ($monsterdamage < 1) { $monsterdamage = 1; }
            if ($userrow["currentuberdamage"] != 0) {
                $monsterdamage += ceil($monsterdamage * ($userrow["currentuberdamage"]/100));
            }
        }
        $pagearray["yourturn"] .= "You attack <font color=\"#0000FF\">the monster for $monsterdamage Hitpoints of damage.</font><br />";
        $userrow["currentmonsterhp"] -= $monsterdamage;
        $pagearray["monsterhp"] = "Monster's HP: " . $userrow["currentmonsterhp"] . "<br /><br />";
        if ($userrow["currentmonsterhp"] <= 0) {
            $updatequery = doquery("UPDATE {{table}} SET currentmonsterhp='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            header("Location: index.php?do=victory");
            die();
        }
        
        // Monster's turn.
        $pagearray["monsterturn"] = "";
        if ($userrow["currentmonstersleep"] != 0) { // Check to wake up.
            $chancetowake = rand(1,15);
            if ($chancetowake > $userrow["currentmonstersleep"]) {
                $userrow["currentmonstersleep"] = 0;
                $pagearray["monsterturn"] .= "$monster_duskwood has woken up and ready for battle.<br />";
            } else {
                $pagearray["monsterturn"] .= "$monster_duskwood is still asleep.<br />";
            }
        }
        if ($userrow["currentmonstersleep"] == 0) { // Only do this if the monster is awake.
            $tohit = ceil(rand($monsterrow["maxdam"]*.5,$monsterrow["maxdam"]));
            if ($userrow["difficulty"] == 2) { $tohit = ceil($tohit * $controlrow["diff2mod"]); }
            if ($userrow["difficulty"] == 3) { $tohit = ceil($tohit * $controlrow["diff3mod"]); }
            if ($userrow["difficulty"] == 4) { $tohit = ceil($tohit * $controlrow["diff4mod"]); }
            if ($userrow["difficulty"] == 5) { $tohit = ceil($tohit * $controlrow["diff5mod"]); }
            if ($userrow["difficulty"] == 6) { $tohit = ceil($tohit * $controlrow["diff6mod"]); }
            if ($userrow["difficulty"] == 7) { $tohit = ceil($tohit * $controlrow["diff7mod"]); }
            if ($userrow["difficulty"] == 8) { $tohit = ceil($tohit * $controlrow["diff8mod"]); }
            if ($userrow["difficulty"] == 9) { $tohit = ceil($tohit * $controlrow["diff9mod"]); }
            if ($userrow["difficulty"] == 10) { $tohit = ceil($tohit * $controlrow["diff10mod"]); }
            if ($userrow["difficulty"] == 11) { $tohit = ceil($tohit * $controlrow["diff11mod"]); }
            $toblock = ceil(rand($userrow["defensepower"]*.75,$userrow["defensepower"])/4);
            $tododge = rand(1,150);
            if ($tododge <= sqrt($userrow["dexterity"])) {
                $tohit = 0; $pagearray["monsterturn"] .= "You dodge the monsters attack. <font color=\"#008000\">No damage has been made.</font><br />";
                $persondamage = 0;
            } else {
                $persondamage = $tohit - $toblock;
                if ($persondamage < 1) { $persondamage = 1; }
                if ($userrow["currentuberdefense"] != 0) {
                    $persondamage -= ceil($persondamage * ($userrow["currentuberdefense"]/100));
                }
                if ($persondamage < 1) { $persondamage = 1; }
            }
            $pagearray["monsterturn"] .= "The monster <font color=\"#008000\">attacks you for $persondamage damage.</font><br /><br />";
            $userrow["currenthp"] -= $persondamage;
            if ($userrow["currenthp"] <= 0) {
                    $newgold = ceil($userrow["gold"]/2);
                    $newsilver = ceil($userrow["silver"]/2);
                    $newcopper = ceil($userrow["copper"]/2);
                    $newhp = ceil($userrow["maxhp"]/4);
    				$newnumdeaths = $userrow["numdeaths"] + 1;
    				$newkills = $userrow["kills"] + 1;
                    $updatequery = doquery("UPDATE {{table}} SET currenthp='$newhp',currentaction='In Town', currentmonster='0', currentmonsterhp='0',currentmonstersleep='0', currentmonsterimmune='0' , currentfight='0', latitude='0', longitude='0', gold='$newgold', numdeaths='$newnumdeaths', kills='$kills', silver='$newsilver', copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
                $playerisdead = 1;
            }
        }
        
    // Do spell stuff.
    } elseif (isset($_POST["spell"])) {
        
        // Your turn.
        $pickedspell = $_POST["userspell"];
        if ($pickedspell == 0) { display("You must select a spell first. Please go back and try again.", "Error"); die(); }
        
        $newspellquery = doquery("SELECT * FROM {{table}} WHERE id='$pickedspell' LIMIT 1", "spells");
        $newspellrow = mysql_fetch_array($newspellquery);
        $spell = false;
        foreach($userspells as $a => $b) {
            if ($b == $pickedspell) { $spell = true; }
        }
        if ($spell != true) { display("You have not learned this spell. Please go back and try again.", "Error"); die(); }
        if ($userrow["currentmp"] < $newspellrow["mp"]) { display("You do not have enough Magic Points to cast this spell. Please go back and try again.", "Error"); die(); }
        
        if ($newspellrow["type"] == 1) { // Heal spell.
            $newhp = $userrow["currenthp"] + $newspellrow["attribute"];
            if ($userrow["maxhp"] < $newhp) { $newspellrow["attribute"] = $userrow["maxhp"] - $userrow["currenthp"]; $newhp = $userrow["currenthp"] + $newspellrow["attribute"]; }
            $userrow["currenthp"] = $newhp;
            $userrow["currentmp"] -= $newspellrow["mp"];
            $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." spell, and gained ".$newspellrow["attribute"]." Hit Points.<br /><br />";
        } elseif ($newspellrow["type"] == 2) { // Hurt spell.
            if ($userrow["currentmonsterimmune"] == 0) {
                $monsterdamage = rand((($newspellrow["attribute"]/6)*5), $newspellrow["attribute"]);
                $userrow["currentmonsterhp"] -= $monsterdamage;
                $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." <font color=\"#0000FF\">Spell for $monsterdamage damage.</font><br /><br />";
            } else {
                $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." <font color=\"#0000FF\">Spell, but the monster is immune to it.</font><br /><br />";
            }
            $userrow["currentmp"] -= $newspellrow["mp"];
        } elseif ($newspellrow["type"] == 3) { // Sleep spell.
            if ($userrow["currentmonsterimmune"] != 2) {
                $userrow["currentmonstersleep"] = $newspellrow["attribute"];
                $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." spell. The monster is asleep.<br /><br />";
            } else {
                $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." spell, but the monster is immune to it.<br /><br />";
            }
            $userrow["currentmp"] -= $newspellrow["mp"];
        } elseif ($newspellrow["type"] == 4) { // +Damage spell.
            $userrow["currentuberdamage"] = $newspellrow["attribute"];
            $userrow["currentmp"] -= $newspellrow["mp"];
            $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." spell, and will gain ".$newspellrow["attribute"]."% damage until the end of this fight.<br /><br />";
        } elseif ($newspellrow["type"] == 5) { // +Defense spell.
            $userrow["currentuberdefense"] = $newspellrow["attribute"];
            $userrow["currentmp"] -= $newspellrow["mp"];
            $pagearray["yourturn"] = "You have cast the ".$newspellrow["name"]." spell, and will gain ".$newspellrow["attribute"]."% defense until the end of this fight.<br /><br />";            
        }
            
        $pagearray["monsterhp"] = "Monster's HP: " . $userrow["currentmonsterhp"] . "<br /><br />";
        if ($userrow["currentmonsterhp"] <= 0) {
            $updatequery = doquery("UPDATE {{table}} SET currentmonsterhp='0',currenthp='".$userrow["currenthp"]."',currentmp='".$userrow["currentmp"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            header("Location: index.php?do=victory");
            die();
        }
        
        // Monster's turn.
        $pagearray["monsterturn"] = "";
        if ($userrow["currentmonstersleep"] != 0) { // Check to wake up.
            $chancetowake = rand(1,15);
            if ($chancetowake > $userrow["currentmonstersleep"]) {
                $userrow["currentmonstersleep"] = 0;
                $pagearray["monsterturn"] .= "The monster has woken up and is ready for battle.<br />";
            } else {
                $pagearray["monsterturn"] .= "The monster is still asleep.<br />";
            }
        }
        if ($userrow["currentmonstersleep"] == 0) { // Only do this if the monster is awake.
            $tohit = ceil(rand($monsterrow["maxdam"]*.5,$monsterrow["maxdam"]));
            if ($userrow["difficulty"] == 2) { $tohit = ceil($tohit * $controlrow["diff2mod"]); }
            if ($userrow["difficulty"] == 3) { $tohit = ceil($tohit * $controlrow["diff3mod"]); }
            if ($userrow["difficulty"] == 4) { $tohit = ceil($tohit * $controlrow["diff4mod"]); }
            if ($userrow["difficulty"] == 5) { $tohit = ceil($tohit * $controlrow["diff5mod"]); }
            if ($userrow["difficulty"] == 6) { $tohit = ceil($tohit * $controlrow["diff6mod"]); }
            if ($userrow["difficulty"] == 7) { $tohit = ceil($tohit * $controlrow["diff7mod"]); }
            if ($userrow["difficulty"] == 8) { $tohit = ceil($tohit * $controlrow["diff8mod"]); }
            if ($userrow["difficulty"] == 9) { $tohit = ceil($tohit * $controlrow["diff9mod"]); }
            if ($userrow["difficulty"] == 10) { $tohit = ceil($tohit * $controlrow["diff10mod"]); }
            if ($userrow["difficulty"] == 11) { $tohit = ceil($tohit * $controlrow["diff11mod"]); }
            $toblock = ceil(rand($userrow["defensepower"]*.75,$userrow["defensepower"])/4);
            $tododge = rand(1,125);
            if ($tododge <= sqrt($userrow["dexterity"])) {
                $tohit = 0; $pagearray["monsterturn"] .= "You dodge $monster_duskwood attack. No damage has been scored.<br />";
                $persondamage = 0;
            } else {
                if ($tohit <= $toblock) { $tohit = $toblock + 1; }
                $persondamage = $tohit - $toblock;
                if ($userrow["currentuberdefense"] != 0) {
                    $persondamage -= ceil($persondamage * ($userrow["currentuberdefense"]/100));
                }
                if ($persondamage < 1) { $persondamage = 1; }
            }
            $pagearray["monsterturn"] .= "The monster attacks you for $persondamage damage.<br /><br />";
            $userrow["currenthp"] -= $persondamage;
            if ($userrow["currenthp"] <= 0) {
                    $newgold = ceil($userrow["gold"]/2);
                    $newsilver = ceil($userrow["silver"]/2);
                    $newcopper = ceil($userrow["copper"]/2);
                    $newhp = ceil($userrow["maxhp"]/4);
    				$newnumdeaths = $userrow["numdeaths"] + 1;
                    $updatequery = doquery("UPDATE {{table}} SET currenthp='$newhp',currentaction='In Town', currentmonster='0', currentmonsterhp='0',currentmonstersleep='0', currentmonsterimmune='0' , currentfight='0', latitude='0', longitude='0', gold='$newgold', numdeaths='$newnumdeaths', kills='$kills', silver='$newsilver', copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
                $playerisdead = 1;
            }
        }
    
    // Do a monster's turn if person lost the chance to swing first. Serves him right!
    } elseif ( $chancetoswingfirst == 0 ) {
        $pagearray["yourturn"] = "The Monster attacks before you are ready!<br /><br />";
        $pagearray["monsterhp"] = "Monster's HP: " . $userrow["currentmonsterhp"] . "<br /><br />";
        $pagearray["monsterturn"] = "";
        if ($userrow["currentmonstersleep"] != 0) { // Check to wake up.
            $chancetowake = rand(1,15);
            if ($chancetowake > $userrow["currentmonstersleep"]) {
                $userrow["currentmonstersleep"] = 0;
                $pagearray["monsterturn"] .= "$monster_duskwood has woken up.<br />";
            } else {
                $pagearray["monsterturn"] .= "$monster_duskwood is still asleep.<br />";
            }
        }
        if ($userrow["currentmonstersleep"] == 0) { // Only do this if the monster is awake.
            $tohit = ceil(rand($monsterrow["maxdam"]*.5,$monsterrow["maxdam"]));
            if ($userrow["difficulty"] == 2) { $tohit = ceil($tohit * $controlrow["diff2mod"]); }
            if ($userrow["difficulty"] == 3) { $tohit = ceil($tohit * $controlrow["diff3mod"]); }
            if ($userrow["difficulty"] == 4) { $tohit = ceil($tohit * $controlrow["diff4mod"]); }
            if ($userrow["difficulty"] == 5) { $tohit = ceil($tohit * $controlrow["diff5mod"]); }
            if ($userrow["difficulty"] == 6) { $tohit = ceil($tohit * $controlrow["diff6mod"]); }
            if ($userrow["difficulty"] == 7) { $tohit = ceil($tohit * $controlrow["diff7mod"]); }
            if ($userrow["difficulty"] == 8) { $tohit = ceil($tohit * $controlrow["diff8mod"]); }
            if ($userrow["difficulty"] == 9) { $tohit = ceil($tohit * $controlrow["diff9mod"]); }
            if ($userrow["difficulty"] == 10) { $tohit = ceil($tohit * $controlrow["diff10mod"]); }
            if ($userrow["difficulty"] == 11) { $tohit = ceil($tohit * $controlrow["diff11mod"]); }
            $toblock = ceil(rand($userrow["defensepower"]*.75,$userrow["defensepower"])/4);
            $tododge = rand(1,125);
            if ($tododge <= sqrt($userrow["dexterity"])) {
                $tohit = 0; $pagearray["monsterturn"] .= "You dodge $monster_duskwood attack. No damage has been made.<br />";
                $persondamage = 0;
            } else {
                $persondamage = $tohit - $toblock;
                if ($persondamage < 1) { $persondamage = 1; }
                if ($userrow["currentuberdefense"] != 0) {
                    $persondamage -= ceil($persondamage * ($userrow["currentuberdefense"]/100));
                }
                if ($persondamage < 1) { $persondamage = 1; }
            }
            $pagearray["monsterturn"] .= "The monster attacks you for $persondamage damage.<br /><br />";
            $userrow["currenthp"] -= $persondamage;
            if ($userrow["currenthp"] <= 0) {
                    $newgold = ceil($userrow["gold"]/2);
                    $newsilver = ceil($userrow["silver"]/2);
                    $newcopper = ceil($userrow["copper"]/2);
                    $newhp = ceil($userrow["maxhp"]/4);
    				$newnumdeaths = $userrow["numdeaths"] + 1;
                    $updatequery = doquery("UPDATE {{table}} SET currenthp='$newhp',currentaction='In Town', currentmonster='0', currentmonsterhp='0',currentmonstersleep='0', currentmonsterimmune='0' , currentfight='0', latitude='0', longitude='0', gold='$newgold', numdeaths='$newnumdeaths', kills='$kills', silver='$newsilver', copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
                $playerisdead = 1;
            }
        }

    } else {
$pagearray["monsterimg"] = "<img src=\"images/monsters/".$userrow["currentmonster"].".png\" />";
$pagearray["yourturn"] = "";
$pagearray["monsterhp"] = "Monster's HP: " . $userrow["currentmonsterhp"] . "<br /><br />";
$pagearray["monsterturn"] = "";
    }
    
    $newmonster = $userrow["currentmonster"];
    $newmonsterhp = $userrow["currentmonsterhp"];
    $newmonstersleep = $userrow["currentmonstersleep"];
    $newmonsterimmune = $userrow["currentmonsterimmune"];
    $newuberdamage = $userrow["currentuberdamage"];
    $newuberdefense = $userrow["currentuberdefense"];
    $newfight = $userrow["currentfight"] + 1;
    $newhp = $userrow["currenthp"];
    $newmp = $userrow["currentmp"];
	$totalfights = $userrow["totalfights"] + 1;     
    
if ($playerisdead != 1) { 
$pagearray["command"] = <<<END
<form action="index.php?do=fight" method="post">
Command? &nbsp;&nbsp;<input type="submit" name="fight" value="Fight" class="myButton2">&nbsp;&nbsp;<select name="userspell"><option value="0">Choose Spell</option>$magiclist</select>&nbsp;&nbsp;<input type="submit" name="spell" value="Do Spell" class="myButton2">&nbsp;&nbsp;<input type="submit" name="run" value="Run" class="myButton2"></form><br /><br />
END;
    $updatequery = doquery("UPDATE {{table}} SET currentaction='Fighting',currenthp='$newhp',currentmp='$newmp',currentfight='$newfight',currentmonster='$newmonster',currentmonsterhp='$newmonsterhp',currentmonstersleep='$newmonstersleep',currentmonsterimmune='$newmonsterimmune',currentuberdamage='$newuberdamage',currentuberdefense='$newuberdefense',totalfights='$totalfights' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
} else {
	$deaths = $userrow["deaths"] + 1;  
	$updatequery = doquery("UPDATE {{table}} SET deaths='$deaths' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

    $pagearray["command"] = "<table width=\"100\"><tr><td>You have died</td></tr></table><br /><br />
	<div align=\"center\"><table width=\"700\"><tr><td width=\"15%\"><div align=\"center\"><IMG src=\"images/items/random/playerghost-1.png\"></div></td><td width=\"70%\"><br /><br />As a consequence, you've lost half of your gold. However, you have been given back a small portion of your hit points to continue your journey.<br /><br />We hope you fair better next time, and remember you can only died ten times before you end up in the Graveyard Forever. You may now continue. <br /><br /><div align=\"center\"><a href=\"index.php\" class=\"myButton2\">The Town Square</a></div></td><td width=\"15%\"><div align=\"center\"><IMG src=\"images/items/random/playerghost-2.png\"></div></td></tr></table></div><br /><br />";
}


$pagearray["monsterimg"] = "<a href=\"javascript:openwiki('.$dwood_monsterid.')\"><img src=\"images/monsters/".$userrow["currentmonster"].".png\" /></a>";

    if($seennew){
	$pagearray["newmonster"] = "You explored a new monster named ".$monster_duskwood." !";
	}else{
	$pagearray["newmonster"] = "";
	}

// Finalize page and display it.
$template = gettemplate("fight");
$page = parsetemplate($template,$pagearray);

display($page, "Fighting");
  }

function victory() {
    
    global $userrow, $controlrow;
    
    if ($userrow["currentmonsterhp"] != 0) { header("Location: index.php?do=fight"); die(); }
    if ($userrow["currentfight"] == 0) { header("Location: index.php"); die(); }
    
    $monsterquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["currentmonster"]."' LIMIT 1", "monsters");
    $monsterrow = mysql_fetch_array($monsterquery);
    $newnumkills = $userrow["numkills"] + 1;
    
    $exp = rand((($monsterrow["maxexp"]/6)*5),$monsterrow["maxexp"]);
    if ($exp < 1) { $exp = 1; }
    if ($userrow["difficulty"] == 2) { $exp = ceil($exp * $controlrow["diff2mod"]); }
    if ($userrow["difficulty"] == 3) { $exp = ceil($exp * $controlrow["diff3mod"]); }
    if ($userrow["difficulty"] == 4) { $exp = ceil($exp * $controlrow["diff4mod"]); }
    if ($userrow["difficulty"] == 5) { $exp = ceil($exp * $controlrow["diff5mod"]); }
    if ($userrow["difficulty"] == 6) { $exp = ceil($exp * $controlrow["diff6mod"]); }
    if ($userrow["difficulty"] == 7) { $exp = ceil($exp * $controlrow["diff7mod"]); }
    if ($userrow["difficulty"] == 8) { $exp = ceil($exp * $controlrow["diff8mod"]); }
    if ($userrow["difficulty"] == 9) { $exp = ceil($exp * $controlrow["diff9mod"]); }
    if ($userrow["difficulty"] == 10) { $exp = ceil($exp * $controlrow["diff10mod"]); }
    if ($userrow["difficulty"] == 11) { $exp = ceil($exp * $controlrow["diff11mod"]); }
    if ($userrow["expbonus"] != 0) { $exp += ceil(($userrow["expbonus"]/100)*$exp); }
	
    $gold = rand((($monsterrow["maxgold"]/6)*5),$monsterrow["maxgold"]);
    if ($gold < 1) { $gold = 1; }
    if ($userrow["difficulty"] == 2) { $gold = ceil($gold * $controlrow["diff2mod"]); }
    if ($userrow["difficulty"] == 3) { $gold = ceil($gold * $controlrow["diff3mod"]); }
    if ($userrow["difficulty"] == 4) { $gold = ceil($gold * $controlrow["diff4mod"]); }
    if ($userrow["difficulty"] == 5) { $gold = ceil($gold * $controlrow["diff5mod"]); }
    if ($userrow["difficulty"] == 6) { $gold = ceil($gold * $controlrow["diff6mod"]); }
    if ($userrow["difficulty"] == 7) { $gold = ceil($gold * $controlrow["diff7mod"]); }
    if ($userrow["difficulty"] == 8) { $gold = ceil($gold * $controlrow["diff8mod"]); }
    if ($userrow["difficulty"] == 9) { $gold = ceil($gold * $controlrow["diff9mod"]); }
    if ($userrow["difficulty"] == 10) { $gold = ceil($gold * $controlrow["diff10mod"]); }
    if ($userrow["difficulty"] == 11) { $gold = ceil($gold * $controlrow["diff11mod"]); }
	
    $silver = rand((($monsterrow["maxsilver"]/6)*5),$monsterrow["maxsilver"]);
    if ($silver < 1) { $silver = 1; }
    if ($userrow["difficulty"] == 2) { $silver = ceil($silver * $controlrow["diff2mod"]); }
    if ($userrow["difficulty"] == 3) { $silver = ceil($silver * $controlrow["diff3mod"]); }
    if ($userrow["difficulty"] == 4) { $silver = ceil($silver * $controlrow["diff4mod"]); }
    if ($userrow["difficulty"] == 5) { $silver = ceil($silver * $controlrow["diff5mod"]); }
    if ($userrow["difficulty"] == 6) { $silver = ceil($silver * $controlrow["diff6mod"]); }
    if ($userrow["difficulty"] == 7) { $silver = ceil($silver * $controlrow["diff7mod"]); }
    if ($userrow["difficulty"] == 8) { $silver = ceil($silver * $controlrow["diff8mod"]); }
    if ($userrow["difficulty"] == 9) { $silver = ceil($silver * $controlrow["diff9mod"]); }
    if ($userrow["difficulty"] == 10) { $silver = ceil($silver * $controlrow["diff10mod"]); }
    if ($userrow["difficulty"] == 11) { $silver = ceil($silver * $controlrow["diff11mod"]); }
	
    $copper = rand((($monsterrow["maxcopper"]/6)*5),$monsterrow["maxcopper"]);
    if ($copper < 1) { $copper = 1; }
    if ($userrow["difficulty"] == 2) { $copper = ceil($copper * $controlrow["diff2mod"]); }
    if ($userrow["difficulty"] == 3) { $copper = ceil($copper * $controlrow["diff3mod"]); }
    if ($userrow["difficulty"] == 4) { $copper = ceil($copper * $controlrow["diff4mod"]); }
    if ($userrow["difficulty"] == 5) { $copper = ceil($copper * $controlrow["diff5mod"]); }
    if ($userrow["difficulty"] == 6) { $copper = ceil($copper * $controlrow["diff6mod"]); }
    if ($userrow["difficulty"] == 7) { $copper = ceil($copper * $controlrow["diff7mod"]); }
    if ($userrow["difficulty"] == 8) { $copper = ceil($copper * $controlrow["diff8mod"]); }
    if ($userrow["difficulty"] == 9) { $copper = ceil($copper * $controlrow["diff9mod"]); }
    if ($userrow["difficulty"] == 10) { $copper = ceil($copper * $controlrow["diff10mod"]); }
    if ($userrow["difficulty"] == 11) { $copper = ceil($copper * $controlrow["diff11mod"]); }
	
    if ($userrow["goldbonus"] != 0) { $gold += ceil(($userrow["goldbonus"]/100)*$exp); }
    if ($userrow["silverbonus"] != 0) { $silver += ceil(($userrow["silverbonus"]/100)*$exp); }
    if ($userrow["copperbonus"] != 0) { $copper += ceil(($userrow["copperbonus"]/100)*$exp); }
	
    if ($userrow["experience"] + $exp < 900000000) { $newexp = $userrow["experience"] + $exp; $warnexp = ""; } else { $newexp = $userrow["experience"]; $exp = 0; $warnexp = "You have maxed out your experience points."; }

    if ($userrow["gold"] + $gold < 900000000) { $newgold = $userrow["gold"] + $gold; $warngold = ""; } else { $newgold = $userrow["gold"]; $gold = 0; $warngold = "You have maxed out your Gold Coins."; }

    if ($userrow["silver"] + $silver < 900000000) { $newsilver = $userrow["silver"] + $silver; $warnsilver = ""; } else { $newsilver = $userrow["silver"]; $silver = 0; $warnsilver = "You have maxed out your Silver Coins."; }

    if ($userrow["copper"] + $copper < 900000000) { $newcopper= $userrow["copper"] + $copper; $warncopper = ""; } else { $newgold = $userrow["copper"]; $copper = 0; $warncopper = "You have maxed out your Copper Coins."; }
    
    $levelquery = doquery("SELECT * FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels");
    if (mysql_num_rows($levelquery) == 1) { $levelrow = mysql_fetch_array($levelquery); }
	
    if ($userrow["level"] < 300) {
        if ($newexp >= $levelrow[$userrow["charclass"]."_exp"]) {
            $newhp = $userrow["maxhp"] + $levelrow[$userrow["charclass"]."_hp"];
            $newmp = $userrow["maxmp"] + $levelrow[$userrow["charclass"]."_mp"];
            $newtp = $userrow["maxtp"] + $levelrow[$userrow["charclass"]."_tp"];
            $newstrength = $userrow["strength"] + $levelrow[$userrow["charclass"]."_strength"];
            $newdexterity = $userrow["dexterity"] + $levelrow[$userrow["charclass"]."_dexterity"];
            $newattack = $userrow["attackpower"] + $levelrow[$userrow["charclass"]."_strength"];
            $newdefense = $userrow["defensepower"] + $levelrow[$userrow["charclass"]."_dexterity"];
            $newlevel = $levelrow["id"];
            $updatequery = doquery("UPDATE {{table}} SET skills=skills+4 WHERE id='".$userrow["id"]."' LIMIT 1", "users");

// START OF HONOR STAT GAIN OR LOSS DURING FIGHT - LEVEL UP
// This set its it so a lord starts to gain honor stats during fight.
if ($userrow["level"] >= 20) { // This needs to be set at same level as becoming a lord.
$lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
$lordsrow = mysql_fetch_array($lordsquery); 
$honor = 1; // This sets how many honor points is added or lost for fight.
doquery("UPDATE {{table}} SET honor=honor+'$honor' WHERE id='".$lordsrow["id"]."' ", "lords"); }
//  END OF HONOR STAT GAIN OR LOSS DURING FIGHT - LEVEL UP
			
            if ($levelrow[$userrow["charclass"]."_spells"] != 0) {
                $userspells = $userrow["spells"] . ",".$levelrow[$userrow["charclass"]."_spells"];
                $newspell = "spells='$userspells',";
                $spelltext = "You have learned a new spell.<br />";
            } else { $spelltext = ""; $newspell=""; }
			
		$pagearray["monsterimg"] = "<a href=\"javascript:openwiki('.$dwood_monsterid.')\"><img src=\"images/monsters/".$userrow["currentmonster"].".png\" /><br />'.$monster_duskwood.'</a><br />";


//  START OF HONOR STAT GAIN OR LOSS DURING FIGHT - KILLS
// This set its it so a lord starts to gain honor stats during fight.
if ($userrow["level"] >= 20) { // This needs to be set at same level as becoming a lord.
$lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
$lordsrow = mysql_fetch_array($lordsquery); 
$honor = 1; // This sets how many honor points is added or lost for fight.
doquery("UPDATE {{table}} SET honor=honor+'$honor' WHERE id='".$lordsrow["id"]."' ", "lords"); }
//  END OF HONOR STAT GAIN OR LOSS DURING FIGHT - KILLS
		  
		$page = "<center><h3 class=\"title\">Current Fight</h3></center>
		<br /><br /><center><blockquote>Congratulations. You have defeated the
		<br /> ".$monsterrow["name"].".
		<br /><a href=\"javascript:openwiki('.$dwood_monsterid.')\"><img src=\"images/monsters/".$userrow["currentmonster"].".png\" /></a>
		
        <br />You gain $exp experience. $warnexp 
		<br />Raising your experience from $userrow[experience] to $newexp experience points. $warnexp 
		<br /><br />You gain <font color=\"#0080FF\">$gold Gold Coins</font>. Raising your funds from $userrow[gold] to $newgold Gold Coins. $warngold
		<br />You gain <font color=\"#0080FF\">$silver Silver Coins</font>. Raising your funds from $userrow[silver] to $newsilver Silver Coins. $warnsilver
		<br />You gain <font color=\"#0080FF\">$copper Copper Coins</font>. Raising your funds from $userrow[copper] to $newcopper Copper Coins. $warncopper
		
		<br /><br />You have gained a level!
		<br /><br />You gain <font color=\"#0080FF\">".$levelrow[$userrow["charclass"]."_hp"]."</font> Hit Points.
		<br />You gain <font color=\"#0080FF\">".$levelrow[$userrow["charclass"]."_mp"]."</font> Magic Points.
		<br />You gain <font color=\"#0080FF\">".$levelrow[$userrow["charclass"]."_tp"]."</font> Travel Points.
		<br />You gain <font color=\"#0080FF\">".$levelrow[$userrow["charclass"]."_strength"]."</font> Strength.
		<br />You gain <font color=\"#0080FF\">".$levelrow[$userrow["charclass"]."_dexterity"]."</font> Dexterity.
		<br />$spelltext
		<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\" />Continue Exploring</a></blockquote></center>";
		

		
			
		$title = "Courage and Wit have served thee well!";
            $dropcode = "";
        } else {
            $newhp = $userrow["maxhp"];
            $newmp = $userrow["maxmp"];
            $newtp = $userrow["maxtp"];
            $newstrength = $userrow["strength"];
            $newdexterity = $userrow["dexterity"];
            $newattack = $userrow["attackpower"];
            $newdefense = $userrow["defensepower"];
            $newlevel = $userrow["level"];
            $kills = $userrow["kills"] + 1;
            $newspell = "";
			$pagearray["monsterimg"] = "<br /><div align=\"center\"><a href=\"javascript:openwiki('.$dwood_monsterid.')\">'.$monster_duskwood.'<br /><img src=\"images/monsters/".$userrow["currentmonster"].".png\" /></a></div><br />";
			
//  START OF HONOR STAT GAIN OR LOSS DURING FIGHT - KILLS
// This set its it so a lord starts to gain honor stats during fight.
if ($userrow["level"] >= 20) { // This needs to be set at same level as becoming a lord.
$lordsquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "lords"); 
$lordsrow = mysql_fetch_array($lordsquery); 
$honor = 1; // This sets how many honor points is added or lost for fight.
doquery("UPDATE {{table}} SET honor=honor+'$honor' WHERE id='".$lordsrow["id"]."' ", "lords"); }
//  END OF HONOR STAT GAIN OR LOSS DURING FIGHT - KILLS
            
			$page = "<center><h3 class=\"title\">Current Fight</h3></center>
<div style=\"text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;\"><br /><br /><br /><center><table width=\"45%\" border=\"0\" cellpadding=\"3\" cellspacing=\"3\" style=\"border-width: 0px;\">

<tr valign=\"top\"><td valign=\"top\"><a href=\"javascript:openwiki('.$dwood_monsterid.')\"><img src=\"images/monsters/".$userrow["currentmonster"].".png\" /></a><br /></td>
<td colspan=3><br />&nbsp;&nbsp;&nbsp;Congratulations!<br />You have defeated the <b><a href=\"javascript:openwiki('.$dwood_monsterid.')\">".$monsterrow["name"].".</a></b><br>Your Current Level: <font color=\"#0080FF\">$userrow[level]</font>.<br /><br />Raising your experience <font color=\"#0080FF\">$userrow[experience]</font> to <font color=\"#0080FF\">$newexp Experience Points</font>. $warnexp</td></tr>

<tr valign=\"top\"><td nowrap>You gain <font color=\"#0080FF\">$gold Gold Coins</font>.&nbsp;&nbsp;&nbsp;<br /></td>
<td nowrap>Raising your funds from <font color=\"#0080FF\">$userrow[gold]</font><br /></td>
<td nowrap>to <font color=\"#0080FF\">$newgold Gold Coins</font>. $warngold<br /></td>
<td nowrap>&nbsp;</td></tr>

<tr valign=\"top\"><td nowrap>You gain <font color=\"#0080FF\">$silver Silver Coins</font>.&nbsp;&nbsp;&nbsp;<br /></td>
<td nowrap>Raising your funds from <font color=\"#0080FF\">$userrow[silver]</font><br /></td>
<td nowrap>to <font color=\"#0080FF\">$newsilver Silver Coins</font>. $warnsilver<br /></td>
<td nowrap>&nbsp;</td></tr>

<tr valign=\"top\"><td nowrap>You gain <font color=\"#0080FF\">$copper Copper Coins</font>.&nbsp;&nbsp;&nbsp;<br /></td>
<td nowrap>Raising your funds from <font color=\"#0080FF\">$userrow[copper]</font><br /></td>
<td nowrap>to <font color=\"#0080FF\">$newcopper Copper Coins</font>. $warncopper<br /></td>
<td nowrap>&nbsp;</td></tr>


</table>
</div></center>";
            
            if (rand(1,10) == 1) {
                $dropquery = doquery("SELECT * FROM {{table}} WHERE mlevel <= '".$monsterrow["level"]."' ORDER BY RAND() LIMIT 1", "drops");
                $droprow = mysql_fetch_array($dropquery);
                $dropcode = "dropcode='".$droprow["id"]."',";
                $page .= "<center><br /><br /></b>The monster has dropped an item on the ground near your feet.<br />To reveal and equip this dropped item.&nbsp;&nbsp;<br /><a href=\"index.php?do=drop\" class=\"myButton2\">Click here</a><br><br><br><a href=\"index.php\" class=\"myButton2\" />Continue Exploring</a></center>";
            } else { 
                $dropcode = "";
$page .="<center><br /><br /></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Continue Exploring</a></center><blockquote>";
            }
            $title = "Victory!";
        }
    }

$updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring',level='$newlevel',maxhp='$newhp',maxmp='$newmp',maxtp='$newtp', strength='$newstrength', dexterity='$newdexterity', attackpower='$newattack',defensepower='$newdefense', $newspell currentfight='0', currentmonster='0', currentmonsterhp='0', currentmonstersleep='0', currentmonsterimmune='0', currentuberdamage='0', currentuberdefense='0', $dropcode experience='$newexp', gold='$newgold', kills='$kills', numkills='$newnumkills', silver='$newsilver', copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");

    display($page, $title);    
}


function drop() {    
    global $userrow;
    
    if ($userrow["dropcode"] == 0) { header("Location: index.php"); die(); }    
    $dropquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["dropcode"]."' LIMIT 1", "drops");
    $droprow = mysql_fetch_array($dropquery);
    
    if (isset($_POST["submit"])) {        
        $slot = $_POST["slot"];
        
        if ($slot == 0) { display("Please go back and select an inventory slot to continue.","Error"); }
        
        if ($userrow["slot".$slot."id"] != 0) {            
            $slotquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["slot".$slot."id"]."' LIMIT 1", "drops");
            $slotrow = mysql_fetch_array($slotquery);            
            $old1 = explode(",",$slotrow["attribute1"]);
            if ($slotrow["attribute2"] != "X") { $old2 = explode(",",$slotrow["attribute2"]); } else { $old2 = array(0=>"maxhp",1=>0); }
            $new1 = explode(",",$droprow["attribute1"]);
            if ($droprow["attribute2"] != "X") { $new2 = explode(",",$droprow["attribute2"]); } else { $new2 = array(0=>"maxhp",1=>0); }
            
            $userrow[$old1[0]] -= $old1[1];
            $userrow[$old2[0]] -= $old2[1];
            if ($old1[0] == "strength") { $userrow["attackpower"] -= $old1[1]; }
            if ($old1[0] == "dexterity") { $userrow["defensepower"] -= $old1[1]; }
            if ($old2[0] == "strength") { $userrow["attackpower"] -= $old2[1]; }
            if ($old2[0] == "dexterity") { $userrow["defensepower"] -= $old2[1]; }            
            $userrow[$new1[0]] += $new1[1];
            $userrow[$new2[0]] += $new2[1];
            if ($new1[0] == "strength") { $userrow["attackpower"] += $new1[1]; }
            if ($new1[0] == "dexterity") { $userrow["defensepower"] += $new1[1]; }
            if ($new2[0] == "strength") { $userrow["attackpower"] += $new2[1]; }
            if ($new2[0] == "dexterity") { $userrow["defensepower"] += $new2[1]; }            
            if ($userrow["currenthp"] > $userrow["maxhp"]) { $userrow["currenthp"] = $userrow["maxhp"]; }
            if ($userrow["currentmp"] > $userrow["maxmp"]) { $userrow["currentmp"] = $userrow["maxmp"]; }
            if ($userrow["currenttp"] > $userrow["maxtp"]) { $userrow["currenttp"] = $userrow["maxtp"]; }
            
            $newname = addslashes($droprow["name"]);
            $query = doquery("UPDATE {{table}} SET slot".$_POST["slot"]."name='$newname',slot".$_POST["slot"]."id='".$droprow["id"]."', $old1[0]='".$userrow[$old1[0]]."',$old2[0]='".$userrow[$old2[0]]."',$new1[0]='".$userrow[$new1[0]]."',$new2[0]='".$userrow[$new2[0]]."', attackpower='".$userrow["attackpower"]."',defensepower='".$userrow["defensepower"]."', currenthp='".$userrow["currenthp"]."', currentmp='".$userrow["currentmp"]."', currenttp='".$userrow["currenttp"]."', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            
        } else {
            
            $new1 = explode(",",$droprow["attribute1"]);
            if ($droprow["attribute2"] != "X") { $new2 = explode(",",$droprow["attribute2"]); } else { $new2 = array(0=>"maxhp",1=>0); }
            
            $userrow[$new1[0]] += $new1[1];
            $userrow[$new2[0]] += $new2[1];
            if ($new1[0] == "strength") { $userrow["attackpower"] += $new1[1]; }
            if ($new1[0] == "dexterity") { $userrow["defensepower"] += $new1[1]; }
            if ($new2[0] == "strength") { $userrow["attackpower"] += $new2[1]; }
            if ($new2[0] == "dexterity") { $userrow["defensepower"] += $new2[1]; }
            
            $newname = addslashes($droprow["name"]);
            $query = doquery("UPDATE {{table}} SET slot".$_POST["slot"]."name='$newname',slot".$_POST["slot"]."id='".$droprow["id"]."',$new1[0]='".$userrow[$new1[0]]."', $new2[0]='".$userrow[$new2[0]]."', attackpower='".$userrow["attackpower"]."',defensepower='".$userrow["defensepower"]."', dropcode='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
            
        }
        $page = "<div align=\"center\"><table width=\"100%\"><tr><td align=\"center\" width=\"100%\"><h3 class=\"title\">Inventory Items</h3></td></tr></table>
		<br><br><table width=\"70%\"><tr><td width=\"15%\"><div align=\"center\"><img src=\"images/drops/".$droprow["name"].".png\"><br />".$droprow["name"]."</div></td><td><blockquote>You have decided to equipped yourself with this item.<br>Your slide it into one of the many slots inside your Clothing.</blockquote></td><td width=\"15%\"><div align=\"center\"><img src=\"images/drops/".$droprow["name"].".png\"><br />".$droprow["name"]."</div></td></tr></table></div><br><br><div align=\"center\"><a href=\"index.php\" class=\"myButton2\">Continue Exploring</a></div>";
        display($page, "Item Drop");        
    }
		

    $attributearray = array("maxhp"=>"Max HP",
                            "maxmp"=>"Max MP",
                            "maxtp"=>"Max TP",
                            "defensepower"=>"Defense Power",
                            "attackpower"=>"Attack Power",
                            "strength"=>"Strength",
                            "dexterity"=>"Dexterity",
                            "expbonus"=>"Experience Bonus",
                            "copperbonus"=>"Copper Bonus",
                            "silverbonus"=>"Silver Bonus",
                            "goldbonus"=>"Gold Bonus");
    
    $page = "<table width=\"100%\"><tr>	<td align=\"center\" width=\"100%\"><h3 class=\"title\">Inventory Items</h3></td></tr></table>
<br><br><div align=\"center\"><table width=\"60%\"><tr>
<td align=\"center\" width=\"15%\"><img src=\"images/drops/".$droprow["name"].".png\"></td>
<td><blockquote><div align=\"center\">The monster has dropped the following item:<br><br>".$droprow["name"]."</div></blockquote></td>
<td align=\"center\" width=\"15%\"><img src=\"images/drops/".$droprow["name"].".png\"></td>
</tr></table></div><br /><br />";



    $page .= "<center>This item has the following attribute(s): &nbsp;&nbsp;&nbsp;";
    $attribute1 = explode(",",$droprow["attribute1"]);
    $page .= $attributearray[$attribute1[0]];
    if ($attribute1[1] > 0) { $page .= " +" . $attribute1[1] . "&nbsp;&nbsp;&nbsp;"; } else { $page .= $attribute1[1] . "&nbsp;&nbsp;&nbsp;"; }
    
    if ($droprow["attribute2"] != "X") { 
        $attribute2 = explode(",",$droprow["attribute2"]);
        $page .= $attributearray[$attribute2[0]];
        if ($attribute2[1] > 0) { $page .= " +" . $attribute2[1] . "<br />"; } else { $page .= $attribute2[1] . "</center><br />"; }
}
    
	
	
    $page .= "<br><br>Select an inventory slot from the list below to equip this item.<br>If the inventory slot is already full, the old item will be discarded.<br><br>";
    $page .= "<form action=\"index.php?do=drop\" method=\"post\"><select name=\"slot\"><option value=\"0\">Choose One</option><option value=\"1\">Slot 1: ".$userrow["slot1name"]."</option><option value=\"2\">Slot 2: ".$userrow["slot2name"]."</option><option value=\"3\">Slot 3: ".$userrow["slot3name"]."</option><option value=\"4\">Slot 4: ".$userrow["slot4name"]."</option><option value=\"5\">Slot 5: ".$userrow["slot5name"]."</option><option value=\"6\">Slot 6: ".$userrow["slot6name"]."</option><option value=\"7\">Slot 7: ".$userrow["slot7name"]."</option><option value=\"8\">Slot 8: ".$userrow["slot8name"]."</option></select><input type=\"submit\" name=\"submit\" value=\"Submit\" class=\"myButton2\"></form><br><br>";
    $page .= "You may also choose to just continue<br><br><a href=\"index.php\" class=\"myButton2\">Exploring</a><br><br>and give up this item.</blockquote></blockquote>";    
    display($page, "Item Drop");
	}
    

function dead() {
    $page = "<center><h3 class=\"title\">Death</h3></center><br><br><blockquote><blockquote>You have died.<br /><br />As a consequence, you've lost half of your gold. <br />However, you have been given back a portion of your hit points to continue your journey.<br /><br />You may now continue back to the <a href=\"index.php\" class=\"myButton2\">Town Square</a>, and we hope you fair better next time.</blockquote></blockquote>";}
?>