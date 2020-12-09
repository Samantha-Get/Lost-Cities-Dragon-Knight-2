<?php // forum.php :: realm Forum.

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
if ($forumcontrolrow["verify_email"] == 1 && $forumusersrow["verify"] != 1) { header("Location: forum_users.php?do=verify"); die(); }

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
  $do = explode(":",$_GET["do"]);
    if ($do[0] == "thread") { showthread($do[1], $do[2]); }
    elseif ($do[0] == "new") { newthread(); }
    elseif ($do[0] == "reply") { reply(); }
    elseif ($do[0] == "userslist") { userslist($do[1]); }
} else { forum(0); }

function forum() { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
$totalonlinequery = doquery("SELECT * FROM {{table}} WHERE UNIX_TIMESTAMP(onlinetime) >= '".(time()-300)."' ", "forumusers"); // Change this '".(time()-300)."' to set online time in seconds.
$totalonline = mysql_num_rows($totalonlinequery);
$totalusersquery = doquery("SELECT * FROM {{table}} WHERE id ", "forumusers"); // Change this '".(time()-300)."' to set online time in seconds.
$totalusers = mysql_num_rows($totalusersquery);
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=25% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out of the Forum'>Log Out</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=index.php title='Return to Town'>Town Square</a></td></tr></table>";
$page .= "<hr width=100%>";
$query = doquery("SELECT * FROM {{table}} WHERE parent='0' ORDER BY newpostdate && sticky DESC LIMIT 20", "forum");
$page .= "<table width=100% align=center><tr><td align=center bgcolor=#ffffff width=40%>";
$page .= "<font color=#000000><b>Thread</b></font>";
$page .= "</td><td align=center width=20% bgcolor=#ffffff>";
$page .= "<font color=#000000><b>Started By</b></font>";
$page .= "</td><td align=center width=10% bgcolor=#ffffff>";
$page .= "<font color=#000000><b>Replies</b></font>";
$page .= "</td><td align=center width=10% bgcolor=#ffffff>";
$page .= "<font color=#000000><b>Views</b></font>";
$page .= "</td><td align=center width=20% bgcolor=#ffffff>";
$page .= "<font color=#000000><b>Last Post</b></font>";
$page .= "</td></tr></table>";
$count = 1;
if (mysql_num_rows($query) == 0) { 
$page .= "<table width=100% align=center><tr><td colspan=3 align=center bgcolor=#dddddd>";
$page .= "<font color=#000000><b>No threads in Forum.</b></font>";
$page .= "</td></tr></table>"; }
else { 
while ($row = mysql_fetch_array($query)) { 
if ($row["sticky"] == 1) { $sticky = "<font color=#FF0000><strong>(S)</font></strong>"; } else { $sticky = "" ; }
if ($row["locked"] == 1) { $locked = "<font color=#FF0000><strong>(L)</font></strong>"; } else { $locked = "" ; }
if ($count == 1) { 
$page .= "<table width=100% align=center><tr><td bgcolor=#dddddd width=40%>";
$page .= "$locked$sticky <a href=forum.php?do=thread:".$row["id"].":0 title='View this thread!'><font color=#0000ff>".$row["title"]."</font></a>";
$page .= "</td><td width=20% bgcolor=#dddddd>";
$page .= "<a href=\"index.php?do=onlinechar:".$row["authorid"]."\" title='View this characters profile'>".$row["author"]."</a>";
$page .= "</td><td width=10% bgcolor=#dddddd>";
$page .= "<font color=#000000>".$row["replies"]."</font> ";
$page .= "</td><td width=10% bgcolor=#dddddd>";
$page .= "<font color=#000000>".$row["views"]."</font> ";
$page .= "</td><td width=20% bgcolor=#dddddd>";
$page .= "<font color=#000000>".$row["newpostdate"]."</font> ";
$page .= "</td></tr></table>";
$count = 2; }
else { 
$page .= "<table width=100% align=center><tr><td bgcolor=#eeeeee>";
$page .= "$locked$sticky <a href=forum.php?do=thread:".$row["id"].":0 title='View this thread!'><font color=#0000ff>".$row["title"]."</font></a>";
$page .= "</td><td width=90 bgcolor=#eeeeee>";
$page .= "<a href=\"index.php?do=onlinechar:".$row["authorid"]."\" title='View this characters profile'>".$row["author"]."</a>";
$page .= "</td><td width=50 bgcolor=#eeeeee>";
$page .= "<font color=#000000>".$row["replies"]."</font> ";
$page .= "</td><td width=40 bgcolor=#eeeeee>";
$page .= " <font color=#000000>".$row["views"]."</font> ";
$page .= "</td><td width=70 bgcolor=#eeeeee>";
$page .= "<font color=#000000>".$row["newpostdate"]."</font> ";
$page .= "</td></tr></table>";
$count = 1; } } }
if ($forumusersrow["rights_level"] == 1) { $rights_display = "<font size=3 color=#ff0000><strong>?</font></strong><br />"; } // BANNED USER'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 2) { $rights_display = "<font size=3 color=#0000ff><strong>*</font></strong><br />"; } // USER'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 3) { $rights_display = "<font size=3 color=#0000ff><strong>**</font></strong><br />"; } // MODERATOR'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 4) { $rights_display = "<font size=3 color=#0000ff><strong>***</font></strong><br />"; } // ADMINISTRATER'S RIGHTS LEVEL DISPLAY
$posts = ($forumusersrow["threads"] + $forumusersrow["replied"]);
if ($forumusersrow["rights_level"] == 4) { $admincontrol = "<a href=forum_admin.php?do=forumcontrol title='Go to the Administraters Control Panel'>Admin Panel</a>"; } // IF ADMIN DO // ADMINISTRATER'S EDIT POST LINK
else { $admincontrol = "<a href=mail.php?do=contact_forum_admin title='Contact the Main Forum Admin'>Contact Admin</a><br />"; } // ELSE DO // USER'S CONTACT ADMIN LINK
$page .= "<hr width=100%>";
$page .= "<table width=100% align=center><tr><td width=90><font color=#FF0000><strong>(S)</font></strong> = Stickied</td><td width=90><font color=#FF0000><strong>(L)</font></strong> = Locked</td><td align=right> </td><td width=100 align=right>Total Users: <font color=#ff9933><strong>$totalusers</font></strong></td><td width=100 align=right>Users Online: <font color=#ff9933><strong>$totalonline</font></strong></td></tr></table>";
$page .= "<hr width=100%>";
$page .= "<table width=100% align=center><tr><td width=80 align=center>";
$page .= "$forumusersrow[charname]<br />";
$page .= "<img src=".$forumcontrolrow["avatar_path"]."".$forumusersrow["forumavatar"]." width=50 height=50 border=1>";
$page .= "</td><td >";
$page .= "$rights_display";
$page .= "<a href=forum.php?do=userslist title='View A list of Registered Forum Users'>User List</a><br />";
$page .= "<a href=forum_avatars.php?do=avatar title='View, Upload and Change Your Avatar'>Avatars</a><br />";
$page .= "$admincontrol";
$page .= "</td><td >";
$page .= "Last Visit = $forumusersrow[lastonlinetime]<br />";
$page .= "Total # of Posts = $posts<br />";
$page .= "Total # of Threads Started = $forumusersrow[threads]<br />";
$page .= "Total # Replied To = $forumusersrow[replied]<br />";
$page .= "Last Post = $forumusersrow[lastpost]<br />";
$page .= "Title: $forumusersrow[posttitle]";
$page .= "</td></tr></table>";
$page .= "<hr width=100%>";
$page .= "</td></tr></table>";
display($page, "Forum"); }

