<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html><head><style type = "text/css">body {font-family: Arial;}</style>
<title>Random Dice</title>
</head>
<body>
<center><?php

/*
  Code by Silas Williams
  January 31st, 2012
*/



//Let's have around of applause for completely un-maintainable code! 
/*
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
if($i = $total) echo '8. Sorry, better luck next time.';
else if($i = $total) echo '7. Sorry, better luck next time';
else if($total = 8) echo '8. Sorry, better luck next time';
else if($total = 9) echo '9. Sorry, better luck next time';
else if($total = 10) echo '10. Sorry, better luck next time';
else if($total = 11) echo '11. Sorry, better luck next time';
else if($total = 12) echo '12. Sorry, better luck next time';
else if($total = 13) echo '13. Sorry, better luck next time';
else if($total = 14) echo '14. Sorry, better luck next time';
else if($total = 15) echo '15. Sorry, better luck next time';
else if($total = 16) echo '16. Sorry, better luck next time';
else if($total = 17) echo '17. Sorry, better luck next time';
else if($total = 18) echo '18. Sorry, better luck next time';
else if($total = 19) echo '19. Sorry, better luck next time';
else if($total = 20) echo '20. Sorry, better luck next time';
else if($total = 21) echo '21. Sorry, better luck next time';
else if($total = 22) echo '22. Sorry, better luck next time';
else if($total = 23) echo '23. Sorry, better luck next time';
else if($total = 24) echo '24. Sorry, better luck next time';
else if($total = 25) echo '25. Sorry, better luck next time';
else if($total = 26) echo '26. You just barely missed a prize. Nice try.';
else if($total = 27) echo '27. You just barely missed a prize. Nice try.';
else if($total = 28) echo '28. You just barely missed a prize. Nice try.';
else if($total = 29) echo '29. You just barely missed a prize. Nice try.';
else if($total = 30) echo '30. You just barely missed a prize. Nice try.';
else if($total = 31) echo '31. You just barely missed a prize. Nice try.';
else if($total = 32) echo '32. You just barely missed a prize. Nice try.';
else if($total = 33) echo '33. You just barely missed a prize. Nice try.';
else if($total = 34) echo '34. You just barely missed a prize. Nice try.';
else if($total = 35) echo '35. You win one of our consolation prizes.';
else echo '36. Congradulations! You win the grand prize.'; 

?></center></body></html>