<?php // forumadmin.php :: HANDLES ALL FORUM ADMIN EDITING CONTROLS

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
if ($forumusersrow["rights_level"] < 4) { header("Location: forum.php"); die(); } // BLOCKS ALL BUT ADMIN FROM USING THIS AREA
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
    if ($do[0] == "users") { users(); }
    elseif ($do[0] == "edituser") { edituser($do[1]); }
    elseif ($do[0] == "forumcontrol") { forumcontrol(); } }

function forumcontrol($id) { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
if (isset($_POST["submit"])) { 
extract($_POST);
$errors = 0;
$errorlist = "";
if ($verify_email == "") { $errors++; $errorlist .= "Verify E-Mail is required.<br />"; }
if ($admin_email == "") { $errors++; $errorlist .= "Admin E-Mail is required.<br />"; }
if ($forum_open == "") { $errors++; $errorlist .= "Forum Open is required.<br />"; }
if ($forum_name == "") { $errors++; $errorlist .= "Forum Name is required.<br />"; }
if ($avatar_path == "") { $errors++; $errorlist .= "Avatar Path is required.<br />"; }
if ($control_icons_path == "") { $errors++; $errorlist .= "Control Avatar Path is required.<br />"; }
if ($image_smilies_path == "") { $errors++; $errorlist .= "Smilies Path is required.<br />"; }
if ($avatar_filesize == "") { $errors++; $errorlist .= "Avatar Filesize is required.<br />"; }
if ($avatar_max_hieght == "") { $errors++; $errorlist .= "Max Hieght is required.<br />"; }
if ($avatar_max_width == "") { $errors++; $errorlist .= "Max Width is required.<br />"; }
if ($forum_url == "") { $errors++; $errorlist .= "Forum Url is required"; }
if ($errors == 0) { 
$query = doquery("UPDATE {{table}} SET verify_email='$verify_email',admin_email='$admin_email',forum_open='$forum_open',forum_name='$forum_name',avatar_path='$avatar_path',control_icons_path='$control_icons_path',image_smilies_path='$image_smilies_path',avatar_filesize='$avatar_filesize',avatar_max_hieght='$avatar_max_hieght',avatar_max_width='$avatar_max_width',forum_url='$forum_url' WHERE id='1' LIMIT 1", "forumcontrol");
header("Location: forum_admin.php?do=forumcontrol");
display("<div align=center><strong>Forum Control has been updated.</strong></div>","Forum Control"); }
else { 
header("Location: forum_admin.php?do=forumcontrol");
display("<div align=center><strong><b>Errors:</b><br /><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.</strong></div>", "Forum Control"); } }
$query = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$row = mysql_fetch_array($query);
if ($row["forum_open"] == 0 ) { $forum_open = "Closed"; }
if ($row["forum_open"] == 1 ) { $forum_open = "Open"; }
if ($row["verify_email"] == 0 ) { $verify_email = "Off"; }
if ($row["verify_email"] == 1 ) { $verify_email = "On"; }
$page = <<<END
<form action="forum_admin.php?do=forumcontrol:$id" method="post">
<table width="100%">
<tr><td class=title colspan=2 align=center><font size=3><b>$forumcontrolrow[forum_name]</b></font></td></tr><td colspan=2>
<table width=100% align=center>
<tr><td class=title width=25% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=25% align=center>
<a href=forum_admin.php?do=forumcontrol title='Return to the Admin Control Panel'>Forum Control</a>
</td><td class=title width=25% align=center>
<a href=forum_admin.php?do=users title='Return to the main forum index'>Edit Users</a>
</td></tr></table>
<tr><td width=100% class=title colspan=2 align=center><strong><u>Edit Forum Control Settings</u></strong></td></tr>
<tr><td colspan=2 align=center><hr width=100%></td></tr>
<tr><td width="25%">ID:</td><td>{{id}}</td></tr>
<tr><td width="20%"><span class="highlight">Forum is $forum_open:</span></td><td><select name="forum_open"><option value="1" {{open1select}}>Open</option><option value="0" {{open0select}}>Closed</option></select><br /><span class="small">Close the Forum if you are upgrading or working on settings and don't want to cause odd errors for end-users. Closing the Forum will completely halt all activity.</span></td></tr>
<tr><td width="20%">Admin Email:</td><td><input type="text" name="admin_email" size="30" maxlength="100" value="{{admin_email}}" /><br /><span class="small">Please specify your email address. This gets used when the Forum has to send an email to users.</span></td></tr>
<tr><td width="20%">Email Verification:<br /><span class="highlight">Is Turned $verify_email</span></td><td><select name="verify_email"><option value="0" {{selectverify0}}>Disabled</option><option value="1" {{selectverify1}}>Enabled</option></select><br /><span class="small">Make users verify their email address for added security.</span></td></tr>
<tr><td width="25%">Forum Name:</td><td><input type="text" name="forum_name" size="30" maxlength="40" value="{{forum_name}}" /><br />Name of Your Forum</td></tr>
<tr><td width="25%">Forum Url:</td><td><input type="text" name="forum_url" size="30" maxlength="40" value="{{forum_url}}" /><br />Location of your Forum</td></tr>
<tr><td width="25%">Avatar Path:</td><td><input type="text" name="avatar_path" size="30" maxlength="30" value="{{avatar_path}}" /><br />Path to Forum Avatars Folder</td></tr>
<tr><td width="25%">Control Avatar Path:</td><td><input type="text" name="control_icons_path" size="30" maxlength="30" value="{{control_icons_path}}" /><br />Path to Control Icons Folder</td></tr>
<tr><td width="25%">Smilies Path:</td><td><input type="text" name="image_smilies_path" size="30" maxlength="30" value="{{image_smilies_path}}" /><br />Path to Smilies Folder</td></tr>
<tr><td width="25%">Avatar Filesize:</td><td><input type="text" name="avatar_filesize" size="10" maxlength="10" value="{{avatar_filesize}}" /><br />Maxamum Avatar Filesize in Bytes ( Default = 1048576 ; 1mb )</td></tr>
<tr><td width="25%">Avatar Hieght:</td><td><input type="text" name="avatar_max_hieght" size="4" maxlength="4" value="{{avatar_max_hieght}}" /><br />Avatar Maximum Hieght</td></tr>
<tr><td width="25%">Avatar Width:</td><td><input type="text" name="avatar_max_width" size="4" maxlength="4" value="{{avatar_max_width}}" /><br />Avatar Maximum Width</td></tr>
<tr><td colspan=2 align=center><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /></td></tr>
</table>
<hr width=100%>
</form>
END;
   if ($row["verify_email"] == 0) { $row["selectverify0"] = "selected=\"selected\" "; } else { $row["selectverify0"] = ""; }
   if ($row["verify_email"] == 1) { $row["selectverify1"] = "selected=\"selected\" "; } else { $row["selectverify1"] = ""; }
   if ($row["forum_open"] == 1) { $row["open1select"] = "selected=\"selected\" "; } else { $row["open1select"] = ""; }
   if ($row["forum_open"] == 0) { $row["open0select"] = "selected=\"selected\" "; } else { $row["open0select"] = ""; }
$page = parsetemplate($page, $row);
display($page, "Forum Control"); }