function showthread($id, $start) { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' OR parent='$id' ORDER BY id LIMIT $start,1000", "forum");
$query1 = doquery("SELECT title,locked FROM {{table}} WHERE id='$id' LIMIT 1", "forum");
$query2 = doquery("UPDATE {{table}} SET views=views+1 WHERE id='$id'", "forum");
$row1 = mysql_fetch_array($query1);
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=33% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=33% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=33% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table>";
$page .= "<hr width=100%>";
$page .= "<table width=100% ><tr><td colspan=2 align=center bgcolor=#ffffff>";
$page .= "<font color=#000000><b>Reply To Title :: &nbsp;&nbsp; ".$row1["title"]."</b></font>";
$page .= "</td></tr></table>";
$count = 1;
while ($row = mysql_fetch_array($query)) { 
if (($forumusersrow["rights_level"] == 2) && ($row["authorid"] == $forumusersrow["id"])) { $edit = "<a href=forum_edit.php?do=editpost:".$row["id"]." title='User Level Edit Post Link'>Edit Post</a>"; } // USER'S EDIT LINK
elseif ($forumusersrow["rights_level"] == 3) { $edit = "<a href=forum_edit.php?do=editpost1:".$row["id"]." title='Moderator Level Edit Post Link'>Edit Post</a>"; } // MODERATOR'S EDIT LINK
elseif ($forumusersrow["rights_level"] == 4) { $edit = "<a href=forum_edit.php?do=editpost2:".$row["id"]." title='Administrater Level Edit Post Link'>Edit Post</a>"; } // ADMINISTRATER'S EDIT LINK
else { $edit = 'Edit Post'; }
if ($row["rights_level"] == 1) { $rights_display = "<font size=3 color=#ff0000><strong>?</font></strong>"; } // BANNED USER'S RIGHTS LEVEL DISPLAY
if ($row["rights_level"] == 2) { $rights_display = "<font size=3 color=#0000ff><strong>*</font></strong>"; } // USER'S RIGHTS LEVEL DISPLAY
if ($row["rights_level"] == 3) { $rights_display = "<font size=3 color=#0000ff><strong>**</font></strong>"; } // MODERATOR'S RIGHTS LEVEL DISPLAY
if ($row["rights_level"] == 4) { $rights_display = "<font size=3 color=#0000ff><strong>***</font></strong>"; } // ADMINISTRATER'S RIGHTS LEVEL DISPLAY
if ($count == 1) { 
$page .= "<table width=100% align=center><tr><td width=100 align=center bgcolor=#dddddd>";
$page .= "<a href=\"index.php?do=onlinechar:".$row["authorid"]."\" title='View this characters profile'>".$row["author"]."</a>";
$page .= "</td><td bgcolor=#dddddd>";
$page .= "<font color=#000000>".prettyforumdate($row["postdate"])."</font>";
$page .= "</td><td width=80 bgcolor=#dddddd>";
$page .= "<div align=right>[ $edit ]</div>";
$page .= "</td></tr><tr><td bgcolor=#dddddd>";
$page .= "<table width=100% align=center><tr><td bgcolor=#dddddd>";
$page .= "<img src=".$forumcontrolrow["avatar_path"]."".$row["forumavatar"]." width=50 height=50>";
$page .= "</td><td bgcolor=#dddddd>";
$page .= "$rights_display";
$page .= "</td></tr></table>";
$page .= "</td><td align=center colspan=2 bgcolor=#dddddd>";
$page .= "<font color=#000000>".nl2br($row["content"])."</font>";
$page .= "</td></tr></table>";
$page .= "<hr width=100%>";
$count = 2; }
else { 
$page .= "<table width=100% align=center><tr><td width=100 align=center bgcolor=#eeeeee>";
$page .= "<a href=\"index.php?do=onlinechar:".$row["authorid"]."\" title='View this characters profile'>".$row["author"]."</a>";
$page .= "</td><td bgcolor=#eeeeee>";
$page .= "<font color=#000000>".prettyforumdate($row["postdate"])."</font>";
$page .= "</td><td width=80 bgcolor=#eeeeee>";
$page .= "<div align=right>[ $edit ]</div>";
$page .= "</td></tr><tr><td bgcolor=#eeeeee>";
$page .= "<table width=100% align=center><tr><td bgcolor=#eeeeee>";
$page .= "<img src=".$forumcontrolrow["avatar_path"]."".$row["forumavatar"]." width=50 height=50>";
$page .= "</td><td bgcolor=#eeeeee>";
$page .= "$rights_display";
$page .= "</td></tr></table>";
$page .= "</td><td align=center colspan=2 bgcolor=#eeeeee>";
$page .= "<font color=#000000>".nl2br($row["content"])."</font>";
$page .= "</td></tr></table>";
$page .= "<hr width=100%>";
$count = 1; } }
if ($row1["locked"] == "0") { 
$page .= "<table width=100% align=center><tr><td align=center bgcolor=#dddddd><br />";
$page .= "<form action=forum.php?do=reply method=post><input type=hidden name=parent value=$id><input type=hidden name=title value='".$row1["title"]."'><textarea name=content rows=10 cols=44></textarea><br /><input type=submit name=submit value=Submit><input type=reset name=reset value=Reset></form>";
$page .= "</td><td align=center bgcolor=#dddddd>";
$page .= "<font color=#000000><b><u>Emoticons!</b></u></font><br /><br />";
$page .= "<font color=#000000>:p &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."tongue.gif><br />";
$page .= "<font color=#000000>:) &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."smile.gif><br />";
$page .= "<font color=#000000>:( &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."frown.gif><br />";
$page .= "<font color=#000000>;) &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."wink.gif><br />";
$page .= "<font color=#000000>-.- &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."sleep.gif><br />";
$page .= "</td></tr></table>";
$page .= "<hr width=100%>"; }
else { 
$page .= "<font color=#FF0000><strong>!This thread is locked so you can not reply!</strong></font>";
$page .= "<hr width=100%>"; }
$page .= "</td></tr></table>";
display($page, "Forum"); }

