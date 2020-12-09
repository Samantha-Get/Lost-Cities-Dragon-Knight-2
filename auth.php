<?php
session_start();
$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$rand = substr(str_shuffle($alphanum), 0, 10);$_SESSION['image_random_value'] = md5($rand);
$bgnum = rand(1, 9);
if ($bgnum == 1) { $bg = 'images/auth/bg1.png'; }
if ($bgnum == 2) { $bg = 'images/auth/bg2.png'; }
if ($bgnum == 3) { $bg = 'images/auth/bg3.png'; }
if ($bgnum == 4) { $bg = 'images/auth/bg4.png'; }
if ($bgnum == 5) { $bg = 'images/auth/bg5.png'; }
if ($bgnum == 6) { $bg = 'images/auth/bg6.png'; }
if ($bgnum == 7) { $bg = 'images/auth/bg7.png'; }
if ($bgnum == 8) { $bg = 'images/auth/bg8.png'; }
if ($bgnum == 9) { $bg = 'images/auth/bg9.png'; }
$image = imagecreatefrompng("$bg");
$textColor = imagecolorallocate ($image, 0, 0, 0);
imagestring ($image, 5, 5, 8, $rand, $textColor); header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-type: image/png');
imagejpeg($image);
imagedestroy($image);
?>