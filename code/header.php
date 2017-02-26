<?php 
/*************************************************
Description:
		This is Header of the page
Author:
	J.Pastorino  Jan.2017
 *************************************************/ 

	$METRICS["START_TIME"]=microtime(true);  //Records the start time to calculate the total running time in seconds.

?>

<table style="border:0px; width: 100%;border-collapse: collapse;">
<tbody> 
	<tr style="border:0px; background-color: black;">  
		<td style="border:0px; width: 70%;">
			<a href="./index.php"><img src="./images/logo.png"></a>
		</td> 
		<td valign="top" style="border:0px; background-color: black;width: 30%;">
			<table style="border:0px; width:100%; background-color: black;">
				<tbody>
					<tr style="border:0px; background-color: black; color:white;"> 
						<td height="24" valign="top" nowrap="nowrap" id="optionsLink" align="right" style="color: antiquewhite;border:0px; background-color: black;"> 
							<a href="http://www.ucdenver.edu/" style="color: antiquewhite;" target="_blank">UCDenver</a> 
							&nbsp;|&nbsp;
							<a href="http://cse.ucdenver.edu/~bdlab/" style="color: antiquewhite;" target="_blank">BDLab</a> 
							&nbsp;|&nbsp;
							<a href="http://cse.ucdenver.edu/~farnoush/teaching/courses/CSCI5559-Spring2017/index.html" style="color: antiquewhite;" target="_blank">CSCI5559</a> 
							&nbsp;|&nbsp;
							<a href="https://ucdenver.instructure.com/courses/361026/assignments/367123" style="color: antiquewhite;" target="_blank">Assignment Description</a> 							
							<br>
							<div style="color: antiquewhite;"><?php echo date('D\, d \d\e F Y');?></div>					
						</td> 
					</tr>
				</tbody>
			</table>
		</td> 
    </tr> 
  </tbody> 
</table>