<?php

 global $userrow, $controlrow;
    
    $townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
            $townrow = mysql_fetch_array($townquery);

 $fighttalk[0] = '<span style="color:#008000">{{weaponname}} Come to me now, so you can be destroyed.</span>';
 $fighttalk[1] = '<span style="color:#008000">{{weaponname}} I {{monstername}} is here!, Lets get it started Strange one.</span>';
 $fighttalk[2] = '<span style="color:#008000">{{weaponname}} If you come for a whipping, you have come to the right place.</span>';
 $fighttalk[3] = '<span style="color:#008000">{{weaponname}} It is I {{monstername}}. {{monstername}} is here to catch a small snack. So lets start, so I can Enjoy my meal.</span>';
 $fighttalk[4] = '<span style="color:#008000">{{weaponname}} No need to waste your energy. I will come to you and destroyed you.</span>';
 $fighttalk[5] = '<span style="color:#008000">{{weaponname}} I {{monstername}} Will stand my ground and not let the tiny speck of a bug pass any further!</span>';
 $fighttalk[6] = '<span style="color:#008000">{{weaponname}} Do you normally look around for a way to escape before very battle demands {{monstername}}?</span>';
 $fighttalk[7] = '<span style="color:#008000">{{weaponname}} I {{monstername}} had news you were coming my way, you have made you death arrangements ?</span>';
 $fighttalk[8] = '<span style="color:#008000">{{weaponname}} Come forth! I {{monstername}} just killed two that looked just like you. Its time to make it a family plot!</span>';
 $fighttalk[9] = '<span style="color:#008000">{{weaponname}} {{monstername}} Shouts, If you fight monsters, you should see to it that in the process you do not become a monster.</span>';
 $fighttalk[10] = '<span style="color:#008000">{{weaponname}} Hear me! War means fighting, and fighting means killing. That is what I am going to do to you today!</span>';
 $fighttalk[11] = '<span style="color:#008000">{{weaponname}} There was no such thing as a fair fight. All vulnerabilities must be exploited {{monstername}}. There is nothing but defeat in your future.</span>';
 $fighttalk[12] = '<span style="color:#008000">{{weaponname}} He who hesitates, meditates in a horizontal position. Speak to your God, this is your last battle Stranger.</span>';
 $ra=mt_rand(0, 12);
 
 
 
 
 $backtalk[0] = '<span style="color:#0000EC">Ok {{monstername}} here I am, if you think you can beat me lets get this done.<br \></span>';
 $backtalk[1] = '<span style="color:#0000EC">I maybe small {{monstername}} but I am a Giant of a Monster Killer! <br \></span>';
 $backtalk[2] = '<span style="color:#0000EC">Ok {{monstername}} let me kill you now. I am late for supper!<br \></span>';
 $backtalk[3] = '<span style="color:#0000EC">{{monstername}} So we meet at last, and this will be our last meeting! As I will defeat you in a Hail of Glory.<br \></span>';
 $backtalk[4] = '<span style="color:#0000EC">Ok {{monstername}} lets get this dance done, so I can bag and tag you before the party is over!<br \></span>';
 $backtalk[5] = '<span style="color:#0000EC">So what are you waiting for? {{monstername}}. You got a Yellow Stripe down you back?<br \></span>';
 $backtalk[6] = '<span style="color:#0000EC">Ok {{monstername}} here I, are here. Come little closer so I can get a better look at you before I mess you that ugly face of yours.<br \></span>';
 $backtalk[7] = '<span style="color:#0000EC">So what are you waiting for {{monstername}}, an Invite to your own death?<br \></span>';
 $backtalk[8] = '<span style="color:#0000EC">Ok {{monstername}} I am happy to see you. My Sword was getting a little Rusty for non use. A little of your blood should make it shine again.<br \></span>'; 
 $backtalk[9] = '<span style="color:#0000EC">Listen {{monstername}} if you gaze long enough into an abyss, the abyss will gaze back into you.<br \></span>';
  $backtalk[10] = '<span style="color:#0000EC">First they ignore you. Then they ridicule you. And then they attack you and want to burn you. But more insults from you {{monstername}} will have no effect on me.<br \></span>';
  $backtalk[11] = '<span style="color:#0000EC">Listen {{monstername}} you can not go back to your mothers womb, so you better learn to be a good fighter or you will meet your death today.<br \></span>';
  $backtalk[12] = '<span style="color:#0000EC">You must not fight too often with one enemy {{monstername}}, or you will teach him all your art of war. And I have fought many of your kind over the years.<br \></span>';
  $backtalk[13] = '<span style="color:#0000EC">There are no pleasures in a fight but some of my fights have been a pleasure to win.  {{monstername}} do you feel like giving me more pleasure today?<br \></span>';
 $rb=mt_rand(0, 13);


$template = <<<THEVERYENDOFYOU
<table width="100%">
<tr>
<td>
<center><h3 class='title'>Quest Event:  <b>{{questname}}</b></h3></center>
</td></tr>
<tr><td align="center">
<br /><font color="#9D72FF">{{questtext}}</font><br />
</td></tr>
<tr><td><blockquote>
You are fighting a <a href="javascript:openwiki('.$dwood_monsterid.')">{{monstername}}</a> with {{monsterhp}}
The {{monstername}} taunts you with:&nbsp; $fighttalk[$ra]<br />
$persondamage<br />
You reply back to {{monstername}}:&nbsp; $backtalk[$rb]<br />
<br \>
<div align="center"><blockquote><blockquote>
{{yourturn}}
{{monsterturn}}
{{command}}
</blockquote>

</blockquote></blockquote></div></td></tr>
</table>
THEVERYENDOFYOU;
?>