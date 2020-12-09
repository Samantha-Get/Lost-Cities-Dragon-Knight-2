<?php
$template = <<<THEVERYENDOFYOU
<br />
<center><table width="98%">
<tr>
<td width="100%" align="center"><center><h3>User & Character Information:</h3></center></td>
</tr>
</table></center><br />


<form action="users.php?do=register" method="post">
<center><table width="50%">
<tr><td width="20%">Username:</td><td><input type="text" name="username" size="30" maxlength="30" /><br />Usernames must be 30 alphanumeric characters or less.<br /><br /><br /></td></tr>
<tr><td>Password:</td><td><input type="password" name="password1" size="30" maxlength="10" /></td></tr>
<tr><td>Verify Password:</td><td><input type="password" name="password2" size="30" maxlength="10" /><br />Passwords must be 10 alphanumeric characters or less.<br /><br /><br /></td></tr>
<tr><td>Email Address:</td><td><input type="text" name="email1" size="30" maxlength="100" /></td></tr>
<tr><td>Verify Email:</td><td><input type="text" name="email2" size="30" maxlength="100" />{{verifytext}}<br /><br /></td></tr></table></center>


<br />
<center><table width="98%">
<tr>
<td width="100%" align="center"><center><h3>Alignments:</h3></center></td>
</tr>
</table></center>

<center>
<table border="1" width="360">
<tr>
<td><img src="images/alignments/Lawfull Good.png" width="100" height="100" title="Lawfull Good" alt="Lawfull Good" border="0"></td>
<td><img src="images/alignments/Chaotic Good.png" width="100" height="100" title="Chaotic Good" alt="Chaotic Good" border="0"></td>
<td><img src="images/alignments/Neutral Good.png" width="100" height="100" title="Neutral Good" alt="Neutral Good" border="0"></td>
<td><img src="images/alignments/Neutral.png" width="100" height="100" title="Neutral" alt="Neutral" border="0"></td>
<td><img src="images/alignments/Neutral Evil.png" width="100" height="100" title="Neutral Evil" alt="Neutral Evil" border="0"></td>
<td><img src="images/alignments/Chaotic Evil.png" width="100" height="100" title="Chaotic Evil" alt="Chaotic Evil" border="0"></td>
<td><img src="images/alignments/Lawfull Evil.png" width="100" height="100" title="Lawfull Evil" alt="Lawfull Evil" border="0"></td>
</tr>
<tr>
<td><input name="alignname" type="radio" value="1">{{align1name}}</td>
<td><input name="alignname" type="radio" value="2">{{align2name}}</td>
<td><input name="alignname" type="radio" value="3">{{align3name}}</td>
<td><input name="alignname" type="radio" checked value="4">{{align4name}}</td>
<td><input name="alignname" type="radio" value="5">{{align5name}}</td>
<td><input name="alignname" type="radio" value="6">{{align6name}}</td>
<td><input name="alignname" type="radio" value="7">{{align7name}}</td>
</tr>
</table></center><br /><br />



<center><table border="1" width="100%" align="center">
<tr>
<td colspan="2" width="100%" align="center"><h3>Character Class:</h3></td>
</tr>
</table></center>

