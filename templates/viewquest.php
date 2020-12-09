<?php
$template = <<<THEVERYENDOFYOU
<center><h3 class='title'>Quest Information [Templates/viewquest.php]</h3></center>
<br><br>

<div align="center"><table width="690" height="690" background="images/background/city/broker.jpg"><tr><td align="center">

<div align="center"><table width="85%" cellpadding="2" cellspacing="2">
<tr>
<td align="left">

<div align="center"><table width="100%">
<tr>
<td title="{{questname}} Quest"><br /><br /><center><h3 class='title'>{{questname}}</h3></center>
<br /><h4 class='titlequest'>{{questtext}}</h4>
</td>
</tr>
</table></div>

</td>
<td align="right"><br /><br /><img src="images/npc/Baron of Camasiacum.png" width="200" height="250" alt="The Kingdoms Quest Master" title="The Kingdoms Quest Master" border="0">
<br>

<div align="center"><table width="100%">
<tr>
<td title="Quest Rewards"><center><h3 class='title'>Quest Rewards</h3></center>
<br /><h4 class='titlequest'>Gold Coins: <b>{{rewardgold}}</b>
<br />Experience Points: <b>{{rewardexp}}</b>
<br />Silver Coins: <b>{{rewardsilver}}</b>
<br />Copper Coins: <b>{{rewardcopper}}</b>
<br />Item: <b>{{dropinfo}}</b>

</h4>
</td>
</tr>
</table></div>

</td>
</tr>

</table></div>
</td></tr></table></div>


<br />
<div align="center"><a href="index.php?do=acceptquest&id={{questid}}" class="myButton2">Accept Quest</a>&nbsp;&nbsp;&nbsp;<a href="index.php" class="myButton2">Back to Town</a>&nbsp;&nbsp;&nbsp;<a href="index.php?do=getquests" class="myButton2">Back to Quest List</a> </div> 
THEVERYENDOFYOU;
?>