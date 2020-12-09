<?php // forum_install.php :: 

include('config.php');
include('lib.php');

$link = opendb();
$start = getmicrotime();

if (isset($_GET["page"])) {
    $page = $_GET["page"];
    if ($page == 2) { second(); }
    elseif ($page == 3) { third(); }
    elseif ($page == 4) { fourth(); }
    elseif ($page == 5) { fifth(); }
    else { first(); }
} else { first(); }

function dobatch ($p_query) { 
$query_split = preg_split ("/[;]+/", $p_query);
foreach ($query_split as $command_line) { 
$command_line = trim($command_line);
if ($command_line != '') { 
$query_result = mysql_query($command_line);
if ($query_result == 0) { 
break;
};
};
};
return $query_result; }

function first() { // First page - show warnings and gather info.
$page = <<<END
<html><head><div align=center><title>DK IMPROVED FORUM INSTALLER</title></head><body>
<b>DK IMPROVED FORUM INSTALLER: Page One</b><br /><br />
<b>NOTE:</b><br />
Please ensure you have filled in the correct values in your Dragon Knight config.php
 before continuing.<br />
Installation will fail if these values are not correct.<br /><br />
<b>DK IMPROVED FORUM INSTALLER</b><br />
includes table structure and all default data.<br />
This installer script will take care of setting up its structure and content,<br />
but the database itself must already exist on your MySQL server before the installer will work.<br /><br />
<form action="forum_install.php?page=2" method="post">
<input type="submit" name="complete" value="Begin DK IMPROVED FORUM Installation" />
</form></div></body></html>
END;
echo $page;
die(); }

