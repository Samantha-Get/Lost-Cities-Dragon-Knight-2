<?php // lib.php :: Common functions used throughout the program.



$starttime = getmicrotime();
$numqueries = 0;
$version = "LC 3134";
$build = "09-06-2020";

// Handling for servers with magic_quotes turned on.
// Example from php.net.
if (get_magic_quotes_gpc()) {

   $_POST = array_map('stripslashes_deep', $_POST);
   $_GET = array_map('stripslashes_deep', $_GET);
   $_COOKIE = array_map('stripslashes_deep', $_COOKIE);

}
$_POST = array_map('addslashes_deep', $_POST);
$_POST = array_map('html_deep', $_POST);
$_GET = array_map('addslashes_deep', $_GET);
$_GET = array_map('html_deep', $_GET);
$_COOKIE = array_map('addslashes_deep', $_COOKIE);
$_COOKIE = array_map('html_deep', $_COOKIE);

function stripslashes_deep($value) {
    
   $value = is_array($value) ?
               array_map('stripslashes_deep', $value) :
               stripslashes($value);
   return $value;
   
}

function addslashes_deep($value) {
    
   $value = is_array($value) ?
               array_map('addslashes_deep', $value) :
               addslashes($value);
   return $value;
   
}

function html_deep($value) {
    
   $value = is_array($value) ?
               array_map('html_deep', $value) :
               htmlspecialchars($value);
   return $value;
   
}

function opendb() { // Open database connection.

    include('config.php');
    extract($dbsettings);
$link = mysql_connect($server, $user, $pass) or die(mysql_error());
mysql_select_db($name) or die(mysql_error());
return $link;

// ...   
}

function doquery($query, $table) { // Something of a tiny little database abstraction layer.
    
    include('config.php');
    global $numqueries;
    $sqlquery = mysql_query(str_replace("{{table}}", $dbsettings["prefix"] . "_" . $table, $query)) or die(mysql_error());
    $numqueries++;
    return $sqlquery;

}

function doquery2($query, $table1, $table2) { // Something of a tiny little database abstraction layer.
    
    include('config.php');
    global $numqueries;
    //$sqlquery = mysql_query(str_replace("{{table}}", $dbsettings["prefix"] . "_" . $table, $query)) or die(mysql_error());
    $endquery = str_replace("{{table1}}", $dbsettings["prefix"] . "_" . $table1, $query);
    $endquery = str_replace("{{table2}}", $dbsettings["prefix"] . "_" . $table2, $endquery);
    $sqlquery = mysql_query($endquery) or die(mysql_error());
    $numqueries++;
    return $sqlquery;

}

function isNaN( $var ) {
	return !ereg ("^[-]?[0-9]+([\.][0-9]+)?$", $var);
}


function gettemplate($templatename) { // SQL query for the template.

    $filename = "templates/" . $templatename . ".php";
    include("$filename");
    return $template;    
}

function parsetemplate($template, $array) { // Replace template with proper content.
    
    foreach($array as $a => $b) {
        $template = str_replace("{{{$a}}}", $b, $template);
    }
    return $template;    
}

function getmicrotime() { // Used for timing script operations.

    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
}

function prettydate($uglydate) { // Change the MySQL date format (YYYY-MM-DD) into something friendlier.

    return date("F j, Y", mktime(0,0,0,substr($uglydate, 5, 2),substr($uglydate, 8, 2),substr($uglydate, 0, 4)));
}

function prettyforumdate($uglydate) { // Change the MySQL date format (YYYY-MM-DD) into something friendlier.

    return date("F j, Y", mktime(0,0,0,substr($uglydate, 5, 2),substr($uglydate, 8, 2),substr($uglydate, 0, 4)));
}

function is_email($email) { // Thanks to "mail(at)philipp-louis.de" from php.net!

    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));

}

function makesafe($d) {
    
    $d = str_replace("\t","",$d);
    $d = str_replace("<","&#60;",$d);
    $d = str_replace(">","&#62;",$d);
    $d = str_replace("\n","",$d);
    $d = str_replace("|","??",$d);
    $d = str_replace("  "," &nbsp;",$d);
    return $d;
    
}

function get_ip_address()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && ip2long($_SERVER["HTTP_X_FORWARDED_FOR"]) !== false) {
                $ipadres = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (isset($_SERVER["HTTP_CLIENT_IP"])  && ip2long($_SERVER["HTTP_CLIENT_IP"]) !== false) {
                $ipadres = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $ipadres = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR') && ip2long(getenv('HTTP_X_FORWARDED_FOR')) !== false) {
                $ipadres = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP') && ip2long(getenv('HTTP_CLIENT_IP')) !== false) {
                $ipadres = getenv('HTTP_CLIENT_IP');
            } else {
                $ipadres = getenv('REMOTE_ADDR');
            }
        }
        return $ipadres;
    }



function admindisplay($content, $title) { // Finalize page and output to browser.
    
    global $numqueries, $userrow, $controlrow, $starttime, $version, $build, $ipadres;
    if (!isset($controlrow)) {
        $controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
        $controlrow = mysql_fetch_array($controlquery);
    }
    
    $template = gettemplate("admin");
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";

    $finalarray = array(
        "title"=>$title,
        "content"=>$content,
        "totaltime"=>round(getmicrotime() - $starttime, 4),
        "numqueries"=>$numqueries,
        "version"=>$version,
        "ipadres"=>$ipadres,
        "build"=>$build);
    $page = parsetemplate($template, $finalarray);
    $page = $xml . $page;

    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
}
function moderatordisplay($content, $title) { // Finalize page and output to browser.
    
    global $numqueries, $userrow, $controlrow, $starttime, $version, $build, $ipadres;
    if (!isset($controlrow)) {
        $controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
        $controlrow = mysql_fetch_array($controlquery);
    }
    
    $template = gettemplate("moderator");
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";

    $finalarray = array(
        "title"=>$title,
        "content"=>$content,
        "totaltime"=>round(getmicrotime() - $starttime, 4),
        "numqueries"=>$numqueries,
        "ipadres"=>$ipadres,
        "version"=>$version,
        "build"=>$build);
    $page = parsetemplate($template, $finalarray);
    $page = $xml . $page;

    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();    
}

