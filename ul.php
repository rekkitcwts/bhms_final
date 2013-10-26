<?php
include_once ('database_connection.php');
try
{
	$con = mysql_connect("localhost","kureido","tnx4standinstillwanker");
	mysql_select_db("kureido", $con);
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$offresult = mysql_query("SELECT COUNT(*) AS OLRecordCount FROM official;");
		$offrow = mysql_fetch_array($offresult);
		$allresult = mysql_query("SELECT COUNT(*) AS AllRecordCount FROM lodger;");
		$allrow = mysql_fetch_array($allresult);
		$resresult = mysql_query("SELECT COUNT(*) AS ResRecordCount FROM reservation;");
		$resrow = mysql_fetch_array($resresult);
		$recordCount = $allrow['AllRecordCount'] - $offrow['OLRecordCount'] - $resrow['ResRecordCount'];

		//Get records from database
		$result = mysql_query("SELECT lodger.ssn, lodger.lname, lodger.fname, lodger.mname, lodger.gender from lodger where lodger.ssn not in (SELECT lodger.ssn FROM lodger, official WHERE lodger.ssn = official.lodger_ssn UNION (SELECT lodger.ssn FROM lodger, reservation WHERE lodger.ssn = reservation.lodger_ssn)) ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";");
		
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
		$result = mysql_query("UPDATE official SET room_code = '" . $_POST["room_code"] . "', appliancerate = '" . $_POST["appliancerate"] . "', monthlybal = '" . $_POST["monthlybal"] . "' WHERE lodger_ssn = " . $_POST["ssn"] . ";");

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
	else if($_GET["action"] == "view")
	{
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