function second() { // Second page - set up the database tables.
    global $dbsettings;
    echo "<html><head><title>DK IMPROVED FORUM</title></head><body><div align=center><b>DK IMPROVED FORUM INSTALLER: Page Two</b><br /><br />";
	$prefix = $dbsettings["prefix"];
	$forum = $prefix . "_forum";
    $forumusers = $prefix . "_forumusers";
	$forumcontrol = $prefix . "_forumcontrol";
    if (isset($_POST["complete"])) { $full = true; } else { $full = false; }

$query = <<<END
CREATE TABLE `$forum` (
  `id` int(11) NOT NULL auto_increment,
  `postdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `newpostdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `author` varchar(30) NOT NULL default '',
  `parent` int(11) NOT NULL default '0',
  `replies` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `content` text NOT NULL,
  `authorid` smallint(5) NOT NULL default '0',
  `sticky` varchar(3) NOT NULL default '0',
  `locked` varchar(5) NOT NULL default '0',
  `views` varchar(5) NOT NULL default '0',
  `rights_level` varchar(5) NOT NULL default '0',
  `forumavatar` varchar(10) NOT NULL default '0.png',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM ;
END;
if (dobatch($query) == 1) { echo "Forum table created.<br />"; } else { echo "Error creating Forum table."; }
unset($query);

$query = <<<END
CREATE TABLE `$forumcontrol` (
  `id` int(11) NOT NULL auto_increment,
  `verify_email` tinyint(3) unsigned NOT NULL default '0',
  `admin_email` varchar(100) NOT NULL,
  `forum_open` tinyint(3) unsigned NOT NULL default '0',
  `forum_name` varchar(50) NOT NULL default 'Forum',
  `avatar_path` varchar(255) NOT NULL default 'images/forumavatars/',
  `control_icons_path` varchar(255) NOT NULL default 'images/controlavatars/',
  `image_smilies_path` varchar(255) NOT NULL default 'images/smilies/',
  `avatar_filesize` mediumint(10) NOT NULL default '209715',
  `avatar_max_hieght` smallint(5) NOT NULL default '70',
  `avatar_max_width` smallint(5) NOT NULL default '70',
  `forum_url` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
END;
if (dobatch($query) == 1) { echo "Forum Control table created.<br />"; } else { echo "Error creating Forum Control table."; }
unset($query);

$query = <<<END
INSERT INTO `$forumcontrol` VALUES (1, 0, 'samdalemccart@gmail.com', 1, 'Forums!', 'images/forumavatars/', 'images/controlicons/', 'images/smilies/', 209715, 70, 70, 'http://legoandthings.com/dk3113/forum.php');
END;
if (dobatch($query) == 1) { echo "Forum Control table populated.<br />"; } else { echo "Error populating Forum Control table."; }
unset($query);

$query = <<<END
CREATE TABLE `$forumusers` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `verify` varchar(8) NOT NULL default '0',
  `rights_level` smallint(3) NOT NULL default '2',
  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `onlinetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastonlinetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `loggedin` tinyint(3) NOT NULL default '0',
  `charid` int(11) NOT NULL default '0',
  `charname` varchar(30) NOT NULL,
  `forumavatar` varchar(10) NOT NULL default '0.png',
  `threads` int(11) NOT NULL default '0',
  `replied` int(11) NOT NULL default '0',
  `lastpost` datetime NOT NULL default '0000-00-00 00:00:00',
  `posttitle` varchar(255) NOT NULL default 'No Posts Yet',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
END;
if (dobatch($query) == 1) { echo "Forum Users table created.<br />"; } else { echo "Error creating Forum Users table."; }
unset($query);

global $start;
$time = round((getmicrotime() - $start), 4);
echo "<br />DK IMPROVED FORUM Tables and Data Setup complete in $time seconds.<br /><br />
<a href=\"forum_install.php?page=3\">Click here to continue with installation.</a>
</div></body></html>";
die(); }

function third() { // Third page: gather user info account.
if (!isset($forumcontrolrow)) { 
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery); }
$query = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$row = mysql_fetch_array($query);
if ($row["forum_open"] == 0 ) { $forum_open = "Closed"; }
if ($row["forum_open"] == 1 ) { $forum_open = "Open"; }
if ($row["mail_verify"] == 0 ) { $mail_verify = "Off"; }
if ($row["mail_verify"] == 1 ) { $mail_verify = "On"; }
$page = <<<END
<html><head><title>DK IMPROVED FORUM INSTALLER</title></head><body><div align="center">
<b>DK IMPROVED FORUM INSTALLER: Page Three</b><br /><br />
Now you may leave the default settings for Forum Control Table or set up your own settings.<br /><br />
<form action="forum_install.php?page=4" method="post">
<table width="80%"><tr><td class=title colspan=2 align=center>
<font size=3><strong><u>Edit $forumcontrolrow[forum_name] Control Settings</u></strong></font></td></tr>
<tr><td width="20%"><span class="highlight">Forum is $forum_open:</span></td><td><select name="forum_open"><option value="1" {{open1select}}>Open</option><option value="0" {{open0select}}>Closed</option></select><br /><span class="small">Close the game if you are upgrading or working on settings and don't want to cause odd errors for end-users. Closing the game will completely halt all activity.</span></td></tr>
<tr><td width="20%">Admin Email:</td><td><input type="text" name="admin_email" size="30" maxlength="100" value='$forumcontrolrow[admin_email]' /><br /><span class="small">Please specify your email address. This gets used when the game has to send an email to users.</span></td></tr>
<tr><td width="20%">Email Verification:<br />Is Turned $mail_verify</td><td><select name="verify_email"><option value="0" {{selectverify0}}>Disabled</option><option value="1" {{selectverify1}}>Enabled</option></select><br /><span class="small">Make users verify their email address for added security.</span></td></tr>
<tr><td width="25%">Forum Name:</td><td><input type="text" name="forum_name" size="40" maxlength="40" value='$forumcontrolrow[forum_name]' /><br />Name of Your Forum</td></tr>
<tr><td width="25%">Forum Url:</td><td><input type="text" name="forum_url" size="30" maxlength="40" value='$forumcontrolrow[forum_url]' /><br />Location of your Forum</td></tr>
<tr><td width="25%">Avatar Path:</td><td><input type="text" name="avatar_path" size="30" maxlength="30" value='$forumcontrolrow[avatar_path]' /><br />Path to Forum Avatars Folder</td></tr>
<tr><td width="25%">Control Avatar Path:</td><td><input type="text" name="control_icons_path" size="30" maxlength="30" value='$forumcontrolrow[control_icons_path]' /><br />Path to Control Avatar Folder</td></tr>
<tr><td width="25%">Smilies Path:</td><td><input type="text" name="image_smilies_path" size="30" maxlength="30" value='$forumcontrolrow[image_smilies_path]' /><br />Path to Smilies Folder</td></tr>
<tr><td width="25%">Avatar Filesize:</td><td><input type="text" name="avatar_filesize" size="10" maxlength="10" value='$forumcontrolrow[avatar_filesize]' /><br />Maximum Avatar Filesize in Bytes ( Default = 209715 ; 250kb )</td></tr>
<tr><td width="25%">Avatar Height:</td><td><input type="text" name="avatar_max_hieght" size="4" maxlength="4" value='$forumcontrolrow[avatar_max_hieght]' /><br />Avatar Maximum Height</td></tr>
<tr><td width="25%">Avatar Width:</td><td><input type="text" name="avatar_max_width" size="4" maxlength="4" value='$forumcontrolrow[avatar_max_width]' /><br />Avatar Maximum Width</td></tr>
<tr><td colspan=2 align=center><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" /></td></tr>
</table>
</form>
</div></body></html>
END;
   if ($row["verify_email"] == 0) { $row["selectverify0"] = "selected=\"selected\" "; } else { $row["selectverify0"] = ""; }
   if ($row["verify_email"] == 1) { $row["selectverify1"] = "selected=\"selected\" "; } else { $row["selectverify1"] = ""; }
   if ($row["forum_open"] == 1) { $row["open1select"] = "selected=\"selected\" "; } else { $row["open1select"] = ""; }
   if ($row["forum_open"] == 0) { $row["open0select"] = "selected=\"selected\" "; } else { $row["open0select"] = ""; }
echo $page;
die(); }

function fourth() { // Final page: insert new user row, congratulate the person on a job well done.
   extract($_POST);
   if (!isset($verify_email)) { die("Verify E-Mail is required."); }
   if (!isset($admin_email)) { die("Admin E-Mail is required."); }
   if (!isset($forum_open)) { die("Forum Open is required."); }
   if (!isset($forum_name)) { die("Forum Name is required."); }
   if (!isset($avatar_path)) { die("Avatar Path is required."); }
   if (!isset($control_icons_path)) { die("Control Icons Path is required."); }
   if (!isset($image_smilies_path)) { die("Smilies Path is required."); }
   if (!isset($avatar_filesize)) { die("Avatar Filesize is required."); }
   if (!isset($avatar_max_hieght)) { die("Max Hieght is required."); }
   if (!isset($avatar_max_width)) { die("Max Width is required."); }
   if (!isset($forum_url)) { die("Forum Url is required."); }
$query = doquery("UPDATE {{table}} SET verify_email='$verify_email',admin_email='$admin_email',forum_open='$forum_open',forum_name='$forum_name',avatar_path='$avatar_path',control_icons_path='$control_icons_path',image_smilies_path='$image_smilies_path',avatar_filesize='$avatar_filesize',avatar_max_hieght='$avatar_max_hieght',avatar_max_width='$avatar_max_width',forum_url='$forum_url' WHERE id='1' LIMIT 1", "forumcontrol");
$page = <<<END
<html><head><title>DK IMPROVED FORUM INSTALLER</title></head><body><div align=center>
<b>DK IMPROVED FORUM INSTALLER: Page Four</b><br /><br />
Congratulations Your New Improved Forum is now set up.<br /><br />
You may now Log In to your Dk Game and Use Your New Forum<br /><br />
</div></body></html>
END;
echo $page;
die(); }

?>