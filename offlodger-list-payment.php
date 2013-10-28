<?php
include_once ('database_connection.php');
try
{
	$con = mysql_connect("localhost","bhms","regularshow");
	mysql_select_db("bhms", $con);
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM lodger_payment;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT lodger_payment.lp_id, lodger.lname, lodger.fname, lodger.mname, payment.paymenttype, payment.amountPaid, payment.paymentDate, bedspace.monthlyrate, appliancerate.appliancerate, bedspace.monthlyrate + appliancerate.appliancerate AS totalrate, bedspace.monthlyrate + appliancerate.appliancerate - payment.amountPaid AS balance FROM lodger INNER JOIN lodger_payment USING (ssn) INNER JOIN payment USING (payment_id) INNER JOIN bedspace USING (bedspace_id) INNER JOIN appliancerate USING (ar_id) ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";");
		
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
