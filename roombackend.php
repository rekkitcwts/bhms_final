<?php
include_once ('database_connection.php');
// Backend for rooms list
try
{
	$con = mysql_connect("localhost","bhms","regularshow");
	mysql_select_db("bhms", $con);
	
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$roomcountquery = "SELECT COUNT(*) AS RecordCount FROM room";
		$result = mysql_query($roomcountquery);
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		 
		//Get records from database
		$roomlistquery = "SELECT room_bedspace.rb_id, room.roomcode, room.roomdesc, room.hasCR, room.roomtype, bedspace.maxspace, bedspace.monthlyrate
FROM room
INNER JOIN room_bedspace USING (roomcode)
INNER JOIN bedspace USING (bedspace_id) ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";";
		$result = mysql_query($roomlistquery);
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		   
			
			$rb_id = $row['rb_id'];
			// Number of official lodgers
			$countOLquery = "SELECT count(official_rec_id) AS occnum FROM occupy_room WHERE rb_id = '$rb_id'";
			$OLresult = mysqli_query($dbc,$countOLquery);
			$OLrow = mysqli_fetch_array($OLresult,MYSQLI_ASSOC);
			$numOL = $OLrow['occnum'];
			
			// Number of reserved lodgers
			$countRLquery = "SELECT count(res_id) AS resnum FROM reservation WHERE rb_id = '$rb_id'";
			$RLresult = mysqli_query($dbc,$countRLquery);
			$RLrow = mysqli_fetch_array($RLresult,MYSQLI_ASSOC);
			$numRL = $RLrow['resnum'];
			$freespace = ($row['maxspace'] - $numOL) - $numRL;
		//	echo '<tr><td>'.$row['roomcode'].'</td><td>' . $row['roomdesc'] .'</td><td>' . $row['roomtype'] .'</td><td>' . $row['roomrate'] .'</td><td>' . $freespace . '/' . $row['remain_bedspace'] .'</td>';
			
			$rows[] = array('rb_id'=>$row['rb_id'],'roomcode' => $row['roomcode'], 'roomdesc' => $row['roomdesc'], 'roomtype' => $row['roomtype'], 'roomrate' => $row['monthlyrate'], 'freespace' => $freespace, 'remain_bedspace' => $row['maxspace'], 'isroomwithCR' => $row['hasCR']);
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
		
		mysql_close();
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		$roomdesc = "";
		
		// ... then generate the description for it.
		if ($_POST['remain_bedspace'] == 1)
		{
			$roomdesc = "Room for 1 person";
		}
		else
		{
			$roomdesc = 'Room for ' . $_POST['remain_bedspace'] . ' persons';
		}
		
		
		$query = "INSERT INTO room (roomcode, roomdesc, roomtype, roomrate, remain_bedspace, isroomwithCR) VALUES ('$roomcode', '$roomdesc', '$roomtype', '$roomrate', '$numberbeds', '$isroomwithCR')";
	
	
		//Insert record into database
		
		
		$result = mysql_query("INSERT INTO room VALUES('" . $_POST["Name"] . "', " . $_POST["Age"] . ",now());");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM people WHERE PersonId = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	} 
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE official SET roomcode = '" . $_POST["roomcode"] . "', roomdesc = '" . $_POST["roomdesc"] . "', roomtype = '" . $_POST["roomtype"] . "', roomrate = '" . $_POST["roomrate"] . "', remain_bedspace = '" . $_POST["remain_bedspace"] . "', isroomwithCR = '" . $_POST["isroomwithCR"] . "' WHERE roomcode = " . $_POST["roomcode"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
/*	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM official WHERE lodger_ssn = " . $_POST["ssn"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}*/
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