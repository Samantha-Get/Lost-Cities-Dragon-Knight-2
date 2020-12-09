<?php
 $result = mysql_query("SELECT id, text FROM base_one")
or die(mysql_error()); 
while($row=mysql_fetch_array($result)){
 $resultb = mysql_query("SELECT id, text FROM base_two 
 WHERE id=".$row['id']." ORDER by text ASC")
or die(mysql_error()); 
while($link=mysql_fetch_array($resultb)){
 echo $link[text]; 
 echo "<br />";
}
}
?>