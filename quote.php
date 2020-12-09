<style type="text/css">
<!--
body,td,th {
	color: #FFFFFF;
}
body {
	background-color: #131416;
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
-->
</style><?php
/* Licence 
Version 0.1 Initial 20/03/2005
Version 0.3, 24/03/2005

copyright RRWH.com 2005.

This script is distributed under the licence conditions on the website http://rrwh.com/scripts.php

****** Usage ********

To use: simply put <?php include("contact2.php");?> in any php web
page to both show and process the form.
 
*** Start of configuration *** 

You will need to customise these 5 variables before you upload this to your website

*/

// what servers are allowed to use this to send you email
$safe_domains = array('legoandthings.com', 'www.legoandthings.com');
// A thank you message when someone fills in the form
$thankyou = 'Your message has been sent. Thank you for your input.';
// Your email address goes here the form is sent to this address
$recipient = "samdalemccart@gmail.com";
// The subject for the email sent to you
$subject = 'Messages sent from website';
// A word that checks that the form was filled in from your website to make it harder for abuse
$doublecheck = 'A_Double007_Z';
// The template for the message that gets sent to you. - do not remove the <from> and <message> 
// as these get replaced with the form details
$form = '

Hello,

<from> has visited your website at
http://www.legoandthings.com/dk3134/index.php and filled in the contact form.

_________Start Message_________

Your Name: <from>
Your Email: <email>
Style: <style>
Pages: <pages>
Year Support: <support>
Domain: <domain>
Hosting: <hosting>
Additional Information: <message>

__________End Message__________

';

/* *** End of configuration *** */


$me = $_SERVER['PHP_SELF'];
$linkback = '';

// Check if we are submitting the form

if(isset($_POST['submit'])) {

// Check REFERER to minimise Abuse
$i = count($safe_domains) - 1;
while ($i >= 0) {
  if (strpos($_SERVER['HTTP_REFERER'], "http://$safe_domains[$i]")=== 0) {
    $safe = "yes";
  }
$i--;
}
if ($safe != "yes") {
  echo "Error - You may not POST to this script from your previous
location " . $_SERVER['HTTP_REFERER'] . "<br />&nbsp;<br />\n";
  $baddata = 'BAD';
}
// We have a valid REFERER - so continue

// Now we want to ensure that a valid email address has been entered
$regexp =
"^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";
$email = $_POST["email"];

$isvalid = 'Invalid_Email_address';
if (eregi($regexp, $email)){
        // Valid looking address
        $isvalid = 'Yes';
} 

if ($isvalid != 'Yes') {
        echo "Error - You entered an invalid email address - I could never
contact you at $email <br />&nbsp;<br />\n";
    $baddata = 'BAD';
}

// We want to make sure a message was entered!

$amessage = $_POST["message"];

if ($amessage == '') {
        echo "Error - I need a message to send - you did not enter a
message! <br />&nbsp;<br />\n";
    $baddata = 'BAD';
}
// print a thank you message
        if ($baddata != 'BAD'){
        print "$thankyou \n";
        }
}

// Process the submitted form or display the form to be filed in

if(isset($_POST['submit']) && ($baddata != 'BAD')) {

                $from = $_POST["email"];
                $headers = "From: <$from>\r\n";
                //$fmtMail = implode("", $form);
                $fmtMail = str_replace("<message>", $_POST["message"], $form);
                $fmtMail = str_replace("<from>", $_POST["name"], $fmtMail);
                $fmtMail = str_replace("<email>", $_POST["email"], $fmtMail);
				$fmtMail = str_replace("<style>", $_POST["style"], $fmtMail);
				$fmtMail = str_replace("<pages>", $_POST["pages"], $fmtMail);
				$fmtMail = str_replace("<support>", $_POST["support"], $fmtMail);
				$fmtMail = str_replace("<domain>", $_POST["domain"], $fmtMail);
				$fmtMail = str_replace("<hosting>", $_POST["hosting"], $fmtMail);
                $frommail = $_SERVER["REMOTE_ADDR"];
                $fmtMail1 = "$fmtMail \nThe message came from $frommail\n\n\n";

// Additional check that the form was sent from your website.
                if ($_POST["send"] == "$doublecheck") {
// send a message to you, that includes the senders IP address
                        mail($recipient, $subject, $fmtMail1, $headers, "-f$from");
// Send a copy of the message to the email address from the form
                        mail($from, $subject, $fmtMail, $headers, "-f$from");
                          }
} else {

// Present the form to be filled out

print <<< form

<form action ="$me" method="post">
<center>Interested in our webdesign? Ask for a free quote<br>
  <table width="270 border="0" align="center">
    <tr>
      <td width="120">Your Name:</td>
      <td width="140"><input type="text" size="20" name="name" /></td>
    </tr>
    <tr>
      <td>Your Email: </td>
      <td><input type="text" size="20" name="email" /></td>
    </tr>
    <tr>
      <td>Style:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label for="radiobutton"><div align="right">Style 1: </div></td>
      <td><input name="style" type="radio" value="Style1" /></td>
    </tr>
    <tr>
      <td><div align="right">Style 2: </div></td>
      <td><input name="style" type="radio" value="Style2" /></td>
    </tr>
    <tr>
      <td><div align="right">Style 3: </div></td>
      <td><input name="style" type="radio" value="Style3" /></label></td>
    </tr>
    <tr>
      <td height="27">Pages:</td>
      <td><input name="pages" type="text" id="pages" size="2" maxlength="2" /></td>
    </tr>
    <tr>
      <td><label for="support">Year Support: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right">Yes</div></td>
      <td><input name="support" type="radio" value="Yes" /></td>
    </tr>
    <tr>
      <td><div align="right">No</div></td>
      <td><input name="support" type="radio" value="No" /></td></label></td>
    </tr>
	    </tr>
	    <tr>
      <td>Domain: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label for="domain"><div align="right">Yes</div></td>
      <td><input name="domain" type="radio" value="Yes" /></td>
    </tr>
    <tr>
      <td><div align="right">No</div></td>
      <td><input name="domain" type="radio" value="No" /></td></label></td>
    </tr>
	    <tr>
      <td>Hosting: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label for="hosting"><div align="right">Yes</div></td>
      <td><input name="hosting" type="radio" value="Yes" /></td>
    </tr>
    <tr>
      <td><div align="right">No</div></td>
      <td><input name="hosting" type="radio" value="No" /></td></label></td>
    </tr>
    <tr>
      <td>Additional Information </td>
      <td><textarea rows="5" cols="18" name="message"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" value="Submit" name="submit" /></td>
      <td><input type="reset" name="Reset" value="Reset" /></td>
    </tr>
  </table>
  <p><input type="hidden" name="send" value="$doublecheck" />
</p></center>
</form>
form;
}
?>