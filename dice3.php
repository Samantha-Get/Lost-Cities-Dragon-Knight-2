<?php
include "config.php";

function dicingbet3(){
global $userrow, $numqueries;

$usergold = $userrow["gold"];




$usergold = $userrow["gold"];
if ($usergold >= 15) {display("<center><h3 class=\"title\">Dice: 15 Gold Coins</h3></center><blockquote><img src=\"images/items/misc/yellowdice.png\" width=\"284\" height=\"177\" alt=\"Yellow 15 Gold Dice\" border=\"0\"><br /><a href=\"index.php?do=dice3\" class=\"myButton2\">PLAY</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Back to Town Square</a></blockquote>","Dice3");}
else{

if ($usergold < 15) {display("<center><h3 class=\"title\">Dice: 15 Gold Coins</h3></center><br /><blockquote><img src=\"images/items/misc/yellowdice.png\" width=\"284\" height=\"177\" alt=\"Yellow 15 Gold Dice\" border=\"0\"><br /><font color=red>You have not enough money.</font><br /><br /><a href=\"index.php\" class=\"myButton2\">Back to Town Square</a></blockquote>","Dice3");}

}
}



function dice3() {
global $userrow, $numqueries;
$usergold = $userrow["gold"];

	$nr1 = rand(1,6);
	$nr2 = rand(1,6);
	$sum = $nr1 + $nr2;

if($sum >= 8 && $sum < 12) {$a=1;}
if($sum == 12) {$a=2;}
if($sum == 2) {$a=2;}
elseif($sum != 2 && $sum < 8) {$a=0;}

if($a == 0){
	$winorlose='You lose';
	$won = 15;
	$newgold = $userrow['gold'] - $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
	
}
if ($usergold == 0 || $usergold < 15) {display("<center><h3 class=\"title\">Dice: 15 Gold Coins</h3></center><br /><blockquote><img src=\"images/items/misc/yellowdice\" width=\"284\" height=\"177\" alt=\"Yellow 15 Gold Dice\" border=\"0\"><br /><font color=red>You have not enough money.</font><br /><br /><a href=\"index.php\" class=\"myButton2\">Back to Town Square</a></blockquote>","Dice3");}

if($a == 1){
	$winorlose='You win';
	$won = 2 * 15;
	$newgold = $userrow['gold'] + $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}

if ($usergold == 0 || $usergold < 15) {display("<center><h3 class=\"title\">Dice: 15 Gold Coins</h3></center><blockquote><img src=\"images/items/misc/yellowdice.png\" width=\"284\" height=\"177\" alt=\"Yellow 15 Gold Dice\" border=\"0\"><br /><a href=\"index.php?do=dice3\" class=\"myButton2\">PLAY</a><br /><br /><a href=\"index.php\" class=\"myButton2\">Back to Town Square</a></blockquote>","Dice3");}


if($a == 2){
	$winorlose='You win';
	$won = 5 * 15;
	$newgold = $userrow['gold'] + $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");}

	$page = '<center>';
	$page .= '<center><h3 class="title">Dice: 15 Gold Coins</h3></center>';
$page .= '<br /><br /><font color=red><b>You may receive the prize promptly</b></font><br /><br />';
$page .= '<b>Number between 3 and 7 = 0 gold<br>
Number between 8 and 11 = 30 gold<br>
2 or 12 number = 75 gold<br>
</b><br>';

$page .= '<table>';
$page .= '<tr>
<td>Your thrown numbers:</td> <td align="right"><b>'.$nr1.'</b></td>
<td align="right"><b>'.$nr2.'</b></td></tr>';
$page .= '</table><font color=blue><b>Altogether you threw this number: '.$sum.'.<br />'.$winorlose.' </b><b>'.$won.' Gold Coins.</b></font><br /><br />';
	$page .= '<blockquote><img src=\'images/items/misc/yellowdice.png\' width=\'284\' height=\'177\' alt=\'Yellow 15 Gold Dice\' border=\'0\'><br /><a href=\'index.php?do=dice3\' class=\'myButton2\'>PLAY</a><br /><br /></blockquote><center><a href=\'index.php?do=dicingbet3\' class=\'myButton2\'>Roll your Dice Again?</a><b><br /></a>';
	$page .= '<a href=\'index.php\' class=\'myButton2\'>Back to Town Square</a><br /><br />';
	$page .= 'Dice: 15 Gold Coins needed</b></center><br />';
	display($page, "Dice3");


}
	
?>
