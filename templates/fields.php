<?php // fields.php :: Handles all actions you can do in field.

function visitfield($id) { // 
    
    global $userrow, $fieldrow, $monsterrow, $numqueries;
    
    if ($userrow["currentaction"] == "Fighting") { header("Location: index.php?do=fight"); die(); }
      if (mysql_num_rows($fieldquery) == 0) { display("There is an error with your user account, or with the field data. Please try again.","Error"); }

   $fieldrow = mysql_fetch_array($fieldquery);

}
      if (mysql_num_rows($fieldquery) > 0) { 
  $updatequery = doquery("UPDATE {{table}} SET currentaction='Exploring Field',latitude='".$fieldrow["latitude"]."',longitude='".$fieldrow["longitude"]."' WHERE id='".$userrow["id"]."' LIMIT 1", "users");


// first monster selection form button
  if ($fieldrow["fieldmonster1id"] > 0) { 
        $monsterquery = doquery("SELECT * FROM {{table}} WHERE id='".$fieldrow["fieldmonster1id"]."' LIMIT 1", "monsters");
        $monsterrow = mysql_fetch_array($monsterquery);

    $page = "You have travelled to <b>".$fieldrow["name"]."</b>. <br>

<div align=center>Some text <br> 
<br>
 You have seen  ".$monsterrow["name"]." sitting by the field.</a>";
  
$page .= "<form action=index.php?do=fixedmonster method=post><input type=submit value='Aproach to monster' name=monster1 class=myButton2></form>"; } 

else

   { display("<h3 class='title'>Towns Maps</h3>
<br><br>You have travelled to <b>".$fieldrow["name"]."</b>. 

<div align=center>Some text <br> 
<br>
But here is no 
monsters","Find some other area"); }

 display($page, "Walking on field");

}


?>


