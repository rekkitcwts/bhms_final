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
		$offresult = mysql_query("SELECT COUNT(*) AS OLRecordCount FROM occupy_room;");
		$offrow = mysql_fetch_array($offresult);
		$allresult = mysql_query("SELECT COUNT(*) AS AllRecordCount FROM lodger;");
		$allrow = mysql_fetch_array($allresult);
		$resresult = mysql_query("SELECT COUNT(*) AS ResRecordCount FROM reservation;");
		$resrow = mysql_fetch_array($resresult);
		$recordCount = $allrow['AllRecordCount'] - $offrow['OLRecordCount'] - $resrow['ResRecordCount'];

		//Get records from database
		$result = mysql_query("SELECT lodger.ssn, lodger.lname, lodger.fname, lodger.mname, lodger.gender FROM lodger WHERE lodger.ssn NOT IN (
	SELECT lodger.ssn
	FROM lodger 
	INNER JOIN occupy_room ON occupy_room.ssn = lodger.ssn 
	INNER JOIN room_bedspace ON room_bedspace.rb_id = occupy_room.rb_id 
	INNER JOIN bedspace ON bedspace.bedspace_id = room_bedspace.bedspace_id UNION (
		SELECT lodger.ssn
		FROM lodger
		INNER JOIN reservation USING (ssn)
		INNER JOIN room_bedspace USING (rb_id)
	)
) ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";");
		
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