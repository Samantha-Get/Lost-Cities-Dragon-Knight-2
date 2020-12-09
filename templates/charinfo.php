<?php // towns.php :: Handles all actions you can do in town.

function avatar() {

global $userrow, $numqueries;
	$townquery = doquery("SELECT name FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (isset($_POST['avatar'])) {   
$avatar = $_POST['address'];

doquery("UPDATE {{table}} SET avatarid='$avatar' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 


$page = "Avatar changed. <br /> Back to <a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br />";
}
$page.="<table class=title width=400><tr><td>Change Your Avatar</td></tr></table>

<form action=index.php?do=avatar method=post><br />
Avataraddress <input type=text value=http://somewebsite.com/image.jpg name=address size=20><br />
<input type=submit value=Submit name=avatar></form><br />
Currenly You Can Only Link To Hosted Images But I Am Working On A Upload Script. Back to 
<a href=\"index.php\" class=\"myButton2\">Town Square</a>";
     display($page, "Change Avatar"); }

function editinfo() {

global $userrow, $numqueries;
	$townquery = doquery("SELECT name FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (isset($_POST['editinfo'])) {   
$publicemail = $_POST['publicemail'];
$msn = $_POST['msn'];
$icq = $_POST['icq'];
$aim = $_POST['aim'];
$yahoo = $_POST['yahoo'];
$website1 = $_POST['website1'];
$website2 = $_POST['website2'];
$realname = $_POST['realname'];
$hobbies = $_POST['hobbies'];
$googletlk = $_POST['googletlk'];
$avatar = $_POST['avatar'];

doquery("UPDATE {{table}} SET publicemail='$publicemail' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET msn='$msn' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET icq='$icq' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET aim='$aim' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET yahoo='$yahoo' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET website1='$website1' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET website2='$website2' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET realname='$realname' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET hobbies='$hobbies' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 
doquery("UPDATE {{table}} SET googletlk='$googletlk' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
doquery("UPDATE {{table}} SET avatarid='$avatar' WHERE id='".$userrow["id"]."' LIMIT 1", "users");




$page = "Character Information Has Been Changed.<br /><br />Back to 
<a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br />";
}
$page.="<form action=index.php?do=editinfo method=post>
  <table class=title width=400>
    <tr>
      <td>Change Your Characters Information</td>
    </tr>
	    <tr>
      <td>Real Name: </td>
      <td><input type=text value=$userrow[realname] name=realname size=25></td>
    </tr>
    <tr>
      <td>Email Address: </td>
      <td><input type=text value=$userrow[publicemail] name=publicemail size=25></td>
    </tr>
    <tr>
      <td>Msn Messenger: </td>
      <td><input type=text value=$userrow[msn] name=msn size=25></td>
    </tr>
    <tr>
      <td>Icq Uim: </td>
      <td><input type=text value=$userrow[icq] name=icq size=25></td>
    </tr>
    <tr>
      <td>Aim Screen Name: </td>
      <td><input type=text value=$userrow[aim] name=aim size=25></td>
    </tr>
    <tr>
      <td>Yahoo! Messenger ID: </td>
      <td><input type=text value=$userrow[yahoo] name=yahoo size=25></td>
    </tr>
	    <tr>
      <td>Googletalk: </td>
      <td><input type=text value=$userrow[googletlk] name=googletlk size=25></td>
    </tr>
    <tr>
      <td>Website 1: </td>
      <td><input type=text value=$userrow[website1] name=website1 size=25></td>
    </tr>
	
    <tr>
      <td>Website 2: </td>
      <td><input type=text value=$userrow[website2] name=website2 size=25></td>
    </tr>
    <tr>
      <td>Hobbies:</td>
      <td><input type=text value=$userrow[hobbies] name=hobbies size=25></td>
    </tr>
    <tr>
      <td>Avatar:</td>
      <td><input type=text value=$userrow[avatarid] name=avatar size=25></td>

    </tr>
  </table>
<input type=submit value=Submit name=editinfo></form><br /><br />Back to 
<a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br />";
     display($page, "Character Information"); }
	 

?>
