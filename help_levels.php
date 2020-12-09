<?php 
include('lib.php'); 
$link = opendb();
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);
ob_start("ob_gzhandler");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><? echo $controlrow["gamename"]; ?> Help</title>
<style type="text/css">
body {
  background-image: url(images/background.jpg);
  color: black;
  font: 10px verdana;
}
table {
  border-style: none;
  padding: 0px;
  font: 10px verdana;
}
td {
  border-style: none;
  padding: 3px;
  vertical-align: top;
}
td.top {
  border-bottom: solid 2px black;
}
td.left {
  width: 150px;
  border-right: solid 2px black;
}
td.right {
  width: 150px;
  border-left: solid 2px black;
}
a {
    color: #663300;
    text-decoration: none;
    font-weight: bold;
}
a:hover {
    color: #330000;
}
.small {
  font: 10px verdana;
}
.highlight {
  color: red;
}
.light {
  color: #999999;
}
.title {
  border: solid 1px black;
  background-color: #eeeeee;
  font-weight: bold;
  padding: 5px;
  margin: 3px;
}
.copyright {
  border: solid 1px black;
  background-color: #eeeeee;
  font: 10px verdana;
}
</style>
</head>
<body>
<a name="top"></a>
<h1><? echo $controlrow["gamename"]; ?> Help: Levels</h1>
[ <a href="help.php">Return to Help</a> | <a href="index.php">Return to the game</a> ]

<br /><br /><hr />

