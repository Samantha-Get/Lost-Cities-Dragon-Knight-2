<?php
include "config.php";

function dicingbet(){
global $userrow, $numqueries;

$usergold = $userrow["gold"];
if ($usergold >= 30) {display("<center><h3 class=\"title\">Dice: 30 Gold Coins</h3></center><blockquote><img src=\"images/items/misc/whitedice.png\" width=\"284\" height=\"177\" alt=\"30 Gold Dice\" border=\"0\"><br /><a href=\"index.php?do=dice\" class=\"myButton2\">PLAY</a>&nbsp; &nbsp; &nbsp; <a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>","Dice");}
else{
if ($usergold < 30) {display("<center><h3 class=\"title\">Dice: 30 Gold Coins</h3></center><blockquote><br /><font color=red>You have not enough money.</font><img src=\"images/items/misc/whitedice.png\" width=\"284\" height=\"177\" alt=\"30 Gold Dice\" border=\"0\"><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a></blockquote>","Dice");}

}
}

function dice() {
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
	$won = 30;
	$newgold = $userrow['gold'] - $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
	
}
if ($usergold == 0 || $usergold < 30) {display("<center><h3 class=\"title\">Dice: 30 Gold Coins</h3></center><br /><img src=\"images/items/misc/whitedice.png\" width=\"284\" height=\"177\" alt=\"30 Gold Dice\" border=\"0\"><font color=red>You have not enough money.</font><br /><br /><a href=\"index.php\">Back to the town</a>","Dice");}

if($a == 1){
	$winorlose='You win';
	$won = 2 * 30;
	$newgold = $userrow['gold'] + $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}
if ($usergold == 0 || $usergold < 30) {display("<center><h3 class=\"title\">Dice: 30 Gold Coins</h3></center><img src=\"images/items/misc/whitedice.png\" width=\"284\" height=\"177\" alt=\"30 Gold Dice\" border=\"0\"><br /><font color=red>You have not enough money.</font><br /><br /><a href=\"index.php\" class=\"myButton2\">Town Square</a>","Dice");}

if($a == 2){
	$winorlose='You win';
	$won = 5 * 30;
	$newgold = $userrow['gold'] + $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");}

	$page = '<center>';
	$page .= '<center><h3 class="title">Dice: 30 Gold Coins</h3></center>';
$page .= '<br /><br /><font color=red><b>You may receive the prize promptly</b></font><br /><br />';
$page .= '<b>Number between 3 and 7 = 0 gold<br>
Number between 8 and 11 = 60 gold<br>
2 or 12 number = 150 gold<br>
</b><br>';

$page .= '<table>';
$page .= '<tr>
<td>Your thrown numbers:</td> <td align="right"><b>'.$nr1.'</b></td>
<td align="right"><b>'.$nr2.'</b></td></tr>';
$page .= '</table><font color=blue><b>Altogether you threw this number: '.$sum.'.<br />'.$winorlose.' </b><b>'.$won.' Gold Coins.</b></font><br /><br />';


		$page .= '<blockquote><img src=\'images/items/misc/whitedice.png\' width=\'284\' height=\'177\' alt=\'30 Gold Dice\' border=\'0\'><br /><center><a href=\'index.php?do=dice\' class=\'myButton2\'>PLAY</a>&nbsp; &nbsp; &nbsp; <a href=\'index.php?do=dicingbet\' class=\'myButton2\'>Roll your Dice Again?</a><a href=\'index.php\' class=\'myButton2\'>Town Square</a></blockquote><br />';
	$page .= 'To playing dice: 30 Gold Coins needed</b></center><br />';
	display($page, "Dice");


}
	
?>