function reply() { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
extract($_POST);
$safecontent = makesafe($_POST["content"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."tongue.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."smile.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."frown.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."wink.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."sleep.gif>");
$safecontent = str_replace($textsmilies, $imagesmilies, $safecontent);
if ($safecontent == "" || $safecontent == " ") { } // blank post. do nothing.
$safetitle = makesafe($_POST["title"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."tongue.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."smile.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."frown.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."wink.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."sleep.gif>");
$safetitle = str_replace($textsmilies, $imagesmilies, $safetitle);
if ($safetitle == "" || $safetitle == " ") { } // blank post. do nothing.
$query = doquery("UPDATE {{table}} SET replied=replied+1,lastpost=NOW(),posttitle='Re: $_POST[title]' WHERE charid='".$userrow["id"]."' ", "forumusers");
$query1 = doquery("INSERT INTO {{table}} SET id='',postdate=NOW(),newpostdate=NOW(),author='".$forumusersrow["charname"]."',authorid='".$forumusersrow["id"]."',parent='$parent',replies='0',title='Re: $safetitle',content='$safecontent',forumavatar='$forumusersrow[forumavatar]',rights_level='".$forumusersrow["rights_level"]."' ", "forum");
$query2 = doquery("UPDATE {{table}} SET newpostdate=NOW(),replies=replies+1 WHERE id='$parent' LIMIT 1", "forum");
$query3 = doquery("SELECT * FROM {{table}} WHERE id='$parent' ", "forum"); // STARTS MAIL RESPONSE // WITH QUERY
$row = mysql_fetch_array($query3);
$title = "$row[title] "; // MESSAGE TITLE
$message = "$forumusersrow[charname] has replied to your Post<br />$row[title]<br /><a href=forum.php>Click here</a> to go to the Forums.<br /><br />You need not reply to this Mail."; // MAIL MESSAGE
$query4 = doquery("INSERT INTO {{table}} SET id='', owner='$row[authorid]', sender='".$userrow["id"]."', message='$message', title='$title', date=NOW(), status='Unread' ", "mail"); // ENDS MAIL RESPONSE // WITH QUERY
header("Location: forum.php?do=thread:$parent:0"); 
die(); }

function newthread() { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
$onlinequery = doquery("UPDATE {{table}} SET onlinetime=NOW() WHERE charid='".$userrow["id"]."' ", "forumusers");
if (isset($_POST["submit"])) { 
extract($_POST);
$safecontent = makesafe($_POST["content"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."tongue.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."smile.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."frown.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."wink.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."sleep.gif>");
$safecontent = str_replace($textsmilies, $imagesmilies, $safecontent);
if ($safecontent == "" || $safecontent == " ") { } // blank post. do nothing.
$safetitle = makesafe($_POST["title"]);
$textsmilies = array(":p", ":)", ":(", ";)", "-.-");
$imagesmilies = array("<img src=".$forumcontrolrow["image_smilies_path"]."tongue.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."smile.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."frown.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."wink.gif>", "<img src=".$forumcontrolrow["image_smilies_path"]."sleep.gif>");
$safetitle = str_replace($textsmilies, $imagesmilies, $safetitle);
if ($safetitle == "" || $safetitle == " ") { } // blank post. do nothing.
$query = doquery("UPDATE {{table}} SET threads=threads+1,lastpost=NOW(),posttitle='$safetitle' WHERE charid='".$userrow["id"]."' ", "forumusers");
$query1 = doquery("INSERT INTO {{table}} SET id='',postdate=NOW(),newpostdate=NOW(),author='".$forumusersrow["charname"]."',authorid='".$forumusersrow["id"]."',parent='$parent',title='$safetitle',content='$safecontent',forumavatar='$forumusersrow[forumavatar]',rights_level='".$forumusersrow["rights_level"]."' ", "forum");
header("Location: forum.php"); 
die(); }
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=33% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=33% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=33% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table>";
$page .= "<table width=100% align=center><tr><td align=center colspan=2 bgcolor=#ffffff>";
$page .= "<font color=#000000><b>Make A New Thread</b></font>";
$page .= "</td></tr><tr><td align=center bgcolor=#eeeeee><br />";
$page .= "<form action=forum.php?do=new method=post>";
$page .= "<font color=#000000><b><u>Title:</b></u></font> &nbsp;&nbsp; <input type=text name=title size=30 maxlength=30><br /><br />";
$page .= "<font color=#000000><b><u>Message:</b></u></font><br /><textarea name=content rows=10 cols=44></textarea><br />";
$page .= "<input type=submit name=submit value=Submit>";
$page .= "<input type=reset name=reset value=Reset></form>";
$page .= "</td><td align=center bgcolor=#eeeeee>";
$page .= "<font color=#000000><b><u>Emoticons!</b></u></font><br /><br />";
$page .= "<font color=#000000>:p &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."tongue.gif><br />";
$page .= "<font color=#000000>:) &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."smile.gif><br />";
$page .= "<font color=#000000>:(  &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."frown.gif><br />";
$page .= "<font color=#000000>;) &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."wink.gif><br />";
$page .= "<font color=#000000>-.- &nbsp;=&nbsp;</font><img src=".$forumcontrolrow["image_smilies_path"]."sleep.gif><br />";
$page .= "</td></tr></table>";
$page .= "<hr width=100%>";
$page .= "</td></tr></table>";
display($page, "Forum"); }

function userslist() { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$usersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$row = mysql_fetch_array($usersquery);
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=33% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=33% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=33% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>";
$page .= "</td></tr></table>";
$page .= "<table width=100% align=center><tr><td class=title colspan=2 align=center>";
$page .= "<strong><u>Users List</u></strong>";
$page .= "</td></tr><tr><td colspan=2 align=center>";
$page .= "<hr width=100%>";
$page .= "</td></tr></table>";
$count = 1;
$forumusersquery = doquery("SELECT * FROM {{table}} ORDER BY id", "forumusers");
while ($forumusersrow = mysql_fetch_array($forumusersquery)) { 
if ($forumusersrow["rights_level"] == 1) { $rights_display = "<font size=3 color=#ff0000><strong>?</font></strong>"; } // BANNED USER'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 2) { $rights_display = "<font size=3 color=#0000ff><strong>*</font></strong>"; } // USER'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 3) { $rights_display = "<font size=3 color=#0000ff><strong>**</font></strong>"; } // MODERATOR'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 4) { $rights_display = "<font size=3 color=#0000ff><strong>***</font></strong>"; } // ADMINISTRATER'S RIGHTS LEVEL DISPLAY
if ($forumusersrow["rights_level"] == 1 ) { $rights_level = "Banned"; }
if ($forumusersrow["rights_level"] == 2 ) { $rights_level = "User"; }
if ($forumusersrow["rights_level"] == 3 ) { $rights_level = "Moderator"; }
if ($forumusersrow["rights_level"] == 4 ) { $rights_level = "Administrator"; }
if ($count == 1) { 



$page .= "<table width=100% bgcolor=#eeeeee><tr><td width=30 align=center>
<font color=#000000><strong><u>ID:</u></strong><br />".$forumusersrow["id"]."</font>
</td><td align=center>
<font color=#000000><strong><u>Name:</u></strong><br /><a href=index.php?do=onlinechar:".$forumusersrow["charid"]." title='View this characters profile'>".$forumusersrow["charname"]."</a></font>
</td><td width=100>
<font color=#000000><strong><u>Auth:</u></strong> $rights_display<br />$rights_level</font>
</td><td width=60 align=center>
<font color=#000000><strong><u>Threads:</u></strong><br />".$forumusersrow["threads"]."</font>
</td><td width=60 align=center>
<font color=#000000><strong><u>Replies:</u></strong><br />".$forumusersrow["replied"]."</font>
</td></tr><tr><td colspan=2>
<font color=#000000><strong><u>Reg Date:</u></strong>&nbsp;&nbsp;".$forumusersrow["regdate"]." <br /></font>
<font color=#000000><strong><u>Last Visit:</u></strong>&nbsp;&nbsp;".$forumusersrow["lastonlinetime"]." <br /></font>
<font color=#000000><strong><u>Last Online:</u></strong>&nbsp;&nbsp;".$forumusersrow["onlinetime"]." </font>
</td><td colspan=3>
<font color=#000000><strong><u>Last Post:</u></strong>&nbsp;&nbsp;".$forumusersrow["lastpost"]."<br /></font>
<font color=#000000><strong><u>Post Title:</u></strong>&nbsp;&nbsp;".$forumusersrow["posttitle"]."</font>
</td></tr></table>";
$page .= "<hr width=100%>";
$count = 2; }
else { 
$page .= "<table width=100% bgcolor=#dddddd><tr><td width=30 align=center>
<font color=#000000><strong><u>ID:</u></strong><br />".$forumusersrow["id"]."</font>
</td><td align=center>
<font color=#000000><strong><u>Name:</u></strong><br /><a href=index.php?do=onlinechar:".$forumusersrow["charid"]." title='View this characters profile'>".$forumusersrow["charname"]."</a></font>
</td><td width=100>
<font color=#000000><strong><u>Auth:</u></strong> $rights_display<br />$rights_level</font>
</td><td width=60 align=center>
<font color=#000000><strong><u>Threads:</u></strong><br />".$forumusersrow["threads"]."</font>
</td><td width=60 align=center>
<font color=#000000><strong><u>Replies:</u></strong><br />".$forumusersrow["replied"]."</font>
</td></tr><tr><td colspan=2>
<font color=#000000><strong><u>Reg Date:</u></strong>&nbsp;&nbsp;".$forumusersrow["regdate"]." <br /></font>
<font color=#000000><strong><u>Last Visit:</u></strong>&nbsp;&nbsp;".$forumusersrow["lastonlinetime"]." <br /></font>
<font color=#000000><strong><u>Last Online:</u></strong>&nbsp;&nbsp;".$forumusersrow["onlinetime"]." </font>
</td><td colspan=3>
<font color=#000000><strong><u>Last Post:</u></strong>&nbsp;&nbsp;".$forumusersrow["lastpost"]."<br /></font>
<font color=#000000><strong><u>Post Title:</u></strong>&nbsp;&nbsp;".$forumusersrow["posttitle"]."</font>
</td></tr></table>";
$page .= "<hr width=100%>";
$count = 1; } }
if (mysql_num_rows($forumusersquery) == 0) { 
$page .= "<table width=100%><tr><td width=8% bgcolor=#eeeeee>No users found.</td></tr></table>"; }
$page .= "</td></tr></table>";
display($page, "List Users"); }

?>