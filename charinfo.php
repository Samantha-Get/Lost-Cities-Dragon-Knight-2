<?php // towns.php :: Handles all actions you can do in town.

function avatar() {

global $userrow, $numqueries;
	$townquery = doquery("SELECT name FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");

if (isset($_POST['avatar'])) {   
$avatar = $_POST['address'];

doquery("UPDATE {{table}} SET avatarid='$avatar' WHERE id='".$userrow["id"]."' LIMIT 1", "users"); 


$page = "<br /><center><b>You Avatar has been changed.</b><br /><a href=\"index.php\" class=\"myButton2\">Back to the Town Square</a></center><br />";
}


$page.="<table class=title width=100%><tr><td align=\"center\">Change Your Avatar</td></tr></table><Blockquote><br /><br />
<a href=\"index.php\" class=\"myButton2\">Back to the Town Square</a>

<form action=index.php?do=avatar method=post><br />
Avatar Address Box: <input type=text value=images/avatar/default.png name=address size=60><br />
<input type=submit value=Submit name=avatar class=myButton2></form>

<br /><br />Currently You Can Only Link To Hosted Images by Inputting the<br />Full URL [ Example: <span style=\"color: #168F09;\">http://Somewebsite.com/images/Crackerjack.png</span> ] in the -Avatar Address Box-. Then hit the Submit Button and you are done.
<br /><font color=\"#FF0000\">NOTE:</font>Limit Image size to 250x250. Image large than this will be deleted and your account banned. 

<br />
<span style=\"color: #168F09;\">OR</span> 

<br />Select one of Dragon Knights Limited Avatars from the Images from Below.

<br /><br />The Quickest way to find the URL for these Avatars is:

<br /><br />1st Step In Windows: Right Click on a Image Below and click on Properties. While the Properties Box is up, copy [Control + C] the Url<br />[ Example: <span style=\"color: #168F09;\">https://www.michaelmccart.com/lc3134/images/avatar/Avatar_1.png</span> ].

<br /><br />2nd Step In Windows: Take the last half of the URL as shown in this<br />[ Example: <span style=\"color: #168F09;\">images/avatar/Avatar_1.png</span> ] and paste [Control + V] it in the -Avatar Address Box-.<br />Then hit the Submit Button and you are done.

<br /><br />
Presently The Only way to check to see if your Avatar has changed is to go to you Character Information Page.

<br /><br />
The following Avatars are available to use or link to a outside Avatar.<br /><br />
<center><table border=\"1\" width=\"100%\">
  <tr>
     <td><img src=\"images/avatar/Avatar_1.png\" width=\"50\" height=\"50\" alt=\"1\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_2.png\" width=\"50\" height=\"50\" alt=\"2\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_3.png\" width=\"50\" height=\"50\" alt=\"3\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_4.png\" width=\"50\" height=\"50\" alt=\"4\" border=\"0\"></td>
	 <td><img src=\"images/avatar/Avatar_5.png\" width=\"50\" height=\"50\" alt=\"5\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_6.png\" width=\"50\" height=\"50\" alt=\"6\" border=\"0\"></td>
  </tr>
  <tr>
  	 <td><img src=\"images/avatar/Avatar_7.png\" width=\"50\" height=\"50\" alt=\"7\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_8.png\" width=\"50\" height=\"50\" alt=\"8\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_9.png\" width=\"50\" height=\"50\" alt=\"9\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_10.png\" width=\"50\" height=\"50\" alt=\"10\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_11.png\" width=\"50\" height=\"50\" alt=\"11\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_12.png\" width=\"50\" height=\"50\" alt=\"12\" border=\"0\"></td>
  </tr>
  <tr>
     <td><img src=\"images/avatar/Avatar_13.png\" width=\"50\" height=\"50\" alt=\"13\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_14.png\" width=\"50\" height=\"50\" alt=\"14\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_15.png\" width=\"50\" height=\"50\" alt=\"15\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_16.png\" width=\"50\" height=\"50\" alt=\"16\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_17.png\" width=\"50\" height=\"50\" alt=\"17\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_18.png\" width=\"50\" height=\"50\" alt=\"18\" border=\"0\"></td>
  </tr> 
  <tr>
     <td><img src=\"images/avatar/Avatar_19.png\" width=\"50\" height=\"50\" alt=\"19\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_20.png\" width=\"50\" height=\"50\" alt=\"20\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_21.png\" width=\"50\" height=\"50\" alt=\"20\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_22.png\" width=\"50\" height=\"50\" alt=\"20\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_23.png\" width=\"50\" height=\"50\" alt=\"20\" border=\"0\"></td>
     <td><img src=\"images/avatar/Avatar_24.png\" width=\"50\" height=\"50\" alt=\"20\" border=\"0\"></td>
  </tr>
  <tr>
     <td><img src=\"images/avatar/Avatar_25.png\" width=\"50\" height=\"50\" alt=\"20\" border=\"0\"></td>
     <td> </td>
     <td> </td>
     <td> </td>
     <td> </td>
     <td><img src=\"images/avatar/default.png\" width=\"50\" height=\"50\" alt=\"default\" border=\"0\"></td>
  </tr>
</table></center>
<br /><br />
<a href=\"index.php\" class=\"myButton2\">Town Square.</a>
</Blockquote>";

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




$page = "<center><h3 class=title>Character Information Changed<h3></center>Character Information Has Been Changed.<a href=\"index.php\" class=\"myButton2\">Town Square</a><br /><br />";
}
$page = "<center><h3 class=title>Change Your Character Information<h3></center>";
$page.="<br /><br /><form action=index.php?do=editinfo method=post>
  <div align=\"center\"><table class=title width=400>
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
  </table><br /><br />
<input type=submit value=Submit name=editinfo class=\"myButton2\"></form><br /><br />
<a href=\"index.php\" class=\"myButton2\">Town Square</a></div>";
     display($page, "Character Information"); }
	 

?>
