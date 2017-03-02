<?php 
/*************************************************
Description:
	This file resolves all the queries and reports proposed in the assignment.
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

<?php

include("./dbConnection.php");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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


if (isset($_GET["queryId"])	)	{ $QUERY_ID = intval($_GET["queryId"]); 	 }		else {	$QUERY_ID =-1;	}	

/******* TIP:  Implement each query in a separate case. You can reuse by copying and pasting the sample query/report and editing the query and code.  */
switch ($QUERY_ID) {
	/***************************************************************************************************************************************************/
	case 1:  /*Query 1: display database Tables.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 1: Database Table List.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>List all the tables in the current database.</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT table_schema as db_name, table_name, engine, table_rows FROM information_schema.tables WHERE table_schema=? ORDER BY db_name,table_name;" ;
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array($db_database));
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:80px;">Database</th>';		//One Column of 80 pixels wide with the title Database.
			echo 	'<th class="bckMngr" style="width:160px;">Table Name</th>';		//One Column of 160 pixels wide with the title Table Name. 
			echo 	'<th class="bckMngr" style="width:80px;">Engine</th>';
			echo 	'<th class="bckMngr" style="width:80px;">No. Of Rows</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:80px;">'.  $row['db_name'].'</td>';
					echo '<td class="bckMngr" style="text-align:left;width:160px;">'. $row['table_name'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:80px;">'.$row['engine'].'</td>';
					echo '<td class="bckMngr" style="text-align:right;width:80px;">'. $row['table_rows'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 2:  /*Query 2: Sample query.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 2: Sample.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>This is a Sample query on the database (solution tables must be created under database schema dba).</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT Cashier.empId as id,name,address,password FROM dba.Employee, dba.Cashier WHERE Employee.empId=Cashier.empId;" ;
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Cashier (#empId)</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Address</th>';			 
			echo 	'<th class="bckMngr" style="width:150px;">Password</th>';

			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.  $row['name']." (".$row['id'].")".'</td>';   //notice how to access empId field.
					echo '<td class="bckMngr" style="text-align:left;width:260px;">'. $row['address'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['password'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	///////////////////////// TODO: Implement here the rest of the queries //////////////////////
	   // Put your code here
	/////////////////////////////////////////////////////////////////////////////////////////////

	case 3:  /*Query 3: A1.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 3: A1.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Address, table number, state, and waiter name and SSN for every table.</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT DinnerTable.address, tableNumber, state, Employee.name, Employee.SSN 
				FROM dba.DinnerTable, dba.Waiter, dba.Employee 
				WHERE DinnerTable.waiter=Waiter.empId AND Waiter.empID=Employee.empID;" ;
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Address</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Number</th>';			 
			echo 	'<th class="bckMngr" style="width:150px;">State</th>';
			echo 	'<th class="bckMngr" style="width:150px;">Name</th>';
			echo 	'<th class="bckMngr" style="width:150px;">SSN</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['address'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['tableNumber'].'</td>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['state'].'</td>';
					echo '<td class="bckMngr" style="text-align:left;width:260px;">'.$row['name'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['SSN'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 4:  /*Query 4: A2.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 4: A2.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Position values for kitchen staff and number of employees assigned to each.</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT position, COUNT(empID) AS count
				FROM dba.KitchenStaff
				GROUP BY (position);" ;
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Position</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Count</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['position'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['count'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 5:  /*Query 5: A3.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 5: A3.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>All employees who live in zip code 80013, 80014, or 80017, including name, address,
					zip code, SSN and the role they play in the organization (waiter, cashier, kitchen position, etc.).</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT name, address, zipCode, SSN, 'Waiter' AS Role
				FROM dba.Employee E, dba.Waiter W
				WHERE (E.zipCode=80013 OR E.zipCode=80014 OR E.zipCode=80017) AND E.empID=W.empId
				UNION
				SELECT name, address, zipCode, SSN, 'Cashier' AS Role
				FROM dba.Employee E, dba.Cashier C
				WHERE (E.zipCode=80013 OR E.zipCode=80014 OR E.zipCode=80017) AND E.empID=C.empId
				UNION
				SELECT name, address, zipCode, SSN, position
				FROM dba.Employee E, dba.KitchenStaff K
				WHERE (E.zipCode=80013 OR E.zipCode=80014 OR E.zipCode=80017) AND E.empID=K.empId";
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Name</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Address</th>';
			echo    '<th class="bckMngr" style="width:150px;">Zip Code</th>';
			echo    '<th class="bckMngr" style="width:150px;">SSN</th>';
			echo    '<th class="bckMngr" style="width:150px;">Role</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['name'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['address'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['zipCode'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['SSN'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['Role'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 6:  /*Query 6: A4.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 6: A4.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Customer information for those who made reservations in the last 2 months but did not
					arrive on time</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT Customer.name, Customer.phone, DATE(reservationDateTime) AS rd, TIME(reservationDateTime) AS rt, arrivalTime
				FROM dba.Reservation, dba.Customer
				WHERE Reservation.phone=Customer.phone 
					AND Reservation.reservationDateTime>DATE_ADD(NOW(), INTERVAL -2 MONTH)
					AND Reservation.arrivalTime>TIME(Reservation.reservationDateTime);";
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Name</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Phone Number</th>';
			echo 	'<th class="bckMngr" style="width:260px;">Reservation Date</th>';
			echo 	'<th class="bckMngr" style="width:260px;">Reservation Time</th>';
			echo 	'<th class="bckMngr" style="width:260px;">Arrival Time</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['name'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['phone'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['rd'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['rt'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['arrivalTime'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 7:  /*Query 7: A5.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 7: A5.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Customer information for those who made reservations and arrived less than 10 minutes 
					before their reservation expired (no duplicate customer info).</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT DISTINCT Customer.name, Customer.phone
				FROM dba.Reservation, dba.Customer
				WHERE Reservation.phone=Customer.phone 
					AND Reservation.arrivalTime>TIME(DATE_ADD(Reservation.reservationDateTime, INTERVAL -10 MINUTE))
					AND Reservation.arrivalTime<TIME(Reservation.reservationDateTime);";
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Name</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Phone Number</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['name'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['phone'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 8:  /*Query 8: A6.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 8: A6.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Menu items that are never ordered</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT description, price
				FROM dba.MenuItem
				WHERE NOT EXISTS (SELECT code
					FROM dba.Items
				 	WHERE MenuItem.code=Items.code);";
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Description</th>';		 
			echo 	'<th class="bckMngr" style="width:260px;">Price</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['description'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['price'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 9:  /*Query 9: A7.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 9: A7.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>All invoices generated in the last 15 days</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT invNumber, DATE(invoiceDateTime) AS indt, name, SUM()
				FROM dba.Invoice
				WHERE Invoice.invoiceDateTime>DATE_ADD(NOW(), INTERVAL -15 DAY)
				AND Invoice.invoiceDateTime<NOW()
				INTERSECT
				SELECT name
				FROM dba.Employee E
				WHERE E.empId=(SELECT DO.empId
					FROM dba.Invoice, dba.DailyOperation DO
					WHERE DO.brand=Invoice.brand
					AND DO.model=Invoice.model
					AND DO.serialNo=Invoice.serialNo);";
			
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Invoice Number</th>';		 
			echo 	'<th class="bckMngr" style="width:150px;">Date</th>';
			echo 	'<th class="bckMngr" style="width:150px;">Cashier</th>';
			echo 	'<th class="bckMngr" style="width:150px;">Subtotal</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['invNumber'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['indt'].'</td>';
					echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['name'].'</td>';
					//echo '<td class="bckMngr" style="text-align:center;width:150px;">'.$row['price'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

	case 10:  /*Query 10: A8.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 10: A8.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>For the last five days, the daily balance for each terminal</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT (openAmt - closeAmt) AS diff
				FROM dba.Terminal, 
				temp1 = (
					SELECT cash AS openAmt
					FROM dba.DailyOperation
					WHERE operation = 'O'
					AND operDate > DATE_ADD(NOW(), INTERVAL -5 DAY)),
				temp2 = (
					SELECT cash AS closeAmt
					FROM dba.DailyOperation
					WHERE operation = 'C'
					AND operDate > DATE_ADD(NOW(), INTERVAL -5 DAY));";
				
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Balance</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['diff'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;

case 11:  /*Query 11: A9.*/
		$tr_id=0; $tr_class='class="bckMngrtrOdd"';  //Used to display rows background color.

		//DISPLAY QUERY Title and Description.
		echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>
				<tr class='bckMngr'><th class='bckMngr'>Query 11: A9.</th></tr>
				<tr class='bckMngr'><td class='bckMngr'>Waiters that have not helped anyone all day over the past 3 days.</td></tr>
			  </table><br>";

		try { /*Protect execution errors capturing exceptions.*/
			//Query to run
			$queryText = "SELECT name
				FROM dba.Waiter
				WHERE NOT EXIST empID = (SELECT waiter
					FROM dba.Invoice I, dba.DinnerTable DT
					WHERE I.address = DT.address
					AND I.tableNumber = DT.tableNumber
					AND I.invoiceDateTime < DATE_ADD(NOW(), INTERVAL -3 DAY));";
				
			//Prepare the query. 
			$resultSet = $mysql->prepare($queryText);  
			
			/*Execute the query. Params are passed in order as they appear in the query text "?" */
			$resultSet->execute(array());
		
			/*** DISPLAY RESULT DATA  -- We will not consider any problem of table shifting because of data size.  *****/
			echo "<table  style='margin: auto;width:750px;' class='disponibilidad'>";	//Try this: May change the whole table size.
			
			echo '<thead>' ;														//HTML Header - Columns headers
			echo 	'<tr class="bckMngr">';
			echo 	'<th class="bckMngr" style="width:150px;">Balance</th>';
			echo '</thead>';


			echo "<tbody>";
			while($row  = $resultSet->fetch(PDO::FETCH_ASSOC)){
				if ($tr_id == 0){$tr_class='class="bckMngrtrEven"'; $tr_id=1;} 		else {$tr_class='class="bckMngrtrOdd"' ; $tr_id=0;}
				echo '<tr '.$tr_class.'>';
					echo '<td class="bckMngr" style="text-align:left;width:150px;">'.$row['diff'].'</td>';
				echo '</tr>';
			}
			echo "</tbody>";
			echo "</table>";

		}
		catch (PDOException $e){
			reportErrorAndDie($e->getCode(), "SQL Exception:". $e->getMessage() );
		}	
	break;
	/***************************************************************************************************************************************************/
	default: /*No valid query or query not implemented yet.*/
		echo '
	    <table width="90%" style="margin: auto;">
			<tr><td>
				<table cellspacing="0" cellpadding="0" valign="top" class="dbaserver" style="width:900px;margin: auto;" >
					<tr class="dbaserver"><th class="month" class="dbaserver" colspan = "2">Invalid query or query not implemented..</th></tr>
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