function display($content, $title, $topnav=true, $leftnav=true, $rightnav=true, $badstart=false) { // Finalize page and output to browser.
    
    global $numqueries, $userrow, $controlrow, $version, $ipadres, $build;
    if (!isset($controlrow)) {
        $controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
        $controlrow = mysql_fetch_array($controlquery);
    }
    if ($badstart == false) { global $starttime; } else { $starttime = $badstart; }
    
    // Make page tags for XHTML validation.
    $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n"
    . "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">\n"
    . "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";

    $template = gettemplate("primary");
    
    if ($rightnav == true) { $rightnav = gettemplate("rightnav"); } else { $rightnav = ""; }
    if ($leftnav == true) { $leftnav = gettemplate("leftnav"); } else { $leftnav = ""; }
    if ($topnav == true) {
        $topnav = "<a href=\"login.php?do=logout\"><img src=\"images/button_logout.png\" alt=\"Log Out\" title=\"Log Out\" border=\"0\" /></a> <a href=\"help.php\"><img src=\"images/button_help.png\" alt=\"Help\" title=\"Help\" border=\"0\" /></a>";
    } else {
        $topnav = "<a href=\"login.php?do=login\"><img src=\"images/button_login.png\" alt=\"Log In\" title=\"Log In\" border=\"0\" /></a> <a href=\"users.php?do=register\"><img src=\"images/button_register.png\" alt=\"Register\" title=\"Register\" border=\"0\" /></a> <a href=\"help.php\"><img src=\"images/button_help.png\" alt=\"Help\" title=\"Help\" border=\"0\" /></a>";
    }
    
    if (isset($userrow)) {
        
        // Get userrow again, in case something has been updated.
        $userquery = doquery("SELECT * FROM {{table}} WHERE id='".$userrow["id"]."' LIMIT 1", "users");
        unset($userrow);
        $userrow = mysql_fetch_array($userquery);
        
// Current town name.

        // Current town name.
        if ($userrow["currentaction"] == "In Town") {
            $townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
            $townrow = mysql_fetch_array($townquery);
            $userrow["currenttown"] = "Welcome to ".$townrow["name"]."<br />";
        } else {
            $userrow["currenttown"] = "";
        }

	if ($userrow["currentaction"] == "In Town") {
	$innquery = doquery("SELECT * FROM {{table}} WHERE latitude='".
	$userrow["latitude"]."' AND longitude='".
	$userrow["longitude"]."' LIMIT 8", "towns");
    $townrow = mysql_fetch_array($innquery);	
	

// Names for Inns

if ($townrow["id"] == "1") {$innsname = "Capital Inn";}
elseif ($townrow["id"] == "2") {$innsname = "Owls Inn";}
elseif ($townrow["id"] == "3") {$innsname = "Carriage House";}
elseif ($townrow["id"] == "4") {$innsname = "The Cranes Inn";}
elseif ($townrow["id"] == "5") {$innsname = "Rams Inn";}
elseif ($townrow["id"] == "6") {$innsname = "Oak Inn";}
elseif ($townrow["id"] == "7") {$innsname = "The Quiver Inn";}
elseif ($townrow["id"] == "8") {$innsname = "Lizard Inn";}
elseif ($townrow["id"] == "9") {$innsname = "Turtle Inn";}
elseif ($townrow["id"] == "10") {$innsname = "Goat Trail Inn";}
elseif ($townrow["id"] == "11") {$innsname = "Wheel Inn";}
elseif ($townrow["id"] == "12") {$innsname = "Peacock Pub";}
elseif ($townrow["id"] == "13") {$innsname = "White Dove Tavern";}
elseif ($townrow["id"] == "14") {$innsname = "Unicorn Inn";}
elseif ($townrow["id"] == "15") {$innsname = "Panther House";}
elseif ($townrow["id"] == "16") {$innsname = "Peacock Tavern";}
elseif ($townrow["id"] == "17") {$innsname = "Twin Oxen Tavern";}
elseif ($townrow["id"] == "18") {$innsname = "Comets Inn";}
elseif ($townrow["id"] == "19") {$innsname = "Amber Rose Inn";}
elseif ($townrow["id"] == "20") {$innsname = "Astrologer Inn";}
elseif ($townrow["id"] == "21") {$innsname = "Moose Head Inn";}
elseif ($townrow["id"] == "22") {$innsname = "Salty Inn";}
elseif ($townrow["id"] == "23") {$innsname = "Nightmare Inn";}
elseif ($townrow["id"] == "24") {$innsname = "Broken Bell Inn";}
elseif ($townrow["id"] == "25") {$innsname = "Whispering Inn";}
elseif ($townrow["id"] == "26") {$innsname = "Wild Crane Inn";}
elseif ($townrow["id"] == "27") {$innsname = "White Mare Inn";}
elseif ($townrow["id"] == "28") {$innsname = "Swinging Bell Inn";}
elseif ($townrow["id"] == "29") {$innsname = "Silent Inn";}
elseif ($townrow["id"] == "30") {$innsname = "One Leg Crane Inn";}
elseif ($townrow["id"] == "31") {$innsname = "Wild Turkey Inn";}





// Names towncityname Town City Name


if ($townrow["id"] == "1") {$towncityname = "Capital";}
elseif ($townrow["id"] == "2") {$towncityname = "Argos";}
elseif ($townrow["id"] == "3") {$towncityname = "Sidon";}
elseif ($townrow["id"] == "4") {$towncityname = "Jericho";}
elseif ($townrow["id"] == "5") {$towncityname = "Narcissa";}
elseif ($townrow["id"] == "6") {$towncityname = "Luxor";}
elseif ($townrow["id"] == "7") {$towncityname = "Carthage";}
elseif ($townrow["id"] == "8") {$towncityname = "Corinth";}
elseif ($townrow["id"] == "9") {$towncityname = "Hagagaror";}
elseif ($townrow["id"] == "10") {$towncityname = "Troy";}
elseif ($townrow["id"] == "11") {$towncityname = "Rey";}
elseif ($townrow["id"] == "12") {$towncityname = "Merigold";}
elseif ($townrow["id"] == "13") {$towncityname = "Athens";}
elseif ($townrow["id"] == "14") {$towncityname = "Cario";}
elseif ($townrow["id"] == "15") {$towncityname = "Cyreneia";}
elseif ($townrow["id"] == "16") {$towncityname = "Camasiacum";}
elseif ($townrow["id"] == "17") {$towncityname = "Itanais";}
elseif ($townrow["id"] == "18") {$towncityname = "Neropolis";}
elseif ($townrow["id"] == "19") {$towncityname = "Girsche";}
elseif ($townrow["id"] == "20") {$towncityname = "Far Point City";}
elseif ($townrow["id"] == "21") {$towncityname = "Lost City of Arcadia";}
elseif ($townrow["id"] == "22") {$towncityname = "Lost City of Avalon";}
elseif ($townrow["id"] == "23") {$towncityname = "Lost City of Nysa";}
elseif ($townrow["id"] == "24") {$towncityname = "Lost City of Zerzura";}
elseif ($townrow["id"] == "25") {$towncityname = "Frontier Post";}
elseif ($townrow["id"] == "26") {$towncityname = "Border Post";}
elseif ($townrow["id"] == "27") {$towncityname = "Near City";}
elseif ($townrow["id"] == "28") {$towncityname = "Forgotten Post";}
elseif ($townrow["id"] == "29") {$towncityname = "National Post";}
elseif ($townrow["id"] == "30") {$towncityname = "Sand Gate Post";}
elseif ($townrow["id"] == "31") {$towncityname = "Outpost Shadow";}



// Names for News   newsname

if ($townrow["id"] == "1") {$newsname = "Capitals News";}
elseif ($townrow["id"] == "2") {$newsname = "Owl Global";}
elseif ($townrow["id"] == "3") {$newsname = "News Weekly";}
elseif ($townrow["id"] == "4") {$newsname = "Town Crier";}
elseif ($townrow["id"] == "5") {$newsname = "Central Union";}
elseif ($townrow["id"] == "6") {$newsname = "Peoples Post";}
elseif ($townrow["id"] == "7") {$newsname = "Midday News";}
elseif ($townrow["id"] == "8") {$newsname = "Tribune News";}
elseif ($townrow["id"] == "9") {$newsname = "News Telegram";}
elseif ($townrow["id"] == "10") {$newsname = "News Press";}
elseif ($townrow["id"] == "11") {$newsname = "News Register";}
elseif ($townrow["id"] == "12") {$newsname = "Sentinel News";}
elseif ($townrow["id"] == "13") {$newsname = "The News Record";}
elseif ($townrow["id"] == "14") {$newsname = "Sunday Telegram";}
elseif ($townrow["id"] == "15") {$newsname = "News Day Report";}
elseif ($townrow["id"] == "16") {$newsname = "News Express";}
elseif ($townrow["id"] == "17") {$newsname = "News Observer";}
elseif ($townrow["id"] == "18") {$newsname = "News Chronicle";}
elseif ($townrow["id"] == "19") {$newsname = "News Journal";}
elseif ($townrow["id"] == "20") {$newsname = "The Dispatch Mirror";}
elseif ($townrow["id"] == "21") {$newsname = "Enterprise Sentinel";}
elseif ($townrow["id"] == "22") {$newsname = "Weekly News";}
elseif ($townrow["id"] == "23") {$newsname = "Daily Star";}
elseif ($townrow["id"] == "24") {$newsname = "Pioneer Times";}
elseif ($townrow["id"] == "25") {$newsname = "Heritage Press";}
elseif ($townrow["id"] == "26") {$newsname = "Morning Chronicles";}
elseif ($townrow["id"] == "27") {$newsname = "Weekly News";}
elseif ($townrow["id"] == "28") {$newsname = "Daily Star";}
elseif ($townrow["id"] == "29") {$newsname = "Pioneer Times";}
elseif ($townrow["id"] == "30") {$newsname = "Heritage Press";}
elseif ($townrow["id"] == "31") {$newsname = "Dark Chronicles";}

// Names for Potions  potionsname

if ($townrow["id"] == "1") {$potionsname = "Apothecary Potions";}
elseif ($townrow["id"] == "2") {$potionsname = "Early Naga Potions";}
elseif ($townrow["id"] == "3") {$potionsname = "Affordable Potions";}
elseif ($townrow["id"] == "4") {$potionsname = "Haberdashery Potions";}
elseif ($townrow["id"] == "5") {$potionsname = "Portable Potions";}
elseif ($townrow["id"] == "6") {$potionsname = "Amazing Potions";}
elseif ($townrow["id"] == "7") {$potionsname = "Talisman Potions";}
elseif ($townrow["id"] == "8") {$potionsname = "Crystal Potions";}
elseif ($townrow["id"] == "9") {$potionsname = "Nostrum Potions";}
elseif ($townrow["id"] == "10") {$potionsname = "Elemental Potions";}
elseif ($townrow["id"] == "11") {$potionsname = "Elementary Potions";}
elseif ($townrow["id"] == "12") {$potionsname = "Naughty Potions";}
elseif ($townrow["id"] == "13") {$potionsname = "Orb Potions";}
elseif ($townrow["id"] == "14") {$potionsname = "Genie Potions";}
elseif ($townrow["id"] == "15") {$potionsname = "Herbs and Potions";}
elseif ($townrow["id"] == "16") {$potionsname = "Orbs & Potions";}
elseif ($townrow["id"] == "17") {$potionsname = "Succubus Potions";}
elseif ($townrow["id"] == "18") {$potionsname = "Runes and Potions";}
elseif ($townrow["id"] == "19") {$potionsname = "Wand's Potions";}
elseif ($townrow["id"] == "20") {$potionsname = "Celestial Potions";}
elseif ($townrow["id"] == "21") {$potionsname = "Wyrm & Potions";}
elseif ($townrow["id"] == "22") {$potionsname = "Horoscopes & Potions";}
elseif ($townrow["id"] == "23") {$potionsname = "Third Wish Potions";}
elseif ($townrow["id"] == "24") {$potionsname = "Merry Potions";}
elseif ($townrow["id"] == "25") {$potionsname = "Relics & Potions";}
elseif ($townrow["id"] == "26") {$potionsname = "Spheres and Potions";}
elseif ($townrow["id"] == "27") {$potionsname = "Horoscopes & Potions";}
elseif ($townrow["id"] == "28") {$potionsname = "Third Wish Potions";}
elseif ($townrow["id"] == "29") {$potionsname = "Merry Potions";}
elseif ($townrow["id"] == "30") {$potionsname = "Relics & Potions";}
elseif ($townrow["id"] == "31") {$potionsname = "Bewitched Potions";}


// Names for Pets  petsname

if ($townrow["id"] == "1") {$petsname = "Central Bark Pets";}
elseif ($townrow["id"] == "2") {$petsname = "Fresh Paws Pets";}
elseif ($townrow["id"] == "3") {$petsname = "Zookeeper Pets";}
elseif ($townrow["id"] == "4") {$petsname = "Right Meow Pets";}
elseif ($townrow["id"] == "5") {$petsname = "The Ark Pets";}
elseif ($townrow["id"] == "6") {$petsname = "Barking Pets";}
elseif ($townrow["id"] == "7") {$petsname = "Companion Pets";}
elseif ($townrow["id"] == "8") {$petsname = "Pawsitive Pets";}
elseif ($townrow["id"] == "9") {$petsname = "Scrubadub Pets";}
elseif ($townrow["id"] == "10") {$petsname = "Muttropolian Pets";}
elseif ($townrow["id"] == "11") {$petsname = "Waggamuffins Pets";}
elseif ($townrow["id"] == "12") {$petsname = "Clippity Doo Pets";}
elseif ($townrow["id"] == "13") {$petsname = "Doggy Do's Pets";}
elseif ($townrow["id"] == "14") {$petsname = "Scruffy Pets";}
elseif ($townrow["id"] == "15") {$petsname = "Beowulf Pets";}
elseif ($townrow["id"] == "16") {$petsname = "Growls & Howls Pets";}
elseif ($townrow["id"] == "17") {$petsname = "Critters & Pets";}
elseif ($townrow["id"] == "18") {$petsname = "Creatures Pets";}
elseif ($townrow["id"] == "19") {$petsname = "Puppy Puppy Pets";}
elseif ($townrow["id"] == "20") {$petsname = "The Bakery Pets";}
elseif ($townrow["id"] == "21") {$petsname = "Hair balls Pets";}
elseif ($townrow["id"] == "22") {$petsname = "Wiggle Waggles Pets";}
elseif ($townrow["id"] == "23") {$petsname = "Cosmopawliton Pets";}
elseif ($townrow["id"] == "24") {$petsname = "Grooming dales Pets";}
elseif ($townrow["id"] == "25") {$petsname = "Beastly Pets";}
elseif ($townrow["id"] == "26") {$petsname = "Pick of the Litter";}
elseif ($townrow["id"] == "27") {$petsname = "Hair balls Pets";}
elseif ($townrow["id"] == "28") {$petsname = "Wiggle Waggles Pets";}
elseif ($townrow["id"] == "29") {$petsname = "Cosmopawliton Pets";}
elseif ($townrow["id"] == "30") {$petsname = "Grooming dales Pets";}
elseif ($townrow["id"] == "31") {$petsname = "Hidden Pets";}



	// Names Helmet helmetname

if ($townrow["id"] == "1") {$helmetname = "Faded Lands Helms";}
elseif ($townrow["id"] == "2") {$helmetname = "Bandit's Ivory Helm";}
elseif ($townrow["id"] == "3") {$helmetname = "Helms of the Steward";}
elseif ($townrow["id"] == "4") {$helmetname = "Faceguard of the Night";}
elseif ($townrow["id"] == "5") {$helmetname = "Gift of the Shadows";}
elseif ($townrow["id"] == "6") {$helmetname = "Arcane Resist Helms";}
elseif ($townrow["id"] == "7") {$helmetname = "Pride's Plate Helms";}
elseif ($townrow["id"] == "8") {$helmetname = "Lost Comrades Helms";}
elseif ($townrow["id"] == "9") {$helmetname = "Crowns of the Infinity";}
elseif ($townrow["id"] == "10") {$helmetname = "Protection Helms";}
elseif ($townrow["id"] == "11") {$helmetname = "Holy Trials Helms";}
elseif ($townrow["id"] == "12") {$helmetname = "Fallen Fortune Helms";}
elseif ($townrow["id"] == "13") {$helmetname = "Bronzed Headcover Helms";}
elseif ($townrow["id"] == "14") {$helmetname = "Gaze of Slaying Helms";}
elseif ($townrow["id"] == "15") {$helmetname = "Holy Protection Helms";}
elseif ($townrow["id"] == "16") {$helmetname = "Adamantine Jaws Helms";}
elseif ($townrow["id"] == "17") {$helmetname = "Attuned Crown Helms";}
elseif ($townrow["id"] == "18") {$helmetname = "Boon of Earth Helms";}
elseif ($townrow["id"] == "19") {$helmetname = "Eternity Helms";}
elseif ($townrow["id"] == "20") {$helmetname = "Comrades Helms";}
elseif ($townrow["id"] == "21") {$helmetname = "Fallen Helms";}
elseif ($townrow["id"] == "22") {$helmetname = "Basque Helms";}
elseif ($townrow["id"] == "23") {$helmetname = "Divine Helms";}
elseif ($townrow["id"] == "24") {$helmetname = "Crusader of Helms";}
elseif ($townrow["id"] == "25") {$helmetname = "Mists Helms";}
elseif ($townrow["id"] == "26") {$helmetname = "Sacred Helms";}
elseif ($townrow["id"] == "27") {$helmetname = "Justice Helms";}
elseif ($townrow["id"] == "28") {$helmetname = "Lionheart Helms";}
elseif ($townrow["id"] == "29") {$helmetname = "Ancient Helms";}
elseif ($townrow["id"] == "30") {$helmetname = "Brotherhood Helms";}
elseif ($townrow["id"] == "31") {$helmetname = "Helmets of Fate";}


	// Names Gauntlet gauntletname

if ($townrow["id"] == "1") {$gauntletname = "Conquered Gauntlets";}
elseif ($townrow["id"] == "2") {$gauntletname = "Punishment Gauntlets";}
elseif ($townrow["id"] == "3") {$gauntletname = "Mail Fists Gauntlets";}
elseif ($townrow["id"] == "4") {$gauntletname = "Steel Warfists";}
elseif ($townrow["id"] == "5") {$gauntletname = "Tyrannical Gauntlets";}
elseif ($townrow["id"] == "6") {$gauntletname = "Warfists Gauntlets";}
elseif ($townrow["id"] == "7") {$gauntletname = "Challenger's Fists";}
elseif ($townrow["id"] == "8") {$gauntletname = "Endless Gauntlets";}
elseif ($townrow["id"] == "9") {$gauntletname = "Bone Gauntlets";}
elseif ($townrow["id"] == "10") {$gauntletname = "Malevolent Gloves";}
elseif ($townrow["id"] == "11") {$gauntletname = "Ivory Gloves";}
elseif ($townrow["id"] == "12") {$gauntletname = "Windsong Gauntlets";}
elseif ($townrow["id"] == "13") {$gauntletname = "Destiny's Grips";}
elseif ($townrow["id"] == "14") {$gauntletname = "Nightmare Gloves";}
elseif ($townrow["id"] == "15") {$gauntletname = "Gloves of Glory";}
elseif ($townrow["id"] == "16") {$gauntletname = "Bronzed Hands";}
elseif ($townrow["id"] == "17") {$gauntletname = "Gloves of Torment";}
elseif ($townrow["id"] == "18") {$gauntletname = "Sorrows Gauntlets";}
elseif ($townrow["id"] == "19") {$gauntletname = "Dream Gauntlets";}
elseif ($townrow["id"] == "20") {$gauntletname = "Golden Gauntlets";}
elseif ($townrow["id"] == "21") {$gauntletname = "Grips of the Ancient";}
elseif ($townrow["id"] == "22") {$gauntletname = "Hands of Fortitude";}
elseif ($townrow["id"] == "23") {$gauntletname = "Hands of Ending Power";}
elseif ($townrow["id"] == "24") {$gauntletname = "Brutal Steel Gloves";}
elseif ($townrow["id"] == "25") {$gauntletname = "Defender's Fists";}
elseif ($townrow["id"] == "26") {$gauntletname = "Gloves of Lost Souls";}
elseif ($townrow["id"] == "27") {$gauntletname = "Chain Gauntlets";}
elseif ($townrow["id"] == "28") {$gauntletname = "Gauntlets of Bravery";}
elseif ($townrow["id"] == "29") {$gauntletname = "Fists of Fortitude";}
elseif ($townrow["id"] == "30") {$gauntletname = "Gloves of Domination";}
elseif ($townrow["id"] == "31") {$gauntletname = "Shadowland Gloves";}


	// Names towninf Town Information

if ($townrow["id"] == "1") {$towninfname = "Gates of the Capital";}
elseif ($townrow["id"] == "2") {$towninfname = "Gates of Argos";}
elseif ($townrow["id"] == "3") {$towninfname = "Gates of Sidon";}
elseif ($townrow["id"] == "4") {$towninfname = "Gates of Jericho";}
elseif ($townrow["id"] == "5") {$towninfname = "Gates of Narcissa";}
elseif ($townrow["id"] == "6") {$towninfname = "Gates of Luxor";}
elseif ($townrow["id"] == "7") {$towninfname = "Gates of Carthage";}
elseif ($townrow["id"] == "8") {$towninfname = "Gates of Corinth";}
elseif ($townrow["id"] == "9") {$towninfname = "Gates of Hagagaror";}
elseif ($townrow["id"] == "10") {$towninfname = "Gates of Troy";}
elseif ($townrow["id"] == "11") {$towninfname = "Gates of Rey";}
elseif ($townrow["id"] == "12") {$towninfname = "Gates of Merigold";}
elseif ($townrow["id"] == "13") {$towninfname = "Gates of Athens";}
elseif ($townrow["id"] == "14") {$towninfname = "Gates of Cario";}
elseif ($townrow["id"] == "15") {$towninfname = "Gates of Cyreneia";}
elseif ($townrow["id"] == "16") {$towninfname = "Gates of Camasiacum";}
elseif ($townrow["id"] == "17") {$towninfname = "Gates of Itanais";}
elseif ($townrow["id"] == "18") {$towninfname = "Gates of Neropolis";}
elseif ($townrow["id"] == "19") {$towninfname = "Gates of Girsche";}
elseif ($townrow["id"] == "20") {$towninfname = "Gates of Far Point City";}
elseif ($townrow["id"] == "21") {$towninfname = "Lost City of Arcadia Gates";}
elseif ($townrow["id"] == "22") {$towninfname = "Lost City of Avalon Gates";}
elseif ($townrow["id"] == "23") {$towninfname = "Lost City of Nysa Gates";}
elseif ($townrow["id"] == "24") {$towninfname = "Lost City of Zerzura Gates";}
elseif ($townrow["id"] == "25") {$towninfname = "Frontier Post Gates";}
elseif ($townrow["id"] == "26") {$towninfname = "Border Post Gates";}
elseif ($townrow["id"] == "27") {$towninfname = "Lost City of Avalon Gates";}
elseif ($townrow["id"] == "28") {$towninfname = "Lost City of Nysa Gates";}
elseif ($townrow["id"] == "29") {$towninfname = "Lost City of Zerzura Gates";}
elseif ($townrow["id"] == "30") {$towninfname = "Frontier Post Gates";}
elseif ($townrow["id"] == "31") {$towninfname = "Gates of Shadowland";}



// Names npclist Talk to NPCs

if ($townrow["id"] == "1") {$npclistname = "Villagers of the Capital";}
elseif ($townrow["id"] == "2") {$npclistname = "Villagers of Argos";}
elseif ($townrow["id"] == "3") {$npclistname = "Villagers of Sidon";}
elseif ($townrow["id"] == "4") {$npclistname = "Villagers of Jericho";}
elseif ($townrow["id"] == "5") {$npclistname = "Villagers of Narcissa";}
elseif ($townrow["id"] == "6") {$npclistname = "Villagers of Luxor";}
elseif ($townrow["id"] == "7") {$npclistname = "Villagers of Carthage";}
elseif ($townrow["id"] == "8") {$npclistname = "Villagers of Corinth";}
elseif ($townrow["id"] == "9") {$npclistname = "Villagers of Hagagaror";}
elseif ($townrow["id"] == "10") {$npclistname = "Villagers of Troy";}
elseif ($townrow["id"] == "11") {$npclistname = "Villagers of Rey";}
elseif ($townrow["id"] == "12") {$npclistname = "Villagers of Merigold";}
elseif ($townrow["id"] == "13") {$npclistname = "Villagers of Athens";}
elseif ($townrow["id"] == "14") {$npclistname = "Villagers of Cario";}
elseif ($townrow["id"] == "15") {$npclistname = "Villagers of Cyreneia";}
elseif ($townrow["id"] == "16") {$npclistname = "Villagers of Camasiacum";}
elseif ($townrow["id"] == "17") {$npclistname = "Villagers of Itanais";}
elseif ($townrow["id"] == "18") {$npclistname = "Villagers of Neropolis";}
elseif ($townrow["id"] == "19") {$npclistname = "Villagers of Girsche";}
elseif ($townrow["id"] == "20") {$npclistname = "Villagers of Astrologer";}
elseif ($townrow["id"] == "21") {$npclistname = "Villagers of Salt Lands";}
elseif ($townrow["id"] == "22") {$npclistname = "Villagers of Ram Mtns";}
elseif ($townrow["id"] == "23") {$npclistname = "Villagers of Nightmare";}
elseif ($townrow["id"] == "24") {$npclistname = "Villagers of Lasting Bell";}
elseif ($townrow["id"] == "25") {$npclistname = "Villagers of Whisper City";}
elseif ($townrow["id"] == "26") {$npclistname = "Villagers of Cranes";}
elseif ($townrow["id"] == "27") {$npclistname = "Villagers of Ram Mtns";}
elseif ($townrow["id"] == "28") {$npclistname = "Villagers of Nightmare";}
elseif ($townrow["id"] == "29") {$npclistname = "Villagers of Lasting Bell";}
elseif ($townrow["id"] == "30") {$npclistname = "Villagers of Whisper City";}
elseif ($townrow["id"] == "31") {$npclistname = "Villagers of Shadow";}


// Names npc2list Talk to NPCs

if ($townrow["id"] == "1") {$npc2listname = "Villagers of the Capital";}
elseif ($townrow["id"] == "2") {$npc2listname = "Villagers of Argos";}
elseif ($townrow["id"] == "3") {$npc2listname = "Villagers of Sidon";}
elseif ($townrow["id"] == "4") {$npc2listname = "Villagers of Jericho";}
elseif ($townrow["id"] == "5") {$npc2listname = "Villagers of Narcissa";}
elseif ($townrow["id"] == "6") {$npc2listname = "Villagers of Luxor";}
elseif ($townrow["id"] == "7") {$npc2listname = "Villagers of Carthage";}
elseif ($townrow["id"] == "8") {$npc2listname = "Villagers of Corinth";}
elseif ($townrow["id"] == "9") {$npc2listname = "Villagers of Hagagaror";}
elseif ($townrow["id"] == "10") {$npc2listname = "Villagers of Troy";}
elseif ($townrow["id"] == "11") {$npc2listname = "Villagers of Rey";}
elseif ($townrow["id"] == "12") {$npc2listname = "Villagers of Merigold";}
elseif ($townrow["id"] == "13") {$npc2listname = "Villagers of Athens";}
elseif ($townrow["id"] == "14") {$npc2listname = "Villagers of Cario";}
elseif ($townrow["id"] == "15") {$npc2listname = "Villagers of Cyreneia";}
elseif ($townrow["id"] == "16") {$npc2listname = "Villagers of Camasiacum";}
elseif ($townrow["id"] == "17") {$npc2listname = "Villagers of Itanais";}
elseif ($townrow["id"] == "18") {$npc2listname = "Villagers of Neropolis";}
elseif ($townrow["id"] == "19") {$npc2listname = "Villagers of Girsche";}
elseif ($townrow["id"] == "20") {$npc2listname = "Villagers of Astrologer";}
elseif ($townrow["id"] == "21") {$npc2listname = "Villagers of Salt Lands";}
elseif ($townrow["id"] == "22") {$npc2listname = "Villagers of Ram Mtns";}
elseif ($townrow["id"] == "23") {$npc2listname = "Villagers of Nightmare";}
elseif ($townrow["id"] == "24") {$npc2listname = "Villagers of Lasting Bell";}
elseif ($townrow["id"] == "25") {$npc2listname = "Villagers of Whisper City";}
elseif ($townrow["id"] == "26") {$npc2listname = "Villagers of Cranes";}
elseif ($townrow["id"] == "27") {$npc2listname = "Villagers of Ram Mtns";}
elseif ($townrow["id"] == "28") {$npc2listname = "Villagers of Nightmare";}
elseif ($townrow["id"] == "29") {$npc2listname = "Villagers of Lasting Bell";}
elseif ($townrow["id"] == "30") {$npc2listname = "Villagers of Whisper City";}
elseif ($townrow["id"] == "31") {$npc2listname = "Villagers of Shadow";}

	// Names questsname Quests

if ($townrow["id"] == "1") {$questsname = "Capital Quests";}
elseif ($townrow["id"] == "2") {$questsname = "Kingdom Quests";}
elseif ($townrow["id"] == "3") {$questsname = "Quests of Fortune";}
elseif ($townrow["id"] == "4") {$questsname = "Adventure Quests";}
elseif ($townrow["id"] == "5") {$questsname = "Lost Lands Quests";}
elseif ($townrow["id"] == "6") {$questsname = "Kingdom Quests";}
elseif ($townrow["id"] == "7") {$questsname = "Quests of Fortune";}
elseif ($townrow["id"] == "8") {$questsname = "Adventure Quests";}
elseif ($townrow["id"] == "9") {$questsname = "Hidden Quests";}
elseif ($townrow["id"] == "10") {$questsname = "Lost Lands Quests";}
elseif ($townrow["id"] == "11") {$questsname = "Kingdom Quests";}
elseif ($townrow["id"] == "12") {$questsname = "Quests of Fortune";}
elseif ($townrow["id"] == "13") {$questsname = "Next World Quests";}
elseif ($townrow["id"] == "14") {$questsname = "Hidden Quests";}
elseif ($townrow["id"] == "15") {$questsname = "Lost Lands Quests";}
elseif ($townrow["id"] == "16") {$questsname = "Kingdom Quests";}
elseif ($townrow["id"] == "17") {$questsname = "Quests of Fortune";}
elseif ($townrow["id"] == "18") {$questsname = "Adventure Quests";}
elseif ($townrow["id"] == "19") {$questsname = "Quests of Girsche";}
elseif ($townrow["id"] == "20") {$questsname = "Lost Lands Quests";}
elseif ($townrow["id"] == "21") {$questsname = "Kingdom Quests";}
elseif ($townrow["id"] == "22") {$questsname = "Quests of Fortune";}
elseif ($townrow["id"] == "23") {$questsname = "Adventure Quests";}
elseif ($townrow["id"] == "24") {$questsname = "Hidden Quests";}
elseif ($townrow["id"] == "25") {$questsname = "Adventure Quests";}
elseif ($townrow["id"] == "26") {$questsname = "Next World Quests";}
elseif ($townrow["id"] == "27") {$questsname = "Kingdom Quests";}
elseif ($townrow["id"] == "28") {$questsname = "Quests of Fortune";}
elseif ($townrow["id"] == "29") {$questsname = "Adventure Quests";}
elseif ($townrow["id"] == "30") {$questsname = "Hidden Quests";}
elseif ($townrow["id"] == "31") {$questsname = "Shadow Quests";}



	// Names warshopname War Shops

if ($townrow["id"] == "1") {$warshopname = "Capital Warshops";}
elseif ($townrow["id"] == "2") {$warshopname = "Argos Warshops";}
elseif ($townrow["id"] == "3") {$warshopname = " Warshops of Sidon";}
elseif ($townrow["id"] == "4") {$warshopname = "Jericho Warshops";}
elseif ($townrow["id"] == "5") {$warshopname = " Warshops of Narcissa";}
elseif ($townrow["id"] == "6") {$warshopname = "Luxor Warshops";}
elseif ($townrow["id"] == "7") {$warshopname = " Warshops of Carthage";}
elseif ($townrow["id"] == "8") {$warshopname = "Corinth Shops of War";}
elseif ($townrow["id"] == "9") {$warshopname = " Warshops of Hagagaror";}
elseif ($townrow["id"] == "10") {$warshopname = "Troy Warshops";}
elseif ($townrow["id"] == "11") {$warshopname = "Warshops of Rey";}
elseif ($townrow["id"] == "12") {$warshopname = "Merigold Shops of War";}
elseif ($townrow["id"] == "13") {$warshopname = "Warshops of Athens";}
elseif ($townrow["id"] == "14") {$warshopname = "Cario Warshops";}
elseif ($townrow["id"] == "15") {$warshopname = "Weapon Shops of Cyreneia";}
elseif ($townrow["id"] == "16") {$warshopname = "Camasiacum Shops of War";}
elseif ($townrow["id"] == "17") {$warshopname = "Warshops of Itanais";}
elseif ($townrow["id"] == "18") {$warshopname = "Neropolis Warshops";}
elseif ($townrow["id"] == "19") {$warshopname = "Warshops of Girsche";}
elseif ($townrow["id"] == "20") {$warshopname = "Astrologer Shops of War";}
elseif ($townrow["id"] == "21") {$warshopname = "Warshops of Salt Lands";}
elseif ($townrow["id"] == "22") {$warshopname = "Ram Mtns Warshops";}
elseif ($townrow["id"] == "23") {$warshopname = "Nightmare Weapon Shops";}
elseif ($townrow["id"] == "24") {$warshopname = "Bells Shops of War";}
elseif ($townrow["id"] == "25") {$warshopname = "Warshops of Whisper";}
elseif ($townrow["id"] == "26") {$warshopname = "Cranes Warshops";}
elseif ($townrow["id"] == "27") {$warshopname = "Astrologer Shops of War";}
elseif ($townrow["id"] == "28") {$warshopname = "Warshops of Salt Lands";}
elseif ($townrow["id"] == "29") {$warshopname = "Ram Mtns Warshops";}
elseif ($townrow["id"] == "30") {$warshopname = "Warshops of White Mare";}
elseif ($townrow["id"] == "31") {$warshopname = "Shadow Warshops";}


	// Offensive Weapon Shop	
	// Names warshopoffname War Shops

if ($townrow["id"] == "1") {$warshopoffname = "Offensive War Shops of the Capital";}
elseif ($townrow["id"] == "2") {$warshopoffname = "Offensive Warshops of Argos";}
elseif ($townrow["id"] == "3") {$warshopoffname = "Offensive Warshops of Sidon";}
elseif ($townrow["id"] == "4") {$warshopoffname = "Offensive Warshops of Jericho";}
elseif ($townrow["id"] == "5") {$warshopoffname = "Offensive Warshops of Narcissa";}
elseif ($townrow["id"] == "6") {$warshopoffname = "Offensive WarShops of Luxor";}
elseif ($townrow["id"] == "7") {$warshopoffname = "Offensive WarShops of Carthage";}
elseif ($townrow["id"] == "8") {$warshopoffname = "Offensive WarShops of Corinth";}
elseif ($townrow["id"] == "9") {$warshopoffname = "Offensive WarShops of Hagagaror";}
elseif ($townrow["id"] == "10") {$warshopoffname = "Offensive WarShops of Troy";}
elseif ($townrow["id"] == "11") {$warshopoffname = "Offensive WarShops of Rey";}
elseif ($townrow["id"] == "12") {$warshopoffname = "Offensive WarShops of Merigold";}
elseif ($townrow["id"] == "13") {$warshopoffname = "Offensive WarShops of Athens";}
elseif ($townrow["id"] == "14") {$warshopoffname = "Offensive WarShops of Cario";}
elseif ($townrow["id"] == "15") {$warshopoffname = "Offensive WarShops of Cyreneia";}
elseif ($townrow["id"] == "16") {$warshopoffname = "Offensive WarShops of Camasiacum";}
elseif ($townrow["id"] == "17") {$warshopoffname = "Offensive WarShops of Itanais";}
elseif ($townrow["id"] == "18") {$warshopoffname = "Offensive WarShops of Neropolis";}
elseif ($townrow["id"] == "19") {$warshopoffname = "Offensive WarShops of Girsche";}
elseif ($townrow["id"] == "20") {$warshopoffname = "Offensive WarShops of Far Point";}
elseif ($townrow["id"] == "21") {$warshopoffname = "Offensive WarShops of Arcadia";}
elseif ($townrow["id"] == "22") {$warshopoffname = "Offensive WarShops of Avalon";}
elseif ($townrow["id"] == "23") {$warshopoffname = "Offensive WarShops of Nysa";}
elseif ($townrow["id"] == "24") {$warshopoffname = "Offensive WarShops of Zerzura";}
elseif ($townrow["id"] == "25") {$warshopoffname = "Offensive WarShops of Disappearing";}
elseif ($townrow["id"] == "26") {$warshopoffname = "Offensive WarShops of Vanishing";}
elseif ($townrow["id"] == "27") {$warshopoffname = "Offensive WarShops of Arcadia";}
elseif ($townrow["id"] == "28") {$warshopoffname = "Offensive WarShops of Arcadia";}
elseif ($townrow["id"] == "29") {$warshopoffname = "Offensive WarShops of Avalon";}
elseif ($townrow["id"] == "30") {$warshopoffname = "Offensive WarShops of Nysa";}
elseif ($townrow["id"] == "31") {$warshopoffname = "Offensive WarShops of Shadowland";}
	

	// Defensive Weapon Shop	
	// Names warshopdefname War Shops

if ($townrow["id"] == "1") {$warshopdefname = "Defensive WarShops of the Capital";}
elseif ($townrow["id"] == "2") {$warshopdefname = "Defensive WarShops of Argos";}
elseif ($townrow["id"] == "3") {$warshopdefname = "Defensive WarShops of Sidon";}
elseif ($townrow["id"] == "4") {$warshopdefname = "Defensive WarShops of Jericho";}
elseif ($townrow["id"] == "5") {$warshopdefname = "Defensive WarShops of Narcissa";}
elseif ($townrow["id"] == "6") {$warshopdefname = "Defensive WarShops of Luxor";}
elseif ($townrow["id"] == "7") {$warshopdefname = "Defensive WarShops of Carthage";}
elseif ($townrow["id"] == "8") {$warshopdefname = "Defensive WarShops of Corinth";}
elseif ($townrow["id"] == "9") {$warshopdefname = "Defensive WarShops of Hagagaror";}
elseif ($townrow["id"] == "10") {$warshopdefname = "Defensive WarShops of Troy";}
elseif ($townrow["id"] == "11") {$warshopdefname = "Defensive WarShops of Rey";}
elseif ($townrow["id"] == "12") {$warshopdefname = "Defensive WarShops of Merigold";}
elseif ($townrow["id"] == "13") {$warshopdefname = "Defensive WarShops of Athens";}
elseif ($townrow["id"] == "14") {$warshopdefname = "Defensive WarShops of Cario";}
elseif ($townrow["id"] == "15") {$warshopdefname = "Defensive WarShops of Cyreneia";}
elseif ($townrow["id"] == "16") {$warshopdefname = "Defensive WarShops of Camasiacum";}
elseif ($townrow["id"] == "17") {$warshopdefname = "Defensive WarShops of Itanais";}
elseif ($townrow["id"] == "18") {$warshopdefname = "Defensive WarShops of Neropolis";}
elseif ($townrow["id"] == "19") {$warshopdefname = "Defensive WarShops of Girsche";}
elseif ($townrow["id"] == "20") {$warshopdefname = "Defensive WarShops of Far Point";}
elseif ($townrow["id"] == "21") {$warshopdefname = "Defensive WarShops of Arcadia";}
elseif ($townrow["id"] == "22") {$warshopdefname = "Defensive WarShops of Avalon";}
elseif ($townrow["id"] == "23") {$warshopdefname = "Defensive WarShops of Nysa";}
elseif ($townrow["id"] == "24") {$warshopdefname = "Defensive WarShops of Zerzura";}
elseif ($townrow["id"] == "25") {$warshopdefname = "Defensive WarShops of Disappearing";}
elseif ($townrow["id"] == "26") {$warshopdefname = "Defensive WarShops of Vanishing";}
elseif ($townrow["id"] == "27") {$warshopdefname = "Defensive WarShops of Neropolis";}
elseif ($townrow["id"] == "28") {$warshopdefname = "Defensive WarShops of Girsche";}
elseif ($townrow["id"] == "29") {$warshopdefname = "Defensive WarShops of Far Point";}
elseif ($townrow["id"] == "30") {$warshopdefname = "Defensive WarShops of Arcadia";}
elseif ($townrow["id"] == "31") {$warshopdefname = "Shadow Defensive WarShops";}

	// Names weaponshopname Weapon Shop

if ($townrow["id"] == "1") {$weaponshopname = "Capital Titan Arms";}
elseif ($townrow["id"] == "2") {$weaponshopname = "Argos Rampant Bull Weapons";}
elseif ($townrow["id"] == "3") {$weaponshopname = "Sidon Titan Arms";}
elseif ($townrow["id"] == "4") {$weaponshopname = "Jericho Weapon Shop";}
elseif ($townrow["id"] == "5") {$weaponshopname = "Narcissa Titan Arms";}
elseif ($townrow["id"] == "6") {$weaponshopname = "Luxor Weapon Shop";}
elseif ($townrow["id"] == "7") {$weaponshopname = "Carthage Weapon Shop";}
elseif ($townrow["id"] == "8") {$weaponshopname = "Rampant Bull Weapons";}
elseif ($townrow["id"] == "9") {$weaponshopname = "Hagagaror Titan Arms";}
elseif ($townrow["id"] == "10") {$weaponshopname = "Troy Titan Arms";}
elseif ($townrow["id"] == "11") {$weaponshopname = "Rey Weapon Shop";}
elseif ($townrow["id"] == "12") {$weaponshopname = "Merigold Weapon Shop";}
elseif ($townrow["id"] == "13") {$weaponshopname = "Rampant Bull Weapons";}
elseif ($townrow["id"] == "14") {$weaponshopname = "Crier Weapon Shop";}
elseif ($townrow["id"] == "15") {$weaponshopname = "Cyreneia Weapons";}
elseif ($townrow["id"] == "16") {$weaponshopname = "Hand Weapons";}
elseif ($townrow["id"] == "17") {$weaponshopname = "Rampant Bull Weapons";}
elseif ($townrow["id"] == "18") {$weaponshopname = "Titan Arms";}
elseif ($townrow["id"] == "19") {$weaponshopname = "Girsche Weapon Shop";}
elseif ($townrow["id"] == "20") {$weaponshopname = "Astrologer Weapon Shop";}
elseif ($townrow["id"] == "21") {$weaponshopname = "Salty Weapon Shop";}
elseif ($townrow["id"] == "22") {$weaponshopname = "Ram Mountains Arms";}
elseif ($townrow["id"] == "23") {$weaponshopname = "Rampant Bull Weapons";}
elseif ($townrow["id"] == "24") {$weaponshopname = "Bell Titan Arms";}
elseif ($townrow["id"] == "25") {$weaponshopname = "Whisper Weapon Shop";}
elseif ($townrow["id"] == "26") {$weaponshopname = "Cranes Weapon Shop";}
elseif ($townrow["id"] == "27") {$weaponshopname = "Girsche Weapon Shop";}
elseif ($townrow["id"] == "28") {$weaponshopname = "Astrologer Weapon Shop";}
elseif ($townrow["id"] == "29") {$weaponshopname = "Salty Weapon Shop";}
elseif ($townrow["id"] == "30") {$weaponshopname = "Ram Mountains Arms";}
elseif ($townrow["id"] == "31") {$weaponshopname = "Shadow Weapons";}
	
	// Name for shieldsshopname Shields Shop
		
if ($townrow["id"] == "1") {$shieldsshopname = "Titan Capital Shields";}
elseif ($townrow["id"] == "2") {$shieldsshopname = "Argos Rampant Bull Shields";}
elseif ($townrow["id"] == "3") {$shieldsshopname = "Sidon Titan Shields";}
elseif ($townrow["id"] == "4") {$shieldsshopname = "Shields Shop";}
elseif ($townrow["id"] == "5") {$shieldsshopname = "Titan Shields";}
elseif ($townrow["id"] == "6") {$shieldsshopname = "Luxor Shields Shop";}
elseif ($townrow["id"] == "7") {$shieldsshopname = "Carthage Shields Shop";}
elseif ($townrow["id"] == "8") {$shieldsshopname = "Rampant Bull Shields";}
elseif ($townrow["id"] == "9") {$shieldsshopname = "Hagagaror Shields Shop";}
elseif ($townrow["id"] == "10") {$shieldsshopname = "Troy Shields Shop";}
elseif ($townrow["id"] == "11") {$shieldsshopname = "Rey Shields Shop";}
elseif ($townrow["id"] == "12") {$shieldsshopname = "Titan Shields";}
elseif ($townrow["id"] == "13") {$shieldsshopname = "Rampant Bull Shields";}
elseif ($townrow["id"] == "14") {$shieldsshopname = "Cario Shields Shop";}
elseif ($townrow["id"] == "15") {$shieldsshopname = "Cyreneia Shields Shop";}
elseif ($townrow["id"] == "16") {$shieldsshopname = "Rampant Bull Shields";}
elseif ($townrow["id"] == "17") {$shieldsshopname = "Running Shields";}
elseif ($townrow["id"] == "18") {$shieldsshopname = "Titan Shields";}
elseif ($townrow["id"] == "19") {$shieldsshopname = "Girsche Shields Shop";}
elseif ($townrow["id"] == "20") {$shieldsshopname = "Astrologer Shields";}
elseif ($townrow["id"] == "21") {$shieldsshopname = "Salty Titan Shields";}
elseif ($townrow["id"] == "22") {$shieldsshopname = "Ram Mtns Shields Shop";}
elseif ($townrow["id"] == "23") {$shieldsshopname = "Nightmare Shields";}
elseif ($townrow["id"] == "24") {$shieldsshopname = "Bell Shields Shop";}
elseif ($townrow["id"] == "25") {$shieldsshopname = "Whispering Shields";}
elseif ($townrow["id"] == "26") {$shieldsshopname = "Cranes Titan Shields";}
elseif ($townrow["id"] == "27") {$shieldsshopname = "Girsche Shields Shop";}
elseif ($townrow["id"] == "28") {$shieldsshopname = "Astrologer Shields";}
elseif ($townrow["id"] == "29") {$shieldsshopname = "Salty Titan Shields";}
elseif ($townrow["id"] == "30") {$shieldsshopname = "Ram Mtns Shields Shop";}
elseif ($townrow["id"] == "31") {$shieldsshopname = "Shields of Shadow";}
	
	// Name for armorshopname Armor Shop
		
if ($townrow["id"] == "1") {$armorshopname = "Capital Armory Shop";}
elseif ($townrow["id"] == "2") {$armorshopname = "Rampant Bull Armory";}
elseif ($townrow["id"] == "3") {$armorshopname = "Sidon Armory Shop";}
elseif ($townrow["id"] == "4") {$armorshopname = "Jericho Armory";}
elseif ($townrow["id"] == "5") {$armorshopname = "Narcissa Armory Shop";}
elseif ($townrow["id"] == "6") {$armorshopname = "Luxor Armory";}
elseif ($townrow["id"] == "7") {$armorshopname = "Carthage Armory Shop";}
elseif ($townrow["id"] == "8") {$armorshopname = "Corinth Armory";}
elseif ($townrow["id"] == "9") {$armorshopname = "Hagagaror Armory Shop";}
elseif ($townrow["id"] == "10") {$armorshopname = "Troy Armory";}
elseif ($townrow["id"] == "11") {$armorshopname = "Rey Armory Shop";}
elseif ($townrow["id"] == "12") {$armorshopname = "Merigold Titan Armory";}
elseif ($townrow["id"] == "13") {$armorshopname = "Rampant Bull Armory";}
elseif ($townrow["id"] == "14") {$armorshopname = "Cario Armory";}
elseif ($townrow["id"] == "15") {$armorshopname = "Cyreneia Armory Shop";}
elseif ($townrow["id"] == "16") {$armorshopname = "Running Bull Armory";}
elseif ($townrow["id"] == "17") {$armorshopname = "Rampant Bull Armory";}
elseif ($townrow["id"] == "18") {$armorshopname = "Custom Armory Shop";}
elseif ($townrow["id"] == "19") {$armorshopname = "Oafs Armory";}
elseif ($townrow["id"] == "20") {$armorshopname = "Oafs Armory";}
elseif ($townrow["id"] == "21") {$armorshopname = "Salty Lands Armory";}
elseif ($townrow["id"] == "22") {$armorshopname = "Ram Mtns Armory";}
elseif ($townrow["id"] == "23") {$armorshopname = "Nightmare Armory Shop";}
elseif ($townrow["id"] == "24") {$armorshopname = "Bell Armory";}
elseif ($townrow["id"] == "25") {$armorshopname = "Whisper Armory Shop";}
elseif ($townrow["id"] == "26") {$armorshopname = "Cranes Oafs Armory";}
elseif ($townrow["id"] == "27") {$armorshopname = "Salty Lands Armory";}
elseif ($townrow["id"] == "28") {$armorshopname = "Ram Mtns Armory Shop";}
elseif ($townrow["id"] == "29") {$armorshopname = "Nightmare Armory";}
elseif ($townrow["id"] == "30") {$armorshopname = "Bell Armory Shop";}
elseif ($townrow["id"] == "31") {$armorshopname = "Shadow Armory";}

	// Name for Post Office - Mail Room
		
if ($townrow["id"] == "1") {$postofficename = "Monet Mail Drop";}
elseif ($townrow["id"] == "2") {$postofficename = "Phaedos Post Office";}
elseif ($townrow["id"] == "3") {$postofficename = "Masers Mail";}
elseif ($townrow["id"] == "4") {$postofficename = "Ceufroy Essex Mail";}
elseif ($townrow["id"] == "5") {$postofficename = "Eisner Mail Office";}
elseif ($townrow["id"] == "6") {$postofficename = "Selepos Van Mail";}
elseif ($townrow["id"] == "7") {$postofficename = "Alkamenos Mail Room";}
elseif ($townrow["id"] == "8") {$postofficename = "Gacaferi Post Office";}
elseif ($townrow["id"] == "9") {$postofficename = "Moriset Pernaska Mail";}
elseif ($townrow["id"] == "10") {$postofficename = "Ludeman Mail";}
elseif ($townrow["id"] == "11") {$postofficename = "Tho's Post Office";}
elseif ($townrow["id"] == "12") {$postofficename = "Tem Mardi Mail";}
elseif ($townrow["id"] == "13") {$postofficename = "Buia Mailbox";}
elseif ($townrow["id"] == "14") {$postofficename = "Morph's Post Office";}
elseif ($townrow["id"] == "15") {$postofficename = "Alkamenos Mail Room";}
elseif ($townrow["id"] == "16") {$postofficename = "Decades Sires Mail";}
elseif ($townrow["id"] == "17") {$postofficename = "Peritas Post Office";}
elseif ($townrow["id"] == "18") {$postofficename = "Teutonic Mail Room";}
elseif ($townrow["id"] == "19") {$postofficename = "Reynfrey Toclive Mail";}
elseif ($townrow["id"] == "20") {$postofficename = "Santxol Mail Room";}
elseif ($townrow["id"] == "21") {$postofficename = "Lycaon Rieux Post";}
elseif ($townrow["id"] == "22") {$postofficename = "Gorky Mail";}
elseif ($townrow["id"] == "23") {$postofficename = "McCann Mail";}
elseif ($townrow["id"] == "24") {$postofficename = "Hanson Post Office";}
elseif ($townrow["id"] == "25") {$postofficename = "Rebecca's Mail Room";}
elseif ($townrow["id"] == "26") {$postofficename = "Vela Mail";}
elseif ($townrow["id"] == "27") {$postofficename = "Lycaon Rieux Post";}
elseif ($townrow["id"] == "28") {$postofficename = "Gorky Mail Room";}
elseif ($townrow["id"] == "29") {$postofficename = "McCann Mail";}
elseif ($townrow["id"] == "30") {$postofficename = "Hanson Post Office";}
elseif ($townrow["id"] == "31") {$postofficename = "Shadow Mailbox";}

	// Name for Sell it Names		
	
if ($townrow["id"] == "1") {$sellitemsname = "We Buy Equipment";}
elseif ($townrow["id"] == "2") {$sellitemsname = "Equipment Buyer";}
elseif ($townrow["id"] == "3") {$sellitemsname = "Equipment Trader";}
elseif ($townrow["id"] == "4") {$sellitemsname = "Sell Your Equipment";}
elseif ($townrow["id"] == "5") {$sellitemsname = "Old Equipment Bought";}
elseif ($townrow["id"] == "6") {$sellitemsname = "We Buy Equipment";}
elseif ($townrow["id"] == "7") {$sellitemsname = "Equipment Buyer";}
elseif ($townrow["id"] == "8") {$sellitemsname = "Equipment Trader";}
elseif ($townrow["id"] == "9") {$sellitemsname = "Sell Your Equipment";}
elseif ($townrow["id"] == "10") {$sellitemsname = "Old Equipment Bought";}
elseif ($townrow["id"] == "11") {$sellitemsname = "We Buy Equipment";}
elseif ($townrow["id"] == "12") {$sellitemsname = "Equipment Buyer";}
elseif ($townrow["id"] == "13") {$sellitemsname = "Equipment Trader";}
elseif ($townrow["id"] == "14") {$sellitemsname = "Sell Your Equipment";}
elseif ($townrow["id"] == "15") {$sellitemsname = "Old Equipment Bought";}
elseif ($townrow["id"] == "16") {$sellitemsname = "We Buy Equipment";}
elseif ($townrow["id"] == "17") {$sellitemsname = "Equipment Buyer";}
elseif ($townrow["id"] == "18") {$sellitemsname = "Equipment Trader";}
elseif ($townrow["id"] == "19") {$sellitemsname = "Sell Your Equipment";}
elseif ($townrow["id"] == "20") {$sellitemsname = "Old Equipment Bought";}
elseif ($townrow["id"] == "21") {$sellitemsname = "We Buy Equipment";}
elseif ($townrow["id"] == "22") {$sellitemsname = "Equipment Buyer";}
elseif ($townrow["id"] == "23") {$sellitemsname = "Equipment Trader";}
elseif ($townrow["id"] == "24") {$sellitemsname = "Sell Your Equipment";}
elseif ($townrow["id"] == "25") {$sellitemsname = "Old Equipment Bought";}
elseif ($townrow["id"] == "26") {$sellitemsname = "We Buy Equipment";}
elseif ($townrow["id"] == "27") {$sellitemsname = "Equipment Buyer";}
elseif ($townrow["id"] == "28") {$sellitemsname = "Equipment Trader";}
elseif ($townrow["id"] == "29") {$sellitemsname = "Sell Your Equipment";}
elseif ($townrow["id"] == "30") {$sellitemsname = "Old Equipment Bought";}
elseif ($townrow["id"] == "31") {$sellitemsname = "Equipment Trader";}


	// Name for Bulletin Board - Forums
		
if ($townrow["id"] == "1") {$forumsname = "Tournachon Forums";}
elseif ($townrow["id"] == "2") {$forumsname = "Marpessa Forums";}
elseif ($townrow["id"] == "3") {$forumsname = "Burgundefara Bulletins";}
elseif ($townrow["id"] == "4") {$forumsname = "For cella Forums";}
elseif ($townrow["id"] == "5") {$forumsname = "Bridget Bulletins";}
elseif ($townrow["id"] == "6") {$forumsname = "Semitics Forums";}
elseif ($townrow["id"] == "7") {$forumsname = "Barbuda Bulletins";}
elseif ($townrow["id"] == "8") {$forumsname = "Enrico Forums";}
elseif ($townrow["id"] == "9") {$forumsname = "Barberella Forums";}
elseif ($townrow["id"] == "10") {$forumsname = "Fassnacht Forums";}
elseif ($townrow["id"] == "11") {$forumsname = "Dundrennan Bulletins";}
elseif ($townrow["id"] == "12") {$forumsname = "Wilhelm's Forums";}
elseif ($townrow["id"] == "13") {$forumsname = "Luckenbach Bulletins";}
elseif ($townrow["id"] == "14") {$forumsname = "Isekenmeiers Forums";}
elseif ($townrow["id"] == "15") {$forumsname = "Northern Forums";}
elseif ($townrow["id"] == "16") {$forumsname = "Michigamme Forums";}
elseif ($townrow["id"] == "17") {$forumsname = "Eduardo Forums";}
elseif ($townrow["id"] == "18") {$forumsname = "Bernard Bulletins";}
elseif ($townrow["id"] == "19") {$forumsname = "Cornelius Bulletins";}
elseif ($townrow["id"] == "20") {$forumsname = "Sengrat Forums";}
elseif ($townrow["id"] == "21") {$forumsname = "Freiburg Forums";}
elseif ($townrow["id"] == "22") {$forumsname = "Znngeru Forums";}
elseif ($townrow["id"] == "23") {$forumsname = "Belies Bulletins";}
elseif ($townrow["id"] == "24") {$forumsname = "Bushwhackers Forums";}
elseif ($townrow["id"] == "25") {$forumsname = "Mont anus Forums";}
elseif ($townrow["id"] == "26") {$forumsname = "Protean Bulletins";}
elseif ($townrow["id"] == "27") {$forumsname = "Freiburg Forums";}
elseif ($townrow["id"] == "28") {$forumsname = "Znngeru Forums";}
elseif ($townrow["id"] == "29") {$forumsname = "Belies Bulletins";}
elseif ($townrow["id"] == "30") {$forumsname = "Bushwhackers Forums";}
elseif ($townrow["id"] == "31") {$forumsname = "Dark Forums";}

	// Maps	
	
if ($townrow["id"] == "1") {$buymapsname = "Michele Maps";}
elseif ($townrow["id"] == "2") {$buymapsname = "Trettel Travel Maps";}
elseif ($townrow["id"] == "3") {$buymapsname = "Marpessa Maps";}
elseif ($townrow["id"] == "4") {$buymapsname = "Tzvetanov Travel Guides";}
elseif ($townrow["id"] == "5") {$buymapsname = "Mirella Maps";}
elseif ($townrow["id"] == "6") {$buymapsname = "Tichelman Travel Maps";}
elseif ($townrow["id"] == "7") {$buymapsname = "Marlins Maps";}
elseif ($townrow["id"] == "8") {$buymapsname = "Toledo Travel Guides";}
elseif ($townrow["id"] == "9") {$buymapsname = "Mehenilda Travel Maps";}
elseif ($townrow["id"] == "10") {$buymapsname = "Trainer Travel Guides";}
elseif ($townrow["id"] == "11") {$buymapsname = "Munga Maps";}
elseif ($townrow["id"] == "12") {$buymapsname = "Tauter Travel Maps";}
elseif ($townrow["id"] == "13") {$buymapsname = "Maiandria Maps";}
elseif ($townrow["id"] == "14") {$buymapsname = "Tourn Travel Guides";}
elseif ($townrow["id"] == "15") {$buymapsname = "Malasua Travel Maps";}
elseif ($townrow["id"] == "16") {$buymapsname = "Tettele Travel Maps";}
elseif ($townrow["id"] == "17") {$buymapsname = "Medesicaste Maps";}
elseif ($townrow["id"] == "18") {$buymapsname = "Thibault Travel Maps";}
elseif ($townrow["id"] == "19") {$buymapsname = "Barberella Maps";}
elseif ($townrow["id"] == "20") {$buymapsname = "Fassnacht Maps";}
elseif ($townrow["id"] == "21") {$buymapsname = "Dundrennan Maps";}
elseif ($townrow["id"] == "22") {$buymapsname = "Wilhelm Map Guides";}
elseif ($townrow["id"] == "23") {$buymapsname = "Luckenbach Maps";}
elseif ($townrow["id"] == "24") {$buymapsname = "Iseke Travel Guides";}
elseif ($townrow["id"] == "25") {$buymapsname = "Protean Travel Maps";}
elseif ($townrow["id"] == "26") {$buymapsname = "Michigamme Maps";}
elseif ($townrow["id"] == "27") {$buymapsname = "Dundrennan Maps";}
elseif ($townrow["id"] == "28") {$buymapsname = "Wilhelm Map Guides";}
elseif ($townrow["id"] == "29") {$buymapsname = "Luckenbach Maps";}
elseif ($townrow["id"] == "30") {$buymapsname = "Iseke Travel Guides";}
elseif ($townrow["id"] == "31") {$buymapsname = "Shadowland Maps";}


	// Names bootshopname Boot Shops

if ($townrow["id"] == "1") {$bootshopname = "Capital Boots";}
elseif ($townrow["id"] == "2") {$bootshopname = "Argos Boot Shop";}
elseif ($townrow["id"] == "3") {$bootshopname = "Sidon Boot Wear";}
elseif ($townrow["id"] == "4") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "5") {$bootshopname = "Boots by Moen";}
elseif ($townrow["id"] == "6") {$bootshopname = "Oafs Boots";}
elseif ($townrow["id"] == "7") {$bootshopname = "Boots of War";}
elseif ($townrow["id"] == "8") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "9") {$bootshopname = "Boot Wear";}
elseif ($townrow["id"] == "10") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "11") {$bootshopname = "Re's Boots";}
elseif ($townrow["id"] == "12") {$bootshopname = "Boots of War";}
elseif ($townrow["id"] == "13") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "14") {$bootshopname = "Boot Wear";}
elseif ($townrow["id"] == "15") {$bootshopname = "Julius Boot Shops";}
elseif ($townrow["id"] == "16") {$bootshopname = "Boots of War";}
elseif ($townrow["id"] == "17") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "18") {$bootshopname = "Boot Wear";}
elseif ($townrow["id"] == "19") {$bootshopname = "Girsche Boots";}
elseif ($townrow["id"] == "20") {$bootshopname = "Charles Boots of War";}
elseif ($townrow["id"] == "21") {$bootshopname = "Boots of War";}
elseif ($townrow["id"] == "22") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "23") {$bootshopname = "Boot Wear";}
elseif ($townrow["id"] == "24") {$bootshopname = "Bells Boot";}
elseif ($townrow["id"] == "25") {$bootshopname = "Boot Whispers";}
elseif ($townrow["id"] == "26") {$bootshopname = "Cranes Boot Shop";}
elseif ($townrow["id"] == "27") {$bootshopname = "Boots of War";}
elseif ($townrow["id"] == "28") {$bootshopname = "War Boots";}
elseif ($townrow["id"] == "29") {$bootshopname = "Boot Wear";}
elseif ($townrow["id"] == "30") {$bootshopname = "Bells Boot";}
elseif ($townrow["id"] == "31") {$bootshopname = "Boot of Shadow";}
	
	
	// Names magicringsname Magic Ring Shops
	
