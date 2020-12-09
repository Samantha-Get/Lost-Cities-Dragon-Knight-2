<?php // forumusers.php :: 

include('lib.php');
include('cookies.php');
$link = opendb();
$userrow = checkcookies();

if ($userrow == false) { display("The forum is for registered players only.", "Forum"); die(); }

$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);

if ($userrow["id"] != $forumusersrow["charid"]) { header("Location: forum_users.php?do=register"); die(); }
if (($userrow["id"] == $forumusersrow["charid"]) && ($forumusersrow["loggedin"] == 0)) { header("Location: forum_loginout.php?do=login"); die(); }
if ($forumcontrolrow["verify_email"] == 1 && $forumusersrow["verify"] == 1) { header("Location: forum_users.php?do=verify"); die(); }

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
</td></tr></table> ", "User Banned"); die(); }

if (isset($_GET["do"])) { 
  $do = explode(":",$_GET["do"]);
    if ($do[0] == "editpost") { editpost($do[1]); } // RIGHTS LEVEL 2 EDIT POSTS // USER'S
    elseif ($do[0] == "editpost1") { editpost1($do[1]); } // RIGHTS LEVEL 3 EDIT POSTS // MODERATOR'S
    elseif ($do[0] == "editpost2") { editpost2($do[1]); } } // RIGHTS LEVEL 4 EDIT POSTS // MAIN ADMIN

// START OF EDIT POSTS FUNCTION // MEMBER'S ONLY rights_level = 1 //
function editpost($id) { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
// START OF MEMBER BLOCKED
if ($forumusersrow["rights_level"] == 3) { // BLOCK MODERATORS
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<hr width=100%><table width=100% align=center><tr><td width=80 align=center>";
$page .= "You have been blocked from entering this area.<br />Moderators may not enter this area.<br />Please do not try to enter this area again!<br /><br />";
$page .= "<a href=mail.php?do=contact title='Contact the Main Forum Admin'>Contact</a> The Forum Admin to enquire why!<br /><br />";
$page .= "Return to the <a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table><hr width=100%></td></tr></table>";
display($page, "Forum"); }
if ($forumusersrow["rights_level"] == 4) { // BLOCK ADMINISTRATORS LOL
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<hr width=100%><table width=100% align=center><tr><td width=80 align=center>";
$page .= "You have been blocked from entering this area.<br />Administrators may not enter this area.<br />Please do not try to enter this area again!<br /><br />";
$page .= "<a href=mail.php?do=contact title='Contact the Main Forum Admin'>Contact</a> The Forum Admin to enquire why!<br /><br />";
$page .= "Return to the <a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table><hr width=100%></td></tr></table>";
display($page, "Forum"); }
// END OF MEMBER BLOCKED
if (isset($_POST["submit"])) { 
extract($_POST);
$errors = 0;
$errorlist = "";
if ($content == "") { $errors++; $errorlist .= "Content is required.<br />"; }
if ($errors == 0) { 
$safecontent = makesafe($_POST["content"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."/tongue.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/smile.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/frown.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/wink.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/sleep.png>");
$safecontent = str_replace($textsmilies, $imagesmilies, $safecontent);
if ($safecontent == "" || $safecontent == " ") { } // blank post. do nothing.
$query = doquery("UPDATE {{table}} SET newpostdate=NOW(),content='$safecontent' WHERE id='$id' LIMIT 1", "forum");
$page = "<table width=100% align=center>
<tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center>
<tr><td class=title width=50% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=50% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table>
<br />Post was Edited!
</td></tr></table>";
header("Refresh: 3; forum.php");
display($page,"Update Post"); }
else { display("<table width=100% align=center>
<tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center>
<tr><td class=title width=50% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=50% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table><br /><br />
<b>Errors:</b><br /><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.
</td></tr></table>", "Update Post");
header("Refresh: 3; forum.php"); } }
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "forum");
$row = mysql_fetch_array($query);
if ($row[parent] == 0) { $parent = "<strong>Parent Post</strong>"; } else { $parent = "$row[title]"; }
if ($row['sticky'] == 0) { $sticky = No ; } else { $sticky = Yes ; }
if ($row['locked'] == 0) { $locked = No ; } else { $locked = Yes ; }
$page = <<<END
<table width=100% align=center><tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center><tr><td class=title width=33% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=33% align=center>
<a href=forum.php?do=thread:$row[id]:0 title='View this post'>View Post</a>
</td><td class=title width=33% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table>
<table align=center width="100%">
<tr><td>Post ID#: {{id}}</td><td >Parent ID#: [ {{parent}} ]</td><td >$parent 
</td></tr></table>
<table align=center width="100%"><tr><td >
Replie's: {{replies}} </td><td >View's: {{views}}</td><td >Stickied: $sticky</td><td >Locked: $locked
</td></tr></table>
<form action="forum_edit.php?do=editpost:$id" method="post">
<table align=center width="100%"><tr><td align=center>
<strong>You need to replace the img src line with matching emote code.</strong><br />
<img src=images/smilies/tongue.png> tongue.png = :p &nbsp; &nbsp; 
<img src=images/smilies/smile.png> smile.png = :) &nbsp; &nbsp; 
<img src=images/smilies/frown.png> frown.png = :( <br />
<img src=images/smilies/wink.png> wink.png = ;) &nbsp; &nbsp; 
<img src=images/smilies/sleep.png> sleep.png = -.- &nbsp; &nbsp; 
</td></tr><tr><td align=center>
<strong>Content:</strong><br/><textarea cols="55" rows="20" name="content" wrap="physical">{{content}}</textarea>
</td></tr><tr><td align=center>
<input type="submit" name="submit" value="Submit"> <input type="reset" name="reset" value="Reset">
</td></tr></table>
</form>
</td></tr></table>
END;
$page = parsetemplate($page, $row);
display($page, "Edit Forum"); }
// END OF EDIT POSTS FUNCTION // MEMBER'S ONLY rights_level = 1 //

