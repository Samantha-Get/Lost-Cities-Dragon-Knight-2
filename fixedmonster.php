<?php  // fixedmonster.php controls handling of all fixed monsters.


FUNCTION fixedmonster() {
global $userrow, $fieldrow, $monsterrow, $numqueries;

if (isset($_POST['monster1'])) { 

   $fieldquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "fields");    
    $fieldrow = mysql_fetch_array($fieldquery);

        $monsterquery = doquery("SELECT * FROM {{table}} WHERE id='".$fieldrow["fieldmonster1id"]."' LIMIT 1", "monsters");
        $monsterrow = mysql_fetch_array($monsterquery);

//Set To fight 
doquery("UPDATE {{table}} SET currentaction='Atacking Monster' WHERE id=".$userrow["id"], "users"); 
doquery("UPDATE {{table}} SET currentfight='2' WHERE id=".$userrow["id"], "users"); 
doquery("UPDATE {{table}} SET currentmonster='".$fieldrow["fieldmonster1id"]."' WHERE id=".$userrow["id"], "users"); 
 
  $page = "Prepare for fight on  ".$fieldrow["name"].". <br>
 This is ".$monsterrow["name"]." looking at You. You can fight this monster if u wish</a>.";
  
$page .= "<form action=index.php?do=fightmonster method=post><input type=submit value='Atack monster' name=monster1></form>"; } 

    display($page, "Attack monster");
//   header("Location: index.php");

}

?>