if ($townrow["id"] == "1") {$magicringshopname = "Rings & Things";}
elseif ($townrow["id"] == "2") {$magicringshopname = "The Ring Magic";}
elseif ($townrow["id"] == "3") {$magicringshopname = "Magic Ring Shop";}
elseif ($townrow["id"] == "4") {$magicringshopname = "Magic Things";}
elseif ($townrow["id"] == "5") {$magicringshopname = "Magic Stuff";}
elseif ($townrow["id"] == "6") {$magicringshopname = "Magic Wear";}
elseif ($townrow["id"] == "7") {$magicringshopname = "Things & Rings";}
elseif ($townrow["id"] == "8") {$magicringshopname = "Binges Rings";}
elseif ($townrow["id"] == "9") {$magicringshopname = "Magical Wonders";}
elseif ($townrow["id"] == "10") {$magicringshopname = "Magical Rings";}
elseif ($townrow["id"] == "11") {$magicringshopname = "Magical Things";}
elseif ($townrow["id"] == "12") {$magicringshopname = "Rings of Protection";}
elseif ($townrow["id"] == "13") {$magicringshopname = "Rings & Rings";}
elseif ($townrow["id"] == "14") {$magicringshopname = "Quality Rings";}
elseif ($townrow["id"] == "15") {$magicringshopname = "Quality Protection";}
elseif ($townrow["id"] == "16") {$magicringshopname = "Rings of Protection";}
elseif ($townrow["id"] == "17") {$magicringshopname = "Magical Things";}
elseif ($townrow["id"] == "18") {$magicringshopname = "Magical Rings";}
elseif ($townrow["id"] == "19") {$magicringshopname = "Magical Wonders";}
elseif ($townrow["id"] == "20") {$magicringshopname = "Binges Rings";}
elseif ($townrow["id"] == "21") {$magicringshopname = "Things & Rings";}
elseif ($townrow["id"] == "22") {$magicringshopname = "Magic Stuff";}
elseif ($townrow["id"] == "23") {$magicringshopname = "Magic Things";}
elseif ($townrow["id"] == "24") {$magicringshopname = "Magic Ring Shop";}
elseif ($townrow["id"] == "25") {$magicringshopname = "The Ring Magic";}
elseif ($townrow["id"] == "26") {$magicringshopname = "Rings & Things";}
elseif ($townrow["id"] == "27") {$magicringshopname = "Magic Stuff";}
elseif ($townrow["id"] == "28") {$magicringshopname = "Magic Things";}
elseif ($townrow["id"] == "29") {$magicringshopname = "Magic Ring Shop";}
elseif ($townrow["id"] == "30") {$magicringshopname = "The Ring Magic";}
elseif ($townrow["id"] == "31") {$magicringshopname = "Rings & Dings";}	
	


	//Throwing Weapons
	