function users() {
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$query = doquery("SELECT * FROM {{table}} ORDER BY id", "forumusers");
$page = "<table width=100%>";
$page .= "<tr><td class=title colspan=2 align=center><font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><td colspan=2>";
$page .= "<table width=100% align=center>";
$page .= "<tr><td class=title width=25% align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td class=title width=25% align=center>";
$page .= "<a href=forum_admin.php?do=forumcontrol title='Return to the Admin Control Panel'>Forum Control</a>";
$page .= "</td><td class=title width=25% align=center>";
$page .= "<a href=forum_admin.php?do=users title='Return to the main forum index'>Edit Users</a>";
$page .= "</td></tr></table>";
$page .= "<tr><td class=title colspan=2 align=center>";
$page .= "<strong><u>Edit Forum Users</u></strong>";
$page .= "</td></tr>";
$page .= "<tr><td colspan=2 align=center>";
$page .= "<hr width=100%>";
$page .= "</td></tr><tr><td align=center>";
$count = 1;
while ($row = mysql_fetch_array($query)) {
if ($count == 1) { 
$page .= "<table width=100%><tr><td width=8% bgcolor=#eeeeee>";
$page .= " ".$row["charid"]." ";
$page .= "</td><td bgcolor=#eeeeee>";
$page .= "<a href=forum_admin.php?do=edituser:".$row["id"].">".$row["charname"]."</a>";
$page .= "</td></tr></table>";
$count = 2; }
else { 
$page .= "<table width=100%><tr><td width=8% bgcolor=#ffffff>";
$page .= " ".$row["charid"]." ";
$page .= "</td><td bgcolor=#ffffff>";
$page .= "<a href=\"forum_admin.php?do=edituser:".$row["id"]."\">".$row["charname"]."</a>";
$page .= "</td></tr></table>";
$count = 1; } }
if (mysql_num_rows($query) == 0) { 
$page .= "<table width=100%><tr><td width=8% bgcolor=#eeeeee>No users found.";
$page .= "</td></tr></table>"; }
$page .= "<hr width=100%>";
$page .= "</td></tr></table>";
display($page, "Edit Forum Users"); }

