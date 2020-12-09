<?php

function oldernews() {

$oldnewsquery=doquery("SELECT id, postdate, content FROM {{table}} ORDER BY id DESC", "news");

$page = "
<table width=100%>
<tr>
<td colspan=3 class=title>
Older News
</td>
</tr>
<td align=center width=10%>
<b>ID:</b>
</td>
<td align=center width=20%>
<b>Post Date:</b>
</td>
<td align=center width=70%>
<b>News Post:</b>
</td>\n";

$totalposts = 1;

while ($newsrow = mysql_fetch_array($oldnewsquery)) {

if ($totalposts == 1) {

$page .= "
<tr>
<td align=center width=10%>
".$newsrow["id"]."
</td>
<td align=center width=20%>
".$newsrow["postdate"]."
</td>
<td width=70%>
".$newsrow["content"]."
</td>
</tr>\n";

$totalposts = 2; }

else { 

$page .= "
<tr>
<td align=center width=10%>
".$newsrow["id"]."
</td>
<td align=center width=20%>
".$newsrow["postdate"]."
</td>
<td width=70%>
".$newsrow["content"]."
</td>
</tr>\n";

$count = 1; }

}

$page .= "
<tr>
<td colspan=3>
<br><br><center><a href=index.php> Back To Town. </a></center>
</td>
</tr>
</table>";

display($page, "Older News");

}

?>