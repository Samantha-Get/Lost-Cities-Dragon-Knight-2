<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html><head><style type = "text/css">body {font-family: Arial;}</style><title>

Week 4 Assignment

</title></head><body><?php

/*
  Code by Silas Williams
  January 31st, 2012
*/


/*
Let's have around of applause for completely un-maintainable code! 
$t=0;
for($i=0;$i<6;++$i)echo '<b>Value of roll ',$i,': </b>',1+~(($t|$t)-($t+=mt_rand(1,6))),'<br/>';
echo '<b><br/>Total value: </b>', $t, '<br/><br/><b>';
echo ($t<26)?'Sorry, better luck next time.': (($t<31)?'You just barely missed a prize. Nice try!':(
($t<36)?'You win one of our consolation prizes!':'Congradulations! You win the grand prize.'));
echo '</b>';

*/


//Here's the better way to do this:

$total = 0;
for($i = 0; $i < 6; ++$i) {
  $temp = mt_rand(1, 6);
  $total += $temp;
  echo 'Value of roll ', $i, ': ', $temp, '<br/>';
  }
if($total < 26) echo 'Sorry, better luck next time.';
else if($total < 31) echo 'You just barely missed a prize. Nice try!';
else if($total < 36) echo 'You win one of our consolation prizes!';
else echo 'Congradulations! You win the grand prize.'; 



?></body></html>