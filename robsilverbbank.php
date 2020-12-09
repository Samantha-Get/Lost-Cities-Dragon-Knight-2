<?php


function robbsilver(){
global $userrow, $numqueries;

$banksilver=$userrow['banksilver'] / 200;

///USER NR
$choose1 = !isset($_POST['codeone'])? NULL : $_POST['codeone'];
$choose2 = !isset($_POST['codetwo'])? NULL : $_POST['codetwo'];
$choose3 = !isset($_POST['codethree'])? NULL : $_POST['codethree'];
$choose4 = !isset($_POST['codefour'])? NULL : $_POST['codefour'];
$choose5 = !isset($_POST['codefive'])? NULL : $_POST['codefive'];
///SAFE NR
$safecode1 = rand(3,4); // Change this to 1,1 or 2,2 etc for 1 only safe code, or random 1-5
$safecode2 = rand(8,9);  // Change this to 6,6 or 7,7 etc for 1 only safe code, or random 6-10
$safecode3 = rand(13,14);  // Change this to 11,11 or 12,12 etc for 1 only safe code, or random 11-15
$safecode4 = rand(18,19);  // Change this to 11,11 or 12,12 etc for 1 only safe code, or random 16-20
$safecode5 = rand(23,24);  // Change this to 11,11 or 12,12 etc for 1 only safe code, or random 21-25

if (isset($_POST['crack'])) {

if($safecode1 == $choose1 && $safecode2 == $choose2 && $safecode3 == $choose3 && $safecode4 == $choose4 && $safecode5 == $choose5){
$newsilver2= $userrow['silver'] + $banksilver;
doquery("UPDATE {{table}} SET silver='$newsilver2' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
doquery("UPDATE {{table}} SET banksilver='$banksilver/200' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>{{towncityname}} {{banksname}}<h3></center>";
$page .="<br /><blockquote><blockquote>Well Done! You have opened the Code. You find $banksilver Silver Coins in side the Safe.</blockquote></blockquote>";
$page .= "<br /><center><a href='index.php' class='myButton2'>{{towncityname}} Town Square</a></center><br>";
display($page, "Robb Bank");
}else{

$page .= "<center><h3 class='title'>{{towncityname}} {{banksname}}<h3></center>";
$page .="<br><blockquote><blockquote>You failed to enter the right codes, go back and try again.";
$page .="<br><br>Your code was: $choose1 $choose2 $choose3 $choose4 $choose5";
$page .="<br><br>Safe code was: <font color=red>$safecode1 $safecode2 $safecode3 $safecode4 $safecode5</font></blockquote></blockquote>
<br /><center><a href='index.php' class='myButton2'>{{towncityname}} Town Square</a></center><br>";
display($page, "Robb Bank");
die(); } }

if (isset($_POST['steal'])) {

//User health
$uhealth = $userrow['currenthp'];

//Guard health
$ghealth = rand($uhealth-2,$uhealth+4);
if($uhealth == 0){ display("<center><h3 class='title'>{{towncityname}} {{banksname}}<h3></center><br><blockquote><blockquote>The Near Dead are unable to rob the Bank.</blockquote></blockquote>
<br /><center><a href='index.php' class='myButton2'>{{towncityname}} Town Square</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?do=inn' class='myButton2'>{{innsname}}</a></center><br>", "ERROR"); die(); }

if($uhealth > $ghealth) {
$page .= "<center><h3 class='title'>{{towncityname}} {{banksname}}<h3></center>";
$page .= "<br /><blockquote><blockquote>So you have passed the guard and made it to the safe.
<br />Good Job. You now have three chances to crack the {{towncityname}} {{banksname}} Vault safe code.
<br />Be Alert and Carefully use your skills to open the safe.</blockquote></blockquote>";
$page .="<br /><center><form action=index.php?do=robb method=post>";

$page .= "<blockquote><blockquote><br />Enter your First Combination Code.<br />";
$page .="<select name=codeone>";
$page .="
<option value='<?php echo $choose1;?>' SELECTED><?php echo $kickplayer;?></option>
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>
<option value=5>5</option>";
$page .="</select>";

	$page .= "<br />Now Enter your Second Combination Code.<br />";
	$page .="<select name=codetwo>";
	$page .="
	<option value='<?php echo $choose2;?>' SELECTED><?php echo $kickplayer;?></option>
	<option value=6>6</option>
	<option value=7>7</option>
	<option value=8>8</option>
	<option value=9>9</option>
	<option value=10>10</option>";
	$page .="</select>";

		$page .= "<br />Now Enter your Third Combination Code.<br />";
		$page .="<select name=codethree>";
		$page .="
		<option value='<?php echo $choose3;?>' SELECTED><?php echo $kickplayer;?></option>
		<option value=11>11</option>
		<option value=12>12</option>
		<option value=13>13</option>
		<option value=14>14</option>
		<option value=15>15</option>";
		$page .="</select>";

			$page .= "<br />Now Enter your Fourth Combination Code.<br />";
			$page .="<select name=codefour>";
			$page .="
			<option value='<?php echo $choose4;?>' SELECTED><?php echo $kickplayer;?></option>
			<option value=16>16</option>
			<option value=17>17</option>
			<option value=18>18</option>
			<option value=19>19</option>
			<option value=20>20</option>";
			$page .="</select>";

				$page .= "<br />Finally, the Fifth and Last combination Code of the Safe.<br />";
				$page .="<select name=codefive>";
				$page .="
				<option value='<?php echo $choose5;?>' SELECTED><?php echo $kickplayer;?></option>
				<option value=21>21</option>
				<option value=22>22</option>
				<option value=23>23</option>
				<option value=24>24</option>
				<option value=25>25</option>";
				$page .="</select>";

$page .="<br /><br /><input type='submit' value='Unlock safe' name='crack' class='myButton2'></form>";
$page .="</center></blockquote></blockquote>";
$page .= "<br /><center><a href='index.php' class='myButton2'>{{towncityname}} Town Square</a></center><br />";

display($page, "Robb Bank");

die();
}else{

if($uhealth < $ghealth) {
doquery("UPDATE {{table}} SET currenthp='2' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
doquery("UPDATE {{table}} SET currentmp='2' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
doquery("UPDATE {{table}} SET currenttp='5' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page .= "<center><h3 class='title'>{{towncityname}} {{banksname}}<h3></center>";
$page .= "<br /><blockquote><blockquote>The {{banksname}} Bank Guard spots you and runs after you.";
$page .= "<br />The Chase continues for what seems like hours, then the Guard has you in sight and yells <em>STOP AND DROP THE Silver</em>. <br><br>You smile back at him and throw a couple of knives towards his direction. The Guard then yells <em>Stop or you will regret it!</em> You return his threat with a couple of more knives that miss the guard again. The Guard then hits you in the leg and upper chest with his own knives.<br><br>You will live to see another day, but you have lost all but 2 Hit Points, 2 Magic Points, 5 Travel Points and need to rest at the Inn. If were lucky this time and will be able to continue your exploring again.</blockquote></blockquote>";
$page .= "<br /><center><a href='index.php' class='myButton2'>{{towncityname}} Town Square</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?do=inn' class='myButton2'>{{innsname}}</a></center><br />";

display($page, "Robb Bank");
die(); } } }

$page .= "<center><h3 class='title'>{{towncityname}} {{banksname}}<h3></center>";
$page .= "<br /><blockquote><blockquote><center><img src='images/items/silver-coins-large.png' align='absmiddle' width='72' height='72' alt='Silver Coins' border='0'>This bank has $banksilver Silver Coins in its Vault. <form action=index.php?do=robb method=post><input type='submit' value='Robb the Bank' name='steal' class='myButton2'></form></center><br />";
$page .= "1. Challenge is to get past the Bank Guard without being Caught. Being caught can end in death.<br>
<br />2. Your second Challenge is to crack Open the safe.</blockquote></blockquote>";
$page .= "<br /><center><a href='index.php' class='myButton2'>{{towncityname}} Town Square</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?do=inn' class='myButton2'>{{innsname}}</a></center><br />";


display($page, "Robb Bank"); }

?>