<center><table border="1" width="100%" align="center">
<tr>
<td width="20%"><center><img src="images/classes/1.png" width="180" height="200" title="{{class1name}}" alt="{{class1name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/2.png" width="180" height="200" title="{{class2name}}" alt="{{class2name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/3.png" width="180" height="200" title="{{class3name}}" alt="{{class3name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/4.png" width="180" height="200" title="{{class4name}}" alt="{{class4name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="1">{{class1name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="2">{{class2name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="3">{{class3name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="4">{{class4name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/5.png" width="180" height="200" title="{{class5name}}" alt="{{class5name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/6.png" width="180" height="200" title="{{class6name}}" alt="{{class6name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/7.png" width="180" height="200" title="{{class7name}}" alt="{{class7name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/8.png" width="180" height="200" title="{{class8name}}" alt="{{class8name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" checked value="5">{{class5name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="6">{{class6name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="7">{{class7name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="8">{{class8name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/9.png" width="180" height="200" title="{{class9name}}" alt="{{class9name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/10.png" width="180" height="200" title="{{class10name}}" alt="{{class10name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/11.png" width="180" height="200" title="{{class11name}}" alt="{{class11name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/12.png" width="180" height="200" title="{{class12name}}" alt="{{class12name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="9">{{class9name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="10">{{class10name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="11">{{class11name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="12">{{class12name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/13.png" width="180" height="200" title="{{class13name}}" alt="{{class13name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/14.png" width="180" height="200" title="{{class14name}}" alt="{{class14name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/15.png" width="180" height="200" title="{{class15name}}" alt="{{class15name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/16.png" width="180" height="200" title="{{class16name}}" alt="{{class16name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="13">{{class13name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="14">{{class14name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="15">{{class15name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="16">{{class16name}}</center></td>
</tr>
<tr>
<td colspan="4" align="center"><br /><br /><b>DO NOT USE CLASSES BELOW. THEY ARE NOT COMPLETE AND WILL CAUSE THE GAME TO CRASH OR NOT WORK CORRECTLY.</b><br /><br /></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/17.png" width="180" height="200" title="{{class17name}}" alt="{{class17name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/18.png" width="180" height="200" title="{{class18name}}" alt="{{class18name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/19.png" width="180" height="200" title="{{class19name}}" alt="{{class19name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/20.png" width="180" height="200" title="{{class20name}}" alt="{{class20name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="17">{{class17name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="18">{{class18name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="19">{{class19name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="20">{{class20name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/21.png" width="180" height="200" title="{{class21name}" alt="{{class21name}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/22.png" width="180" height="200" title="{{class22name}}" alt="{{class22name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/23.png" width="180" height="200" title="{{class23name}}" alt="{{class23name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/24.png" width="180" height="200" title="{{class24name}}" alt="{{class24name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="21">{{class21name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="22">{{class22name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="23">{{class23name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="24">{{class24name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/25.png" width="180" height="200" title="{{class25name}}" alt="{{class25name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/26.png" width="180" height="200" title="{{class26name}}" alt="{{class26name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/27.png" width="180" height="200" title="{{class27name}}" alt="{{class27name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/28.png" width="180" height="200" title="{{class28name}}" alt="{{class28name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="25">{{class25name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="26">{{class26name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="27">{{class27name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="28">{{class28name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/29.png" width="180" height="200" title="{{class29name}}" alt="{{class29name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/30.png" width="180" height="200" title="{{class30name}}" alt="{{class30name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/31.png" width="180" height="200" title="{{class31name}}" alt="{{class31name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/32.png" width="180" height="200" title="{{class32name}}" alt="{{class32name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="29">{{class29name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="30">{{class30name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="31">{{class31name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="32">{{class32name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/33.png" width="180" height="200" title="{{class33name}}" alt="{{class33name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/34.png" width="180" height="200" title="{{class34name}}" alt="{{class34name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/35.png" width="180" height="200" title="{{class35name}}" alt="{{class35name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/36.png" width="180" height="200" title="{{class36name}}" alt="{{class36name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="33">{{class33name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="34">{{class34name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="35">{{class35name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="36">{{class36name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/37.png" width="180" height="200" title="{{class37name}}" alt="{{class37name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/38.png" width="180" height="200" title="{{class38name}}" alt="{{class38name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/39.png" width="180" height="200" title="{{class39name}}" alt="{{class39name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/40.png" width="180" height="200" title="{{class40name}}" alt="{{class40name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="37">{{class37name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="38">{{class38name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="39">{{class39name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="40">{{class40name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/41.png" width="180" height="200" title="{{class41name}}" alt="{{class415name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/42.png" width="180" height="200" title="{{class42name}}" alt="{{class42name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/43.png" width="180" height="200" title="{{class43name}}" alt="{{class43name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/44.png" width="180" height="200" title="{{class44name}}" alt="{{class44name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="41">{{class41name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="42">{{class42name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="43">{{class43name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="44">{{class44name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/45.png" width="180" height="200" title="{{class45name}}" alt="{{class45name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/46.png" width="180" height="200" title="{{class46name}}" alt="{{class46name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/47.png" width="180" height="200" title="{{class47name}}" alt="{{class47name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/48.png" width="180" height="200" title="{{class48name}}" alt="{{class48name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="45">{{class45name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="46">{{class46name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="47">{{class47name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="48">{{class48name}}</center></td>
</tr>
<tr>
<td width="20%"><center><img src="images/classes/49.png" width="180" height="200" title="{{class49name}}" alt="{{class49name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/50.png" width="180" height="200" title="{{class50name}}" alt="{{class50name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/51.png" width="180" height="200" title="{{class51name}}" alt="{{class51name}}" border="0"></center></td>
<td width="20%"><center><img src="images/classes/52.png" width="180" height="200" title="{{class52name}}" alt="{{class52name}}" border="0"></center></td>
</tr>
<tr>
<td width="20%"><center><input name="charclass" type="radio" value="29">{{class49name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="30">{{class50name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="31">{{class51name}}</center></td>
<td width="20%"><center><input name="charclass" type="radio" value="32">{{class52name}}</center></td>
</tr>
</table></center><br /><br /><br />



<center><table border="1" width="100%" align="center">
<tr>
<td colspan="2" width="100%" align="center"><h3>Difficulty Levels:</h3></td>
</tr>
</table></center>

<center>
<table border="1" width="650">
<tr>
<td width="20%" align="center"><input name="difficulty" type="radio" checked value="1">{{diff1name}} Lvl: 1.0</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="2">{{diff2name}} Lvl: 1.1</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="3">{{diff3name}} Lvl: 1.2</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="4">{{diff4name}} Lvl: 1.3</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="5">{{diff5name}} Lvl: 1.4</td>
</tr>
<tr>
<td colspan="5" width="100%" align="center"><input name="difficulty" type="radio" value="6">{{diff6name}} Lvl: 1.5</td>
</tr>
<tr>
<td width="20%" align="center"><input name="difficulty" type="radio" value="7">{{diff7name}} Lvl: 1.6</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="8">{{diff8name}} Lvl: 1.7</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="9">{{diff9name}} Lvl: 1.8</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="10">{{diff10name}} Lvl: 1.9</td>
<td width="20%" align="center"><input name="difficulty" type="radio" value="11">{{diff11name}} Lvl: 2.0</td>
</tr>

<tr>
<td colspan="5" align="center"><br />Character Name:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="charname" size="30" maxlength="30" /></td></tr>
</td>
</tr>

<tr>
<td colspan="5" align="center"><br />
See <a href="help.php">Help</a>* for more information about character classes and difficulty levels.<br>
*Note: Help is the Original v1.0 and has not yet been updated for v3133.
</td>
</tr>
<tr>
<td colspan="5" align="center"><h1><img src="auth.php" alt="Image Verification" width="135" height="25"></h1><br />Verification: Enter text from the above image into the box below.<br />Note: <font color="#C8003C">*</font> Refreshing the Image will result in all information being cleared.<br /><br /><a href="users.php?do=register" class="myButton2">Refresh Image</a><br /><br /><input id="imagever" name="imagever" type="text" /></td>
</tr>
<tr>
<td colspan="5" align="center"><input type="submit" name="submit" value="Submit" class="myButton2" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="myButton2" />
</td>
</tr>
</table>
</center></blockquote></blockquote>
</center>
</form>
<br /><br /><br />
THEVERYENDOFYOU;
?>