// START OF EDIT POSTS FUNCTION // MODERATOR'S ONLY rights_level = 2 //
function editpost1($id) { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
// START OF MEMBER BLOCKED
if ($forumusersrow["rights_level"] == 2) { // BLOCK USERS
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<hr width=100%><table width=100% align=center><tr><td width=80 align=center>";
$page .= "You have been blocked from entering this area.<br />Users may not enter this area.<br />Please do not try to enter this area again!<br /><br />";
$page .= "<a href=mail.php?do=contact title='Contact the Main Forum Admin'>Contact</a> The Forum Admin to enquire why!<br /><br />";
$page .= "Return to the <a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table><hr width=100%></td></tr></table>";
display($page, "Forum"); }
if ($forumusersrow["rights_level"] == 4) { // BLOCK ADMINISTRATORS LOL
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<hr width=100%><table width=100% align=center><tr><td width=80 align=center>";
$page .= "You have been blocked from entering this area.<br />Administrators may not enter this area.<br />Please do not try to enter this area again!<br /><br />";
$page .= "<a href=mail.php?do=contact title='Contact the Main Forum Admin'>Contact</a> The Forum Admin to enquire why!<br /><br />";
$page .= "Return to the <a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table><hr width=100%></td></tr></table>";
display($page, "Forum"); }
// END OF MEMBER BLOCKED
if (isset($_POST['deletereply'])) { 
$sql ="update dk_forum set replies=replies-1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['addreply'])) { 
$sql ="update dk_forum set replies=replies+1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['deleteview'])) { 
$sql ="update dk_forum set views=views-1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['addview'])) { 
$sql ="update dk_forum set views=views+1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['sticky'])) {
$sql ="update  dk_forum set sticky='1' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['unsticky'])) {
$sql ="update  dk_forum set sticky='0' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['lock'])) {
$sql ="update  dk_forum set locked='1' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['unlock'])) {
$sql ="update  dk_forum set locked='0' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST["submit"])) { 
extract($_POST);
$errors = 0;
$errorlist = "";
if ($content == "") { $errors++; $errorlist .= "Content is required.<br />"; }
if ($errors == 0) { 
$safecontent = makesafe($_POST["content"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."/tongue.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/smile.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/frown.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/wink.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/sleep.png>");
$safecontent = str_replace($textsmilies, $imagesmilies, $safecontent);
if ($safecontent == "" || $safecontent == " ") { } // blank post. do nothing.
$query = doquery("UPDATE {{table}} SET newpostdate=NOW(),content='$safecontent' WHERE id='$id' LIMIT 1", "forum");
$page = "<table width=100% align=center>
<tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center>
<tr><td class=title width=50% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=50% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table>
<br />Post was Edited!
</td></tr></table>";
header("Refresh: 3; forum.php");
display($page,"Update Post"); }
else { display("<table width=100% align=center>
<tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center>
<tr><td class=title width=50% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=50% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table><br /><br />
<b>Errors:</b><br /><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.
</td></tr></table>", "Update Post");
header("Refresh: 3; forum.php"); } }
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "forum");
$row = mysql_fetch_array($query);
if ($row[parent] == 0) { $parent = "<strong>Parent Post</strong>"; } else { $parent = "$row[title]"; }
if ($row['sticky'] == 0) { $sticky = No ; } else { $sticky = Yes ; }
if ($row['locked'] == 0) { $locked = No ; } else { $locked = Yes ; }
$page = <<<END
<table width=100% align=center><tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center><tr><td class=title width=33% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=33% align=center>
<a href=forum.php?do=thread:$row[id]:0 title='View this post'>View Post</a>
</td><td class=title width=33% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table>
<table align=center width="100%">
<tr><td width="20%">ID#:</td><td>{{id}} &nbsp; &nbsp; $parent</td></tr>
<tr><td width="20%">Title:</td><td>{{title}}</td></tr>
<tr><td width="20%">Parent ID#:</td><td>[ {{parent}} ] &nbsp;&nbsp; ID# Of Initial Post if this is a Reply</td></tr>
<tr><td width="20%">Author:</td><td>{{author}}</td></tr>
<tr><td width="20%">Post Date:</td><td>{{postdate}}</td></tr>
</table>
<form action="forum_edit.php?do=editpost1:$id" method=post>
<table align=center width="100%">
<tr><td width="20%">Replies:</td><td>{{replies}}</td><td><input type=submit value='Delete a reply' name=deletereply><input type=submit value='Add a reply' name=addreply></td></tr>
<tr><td width="20%">Views:</td><td>{{views}}</td><td><input type=submit value='Delete a View' name=deleteview><input type=submit value='Add a View' name=addview></td></tr>
<tr><td width="20%">Sticky:</td><td>{{sticky}}</td><td><input type=submit value='Sticky' name=sticky><input type=submit value='Un Sticky' name=unsticky></td></tr>
<tr><td width="20%">Locked:</td><td>{{locked}}</td><td><input type=submit value='Lock' name=lock><input type=submit value='Un Lock' name=unlock></td></tr>
</table>
</form>
<br /><form action="forum_edit.php?do=editpost1:$id" method="post">
<table align=center width="100%">
<tr><td width="15%">Emoticons:</td><td><strong>Sorry! - You need to replace the img src line with matching emote code, if you edit anything here.</strong><br /><br />:p &nbsp; = &nbsp; <img src=images/smilies/tongue.png> &nbsp;&nbsp; tongue.png <br /><br /> :) &nbsp; = &nbsp; <img src=images/smilies/smile.png> &nbsp;&nbsp; smile.png <br /><br /> :(  &nbsp; = &nbsp; <img src=images/smilies/frown.png> &nbsp;&nbsp; frown.png <br /><br /> ;) &nbsp; = &nbsp; <img src=images/smilies/wink.png> &nbsp;&nbsp; wink.png <br /><br /> -.- &nbsp; = &nbsp; <img src=images/smilies/sleep.png> &nbsp;&nbsp; sleep.png</td></tr>
<tr><td width="15%">Content:</td><td><textarea cols="48" rows="20" name="content" wrap="physical">{{content}}</textarea></td></tr>
<tr><td colspan=2 align=center><input type="submit" name="submit" value="Submit"> <input type="reset" name="reset" value="Reset"></td></tr>
</table>
</form>
</td></tr></table>
END;
$page = parsetemplate($page, $row);
display($page, "Edit Forum"); }
// END OF EDIT POSTS FUNCTION // MODERATOR'S ONLY rights_level = 2 //

