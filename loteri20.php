<?php

/*

Script made by ErRoR

You may edit this script any way you like.
Any comments in Mod Index are welcome..


*/

include "config.php";


function loteri() {
global $userrow, $numqueries;
$usergold = $userrow["gold"];


if (isset($_POST['buy'])) {


////////////////////////////
// Here you can change the value of cash. 20 gold is default value which is needed to play the game.
////////////////////////////

$cash = 20;

if ($cash > $userrow["gold"]) {display("You dont have enough money to play!<br><a href=\"index.php?\">Back to town</a>", "Lottery"); die(); }
			
/////////
///USER NUMBERS
/////////

$guess1 = $_POST['choice1'];
$guess11 = $guess1;

	$guess2 = $_POST['choice2'];
	$guess22 = $guess2;

		$guess3 = $_POST['choice3'];
		$guess33 = $guess3;

			$guess4 = $_POST['choice4'];
			$guess44 = $guess4;

				$guess5 = $_POST['choice5'];
				$guess55 = $guess5;




////////
///LOTTERY NUMBERS
////////

$nr1 = rand(1,5);
$nr11=$nr1;

	$nr2 = rand(6,10);
	$nr22=$nr2;

		$nr3 = rand(11,15);
		$nr33=$nr3;

			$nr4 = rand(16,20);
			$nr44=$nr4;

				$nr5 = rand(21,25);
				$nr55=$nr5;



/////////////////
///Check user and lottery numbers
/////////////////

if($guess11 == "" || $guess22 == "" || $guess33 == "" || $guess44 == "" || $guess55 == "") {display("You must choose 5 numbers!!!<br><a href=\"index.php?do=loteri\">Back</a>", "Lottery"); die(); }


if($nr11 == $guess11) {$a=$a+1;}
	if($nr22 == $guess22) {$a=$a+1;}
		if($nr33 == $guess33) {$a=$a+1;}
			if($nr44 == $guess44) {$a=$a+1;}
				if($nr55 == $guess55) {$a=$a+1;}
					elseif($nr11 != $guess11 && $nr22 != $guess22 && $nr33 != $guess33 && $nr44 != $guess44 && $nr55 != $guess55) {$a=0;}

if($a == 0){
	$winorlose=lost;
	$won =20;
	$newgold = $userrow['gold'] - $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");	
}
if($a != 0 && $a == 1){
	$winorlose=lost;
	$won =20;
	$newgold = $userrow['gold'] - $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}


if($a != 0 && $a == 2) {
$winorlose=won;
$won = 2 * 20;
$newgold = $userrow['gold'] + $won;
doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}
	if($a != 0 && $a == 3){
	$winorlose=won;
	$won = 3 * 60;
	$newgold = $userrow['gold'] + $won;
	doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
	}
		if($a != 0 && $a == 4){
		$winorlose=won;
		$won = 4 * 80;
		$newgold = $userrow['gold'] + $won;
		doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
		}
			if($a != 0 && $a == 5){
    	  		$winorlose=won;
			$won = 5 * 120;
			$newgold = $userrow['gold'] + $won;
			doquery("UPDATE {{table}} SET gold='$newgold' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
			}

/////////
///Second page layout
/////////


$page = '<center>';
$page .= '<h3 class="title">{{innsname}} Lottery 20</h3>';
$page .= '<br><br>You got 1 number right = 0 Gold Coins<br>
You got 2 number right = 40 Gold Coins<br>
You got 3 number right = 180 Gold Coins<br>
You got 4 number right = 320 Gold Coins<br>
You got 5 number right = 600 Gold Coins<br>
<br>';
$page .= '<table>';
$page .= '<tr>
<td>Lottery numbers are: <b>'.$nr11.'</b></td>
<td><b>'.$nr22.'</b></td>
<td><b>'.$nr33.'</b></td>
<td><b>'.$nr44.'</b></td>
<td><b>'.$nr55.'</b></td></tr>';
$page .= '<tr>
<td>Your numbers where:  <b>'.$guess1.'</b></td>
<td><b>'.$guess2.'</b></td>
<td><b>'.$guess3.'</b></td>
<td><b>'.$guess4.'</b></td>
<td><b>'.$guess5.'</b></td>';
$page .= '</tr>';
$page .= '</table>';
$page .= '<br><font color=green>You got '.$a.' number(s) right!<br>You '.$winorlose.': <b>'.$won.'</b> Gold Coins</font><br /><br />';
$page .= '<a href=\'index.php\'>Back to Town Square</a> or <a href=\'index.php?do=loteri\'>Play Again</a></center>';

	display($page, "Lottery");

}




/////////
///First PAGE LAYOUT
/////////


$page = '<center>';
$page .= '<h3 class="title">{{innsname}} Lottery 20</h3>';
$page .='<br><h3>Please Choose One Number from each Column</H3><br><p>';

$page .= '<form action=index.php?do=loteri method=post>
1<input type=radio name=choice1 value=1 id=1>|&nbsp;
6<input type=radio name=choice2 value=6 id=1>|&nbsp;
11<input type=radio name=choice3 value=11 id=1>|&nbsp;
16<input type=radio name=choice4 value=16 id=1>|&nbsp;
21<input type=radio name=choice5 value=21 id=1>|&nbsp;
<br>
	2<input type=radio name=choice1 value=2 id=2>|&nbsp;
	7<input type=radio name=choice2 value=7 id=1>|&nbsp;
	12<input type=radio name=choice3 value=12 id=1>|&nbsp;
	17<input type=radio name=choice4 value=17 id=1>|&nbsp;
	22<input type=radio name=choice5 value=22 id=1>|&nbsp;
	<br>
		3<input type=radio name=choice1 value=3 id=3>|&nbsp;
		8<input type=radio name=choice2 value=8 id=1>|&nbsp;
		13<input type=radio name=choice3 value=13 id=1>|&nbsp;
		18<input type=radio name=choice4 value=18 id=1>|&nbsp;
		23<input type=radio name=choice5 value=23 id=1>|&nbsp;
		<br>
			4<input type=radio name=choice1 value=4 id=4>|&nbsp;
			9<input type=radio name=choice2 value=9 id=1>|&nbsp;
			14<input type=radio name=choice3 value=14 id=1>|&nbsp;
			19<input type=radio name=choice4 value=19 id=1>|&nbsp;
			24<input type=radio name=choice5 value=24 id=1>|&nbsp;
			<br>
				5<input type=radio name=choice1 value=5 id=5>|&nbsp;
				10<input type=radio name=choice2 value=10 id=1>|&nbsp;
				15<input type=radio name=choice3 value=15 id=1>|&nbsp;
				20<input type=radio name=choice4 value=20 id=1>|&nbsp;
				25<input type=radio name=choice5 value=25 id=1>|&nbsp;
<p>';



	$page .= '<input type=submit value=OK name=buy></form><br><i><b>To play you need 20 Gold Coins.</b></i>';
	$page .= '<br><a href=\'index.php\'>Back to Town Square</a></center>';

	display($page, "Lottery");







}

	
?>
