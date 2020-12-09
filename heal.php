<?php // heal.php :: Handles stuff from the Quick Spells menu. (Healing spells only... other spells are handled in fight.php.)

function healspells($id) {
    
    global $userrow;
    
    $userspells = explode(",",$userrow["spells"]);
    $spellquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "spells");
    $spellrow = mysql_fetch_array($spellquery);
    
    // All the various ways to error out.
    $spell = false;
    foreach ($userspells as $a => $b) {
        if ($b == $id) { $spell = true; }
    }
    if ($spell != true) { display("<center><h3 class='title'>Spell Unknown to You</h3></center><center><blockquote><blockquote><br /><br />You have not yet learned this spell. Please go back and try again.</blockquote></blockquote></center><br /><br />", "Error"); die(); }
    if ($spellrow["type"] != 1) { display("<center><h3 class='title'>Not a Healing Spell</h3></center><center><blockquote><blockquote><br /><br />This is not a healing spell. Please go back and try again.</blockquote></blockquote></center><br /><br />", "Error"); die(); }
    if ($userrow["currentmp"] < $spellrow["mp"]) { display("<center><h3 class='title'>More Magic Points Needed</h3></center><center><blockquote><blockquote><br /><br />You do not have enough Magic Points to cast this spell. Please go back and try again.</blockquote></blockquote></center><br /><br />", "Error"); die(); }
  
  
  
    if ($userrow["currentaction"] == "Fighting") { display("<center><h3 class='title'>Can Not be Used Here</h3></center><center><blockquote><blockquote><br /><br />You cannot use the Quick Spells list during a fight. Please go back and select the Healing Spell you wish to use from the Spells box on the main fighting screen to continue.</blockquote></blockquote></center><br /><br />", "Error"); die(); }
    if ($userrow["currentaction"] == "Quest Event") { display("<center><h3 class='title'>Can Not be Used Here</h3></center><center><blockquote><blockquote><br /><br />You cannot use the Quick Spells list during a fight. Please go back and select the Healing Spell you wish to use from the Spells box on the main fighting screen to continue.</blockquote></blockquote></center><br /><br />", "Error"); die(); }
    if ($userrow["currenthp"] == $userrow["maxhp"]) { display("<center><h3 class='title'>Healing Spell Unnecessary</h3></center><center><blockquote><blockquote><br /><br />Your Hit Points are already full. You don't need to use a Healing spell now.</blockquote></blockquote></center><br /><br />", "Error"); die(); }

    
    $newhp = $userrow["currenthp"] + $spellrow["attribute"];
    if ($userrow["maxhp"] < $newhp) { $spellrow["attribute"] = $userrow["maxhp"] - $userrow["currenthp"]; $newhp = $userrow["currenthp"] + $spellrow["attribute"]; }
    $newmp = $userrow["currentmp"] - $spellrow["mp"];
    
    $updatequery = doquery("UPDATE {{table}} SET currenthp='$newhp', currentmp='$newmp' WHERE id='".$userrow["id"]."' LIMIT 1", "users");


    
//Random Wizard Picture.
//Random Wizard Picture.
//Random Wizard Picture.


	
$wizardchance = rand(1,1);
if ($wizardchance == 1) { 
$wizard = rand(1,15); 
}  
	
    display("<center><h3 class='title'>Spell Casting</h3></center><center><blockquote><blockquote><br /><br /><div align='center'><img src='images/pills/$wizard.png'/></div><br /><br />You have cast the<b> ".$spellrow["name"]." spell, and gained ".$spellrow["attribute"]." Hit Points</b>. You can now continue.<br /><br /><a href='index.php' class='myButton2'>Exploring</a></blockquote></blockquote></center><br /><br />", "Healing Spell");
    die();
   
}

?>