<?php // forumavatar.php HANDLES ALL UPLOADING, VIEWING AND CHANGING OF FORUM AVATARS 

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
</td></tr></table> ", "User Banned"); die(); }

if (isset($_GET["do"])) { 
  $do = explode(":",$_GET["do"]);
    if ($do[0] == "avatar") { avatar(); }
    elseif ($do[0] == "avupload") { avupload(); } }

// START OF THE FORUM AVATAR FUNCTION
function avatar() { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$forumusersquery = doquery("SELECT * FROM {{table}} WHERE charid='$userrow[id]' LIMIT 1", "forumusers");
$forumusersrow = mysql_fetch_array($forumusersquery);
$file_dir = $forumcontrolrow["avatar_path"]; // SETS THE PATH TO THE BULLITIN AVATAR FOLDER.
$handle = opendir($file_dir);
$filelist = "";
while ($file = readdir($handle)) { 
if (!is_dir($file) && !is_link($file)) { 
$filelist .= "<table cellspacing=0 cellpadding=0 border=0><tr><td align=center>
<a href='$file_dir$file' target=_blank alt='$file'><font color=#000000>$file</font></a></td></tr>
<tr><td align=center><img src=".$forumcontrolrow["avatar_path"]."/$file width=50 height=50 border=0></td></tr></table><br />"; } }
if (isset($_POST['change_forum_avatar'])) { 
$avatar = $_POST['forum_avatar_name'];
$query = doquery("UPDATE {{table}} SET forumavatar='$avatar' WHERE charid='".$userrow["id"]."' LIMIT 1", "forumusers");
display("
<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>
<table width=100% align=center><tr><td width=25% class=title align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td width=25% class=title align=center>
<a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatars</a>
</td><td width=25% class=title align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
<td width=25% class=title align=center>
<a href=index.php title='Return to Town'>Town Square</a></td>
</tr></table>

<br /><br />
<div align=center>Congratulations You have changed your avatar,<br />Go back to the <a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatar</a> area</div>
</td></tr></table> ", "Avatar Changed"); die(); }

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

//$page .= "<form action='forum_avatars.php?do=avupload' method='post' enctype='multipart/form-data'><p>"; // DELETE THIS LINE IF YOU DONT WISH TO ALLOW UPLOADS OR PUT LIKE THIS // IN FRONT OF THIS LINE, THEN YOU CAN JUST REMOVE THE // TO GET THE UPLOAD OPTION BACK
//$page .= "<label for='file'><strong>!Select and Upload Your Forum Avatar!</strong></label><br /><br />Avatar Images should be no larger then 50 x 50 Pixels and 1 mb in size.<br />"; // DELETE THIS LINE IF YOU DONT WISH TO ALLOW UPLOADS OR PUT LIKE THIS // IN FRONT OF THIS LINE, THEN YOU CAN JUST REMOVE THE // TO GET THE UPLOAD OPTION BACK
//$page .= "<input type='file' name='userfile' id='file' size=50><br /><input type='submit' value='Upload Avatar' /><p></form>"; // DELETE THIS LINE IF YOU DONT WISH TO ALLOW UPLOADS OR PUT LIKE THIS // IN FRONT OF THIS LINE, THEN YOU CAN JUST REMOVE THE // TO GET THE UPLOAD OPTION BACK

$page .= "<table><tr><td align=center>";
$page .= "<br /><br /><br /><img src=".$forumcontrolrow["avatar_path"]."".$forumusersrow["forumavatar"]." width=50 height=50 border=0><br />Current<br>Avatar";
$page .= "</td><td align=center>";
$page .= "<form action=forum_avatars.php?do=avatar method=post>";
$page .= "<br /><br />Avatar Name<br /><input type=text value='$forumusersrow[forumavatar]' name=forum_avatar_name width=50 height=50 border=0><br />";
$page .= "<input type=submit value='Change My Avatar' name=change_forum_avatar></form><br />";
//$page .= "<strong>!Or use a Avatar from the Gallery!</strong><br />";
$page .= "</td></tr></table>";
$page .= "<br><br>";
$page .= "$filelist";
$page .= "<br><br>";
$page .= "</td></tr></table>";
display($page, "Change Forum Avatars"); }
// END OF THE FORUM AVATAR FUNCTION

// START OF THE FORUM AVATAR UPLOAD FUNCTION
function avupload() { 
global $userrow, $controlrow, $numqueries;
$forumcontrolquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "forumcontrol");
$forumcontrolrow = mysql_fetch_array($forumcontrolquery);
$allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // TYPES OF FILES THAT CAN BE UPLOADED.
$max_filesize = "$forumcontrolrow[avatar_filesize]"; // SETS THE PATH TO AVATAR MAXIMUM FILE SIZE TO BE UPLOADED IN BYTES, CURRENTLY ( 250 KBs ).
$max_hieght = "$forumcontrolrow[avatar_max_hieght]"; // SETS THE PATH TO AVATAR MAXIMUM HIEGHT OF FILE IN PIXELS
$max_width = "$forumcontrolrow[avatar_max_width]"; // SETS THE PATH TO AVATAR MAXIMUM WIDTH OF FILE IN PIXELS
$uploaddir = "$forumcontrolrow[avatar_path]"; // SETS THE PATH TO THE AVATAR FOLDER, FILES WILL BE UPLOADED TO THIS FOLDER.
$filename = $_FILES['userfile']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
if ($max_width) { list($width, $type, $w) = getimagesize($_FILES['userfile']['tmp_name']);
if ($width > $max_width) { 
display("<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>
<table width=100% align=center><tr><td width=25% class=title align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td width=25% class=title align=center>
<a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatars</a>
</td><td width=25% class=title align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
<td width=25% class=title align=center>
<a href=index.php title='Return to Town'>Town Square</a></td>
</tr></table>
<br />
File Width is to great, files must be less then 100 x 100 Pixels in size!</td></tr></table> ", "Error"); die(); } }
if ($max_hieght) { list($hieght, $type, $w) = getimagesize($_FILES['userfile']['tmp_name']);
if ($hieght > $max_hieght) { 
display("<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>


<table width=100% align=center><tr><td width=25% class=title align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td width=25% class=title align=center>
<a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatars</a>
</td><td width=25% class=title align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
<td width=25% class=title align=center>
<a href=index.php title='Return to Town'>Town Square</a></td>
</tr></table>

<br />
File Hieght is to great, files must be less then 70 x 70 Pixels in size!</td></tr></table> ", "Error"); die(); } }
if (!in_array($ext,$allowed_filetypes)) { // CHECK TO ENSURE FILE TYPE IS ALLOWED, IF NOT DIE AND INFORM USER.
display("<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>
<table width=100% align=center><tr><td width=25% class=title align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td width=25% class=title align=center>
<a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatars</a>
</td><td width=25% class=title align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
<td width=25% class=title align=center>
<a href=index.php title='Return to Town'>Town Square</a></td>
</tr></table>

<br />
The file you attempted to upload is not allowed.</td></tr></table>", "Error"); die(); }
if (filesize($_FILES['userfile']['tmp_name']) > $max_filesize) { // CHECK THE FILESIZE, IF ITS TO LARGE THEN DIE AND INFORM USER.
display("<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>
<table width=100% align=center><tr><td width=25% class=title align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td width=25% class=title align=center>
<a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatars</a>
</td><td width=25% class=title align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
<td width=25% class=title align=center>
<a href=index.php title='Return to Town'>Town Square</a></td>
</tr></table>

<br />
The file you attempted to upload is too large.</td></tr></table>", "Error"); die(); }
if (!is_writable($uploaddir)) { // CHECK TO ENSURE PROPER UPLOAD FOLDER, IF NOT DIE AND INFORM USER.
display("<table width=100% align=center border=1><tr><td>
<table width=100% align=center><tr><td class=title align=center>
<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>
<table width=100% align=center><tr><td width=25% class=title align=center>
<a href=forum.php title='Return to the Main Forum Index'>Forum</a>
</td><td width=25% class=title align=center>
<a href=forum_avatars.php?do=avatar title='Go back to the Main Avatar area'>Avatars</a>
</td><td width=25% class=title align=center>
<a href=forum_loginout.php?do=logout title='Log Out! of the Forum!'>Log Out</a>
<td width=25% class=title align=center>
<a href=index.php title='Return to Town'>Town Square</a></td>
</tr></table>

<br />
You cannot upload to the specified directory.</td></tr></table>", "Error"); die(); }
if (!file_exists($uploaddir . $_FILES["userfile"]["name"])) { 
if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploaddir . $filename)) { 
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=25% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out of the Forum'>Log Out</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=index.php title='Return to Town'>Town Square</a></td></tr></table><BR><BR>";
$page .= "Your file upload was successful, view the file <a href=\"$uploaddir$filename\" title=\"Your File\" target=\"_blank\">here</a><br />";
$page .= "</td></tr></table>";
display($page, "Change avatar"); }
else { 
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=25% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out of the Forum'>Log Out</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=index.php title='Return to Town'>Town Square</a></td></tr></table><br><br>";
$page .= "There was an error during the file upload, Please try again.<br />";
$page .= "</td></tr></table>";
display($page, "Upload Forum Avatars"); } }
else { // There's a file with the same name
$page = "<table width=100% align=center><tr><td class=title align=center>";
$page .= "<font size=3><b>".$forumcontrolrow["forum_name"]."</b></font></td></tr><tr><td align=center>";
$page .= "<table width=100% align=center><tr><td width=25% class=title align=center>";
$page .= "<a href=forum.php title='Return to the Main Forum Index'>Forum</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum.php?do=new title='Create a new thread'>New Thread</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=forum_loginout.php?do=logout title='Log Out of the Forum'>Log Out</a>";
$page .= "</td><td width=25% class=title align=center>";
$page .= "<a href=index.php title='Return to Town'>Town Square</a></td></tr></table><br><br>";
$page .= "Sorry! - The File Name you are trying to upload is already being used.<br />";
$page .= "Please go back change Your File Name and try again.<br />";
$page .= "</td></tr></table>";
display($page, "Upload Forum Avatars"); } }
// END OF THE FORUM AVATAR UPLOAD FUNCTION

?>