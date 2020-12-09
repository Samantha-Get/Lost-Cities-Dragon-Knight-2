<?php
/* Recommend this website to a friend
Script Version 0.2, copyright RRWH.com 2005.

This script is distributed under the licence conditions on the website http://rrwh.com/scripts.php

You only need to modify 3 variables - the $my_email, $safe_domains and $message

To use this script, simply set the 3 variables, upload it to your website and on the page you wish it to appear
add the following php code 
	<?php include("contact2.php"); ?>
This script creates the form, and outputs a message on sucess.
*/

// your email address - so you get copies - in case of abuse.
$my_email = 'samdalemccart@gmail.com';
// set the safe domains to your own domain names
$safe_domains = array('shogans.com', 'ageofempires.com', 'heavenweb.com', 'legoandthings.com', 'www.shogans.com');

// check if we are being submitted, and if we are, process it and output a message
if ((isset($_POST['email_friend'])) && ($_POST['email_friend'] == 'Recommend') ) {
	addslashes(extract($_POST));
	// this is the message you send when the form is completed.
	// DO NOT remove any words enclosed in "< >" as they get substituted for form values
	$message = '
	
	Hello <tellfriend>

Your friend <tellname>, <tellemail> visited our website at
http://www.legoandthings.com/ and wanted to share it with you.
	
Legoandthings© and Heavenweb© is a company that provises affordable Lego for anyone, anywhere.
	
Please drop by some time and check it out for yourself.

	';

// No need to modify ANYTHING below.

	// Check REFERER to minimise Abuse
	$i = count($safe_domains) - 1;
	while ($i >= 0) {
		if (strpos($_SERVER['HTTP_REFERER'], "http://$safe_domains[$i]") === 0) {
		$safe = "yes";
		}
	$i--;
	}
	// make sure form fields have been filled in, name is optional
	if ( ($safe == "yes") && (($tellemail != '' ) || ($tellfriend != '' ))) {
		$regexp = "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";
		$sendervalid = 'Nope';
		$rxvalid = 'Nope';
		if (eregi($regexp, $tellemail)){
			$sendervalid = 'Yes';
		} 
		if (eregi($regexp, $tellfriend)){
			$rxvalid = 'Yes';
		}
		if (($sendervalid == 'Yes') && ($rxvalid == 'Yes')) {
			// valid to and from address
			$good = 'yes';
		}
	}
	
	if ($good =='yes') {
		// form data validated.
		$subject = 'Recommended Website';
		$headers = "From: <$tellemail>\r\n";
		$fmtMail = str_replace("<tellfriend>", $tellfriend, $message);
		$fmtMail = str_replace("<tellname>", $tellname, $fmtMail);
		$fmtMail = str_replace("<tellemail>", $tellemail, $fmtMail);
		$frommail = $_SERVER["REMOTE_ADDR"];
		$fmtMail2 = "$fmtMail \n\n Remote IP is $frommail \n\n\n";
		
		//echo "$tell_friend - $subject \n";
		// send message
		mail($tellfriend, $subject, $fmtMail, $headers, "-f$tellemail");
		// send message to admin address
		mail($my_email, $subject, $fmtMail2, $headers, "-f$tellemail");
		// output message
		echo "Thankyou for reccomending us. Message sent!\n<br>\n";
	}
}
?><style type="text/css">
<!--
body,td,th {
	color: #FFFFFF;
}
body {
	background-color: #000000;
}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #CCCCCC;
}
a:hover {
	color: #CCCCCC;
}
.style3 {font-size: medium}
-->
</style>
<form action="#" method="post" name="tellfriend">
<fieldset>
<legend><span class="style3">Tell a friend</span></legend>
Your name:<br>
<input type="text" size="14" name="tellname" />
<br>
Example: Forename Surname<br />
Your e-mail:<br>
<input type="text" size="14" name="tellemail"><br />Example: name@domain.com<br>
Friend's e-mail:<br>
<input type="text" size="14" name="tellfriend"><br />Example: name@domain.com
<p><input type="submit" name="email_friend" value="Recommend"></p>
<h6 align="center">&nbsp;</h6>
</fieldset>
</form>