// START OF EDIT POSTS FUNCTION // ADMINISTRATER'S ONLY rights_level = 3 //
function editpost2($id) { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
// START OF MEMBER BLOCKED
if ($forumusersrow["rights_level"] == 2) { // BLOCK USERS
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<hr width=100%><table width=100% align=center><tr><td width=80 align=center>";
$page .= "You have been blocked from entering this area.<br />Users may not enter this area.<br />Please do not try to enter this area again!<br /><br />";
$page .= "<a href=mail.php?do=contact title='Contact the Main Forum Admin'>Contact</a> The Forum Admin to enquire why!<br /><br />";
$page .= "Return to the <a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table><hr width=100%></td></tr></table>";
display($page, "Forum"); }
if ($forumusersrow["rights_level"] == 3) { // BLOCK MODERATORS
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<hr width=100%><table width=100% align=center><tr><td width=80 align=center>";
$page .= "You have been blocked from entering this area.<br />Moderators may not enter this area.<br />Please do not try to enter this area again!<br /><br />";
$page .= "<a href=mail.php?do=contact title='Contact the Main Forum Admin'>Contact</a> The Forum Admin to enquire why!<br /><br />";
$page .= "Return to the <a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table><hr width=100%></td></tr></table>";
display($page, "Forum"); }
// END OF MEMBER BLOCKED
if (isset($_POST['delete'])) { 
$sql ="delete from dk_forum where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error()."");
header("Location: forum.php"); }
if (isset($_POST['deletereply'])) { 
$sql ="update dk_forum set replies=replies-1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['addreply'])) { 
$sql ="update dk_forum set replies=replies+1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['deleteview'])) { 
$sql ="update dk_forum set views=views-1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['addview'])) { 
$sql ="update dk_forum set views=views+1 where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['sticky'])) {
$sql ="update  dk_forum set sticky='1' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['unsticky'])) {
$sql ="update  dk_forum set sticky='0' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['lock'])) {
$sql ="update  dk_forum set locked='1' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST['unlock'])) {
$sql ="update  dk_forum set locked='0' where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error().""); }
if (isset($_POST["submit"])) { 
extract($_POST);
$errors = 0;
$errorlist = "";
if ($content == "") { $errors++; $errorlist .= "Content is required.<br />"; }
if ($errors == 0) { 
$safecontent = makesafe($_POST["content"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."/tongue.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/smile.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/frown.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/wink.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/sleep.png>");
$safecontent = str_replace($textsmilies, $imagesmilies, $safecontent);
if ($safecontent == "" || $safecontent == " ") { } // blank post. do nothing.
$safetitle = makesafe($_POST["title"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."/tongue.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/smile.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/frown.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/wink.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."/sleep.png>");
$safetitle = str_replace($textsmilies, $imagesmilies, $safetitle);
if ($safetitle == "" || $safetitle == " ") { } // blank post. do nothing.
$query = doquery("UPDATE {{table}} SET newpostdate=NOW(),title='$safetitle',content='$safecontent' WHERE id='$id' LIMIT 1", "forum");
$page = "<table width=100% align=center>
<tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center>
<tr><td class=title width=50% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=50% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table>
<br />Post was Edited sucsessfully!
</td></tr></table>";
header("Refresh: 3; forum.php");
display($page,"Update Post"); }
else { display("<table width=100% align=center>
<tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center>
<tr><td class=title width=50% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=50% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table><br /><br />
<b>Errors:</b><br /><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.
</td></tr></table>", "Update Post");
header("Refresh: 3; forum.php"); } }
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "forum");
$row = mysql_fetch_array($query);
if ($row[parent] == 0) { $parent = "<strong>Parent Post</strong>"; } else { $parent = "$row[title]"; }
if ($row['sticky'] == 0) { $sticky = No ; } else { $sticky = Yes ; }
if ($row['locked'] == 0) { $locked = No ; } else { $locked = Yes ; }
$page = <<<END
<table width=100% align=center><tr><td class=title colspan=2 align=center border=1>
<b><u>Edit Post</u></b></td></tr><tr><td align=center>
<table width=100% align=center><tr><td class=title width=33% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=33% align=center>
<a href=forum.php?do=thread:$row[id]:0 title='View this post'>View Post</a>
</td><td class=title width=33% align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
</td></tr></table>
<table align=center width="100%">
<tr><td width="20%">ID#:</td><td>{{id}} &nbsp; &nbsp; $parent</td></tr>
<tr><td width="20%">Title:</td><td>{{title}}</td></tr>
<tr><td width="20%">Parent ID#:</td><td>[ {{parent}} ] &nbsp;&nbsp; ID# Of Initial Post if this is a Reply</td></tr>
<tr><td width="20%">Author:</td><td>{{author}}</td></tr>
<tr><td width="20%">Post Date:</td><td>{{postdate}}</td></tr>
</table>
<form action="forum_edit.php?do=editpost2:$id" method=post>
<table align=center width="100%">
<tr><td width="20%">Replies:</td><td>{{replies}}</td><td><input type=submit value='Delete a reply' name=deletereply><input type=submit value='Add a reply' name=addreply></td></tr>
<tr><td width="20%">Views:</td><td>{{views}}</td><td><input type=submit value='Delete a View' name=deleteview><input type=submit value='Add a View' name=addview></td></tr>
<tr><td width="20%">Sticky:</td><td>{{sticky}}</td><td><input type=submit value='Sticky' name=sticky><input type=submit value='Un Sticky' name=unsticky></td></tr>
<tr><td width="20%">Locked:</td><td>{{locked}}</td><td><input type=submit value='Lock' name=lock><input type=submit value='Un Lock' name=unlock></td></tr>
</table>
</form>
<form action="forum_edit.php?do=editpost2:$id" method="post">
<table align=center width="100%"><tr><td align=center>
<strong>You need to replace the img src line with matching emote code.</strong><br />
<img src=images/smilies/tongue.png> tongue.png = :p &nbsp; &nbsp; 
<img src=images/smilies/smile.png> smile.png = :) &nbsp; &nbsp; 
<img src=images/smilies/frown.png> frown.png = :( <br />
<img src=images/smilies/wink.png> wink.png = ;) &nbsp; &nbsp; 
<img src=images/smilies/sleep.png> sleep.png = -.- &nbsp; &nbsp; 
</td></tr><tr><td align=center>
<strong>Title:</strong> &nbsp; <textarea cols="30" rows="1" name="title">{{title}}</textarea>
</td></tr><tr><td align=center>
<strong>Content:</strong><br /><textarea cols="55" rows="20" name="content" wrap="physical">{{content}}</textarea>
</td></tr><tr><td align=center>
<input type="submit" name="submit" value="Submit"> <input type="reset" name="reset" value="Reset"> &nbsp;&nbsp; <input type="submit" value="Delete" name="delete">
</td></tr></table>
</form>
</td></tr></table>
END;
$page = parsetemplate($page, $row);
display($page, "Edit Forum"); }
// END OF EDIT POSTS FUNCTION // ADMINISTRATER'S ONLY rights_level = 3 //

?>