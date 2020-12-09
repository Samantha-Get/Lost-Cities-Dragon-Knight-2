<?php

function amis($id) {
global $userrow;
if(isset($_POST['oui'])) {
$time = time();
$query = doquery("INSERT INTO {{table}} SET id='', idmec='$id', idmoi='".$userrow["id"]."', pseudomec='".$_POST['pseudomec']."', date='$time'", "amis");
$page.="<center>THIS PLAYER ADDED IN 	
List friends .<br /><br /><a href=\"index.php\">CONTINUE</a></center>";
}
elseif(isset($_POST['non'])) {
$page.= <<<END
<meta http-equiv="refresh" content="2;URL=index.php">
END;
$page.="<center>THIS PLAYER NOTADDED IN 	
List friends </center>"; }
else {
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "users");
while ($row = mysql_fetch_array($query)) {
$nom_de_lami = $row["username"];
$page .= "<form action=index.php?do=amis:$id method=post><br />";
$page .= "
<center> ADD » <b>$nom_de_lami</b> IN LIST FRIEND ?<br /><br /> ";
$page .= "
<select name='pseudomec' id='pseudomec'>
<option value='$nom_de_lami'>$nom_de_lami</option>
</select>";

$page .= "<input type=submit value=YES name=oui>
&nbsp;&nbsp;<input type=submit value=No name=non></form><br />"; } }
display($page, "Db dreams [ Amis ]"); }

function supprimer_amis($id) {
global $userrow;
if(isset($_POST['oui'])) {
$time = time();
$query = doquery("DELETE FROM {{table}} WHERE idmec='$id' AND idmoi='".$userrow["id"]."'", "amis");
$page.="<center>THIS PLAYER IS REMOVE IN LIST FRIENDS.<br /><br /><a href=\"index.php\">Continue</a></center>";
}
elseif(isset($_POST['non'])) {
$page.= <<<END
<meta http-equiv="refresh" content="2;URL=index.php">
END;
$page.="<center>THIS PLAYER IS NOT DELETE.</center>"; }
else {
$query = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "users");
while ($row = mysql_fetch_array($query)) {
$nom_de_lami = $row["username"];
$page .= "<form action=index.php?do=supprimer_amis:$id method=post><br />";
$page .= "
<center> DELETE » <b>$nom_de_lami</b> IN LIST FRIENDS ?<br /><br /> ";

$page .= "<input type=submit value=YED name=oui>
&nbsp;&nbsp;<input type=submit value=No name=non></form><br />"; } }
display($page, "Db dreams [ Supprimer ami ]"); }

function liste_amis() {

global $userrow ;

$tas_combien_damis_sql = mysql_query("SELECT COUNT(*) AS id FROM rpg_amis WHERE idmoi='".$userrow["id"]."'") or die (mysql_error());
$tas_combien_damis_donnee = mysql_fetch_array($tas_combien_damis_sql);
$tas_combien_damis = $tas_combien_damis_donnee["id"];

$query = doquery("SELECT date,pseudomec,idmec FROM {{table}} WHERE idmoi='".$userrow["id"]."'", "amis");
$page = "<center><img src='images/liste_amis.gif'><br /><br />
YOU HAVE $tas_combien_damis amis FRIENDS.
<br /><br /></center>
<div class='liste-scan-mois'>
<table><tr>
<th>[ NAME</th>
<th>| MAIL</th>
<th>| DELETE</th>";
$count = 1;
while ($row = mysql_fetch_array($query)) {
if ($count == 1) { $page .= "
<tr><td><a href='index.php?do=onlinechar:".$row["idmec"]."' title='PROFIL'>".$row["pseudomec"]."</td>
<td>
<a href='mail.php?do=ENVOIE&user=".$row["pseudomec"]."' title='Mail'>MAIL</a></td>
<td><a href='index.php?do=supprimer_amis:".$row["idmec"]."' title='DELETE'>DELETE</a></td>
</tr>"; $count = 2; }
else { $page .= " <tr><td><a href='index.php?do=onlinechar:".$row["idmec"]."' title='PROFIL'>".$row["pseudomec"]."</td>
<td>
<a href='mail.php?do=ENVOIE&user=".$row["pseudomec"]."' title='Mail'>MAIL</a></td>
<td><a href='index.php?do=supprimer_amis:".$row["idmec"]."' title='DELETE'>DELETE</a></td>
</tr>"; $count = 1; }
}
if (mysql_num_rows($query) == 0) { $page .= "	
YOU do not have friends "; }
$page .= "</table>
</div>";

display($page, "Db dreams [ FRIENDS ]");

}

?>