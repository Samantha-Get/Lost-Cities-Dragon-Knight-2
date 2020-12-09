<?php


global $userrow, $controlrow, $monsterrow;

  $attackpower = ($userrow["attackpower"]);
  $strength = ($userrow["strength"]);  
  $charname = ($userrow[charname]);  
  $monstername = ($monsterrow[name]);
  $monsterlevel = ($monsterrow[level]);
  $monsterseenby = ($monsterrow[seenby]);

    
    $townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
            $townrow = mysql_fetch_array($townquery);

// Monster
 $fighttalk[0] = '<span style="color:#000000"> Come to me now, so you can be destroyed.</span>';
 $fighttalk[1] = '<span style="color:#000000"> I am is here and ready for blood letting!, Lets get it started.</span>';
 $fighttalk[2] = '<span style="color:#000000"> If you come for a whipping small one, you have come to the right place.</span>';
 $fighttalk[3] = '<span style="color:#000000"> It is I {{monstername}}. {{monstername}} is here to catch a small snack. So lets start, so I can Enjoy my meal.</span>';
 $fighttalk[4] = '<span style="color:#000000"> No need to waste your energy. I will come to you and will crush you.</span>';
 $fighttalk[5] = '<span style="color:#000000"> I {{monstername}} will stand my ground and not let your tiny speck of a bug pass any further!</span>';
 $fighttalk[6] = '<span style="color:#000000"> Do you normally look around for a way to escape before every battle, but with an insect like you I do not give it a second thought.</span>';
 $fighttalk[7] = '<span style="color:#000000"> I {{monstername}} had news you were coming my way. So have you made you death arrangements before?</span>';
 $fighttalk[8] = '<span style="color:#000000"> Come forth! I {{monstername}} just killed two that looked just like you. Its time to make it a family plot!</span>';
 $fighttalk[9] = '<span style="color:#000000"> {{monstername}} Shouts, If you fight monsters, make sure that in the process you do not become a monster yourself.</span>';
 $fighttalk[10] = '<span style="color:#000000"> Hear me! War means fighting, and fighting means killing. That is what I am going to do to you today!</span>';
 $fighttalk[11] = '<span style="color:#000000"> There was no such thing as a fair fight. All vulnerabilities must be exploited. There is nothing but defeat in your future.</span>';
 $fighttalk[12] = '<span style="color:#000000"> He who hesitates, meditates in a horizontal position. Speak to your God, this is your last battle.</span>';
 $fighttalk[13] = '<span style="color:#000000"> Listen small one this Battle is an orgy of disorder. Come meet your personal orgy!</span>';
 $fighttalk[14] = '<span style="color:#000000"> Hokahey! Today is a good day for you to die!</span>';
 $fighttalk[15] = '<span style="color:#000000"> Might as well stop breathing, you are not going to be doing that anymore.</span>';
 $fighttalk[16] = '<span style="color:#000000"> They would have to glue you together in Hell after I finish with you.</span>';
 $fighttalk[17] = '<span style="color:#000000"> I {{monstername}} say a  warriors death is its own reward.</span>';
 $fighttalk[18] = '<span style="color:#000000"> Lets make this a battle for the ages.</span>';
 $fighttalk[19] = '<span style="color:#000000"> I am going to show you the difference between pain and agony explorer.</span>';
 $fighttalk[20] = '<span style="color:#000000"> You Look Like Somebody Just Walked Over Your Grave.</span>';
 $ra=mt_rand(0, 20);
 
 // You
 $backtalk[0] = '<span style="color:#000000"> Ok {{monstername}} here I am, if you think you can beat me lets get this done. My attack power is Great.</span>';
 $backtalk[1] = '<span style="color:#000000"> I maybe small compared to you {{monstername}} but I am a Giant of a Monster Killer!</span>';
 $backtalk[2] = '<span style="color:#000000"> Ok {{monstername}} let me kill you now. I am late for supper!</span>';
 $backtalk[3] = '<span style="color:#000000"> {{monstername}} So we meet at last, and this will be our last meeting! As I will defeat you in a Hail of Glory.</span>';
 $backtalk[4] = '<span style="color:#000000"> Ok {{monstername}} lets get this dance done, so I can bag and tag you before the party is over!</span>';
 $backtalk[5] = '<span style="color:#000000"> So what are you waiting for {{monstername}}? You got a Yellow Stripe down you back?</span>';
 $backtalk[6] = '<span style="color:#000000"> Ok {{monstername}} here I, are here. Come little closer so I can get a better look at you before I mess up that ugly face of yours.</span>';
 $backtalk[7] = '<span style="color:#000000"> So what are you waiting for {{monstername}}, an Invite to your own death?</span>';
 $backtalk[8] = '<span style="color:#000000"> Ok {{monstername}} I am happy to see you. My Sword was getting a little Rusty for non use. A little of your blood should make it shine again.</span>'; 
 $backtalk[9] = '<span style="color:#000000"> Listen {{monstername}} if you gaze long enough into an abyss, the abyss will gaze back into you.</span>';
 $backtalk[10] = '<span style="color:#000000"> First they ignore you. Then they ridicule you. And then they attack you and want to burn you. But more insults from you {{monstername}} will have no effect on me.</span>';
 $backtalk[11] = '<span style="color:#000000"> Listen {{monstername}} you can not go back to your mothers womb, so you better learn to be a good fighter or you will meet your death today.</span>';
 $backtalk[12] = '<span style="color:#000000"> You must not fight too often with one enemy {{monstername}}, or you will teach them your art of war. And I have fought many of your kind over the years.</span>';
 $backtalk[13] = '<span style="color:#000000"> There are no pleasures in a fight but some of my fights have been a pleasure to win.  {{monstername}} do you feel like giving me more pleasure today?</span>';
 $backtalk[14] = '<span style="color:#000000">  Hakkaa Paalle!  Lets cut you down to size!</span>';
 $backtalk[15] = '<span style="color:#000000">  You {{monstername}} you are not gonna win, but you are sure as hell can try.</span>';
 $backtalk[16] = '<span style="color:#000000">  Waking up this morning was an eye-opening experience.</span>';
 $backtalk[17] = '<span style="color:#000000">  Hakkaa Paalle! {{monstername}} Now is the time to cut you down to size!</span>'; 
 $backtalk[18] = '<span style="color:#000000">  I had prepared for a battle of wits {{monstername}}, but I see you came unarmed.</span>';
 $backtalk[19] = '<span style="color:#000000">  I got into an argument with a {{monstername}} once, then I had to silence him.</span>';
 $backtalk[20] = '<span style="color:#000000">  Fighting does not determine who is right {{monstername}} only who is left.</span>';
 $backtalk[21] = '<span style="color:#000000">  Just remember what old Hero does when the earth quakes, and the poison arrows fall from the sky, and the pillars of Heaven shake. Yeah, The Hero just looks that big old storm right square in the eye and I says, Give me your best shot. I can take it.</span>';
 $backtalk[22] = '<span style="color:#000000">  My name is your Death, and I can lick any {{monstername}} Monster in the land.</span>';
 $backtalk[23] = '<span style="color:#000000">  Might as well stop breathing {{monstername}}, you are not going to be doing that anymore.</span>';
 $backtalk[24] = '<span style="color:#000000">  {{monstername}} relax, I am here to kick you back to Hell.</span>';
 $backtalk[25] = '<span style="color:#000000">  {{monstername}} die or check into a psycho ward, whichever comes first huh?</span>';
 $backtalk[26] = '<span style="color:#000000">  Like I told my last wife {{monstername}}, I says, Honey, I never swing my sword faster than I can see the blade shine. Besides that, it is all in the reflexes. So close your eyes and let death over come you.</span>';

 $backtalk[27] = '<span style="color:#000000">  When some wild-eyed, eight-foot-tall monster grabs your neck, taps the back of your favorite head up against the wall, and he looks you crooked in the eye and he asks you if you paid your dues, you just stare that big sucker right back in the eye and say its time for you to die.</span>';
 $backtalk[28] = '<span style="color:#000000">  I know {{monstername}}, there is a problem with your face, but I can fix that in short order.</span>';
 $backtalk[29] = '<span style="color:#000000">  I am a reasonable guy {{monstername}}. But, I have just experienced some very unreasonable things and you are one of them.</span>';
 $backtalk[30] = '<span style="color:#000000">  Would you stop rubbing your body up against mine {{monstername}}, because I can not concentrate when you do that and we have some serious fighting to do.</span>';
 $backtalk[31] = '<span style="color:#000000">  {{monstername}}, You can go off and rule the universe from beyond the grave.</span>';
 $backtalk[32] = '<span style="color:#000000">  Well, you see, I am not saying that I have been everywhere and I have done everything, but I do know it is a pretty amazing planet we live on here, and a man would have to be some kind of fool to think we are alone here. But {{monstername}} I think the world would not be a better place without you in it.</span>';
 $rb=mt_rand(0, 32);
 
 

