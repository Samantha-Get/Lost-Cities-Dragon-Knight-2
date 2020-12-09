<?php // fields.php :: Handles all actions you can do in field.

function visitfield($id) { // 
    
    global $userrow, $fieldrow, $monsterrow, $numqueries;
    
    if ($userrow["currentaction"] == "Fighting") { header("Location: index.php?do=fight"); die(); }
      if (mysql_num_rows($fieldquery) == 0) { display("There is an error with your user account, or with the field data. Please try again.","Error"); }

   $fieldrow = mysql_fetch_array($fieldquery);

}
      if (mysql_num_rows($fieldquery) > 0) { 
  $updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring',latitude='".$fieldrow["latitude"]."',longitude='".$fieldrow["longitude"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");


// first monster selection form button
  if ($fieldrow["fieldmonster1id"] > 0) { 
        $monsterquery = doquery("SELECT * FROM {{table}} WHERE id='".$fieldrow["fieldmonster1id"]."' LIMIT 1", "monsters");
        $monsterrow = mysql_fetch_array($monsterquery);

    $page = "<center><h3 class='title'>Your Path leads to a Field</h3></center>
	<br><br><blockquote><blockquote> ".$userrow["status"]." ".$userrow["charname"].", you have travelled to <b>".$fieldrow["name"]."</b>. 

<br><br><br> You have seen  ".$monsterrow["name"]."   <img src='images/monsters/".$monsterrow["id"].".png' alt='fieldmonsterid' border='0'>  sitting by the field.</a>";
  
$page .= "<br><br><form action=index.php?do=fight method=post><input type='submit' value='Fight' name='Fight' class='myButton2'></form><br><br>"; } 

else

   { display("<center><h3 class='title'>Your Path leads to a Field</h3></center>
<br><br><blockquote><blockquote> ".$userrow["status"]." ".$userrow["charname"]." you seemed to have travelled off the main path, to <b>".$fieldrow["name"]."</b>. 

<br><br>Go back and <a href=index.php?do=npc:".$npcid.">talk about something else</a>

<br><br>In your long and painful search of ".$fieldrow["name"].", there are no monsters to be found. Or for fact nothing of any value at all.

<br><br>Wait you hear something move by the  ".$fieldrow["name"].". You quickly turn around and spot a ".$monsterrow["name"].". You draw your weapon and prepare for battle.

<br><br><center><a href=\"index.php?do=move\" class=\"tab blink\" class=\"myButton2\">Back to Exploring</a></center>

</blockquote></blockquote><br><br>","Your Path leads to a Field"); }

display($page, "Walking on field");
}

?>


