<?php
include "config.php";

function dicingbet5(){
global $userrow, $numqueries;

$usercopper = $userrow["copper"];
if ($usercopper >= 500) {disPlay("<center><h3 class=\"title\">Dice: 500 Copper Coins</h3></center><blockquote><img src=\"images/items/misc/darkvioletdice.png\" width=\"284\" height=\"177\" border=\"0\"><br /><div align=\"center\"><a href=\"index.php?do=dice5\" class=\"myButton2\">Play</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></div></blockquote>","Dice5");}
else{
if ($usercopper < 500) {disPlay("<center><h3 class=\"title\">Dice: 500 Copper Coins</h3></center><blockquote><img src=\"images/items/misc/darkvioletdice.png\" width=\"284\" height=\"177\" border=\"0\"><br /><div align=\"center\"><a href=\"index.php?do=dice5\" class=\"myButton2\">Play</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></div></blockquote>","Dice5");}

}
}

function dice5() {
global $userrow, $numqueries;
$usercopper = $userrow["copper"];

	$nr1 = rand(1,6);
	$nr2 = rand(1,6);
	$sum = $nr1 + $nr2;

if($sum >= 8 && $sum < 12) {$a=1;}
if($sum == 12) {$a=2;}
if($sum == 2) {$a=2;}
elseif($sum != 2 && $sum < 8) {$a=0;}

if($a == 0){
	$winorlose='You lose';
	$won = 500;
	$newcopper = $userrow['copper'] - $won;
	doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
	
}
if ($usercopper == 0 || $usercopper < 500) {disPlay("<center><h3 class=\"title\">Dice: 500 Copper Coins</h3></center><blockquote><img src=\"images/items/misc/darkvioletdice.png\" width=\"284\" height=\"177\" border=\"0\"><br /><a href=\"index.php?do=dice5\" class=\"myButton2\">Play</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>","Dice5");}

if($a == 1){
	$winorlose='You win';
	$won = 2 * 500;
	$newcopper = $userrow['copper'] + $won;
	doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}
if ($usercopper == 0 || $usercopper < 500) {disPlay("<center><h3 class=\"title\">Dice: 500 Copper Coins</h3></center><blockquote><img src=\"images/items/misc/darkvioletdice.png\" width=\"284\" height=\"177\" border=\"0\"><br /><a href=\"index.php?do=dice5\" class=\"myButton2\">Play</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>","Dice5");}

if($a == 2){
	$winorlose='You win';
	$won = 5 * 500;
	$newcopper = $userrow['copper'] + $won;
	doquery("UPDATE {{table}} SET copper='$newcopper' WHERE id='".$userrow["id"]."' LIMIT 1", "users");}

	$page = '<center>';
	$page .= '<center><h3 class="title">Dice: 500 Copper Coins</h3></center>';
$page .= '<br /><br /><font color=#0080FF>You will receive the Winnings or Losses Promptly.</font><br /><br />';
$page .= 'Number between 3 and 7 = 0 copper<br>
Number between 8 and 11 = 200 copper<br>
2 or 12 number = 500 copper<br>
<br>';

$page .= '<table>';
$page .= '<tr>
<td>Your thrown numbers:</td> <td align="right">'.$nr1.'</td>
<td align="right">'.$nr2.'</td></tr>';
$page .= '</table><font color=#0080FF>Altogether you threw this number: '.$sum.'.<br />'.$winorlose.' '.$won.' Copper Coins.</font><br /><br />';
	$page .= '<blockquote><img src=\'images/items/misc/darkvioletdice.png\' width=\'284\' height=\'177\' border=\'0\'><br /><a href=\'index.php?do=dice5\' class=\'myButton2\'>Play</a><br /><br /></blockquote><center><a href=\'index.php?do=dicingbet2\' class=\'myButton2\'>Roll the Dice Again</a><br /><br /></a>';
	$page .= '<a href=\'index.php\' class=\'myButton2\'>Town Square</a><br /><br />';
	$page .= 'Dice: 500 Copper Coins needed</center><br />';
	display($page, "500 Coppers Dice");


}
	
?>
