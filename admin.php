<?php // admin.php :: primary administration script.

include('lib.php');
include('cookies.php');
$link = opendb();
$userrow = checkcookies();
if ($userrow == false) { die("Please log in to the <a href=\"../login.php?do=login\">Game</a> before using the control panel."); }
if ($userrow["authlevel"] != 1) { die("You must have administrator privileges to use the control panel."); }
$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);


if (isset($_GET["do"])) {
    $do = explode(":",$_GET["do"]);
	
	
    //Server Admin:
    if ($do[0] == "main") { main(); }
    elseif ($do[0] == "news") { addnews(); }
    elseif ($do[0] == "resetbabble") { resetbabble(); }
		
	// User Admin:
	elseif ($do[0] == "users") { users(); }
	elseif ($do[0] == "edituser") { edituser($do[1]); }
    elseif ($do[0] == "addusers") { adduser(); }
    elseif ($do[0] == "delusers") { deluser(); }
		
	// Orbs-Stats Admin:
	elseif ($do[0] == "resetstats") { resetstats(); } 
	elseif ($do[0] == "resetorbs") { resetorbs(); }
	elseif ($do[0] == "orbs") { orbs(); }
	
    //Monsters:
	elseif ($do[0] == "addmonster") { addmonster(); }
    elseif ($do[0] == "monsters") { monsters(); }
    elseif ($do[0] == "editmonster") { editmonster($do[1]); }
    elseif ($do[0] == "delmonsters") { delmonster(); }
	
	// Items:
	elseif ($do[0] == "additem") { additem(); }
	elseif ($do[0] == "items") { items(); }
    elseif ($do[0] == "edititem") { edititem($do[1]); }
	elseif ($do[0] == "delitems") { delitem(); }
	
    // Drops:
	elseif ($do[0] == "adddrop") { adddrop(); }
	elseif ($do[0] == "drops") { drops(); }
    elseif ($do[0] == "editdrop") { editdrop($do[1]); }
	elseif ($do[0] == "deldrops") { deldrop(); }
	
    //Towns:
	elseif ($do[0] == "addtown") { addtown(); }
	elseif ($do[0] == "towns") { towns(); }
    elseif ($do[0] == "edittown") { edittown($do[1]); }
    elseif ($do[0] == "deltowns") { deltown(); }
	
    //Spells:
	elseif ($do[0] == "addspell") { addspell(); }
	elseif ($do[0] == "spells") { spells(); }
    elseif ($do[0] == "editspell") { editspell($do[1]); }
    elseif ($do[0] == "delspells") { delspell(); }
	
	// Levels
    elseif ($do[0] == "addlevel") { addlevel(); }
	elseif ($do[0] == "levels") { levels(); }
    elseif ($do[0] == "editlevel") { editlevel(); }
    elseif ($do[0] == "dellevel") { dellevel(); }	
	
    //Fields:
    elseif ($do[0] == "fields") { fields(); }
    elseif ($do[0] == "editfield") { editfield($do[1]); }
    elseif ($do[0] == "addfield") { addfield(); }
	
	//Kingdoms
	elseif ($do[0] == "addlords") { addlords(); }
	elseif ($do[0] == "lords") { lords(); }
    elseif ($do[0] == "dellords") { dellords(); }
	elseif ($do[0] == "editlords") { editlords($do[1]); }
	
	//Start resource
 	elseif ($do[0] == "woodcut") {include('towns.php'); woodcut(); }
	elseif ($do[0] == "sellwood") {include('towns.php'); sellwood(); }
 	elseif ($do[0] == "un") {include('towns.php'); un(); }
 	elseif ($do[0] == "fish") {include('towns.php'); fish(); }
 	elseif ($do[0] == "ranger") {include('towns.php'); ranger(); }
 	elseif ($do[0] == "sellfish") {include('towns.php'); sellfish(); }
 	elseif ($do[0] == "market") {include('towns.php'); market(); }
	elseif ($do[0] == "resources") { resources(); }
	
	//NPC
    elseif ($do[0] == "addnpc") { addnpc(); }
	elseif ($do[0] == "npc") {  npc($do[1]); }
    elseif ($do[0] == "editnpc") {  editnpc($do[1]); }
    elseif ($do[0] == "delnpc") { delnpc(); }
	
	//NPC1
    elseif ($do[0] == "addnpc1") { addnpc1(); }
    elseif ($do[0] == "npc1") {  npc1($do[1]); }
    elseif ($do[0] == "editnpc1") { editnpc1($do[1]); }
    elseif ($do[0] == "delnpc1") { delnpc1(); }
	
	//NPC2
    elseif ($do[0] == "addnpc2") { addnpc2(); }
    elseif ($do[0] == "npc2") {  npc2($do[1]); }
    elseif ($do[0] == "editnpc2") { editnpc2($do[1]); }
    elseif ($do[0] == "delnpc2") { delnpc2(); }
	
	//Fields	
    elseif ($do[0] == "addfield") { addfield(); }
	elseif ($do[0] == "fields") { fields(); }
    elseif ($do[0] == "editfield") { editfield($do[1]); }
    elseif ($do[0] == "delfield") { delfield(); }
	
	//Quests	
    elseif ($do[0] == "addquest") { addquest(); }
	elseif ($do[0] == "quests") { quests(); }
    elseif ($do[0] == "editquest") { editquest($do[1]); }
    elseif ($do[0] == "delquest") { delquest(); }
	
	//Forums
	elseif ($do[0] == "editforum") { editforum(); }
	
    
} else { donothing(); }


function donothing() {
    $page = "<table width='530' height='530'>
<tr><td><center><h3 class='title'>Game Map Admin</h3></center></td></tr>
<tr><td align='left' valign='top' width='504' height='504' bordercolor='#000000' border='#000000'><center><iframe src ='images/map.gif' align='center' marginheight='0' marginwidth='0' height='501' width='501' scrolling='no' frameborder='2'></iframe></center></td></tr></table>";
	admindisplay($page, "Admin Home");
   
}



function main() {
    
    if (isset($_POST["submit"])) {
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($gamename == "") { $errors++; $errorlist .= "Game name is required.<br />"; }
        if (($gamesize % 5) != 0) { $errors++; $errorlist .= "Map size must be divisible by five.<br />"; }
        if (!is_numeric($gamesize)) { $errors++; $errorlist .= "Map size must be a number.<br />"; }
        if ($forumtype == 2 && $forumaddress == "") { $errors++; $errorlist .= "You must specify a forum address when using the External setting.<br />"; }
        if ($class1name == "") { $errors++; $errorlist .= "Class 1 name is required.<br />"; }
        if ($class2name == "") { $errors++; $errorlist .= "Class 2 name is required.<br />"; }
        if ($class3name == "") { $errors++; $errorlist .= "Class 3 name is required.<br />"; }
		if ($class4name == "") { $errors++; $errorlist .= "Class 4 name is required.<br />"; }
		if ($class5name == "") { $errors++; $errorlist .= "Class 5 name is required.<br />"; }
		if ($class6name == "") { $errors++; $errorlist .= "Class 6 name is required.<br />"; }
		if ($class7name == "") { $errors++; $errorlist .= "Class 7 name is required.<br />"; }
		if ($class8name == "") { $errors++; $errorlist .= "Class 8 name is required.<br />"; }
		if ($class9name == "") { $errors++; $errorlist .= "Class 9 name is required.<br />"; }
		if ($class10name == "") { $errors++; $errorlist .= "Class 10 name is required.<br />"; }
        if ($class11name == "") { $errors++; $errorlist .= "Class 11 name is required.<br />"; }
        if ($class12name == "") { $errors++; $errorlist .= "Class 12 name is required.<br />"; }
        if ($class13name == "") { $errors++; $errorlist .= "Class 13 name is required.<br />"; }
		if ($class14name == "") { $errors++; $errorlist .= "Class 14 name is required.<br />"; }
		if ($class15name == "") { $errors++; $errorlist .= "Class 15 name is required.<br />"; }
		if ($class16name == "") { $errors++; $errorlist .= "Class 16 name is required.<br />"; }
		if ($class17name == "") { $errors++; $errorlist .= "Class 17 name is required.<br />"; }
		if ($class18name == "") { $errors++; $errorlist .= "Class 18 name is required.<br />"; }
		if ($class19name == "") { $errors++; $errorlist .= "Class 19 name is required.<br />"; }
		if ($class20name == "") { $errors++; $errorlist .= "Class 20 name is required.<br />"; }
        if ($class21name == "") { $errors++; $errorlist .= "Class 21 name is required.<br />"; }
        if ($class22name == "") { $errors++; $errorlist .= "Class 22 name is required.<br />"; }
        if ($class23name == "") { $errors++; $errorlist .= "Class 23 name is required.<br />"; }
		if ($class24name == "") { $errors++; $errorlist .= "Class 24 name is required.<br />"; }
		if ($class25name == "") { $errors++; $errorlist .= "Class 25 name is required.<br />"; }
		if ($class26name == "") { $errors++; $errorlist .= "Class 26 name is required.<br />"; }
		if ($class27name == "") { $errors++; $errorlist .= "Class 27 name is required.<br />"; }
		if ($class28name == "") { $errors++; $errorlist .= "Class 28 name is required.<br />"; }
		if ($class29name == "") { $errors++; $errorlist .= "Class 29 name is required.<br />"; }
		if ($class30name == "") { $errors++; $errorlist .= "Class 30 name is required.<br />"; }
        if ($class31name == "") { $errors++; $errorlist .= "Class 31 name is required.<br />"; }
        if ($class32name == "") { $errors++; $errorlist .= "Class 32 name is required.<br />"; }
        if ($class33name == "") { $errors++; $errorlist .= "Class 33 name is required.<br />"; }
		if ($class34name == "") { $errors++; $errorlist .= "Class 34 name is required.<br />"; }
		if ($class35name == "") { $errors++; $errorlist .= "Class 35 name is required.<br />"; }
		if ($class36name == "") { $errors++; $errorlist .= "Class 36 name is required.<br />"; }
		if ($class37name == "") { $errors++; $errorlist .= "Class 37 name is required.<br />"; }
		if ($class38name == "") { $errors++; $errorlist .= "Class 38 name is required.<br />"; }
		if ($class39name == "") { $errors++; $errorlist .= "Class 39 name is required.<br />"; }
		if ($class40name == "") { $errors++; $errorlist .= "Class 40 name is required.<br />"; }
        if ($class41name == "") { $errors++; $errorlist .= "Class 41 name is required.<br />"; }
        if ($class42name == "") { $errors++; $errorlist .= "Class 42 name is required.<br />"; }
        if ($class43name == "") { $errors++; $errorlist .= "Class 43 name is required.<br />"; }
		if ($class44name == "") { $errors++; $errorlist .= "Class 44 name is required.<br />"; }
		if ($class45name == "") { $errors++; $errorlist .= "Class 45 name is required.<br />"; }
		if ($class46name == "") { $errors++; $errorlist .= "Class 46 name is required.<br />"; }
		if ($class47name == "") { $errors++; $errorlist .= "Class 47 name is required.<br />"; }
		if ($class48name == "") { $errors++; $errorlist .= "Class 48 name is required.<br />"; }
		if ($class49name == "") { $errors++; $errorlist .= "Class 49 name is required.<br />"; }
		if ($class50name == "") { $errors++; $errorlist .= "Class 50 name is required.<br />"; }
        if ($class51name == "") { $errors++; $errorlist .= "Class 51 name is required.<br />"; }
        if ($class52name == "") { $errors++; $errorlist .= "Class 52 name is required.<br />"; }
		
        if ($class1desc == "") { $errors++; $errorlist .= "Class 1 Description is Required.<br />"; }
        if ($class2desc == "") { $errors++; $errorlist .= "Class 2 Description is Required.<br />"; }
        if ($class3desc == "") { $errors++; $errorlist .= "Class 3 Description is Required.<br />"; }
		if ($class4desc == "") { $errors++; $errorlist .= "Class 4 Description is Required.<br />"; }
		if ($class5desc == "") { $errors++; $errorlist .= "Class 5 Description is Required.<br />"; }
		if ($class6desc == "") { $errors++; $errorlist .= "Class 6 Description is Required.<br />"; }
		if ($class7desc == "") { $errors++; $errorlist .= "Class 7 Description is Required.<br />"; }
		if ($class8desc == "") { $errors++; $errorlist .= "Class 8 Description is Required.<br />"; }
		if ($class9desc == "") { $errors++; $errorlist .= "Class 9 Description is Required.<br />"; }
		if ($class10desc == "") { $errors++; $errorlist .= "Class 10 Description is Required.<br />"; }
        if ($class11desc == "") { $errors++; $errorlist .= "Class 11 Description is Required.<br />"; }
        if ($class12desc == "") { $errors++; $errorlist .= "Class 12 Description is Required.<br />"; }
        if ($class13desc == "") { $errors++; $errorlist .= "Class 13 Description is Required.<br />"; }
		if ($class14desc == "") { $errors++; $errorlist .= "Class 14 Description is Required.<br />"; }
		if ($class15desc == "") { $errors++; $errorlist .= "Class 15 Description is Required.<br />"; }
		if ($class16desc == "") { $errors++; $errorlist .= "Class 16 Description is Required.<br />"; }
		if ($class17desc == "") { $errors++; $errorlist .= "Class 17 Description is Required.<br />"; }
		if ($class18desc == "") { $errors++; $errorlist .= "Class 18 Description is Required.<br />"; }
		if ($class19desc == "") { $errors++; $errorlist .= "Class 19 Description is Required.<br />"; }
		if ($class20desc == "") { $errors++; $errorlist .= "Class 20 Description is Required.<br />"; }
        if ($class21desc == "") { $errors++; $errorlist .= "Class 21 Description is Required.<br />"; }
        if ($class22desc == "") { $errors++; $errorlist .= "Class 22 Description is Required.<br />"; }
        if ($class23desc == "") { $errors++; $errorlist .= "Class 23 Description is Required.<br />"; }
		if ($class24desc == "") { $errors++; $errorlist .= "Class 24 Description is Required.<br />"; }
		if ($class25desc == "") { $errors++; $errorlist .= "Class 25 Description is Required.<br />"; }
		if ($class26desc == "") { $errors++; $errorlist .= "Class 26 Description is Required.<br />"; }
		if ($class27desc == "") { $errors++; $errorlist .= "Class 27 Description is Required.<br />"; }
		if ($class28desc == "") { $errors++; $errorlist .= "Class 28 Description is Required.<br />"; }
		if ($class29desc == "") { $errors++; $errorlist .= "Class 29 Description is Required.<br />"; }
		if ($class30desc == "") { $errors++; $errorlist .= "Class 30 Description is Required.<br />"; }
        if ($class31desc == "") { $errors++; $errorlist .= "Class 31 Description is Required.<br />"; }
        if ($class32desc == "") { $errors++; $errorlist .= "Class 32 Description is Required.<br />"; }
        if ($class33desc == "") { $errors++; $errorlist .= "Class 33 Description is Required.<br />"; }
		if ($class34desc == "") { $errors++; $errorlist .= "Class 34 Description is Required.<br />"; }
		if ($class35desc == "") { $errors++; $errorlist .= "Class 35 Description is Required.<br />"; }
		if ($class36desc == "") { $errors++; $errorlist .= "Class 36 Description is Required.<br />"; }
		if ($class37desc == "") { $errors++; $errorlist .= "Class 37 Description is Required.<br />"; }
		if ($class38desc == "") { $errors++; $errorlist .= "Class 38 Description is Required.<br />"; }
		if ($class39desc == "") { $errors++; $errorlist .= "Class 39 Description is Required.<br />"; }
		if ($class40desc == "") { $errors++; $errorlist .= "Class 40 Description is Required.<br />"; }
        if ($class41desc == "") { $errors++; $errorlist .= "Class 41 Description is Required.<br />"; }
        if ($class42desc == "") { $errors++; $errorlist .= "Class 42 Description is Required.<br />"; }
        if ($class43desc == "") { $errors++; $errorlist .= "Class 43 Description is Required.<br />"; }
		if ($class44desc == "") { $errors++; $errorlist .= "Class 44 Description is Required.<br />"; }
		if ($class45desc == "") { $errors++; $errorlist .= "Class 45 Description is Required.<br />"; }
		if ($class46desc == "") { $errors++; $errorlist .= "Class 46 Description is Required.<br />"; }
		if ($class47desc == "") { $errors++; $errorlist .= "Class 47 Description is Required.<br />"; }
		if ($class48desc == "") { $errors++; $errorlist .= "Class 48 Description is Required.<br />"; }
		if ($class49desc == "") { $errors++; $errorlist .= "Class 49 Description is Required.<br />"; }
		if ($class50desc == "") { $errors++; $errorlist .= "Class 50 Description is Required.<br />"; }
        if ($class51desc == "") { $errors++; $errorlist .= "Class 51 Description is Required.<br />"; }
        if ($class52desc == "") { $errors++; $errorlist .= "Class 52 Description is Required.<br />"; }
		
	 	if ($align1name == "") { $errors++; $errorlist .= "Align 1 name is required.<br />"; }
	 	if ($align2name == "") { $errors++; $errorlist .= "Align 2 name is required.<br />"; }
	 	if ($align3name == "") { $errors++; $errorlist .= "Align 3 name is required.<br />"; }
	 	if ($align4name == "") { $errors++; $errorlist .= "Align 4 name is required.<br />"; }
	 	if ($align5name == "") { $errors++; $errorlist .= "Align 5 name is required.<br />"; }
	 	if ($align6name == "") { $errors++; $errorlist .= "Align 6 name is required.<br />"; }
	 	if ($align7name == "") { $errors++; $errorlist .= "Align 7 name is required.<br />"; }
		
        if ($diff1name == "") { $errors++; $errorlist .= "Difficulty 1 name is required.<br />"; }
        if ($diff2name == "") { $errors++; $errorlist .= "Difficulty 2 name is required.<br />"; }
        if ($diff3name == "") { $errors++; $errorlist .= "Difficulty 3 name is required.<br />"; }
        if ($diff4name == "") { $errors++; $errorlist .= "Difficulty 4 name is required.<br />"; }
        if ($diff5name == "") { $errors++; $errorlist .= "Difficulty 5 name is required.<br />"; }
        if ($diff6name == "") { $errors++; $errorlist .= "Difficulty 6 name is required.<br />"; }
        if ($diff7name == "") { $errors++; $errorlist .= "Difficulty 7 name is required.<br />"; }
        if ($diff8name == "") { $errors++; $errorlist .= "Difficulty 8 name is required.<br />"; }
        if ($diff9name == "") { $errors++; $errorlist .= "Difficulty 9 name is required.<br />"; }
        if ($diff10name == "") { $errors++; $errorlist .= "Difficulty 10 name is required.<br />"; }
        if ($diff11name == "") { $errors++; $errorlist .= "Difficulty 11 name is required.<br />"; }		
		
        if (!is_numeric($_POST["diff2mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff3mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff4mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff5mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff6mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff7mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff8mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff9mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff10mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }
        if (!is_numeric($_POST["diff11mod"])) { $errors++; $errorlist .= "Difficulty 2 Factor is required.<br />"; }		
		
        if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET gamename='$gamename',gamesize='$gamesize',forumtype='$forumtype',forumaddress='$forumaddress',compression='$compression', class1name='$class1name', class2name='$class2name', class3name='$class3name', class4name='$class4name', class5name='$class5name', class6name='$class6name', class7name='$class7name', class8name='$class8name', class9name='$class9name', class10name='$class10name', class11name='$class11name', class12name='$class12name', class13name='$class13name', class14name='$class14name', class15name='$class15name', class16name='$class16name', class17name='$class17name', class18name='$class18name', class19name='$class19name', class20name='$class20name', class21name='$class21name', class22name='$class22name', class23name='$class23name', class24name='$class24name', class25name='$class25name', class26name='$class26name', class27name='$class27name', class28name='$class28name', class29name='$class29name', class30name='$class30name', class31name='$class31name', class32name='$class32name', class33name='$class33name', class34name='$class34name', class35name='$class35name', class36name='$class36name', class37name='$class37name', class38name='$class38name', class39name='$class39name', class40name='$class40name', class41name='$class41name', class42name='$class42name', class43name='$class43name', class44name='$class44name', class45name='$class45name', class46name='$class46name', class47name='$class47name', class48name='$class48name', class49name='$class49name', class50name='$class50name', class51name='$class51name', class52name='$class52name', class1desc='$class1desc', class2desc='$class2desc', class3desc='$class3desc', class4desc='$class4desc', class5desc='$class5desc', class6desc='$class6desc', class7desc='$class7desc', class8desc='$class8desc', class9desc='$class9desc', class10desc='$class10desc', class11desc='$class11desc', class12desc='$class12desc', class13desc='$class13desc', class14desc='$class14desc', class15desc='$class15desc', class16desc='$class16desc', class17desc='$class17desc', class18desc='$class18desc', class19desc='$class19desc', class20desc='$class20desc', class21desc='$class21desc', class22desc='$class22desc', class23desc='$class23desc', class24desc='$class24desc', class25desc='$class25desc', class26desc='$class26desc', class27desc='$class27desc', class28desc='$class28desc', class29desc='$class29desc', class30desc='$class30desc', class31desc='$class31desc', class32desc='$class32desc', class33desc='$class33desc', class34desc='$class34desc', class35desc='$class35desc', class36desc='$class36desc', class37desc='$class37desc', class38desc='$class38desc', class39desc='$class39desc', class40desc='$class40desc', class41desc='$class41desc', class42desc='$class42desc', class43desc='$class43desc', class44desc='$class44desc', class45desc='$class45desc', class46desc='$class46desc', class47desc='$class47desc', class48desc='$class48desc', class49desc='$class49desc', class50desc='$class50desc', class51desc='$class51desc', class52desc='$class52desc', align1name='$align1name', align2name='$align2name', align3name='$align3name', align4name='$align4name', align5name='$align5name', align6name='$align6name', align7name='$align7name', diff1name='$diff1name', diff2name='$diff2name', diff3name='$diff3name', diff4name='$diff4name', diff5name='$diff5name', diff6name='$diff6name', diff7name='$diff7name', diff8name='$diff8name', diff9name='$diff9name', diff10name='$diff10name', diff11name='$diff11name', diff2mod='$diff2mod', diff3mod='$diff3mod', diff4mod='$diff4mod', diff5mod='$diff5mod', diff6mod='$diff6mod', diff7mod='$diff7mod', diff8mod='$diff8mod', diff9mod='$diff9mod', diff10mod='$diff10mod', diff11mod='$diff11mod', gameopen='$gameopen', verifyemail='$verifyemail', gameurl='$gameurl', adminemail='$adminemail', shownews='$shownews', showonline='$showonline', showbabble='$showbabble' WHERE id='1' LIMIT 1", "control");
            admindisplay("Settings updated.","Main Settings");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br /><br />Please go back and try again.", "Main Settings");
        }
    }
    
    global $controlrow;
    
$page = <<<END
<u>Main Settings</u><br />
These options control several major settings for the overall game engine.<br /><br />
<form action="admin.php?do=main" method="post">
<table width="90%">

<tr>
<td width="20%"><span class="highlight">Game Open:</span></td>
<td><select name="gameopen"><option value="1" {{open1select}}>Open</option>
<option value="0" {{open0select}}>Closed</option></select><br />
<span class="small">Close the game if you are upgrading or working on settings and don't want to cause odd errors for end-users. Closing the game will completely halt all activity.</span></td></tr>

<tr><td width="20%">Game Name:</td><td><input type="text" name="gamename" size="50" maxlength="50" value="{{gamename}}" /><br /><span class="small">Default is "Dragon Knight". Change this if you want to change to call your game something different.</span></td></tr>

<tr><td width="20%">Game URL:</td><td><input type="text" name="gameurl" size="50" maxlength="100" value="{{gameurl}}" /><br /><span class="small">Please specify the full URL to your game installation ("http://www.server.com/dkpath/index.php").  This gets used in the registration email sent to users. If you leave this field blank or incorrect, users may not be able to register correctly.</span></td></tr>

<tr><td width="20%">Admin Email:</td><td><input type="text" name="adminemail" size="30" maxlength="100" value="{{adminemail}}" /><br /><span class="small">Please specify your email address. This gets used when the game has to send an email to users.</span></td></tr>

<tr><td width="20%">Map Size:</td><td><input type="text" name="gamesize" size="6" maxlength="6" value="{{gamesize}}" /><br /><span class="small">Default is 250. This is the size of each map quadrant. Note that monster levels increase every 5 spaces, so you should ensure that you have at least (map size / 5) monster levels total, otherwise there will be parts of the map without any monsters, or some monsters won't ever get used. Ex: with a map size of 250, you should have 50 monster levels total.</span></td></tr>

<tr><td width="20%">Forum Type:</td><td><select name="forumtype"><option value="0" {{selecttype0}}>Disabled</option><option value="1" {{selecttype1}}>Internal</option><option value="2" {{selecttype2}}>External</option></select><br /><span class="small">'Disabled' removes the forum link. 'Internal' uses the built-in (and very stripped-down) forum program included with Dragon Knight, if you don't have your own forums software already installed. 'External' uses the address provided below and links to your own forums software.</span></td></tr>

<tr><td width="20%">External Forum:</td><td><input type="text" name="forumaddress" size="50" maxlength="200" value="{{forumaddress}}" /><br /><span class="small">If the above value is set to 'External,' please specify the complete URL to your forums here.</span></td></tr>

<tr><td width="20%">Page Compression:</td><td><select name="compression"><option value="0" {{selectcomp0}}>Disabled</option><option value="1" {{selectcomp1}}>Enabled</option></select><br /><span class="small">Enable page compression if it is supported by your server, and this will greatly reduce the amount of bandwidth required by the game.</span></td></tr>

<tr><td width="20%">Email Verification:</td><td><select name="verifyemail"><option value="0" {{selectverify0}}>Disabled</option><option value="1" {{selectverify1}}>Enabled</option></select><br /><span class="small">Make users verify their email address for added security.</span></td></tr>

<tr><td width="20%">Show News:</td><td><select name="shownews"><option value="0" {{selectnews0}}>No</option><option value="1" {{selectnews1}}>Yes</option></select><br /><span class="small">Toggle display of the Latest News box in towns.</td></tr>

<tr><td width="20%">Show Who's Online:</td><td><select name="showonline"><option value="0" {{selectonline0}}>No</option><option value="1" {{selectonline1}}>Yes</option></select><br /><span class="small">Toggle display of the Who's Online box in towns.</span></td></tr>

<tr><td width="20%">Show Babblebox:</td><td><select name="showbabble"><option value="0" {{selectbabble0}}>No</option><option value="1" {{selectbabble1}}>Yes</option></select><br /><span class="small">Toggle display of the Babble Box in towns.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Classes</td></tr><tr>
<td width="20%">Class 1 Name:</td><td><input type="text" name="class1name" size="30" maxlength="50" value="{{class1name}}" /><br /></td></tr>
<tr><td width="20%">Class 2 Name:</td><td><input type="text" name="class2name" size="30" maxlength="50" value="{{class2name}}" /><br /></td></tr>
<tr><td width="20%">Class 3 Name:</td><td><input type="text" name="class3name" size="30" maxlength="50" value="{{class3name}}" /><br /></td></tr>
<tr><td width="20%">Class 4 Name:</td><td><input type="text" name="class4name" size="30" maxlength="50" value="{{class4name}}" /><br /></td></tr>
<tr><td width="20%">Class 5 Name:</td><td><input type="text" name="class5name" size="30" maxlength="50" value="{{class5name}}" /><br /></td></tr>
<tr><td width="20%">Class 6 Name:</td><td><input type="text" name="class6name" size="30" maxlength="50" value="{{class6name}}" /><br /></td></tr>
<tr><td width="20%">Class 7 Name:</td><td><input type="text" name="class7name" size="30" maxlength="50" value="{{class7name}}" /><br /></td></tr>
<tr><td width="20%">Class 8 Name:</td><td><input type="text" name="class8name" size="30" maxlength="50" value="{{class8name}}" /><br /></td></tr>
<tr><td width="20%">Class 9 Name:</td><td><input type="text" name="class9name" size="30" maxlength="50" value="{{class9name}}" /><br /></td></tr>
<tr><td width="20%">Class 10 Name:</td><td><input type="text" name="class10name" size="30" maxlength="50" value="{{class10name}}" /><br /></td></tr>
<tr><td width="20%">Class 11 Name:</td><td><input type="text" name="class11name" size="30" maxlength="50" value="{{class11name}}" /><br /></td></tr>
<tr><td width="20%">Class 12 Name:</td><td><input type="text" name="class12name" size="30" maxlength="50" value="{{class12name}}" /><br /></td></tr>
<tr><td width="20%">Class 13 Name:</td><td><input type="text" name="class13name" size="30" maxlength="50" value="{{class13name}}" /><br /></td></tr>
<tr><td width="20%">Class 14 Name:</td><td><input type="text" name="class14name" size="30" maxlength="50" value="{{class14name}}" /><br /></td></tr>
<tr><td width="20%">Class 15 Name:</td><td><input type="text" name="class15name" size="30" maxlength="50" value="{{class15name}}" /><br /></td></tr>
<tr><td width="20%">Class 16 Name:</td><td><input type="text" name="class16name" size="30" maxlength="50" value="{{class16name}}" /><br /></td></tr>
<tr><td width="20%">Class 17 Name:</td><td><input type="text" name="class17name" size="30" maxlength="50" value="{{class17name}}" /><br /></td></tr>
<tr><td width="20%">Class 18 Name:</td><td><input type="text" name="class18name" size="30" maxlength="50" value="{{class18name}}" /><br /></td></tr>
<tr><td width="20%">Class 19 Name:</td><td><input type="text" name="class19name" size="30" maxlength="50" value="{{class19name}}" /><br /></td></tr>
<tr><td width="20%">Class 20 Name:</td><td><input type="text" name="class20name" size="30" maxlength="50" value="{{class20name}}" /><br /></td></tr>
<tr><td width="20%">Class 21 Name:</td><td><input type="text" name="class21name" size="30" maxlength="50" value="{{class21name}}" /><br /></td></tr>
<tr><td width="20%">Class 22 Name:</td><td><input type="text" name="class22name" size="30" maxlength="50" value="{{class22name}}" /><br /></td></tr>
<tr><td width="20%">Class 23 Name:</td><td><input type="text" name="class23name" size="30" maxlength="50" value="{{class23name}}" /><br /></td></tr>
<tr><td width="20%">Class 24 Name:</td><td><input type="text" name="class24name" size="30" maxlength="50" value="{{class24name}}" /><br /></td></tr>
<tr><td width="20%">Class 25 Name:</td><td><input type="text" name="class25name" size="30" maxlength="50" value="{{class25name}}" /><br /></td></tr>
<tr><td width="20%">Class 26 Name:</td><td><input type="text" name="class26name" size="30" maxlength="50" value="{{class26name}}" /><br /></td></tr>
<tr><td width="20%">Class 27 Name:</td><td><input type="text" name="class27name" size="30" maxlength="50" value="{{class27name}}" /><br /></td></tr>
<tr><td width="20%">Class 28 Name:</td><td><input type="text" name="class28name" size="30" maxlength="50" value="{{class28name}}" /><br /></td></tr>
<tr><td width="20%">Class 29 Name:</td><td><input type="text" name="class29name" size="30" maxlength="50" value="{{class29name}}" /><br /></td></tr>
<tr><td width="20%">Class 30 Name:</td><td><input type="text" name="class30name" size="30" maxlength="50" value="{{class30name}}" /><br /></td></tr>
<tr><td width="20%">Class 31 Name:</td><td><input type="text" name="class31name" size="30" maxlength="50" value="{{class31name}}" /><br /></td></tr>
<tr><td width="20%">Class 32 Name:</td><td><input type="text" name="class32name" size="30" maxlength="50" value="{{class32name}}" /><br /></td></tr>
<tr><td width="20%">Class 33 Name:</td><td><input type="text" name="class33name" size="30" maxlength="50" value="{{class33name}}" /><br /></td></tr>
<tr><td width="20%">Class 34 Name:</td><td><input type="text" name="class34name" size="30" maxlength="50" value="{{class34name}}" /><br /></td></tr>
<tr><td width="20%">Class 35 Name:</td><td><input type="text" name="class35name" size="30" maxlength="50" value="{{class35name}}" /><br /></td></tr>
<tr><td width="20%">Class 36 Name:</td><td><input type="text" name="class36name" size="30" maxlength="50" value="{{class36name}}" /><br /></td></tr>
<tr><td width="20%">Class 37 Name:</td><td><input type="text" name="class37name" size="30" maxlength="50" value="{{class37name}}" /><br /></td></tr>
<tr><td width="20%">Class 38 Name:</td><td><input type="text" name="class38name" size="30" maxlength="50" value="{{class38name}}" /><br /></td></tr>
<tr><td width="20%">Class 39 Name:</td><td><input type="text" name="class39name" size="30" maxlength="50" value="{{class39name}}" /><br /></td></tr>
<tr><td width="20%">Class 40 Name:</td><td><input type="text" name="class40name" size="30" maxlength="50" value="{{class40name}}" /><br /></td></tr>
<tr><td width="20%">Class 41 Name:</td><td><input type="text" name="class41name" size="30" maxlength="50" value="{{class41name}}" /><br /></td></tr>
<tr><td width="20%">Class 42 Name:</td><td><input type="text" name="class42name" size="30" maxlength="50" value="{{class42name}}" /><br /></td></tr>
<tr><td width="20%">Class 43 Name:</td><td><input type="text" name="class43name" size="30" maxlength="50" value="{{class43name}}" /><br /></td></tr>
<tr><td width="20%">Class 44 Name:</td><td><input type="text" name="class44name" size="30" maxlength="50" value="{{class44name}}" /><br /></td></tr>
<tr><td width="20%">Class 45 Name:</td><td><input type="text" name="class45name" size="30" maxlength="50" value="{{class45name}}" /><br /></td></tr>
<tr><td width="20%">Class 46 Name:</td><td><input type="text" name="class46name" size="30" maxlength="50" value="{{class46name}}" /><br /></td></tr>
<tr><td width="20%">Class 47 Name:</td><td><input type="text" name="class47name" size="30" maxlength="50" value="{{class47name}}" /><br /></td></tr>
<tr><td width="20%">Class 48 Name:</td><td><input type="text" name="class48name" size="30" maxlength="50" value="{{class48name}}" /><br /></td></tr>
<tr><td width="20%">Class 49 Name:</td><td><input type="text" name="class49name" size="30" maxlength="50" value="{{class49name}}" /><br /></td></tr>
<tr><td width="20%">Class 50 Name:</td><td><input type="text" name="class50name" size="30" maxlength="50" value="{{class50name}}" /><br /></td></tr>
<tr><td width="20%">Class 51 Name:</td><td><input type="text" name="class51name" size="30" maxlength="50" value="{{class51name}}" /><br /></td></tr>
<tr><td width="20%">Class 52 Name:</td><td><input type="text" name="class52name" size="30" maxlength="50" value="{{class52name}}" /><br /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Classes Descriptions</td></tr><tr>
<tr><td width="20%">Class 1 Desc:</td><td><input type="text" name="class1desc" size="120" maxlength="360" value="{{class1desc}}" /><br /></td></tr>
<tr><td width="20%">Class 2 Desc:</td><td><input type="text" name="class2desc" size="120" maxlength="360" value="{{class2desc}}" /><br /></td></tr>
<tr><td width="20%">Class 3 Desc:</td><td><input type="text" name="class3desc" size="120" maxlength="360" value="{{class3desc}}" /><br /></td></tr>
<tr><td width="20%">Class 4 Desc:</td><td><input type="text" name="class4desc" size="120" maxlength="360" value="{{class4desc}}" /><br /></td></tr>
<tr><td width="20%">Class 5 Desc:</td><td><input type="text" name="class5desc" size="120" maxlength="360" value="{{class5desc}}" /><br /></td></tr>
<tr><td width="20%">Class 6 Desc:</td><td><input type="text" name="class6desc" size="120" maxlength="360" value="{{class6desc}}" /><br /></td></tr>
<tr><td width="20%">Class 7 Desc:</td><td><input type="text" name="class7desc" size="120" maxlength="360" value="{{class7desc}}" /><br /></td></tr>
<tr><td width="20%">Class 8 Desc:</td><td><input type="text" name="class8desc" size="120" maxlength="360" value="{{class8desc}}" /><br /></td></tr>
<tr><td width="20%">Class 9 Desc:</td><td><input type="text" name="class9desc" size="120" maxlength="360" value="{{class9desc}}" /><br /></td></tr>
<tr><td width="20%">Class 10 Desc:</td><td><input type="text" name="class10desc" size="120" maxlength="360" value="{{class10desc}}" /><br /></td></tr>
<tr><td width="20%">Class 11 Desc:</td><td><input type="text" name="class11desc" size="120" maxlength="360" value="{{class11desc}}" /><br /></td></tr>
<tr><td width="20%">Class 12 Desc:</td><td><input type="text" name="class12desc" size="120" maxlength="360" value="{{class12desc}}" /><br /></td></tr>
<tr><td width="20%">Class 13 Desc:</td><td><input type="text" name="class13desc" size="120" maxlength="360" value="{{class13desc}}" /><br /></td></tr>
<tr><td width="20%">Class 14 Desc:</td><td><input type="text" name="class14desc" size="120" maxlength="360" value="{{class14desc}}" /><br /></td></tr>
<tr><td width="20%">Class 15 Desc:</td><td><input type="text" name="class15desc" size="120" maxlength="360" value="{{class15desc}}" /><br /></td></tr>
<tr><td width="20%">Class 16 Desc:</td><td><input type="text" name="class16desc" size="120" maxlength="360" value="{{class16desc}}" /><br /></td></tr>
<tr><td width="20%">Class 17 Desc:</td><td><input type="text" name="class17desc" size="120" maxlength="360" value="{{class17desc}}" /><br /></td></tr>
<tr><td width="20%">Class 18 Desc:</td><td><input type="text" name="class18desc" size="120" maxlength="360" value="{{class18desc}}" /><br /></td></tr>
<tr><td width="20%">Class 19 Desc:</td><td><input type="text" name="class19desc" size="120" maxlength="360" value="{{class19desc}}" /><br /></td></tr>
<tr><td width="20%">Class 20 Desc:</td><td><input type="text" name="class20desc" size="120" maxlength="360" value="{{class20desc}}" /><br /></td></tr>
<tr><td width="20%">Class 21 Desc:</td><td><input type="text" name="class21desc" size="120" maxlength="360" value="{{class21desc}}" /><br /></td></tr>
<tr><td width="20%">Class 22 Desc:</td><td><input type="text" name="class22desc" size="120" maxlength="360" value="{{class22desc}}" /><br /></td></tr>
<tr><td width="20%">Class 23 Desc:</td><td><input type="text" name="class23desc" size="120" maxlength="360" value="{{class23desc}}" /><br /></td></tr>
<tr><td width="20%">Class 24 Desc:</td><td><input type="text" name="class24desc" size="120" maxlength="360" value="{{class24desc}}" /><br /></td></tr>
<tr><td width="20%">Class 25 Desc:</td><td><input type="text" name="class25desc" size="120" maxlength="360" value="{{class25desc}}" /><br /></td></tr>
<tr><td width="20%">Class 26 Desc:</td><td><input type="text" name="class26desc" size="120" maxlength="360" value="{{class26desc}}" /><br /></td></tr>
<tr><td width="20%">Class 27 Desc:</td><td><input type="text" name="class27desc" size="120" maxlength="360" value="{{class27desc}}" /><br /></td></tr>
<tr><td width="20%">Class 28 Desc:</td><td><input type="text" name="class28desc" size="120" maxlength="360" value="{{class28desc}}" /><br /></td></tr>
<tr><td width="20%">Class 29 Desc:</td><td><input type="text" name="class29desc" size="120" maxlength="360" value="{{class29desc}}" /><br /></td></tr>
<tr><td width="20%">Class 30 Desc:</td><td><input type="text" name="class30desc" size="120" maxlength="360" value="{{class30desc}}" /><br /></td></tr>
<tr><td width="20%">Class 31 Desc:</td><td><input type="text" name="class31desc" size="120" maxlength="360" value="{{class31desc}}" /><br /></td></tr>
<tr><td width="20%">Class 32 Desc:</td><td><input type="text" name="class32desc" size="120" maxlength="360" value="{{class32desc}}" /><br /></td></tr>
<tr><td width="20%">Class 33 Desc:</td><td><input type="text" name="class33desc" size="120" maxlength="360" value="{{class33desc}}" /><br /></td></tr>
<tr><td width="20%">Class 34 Desc:</td><td><input type="text" name="class34desc" size="120" maxlength="360" value="{{class34desc}}" /><br /></td></tr>
<tr><td width="20%">Class 35 Desc:</td><td><input type="text" name="class35desc" size="120" maxlength="360" value="{{class35desc}}" /><br /></td></tr>
<tr><td width="20%">Class 36 Desc:</td><td><input type="text" name="class36desc" size="120" maxlength="360" value="{{class36desc}}" /><br /></td></tr>
<tr><td width="20%">Class 37 Desc:</td><td><input type="text" name="class37desc" size="120" maxlength="360" value="{{class37desc}}" /><br /></td></tr>
<tr><td width="20%">Class 38 Desc:</td><td><input type="text" name="class38desc" size="120" maxlength="360" value="{{class38desc}}" /><br /></td></tr>
<tr><td width="20%">Class 39 Desc:</td><td><input type="text" name="class39desc" size="120" maxlength="360" value="{{class39desc}}" /><br /></td></tr>
<tr><td width="20%">Class 40 Desc:</td><td><input type="text" name="class40desc" size="120" maxlength="360" value="{{class40desc}}" /><br /></td></tr>
<tr><td width="20%">Class 41 Desc:</td><td><input type="text" name="class41desc" size="120" maxlength="360" value="{{class41desc}}" /><br /></td></tr>
<tr><td width="20%">Class 42 Desc:</td><td><input type="text" name="class42desc" size="120" maxlength="360" value="{{class42desc}}" /><br /></td></tr>
<tr><td width="20%">Class 43 Desc:</td><td><input type="text" name="class43desc" size="120" maxlength="360" value="{{class43desc}}" /><br /></td></tr>
<tr><td width="20%">Class 44 Desc:</td><td><input type="text" name="class44desc" size="120" maxlength="360" value="{{class44desc}}" /><br /></td></tr>
<tr><td width="20%">Class 45 Desc:</td><td><input type="text" name="class45desc" size="120" maxlength="360" value="{{class45desc}}" /><br /></td></tr>
<tr><td width="20%">Class 46 Desc:</td><td><input type="text" name="class46desc" size="120" maxlength="360" value="{{class46desc}}" /><br /></td></tr>
<tr><td width="20%">Class 47 Desc:</td><td><input type="text" name="class47desc" size="120" maxlength="360" value="{{class47desc}}" /><br /></td></tr>
<tr><td width="20%">Class 48 Desc:</td><td><input type="text" name="class48desc" size="120" maxlength="360" value="{{class48desc}}" /><br /></td></tr>
<tr><td width="20%">Class 49 Desc:</td><td><input type="text" name="class49desc" size="120" maxlength="360" value="{{class49desc}}" /><br /></td></tr>
<tr><td width="20%">Class 50 Desc:</td><td><input type="text" name="class50desc" size="120" maxlength="360" value="{{class50desc}}" /><br /></td></tr>
<tr><td width="20%">Class 51 Desc:</td><td><input type="text" name="class51desc" size="120" maxlength="360" value="{{class51desc}}" /><br /></td></tr>
<tr><td width="20%">Class 52 Desc:</td><td><input type="text" name="class52desc" size="120" maxlength="360" value="{{class52desc}}" /><br /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Alignments</td></tr>
<tr><td width="20%">Align 1 Name:</td><td><input type="text" name="align1name" size="30" maxlength="50" value="{{align1name}}" /><br /></td></tr>
<tr><td width="20%">Align 2 Name:</td><td><input type="text" name="align2name" size="30" maxlength="50" value="{{align2name}}" /><br /></td></tr>
<tr><td width="20%">Align 3 Name:</td><td><input type="text" name="align3name" size="30" maxlength="50" value="{{align3name}}" /><br /></td></tr>
<tr><td width="20%">Align 4 Name:</td><td><input type="text" name="align4name" size="30" maxlength="50" value="{{align4name}}" /><br /></td></tr>
<tr><td width="20%">Align 5 Name:</td><td><input type="text" name="align5name" size="30" maxlength="50" value="{{align5name}}" /><br /></td></tr>
<tr><td width="20%">Align 6 Name:</td><td><input type="text" name="align6name" size="30" maxlength="50" value="{{align6name}}" /><br /></td></tr>
<tr><td width="20%">Align 7 Name:</td><td><input type="text" name="align7name" size="30" maxlength="50" value="{{align7name}}" /><br /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Difficulty Levels</td></tr>
<tr><td width="20%">Difficulty 1 Name:</td><td><input type="text" name="diff1name" size="30" maxlength="50" value="{{diff1name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 2 Name:</td><td><input type="text" name="diff2name" size="30" maxlength="50" value="{{diff2name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 2 Value:</td><td><input type="text" name="diff2mod" size="3" maxlength="3" value="{{diff2mod}}" /><br /><span class="small">Default is 1.1. Specify factorial value for Peasant difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 3 Name:</td><td><input type="text" name="diff3name" size="30" maxlength="50" value="{{diff3name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 3 Value:</td><td><input type="text" name="diff3mod" size="3" maxlength="3" value="{{diff3mod}}" /><br /><span class="small">Default is 1.2. Specify factorial value for Vassal difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 4 Name:</td><td><input type="text" name="diff4name" size="30" maxlength="50" value="{{diff4name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 4 Value:</td><td><input type="text" name="diff4mod" size="3" maxlength="3" value="{{diff4mod}}" /><br /><span class="small">Default is 1.3. Specify factorial value for Farmer difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 5 Name:</td><td><input type="text" name="diff5name" size="30" maxlength="50" value="{{diff5name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 5 Value:</td><td><input type="text" name="diff5mod" size="3" maxlength="3" value="{{diff5mod}}" /><br /><span class="small">Default is 1.4. Specify factorial value for Trader difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 6 Name:</td><td><input type="text" name="diff6name" size="30" maxlength="50" value="{{diff6name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 6 Value:</td><td><input type="text" name="diff6mod" size="3" maxlength="3" value="{{diff6mod}}" /><br /><span class="small">Default is 1.5. Specify factorial value for Merchant difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 7 Name:</td><td><input type="text" name="diff7name" size="30" maxlength="50" value="{{diff7name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 7 Value:</td><td><input type="text" name="diff7mod" size="3" maxlength="3" value="{{diff7mod}}" /><br /><span class="small">Default is 1.6. Specify factorial value for Clergy difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 8 Name:</td><td><input type="text" name="diff8name" size="30" maxlength="50" value="{{diff8name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 8 Value:</td><td><input type="text" name="diff8mod" size="3" maxlength="3" value="{{diff8mod}}" /><br /><span class="small">Default is 1.7. Specify factorial value for Knight difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 9 Name:</td><td><input type="text" name="diff9name" size="30" maxlength="50" value="{{diff9name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 9 Value:</td><td><input type="text" name="diff9mod" size="3" maxlength="3" value="{{diff9mod}}" /><br /><span class="small">Default is 1.8. Specify factorial value for Nobleman difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 10 Name:</td><td><input type="text" name="diff10name" size="30" maxlength="50" value="{{diff10name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 10 Value:</td><td><input type="text" name="diff10mod" size="3" maxlength="3" value="{{diff10mod}}" /><br /><span class="small">Default is 1.9. Specify factorial value for Lord difficulty here.</span></td></tr>
<tr><td width="20%">Difficulty 11 Name:</td><td><input type="text" name="diff11name" size="30" maxlength="50" value="{{diff11name}}" /><br /></td></tr>
<tr><td width="20%">Difficulty 11 Value:</td><td><input type="text" name="diff11mod" size="3" maxlength="3" value="{{diff11mod}}" /><br /><span class="small">Default is 2. Specify factorial value for King difficulty here.</span></td></tr>

</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form>
END;

    if ($controlrow["forumtype"] == 0) { $controlrow["selecttype0"] = "selected=\"selected\" "; } else { $controlrow["selecttype0"] = ""; }
    if ($controlrow["forumtype"] == 1) { $controlrow["selecttype1"] = "selected=\"selected\" "; } else { $controlrow["selecttype1"] = ""; }
    if ($controlrow["forumtype"] == 2) { $controlrow["selecttype2"] = "selected=\"selected\" "; } else { $controlrow["selecttype2"] = ""; }
    if ($controlrow["compression"] == 0) { $controlrow["selectcomp0"] = "selected=\"selected\" "; } else { $controlrow["selectcomp0"] = ""; }
    if ($controlrow["compression"] == 1) { $controlrow["selectcomp1"] = "selected=\"selected\" "; } else { $controlrow["selectcomp1"] = ""; }
    if ($controlrow["verifyemail"] == 0) { $controlrow["selectverify0"] = "selected=\"selected\" "; } else { $controlrow["selectverify0"] = ""; }
    if ($controlrow["verifyemail"] == 1) { $controlrow["selectverify1"] = "selected=\"selected\" "; } else { $controlrow["selectverify1"] = ""; }
    if ($controlrow["shownews"] == 0) { $controlrow["selectnews0"] = "selected=\"selected\" "; } else { $controlrow["selectnews0"] = ""; }
    if ($controlrow["shownews"] == 1) { $controlrow["selectnews1"] = "selected=\"selected\" "; } else { $controlrow["selectnews1"] = ""; }
    if ($controlrow["showonline"] == 0) { $controlrow["selectonline0"] = "selected=\"selected\" "; } else { $controlrow["selectonline0"] = ""; }
    if ($controlrow["showonline"] == 1) { $controlrow["selectonline1"] = "selected=\"selected\" "; } else { $controlrow["selectonline1"] = ""; }
    if ($controlrow["showbabble"] == 0) { $controlrow["selectbabble0"] = "selected=\"selected\" "; } else { $controlrow["selectbabble0"] = ""; }
    if ($controlrow["showbabble"] == 1) { $controlrow["selectbabble1"] = "selected=\"selected\" "; } else { $controlrow["selectbabble1"] = ""; }
    if ($controlrow["gameopen"] == 1) { $controlrow["open1select"] = "selected=\"selected\" "; } else { $controlrow["open1select"] = ""; }
    if ($controlrow["gameopen"] == 0) { $controlrow["open0select"] = "selected=\"selected\" "; } else { $controlrow["open0select"] = ""; }

    $page = parsetemplate($page, $controlrow);
    admindisplay($page, "Main Settings");

}




function editforum() {
	
	$adtoken = admintoken();
	$link = opendb();
	
	if (isset($_POST['delete'])) {
		$id = protect($_POST['id']);
		doquery($link, "delete from {{table}} where id=$id","forum");
		admindisplay("Forum thread deleted, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Thread Deleted");
	}
	if (isset($_POST['sticky'])) {
		$id = protect($_POST['id']);
		doquery($link,"update {{table}} set sticky='1' where id=$id","forum");
		admindisplay("Forum thread stickied, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Thread Stickied");
	}
	if (isset($_POST['unsticky'])) {
		$id = protect($_POST['id']);
		doquery($link,"update {{table}} set sticky='0' where id=$id","forum");
		admindisplay("Forum thread unstickied, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Thread Unstickied");
	}
	if (isset($_POST['lock'])) {
		$id = protect($_POST['id']);
		doquery($link,"update {{table}} set locked='1' where id=$id","forum");
		admindisplay("Forum thread locked, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Thread Locked");
	}
	if (isset($_POST['unlock'])) {
		$id = protect($_POST['id']);
		doquery($link,"update {{table}} set locked='0' where id=$id","forum");
		admindisplay("Forum thread unlocked, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Thread Unlocked");
	}
	if (isset($_POST['deletereply'])) {
		$id = protect($_POST['id']);
		doquery($link,"update {{table}} set replies=replies-1 where id=$id","forum");
		admindisplay("Forum reply deleted, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Reply Deleted");
	}
	if (isset($_POST['addreply'])) {
		$id = protect($_POST['id']);
		doquery($link,"update {{table}} set replies=replies+1 where id=$id","forum");
		admindisplay("Forum thread added, you may return to editing the <a href=admin.php?do=editforum>Forum</a>","Thread Added");
	}
	$page = "<b><u>Edit forum posts</b></u><br /><br /><br />Click the Delete button to delete a post.<br /><br />";
	$page .= "<b><u>KEY</b></u><br /><br /><p><u>lock:</u>      0 = unlocked &nbsp&nbsp&nbsp&nbsp 1 = locked   </p><p> <u>stickied:</u>      0 = unstickied &nbsp&nbsp&nbsp&nbsp 1 = stickied  </p><br />   ";
	$forumquery = doquery($link, "SELECT * FROM {{table}} ORDER BY id DESC LIMIT 100", "forum");
	while ($forumrow = mysqli_fetch_array($forumquery)) {
		if ($bg = 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=editforum\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"><input type=\"submit\" value=\"sticky\" name=\"sticky\"><input type=\"submit\" value=\"unsticky\" name=\"unsticky\"> <input type=\"submit\" value=\"lock\" name=\"lock\"><input type=\"submit\" value=\"unlock\" name=\"unlock\"><input type=\"submit\" value=\"delete a reply\" name=\"deletereply\"><input type=\"submit\" value=\"add a reply\" name=\"addreply\">  <input type=\"hidden\" name=\"id\" value=\"".$forumrow["id"]."\"></form></p><p><b>".$forumrow["author"].":</b> ".$forumrow["content"]."</p><p> locked:".$forumrow["locked"]."   stickied:".$forumrow["sticky"]."  parent:".$forumrow["parent"]."  replies:".$forumrow["replies"]."</p><p>Title:".$forumrow["title"]."</p></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=editforum\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"submit\" value=\"sticky\" name=\"sticky\"><input type=\"submit\" value=\"unsticky\" name=\"unsticky\"> <input type=\"submit\" value=\"lock\" name=\"lock\"><input type=\"submit\" value=\"unlock\" name=\"unlock\"><input type=\"submit\" value=\"delete a reply\" name=\"deletereply\"><input type=\"submit\" value=\"add a reply\" name=\"addreply\"> <input type=\"hidden\" name=\"id\" value=\"".$forumrow["id"]."\"></form></p><p><b>".$forumrow["author"].":</b> ".stripslashes($forumrow["content"])."</p><p> locked:".$forumrow["locked"]."   stickied:".$forumrow["sticky"]."  parent:".$forumrow["parent"]."  replies:".$forumrow["replies"]."</p><p>Title:".$forumrow["title"]."</p></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Edit forum");
}



function items() {
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "items");
    $page = "Edit Items<br />Click an item's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=edititem:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=edititem:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No items found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Items");
    
}

function edititem($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($buycost == "") { $errors++; $errorlist .= "Cost is required.<br />"; }
        if (!is_numeric($buycost)) { $errors++; $errorlist .= "Cost must be a number.<br />"; }
        if ($attribute == "") { $errors++; $errorlist .= "Attribute is required.<br />"; }
        if (!is_numeric($attribute)) { $errors++; $errorlist .= "Attribute must be a number.<br />"; }		
        if ($level == "") { $errors++; $errorlist .= "Level is required.<br />"; }
        if (!is_numeric($level)) { $errors++; $errorlist .= "Level must be a number.<br />"; }		
        if ($special == "" || $special == " ") { $special = "X"; }
        if ($special2 == "" || $special2 == " ") { $special2 = "X"; }
        if ($special3 == "" || $special3 == " ") { $special3 = "X"; }		
        if ($description == "") { $errors++; $errorlist .= "Description is Required. You can enter None.<br />"; }
        
        if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='$name',type='$type',buycost='$buycost',attribute='$attribute',level='$level',special='$special',special2='$special2',special3='$special3',description='$description' WHERE id='$id' LIMIT 1", "items");
            admindisplay("Item updated.","Edit Items");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Items");
        }    
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "items");
    $row = mysql_fetch_array($query);

$page = <<<END
<u>Edit Items</u><br /><br />
<form action="admin.php?do=edititem:$id" method="post">
<table width="90%">

<tr><td width="20%">ID:</td><td>{{id}}</td></tr>

<tr><td width="20%"><img src="imag/{{name}}.png" alt="Items"></td>
<td><br />Images should be 26-60px Height (average should be 32px) & a Max. of 120px Width.</td></tr>


<tr><td width="20%">Name:</td><td><input type="text" name="name" size="40" maxlength="30" value="{{name}}" /></td></tr>
<tr><td width="20%">Type:</td><td><select name="type">
	<option value="1" {{type1select}}>Weapons</option>
	<option value="2" {{type2select}}>Armor</option>
	<option value="3" {{type3select}}>Shield</option>
	<option value="4" {{type4select}}>Pet</option>
	<option value="5" {{type5select}}>Helmet</option>
	<option value="6" {{type6select}}>Gauntlet</option>
	<option value="7" {{type7select}}>Boots</option>
	<option value="8" {{type8select}}>Range Weapons</option>
	<option value="9" {{type9select}}>Magic Rings</option>
</td></tr>

<tr><td width="20%">Cost:</td>
<td><input type="text" name="buycost" size="10" maxlength="10" value="{{buycost}}" /> gold</td></tr>

<tr><td width="20%">Attribute:</td>
<td><input type="text" name="attribute" size="4" maxlength="5" value="{{attribute}}" />
<br />How much the item adds to total <font color="green">Attack Power</font> (Weapons | Range & Throwing Weapons | Gauntlets | Pets) or 
<font color="green">Defense Power</font> (Armor | Shields | Helmets | Boots | Magic Rings).</td></tr>

<tr><td width="20%">Level:</td>
<td><input type="text" name="level" size="3" maxlength="3" value="{{level}}" />
<br />Restricts buying of item to this level and above.</td></tr>

<tr><td width="20%">Special:</td>
<td><input type="text" name="special" size="30" maxlength="50" value="{{special}}" />
<br />Needs be either a special code or <span class="highlight">X</span><br />to disable. 
<font color="green">Edit this field very carefully</font> because mistakes to<br />formatting 
or field names can create problems in the game.</td></tr>

<tr><td width="20%">Special2:</td>
<td><input type="text" name="special2" size="30" maxlength="50" value="{{special2}}" />
<br />Needs be either a special code or <span class="highlight">X</span><br />to disable.  
<font color="green">Edit this field very carefully</font> because mistakes to<br />formatting 
or field names can create problems in the game.</td></tr>

<tr><td width="20%">Special3:</td>
<td><input type="text" name="special3" size="30" maxlength="50" value="{{special3}}" />
<br />Needs  be either a special code or <span class="highlight">X</span><br />to disable.  
<font color="green">Edit this field very carefully</font> because mistakes to<br />formatting 
or field names can create problems in the game.</td></tr>

<tr><td width="100%">Description:</td>
<td colspan="7"><input type="text" name="description" size="100" maxlength="300" value="{{description}}" />
<br />Description of the Item. Up to 300 Characters. Or Just Type: <font color="green">None</font>. 
Its Required that one or the other must be Entered.</td>
</tr></table>
  
<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset"  class="myButton2" />
</form><br /><br />

Special Codes:<br />
Special codes are used in the three attribute [Special] fields to give the item properties. 
The first attribute field must contain a special code, but the second one may be left empty ("X"). 
Same goes for the third. Special codes are in the format <span class="highlight">attribute,value</span>. 
<span class="highlight">Attribute</span> can be any database field from the Users table - however,
 it is suggested that you only use the ones from the list below, otherwise things can get freaky. 
 <span class="highlight">Value</span> may be any positive or negative whole number. For example, 
 if you want a weapon to give an additional 50 max hit points, the special code would be 
 <span class="highlight">maxhp,50</span>. Special Codes fields do not have to contain a special code, 
 and may be left empty ("X") if you wish. <font color="green">The ("X") is REQUIRED if left empty</font>.<br /><br />

Suggested user fields for special codes: [Just Examples - the second value can be any number. 
For game sake balancing, codes should be kept at values under 255. 
[<font color="green">For better gameplay, its recommended values range from 0 - 30</font>]. 
Remember the lower the overall Attributes for any item with the Level Up numbers make for a more 
interesting and longer game. Ensure your game has lots of Quests, gambling, 
random functions to keep the gamer interested.<br /><br />
<center>
<table border="0" width="100%">
  <tr>
     <td align="center" colspan="5" bgcolor="#ffffff">Attribute Special Codes:</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td align="center">Attribute</td>
     <td align="center">Meaning</td>
     <td align="center">Example</td>
     <td align="center">Desc</td>
      <td align="center">Use</td>
  </tr>
  <tr bgcolor="#eeeeee">
     <td>maxhp</td>
     <td>Maximum Hit Points</td>
     <td>maxhp,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>maxhp,3</td>
  </tr>
  </tr>
  <tr bgcolor="#dddddd">
     <td>maxmp</td>
     <td>Maximum Magic Points</td>
     <td>maxmp,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>maxmp,3</td>
  </tr>
  </tr>
  <tr bgcolor="#eeeeee">
     <td>maxtp</td>
     <td>Maximum Travel Points</td>
     <td>maxtp,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>maxtp,3</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td>goldbonus</td>
     <td>Gold Bonus in %</td>
     <td>goldbonus,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>goldbonus,3</td>
  </tr>
  
 
   <tr bgcolor="#eeeeee">
     <td>expbonus</td>
     <td>Experience Bonus in %</td>
     <td>expbonus,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>expbonus,3</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td>strength</td>
     <td>Strength (Adds to attackpower)</td>
     <td>strength,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>strength,3</td>
  </tr>
  <tr bgcolor="#eeeeee">
     <td>dexterity</td>
     <td>Dexterity (Adds to defensepower)</td>
     <td>dexterity,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>dexterity,3</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td>attackpower</td>
     <td>Attack Power</td>
     <td>attackpower,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>attackpower,3</td>
  </tr>
   <tr bgcolor="#eeeeee">
     <td>defensepower</td>
     <td>Defense Power</td>
     <td>defensepower,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>defensepower,3</td>
  </tr></table></center><br />
END;
    
    if ($row["type"] == 1) { $row["type1select"] = "selected=\"selected\" "; } else { $row["type1select"] = ""; }
    if ($row["type"] == 2) { $row["type2select"] = "selected=\"selected\" "; } else { $row["type2select"] = ""; }
    if ($row["type"] == 3) { $row["type3select"] = "selected=\"selected\" "; } else { $row["type3select"] = ""; }
    if ($row["type"] == 4) { $row["type4select"] = "selected=\"selected\" "; } else { $row["type4select"] = ""; }
    if ($row["type"] == 5) { $row["type5select"] = "selected=\"selected\" "; } else { $row["type5select"] = ""; }
    if ($row["type"] == 6) { $row["type6select"] = "selected=\"selected\" "; } else { $row["type6select"] = ""; }
    if ($row["type"] == 7) { $row["type7select"] = "selected=\"selected\" "; } else { $row["type7select"] = ""; }
    if ($row["type"] == 8) { $row["type8select"] = "selected=\"selected\" "; } else { $row["type8select"] = ""; }
    if ($row["type"] == 9) { $row["type9select"] = "selected=\"selected\" "; } else { $row["type9select"] = ""; }
	
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Items");    
}





function adddrop() {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
		$type = 1;
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($name2 == "") { $errors++; $errorlist .= "Name2-Drop Attribute is required.<br />"; }
        if ($description == "") { $errors++; $errorlist .= "Description is required.<br />"; }
        if ($mlevel == "") { $errors++; $errorlist .= "Monster level is required.<br />"; }
        if (!is_numeric($mlevel)) { $errors++; $errorlist .= "Monster level must be a number.<br />"; }
        if ($type == "") { $errors++; $errorlist .= "Type is required.<br />1. maxhp, 2. maxmp, 3. maxtp, 4. goldbonus, 5. expbonus,<br />6. strength, 7. dexterity, 8. attackpower, 9. defensepower."; }
        if (!is_numeric($type)) { $errors++; $errorlist .= "Type must be number 1.<br />"; }
        if ($cost == "") { $errors++; $errorlist .= "Cost is required.<br />"; }
        if (!is_numeric($cost)) { $errors++; $errorlist .= "Cost must be a number.<br />"; }
        
		if ($attribute1 == "" || $attribute1 == " " || $attribute1 == "X") { $errors++; $errorlist .= "First attribute is required.<br />"; }
        if ($attribute2 == "" || $attribute2 == " ") { $attribute2 == "X"; }
        if ($attribute3 == "" || $attribute3 == " ") { $attribute3 == "X"; }
        
        if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET name='$name',name2='$name2',mlevel='$mlevel',type=1,attribute1='$attribute1',attribute2='$attribute2',attribute3='$attribute3',cost='$cost',description='$description'","drops");
            admindisplay("Drop Item created.","Add Drops");
        } else {
            admindisplay("<b>Errors:</b><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Add Drops");
        }        
        
    }   

$page = <<<END
<b><u>Add New Drop Item</u></b><br /><br />
<form action="admin.php?do=adddrop" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>

<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="30" value="" /></td></tr>

<tr><td width="20%">Attribute Desc:</td><td><input type="text" name="name2" size="30" maxlength="30" value="" /></td></tr>

<tr><td width="20%">Monster Level:</td><td><input type="text" name="mlevel" size="5" maxlength="10" value="" /><br /><span class="small">Minimum monster level that will drop this item.</span></td></tr>

<tr><td width="20%">Type:</td><td><input type="text" name="type" size="5" maxlength="1" value="" /><br /><span class="small">There are 3 types: 1, 2, and 3. Don't know what each number means yet.<br>Or there are 9 Types: 1. maxhp, 2. maxmp, 3. maxtp, 4. goldbonus, 5. expbonus,<br />6. strength, 7. dexterity, 8. attackpower, 9. defensepower. Insert the number <span class="highlight">1</span> in this block.</span></td></tr>

<tr><td width="20%">Attribute 1:</td><td><input type="text" name="attribute1" size="30" maxlength="50" value="" /><br /><span class="small">Must be a special code. First attribute cannot be disabled. Edit this field very carefully because mistakes to formatting or field names can create problems in the game.</span></td></tr>

<tr><td width="20%">Attribute 2:</td><td><input type="text" name="attribute2" size="30" maxlength="50" value="" /><br /><span class="small">Should be either a special code or <span class="highlight">X</span> to disable. Edit this field very carefully because mistakes to formatting or field names can create problems in the game.</span></td></tr>

<tr><td width="20%">Attribute 3:</td><td><input type="text" name="attribute3" size="30" maxlength="50" value="" /><br /><span class="small">Should be either a special code or <span class="highlight">X</span> to disable. Edit this field very carefully because mistakes to formatting or field names can create problems in the game.</span></td></tr>

<tr><td width="20%">Description:</td><td><input type="text" name="description" size="120" maxlength="360" value="" /><br /><span class="small">Description of item: Can be up to 360 Characters, but the shorter the better.</span></td></tr>

<tr><td width="20%">Cost:</td><td><input type="text" name="cost" size="12" maxlength="12" value="" /><br /><span class="small">Cost is the value for the item when sold at the Broker or Sell-Item-Shop. The cost price you insert will be divided by 2 for the Sell Price. Example enter 5000, the sell price will be 2500 Gold Coins.</span></td></tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form>
<blockquote><b>Special Codes:</b><br />
Special codes are used in the two attribute fields to give the item properties. The first attribute field must contain a special code, but the second one may be left empty ("X") if you wish. Special codes are in the format <span class="highlight">attribute,value</span>. <span class="highlight">Attribute</span> can be any database field from the Users table - however, it is suggested that you only use the ones from the list below, otherwise things can get freaky. <span class="highlight">Value</span> may be any positive or negative whole number. For example, if you want a item to give a player a additional 50 max hit points, the special code would be <span class="highlight">maxhp,50</span>.<br /><br />
Suggested user fields for special codes:<br />
1. maxhp - max hit points<br />
2. maxmp - max magic points<br />
3. maxtp - max travel points<br />
4. goldbonus - gold bonus, in percent<br />
5. expbonus - experience bonus, in percent<br />
6. strength - strength (which also adds to attackpower)<br />
7. dexterity - dexterity (which also adds to defensepower)<br />
8. attackpower - total attack power<br />
9. defensepower - total defense power</blockquote>
END;
    if ($row["type"] == 1) { $row["type1select"] = "selected=\"selected\" "; } else { $row["type1select"] = ""; }
    if ($row["type"] == 2) { $row["type2select"] = "selected=\"selected\" "; } else { $row["type2select"] = ""; }
    if ($row["type"] == 3) { $row["type3select"] = "selected=\"selected\" "; } else { $row["type3select"] = ""; }
    
   $page = parsetemplate($page, $row);
    admindisplay($page, "Add Drops");
    
}



function drops() {
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "drops");
    $page = "<u>Edit Drops</u><br />Click an item's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr>
		<td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td>
		<td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editdrop:".$row["id"]."\">".$row["name"]."</a></td>
		</tr>\n"; $count = 2; }
        else { $page .= "<tr>
		<td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td>
		<td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editdrop:".$row["id"]."\">".$row["name"]."</a></td>
		</tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No items found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Drops");
    
}

function editdrop($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($name2 == "") { $errors++; $errorlist .= "Name2-Drop Attribute is required.<br />"; }
        if ($description == "") { $errors++; $errorlist .= "Description is required.<br />"; }
        if ($mlevel == "") { $errors++; $errorlist .= "Monster level is required.<br />"; }
        if (!is_numeric($mlevel)) { $errors++; $errorlist .= "Monster level must be a number.<br />"; }
        if ($type == "") { $errors++; $errorlist .= "Type is required. 3 Types: 1, 2, or 3. Unknown what they are.<br>Or there are 9 Types: 1. maxhp, 2. maxmp, 3. maxtp, 4. goldbonus, 5. expbonus,<br />6. strength, 7. dexterity, 8. attackpower, 9. defensepower.<br />"; }
        if (!is_numeric($type)) { $errors++; $errorlist .= "Type must be number 1.<br />"; }
        if ($cost == "") { $errors++; $errorlist .= "Cost is required.<br />"; }
        if (!is_numeric($cost)) { $errors++; $errorlist .= "Cost must be a number.<br />"; }
        
		if ($attribute1 == "" || $attribute1 == " " || $attribute1 == "X") { $errors++; $errorlist .= "First attribute is required.<br />"; }
        if ($attribute2 == "" || $attribute2 == " ") { $attribute2 == "X"; }
        if ($attribute3 == "" || $attribute3 == " ") { $attribute3 == "X"; }
        
        if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET name='$name',name2='$name2',mlevel='$mlevel',type=1,attribute1='$attribute1',attribute2='$attribute2',attribute3='$attribute3',cost='$cost',description='$description'","drops");
            admindisplay("Item updated.","Edit Drops");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div>
			<br />Please go back and try again.", "Edit Drops");
        }  
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "drops");
    $row = mysql_fetch_array($query);

$page = <<<END
<u>Edit Drops</u><br /><br />


<form action="admin.php?do=editdrop:$id" method="post">
<table width="90%">
<tr><td width="20%"><img src="images/drops/{{name}}.png" alt="drops" width="86" height="66"></td>
<td><br />Drop images can be any Height & Width.
<br />As long as they are Less than 120H x 120W px.
<br />86 in Width and 66 in Height, work best.</td></tr>

<tr><td width="5%">ID:</td><td>{{id}}</td></tr>

<tr><td width="17%">Name:</td><td><input type="text" name="name" size="40" maxlength="40" value="{{name}}" /></td></tr>

<tr><td width="17%">Name2-Attribute Desc:</td><td><input type="text" name="name2" size="40" maxlength="40" value="{{name2}}" /></td></tr>

<tr><td width="10%">Monster Level:</td><td><input type="text" name="mlevel" size="5" maxlength="5" value="{{mlevel}}" />
<br /><span class="small">Minimum monster level that will drop this item.</span></td></tr>

<tr><td width="20%">Type:</td><td><input type="text" name="type" size="5" maxlength="1" value="{{type}}" /><br /><span class="small">There are 3 types: 1, 2, and 3. Don't know what each number means yet.<br>Or there are 9 Types: 1. maxhp, 2. maxmp, 3. maxtp, 4. goldbonus, 5. expbonus,<br />6. strength, 7. dexterity, 8. attackpower, 9. defensepower. <br>Insert the number <span class="highlight">1</span> in this block.<br>Or there are 9 types: </span></td></tr>

<tr><td width="17%">Attribute 1:</td><td><input type="text" name="attribute1" size="30" maxlength="30" value="{{attribute1}}" />
<br /><span class="small">Must be a special code. First attribute cannot be disabled. Edit this field very carefully because mistakes to formatting 
or field names can create problems in the game.</span><font color="#C8003C">Can not be left blank, enter X or Special Code.</font></span></td></tr>

<tr><td width="17%">Attribute 2:</td><td><input type="text" name="attribute2" size="30" maxlength="30" value="{{attribute2}}" />
<br /><span class="small">Should be either a special code or <span class="highlight">X</span> to disable. Edit this field very carefully because 
mistakes to formatting or field names can create problems</font> in the game. <font color="#C8003C">Can not be left blank, enter X or Special Code.</font></span></td></tr>

<tr><td width="17%">Attribute 3:</td><td><input type="text" name="attribute3" size="30" maxlength="30" value="{{attribute3}}" />
<br /><span class="small">Should be either a special code or <span class="highlight">X</span> to disable. Edit this field very carefully because 
mistakes to formatting or field names can create problems</font> in the game.<font color="#C8003C">Can not be left blank, enter X or Special Code.</font></span></td></tr>

<tr><td width="20%">Description:</td><td><input type="text" name="description" size="120" maxlength="360" value="{{description}}" /><br /><span class="small">Description of item: Can be up to 360 Characters, but the shorter the better.</span></td></tr>

<tr><td width="20%">Cost:</td><td><input type="text" name="cost" size="12" maxlength="12" value="{{cost}}" /><br /><span class="small">Cost is the value for the item when sold at the Broker or Sell-Item-Shop. The cost price you insert will be divided by 2 for the Sell Price. Example enter 5000, the sell price will be 2500 Gold Coins.</span></td></tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form><br />
<blockquote><b>Special Codes:</b><br />
<span class="small">Special codes are used in the two attribute fields to give the item properties. 
The first attribute field must contain a special code, but the second one may be left empty ("X") if you wish. 
Special codes are in the format <span class="highlight">attribute,value</span>. 
<span class="highlight">Attribute</span> can be any database field from the Users table - 
however, it is suggested that you only use the ones from the list below, otherwise things can get freaky. 
<span class="highlight">Value</span> may be any positive or negative whole number. For example, 
if you want a item to give a player a additional 50 max hit points, the special code would be <span class="highlight">maxhp,50</span>.</span></blockquote><br /><br />

<br /><center>
<table border="0" width="100%">
  <tr>
     <td align="center" colspan="5" bgcolor="#ffffff">Attribute Special Codes:</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td align="center">Attribute</td>
     <td align="center">Meaning</td>
     <td align="center">Example</td>
     <td align="center">Desc</td>
      <td align="center">Use</td>
  </tr>
  <tr bgcolor="#eeeeee">
     <td>maxhp</td>
     <td>Maximum Hit Points</td>
     <td>maxhp,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>maxhp,3</td>
  </tr>
  </tr>
  <tr bgcolor="#dddddd">
     <td>maxmp</td>
     <td>Maximum Magic Points</td>
     <td>maxmp,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>maxmp,3</td>
  </tr>
  </tr>
  <tr bgcolor="#eeeeee">
     <td>maxtp</td>
     <td>Maximum Travel Points</td>
     <td>maxtp,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>maxtp,3</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td>goldbonus</td>
     <td>Gold Bonus in %</td>
     <td>goldbonus,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>goldbonus,3</td>
  </tr>
   <tr bgcolor="#eeeeee">
     <td>expbonus</td>
     <td>Experience Bonus in %</td>
     <td>expbonus,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>expbonus,3</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td>strength</td>
     <td>Strength (Adds to attackpower)</td>
     <td>strength,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>strength,3</td>
  </tr>
  <tr bgcolor="#eeeeee">
     <td>dexterity</td>
     <td>Dexterity (Adds to defensepower)</td>
     <td>dexterity,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>dexterity,3</td>
  </tr>
  <tr bgcolor="#ddddd">
     <td>attackpower</td>
     <td>Attack Power</td>
     <td>attackpower,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>attackpower,3</td>
  </tr>
   <tr bgcolor="#eeeeee">
     <td>defensepower</td>
     <td>Defense Power</td>
     <td>defensepower,X</td>
     <td>X = a Number from 0 to 50</td>
     <td>defensepower,3</td>
  </tr></table></center><br />
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Drops");
    
}


function addtown() {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
        if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be a number.<br />"; }
        if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
        if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be a number.<br />"; }
        if ($innprice == "") { $errors++; $errorlist .= "Inn Price is required.<br />"; }
        if (!is_numeric($innprice)) { $errors++; $errorlist .= "Inn Price must be a number.<br />"; }
        if ($mapprice == "") { $errors++; $errorlist .= "Map Price is required.<br />"; }
        if (!is_numeric($mapprice)) { $errors++; $errorlist .= "Map Price must be a number.<br />"; }

        if ($travelpoints == "") { $errors++; $errorlist .= "Travel Points is required.<br />"; }
        if (!is_numeric($travelpoints)) { $errors++; $errorlist .= "Travel Points must be a number.<br />"; }
        if ($itemslist == "") { $errors++; $errorlist .= "Items List is required.<br />"; }
        
        if ($errors == 0) { 
		$query = doquery("INSERT INTO {{table}} SET id='',name='$name',latitude='$latitude',longitude='$longitude',innprice='$innprice',mapprice='$mapprice',travelpoints='$travelpoints',itemslist='$itemslist'", "towns");
            admindisplay("Town created.","Edit Towns");
        } else {
            admindisplay("<b>Errors:</b><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Create Towns");
        }        
        
    }   
    
$page = <<<END
<b><u>Create Towns</u></b><br /><br />
<form action="admin.php?do=addtown" method="post">
Type your post below and then click Submit to add it.<br />

<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="30" value="" /></td></tr>

<tr><td width="20%">Latitude:</td><td><input type="text" name="latitude" size="5" maxlength="10" value="" /><br /><span class="small">Positive or negative integer. Neg [-] is SOUTH on the Map. Positive [+] is NORTH.  [No need to Enter + sign].</span></td></tr>

<tr><td width="20%">Longitude:</td><td><input type="text" name="longitude" size="5" maxlength="10" value="" /><br /><span class="small">Positive or negative integer. Neg [-] is WEST on the Map. Positive [+] is EAST. [No need to Enter + sign].</span></td></tr>

<tr><td width="20%">Inn Price:</td><td><input type="text" name="innprice" size="5" maxlength="10" value="" /><br /><span class="small">Gold Coins. How much it costs to restore all player stats.</span></td></tr>

<tr><td width="20%">Hidden town:</td><td><input type="text" name="hidden" size="5" maxlength="1" value="" />
<br /><span class="small">When hidden is set to 1 on a town, the town will not show up in map shop.
<br>If set to 0 the town is unhidden [The default setting].
<br />If You select to have hidden town, You still can input the price for a map of a town, 
<br />if You later decide to make it available for Purchase.
<br />Remember when a Town is set to Hidden, the price will be ignored
<br />and player will not be able to buy a Hidden Town Map. <font color="green">These Towns can only be found by exploring
<br />the Full Map in the Game. Or in Some games by an Game Event or Game Quest.</font></span></td></tr>

<tr><td width="20%">Map Price:</td><td><input type="text" name="mapprice" size="5" maxlength="10" value="" /><br /><span class="small">Gold Coins. How much it costs to buy the map to this town.</span></td></tr>

<tr><td width="20%">Travel Points:</td><td><input type="text" name="travelpoints" size="5" maxlength="10" value="" /><br /><span class="small">How many TP are consumed when traveling to this town.</span></td></tr>


<tr><td width="20%">Items List Primary Weapons:</td><td><input type="text" name="itemslist" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town. 
<br />(WEAPONS ITEMS ARE ASSIGNED NUMBERS 1-300.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).
<br /><span class="highlight">
<br />1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,21,22,23,24,25,
<br />26,27,28,29,30,31,32,33,34,35,36,40,41,42,43,44,45,46,47,48,49,50,
<br />51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75, 
<br />76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100
<br />101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,
<br />126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,
<br />151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,
<br />176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,
<br />201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,
<br />226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,
<br />251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,
<br />276,277,278,279,280,281,282,283,284,285,286,287,288,289,290,291,292,293,294,295,296,297,298,299,300
<br /><br />
</span></span>
</td></tr>

<tr><td width="20%">Items List 2 - Shields:</td><td><input type="text" name="itemslist2" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(SHIELD ITEMS ARE ASSIGNED NUMBERS 301-700.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,
<br />326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,
<br />351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375,
<br />376,377,378,379,380,381,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,
<br />401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,
<br />426,427,428,429,430,431,432,433,434,435,436,437,438,439,440,441,442,443,444,445,446,447,448,449,450,
<br />451,452,453,454,455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,470,471,472,473,474,475,
<br />476,477,478,479,480,481,482,483,484,485,486,487,488,489,490,491,492,493,494,495,496,497,498,499,500,
<br />501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,
<br />526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,549,550,
<br />551,552,553,554,555,556,557,558,559,560,561,562,563,564,565,566,567,568,569,570,571,572,573,574,575,
<br />576,577,578,579,580,581,582,583,584,585,586,587,588,589,590,591,592,593,594,595,596,597,598,599,600,
<br />601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,619,620,621,622,623,624,625,
<br />626,627,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,650,
<br />651,652,653,654,655,656,657,658,659,660,661,662,663,664,665,666,667,668,669,670,671,672,673,674,675,
<br />676,677,678,679,680,681,682,683,684,685,686,687,688,689,690,691,692,693,694,695,696,697,698,699,700,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 3 - Armor:</td><td><input type="text" name="itemslist3" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(ARMOR ITEMS ARE ASSIGNED NUMBERS 701-836. 837-900 ARE RESERVED. ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />701,702,703,704,705,706,707,708,709,710,711,712,713,714,715,716,717,718,719,720,721,722,723,724,725,
<br />726,727,728,729,730,731,732,733,734,735,736,737,738,739,740,741,742,743,744,745,746,747,748,749,750,
<br />751,752,753,754,755,756,757,758,759,760,761,762,763,764,765,766,767,768,769,770,771,772,773,774,775,
<br />776,777,778,779,780,781,782,783,784,785,786,787,788,789,790,791,792,793,794,795,796,797,798,799,800
<br />801,802,803,804,805,806,807,808,809,810,811,812,813,814,815,816,817,818,819,820,821,822,823,824,825,
<br />826,827,828,829,830,831,832,833,834,835,836,
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;A R M O R&nbsp;&nbsp;U S E</font>
<br />837,838,839,840,841,842,843,844,845,846,847,848,849,850,
<br />851,852,853,854,855,856,857,858,859,860,861,862,863,864,865,866,867,868,869,870,871,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 4 - Pets:</td><td><input type="text" name="itemslist4" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(PET ITEMS ARE ASSIGNED NUMBERS 872-1000.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />872,873,874,875,
<br />876,877,878,879,880,881,882,883,884,885,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,
<br />901,902,903,904,905,906,907,908,909,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,
<br />926,927,928,929,930,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,
<br />951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,975,
<br />976,977,978,979,980,981,982,983,984,985,986,987,988,989,990,991,992,993,994,995,996,997,998,999,1000,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 5 - Helmet:</td><td><input type="text" name="itemslist5" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(HELMET ITEMS ARE ASSIGNED NUMBERS 1001-1100.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,
<br />1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,
<br />1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,
<br />1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,
<br />1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;H E L M E T&nbsp;&nbsp;U S E</font>
<br />1101,1102,1103,1104,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,1117,1118,1119,1120,
<br />1121,1122,1123,1124,1125,1126,1127,1128,1129,1130,1131,1132,1133,1134,1135,1136,1137,1138,1139,1140,
<br />1141,1142,1143,1144,1145,1146,1147,1148,1149,1150,1151,1152,1153,1154,1155,1156,1157,1158,1159,1160,
<br />1161,1162,1163,1164,1165,1166,1167,1168,1169,1170,1171,1172,1173,1174,1175,1176,1177,1178,1179,1180,
<br />1181,1182,1183,1184,1185,1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,1199,1200,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 6 - Gauntlets:</td><td><input type="text" name="itemslist6" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(GAUNTLET ITEMS ARE ASSIGNED NUMBERS 1201-1305.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,
<br />1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236,1237,1238,1239,1240,
<br />1241,1242,1243,1244,1245,1246,1247,1248,1249,1250,1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,
<br />1261,1262,1263,1264,1265,1266,1267,1268,1269,1270,1271,1272,1273,1274,1275,1276,1277,1278,1279,1280,
<br />1281,1282,1283,1284,1285,1286,1287,1288,1289,1290,1291,1292,1293,1294,1295,1296,1297,1298,1299,1300,
<br />1301,1302,1303,1304,1305,
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;G A U N T L E T&nbsp;&nbsp;U S E</font>
<br />1306,1307,1308,1309,1310,1311,1312,1313,1314,1315,1316,1317,1318,1319,1320,
<br />1321,1322,1323,1324,1325,1326,1327,1328,1329,1330,1331,1332,1333,1334,1335,1336,1337,1338,1339,1340,
<br />1341,1342,1343,1344,1345,1346,1347,1348,1349,1350,1351,1352,1353,1354,1355,1356,1357,1358,1359,1360,
<br />1361,1362,1363,1364,1365,1366,1367,1368,1369,1370,1371,1372,1373,1374,1375,1376,1377,1378,1379,1380,
<br />1381,1382,1383,1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 7 - Boots:</td><td><input type="text" name="itemslist7" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(BOOTS ITEMS ARE ASSIGNED NUMBERS 1401-1446.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1401,1402,1403,1404,1405,1406,1407,1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,
<br />1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,1432,1433,1434,1435,1436,1437,1438,1439,1440,
<br />1441,1442,1443,1444,1445,1446
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 8 - Range Weapons:</td><td><input type="text" name="itemslist8" size="120" maxlength="4000" value="{{itemslist8}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(RANGE WEAPON ITEMS ARE ASSIGNED NUMBERS 1447-1480. ONLY USE THESE ITEMS <br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1447,1448,1449,1450,1451,1452,1453,1454,1455,1456,1457,1458,1459,1460,1461,1462,1463,1464,
<br />1465,1466,1467,1468,1469,1470,1471,1472,1473,1474,1475,1476,1477,1478,1479,1480
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;R A N G E&nbsp;W E A P O N S&nbsp;&nbsp;U S E</font>
<br />,1481,1482,1483,1484,1485,1486,1487,1488,1489,1490,1491,1492,1493,1494,1495,1496,1497,1498,1499,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 9 - Magic Rings & Things:</td><td><input type="text" name="itemslist9" size="120" maxlength="4000" value="" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(MAGIC RINGS ITEMS ARE ASSIGNED NUMBERS 1500-1720. ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,1515,1516,1517,1518,1519,1520,
<br />1521,1522,1523,1524,1525,1526,1527,1528,1529,1530,1531,1532,1533,1534,1535,1536,1537,1538,1539,1540,
<br /></span></span></td></tr>

<tr><td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;</td><td><span class="highlight">
<br /><font color="#0000FF">1501 - 1720 SLOTS RESERVED:</font>&nbsp;&nbsp;&nbsp;<font color="green">A L L&nbsp;&nbsp I T E M&nbsp;&nbsp9&nbsp;&nbsp-&nbsp;&nbspM A G I C&nbsp;&nbspS L O T &nbsp;&nbspN U M B E R S</font>
<span class="small"
<br />1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,1515,1516,1517,1518,1519,1520,
<br />1521,1522,1523,1524,1525,1526,1527,1528,1529,1530,1531,1532,1533,1534,1535,1536,1537,1538,1539,1540,
<br/>1541,1542,1543,1544,1545,1546,1547,1548,1549,1550,1551,1552,1553,1554,1555,1556,1557,1558,1559,1560,
<br />1561,1562,1563,1564,1565,1566,1567,1568,1569,1570,1571,1572,1573,1574,1575,1576,1577,1578,1579,1580,
<br />1581,1582,1583,1584,1585,1586,1587,1588,1589,1590,1591,1592,1593,1594,1595,1596,1597,1598,1599,1600,
<br />1601,1602,1603,1604,1605,1606,1607,1608,1609,1610,1611,1612,1613,1614,1615,1616,1617,1618,1619,1620,
<br />1621,1622,1623,1624,1625,1626,1627,1628,1629,1630,1631,1632,1633,1634,1635,1636,1637,1638,1639,1640,
<br />1641,1642,1643,1644,1645,1646,1647,1648,1649,1650,1651,1652,1653,1654,1655,1656,1657,1658,1659,1660,
<br />1661,1662,1663,1664,1665,1666,1667,1668,1669,1670,1671,1672,1673,1674,1675,1676,1677,1678,1679,1680,
<br />1681,1682,1683,1684,1685,1686,1687,1688,1689,1690,1691,1692,1693,1694,1695,1696,1697,1698,1699,1700,
<br />1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,1711,1712,1713,1714,1715,1716,1717,1718,1719,1720,
<br /></span></span></span></td></tr>

<tr><td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;</td><td><span class="highlight">
<br /><font color="#0000FF">1721 - 1900 SLOTS RESERVED:</font>&nbsp;&nbsp;&nbsp;<font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;U S E</font>
<span class="small"
<br />1721,1722,1723,1724,1725,1726,1727,1728,1729,1730,1731,1732,1733,1734,1735,1736,1737,1738,1739,1740,
<br />1741,1742,1743,1744,1745,1746,1747,1748,1749,1750,1751,1752,1753,1754,1755,1756,1757,1758,1759,1760,
<br />1761,1762,1763,1764,1765,1766,1767,1768,1769,1770,1771,1772,1773,1774,1775,1776,1777,1778,1779,1780,
<br />1781,1782,1783,1784,1785,1786,1787,1788,1789,1790,1791,1792,1793,1794,1795,1796,1797,1798,1799,1800,
<br />1801,1802,1803,1804,1805,1806,1807,1808,1809,1810,1811,1812,1813,1814,1815,1816,1817,1818,1819,1820,
<br />1821,1822,1823,1824,1825,1826,1827,1828,1829,1830,1831,1832,1833,1834,1835,1836,1837,1838,1839,1840,
<br />1841,1842,1843,1844,1845,1846,1847,1848,1849,1850,1851,1852,1853,1854,1855,1856,1857,1858,1859,1860,
<br />1861,1862,1863,1864,1865,1866,1867,1868,1869,1870,1871,1872,1873,1874,1875,1876,1877,1878,1879,1880,
<br />1881,1882,1883,1884,1885,1886,1887,1888,1889,1890,1891,1892,1893,1894,1895,1896,1897,1898,1899,1900
<br /></span></span></span></td></tr>

</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form>
END;
 
//    $page = parsetemplate($page, $row);
    admindisplay($page, "Create New Town");
    
}

function towns() {
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "towns");
    $page = "<b><u>Edit Towns</u></b><br />Click an town's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=edittown:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=edittown:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No towns found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Towns");
    
}



function edittown($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
        if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be a number.<br />"; }
        if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
        if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be a number.<br />"; }
        if ($innprice == "") { $errors++; $errorlist .= "Inn Price is required.<br />"; }
        if (!is_numeric($innprice)) { $errors++; $errorlist .= "Inn Price must be a number.<br />"; }
        if ($mapprice == "") { $errors++; $errorlist .= "Map Price is required.<br />"; }
        if (!is_numeric($mapprice)) { $errors++; $errorlist .= "Map Price must be a number.<br />"; }
        if ($travelpoints == "") { $errors++; $errorlist .= "Travel Points is required.<br />"; }
        if (!is_numeric($travelpoints)) { $errors++; $errorlist .= "Travel Points must be a number.<br />"; }
			
		if ($itemslist == "") { $errors++; $errorlist .= "Weapons Items List is required.<br />"; }
		if ($itemslist2 == "") { $errors++; $errorlist .= "Shields Items List 2 is required.<br />"; }
if ($itemslist3 == "") { $errors++; $errorlist .= "Armor Items List 3 is required.<br />"; }
if ($itemslist4 == "") { $errors++; $errorlist .= "Pets Items List 4 is required.<br />"; }
if ($itemslist5 == "") { $errors++; $errorlist .= "Helmet List 5 is required.<br />"; }
if ($itemslist6 == "") { $errors++; $errorlist .= "Gauntlets Items List 6 is required.<br />"; }
if ($itemslist7 == "") { $errors++; $errorlist .= "Boots Items List 7 is required.<br />"; }
if ($itemslist8 == "") { $errors++; $errorlist .= "Range Weapons Items List 8 is required.<br />"; }
if ($itemslist9 == "") { $errors++; $errorlist .= "Magic Rings Items List 9 is required.<br />"; }		
		
        if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET  name='$name',latitude='$latitude',longitude='$longitude',innprice='$innprice',mapprice='$mapprice',hidden='$hidden',travelpoints='$travelpoints',itemslist='$itemslist',itemslist2='$itemslist2',itemslist3='$itemslist3',itemslist4='$itemslist4',itemslist5='$itemslist5',itemslist6='$itemslist6',itemslist7='$itemslist7',itemslist8='$itemslist8', itemslist9='$itemslist9' WHERE id='$id' LIMIT 1", "towns");

            admindisplay("Town updated.","Edit Towns");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Towns");
        }  
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "towns");
    $row = mysql_fetch_array($query);

$page = <<<END
Edit Towns<br /><br />
<form action="admin.php?do=edittown:$id" method="post">
<table width="98%">

<tr><td width="20%">ID:</td><td>{{id}}</td></tr>

<tr><td width="20%">Name:</td><td><input type="text" name="name" size="50" maxlength="50" value="{{name}}" /></td></tr>

<tr><td width="20%">Latitude:</td><td><input type="text" name="latitude" size="5" maxlength="10" value="{{latitude}}" />
<br /><span class="small">Positive or negative integer.<br />Neg [-] is SOUTH on the Map.<br />Positive [+] is NORTH. [No need to Enter + sign}.</span></td></tr>

<tr><td width="20%">Longitude:</td><td><input type="text" name="longitude" size="5" maxlength="10" value="{{longitude}}" />
<br /><span class="small">Positive or negative integer.<br />Neg [-] is WEST on the Map.<br />Positive [+] is EAST. [No need to Enter + sign}.</span></td></tr>

<tr><td width="20%">Inn Price:</td><td><input type="text" name="innprice" size="5" maxlength="10" value="{{innprice}}" /><br /><span class="small">Gold Coins. How much it costs to restore all player stats.</td></tr>

<tr><td width="20%">Hidden town:</td><td><input type="text" name="hidden" size="5" maxlength="1" value="{{hidden}}" />
<br /><span class="small">When hidden is set to 1 on a town, the town will not show up in map shop.
<br>If set to 0 the town is unhidden [The default setting].
<br />If You select to have hidden town, You still can input the price for a map of a town, 
<br />if You later decide to make it available for Purchase.
<br />Remember when a Town is set to Hidden, the price will be ignored
<br />and player will not be able to buy a Hidden Town Map. <font color="green">These Towns can only be found by exploring
<br />the Full Map in the Game. Or in Some games by an Game Event or Game Quest.</font></span></td></tr>

<tr><td width="20%">Map Price:</td><td><input type="text" name="mapprice" size="5" maxlength="10" value="{{mapprice}}" /><br /><span class="small">Gold Coins. How much it costs to buy this Town Map to make it Visible to you.</span></td></tr>

<tr><td width="20%">Travel Points:</td><td><input type="text" name="travelpoints" size="5" maxlength="10" value="{{travelpoints}}" />
<br /><span class="small">How many TP are consumed when traveling to this town.</span></td></tr>

<tr><td width="20%"><br /><br />Items List - Primary Weapon:</td>
<td><input type="text" name="itemslist" size="120" maxlength="4000" value="{{itemslist}}" />
<br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.
<br />(WEAPONS ITEMS ARE ASSIGNED NUMBERS 1-300.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).
<br /><span class="highlight">
<br />1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,21,22,23,24,25,
<br />26,27,28,29,30,31,32,33,34,35,36,40,41,42,43,44,45,46,47,48,49,50,
<br />51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75, 
<br />76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100
<br />101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,
<br />126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,
<br />151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,
<br />176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,
<br />201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,
<br />226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,
<br />251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,
<br />276,277,278,279,280,281,282,283,284,285,286,287,288,289,290,291,292,293,294,295,296,297,298,299,300
<br /><br />
</span></span>
</td></tr>

<tr><td width="20%">Items List 2 - Shields:</td><td><input type="text" name="itemslist2" size="120" maxlength="4000" value="{{itemslist2}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(SHIELD ITEMS ARE ASSIGNED NUMBERS 301-700.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,
<br />326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,
<br />351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375,
<br />376,377,378,379,380,381,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,
<br />401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,
<br />426,427,428,429,430,431,432,433,434,435,436,437,438,439,440,441,442,443,444,445,446,447,448,449,450,
<br />451,452,453,454,455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,470,471,472,473,474,475,
<br />476,477,478,479,480,481,482,483,484,485,486,487,488,489,490,491,492,493,494,495,496,497,498,499,500,
<br />501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,
<br />526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,549,550,
<br />551,552,553,554,555,556,557,558,559,560,561,562,563,564,565,566,567,568,569,570,571,572,573,574,575,
<br />576,577,578,579,580,581,582,583,584,585,586,587,588,589,590,591,592,593,594,595,596,597,598,599,600,
<br />601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,619,620,621,622,623,624,625,
<br />626,627,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,650,
<br />651,652,653,654,655,656,657,658,659,660,661,662,663,664,665,666,667,668,669,670,671,672,673,674,675,
<br />676,677,678,679,680,681,682,683,684,685,686,687,688,689,690,691,692,693,694,695,696,697,698,699,700,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 3 - Armor:</td><td><input type="text" name="itemslist3" size="120" maxlength="4000" value="{{itemslist3}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(ARMOR ITEMS ARE ASSIGNED NUMBERS 701-836. 837-900 ARE RESERVED. ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />701,702,703,704,705,706,707,708,709,710,711,712,713,714,715,716,717,718,719,720,721,722,723,724,725,
<br />726,727,728,729,730,731,732,733,734,735,736,737,738,739,740,741,742,743,744,745,746,747,748,749,750,
<br />751,752,753,754,755,756,757,758,759,760,761,762,763,764,765,766,767,768,769,770,771,772,773,774,775,
<br />776,777,778,779,780,781,782,783,784,785,786,787,788,789,790,791,792,793,794,795,796,797,798,799,800
<br />801,802,803,804,805,806,807,808,809,810,811,812,813,814,815,816,817,818,819,820,821,822,823,824,825,
<br />826,827,828,829,830,831,832,833,834,835,836,
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;A R M O R&nbsp;&nbsp;U S E</font>
<br />837,838,839,840,841,842,843,844,845,846,847,848,849,850,
<br />851,852,853,854,855,856,857,858,859,860,861,862,863,864,865,866,867,868,869,870,871,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 4 - Pets:</td><td><input type="text" name="itemslist4" size="120" maxlength="4000" value="{{itemslist4}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(PET ITEMS ARE ASSIGNED NUMBERS 872-1000.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />872,873,874,875,
<br />876,877,878,879,880,881,882,883,884,885,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,
<br />901,902,903,904,905,906,907,908,909,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,
<br />926,927,928,929,930,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,948,949,950,
<br />951,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,975,
<br />976,977,978,979,980,981,982,983,984,985,986,987,988,989,990,991,992,993,994,995,996,997,998,999,1000,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 5 - Helmet:</td><td><input type="text" name="itemslist5" size="120" maxlength="4000" value="{{itemslist5}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(HELMET ITEMS ARE ASSIGNED NUMBERS 1001-1100.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br /><span class="highlight">
<br />1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,
<br />1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,
<br />1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,
<br />1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,
<br />1081,1082,1083,1084,1085,1086,1087,1088,1089,1090,1091,1092,1093,1094,1095,1096,1097,1098,1099,1100,
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;H E L M E T&nbsp;&nbsp;U S E</font>
<br />1101,1102,1103,1104,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,1117,1118,1119,1120,
<br />1121,1122,1123,1124,1125,1126,1127,1128,1129,1130,1131,1132,1133,1134,1135,1136,1137,1138,1139,1140,
<br />1141,1142,1143,1144,1145,1146,1147,1148,1149,1150,1151,1152,1153,1154,1155,1156,1157,1158,1159,1160,
<br />1161,1162,1163,1164,1165,1166,1167,1168,1169,1170,1171,1172,1173,1174,1175,1176,1177,1178,1179,1180,
<br />1181,1182,1183,1184,1185,1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,1199,1200,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 6 - Gauntlets:</td><td><input type="text" name="itemslist6" size="120" maxlength="4000" value="{{itemslist6}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(GAUNTLET ITEMS ARE ASSIGNED NUMBERS 1201-1305.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1201,1202,1203,1204,1205,1206,1207,1208,1209,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,
<br />1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,1235,1236,1237,1238,1239,1240,
<br />1241,1242,1243,1244,1245,1246,1247,1248,1249,1250,1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,
<br />1261,1262,1263,1264,1265,1266,1267,1268,1269,1270,1271,1272,1273,1274,1275,1276,1277,1278,1279,1280,
<br />1281,1282,1283,1284,1285,1286,1287,1288,1289,1290,1291,1292,1293,1294,1295,1296,1297,1298,1299,1300,
<br />1301,1302,1303,1304,1305,
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;G A U N T L E T&nbsp;&nbsp;U S E</font>
<br />1306,1307,1308,1309,1310,1311,1312,1313,1314,1315,1316,1317,1318,1319,1320,
<br />1321,1322,1323,1324,1325,1326,1327,1328,1329,1330,1331,1332,1333,1334,1335,1336,1337,1338,1339,1340,
<br />1341,1342,1343,1344,1345,1346,1347,1348,1349,1350,1351,1352,1353,1354,1355,1356,1357,1358,1359,1360,
<br />1361,1362,1363,1364,1365,1366,1367,1368,1369,1370,1371,1372,1373,1374,1375,1376,1377,1378,1379,1380,
<br />1381,1382,1383,1384,1385,1386,1387,1388,1389,1390,1391,1392,1393,1394,1395,1396,1397,1398,1399,1400,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 7 - Boots:</td><td><input type="text" name="itemslist7" size="120" maxlength="4000" value="{{itemslist7}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(BOOTS ITEMS ARE ASSIGNED NUMBERS 1401-1446.  ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1401,1402,1403,1404,1405,1406,1407,1408,1409,1410,1411,1412,1413,1414,1415,1416,1417,1418,1419,1420,
<br />1421,1422,1423,1424,1425,1426,1427,1428,1429,1430,1431,1432,1433,1434,1435,1436,1437,1438,1439,1440,
<br />1441,1442,1443,1444,1445,1446
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 8 - Range Weapons:</td><td><input type="text" name="itemslist8" size="120" maxlength="4000" value="{{itemslist8}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(RANGE WEAPON ITEMS ARE ASSIGNED NUMBERS 1447-1480. ONLY USE THESE ITEMS <br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1447,1448,1449,1450,1451,1452,1453,1454,1455,1456,1457,1458,1459,1460,1461,1462,1463,1464,
<br />1465,1466,1467,1468,1469,1470,1471,1472,1473,1474,1475,1476,1477,1478,1479,1480
<br /><font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;R A N G E&nbsp;W E A P O N S&nbsp;&nbsp;U S E</font>
<br />,1481,1482,1483,1484,1485,1486,1487,1488,1489,1490,1491,1492,1493,1494,1495,1496,1497,1498,1499,
<br /><br /></span></span></td></tr>

<tr><td width="20%">Items List 9 - Rings & Things:</td><td><input type="text" name="itemslist9" size="120" maxlength="4000" value="{{itemslist9}}" /><br /><span class="small">Comma-separated list of item ID numbers available for purchase at this town.<br />(MAGIC RINGS ITEMS ARE ASSIGNED NUMBERS 1500-1720. ONLY USE THESE ITEM NUMBERS<br />TO KEEP LIKE ITEMS IN THE SAME SHOP).<br />
<span class="highlight">
<br />1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,1515,1516,1517,1518,1519,1520,
<br />1521,1522,1523,1524,1525,1526,1527,1528,1529,1530,1531,1532,1533,1534,1535,1536,1537,1538,1539,1540,
<br /></span></span></td></tr>

<tr><td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;</td><td><span class="highlight">
<br /><font color="#0000FF">1501 - 1720 SLOTS RESERVED:</font>&nbsp;&nbsp;&nbsp;<font color="green">A L L&nbsp;&nbsp I T E M&nbsp;&nbsp9&nbsp;&nbsp-&nbsp;&nbspM A G I C&nbsp;&nbspS L O T &nbsp;&nbspN U M B E R S</font>
<span class="small">
<br />1501,1502,1503,1504,1505,1506,1507,1508,1509,1510,1511,1512,1513,1514,1515,1516,1517,1518,1519,1520,
<br />1521,1522,1523,1524,1525,1526,1527,1528,1529,1530,1531,1532,1533,1534,1535,1536,1537,1538,1539,1540,
<br/>1541,1542,1543,1544,1545,1546,1547,1548,1549,1550,1551,1552,1553,1554,1555,1556,1557,1558,1559,1560,
<br />1561,1562,1563,1564,1565,1566,1567,1568,1569,1570,1571,1572,1573,1574,1575,1576,1577,1578,1579,1580,
<br />1581,1582,1583,1584,1585,1586,1587,1588,1589,1590,1591,1592,1593,1594,1595,1596,1597,1598,1599,1600,
<br />1601,1602,1603,1604,1605,1606,1607,1608,1609,1610,1611,1612,1613,1614,1615,1616,1617,1618,1619,1620,
<br />1621,1622,1623,1624,1625,1626,1627,1628,1629,1630,1631,1632,1633,1634,1635,1636,1637,1638,1639,1640,
<br />1641,1642,1643,1644,1645,1646,1647,1648,1649,1650,1651,1652,1653,1654,1655,1656,1657,1658,1659,1660,
<br />1661,1662,1663,1664,1665,1666,1667,1668,1669,1670,1671,1672,1673,1674,1675,1676,1677,1678,1679,1680,
<br />1681,1682,1683,1684,1685,1686,1687,1688,1689,1690,1691,1692,1693,1694,1695,1696,1697,1698,1699,1700,
<br />1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,1711,1712,1713,1714,1715,1716,1717,1718,1719,1720,
<br /></span></span></span></td></tr>

<tr><td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;</td><td><span class="highlight">
<br /><font color="#0000FF">1721 - 1900 SLOTS RESERVED:</font>&nbsp;&nbsp;&nbsp;<font color="green">E X T R A&nbsp;&nbsp;S L O T S&nbsp;&nbsp;F O R&nbsp;&nbsp;F U T U R E&nbsp;&nbsp;U S E</font>
<span class="small">
<br />1721,1722,1723,1724,1725,1726,1727,1728,1729,1730,1731,1732,1733,1734,1735,1736,1737,1738,1739,1740,
<br />1741,1742,1743,1744,1745,1746,1747,1748,1749,1750,1751,1752,1753,1754,1755,1756,1757,1758,1759,1760,
<br />1761,1762,1763,1764,1765,1766,1767,1768,1769,1770,1771,1772,1773,1774,1775,1776,1777,1778,1779,1780,
<br />1781,1782,1783,1784,1785,1786,1787,1788,1789,1790,1791,1792,1793,1794,1795,1796,1797,1798,1799,1800,
<br />1801,1802,1803,1804,1805,1806,1807,1808,1809,1810,1811,1812,1813,1814,1815,1816,1817,1818,1819,1820,
<br />1821,1822,1823,1824,1825,1826,1827,1828,1829,1830,1831,1832,1833,1834,1835,1836,1837,1838,1839,1840,
<br />1841,1842,1843,1844,1845,1846,1847,1848,1849,1850,1851,1852,1853,1854,1855,1856,1857,1858,1859,1860,
<br />1861,1862,1863,1864,1865,1866,1867,1868,1869,1870,1871,1872,1873,1874,1875,1876,1877,1878,1879,1880,
<br />1881,1882,1883,1884,1885,1886,1887,1888,1889,1890,1891,1892,1893,1894,1895,1896,1897,1898,1899,1900
<br /></span></span></span></td></tr>

</table>
<div align="center"><blockquote><blockquote><br /><br /><input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form><br /><br />
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Towns");
}



function deltown() {

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_towns where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_towns";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<b><u>Del Towns</b></u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database.";
	$townquery = doquery("SELECT * FROM {{table}} ORDER BY id", "towns");
	while ($townrow = mysql_fetch_array($townquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=deltowns\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$townrow["id"]."\"> <b>".$townrow["id"]."</b>: <b>".$townrow["name"]."</b></p></form></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=deltowns\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$townrow["id"]."\"> <b>".$townrow["id"]."</b>: <b>".$townrow["name"]."</b></p></form></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Del Towns");
}




function quests() {
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "quests");
    $page = "<u>Edit Quests</u><br />Click a quest's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editquest:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editquest:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No quests found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Quests");
    
}

function editquest($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
	  if ($townid == "") { $errors++; $errorlist .= "Town ID is required.<br />"; }
	  if (!is_numeric($townid)) { $errors++; $errorlist .= "Town ID must be a number.<br />"; }
	  if ($minlevel == "") { $errors++; $errorlist .= "Minimum level is required.<br />"; }
	  if (!is_numeric($minlevel)) { $errors++; $errorlist .= "Minimum Level must be a number.<br />"; }
	  if ($maxlevel == "") { $errors++; $errorlist .= "Maximum level is required.<br />"; }
	  if (!is_numeric($maxlevel)) { $errors++; $errorlist .= "Maximum Level must be a number.<br />"; }
	  if (is_numeric($minlevel) && is_numeric($maxlevel) && $minlevel > $maxlevel) { $errors++; $errorlist .= "Maximum level must be greater than or equal to minimum level.<br />"; }
      if ($questtype == "") { $errors++; $errorlist .= "Quest Type is required.<br />"; }
	  if (!is_numeric($questtype)) { $errors++; $errorlist .= "Quest Type must be 0 or 1.<br />"; }
	  if (is_numeric($questtype) && ($questtype < 0 || $questtype > 1)) { $errors++; $errorlist .= "Quest Type must be 0 or 1.<br />"; } 
      if ($monsterid == "") { $errors++; $errorlist .= "Monster ID is required.<br />"; }
      if (!is_numeric($monsterid)) { $errors++; $errorlist .= "Monster ID must be numeric.<br />"; }
	  if ($preid == "") { $errors++; $errorlist .= "Pre ID is required.<br />"; }
	  if (!is_numeric($preid)) { $errors++; $errorlist .= "Pre ID must be numeric.<br />"; }
	  if ($starttext == "") { $errors++; $errorlist .= "Start text is required.<br />"; }
	  if ($endtext == "") { $errors++; $errorlist .= "End text is required.<br />"; }
	  if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
	  if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be numeric.<br />"; }
	  if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
	  if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be numeric.<br />"; }
	  if ($experience == "") { $errors++; $errorlist .= "Experience is required.<br />"; }
	  if (!is_numeric($experience)) { $errors++; $errorlist .= "Experience must be numeric.<br />"; }	  
	  if ($gold == "") { $errors++; $errorlist .= "Gold is required.<br />"; }
	  if (!is_numeric($gold)) { $errors++; $errorlist .= "Gold must be numeric.<br />"; }	  
//	  if ($silver == "") { $errors++; $errorlist .= "Silver is required.<br />"; }
//	  if (!is_numeric($silver)) { $errors++; $errorlist .= "Silver must be numeric.<br />"; }	  
//	  if ($copper == "") { $errors++; $errorlist .= "Copper is required.<br />"; }
//	  if (!is_numeric($copper)) { $errors++; $errorlist .= "Copper must be numeric.<br />"; }	  
	  if ($dropid == "") { $errors++; $errorlist .= "Drop ID is required.<br />"; }
	  if (!is_numeric($dropid)) { $errors++; $errorlist .= "Drop ID must be numeric.<br />"; }
        
	  if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='" .$name. "',town_id='" .$townid. "',min_level='" .$minlevel. "',max_level='" .$maxlevel. "',quest_type='" .$questtype. "',monster_id='" .$monsterid. "',pre_id='" .$preid. "',begin_text='" .$starttext. "',end_text='" .$endtext. "',objective_lat='" .$latitude. "',objective_long='" .$longitude. "',reward_exp='" .$experience. "', reward_gold='" .$gold. "', reward_silver='" .$silver. "', reward_copper='" .$copper. "', drop_id='" .$dropid. "' WHERE id='$id' LIMIT 1", "quests");
            admindisplay("Quest updated.","Edit Quests");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Towns");
        }  
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "quests");
    $row = mysql_fetch_array($query);

$page = <<<END
<u>Edit Quests</u><br /><br />
<form action="admin.php?do=editquest:$id" method="post">
<table width="90%">
<tr><td width="20%">ID:</td>
<td>{{id}}</td></tr>
<tr><td width="20%">Name:</td>
<td><input type="text" name="name" size="30" maxlength="50" value="{{name}}" />
<br Name of the quest.</span></td>
</tr>
<tr>
<td width="20%">Town ID:</td>
<td><input type="text" name="townid" size="5" maxlength="3" value="{{town_id}}" />
<br /><span class="small">This is the id of the town where the quest will appear.  
If you give an id which doesn't exist, the quest will never show up.</span></td>
</tr>
<tr>
<td width="20%">Minimum Level:</td>
<td><input type="text" name="minlevel" size="5" maxlength="5" value="{{min_level}}" />
<br /><span class="small">This is the earliest level the quest can be picked up.</span></td>
</tr>
<tr>
<td width="20%">Maximum Level:</td>
<td><input type="text" name="maxlevel" size="5" maxlength="5" value="{{max_level}}" />
<br /><span class="small">This is the latest level the quest can be picked up.  
If a user picks up this quest and then levels past this level, they will still be able to complete it.</span></td>
</tr>
<tr>
<td width="20%">Quest Type:</td>
<td><input type="text" name="questtype" size="5" maxlength="1" value="{{quest_type}}" />
<br /><span class="small">Set this to 0 for a 'fetch' quest where the user simply must arrive at the area you 
specify, or set this to 1 for a 'kill' quest where a user will fight a monster at the area you specify.</span></td>
</tr> 
<tr>
<td width="20%">Monster ID:</td>
<td><input type="text" name="monsterid" size="5" maxlength="5" value="{{monster_id}}" /><br /><span class="small">If quest type is set to 1 for a 'kill' quest, then this is the id of the monster that must be beaten to finish the quest.</span></td></tr>
<tr><td width="20%">Previous Quest ID:</td>
<td><input type="text" name="preid" size="5" maxlength="5" value="{{pre_id}}" /><br /><span class="small">This is for creating quest chains.  Set this to 0 if no previous quest must be completed for this quest to show up, or set it to the ID of the quest that must first be completed before this quest can be gotten.  For example, if you have two quests you want to chain together, set the first quest's Previous Quest ID to 0, and set the second quest's Previous Quest ID to the ID of the first quest.  Note that you still must be conscious of quest min/max levels when creating quest chains.  If the second quest in a chain has a maximum level lower than the first quest's minimum level, it will never show up!</span></td></tr>

<tr><td width="20%">Latitude:</td>
<td><input type="text" name="latitude" size="5" maxlength="6" value="{{objective_lat}}" /><br /><span class="small">This can be a positive or negative integer representing the latitude on the map where the quest will end at.  A quest can not end in a town, so be sure to avoid entering the same long/lat combination that represents an existing town. Enter a Positive number for a Northern Latitude (without the +) and Enter a Negative Number for a Southern Latitude (with the -). Examples: 3 - would mean 3 North, and -3 would mean 3 South.</span></td></tr>

<tr><td width="20%">Longitude:</td>
<td><input type="text" name="longitude" size="5" maxlength="6" value="{{objective_long}}" /><br /><span class="small">This can be a positive or negative integer representing the longitude on the map where the quest will end at. Enter a Positive number for a Eastern Longitude (without the +) and Enter a Negative Number for a Western Longitude (with the -). Examples: 5 - would mean 5 East, and -5 would mean 5 West.</td></tr>

<tr><td width="20%">Experience Rewarded:</td>
<td><input type="text" name="experience" size="5" maxlength="8" value="{{reward_exp}}" /><br /><span class="small">This is the amount of Experience that will be rewarded for completing the quest.</td></tr>

<tr><td width="20%">Gold Rewarded:</td>
<td><input type="text" name="gold" size="5" maxlength="8" value="{{reward_gold}}" /><br /><span class="small">This is the amount of <b>Gold</b> that will be rewarded for completing the quest.</td></tr>

<tr><td width="20%">Silver Rewarded:</td>
<td><input type="text" name="silver" size="5" maxlength="8" value="{{reward_silver}}" /><br /><span class="small">This is the amount of <b>Silver</b> that will be rewarded for completing the quest.</td></tr>

<tr><td width="20%">Copper Rewarded:</td>
<td><input type="text" name="copper" size="5" maxlength="8" value="{{reward_copper}}" /><br /><span class="small">This is the amount of <b>Copper</b> that will be rewarded for completing the quest.</td></tr>

<tr><td width="20%">Drop ID:</td>
<td><input type="text" name="dropid" size="5" maxlength="8" value="{{drop_id}}" /><br /><span class="small">This is the ID of the drop that will be rewarded for completing the quest.  Set this to 0 if you do not want to reward a drop for this quest.</td></tr>
<tr><td width="20%">Starting Text:</td>
<td><textarea cols="40" rows="8" name="starttext" wrap="physical">{{begin_text}}</textarea><br /><span class="small">This is the text that appears to the user when they are first presented with the quest. Latitude 2 North, Longitude 2 East (+), Latitude 2 South, Longitude 2 Wast (-) </span></td></tr>
<tr><td width="20%">Ending Text:</td>
<td><textarea cols="40" rows="8" name="endtext" wrap="physical">{{end_text}}</textarea><br /><span class="small">This is the text that appears when the user arrives at the ending quest area you specify to complete the quest.</span></td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br /><input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Quests");
    
}

function addquest() {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
	  if ($townid == "") { $errors++; $errorlist .= "Town ID is required.<br />"; }
	  if (!is_numeric($townid)) { $errors++; $errorlist .= "Town ID must be a number.<br />"; }
	  if ($minlevel == "") { $errors++; $errorlist .= "Minimum level is required.<br />"; }
	  if (!is_numeric($minlevel)) { $errors++; $errorlist .= "Minimum Level must be a number.<br />"; }
	  if ($maxlevel == "") { $errors++; $errorlist .= "Maximum level is required.<br />"; }
	  if (!is_numeric($maxlevel)) { $errors++; $errorlist .= "Maximum Level must be a number.<br />"; }
	  if (is_numeric($minlevel) && is_numeric($maxlevel) && $minlevel > $maxlevel) { $errors++; $errorlist .= "Maximum level must be greater than or equal to minimum level.<br />"; }
      if ($questtype == "") { $errors++; $errorlist .= "Quest Type is required.<br />"; }
	  if (!is_numeric($questtype)) { $errors++; $errorlist .= "Quest Type must be 0 or 1.<br />"; }
	  if (is_numeric($questtype) && ($questtype < 0 || $questtype > 1)) { $errors++; $errorlist .= "Quest Type must be 0 or 1.<br />"; } 
      if ($monsterid == "") { $errors++; $errorlist .= "Monster ID is required.<br />"; }
      if (!is_numeric($monsterid)) { $errors++; $errorlist .= "Monster ID must be numeric.<br />"; }
	  if ($preid == "") { $errors++; $errorlist .= "Pre ID is required.<br />"; }
	  if (!is_numeric($preid)) { $errors++; $errorlist .= "Pre ID must be numeric.<br />"; }
	  if ($starttext == "") { $errors++; $errorlist .= "Start text is required.<br />"; }
	  if ($endtext == "") { $errors++; $errorlist .= "End text is required.<br />"; }
	  if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
	  if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be numeric.<br />"; }
	  if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
	  if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be numeric.<br />"; }
	  if ($experience == "") { $errors++; $errorlist .= "Experience is required.<br />"; }
	  if (!is_numeric($experience)) { $errors++; $errorlist .= "Experience must be numeric.<br />"; }
	  if ($gold == "") { $errors++; $errorlist .= "Gold is required.<br />"; }
	  if (!is_numeric($gold)) { $errors++; $errorlist .= "Gold must be numeric.<br />"; }	  
	  if ($silver == "") { $errors++; $errorlist .= "Silver is required.<br />"; }
	  if (!is_numeric($silver)) { $errors++; $errorlist .= "Silver must be numeric.<br />"; }	  
	  if ($copper == "") { $errors++; $errorlist .= "Copper is required.<br />"; }
	  if (!is_numeric($copper)) { $errors++; $errorlist .= "Copper must be numeric.<br />"; }	  
	  if ($dropid == "") { $errors++; $errorlist .= "Drop ID is required.<br />"; }
	  if (!is_numeric($dropid)) { $errors++; $errorlist .= "Drop ID must be numeric.<br />"; }
	  
        
	  if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET name='" .$name. "',town_id='" .$townid. "',min_level='" .$minlevel. "',max_level='" .$maxlevel. "',quest_type='" .$questtype. "',monster_id='" .$monsterid. "',pre_id='" .$preid. "',begin_text='" .$starttext. "',end_text='" .$endtext. "',objective_lat='" .$latitude. "',objective_long='" .$longitude. "',reward_exp='" .$experience. "', reward_gold='" .$gold. "', reward_silver='" .$silver. "', reward_copper='" .$copper. "', drop_id='" .$dropid. "'", "quests");
            admindisplay("Quest added.","Add Quest");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Towns");
        }
    }   
        
    
    //$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "quests");
    //$row = mysql_fetch_array($query);

$page = <<<END
<u>Add Quest</u><br /><br />
<form action="admin.php?do=addquest" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="50" value="" /><br Name of the quest.</span></td></tr>
<tr><td width="20%">Town ID:</td><td><input type="text" name="townid" size="5" maxlength="3" value="" /><br /><span class="small">This is the id of the town where the quest will appear.  If you give an id which doesn't exist, the quest will never show up.</span></td></tr>
<tr><td width="20%">Minimum Level:</td><td><input type="text" name="minlevel" size="5" maxlength="5" value="" /><br /><span class="small">This is the earliest level the quest can be picked up.</span></td></tr>
<tr><td width="20%">Maximum Level:</td><td><input type="text" name="maxlevel" size="5" maxlength="5" value="" /><br /><span class="small">This is the latest level the quest can be picked up.  If a user picks up this quest and then levels past this level, they will still be able to complete it.</span></td></tr>
<tr><td width="20%">Quest Type:</td><td><input type="text" name="questtype" size="5" maxlength="1" value="" /><br /><span class="small">Set this to 0 for a 'fetch' quest where the user simply must arrive at the area you specify, or set this to 1 for a 'kill' quest where a user will fight a monster at the area you specify.</span></td></tr> 
<tr><td width="20%">Monster ID:</td><td><input type="text" name="monsterid" size="5" maxlength="5" value="" /><br /><span class="small">If quest type is set to 1 for a 'kill' quest, then this is the id of the monster that must be beaten to finish the quest.</span></td></tr>
<tr><td width="20%">Previous Quest ID:</td><td><input type="text" name="preid" size="5" maxlength="5" value="" /><br /><span class="small">This is for creating quest chains.  Set this to 0 if no previous quest must be completed for this quest to show up, or set it to the ID of the quest that must first be completed before this quest can be gotten.  For example, if you have two quests you want to chain together, set the first quest's Previous Quest ID to 0, and set the second quest's Previous Quest ID to the ID of the first quest.  Note that you still must be conscious of quest min/max levels when creating quest chains.  If the second quest in a chain has a maximum level lower than the first quest's minimum level, it will never show up!</span></td></tr>
<tr><td width="20%">Latitude:</td><td><input type="text" name="latitude" size="5" maxlength="6" value="" /><br /><span class="small">This can be a positive or negative integer representing the latitude on the map where the quest will end at.  A quest can not end in a town, so be sure to avoid entering the same long/lat combination that represents an existing town.</span></td></tr>
<tr><td width="20%">Longitude:</td><td><input type="text" name="longitude" size="5" maxlength="6" value="" /><br /><span class="small">This can be a positive or negative integer representing the longitude on the map where the quest will end at.</td></tr>
<tr><td width="20%">Experience Rewarded:</td><td><input type="text" name="experience" size="5" maxlength="8" value="" /><br /><span class="small">This is the amount of experience that will be rewarded for completing the quest.</td></tr>
<tr><td width="20%">Gold Rewarded:</td><td><input type="text" name="gold" size="5" maxlength="8" value="" /><br /><span class="small">This is the amount of Gold that will be rewarded for completing the quest.</td></tr>
<tr><td width="20%">Silver Rewarded:</td><td><input type="text" name="silver" size="5" maxlength="8" value="" /><br /><span class="small">This is the amount of Silver that will be rewarded for completing the quest.</td></tr>
<tr><td width="20%">Copper Rewarded:</td><td><input type="text" name="copper" size="5" maxlength="8" value="" /><br /><span class="small">This is the amount of Copper that will be rewarded for completing the quest.</td></tr>
<tr><td width="20%">Drop ID:</td><td><input type="text" name="dropid" size="5" maxlength="8" value="" /><br /><span class="small">This is the ID of the drop that will be rewarded for completing the quest.  Set this to 0 if you do not want to reward a drop for this quest.</td></tr>
<tr><td width="20%">Starting Text:</td><td><textarea cols="40" rows="8" name="starttext" wrap="physical"></textarea><br /><span class="small">This is the text that appears to the user when they are first presented with the quest.</span></td></tr>
<tr><td width="20%">Ending Text:</td><td><textarea cols="40" rows="8" name="endtext" wrap="physical"></textarea><br /><span class="small">This is the text that appears when the user arrives at the ending quest area you specify to complete the quest.</span></td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    //$page = parsetemplate($page, $row);
    admindisplay($page, "Add Quest");
    
}



function monsters() {
    
    global $controlrow;
    
    $statquery = doquery("SELECT * FROM {{table}} ORDER BY level DESC LIMIT 1", "monsters");
    $statrow = mysql_fetch_array($statquery);
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "monsters");
    $page = "<u>Edit Monsters</u><br />";
    
    if (($controlrow["gamesize"]/5) != $statrow["level"]) {
        $page .= "<span class=\"highlight\">Note:</span> Your highest monster level does not match with your entered map size. Highest monster level should be ".($controlrow["gamesize"]/5).", yours is ".$statrow["level"].". Please fix this before opening the game to the public.<br /><br />";
    } else { $page .= "Monster level and map size match. No further actions are required for map compatibility.<br /><br />"; }
    
    $page .= "Click an monster's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
       
	    if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editmonster:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 2; }

        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editmonster:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 1; }
    }
	
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No towns found.</td></tr>\n"; }

    $page .= "</table>";
    admindisplay($page, "Edit Monster");
    
}


function addmonster() {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($maxhp == "") { $errors++; $errorlist .= "Max HP is required.<br />"; }
        if (!is_numeric($maxhp)) { $errors++; $errorlist .= "Max HP must be a number.<br />"; }
        if ($maxdam == "") { $errors++; $errorlist .= "Max Damage is required.<br />"; }
        if (!is_numeric($maxdam)) { $errors++; $errorlist .= "Max Damage must be a number.<br />"; }
        if ($armor == "") { $errors++; $errorlist .= "Armor is required.<br />"; }
        if (!is_numeric($armor)) { $errors++; $errorlist .= "Armor must be a number.<br />"; }
        if ($level == "") { $errors++; $errorlist .= "Monster Level is required.<br />"; }
        if (!is_numeric($level)) { $errors++; $errorlist .= "Monster Level must be a number.<br />"; }
        if ($maxexp == "") { $errors++; $errorlist .= "Max Exp is required.<br />"; }
        if (!is_numeric($maxexp)) { $errors++; $errorlist .= "Max Exp must be a number.<br />"; }
        if ($maxgold == "") { $errors++; $errorlist .= "Max Gold is required.<br />"; }
        if (!is_numeric($maxgold)) { $errors++; $errorlist .= "Max Gold must be a number.<br />"; }		
        if ($maxsilver == "") { $errors++; $errorlist .= "Max Silver is required.<br />"; }
        if (!is_numeric($maxsilver)) { $errors++; $errorlist .= "Max Silver must be a number.<br />"; }		
        if ($maxcopper == "") { $errors++; $errorlist .= "Max Copper is required.<br />"; }
        if (!is_numeric($maxcopper)) { $errors++; $errorlist .= "Max Copper must be a number.<br />"; }
        
        if ($errors == 0) { 
		$query = doquery("INSERT INTO {{table}} SET id='',name='$name',maxhp='$maxhp',maxdam='$maxdam',armor='$armor',level='$level',maxexp='$maxexp',maxgold='$maxgold',immune='$immune' ", "monsters");
            admindisplay("Monster Created.","Create New Monster");
        } else {
            admindisplay("<b>Errors:</b><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Create new monster");
        }        
        
    }   

$page = <<<END
<b><u>Add New Monster</u></b><br /><br />
<form action="admin.php?do=addmonster" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>
<tr><td width="20%"><img src="images/monsters/703.png" alt="{{id}}" border="0"></td>
<td><b><i>This is a Placeholder Image Only</i></b>.<br />
<li>Normal Monster Images Should be Between 80-100px in Height.
<li>Giant Monster Images Should be between 80-90px in Width.
<li>Canvas Size for images should not exceed 135x135px.
<li>All [?X numbers] are only a guideline [But a Good Balanced Guideline] for you to use. Just keep in mind.<br>
&nbsp;&nbsp;&nbsp;You can always set the Difficulty Level in User Settings for a Easier or Harder Game.</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="30" value="" /></td></tr>

<tr><td width="20%">Max Hit Points [3X Monster Level]:</td><td><input type="text" name="maxhp" size="5" maxlength="10" value="" /></td></tr>
<tr><td width="20%">Max Damage [3X Monster Level]:</td><td><input type="text" name="maxdam" size="5" maxlength="10" value="" /><br /><span class="small">Compares to player's attackpower.</span></td></tr>
<tr><td width="20%">Armor [3X Monster Level]:</td><td><input type="text" name="armor" size="5" maxlength="10" value="" /><br /><span class="small">Compares to player's defensepower.</span></td></tr>
<tr><td width="20%">Monster Level [1-250]:</td><td><input type="text" name="level" size="5" maxlength="10" value="" /><br /><span class="small">Determines spawn location and item drops. Every 5 spaces from the Capitol Crossroad [Position 0N,0E] spawns a new Monster Level. Example 100N,100E would spawn the Monster Classes for Level 25.</span></td></tr>
<tr><td width="20%">Max Experience [5X Monster Level]:</td><td><input type="text" name="maxexp" size="5" maxlength="10" value="" /><br /><span class="small">Max experience gained from defeating monster.</span></td></tr>
<tr><td width="20%">Max Gold Coins [5X Monster Level]:</td><td><input type="text" name="maxgold" size="5" maxlength="10" value="" /><br /><span class="small">Max gold gained from defeating monster.</span></td></tr>
<tr><td width="20%">Max Silver Coins [3X Monster Level]:</td><td><input type="text" name="maxsilver" size="5" maxlength="10" value="" /><br /><span class="small">Max silver gained from defeating monster.</span></td></tr>
<tr><td width="20%">Max Copper Coins [3X Monster Level]:</td><td><input type="text" name="maxcopper" size="5" maxlength="10" value="" /><br /><span class="small">Max copper gained from defeating monster.</span></td></tr>

<tr><td width="20%">Immunity:</td><td><select name="immune">
<option value="0" {{immune0select}}>&nbsp;&nbsp;None</option>
<option value="1" {{immune1select}}>&nbsp;&nbsp;Heal Spells&nbsp;&nbsp;</option>
<option value="2" {{immune2select}}>&nbsp;&nbsp;Hurt Spells&nbsp;&nbsp;</option>
<option value="3" {{immune3select}}>&nbsp;&nbsp;Sleep Spells&nbsp;&nbsp;</option>
<option value="4" {{immune4select}}>&nbsp;&nbsp;Uber Attack Spells&nbsp;&nbsp;</option>
<option value="5" {{immune5select}}>&nbsp;&nbsp;Uber Defense Spells&nbsp;&nbsp;</option>
</select><br />Some monsters may not be hurt by certain spells.</td></tr>


</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form>
END;
    
    if ($row["immune"] == 1) { $row["immune1select"] = "selected=\"selected\" "; } else { $row["immune1select"] = ""; }
    if ($row["immune"] == 2) { $row["immune2select"] = "selected=\"selected\" "; } else { $row["immune2select"] = ""; }
    if ($row["immune"] == 3) { $row["immune3select"] = "selected=\"selected\" "; } else { $row["immune3select"] = ""; }
    if ($row["immune"] == 4) { $row["immune4select"] = "selected=\"selected\" "; } else { $row["immune4select"] = ""; }
    if ($row["immune"] == 5) { $row["immune5select"] = "selected=\"selected\" "; } else { $row["immune5select"] = ""; }
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Add New Monster");
    
}


function editmonster($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($maxhp == "") { $errors++; $errorlist .= "Max HP is required.<br />"; }
        if (!is_numeric($maxhp)) { $errors++; $errorlist .= "Max HP must be a number.<br />"; }
        if ($maxdam == "") { $errors++; $errorlist .= "Max Damage is required.<br />"; }
        if (!is_numeric($maxdam)) { $errors++; $errorlist .= "Max Damage must be a number.<br />"; }
        if ($armor == "") { $errors++; $errorlist .= "Armor is required.<br />"; }
        if (!is_numeric($armor)) { $errors++; $errorlist .= "Armor must be a number.<br />"; }
        if ($level == "") { $errors++; $errorlist .= "Monster Level is required.<br />"; }
        if (!is_numeric($level)) { $errors++; $errorlist .= "Monster Level must be a number.<br />"; }
        if ($maxexp == "") { $errors++; $errorlist .= "Max Exp is required.<br />"; }
        if (!is_numeric($maxexp)) { $errors++; $errorlist .= "Max Exp must be a number.<br />"; }
        if ($maxgold == "") { $errors++; $errorlist .= "Max Gold is required.<br />"; }
        if (!is_numeric($maxgold)) { $errors++; $errorlist .= "Max Gold must be a number.<br />"; }
        if (!is_numeric($maxsilver)) { $errors++; $errorlist .= "Max Silver must be a number.<br />"; }		
        if ($maxcopper == "") { $errors++; $errorlist .= "Max Copper is required.<br />"; }
        if (!is_numeric($maxcopper)) { $errors++; $errorlist .= "Max Copper must be a number.<br />"; }
        if ($seenby == "") { $errors++; $errorlist .= "Seen by is required.<br />"; }
        if (!is_numeric($seenby)) { $errors++; $errorlist .= "Seen by must be a Player number.<br />"; }
		
        if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='$name',maxhp='$maxhp',maxdam='$maxdam',armor='$armor',level='$level',maxexp='$maxexp',maxgold='$maxgold',immune='$immune',seenby='$seenby' WHERE id='$id' LIMIT 1", "monsters");
            admindisplay("Monster updated.","Edit monsters");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit monsters");
        }   
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "monsters");
    $row = mysql_fetch_array($query);

$page = <<<END
<u>Edit Monsters</u><br /><br />
<form action="admin.php?do=editmonster:$id" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>{{id}}</td></tr>
<tr><td width="20%"><img src="images/monsters/{{id}}.png" alt="{{id}}" border="0"></td>
<td><li>Normal Monster Images Should be Between 80-100px in Height.
<li>Giant Monster Images Should be between 80-90px in Width.
<li>Canvas Size for images should not exceed 135x135px.
<li>The ID Number of your Monster will also be the image name, that must be placed in your [root/images/monsters/] directory.
<li>Example: If your Monster ID is 6, the name of the image to upload [root/images/monsters/] is 6.png
<li>All [?X numbers] are only a guideline for you to use. Just keep in mind<br>
&nbsp;&nbsp;&nbsp;You can always set the Difficulty Level in User Settings for Easier or Harder Game.</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="50" maxlength="50" value="{{name}}" /></td></tr>
<tr><td width="20%">Max Hit Points [3X Monster Level]:</td><td><input type="text" name="maxhp" size="5" maxlength="10" value="{{maxhp}}" /></td></tr>
<tr><td width="20%">Max Damage [3X Monster Level]:</td><td><input type="text" name="maxdam" size="5" maxlength="10" value="{{maxdam}}" /><br />Compares to player's attackpower.</td></tr>
<tr><td width="20%">Armor [3X Monster Level]:</td><td><input type="text" name="armor" size="5" maxlength="10" value="{{armor}}" /><br />Compares to player's defensepower.</td></tr>
<tr><td width="20%">Monster Level [1-250]:</td><td><input type="text" name="level" size="5" maxlength="10" value="{{level}}" /><br /></span>Determines spawn location and item Drops. Spawn location is from Map location 0,0. <font color="#C8003C">Every five spaces from 0,0 {ex: 0,6, 6,3, 7,4, etc) Spawns the next Monster Level. So Map Location 16,8 would Spawn Level 3 Monsters. As such would also Drop Level three Objects (random).</font></td></tr>
<tr><td width="20%">Max Experience [5X Monster Level]:</td><td><input type="text" name="maxexp" size="5" maxlength="10" value="{{maxexp}}" /><br />Max experience gained from defeating monster.</td></tr>
<tr><td width="20%">Max Gold Coins [5X Monster Level]:</td><td><input type="text" name="maxgold" size="5" maxlength="10" value="{{maxgold}}" /><br />Max gold gained from defeating monster.</td></tr>
<tr><td width="20%">Max Silver Coins [3X Monster Level]:</td><td><input type="text" name="maxsilver" size="5" maxlength="10" value="{{maxsilver}}" /><br />Max silver gained from defeating monster.</td></tr>
<tr><td width="20%">Max Copper Coins [3X Monster Level]:</td><td><input type="text" name="maxcopper" size="5" maxlength="10" value="{{maxcopper}}" /><br />Max copper gained from defeating monster.</td></tr>
<tr><td width="20%">Immunity:</td><td><select name="immune">
<option value="0" {{immune0select}}>&nbsp;&nbsp;None</option>
<option value="1" {{immune1select}}>&nbsp;&nbsp;Heal Spells&nbsp;&nbsp;</option>
<option value="2" {{immune2select}}>&nbsp;&nbsp;Hurt Spells&nbsp;&nbsp;</option>
<option value="3" {{immune3select}}>&nbsp;&nbsp;Sleep Spells&nbsp;&nbsp;</option>
<option value="4" {{immune4select}}>&nbsp;&nbsp;Uber Attack Spells&nbsp;&nbsp;</option>
<option value="5" {{immune5select}}>&nbsp;&nbsp;Uber Defense Spells&nbsp;&nbsp;</option>
</select><br />Some monsters may not be hurt by certain spells.</td></tr>
<tr><td width="20%">Seen by:</td><td><input type="text" name="seenby" size="3" maxlength="5" value="{{seenby}}" /><br />Monster was Seen By Player Number. Check the <a href="index.php?do=viewmembers">Game Member List</a> for correct player numbers.</td></tr>

</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    if ($row["immune"] == 1) { $row["immune1select"] = "selected=\"selected\" "; } else { $row["immune1select"] = ""; }
    if ($row["immune"] == 2) { $row["immune2select"] = "selected=\"selected\" "; } else { $row["immune2select"] = ""; }
    if ($row["immune"] == 3) { $row["immune3select"] = "selected=\"selected\" "; } else { $row["immune3select"] = ""; }
    if ($row["immune"] == 4) { $row["immune4select"] = "selected=\"selected\" "; } else { $row["immune4select"] = ""; }
    if ($row["immune"] == 5) { $row["immune5select"] = "selected=\"selected\" "; } else { $row["immune5select"] = ""; }
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Monsters");
}




function delmonster() {

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_monsters where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_monsters";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<b><u>Del Monsters</b></u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database.";
	$monsterquery = doquery("SELECT * FROM {{table}} ORDER BY id", "monsters");
	while ($monsterrow = mysql_fetch_array($monsterquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delmonsters\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$monsterrow["id"]."\"> <b>".$monsterrow["id"]."</b>: <b>".$monsterrow["name"]."</b></p></form></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delmonsters\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$monsterrow["id"]."\"> <b>".$monsterrow["id"]."</b>: <b>".$monsterrow["name"]."</b></p></form></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Del Monsters");

}   




function addspell() {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($mp == "") { $errors++; $errorlist .= "MP is required.<br />"; }
        if (!is_numeric($mp)) { $errors++; $errorlist .= "MP must be a number.<br />"; }
        if ($attribute == "") { $errors++; $errorlist .= "Attribute is required.<br />"; }
        if (!is_numeric($attribute)) { $errors++; $errorlist .= "Attribute must be a number.<br />"; }
        
        if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET name='$name',mp='$mp',attribute='$attribute',type='$type'", "spells");
            admindisplay("Spell Created.","Add New Spell");
        } else {
            admindisplay("<b>Errors:</b><br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Add New Spell");
        }        
        
    }   
        
    

$page = <<<END
<b><u>Add New Spells</u></b><br /><br />
<form action="admin.php?do=addspell" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="30" value="" /></td></tr>
<tr><td width="20%">Magic Points:</td><td><input type="text" name="mp" size="5" maxlength="10" value="" /><br /><span class="small">MP required to cast spell.</span></td></tr>
<tr><td width="20%">Attribute:</td><td><input type="text" name="attribute" size="5" maxlength="10" value="" /><br /><span class="small">Numeric value of the spell's effect. Ties with type, below.</span></td></tr>
<tr><td width="20%">Type:</td><td><select name="type"><option value="1" {{type1select}}>Heal</option><option value="2" {{type2select}}>Hurt</option><option value="3" {{type3select}}>Sleep</option><option value="4" {{type4select}}>Uber Attack</option><option value="5" {{type5select}}>Uber Defense</option></select><br /><span class="small">- Heal gives player back [attribute] hit points.<br />- Hurt deals [attribute] damage to monster.<br />- Sleep keeps monster from attacking ([attribute] is monster's chance out of 15 to stay asleep each turn).<br />- Uber Attack increases total attack damage by [attribute] percent.<br />- Uber Defense increases total defense from attack by [attribute] percent.</span></td></tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form>
END;

    if ($row["type"] == 1) { $row["type1select"] = "selected=\"selected\" "; } else { $row["type1select"] = ""; }
    if ($row["type"] == 2) { $row["type2select"] = "selected=\"selected\" "; } else { $row["type2select"] = ""; }
    if ($row["type"] == 3) { $row["type3select"] = "selected=\"selected\" "; } else { $row["type3select"] = ""; }
    if ($row["type"] == 4) { $row["type4select"] = "selected=\"selected\" "; } else { $row["type4select"] = ""; }
    if ($row["type"] == 5) { $row["type5select"] = "selected=\"selected\" "; } else { $row["type5select"] = ""; }
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Add New Spell");
    
}


function spells() {
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "spells");
    $page = "<u>Edit Spells</u><br />Click an spell's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editspell:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editspell:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No spells found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Spells");
    
}

function editspell($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($mp == "") { $errors++; $errorlist .= "MP is required.<br />"; }
        if (!is_numeric($mp)) { $errors++; $errorlist .= "MP must be a number.<br />"; }
        if ($attribute == "") { $errors++; $errorlist .= "Attribute is required.<br />"; }
        if (!is_numeric($attribute)) { $errors++; $errorlist .= "Attribute must be a number.<br />"; }
        
        if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='$name',mp='$mp',attribute='$attribute',type='$type' WHERE id='$id' LIMIT 1", "spells");
            admindisplay("Spell updated.","Edit Spells");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Spells");
        }     
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "spells");
    $row = mysql_fetch_array($query);

$page = <<<END
<u>Edit Spells</u><br /><br />
<form action="admin.php?do=editspell:$id" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>{{id}}</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="50" maxlength="50" value="{{name}}" /></td></tr>
<tr><td width="20%">Magic Points:</td><td><input type="text" name="mp" size="5" maxlength="10" value="{{mp}}" /><br />MP required to cast spell.</td></tr>
<tr><td width="20%">Attribute:</td><td><input type="text" name="attribute" size="5" maxlength="10" value="{{attribute}}" /><br />Numeric value of the spell's effect. Ties with type, below.</td></tr>
<tr><td width="20%">Type:</td><td><select name="type">
<option value="1" {{type1select}}>Heal</option>
<option value="2" {{type2select}}>Hurt</option>
<option value="3" {{type3select}}>Sleep</option>
<option value="4" {{type4select}}>Uber Attack</option>
<option value="5" {{type5select}}>Uber Defense</option></select><br />
<br /><font color="#C8003C">Heal</font> gives player back [attribute] hit points.
<br /><font color="#C8003C">Hurt</font> deals [attribute] damage to monster.
<br /><font color="#C8003C">Sleep</font> keeps monster from attacking.([attribute] is monsters chance out of 15 to stay asleep each turn).
<br /><font color="#C8003C">Uber Attack</font> Increases total attack damage by [attribute] percent.
<br /><font color="#C8003C">Uber Defense</font> Increases total defense from attack by [attribute] percent.</td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div></td></tr>
</table>
</form>
END;

    if ($row["type"] == 1) { $row["type1select"] = "selected=\"selected\" "; } else { $row["type1select"] = ""; }
    if ($row["type"] == 2) { $row["type2select"] = "selected=\"selected\" "; } else { $row["type2select"] = ""; }
    if ($row["type"] == 3) { $row["type3select"] = "selected=\"selected\" "; } else { $row["type3select"] = ""; }
    if ($row["type"] == 4) { $row["type4select"] = "selected=\"selected\" "; } else { $row["type4select"] = ""; }
    if ($row["type"] == 5) { $row["type5select"] = "selected=\"selected\" "; } else { $row["type5select"] = ""; }
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Spells");
}



function delspell() {

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_spells where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_spells";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<b><u>Del Spells</b></u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database.";
	$spellquery = doquery("SELECT * FROM {{table}} ORDER BY id", "spells");
	while ($spellrow = mysql_fetch_array($spellquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delspells\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$spellrow["id"]."\"> <b>".$spellrow["id"]."</b>: <b>".$spellrow["name"]."</b></p></form></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delspells\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$spellrow["id"]."\"> <b>".$spellrow["id"]."</b>: <b>".$spellrow["name"]."</b></p></form></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Del Spells");

}   




function levels() {

    $query = doquery("SELECT id FROM {{table}} ORDER BY id DESC LIMIT 1", "levels");
    $row = mysql_fetch_array($query);
    
    $options = "";
    for($i=1; $i<$row["id"]; $i++) {
        $options .= "<option value=\"$i\">$i</option>\n";
    }
    
$page = <<<END
<blockquote><blockquote><u>Edit Levels</u><br />Select a level number from the dropdown box to edit it.<br /><br />
<form action="admin.php?do=editlevel" method="post">
<select name="level">
$options
</select>
<input type="submit" name="go" value="Submit" class="myButton2" />
</form></blockquote></blockquote>
END;

    admindisplay($page, "Edit Levels");
}

function editlevel() {

    if (!isset($_POST["level"])) { admindisplay("No level to edit.", "Edit Levels"); die(); }
    $id = $_POST["level"];
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";

        if ($_POST["one_exp"] == "") { $errors++; $errorlist .= "Class 1 Experience is required.<br />"; }
        if ($_POST["one_hp"] == "") { $errors++; $errorlist .= "Class 1 HP is required.<br />"; }
        if ($_POST["one_mp"] == "") { $errors++; $errorlist .= "Class 1 MP is required.<br />"; }
        if ($_POST["one_tp"] == "") { $errors++; $errorlist .= "Class 1 TP is required.<br />"; }
        if ($_POST["one_strength"] == "") { $errors++; $errorlist .= "Class 1 Strength is required.<br />"; }
        if ($_POST["one_dexterity"] == "") { $errors++; $errorlist .= "Class 1 Dexterity is required.<br />"; }
        if ($_POST["one_spells"] == "") { $errors++; $errorlist .= "Class 1 Spells is required.<br />"; }
        if (!is_numeric($_POST["one_exp"])) { $errors++; $errorlist .= "Class 1 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["one_hp"])) { $errors++; $errorlist .= "Class 1 HP must be a number.<br />"; }
        if (!is_numeric($_POST["one_mp"])) { $errors++; $errorlist .= "Class 1 MP must be a number.<br />"; }
        if (!is_numeric($_POST["one_tp"])) { $errors++; $errorlist .= "Class 1 TP must be a number.<br />"; }
        if (!is_numeric($_POST["one_strength"])) { $errors++; $errorlist .= "Class 1 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["one_dexterity"])) { $errors++; $errorlist .= "Class 1 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["one_spells"])) { $errors++; $errorlist .= "Class 1 Spells must be a number.<br />"; }

        if ($_POST["two_exp"] == "") { $errors++; $errorlist .= "Class 2 Experience is required.<br />"; }
        if ($_POST["two_hp"] == "") { $errors++; $errorlist .= "Class 2 HP is required.<br />"; }
        if ($_POST["two_mp"] == "") { $errors++; $errorlist .= "Class 2 MP is required.<br />"; }
        if ($_POST["two_tp"] == "") { $errors++; $errorlist .= "Class 2 TP is required.<br />"; }
        if ($_POST["two_strength"] == "") { $errors++; $errorlist .= "Class 2 Strength is required.<br />"; }
        if ($_POST["two_dexterity"] == "") { $errors++; $errorlist .= "Class 2 Dexterity is required.<br />"; }
        if ($_POST["two_spells"] == "") { $errors++; $errorlist .= "Class 2 Spells is required.<br />"; }
        if (!is_numeric($_POST["two_exp"])) { $errors++; $errorlist .= "Class 2 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["two_hp"])) { $errors++; $errorlist .= "Class 2 HP must be a number.<br />"; }
        if (!is_numeric($_POST["two_mp"])) { $errors++; $errorlist .= "Class 2 MP must be a number.<br />"; }
        if (!is_numeric($_POST["two_tp"])) { $errors++; $errorlist .= "Class 2 TP must be a number.<br />"; }
        if (!is_numeric($_POST["two_strength"])) { $errors++; $errorlist .= "Class 2 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["two_dexterity"])) { $errors++; $errorlist .= "Class 2 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["two_spells"])) { $errors++; $errorlist .= "Class 2 Spells must be a number.<br />"; }
                
        if ($_POST["three_exp"] == "") { $errors++; $errorlist .= "Class 3 Experience is required.<br />"; }
        if ($_POST["three_hp"] == "") { $errors++; $errorlist .= "Class 3 HP is required.<br />"; }
        if ($_POST["three_mp"] == "") { $errors++; $errorlist .= "Class 3 MP is required.<br />"; }
        if ($_POST["three_tp"] == "") { $errors++; $errorlist .= "Class 3 TP is required.<br />"; }
        if ($_POST["three_strength"] == "") { $errors++; $errorlist .= "Class 3 Strength is required.<br />"; }
        if ($_POST["three_dexterity"] == "") { $errors++; $errorlist .= "Class 3 Dexterity is required.<br />"; }
        if ($_POST["three_spells"] == "") { $errors++; $errorlist .= "Class 3 Spells is required.<br />"; }
        if (!is_numeric($_POST["three_exp"])) { $errors++; $errorlist .= "Class 3 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["three_hp"])) { $errors++; $errorlist .= "Class 3 HP must be a number.<br />"; }
        if (!is_numeric($_POST["three_mp"])) { $errors++; $errorlist .= "Class 3 MP must be a number.<br />"; }
        if (!is_numeric($_POST["three_tp"])) { $errors++; $errorlist .= "Class 3 TP must be a number.<br />"; }
        if (!is_numeric($_POST["three_strength"])) { $errors++; $errorlist .= "Class 3 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["three_dexterity"])) { $errors++; $errorlist .= "Class 3 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["three_spells"])) { $errors++; $errorlist .= "Class 3 Spells must be a number.<br />"; }
		
        if ($_POST["four_exp"] == "") { $errors++; $errorlist .= "Class 4 Experience is required.<br />"; }
        if ($_POST["four_hp"] == "") { $errors++; $errorlist .= "Class 4 HP is required.<br />"; }
        if ($_POST["four_mp"] == "") { $errors++; $errorlist .= "Class 4 MP is required.<br />"; }
        if ($_POST["four_tp"] == "") { $errors++; $errorlist .= "Class 4 TP is required.<br />"; }
        if ($_POST["four_strength"] == "") { $errors++; $errorlist .= "Class 4 Strength is required.<br />"; }
        if ($_POST["four_dexterity"] == "") { $errors++; $errorlist .= "Class 4 Dexterity is required.<br />"; }
        if ($_POST["four_spells"] == "") { $errors++; $errorlist .= "Class 4 Spells is required.<br />"; }
        if (!is_numeric($_POST["four_exp"])) { $errors++; $errorlist .= "Class 4 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["four_hp"])) { $errors++; $errorlist .= "Class 4 HP must be a number.<br />"; }
        if (!is_numeric($_POST["four_mp"])) { $errors++; $errorlist .= "Class 4 MP must be a number.<br />"; }
        if (!is_numeric($_POST["four_tp"])) { $errors++; $errorlist .= "Class 4 TP must be a number.<br />"; }
        if (!is_numeric($_POST["four_strength"])) { $errors++; $errorlist .= "Class 4 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["four_dexterity"])) { $errors++; $errorlist .= "Class 4 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["four_spells"])) { $errors++; $errorlist .= "Class 4 Spells must be a number.<br />"; }

        if ($_POST["five_exp"] == "") { $errors++; $errorlist .= "Class 5 Experience is required.<br />"; }
        if ($_POST["five_hp"] == "") { $errors++; $errorlist .= "Class 5 HP is required.<br />"; }
        if ($_POST["five_mp"] == "") { $errors++; $errorlist .= "Class 5 MP is required.<br />"; }
        if ($_POST["five_tp"] == "") { $errors++; $errorlist .= "Class 5 TP is required.<br />"; }
        if ($_POST["five_strength"] == "") { $errors++; $errorlist .= "Class 5 Strength is required.<br />"; }
        if ($_POST["five_dexterity"] == "") { $errors++; $errorlist .= "Class 5 Dexterity is required.<br />"; }
        if ($_POST["five_spells"] == "") { $errors++; $errorlist .= "Class 5 Spells is required.<br />"; }
        if (!is_numeric($_POST["five_exp"])) { $errors++; $errorlist .= "Class 5 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["five_hp"])) { $errors++; $errorlist .= "Class 5 HP must be a number.<br />"; }
        if (!is_numeric($_POST["five_mp"])) { $errors++; $errorlist .= "Class 5 MP must be a number.<br />"; }
        if (!is_numeric($_POST["five_tp"])) { $errors++; $errorlist .= "Class 5 TP must be a number.<br />"; }
        if (!is_numeric($_POST["five_strength"])) { $errors++; $errorlist .= "Class 5 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["five_dexterity"])) { $errors++; $errorlist .= "Class 5 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["five_spells"])) { $errors++; $errorlist .= "Class 5 Spells must be a number.<br />"; }	
		
        if ($_POST["six_exp"] == "") { $errors++; $errorlist .= "Class 6 Experience is required.<br />"; }
        if ($_POST["six_hp"] == "") { $errors++; $errorlist .= "Class 6 HP is required.<br />"; }
        if ($_POST["six_mp"] == "") { $errors++; $errorlist .= "Class 6 MP is required.<br />"; }
        if ($_POST["six_tp"] == "") { $errors++; $errorlist .= "Class 6 TP is required.<br />"; }
        if ($_POST["six_strength"] == "") { $errors++; $errorlist .= "Class 6 Strength is required.<br />"; }
        if ($_POST["six_dexterity"] == "") { $errors++; $errorlist .= "Class 6 Dexterity is required.<br />"; }
        if ($_POST["six_spells"] == "") { $errors++; $errorlist .= "Class 6 Spells is required.<br />"; }
        if (!is_numeric($_POST["six_exp"])) { $errors++; $errorlist .= "Class 6 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["six_hp"])) { $errors++; $errorlist .= "Class 6 HP must be a number.<br />"; }
        if (!is_numeric($_POST["six_mp"])) { $errors++; $errorlist .= "Class 6 MP must be a number.<br />"; }
        if (!is_numeric($_POST["six_tp"])) { $errors++; $errorlist .= "Class 6 TP must be a number.<br />"; }
        if (!is_numeric($_POST["six_strength"])) { $errors++; $errorlist .= "Class 6 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["six_dexterity"])) { $errors++; $errorlist .= "Class 6 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["six_spells"])) { $errors++; $errorlist .= "Class 6 Spells must be a number.<br />"; }

        if ($_POST["seven_exp"] == "") { $errors++; $errorlist .= "Class 7 Experience is required.<br />"; }
        if ($_POST["seven_hp"] == "") { $errors++; $errorlist .= "Class 7 HP is required.<br />"; }
        if ($_POST["seven_mp"] == "") { $errors++; $errorlist .= "Class 7 MP is required.<br />"; }
        if ($_POST["seven_tp"] == "") { $errors++; $errorlist .= "Class 7 TP is required.<br />"; }
        if ($_POST["seven_strength"] == "") { $errors++; $errorlist .= "Class 7 Strength is required.<br />"; }
        if ($_POST["seven_dexterity"] == "") { $errors++; $errorlist .= "Class 7 Dexterity is required.<br />"; }
        if ($_POST["seven_spells"] == "") { $errors++; $errorlist .= "Class 7 Spells is required.<br />"; }
        if (!is_numeric($_POST["seven_exp"])) { $errors++; $errorlist .= "Class 7 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["seven_hp"])) { $errors++; $errorlist .= "Class 7 HP must be a number.<br />"; }
        if (!is_numeric($_POST["seven_mp"])) { $errors++; $errorlist .= "Class 7 MP must be a number.<br />"; }
        if (!is_numeric($_POST["seven_tp"])) { $errors++; $errorlist .= "Class 7 TP must be a number.<br />"; }
        if (!is_numeric($_POST["seven_strength"])) { $errors++; $errorlist .= "Class 7 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["seven_dexterity"])) { $errors++; $errorlist .= "Class 7 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["seven_spells"])) { $errors++; $errorlist .= "Class 7 Spells must be a number.<br />"; }
                
        if ($_POST["eight_exp"] == "") { $errors++; $errorlist .= "Class 8 Experience is required.<br />"; }
        if ($_POST["eight_hp"] == "") { $errors++; $errorlist .= "Class 8 HP is required.<br />"; }
        if ($_POST["eight_mp"] == "") { $errors++; $errorlist .= "Class 8 MP is required.<br />"; }
        if ($_POST["eight_tp"] == "") { $errors++; $errorlist .= "Class 8 TP is required.<br />"; }
        if ($_POST["eight_strength"] == "") { $errors++; $errorlist .= "Class 8 Strength is required.<br />"; }
        if ($_POST["eight_dexterity"] == "") { $errors++; $errorlist .= "Class 8 Dexterity is required.<br />"; }
        if ($_POST["eight_spells"] == "") { $errors++; $errorlist .= "Class 8 Spells is required.<br />"; }
        if (!is_numeric($_POST["eight_exp"])) { $errors++; $errorlist .= "Class 8 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["eight_hp"])) { $errors++; $errorlist .= "Class 8 HP must be a number.<br />"; }
        if (!is_numeric($_POST["eight_mp"])) { $errors++; $errorlist .= "Class 8 MP must be a number.<br />"; }
        if (!is_numeric($_POST["eight_tp"])) { $errors++; $errorlist .= "Class 8 TP must be a number.<br />"; }
        if (!is_numeric($_POST["eight_strength"])) { $errors++; $errorlist .= "Class 8 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["eight_dexterity"])) { $errors++; $errorlist .= "Class 8 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["eight_spells"])) { $errors++; $errorlist .= "Class 8 Spells must be a number.<br />"; }

        if ($_POST["nine_exp"] == "") { $errors++; $errorlist .= "Class 9 Experience is required.<br />"; }
        if ($_POST["nine_hp"] == "") { $errors++; $errorlist .= "Class 9 HP is required.<br />"; }
        if ($_POST["nine_mp"] == "") { $errors++; $errorlist .= "Class 9 MP is required.<br />"; }
        if ($_POST["nine_tp"] == "") { $errors++; $errorlist .= "Class 9 TP is required.<br />"; }
        if ($_POST["nine_strength"] == "") { $errors++; $errorlist .= "Class 9 Strength is required.<br />"; }
        if ($_POST["nine_dexterity"] == "") { $errors++; $errorlist .= "Class 9 Dexterity is required.<br />"; }
        if ($_POST["nine_spells"] == "") { $errors++; $errorlist .= "Class 9 Spells is required.<br />"; }
        if (!is_numeric($_POST["nine_exp"])) { $errors++; $errorlist .= "Class 9 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["nine_hp"])) { $errors++; $errorlist .= "Class 9 HP must be a number.<br />"; }
        if (!is_numeric($_POST["nine_mp"])) { $errors++; $errorlist .= "Class 9 MP must be a number.<br />"; }
        if (!is_numeric($_POST["nine_tp"])) { $errors++; $errorlist .= "Class 9 TP must be a number.<br />"; }
        if (!is_numeric($_POST["nine_strength"])) { $errors++; $errorlist .= "Class 9 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["nine_dexterity"])) { $errors++; $errorlist .= "Class 9 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["nine_spells"])) { $errors++; $errorlist .= "Class 9 Spells must be a number.<br />"; }

        if ($_POST["ten_exp"] == "") { $errors++; $errorlist .= "Class 10 Experience is required.<br />"; }
        if ($_POST["ten_hp"] == "") { $errors++; $errorlist .= "Class 10 HP is required.<br />"; }
        if ($_POST["ten_mp"] == "") { $errors++; $errorlist .= "Class 10 MP is required.<br />"; }
        if ($_POST["ten_tp"] == "") { $errors++; $errorlist .= "Class 10 TP is required.<br />"; }
        if ($_POST["ten_strength"] == "") { $errors++; $errorlist .= "Class 10 Strength is required.<br />"; }
        if ($_POST["ten_dexterity"] == "") { $errors++; $errorlist .= "Class 10 Dexterity is required.<br />"; }
        if ($_POST["ten_spells"] == "") { $errors++; $errorlist .= "Class 10 Spells is required.<br />"; }
        if (!is_numeric($_POST["ten_exp"])) { $errors++; $errorlist .= "Class 10 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ten_hp"])) { $errors++; $errorlist .= "Class 10 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ten_mp"])) { $errors++; $errorlist .= "Class 10 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ten_tp"])) { $errors++; $errorlist .= "Class 10 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ten_strength"])) { $errors++; $errorlist .= "Class 10 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ten_dexterity"])) { $errors++; $errorlist .= "Class 10 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ten_spells"])) { $errors++; $errorlist .= "Class 10 Spells must be a number.<br />"; }

        if ($_POST["OneOne_exp"] == "") { $errors++; $errorlist .= "Class 11 Experience is required.<br />"; }
        if ($_POST["OneOne_hp"] == "") { $errors++; $errorlist .= "Class 11 HP is required.<br />"; }
        if ($_POST["OneOne_mp"] == "") { $errors++; $errorlist .= "Class 11 MP is required.<br />"; }
        if ($_POST["OneOne_tp"] == "") { $errors++; $errorlist .= "Class 11 TP is required.<br />"; }
        if ($_POST["OneOne_strength"] == "") { $errors++; $errorlist .= "Class 11 Strength is required.<br />"; }
        if ($_POST["OneOne_dexterity"] == "") { $errors++; $errorlist .= "Class 11 Dexterity is required.<br />"; }
        if ($_POST["OneOne_spells"] == "") { $errors++; $errorlist .= "Class 11 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneOne_exp"])) { $errors++; $errorlist .= "Class 11 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneOne_hp"])) { $errors++; $errorlist .= "Class 11 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneOne_mp"])) { $errors++; $errorlist .= "Class 11 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneOne_tp"])) { $errors++; $errorlist .= "Class 11 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneOne_strength"])) { $errors++; $errorlist .= "Class 11 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneOne_dexterity"])) { $errors++; $errorlist .= "Class 11 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneOne_spells"])) { $errors++; $errorlist .= "Class 11 Spells must be a number.<br />"; }

        if ($_POST["OneTwo_exp"] == "") { $errors++; $errorlist .= "Class 12 Experience is required.<br />"; }
        if ($_POST["OneTwo_hp"] == "") { $errors++; $errorlist .= "Class 12 HP is required.<br />"; }
        if ($_POST["OneTwo_mp"] == "") { $errors++; $errorlist .= "Class 12 MP is required.<br />"; }
        if ($_POST["OneTwo_tp"] == "") { $errors++; $errorlist .= "Class 12 TP is required.<br />"; }
        if ($_POST["OneTwo_strength"] == "") { $errors++; $errorlist .= "Class 12 Strength is required.<br />"; }
        if ($_POST["OneTwo_dexterity"] == "") { $errors++; $errorlist .= "Class 12 Dexterity is required.<br />"; }
        if ($_POST["OneTwo_spells"] == "") { $errors++; $errorlist .= "Class 12 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneTwo_exp"])) { $errors++; $errorlist .= "Class 12 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneTwo_hp"])) { $errors++; $errorlist .= "Class 12 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneTwo_mp"])) { $errors++; $errorlist .= "Class 12 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneTwo_tp"])) { $errors++; $errorlist .= "Class 12 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneTwo_strength"])) { $errors++; $errorlist .= "Class 12 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneTwo_dexterity"])) { $errors++; $errorlist .= "Class 12 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneTwo_spells"])) { $errors++; $errorlist .= "Class 12 Spells must be a number.<br />"; }
                
        if ($_POST["OneThree_exp"] == "") { $errors++; $errorlist .= "Class 13 Experience is required.<br />"; }
        if ($_POST["OneThree_hp"] == "") { $errors++; $errorlist .= "Class 13 HP is required.<br />"; }
        if ($_POST["OneThree_mp"] == "") { $errors++; $errorlist .= "Class 13 MP is required.<br />"; }
        if ($_POST["OneThree_tp"] == "") { $errors++; $errorlist .= "Class 13 TP is required.<br />"; }
        if ($_POST["OneThree_strength"] == "") { $errors++; $errorlist .= "Class 13 Strength is required.<br />"; }
        if ($_POST["OneThree_dexterity"] == "") { $errors++; $errorlist .= "Class 13 Dexterity is required.<br />"; }
        if ($_POST["OneThree_spells"] == "") { $errors++; $errorlist .= "Class 13 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneThree_exp"])) { $errors++; $errorlist .= "Class 13 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneThree_hp"])) { $errors++; $errorlist .= "Class 13 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneThree_mp"])) { $errors++; $errorlist .= "Class 13 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneThree_tp"])) { $errors++; $errorlist .= "Class 13 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneThree_strength"])) { $errors++; $errorlist .= "Class 13 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneThree_dexterity"])) { $errors++; $errorlist .= "Class 13 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneThree_spells"])) { $errors++; $errorlist .= "Class 13 Spells must be a number.<br />"; }
		
        if ($_POST["OneFour_exp"] == "") { $errors++; $errorlist .= "Class 14 Experience is required.<br />"; }
        if ($_POST["OneFour_hp"] == "") { $errors++; $errorlist .= "Class 14 HP is required.<br />"; }
        if ($_POST["OneFour_mp"] == "") { $errors++; $errorlist .= "Class 14 MP is required.<br />"; }
        if ($_POST["OneFour_tp"] == "") { $errors++; $errorlist .= "Class 14 TP is required.<br />"; }
        if ($_POST["OneFour_strength"] == "") { $errors++; $errorlist .= "Class 14 Strength is required.<br />"; }
        if ($_POST["OneFour_dexterity"] == "") { $errors++; $errorlist .= "Class 14 Dexterity is required.<br />"; }
        if ($_POST["OneFour_spells"] == "") { $errors++; $errorlist .= "Class 14 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneFour_exp"])) { $errors++; $errorlist .= "Class 14 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneFour_hp"])) { $errors++; $errorlist .= "Class 14 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneFour_mp"])) { $errors++; $errorlist .= "Class 14 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneFour_tp"])) { $errors++; $errorlist .= "Class 14 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneFour_strength"])) { $errors++; $errorlist .= "Class 14 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneFour_dexterity"])) { $errors++; $errorlist .= "Class 14 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneFour_spells"])) { $errors++; $errorlist .= "Class 14 Spells must be a number.<br />"; }

        if ($_POST["OneFive_exp"] == "") { $errors++; $errorlist .= "Class 15 Experience is required.<br />"; }
        if ($_POST["OneFive_hp"] == "") { $errors++; $errorlist .= "Class 15 HP is required.<br />"; }
        if ($_POST["OneFive_mp"] == "") { $errors++; $errorlist .= "Class 15 MP is required.<br />"; }
        if ($_POST["OneFive_tp"] == "") { $errors++; $errorlist .= "Class 15 TP is required.<br />"; }
        if ($_POST["OneFive_strength"] == "") { $errors++; $errorlist .= "Class 15 Strength is required.<br />"; }
        if ($_POST["OneFive_dexterity"] == "") { $errors++; $errorlist .= "Class 15 Dexterity is required.<br />"; }
        if ($_POST["OneFive_spells"] == "") { $errors++; $errorlist .= "Class 15 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneFive_exp"])) { $errors++; $errorlist .= "Class 15 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneFive_hp"])) { $errors++; $errorlist .= "Class 15 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneFive_mp"])) { $errors++; $errorlist .= "Class 15 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneFive_tp"])) { $errors++; $errorlist .= "Class 15 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneFive_strength"])) { $errors++; $errorlist .= "Class 15 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneFive_dexterity"])) { $errors++; $errorlist .= "Class 15 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneFive_spells"])) { $errors++; $errorlist .= "Class 15 Spells must be a number.<br />"; }	
		
        if ($_POST["OneSix_exp"] == "") { $errors++; $errorlist .= "Class 16 Experience is required.<br />"; }
        if ($_POST["OneSix_hp"] == "") { $errors++; $errorlist .= "Class 16 HP is required.<br />"; }
        if ($_POST["OneSix_mp"] == "") { $errors++; $errorlist .= "Class 16 MP is required.<br />"; }
        if ($_POST["OneSix_tp"] == "") { $errors++; $errorlist .= "Class 16 TP is required.<br />"; }
        if ($_POST["OneSix_strength"] == "") { $errors++; $errorlist .= "Class 16 Strength is required.<br />"; }
        if ($_POST["OneSix_dexterity"] == "") { $errors++; $errorlist .= "Class 16 Dexterity is required.<br />"; }
        if ($_POST["OneSix_spells"] == "") { $errors++; $errorlist .= "Class 16 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneSix_exp"])) { $errors++; $errorlist .= "Class 16 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneSix_hp"])) { $errors++; $errorlist .= "Class 16 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneSix_mp"])) { $errors++; $errorlist .= "Class 16 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneSix_tp"])) { $errors++; $errorlist .= "Class 16 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneSix_strength"])) { $errors++; $errorlist .= "Class 16 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneSix_dexterity"])) { $errors++; $errorlist .= "Class 16 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneSix_spells"])) { $errors++; $errorlist .= "Class 16 Spells must be a number.<br />"; }

        if ($_POST["OneSeven_exp"] == "") { $errors++; $errorlist .= "Class 17 Experience is required.<br />"; }
        if ($_POST["OneSeven_hp"] == "") { $errors++; $errorlist .= "Class 17 HP is required.<br />"; }
        if ($_POST["OneSeven_mp"] == "") { $errors++; $errorlist .= "Class 17 MP is required.<br />"; }
        if ($_POST["OneSeven_tp"] == "") { $errors++; $errorlist .= "Class 17 TP is required.<br />"; }
        if ($_POST["OneSeven_strength"] == "") { $errors++; $errorlist .= "Class 17 Strength is required.<br />"; }
        if ($_POST["OneSeven_dexterity"] == "") { $errors++; $errorlist .= "Class 17 Dexterity is required.<br />"; }
        if ($_POST["OneSeven_spells"] == "") { $errors++; $errorlist .= "Class 17 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneSeven_exp"])) { $errors++; $errorlist .= "Class 17 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneSeven_hp"])) { $errors++; $errorlist .= "Class 17 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneSeven_mp"])) { $errors++; $errorlist .= "Class 17 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneSeven_tp"])) { $errors++; $errorlist .= "Class 17 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneSeven_strength"])) { $errors++; $errorlist .= "Class 17 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneSeven_dexterity"])) { $errors++; $errorlist .= "Class 17 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneSeven_spells"])) { $errors++; $errorlist .= "Class 17 Spells must be a number.<br />"; }
                
        if ($_POST["OneEight_exp"] == "") { $errors++; $errorlist .= "Class 18 Experience is required.<br />"; }
        if ($_POST["OneEight_hp"] == "") { $errors++; $errorlist .= "Class 18 HP is required.<br />"; }
        if ($_POST["OneEight_mp"] == "") { $errors++; $errorlist .= "Class 18 MP is required.<br />"; }
        if ($_POST["OneEight_tp"] == "") { $errors++; $errorlist .= "Class 18 TP is required.<br />"; }
        if ($_POST["OneEight_strength"] == "") { $errors++; $errorlist .= "Class 18 Strength is required.<br />"; }
        if ($_POST["OneEight_dexterity"] == "") { $errors++; $errorlist .= "Class 18 Dexterity is required.<br />"; }
        if ($_POST["OneEight_spells"] == "") { $errors++; $errorlist .= "Class 18 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneEight_exp"])) { $errors++; $errorlist .= "Class 18 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneEight_hp"])) { $errors++; $errorlist .= "Class 18 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneEight_mp"])) { $errors++; $errorlist .= "Class 18 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneEight_tp"])) { $errors++; $errorlist .= "Class 18 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneEight_strength"])) { $errors++; $errorlist .= "Class 18 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneEight_dexterity"])) { $errors++; $errorlist .= "Class 18 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneEight_spells"])) { $errors++; $errorlist .= "Class 18 Spells must be a number.<br />"; }

        if ($_POST["OneNine_exp"] == "") { $errors++; $errorlist .= "Class 19 Experience is required.<br />"; }
        if ($_POST["OneNine_hp"] == "") { $errors++; $errorlist .= "Class 19 HP is required.<br />"; }
        if ($_POST["OneNine_mp"] == "") { $errors++; $errorlist .= "Class 19 MP is required.<br />"; }
        if ($_POST["OneNine_tp"] == "") { $errors++; $errorlist .= "Class 19 TP is required.<br />"; }
        if ($_POST["OneNine_strength"] == "") { $errors++; $errorlist .= "Class 19 Strength is required.<br />"; }
        if ($_POST["OneNine_dexterity"] == "") { $errors++; $errorlist .= "Class 19 Dexterity is required.<br />"; }
        if ($_POST["OneNine_spells"] == "") { $errors++; $errorlist .= "Class 19 Spells is required.<br />"; }
        if (!is_numeric($_POST["OneNine_exp"])) { $errors++; $errorlist .= "Class 19 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["OneNine_hp"])) { $errors++; $errorlist .= "Class 19 HP must be a number.<br />"; }
        if (!is_numeric($_POST["OneNine_mp"])) { $errors++; $errorlist .= "Class 19 MP must be a number.<br />"; }
        if (!is_numeric($_POST["OneNine_tp"])) { $errors++; $errorlist .= "Class 19 TP must be a number.<br />"; }
        if (!is_numeric($_POST["OneNine_strength"])) { $errors++; $errorlist .= "Class 19 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["OneNine_dexterity"])) { $errors++; $errorlist .= "Class 19 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["OneNine_spells"])) { $errors++; $errorlist .= "Class 19 Spells must be a number.<br />"; }

        if ($_POST["TwoZero_exp"] == "") { $errors++; $errorlist .= "Class 20 Experience is required.<br />"; }
        if ($_POST["TwoZero_hp"] == "") { $errors++; $errorlist .= "Class 20 HP is required.<br />"; }
        if ($_POST["TwoZero_mp"] == "") { $errors++; $errorlist .= "Class 20 MP is required.<br />"; }
        if ($_POST["TwoZero_tp"] == "") { $errors++; $errorlist .= "Class 20 TP is required.<br />"; }
        if ($_POST["TwoZero_strength"] == "") { $errors++; $errorlist .= "Class 20 Strength is required.<br />"; }
        if ($_POST["TwoZero_dexterity"] == "") { $errors++; $errorlist .= "Class 20 Dexterity is required.<br />"; }
        if ($_POST["TwoZero_spells"] == "") { $errors++; $errorlist .= "Class 20 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoZero_exp"])) { $errors++; $errorlist .= "Class 20 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoZero_hp"])) { $errors++; $errorlist .= "Class 20 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoZero_mp"])) { $errors++; $errorlist .= "Class 20 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoZero_tp"])) { $errors++; $errorlist .= "Class 20 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoZero_strength"])) { $errors++; $errorlist .= "Class 20 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoZero_dexterity"])) { $errors++; $errorlist .= "Class 20 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoZero_spells"])) { $errors++; $errorlist .= "Class 20 Spells must be a number.<br />"; }

        if ($_POST["TwoOne_exp"] == "") { $errors++; $errorlist .= "Class 21 Experience is required.<br />"; }
        if ($_POST["TwoOne_hp"] == "") { $errors++; $errorlist .= "Class 21 HP is required.<br />"; }
        if ($_POST["TwoOne_mp"] == "") { $errors++; $errorlist .= "Class 21 MP is required.<br />"; }
        if ($_POST["TwoOne_tp"] == "") { $errors++; $errorlist .= "Class 21 TP is required.<br />"; }
        if ($_POST["TwoOne_strength"] == "") { $errors++; $errorlist .= "Class 21 Strength is required.<br />"; }
        if ($_POST["TwoOne_dexterity"] == "") { $errors++; $errorlist .= "Class 21 Dexterity is required.<br />"; }
        if ($_POST["TwoOne_spells"] == "") { $errors++; $errorlist .= "Class 21 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoOne_exp"])) { $errors++; $errorlist .= "Class 21 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoOne_hp"])) { $errors++; $errorlist .= "Class 21 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoOne_mp"])) { $errors++; $errorlist .= "Class 21 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoOne_tp"])) { $errors++; $errorlist .= "Class 21 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoOne_strength"])) { $errors++; $errorlist .= "Class 21 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoOne_dexterity"])) { $errors++; $errorlist .= "Class 21 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoOne_spells"])) { $errors++; $errorlist .= "Class 21 Spells must be a number.<br />"; }

        if ($_POST["TwoTwo_exp"] == "") { $errors++; $errorlist .= "Class 22 Experience is required.<br />"; }
        if ($_POST["TwoTwo_hp"] == "") { $errors++; $errorlist .= "Class 22 HP is required.<br />"; }
        if ($_POST["TwoTwo_mp"] == "") { $errors++; $errorlist .= "Class 22 MP is required.<br />"; }
        if ($_POST["TwoTwo_tp"] == "") { $errors++; $errorlist .= "Class 22 TP is required.<br />"; }
        if ($_POST["TwoTwo_strength"] == "") { $errors++; $errorlist .= "Class 22 Strength is required.<br />"; }
        if ($_POST["TwoTwo_dexterity"] == "") { $errors++; $errorlist .= "Class 22 Dexterity is required.<br />"; }
        if ($_POST["TwoTwo_spells"] == "") { $errors++; $errorlist .= "Class 22 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoTwo_exp"])) { $errors++; $errorlist .= "Class 22 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoTwo_hp"])) { $errors++; $errorlist .= "Class 22 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoTwo_mp"])) { $errors++; $errorlist .= "Class 22 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoTwo_tp"])) { $errors++; $errorlist .= "Class 22 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoTwo_strength"])) { $errors++; $errorlist .= "Class 22 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoTwo_dexterity"])) { $errors++; $errorlist .= "Class 22 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoTwo_spells"])) { $errors++; $errorlist .= "Class 22 Spells must be a number.<br />"; }
                
        if ($_POST["TwoThree_exp"] == "") { $errors++; $errorlist .= "Class 23 Experience is required.<br />"; }
        if ($_POST["TwoThree_hp"] == "") { $errors++; $errorlist .= "Class 23 HP is required.<br />"; }
        if ($_POST["TwoThree_mp"] == "") { $errors++; $errorlist .= "Class 23 MP is required.<br />"; }
        if ($_POST["TwoThree_tp"] == "") { $errors++; $errorlist .= "Class 23 TP is required.<br />"; }
        if ($_POST["TwoThree_strength"] == "") { $errors++; $errorlist .= "Class 23 Strength is required.<br />"; }
        if ($_POST["TwoThree_dexterity"] == "") { $errors++; $errorlist .= "Class 23 Dexterity is required.<br />"; }
        if ($_POST["TwoThree_spells"] == "") { $errors++; $errorlist .= "Class 23 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoThree_exp"])) { $errors++; $errorlist .= "Class 23 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoThree_hp"])) { $errors++; $errorlist .= "Class 23 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoThree_mp"])) { $errors++; $errorlist .= "Class 23 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoThree_tp"])) { $errors++; $errorlist .= "Class 23 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoThree_strength"])) { $errors++; $errorlist .= "Class 23 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoThree_dexterity"])) { $errors++; $errorlist .= "Class 23 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoThree_spells"])) { $errors++; $errorlist .= "Class 23 Spells must be a number.<br />"; }
		
        if ($_POST["TwoFour_exp"] == "") { $errors++; $errorlist .= "Class 24 Experience is required.<br />"; }
        if ($_POST["TwoFour_hp"] == "") { $errors++; $errorlist .= "Class 24 HP is required.<br />"; }
        if ($_POST["TwoFour_mp"] == "") { $errors++; $errorlist .= "Class 24 MP is required.<br />"; }
        if ($_POST["TwoFour_tp"] == "") { $errors++; $errorlist .= "Class 24 TP is required.<br />"; }
        if ($_POST["TwoFour_strength"] == "") { $errors++; $errorlist .= "Class 24 Strength is required.<br />"; }
        if ($_POST["TwoFour_dexterity"] == "") { $errors++; $errorlist .= "Class 24 Dexterity is required.<br />"; }
        if ($_POST["TwoFour_spells"] == "") { $errors++; $errorlist .= "Class 24 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoFour_exp"])) { $errors++; $errorlist .= "Class 24 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFour_hp"])) { $errors++; $errorlist .= "Class 24 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFour_mp"])) { $errors++; $errorlist .= "Class 24 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFour_tp"])) { $errors++; $errorlist .= "Class 24 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFour_strength"])) { $errors++; $errorlist .= "Class 24 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFour_dexterity"])) { $errors++; $errorlist .= "Class 24 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFour_spells"])) { $errors++; $errorlist .= "Class 24 Spells must be a number.<br />"; }

        if ($_POST["TwoFive_exp"] == "") { $errors++; $errorlist .= "Class 25 Experience is required.<br />"; }
        if ($_POST["TwoFive_hp"] == "") { $errors++; $errorlist .= "Class 25 HP is required.<br />"; }
        if ($_POST["TwoFive_mp"] == "") { $errors++; $errorlist .= "Class 25 MP is required.<br />"; }
        if ($_POST["TwoFive_tp"] == "") { $errors++; $errorlist .= "Class 25 TP is required.<br />"; }
        if ($_POST["TwoFive_strength"] == "") { $errors++; $errorlist .= "Class 25 Strength is required.<br />"; }
        if ($_POST["TwoFive_dexterity"] == "") { $errors++; $errorlist .= "Class 25 Dexterity is required.<br />"; }
        if ($_POST["TwoFive_spells"] == "") { $errors++; $errorlist .= "Class 25 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoFive_exp"])) { $errors++; $errorlist .= "Class 25 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFive_hp"])) { $errors++; $errorlist .= "Class 25 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFive_mp"])) { $errors++; $errorlist .= "Class 25 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFive_tp"])) { $errors++; $errorlist .= "Class 25 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFive_strength"])) { $errors++; $errorlist .= "Class 25 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFive_dexterity"])) { $errors++; $errorlist .= "Class 25 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoFive_spells"])) { $errors++; $errorlist .= "Class 25 Spells must be a number.<br />"; }	
		
        if ($_POST["TwoSix_exp"] == "") { $errors++; $errorlist .= "Class 26 Experience is required.<br />"; }
        if ($_POST["TwoSix_hp"] == "") { $errors++; $errorlist .= "Class 26 HP is required.<br />"; }
        if ($_POST["TwoSix_mp"] == "") { $errors++; $errorlist .= "Class 26 MP is required.<br />"; }
        if ($_POST["TwoSix_tp"] == "") { $errors++; $errorlist .= "Class 26 TP is required.<br />"; }
        if ($_POST["TwoSix_strength"] == "") { $errors++; $errorlist .= "Class 26 Strength is required.<br />"; }
        if ($_POST["TwoSix_dexterity"] == "") { $errors++; $errorlist .= "Class 26 Dexterity is required.<br />"; }
        if ($_POST["TwoSix_spells"] == "") { $errors++; $errorlist .= "Class 26 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoSix_exp"])) { $errors++; $errorlist .= "Class 26 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSix_hp"])) { $errors++; $errorlist .= "Class 26 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSix_mp"])) { $errors++; $errorlist .= "Class 26 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSix_tp"])) { $errors++; $errorlist .= "Class 26 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSix_strength"])) { $errors++; $errorlist .= "Class 26 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSix_dexterity"])) { $errors++; $errorlist .= "Class 26 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSix_spells"])) { $errors++; $errorlist .= "Class 26 Spells must be a number.<br />"; }

        if ($_POST["TwoSeven_exp"] == "") { $errors++; $errorlist .= "Class 27 Experience is required.<br />"; }
        if ($_POST["TwoSeven_hp"] == "") { $errors++; $errorlist .= "Class 27 HP is required.<br />"; }
        if ($_POST["TwoSeven_mp"] == "") { $errors++; $errorlist .= "Class 27 MP is required.<br />"; }
        if ($_POST["TwoSeven_tp"] == "") { $errors++; $errorlist .= "Class 27 TP is required.<br />"; }
        if ($_POST["TwoSeven_strength"] == "") { $errors++; $errorlist .= "Class 27 Strength is required.<br />"; }
        if ($_POST["TwoSeven_dexterity"] == "") { $errors++; $errorlist .= "Class 27 Dexterity is required.<br />"; }
        if ($_POST["TwoSeven_spells"] == "") { $errors++; $errorlist .= "Class 27 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoSeven_exp"])) { $errors++; $errorlist .= "Class 27 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSeven_hp"])) { $errors++; $errorlist .= "Class 27 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSeven_mp"])) { $errors++; $errorlist .= "Class 27 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSeven_tp"])) { $errors++; $errorlist .= "Class 27 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSeven_strength"])) { $errors++; $errorlist .= "Class 27 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSeven_dexterity"])) { $errors++; $errorlist .= "Class 27 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoSeven_spells"])) { $errors++; $errorlist .= "Class 27 Spells must be a number.<br />"; }
                
        if ($_POST["TwoEight_exp"] == "") { $errors++; $errorlist .= "Class 28 Experience is required.<br />"; }
        if ($_POST["TwoEight_hp"] == "") { $errors++; $errorlist .= "Class 28 HP is required.<br />"; }
        if ($_POST["TwoEight_mp"] == "") { $errors++; $errorlist .= "Class 28 MP is required.<br />"; }
        if ($_POST["TwoEight_tp"] == "") { $errors++; $errorlist .= "Class 28 TP is required.<br />"; }
        if ($_POST["TwoEight_strength"] == "") { $errors++; $errorlist .= "Class 28 Strength is required.<br />"; }
        if ($_POST["TwoEight_dexterity"] == "") { $errors++; $errorlist .= "Class 28 Dexterity is required.<br />"; }
        if ($_POST["TwoEight_spells"] == "") { $errors++; $errorlist .= "Class 28 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoEight_exp"])) { $errors++; $errorlist .= "Class 28 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoEight_hp"])) { $errors++; $errorlist .= "Class 28 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoEight_mp"])) { $errors++; $errorlist .= "Class 28 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoEight_tp"])) { $errors++; $errorlist .= "Class 28 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoEight_strength"])) { $errors++; $errorlist .= "Class 28 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoEight_dexterity"])) { $errors++; $errorlist .= "Class 28 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoEight_spells"])) { $errors++; $errorlist .= "Class 28 Spells must be a number.<br />"; }

        if ($_POST["TwoNine_exp"] == "") { $errors++; $errorlist .= "Class 29 Experience is required.<br />"; }
        if ($_POST["TwoNine_hp"] == "") { $errors++; $errorlist .= "Class 29 HP is required.<br />"; }
        if ($_POST["TwoNine_mp"] == "") { $errors++; $errorlist .= "Class 29 MP is required.<br />"; }
        if ($_POST["TwoNine_tp"] == "") { $errors++; $errorlist .= "Class 29 TP is required.<br />"; }
        if ($_POST["TwoNine_strength"] == "") { $errors++; $errorlist .= "Class 29 Strength is required.<br />"; }
        if ($_POST["TwoNine_dexterity"] == "") { $errors++; $errorlist .= "Class 29 Dexterity is required.<br />"; }
        if ($_POST["TwoNine_spells"] == "") { $errors++; $errorlist .= "Class 29 Spells is required.<br />"; }
        if (!is_numeric($_POST["TwoNine_exp"])) { $errors++; $errorlist .= "Class 29 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["TwoNine_hp"])) { $errors++; $errorlist .= "Class 29 HP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoNine_mp"])) { $errors++; $errorlist .= "Class 29 MP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoNine_tp"])) { $errors++; $errorlist .= "Class 29 TP must be a number.<br />"; }
        if (!is_numeric($_POST["TwoNine_strength"])) { $errors++; $errorlist .= "Class 29 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["TwoNine_dexterity"])) { $errors++; $errorlist .= "Class 29 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["TwoNine_spells"])) { $errors++; $errorlist .= "Class 29 Spells must be a number.<br />"; }

        if ($_POST["ThreeZero_exp"] == "") { $errors++; $errorlist .= "Class 30 Experience is required.<br />"; }
        if ($_POST["ThreeZero_hp"] == "") { $errors++; $errorlist .= "Class 30 HP is required.<br />"; }
        if ($_POST["ThreeZero_mp"] == "") { $errors++; $errorlist .= "Class 30 MP is required.<br />"; }
        if ($_POST["ThreeZero_tp"] == "") { $errors++; $errorlist .= "Class 30 TP is required.<br />"; }
        if ($_POST["ThreeZero_strength"] == "") { $errors++; $errorlist .= "Class 30 Strength is required.<br />"; }
        if ($_POST["ThreeZero_dexterity"] == "") { $errors++; $errorlist .= "Class 30 Dexterity is required.<br />"; }
        if ($_POST["ThreeZero_spells"] == "") { $errors++; $errorlist .= "Class 30 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeZero_exp"])) { $errors++; $errorlist .= "Class 30 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeZero_hp"])) { $errors++; $errorlist .= "Class 30 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeZero_mp"])) { $errors++; $errorlist .= "Class 30 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeZero_tp"])) { $errors++; $errorlist .= "Class 30 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeZero_strength"])) { $errors++; $errorlist .= "Class 30 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeZero_dexterity"])) { $errors++; $errorlist .= "Class 30 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeZero_spells"])) { $errors++; $errorlist .= "Class 30 Spells must be a number.<br />"; }

        if ($_POST["ThreeOne_exp"] == "") { $errors++; $errorlist .= "Class 31 Experience is required.<br />"; }
        if ($_POST["ThreeOne_hp"] == "") { $errors++; $errorlist .= "Class 31 HP is required.<br />"; }
        if ($_POST["ThreeOne_mp"] == "") { $errors++; $errorlist .= "Class 31 MP is required.<br />"; }
        if ($_POST["ThreeOne_tp"] == "") { $errors++; $errorlist .= "Class 31 TP is required.<br />"; }
        if ($_POST["ThreeOne_strength"] == "") { $errors++; $errorlist .= "Class 31 Strength is required.<br />"; }
        if ($_POST["ThreeOne_dexterity"] == "") { $errors++; $errorlist .= "Class 31 Dexterity is required.<br />"; }
        if ($_POST["ThreeOne_spells"] == "") { $errors++; $errorlist .= "Class 31 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeOne_exp"])) { $errors++; $errorlist .= "Class 31 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeOne_hp"])) { $errors++; $errorlist .= "Class 31 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeOne_mp"])) { $errors++; $errorlist .= "Class 31 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeOne_tp"])) { $errors++; $errorlist .= "Class 31 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeOne_strength"])) { $errors++; $errorlist .= "Class 31 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeOne_dexterity"])) { $errors++; $errorlist .= "Class 31 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeOne_spells"])) { $errors++; $errorlist .= "Class 31 Spells must be a number.<br />"; }

        if ($_POST["ThreeTwo_exp"] == "") { $errors++; $errorlist .= "Class 32 Experience is required.<br />"; }
        if ($_POST["ThreeTwo_hp"] == "") { $errors++; $errorlist .= "Class 32 HP is required.<br />"; }
        if ($_POST["ThreeTwo_mp"] == "") { $errors++; $errorlist .= "Class 32 MP is required.<br />"; }
        if ($_POST["ThreeTwo_tp"] == "") { $errors++; $errorlist .= "Class 32 TP is required.<br />"; }
        if ($_POST["ThreeTwo_strength"] == "") { $errors++; $errorlist .= "Class 32 Strength is required.<br />"; }
        if ($_POST["ThreeTwo_dexterity"] == "") { $errors++; $errorlist .= "Class 32 Dexterity is required.<br />"; }
        if ($_POST["ThreeTwo_spells"] == "") { $errors++; $errorlist .= "Class 32 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_exp"])) { $errors++; $errorlist .= "Class 32 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_hp"])) { $errors++; $errorlist .= "Class 32 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_mp"])) { $errors++; $errorlist .= "Class 32 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_tp"])) { $errors++; $errorlist .= "Class 32 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_strength"])) { $errors++; $errorlist .= "Class 32 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_dexterity"])) { $errors++; $errorlist .= "Class 32 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeTwo_spells"])) { $errors++; $errorlist .= "Class 32 Spells must be a number.<br />"; }
                
        if ($_POST["ThreeThree_exp"] == "") { $errors++; $errorlist .= "Class 33 Experience is required.<br />"; }
        if ($_POST["ThreeThree_hp"] == "") { $errors++; $errorlist .= "Class 33 HP is required.<br />"; }
        if ($_POST["ThreeThree_mp"] == "") { $errors++; $errorlist .= "Class 33 MP is required.<br />"; }
        if ($_POST["ThreeThree_tp"] == "") { $errors++; $errorlist .= "Class 33 TP is required.<br />"; }
        if ($_POST["ThreeThree_strength"] == "") { $errors++; $errorlist .= "Class 33 Strength is required.<br />"; }
        if ($_POST["ThreeThree_dexterity"] == "") { $errors++; $errorlist .= "Class 33 Dexterity is required.<br />"; }
        if ($_POST["ThreeThree_spells"] == "") { $errors++; $errorlist .= "Class 33 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeThree_exp"])) { $errors++; $errorlist .= "Class 33 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeThree_hp"])) { $errors++; $errorlist .= "Class 33 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeThree_mp"])) { $errors++; $errorlist .= "Class 33 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeThree_tp"])) { $errors++; $errorlist .= "Class 33 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeThree_strength"])) { $errors++; $errorlist .= "Class 33 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeThree_dexterity"])) { $errors++; $errorlist .= "Class 33 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeThree_spells"])) { $errors++; $errorlist .= "Class 33 Spells must be a number.<br />"; }
		
        if ($_POST["ThreeFour_exp"] == "") { $errors++; $errorlist .= "Class 34 Experience is required.<br />"; }
        if ($_POST["ThreeFour_hp"] == "") { $errors++; $errorlist .= "Class 34 HP is required.<br />"; }
        if ($_POST["ThreeFour_mp"] == "") { $errors++; $errorlist .= "Class 34 MP is required.<br />"; }
        if ($_POST["ThreeFour_tp"] == "") { $errors++; $errorlist .= "Class 34 TP is required.<br />"; }
        if ($_POST["ThreeFour_strength"] == "") { $errors++; $errorlist .= "Class 34 Strength is required.<br />"; }
        if ($_POST["ThreeFour_dexterity"] == "") { $errors++; $errorlist .= "Class 34 Dexterity is required.<br />"; }
        if ($_POST["ThreeFour_spells"] == "") { $errors++; $errorlist .= "Class 34 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeFour_exp"])) { $errors++; $errorlist .= "Class 34 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFour_hp"])) { $errors++; $errorlist .= "Class 34 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFour_mp"])) { $errors++; $errorlist .= "Class 34 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFour_tp"])) { $errors++; $errorlist .= "Class 34 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFour_strength"])) { $errors++; $errorlist .= "Class 34 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFour_dexterity"])) { $errors++; $errorlist .= "Class 34 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFour_spells"])) { $errors++; $errorlist .= "Class 34 Spells must be a number.<br />"; }

        if ($_POST["ThreeFive_exp"] == "") { $errors++; $errorlist .= "Class 35 Experience is required.<br />"; }
        if ($_POST["ThreeFive_hp"] == "") { $errors++; $errorlist .= "Class 35 HP is required.<br />"; }
        if ($_POST["ThreeFive_mp"] == "") { $errors++; $errorlist .= "Class 35 MP is required.<br />"; }
        if ($_POST["ThreeFive_tp"] == "") { $errors++; $errorlist .= "Class 35 TP is required.<br />"; }
        if ($_POST["ThreeFive_strength"] == "") { $errors++; $errorlist .= "Class 35 Strength is required.<br />"; }
        if ($_POST["ThreeFive_dexterity"] == "") { $errors++; $errorlist .= "Class 35 Dexterity is required.<br />"; }
        if ($_POST["ThreeFive_spells"] == "") { $errors++; $errorlist .= "Class 35 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeFive_exp"])) { $errors++; $errorlist .= "Class 35 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFive_hp"])) { $errors++; $errorlist .= "Class 35 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFive_mp"])) { $errors++; $errorlist .= "Class 35 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFive_tp"])) { $errors++; $errorlist .= "Class 35 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFive_strength"])) { $errors++; $errorlist .= "Class 35 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFive_dexterity"])) { $errors++; $errorlist .= "Class 35 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeFive_spells"])) { $errors++; $errorlist .= "Class 35 Spells must be a number.<br />"; }	
		
        if ($_POST["ThreeSix_exp"] == "") { $errors++; $errorlist .= "Class 36 Experience is required.<br />"; }
        if ($_POST["ThreeSix_hp"] == "") { $errors++; $errorlist .= "Class 36 HP is required.<br />"; }
        if ($_POST["ThreeSix_mp"] == "") { $errors++; $errorlist .= "Class 36 MP is required.<br />"; }
        if ($_POST["ThreeSix_tp"] == "") { $errors++; $errorlist .= "Class 36 TP is required.<br />"; }
        if ($_POST["ThreeSix_strength"] == "") { $errors++; $errorlist .= "Class 36 Strength is required.<br />"; }
        if ($_POST["ThreeSix_dexterity"] == "") { $errors++; $errorlist .= "Class 36 Dexterity is required.<br />"; }
        if ($_POST["ThreeSix_spells"] == "") { $errors++; $errorlist .= "Class 36 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeSix_exp"])) { $errors++; $errorlist .= "Class 36 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSix_hp"])) { $errors++; $errorlist .= "Class 36 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSix_mp"])) { $errors++; $errorlist .= "Class 36 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSix_tp"])) { $errors++; $errorlist .= "Class 36 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSix_strength"])) { $errors++; $errorlist .= "Class 36 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSix_dexterity"])) { $errors++; $errorlist .= "Class 36 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSix_spells"])) { $errors++; $errorlist .= "Class 36 Spells must be a number.<br />"; }

        if ($_POST["ThreeSeven_exp"] == "") { $errors++; $errorlist .= "Class 37 Experience is required.<br />"; }
        if ($_POST["ThreeSeven_hp"] == "") { $errors++; $errorlist .= "Class 37 HP is required.<br />"; }
        if ($_POST["ThreeSeven_mp"] == "") { $errors++; $errorlist .= "Class 37 MP is required.<br />"; }
        if ($_POST["ThreeSeven_tp"] == "") { $errors++; $errorlist .= "Class 37 TP is required.<br />"; }
        if ($_POST["ThreeSeven_strength"] == "") { $errors++; $errorlist .= "Class 37 Strength is required.<br />"; }
        if ($_POST["ThreeSeven_dexterity"] == "") { $errors++; $errorlist .= "Class 37 Dexterity is required.<br />"; }
        if ($_POST["ThreeSeven_spells"] == "") { $errors++; $errorlist .= "Class 37 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_exp"])) { $errors++; $errorlist .= "Class 37 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_hp"])) { $errors++; $errorlist .= "Class 37 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_mp"])) { $errors++; $errorlist .= "Class 37 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_tp"])) { $errors++; $errorlist .= "Class 37 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_strength"])) { $errors++; $errorlist .= "Class 37 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_dexterity"])) { $errors++; $errorlist .= "Class 37 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeSeven_spells"])) { $errors++; $errorlist .= "Class 37 Spells must be a number.<br />"; }
                
        if ($_POST["ThreeEight_exp"] == "") { $errors++; $errorlist .= "Class 38 Experience is required.<br />"; }
        if ($_POST["ThreeEight_hp"] == "") { $errors++; $errorlist .= "Class 38 HP is required.<br />"; }
        if ($_POST["ThreeEight_mp"] == "") { $errors++; $errorlist .= "Class 38 MP is required.<br />"; }
        if ($_POST["ThreeEight_tp"] == "") { $errors++; $errorlist .= "Class 38 TP is required.<br />"; }
        if ($_POST["ThreeEight_strength"] == "") { $errors++; $errorlist .= "Class 38 Strength is required.<br />"; }
        if ($_POST["ThreeEight_dexterity"] == "") { $errors++; $errorlist .= "Class 38 Dexterity is required.<br />"; }
        if ($_POST["ThreeEight_spells"] == "") { $errors++; $errorlist .= "Class 38 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeEight_exp"])) { $errors++; $errorlist .= "Class 38 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeEight_hp"])) { $errors++; $errorlist .= "Class 38 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeEight_mp"])) { $errors++; $errorlist .= "Class 38 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeEight_tp"])) { $errors++; $errorlist .= "Class 38 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeEight_strength"])) { $errors++; $errorlist .= "Class 38 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeEight_dexterity"])) { $errors++; $errorlist .= "Class 38 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeEight_spells"])) { $errors++; $errorlist .= "Class 38 Spells must be a number.<br />"; }

        if ($_POST["ThreeNine_exp"] == "") { $errors++; $errorlist .= "Class 39 Experience is required.<br />"; }
        if ($_POST["ThreeNine_hp"] == "") { $errors++; $errorlist .= "Class 39 HP is required.<br />"; }
        if ($_POST["ThreeNine_mp"] == "") { $errors++; $errorlist .= "Class 39 MP is required.<br />"; }
        if ($_POST["ThreeNine_tp"] == "") { $errors++; $errorlist .= "Class 39 TP is required.<br />"; }
        if ($_POST["ThreeNine_strength"] == "") { $errors++; $errorlist .= "Class 39 Strength is required.<br />"; }
        if ($_POST["ThreeNine_dexterity"] == "") { $errors++; $errorlist .= "Class 39 Dexterity is required.<br />"; }
        if ($_POST["ThreeNine_spells"] == "") { $errors++; $errorlist .= "Class 39 Spells is required.<br />"; }
        if (!is_numeric($_POST["ThreeNine_exp"])) { $errors++; $errorlist .= "Class 39 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeNine_hp"])) { $errors++; $errorlist .= "Class 39 HP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeNine_mp"])) { $errors++; $errorlist .= "Class 39 MP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeNine_tp"])) { $errors++; $errorlist .= "Class 39 TP must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeNine_strength"])) { $errors++; $errorlist .= "Class 39 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeNine_dexterity"])) { $errors++; $errorlist .= "Class 39 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["ThreeNine_spells"])) { $errors++; $errorlist .= "Class 39 Spells must be a number.<br />"; }

        if ($_POST["FourZero_exp"] == "") { $errors++; $errorlist .= "Class 40 Experience is required.<br />"; }
        if ($_POST["FourZero_hp"] == "") { $errors++; $errorlist .= "Class 40 HP is required.<br />"; }
        if ($_POST["FourZero_mp"] == "") { $errors++; $errorlist .= "Class 40 MP is required.<br />"; }
        if ($_POST["FourZero_tp"] == "") { $errors++; $errorlist .= "Class 40 TP is required.<br />"; }
        if ($_POST["FourZero_strength"] == "") { $errors++; $errorlist .= "Class 40 Strength is required.<br />"; }
        if ($_POST["FourZero_dexterity"] == "") { $errors++; $errorlist .= "Class 40 Dexterity is required.<br />"; }
        if ($_POST["FourZero_spells"] == "") { $errors++; $errorlist .= "Class 40 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourZero_exp"])) { $errors++; $errorlist .= "Class 40 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourZero_hp"])) { $errors++; $errorlist .= "Class 40 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourZero_mp"])) { $errors++; $errorlist .= "Class 40 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourZero_tp"])) { $errors++; $errorlist .= "Class 40 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourZero_strength"])) { $errors++; $errorlist .= "Class 40 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourZero_dexterity"])) { $errors++; $errorlist .= "Class 40 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourZero_spells"])) { $errors++; $errorlist .= "Class 40 Spells must be a number.<br />"; }

        if ($_POST["FourOne_exp"] == "") { $errors++; $errorlist .= "Class 41 Experience is required.<br />"; }
        if ($_POST["FourOne_hp"] == "") { $errors++; $errorlist .= "Class 41 HP is required.<br />"; }
        if ($_POST["FourOne_mp"] == "") { $errors++; $errorlist .= "Class 41 MP is required.<br />"; }
        if ($_POST["FourOne_tp"] == "") { $errors++; $errorlist .= "Class 41 TP is required.<br />"; }
        if ($_POST["FourOne_strength"] == "") { $errors++; $errorlist .= "Class 41 Strength is required.<br />"; }
        if ($_POST["FourOne_dexterity"] == "") { $errors++; $errorlist .= "Class 41 Dexterity is required.<br />"; }
        if ($_POST["FourOne_spells"] == "") { $errors++; $errorlist .= "Class 41 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourOne_exp"])) { $errors++; $errorlist .= "Class 41 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourOne_hp"])) { $errors++; $errorlist .= "Class 41 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourOne_mp"])) { $errors++; $errorlist .= "Class 41 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourOne_tp"])) { $errors++; $errorlist .= "Class 41 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourOne_strength"])) { $errors++; $errorlist .= "Class 41 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourOne_dexterity"])) { $errors++; $errorlist .= "Class 41 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourOne_spells"])) { $errors++; $errorlist .= "Class 41 Spells must be a number.<br />"; }

        if ($_POST["FourTwo_exp"] == "") { $errors++; $errorlist .= "Class 42 Experience is required.<br />"; }
        if ($_POST["FourTwo_hp"] == "") { $errors++; $errorlist .= "Class 42 HP is required.<br />"; }
        if ($_POST["FourTwo_mp"] == "") { $errors++; $errorlist .= "Class 42 MP is required.<br />"; }
        if ($_POST["FourTwo_tp"] == "") { $errors++; $errorlist .= "Class 42 TP is required.<br />"; }
        if ($_POST["FourTwo_strength"] == "") { $errors++; $errorlist .= "Class 42 Strength is required.<br />"; }
        if ($_POST["FourTwo_dexterity"] == "") { $errors++; $errorlist .= "Class 42 Dexterity is required.<br />"; }
        if ($_POST["FourTwo_spells"] == "") { $errors++; $errorlist .= "Class 42 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourTwo_exp"])) { $errors++; $errorlist .= "Class 42 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourTwo_hp"])) { $errors++; $errorlist .= "Class 42 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourTwo_mp"])) { $errors++; $errorlist .= "Class 42 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourTwo_tp"])) { $errors++; $errorlist .= "Class 42 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourTwo_strength"])) { $errors++; $errorlist .= "Class 42 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourTwo_dexterity"])) { $errors++; $errorlist .= "Class 42 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourTwo_spells"])) { $errors++; $errorlist .= "Class 42 Spells must be a number.<br />"; }
                
        if ($_POST["FourThree_exp"] == "") { $errors++; $errorlist .= "Class 43 Experience is required.<br />"; }
        if ($_POST["FourThree_hp"] == "") { $errors++; $errorlist .= "Class 43 HP is required.<br />"; }
        if ($_POST["FourThree_mp"] == "") { $errors++; $errorlist .= "Class 43 MP is required.<br />"; }
        if ($_POST["FourThree_tp"] == "") { $errors++; $errorlist .= "Class 43 TP is required.<br />"; }
        if ($_POST["FourThree_strength"] == "") { $errors++; $errorlist .= "Class 43 Strength is required.<br />"; }
        if ($_POST["FourThree_dexterity"] == "") { $errors++; $errorlist .= "Class 43 Dexterity is required.<br />"; }
        if ($_POST["FourThree_spells"] == "") { $errors++; $errorlist .= "Class 43 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourThree_exp"])) { $errors++; $errorlist .= "Class 43 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourThree_hp"])) { $errors++; $errorlist .= "Class 43 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourThree_mp"])) { $errors++; $errorlist .= "Class 43 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourThree_tp"])) { $errors++; $errorlist .= "Class 43 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourThree_strength"])) { $errors++; $errorlist .= "Class 43 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourThree_dexterity"])) { $errors++; $errorlist .= "Class 43 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourThree_spells"])) { $errors++; $errorlist .= "Class 43 Spells must be a number.<br />"; }
		
        if ($_POST["FourFour_exp"] == "") { $errors++; $errorlist .= "Class 44 Experience is required.<br />"; }
        if ($_POST["FourFour_hp"] == "") { $errors++; $errorlist .= "Class 44 HP is required.<br />"; }
        if ($_POST["FourFour_mp"] == "") { $errors++; $errorlist .= "Class 44 MP is required.<br />"; }
        if ($_POST["FourFour_tp"] == "") { $errors++; $errorlist .= "Class 44 TP is required.<br />"; }
        if ($_POST["FourFour_strength"] == "") { $errors++; $errorlist .= "Class 44 Strength is required.<br />"; }
        if ($_POST["FourFour_dexterity"] == "") { $errors++; $errorlist .= "Class 44 Dexterity is required.<br />"; }
        if ($_POST["FourFour_spells"] == "") { $errors++; $errorlist .= "Class 44 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourFour_exp"])) { $errors++; $errorlist .= "Class 44 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourFour_hp"])) { $errors++; $errorlist .= "Class 44 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourFour_mp"])) { $errors++; $errorlist .= "Class 44 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourFour_tp"])) { $errors++; $errorlist .= "Class 44 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourFour_strength"])) { $errors++; $errorlist .= "Class 44 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourFour_dexterity"])) { $errors++; $errorlist .= "Class 44 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourFour_spells"])) { $errors++; $errorlist .= "Class 44 Spells must be a number.<br />"; }

        if ($_POST["FourFive_exp"] == "") { $errors++; $errorlist .= "Class 45 Experience is required.<br />"; }
        if ($_POST["FourFive_hp"] == "") { $errors++; $errorlist .= "Class 45 HP is required.<br />"; }
        if ($_POST["FourFive_mp"] == "") { $errors++; $errorlist .= "Class 45 MP is required.<br />"; }
        if ($_POST["FourFive_tp"] == "") { $errors++; $errorlist .= "Class 45 TP is required.<br />"; }
        if ($_POST["FourFive_strength"] == "") { $errors++; $errorlist .= "Class 45 Strength is required.<br />"; }
        if ($_POST["FourFive_dexterity"] == "") { $errors++; $errorlist .= "Class 45 Dexterity is required.<br />"; }
        if ($_POST["FourFive_spells"] == "") { $errors++; $errorlist .= "Class 45 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourFive_exp"])) { $errors++; $errorlist .= "Class 45 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourFive_hp"])) { $errors++; $errorlist .= "Class 45 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourFive_mp"])) { $errors++; $errorlist .= "Class 45 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourFive_tp"])) { $errors++; $errorlist .= "Class 45 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourFive_strength"])) { $errors++; $errorlist .= "Class 45 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourFive_dexterity"])) { $errors++; $errorlist .= "Class 45 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourFive_spells"])) { $errors++; $errorlist .= "Class 45 Spells must be a number.<br />"; }	
	
        if ($_POST["FourSix_exp"] == "") { $errors++; $errorlist .= "Class 46 Experience is required.<br />"; }
        if ($_POST["FourSix_hp"] == "") { $errors++; $errorlist .= "Class 46 HP is required.<br />"; }
        if ($_POST["FourSix_mp"] == "") { $errors++; $errorlist .= "Class 46 MP is required.<br />"; }
        if ($_POST["FourSix_tp"] == "") { $errors++; $errorlist .= "Class 46 TP is required.<br />"; }
        if ($_POST["FourSix_strength"] == "") { $errors++; $errorlist .= "Class 46 Strength is required.<br />"; }
		
        if ($_POST["FourSix_spells"] == "") { $errors++; $errorlist .= "Class 46 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourSix_exp"])) { $errors++; $errorlist .= "Class 46 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourSix_hp"])) { $errors++; $errorlist .= "Class 46 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourSix_mp"])) { $errors++; $errorlist .= "Class 46 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourSix_tp"])) { $errors++; $errorlist .= "Class 46 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourSix_strength"])) { $errors++; $errorlist .= "Class 46 Strength must be a number.<br />"; }
		
        if (!is_numeric($_POST["FourSix_spells"])) { $errors++; $errorlist .= "Class 46 Spells must be a number.<br />"; } 
		
        if ($_POST["FourSeven_exp"] == "") { $errors++; $errorlist .= "Class 47 Experience is required.<br />"; }
        if ($_POST["FourSeven_hp"] == "") { $errors++; $errorlist .= "Class 47 HP is required.<br />"; }
        if ($_POST["FourSeven_mp"] == "") { $errors++; $errorlist .= "Class 47 MP is required.<br />"; }
        if ($_POST["FourSeven_tp"] == "") { $errors++; $errorlist .= "Class 47 TP is required.<br />"; }
        if ($_POST["FourSeven_strength"] == "") { $errors++; $errorlist .= "Class 47 Strength is required.<br />"; }
        if ($_POST["FourSeven_dexterity"] == "") { $errors++; $errorlist .= "Class 47 Dexterity is required.<br />"; }
        if ($_POST["FourSeven_spells"] == "") { $errors++; $errorlist .= "Class 47 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourSeven_exp"])) { $errors++; $errorlist .= "Class 47 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourSeven_hp"])) { $errors++; $errorlist .= "Class 47 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourSeven_mp"])) { $errors++; $errorlist .= "Class 47 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourSeven_tp"])) { $errors++; $errorlist .= "Class 47 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourSeven_strength"])) { $errors++; $errorlist .= "Class 47 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourSeven_dexterity"])) { $errors++; $errorlist .= "Class 47 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourSeven_spells"])) { $errors++; $errorlist .= "Class 47 Spells must be a number.<br />"; }
                
        if ($_POST["FourEight_exp"] == "") { $errors++; $errorlist .= "Class 48 Experience is required.<br />"; }
        if ($_POST["FourEight_hp"] == "") { $errors++; $errorlist .= "Class 48 HP is required.<br />"; }
        if ($_POST["FourEight_mp"] == "") { $errors++; $errorlist .= "Class 48 MP is required.<br />"; }
        if ($_POST["FourEight_tp"] == "") { $errors++; $errorlist .= "Class 48 TP is required.<br />"; }
        if ($_POST["FourEight_strength"] == "") { $errors++; $errorlist .= "Class 48 Strength is required.<br />"; }
        if ($_POST["FourEight_dexterity"] == "") { $errors++; $errorlist .= "Class 48 Dexterity is required.<br />"; }
        if ($_POST["FourEight_spells"] == "") { $errors++; $errorlist .= "Class 48 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourEight_exp"])) { $errors++; $errorlist .= "Class 48 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourEight_hp"])) { $errors++; $errorlist .= "Class 48 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourEight_mp"])) { $errors++; $errorlist .= "Class 48 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourEight_tp"])) { $errors++; $errorlist .= "Class 48 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourEight_strength"])) { $errors++; $errorlist .= "Class 48 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourEight_dexterity"])) { $errors++; $errorlist .= "Class 48 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourEight_spells"])) { $errors++; $errorlist .= "Class 48 Spells must be a number.<br />"; }

        if ($_POST["FourNine_exp"] == "") { $errors++; $errorlist .= "Class 49 Experience is required.<br />"; }
        if ($_POST["FourNine_hp"] == "") { $errors++; $errorlist .= "Class 49 HP is required.<br />"; }
        if ($_POST["FourNine_mp"] == "") { $errors++; $errorlist .= "Class 49 MP is required.<br />"; }
        if ($_POST["FourNine_tp"] == "") { $errors++; $errorlist .= "Class 49 TP is required.<br />"; }
        if ($_POST["FourNine_strength"] == "") { $errors++; $errorlist .= "Class 49 Strength is required.<br />"; }
        if ($_POST["FourNine_dexterity"] == "") { $errors++; $errorlist .= "Class 49 Dexterity is required.<br />"; }
        if ($_POST["FourNine_spells"] == "") { $errors++; $errorlist .= "Class 49 Spells is required.<br />"; }
        if (!is_numeric($_POST["FourNine_exp"])) { $errors++; $errorlist .= "Class 49 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FourNine_hp"])) { $errors++; $errorlist .= "Class 49 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FourNine_mp"])) { $errors++; $errorlist .= "Class 49 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FourNine_tp"])) { $errors++; $errorlist .= "Class 49 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FourNine_strength"])) { $errors++; $errorlist .= "Class 49 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FourNine_dexterity"])) { $errors++; $errorlist .= "Class 49 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FourNine_spells"])) { $errors++; $errorlist .= "Class 49 Spells must be a number.<br />"; }

        if ($_POST["FiveZero_exp"] == "") { $errors++; $errorlist .= "Class 50 Experience is required.<br />"; }
        if ($_POST["FiveZero_hp"] == "") { $errors++; $errorlist .= "Class 50 HP is required.<br />"; }
        if ($_POST["FiveZero_mp"] == "") { $errors++; $errorlist .= "Class 50 MP is required.<br />"; }
        if ($_POST["FiveZero_tp"] == "") { $errors++; $errorlist .= "Class 50 TP is required.<br />"; }
        if ($_POST["FiveZero_strength"] == "") { $errors++; $errorlist .= "Class 50 Strength is required.<br />"; }
        if ($_POST["FiveZero_dexterity"] == "") { $errors++; $errorlist .= "Class 50 Dexterity is required.<br />"; }
        if ($_POST["FiveZero_spells"] == "") { $errors++; $errorlist .= "Class 50 Spells is required.<br />"; }
        if (!is_numeric($_POST["FiveZero_exp"])) { $errors++; $errorlist .= "Class 50 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FiveZero_hp"])) { $errors++; $errorlist .= "Class 50 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveZero_mp"])) { $errors++; $errorlist .= "Class 50 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveZero_tp"])) { $errors++; $errorlist .= "Class 50 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveZero_strength"])) { $errors++; $errorlist .= "Class 50 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FiveZero_dexterity"])) { $errors++; $errorlist .= "Class 50 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FiveZero_spells"])) { $errors++; $errorlist .= "Class 50 Spells must be a number.<br />"; }

        if ($_POST["FiveOne_exp"] == "") { $errors++; $errorlist .= "Class 51 Experience is required.<br />"; }
        if ($_POST["FiveOne_hp"] == "") { $errors++; $errorlist .= "Class 51 HP is required.<br />"; }
        if ($_POST["FiveOne_mp"] == "") { $errors++; $errorlist .= "Class 51 MP is required.<br />"; }
        if ($_POST["FiveOne_tp"] == "") { $errors++; $errorlist .= "Class 51 TP is required.<br />"; }
        if ($_POST["FiveOne_strength"] == "") { $errors++; $errorlist .= "Class 51 Strength is required.<br />"; }
        if ($_POST["FiveOne_dexterity"] == "") { $errors++; $errorlist .= "Class 51 Dexterity is required.<br />"; }
        if ($_POST["FiveOne_spells"] == "") { $errors++; $errorlist .= "Class 51 Spells is required.<br />"; }
        if (!is_numeric($_POST["FiveOne_exp"])) { $errors++; $errorlist .= "Class 51 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FiveOne_hp"])) { $errors++; $errorlist .= "Class 51 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveOne_mp"])) { $errors++; $errorlist .= "Class 51 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveOne_tp"])) { $errors++; $errorlist .= "Class 51 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveOne_strength"])) { $errors++; $errorlist .= "Class 51 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FiveOne_dexterity"])) { $errors++; $errorlist .= "Class 51 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FiveOne_spells"])) { $errors++; $errorlist .= "Class 51 Spells must be a number.<br />"; }

        if ($_POST["FiveTwo_exp"] == "") { $errors++; $errorlist .= "Class 52 Experience is required.<br />"; }
        if ($_POST["FiveTwo_hp"] == "") { $errors++; $errorlist .= "Class 52 HP is required.<br />"; }
        if ($_POST["FiveTwo_mp"] == "") { $errors++; $errorlist .= "Class 52 MP is required.<br />"; }
        if ($_POST["FiveTwo_tp"] == "") { $errors++; $errorlist .= "Class 52 TP is required.<br />"; }
        if ($_POST["FiveTwo_strength"] == "") { $errors++; $errorlist .= "Class 52 Strength is required.<br />"; }
        if ($_POST["FiveTwo_dexterity"] == "") { $errors++; $errorlist .= "Class 52 Dexterity is required.<br />"; }
        if ($_POST["FiveTwo_spells"] == "") { $errors++; $errorlist .= "Class 52 Spells is required.<br />"; }
        if (!is_numeric($_POST["FiveTwo_exp"])) { $errors++; $errorlist .= "Class 52 Experience must be a number.<br />"; }
        if (!is_numeric($_POST["FiveTwo_hp"])) { $errors++; $errorlist .= "Class 52 HP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveTwo_mp"])) { $errors++; $errorlist .= "Class 52 MP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveTwo_tp"])) { $errors++; $errorlist .= "Class 52 TP must be a number.<br />"; }
        if (!is_numeric($_POST["FiveTwo_strength"])) { $errors++; $errorlist .= "Class 52 Strength must be a number.<br />"; }
        if (!is_numeric($_POST["FiveTwo_dexterity"])) { $errors++; $errorlist .= "Class 52 Dexterity must be a number.<br />"; }
        if (!is_numeric($_POST["FiveTwo_spells"])) { $errors++; $errorlist .= "Class 52 Spells must be a number.<br />"; }

		
        if ($errors == 0) { 
$updatequery = <<<END
UPDATE {{table}} SET
1_exp='$one_exp', 1_hp='$one_hp', 1_mp='$one_mp', 1_tp='$one_tp', 1_strength='$one_strength', 1_dexterity='$one_dexterity',	1_spells='$one_spells',
2_exp='$two_exp', 2_hp='$two_hp', 2_mp='$two_mp', 2_tp='$two_tp', 2_strength='$two_strength', 2_dexterity='$two_dexterity',	2_spells='$two_spells',
3_exp='$three_exp', 3_hp='$three_hp', 3_mp='$three_mp', 3_tp='$three_tp', 3_strength='$three_strength', 3_dexterity='$three_dexterity', 3_spells='$three_spells', 4_exp='$four_exp', 4_hp='$four_hp', 4_mp='$four_mp', 4_tp='$four_tp', 4_strength='$four_strength', 4_dexterity='$four_dexterity', 	4_spells='$four_spells', 5_exp='$five_exp', 5_hp='$five_hp', 5_mp='$five_mp', 5_tp='$five_tp', 5_strength='$five_strength', 5_dexterity='$five_dexterity', 5_spells='$five_spells', 6_exp='$six_exp', 6_hp='$six_hp', 6_mp='$six_mp', 6_tp='$six_tp', 6_strength='$six_strength', 6_dexterity='$six_dexterity', 6_spells='$six_spells', 7_exp='$seven_exp', 7_hp='$seven_hp', 7_mp='$seven_mp', 7_tp='$seven_tp', 7_strength='$seven_strength', 7_dexterity='$seven_dexterity', 7_spells='$seven_spells', 8_exp='$eight_exp', 8_hp='$eight_hp', 8_mp='$eight_mp', 8_tp='$eight_tp', 8_strength='$eight_strength', 8_dexterity='$eight_dexterity', 8_spells='$eight_spells',	9_exp='$nine_exp', 9_hp='$nine_hp', 9_mp='$nine_mp', 9_tp='$nine_tp', 9_strength='$nine_strength', 9_dexterity='$nine_dexterity', 9_spells='$nine_spells', 10_exp='$ten_exp', 10_hp='$ten_hp', 10_mp='$ten_mp', 10_tp='$ten_tp', 10_strength='$ten_strength', 10_dexterity='$ten_dexterity', 10_spells='$ten_spells', 11_exp='$OneOne_exp', 11_hp='$OneOne_hp', 11_mp='$OneOne_mp', 11_tp='$OneOne_tp', 11_strength='$OneOne_strength', 11_dexterity='$OneOne_dexterity', 11_spells='$OneOne_spells',
12_exp='$OneTwo_exp', 12_hp='$OneTwo_hp', 12_mp='$OneTwo_mp', 12_tp='$OneTwo_tp', 12_strength='$OneTwo_strength', 12_dexterity='$OneTwo_dexterity', 12_spells='$OneTwo_spells', 13_exp='$OneThree_exp', 13_hp='$OneThree_hp', 13_mp='$OneThree_mp', 13_tp='$OneThree_tp', 13_strength='$OneThree_strength', 13_dexterity='$OneThree_dexterity', 13_spells='$OneThree_spells', 14_exp='$OneFour_exp', 14_hp='$OneFour_hp', 14_mp='$OneFour_mp', 14_tp='$OneFour_tp', 14_strength='$OneFour_strength', 14_dexterity='$OneFour_dexterity', 14_spells='$OneFour_spells', 15_exp='$OneFive_exp', 15_hp='$OneFive_hp', 15_mp='$OneFive_mp', 15_tp='$OneFive_tp', 15_strength='$OneFive_strength', 15_dexterity='$OneFive_dexterity', 15_spells='$OneFive_spells',
16_exp='$OneSix_exp', 16_hp='$OneSix_hp', 16_mp='$OneSix_mp', 16_tp='$OneSix_tp', 16_strength='$OneSix_strength', 16_dexterity='$OneSix_dexterity', 16_spells='$OneSix_spells', 17_exp='$OneSeven_exp', 17_hp='$OneSeven_hp', 17_mp='$OneSeven_mp', 17_tp='$OneSeven_tp', 17_strength='$OneSeven_strength', 17_dexterity='$OneSeven_dexterity', 17_spells='$OneSeven_spells', 18_exp='$OneEight_exp', 18_hp='$OneEight_hp', 18_mp='$OneEight_mp', 18_tp='$OneEight_tp', 18_strength='$OneEight_strength', 18_dexterity='$OneEight_dexterity', 18_spells='$OneEight_spells', 19_exp='$OneNine_exp', 19_hp='$OneNine_hp', 19_mp='$OneNine_mp', 19_tp='$OneNine_tp', 19_strength='$OneNine_strength',	19_dexterity='$OneNine_dexterity', 19_spells='$OneNine_spells',
20_exp='$TwoZero_exp', 20_hp='$TwoZero_hp', 20_mp='$TwoZero_mp', 20_tp='$TwoZero_tp', 20_strength='$TwoZero_strength', 20_dexterity='$TwoZero_dexterity', 20_spells='$TwoZero_spells', 21_exp='$TwoOne_exp', 21_hp='$TwoOne_hp', 21_mp='$TwoOne_mp', 21_tp='$TwoOne_tp', 21_strength='$TwoOne_strength', 21_dexterity='$TwoOne_dexterity', 21_spells='$TwoOne_spells', 22_exp='$TwoTwo_exp', 22_hp='$TwoTwo_hp', 22_mp='$TwoTwo_mp', 22_tp='$TwoTwo_tp', 22_strength='$TwoTwo_strength', 22_dexterity='$TwoTwo_dexterity', 22_spells='$TwoTwo_spells', 23_exp='$TwoThree_exp', 23_hp='$TwoThree_hp',	13_mp='$TwoThree_mp', 23_tp='$TwoThree_tp', 23_strength='$TwoThree_strength', 23_dexterity='$TwoThree_dexterity', 23_spells='$TwoThree_spells', 24_exp='$TwoFour_exp', 24_hp='$TwoFour_hp', 24_mp='$TwoFour_mp', 24_tp='$TwoFour_tp', 24_strength='$TwoFour_strength', 24_dexterity='$TwoFour_dexterity', 24_spells='$TwoFour_spells', 25_exp='$TwoFive_exp', 25_hp='$TwoFive_hp', 25_mp='$TwoFive_mp', 25_tp='$TwoFive_tp', 25_strength='$TwoFive_strength', 25_dexterity='$TwoFive_dexterity', 25_spells='$TwoFive_spells', 26_exp='$TwoSix_exp', 26_hp='$TwoSix_hp', 26_mp='$TwoSix_mp', 26_tp='$TwoSix_tp', 26_strength='$TwoSix_strength', 26_dexterity='$TwoSix_dexterity', 26_spells='$TwoSix_spells', 27_exp='$TwoSeven_exp', 27_hp='$TwoSeven_hp', 27_mp='$TwoSeven_mp', 27_tp='$TwoSeven_tp', 27_strength='$TwoSeven_strength', 27_dexterity='$TwoSeven_dexterity', 27_spells='$TwoSeven_spells', 28_exp='$TwoEight_exp', 28_hp='$TwoEight_hp', 28_mp='$TwoEight_mp', 28_tp='$TwoEight_tp', 28_strength='$TwoEight_strength', 28_dexterity='$TwoEight_dexterity', 28_spells='$TwoEight_spells', 29_exp='$TwoNine_exp', 29_hp='$TwoNine_hp', 29_mp='$TwoNine_mp', 29_tp='$TwoNine_tp', 29_strength='$TwoNine_strength', 29_dexterity='$TwoNine_dexterity', 29_spells='$TwoNine_spells', 30_exp='$ThreeZero_exp', 30_hp='$ThreeZero_hp', 30_mp='$ThreeZero_mp', 30_tp='$ThreeZero_tp', 30_strength='$ThreeZero_strength', 30_dexterity='$ThreeZero_dexterity', 30_spells='$ThreeZero_spells', 31_exp='$ThreeOne_exp', 31_hp='$ThreeOne_hp', 31_mp='$ThreeOne_mp', 31_tp='$ThreeOne_tp', 31_strength='$ThreeOne_strength', 31_dexterity='$ThreeOne_dexterity', 31_spells='$ThreeOne_spells', 32_exp='$ThreeTwo_exp', 32_hp='$ThreeTwo_hp', 32_mp='$ThreeTwo_mp', 32_tp='$ThreeTwo_tp', 32_strength='$ThreeTwo_strength', 32_dexterity='$ThreeTwo_dexterity', 32_spells='$ThreeTwo_spells', 33_exp='$ThreeThree_exp', 33_hp='$ThreeThree_hp',	13_mp='$ThreeThree_mp', 33_tp='$ThreeThree_tp', 33_strength='$ThreeThree_strength', 33_dexterity='$ThreeThree_dexterity', 33_spells='$ThreeThree_spells', 34_exp='$ThreeFour_exp', 34_hp='$ThreeFour_hp', 34_mp='$ThreeFour_mp', 34_tp='$ThreeFour_tp', 34_strength='$ThreeFour_strength', 34_dexterity='$ThreeFour_dexterity', 34_spells='$ThreeFour_spells', 35_exp='$ThreeFive_exp', 35_hp='$ThreeFive_hp', 35_mp='$ThreeFive_mp', 35_tp='$ThreeFive_tp', 35_strength='$ThreeFive_strength', 35_dexterity='$ThreeFive_dexterity', 35_spells='$ThreeFive_spells', 36_exp='$ThreeSix_exp', 36_hp='$ThreeSix_hp', 36_mp='$ThreeSix_mp', 36_tp='$ThreeSix_tp', 36_strength='$ThreeSix_strength', 36_dexterity='$ThreeSix_dexterity', 36_spells='$ThreeSix_spells', 37_exp='$ThreeSeven_exp', 37_hp='$ThreeSeven_hp', 37_mp='$ThreeSeven_mp', 37_tp='$ThreeSeven_tp', 37_strength='$ThreeSeven_strength', 37_dexterity='$ThreeSeven_dexterity', 37_spells='$ThreeSeven_spells', 38_exp='$ThreeEight_exp', 38_hp='$ThreeEight_hp', 38_mp='$ThreeEight_mp', 38_tp='$ThreeEight_tp', 38_strength='$ThreeEight_strength', 38_dexterity='$ThreeEight_dexterity', 38_spells='$ThreeEight_spells', 39_exp='$ThreeNine_exp', 39_hp='$ThreeNine_hp', 39_mp='$ThreeNine_mp', 39_tp='$ThreeNine_tp', 39_strength='$ThreeNine_strength', 39_dexterity='$ThreeNine_dexterity', 39_spells='$ThreeNine_spells', 40_exp='$FourZero_exp', 40_hp='$FourZero_hp', 40_mp='$FourZero_mp', 40_tp='$FourZero_tp', 40_strength='$FourZero_strength', 40_dexterity='$FourZero_dexterity', 40_spells='$FourZero_spells', 41_exp='$FourOne_exp', 41_hp='$FourOne_hp', 41_mp='$FourOne_mp', 41_tp='$FourOne_tp', 41_strength='$FourOne_strength', 41_dexterity='$FourOne_dexterity', 41_spells='$FourOne_spells', 42_exp='$FourTwo_exp', 42_hp='$FourTwo_hp', 42_mp='$FourTwo_mp', 42_tp='$FourTwo_tp', 42_strength='$FourTwo_strength', 42_dexterity='$FourTwo_dexterity', 42_spells='$FourTwo_spells', 43_exp='$FourThree_exp', 43_hp='$FourThree_hp',	13_mp='$FourThree_mp', 43_tp='$FourThree_tp', 43_strength='$FourThree_strength', 43_dexterity='$FourThree_dexterity', 43_spells='$FourThree_spells', 44_exp='$FourFour_exp', 44_hp='$FourFour_hp', 44_mp='$FourFour_mp', 44_tp='$FourFour_tp', 44_strength='$FourFour_strength', 44_dexterity='$FourFour_dexterity', 44_spells='$FourFour_spells', 45_exp='$FourFive_exp', 45_hp='$FourFive_hp', 45_mp='$FourFive_mp', 45_tp='$FourFive_tp', 45_strength='$FourFive_strength', 45_dexterity='$FourFive_dexterity', 45_spells='$FourFive_spells', 46_exp='$FourSix_exp', 46_hp='$FourSix_hp', 46_mp='$FourSix_mp', 46_tp='$FourSix_tp', 46_strength='$FourSix_strength', 46_dexterity='$FourSix_dexterity', 46_spells='$FourSix_spells', 47_exp='$FourSeven_exp', 47_hp='$FourSeven_hp', 47_mp='$FourSeven_mp', 47_tp='$FourSeven_tp', 47_strength='$FourSeven_strength', 47_dexterity='$FourSeven_dexterity', 47_spells='$FourSeven_spells', 48_exp='$FourEight_exp', 48_hp='$FourEight_hp', 48_mp='$FourEight_mp', 48_tp='$FourEight_tp', 48_strength='$FourEight_strength', 48_dexterity='$FourEight_dexterity', 48_spells='$FourEight_spells', 49_exp='$FourNine_exp', 49_hp='$FourNine_hp', 49_mp='$FourNine_mp', 49_tp='$FourNine_tp', 49_strength='$FourNine_strength', 49_dexterity='$FourNine_dexterity', 49_spells='$FourNine_spells', 50_exp='$FiveZero_exp', 50_hp='$FiveZero_hp', 50_mp='$FiveZero_mp', 50_tp='$FiveZero_tp', 50_strength='$FiveZero_strength', 50_dexterity='$FiveZero_dexterity', 50_spells='$FiveZero_spells', 51_exp='$FiveOne_exp', 51_hp='$FiveOne_hp', 51_mp='$FiveOne_mp', 51_tp='$FiveOne_tp', 51_strength='$FiveOne_strength', 51_dexterity='$FiveOne_dexterity', 51_spells='$FiveOne_spells', 52_exp='$FiveTwo_exp', 52_hp='$FiveTwo_hp', 52_mp='$FiveTwo_mp', 52_tp='$FiveTwo_tp', 52_strength='$FiveTwo_strength', 52_dexterity='$FiveTwo_dexterity', 52_spells='$FiveTwo_spells'
	WHERE id='$id' LIMIT 1
END;
			$query = doquery($updatequery, "levels");
            admindisplay("<blockquote><blockquote><a href=\"admin.php?do=levels\" class=\"myButton2\">Level updated</a></blockquote></blockquote>","Edit Levels");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Spells");
        }    
    }   
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "levels");
    $row = mysql_fetch_array($query);
    global $controlrow;
	$class1name = $controlrow["class1name"];
    $class2name = $controlrow["class2name"];
    $class3name = $controlrow["class3name"];
    $class4name = $controlrow["class4name"];
    $class5name = $controlrow["class5name"];
    $class6name = $controlrow["class6name"];
    $class7name = $controlrow["class7name"];
    $class8name = $controlrow["class8name"];
    $class9name = $controlrow["class9name"];
    $class10name = $controlrow["class10name"];	
	$class11name = $controlrow["class11name"];
    $class12name = $controlrow["class12name"];
    $class13name = $controlrow["class13name"];
    $class14name = $controlrow["class14name"];
    $class15name = $controlrow["class15name"];
    $class16name = $controlrow["class16name"];
    $class17name = $controlrow["class17name"];
    $class18name = $controlrow["class18name"];
    $class19name = $controlrow["class19name"];
    $class20name = $controlrow["class20name"];	
	$class21name = $controlrow["class21name"];
    $class22name = $controlrow["class22name"];
    $class23name = $controlrow["class23name"];
    $class24name = $controlrow["class24name"];
    $class25name = $controlrow["class25name"];
    $class26name = $controlrow["class26name"];
    $class27name = $controlrow["class27name"];
    $class28name = $controlrow["class28name"];
    $class29name = $controlrow["class29name"];
    $class30name = $controlrow["class30name"];	
	$class31name = $controlrow["class31name"];
    $class32name = $controlrow["class32name"];
    $class33name = $controlrow["class33name"];
    $class34name = $controlrow["class34name"];
    $class35name = $controlrow["class35name"];
    $class36name = $controlrow["class36name"];
    $class37name = $controlrow["class37name"];
    $class38name = $controlrow["class38name"];
    $class39name = $controlrow["class39name"];
    $class40name = $controlrow["class40name"];	
	$class41name = $controlrow["class41name"];
    $class42name = $controlrow["class42name"];
    $class43name = $controlrow["class43name"];
    $class44name = $controlrow["class44name"];
    $class45name = $controlrow["class45name"];
    $class46name = $controlrow["class46name"];
    $class47name = $controlrow["class47name"];
    $class48name = $controlrow["class48name"];
    $class49name = $controlrow["class49name"];
    $class50name = $controlrow["class50name"];
	$class51name = $controlrow["class51name"];
    $class52name = $controlrow["class52name"];

$page = <<<END
<u>Edit Levels</u><br /><br />
<font color="#C8003C">Experience values</font> for each level should be the <font color="#C8003C">cumulative total amount of experience</font> up to this point.<br /><font color="#008000">All other values</font> should be only the <font color="#008000">new amount</font> to add this level.<br /><font color="#0000FF">Level One Only: Values should be the same</font> for all Classes of Characters to give each player a equal footing to reach Level Two.<br /><br />
<form action="admin.php?do=editlevel" method="post">
<input type="hidden" name="level" value="$id" />
<table width="90%">
<tr><td width="20%">ID:</td><td>{{id}}</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">1 - $class1name</td></tr>

<tr><td width="20%">$class1name Experience:</td><td><input type="text" name="one_exp" size="10" maxlength="8" value="{{1_exp}}" /></td></tr>
<tr><td width="20%">$class1name HP:</td><td><input type="text" name="one_hp" size="5" maxlength="5" value="{{1_hp}}" /></td></tr>
<tr><td width="20%">$class1name MP:</td><td><input type="text" name="one_mp" size="5" maxlength="5" value="{{1_mp}}" /></td></tr>
<tr><td width="20%">$class1name TP:</td><td><input type="text" name="one_tp" size="5" maxlength="5" value="{{1_tp}}" /></td></tr>
<tr><td width="20%">$class1name Strength:</td><td><input type="text" name="one_strength" size="5" maxlength="5" value="{{1_strength}}" /></td></tr>
<tr><td width="20%">$class1name Dexterity:</td><td><input type="text" name="one_dexterity" size="5" maxlength="5" value="{{1_dexterity}}" /></td></tr>
<tr><td width="20%">$class1name Spells:</td><td><input type="text" name="one_spells" size="5" maxlength="3" value="{{1_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">2 - $class2name</td></tr>

<tr><td width="20%">$class2name Experience:</td><td><input type="text" name="two_exp" size="10" maxlength="8" value="{{2_exp}}" /></td></tr>
<tr><td width="20%">$class2name HP:</td><td><input type="text" name="two_hp" size="5" maxlength="5" value="{{2_hp}}" /></td></tr>
<tr><td width="20%">$class2name MP:</td><td><input type="text" name="two_mp" size="5" maxlength="5" value="{{2_mp}}" /></td></tr>
<tr><td width="20%">$class2name TP:</td><td><input type="text" name="two_tp" size="5" maxlength="5" value="{{2_tp}}" /></td></tr>
<tr><td width="20%">$class2name Strength:</td><td><input type="text" name="two_strength" size="5" maxlength="5" value="{{2_strength}}" /></td></tr>
<tr><td width="20%">$class2name Dexterity:</td><td><input type="text" name="two_dexterity" size="5" maxlength="5" value="{{2_dexterity}}" /></td></tr>
<tr><td width="20%">$class2name Spells:</td><td><input type="text" name="two_spells" size="5" maxlength="3" value="{{2_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">3 - $class3name</td></tr>

<tr><td width="20%">$class3name Experience:</td><td><input type="text" name="three_exp" size="10" maxlength="8" value="{{3_exp}}" /></td></tr>
<tr><td width="20%">$class3name HP:</td><td><input type="text" name="three_hp" size="5" maxlength="5" value="{{3_hp}}" /></td></tr>
<tr><td width="20%">$class3name MP:</td><td><input type="text" name="three_mp" size="5" maxlength="5" value="{{3_mp}}" /></td></tr>
<tr><td width="20%">$class3name TP:</td><td><input type="text" name="three_tp" size="5" maxlength="5" value="{{3_tp}}" /></td></tr>
<tr><td width="20%">$class3name Strength:</td><td><input type="text" name="three_strength" size="5" maxlength="5" value="{{3_strength}}" /></td></tr>
<tr><td width="20%">$class3name Dexterity:</td><td><input type="text" name="three_dexterity" size="5" maxlength="5" value="{{3_dexterity}}" /></td></tr>
<tr><td width="20%">$class3name Spells:</td><td><input type="text" name="three_spells" size="5" maxlength="3" value="{{3_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">4 - $class4name</td></tr>

<tr><td width="20%">$class4name Experience:</td><td><input type="text" name="four_exp" size="10" maxlength="8" value="{{4_exp}}" /></td></tr>
<tr><td width="20%">$class4name HP:</td><td><input type="text" name="four_hp" size="5" maxlength="5" value="{{4_hp}}" /></td></tr>
<tr><td width="20%">$class4name MP:</td><td><input type="text" name="four_mp" size="5" maxlength="5" value="{{4_mp}}" /></td></tr>
<tr><td width="20%">$class4name TP:</td><td><input type="text" name="four_tp" size="5" maxlength="5" value="{{4_tp}}" /></td></tr>
<tr><td width="20%">$class4name Strength:</td><td><input type="text" name="four_strength" size="5" maxlength="5" value="{{4_strength}}" /></td></tr>
<tr><td width="20%">$class4name Dexterity:</td><td><input type="text" name="four_dexterity" size="5" maxlength="5" value="{{4_dexterity}}" /></td></tr>
<tr><td width="20%">$class4name Spells:</td><td><input type="text" name="four_spells" size="5" maxlength="3" value="{{4_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">5 - $class5name</td></tr>

<tr><td width="20%">$class5name Experience:</td><td><input type="text" name="five_exp" size="10" maxlength="8" value="{{5_exp}}" /></td></tr>
<tr><td width="20%">$class5name HP:</td><td><input type="text" name="five_hp" size="5" maxlength="5" value="{{5_hp}}" /></td></tr>
<tr><td width="20%">$class5name MP:</td><td><input type="text" name="five_mp" size="5" maxlength="5" value="{{5_mp}}" /></td></tr>
<tr><td width="20%">$class5name TP:</td><td><input type="text" name="five_tp" size="5" maxlength="5" value="{{5_tp}}" /></td></tr>
<tr><td width="20%">$class5name Strength:</td><td><input type="text" name="five_strength" size="5" maxlength="5" value="{{5_strength}}" /></td></tr>
<tr><td width="20%">$class5name Dexterity:</td><td><input type="text" name="five_dexterity" size="5" maxlength="5" value="{{5_dexterity}}" /></td></tr>
<tr><td width="20%">$class5name Spells:</td><td><input type="text" name="five_spells" size="5" maxlength="3" value="{{5_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">6 - $class6name</td></tr>

<tr><td width="20%">$class6name Experience:</td><td><input type="text" name="six_exp" size="10" maxlength="8" value="{{6_exp}}" /></td></tr>
<tr><td width="20%">$class6name HP:</td><td><input type="text" name="six_hp" size="5" maxlength="5" value="{{6_hp}}" /></td></tr>
<tr><td width="20%">$class6name MP:</td><td><input type="text" name="six_mp" size="5" maxlength="5" value="{{6_mp}}" /></td></tr>
<tr><td width="20%">$class6name TP:</td><td><input type="text" name="six_tp" size="5" maxlength="5" value="{{6_tp}}" /></td></tr>
<tr><td width="20%">$class6name Strength:</td><td><input type="text" name="six_strength" size="5" maxlength="5" value="{{6_strength}}" /></td></tr>
<tr><td width="20%">$class6name Dexterity:</td><td><input type="text" name="six_dexterity" size="5" maxlength="5" value="{{6_dexterity}}" /></td></tr>
<tr><td width="20%">$class6name Spells:</td><td><input type="text" name="six_spells" size="5" maxlength="3" value="{{6_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">7 - $class7name</td></tr>

<tr><td width="20%">$class7name Experience:</td><td><input type="text" name="seven_exp" size="10" maxlength="8" value="{{7_exp}}" /></td></tr>
<tr><td width="20%">$class7name HP:</td><td><input type="text" name="seven_hp" size="5" maxlength="5" value="{{7_hp}}" /></td></tr>
<tr><td width="20%">$class7name MP:</td><td><input type="text" name="seven_mp" size="5" maxlength="5" value="{{7_mp}}" /></td></tr>
<tr><td width="20%">$class7name TP:</td><td><input type="text" name="seven_tp" size="5" maxlength="5" value="{{7_tp}}" /></td></tr>
<tr><td width="20%">$class7name Strength:</td><td><input type="text" name="seven_strength" size="5" maxlength="5" value="{{7_strength}}" /></td></tr>
<tr><td width="20%">$class7name Dexterity:</td><td><input type="text" name="seven_dexterity" size="5" maxlength="5" value="{{7_dexterity}}" /></td></tr>
<tr><td width="20%">$class7name Spells:</td><td><input type="text" name="seven_spells" size="5" maxlength="3" value="{{7_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">8 - $class8name</td></tr>

<tr><td width="20%">$class8name Experience:</td><td><input type="text" name="eight_exp" size="10" maxlength="8" value="{{8_exp}}" /></td></tr>
<tr><td width="20%">$class8name HP:</td><td><input type="text" name="eight_hp" size="5" maxlength="5" value="{{8_hp}}" /></td></tr>
<tr><td width="20%">$class8name MP:</td><td><input type="text" name="eight_mp" size="5" maxlength="5" value="{{8_mp}}" /></td></tr>
<tr><td width="20%">$class8name TP:</td><td><input type="text" name="eight_tp" size="5" maxlength="5" value="{{8_tp}}" /></td></tr>
<tr><td width="20%">$class8name Strength:</td><td><input type="text" name="eight_strength" size="5" maxlength="5" value="{{8_strength}}" /></td></tr>
<tr><td width="20%">$class8name Dexterity:</td><td><input type="text" name="eight_dexterity" size="5" maxlength="5" value="{{8_dexterity}}" /></td></tr>
<tr><td width="20%">$class8name Spells:</td><td><input type="text" name="eight_spells" size="5" maxlength="3" value="{{8_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">9 - $class9name</td></tr>

<tr><td width="20%">$class9name Experience:</td><td><input type="text" name="nine_exp" size="10" maxlength="8" value="{{9_exp}}" /></td></tr>
<tr><td width="20%">$class9name HP:</td><td><input type="text" name="nine_hp" size="5" maxlength="5" value="{{9_hp}}" /></td></tr>
<tr><td width="20%">$class9name MP:</td><td><input type="text" name="nine_mp" size="5" maxlength="5" value="{{9_mp}}" /></td></tr>
<tr><td width="20%">$class9name TP:</td><td><input type="text" name="nine_tp" size="5" maxlength="5" value="{{9_tp}}" /></td></tr>
<tr><td width="20%">$class9name Strength:</td><td><input type="text" name="nine_strength" size="5" maxlength="5" value="{{9_strength}}" /></td></tr>
<tr><td width="20%">$class9name Dexterity:</td><td><input type="text" name="nine_dexterity" size="5" maxlength="5" value="{{9_dexterity}}" /></td></tr>
<tr><td width="20%">$class9name Spells:</td><td><input type="text" name="nine_spells" size="5" maxlength="3" value="{{9_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">10 - $class10name</td></tr>

<tr><td width="20%">$class10name Experience:</td><td><input type="text" name="ten_exp" size="10" maxlength="8" value="{{10_exp}}" /></td></tr>
<tr><td width="20%">$class10name HP:</td><td><input type="text" name="ten_hp" size="5" maxlength="5" value="{{10_hp}}" /></td></tr>
<tr><td width="20%">$class10name MP:</td><td><input type="text" name="ten_mp" size="5" maxlength="5" value="{{10_mp}}" /></td></tr>
<tr><td width="20%">$class10name TP:</td><td><input type="text" name="ten_tp" size="5" maxlength="5" value="{{10_tp}}" /></td></tr>
<tr><td width="20%">$class10name Strength:</td><td><input type="text" name="ten_strength" size="5" maxlength="5" value="{{10_strength}}" /></td></tr>
<tr><td width="20%">$class10name Dexterity:</td><td><input type="text" name="ten_dexterity" size="5" maxlength="5" value="{{10_dexterity}}" /></td></tr>
<tr><td width="20%">$class10name Spells:</td><td><input type="text" name="ten_spells" size="5" maxlength="3" value="{{10_spells}}" /></td></tr>
 
<tr><td colspan="2" style="background-color:#cccccc;">11 - $class11name</td></tr>

<tr><td width="20%">$class11name Experience:</td><td><input type="text" name="OneOne_exp" size="10" maxlength="8" value="{{11_exp}}" /></td></tr>
<tr><td width="20%">$class11name HP:</td><td><input type="text" name="OneOne_hp" size="5" maxlength="5" value="{{11_hp}}" /></td></tr>
<tr><td width="20%">$class11name MP:</td><td><input type="text" name="OneOne_mp" size="5" maxlength="5" value="{{11_mp}}" /></td></tr>
<tr><td width="20%">$class11name TP:</td><td><input type="text" name="OneOne_tp" size="5" maxlength="5" value="{{11_tp}}" /></td></tr>
<tr><td width="20%">$class11name Strength:</td><td><input type="text" name="OneOne_strength" size="5" maxlength="5" value="{{11_strength}}" /></td></tr>
<tr><td width="20%">$class11name Dexterity:</td><td><input type="text" name="OneOne_dexterity" size="5" maxlength="5" value="{{11_dexterity}}" /></td></tr>
<tr><td width="20%">$class11name Spells:</td><td><input type="text" name="OneOne_spells" size="5" maxlength="3" value="{{11_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">12 - $class12name</td></tr>

<tr><td width="20%">$class12name Experience:</td><td><input type="text" name="OneTwo_exp" size="10" maxlength="8" value="{{12_exp}}" /></td></tr>
<tr><td width="20%">$class12name HP:</td><td><input type="text" name="OneTwo_hp" size="5" maxlength="5" value="{{12_hp}}" /></td></tr>
<tr><td width="20%">$class12name MP:</td><td><input type="text" name="OneTwo_mp" size="5" maxlength="5" value="{{12_mp}}" /></td></tr>
<tr><td width="20%">$class12name TP:</td><td><input type="text" name="OneTwo_tp" size="5" maxlength="5" value="{{12_tp}}" /></td></tr>
<tr><td width="20%">$class12name Strength:</td><td><input type="text" name="OneTwo_strength" size="5" maxlength="5" value="{{12_strength}}" /></td></tr>
<tr><td width="20%">$class12name Dexterity:</td><td><input type="text" name="OneTwo_dexterity" size="5" maxlength="5" value="{{12_dexterity}}" /></td></tr>
<tr><td width="20%">$class12name Spells:</td><td><input type="text" name="OneTwo_spells" size="5" maxlength="3" value="{{12_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">13 - $class13name</td></tr>

<tr><td width="20%">$class13name Experience:</td><td><input type="text" name="OneThree_exp" size="10" maxlength="8" value="{{13_exp}}" /></td></tr>
<tr><td width="20%">$class13name HP:</td><td><input type="text" name="OneThree_hp" size="5" maxlength="5" value="{{13_hp}}" /></td></tr>
<tr><td width="20%">$class13name MP:</td><td><input type="text" name="OneThree_mp" size="5" maxlength="5" value="{{13_mp}}" /></td></tr>
<tr><td width="20%">$class13name TP:</td><td><input type="text" name="OneThree_tp" size="5" maxlength="5" value="{{13_tp}}" /></td></tr>
<tr><td width="20%">$class13name Strength:</td><td><input type="text" name="OneThree_strength" size="5" maxlength="5" value="{{13_strength}}" /></td></tr>
<tr><td width="20%">$class13name Dexterity:</td><td><input type="text" name="OneThree_dexterity" size="5" maxlength="5" value="{{13_dexterity}}" /></td></tr>
<tr><td width="20%">$class13name Spells:</td><td><input type="text" name="OneThree_spells" size="5" maxlength="3" value="{{13_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">14 - $class14name</td></tr>

<tr><td width="20%">$class14name Experience:</td><td><input type="text" name="OneFour_exp" size="10" maxlength="8" value="{{14_exp}}" /></td></tr>
<tr><td width="20%">$class14name HP:</td><td><input type="text" name="OneFour_hp" size="5" maxlength="5" value="{{14_hp}}" /></td></tr>
<tr><td width="20%">$class14name MP:</td><td><input type="text" name="OneFour_mp" size="5" maxlength="5" value="{{14_mp}}" /></td></tr>
<tr><td width="20%">$class14name TP:</td><td><input type="text" name="OneFour_tp" size="5" maxlength="5" value="{{14_tp}}" /></td></tr>
<tr><td width="20%">$class14name Strength:</td><td><input type="text" name="OneFour_strength" size="5" maxlength="5" value="{{14_strength}}" /></td></tr>
<tr><td width="20%">$class14name Dexterity:</td><td><input type="text" name="OneFour_dexterity" size="5" maxlength="5" value="{{14_dexterity}}" /></td></tr>
<tr><td width="20%">$class14name Spells:</td><td><input type="text" name="OneFour_spells" size="5" maxlength="3" value="{{14_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">15 - $class15name</td></tr>

<tr><td width="20%">$class15name Experience:</td><td><input type="text" name="OneFive_exp" size="10" maxlength="8" value="{{15_exp}}" /></td></tr>
<tr><td width="20%">$class15name HP:</td><td><input type="text" name="OneFive_hp" size="5" maxlength="5" value="{{15_hp}}" /></td></tr>
<tr><td width="20%">$class15name MP:</td><td><input type="text" name="OneFive_mp" size="5" maxlength="5" value="{{15_mp}}" /></td></tr>
<tr><td width="20%">$class15name TP:</td><td><input type="text" name="OneFive_tp" size="5" maxlength="5" value="{{15_tp}}" /></td></tr>
<tr><td width="20%">$class15name Strength:</td><td><input type="text" name="OneFive_strength" size="5" maxlength="5" value="{{15_strength}}" /></td></tr>
<tr><td width="20%">$class15name Dexterity:</td><td><input type="text" name="OneFive_dexterity" size="5" maxlength="5" value="{{15_dexterity}}" /></td></tr>
<tr><td width="20%">$class15name Spells:</td><td><input type="text" name="OneFive_spells" size="5" maxlength="3" value="{{15_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">16 - $class16name</td></tr>

<tr><td width="20%">$class16name Experience:</td><td><input type="text" name="OneSix_exp" size="10" maxlength="8" value="{{16_exp}}" /></td></tr>
<tr><td width="20%">$class16name HP:</td><td><input type="text" name="OneSix_hp" size="5" maxlength="5" value="{{16_hp}}" /></td></tr>
<tr><td width="20%">$class16name MP:</td><td><input type="text" name="OneSix_mp" size="5" maxlength="5" value="{{16_mp}}" /></td></tr>
<tr><td width="20%">$class16name TP:</td><td><input type="text" name="OneSix_tp" size="5" maxlength="5" value="{{16_tp}}" /></td></tr>
<tr><td width="20%">$class16name Strength:</td><td><input type="text" name="OneSix_strength" size="5" maxlength="5" value="{{16_strength}}" /></td></tr>
<tr><td width="20%">$class16name Dexterity:</td><td><input type="text" name="OneSix_dexterity" size="5" maxlength="5" value="{{16_dexterity}}" /></td></tr>
<tr><td width="20%">$class16name Spells:</td><td><input type="text" name="OneSix_spells" size="5" maxlength="3" value="{{16_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">17 - $class17name</td></tr>

<tr><td width="20%">$class17name Experience:</td><td><input type="text" name="OneSeven_exp" size="10" maxlength="8" value="{{17_exp}}" /></td></tr>
<tr><td width="20%">$class17name HP:</td><td><input type="text" name="OneSeven_hp" size="5" maxlength="5" value="{{17_hp}}" /></td></tr>
<tr><td width="20%">$class17name MP:</td><td><input type="text" name="OneSeven_mp" size="5" maxlength="5" value="{{17_mp}}" /></td></tr>
<tr><td width="20%">$class17name TP:</td><td><input type="text" name="OneSeven_tp" size="5" maxlength="5" value="{{17_tp}}" /></td></tr>
<tr><td width="20%">$class17name Strength:</td><td><input type="text" name="OneSeven_strength" size="5" maxlength="5" value="{{17_strength}}" /></td></tr>
<tr><td width="20%">$class17name Dexterity:</td><td><input type="text" name="OneSeven_dexterity" size="5" maxlength="5" value="{{17_dexterity}}" /></td></tr>
<tr><td width="20%">$class17name Spells:</td><td><input type="text" name="OneSeven_spells" size="5" maxlength="3" value="{{17_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">18 - $class18name</td></tr>

<tr><td width="20%">$class18name Experience:</td><td><input type="text" name="OneEight_exp" size="10" maxlength="8" value="{{18_exp}}" /></td></tr>
<tr><td width="20%">$class18name HP:</td><td><input type="text" name="OneEight_hp" size="5" maxlength="5" value="{{18_hp}}" /></td></tr>
<tr><td width="20%">$class18name MP:</td><td><input type="text" name="OneEight_mp" size="5" maxlength="5" value="{{18_mp}}" /></td></tr>
<tr><td width="20%">$class18name TP:</td><td><input type="text" name="OneEight_tp" size="5" maxlength="5" value="{{18_tp}}" /></td></tr>
<tr><td width="20%">$class18name Strength:</td><td><input type="text" name="OneEight_strength" size="5" maxlength="5" value="{{18_strength}}" /></td></tr>
<tr><td width="20%">$class18name Dexterity:</td><td><input type="text" name="OneEight_dexterity" size="5" maxlength="5" value="{{18_dexterity}}" /></td></tr>
<tr><td width="20%">$class18name Spells:</td><td><input type="text" name="OneEight_spells" size="5" maxlength="3" value="{{18_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">19 - $class19name</td></tr>

<tr><td width="20%">$class19name Experience:</td><td><input type="text" name="OneNine_exp" size="10" maxlength="8" value="{{19_exp}}" /></td></tr>
<tr><td width="20%">$class19name HP:</td><td><input type="text" name="OneNine_hp" size="5" maxlength="5" value="{{19_hp}}" /></td></tr>
<tr><td width="20%">$class19name MP:</td><td><input type="text" name="OneNine_mp" size="5" maxlength="5" value="{{19_mp}}" /></td></tr>
<tr><td width="20%">$class19name TP:</td><td><input type="text" name="OneNine_tp" size="5" maxlength="5" value="{{19_tp}}" /></td></tr>
<tr><td width="20%">$class19name Strength:</td><td><input type="text" name="OneNine_strength" size="5" maxlength="5" value="{{19_strength}}" /></td></tr>
<tr><td width="20%">$class19name Dexterity:</td><td><input type="text" name="OneNine_dexterity" size="5" maxlength="5" value="{{19_dexterity}}" /></td></tr>
<tr><td width="20%">$class19name Spells:</td><td><input type="text" name="OneNine_spells" size="5" maxlength="3" value="{{19_spells}}" /></td></tr>
  
<tr><td colspan="2" style="background-color:#cccccc;">20 - $class20name</td></tr>

<tr><td width="20%">$class20name Experience:</td><td><input type="text" name="TwoZero_exp" size="10" maxlength="8" value="{{21_exp}}" /></td></tr>
<tr><td width="20%">$class20name HP:</td><td><input type="text" name="TwoZero_hp" size="5" maxlength="5" value="{{21_hp}}" /></td></tr>
<tr><td width="20%">$class20name MP:</td><td><input type="text" name="TwoZero_mp" size="5" maxlength="5" value="{{21_mp}}" /></td></tr>
<tr><td width="20%">$class20name TP:</td><td><input type="text" name="TwoZero_tp" size="5" maxlength="5" value="{{21_tp}}" /></td></tr>
<tr><td width="20%">$class20name Strength:</td><td><input type="text" name="TwoZero_strength" size="5" maxlength="5" value="{{21_strength}}" /></td></tr>
<tr><td width="20%">$class20name Dexterity:</td><td><input type="text" name="TwoZero_dexterity" size="5" maxlength="5" value="{{21_dexterity}}" /></td></tr>
<tr><td width="20%">$class20name Spells:</td><td><input type="text" name="TwoZero_spells" size="5" maxlength="3" value="{{21_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">21 - $class21name</td></tr>

<tr><td width="20%">$class21name Experience:</td><td><input type="text" name="TwoOne_exp" size="10" maxlength="8" value="{{20_exp}}" /></td></tr>
<tr><td width="20%">$class21name HP:</td><td><input type="text" name="TwoOne_hp" size="5" maxlength="5" value="{{20_hp}}" /></td></tr>
<tr><td width="20%">$class21name MP:</td><td><input type="text" name="TwoOne_mp" size="5" maxlength="5" value="{{20_mp}}" /></td></tr>
<tr><td width="20%">$class21name TP:</td><td><input type="text" name="TwoOne_tp" size="5" maxlength="5" value="{{20_tp}}" /></td></tr>
<tr><td width="20%">$class21name Strength:</td><td><input type="text" name="TwoOne_strength" size="5" maxlength="5" value="{{20_strength}}" /></td></tr>
<tr><td width="20%">$class21name Dexterity:</td><td><input type="text" name="TwoOne_dexterity" size="5" maxlength="5" value="{{20_dexterity}}" /></td></tr>
<tr><td width="20%">$class21name Spells:</td><td><input type="text" name="TwoOne_spells" size="5" maxlength="3" value="{{20_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">22 - $class22name</td></tr>

<tr><td width="20%">$class22name Experience:</td><td><input type="text" name="TwoTwo_exp" size="10" maxlength="8" value="{{20_exp}}" /></td></tr>
<tr><td width="20%">$class22name HP:</td><td><input type="text" name="TwoTwo_hp" size="5" maxlength="5" value="{{20_hp}}" /></td></tr>
<tr><td width="20%">$class22name MP:</td><td><input type="text" name="TwoTwo_mp" size="5" maxlength="5" value="{{20_mp}}" /></td></tr>
<tr><td width="20%">$class22name TP:</td><td><input type="text" name="TwoTwo_tp" size="5" maxlength="5" value="{{20_tp}}" /></td></tr>
<tr><td width="20%">$class22name Strength:</td><td><input type="text" name="TwoTwo_strength" size="5" maxlength="5" value="{{20_strength}}" /></td></tr>
<tr><td width="20%">$class22name Dexterity:</td><td><input type="text" name="TwoTwo_dexterity" size="5" maxlength="5" value="{{20_dexterity}}" /></td></tr>
<tr><td width="20%">$class22name Spells:</td><td><input type="text" name="TwoTwo_spells" size="5" maxlength="3" value="{{20_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">23 - $class23name</td></tr>

<tr><td width="20%">$class23name Experience:</td><td><input type="text" name="TwoThree_exp" size="10" maxlength="8" value="{{23_exp}}" /></td></tr>
<tr><td width="20%">$class23name HP:</td><td><input type="text" name="TwoThree_hp" size="5" maxlength="5" value="{{23_hp}}" /></td></tr>
<tr><td width="20%">$class23name MP:</td><td><input type="text" name="TwoThree_mp" size="5" maxlength="5" value="{{23_mp}}" /></td></tr>
<tr><td width="20%">$class23name TP:</td><td><input type="text" name="TwoThree_tp" size="5" maxlength="5" value="{{23_tp}}" /></td></tr>
<tr><td width="20%">$class23name Strength:</td><td><input type="text" name="TwoThree_strength" size="5" maxlength="5" value="{{23_strength}}" /></td></tr>
<tr><td width="20%">$class23name Dexterity:</td><td><input type="text" name="TwoThree_dexterity" size="5" maxlength="5" value="{{23_dexterity}}" /></td></tr>
<tr><td width="20%">$class23name Spells:</td><td><input type="text" name="TwoThree_spells" size="5" maxlength="3" value="{{23_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">24 - $class24name</td></tr>

<tr><td width="20%">$class24name Experience:</td><td><input type="text" name="TwoFour_exp" size="10" maxlength="8" value="{{24_exp}}" /></td></tr>
<tr><td width="20%">$class24name HP:</td><td><input type="text" name="TwoFour_hp" size="5" maxlength="5" value="{{24_hp}}" /></td></tr>
<tr><td width="20%">$class24name MP:</td><td><input type="text" name="TwoFour_mp" size="5" maxlength="5" value="{{24_mp}}" /></td></tr>
<tr><td width="20%">$class24name TP:</td><td><input type="text" name="TwoFour_tp" size="5" maxlength="5" value="{{24_tp}}" /></td></tr>
<tr><td width="20%">$class24name Strength:</td><td><input type="text" name="TwoFour_strength" size="5" maxlength="5" value="{{24_strength}}" /></td></tr>
<tr><td width="20%">$class24name Dexterity:</td><td><input type="text" name="TwoFour_dexterity" size="5" maxlength="5" value="{{24_dexterity}}" /></td></tr>
<tr><td width="20%">$class24name Spells:</td><td><input type="text" name="TwoFour_spells" size="5" maxlength="3" value="{{24_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">25 - $class25name</td></tr>

<tr><td width="20%">$class25name Experience:</td><td><input type="text" name="TwoFive_exp" size="10" maxlength="8" value="{{25_exp}}" /></td></tr>
<tr><td width="20%">$class25name HP:</td><td><input type="text" name="TwoFive_hp" size="5" maxlength="5" value="{{25_hp}}" /></td></tr>
<tr><td width="20%">$class25name MP:</td><td><input type="text" name="TwoFive_mp" size="5" maxlength="5" value="{{25_mp}}" /></td></tr>
<tr><td width="20%">$class25name TP:</td><td><input type="text" name="TwoFive_tp" size="5" maxlength="5" value="{{25_tp}}" /></td></tr>
<tr><td width="20%">$class25name Strength:</td><td><input type="text" name="TwoFive_strength" size="5" maxlength="5" value="{{25_strength}}" /></td></tr>
<tr><td width="20%">$class25name Dexterity:</td><td><input type="text" name="TwoFive_dexterity" size="5" maxlength="5" value="{{25_dexterity}}" /></td></tr>
<tr><td width="20%">$class25name Spells:</td><td><input type="text" name="TwoFive_spells" size="5" maxlength="3" value="{{25_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">26 - $class26name</td></tr>

<tr><td width="20%">$class26name Experience:</td><td><input type="text" name="TwoSix_exp" size="10" maxlength="8" value="{{26_exp}}" /></td></tr>
<tr><td width="20%">$class26name HP:</td><td><input type="text" name="TwoSix_hp" size="5" maxlength="5" value="{{26_hp}}" /></td></tr>
<tr><td width="20%">$class26name MP:</td><td><input type="text" name="TwoSix_mp" size="5" maxlength="5" value="{{26_mp}}" /></td></tr>
<tr><td width="20%">$class26name TP:</td><td><input type="text" name="TwoSix_tp" size="5" maxlength="5" value="{{26_tp}}" /></td></tr>
<tr><td width="20%">$class26name Strength:</td><td><input type="text" name="TwoSix_strength" size="5" maxlength="5" value="{{26_strength}}" /></td></tr>
<tr><td width="20%">$class26name Dexterity:</td><td><input type="text" name="TwoSix_dexterity" size="5" maxlength="5" value="{{26_dexterity}}" /></td></tr>
<tr><td width="20%">$class26name Spells:</td><td><input type="text" name="TwoSix_spells" size="5" maxlength="3" value="{{26_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">27 - $class27name</td></tr>

<tr><td width="20%">$class27name Experience:</td><td><input type="text" name="TwoSeven_exp" size="10" maxlength="8" value="{{27_exp}}" /></td></tr>
<tr><td width="20%">$class27name HP:</td><td><input type="text" name="TwoSeven_hp" size="5" maxlength="5" value="{{27_hp}}" /></td></tr>
<tr><td width="20%">$class27name MP:</td><td><input type="text" name="TwoSeven_mp" size="5" maxlength="5" value="{{27_mp}}" /></td></tr>
<tr><td width="20%">$class27name TP:</td><td><input type="text" name="TwoSeven_tp" size="5" maxlength="5" value="{{27_tp}}" /></td></tr>
<tr><td width="20%">$class27name Strength:</td><td><input type="text" name="TwoSeven_strength" size="5" maxlength="5" value="{{27_strength}}" /></td></tr>
<tr><td width="20%">$class27name Dexterity:</td><td><input type="text" name="TwoSeven_dexterity" size="5" maxlength="5" value="{{27_dexterity}}" /></td></tr>
<tr><td width="20%">$class27name Spells:</td><td><input type="text" name="TwoSeven_spells" size="5" maxlength="3" value="{{27_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">28 - $class28name</td></tr>

<tr><td width="20%">$class28name Experience:</td><td><input type="text" name="TwoEight_exp" size="10" maxlength="8" value="{{28_exp}}" /></td></tr>
<tr><td width="20%">$class28name HP:</td><td><input type="text" name="TwoEight_hp" size="5" maxlength="5" value="{{28_hp}}" /></td></tr>
<tr><td width="20%">$class28name MP:</td><td><input type="text" name="TwoEight_mp" size="5" maxlength="5" value="{{28_mp}}" /></td></tr>
<tr><td width="20%">$class28name TP:</td><td><input type="text" name="TwoEight_tp" size="5" maxlength="5" value="{{28_tp}}" /></td></tr>
<tr><td width="20%">$class28name Strength:</td><td><input type="text" name="TwoEight_strength" size="5" maxlength="5" value="{{28_strength}}" /></td></tr>
<tr><td width="20%">$class28name Dexterity:</td><td><input type="text" name="TwoEight_dexterity" size="5" maxlength="5" value="{{28_dexterity}}" /></td></tr>
<tr><td width="20%">$class28name Spells:</td><td><input type="text" name="TwoEight_spells" size="5" maxlength="3" value="{{28_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">29 - $class29name</td></tr>

<tr><td width="20%">$class29name Experience:</td><td><input type="text" name="TwoNine_exp" size="10" maxlength="8" value="{{29_exp}}" /></td></tr>
<tr><td width="20%">$class29name HP:</td><td><input type="text" name="TwoNine_hp" size="5" maxlength="5" value="{{29_hp}}" /></td></tr>
<tr><td width="20%">$class29name MP:</td><td><input type="text" name="TwoNine_mp" size="5" maxlength="5" value="{{29_mp}}" /></td></tr>
<tr><td width="20%">$class29name TP:</td><td><input type="text" name="TwoNine_tp" size="5" maxlength="5" value="{{29_tp}}" /></td></tr>
<tr><td width="20%">$class29name Strength:</td><td><input type="text" name="TwoNine_strength" size="5" maxlength="5" value="{{29_strength}}" /></td></tr>
<tr><td width="20%">$class29name Dexterity:</td><td><input type="text" name="TwoNine_dexterity" size="5" maxlength="5" value="{{29_dexterity}}" /></td></tr>
<tr><td width="20%">$class29name Spells:</td><td><input type="text" name="TwoNine_spells" size="5" maxlength="3" value="{{29_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">30 - $class30name</td></tr>

<tr><td width="20%">$class30name Experience:</td><td><input type="text" name="ThreeZero_exp" size="10" maxlength="8" value="{{30_exp}}" /></td></tr>
<tr><td width="20%">$class30name HP:</td><td><input type="text" name="ThreeZero_hp" size="5" maxlength="5" value="{{30_hp}}" /></td></tr>
<tr><td width="20%">$class30name MP:</td><td><input type="text" name="ThreeZero_mp" size="5" maxlength="5" value="{{30_mp}}" /></td></tr>
<tr><td width="20%">$class30name TP:</td><td><input type="text" name="ThreeZero_tp" size="5" maxlength="5" value="{{30_tp}}" /></td></tr>
<tr><td width="20%">$class30name Strength:</td><td><input type="text" name="ThreeZero_strength" size="5" maxlength="5" value="{{30_strength}}" /></td></tr>
<tr><td width="20%">$class30name Dexterity:</td><td><input type="text" name="ThreeZero_dexterity" size="5" maxlength="5" value="{{30_dexterity}}" /></td></tr>
<tr><td width="20%">$class30name Spells:</td><td><input type="text" name="ThreeZero_spells" size="5" maxlength="3" value="{{30_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">31 - $class31name</td></tr>

<tr><td width="20%">$class31name Experience:</td><td><input type="text" name="ThreeOne_exp" size="10" maxlength="8" value="{{31_exp}}" /></td></tr>
<tr><td width="20%">$class31name HP:</td><td><input type="text" name="ThreeOne_hp" size="5" maxlength="5" value="{{31_hp}}" /></td></tr>
<tr><td width="20%">$class31name MP:</td><td><input type="text" name="ThreeOne_mp" size="5" maxlength="5" value="{{31_mp}}" /></td></tr>
<tr><td width="20%">$class31name TP:</td><td><input type="text" name="ThreeOne_tp" size="5" maxlength="5" value="{{31_tp}}" /></td></tr>
<tr><td width="20%">$class31name Strength:</td><td><input type="text" name="ThreeOne_strength" size="5" maxlength="5" value="{{31_strength}}" /></td></tr>
<tr><td width="20%">$class31name Dexterity:</td><td><input type="text" name="ThreeOne_dexterity" size="5" maxlength="5" value="{{31_dexterity}}" /></td></tr>
<tr><td width="20%">$class31name Spells:</td><td><input type="text" name="ThreeOne_spells" size="5" maxlength="3" value="{{31_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">32 - $class32name</td></tr>

<tr><td width="20%">$class32name Experience:</td><td><input type="text" name="ThreeTwo_exp" size="10" maxlength="8" value="{{32_exp}}" /></td></tr>
<tr><td width="20%">$class32name HP:</td><td><input type="text" name="ThreeTwo_hp" size="5" maxlength="5" value="{{32_hp}}" /></td></tr>
<tr><td width="20%">$class32name MP:</td><td><input type="text" name="ThreeTwo_mp" size="5" maxlength="5" value="{{32_mp}}" /></td></tr>
<tr><td width="20%">$class32name TP:</td><td><input type="text" name="ThreeTwo_tp" size="5" maxlength="5" value="{{32_tp}}" /></td></tr>
<tr><td width="20%">$class32name Strength:</td><td><input type="text" name="ThreeTwo_strength" size="5" maxlength="5" value="{{32_strength}}" /></td></tr>
<tr><td width="20%">$class32name Dexterity:</td><td><input type="text" name="ThreeTwo_dexterity" size="5" maxlength="5" value="{{32_dexterity}}" /></td></tr>
<tr><td width="20%">$class32name Spells:</td><td><input type="text" name="ThreeTwo_spells" size="5" maxlength="3" value="{{32_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">33 - $class33name</td></tr>

<tr><td width="20%">$class33name Experience:</td><td><input type="text" name="ThreeThree_exp" size="10" maxlength="8" value="{{33_exp}}" /></td></tr>
<tr><td width="20%">$class33name HP:</td><td><input type="text" name="ThreeThree_hp" size="5" maxlength="5" value="{{33_hp}}" /></td></tr>
<tr><td width="20%">$class33name MP:</td><td><input type="text" name="ThreeThree_mp" size="5" maxlength="5" value="{{33_mp}}" /></td></tr>
<tr><td width="20%">$class33name TP:</td><td><input type="text" name="ThreeThree_tp" size="5" maxlength="5" value="{{33_tp}}" /></td></tr>
<tr><td width="20%">$class33name Strength:</td><td><input type="text" name="ThreeThree_strength" size="5" maxlength="5" value="{{33_strength}}" /></td></tr>
<tr><td width="20%">$class33name Dexterity:</td><td><input type="text" name="ThreeThree_dexterity" size="5" maxlength="5" value="{{33_dexterity}}" /></td></tr>
<tr><td width="20%">$class33name Spells:</td><td><input type="text" name="ThreeThree_spells" size="5" maxlength="3" value="{{33_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">34 - $class34name</td></tr>

<tr><td width="20%">$class34name Experience:</td><td><input type="text" name="ThreeFour_exp" size="10" maxlength="8" value="{{34_exp}}" /></td></tr>
<tr><td width="20%">$class34name HP:</td><td><input type="text" name="ThreeFour_hp" size="5" maxlength="5" value="{{34_hp}}" /></td></tr>
<tr><td width="20%">$class34name MP:</td><td><input type="text" name="ThreeFour_mp" size="5" maxlength="5" value="{{34_mp}}" /></td></tr>
<tr><td width="20%">$class34name TP:</td><td><input type="text" name="ThreeFour_tp" size="5" maxlength="5" value="{{34_tp}}" /></td></tr>
<tr><td width="20%">$class34name Strength:</td><td><input type="text" name="ThreeFour_strength" size="5" maxlength="5" value="{{34_strength}}" /></td></tr>
<tr><td width="20%">$class34name Dexterity:</td><td><input type="text" name="ThreeFour_dexterity" size="5" maxlength="5" value="{{34_dexterity}}" /></td></tr>
<tr><td width="20%">$class34name Spells:</td><td><input type="text" name="ThreeFour_spells" size="5" maxlength="3" value="{{34_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">35 - $class35name</td></tr>

<tr><td width="20%">$class35name Experience:</td><td><input type="text" name="ThreeFive_exp" size="10" maxlength="8" value="{{35_exp}}" /></td></tr>
<tr><td width="20%">$class35name HP:</td><td><input type="text" name="ThreeFive_hp" size="5" maxlength="5" value="{{35_hp}}" /></td></tr>
<tr><td width="20%">$class35name MP:</td><td><input type="text" name="ThreeFive_mp" size="5" maxlength="5" value="{{35_mp}}" /></td></tr>
<tr><td width="20%">$class35name TP:</td><td><input type="text" name="ThreeFive_tp" size="5" maxlength="5" value="{{35_tp}}" /></td></tr>
<tr><td width="20%">$class35name Strength:</td><td><input type="text" name="ThreeFive_strength" size="5" maxlength="5" value="{{35_strength}}" /></td></tr>
<tr><td width="20%">$class35name Dexterity:</td><td><input type="text" name="ThreeFive_dexterity" size="5" maxlength="5" value="{{35_dexterity}}" /></td></tr>
<tr><td width="20%">$class35name Spells:</td><td><input type="text" name="ThreeFive_spells" size="5" maxlength="3" value="{{35_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">36 - $class36name</td></tr>

<tr><td width="20%">$class36name Experience:</td><td><input type="text" name="ThreeSix_exp" size="10" maxlength="8" value="{{36_exp}}" /></td></tr>
<tr><td width="20%">$class36name HP:</td><td><input type="text" name="ThreeSix_hp" size="5" maxlength="5" value="{{36_hp}}" /></td></tr>
<tr><td width="20%">$class36name MP:</td><td><input type="text" name="ThreeSix_mp" size="5" maxlength="5" value="{{36_mp}}" /></td></tr>
<tr><td width="20%">$class36name TP:</td><td><input type="text" name="ThreeSix_tp" size="5" maxlength="5" value="{{36_tp}}" /></td></tr>
<tr><td width="20%">$class36name Strength:</td><td><input type="text" name="ThreeSix_strength" size="5" maxlength="5" value="{{36_strength}}" /></td></tr>
<tr><td width="20%">$class36name Dexterity:</td><td><input type="text" name="ThreeSix_dexterity" size="5" maxlength="5" value="{{36_dexterity}}" /></td></tr>
<tr><td width="20%">$class36name Spells:</td><td><input type="text" name="ThreeSix_spells" size="5" maxlength="3" value="{{36_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">37 - $class37name</td></tr>

<tr><td width="20%">$class37name Experience:</td><td><input type="text" name="ThreeSeven_exp" size="10" maxlength="8" value="{{37_exp}}" /></td></tr>
<tr><td width="20%">$class37name HP:</td><td><input type="text" name="ThreeSeven_hp" size="5" maxlength="5" value="{{37_hp}}" /></td></tr>
<tr><td width="20%">$class37name MP:</td><td><input type="text" name="ThreeSeven_mp" size="5" maxlength="5" value="{{37_mp}}" /></td></tr>
<tr><td width="20%">$class37name TP:</td><td><input type="text" name="ThreeSeven_tp" size="5" maxlength="5" value="{{37_tp}}" /></td></tr>
<tr><td width="20%">$class37name Strength:</td><td><input type="text" name="ThreeSeven_strength" size="5" maxlength="5" value="{{37_strength}}" /></td></tr>
<tr><td width="20%">$class37name Dexterity:</td><td><input type="text" name="ThreeSeven_dexterity" size="5" maxlength="5" value="{{37_dexterity}}" /></td></tr>
<tr><td width="20%">$class37name Spells:</td><td><input type="text" name="ThreeSeven_spells" size="5" maxlength="3" value="{{37_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">38 - $class38name</td></tr>

<tr><td width="20%">$class38name Experience:</td><td><input type="text" name="ThreeEight_exp" size="10" maxlength="8" value="{{38_exp}}" /></td></tr>
<tr><td width="20%">$class38name HP:</td><td><input type="text" name="ThreeEight_hp" size="5" maxlength="5" value="{{38_hp}}" /></td></tr>
<tr><td width="20%">$class38name MP:</td><td><input type="text" name="ThreeEight_mp" size="5" maxlength="5" value="{{38_mp}}" /></td></tr>
<tr><td width="20%">$class38name TP:</td><td><input type="text" name="ThreeEight_tp" size="5" maxlength="5" value="{{38_tp}}" /></td></tr>
<tr><td width="20%">$class38name Strength:</td><td><input type="text" name="ThreeEight_strength" size="5" maxlength="5" value="{{38_strength}}" /></td></tr>
<tr><td width="20%">$class38name Dexterity:</td><td><input type="text" name="ThreeEight_dexterity" size="5" maxlength="5" value="{{38_dexterity}}" /></td></tr>
<tr><td width="20%">$class38name Spells:</td><td><input type="text" name="ThreeEight_spells" size="5" maxlength="3" value="{{38_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">39 - $class39name</td></tr>

<tr><td width="20%">$class39name Experience:</td><td><input type="text" name="ThreeNine_exp" size="10" maxlength="8" value="{{39_exp}}" /></td></tr>
<tr><td width="20%">$class39name HP:</td><td><input type="text" name="ThreeNine_hp" size="5" maxlength="5" value="{{39_hp}}" /></td></tr>
<tr><td width="20%">$class39name MP:</td><td><input type="text" name="ThreeNine_mp" size="5" maxlength="5" value="{{39_mp}}" /></td></tr>
<tr><td width="20%">$class39name TP:</td><td><input type="text" name="ThreeNine_tp" size="5" maxlength="5" value="{{39_tp}}" /></td></tr>
<tr><td width="20%">$class39name Strength:</td><td><input type="text" name="ThreeNine_strength" size="5" maxlength="5" value="{{39_strength}}" /></td></tr>
<tr><td width="20%">$class39name Dexterity:</td><td><input type="text" name="ThreeNine_dexterity" size="5" maxlength="5" value="{{39_dexterity}}" /></td></tr>
<tr><td width="20%">$class39name Spells:</td><td><input type="text" name="ThreeNine_spells" size="5" maxlength="3" value="{{39_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">40 - $class40name</td></tr>

<tr><td width="20%">$class40name Experience:</td><td><input type="text" name="FourZero_exp" size="10" maxlength="8" value="{{40_exp}}" /></td></tr>
<tr><td width="20%">$class40name HP:</td><td><input type="text" name="FourZero_hp" size="5" maxlength="5" value="{{40_hp}}" /></td></tr>
<tr><td width="20%">$class40name MP:</td><td><input type="text" name="FourZero_mp" size="5" maxlength="5" value="{{40_mp}}" /></td></tr>
<tr><td width="20%">$class40name TP:</td><td><input type="text" name="FourZero_tp" size="5" maxlength="5" value="{{40_tp}}" /></td></tr>
<tr><td width="20%">$class40name Strength:</td><td><input type="text" name="FourZero_strength" size="5" maxlength="5" value="{{40_strength}}" /></td></tr>
<tr><td width="20%">$class40name Dexterity:</td><td><input type="text" name="FourZero_dexterity" size="5" maxlength="5" value="{{40_dexterity}}" /></td></tr>
<tr><td width="20%">$class40name Spells:</td><td><input type="text" name="FourZero_spells" size="5" maxlength="3" value="{{40_spells}}" /></td></tr>

  
<tr><td colspan="2" style="background-color:#cccccc;">41 - $class41name</td></tr>

<tr><td width="20%">$class41name Experience:</td><td><input type="text" name="FourOne_exp" size="10" maxlength="8" value="{{41_exp}}" /></td></tr>
<tr><td width="20%">$class41name HP:</td><td><input type="text" name="FourOne_hp" size="5" maxlength="5" value="{{41_hp}}" /></td></tr>
<tr><td width="20%">$class41name MP:</td><td><input type="text" name="FourOne_mp" size="5" maxlength="5" value="{{41_mp}}" /></td></tr>
<tr><td width="20%">$class41name TP:</td><td><input type="text" name="FourOne_tp" size="5" maxlength="5" value="{{41_tp}}" /></td></tr>
<tr><td width="20%">$class41name Strength:</td><td><input type="text" name="FourOne_strength" size="5" maxlength="5" value="{{41_strength}}" /></td></tr>
<tr><td width="20%">$class41name Dexterity:</td><td><input type="text" name="FourOne_dexterity" size="5" maxlength="5" value="{{41_dexterity}}" /></td></tr>
<tr><td width="20%">$class41name Spells:</td><td><input type="text" name="FourOne_spells" size="5" maxlength="3" value="{{41_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">42 - $class42name</td></tr>

<tr><td width="20%">$class42name Experience:</td><td><input type="text" name="FourTwo_exp" size="10" maxlength="8" value="{{42_exp}}" /></td></tr>
<tr><td width="20%">$class42name HP:</td><td><input type="text" name="FourTwo_hp" size="5" maxlength="5" value="{{42_hp}}" /></td></tr>
<tr><td width="20%">$class42name MP:</td><td><input type="text" name="FourTwo_mp" size="5" maxlength="5" value="{{42_mp}}" /></td></tr>
<tr><td width="20%">$class42name TP:</td><td><input type="text" name="FourTwo_tp" size="5" maxlength="5" value="{{42_tp}}" /></td></tr>
<tr><td width="20%">$class42name Strength:</td><td><input type="text" name="FourTwo_strength" size="5" maxlength="5" value="{{42_strength}}" /></td></tr>
<tr><td width="20%">$class42name Dexterity:</td><td><input type="text" name="FourTwo_dexterity" size="5" maxlength="5" value="{{42_dexterity}}" /></td></tr>
<tr><td width="20%">$class42name Spells:</td><td><input type="text" name="FourTwo_spells" size="5" maxlength="3" value="{{42_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">43 - $class43name</td></tr>

<tr><td width="20%">$class43name Experience:</td><td><input type="text" name="FourThree_exp" size="10" maxlength="8" value="{{43_exp}}" /></td></tr>
<tr><td width="20%">$class43name HP:</td><td><input type="text" name="FourThree_hp" size="5" maxlength="5" value="{{43_hp}}" /></td></tr>
<tr><td width="20%">$class43name MP:</td><td><input type="text" name="FourThree_mp" size="5" maxlength="5" value="{{43_mp}}" /></td></tr>
<tr><td width="20%">$class43name TP:</td><td><input type="text" name="FourThree_tp" size="5" maxlength="5" value="{{43_tp}}" /></td></tr>
<tr><td width="20%">$class43name Strength:</td><td><input type="text" name="FourThree_strength" size="5" maxlength="5" value="{{43_strength}}" /></td></tr>
<tr><td width="20%">$class43name Dexterity:</td><td><input type="text" name="FourThree_dexterity" size="5" maxlength="5" value="{{43_dexterity}}" /></td></tr>
<tr><td width="20%">$class43name Spells:</td><td><input type="text" name="FourThree_spells" size="5" maxlength="3" value="{{43_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">44 - $class44name</td></tr>

<tr><td width="20%">$class44name Experience:</td><td><input type="text" name="FourFour_exp" size="10" maxlength="8" value="{{44_exp}}" /></td></tr>
<tr><td width="20%">$class44name HP:</td><td><input type="text" name="FourFour_hp" size="5" maxlength="5" value="{{44_hp}}" /></td></tr>
<tr><td width="20%">$class44name MP:</td><td><input type="text" name="FourFour_mp" size="5" maxlength="5" value="{{44_mp}}" /></td></tr>
<tr><td width="20%">$class44name TP:</td><td><input type="text" name="FourFour_tp" size="5" maxlength="5" value="{{44_tp}}" /></td></tr>
<tr><td width="20%">$class44name Strength:</td><td><input type="text" name="FourFour_strength" size="5" maxlength="5" value="{{44_strength}}" /></td></tr>
<tr><td width="20%">$class44name Dexterity:</td><td><input type="text" name="FourFour_dexterity" size="5" maxlength="5" value="{{44_dexterity}}" /></td></tr>
<tr><td width="20%">$class44name Spells:</td><td><input type="text" name="FourFour_spells" size="5" maxlength="3" value="{{44_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">45 - $class45name</td></tr>

<tr><td width="20%">$class45name Experience:</td><td><input type="text" name="FourFive_exp" size="10" maxlength="8" value="{{45_exp}}" /></td></tr>
<tr><td width="20%">$class45name HP:</td><td><input type="text" name="FourFive_hp" size="5" maxlength="5" value="{{45_hp}}" /></td></tr>
<tr><td width="20%">$class45name MP:</td><td><input type="text" name="FourFive_mp" size="5" maxlength="5" value="{{45_mp}}" /></td></tr>
<tr><td width="20%">$class45name TP:</td><td><input type="text" name="FourFive_tp" size="5" maxlength="5" value="{{45_tp}}" /></td></tr>
<tr><td width="20%">$class45name Strength:</td><td><input type="text" name="FourFive_strength" size="5" maxlength="5" value="{{45_strength}}" /></td></tr>
<tr><td width="20%">$class45name Dexterity:</td><td><input type="text" name="FourFive_dexterity" size="5" maxlength="5" value="{{45_dexterity}}" /></td></tr>
<tr><td width="20%">$class45name Spells:</td><td><input type="text" name="FourFive_spells" size="5" maxlength="3" value="{{45_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">46 - $class46name</td></tr>

<tr><td width="20%">$class46name Experience:</td><td><input type="text" name="FourSix_exp" size="10" maxlength="8" value="{{46_exp}}" /></td></tr>
<tr><td width="20%">$class46name HP:</td><td><input type="text" name="FourSix_hp" size="5" maxlength="5" value="{{46_hp}}" /></td></tr>
<tr><td width="20%">$class46name MP:</td><td><input type="text" name="FourSix_mp" size="5" maxlength="5" value="{{46_mp}}" /></td></tr>
<tr><td width="20%">$class46name TP:</td><td><input type="text" name="FourSix_tp" size="5" maxlength="5" value="{{46_tp}}" /></td></tr>
<tr><td width="20%">$class46name Strength:</td><td><input type="text" name="FourSix_strength" size="5" maxlength="5" value="{{46_strength}}" /></td></tr>
<tr><td width="20%">$class46name Dexterity:</td><td><input type="text" name="FoureSix_dexterity" size="5" maxlength="5" value="{{46_dexterity}}" /></td></tr>
<tr><td width="20%">$class46name Spells:</td><td><input type="text" name="FourSix_spells" size="5" maxlength="3" value="{{46_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">47 - $class47name</td></tr>

<tr><td width="20%">$class47name Experience:</td><td><input type="text" name="FourSeven_exp" size="10" maxlength="8" value="{{47_exp}}" /></td></tr>
<tr><td width="20%">$class47name HP:</td><td><input type="text" name="FourSeven_hp" size="5" maxlength="5" value="{{47_hp}}" /></td></tr>
<tr><td width="20%">$class47name MP:</td><td><input type="text" name="FourSeven_mp" size="5" maxlength="5" value="{{47_mp}}" /></td></tr>
<tr><td width="20%">$class47name TP:</td><td><input type="text" name="FourSeven_tp" size="5" maxlength="5" value="{{47_tp}}" /></td></tr>
<tr><td width="20%">$class47name Strength:</td><td><input type="text" name="FourSeven_strength" size="5" maxlength="5" value="{{47_strength}}" /></td></tr>
<tr><td width="20%">$class47name Dexterity:</td><td><input type="text" name="FourSeven_dexterity" size="5" maxlength="5" value="{{47_dexterity}}" /></td></tr>
<tr><td width="20%">$class47name Spells:</td><td><input type="text" name="FourSeven_spells" size="5" maxlength="3" value="{{47_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">48 - $class48name</td></tr>

<tr><td width="20%">$class48name Experience:</td><td><input type="text" name="FourEight_exp" size="10" maxlength="8" value="{{48_exp}}" /></td></tr>
<tr><td width="20%">$class48name HP:</td><td><input type="text" name="FourEight_hp" size="5" maxlength="5" value="{{48_hp}}" /></td></tr>
<tr><td width="20%">$class48name MP:</td><td><input type="text" name="FourEight_mp" size="5" maxlength="5" value="{{48_mp}}" /></td></tr>
<tr><td width="20%">$class48name TP:</td><td><input type="text" name="FourEight_tp" size="5" maxlength="5" value="{{48_tp}}" /></td></tr>
<tr><td width="20%">$class48name Strength:</td><td><input type="text" name="FourEight_strength" size="5" maxlength="5" value="{{48_strength}}" /></td></tr>
<tr><td width="20%">$class48name Dexterity:</td><td><input type="text" name="FourEight_dexterity" size="5" maxlength="5" value="{{48_dexterity}}" /></td></tr>
<tr><td width="20%">$class48name Spells:</td><td><input type="text" name="FourEight_spells" size="5" maxlength="3" value="{{48_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">49 - $class49name</td></tr>

<tr><td width="20%">$class49name Experience:</td><td><input type="text" name="FourNine_exp" size="10" maxlength="8" value="{{49_exp}}" /></td></tr>
<tr><td width="20%">$class49name HP:</td><td><input type="text" name="FourNine_hp" size="5" maxlength="5" value="{{49_hp}}" /></td></tr>
<tr><td width="20%">$class49name MP:</td><td><input type="text" name="FourNine_mp" size="5" maxlength="5" value="{{49_mp}}" /></td></tr>
<tr><td width="20%">$class49name TP:</td><td><input type="text" name="FourNine_tp" size="5" maxlength="5" value="{{49_tp}}" /></td></tr>
<tr><td width="20%">$class49name Strength:</td><td><input type="text" name="FourNine_strength" size="5" maxlength="5" value="{{49_strength}}" /></td></tr>
<tr><td width="20%">$class49name Dexterity:</td><td><input type="text" name="FourNine_dexterity" size="5" maxlength="5" value="{{49_dexterity}}" /></td></tr>
<tr><td width="20%">$class49name Spells:</td><td><input type="text" name="FourNine_spells" size="5" maxlength="3" value="{{49_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">50 - $class50name</td></tr>

<tr><td width="20%">$class50name Experience:</td><td><input type="text" name="FiveZero_exp" size="10" maxlength="8" value="{{50_exp}}" /></td></tr>
<tr><td width="20%">$class50name HP:</td><td><input type="text" name="FiveZero_hp" size="5" maxlength="5" value="{{50_hp}}" /></td></tr>
<tr><td width="20%">$class50name MP:</td><td><input type="text" name="FiveZero_mp" size="5" maxlength="5" value="{{50_mp}}" /></td></tr>
<tr><td width="20%">$class50name TP:</td><td><input type="text" name="FiveZero_tp" size="5" maxlength="5" value="{{50_tp}}" /></td></tr>
<tr><td width="20%">$class50name Strength:</td><td><input type="text" name="FiveZero_strength" size="5" maxlength="5" value="{{50_strength}}" /></td></tr>
<tr><td width="20%">$class50name Dexterity:</td><td><input type="text" name="FiveZero_dexterity" size="5" maxlength="5" value="{{50_dexterity}}" /></td></tr>
<tr><td width="20%">$class50name Spells:</td><td><input type="text" name="FiveZero_spells" size="5" maxlength="3" value="{{50_spells}}" /></td></tr>
  
<tr><td colspan="2" style="background-color:#cccccc;">51 - $class51name</td></tr>

<tr><td width="20%">$class51name Experience:</td><td><input type="text" name="FiveOne_exp" size="10" maxlength="8" value="{{51_exp}}" /></td></tr>
<tr><td width="20%">$class51name HP:</td><td><input type="text" name="FiveOne_hp" size="5" maxlength="5" value="{{51_hp}}" /></td></tr>
<tr><td width="20%">$class51name MP:</td><td><input type="text" name="FiveOne_mp" size="5" maxlength="5" value="{{51_mp}}" /></td></tr>
<tr><td width="20%">$class51name TP:</td><td><input type="text" name="FiveOne_tp" size="5" maxlength="5" value="{{51_tp}}" /></td></tr>
<tr><td width="20%">$class51name Strength:</td><td><input type="text" name="FiveOne_strength" size="5" maxlength="5" value="{{51_strength}}" /></td></tr>
<tr><td width="20%">$class51name Dexterity:</td><td><input type="text" name="FiveOne_dexterity" size="5" maxlength="5" value="{{51_dexterity}}" /></td></tr>
<tr><td width="20%">$class51name Spells:</td><td><input type="text" name="FiveOne_spells" size="5" maxlength="3" value="{{51_spells}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">52 - $class52name</td></tr>

<tr><td width="20%">$class52name Experience:</td><td><input type="text" name="FiveTwo_exp" size="10" maxlength="8" value="{{52_exp}}" /></td></tr>
<tr><td width="20%">$class52name HP:</td><td><input type="text" name="FiveTwo_hp" size="5" maxlength="5" value="{{52_hp}}" /></td></tr>
<tr><td width="20%">$class52name MP:</td><td><input type="text" name="FiveTwo_mp" size="5" maxlength="5" value="{{52_mp}}" /></td></tr>
<tr><td width="20%">$class52name TP:</td><td><input type="text" name="FiveTwo_tp" size="5" maxlength="5" value="{{52_tp}}" /></td></tr>
<tr><td width="20%">$class52name Strength:</td><td><input type="text" name="FiveTwo_strength" size="5" maxlength="5" value="{{52_strength}}" /></td></tr>
<tr><td width="20%">$class52name Dexterity:</td><td><input type="text" name="FiveTwo_dexterity" size="5" maxlength="5" value="{{52_dexterity}}" /></td></tr>
<tr><td width="20%">$class52name Spells:</td><td><input type="text" name="FiveTwo_spells" size="5" maxlength="3" value="{{52_spells}}" /></td></tr>
	
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form>
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Levels");
    
}


function lords() {
$lordsquery = doquery("SELECT id,lordname FROM {{table}} ORDER BY id", "lords");
$page = "<u>Edit Lords</u><br />Click a lord name to edit the account.<br /><br /><table width=\"50%\">\n";
$count = 1;
while ($lordsrow = mysql_fetch_array($lordsquery)) {
if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #cccccc;\">".$lordsrow["id"]."</td><td style=\"background-color: #cccccc;\"><a href=\"admin.php?do=editlords:".$lordsrow["id"]."\">".$lordsrow["lordname"]."</a></td></tr>\n"; $count = 2; }
else { $page .= "<tr><td width=\"8%\" style=\"background-color: #cccccc;\">".$lordsrow["id"]."</td><td style=\"background-color: #cccccc;\"><a href=\"admin.php?do=editlords:".$lordsrow["id"]."\">".$lordsrow["lordname"]."</a></td></tr>\n"; $count = 1; } }
if (mysql_num_rows($lordsquery) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #cccccc;\">No spells found.</td></tr>\n"; }
$page .= "</table>";
admindisplay($page, "Edit Lords"); }

function editlords($id) {
if (isset($_POST["submit"])) {
extract($_POST);
$errors = 0;
$errorlist = "";

if ($tactical == "") { $errors++; $errorlist .= "Tactical is required.<br />"; }
if ($honor == "") { $errors++; $errorlist .= "Honor is required.<br />"; }
if ($land == "") { $errors++; $errorlist .= "Land Owned is required.<br />"; }
if ($offarmy == "") { $errors++; $errorlist .= "Offensive Troops is required.<br />"; }
if ($dffarmy == "") { $errors++; $errorlist .= "Defensive Troops is required.<br />"; }
if ($treasury == "") { $errors++; $errorlist .= "Treasury is required.<br />"; }
if ($battot == "") { $errors++; $errorlist .= "Total Battles is required.<br />"; }
if ($batwins == "") { $errors++; $errorlist .= "Battles Won is required.<br />"; }
if ($batloss == "") { $errors++; $errorlist .= "Battles Lost is required.<br />"; }
if ($landwon == "") { $errors++; $errorlist .= "Land Won is required.<br />"; }
if ($landlost == "") { $errors++; $errorlist .= "Land Lost is required.<br />"; }
if ($troopskilled == "") { $errors++; $errorlist .= "Troops Killed is required.<br />"; }
if ($troopslost == "") { $errors++; $errorlist .= "Troops Lost is required.<br />"; }
if ($killed == "") { $errors++; $errorlist .= "Killed Troops is required.<br />"; }
if ($lost == "") { $errors++; $errorlist .= "Lost Troops is required.<br />"; }
if ($lostgold == "") { $errors++; $errorlist .= "Lost Gold is required.<br />"; }
if ($lostland == "") { $errors++; $errorlist .= "Lost Land is required.<br />"; }
if ($taxaction == "") { $errors++; $errorlist .= "Tax Action is required.<br />"; }
if ($attackaction == "") { $errors++; $errorlist .= "Attack Action is required.<br />"; }
if ($landname == "") { $errors++; $errorlist .= "Current MP is required.<br />"; }
if ($total == "") { $errors++; $errorlist .= "Current HP is required.<br />"; }		
if ($exchanged == "") { $errors++; $errorlist .= "Max HP is required.<br />"; }		
if ($attstrength == "") { $errors++; $errorlist .= "Current TP is required.<br />"; }
if ($dffstrength == "") { $errors++; $errorlist .= "Max HP is required.<br />"; }	
				

if (!is_numeric($total)) { $errors++; $errorlist .= "Current HP is required.<br />"; }		
if (!is_numeric($exchanged)) { $errors++; $errorlist .= "Max HP is required.<br />"; }		
if (!is_numeric($attstrength)) { $errors++; $errorlist .= "Current TP is required.<br />"; }
if (!is_numeric($dffstrength)) { $errors++; $errorlist .= "Max HP is required.<br />"; }	
if (!is_numeric($tactical)) { $errors++; $errorlist .= "Tactical must be a number.<br />"; }
if (!is_numeric($honor)) { $errors++; $errorlist .= "Honor must be a number.<br />"; }
if (!is_numeric($land)) { $errors++; $errorlist .= "Land must be a number.<br />"; }
if (!is_numeric($offarmy)) { $errors++; $errorlist .= "Offensive Troops must be a number.<br />"; }
if (!is_numeric($dffarmy)) { $errors++; $errorlist .= "Defensive Troops must be a number.<br />"; }
if (!is_numeric($treasury)) { $errors++; $errorlist .= "Treasury must be a number.<br />"; }
if (!is_numeric($battot)) { $errors++; $errorlist .= "Total Battles must be a number.<br />"; }
if (!is_numeric($batwins)) { $errors++; $errorlist .= "Battles Won be a number.<br />"; }
if (!is_numeric($batloss)) { $errors++; $errorlist .= "Battles Lost be a number.<br />"; }
if (!is_numeric($landwon)) { $errors++; $errorlist .= "Land Won be a number.<br />"; }
if (!is_numeric($landlost)) { $errors++; $errorlist .= "Land Lost must be a number.<br />"; }
if (!is_numeric($troopskilled)) { $errors++; $errorlist .= "Troops Killed must be a number.<br />"; }
if (!is_numeric($troopslost)) { $errors++; $errorlist .= "Troops Lost must be a number.<br />"; }
if (!is_numeric($killed)) { $errors++; $errorlist .= "Killed Troops must be a number.<br />"; }
if (!is_numeric($lost)) { $errors++; $errorlist .= "Lost Troops must be a number.<br />"; }
if (!is_numeric($lostgold)) { $errors++; $errorlist .= "Lost Gold must be a number.<br />"; }
if (!is_numeric($lostland)) { $errors++; $errorlist .= "Lost Land must be a number.<br />"; }
if (!is_numeric($taxaction)) { $errors++; $errorlist .= "Tax Action must be a number.<br />"; }
if (!is_numeric($attackaction)) { $errors++; $errorlist .= "Attack Action must be a number.<br />"; }

if ($errors == 0) { 
$updatequery = <<<END
UPDATE {{table}} SET
tactical="$tactical", honor="$honor", land="$land", offarmy="$offarmy", dffarmy="$dffarmy", 
treasury="$treasury", battot="$battot", batwins="$batwins", batloss="$batloss", 
landwon="$landwon", landlost="$landlost", troopskilled="$troopskilled", troopslost="$troopslost", 
attname="$attname", killed="$killed", lost="$lost", lostgold="$lostgold", lostland="$lostland", 
outcome="$outcome", taxaction="$taxaction", attackaction="$attackaction", landname="$landname" WHERE id="$id" LIMIT 1
END;
$query = doquery($updatequery, "lords");
admindisplay("Lord updated.","Edit Lords");
} else {
admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Lords"); } }

$lordsquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "lords");
$lordsrow = mysql_fetch_array($lordsquery);

$page = <<<END
<u>Edit Lords</u><br /><br />
<form action="admin.php?do=editlords:$id" method="post">
<table width="90%">

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp; Lord Information</td></tr>

<tr><td width="20%">ID:</td><td>{{id}}</td></tr>
<tr><td width="20%">Status:</td><td>{{status}}</td></tr>
<tr><td width="20%">Lord Name:</td><td>{{lordname}}</td></tr>
<tr><td width="20%">Alignment:</td><td>{{alignment}}</td></tr>
<tr><td width="20%">Land Name:</td><td>{{landname}}</td></tr>
<tr><td width="20%">Land Name:</td>
<td><input type="text" name="landname" size="26" maxlength="30" value="{{landname}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp; Lord Skills</td></tr>

<tr><td width="20%">Tactical:</td><td><input type="text" name="tactical" size="5" maxlength="5" value="{{tactical}}" /></td></tr>
<tr><td width="20%">Honor:</td><td><input type="text" name="honor" size="5" maxlength="5" value="{{honor}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp; Land & Soldiers Controlled</td></tr>

<tr><td width="20%">Land Owned:</td><td><input type="text" name="land" size="5" maxlength="5" value="{{land}}" /></td></tr>
<tr><td width="20%">Offensive Troops:</td><td><input type="text" name="offarmy" size="5" maxlength="5" value="{{offarmy}}" /></td></tr>
<tr><td width="20%">Defensive Troops:</td><td><input type="text" name="dffarmy" size="5" maxlength="5" value="{{dffarmy}}" /></td></tr>
<tr><td width="20%">Treasury:</td><td><input type="text" name="treasury" size="10" maxlength="10" value="{{treasury}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp; Battle Record</td></tr>

<tr><td width="20%">Total Battles:</td><td><input type="text" name="battot" size="5" maxlength="5" value="{{battot}}" /></td></tr>
<tr><td width="20%">Battles Won:</td><td><input type="text" name="batwins" size="5" maxlength="5" value="{{batwins}}" /></td></tr>
<tr><td width="20%">Battles Lost:</td><td><input type="text" name="batloss" size="5" maxlength="5" value="{{batloss}}" /></td></tr>
<tr><td width="20%">Land Won:</td><td><input type="text" name="landwon" size="5" maxlength="5" value="{{landwon}}" /></td></tr>
<tr><td width="20%">Land Lost:</td><td><input type="text" name="landlost" size="5" maxlength="5" value="{{landlost}}" /></td></tr>
<tr><td width="20%">Troops Killed:</td><td><input type="text" name="troopskilled" size="5" maxlength="5" value="{{troopskilled}}" /></td></tr>
<tr><td width="20%">Troops Lost:</td><td><input type="text" name="troopslost" size="5" maxlength="5" value="{{troopslost}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp; Last Attacked By</td></tr>

<tr><td width="20%">Attacker Name:</td><td><input type="text" name="attname" size="30" maxlength="30" value="{{attname}}" /></td></tr>
<tr><td width="20%">Killed Troops:</td><td><input type="text" name="killed" size="5" maxlength="5" value="{{killed}}" /></td></tr>
<tr><td width="20%">Lost Troops:</td><td><input type="text" name="lost" size="5" maxlength="5" value="{{lost}}" /></td></tr>
<tr><td width="20%">Lost Gold:</td><td><input type="text" name="lostgold" size="5" maxlength="5" value="{{lostgold}}" /></td></tr>
<tr><td width="20%">Lost Land:</td><td><input type="text" name="lostland" size="5" maxlength="5" value="{{lostland}}" /></td></tr>
<tr><td width="20%">Outcome:</td><td><input type="text" name="outcome" size="5" maxlength="5" value="{{outcome}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp; Lord Actions</td></tr>

<tr><td width="20%">Tax Action:</td><td><input type="text" name="taxaction" size="20" maxlength="20" value="{{taxaction}}" /></td></tr>
<tr><td width="20%">Attack Action:</td><td><input type="text" name="attackaction" size="20" maxlength="20" value="{{attackaction}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">&nbsp;</td></tr>

</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</form><br /><br />
END;
$page = parsetemplate($page, $lordsrow);
admindisplay($page, "Edit Lords"); }

function users() {
    
    $query = doquery("SELECT id,username FROM {{table}} ORDER BY id", "users");
    $page = "<u>Edit Users</u><br />Click a username to edit the account.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=edituser:".$row["id"]."\">".$row["username"]."</a></td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=edituser:".$row["id"]."\">".$row["username"]."</a></td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No spells found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Users");
}

function edituser($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($email == "") { $errors++; $errorlist .= "Email is required.<br />"; }
        if ($verify == "") { $errors++; $errorlist .= "Verify is required.<br />"; }
        if ($charname == "") { $errors++; $errorlist .= "Character Name is required.<br />"; }
        if ($authlevel == "") { $errors++; $errorlist .= "Auth Level is required.<br />"; }
        if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
        if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
        if ($difficulty == "") { $errors++; $errorlist .= "Difficulty is required.<br />"; }
        if ($charclass == "") { $errors++; $errorlist .= "Character Class is required.<br />"; }
		if ($charalign == "") { $errors++; $errorlist .= "Character Alignment is required.<br />"; }
        if ($currentaction == "") { $errors++; $errorlist .= "Current Action is required.<br />"; }
        if ($currentfight == "") { $errors++; $errorlist .= "Current Fight is required.<br />"; }
        
        if ($currentmonster == "") { $errors++; $errorlist .= "Current Monster is required.<br />"; }
        if ($currentmonsterhp == "") { $errors++; $errorlist .= "Current Monster HP is required.<br />"; }
        if ($currentmonstersleep == "") { $errors++; $errorlist .= "Current Monster Sleep is required.<br />"; }
        if ($currentmonsterimmune == "") { $errors++; $errorlist .= "Current Monster Immune is required.<br />"; }
        if ($currentuberdamage == "") { $errors++; $errorlist .= "Current Uber Damage is required.<br />"; }
        if ($currentuberdefense == "") { $errors++; $errorlist .= "Current Uber Defense is required.<br />"; }
        if ($currenthp == "") { $errors++; $errorlist .= "Current HP is required.<br />"; }
        if ($currentmp == "") { $errors++; $errorlist .= "Current MP is required.<br />"; }
        if ($currenttp == "") { $errors++; $errorlist .= "Current TP is required.<br />"; }
        if ($maxhp == "") { $errors++; $errorlist .= "Max HP is required.<br />"; }

        if ($maxmp == "") { $errors++; $errorlist .= "Max MP is required.<br />"; }
        if ($maxtp == "") { $errors++; $errorlist .= "Max TP is required.<br />"; }
        if ($level == "") { $errors++; $errorlist .= "Level is required.<br />"; }
        if ($gold == "") { $errors++; $errorlist .= "Gold is required.<br />"; }
        if ($experience == "") { $errors++; $errorlist .= "Experience is required.<br />"; }
        if ($goldbonus == "") { $errors++; $errorlist .= "Gold Bonus is required.<br />"; }
        if ($expbonus == "") { $errors++; $errorlist .= "Experience Bonus is required.<br />"; }
        if ($strength == "") { $errors++; $errorlist .= "Strength is required.<br />"; }
        if ($dexterity == "") { $errors++; $errorlist .= "Dexterity is required.<br />"; }
        if ($attackpower == "") { $errors++; $errorlist .= "Attack Power is required.<br />"; }
        if ($defensepower == "") { $errors++; $errorlist .= "Defense Power is required.<br />"; }
		
        if ($weaponid == "") { $errors++; $errorlist .= "Weapon ID is required.<br />"; }
        if ($armorid == "") { $errors++; $errorlist .= "Armor ID is required.<br />"; }
        if ($shieldid == "") { $errors++; $errorlist .= "Shield ID is required.<br />"; }		
        if ($helmetid == "") { $errors++; $errorlist .= "Helmet ID is required.<br />"; }
        if ($gauntletid == "") { $errors++; $errorlist .= "Gauntlet ID is required.<br />"; }
        if ($bootid == "") { $errors++; $errorlist .= "Boot ID is required.<br />"; }
        if ($petid == "") { $errors++; $errorlist .= "Pet ID is required.<br />"; }
        if ($rangeweaponsid == "") { $errors++; $errorlist .= "Range Weapons ID is required.<br />"; }
        if ($magicringsid == "") { $errors++; $errorlist .= "Magic Rings ID is required.<br />"; }	
		
        if ($weaponname == "") { $errors++; $errorlist .= "Weapon Name is required.<br />"; }
        if ($shieldname == "") { $errors++; $errorlist .= "Shield Name is required.<br />"; }
        if ($armorname == "") { $errors++; $errorlist .= "Armor Name is required.<br />"; }
        if ($petname == "") { $errors++; $errorlist .= "Pet Name is required.<br />"; }				
        if ($helmetname == "") { $errors++; $errorlist .= "Helmet Name is required.<br />"; }
        if ($gauntletname == "") { $errors++; $errorlist .= "Gauntlet Name is required.<br />"; }
        if ($bootname == "") { $errors++; $errorlist .= "Boot Name is required.<br />"; }
        if ($rangeweaponsname == "") { $errors++; $errorlist .= "Range Weapons Name is required.<br />"; }
        if ($magicringsname == "") { $errors++; $errorlist .= "Magic Rings Name is required.<br />"; }
		
        if ($wood == "" ) { $errors++; $errorlist .= "current wood is required.<br />"; }
   		if ($fish == "" ) { $errors++; $errorlist .= "current fish is required.<br />"; }     
		
		if ($slot1id == "") { $errors++; $errorlist .= "Slot 1 ID is required.<br />"; }
        if ($slot2id == "") { $errors++; $errorlist .= "Slot 2 ID is required.<br />"; }
        if ($slot3id == "") { $errors++; $errorlist .= "Slot 3 ID is required.<br />"; }
		if ($slot4id == "") { $errors++; $errorlist .= "Slot 4 ID is required.<br />"; }
        if ($slot5id == "") { $errors++; $errorlist .= "Slot 5 ID is required.<br />"; }
        if ($slot6id == "") { $errors++; $errorlist .= "Slot 6 ID is required.<br />"; }
        if ($slot7id == "") { $errors++; $errorlist .= "Slot 7 ID is required.<br />"; }
        if ($slot8id == "") { $errors++; $errorlist .= "Slot 8 ID is required.<br />"; }		
		
        if ($slot1name == "") { $errors++; $errorlist .= "Slot 1 Name is required.<br />"; }
        if ($slot2name == "") { $errors++; $errorlist .= "Slot 2 Name is required.<br />"; }
        if ($slot3name == "") { $errors++; $errorlist .= "Slot 3 Name is required.<br />"; }
		if ($slot4name == "") { $errors++; $errorlist .= "Slot 4 Name is required.<br />"; }
        if ($slot5name == "") { $errors++; $errorlist .= "Slot 5 Name is required.<br />"; }
        if ($slot6name == "") { $errors++; $errorlist .= "Slot 6 Name is required.<br />"; }
        if ($slot7name == "") { $errors++; $errorlist .= "Slot 7 Name is required.<br />"; }
        if ($slot8name == "") { $errors++; $errorlist .= "Slot 8 Name is required.<br />"; }	
		
        if ($silver == "") { $errors++; $errorlist .= "Current Silver Coins Amount is required.<br />"; }
        if ($copper == "") { $errors++; $errorlist .= "Current Copper Coins Amount is required.<br />"; }
		
        if ($skills == "") { $errors++; $errorlist .= "Current Skills number 0-? is required.<br />"; }
		
        if ($hp_potion == "") { $errors++; $errorlist .= "Current Number of Hit Potions is required.<br />"; }
        if ($mp_potion == "") { $errors++; $errorlist .= "Current Number of Magic Potions is required.<br />"; }
        if ($tp_potion == "") { $errors++; $errorlist .= "Current Number of Travel Potions is required.<br />"; }
		
        if ($numkills == "") { $errors++; $errorlist .= "Another Game Gains is required.<br />"; }	
        if ($numdeaths == "") { $errors++; $errorlist .= "Kirst is required. Enter 0.<br />"; }		
				
		if (!is_numeric($numkills)) { $errors++; $errorlist .= "Silver must be a number.<br />"; }
        if (!is_numeric($numdeaths)) { $errors++; $errorlist .= "Copper be a number.<br />"; }	
				
		if ($lottogains == "") { $errors++; $errorlist .= "Lotto Gains is required.<br />"; }	
        if ($lottery == "") { $errors++; $errorlist .= "Lottery Game Gains is required.<br />"; }	
        if ($partlotto == "") { $errors++; $errorlist .= "Another Game Gains is required.<br />"; }	
        if ($kirst == "") { $errors++; $errorlist .= "Kirst is required. Enter 0.<br />"; }		
				
		if (!is_numeric($silver)) { $errors++; $errorlist .= "Silver must be a number.<br />"; }
        if (!is_numeric($copper)) { $errors++; $errorlist .= "Copper be a number.<br />"; }
		
        if (!is_numeric($skills)) { $errors++; $errorlist .= "Skills must be a number.<br />"; }
		
	 	if (!is_numeric($hp_potion)) { $errors++; $errorlist .= "HP Potions must be a number.<br />"; }
        if (!is_numeric($mp_potion)) { $errors++; $errorlist .= "MP Potions must be a number.<br />"; }
        if (!is_numeric($tp_potion)) { $errors++; $errorlist .= "TP Potions must be a number.<br />"; }
		
		if (!is_numeric($lottogains)) { $errors++; $errorlist .= "Lotto Gains must be a number.<br />"; }
        if (!is_numeric($lottery)) { $errors++; $errorlist .= "Lottery Gains be a number.<br />"; }
        if (!is_numeric($partlotto)) { $errors++; $errorlist .= "Part Lotto must be a number.<br />"; }
        if (!is_numeric($kirst)) { $errors++; $errorlist .= "Kirst must be a number.<br />"; }
		
	    if ($dropcode == "") { $errors++; $errorlist .= "Drop Code is required.<br />"; }
        if ($spells == "") { $errors++; $errorlist .= "Spells is required.<br />"; }
        if ($towns == "") { $errors++; $errorlist .= "Towns is required.<br />"; }
        
        if (!is_numeric($authlevel)) { $errors++; $errorlist .= "Auth Level must be a number.<br />"; }
        if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be a number.<br />"; }
        if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be a number.<br />"; }
        if (!is_numeric($difficulty)) { $errors++; $errorlist .= "Difficulty must be a number.<br />"; }
        if (!is_numeric($charclass)) { $errors++; $errorlist .= "Character Class must be a number.<br />"; }
	 	if (!is_numeric($charalign)) { $errors++; $errorlist .= "Character Alignment must be a number.<br />"; }
        if (!is_numeric($currentfight)) { $errors++; $errorlist .= "Current Fight must be a number.<br />"; }
        if (!is_numeric($currentmonster)) { $errors++; $errorlist .= "Current Monster must be a number.<br />"; }
		if (!is_numeric($currentmonsterhp)) { $errors++; $errorlist .= "Current Monster HP must be a number.<br />";}
		if (!is_numeric($currentmonstersleep)) { $errors++; $errorlist .= "Current Monster Sleep must be a number.<br />"; }        
		if (!is_numeric($currentmonsterimmune)) { $errors++; $errorlist .= "Current Monster Immune must be a number.<br />"; }
		if (!is_numeric($currentuberdamage)) { $errors++; $errorlist .= "Current Uber Damage must be a number.<br />"; }
		if (!is_numeric($currentuberdefense)) { $errors++; $errorlist .= "Current Uber Defense must be a number.<br />"; }
        if (!is_numeric($currenthp)) { $errors++; $errorlist .= "Current HP must be a number.<br />"; }
        if (!is_numeric($currentmp)) { $errors++; $errorlist .= "Current MP must be a number.<br />"; }
        if (!is_numeric($currenttp)) { $errors++; $errorlist .= "Current TP must be a number.<br />"; }
        if (!is_numeric($maxhp)) { $errors++; $errorlist .= "Max HP must be a number.<br />"; }
        if (!is_numeric($maxmp)) { $errors++; $errorlist .= "Max MP must be a number.<br />"; }
        if (!is_numeric($maxtp)) { $errors++; $errorlist .= "Max TP must be a number.<br />"; }
        if (!is_numeric($level)) { $errors++; $errorlist .= "Level must be a number.<br />"; }
        
        if (!is_numeric($gold)) { $errors++; $errorlist .= "Gold must be a number.<br />"; }
        if (!is_numeric($experience)) { $errors++; $errorlist .= "Experience must be a number.<br />"; }
        if (!is_numeric($goldbonus)) { $errors++; $errorlist .= "Gold Bonus must be a number.<br />"; }
        if (!is_numeric($expbonus)) { $errors++; $errorlist .= "Experience Bonus must be a number.<br />"; }
        if (!is_numeric($strength)) { $errors++; $errorlist .= "Strength must be a number.<br />"; }
        if (!is_numeric($dexterity)) { $errors++; $errorlist .= "Dexterity must be a number.<br />"; }
        if (!is_numeric($attackpower)) { $errors++; $errorlist .= "Attack Power must be a number.<br />"; }
        if (!is_numeric($defensepower)) { $errors++; $errorlist .= "Defense Power must be a number.<br />"; }
		
        if (!is_numeric($weaponid)) { $errors++; $errorlist .= "Weapon ID must be a number.<br />"; }
        if (!is_numeric($armorid)) { $errors++; $errorlist .= "Armor ID must be a number.<br />"; }        
        if (!is_numeric($shieldid)) { $errors++; $errorlist .= "Shield ID must be a number.<br />"; }
        if (!is_numeric($petid)) { $errors++; $errorlist .= "Pet ID must be a number.<br />"; }		
        if (!is_numeric($helmetid)) { $errors++; $errorlist .= "Helmet ID must be a number.<br />"; }
        if (!is_numeric($gauntletid)) { $errors++; $errorlist .= "Gauntlet ID must be a number.<br />"; }
        if (!is_numeric($bootid)) { $errors++; $errorlist .= "Boot ID must be a number.<br />"; }
        if (!is_numeric($rangeweaponsid)) { $errors++; $errorlist .= "Range Weapons ID must be a number.<br />"; }
        if (!is_numeric($magicringsid)) { $errors++; $errorlist .= "Magic Rings ID must be a number.<br />"; }
				
        if (!is_numeric($fish)) { $errors++; $errorlist .= "Current fish Sleep must be a number.<br />"; }
        if (!is_numeric($wood)) { $errors++; $errorlist .= "Current wood Sleep must be a number.<br />"; }
		
        if (!is_numeric($slot1id)) { $errors++; $errorlist .= "Slot 1 ID  must be a number.<br />"; }
        if (!is_numeric($slot2id)) { $errors++; $errorlist .= "Slot 2 ID must be a number.<br />"; }
        if (!is_numeric($slot3id)) { $errors++; $errorlist .= "Slot 3 ID must be a number.<br />"; }
		if (!is_numeric($slot4id)) { $errors++; $errorlist .= "Slot 4 ID must be a number.<br />"; }
        if (!is_numeric($slot5id)) { $errors++; $errorlist .= "Slot 5 ID must be a number.<br />"; }
        if (!is_numeric($slot6id)) { $errors++; $errorlist .= "Slot 6 ID must be a number.<br />"; }
        if (!is_numeric($slot7id)) { $errors++; $errorlist .= "Slot 7 ID must be a number.<br />"; }
        if (!is_numeric($slot8id)) { $errors++; $errorlist .= "Slot 8 ID must be a number.<br />"; }
		
        if (!is_numeric($dropcode)) { $errors++; $errorlist .= "Drop Code must be a number.<br />"; }
		
        if ($numkills == "") { $errors++; $errorlist .= "Current Number of Monster Kills is required.<br />"; }
        if ($kills == "") { $errors++; $errorlist .= "Current Number of Kills is required.<br />"; }
        if ($numdeaths == "") { $errors++; $errorlist .= "Current Number of Player Deaths is required.<br />"; }
        if ($deaths == "") { $errors++; $errorlist .= "Current Number of Deaths is required.<br />"; }
        if ($totalfights == "") { $errors++; $errorlist .= "Current Total Fights is required.<br />"; }
        if ($fights == "") { $errors++; $errorlist .= "Current Fights is required.<br />"; }
        if ($total == "") { $errors++; $errorlist .= "Current Total required.<br />"; }
		
		if (!is_numeric($numkills)) { $errors++; $errorlist .= "Current Number of Monster Kills is required.<br />"; }
 		if (!is_numeric($kills)) { $errors++; $errorlist .= "Current Number of Kills is required.<br />"; }
		if (!is_numeric($numdeaths)) { $errors++; $errorlist .= "Current Number of Player Deaths is required.<br />"; }
		if (!is_numeric($deaths)) { $errors++; $errorlist .= "Current Number of Deaths is required.<br />"; }
		if (!is_numeric($totalfights)) { $errors++; $errorlist .= "Current Total Fights is required.<br />"; }
		if (!is_numeric($fights)) { $errors++; $errorlist .= "Current Fights is required.<br />"; }
		if (!is_numeric($total)) { $errors++; $errorlist .= "Current Total required.<br />"; }
		
        
	    if ($errors == 0) { 
$updatequery = <<<END
UPDATE {{table}} SET
email="$email", 
verify="$verify", 
charname="$charname", 
authlevel="$authlevel", 
latitude="$latitude",
longitude="$longitude", 
difficulty="$difficulty", 
charclass="$charclass", 
currentaction="$currentaction", 
currentfight="$currentfight",
wood="$wood",
fish="$fish",
numkills="$numkills",
numdeaths="$numdeaths",
kills="$kills",
deaths="deaths",
totalfights="$totalfights",
fights="$fights",
total="$total",
currentmonster="$currentmonster", 
currentmonsterhp="$currentmonsterhp", 
currentmonstersleep="$currentmonstersleep", 
currentmonsterimmune="$currentmonsterimmune", 
currentuberdamage="$currentuberdamage",
currentuberdefense="$currentuberdefense", 
currenthp="$currenthp", 
currentmp="$currentmp", 
currenttp="$currenttp",
allmoney="$allmoney",
allsilvermoney="$allsilvermoney",
allcoppermoney="$allcoppermoney", 
gold="$gold", 
silver="$silver", 
copper="$copper",
bank="$bank",
silverbank="$silverbank", 
copperbank="$copperbank", 
bankgold="$bankgold", 
banksilver="$banksilver", 
bankcopper="$bankcopper",
goldbonus="$goldbonus",
silverbonus="$silverbonus",
copperbonus="$copperbonus",
skills="$skills", 
hp_potion="$hp_potion", 
mp_potion="$mp_potion", 
tp_potion="$tp_potion", 
lottogains="$lottogains", 
lottery="$lottery", 
partlotto="$partlotto", 
kirst="$kirst", 
maxhp="$maxhp",
maxmp="$maxmp", 
maxtp="$maxtp", 
level="$level", 
experience="$experience",
goldbonus="$goldbonus",
silverbonus="$silverbonus",
copperbonus="$copperbonus",
expbonus="$expbonus", 
strength="$strength", 
dexterity="$dexterity", 
attackpower="$attackpower",
defensepower="$defensepower", 
weaponid="$weaponid",
armorid="$armorid", 
shieldid="$shieldid", 
petid="$petid", 
helmetid="$helmetid", 
gauntletid="$gauntletid", 
bootid="$bootid",  
rangeweaponsid="$rangeweaponsid", 
magicringsid="$magicringsid", 
slot1id="$slot1id",
slot2id="$slot2id", 
slot3id="$slot3id", 
slot4id="$slot4id", 
slot5id="$slot5id", 
slot6id="$slot6id", 
slot7id="$slot7id", 
slot8id="$slot8id", 
weaponname="$weaponname", 
shieldname="$shieldname", 
armorname="$armorname",
petname="$petname", 
helmetname="$helmetname", 
gauntletname="$gauntletname", 
bootname="$bootname", 
rangeweaponsname="$rangeweaponsname", 
magicringsname="$magicringsname", 
slot1name="$slot1name", 
slot2name="$slot2name", 
slot3name="$slot3name", 
slot4name="$slot4name", 
slot5name="$slot5name", 
slot6name="$slot6name", 
slot7name="$slot7name", 
slot8name="$slot8name", 
dropcode="$dropcode", 
spells="$spells",
ipadres="$ipadres", 
towns="$towns"
WHERE id="$id" LIMIT 1
END;
			$query = doquery($updatequery, "users");
            admindisplay("User updated.","Edit Users");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Users");
        }     
    }   
        
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "users");
    $row = mysql_fetch_array($query);
    global $controlrow;
	$diff1name = $controlrow["diff1name"];
    $diff2name = $controlrow["diff2name"];
    $diff3name = $controlrow["diff3name"];
    $diff4name = $controlrow["diff4name"];
    $diff5name = $controlrow["diff5name"];
    $diff6name = $controlrow["diff6name"];
    $diff7name = $controlrow["diff7name"];
    $diff8name = $controlrow["diff8name"];
    $diff9name = $controlrow["diff9name"];
    $diff10name = $controlrow["diff10name"];
    $diff11name = $controlrow["diff11name"];
	$class1name = $controlrow["class1name"];
    $class2name = $controlrow["class2name"];
    $class3name = $controlrow["class3name"];
    $class4name = $controlrow["class4name"];
    $class5name = $controlrow["class5name"];
    $class6name = $controlrow["class6name"];
    $class7name = $controlrow["class7name"];
    $class8name = $controlrow["class8name"];
    $class9name = $controlrow["class9name"];
    $class10name = $controlrow["class10name"];	
	$class11name = $controlrow["class11name"];
    $class12name = $controlrow["class12name"];
    $class13name = $controlrow["class13name"];
    $class14name = $controlrow["class14name"];
    $class15name = $controlrow["class15name"];
    $class16name = $controlrow["class16name"];
    $class17name = $controlrow["class17name"];
    $class18name = $controlrow["class18name"];
    $class19name = $controlrow["class19name"];
    $class20name = $controlrow["class20name"];	
	$class21name = $controlrow["class21name"];
    $class22name = $controlrow["class22name"];
    $class23name = $controlrow["class23name"];
    $class24name = $controlrow["class24name"];
    $class25name = $controlrow["class25name"];
    $class26name = $controlrow["class26name"];
    $class27name = $controlrow["class27name"];
    $class28name = $controlrow["class28name"];
    $class29name = $controlrow["class29name"];
    $class30name = $controlrow["class30name"];	
	$class31name = $controlrow["class31name"];
    $class32name = $controlrow["class32name"];
    $class33name = $controlrow["class33name"];
    $class34name = $controlrow["class34name"];
    $class35name = $controlrow["class35name"];
    $class36name = $controlrow["class36name"];
    $class37name = $controlrow["class37name"];
    $class38name = $controlrow["class38name"];
    $class39name = $controlrow["class39name"];
    $class40name = $controlrow["class40name"];	
	$class41name = $controlrow["class41name"];
    $class42name = $controlrow["class42name"];
    $class43name = $controlrow["class43name"];
    $class44name = $controlrow["class44name"];
    $class45name = $controlrow["class45name"];
    $class46name = $controlrow["class46name"];
    $class47name = $controlrow["class47name"];
    $class48name = $controlrow["class48name"];
    $class49name = $controlrow["class49name"];
    $class50name = $controlrow["class50name"];	
	$class51name = $controlrow["class51name"];
    $class52name = $controlrow["class52name"];
    $align1name = $controlrow["align1name"];
    $align2name = $controlrow["align2name"];
    $align3name = $controlrow["align3name"];
    $align4name = $controlrow["align4name"];
    $align5name = $controlrow["align5name"];
    $align6name = $controlrow["align6name"];
    $align7name = $controlrow["align7name"];

$page = <<<END
<u>Edit Users</u><br /><br />
<form action="admin.php?do=edituser:$id" method="post">
<table width="90%">

<tr><td colspan="2" style="background-color:#cccccc;">User Options</td></tr>
<tr><td width="20%">ID:</td><td>{{id}}</td></tr>
<tr><td width="20%">Username:</td><td>{{username}}</td></tr>
<tr><td width="20%">Email:</td><td><input type="text" name="email" size="30" maxlength="100" value="{{email}}" /></td></tr>
<tr><td width="20%">Verify:</td><td><input type="text" name="verify" size="30" maxlength="8" value="{{verify}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for a normal game is <b>1</b>. Setting <b>0</b> is for No email Verify. 0 & 1 are the only setting, changing to something else will break the game.<br></td></tr>

<tr><td width="20%">Character Name:</td><td><input type="text" name="charname" size="30" maxlength="30" value="{{charname}}" /></td></tr>
<tr><td width="20%">Real Name:</td><td><input type="text" name="realname" size="30" maxlength="30" value="{{realname}}" /></td></tr>
<tr><td width="20%">Gender:</td><td><input type="text" name="gender" size="8" maxlength="12" value="{{gender}}" /></td></tr>
<tr><td width="20%">Public Email:</td><td><input type="text" name="publicemail" size="30" maxlength="30" value="{{publicemail}}" /></td></tr>
<tr><td width="20%">Web Site 1:</td><td><input type="text" name="website1" size="40" maxlength="90" value="{{website1}}" /></td></tr>
<tr><td width="20%">Web Site 2:</td><td><input type="text" name="website2" size="40" maxlength="90" value="{{website2}}" /></td></tr>
<tr><td width="20%">MSN:</td><td><input type="text" name="msn" size="30" maxlength="30" value="{{msn}}" /></td></tr>
<tr><td width="20%">ICQ:</td><td><input type="text" name="icq" size="30" maxlength="30" value="{{icq}}" /></td></tr>
<tr><td width="20%">AIM:</td><td><input type="text" name="aim" size="30" maxlength="30" value="{{aim}}" /></td></tr>
<tr><td width="20%">Yahoo:</td><td><input type="text" name="yahoo" size="30" maxlength="30" value="{{yahoo}}" /></td></tr>
<tr><td width="20%">Google Talk:</td><td><input type="text" name="googletlk" size="30" maxlength="30" value="{{googletlk}}" /><br></td></tr>

<tr><td width="20%">Register Date:</td><td>{{regdate}}</td></tr>
<tr><td width="20%">Last Online:</td><td>{{onlinetime}}</td></tr>
<tr><td width="20%">IP Address:</td><td>{{ipadres}}</td></tr>

<tr><td width="20%">Auth Level:</td><td><select name="authlevel"><option value="0" {{auth0select}}>User</option><option value="1" {{auth1select}}>Admin</option><option value="2" {{auth2select}}>Blocked</option></select><br /><span class="small">Set to "<b>Blocked</b>" to temporarily (or permanently) ban a user.</span></td></tr>
<tr><td width="20%">Latitude:</td><td><input type="text" name="latitude" size="5" maxlength="6" value="{{latitude}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for a normal game is <b>0</b>.</td></tr>
<tr><td width="20%">Longitude:</td><td><input type="text" name="longitude" size="5" maxlength="6" value="{{longitude}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for a normal game is <b>0</b>.</td></tr>

<tr><td width="20%">Difficulty:</td><td><select name="difficulty">
<option value="1" {{diff1select}}>$diff1name</option>
<option value="2" {{diff2select}}>$diff2name</option>
<option value="3" {{diff3select}}>$diff3name</option>
<option value="4" {{diff4select}}>$diff4name</option>
<option value="5" {{diff5select}}>$diff5name</option>
<option value="6" {{diff6select}}>$diff6name</option>
<option value="7" {{diff7select}}>$diff7name</option>
<option value="8" {{diff8select}}>$diff8name</option>
<option value="9" {{diff9select}}>$diff9name</option>
<option value="10" {{diff10select}}>$diff10name</option>
<option value="11" {{diff11select}}>$diff11name</option>
</select></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Difficulty Setting: Serf Lvl: 1.0 <b>[Easy]</b> - Peasant Lvl: 1.1 - Vassal Lvl: 1.2 - Farmer Lvl: 1.3 - Trader Lvl: 1.4 - Merchant Lvl: 1.5 - Clergy Lvl: 1.6 - Knight Lvl: 1.7 - Nobleman Lvl: 1.8 - Lord Lvl: 1.9 - King Lvl: 2.0 <b>[Hardest - 2x normal]</b>.</td></tr>


<tr><td colspan="2" style="background-color:#cccccc;">Extra Character Information</td></tr>
<tr><td width="20%">Clan ID:</td><td>{{clanid}}</td></tr>
<tr><td width="20%">Clan Leader:</td><td>{{clanleader}}</td></tr>
<tr><td width="20%">Member Status:</td><td>{{memberstatus}}</td></tr>
<tr><td width="20%">Career Deaths:</td><td><input type="text" name="numdeaths" size="2" maxlength="2" value="{{numdeaths}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>. Values are <b>0 to 10</b>. 0 = Your character has not died. 10 = Your character has died 10 times and is not longer playable and is buried in the Town graveyard. </td></tr>


<tr><td colspan="2" style="background-color:#cccccc;">Character Classes - Character Alignment - Current</td></tr>
<tr><td width="20%">Character Class:</td><td>
<select name="charclass">
<option value="1" {{class1select}}>$class1name</option>
<option value="2" {{class2select}}>$class2name</option>
<option value="3" {{class3select}}>$class3name</option>
<option value="4" {{class4select}}>$class4name</option>
<option value="5" {{class5select}}>$class5name</option>
<option value="6" {{class6select}}>$class6name</option>
<option value="7" {{class7select}}>$class7name</option>
<option value="8" {{class8select}}>$class8name</option>
<option value="9" {{class9select}}>$class9name</option>
<option value="10" {{class10select}}>$class10name</option>
<option value="11" {{class11select}}>$class11name</option>
<option value="12" {{class12select}}>$class12name</option>
<option value="13" {{class13select}}>$class13name</option>
<option value="14" {{class14select}}>$class14name</option>
<option value="15" {{class15select}}>$class15name</option>
<option value="16" {{class16select}}>$class16name</option>
<option value="17" {{class17select}}>$class17name</option>
<option value="18" {{class18select}}>$class18name</option>
<option value="19" {{class19select}}>$class19name</option>
<option value="20" {{class20select}}>$class20name</option>
<option value="21" {{class21select}}>$class21name</option>
<option value="22" {{class22select}}>$class22name</option>
<option value="23" {{class23select}}>$class23name</option>
<option value="24" {{class24select}}>$class24name</option>
<option value="25" {{class25select}}>$class25name</option>
<option value="26" {{class26select}}>$class26name</option>
<option value="27" {{class27select}}>$class27name</option>
<option value="28" {{class28select}}>$class28name</option>
<option value="29" {{class29select}}>$class29name</option>
<option value="30" {{class30select}}>$class30name</option>
<option value="31" {{class31select}}>$class31name</option>
<option value="32" {{class32select}}>$class32name</option>
<option value="33" {{class33select}}>$class33name</option>
<option value="34" {{class34select}}>$class34name</option>
<option value="35" {{class35select}}>$class35name</option>
<option value="36" {{class36select}}>$class36name</option>
<option value="37" {{class37select}}>$class37name</option>
<option value="38" {{class38select}}>$class38name</option>
<option value="39" {{class39select}}>$class39name</option>
<option value="40" {{class40select}}>$class40name</option>
<option value="41" {{class41select}}>$class41name</option>
<option value="42" {{class42select}}>$class42name</option>
<option value="43" {{class43select}}>$class43name</option>
<option value="44" {{class44select}}>$class44name</option>
<option value="45" {{class45select}}>$class45name</option>
<option value="46" {{class46select}}>$class46name</option>
<option value="47" {{class47select}}>$class47name</option>
<option value="48" {{class48select}}>$class48name</option>
<option value="49" {{class49select}}>$class49name</option>
<option value="50" {{class50select}}>$class50name</option>
<option value="51" {{class51select}}>$class51name</option>
<option value="52" {{class52select}}>$class52name</option>
</td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Character Classes: <b>*</b> Use only first 12 Class. Others are under development.</td></tr>

<tr><td width="20%">Character Alignment:</td><td><select name="charalign"><option value="1" {{align1select}}>$align1name</option><option value="2" {{align2select}}>$align2name</option><option value="3" {{align3select}}>$align3name</option><option value="4" {{align4select}}>$align4name</option><option value="5" {{align5select}}>$align5name</option><option value="6" {{align6select}}>$align6name</option><option value="7" {{align7select}}>$align7name</option></select></td></tr>
</td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for a normal game is <b>Neutral</b>.</td></tr>


<tr><td width="20%">Current Action:</td><td><input type="text" name="currentaction" size="30" maxlength="30" value="{{currentaction}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for a normal game is <b>In Town</b></td></tr>
<tr><td width="20%">Current Fight:</td><td><input type="text" name="currentfight" size="5" maxlength="4" value="{{currentfight}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for a normal game is <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Monster</td></tr>
<tr><td width="20%">Current Monster:</td><td><input type="text" name="currentmonster" size="5" maxlength="6" value="{{currentmonster}}" /></td></tr>
<tr><td width="20%">Current Monster HP:</td><td><input type="text" name="currentmonsterhp" size="5" maxlength="6" value="{{currentmonsterhp}}" /></td></tr>
<tr><td width="20%">Current Monster Sleep:</td><td><input type="text" name="currentmonsterimmune" size="5" maxlength="3" value="{{currentmonsterimmune}}" /></td></tr>
<tr><td width="20%">Current Monster Immune:</td><td><input type="text" name="currentmonstersleep" size="5" maxlength="3" value="{{currentmonstersleep}}" /></td></tr>
<tr><td width="20%">Current Uber Damage:</td><td><input type="text" name="currentuberdamage" size="5" maxlength="3" value="{{currentuberdamage}}" /></td></tr>
<tr><td width="20%">Current Uber Defense:</td><td><input type="text" name="currentuberdefense" size="5" maxlength="3" value="{{currentuberdefense}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default for all Monster setting are <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Kills & Player Deaths</td></tr>
<tr><td width="20%">Current Number of Kills:</td><td><input type="text" name="numkills" size="5" maxlength="6" value="{{numkills}}" /></td></tr>
<tr><td width="20%">Current Number of Deaths:</td><td><input type="text" name="numdeaths" size="5" maxlength="6" value="{{numdeaths}}" /></td></tr>
<tr><td width="20%">Current Kills:</td><td><input type="text" name="kills" size="5" maxlength="6" value="{{kills}}" /></td></tr>
<tr><td width="20%">Current Deaths:</td><td><input type="text" name="deaths" size="5" maxlength="6" value="{{deaths}}" /></td></tr>
<tr><td width="20%">Current Total Fights:</td><td><input type="text" name="totalfights" size="5" maxlength="6" value="{{totalfights}}" /></td></tr>
<tr><td width="20%">Current Fights:</td><td><input type="text" name="fights" size="5" maxlength="6" value="{{fights}}" /></td></tr>
<tr><td width="20%">Current Total:</td><td><input type="text" name="total" size="5" maxlength="6" value="{{total}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default for all Kills & Player Deaths setting are <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">HPs TPs MPs</td></tr>
<tr><td width="20%">Current HP:</td><td><input type="text" name="currenthp" size="5" maxlength="7" value="{{currenthp}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default Hit Points [HPs] for a normal game is <b>10</b>.</td></tr>
<tr><td width="20%">Max HP:</td><td><input type="text" name="maxhp" size="5" maxlength="7" value="{{maxhp}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default Max Hit Points [HPs] for a normal game is <b>10</b>.</td></tr>

<tr><td width="20%">Current MP:</td><td><input type="text" name="currentmp" size="5" maxlength="7" value="{{currentmp}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default Magic Points [MPs] for a normal game is <b>2</b>.</td></tr>
<tr><td width="20%">Max MP:</td><td><input type="text" name="maxmp" size="5" maxlength="7" value="{{maxmp}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default Max Magic Points [MPs] for a normal game is <b>2</b>.</td></tr>

<tr><td width="20%">Current TP:</td><td><input type="text" name="currenttp" size="5" maxlength="7" value="{{currenttp}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default Travel Points [TPs] for a normal game is <b>5</b>.</td></tr>
<tr><td width="20%">Max TP:</td><td><input type="text" name="maxtp" size="5" maxlength="7" value="{{maxtp}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default Max Travel Points [TPs] for a normal game is <b>5</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">HP - TP - MP Potion Bottles</td></tr>
<tr><td width="20%">HP Potion Bottles:</td><td><input type="text" name="hp_potion" size="5" maxlength="7" value="{{hp_potion}}" /></td></tr>
<tr><td width="20%">MP Potion Bottles:</td><td><input type="text" name="mp_potion" size="5" maxlength="7" value="{{mp_potion}}" /></td></tr>
<tr><td width="20%">TP Potion Bottles:</td><td><input type="text" name="tp_potion" size="5" maxlength="7" value="{{tp_potion}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all Potion Bottles is <b>1</b> each.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Level - Experience - Skills</td></tr>
<tr><td width="20%">Level:</td><td><input type="text" name="level" size="5" maxlength="5" value="{{level}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for normal game is <b>1</b>.</td></tr>

<tr><td width="20%">Experience:</td><td><input type="text" name="experience" size="10" maxlength="14" value="{{experience}}" /></td></tr>
<tr><td width="20%">Experience Bonus:</td><td><input type="text" name="expbonus" size="5" maxlength="5" value="{{expbonus}}" /></td></tr>
<tr><td width="20%">Skills Points:</td><td><input type="text" name="skills" size="3" maxlength="5" value="{{skills}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for Experience, Experience Bonus & Skills Points are all <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Gold Coins</td></tr>
<tr><td width="20%">Gold:</td><td><input type="text" name="gold" size="14" maxlength="14" value="{{gold}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>50</b>.</td></tr>
<tr><td width="20%">Gold Bank:</td><td><input type="text" name="bank" size="14" maxlength="14" value="{{bank}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>25</b>.</td></tr>
<tr><td width="20%">Gold Bonus:</td><td><input type="text" name="goldbonus" size="5" maxlength="2" value="{{goldbonus}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Silver Coins</td></tr>
<tr><td width="20%">Silver:</td><td><input type="text" name="silver" size="14" maxlength="14" value="{{silver}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>25</b>.</td></tr>
<tr><td width="20%">Silver Bank:</td><td><input type="text" name="silverbank" size="14" maxlength="14" value="{{silverbank}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>15</b>.</td></tr>
<tr><td width="20%">Silver Bonus:</td><td><input type="text" name="silverbonus" size="5" maxlength="2" value="{{silverbonus}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Copper Coins</td></tr>
<tr><td width="20%">Copper:</td><td><input type="text" name="copper" size="14" maxlength="14" value="{{copper}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>10</b>.</td></tr>
<tr><td width="20%">Copper Bank:</td><td><input type="text" name="copperbank" size="14" maxlength="14" value="{{copperbank}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>5</b>.</td></tr>
<tr><td width="20%">Copper Bonus:</td><td><input type="text" name="copperbonus" size="5" maxlength="2" value="{{copperbonus}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for any new Game is <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Gambling</td></tr>
<tr><td width="20%">Lotto Gains:</td><td><input type="text" name="lottogains" size="14" maxlength="14" value="{{lottogains}}" /></td></tr>
<tr><td width="20%">Lottery Profits:</td><td><input type="text" name="lottery" size="14" maxlength="14" value="{{lottery}}" /></td></tr>
<tr><td width="20%">Part Lotto Gains:</td><td><input type="text" name="partlotto" size="14" maxlength="14" value="{{partlotto}}" /></td></tr>
<tr><td width="20%">Kirst:</td><td><input type="text" name="kirst" size="14" maxlength="14" value="{{kirst}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all is <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Ip Address</td></tr>
<tr><td width="20%">Ip Address:</td><td><input type="text" name="ipadres" size="15" maxlength="20" value="{{ipadres}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Abilities & Powers</td></tr>
<tr><td width="20%">Strength:</td><td><input type="text" name="strength" size="5" maxlength="5" value="{{strength}}" /></td></tr>
<tr><td width="20%">Dexterity:</td><td><input type="text" name="dexterity" size="5" maxlength="5" value="{{dexterity}}" /></td></tr>
<tr><td width="20%">Attack Power:</td><td><input type="text" name="attackpower" size="5" maxlength="5" value="{{attackpower}}" /></td></tr>
<tr><td width="20%">Defense Power:</td><td><input type="text" name="defensepower" size="5" maxlength="5" value="{{defensepower}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all Abilities & Powers are <b>5</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Weapons IDs and Names</td></tr>
<tr><td width="20%">Weapon ID:</td><td><input type="text" name="weaponid" size="5" maxlength="5" value="{{weaponid}}" /></td></tr>
<tr><td width="20%">Weapon Name:</td><td><input type="text" name="weaponname" size="30" maxlength="30" value="{{weaponname}}" /></td></tr>
<tr><td width="20%">Shield ID:</td><td><input type="text" name="shieldid" size="5" maxlength="5" value="{{shieldid}}" /></td></tr>
<tr><td width="20%">Shield Name:</td><td><input type="text" name="shieldname" size="30" maxlength="30" value="{{shieldname}}" /></td></tr>
<tr><td width="20%">Armor ID:</td><td><input type="text" name="armorid" size="5" maxlength="5" value="{{armorid}}" /></td></tr>
<tr><td width="20%">Armor Name:</td><td><input type="text" name="armorname" size="30" maxlength="30" value="{{armorname}}" /></td></tr>
<tr><td width="20%">Pet ID:</td><td><input type="text" name="petid" size="5" maxlength="5" value="{{petid}}" /></td></tr>
<tr><td width="20%">Pet Name:</td><td><input type="text" name="petname" size="30" maxlength="30" value="{{petname}}" /></td></tr>
<tr><td width="20%">Helmet ID:</td><td><input type="text" name="helmetid" size="5" maxlength="5" value="{{helmetid}}" /></td></tr>
<tr><td width="20%">Helmet Name:</td><td><input type="text" name="helmetname" size="30" maxlength="30" value="{{helmetname}}" /></td></tr>
<tr><td width="20%">Gauntlet ID:</td><td><input type="text" name="gauntletid" size="5" maxlength="5" value="{{gauntletid}}" /></td></tr>
<tr><td width="20%">Gauntlet Name:</td><td><input type="text" name="gauntletname" size="30" maxlength="30" value="{{gauntletname}}" /></td></tr>
<tr><td width="20%">Boot ID:</td><td><input type="text" name="bootid" size="5" maxlength="5" value="{{bootid}}" /></td></tr>
<tr><td width="20%">Boot Name:</td><td><input type="text" name="bootname" size="30" maxlength="30" value="{{bootname}}" /></td></tr>
<tr><td width="20%">Range Weapons ID:</td><td><input type="text" name="rangeweaponsid" size="5" maxlength="5" value="{{rangeweaponsid}}" /></td></tr>
<tr><td width="20%">Range Weapons Name:</td><td><input type="text" name="rangeweaponsname" size="30" maxlength="30" value="{{rangeweaponsname}}" /></td></tr>
<tr><td width="20%">Magic Rings ID:</td><td><input type="text" name="magicringsid" size="5" maxlength="5" value="{{magicringsid}}" /></td></tr>
<tr><td width="20%">Magic Rings Name:</td><td><input type="text" name="magicringsname" size="30" maxlength="30" value="{{magicringsname}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all Weapon IDs is <b>0</b>.</td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all Weapon Names is <b>None</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Slots IDs and Names</td></tr>
<tr><td width="20%">Slot 1 ID:</td><td><input type="text" name="slot1id" size="5" maxlength="5" value="{{slot1id}}" /></td></tr>
<tr><td width="20%">Slot 1 Name:</td><td><input type="text" name="slot1name" size="30" maxlength="30" value="{{slot1name}}" /></td></tr>
<tr><td width="20%">Slot 2 ID:</td><td><input type="text" name="slot2id" size="5" maxlength="5" value="{{slot2id}}" /></td></tr>
<tr><td width="20%">Slot 2 Name:</td><td><input type="text" name="slot2name" size="30" maxlength="30" value="{{slot2name}}" /></td></tr>
<tr><td width="20%">Slot 3 ID:</td><td><input type="text" name="slot3id" size="5" maxlength="5" value="{{slot3id}}" /></td></tr>
<tr><td width="20%">Slot 3 Name:</td><td><input type="text" name="slot3name" size="30" maxlength="30" value="{{slot3name}}" /></td></tr>
<tr><td width="20%">Slot 4 ID:</td><td><input type="text" name="slot4id" size="5" maxlength="5" value="{{slot4id}}" /></td></tr>
<tr><td width="20%">Slot 4 Name:</td><td><input type="text" name="slot4name" size="30" maxlength="30" value="{{slot4name}}" /></td></tr>
<tr><td width="20%">Slot 5 ID:</td><td><input type="text" name="slot5id" size="5" maxlength="5" value="{{slot5id}}" /></td></tr>
<tr><td width="20%">Slot 5 Name:</td><td><input type="text" name="slot5name" size="30" maxlength="30" value="{{slot5name}}" /></td></tr>
<tr><td width="20%">Slot 6 ID:</td><td><input type="text" name="slot6id" size="5" maxlength="5" value="{{slot6id}}" /></td></tr>
<tr><td width="20%">Slot 6 Name:</td><td><input type="text" name="slot6name" size="30" maxlength="30" value="{{slot6name}}" /></td></tr>
<tr><td width="20%">Slot 7 ID:</td><td><input type="text" name="slot7id" size="5" maxlength="5" value="{{slot7id}}" /></td></tr>
<tr><td width="20%">Slot 7 Name:</td><td><input type="text" name="slot7name" size="30" maxlength="30" value="{{slot7name}}" /></td></tr>
<tr><td width="20%">Slot 8 ID:</td><td><input type="text" name="slot8id" size="5" maxlength="5" value="{{slot8id}}" /></td></tr>
<tr><td width="20%">Slot 8 Name:</td><td><input type="text" name="slot8name" size="30" maxlength="30" value="{{slot8name}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all Slot IDs are <b>0</b>.</td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting for all Slot Names is <b>Empty</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Drops - Spells - Towns</td></tr>
<tr><td width="20%">Drop Code:</td><td><input type="text" name="dropcode" size="5" maxlength="8" value="{{dropcode}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>.</td></tr>
<tr><td width="20%">Spells:</td><td><input type="text" name="spells" size="50" maxlength="80" value="{{spells}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>1</b>.</td></tr>
<tr><td width="20%">Towns:</td><td><input type="text" name="towns" size="50" maxlength="70" value="{{towns}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>1</b>.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Profession: University</td></tr>
<tr><td width="20%">Wood Skill:</td><td><input type="text" name="woodskill" size="3" maxlength="5" value="{{woodskill}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>.</td></tr>
<tr><td width="20%">Fish Skill:</td><td><input type="text" name="fishskill" size="3" maxlength="5" value="{{fishskill}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>.</td></tr>
<tr><td width="20%">Wood:</td><td><input type="text" name="wood" size="3" maxlength="5" value="{{wood}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>.</td></tr>
<tr><td width="20%">Fish:</td><td><input type="text" name="fish" size="3" maxlength="5" value="{{fish}}" /></td></tr>
<tr><td width="20%">&nbsp;&nbsp;</td><td class="small">Default setting is <b>0</b>.</td></tr>

</table>

<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div><br /><br /><br />
</form>
END;

    if ($row["authlevel"] == 0) { $row["auth0select"] = "selected=\"selected\" "; } else { $row["auth0select"] = ""; }
    if ($row["authlevel"] == 1) { $row["auth1select"] = "selected=\"selected\" "; } else { $row["auth1select"] = ""; }
    if ($row["authlevel"] == 2) { $row["auth2select"] = "selected=\"selected\" "; } else { $row["auth2select"] = ""; }
	
	if ($row["charclass"] == 1) { $row["class1select"] = "selected=\"selected\" "; } else { $row["class1select"] = ""; }
	if ($row["charclass"] == 2) { $row["class2select"] = "selected=\"selected\" "; } else { $row["class2select"] = ""; }
	if ($row["charclass"] == 3) { $row["class3select"] = "selected=\"selected\" "; } else { $row["class3select"] = ""; }
	if ($row["charclass"] == 4) { $row["class4select"] = "selected=\"selected\" "; } else { $row["class4select"] = ""; }
	if ($row["charclass"] == 5) { $row["class5select"] = "selected=\"selected\" "; } else { $row["class5select"] = ""; }
	if ($row["charclass"] == 6) { $row["class6select"] = "selected=\"selected\" "; } else { $row["class6select"] = ""; }
	if ($row["charclass"] == 7) { $row["class7select"] = "selected=\"selected\" "; } else { $row["class7select"] = ""; }
	if ($row["charclass"] == 8) { $row["class8select"] = "selected=\"selected\" "; } else { $row["class8select"] = ""; }
	if ($row["charclass"] == 9) { $row["class9select"] = "selected=\"selected\" "; } else { $row["class9select"] = ""; }
	if ($row["charclass"] == 10) { $row["class10select"] = "selected=\"selected\" "; } else { $row["class10select"] = ""; }	
	if ($row["charclass"] == 11) { $row["class11select"] = "selected=\"selected\" "; } else { $row["class11select"] = ""; }
	if ($row["charclass"] == 12) { $row["class12select"] = "selected=\"selected\" "; } else { $row["class12select"] = ""; }
	if ($row["charclass"] == 13) { $row["class13select"] = "selected=\"selected\" "; } else { $row["class13select"] = ""; }
	if ($row["charclass"] == 14) { $row["class14select"] = "selected=\"selected\" "; } else { $row["class14select"] = ""; }
	if ($row["charclass"] == 15) { $row["class15select"] = "selected=\"selected\" "; } else { $row["class15select"] = ""; }
	if ($row["charclass"] == 16) { $row["class16select"] = "selected=\"selected\" "; } else { $row["class16select"] = ""; }
	if ($row["charclass"] == 17) { $row["class17select"] = "selected=\"selected\" "; } else { $row["class17select"] = ""; }
	if ($row["charclass"] == 18) { $row["class18select"] = "selected=\"selected\" "; } else { $row["class18select"] = ""; }
	if ($row["charclass"] == 19) { $row["class19select"] = "selected=\"selected\" "; } else { $row["class19select"] = ""; }
	if ($row["charclass"] == 20) { $row["class20select"] = "selected=\"selected\" "; } else { $row["class20select"] = ""; }	
	if ($row["charclass"] == 21) { $row["class21select"] = "selected=\"selected\" "; } else { $row["class21select"] = ""; }
	if ($row["charclass"] == 22) { $row["class22select"] = "selected=\"selected\" "; } else { $row["class22select"] = ""; }
	if ($row["charclass"] == 23) { $row["class23select"] = "selected=\"selected\" "; } else { $row["class23select"] = ""; }
	if ($row["charclass"] == 24) { $row["class24select"] = "selected=\"selected\" "; } else { $row["class24select"] = ""; }
	if ($row["charclass"] == 25) { $row["class25select"] = "selected=\"selected\" "; } else { $row["class25select"] = ""; }
	if ($row["charclass"] == 26) { $row["class26select"] = "selected=\"selected\" "; } else { $row["class26select"] = ""; }
	if ($row["charclass"] == 27) { $row["class27select"] = "selected=\"selected\" "; } else { $row["class27select"] = ""; }
	if ($row["charclass"] == 28) { $row["class28select"] = "selected=\"selected\" "; } else { $row["class28select"] = ""; }
	if ($row["charclass"] == 29) { $row["class29select"] = "selected=\"selected\" "; } else { $row["class29select"] = ""; }
	if ($row["charclass"] == 30) { $row["class30select"] = "selected=\"selected\" "; } else { $row["class30select"] = ""; }	
	if ($row["charclass"] == 31) { $row["class31select"] = "selected=\"selected\" "; } else { $row["class31select"] = ""; }
	if ($row["charclass"] == 32) { $row["class32select"] = "selected=\"selected\" "; } else { $row["class32select"] = ""; }
	if ($row["charclass"] == 33) { $row["class33select"] = "selected=\"selected\" "; } else { $row["class33select"] = ""; }
	if ($row["charclass"] == 34) { $row["class34select"] = "selected=\"selected\" "; } else { $row["class34select"] = ""; }
	if ($row["charclass"] == 35) { $row["class35select"] = "selected=\"selected\" "; } else { $row["class35select"] = ""; }
	if ($row["charclass"] == 36) { $row["class36select"] = "selected=\"selected\" "; } else { $row["class36select"] = ""; }
	if ($row["charclass"] == 37) { $row["class37select"] = "selected=\"selected\" "; } else { $row["class37select"] = ""; }
	if ($row["charclass"] == 38) { $row["class38select"] = "selected=\"selected\" "; } else { $row["class38select"] = ""; }
	if ($row["charclass"] == 39) { $row["class39select"] = "selected=\"selected\" "; } else { $row["class39select"] = ""; }
	if ($row["charclass"] == 40) { $row["class40select"] = "selected=\"selected\" "; } else { $row["class40select"] = ""; }	
	if ($row["charclass"] == 41) { $row["class41select"] = "selected=\"selected\" "; } else { $row["class41select"] = ""; }
	if ($row["charclass"] == 42) { $row["class42select"] = "selected=\"selected\" "; } else { $row["class42select"] = ""; }
	if ($row["charclass"] == 43) { $row["class43select"] = "selected=\"selected\" "; } else { $row["class43select"] = ""; }
	if ($row["charclass"] == 44) { $row["class44select"] = "selected=\"selected\" "; } else { $row["class44select"] = ""; }
	if ($row["charclass"] == 45) { $row["class45select"] = "selected=\"selected\" "; } else { $row["class45select"] = ""; }
	if ($row["charclass"] == 46) { $row["class46select"] = "selected=\"selected\" "; } else { $row["class46select"] = ""; }
	if ($row["charclass"] == 47) { $row["class47select"] = "selected=\"selected\" "; } else { $row["class47select"] = ""; }
	if ($row["charclass"] == 48) { $row["class48select"] = "selected=\"selected\" "; } else { $row["class48select"] = ""; }
	if ($row["charclass"] == 49) { $row["class49select"] = "selected=\"selected\" "; } else { $row["class49select"] = ""; }
	if ($row["charclass"] == 50) { $row["class50select"] = "selected=\"selected\" "; } else { $row["class50select"] = ""; }
	if ($row["charclass"] == 51) { $row["class51select"] = "selected=\"selected\" "; } else { $row["class51select"] = ""; }
	if ($row["charclass"] == 52) { $row["class52select"] = "selected=\"selected\" "; } else { $row["class52select"] = ""; }
	
    if ($row["charalign"] == 1) { $row["align1select"] = "selected=\"selected\" "; } else { $row["align1select"] = ""; }
    if ($row["charalign"] == 2) { $row["align2select"] = "selected=\"selected\" "; } else { $row["align2select"] = ""; }
    if ($row["charalign"] == 3) { $row["align3select"] = "selected=\"selected\" "; } else { $row["align3select"] = ""; }
    if ($row["charalign"] == 4) { $row["align4select"] = "selected=\"selected\" "; } else { $row["align4select"] = ""; }
    if ($row["charalign"] == 5) { $row["align5select"] = "selected=\"selected\" "; } else { $row["align5select"] = ""; }
    if ($row["charalign"] == 6) { $row["align6select"] = "selected=\"selected\" "; } else { $row["align6select"] = ""; }
    if ($row["charalign"] == 7) { $row["align7select"] = "selected=\"selected\" "; } else { $row["align7select"] = ""; }
	
    if ($row["difficulty"] == 1) { $row["diff1select"] = "selected=\"selected\" "; } else { $row["diff1select"] = ""; }
    if ($row["difficulty"] == 2) { $row["diff2select"] = "selected=\"selected\" "; } else { $row["diff2select"] = ""; }
    if ($row["difficulty"] == 3) { $row["diff3select"] = "selected=\"selected\" "; } else { $row["diff3select"] = ""; }
    if ($row["difficulty"] == 4) { $row["diff4select"] = "selected=\"selected\" "; } else { $row["diff4select"] = ""; }
    if ($row["difficulty"] == 5) { $row["diff5select"] = "selected=\"selected\" "; } else { $row["diff5select"] = ""; }
    if ($row["difficulty"] == 6) { $row["diff6select"] = "selected=\"selected\" "; } else { $row["diff6select"] = ""; }
    if ($row["difficulty"] == 7) { $row["diff7select"] = "selected=\"selected\" "; } else { $row["diff7select"] = ""; }
    if ($row["difficulty"] == 8) { $row["diff8select"] = "selected=\"selected\" "; } else { $row["diff8select"] = ""; }
    if ($row["difficulty"] == 9) { $row["diff9select"] = "selected=\"selected\" "; } else { $row["diff9select"] = ""; }
    if ($row["difficulty"] == 10) { $row["diff10select"] = "selected=\"selected\" "; } else { $row["diff10select"] = ""; }
    if ($row["difficulty"] == 11) { $row["diff11select"] = "selected=\"selected\" "; } else { $row["diff11select"] = ""; }
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Users");
}

function addnews() {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($content == "") { $errors++; $errorlist .= "Content is required.<br />"; }
        
        if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET id='',postdate=NOW(),content='$content'", "news");
            admindisplay("News post added.","Add News");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Add News");
        }   
    }   
        
$page = <<<END

<u>Add A News Post</u><br /><br />
<form action="admin.php?do=news" method="post">
Type your post below and then click Submit to add it.<br />
<textarea name="content" rows="5" cols="50"></textarea><br />
<div align="center"><blockquote><blockquote><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote</blockquote></blockquote></div>
</form>
END;
    
    admindisplay($page, "Add News");
}

// Start Reset Orbs

function resetorbs() {

if (isset($_POST['rorbs'])) {
doquery("UPDATE {{table}} SET orbsrestart='1'", "users");

$page = '<u>Reset Orbs</u><br /><br />';
$page .= 'Reset orbs here every day so that users can collect orbs again. <br> NB Resetting orbs will not reset users collected orbs<p>';
$page .= '<form action="admin.php?do=resetorbs" method="post">';
$page .= '<input type="submit" name="rorbs" value="Resert Orbs" /></form>';
$page .= '<i>Orbs reset, users can now collect orbs again</i>';		
admindisplay($page, 'Reset Orbs');

}

	$page = '<u>Reset Orbs</u><br /><br />';
	$page .= 'Reset orbs here every day so that users can collect orbs again. <br> NB Resetting orbs will not reset users collected orbs<p>';
	$page .= '<form action="admin.php?do=resetorbs" method="post">';
	$page .= '<input type="submit" name="rorbs" value="Resert Orbs" /></form>';	
    admindisplay($page, 'Reset Orbs');
}

// END Reset Orbs




// Start reset babblebox

function resetbabble() {
	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_babble where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_babble";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<u>Reset Babblebox v2.0</u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database, or click the Clear button to erase all data.";
	$babblequery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 100", "babble");
	while ($babblerow = mysql_fetch_array($babblequery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=resetbabble\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$babblerow["id"]."\"></form>".$babblerow["author"].": ".$babblerow["babble"]."</p></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=resetbabble\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$babblerow["id"]."\"></form>".$babblerow["author"].": ".stripslashes($babblerow["babble"])."</p></div>\n"; $bg = 1; } 
	}
	$page .= "<br /><form action=\"admin.php?do=resetbabble\" method=\"post\"><input type=\"submit\" value=\"Clear Babblebox\" name=\"clear\"></form>";
	admindisplay($page, "Reset Babblebox");
}

// END reset babblebox




// edit news
function editnews() {
	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_news where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_news";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<u>Edit News</u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database, or click the Clear button to erase all data.";
	$newsquery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 100", "news");
	while ($newsrow = mysql_fetch_array($newsquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=editnews\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$newsrow["id"]."\"></form>".$newsrow["postdate"].": ".$newsrow["content"]."</p></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=editnews\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$newsrow["id"]."\"></form>".$newsrow["postdate"].": ".stripslashes($newsrow["content"])."</p></div>\n"; $bg = 1; } 
	}
	$page .= "<br /><form action=\"admin.php?do=editnews\" method=\"post\"><input type=\"submit\" value=\"Clear News\" name=\"clear\"></form>";
	admindisplay($page, "Reset News");
}


// del users
function deluser() {
	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_users where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_users";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<b><u>Del Users</b></u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database.";
	$userquery = doquery("SELECT * FROM {{table}} ORDER BY id DESC LIMIT 100", "users");
	while ($userrow = mysql_fetch_array($userquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:30%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delusers\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" name=\"id\" value=\"".$userrow["id"]."\"> <b>".$userrow["id"]."</b>: <b>".$userrow["charname"]."</b></p></form></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:30%; background-color:#cccccc; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delusers\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\" class=\"myButton2\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" name=\"id\" value=\"".$userrow["id"]."\"> <b>".$userrow["id"]."</b>: <b>".$userrow["charname"]."</b></p></form></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Del Users");
}   



function deldrop() {

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_drops where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_drops";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<b><u>Del Drops</b></u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database.";
	$userquery = doquery("SELECT * FROM {{table}} ORDER BY id", "drops");
	while ($userrow = mysql_fetch_array($userquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=deldrops\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$userrow["id"]."\"> <b>".$userrow["id"]."</b>: <b>".$userrow["name"]."</b></p></form></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=deldrops\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$userrow["id"]."\"> <b>".$userrow["id"]."</b>: <b>".$userrow["name"]."</b></p></form></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Del Drops");
}






function delitem() {

	if (isset($_POST['delete'])) {
		$id = $_POST['id'];
		$sql ="delete from dk_items where id=$id";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	if (isset($_POST['clear'])) {
		$sql ="delete from dk_items";
		mysql_query($sql) or die("MySQL error: ".mysql_error()."");
	}
	$page = "<b><u>Del Items</b></u><br /><br />Click the Delete button next to the appropriate entry to remove that entry from the database.";
	$itemquery = doquery("SELECT * FROM {{table}} ORDER BY id", "items");
	while ($itemrow = mysql_fetch_array($itemquery)) {
		if ($bg == 1) { $page .= "<div style=\"width:98%; background-color:#eeeeee; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delitems\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$itemrow["id"]."\"> <b>".$itemrow["id"]."</b>: <b>".$itemrow["name"]."</b></p></form></div>\n"; $bg = 2; }
		else { $page .= "<div style=\"width:98%; background-color:#ffffff; font-family: tahoma; font-size: 8pt; line-height: 1.4em; color: #0A3549;\"><form action=\"admin.php?do=delitems\" method=\"post\"><p><input type=\"submit\" value=\"Delete\" name=\"delete\"> <input type=\"hidden\" name=\"id\" value=\"".$itemrow["id"]."\"> <b>".$itemrow["id"]."</b>: <b>".$itemrow["name"]."</b></p></form></div>\n"; $bg = 1; } 
	}
	admindisplay($page, "Del Items");
} 




// Start NPC
// Start NPC
// Start NPC

function npc() {
    
    $query = doquery("SELECT id,name,town FROM {{table}} ORDER BY id", "npcs");
    $page = "<u>Edit NPC's</u><br />Click a NPC's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editnpc:".$row["id"]."\">".$row["name"]."</a></td><td width=\"12%\" style=\"background-color: #eeeeee;\">Town ".$row["town"]."</td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editnpc:".$row["id"]."\">".$row["name"]."</a></td><td width=\"12%\" style=\"background-color: #ffffff;\">Town ".$row["town"]."</td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No NPC's found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit NPC's");
    
}

function editnpc($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
		if ($townid == "") { $errors++; $errorlist .= "Town ID is required.<br />"; }
		if (!is_numeric($townid)) { $errors++; $errorlist .= "Town ID must be a number.<br />"; }
		if ($image == "") { $errors++; $errorlist .= "Image link is required. Set this to 0 if you don't want to use a image for the NPC.<br />"; }
		if ($introtext == "") { $errors++; $errorlist .= "Intro text is required.<br />"; }
		if ($qnum == "") { $errors++; $errorlist .= "Numbers of questions must be set.<br />"; }
		if (!is_numeric($qnum)) { $errors++; $errorlist .= "Numbers of questions must be a number.<br />"; }
			
		if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='".$name."',town='".$townid."',image='".$image."',intro='".$introtext."',questions='".$qnum."',question1='".$q1."',answer1='".$a1."',question2='".$q2."',answer2='".$a2."',question3='".$q3."',answer3='".$a3."',question4='".$q4."',answer4='".$a4."',question5='".$q5."',answer5='".$a5."',question6='".$q6."',answer6='".$a6."',question7='".$q7."',answer7='".$a7."',question8='".$q8."',answer8='".$a8."',question9='".$q9."',answer9='".$a9."',question10='".$q10."',answer10='".$a10."' WHERE id='$id' LIMIT 1", "npcs");
            admindisplay("NPC updated.","Edit NPC's");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit NPC's");
        }   
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "npcs");
    $row = mysql_fetch_array($query);
	

$page = <<<END
<u>Edit NPC</u><br><br>

<form action="admin.php?do=editnpc:$id" method="post">
<table width="80%">
<tr><td width="20%">ID:</td><td>{{id}}</td><td colspan="2" rowspan=5><img align="left" src="images/npc/{{name}}.png"></td></tr>      

<tr><td width="20%">Name:</td><td><input type="text" name="name" size="80" maxlength="80" value="{{name}}" /><br Name of the NPC.</td><td><br /></td></tr>

<tr><td width="20%">Town ID:</td><td><input type="text" name="townid" size="2" maxlength="2" value="{{town}}" /><br />This is the ID of the town where the NPC will appear.<br />If you give an ID which doesn't exist, the NPC will never show up.</td><td><br /></td></tr>

<tr><td colspan="3">
<br />
<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="80%" border="2" cellpadding="0" cellspacing="0" style="border-width: 0px; background-color: #ffffff;"><tr valign="top"><td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">1</td><td style="background-color: #eeeeee;">Capital Crossroads</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">2</td><td style="background-color: #ffffff;">Argos</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">3</td><td style="background-color: #eeeeee;">Sidon</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">4</td><td style="background-color: #ffffff;">Jericho</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">5</td><td style="background-color: #eeeeee;">Narcissa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">6</td><td style="background-color: #ffffff;">Luxor</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">7</td><td style="background-color: #eeeeee;">Carthage</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">8</td><td style="background-color: #ffffff;">Corinth</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">9</td><td style="background-color: #eeeeee;">Haggaror</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">10</td><td style="background-color: #ffffff;">Troy</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">11</td><td style="background-color: #eeeeee;">Rey</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">12</td><td style="background-color: #ffffff;">Merigold</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">13</td><td style="background-color: #eeeeee;">Athens</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">14</td><td style="background-color: #ffffff;">Cario</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">15</td><td style="background-color: #eeeeee;">Cyreneia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">16</td><td style="background-color: #ffffff;">Camasiacum</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">17</td><td style="background-color: #eeeeee;">Itanais</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">18</td><td style="background-color: #ffffff;">Neropolis</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">19</td><td style="background-color: #eeeeee;">Girsche</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">20</td><td style="background-color: #ffffff;">Far Point City</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">21</td><td style="background-color: #eeeeee;">LC of Arcadia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">22</td><td style="background-color: #ffffff;">LC of Avalon</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">23</td><td style="background-color: #eeeeee;">LC of Nysa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">24</td><td style="background-color: #ffffff;">LC of Zerzura</td></tr>
</table>
</td></tr></table></div>
<br />
</td></tr>

<tr><td width="20%">Image:</td><td><input type="text" name="image" size="80" maxlength="80" value="{{image}}" /><br />This is the name of the image file that will be shown when a player speaks to the<br /> NPC. Set this to 0 if you don't want to use a image for the NPC.</td><td><br /></td></tr>

<tr><td width="20%">Intro text:</td><td><textarea cols="80" rows="12" name="introtext" wrap="physical">{{intro}}</textarea><br />This is the text that appears to the user when they are first talk with the NPC.<br /></td><td><br /></td></tr>
</table>

<table width="80%">
<tr><td colspan="2" style="background-color:#cccccc;">Number of Questions</td></tr>

<tr><td width="20%">Number of questions:</td><td><input type="text" name="qnum" size="2" maxlength="2" value="{{questions}}" /><br />This shall be a number between 1 and 10, depending on how many <br />questions you have. 1 = 1 Question, 2 = 2 Questions, etc.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 1</td></tr>
<tr><td width="20%">Question 1:</td><td><input type="text" name="q1" size="80" maxlength="120" value="{{question1}}" /><br />This is question number 1, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 1:</td><td><textarea cols="80" rows="12" name="a1" wrap="physical">{{answer1}}</textarea><br />This is the answer to question number 1, it appears when the user have asked the NPC about question 1.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 2</td></tr>
<tr><td width="20%">Question 2:</td><td><input type="text" name="q2" size="80" maxlength="120" value="{{question2}}" /><br />This is question number 2, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 2:</td><td><textarea cols="80" rows="12" name="a2" wrap="physical">{{answer2}}</textarea><br />This is the answer to question number 2, it appears when the user have asked the NPC about question 2.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 3</td></tr>
<tr><td width="20%">Question 3:</td><td><input type="text" name="q3" size="80" maxlength="120" value="{{question3}}" /><br />This is question number 3, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 3:</td><td><textarea cols="80" rows="12" name="a3" wrap="physical">{{answer3}}</textarea><br />This is the answer to question number 3, it appears when the user have asked the NPC about question 3.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 4</td></tr>
<tr><td width="20%">Question 4:</td><td><input type="text" name="q4" size="80" maxlength="120" value="{{question4}}" /><br />This is question number 4, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 4:</td><td><textarea cols="80" rows="12" name="a4" wrap="physical">{{answer4}}</textarea><br />This is the answer to question number 4, it appears when the user have asked the NPC about question 4.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 5</td></tr>
<tr><td width="20%">Question 5:</td><td><input type="text" name="q5" size="80" maxlength="120" value="{{question5}}" /><br />This is question number 5, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 5:</td><td><textarea cols="80" rows="12" name="a5" wrap="physical">{{answer5}}</textarea><br />This is the answer to question number 5, it appears when the user have asked the NPC about question 5.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 6</td></tr>
<tr><td width="20%">Question 6:</td><td><input type="text" name="q6" size="80" maxlength="120" value="{{question6}}" /><br />This is question number 6, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 6:</td><td><textarea cols="80" rows="12" name="a6" wrap="physical">{{answer6}}</textarea><br />This is the answer to question number 6, it appears when the user have asked the NPC about question 6.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 7</td></tr>
<tr><td width="20%">Question 7:</td><td><input type="text" name="q7" size="80" maxlength="120" value="{{question7}}" /><br />This is question number 7, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 7:</td><td><textarea cols="80" rows="12" name="a7" wrap="physical">{{answer7}}</textarea><br />This is the answer to question number 7, it appears when the user have asked the NPC about question 7.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 8</td></tr>
<tr><td width="20%">Question 8:</td><td><input type="text" name="q8" size="80" maxlength="120" value="{{question8}}" /><br />This is question number 8, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 8:</td><td><textarea cols="80" rows="12" name="a8" wrap="physical">{{answer8}}</textarea><br />This is the answer to question number 8, it appears when the user have asked the NPC about question 8.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 9</td></tr>
<tr><td width="20%">Question 9:</td><td><input type="text" name="q9" size="80" maxlength="120" value="{{question9}}" /><br />This is question number 9, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 9:</td><td><textarea cols="80" rows="12" name="a9" wrap="physical">{{answer9}}</textarea><br />This is the answer to question number 9, it appears when the user have asked the NPC about question 9.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 10</td></tr>
<tr><td width="20%">Question 10:</td><td><input type="text" name="q10" size="80" maxlength="120" value="{{question10}}" /><br />This is question number 10, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 10:</td><td><textarea cols="80" rows="12" name="a10" wrap="physical">{{answer10}}</textarea><br />This is the answer to question number 10, it appears when the user have asked the NPC about question 10.</td></tr>

</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit NPC's");
}

function addnpc() {
    
    if (isset($_POST["submit"])) {
        
		extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
		if ($townid == "") { $errors++; $errorlist .= "Town ID is required.<br />"; }
		if (!is_numeric($townid)) { $errors++; $errorlist .= "Town ID must be a number.<br />"; }
		if ($image == "") { $errors++; $errorlist .= "Image link is required. Set this to 0 if you don't want to use a image for the NPC.<br />"; }
		if ($introtext == "") { $errors++; $errorlist .= "Intro text is required.<br />"; }
		if ($qnum == "") { $errors++; $errorlist .= "Numbers of questions must be set.<br />"; }
		if (!is_numeric($qnum)) { $errors++; $errorlist .= "Numbers of questions must be a number.<br />"; }
			
		if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET name='".$name."',town='".$townid."',image='".$image."',intro='".$introtext."',questions='".$qnum."',question1='".$q1."',question2='".$q2."',question3='".$q3."',question4='".$q4."',question5='".$q5."',question6='".$q6."',question7='".$q7."',question8='".$q8."',question9='".$q9."',question10='".$q10."',answer1='".$a1."',answer2='".$a2."',answer3='".$a3."',answer4='".$a4."',answer5='".$a5."',answer6='".$a6."',answer7='".$a7."',answer8='".$a8."',answer9='".$a9."',answer10='".$a10."'", "npcs");
            admindisplay("NPC added.","Add NPC");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Add NPC");
        }   
    }   

$page = <<<END
Add NPC<br /><br />
<form action="admin.php?do=addnpc:$id" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>

<tr><td width="20%">Name:</td><td><input type="text" name="name" size="80" maxlength="80" value="" /><br Name of the NPC.</span></td></tr>

<tr><td width="20%">Town ID:</td><td><input type="text" name="townid" size="2" maxlength="2" value="" /><br /><span class="small">This is the ID of the town where the NPC will appear. If you give an ID which doesn't exist, the NPC will never show up.</span></td></tr>


<tr><td colspan="3">
<br />
<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="80%" border="2" cellpadding="0" cellspacing="0" style="border-width: 0px; background-color: #ffffff;"><tr valign="top"><td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">1</td><td style="background-color: #eeeeee;">Capital Crossroads</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">2</td><td style="background-color: #ffffff;">Argos</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">3</td><td style="background-color: #eeeeee;">Sidon</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">4</td><td style="background-color: #ffffff;">Jericho</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">5</td><td style="background-color: #eeeeee;">Narcissa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">6</td><td style="background-color: #ffffff;">Luxor</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">7</td><td style="background-color: #eeeeee;">Carthage</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">8</td><td style="background-color: #ffffff;">Corinth</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">9</td><td style="background-color: #eeeeee;">Haggaror</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">10</td><td style="background-color: #ffffff;">Troy</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">11</td><td style="background-color: #eeeeee;">Rey</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">12</td><td style="background-color: #ffffff;">Merigold</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">13</td><td style="background-color: #eeeeee;">Athens</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">14</td><td style="background-color: #ffffff;">Cario</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">15</td><td style="background-color: #eeeeee;">Cyreneia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">16</td><td style="background-color: #ffffff;">Camasiacum</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">17</td><td style="background-color: #eeeeee;">Itanais</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">18</td><td style="background-color: #ffffff;">Neropolis</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">19</td><td style="background-color: #eeeeee;">Girsche</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">20</td><td style="background-color: #ffffff;">Far Point City</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">21</td><td style="background-color: #eeeeee;">LC of Arcadia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">22</td><td style="background-color: #ffffff;">LC of Avalon</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">23</td><td style="background-color: #eeeeee;">LC of Nysa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">24</td><td style="background-color: #ffffff;">LC of Zerzura</td></tr>
</table>
</td></tr></table></div>
<br />
</td></tr>


<tr><td width="20%">Image:</td><td><input type="text" name="image" size="80" maxlength="80" value="" /><br /><span class="small">This is the name of the image file that will be shown when a player speaks to the NPC. Set this to 0 if you don't want to use a image for the NPC.</td></tr>

<tr><td width="20%">Intro text:</td><td><textarea cols="80" rows="12" name="introtext" wrap="physical"></textarea><br /><span class="small">This is the text that appears to the user when they are first talk with the NPC.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Number if Questions</td></tr>

<tr><td width="20%">Number of questions:</td><td><input type="text" name="qnum" size="2" maxlength="2" value="" /><br /><span class="small">This shall be a number between 1 and 10, depending on how many questions you have. 1 = 1 Question, 2 = 2 Questions, etc.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 1</td></tr>
<tr><td width="20%">Question 1:</td><td><input type="text" name="q1" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 1, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 1:</td><td><textarea cols="80" rows="12" name="a1" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 1, it appears when the user have asked the NPC about question 1.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 2</td></tr>
<tr><td width="20%">Question 2:</td><td><input type="text" name="q2" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 2, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 2:</td><td><textarea cols="80" rows="12" name="a2" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 2, it appears when the user have asked the NPC about question 2.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 3</td></tr>
<tr><td width="20%">Question 3:</td><td><input type="text" name="q3" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 3, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 3:</td><td><textarea cols="80" rows="12" name="a3" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 3, it appears when the user have asked the NPC about question 3.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 4</td></tr>
<tr><td width="20%">Question 4:</td><td><input type="text" name="q4" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 4, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 4:</td><td><textarea cols="80" rows="12" name="a4" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 4, it appears when the user have asked the NPC about question 4.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 5</td></tr>
<tr><td width="20%">Question 5:</td><td><input type="text" name="q5" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 5, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 5:</td><td><textarea cols="80" rows="12" name="a5" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 5, it appears when the user have asked the NPC about question 5.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 6</td></tr>
<tr><td width="20%">Question 6:</td><td><input type="text" name="q6" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 6, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 6:</td><td><textarea cols="80" rows="12" name="a6" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 6, it appears when the user have asked the NPC about question 6.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 7</td></tr>
<tr><td width="20%">Question 7:</td><td><input type="text" name="q7" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 7, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 7:</td><td><textarea cols="80" rows="12" name="a7" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 7, it appears when the user have asked the NPC about question 7.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 8</td></tr>
<tr><td width="20%">Question 8:</td><td><input type="text" name="q8" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 8, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 8:</td><td><textarea cols="80" rows="12" name="a8" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 8, it appears when the user have asked the NPC about question 8.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 9</td></tr>
<tr><td width="20%">Question 9:</td><td><input type="text" name="q9" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 9, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 9:</td><td><textarea cols="80" rows="12" name="a9" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 9, it appears when the user have asked the NPC about question 9.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 10</td></tr>
<tr><td width="20%">Question 10:</td><td><input type="text" name="q10" size="80" maxlength="80" value="" /><br /><span class="small">This is question number 10, it appears when the user have talked with the NPC.</td></tr>
<tr><td width="20%">Answer 10:</td><td><textarea cols="80" rows="12" name="a10" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 10, it appears when the user have asked the NPC about question 10.</span></td></tr>

</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    //$page = parsetemplate($page, $row);
    admindisplay($page, "Add NPC");
	
// END NPCs	
}









//START NPC2





function npc2() {
    
    $query = doquery("SELECT id,name,town FROM {{table}} ORDER BY id", "npcs2");
    $page = "<u>Edit NPC's II</u><br />Click a NPC's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editnpc2:".$row["id"]."\">".$row["name"]."</a></td><td width=\"12%\" style=\"background-color: #eeeeee;\">Town ".$row["town"]."</td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editnpc2:".$row["id"]."\">".$row["name"]."</a></td><td width=\"12%\" style=\"background-color: #ffffff;\">Town ".$row["town"]."</td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No NPC's II  found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit NPC's II");
    
}

function editnpc2($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
		if ($townid == "") { $errors++; $errorlist .= "Town ID is required.<br />"; }
		if (!is_numeric($townid)) { $errors++; $errorlist .= "Town ID must be a number.<br />"; }
		if ($image == "") { $errors++; $errorlist .= "Image link is required. Set this to 0 if you don't want to use a image for the NPC.<br />"; }
		if ($introtext == "") { $errors++; $errorlist .= "Intro text is required.<br />"; }
		if ($qnum == "") { $errors++; $errorlist .= "Numbers of questions must be set.<br />"; }
		if (!is_numeric($qnum)) { $errors++; $errorlist .= "Numbers of questions must be a number.<br />"; }
			
		if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='".$name."',town='".$townid."',image='".$image."',intro='".$introtext."',questions='".$qnum."',question1='".$q1."',answer1='".$a1."',question2='".$q2."',answer2='".$a2."',question3='".$q3."',answer3='".$a3."',question4='".$q4."',answer4='".$a4."',question5='".$q5."',answer5='".$a5."' WHERE id='$id' LIMIT 1", "npcs2");
            admindisplay("NPC II updated.","Edit NPC's II");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit NPC's II");
        }   
    }   
        
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "npcs2");
    $row = mysql_fetch_array($query);

$page = <<<END
<u>Edit NPC II</u><br /><br />
<form action="admin.php?do=editnpc2:$id" method="post">
<table width="80%">
<tr><td width="20%">ID:</td><td>{{id}}</td><td colspan="2" rowspan=5><img align="left" src="images/npc/{{name}}.png"></td></tr>      

<tr><td width="20%">Name:</td><td><input type="text" name="name" size="80" maxlength="80" value="{{name}}" /><br Name of the NPC II.</td><td><br /></td></tr>

<tr><td width="20%">Town ID:</td><td><input type="text" name="townid" size="2" maxlength="2" value="{{town}}" /><br />This is the ID of the town where the NPC II will appear.<br />If you give an ID which doesn't exist, the NPC II will never show up.</td><td><br /></td></tr>

<tr><td colspan="3">
<br />
<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="80%" border="2" cellpadding="0" cellspacing="0" style="border-width: 0px; background-color: #ffffff;"><tr valign="top"><td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">1</td><td style="background-color: #eeeeee;">Capital Crossroads</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">2</td><td style="background-color: #ffffff;">Argos</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">3</td><td style="background-color: #eeeeee;">Sidon</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">4</td><td style="background-color: #ffffff;">Jericho</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">5</td><td style="background-color: #eeeeee;">Narcissa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">6</td><td style="background-color: #ffffff;">Luxor</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">7</td><td style="background-color: #eeeeee;">Carthage</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">8</td><td style="background-color: #ffffff;">Corinth</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">9</td><td style="background-color: #eeeeee;">Haggaror</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">10</td><td style="background-color: #ffffff;">Troy</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">11</td><td style="background-color: #eeeeee;">Rey</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">12</td><td style="background-color: #ffffff;">Merigold</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">13</td><td style="background-color: #eeeeee;">Athens</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">14</td><td style="background-color: #ffffff;">Cario</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">15</td><td style="background-color: #eeeeee;">Cyreneia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">16</td><td style="background-color: #ffffff;">Camasiacum</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">17</td><td style="background-color: #eeeeee;">Itanais</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">18</td><td style="background-color: #ffffff;">Neropolis</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">19</td><td style="background-color: #eeeeee;">Girsche</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">20</td><td style="background-color: #ffffff;">Far Point City</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">21</td><td style="background-color: #eeeeee;">LC of Arcadia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">22</td><td style="background-color: #ffffff;">LC of Avalon</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">23</td><td style="background-color: #eeeeee;">LC of Nysa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">24</td><td style="background-color: #ffffff;">LC of Zerzura</td></tr>
</table>
</td></tr></table></div>
<br />
</td></tr>

<tr><td width="20%">Image:</td><td><input type="text" name="image" size="80" maxlength="80" value="{{image}}" /><br />This is the name of the image file that will be shown when a player speaks to the<br /> NPC II. Set this to 0 if you don't want to use a image for the NPC.</td><td><br /></td></tr>

<tr><td width="20%">Intro text:</td><td><textarea cols="80" rows="12" name="introtext" wrap="physical">{{intro}}</textarea><br />This is the text that appears to the user when they are first talk with the NPC II.<br /></td><td><br /></td></tr>
</table>


<table width="80%">
<tr><td colspan="2" style="background-color:#cccccc;">Number of Questions</td></tr>

<tr><td width="20%">Number of questions:</td><td><input type="text" name="qnum" size="40" maxlength="60" value="{{questions}}" /><br />This shall be a number between 1 and 5, depending on how many questions you have. 1 = 1 Question, 2 = 2 Questions, etc.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 1</td></tr>

<tr><td width="20%">Question 1:</td><td><input type="text" name="q1" size="50" maxlength="100" value="{{question1}}" /><br />This is question number 1, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 1:</td><td><textarea cols="60" rows="20" name="a1" wrap="physical">{{answer1}}</textarea><br />This is the answer to question number 1, it appears when the user have asked the NPC II about question 1.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 2</td></tr>

<tr><td width="20%">Question 2:</td><td><input type="text" name="q2" size="50" maxlength="100" value="{{question2}}" /><br />This is question number 2, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 2:</td><td><textarea cols="60" rows="20" name="a2" wrap="physical">{{answer2}}</textarea><br />This is the answer to question number 2, it appears when the user have asked the NPC II about question 2.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 3</td></tr>

<tr><td width="20%">Question 3:</td><td><input type="text" name="q3" size="50" maxlength="100" value="{{question3}}" /><br />This is question number 3, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 3:</td><td><textarea cols="60" rows="20" name="a3" wrap="physical">{{answer3}}</textarea><br />This is the answer to question number 3, it appears when the user have asked the NPC II about question 3.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 4</td></tr>

<tr><td width="20%">Question 4:</td><td><input type="text" name="q4" size="50" maxlength="100" value="{{question4}}" /><br />This is question number 4, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 4:</td><td><textarea cols="60" rows="20" name="a4" wrap="physical">{{answer4}}</textarea><br />This is the answer to question number 4, it appears when the user have asked the NPC II about question 4.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 5</td></tr>

<tr><td width="20%">Question 5:</td><td><input type="text" name="q5" size="50" maxlength="100" value="{{question5}}" /><br />This is question number 5, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 5:</td><td><textarea cols="60" rows="20" name="a5" wrap="physical">{{answer5}}</textarea><br />This is the answer to question number 5, it appears when the user have asked the NPC II about question 5.</td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit NPC's II");
}

function addnpc2() {
    
    if (isset($_POST["submit"])) {
        
		extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
		if ($townid == "") { $errors++; $errorlist .= "Town ID is required.<br />"; }
		if (!is_numeric($townid)) { $errors++; $errorlist .= "Town ID must be a number.<br />"; }
		if ($image == "") { $errors++; $errorlist .= "Image link is required. Set this to 0 if you don't want to use a image for the NPC.<br />"; }
		if ($introtext == "") { $errors++; $errorlist .= "Intro text is required.<br />"; }
		if ($qnum == "") { $errors++; $errorlist .= "Numbers of questions must be set.<br />"; }
		if (!is_numeric($qnum)) { $errors++; $errorlist .= "Numbers of questions must be a number.<br />"; }
			
		if ($errors == 0) { 
            $query = doquery("INSERT INTO {{table}} SET name='".$name."',town='".$townid."',image='".$image."',intro='".$introtext."',questions='".$qnum."',question1='".$q1."',question2='".$q2."',question3='".$q3."',question4='".$q4."',question5='".$q5."',answer1='".$a1."',answer2='".$a2."',answer3='".$a3."',answer4='".$a4."',answer5='".$a5."'", "npcs2");
            admindisplay("NPC II added.","Add NPC II");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Add NPC II");
        }   
    }   

$page = <<<END
Add NPC II<br /><br />
<form action="admin.php?do=addnpc2:$id" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>Autogenerated</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="40" maxlength="50" value="" /><br Name of the NPC.</span></td></tr>
<tr><td width="20%">Town ID:</td><td><input type="text" name="townid" size="3" maxlength="3" value="" /><br /><span class="small">This is the ID of the town where the NPC will appear. If you give an ID which doesn't exist, the NPC will never show up.</span></td></tr>

<tr><td colspan="3">
<br />
<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table width="80%" border="2" cellpadding="0" cellspacing="0" style="border-width: 0px; background-color: #ffffff;"><tr valign="top"><td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">1</td><td style="background-color: #eeeeee;">Capital Crossroads</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">2</td><td style="background-color: #ffffff;">Argos</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">3</td><td style="background-color: #eeeeee;">Sidon</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">4</td><td style="background-color: #ffffff;">Jericho</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">5</td><td style="background-color: #eeeeee;">Narcissa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">6</td><td style="background-color: #ffffff;">Luxor</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">7</td><td style="background-color: #eeeeee;">Carthage</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">8</td><td style="background-color: #ffffff;">Corinth</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">9</td><td style="background-color: #eeeeee;">Haggaror</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">10</td><td style="background-color: #ffffff;">Troy</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">11</td><td style="background-color: #eeeeee;">Rey</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">12</td><td style="background-color: #ffffff;">Merigold</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">13</td><td style="background-color: #eeeeee;">Athens</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">14</td><td style="background-color: #ffffff;">Cario</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">15</td><td style="background-color: #eeeeee;">Cyreneia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">16</td><td style="background-color: #ffffff;">Camasiacum</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">17</td><td style="background-color: #eeeeee;">Itanais</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">18</td><td style="background-color: #ffffff;">Neropolis</td></tr>
</table>
</td>
<td>
<table width="100%">
<tr><td width="8%" style="background-color: #eeeeee;">19</td><td style="background-color: #eeeeee;">Girsche</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">20</td><td style="background-color: #ffffff;">Far Point City</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">21</td><td style="background-color: #eeeeee;">LC of Arcadia</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">22</td><td style="background-color: #ffffff;">LC of Avalon</td></tr>
<tr><td width="8%" style="background-color: #eeeeee;">23</td><td style="background-color: #eeeeee;">LC of Nysa</td></tr>
<tr><td width="8%" style="background-color: #ffffff;">24</td><td style="background-color: #ffffff;">LC of Zerzura</td></tr>
</table>
</td></tr></table></div>
<br />
</td></tr>

<tr><td width="20%">Image:</td><td><input type="text" name="image" size="40" maxlength="50" value="" /><br /><span class="small">This is the name of the image file that will be shown when a player speaks to the NPC. Set this to 0 if you don't want to use a image for the NPC.</td></tr>
<tr><td width="20%">Intro text:</td><td><textarea cols="60" rows="10" name="introtext" wrap="physical"></textarea><br /><span class="small">This is the text that appears to the user when they are first talk with the NPC II.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Number if Questions</td></tr>

<tr><td width="20%">Number of questions:</td><td><input type="text" name="qnum" size="3" maxlength="3" value="" /><br /><span class="small">This shall be a number between 1 and 5, depending on how many questions you have. 1 = 1 Question, 2 = 2 Questions, etc...</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 1</td></tr>

<tr><td width="20%">Question 1:</td><td><input type="text" name="q1" size="60" maxlength="100" value="" /><br /><span class="small">This is question number 1, it appears when the user have talked with the NPC.</td></tr>

<tr><td width="20%">Answer 1:</td><td><textarea cols="60" rows="10" name="a1" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 1, it appears when the user have asked the NPC II about question 1.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 2</td></tr>

<tr><td width="20%">Question 2:</td><td><input type="text" name="q2" size="60" maxlength="100" value="" /><br /><span class="small">This is question number 2, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 2:</td><td><textarea cols="60" rows="10" name="a2" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 2, it appears when the user have asked the NPC II about question 2.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 3</td></tr>

<tr><td width="20%">Question 3:</td><td><input type="text" name="q3" size="60" maxlength="100" value="" /><br /><span class="small">This is question number 3, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 3:</td><td><textarea cols="60" rows="10" name="a3" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 3, it appears when the user have asked the NPC about question 3.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 4</td></tr>

<tr><td width="20%">Question 4:</td><td><input type="text" name="q4" size="60" maxlength="100" value="" /><br /><span class="small">This is question number 4, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 4:</td><td><textarea cols="60" rows="10" name="a4" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 4, it appears when the user have asked the NPC II about question 4.</span></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Question & Answer 5</td></tr>

<tr><td width="20%">Question 5:</td><td><input type="text" name="q5" size="60" maxlength="100" value="" /><br /><span class="small">This is question number 5, it appears when the user have talked with the NPC II.</td></tr>

<tr><td width="20%">Answer 5:</td><td><textarea cols="60" rows="10" name="a5" wrap="physical"></textarea><br /><span class="small">This is the answer to question number 5, it appears when the user have asked the NPC II about question 5.</span></td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    //$page = parsetemplate($page, $row);
    admindisplay($page, "Add NPC II");
	
}






//END NPC2








function fields() {
    
    $query = doquery("SELECT id,name FROM {{table}} ORDER BY id", "fields");
    $page = "<u>Edit Fields</u><br />Click an field's name to edit it.<br /><br /><table width=\"50%\">\n";
    $count = 1;
    while ($row = mysql_fetch_array($query)) {
        if ($count == 1) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">".$row["id"]."</td><td style=\"background-color: #eeeeee;\"><a href=\"admin.php?do=editfield:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 2; }
        else { $page .= "<tr><td width=\"8%\" style=\"background-color: #ffffff;\">".$row["id"]."</td><td style=\"background-color: #ffffff;\"><a href=\"admin.php?do=editfield:".$row["id"]."\">".$row["name"]."</a></td></tr>\n"; $count = 1; }
    }
    if (mysql_num_rows($query) == 0) { $page .= "<tr><td width=\"8%\" style=\"background-color: #eeeeee;\">No fields found.</td></tr>\n"; }
    $page .= "</table>";
    admindisplay($page, "Edit Fields");
}

function editfield($id) {
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
        if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be a number.<br />"; }
        if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
        if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be a number.<br />"; }
        
        if ($errors == 0) { 
            $query = doquery("UPDATE {{table}} SET name='$name',latitude='$latitude',longitude='$longitude',fieldmonster1id='$fieldmonster1id',fieldmonster2id='$fieldmonster2id' WHERE id='$id' LIMIT 1", "fields");

            admindisplay("Field updated.","Edit Fields");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Edit Fields");
        }              
    }           
    
    $query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "fields");
    $row = mysql_fetch_array($query);

$page = <<<END
Edit Fields<br /><br />
<form action="admin.php?do=editfield:$id" method="post">
<table width="90%">
<tr><td width="20%">ID:</td><td>{{id}}</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="30" value="{{name}}" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Position</td></tr>

<tr><td width="20%">Latitude:</td><td><input type="text" name="latitude" size="5" maxlength="10" value="{{latitude}}" /><br />Positive or negative integer.</td></tr>

<tr><td width="20%">Longitude:</td><td><input type="text" name="longitude" size="5" maxlength="10" value="{{longitude}}" /><br />Positive or negative integer.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Field Monster</td></tr>

<tr><td width="20%">Field Monster 1 ID:</td><td><input type="text" name="fieldmonster1id" size="5" maxlength="5" value="{{fieldmonster1id}}" /></td></tr>

<tr><td width="20%">Field Monster 2 ID:</td><td><input type="text" name="fieldmonster2id" size="5" maxlength="5" value="{{fieldmonster2id}}" /></td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Edit Fields"); 

}

function addfield() {  
    
    if (isset($_POST["submit"])) {
        
        extract($_POST);
        $errors = 0;
        $errorlist = "";
        if ($name == "") { $errors++; $errorlist .= "Name is required.<br />"; }
        if ($latitude == "") { $errors++; $errorlist .= "Latitude is required.<br />"; }
        if (!is_numeric($latitude)) { $errors++; $errorlist .= "Latitude must be a number.<br />"; }
        if ($longitude == "") { $errors++; $errorlist .= "Longitude is required.<br />"; }
        if (!is_numeric($longitude)) { $errors++; $errorlist .= "Longitude must be a number.<br />"; }
        
        if ($errors == 0) { 
		$query = doquery("INSERT INTO {{table}} SET id='',name='$name',fieldmonster1id='$fieldmonster1id',fieldmonster2id='$fieldmonster2id',latitude='$latitude',longitude='$longitude'", "fields");
            admindisplay("Field created.","Edit Fieldss");
        } else {
            admindisplay("Errors:<br /><div style=\"color:red;\">$errorlist</div><br />Please go back and try again.", "Create Fields");
        } 
    }   
    
$page = <<<END
Create Fields<br /><br />
<form action="admin.php?do=addfield" method="post">
Type your post below and then click Submit to add it.<br />

<table width="90%">
<tr><td width="20%">ID:</td><td>Auto generated</td></tr>
<tr><td width="20%">Name:</td><td><input type="text" name="name" size="30" maxlength="30" value="" /></td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Position</td></tr>

<tr><td width="20%">Latitude:</td><td><input type="text" name="latitude" size="5" maxlength="10" value="" /><br />Positive or negative integer.</td></tr>
<tr><td width="20%">Longitude:</td><td><input type="text" name="longitude" size="5" maxlength="10" value="" /><br />Positive or negative integer.</td></tr>

<tr><td colspan="2" style="background-color:#cccccc;">Field Monster</td></tr>

<tr><td width="20%"> Field Monster 1 ID:</td><td><input type="text" name="fieldmonster1id" size="5" maxlength="5" value="" /><br />ID of monster that You want available for attack at this field.</td></tr>
<tr><td width="20%">Field Monster 2 ID:</td><td><input type="text" name="fieldmonster2id" size="5" maxlength="5" value="" /><br />ID of monster that You want available for attack at this field.</td></tr>
</table>
<div align="center"><blockquote><blockquote><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" /></blockquote></blockquote></div>
</form>
END;
    
    $page = parsetemplate($page, $row);
    admindisplay($page, "Create New Field");
    
}
    
?>