$template = <<<THEVERYENDOFYOU
<center><table width="98%"><tr><td><h3 class="title"><center>Fighting</center></h3></td></tr></table></center>
 
<center><br /><blockquote>
<table width="75%"><tr><td width="15%">
{{monsterimg}}
</td><td width="85%">
<b>$charname</b>, You are at <font color="#0080FF">Latitude $userrow[latitude] and Longitude $userrow[longitude]</font> you find yourself in a fight to the death with
a <a href="javascript:openwiki('.$dwood_monsterid.')"><b>{{monstername}}</b></a>.
<br />Monster Catalog ID: <font color="#0080FF">$userrow[currentmonster]</font>.<br /><br />

This seems to be a immediate threat to you which must be dealt with.<br />
Your HPs stand at <font color="#0080FF">$userrow[currenthp] out of $userrow[maxhp]</font>, MPs at <font color="#0080FF">$userrow[currentmp] of $userrow[maxmp]</font> and TPs <font color="#0080FF">$userrow[currenttp] of $userrow[maxtp]</font>.<br /><br /><br />

<a href="javascript:openwiki('.$dwood_monsterid.')"><b>{{monstername}}</b></a>:&nbsp; $fighttalk[$ra] <font color="#000000">I have</font> <font color="#0080FF">$userrow[currentmonsterhp] Hitpoints</font>.<br />

<b>$persondamage</b><br />

<b>$charname</b>: &nbsp; $backtalk[$rb]<br /><br />

{{yourturn}}<br />
{{monsterturn}}
{{command}}
<br /><br /> 
</td></tr></table>
</blockquote></center><br />
THEVERYENDOFYOU;
?>