if ($townrow["id"] == "1") {$throwingshopname = "Sky Weapons";}
elseif ($townrow["id"] == "2") {$throwingshopname = "The Throwing Cross";}
elseif ($townrow["id"] == "3") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "4") {$throwingshopname = "Range Weapon Shop";}
elseif ($townrow["id"] == "5") {$throwingshopname = "Weapons of the Air";}
elseif ($townrow["id"] == "6") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "7") {$throwingshopname = "Range Weapons Wonders";}
elseif ($townrow["id"] == "8") {$throwingshopname = "Range & Throwing Weapons";}
elseif ($townrow["id"] == "9") {$throwingshopname = "Throwing & Range Weapons";}
elseif ($townrow["id"] == "10") {$throwingshopname = "Bears Throwing Weapons";}
elseif ($townrow["id"] == "11") {$throwingshopname = "Quality Range Weapons";}
elseif ($townrow["id"] == "12") {$throwingshopname = "Quality Throwing Weapons";}
elseif ($townrow["id"] == "13") {$throwingshopname = "Weapons of the Air";}
elseif ($townrow["id"] == "14") {$throwingshopname = "Quality Range Weapons";}
elseif ($townrow["id"] == "15") {$throwingshopname = "Quality Throwing Weapons";}
elseif ($townrow["id"] == "16") {$throwingshopname = "Weapons of the Air";}
elseif ($townrow["id"] == "17") {$throwingshopname = "Throwing/Range Weapons";}
elseif ($townrow["id"] == "18") {$throwingshopname = "Range & Throwing Weapons";}
elseif ($townrow["id"] == "19") {$throwingshopname = "Range Weapon Wonders";}
elseif ($townrow["id"] == "20") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "21") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "22") {$throwingshopname = "Sky Weapons";}
elseif ($townrow["id"] == "23") {$throwingshopname = "Range Weapon Shop";}
elseif ($townrow["id"] == "24") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "25") {$throwingshopname = "The Throwing Bear";}
elseif ($townrow["id"] == "26") {$throwingshopname = "Throwing Things";}
elseif ($townrow["id"] == "27") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "28") {$throwingshopname = "Sky Weapons";}
elseif ($townrow["id"] == "29") {$throwingshopname = "Range Weapon Shop";}
elseif ($townrow["id"] == "30") {$throwingshopname = "Throwing Weapons Shop";}
elseif ($townrow["id"] == "31") {$throwingshopname = "Throwing Things";}


	// Broker	
	
