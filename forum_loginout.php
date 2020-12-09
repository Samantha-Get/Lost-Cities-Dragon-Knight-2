<?php // forum_loginout.php :: Handles logins and cookies.

include('lib.php');
include('cookies.php');
$link = opendb();
$userrow = checkcookies();

if (isset($_GET["do"])) { 
    if ($_GET["do"] == "login") { login(); }
    elseif ($_GET["do"] == "logout") { logout(); } }

function login() { 
global $userrow;
    include('config.php');
    $link = opendb();
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
if (isset($_POST["submit"])) { 
$query = doquery("SELECT * FROM {{table}} WHERE username='".$_POST["username"]."' AND password='".md5($_POST["password"])."' LIMIT 1", "forumusers");
if (mysql_num_rows($query) != 1) { 
die("Invalid username or password. Please go back and try again."); }
$row = mysql_fetch_array($query);
if (isset($_POST["rememberme"])) { 
$expiretime = time()+31536000; $rememberme = 1; }
else { 
$expiretime = 0; $rememberme = 0; }
$cookie = $row["charid"] . " " . $row["username"] . " " . md5($row["password"] . "--" . $dbsettings["secretword"]) . " " . $rememberme;
setcookie("dkforum", $cookie, $expiretime, "/", "", 0);
$onlinequery = doquery("UPDATE {{table}} SET onlinetime=NOW(),loggedin='1' WHERE charid='".$userrow["id"]."' ", "forumusers");
header("Location: forum.php");
die(); }
$totalonlinequery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-300)."' ", "forumusers"); // Change this '".(time()-300)."' to set online time in seconds.
$totalonline = mysql_num_rows($totalonlinequery);
$totalusersquery = doquery("SELECT * FROM {{table}} WHERE id ", "forumusers"); // Change this '".(time()-300)."' to set online time in seconds.
$totalusers = mysql_num_rows($totalusersquery);
$pagearray["welcome"] = "Greetings! ".$userrow["charname"]." and Welcome! to the Forums.<br />You have to Log In to use the Forums";
$pagearray["information"] = "<table width=100% align=center><tr><td width=90> </td><td width=90> </td><td align=right></td> <td width=100 align=right>Total Users: <font color=#ff9933><strong>$totalusers</font></strong></td><td width=100 align=right>Users Online: <font color=#ff9933><strong>$totalonline</font></strong></td></tr></table>";
$pagearray["forumname"] .= "".$forumcontrolrow["forum_name"]."";
$pagearray["mainbody"] = "<form action=forum_loginout.php?do=login method=post><table width=75%>
<tr><td width=30%>Username:</td><td><input type=text size=30 name=username></td></tr>
<tr><td>Password:</td><td><input type=password size=30 name=password></td></tr>
<tr><td>Remember me?</td><td><input type=checkbox name=rememberme value=yes> Yes</td></tr>
<tr><td colspan=2><input type=submit name=submit value='Log In'> &nbsp;&nbsp; </td></tr>
<tr><td colspan=2>
You may also <a href=forum_users.php?do=changepassword>change your password</a>, or 
<a href=forum_users.php?do=lostpassword>request a new one</a> if you've lost yours.
</td></tr></table></form>";
$template = gettemplate("forum_main");
$page = parsetemplate($template, $pagearray, $controlrow);
display($page, "Log In"); }

function logout() { 
global $userrow, $numqueries;
setcookie("dkforum", "", time()-100000, "/", "", 0);
$onlinequery = doquery("UPDATE {{table}} SET onlinetime=NOW(),lastonlinetime=NOW(),loggedin='0' WHERE charid='".$userrow["id"]."' ", "forumusers");
header("Location: forum.php");
die(); }

?>