function edituser($id) {
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
if (isset($_POST['delete'])) { 
$sql ="delete from dk_forumusers where id=$id";
mysql_query($sql) or die("MySQL error: ".mysql_error()."");
header("Location: forum_admin.php?do=users"); }
if (isset($_POST["submit"])) {
extract($_POST);
$errors = 0;
$errorlist = "";
if ($id == "") { $errors++; $errorlist .= "User ID# is required.<br />"; }
if ($username == "") { $errors++; $errorlist .= "User Name is required.<br />"; }
if ($charid == "") { $errors++; $errorlist .= "Char ID# is required.<br />"; }
if ($charname == "") { $errors++; $errorlist .= "Char Name is required.<br />"; }
if ($email == "") { $errors++; $errorlist .= "E-Mail is required.<br />"; }
if ($forumavatar == "") { $errors++; $errorlist .= "Forum Avatar is required.<br />"; }
if ($threads == "") { $errors++; $errorlist .= "Threads Started is required.<br />"; }
if ($replied == "") { $errors++; $errorlist .= "Threads Replied To is required.<br />"; }
if ($regdate == "") { $errors++; $errorlist .= "Reg Date is required.<br />"; }
if ($onlinetime == "") { $errors++; $errorlist .= "Online Time is required.<br />"; }
if ($lastonlinetime == "") { $errors++; $errorlist .= "Last Online Time is required.<br />"; }
if ($lastpost == "") { $errors++; $errorlist .= "Last Post Time is required.<br />"; }
if ($posttitle == "") { $errors++; $errorlist .= "Last Post Title is required.<br />"; }
if ($rights_level == "") { $errors++; $errorlist .= "Rights level is required.<br />"; }
if ($errors == 0) { 
$safeposttitle = makesafe($_POST["posttitle"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."tongue.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."smile.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."frown.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."wink.png>", "<img src=".$forumcontrolrow["image_smilies_path"]."sleep.png>");
$safeposttitle = str_replace($textsmilies, $imagesmilies, $safeposttitle);
if ($safeposttitle == "" || $safeposttitle == " ") { } // blank post. do nothing.
$updatequery = <<<END
UPDATE {{table}} SET id='$id',username='$username',charid='$charid',charname='$charname',
email='$email',forumavatar='$forumavatar',threads='$threads',replied='$replied',regdate='$regdate',
onlinetime='$onlinetime',lastonlinetime='$lastonlinetime',lastpost='$lastpost',posttitle='$safeposttitle',
rights_level='$rights_level' WHERE id="$id" LIMIT 1
END;
$query = doquery($updatequery, "forumusers");
header("Location: forum_admin.php?do=edituser:$id");
display("User updated.","Edit Forum Users"); } 
else { 
header("Location: forum_admin.php?do=edituser:$id");
display("<b>Errors:</b><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Users"); } }       
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "forumusers");
$row = mysql_fetch_array($query);
$rights_level1name = '(1)= Banned' ;
$rights_level2name = '(2)= User' ;
$rights_level3name = '(3)= Moderator' ;
$rights_level4name = '(4)= Administrator' ;
if ($row["rights_level"] == 1 ) { $rights_level = "Banned"; }
if ($row["rights_level"] == 2 ) { $rights_level = "User"; }
if ($row["rights_level"] == 3 ) { $rights_level = "Moderator"; }
if ($row["rights_level"] == 4 ) { $rights_level = "Administrator"; }
if ($row["rights_level"] == 1) { $rights_display = "<font size=3 color=#ff0000><strong>?</font></strong>"; } // BANNED USER'S RIGHTS LEVEL DISPLAY
if ($row["rights_level"] == 2) { $rights_display = "<font size=3 color=#0000ff><strong>*</font></strong>"; } // USER'S RIGHTS LEVEL DISPLAY
if ($row["rights_level"] == 3) { $rights_display = "<font size=3 color=#0000ff><strong>**</font></strong>"; } // MODERATOR'S RIGHTS LEVEL DISPLAY
if ($row["rights_level"] == 4) { $rights_display = "<font size=3 color=#0000ff><strong>***</font></strong>"; } // ADMINISTRATER'S RIGHTS LEVEL DISPLAY
$page = <<<END
<table width=100%>
<tr><td class=title colspan=4 align=center><font size=3><b>$forumcontrolrow[forum_name]</b></font></td></tr><td colspan=2>
<table width=100% align=center>
<tr><td class=title width=25% align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td class=title width=25% align=center>
<a href=forum_admin.php?do=forumcontrol title='Return to the Admin Control Panel'>Forum Control</a>
</td><td class=title width=25% align=center>
<a href=forum_admin.php?do=users title='Return to the main forum index'>Edit Users</a>
</td></tr></table>
<tr><td class=title colspan=4 align=center>
<strong><u>Edit Forum Users</u></strong>
</td></tr><tr><td colspan=4 align=center>
<hr width=100%>
<form action="forum_admin.php?do=edituser:$id" method="post">
</td></tr>
<tr><td width="30%">User ID#:</td><td><input type="text" name="id" size="2" maxlength="2" value="{{id}}" /></td></tr>
<tr><td width="30%">User Name:</td><td><input type="text" name="username" size="30" maxlength="30" value="{{username}}" /></td></tr>
<tr><td width="30%">Character ID#:</td><td><input type="text" name="charid" size="2" maxlength="2" value="{{charid}}" /></td></tr>
<tr><td width="30%">Character Name:</td><td><input type="text" name="charname" size="30" maxlength="30" value="{{charname}}" /></td></tr>
<tr><td width="30%">E-Mail:</td><td><input type="text" name="email" size="30" maxlength="30" value="{{email}}" /></td></tr>
<tr><td width="30%">Forum Avatar:</td><td><input type="text" name="forumavatar" size="4" maxlength="8" value="{{forumavatar}}" /><br /><img src=$forumcontrolrow[avatar_path]/$row[forumavatar] width=50 height=50></td></tr>
<tr><td width="30%">Threads Started:</td><td><input type="text" name="threads" size="3" maxlength="5" value="{{threads}}" /></td></tr>
<tr><td width="30%">Threads Replied To:</td><td><input type="text" name="replied" size="3" maxlength="5" value="{{replied}}" /></td></tr>
<tr><td width="30%">Reg Date:</td><td><input type="text" name="regdate" size="20" maxlength="20" value="{{regdate}}" /></td></tr>
<tr><td width="30%">Online Time:</td><td><input type="text" name="onlinetime" size="20" maxlength="20" value="{{onlinetime}}" /></td></tr>
<tr><td width="30%">Last Online Time:</td><td><input type="text" name="lastonlinetime" size="20" maxlength="20" value="{{lastonlinetime}}" /></td></tr>
<tr><td width="30%">Last Post Time:</td><td><input type="text" name="lastpost" size="20" maxlength="20" value="{{lastpost}}" /></td></tr>
<tr><td width="30%">Last Post Title:</td><td><input type="text" name="posttitle" size="30" maxlength="100" value="{{posttitle}}" /></td></tr>
<tr><td colspan=2 align=center><strong>You need to replace the img src line with matching emote code.</strong><br /><img src=images/smilies/tongue.png> tongue.png = :p &nbsp; &nbsp; <img src=images/smilies/smile.png> smile.png = :) &nbsp; &nbsp; <img src=images/smilies/frown.png> frown.png = :( <br /><img src=images/smilies/wink.png> wink.png = ;) &nbsp; &nbsp; <img src=images/smilies/sleep.png> sleep.png = -.-  </td></tr>
<tr><td width="30%">Rights Level:</td><td> Current Level = {{rights_level}} &nbsp; $rights_level &nbsp; $rights_display</td></tr>
<tr><td colspan=2 align=center><select name="rights_level"><option value="1" {{rights_level1select}}>$rights_level1name</option><option value="2" {{rights_level2select}}>$rights_level2name</option><option value="3" {{rights_level3select}}>$rights_level3name</option><option value="4" {{rights_level4select}}>$rights_level4name</option></select></td></tr>
<tr><td colspan=2 align=center><spanclass="small">Set to "Banned" to temporarily (or permanently) ban a Forum User.</span></td></tr>
<tr><td colspan=2 align=center><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /> <input type="submit" value="Delete User" name="delete"></td></tr>
</table>
<hr width=100%>
</form>
END;
  if ($row["rights_level"] == 1) { $row["rights_level1select"] = "selected=\"selected\" "; } else { $row["rights_level1select"] = ""; }
  if ($row["rights_level"] == 2) { $row["rights_level2select"] = "selected=\"selected\" "; } else { $row["rights_level2select"] = ""; } 
  if ($row["rights_level"] == 3) { $row["rights_level3select"] = "selected=\"selected\" "; } else { $row["rights_level3select"] = ""; }
  if ($row["rights_level"] == 4) { $row["rights_level4select"] = "selected=\"selected\" "; } else { $row["rights_level4select"] = ""; }
$page = parsetemplate($page, $row);
display($page, "Edit Forum Users"); }

?>