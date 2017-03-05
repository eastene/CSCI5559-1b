<?php 
/*************************************************
Description:
	This file resolves Data Manipulation for section B.
Author:
	Evan Stene
    830387196
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

<?php
include("./dbConnection.php");
function reportErrorAndDie($error, $description){  /* In case of an error, this function displays the error and abort the execution.*/
	echo '
		<table width="550px" style="margin: auto;" class="disponibilidad">
			<tr><th class="month" style="text-align:center;border:0px; " colspan="2">
					Error Occured.
				</th>
			</tr>					
			<tr>
				<th>ErrCode</th> <td>'.$error.'</td>
			</tr>
			<tr>
				<th>Description</th> <td>'.$description.'</td>
			</tr>
		</table>
		<br>';
	include ("./copyright.php");
	echo '
	</body>
	</html>';
	die;
}


if (isset($_GET["option"])	)	{ $OPTION_ID = intval($_GET["option"]); 	 }		else {	$OPTION_ID =1;	}	
/******* TIP:  Implement each query in a separate case. You can reuse by copying and pasting the sample query/report and editing the query and code.  */

switch ($OPTION_ID) {
	/************************************************************************************************************************************************/
	case 5:  /*Option 1: Add new Reservation.*/
		if (isset($_POST["optionAdd"])	)	{ $optionAdd = intval($_POST["optionAdd"]); 	 }		else {	$optionAdd =0;	}	
		/*optionAdd will tell me is I have to show the form or process form data. Uses POST as I'm sending a form data.*/

		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Append Reservation. </th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Append a new reservation to the system.</td></tr>
			  </table><br>";
		switch ($optionAdd){ 
			case 0:	/*First invocation. Display Form.*/
				echo '
				    <table width="90%" style="margin: auto;">
						<tr><td>
							<form name="newReservation" id="newReservation" method="POST" action="./dataManipulation.php?option=5">
							<input type="hidden" name="optionAdd" id="optionAdd" value="1" >
							<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:500px;margin: auto;" >
								<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">New Reservation Form</th></tr>
								<tr>
									<td>Name:</td>			<td><input type="text" name="name" id="name" style="width:250px;"></td>
								</tr>
								<tr>
									<td>Phone Number:</td>			<td><input type="text" name="phone" id="phone" ></td>
								</tr>
								<tr>
									<td>Address:</td>		<td><input type="text" name="address" id="address" style="width:250px;"></td>
								</tr>
								<tr>
									<td>Table Number:</td>			<td><input type="text" name="tableNumber" id="tableNumber" ></td>
								</tr>
								<tr>
									<td>Reservation DateTime:</td>	<td><input type="text" name="reservationDateTime" id="reservationDateTime" > Format: YYYY-MM-DD HH:MM:SS</td>
								</tr>
                                <tr>
									<td>Reservation ID:</td>	<td><input type="text" name="reservationID" id="reservationID" ></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center;">
										<input 	name="addSubmit" 	type="button" 
										onclick="javascript:this.form.submit();" 
		 								class="normalbtn"	value="Confirm Add Reservation"> 	
					 			   	</td>
								</tr>
							</table>
							</form>
						</td></tr>
						<tr><td>&nbsp;</td></tr>
					</table>	
					';
			break;

			case 1: /*Process the data and add the reservation and customer if not already in db.*/
				//Read Parameter data
				$vArgs["name"] = $_POST["name"];			$vArgs["phone"] = $_POST["phone"];	$vArgs["address"] = $_POST["address"];
				$vArgs["tableNumber"] = $_POST["tableNumber"];	$vArgs["reservationDateTime"] = $_POST["reservationDateTime"];
                $vArgs["reservationID"] = $_POST["reservationID"];

				try{
					// check if customer exists in db already
 					/*$phone = mysql_real_escape_string($vArgs["phone"]);
					$result = mysql_query("SELECT 1 FROM Customer WHERE Customer.phone='$phone'");
					if (mysql_fetch_row($result)) {
						$stmt=null;
						$qry ="INSERT INTO dba.Customer(name, phone) VALUES (?,?);";
						$stmt= $mysql->prepare($qry);
						// add customer to the database if one with the given number does not exist already
						if ($stmt){
							$stmt->execute(array(	$vArgs["name"], $vArgs["phone"] ));
							echo '<table width="90%" style="margin: auto;">
								<tr><td>
									<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
										<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">New Customer Insertion OK.</th></tr>
									</table>
								</td></tr>
								<tr><td>&nbsp;</td></tr>
							</table>	
							'; 
						}
					}else{
							echo '<table width="90%" style="margin: auto;">
								<tr><td>
									<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
										<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Returning Customer.</th></tr>
									</table>
								</td></tr>
								<tr><td>&nbsp;</td></tr>
							</table>	
							'; 
					}
*/
					// add the reservation to the db
					$stmt=null;
					$qry ="INSERT INTO dba.Reservation(reservationDateTime, reservationId, phone, address, tableNumber, arrivalTime) VALUES (?,?,?,?,?,NULL);";
					$stmt= $mysql->prepare($qry);

					if ($stmt){	 
						$stmt->execute(array(	$vArgs["reservationDateTime"], $vArgs["reservationID"], $vArgs["phone"], 
                            $vArgs["address"], $vArgs["tableNumber"] ));
						echo '
						    <table width="90%" style="margin: auto;">
								<tr><td>
									<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
										<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Insertion OK.</th></tr>
									</table>
								</td></tr>
								<tr><td>&nbsp;</td></tr>
							</table>	
							'; 
					}
				}
				catch (PDOException $e){
					reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
				}
			break;
		}
	break;

	/************************************************************************************************************************************************/
	case 6:	/*Option 2: list and delete standing reservations*/
		if (isset($_POST["optionDel"])	)	{ $optionDel = intval($_POST["optionDel"]); 	 }		else {	$optionDel =0;	}	

		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>List/Delete Standing Reservations. </th></tr>
				<tr class='bckMngr'><td class='bckMngr'>List and Delete option of reservations.</td></tr>
			  </table><br>";
		switch ($optionDel){ 
			case 0:	/*First invocation. List Reservations.*/
				$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

				try {  
					 
					$queryText = "SELECT reservationID, reservationDateTime, phone, address, tableNumber
                        FROM dba.Reservation R
                        WHERE R.reservationDateTime > NOW()
                        ORDER BY reservationID;";
					
					//Prepare the query. 
					$resultSet = $mysql->prepare($queryText);  
					
					/*Execute the query. Params are passed in order as they appear in the query text "?" */
					$resultSet->execute(array());
				
					/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
					echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	
					
					echo '<thead>' ;														
					echo 	'<tr class="bckMngr">';
					echo 	'<th class="bckMngr" style="width:150px;">ID</th>';		
					echo 	'<th class="bckMngr" style="width:100px;">Date Time</th>';		
					echo 	'<th class="bckMngr" style="width:160px;">Phone</th>';		
					echo 	'<th class="bckMngr" style="width:250px;">Address</th>';
					echo 	'<th class="bckMngr" style="width:100px;">Table Number</th>';
					echo '</thead>';


					echo "<tbody>";
					while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
						if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
						echo '<tr '.$tr_class.'>';
                            echo '<td class="bckMngr" style="text-align:center;width:100px;">'. $row['reservationID'].'</td>';
							echo '<td class="bckMngr" style="text-align:left;width:150px;">'. $row['reservationDateTime'].'</td>';
							echo '<td class="bckMngr" style="text-align:center;width:160px;">'.$row['phone'].'</td>';
							echo '<td class="bckMngr" style="text-align:left;width:250px;">'. $row['address'].'</td>';
							echo '<td class="bckMngr" style="text-align:center;width:100px;">'.$row['tableNumber'].'</td>';
							echo '<td class="bckMngr" style="text-align:center;width:100px;">';
							echo "
									<form name='delete' id='delete_".$row["reservationID"]."' method='POST'>
										<input type='hidden' name='optionDel'  VALUE='1'/>
										<input type='hidden' name='reservationID' VALUE='".$row["reservationID"]."'/>
										<a href='#' onclick='document.getElementById(".'"'."delete_".$row["reservationID"].'"'.").submit();'>delete</a>
									</form>";
							echo '</td>';
						echo '</tr>';
					}
					echo "</tbody>";
					echo "</table>";

				}
				catch (PDOException $e){
					reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
				}	
			break;

			case 1: /*** Delete Reservation based on the parameters ***/  
				if (isset($_POST["reservationID"])	)	{ $vArgs["reservationID"] = intval($_POST["reservationID"]); 	 }		else {	reportErrorAndDie(100,"Insuficient Data.");	}

				try{
					$stmt=null;
					$qry ="DELETE FROM dba.Reservation WHERE reservationID=?;";
					$stmt= $mysql->prepare($qry);

					if ($stmt){	 
						$stmt->execute(array( $vArgs["reservationID"] ) ) ;
						echo '
						    <table width="90%" style="margin: auto;">
								<tr><td>
									<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
										<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Reservation Deleted OK.</th></tr>
									</table>
								</td></tr>
								<tr><td>&nbsp;</td></tr>
							</table>	
							'; 
					}
				}
				catch (PDOException $e){
					reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
				}

			break;

		}
	break;


	/************************************************************************************************************************************************/
	case 7:	/*Option 3: Update Menu Items*/
		if (isset($_POST["optionUpd"])	)	{ $optionUpd = intval($_POST["optionUpd"]); 	 }		else {	$optionUpd =0;	}	

		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Update Menu Item Prics. </th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Allow to change all menu item's prices under a certain value by a percentage.</td></tr>
			  </table><br>";
		switch ($optionUpd){ 
			case 0:	/*First invocation. Display Form.*/
				echo '
				    <table width="90%" style="margin: auto;">
						<tr><td>
							<form name="priceUpdate" id="priceUpdate" method="POST" action="./dataManipulation.php?option=7">
							<input type="hidden" name="optionUpd" id="optionUpd" value="1" >
							<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:500px;margin: auto;" >
								<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Menu Price Update Form</th></tr>
								<tr>
									<td>Cutoff Price:</td>			<td><input type="text" name="price" id="price" style="width:100px;"></td>
								</tr>
								<tr>
									<td>Percentage Increase:</td>		<td><input type="text" name="percent" id="percent" ></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center;">
										<input 	name="addSubmit" 	type="button" 
										onclick="javascript:this.form.submit();" 
		 								class="normalbtn"	value="Update Prices"> 	
					 			   	</td>
								</tr>
							</table>
							</form>
						</td></tr>
						<tr><td>&nbsp;</td></tr>
					</table>	
					';
			break;
				
			case 1: /*** update menu item prices ***/  
				$vArgs["price"] = $_POST["price"];			$vArgs["percent"] = $_POST["percent"];
				try{
					$stmt=null;
					$incr = (floatval($vArgs["percent"])/100) + 1;
					$qry ="UPDATE dba.MenuItem SET price=(?*'$incr') WHERE price<?;";
					$stmt= $mysql->prepare($qry);

					if ($stmt){	 
						$stmt->execute(array( $vArgs["percent"], $vArgs["price"] ) ) ;
						echo '
						    <table width="90%" style="margin: auto;">
								<tr><td>
									<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
										<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Menu Items Updated OK.</th></tr>
									</table>
								</td></tr>
								<tr><td>&nbsp;</td></tr>
							</table>	
							'; 
					}
				}
				catch (PDOException $e){
					reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
				}
			break;
		}
	break;

	/************************************************************************************************************************************************/
	default: /*No valid option.*/
		echo '
	    <table width="90%" style="margin: auto;">
			<tr><td>
				<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
					<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Invalid Option or Not implemented..</th></tr>
				</table>
			</td></tr>
			<tr><td>&nbsp;</td></tr>
		</table>	
		';
	break;
}

echo "<br>";
include ("./copyright.php"); 
?>

</body>
</html>
