<?php 
/*************************************************
Description:
	This is the main menu file.
Author:
	J.Pastorino  Jan.2017
 *************************************************/ 
?>

<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8">
	<link href="./styles.css"	 	rel="stylesheet" type="text/css"> 
</head>

<body>
	<?php include ('./header.php'); ?>



	<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
		<tr> 
			<td> 
				<table height="50px" width="99%" border="0" cellpadding="3" cellspacing="5"> 
				<tr> 
					<td style='width:100%; text-align:left;'> <h1>CSCI5559 - Database Systems - Assignment #1B - Application framework</h1></td> 
				</tr> 
				</table>
			<br>
			</td>
		</tr>
	</table>

	<table width="90%" style="margin: auto;">
		<tr><td>
			<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
				<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "4">A - Data Query Section</th></tr>
				<tr class="dbaserver">
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=1">dba Database tables</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=2">Sample Query</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=3">DataQuery A1</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=4">DataQuery A2</a></td>
				</tr>
				<tr class="dbaserver">
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=5">DataQuery A3</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=6">DataQuery A4</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=7">DataQuery A5</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=8">DataQuery A6</a></td>
				</tr>
				<tr class="dbaserver">
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=9">DataQuery A7</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=10">DataQuery A8</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=11">DataQuery A9</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=12">DataQuery A10</a></td>
				</tr>
				<tr class="dbaserver">
					<td colspan = "2" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=13">DataQuery A11</a></td>
					<td colspan = "2" style="width:300px;text-align:center;"><a class='dbaserver' href="query.php?queryId=14">DataQuery A12</a></td>
				</tr>
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
				<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "3">B - Data Management Section</th></tr>
				<tr class="dbaserver">
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="employee.php?option=1">Add Employee</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="employee.php?option=2">Delete Employee</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="employee.php?option=3">Change ZipCode For employee</a></td>
					 
				</tr>
				<tr class="dbaserver">
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="dataManipulation.php?option=5">DM-B1</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="dataManipulation.php?option=6">DM-B2</a></td>
					<td colspan = "1" style="width:300px;text-align:center;"><a class='dbaserver' href="dataManipulation.php?option=7">DM-B3</a></td>
			 
				</tr> 
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>	
	<br>

	<?php include ("./copyright.php"); ?>

</body>
</html>
