<?php
//	include_once('backend/database_connection.php');
	
	try
	{
		$con = mysql_connect("localhost","bhms","regularshow");
		mysql_select_db("bhms", $con);
		//Get record count
		$roomcountquery = "SELECT COUNT(*) AS RecordCount FROM room";
		$result = mysql_query($roomcountquery);
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		 
		//Get records from database
		$roomlistquery = "SELECT * from room ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";";
		$result = mysql_query($roomlistquery);
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
			$rows = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	catch (Exception $ex)
	{
		//Return error message
		$jTableResult = array();
		$jTableResult['Result'] = "ERROR";
		$jTableResult['Message'] = $ex->getMessage();
		print json_encode($jTableResult);
	}
?>