if ($townrow["id"] == "1") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "2") {$brokersname = "Sell Your Items";}
elseif ($townrow["id"] == "3") {$brokersname = "Items Buyer";}
elseif ($townrow["id"] == "4") {$brokersname = "We Buy Items";}
elseif ($townrow["id"] == "5") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "6") {$brokersname = "Items Trader";}
elseif ($townrow["id"] == "7") {$brokersname = "Sell Your Items";}
elseif ($townrow["id"] == "8") {$brokersname = "Items Buyer";}
elseif ($townrow["id"] == "9") {$brokersname = "We Buy Items";}
elseif ($townrow["id"] == "10") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "11") {$brokersname = "Items Trader";}
elseif ($townrow["id"] == "12") {$brokersname = "Sell Your Items";}
elseif ($townrow["id"] == "13") {$brokersname = "Items Buyer";}
elseif ($townrow["id"] == "14") {$brokersname = "We Buy Items";}
elseif ($townrow["id"] == "15") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "16") {$brokersname = "Items Trader";}
elseif ($townrow["id"] == "17") {$brokersname = "Sell Your Items";}
elseif ($townrow["id"] == "18") {$brokersname = "Items Buyer";}
elseif ($townrow["id"] == "19") {$brokersname = "We Buy Items";}
elseif ($townrow["id"] == "20") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "21") {$brokersname = "Items Trader";}
elseif ($townrow["id"] == "22") {$brokersname = "Sell Your Items";}
elseif ($townrow["id"] == "23") {$brokersname = "Items Buyer";}
elseif ($townrow["id"] == "24") {$brokersname = "We Buy Items";}
elseif ($townrow["id"] == "25") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "26") {$brokersname = "Items Trader";}
elseif ($townrow["id"] == "27") {$brokersname = "Sell Your Items";}
elseif ($townrow["id"] == "28") {$brokersname = "Items Buyer";}
elseif ($townrow["id"] == "29") {$brokersname = "We Buy Items";}
elseif ($townrow["id"] == "30") {$brokersname = "Old Items Bought";}
elseif ($townrow["id"] == "31") {$brokersname = "Sell Your Items";}

	// Banking	
	
