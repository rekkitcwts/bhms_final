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
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM occupy_room;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		

		//Get records from database. Clean Line 17.
		$result = mysql_query("SELECT occupy_room.official_rec_id, lodger.lname, lodger.fname, lodger.mname, lodger.ssn, appliancerate.appliancerate, room_bedspace.rb_id, room_bedspace.roomcode, bedspace.monthlyrate, appliancerate.appliancerate + bedspace.monthlyrate AS total FROM lodger INNER JOIN occupy_room ON occupy_room.ssn = lodger.ssn INNER JOIN room_bedspace ON room_bedspace.rb_id = occupy_room.rb_id INNER JOIN bedspace ON bedspace.bedspace_id = room_bedspace.bedspace_id INNER JOIN appliancerate USING (ar_id) WHERE " . $_POST["criteria"] . " LIKE '%" . $_POST["name"] . "%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";");
		
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
		$result = mysql_query("DELETE FROM occupy_room WHERE official_rec_id = " . $_POST["official_rec_id"] . ";");

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