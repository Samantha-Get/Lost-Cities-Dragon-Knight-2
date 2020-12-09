<?php // forum_users.php :: Handles forum user account functions.

include('lib.php');
include('cookies.php');
$link = opendb();
$userrow = checkcookies();

if ($userrow == false) { display("The forum is for registered players only.", "Forum"); die(); }

$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);

if ($forumcontrolrow["forum_open"] == 0) { display("<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>!Forum Is Closed!</b></font></td></tr><tr><td align=center><br />
<blink><span class=highlight>The Forum is currently closed for maintanence!<br />Please check back later!<br /></span></blink>
You may also <a href=mail.php?do=contact title='Contact the Admin'>Contact</a> the Admin to enquire why!<br />
or return to the <a href=index.php title='Return to the City!'>Town Square</a>
</td></tr></table> ", "Forum Closed"); die(); }
if ($forumusersrow["rights_level"] == 1) { display("<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>!Banned Forum User!</b></font></td></tr><tr><td align=center><br />
<blink><span class=highlight>You have been blocked from entering this area.<br />Banned Users may not enter this area.<br />Please do not try to enter this area again!<br /><br /></span></blink>
You may also <a href=mail.php?do=contact title='Contact the Admin'>Contact</a> the Admin to enquire why!<br />
or return to the <a href=index.php title='Return to the City!'>Town Square</a>
</td></tr></table> ", "Forum Closed"); die(); }

if (isset($_GET["do"])) { 
$do = $_GET["do"];
if ($do == "register") { register(); }
elseif ($do == "verify") { verify(); }
elseif ($do == "lostpassword") { lostpassword(); }
elseif ($do == "changepassword") { changepassword(); } }

function register() { // Register a new account.
global $userrow, $controlrow;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
$totalonlinequery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-300)."' ", "forumusers"); // Change this '".(time()-300)."' to set online time in seconds.
$totalonline = mysql_num_rows($totalonlinequery);
$totalusersquery = doquery("SELECT * FROM {{table}} WHERE id ", "forumusers"); // Change this '".(time()-300)."' to set online time in seconds.
$totalusers = mysql_num_rows($totalusersquery);
if (isset($_POST["submit"])) { 
extract($_POST);
$errors = 0; $errorlist = "";
// Process username.
if ($username == "") { $errors++; $errorlist .= "Username field is required.<br />"; }
if (preg_match("/[^A-z0-9_\-]/", $username)==1) { $errors++; $errorlist .= "Username must be alphanumeric.<br />"; } // Thanks to "Carlos Pires" from php.net!
$forumusersnamequery = doquery("SELECT username FROM {{table}} WHERE username='$username' LIMIT 1","forumusers");
if (mysql_num_rows($forumusersnamequery) > 0) { $errors++; $errorlist .= "Username already taken - unique username required.<br />"; }
// Process charname.
if ($charname == "") { $errors++; $errorlist .= "Character Name field is required.<br />"; }
if (preg_match("/[^A-z0-9_\-]/", $charname)==1) { $errors++; $errorlist .= "Character Name must be alphanumeric.<br />"; } // Thanks to "Carlos Pires" from php.net!
$forumcharacternamequery = doquery("SELECT charname FROM {{table}} WHERE charname='$charname' LIMIT 1","forumusers");
if (mysql_num_rows($forumcharacternamequery) > 0) { $errors++; $errorlist .= "Character Name already taken - unique Character Name required.<br />"; }
// Process email address.
if ($email1 == "" || $email2 == "") { $errors++; $errorlist .= "Email fields are required.<br />"; }
if ($email1 != $email2) { $errors++; $errorlist .= "Emails don't match.<br />"; }
if (! is_email($email1)) { $errors++; $errorlist .= "Email isn't valid.<br />"; }
$forumemailquery = doquery("SELECT email FROM {{table}} WHERE email='$email1' LIMIT 1","forumusers");
if (mysql_num_rows($forumemailquery) > 0) { $errors++; $errorlist .= "Email already taken - unique email address required.<br />"; }
// Process password.
if (trim($password1) == "") { $errors++; $errorlist .= "Password field is required.<br />"; }
if (preg_match("/[^A-z0-9_\-]/", $password1)==1) { $errors++; $errorlist .= "Password must be alphanumeric.<br />"; } // Thanks to "Carlos Pires" from php.net!
if ($password1 != $password2) { $errors++; $errorlist .= "Passwords don't match.<br />"; }
$password = md5($password1);
if ($errors == 0) { 
if ($forumcontrolrow["verify_email"] == 1) { 
$verifycode = "";
for ($i=0; $i<8; $i++) { 
$verifycode .= chr(rand(65,90)); } }
else { $verifycode='1'; }
if ($userrow["authlevel"] == 1) { $rights_level = "4"; }
else { $rights_level = "2"; }
$query = doquery("INSERT INTO {{table}} SET id='',regdate=NOW(),verify='$verifycode',username='$username',password='$password',email='$email1',charname='$charname',rights_level='$rights_level',charid='".$userrow["id"]."',forumavatar='0.png' ", "forumusers") or die(mysql_error());
if ($forumcontrolrow["verify_email"] == 1) { 
if (sendregmail($email1, $verifycode) == true) { $page = "Your account was created successfully.<br /><br />You should receive an Account Verification email shortly. You will need the verification code contained in that email before you are allowed to log in. Once you have received the email, please visit the <a href=\"forum_users.php?do=verify\">Verification Page</a> to enter your code and login to the Forums."; }
else { $page = "Your account was created successfully.<br /><br />However, there was a problem sending your verification email. Please check with the game administrator to help resolve this problem."; } }
else { $page = "Your account was created succesfully.<br /><br />You may now continue to the ".$forumcontrolrow["forum_name"]."! <a href=\"forum_loginout.php?do=login\">Login Page</a>."; } }
else { $page = "The following error(s) occurred when your account was being made:<br /><span style=\"color:red;\">$errorlist</span><br />Please go back and try again."; } }
else { 
if ($forumcontrolrow["verify_email"] == 1) { $verifytext = "<br /><span class=\"small\">Verification is On! - A verification code will be sent to the address above, and you will not be able to log in without first entering the code. Please be sure to enter your correct email address.</span>"; }
else { $verifytext = "<br />Verification is Off! - No verification code will be sent to the address above"; }
$pagearray["forumname"] = "".$forumcontrolrow["forum_name"]."";
$pagearray["welcome"] = "Greetings! ".$userrow["charname"]." and Welcome! to the Forums.<br />You will have too register with the Forums before you can use them.";
$pagearray["information"] = "Total Members: <font color=#ff9933><strong>$totalusers</font></strong> &nbsp; &nbsp; &nbsp; &nbsp; Members Online: <font color=#ff9933><strong>$totalonline</font></strong><hr width=100%>";
$pagearray["mainbody"] = "<form action=forum_users.php?do=register method=post><table width=80%>
<tr><td width=20%>Username:</td><td><input type=text name=username size=30 maxlength=30><br />Usernames must be 30 alphanumeric characters or less.<br /><br /><br /></td></tr>
<tr><td>Password:</td><td><input type=password name=password1 size=30 maxlength=20></td></tr>
<tr><td>Verify Password:</td><td><input type=password name=password2 size=30 maxlength=20><br />Passwords must be 20 alphanumeric characters or less.<br /><br /><br /></td></tr>
<tr><td>Email Address:</td><td><input type=text name=email1 size=30 maxlength=100></td></tr>
<tr><td>Verify Email:</td><td><input type=text name=email2 size=30 maxlength=100>$verifytext<br /><br /><br /></td></tr>
<tr><td>Character Name:</td><td><input type=text name=charname size=30 maxlength=30></td></tr>
<tr><td colspan=2 align=center><input type=submit name=submit value=Submit> <input type=reset name=reset value=Reset></td></tr></table></form>";
$template = gettemplate("forum_main");
$page = parsetemplate($template, $pagearray, $controlrow); }
display($page, "Register"); }

function verify() {
global $userrow, $controlrow;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
if (isset($_POST["submit"])) {
extract($_POST);
$forumusersquery = doquery("SELECT username,email,verify FROM {{table}} WHERE username='$username' LIMIT 1","forumusers");
if (mysql_num_rows($forumusersquery) != 1) { die("No account with that username."); }
$forumusersrow = mysql_fetch_array($forumusersquery);
if ($forumusersrow["verify"] == 1) { die("Your account is already verified."); }
if ($forumusersrow["email"] != $email) { die("Incorrect email address."); }
if ($forumusersrow["verify"] != $verify) { die("Incorrect verification code."); }
// If we've made it this far, should be safe to update their account.
$updatequery = doquery("UPDATE {{table}} SET verify='1' WHERE username='$username' LIMIT 1","forumusers");
display("Your account was verified successfully.<br /><br />You may now continue to the <a href=\"forum_loginout.php?do=login\">Login Page</a> and start playing the game.<br /><br />Thanks for playing!","Verify Email"); }
$pagearray["forumname"] = "".$forumcontrolrow["forum_name"]."";
$pagearray["welcome"] = "Greetings! ".$userrow["charname"]." Thank you for registering with the Forums.<br />Please enter your username, email address, and the verification code,<br />that was emailed to you to unlock your character.";
$pagearray["information"] = "";
$pagearray["mainbody"] = "<form action=forum_users.php?do=verify method=post><table width=80%><tr><td width=20%>Username:</td><td><input type=text name=username size=30 maxlength=30></td></tr><tr><td>Email Address:</td><td><input type=text name=email size=30 maxlength=100></td></tr><tr><td>Verification Code:</td><td><input type=text name=verify size=10 maxlength=8><br /><br /><br /></td></tr><tr><td colspan=2><input type=submit name=submit value=Submit> <input type=reset name=reset value=Reset></td></tr></table></form>";
$template = gettemplate("forum_main");
$page = parsetemplate($template, $pagearray, $controlrow);
display($page, "Verify Email"); }

function lostpassword() { 
global $userrow, $controlrow;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
if (isset($_POST["submit"])) { 
extract($_POST);
$forumusersquery = doquery("SELECT email FROM {{table}} WHERE email='$email' LIMIT 1","forumusers");
if (mysql_num_rows($forumusersquery) != 1) { die("No account with that email address."); }
$newpass = "";
for ($i=0; $i<8; $i++) {
$newpass .= chr(rand(65,90)); }
$md5newpass = md5($newpass);
$updatequery = doquery("UPDATE {{table}} SET password='$md5newpass' WHERE email='$email' LIMIT 1","forumusers");
if (sendpassemail($email,$newpass) == true) { display("Your new password was emailed to the address you provided.<br /><br />Once you receive it, you may <a href=\"forum_loginout.php?do=login\">Log In</a> and continue playing.<br /><br />Thank you.","Lost Password"); }
else { display("There was an error sending your new password.<br /><br />Please check with the game administrator for more information.<br /><br />We apologize for the inconvience.","Lost Password"); }
die();}
$pagearray["forumname"] = "".$forumcontrolrow["forum_name"]."";
$pagearray["welcome"] = "Greetings! ".$userrow["charname"]." If you've lost your password, enter your email address below and you will be sent a new one.";
$pagearray["information"] = "";
$pagearray["mainbody"] = "<form action=forum_users.php?do=lostpassword method=post>
<table width=80%><tr><td width=20%>Email Address:</td><td>
<input type=text name=email size=30 maxlength=100></td></tr>
<tr><td colspan=2><input type=submit name=submit value=Submit> 
<input type=reset name=reset value=Reset></td></tr></table></form>";
$template = gettemplate("forum_main");
$page = parsetemplate($template, $pagearray, $controlrow);
display($page, "Lost Password"); }

function changepassword() { 
global $userrow, $forumcontrolrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
if (isset($_POST["submit"])) { 
extract($_POST);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE username='$username' LIMIT 1","forumusers");
if (mysql_num_rows($forumusersquery) != 1) { 
die("No account with that username."); }
$forumusersrow = mysql_fetch_array($forumusersquery);
if ($forumusersrow["password"] != md5($oldpass)) { 
die("The old password you provided was incorrect."); }
if (preg_match("/[^A-z0-9_\-]/", $newpass1)==1) { 
die("New password must be alphanumeric."); } // Thanks to "Carlos Pires" from php.net!
if ($newpass1 != $newpass2) { 
die("New passwords don't match."); }
$realnewpass = md5($newpass1);
$updatequery = doquery("UPDATE {{table}} SET password='$realnewpass' WHERE username='$username' LIMIT 1","forumusers");
display("Your password was changed successfully.<br /><br />You have been logged out of the forum to avoid errors.<br /><br />Please <a href=\"forum_loginout.php?do=login\">log back in</a> to continue playing.","Change Password");
die(); }
$pagearray["forumname"] = "".$forumcontrolrow["forum_name"]."";
$pagearray["welcome"] = "Greetings! ".$userrow["charname"]." Use the form below to change your password. All fields are required. New passwords must be 20 alphanumeric characters or less.";
$pagearray["information"] = "";
$pagearray["mainbody"] = "<form action=users.php?do=changepassword method=post><table width=100%>
<tr><td width=20%>Username:</td><td><input type=text name=username size=30 maxlength=30></td></tr>
<tr><td>Old Password:</td><td><input type=password name=oldpass size=20></td></tr>
<tr><td>New Password:</td><td><input type=password name=newpass1 size=20 maxlength=10></td></tr>
<tr><td>Verify New Password:</td><td><input type=password name=newpass2 size=20 maxlength=10><br /><br /><br /></td></tr>
<tr><td colspan=2><input type=submit name=submit value=Submit> <input type=reset name=reset value=Reset></td></tr></table></form>";
$template = gettemplate("forum_main");
$page = parsetemplate($template, $pagearray, $controlrow);
display($page, "Change Password"); }

function sendpassemail($emailaddress, $password) { 
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
extract($forumcontrolrow);
$email = <<<END
You or someone using your email address submitted a Lost Password application at the $forum_name game Forum, located at $forum_url. 
We have issued you a new password so you can log back into the game.
Your new password is: $password
Thanks for playing.
END;
$status = mymail($emailaddress, "$forum_name Lost Password", $email);
return $status; }

function sendregmail($emailaddress, $vercode) {
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
extract($forumcontrolrow);
$verurl = $forum_url . "?do=verify";
$email = <<<END
You or someone using your email address recently signed up for an account on the $forum_name server, located at $forum_url.
This email is sent to verify your registration email. In order to begin using your account, you must verify your email address. 
Please visit the Verification Page ($verurl) and enter the code below to activate your account.
Verification code: $vercode
If you were not the person who signed up for the game, please disregard this message. You will not be emailed again.
END;
$status = mymail($emailaddress, "$forum_name Account Verification", $email);
return $status; }

function mymail($to, $title, $body, $from = '') { // thanks to arto dot PLEASE dot DO dot NOT dot SPAM at artoaaltonen dot fi.
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
extract($forumcontrolrow);
$from = trim($from);
if (!$from) {
$from = '<'.$forumcontrolrow["admin_email"].'>'; }
$rp    = $forumcontrolrow["admin_email"];
$org    = '$forum_url';
$mailer = 'PHP';
$head  = '';
$head  .= "Content-Type: text/plain \r\n";
$head  .= "Date: ". date('r'). " \r\n";
$head  .= "Return-Path: $rp \r\n";
$head  .= "From: $from \r\n";
$head  .= "Sender: $from \r\n";
$head  .= "Reply-To: $from \r\n";
$head  .= "Organization: $org \r\n";
$head  .= "X-Sender: $from \r\n";
$head  .= "X-Priority: 3 \r\n";
$head  .= "X-Mailer: $mailer \r\n";
$body  = str_replace("\r\n", "\n", $body);
$body  = str_replace("\n", "\r\n", $body);
return mail($to, $title, $body, $head); }

?>