if ($townrow["id"] == "1") {$banksname = " Valley Banking";}
elseif ($townrow["id"] == "2") {$banksname = "National Bank";}
elseif ($townrow["id"] == "3") {$banksname = "Grand Bank";}
elseif ($townrow["id"] == "4") {$banksname = "Trust Company Bank";}
elseif ($townrow["id"] == "5") {$banksname = "Security Banking";}
elseif ($townrow["id"] == "6") {$banksname = "Guaranty Bank";}
elseif ($townrow["id"] == "7") {$banksname = "Cooperative Bank";}
elseif ($townrow["id"] == "8") {$banksname = "Savings Bank";}
elseif ($townrow["id"] == "9") {$banksname = "Commercial Bank";}
elseif ($townrow["id"] == "10") {$banksname = "Banking Association";}
elseif ($townrow["id"] == "11") {$banksname = "Chartered Bank";}
elseif ($townrow["id"] == "12") {$banksname = "National Bank";}
elseif ($townrow["id"] == "13") {$banksname = "Popular Bank";}
elseif ($townrow["id"] == "14") {$banksname = "First Bank";}
elseif ($townrow["id"] == "15") {$banksname = "Capital Bank";}
elseif ($townrow["id"] == "16") {$banksname = "Bank-N-Trust";}
elseif ($townrow["id"] == "17") {$banksname = "Interstate Bank";}
elseif ($townrow["id"] == "18") {$banksname = "Exchange Bank";}
elseif ($townrow["id"] == "19") {$banksname = "Moriset Pernaska Bank";}
elseif ($townrow["id"] == "20") {$banksname = "Sari lo Bank";}
elseif ($townrow["id"] == "21") {$banksname = "Theophilius Bank";}
elseif ($townrow["id"] == "22") {$banksname = "Tem Mardi Bank";}
elseif ($townrow["id"] == "23") {$banksname = "National Buia Bank";}
elseif ($townrow["id"] == "24") {$banksname = "Callimorphus Bank";}
elseif ($townrow["id"] == "25") {$banksname = "Alkamenos Bank";}
elseif ($townrow["id"] == "26") {$banksname = "Demades Sires Bank";}
elseif ($townrow["id"] == "27") {$banksname = "Theophilius Bank";}
elseif ($townrow["id"] == "28") {$banksname = "Tem Mardi Bank";}
elseif ($townrow["id"] == "29") {$banksname = "National Buia Bank";}
elseif ($townrow["id"] == "30") {$banksname = "Callimorphus Bank";}
elseif ($townrow["id"] == "31") {$banksname = "Hidden Bank";}
        }
	

