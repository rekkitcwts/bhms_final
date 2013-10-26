<?php
/* OLD CODE COMMENTED

include_once ('database_connection.php');

if(isset($_GET['keyword'])){
    $keyword = 	trim($_GET['keyword']) ;
$keyword = mysqli_real_escape_string($dbc, $keyword);


$query = "SELECT lodger.ssn, lodger.lname, lodger.fname, lodger.mname,official.room_code, official.appliancerate, official.monthlybal, official.appliancerate + official.monthlybal AS total FROM lodger, official WHERE lodger.ssn = official.lodger_ssn ORDER BY lodger.lname ASC ";

//echo $query;
$result = mysqli_query($dbc,$query);
if($result){
	
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow" width="900">';
	echo '<tr bgcolor="#66cc44"><th>Name</th><th>Room</th><th>Appliance Rate</th><th>Monthly Room Rate</th><th>Total Monthly Rate</th><th>Options</th></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			echo '<tr><td>'.$row['lname'].', '.$row['fname']. ' '.$row['mname'].'</td><td>' . $row['room_code'] .'</td><td>' . $row['appliancerate'] .'</td><td>' . $row['monthlybal'] .'</td><td>' . $row['total'] .'</td><td>';
			echo '<a href="' . './' . 'recordpayment.php?type=full&ssn=' . $row['ssn'] . '"\>' . 'Full Payment' . '</a>';
			echo '<br>';
			echo '<a href="' . './' . 'addpayment.php?ssn=' . $row['ssn'] . '"\>' . 'Partial Payment' . '</a></td></tr>';
		 }
	echo '</table>';
    }else {
       // echo 'No Results for :"'.$_GET['keyword'].'"';
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"../../img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Lodger with last name ' . $_GET['keyword'] . ' was not found.';
			echo '</span>';
    }
  
}
}else {
    echo 'Parameter Missing';
}
*/

include_once ('database_connection.php');
try
{
	$con = mysql_connect("localhost","kureido","tnx4standinstillwanker");
	mysql_select_db("kureido", $con);
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM payment;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT payment.paymentid, lodger.ssn, lodger.lname, lodger.fname, lodger.mname, payment.paymenttype, payment.paymentdate, payment.totalrate, payment.paymentamt, payment.totalrate - payment.paymentamt AS balance FROM payment, lodger WHERE lodger.ssn = payment.lodger_ssn ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
/*	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO people(Name, Age, RecordDate) VALUES('" . $_POST["Name"] . "', " . $_POST["Age"] . ",now());");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM people WHERE PersonId = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	} */
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE payment SET paymentamt = '" . $_POST["paymentamt"] . "' WHERE paymentid = " . $_POST["paymentid"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM official WHERE lodger_ssn = " . $_POST["ssn"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>
