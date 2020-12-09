<?php

include "config.php";

function loteri() {
global $userrow, $numqueries;
$usersilver = $userrow["silver"];

if (isset($_POST['buy'])) {

////////////////////////////
// Here you can change the value of cash. 10 silver coins is default value which is needed to play the game.
////////////////////////////

$cash = 20;

if ($cash > $userrow["silver"]) {display("<center><blockquote>You need 20 Silver Coins to Play!<br /><br />
<br /><br /><center><a href=index.php?do=loteri class=myButton2>Play Again</a>&nbsp;&nbsp;<a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></center>                                                                                                                                              ", "Lottery"); die(); }
			
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

if($nr11 == $guess11) {$a=$a+1;}
	if($nr22 == $guess22) {$a=$a+1;}
		if($nr33 == $guess33) {$a=$a+1;}
			if($nr44 == $guess44) {$a=$a+1;}
				if($nr55 == $guess55) {$a=$a+1;}
					elseif($nr11 != $guess11 && $nr22 != $guess22 && $nr33 != $guess33 && $nr44 != $guess44 && $nr55 != $guess55) {$a=0;}

if($a == 0){
	$winorlose=lost;
	$won =20;
	$newsilver = $userrow['silver'] - $won;
	doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");	
}
if($a != 0 && $a == 1){
	$winorlose=lost;
	$won =20;
	$newsilver = $userrow['silver'] - $won;
	doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}


if($a != 0 && $a == 2) {
$winorlose=won;
$won = 2 * 10;
$newsilver = $userrow['silver'] + $won;
doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
}
	if($a != 0 && $a == 3){
	$winorlose=won;
	$won = 3 * 40;
	$newsilver = $userrow['silver'] + $won;
	doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
	}
		if($a != 0 && $a == 4){
		$winorlose=won;
		$won = 4 * 125;
		$newsilver = $userrow['silver'] + $won;
		doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
		}
			if($a != 0 && $a == 5){
    	  		$winorlose=won;
			$won = 5 * 200;
			$newsilver = $userrow['silver'] + $won;
			doquery("UPDATE {{table}} SET silver='$newsilver' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
			}

/////////
///Second page layout
/////////


$page = '<center>';
$page .= '<h3 class="title">{{innsname}} Lottery 20</h3>';
$page .= '<br><br>
<div style=text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;><center><table width=40% border=0 cellpadding=1 cellspacing=1 style=border-width: 0px; background-color: #ffffff;>
<tr valign=top><td><div style=text-align: left;>1 number right = 0 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>2 number right = 20 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>3 number right = 120 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>4 number right = 500 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>5 number right = 1000 Silver Coins</div</td></tr>
</table>
</center></div>
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
$page .= '<br>You got '.$a.' number(s) right!<br>You '.$winorlose.': <b>'.$won.'</b> Silver Coins<br /><br />';
$page .= '<center><blockquote><a href=index.php?do=loteri class=myButton2>Play Again</a>&nbsp;&nbsp;<a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></blockquote></center>';

	display($page, "Lottery10");

}




/////////
///First PAGE LAYOUT
/////////


$page = '<center>';
$page .= '<h3 class="title">{{innsname}} Lottery 20</h3>';
$page .='<br><h3>Please Choose One Number from each Column</H3><br><p>';

$page .= '<form action=index.php?do=loteri method=post>
01<input type=radio name=choice1 value=1 id=1>&nbsp;&nbsp;&nbsp;
06<input type=radio name=choice2 value=6 id=1>&nbsp;&nbsp;&nbsp;
11<input type=radio name=choice3 value=11 id=1>&nbsp;&nbsp;&nbsp;
16<input type=radio name=choice4 value=16 id=1>&nbsp;&nbsp;&nbsp;
21<input type=radio name=choice5 value=21 id=1>&nbsp;&nbsp;&nbsp;
<br>
	02<input type=radio name=choice1 value=2 id=2>&nbsp;&nbsp;&nbsp;
	07<input type=radio name=choice2 value=7 id=1>&nbsp;&nbsp;&nbsp;
	12<input type=radio name=choice3 value=12 id=1>&nbsp;&nbsp;&nbsp;
	17<input type=radio name=choice4 value=17 id=1>&nbsp;&nbsp;&nbsp;
	22<input type=radio name=choice5 value=22 id=1>&nbsp;&nbsp;&nbsp;
	<br>
		03<input type=radio name=choice1 value=3 id=3>&nbsp;&nbsp;&nbsp;
		08<input type=radio name=choice2 value=8 id=1>&nbsp;&nbsp;&nbsp;
		13<input type=radio name=choice3 value=13 id=1>&nbsp;&nbsp;&nbsp;
		18<input type=radio name=choice4 value=18 id=1>&nbsp;&nbsp;&nbsp;
		23<input type=radio name=choice5 value=23 id=1>&nbsp;&nbsp;&nbsp;
		<br>
			04<input type=radio name=choice1 value=4 id=4>&nbsp;&nbsp;&nbsp;
			09<input type=radio name=choice2 value=9 id=1>&nbsp;&nbsp;&nbsp;
			14<input type=radio name=choice3 value=14 id=1>&nbsp;&nbsp;&nbsp;
			19<input type=radio name=choice4 value=19 id=1>&nbsp;&nbsp;&nbsp;
			24<input type=radio name=choice5 value=24 id=1>&nbsp;&nbsp;&nbsp;
			<br>
				05<input type=radio name=choice1 value=5 id=5>&nbsp;&nbsp;&nbsp;
				10<input type=radio name=choice2 value=10 id=1>&nbsp;&nbsp;&nbsp;
				15<input type=radio name=choice3 value=15 id=1>&nbsp;&nbsp;&nbsp;
				20<input type=radio name=choice4 value=20 id=1>&nbsp;&nbsp;&nbsp;
				25<input type=radio name=choice5 value=25 id=1>&nbsp;&nbsp;&nbsp;
<p>';

$page .= '<br><br>
<div style=text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;><center><table width=40% border=0 cellpadding=1 cellspacing=1 style=border-width: 0px; background-color: #ffffff;>
<tr valign=top><td><div style=text-align: left;>1 number right = 0 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>2 number right = 20 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>3 number right = 120 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>4 number right = 500 Silver Coins</div</td></tr>
<tr valign=top><td><div style=text-align: left;>5 number right = 1000 Silver Coins</div</td></tr>
</table>
</center></div>
<br>';



	$page .= '<input type=submit value=OK name=buy class=myButton2></form><br><center><blockquote>20 Silver Coins to Play.';
	$page .= '<br><br><center><blockquote><a href=index.php?do=loteri class=myButton2>Play Again</a>&nbsp;&nbsp;<a href=index.php?do=banksilver class=myButton2>Silver Bank</a>&nbsp;&nbsp;<a href=index.php class=myButton2>Town Square</a></blockquote></center>';

	display($page, "Lottery");
}

	
?>