// End Current town name.
		
        
        if ($controlrow["forumtype"] == 0) { $userrow["forumslink"] = ""; }
        elseif ($controlrow["forumtype"] == 1) { $userrow["forumslink"] = "<a href=\"forum.php\" class=\"myButton2\">Forum</a><br />"; }
        elseif ($controlrow["forumtype"] == 2) { $userrow["forumslink"] = "<a href=\"".$controlrow["forumaddress"]."\" class=\"myButton2\">Forum</a><br />"; }
        
        // Format various userrow stuffs...
		
		$userrow["brx"] = -($controlrow["gamesize"]) - $userrow["longitude"] + 100;    
        $userrow["bry"] = -($controlrow["gamesize"]) + $userrow["latitude"] + 100; 
		
        if ($userrow["latitude"] < 0) { $userrow["latitude"] = $userrow["latitude"] * -1 . "S"; } else { $userrow["latitude"] .= "N"; }
        if ($userrow["longitude"] < 0) { $userrow["longitude"] = $userrow["longitude"] * -1 . "W"; } else { $userrow["longitude"] .= "E"; }
		
        if ($userrow["authlevel"] == 1) { $userrow["adminlink"] = "<a href=\"admin.php\" class=\"myButton2\">Admin</a><br />"; } else { $userrow["adminlink"] = ""; }
        if ($userrow["authlevel"] == 3) { $userrow["moderatorlink"] = "<a href=\"moderator.php\" class=\"myButton2\">Moderator</a><br />"; } else { $userrow["moderatorlink"] = ""; }


//simple exp needed mod.
//simple exp needed mod.
//simple exp needed mod.

// add silver and copper banks and allmoneys

    	$levelquery = doquery("SELECT ". $userrow["charclass"]."_exp FROM {{table}} WHERE id='".($userrow["level"]+1)."' LIMIT 1", "levels");
    	$levelrow = mysql_fetch_array($levelquery);		
 		$exp_raw = $userrow["experience"];
        $userrow["experience"] = number_format($userrow["experience"]);
        $userrow["nextlevel"] = $levelrow[$userrow["charclass"]."_exp"];
    	$need = ($userrow["nextlevel"] - $userrow["experience"]);
        $userrow["expneed"] = $userrow["nextlevel"] - $exp_raw;
        $userrow["gold"] = ($userrow["gold"]);
        $userrow["bank"] = ($userrow["bank"]);
        $userrow["allmoney"] = ($userrow["bank"]) + ($userrow["gold"]);
		
		
        $userrow["silver"] = ($userrow["silver"]);
        $userrow["silverbank"] = ($userrow["silverbank"]);
        $userrow["allsilvermoney"] = ($userrow["silverbank"]) + ($userrow["silver"]);
		
		
        $userrow["copper"] = ($userrow["copper"]);
        $userrow["copperbank"] = ($userrow["copperbank"]);
        $userrow["allcoppermoney"] = ($userrow["copperbank"]) + ($userrow["copper"]);
		

