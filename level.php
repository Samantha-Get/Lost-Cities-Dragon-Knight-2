<?php 

function level() { 
global $userrow, $numqueries; 

if (isset($_POST['level'])) { 
$title = "Sevren Knights :: Level Points"; 

if ($_POST['maxhp']) { 
if ($_POST['maxhp'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["maxhp"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Max HP field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Max HP!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newmaxhp = $userrow['maxhp'] + intval($_POST['maxhp']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['maxhp']); 
doquery("UPDATE {{table}} SET maxhp='$newmaxhp' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Max HP</center></b></div>You have upgraded your Max HP with $_POST[maxhp] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 

} elseif ($_POST['maxmp']) { 
if ($_POST['maxmp'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["maxmp"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Max MP field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Max MP!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newmaxmp = $userrow['maxmp'] + intval($_POST['maxmp']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['maxmp']); 
doquery("UPDATE {{table}} SET maxmp='$newmaxmp' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Max MP</center></b></div>You have upgraded your Max MP with $_POST[maxmp] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 

} elseif ($_POST['maxtp']) { 
if ($_POST['maxtp'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["maxtp"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Max TP field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Max TP!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newmaxtp = $userrow['maxtp'] + intval($_POST['maxtp']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['maxtp']); 
doquery("UPDATE {{table}} SET maxtp='$newmaxtp' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Max TP</center></b></div>You have upgraded your Max TP with $_POST[maxtp] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 
} elseif ($_POST['strength']) { 
if ($_POST['strength'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["strength"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Strength field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Strength!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newstrength = $userrow['strength'] + intval($_POST['strength']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['strength']); 
doquery("UPDATE {{table}} SET strength='$newstrength' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Strength</center></b></div>You have upgraded your Strength with $_POST[strength] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 

} elseif ($_POST['dexterity']) { 
if ($_POST['dexterity'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["dexterity"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Dexterity field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Dexterity!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newdexterity = $userrow['dexterity'] + intval($_POST['dexterity']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['dexterity']); 
doquery("UPDATE {{table}} SET dexterity='$newdexterity' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Dexterity</center></b></div>You have upgraded your Dexterity with $_POST[dexterity] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 
} elseif ($_POST['attackpower']) { 
if ($_POST['attackpower'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["attackpower"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Attack Power field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Attack Power!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newattackpower = $userrow['attackpower'] + intval($_POST['attackpower']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['attackpower']); 
doquery("UPDATE {{table}} SET attackpower='$newattackpower' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Attack Power</center></b></div>You have upgraded your Attack Power with $_POST[attackpower] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 

} elseif ($_POST['defensepower']) { 
if ($_POST['defensepower'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You must enter an amount above 0!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif(!is_numeric($_POST["defensepower"])) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You have invalid characters in your Defense Power field.<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
elseif ($userrow['levelpt'] <= 0) 
$page = "<div class=\"big\"><center><b>Error</center></b></div>You do not have that many Level Points to upgrade your Defense Power!<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
else { 
$newdefensepower = $userrow['defensepower'] + intval($_POST['defensepower']); 
$newlevelpt = $userrow['levelpt'] - intval($_POST['defensepower']); 
doquery("UPDATE {{table}} SET defensepower='$newdefensepower' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET levelpt='$newlevelpt' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page = "<div class=\"big\"><center><b>Successfully Upgraded Defense Power</center></b></div>You have upgraded your Defense Power with $_POST[defensepower] Level Points!"; 
$page .= "<br /><br />You may go back to your <a href=index.php?do=level>Level Points</a> or <a href=index.php>return</a> to what you were doing."; 
} 
} 
} else { 
$title = "Sevren Knights :: Level Points"; 
$page .= "<div class=\"big\"><center><b>Character Level Points</center></b></div><center><br />Welcome ".$userrow["charname"].", here you can spend your level points and spell points on upgrading your character.</center><br />"; 
$page .= "<center>Your Character currently has <b>".$userrow["levelpt"]." level points</b> and <b>".$userrow["spellpt"]." spell points</b></center>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Max HP with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=maxhp> Level Points <input type=submit value=\"Upgrade HP\" name=level></form>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Max MP with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=maxmp> Level Points <input type=submit value=\"Upgrade MP\" name=level></form>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Max TP with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=maxtp> Level Points <input type=submit value=\"Upgrade TP\" name=level></form>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Strength with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=strength> Level Points <input type=submit value=\"Upgrade Strength\" name=level></form>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Dexterity with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=dexterity> Level Points <input type=submit value=\"Upgrade Dexterity\" name=level></form>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Attack with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=attackpower> Level Points <input type=submit value=\"Upgrade Attack\" name=level></form>"; 
$page .= "<form action=index.php?do=level method=post>"; 
$page .= "Upgrade Defense with <input type=text value=\"0\" size=\"3\" maxlength=\"3\" name=defensepower> Level Points <input type=submit value=\"Upgrade Defense\" name=level></form>"; 
$page .= "<br /><br /><center>When you are finished with your level points you may return to <a href=index.php>what you were doing</a>, or use the direction buttons on the left to start exploring.</a></center>"; 
} 

display($page, $title); 

} 
?>