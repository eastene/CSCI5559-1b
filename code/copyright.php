<?php 
/*************************************************
Description:
	This is the copyright and footer of the page.
Author:
	J.Pastorino  Jan.2017
 *************************************************/ 
?>
<?php

if (! isset($METRICS["START_TIME"]))	$METRICS["START_TIME"]=microtime(true);

$METRICS["END_TIME"]=microtime(true);

echo '<meta http-equiv="Content-Type" 		charset="UTF-8">';
echo '<table width="100%" cellspacing="0" cellpadding="0" valign="top" style="border-top:1px solid #7EA0E9;">';
echo '<tr >';
echo '<td style="width:90%">&copy; '.date("Y").'. BDLab - All rights reserved.</td>';
echo '<td style="width:10%">Generated in '. round( ($METRICS["END_TIME"] - $METRICS["START_TIME"]),4). 's.</td>';
echo '</tr></table>';
?>