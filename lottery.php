<?
function lottery_presentation() {
global $userrow;
if ($userrow["lottery"] == 0 ) { display("<center><br /><br><img src='images/lottery/lottery_erreur.png' /><br /><br>We apologize, but it seems that you have taken part in the lottery today!<br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br />", "The Lottery [ Lottery 50 ]"); die(); }
$page = "<center><br /><br><img src='images/lottery/lottery_presentation.jpg' /><br /><br>Welcome to the lottery<br>For just <font color='#C8003C'>50 Gold Coins</font> you can participate in the lottery for a chance to win big.<br />Odds 1 to 3 to Win <font color='#008000'>50 to 150 Gold Coins</font>.<br><br><b>Your Statistics</b><br> <b>Gold won: »</b> ".$userrow["lottogains"]."<br>
<b>Times you have participated:</b> ".$userrow["partlotto"]."
<br><br><a href='index.php?do=lottery_participation' class='myButton2'>Participate</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='index.php?do=town' class='myButton2'>Town</a></center><br /><br />
";

display($page, "The Lottery [ Lottery 50 ]");
}

function lottery_participation() {

global $userrow;


if ($userrow["gold"] < 50 ) { display("<center><br /><br><img src='images/lottery/lottery_erreur.png' /><br /><br>You do not have enough gold to buy a ticket!<br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br />", "The Lottery [ Lottery 50 ]"); die(); }

$deaths = $userrow["gold"] - 50;
$deaths2 = $userrow["partlotto"] + 1;

if($userrow["lottery"] == '1')
{
$query = doquery("UPDATE {{table}} SET gold='$deaths', partlotto='$deaths2', lottery='1' WHERE id='".$userrow['id']."' ", "users");
}
$page .= "
<center><br /><br><img src='images/lottery/lottery_ticket_achat.jpg' /><br /><br>You have purchased a Lottery Ticket!<br><br>
<b>did you win?</b><br /><br /><a href='index.php?do=lottery_results' class='myButton2'>Check the results.</a></center>
";

display($page, "The Lottery [ Lottery 50 ]");
}

function lottery_results() {
global $userrow;

if ($userrow["lottery"] == 0 ) { display("<center><br /><br><img src='images/lottery/lottery_erreur.png' /><br /><br>An error has occurred, Please try again.<br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br />", "The Lottery [ Lottery 50 ]"); die(); }

$goldfouille = rand(1,3);
if ($goldfouille == 1) {
$gold = rand(50,150);
$id=$userrow['id'];

mysql_query(' UPDATE dk_users SET gold=gold+'.$gold.', lottogains=lottogains+'.$gold.' WHERE id='.$userrow['id'].' ');

$title= 'The Lottery [ Have you Won ]';
$page = '<center><br /><br><img src="images/lottery/lottery_victoire_titre.jpg" /><br /><br>You have won the lottery! !<br><br><a href="index.php?do=lottery_update" class="myButton2">Continue</a><br>';
$page.= '</center>';
display($page, $title);
}
else {
$title= 'The Lottery [ You have Lost ]';
$page = "<center><br /><br><img src='images/lottery/lottery-loser.jpg' /><br /><br>You have lost the lottery, but you can try again for another <font color='#C8003C'>50 Gold Coins</font>.<br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br />";
display($page, $title);
}
}

function lottery_update() {
global $userrow;

if ($userrow["lottery"] == 0 ) { display("<center><br /><br><img src='images/lottery/lottery_erreur.png' /><br /><br>An error has occurred. Please try again.<br><br><a href='index.php?do=lottery_update'>Continue</a><br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br />", "The Lottery [ Lottery 50 ]"); die(); }


if($userrow["lottery"] == 1)
{
$query = doquery("INSERT INTO {{table}} SET gains='".$userrow['username']."', date=NOW()", "loto");
}

$page = "<center><br /><br><img src='images/lottery/dice.jpg' /><br><br>You have been recorded in the Lottery history.<br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br />";

display($page, "The Lottery [ Lottery 50 ]");
}

function history_lottery() {

$histoquery = doquery("SELECT gains, date FROM {{table}} ORDER BY date DESC LIMIT 50", "loto" );
$page = "<center><br /><br><img src='images/lottery/dice1.jpg' /><br><br><a href='index.php?do=history_lottery' class='myButton2'>Lottery History</a>&nbsp;&nbsp;<a href='index.php?do=lottery_presentation' class='myButton2'>Lottery</a>&nbsp;&nbsp;&nbsp;<a href='gamblingmenu.html' class='myButton2'>Gambling Menu</a>&nbsp;&nbsp;&nbsp;<a href='index.php' class='myButton2'>Town Square</a></center><br /><br /><div align='center'><table width='50%'><tr><td align='center' colspan='2'><div align='center'><h3 class='title'>Last 50 Players</h3></div></td></tr>
";


while ($row = mysql_fetch_array($histoquery))
$page .= "<tr><td></td><td>".$userrow['username']." » ".$row["gains"]." ".$row["lotogains"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date » ".$row["date"]."</td></tr>
";

if (mysql_num_rows($histoquery) == 0) { $page .= "<tr><td width='8%'>No Players have won the Lottery.</td></tr>
"; }
$page .= "</table></div>";

display($page, "The Lottery [ Lottery History 50 ]");

}
?>