//  $userrow["gold"] = number_format($userrow["gold"]);
//  $userrow["bank"] = number_format($userrow["bank"]);
//  $userrow["allmoney"] = number_format($userrow["bank"]) + number_format($userrow["gold"]);
		
		
// class image
		$userrow["classimg"] = "<img src=\"images/classes/".$userrow["charclass"].".png\" />";
// Gold image
		$userrow["goldimg"] = "<img src=\"images/items/gold_0.png\" />";

//  START CHARACTER ALIGNMENT ARRAY
//  START CHARACTER ALIGNMENT ARRAY
//  START CHARACTER ALIGNMENT ARRAY


if ($userrow["charalign"] == 1) { $userrow["charalign"] = $controlrow["align1name"]; }
elseif ($userrow["charalign"] == 2) { $userrow["charalign"] = $controlrow["align2name"]; }
elseif ($userrow["charalign"] == 3) { $userrow["charalign"] = $controlrow["align3name"]; }
elseif ($userrow["charalign"] == 4) { $userrow["charalign"] = $controlrow["align4name"]; }
elseif ($userrow["charalign"] == 5) { $userrow["charalign"] = $controlrow["align5name"]; }
elseif ($userrow["charalign"] == 6) { $userrow["charalign"] = $controlrow["align6name"]; }
elseif ($userrow["charalign"] == 7) { $userrow["charalign"] = $controlrow["align7name"]; }
//  END CHARACTER ALIGNMENT ARRAY
	
	
	
        // HP/MP/TP bars.
        $stathp = ceil($userrow["currenthp"] / $userrow["maxhp"] * 100);
        if ($userrow["maxmp"] != 0) { $statmp = ceil($userrow["currentmp"] / $userrow["maxmp"] * 100); } else { $statmp = 0; }
        $stattp = ceil($userrow["currenttp"] / $userrow["maxtp"] * 100);
        $stattable = "<table width=\"100\"><tr><td width=\"33%\">\n";
        $stattable .= "<table cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"padding:0px; width:15px; height:100px; border:solid 1px black; vertical-align:bottom;\">\n";
        if ($stathp >= 66) { $stattable .= "<div style=\"padding:0px; height:".$stathp."px; border-top:solid 1px black; background-image:url(images/bars_green.gif);\"><img src=\"images/bars_green.gif\" alt=\"\" /></div>"; }
        if ($stathp < 66 && $stathp >= 33) { $stattable .= "<div style=\"padding:0px; height:".$stathp."px; border-top:solid 1px black; background-image:url(images/bars_yellow.gif);\"><img src=\"images/bars_yellow.gif\" alt=\"\" /></div>"; }
        if ($stathp < 33) { $stattable .= "<div style=\"padding:0px; height:".$stathp."px; border-top:solid 1px black; background-image:url(images/bars_red.gif);\"><img src=\"images/bars_red.gif\" alt=\"\" /></div>"; }
        $stattable .= "</td></tr></table></td><td width=\"33%\">\n";
        $stattable .= "<table cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"padding:0px; width:15px; height:100px; border:solid 1px black; vertical-align:bottom;\">\n";
        if ($statmp >= 66) { $stattable .= "<div style=\"padding:0px; height:".$statmp."px; border-top:solid 1px black; background-image:url(images/bars_green.gif);\"><img src=\"images/bars_green.gif\" alt=\"\" /></div>"; }
        if ($statmp < 66 && $statmp >= 33) { $stattable .= "<div style=\"padding:0px; height:".$statmp."px; border-top:solid 1px black; background-image:url(images/bars_yellow.gif);\"><img src=\"images/bars_yellow.gif\" alt=\"\" /></div>"; }
        if ($statmp < 33) { $stattable .= "<div style=\"padding:0px; height:".$statmp."px; border-top:solid 1px black; background-image:url(images/bars_red.gif);\"><img src=\"images/bars_red.gif\" alt=\"\" /></div>"; }
        $stattable .= "</td></tr></table></td><td width=\"33%\">\n";
        $stattable .= "<table cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"padding:0px; width:15px; height:100px; border:solid 1px black; vertical-align:bottom;\">\n";
        if ($stattp >= 66) { $stattable .= "<div style=\"padding:0px; height:".$stattp."px; border-top:solid 1px black; background-image:url(images/bars_green.gif);\"><img src=\"images/bars_green.gif\" alt=\"\" /></div>"; }
        if ($stattp < 66 && $stattp >= 33) { $stattable .= "<div style=\"padding:0px; height:".$stattp."px; border-top:solid 1px black; background-image:url(images/bars_yellow.gif);\"><img src=\"images/bars_yellow.gif\" alt=\"\" /></div>"; }
        if ($stattp < 33) { $stattable .= "<div style=\"padding:0px; height:".$stattp."px; border-top:solid 1px black; background-image:url(images/bars_red.gif);\"><img src=\"images/bars_red.gif\" alt=\"\" /></div>"; }
        $stattable .= "</td></tr></table></td>\n";
        $stattable .= "</tr><tr><td colspan=3><center>Potion</center></td></tr>
		<tr>
<td><center><a title='$userrow[hp_potion] HP Potion(s)' href='index.php?do=potion:1'>HP</a></center></td>
<td><center><a title='$userrow[mp_potion] MP Potion(s)' href='index.php?do=potion:2'>MP</a></center></td>
<td><center><a title='$userrow[tp_potion] TP Potion(s)' href='index.php?do=potion:3'>TP</a></center></td></tr>
</table>\n";
        $userrow["statbars"] = $stattable;
        
        // Now make numbers stand out if they're low.
        if ($userrow["currenthp"] <= ($userrow["maxhp"]/5)) { $userrow["currenthp"] = "<blink><span class=\"highlight\"><b>*".$userrow["currenthp"]."*</b></span></blink>"; }
        if ($userrow["currentmp"] <= ($userrow["maxmp"]/5)) { $userrow["currentmp"] = "<blink><span class=\"highlight\"><b>*".$userrow["currentmp"]."*</b></span></blink>"; }

 // YOU Have MAIL WARNING DISPLAY
        $mailquery = doquery("SELECT * FROM {{table}} WHERE owner='".$userrow["id"]."' ", "mail");
        $mailrow = mysql_fetch_array($mailquery);
        if ($userrow["id"] == ($mailrow["owner"])) { $userrow["mail"] == $mailrow["owner"];
        $userrow["mail"] = "<font color=\"#804000\">Mail Awaits</font>"; }
        else { $userrow["mail"] = ""; }


           // YOU Have BEEN CHALLENGED DISPLAY
           $fightquery = doquery("SELECT * FROM {{table}} WHERE receiver='".$userrow["id"]."' ", "fight");
           $fightrow = mysql_fetch_array($fightquery);
           if ($userrow["id"] == ($fightrow["receiver"])) { $userrow["challenged"] == $fightrow["receiver"];
           $userrow["challenged"] = "<font color=\"#804000\">Arena Challenge</font>"; }
           else { $userrow["challenged"] = ""; }


        $spellquery = doquery("SELECT id,name,type FROM {{table}}","spells");
        $userspells = explode(",",$userrow["spells"]);
        $userrow["magiclist"] = "";
        while ($spellrow = mysql_fetch_array($spellquery)) {
            $spell = false;
            foreach($userspells as $a => $b) {
                if ($b == $spellrow["id"] && $spellrow["type"] == 1) { $spell = true; }
            }
            if ($spell == true) {
                $userrow["magiclist"] .= "<a href=\"index.php?do=spell:".$spellrow["id"]."\" class=\"myButton2\">".$spellrow["name"]."</a><br /><br />";
            }
        }
        if ($userrow["magiclist"] == "") { $userrow["magiclist"] = "None"; }
        if ($userrow["skills"] == 0) { $userrow["skills"] = ""; }
	  else { $userrow["skills"] = "<a href=\"index.php?do=skills\" class=\"myButton2\"><font color=\"red\"><blink><span class=\"highlight\"><b>&nbsp&nbsp ".$userrow["skills"]." Skill Points!</b></span></blink></font></a><br /><br />"; }




       
        // Travel To list.
        $townslist = explode(",",$userrow["towns"]);
        $townquery2 = doquery("SELECT * FROM {{table}} ORDER BY id", "towns");
        $userrow["townslist"] = "";
        while ($townrow2 = mysql_fetch_array($townquery2)) {
            $town = false;
            foreach($townslist as $a => $b) {
                if ($b == $townrow2["id"]) { $town = true; }
            }
  if ($town == true) { 
			if ($townrow2["latitude"] < 0) { $townrow2["latitude"] = $townrow2["latitude"] * -1 . "S"; } else { $townrow2["latitude"] .= "N"; }
        if ($townrow2["longitude"] < 0) { $townrow2["longitude"] = $townrow2["longitude"] * -1 . "W"; } else { $townrow2["longitude"] .= "E"; }
			$userrow["townslist"] .= "<a href=\"index.php?do=gotown:".$townrow2["id"]."\">".$townrow2["name"]."</a> - [".$townrow2["latitude"].", ".$townrow2["longitude"]."] TP: ".$townrow2["travelpoints"]."<br />\n";
            }
        }
        
    } else {
        $userrow = array();
    }



$finalarray = array(
"dkgamename"=>$controlrow["gamename"],
"title"=>$title,
"content"=>$content,
"rightnav"=>parsetemplate($rightnav,$userrow),
"leftnav"=>parsetemplate($leftnav,$userrow),
"topnav"=>$topnav,
"totaltime"=>round(getmicrotime() - $starttime, 4), 
"numqueries"=>$numqueries, 
"version"=>$version, 
"ipadres"=>$ipadres,
"allmoney"=>$allmoney,
"banksname"=>$banksname, 
"brokersname"=>$brokersname, 
"buymapsname"=>$buymapsname, 
"forumsname"=>$forumsname,
"sellitemsname"=>$sellitemsname,  
"postofficename"=>$postofficename, 
"potionsname"=>$potionsname, 
"innsname"=>$innsname, 
"towninfname"=>$towninfname, 
"newsname"=>$newsname, 
"npc2listname"=>$npc2listname, 
"npclistname"=>$npclistname, 
"questsname"=>$questsname, 
"warshopname"=>$warshopname,
"weaponshopname"=>$weaponshopname, 
"shieldsshopname"=>$shieldsshopname, 
"armorshopname"=>$armorshopname, 
"bootshopname"=>$bootshopname,
"throwingshopname"=>$throwingshopname,
"weaponname"=>$weaponname, 
"bootname"=>$bootname, 
"shieldname"=>$shieldname,
"armorname"=>$armorname,
"orbsname"=>$orbs,
"petsname"=>$petsname, 
"helmetname"=>$helmetname,
"magicringshopname"=>$magicringshopname,
"rangeweaponsname"=>$rangeweaponsname,
"allmoneyname"=>$allmoneyname,
"gauntletname"=>$gauntletname,
"warshopdefname"=>$warshopdefname,
"warshopoffname"=>$warshopoffname,
"towncityname"=>$towncityname,
"build"=>$build);


$page = parsetemplate($template, $finalarray);
$page = $xml . $page;
    
    if ($controlrow["compression"] == 1) { ob_start("ob_gzhandler"); }
    echo $page;
    die();
    
}




?>