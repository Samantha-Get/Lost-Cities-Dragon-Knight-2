<?php
include "config.php";

function dicingbet4(){
global $userrow, $numqueries;

$usersilver = $userrow["silver"];




$usersilver = $userrow["silver"];
if ($usersilver >= 5) {display("<center><h3 class=\"title\">Dice: 5 Silver Coins</h3></center><blockquote><img src=\"images/items/misc/blackdice.png\" width=\"284\" height=\"177\" alt=\"5 Silver Dice\" border=\"0\"><br /><a href=\"index.php?do=dice4\">PLAY</a><br /><br /><a href=\"index.php\">Back to the town</a></blockquote>","Dice4");}
else{

if ($usersilver < 5) {display("<center><h3 class=\"title\">Dice: 5 Silver Coins</h3></center><br /><blockquote><img src=\"images/items/misc/blackdice.png\" width=\"284\" height=\"177\" alt=\"5 Silver Dice\" border=\"0\"><br /><font color=red>You have not enough money.</font><br /><br /><a href=\"index.php\">Back to the town</a><br /></blockquote>","Dice4");}

}
}



function dice4() {
global $userrow, $numqueries;
$usersilver = $userrow["silver"];

	$nr1 = rand(1,6);
	$nr2 = rand(1,6);
	$sum = $nr1 + $nr2;

if($sum >= 8 && $sum < 12) {$a=1;}
if($sum == 12) {$a=2;}
if($sum == 2) {$a=2;}
elseif($sum != 2 && $sum < 8) {$a=0;}

if($a == 0){
	$winorlose='You lose';
	$won = 5;
	$newsilver = $userrow['silver'] - $won;
	doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
	
}
if ($usersilver == 0 || $usersilver < 5) {display("<center><h3 class=\"title\">Dice:  Silver Coins</h3></center><br /><blockquote><img src=\"images/items/misc/blackdice.png\" width=\"284\" height=\"177\" alt=\"5 Silver Dice\" border=\"0\"><br /><font color=red>You have not enough money.</font><br /><br /><a href=\"index.php\">Back to the town</a><br /></blockquote>","Dice4");}

if($a == 1){
	$winorlose='You win';
	$won = 2 * 5;
	$newsilver = $userrow['silver'] + $won;
	doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}

if ($usersilver == 0 || $usersilver < 5) {display("<center><h3 class=\"title\">Dice: 5 Silver Coins</h3></center><blockquote><img src=\"images/items/misc/blackdice.png\" width=\"284\" height=\"177\" alt=\"5 Silver Dice\" border=\"0\"><br /><a href=\"index.php?do=dice4\">Play</a><br /><br /><a href=\"index.php\">Back to the town</a></blockquote>","Dice4");}


if($a == 2){
	$winorlose='You win';
	$won = 5 * 5;
	$newsilver = $userrow['silver'] + $won;
	doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");}

	$page = '<center>';
	$page .= '<center><h3 class="title">Dice: 5 Silver Coins</h3></center>';
$page .= '<br /><br /><font color=red><b>You may receive the prize promptly</b></font><br /><br />';
$page .= '<b>Number between 3 and 7 = 0 silver<br>
Number between 8 and 11 = 10 silver<br>
2 or 12 number = 25 silver<br>
</b><br>';

$page .= '<table>';
$page .= '<tr>
<td>Your thrown numbers:</td> <td align="right"><b>'.$nr1.'</b></td>
<td align="right"><b>'.$nr2.'</b></td></tr>';
$page .= '</table><font color=blue><b>Altogether you threw this number: '.$sum.'.<br />'.$winorlose.' </b><b>'.$won.' Silver Coins.</b></font><br /><br />';
	$page .= '<blockquote><img src=\'images/items/misc/blackdice.png\' width=\'284\' height=\'177\' alt=\'5 Silver Dice\' border=\'0\'><br /><a href=\'index.php?do=dice4\'>PLAY</a><br /><br /></blockquote><center><a href=\'index.php?do=dicingbet4\'>Roll your Dice Again?</a><b><br /></a>';
	$page .= '<a href=\'index.php\'>Back to the town</a><br /><br />';
	$page .= 'Dice: 5 Silver Coins needed</b></center><br />';
	display($page, "Dice4");


}
	
?>
