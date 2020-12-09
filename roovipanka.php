<?php // Roovipanka.php :: Primary program script, evil alien overlord, you decide.

if (file_exists('install.php')) { die("Please delete <b>install.php</b> from your Dragon Knight directory before continuing."); }
include('lib.php');
include('cookies.php');
$link = opendb();
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);

// Login (or verify) if not logged in.
$userrow = checkcookies();
if ($userrow == false) { 
    if (isset($_GET["do"])) {
        if ($_GET["do"] == "verify") { header("Location: users.php?do=verify"); die(); }
    }
    header("Location: login.php?do=login"); die(); 
}


function roovipanka() {

global $userrow, $numqueries;

if ($userrow['katse'] == '0') { header("Location: index.php?do=roovipanka2"); }
elseif ($userrow['katse'] == '1') { header("Location: index.php?do=murra1"); }
elseif ($userrow['katse'] == '2') { header("Location: index.php?do=murra2"); }
elseif ($userrow['katse'] == '3') { header("Location: index.php?do=murra3"); }

}

function roovipanka2() {
global $userrow, $numqueries;

if ($userrow['katse'] != '0') { header("Location: index.php?do=roovipanka"); die(); }

$bankgold=$userrow['bank'] / 2;
$pangakuld=number_format($bankgold, 0, ' ', ' ');

if (isset($_POST['steal'])) {

//User health

$uhealth = $userrow['currenthp'];

//Guard health
$ghealth = rand($uhealth-10,$uhealth+10);
if($uhealth == 0) { display("Panka ei saa röövida, kui oled surnud.<p><a href=\"index.php\">Linna</a>", "Viga"); die(); }



if($uhealth > $ghealth) {

doquery("UPDATE {{table}} SET katse='3' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 

header("Location: index.php?do=murra3");

}else{

if($uhealth < $ghealth) {
doquery("UPDATE {{table}} SET currenthp='1',gold='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
$page .= "<center><h3 class='title'>Rahvusvaheline pank<h3></center>";
$page .= "Valvurid said su kätte ja andsid peksa! Nad jätsid su piinlema ja röövisid kogu su kulla.";
$page .= "<br /><br /><a href=index.php>Linna</a>";

display($page, "Roovipanka");
die();
}
}
}


$page .= "<center><h3 class='title'>Rahvusvaheline pank<h3></center>";
$page .= "Pangas on $pangakuld kulda.";
$page .= "<form action=index.php?do=roovipanka2 method=post><br />";
$page .= "<input type=submit value='Roovi' name=steal></form><p>";
$page .= "<i>1. ülesanne on valvurist mööda saada.<br>2. ülesanne on seifi kood murda.</i>";
$page .= "<br /><br /><a href=index.php>Linna</a>";

display($page, "Roovipanka");



}

function murra3() {

global $userrow, $numqueries;

if ($userrow['katse'] != '3') { header("Location: index.php?do=roovipanka"); die(); }

$bankgold=$userrow['bank'] / 2;
$pangakuld=number_format($bankgold, 0, ' ', ' ');

///USER NR
$choose1 = !isset($_POST['codeone'])? NULL : $_POST['codeone'];
$choose2 = !isset($_POST['codetwo'])? NULL : $_POST['codetwo'];
$choose3 = !isset($_POST['codethree'])? NULL : $_POST['codethree'];

if ($choose1 == '0') { die("Viga: 1. valik jäi tegemata"); }
if ($choose2 == '0') { die("Viga: 2. valik jäi tegemata"); }
if ($choose3 == '0') { die("Viga: 3. valik jäi tegemata"); }

///SAFE NR
$safecode1 = rand(1,4);
$safecode2 = rand(5,8);
$safecode3 = rand(9,12);

if (isset($_POST['crack'])) {

if($safecode1 == $choose1 && $safecode2 == $choose2 && $safecode3 == $choose3){
$newgold2= $userrow['gold'] + $bankgold;
doquery("UPDATE {{table}} SET gold='$newgold2',katse='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>Rahvusvaheline pank<h3></center>";
$page .="Said läbi mingi ime koodi murtud, sa võitsid $pangakuld kulda!";
$page .= "<br /><a href=index.php>Linna </a>, <a href=index.php?do=roovipanka>Tagasi </a>";
display($page, "Roovipanka");

}else{

doquery("UPDATE {{table}} SET katse='2' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>.::Rahvusvaheline pank::.<h3></center>";
$page .="Kahjuks on kood vale, mine <a href=index.php?do=roovipanka>tagasi</a> ja proovi uuesti. ";
$page .= "Sinu kood oli: <b>$choose1 $choose2 $choose3</b><br>";
$page .="Seifi kood oli: <font color=red>$safecode1 $safecode2 $safecode3</font>";

display($page, "Roovipanka");
die();
}

}

$page .= "<center><h3 class='title'>Rahvusvaheline pank<h3></center>";
$page .= "Oled valvurist mööda saanud. Hakka seifi koodi murdma. Katseid järel: <b>3</b>.";
$page .="<p><center><form action=index.php?do=murra3 method=post>";

$page .="<select name=codeone>";
$page .="
<option value=0></option>
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>";
$page .="</select>";

	$page .="<select name=codetwo>";
	$page .="
	<option value=0></option>
	<option value=5>5</option>
	<option value=6>6</option>
	<option value=7>7</option>
	<option value=8>8</option>";
	$page .="</select>";

		$page .="<select name=codethree>";
		$page .="
		<option value=0></option>
		<option value=9>9</option>
		<option value=10>10</option>
		<option value=11>11</option>
		<option value=12>12</option>";
		$page .="</select>";

$page .="<p><input type=submit value='Murra seifi sisse' name=crack></form>";
$page .="</center>";
$page .= "<br /><a href=index.php>Linna </a>";

display($page, "Röövi panka");

die();

} // lõpeta funktsioon

function murra2() {

global $userrow, $numqueries;

if ($userrow['katse'] != '2') { header("Location: index.php?do=roovipanka"); die(); }

$bankgold=$userrow['bank'] / 2;
$pangakuld=number_format($bankgold, 0, ' ', ' ');

///USER NR
$choose1 = !isset($_POST['codeone'])? NULL : $_POST['codeone'];
$choose2 = !isset($_POST['codetwo'])? NULL : $_POST['codetwo'];
$choose3 = !isset($_POST['codethree'])? NULL : $_POST['codethree'];

if ($choose1 == '0') { die("Viga: 1. valik jäi tegemata"); }
if ($choose2 == '0') { die("Viga: 2. valik jäi tegemata"); }
if ($choose3 == '0') { die("Viga: 3. valik jäi tegemata"); }

///SAFE NR
$safecode1 = rand(1,4);
$safecode2 = rand(5,8);
$safecode3 = rand(9,12);

if (isset($_POST['crack'])) {

if($safecode1 == $choose1 && $safecode2 == $choose2 && $safecode3 == $choose3){
$newgold2= $userrow['gold'] + $bankgold;
doquery("UPDATE {{table}} SET gold='$newgold2',katse='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>.::Rahvusvaheline pank::.<h3></center>";
$page .="Said said läbi mingi ime koodi murtud, sa võitsid $pangakuld kulda!";
$page .= "<br /><a href=index.php>Linna </a>, <a href=index.php?do=roovipanka>Tagasi </a>";
display($page, "Röövi panka");

}else{

doquery("UPDATE {{table}} SET katse='1' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>.::Rahvusvaheline pank::.<h3></center>";
$page .="Kahjuks on kood vale, mine <a href=index.php?do=roovipanka>tagasi</a> ja proovi uuesti. ";
$page .= "Sinu kood oli: <b>$choose1 $choose2 $choose3</b><br>";
$page .="Seifi kood oli: <font color=red>$safecode1 $safecode2 $safecode3</font>";

display($page, "Roovipanka");
die();
}

}

$page .= "<center><h3 class='title'>.::Rahvusvaheline pank::.<h3></center>";
$page .= "Oled valvurist mööda saanud. Hakka seifi koodi murdma.  Katseid järel: <b>2</b>.";
$page .="<p><center><form action=index.php?do=murra2 method=post>";

$page .="<select name=codeone>";
$page .="
<option value=0></option>
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>";
$page .="</select>";

	$page .="<select name=codetwo>";
	$page .="
	<option value=0></option>
	<option value=5>5</option>
	<option value=6>6</option>
	<option value=7>7</option>
	<option value=8>8</option>";
	$page .="</select>";

		$page .="<select name=codethree>";
		$page .="
		<option value=0></option>
		<option value=9>9</option>
		<option value=10>10</option>
		<option value=11>11</option>
		<option value=12>12</option>";
		$page .="</select>";

$page .="<p><input type=submit value='Murra seifi sisse' name=crack></form>";
$page .="</center>";
$page .= "<br /><a href=index.php>Linna </a>";

display($page, "Roovipanka");

die();

}

function murra1() {

global $userrow, $numqueries;

if ($userrow['katse'] != '1') { header("Location: index.php?do=roovipanka"); die(); }

$bankgold=$userrow['bank'] / 2;
$pangakuld=number_format($bankgold, 0, ' ', ' ');

///USER NR
$choose1 = !isset($_POST['codeone'])? NULL : $_POST['codeone'];
$choose2 = !isset($_POST['codetwo'])? NULL : $_POST['codetwo'];
$choose3 = !isset($_POST['codethree'])? NULL : $_POST['codethree'];

if ($choose1 == '0') { die("Viga: 1. valik jäi tegemata"); }
if ($choose2 == '0') { die("Viga: 2. valik jäi tegemata"); }
if ($choose3 == '0') { die("Viga: 3. valik jäi tegemata"); }

///SAFE NR
$safecode1 = rand(1,4);
$safecode2 = rand(5,8);
$safecode3 = rand(9,12);

if (isset($_POST['crack'])) {

if($safecode1 == $choose1 && $safecode2 == $choose2 && $safecode3 == $choose3){
$newgold2= $userrow['gold'] + $bankgold;
doquery("UPDATE {{table}} SET gold='$newgold2',katse='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>Rahvusvaheline pank<h3></center>";
$page .="Said said läbi mingi ime koodi murtud, sa võitsid $pangakuld kulda!";
$page .= "<br /><a href=index.php>Linna </a>, <a href=index.php?do=roovipanka>Tagasi </a>";
display($page, "Roovipanka");

}else{

doquery("UPDATE {{table}} SET katse='0' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
$page .= "<center><h3 class='title'>.::Rahvusvaheline pank::.<h3></center>";
$page .="Kahjuks on kood vale, mine <a href=index.php?do=roovipanka>tagasi</a> ja proovi uuesti. ";
$page .= "Sinu kood oli: <b>$choose1 $choose2 $choose3</b><br>";
$page .="Seifi kood oli: <font color=red>$safecode1 $safecode2 $safecode3</font>";

display($page, "Roovipanka");
die();
}

}

$page .= "<center><h3 class='title'>Rahvusvaheline pank<h3></center>";
$page .= "Oled valvurist mööda saanud. Hakka seifi koodi murdma.  Katseid järel: <b>1</b>.";
$page .="<br /><center><form action=index.php?do=murra1 method=post>";

$page .="<select name=codeone>";
$page .="
<option value=0></option>
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>";
$page .="</select>";

	$page .="<select name=codetwo>";
	$page .="
	<option value=0></option>
	<option value=5>5</option>
	<option value=6>6</option>
	<option value=7>7</option>
	<option value=8>8</option>";
	$page .="</select>";

		$page .="<select name=codethree>";
		$page .="
		<option value=0></option>
		<option value=9>9</option>
		<option value=10>10</option>
		<option value=11>11</option>
		<option value=12>12</option>";
		$page .="</select>";

     $page .="<input type=submit value='Murra seifi sisse' name=crack></form></center><br />";
    $page .= "<br /><b>You may return to the <a href=\"index.php\">Town Square</a>, <br />or use the compass on the left to start exploring.</b><br />\n";      
    
display($page, "Roovipanka");

die();

}

?>