<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class1name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,1_exp,1_hp,1_mp,1_tp,1_strength,1_dexterity,1_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["1_spells"] != 0) { $spell = $spells[$itemsrow["1_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 300) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["1_exp"])."</td><td $color width=\"12%\">".$itemsrow["1_hp"]."</td><td $color width=\"12%\">".$itemsrow["1_mp"]."</td><td $color width=\"12%\">".$itemsrow["1_tp"]."</td><td $color width=\"12%\">".$itemsrow["1_strength"]."</td><td $color width=\"12%\">".$itemsrow["1_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>

<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class2name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,2_exp,2_hp,2_mp,2_tp,2_strength,2_dexterity,2_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["2_spells"] != 0) { $spell = $spells[$itemsrow["2_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 300) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["2_exp"])."</td><td $color width=\"12%\">".$itemsrow["2_hp"]."</td><td $color width=\"12%\">".$itemsrow["2_mp"]."</td><td $color width=\"12%\">".$itemsrow["2_tp"]."</td><td $color width=\"12%\">".$itemsrow["2_strength"]."</td><td $color width=\"12%\">".$itemsrow["2_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>

<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class3name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,3_exp,3_hp,3_mp,3_tp,3_strength,3_dexterity,3_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["3_spells"] != 0) { $spell = $spells[$itemsrow["3_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["3_exp"])."</td><td $color width=\"12%\">".$itemsrow["3_hp"]."</td><td $color width=\"12%\">".$itemsrow["3_mp"]."</td><td $color width=\"12%\">".$itemsrow["3_tp"]."</td><td $color width=\"12%\">".$itemsrow["3_strength"]."</td><td $color width=\"12%\">".$itemsrow["3_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class4name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,4_exp,4_hp,4_mp,4_tp,4_strength,4_dexterity,4_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["4_spells"] != 0) { $spell = $spells[$itemsrow["4_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["4_exp"])."</td><td $color width=\"12%\">".$itemsrow["4_hp"]."</td><td $color width=\"12%\">".$itemsrow["4_mp"]."</td><td $color width=\"12%\">".$itemsrow["4_tp"]."</td><td $color width=\"12%\">".$itemsrow["4_strength"]."</td><td $color width=\"12%\">".$itemsrow["4_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class5name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,5_exp,5_hp,5_mp,5_tp,5_strength,5_dexterity,5_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["5_spells"] != 0) { $spell = $spells[$itemsrow["5_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["5_exp"])."</td><td $color width=\"12%\">".$itemsrow["5_hp"]."</td><td $color width=\"12%\">".$itemsrow["5_mp"]."</td><td $color width=\"12%\">".$itemsrow["5_tp"]."</td><td $color width=\"12%\">".$itemsrow["5_strength"]."</td><td $color width=\"12%\">".$itemsrow["5_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>




<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class6name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,6_exp,6_hp,6_mp,6_tp,6_strength,6_dexterity,6_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["6_spells"] != 0) { $spell = $spells[$itemsrow["6_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["6_exp"])."</td><td $color width=\"12%\">".$itemsrow["6_hp"]."</td><td $color width=\"12%\">".$itemsrow["6_mp"]."</td><td $color width=\"12%\">".$itemsrow["6_tp"]."</td><td $color width=\"12%\">".$itemsrow["6_strength"]."</td><td $color width=\"12%\">".$itemsrow["6_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>





<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class7name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,7_exp,7_hp,7_mp,7_tp,7_strength,7_dexterity,7_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["7_spells"] != 0) { $spell = $spells[$itemsrow["7_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["7_exp"])."</td><td $color width=\"12%\">".$itemsrow["7_hp"]."</td><td $color width=\"12%\">".$itemsrow["7_mp"]."</td><td $color width=\"12%\">".$itemsrow["7_tp"]."</td><td $color width=\"12%\">".$itemsrow["7_strength"]."</td><td $color width=\"12%\">".$itemsrow["7_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class8name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,8_exp,8_hp,8_mp,8_tp,8_strength,8_dexterity,8_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["7_spells"] != 0) { $spell = $spells[$itemsrow["7_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["8_exp"])."</td><td $color width=\"12%\">".$itemsrow["8_hp"]."</td><td $color width=\"12%\">".$itemsrow["8_mp"]."</td><td $color width=\"12%\">".$itemsrow["8_tp"]."</td><td $color width=\"12%\">".$itemsrow["8_strength"]."</td><td $color width=\"12%\">".$itemsrow["8_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>




<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class9name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,9_exp,9_hp,9_mp,9_tp,9_strength,9_dexterity,9_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["9_spells"] != 0) { $spell = $spells[$itemsrow["9_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["9_exp"])."</td><td $color width=\"12%\">".$itemsrow["9_hp"]."</td><td $color width=\"12%\">".$itemsrow["9_mp"]."</td><td $color width=\"12%\">".$itemsrow["9_tp"]."</td><td $color width=\"12%\">".$itemsrow["9_strength"]."</td><td $color width=\"12%\">".$itemsrow["9_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>





<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class10name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,10_exp,10_hp,10_mp,10_tp,10_strength,10_dexterity,10_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["10_spells"] != 0) { $spell = $spells[$itemsrow["10_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["10_exp"])."</td><td $color width=\"12%\">".$itemsrow["10_hp"]."</td><td $color width=\"12%\">".$itemsrow["10_mp"]."</td><td $color width=\"12%\">".$itemsrow["10_tp"]."</td><td $color width=\"12%\">".$itemsrow["10_strength"]."</td><td $color width=\"12%\">".$itemsrow["10_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class11name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,11_exp,11_hp,11_mp,11_tp,11_strength,11_dexterity,11_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["11_spells"] != 0) { $spell = $spells[$itemsrow["11_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["11_exp"])."</td><td $color width=\"12%\">".$itemsrow["11_hp"]."</td><td $color width=\"12%\">".$itemsrow["11_mp"]."</td><td $color width=\"12%\">".$itemsrow["11_tp"]."</td><td $color width=\"12%\">".$itemsrow["11_strength"]."</td><td $color width=\"12%\">".$itemsrow["11_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>




<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class12name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,12_exp,12_hp,12_mp,12_tp,12_strength,12_dexterity,12_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["12_spells"] != 0) { $spell = $spells[$itemsrow["12_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["12_exp"])."</td><td $color width=\"12%\">".$itemsrow["12_hp"]."</td><td $color width=\"12%\">".$itemsrow["12_mp"]."</td><td $color width=\"12%\">".$itemsrow["12_tp"]."</td><td $color width=\"12%\">".$itemsrow["12_strength"]."</td><td $color width=\"12%\">".$itemsrow["12_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class13name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,13_exp,13_hp,13_mp,13_tp,13_strength,13_dexterity,13_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["13_spells"] != 0) { $spell = $spells[$itemsrow["13_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["13_exp"])."</td><td $color width=\"12%\">".$itemsrow["13_hp"]."</td><td $color width=\"12%\">".$itemsrow["13_mp"]."</td><td $color width=\"12%\">".$itemsrow["13_tp"]."</td><td $color width=\"12%\">".$itemsrow["13_strength"]."</td><td $color width=\"12%\">".$itemsrow["13_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class14name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,14_exp,14_hp,14_mp,14_tp,14_strength,14_dexterity,14_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["14_spells"] != 0) { $spell = $spells[$itemsrow["14_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["14_exp"])."</td><td $color width=\"12%\">".$itemsrow["14_hp"]."</td><td $color width=\"12%\">".$itemsrow["14_mp"]."</td><td $color width=\"12%\">".$itemsrow["14_tp"]."</td><td $color width=\"12%\">".$itemsrow["14_strength"]."</td><td $color width=\"12%\">".$itemsrow["14_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>




<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class15name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,15_exp,15_hp,15_mp,15_tp,15_strength,15_dexterity,15_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["15_spells"] != 0) { $spell = $spells[$itemsrow["15_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["15_exp"])."</td><td $color width=\"12%\">".$itemsrow["15_hp"]."</td><td $color width=\"12%\">".$itemsrow["15_mp"]."</td><td $color width=\"12%\">".$itemsrow["15_tp"]."</td><td $color width=\"12%\">".$itemsrow["15_strength"]."</td><td $color width=\"12%\">".$itemsrow["15_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class16name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,16_exp,16_hp,16_mp,16_tp,16_strength,16_dexterity,16_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["16_spells"] != 0) { $spell = $spells[$itemsrow["16_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["16_exp"])."</td><td $color width=\"12%\">".$itemsrow["16_hp"]."</td><td $color width=\"12%\">".$itemsrow["16_mp"]."</td><td $color width=\"12%\">".$itemsrow["16_tp"]."</td><td $color width=\"12%\">".$itemsrow["16_strength"]."</td><td $color width=\"12%\">".$itemsrow["16_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class17name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,17_exp,17_hp,17_mp,17_tp,17_strength,17_dexterity,17_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["17_spells"] != 0) { $spell = $spells[$itemsrow["17_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["17_exp"])."</td><td $color width=\"12%\">".$itemsrow["17_hp"]."</td><td $color width=\"12%\">".$itemsrow["17_mp"]."</td><td $color width=\"12%\">".$itemsrow["17_tp"]."</td><td $color width=\"12%\">".$itemsrow["17_strength"]."</td><td $color width=\"12%\">".$itemsrow["17_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>

<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class18name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,18_exp,18_hp,18_mp,18_tp,18_strength,18_dexterity,18_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["18_spells"] != 0) { $spell = $spells[$itemsrow["18_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["18_exp"])."</td><td $color width=\"12%\">".$itemsrow["18_hp"]."</td><td $color width=\"12%\">".$itemsrow["18_mp"]."</td><td $color width=\"12%\">".$itemsrow["18_tp"]."</td><td $color width=\"12%\">".$itemsrow["18_strength"]."</td><td $color width=\"12%\">".$itemsrow["18_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class19name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,19_exp,19_hp,19_mp,19_tp,19_strength,19_dexterity,19_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["19_spells"] != 0) { $spell = $spells[$itemsrow["19_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["19_exp"])."</td><td $color width=\"12%\">".$itemsrow["19_hp"]."</td><td $color width=\"12%\">".$itemsrow["19_mp"]."</td><td $color width=\"12%\">".$itemsrow["19_tp"]."</td><td $color width=\"12%\">".$itemsrow["19_strength"]."</td><td $color width=\"12%\">".$itemsrow["19_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class20name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,20_exp,20_hp,20_mp,20_tp,20_strength,20_dexterity,20_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["20_spells"] != 0) { $spell = $spells[$itemsrow["20_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["20_exp"])."</td><td $color width=\"12%\">".$itemsrow["20_hp"]."</td><td $color width=\"12%\">".$itemsrow["20_mp"]."</td><td $color width=\"12%\">".$itemsrow["20_tp"]."</td><td $color width=\"12%\">".$itemsrow["20_strength"]."</td><td $color width=\"12%\">".$itemsrow["20_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class21name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,21_exp,21_hp,21_mp,21_tp,21_strength,21_dexterity,21_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["21_spells"] != 0) { $spell = $spells[$itemsrow["21_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["21_exp"])."</td><td $color width=\"12%\">".$itemsrow["21_hp"]."</td><td $color width=\"12%\">".$itemsrow["21_mp"]."</td><td $color width=\"12%\">".$itemsrow["21_tp"]."</td><td $color width=\"12%\">".$itemsrow["21_strength"]."</td><td $color width=\"12%\">".$itemsrow["21_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class22name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,22_exp,22_hp,22_mp,22_tp,22_strength,22_dexterity,22_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["22_spells"] != 0) { $spell = $spells[$itemsrow["22_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["22_exp"])."</td><td $color width=\"12%\">".$itemsrow["22_hp"]."</td><td $color width=\"12%\">".$itemsrow["22_mp"]."</td><td $color width=\"12%\">".$itemsrow["22_tp"]."</td><td $color width=\"12%\">".$itemsrow["22_strength"]."</td><td $color width=\"12%\">".$itemsrow["22_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class23name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,23_exp,23_hp,23_mp,23_tp,23_strength,23_dexterity,23_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["23_spells"] != 0) { $spell = $spells[$itemsrow["23_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["23_exp"])."</td><td $color width=\"12%\">".$itemsrow["23_hp"]."</td><td $color width=\"12%\">".$itemsrow["23_mp"]."</td><td $color width=\"12%\">".$itemsrow["23_tp"]."</td><td $color width=\"12%\">".$itemsrow["23_strength"]."</td><td $color width=\"12%\">".$itemsrow["23_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class24name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,24_exp,24_hp,24_mp,24_tp,24_strength,24_dexterity,24_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["24_spells"] != 0) { $spell = $spells[$itemsrow["24_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["24_exp"])."</td><td $color width=\"12%\">".$itemsrow["24_hp"]."</td><td $color width=\"12%\">".$itemsrow["24_mp"]."</td><td $color width=\"12%\">".$itemsrow["24_tp"]."</td><td $color width=\"12%\">".$itemsrow["24_strength"]."</td><td $color width=\"12%\">".$itemsrow["24_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class25name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,25_exp,25_hp,25_mp,25_tp,25_strength,25_dexterity,25_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["25_spells"] != 0) { $spell = $spells[$itemsrow["25_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["25_exp"])."</td><td $color width=\"12%\">".$itemsrow["25_hp"]."</td><td $color width=\"12%\">".$itemsrow["25_mp"]."</td><td $color width=\"12%\">".$itemsrow["25_tp"]."</td><td $color width=\"12%\">".$itemsrow["25_strength"]."</td><td $color width=\"12%\">".$itemsrow["25_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class26name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,26_exp,26_hp,26_mp,26_tp,26_strength,26_dexterity,26_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["26_spells"] != 0) { $spell = $spells[$itemsrow["26_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["26_exp"])."</td><td $color width=\"12%\">".$itemsrow["26_hp"]."</td><td $color width=\"12%\">".$itemsrow["26_mp"]."</td><td $color width=\"12%\">".$itemsrow["26_tp"]."</td><td $color width=\"12%\">".$itemsrow["26_strength"]."</td><td $color width=\"12%\">".$itemsrow["26_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class27name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,27_exp,27_hp,27_mp,27_tp,27_strength,27_dexterity,27_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["27_spells"] != 0) { $spell = $spells[$itemsrow["27_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["27_exp"])."</td><td $color width=\"12%\">".$itemsrow["27_hp"]."</td><td $color width=\"12%\">".$itemsrow["27_mp"]."</td><td $color width=\"12%\">".$itemsrow["27_tp"]."</td><td $color width=\"12%\">".$itemsrow["27_strength"]."</td><td $color width=\"12%\">".$itemsrow["27_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class28name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,28_exp,28_hp,28_mp,28_tp,28_strength,28_dexterity,28_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["28_spells"] != 0) { $spell = $spells[$itemsrow["28_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["28_exp"])."</td><td $color width=\"12%\">".$itemsrow["28_hp"]."</td><td $color width=\"12%\">".$itemsrow["28_mp"]."</td><td $color width=\"12%\">".$itemsrow["28_tp"]."</td><td $color width=\"12%\">".$itemsrow["28_strength"]."</td><td $color width=\"12%\">".$itemsrow["28_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>


<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class29name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,29_exp,29_hp,29_mp,29_tp,29_strength,29_dexterity,29_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["29_spells"] != 0) { $spell = $spells[$itemsrow["29_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["29_exp"])."</td><td $color width=\"12%\">".$itemsrow["29_hp"]."</td><td $color width=\"12%\">".$itemsrow["29_mp"]."</td><td $color width=\"12%\">".$itemsrow["29_tp"]."</td><td $color width=\"12%\">".$itemsrow["29_strength"]."</td><td $color width=\"12%\">".$itemsrow["29_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class30name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,30_exp,30_hp,30_mp,30_tp,30_strength,30_dexterity,30_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["30_spells"] != 0) { $spell = $spells[$itemsrow["30_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["30_exp"])."</td><td $color width=\"12%\">".$itemsrow["30_hp"]."</td><td $color width=\"12%\">".$itemsrow["30_mp"]."</td><td $color width=\"12%\">".$itemsrow["30_tp"]."</td><td $color width=\"12%\">".$itemsrow["30_strength"]."</td><td $color width=\"12%\">".$itemsrow["30_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>



<br /><br />
<table width="50%" style="border: solid 1px black" cellspacing="0" cellpadding="0">
<tr><td colspan="8" bgcolor="#ffffff"><center><b><? echo $controlrow["class31name"]; ?> Levels</b></center></td></tr>
<tr><td><b>Level</b><td><b>Exp.</b></td><td><b>HP</b></td><td><b>MP</b></td><td><b>TP</b></td><td><b>Strength</b></td><td><b>Dexterity</b></td><td><b>Spell</b></td></tr>
<?
$count = 1;
$itemsquery = doquery("SELECT id,31_exp,31_hp,31_mp,31_tp,31_strength,31_dexterity,31_spells FROM {{table}} ORDER BY id", "levels");
$spellsquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
$spells = array();
while ($spellsrow = mysql_fetch_array($spellsquery)) {
    $spells[$spellsrow["id"]] = $spellsrow;
}
while ($itemsrow = mysql_fetch_array($itemsquery)) {
    if ($count == 1) { $color = "bgcolor=\"#ffffff\""; $count = 2; } else { $color = ""; $count = 1; }
    if ($itemsrow["31_spells"] != 0) { $spell = $spells[$itemsrow["31_spells"]]["name"]; } else { $spell = "<span class=\"light\">None</span>"; }
    if ($itemsrow["id"] != 213) { echo "<tr><td $color width=\"12%\">".$itemsrow["id"]."</td><td $color width=\"12%\">".number_format($itemsrow["31_exp"])."</td><td $color width=\"12%\">".$itemsrow["31_hp"]."</td><td $color width=\"12%\">".$itemsrow["31_mp"]."</td><td $color width=\"12%\">".$itemsrow["31_tp"]."</td><td $color width=\"12%\">".$itemsrow["31_strength"]."</td><td $color width=\"12%\">".$itemsrow["31_dexterity"]."</td><td $color width=\"12%\">$spell</td></tr>\n"; }
}
?>
</table>





<br />
Experience points listed are total values up until that point. All other values are just the new amount that you gain for each level.

<br /><br />
<div align="center">[ <a href="help.php">Return to Help</a> | <a href="index.php">Return to the game</a> ]</div>
<br /><br />
<table width="100%">
<tr>
<td align="center" class="copyright">Powered by <? echo $controlrow["gamename"]; ?> </td>
<td align="center" class="copyright">by ES_Archangel - Archangel Michael - Archangel Heavenweb</td>
<td align="center" class="copyright">&copy; 2010-2020</td>
</tr>
</table>


</body>
</html>