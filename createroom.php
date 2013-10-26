<?php
include_once ('database_connection.php');

$roomcode = $_POST['roomcode'];
$roomtype = $_POST['roomtype'];
$roomrate = $_POST['roomrate'];
// Get number of beds of this room...
$numberbeds = $_POST['remain_bedspace'];
$isroomwithCR = $_POST['isroomwithCR'];

if(empty($roomcode))
{
	echo 'ERROR: Need to input a room code.';
}
else
{
	$roomdesc = "";
		
		// ... then generate the description for it.
		if ($numberbeds == 1)
		{
			$roomdesc = "Room for 1 person";
		}
		else
		{
			$roomdesc = 'Room for ' . $numberbeds . ' persons';
		}
		
		
		$query = "INSERT INTO room (roomcode, roomdesc, roomtype, roomrate, remain_bedspace, isroomwithCR) VALUES ('$roomcode', '$roomdesc', '$roomtype', '$roomrate', '$numberbeds', '$isroomwithCR')";
		mysqli_query($dbc, $query)
			or die('Error querying database.');
			
		echo 'Room info added.<br>';
		echo 'Room number: ' . $roomcode . '<br>';
		echo 'Details: ' . $roomdesc . '<br>';
		echo 'Type: ' . $roomtype . '<br>';
		echo 'Room rate: ' . $roomrate . '<br>';
		if ($isroomwithCR == 1)
		echo 'Has CR: Yes<br>';
		else
		echo 'Has CR: No<br>';
		echo 'Redirecting to room list within a few moments. Please wait.';
		
		header('Refresh: 1.5; viewrooms.php');

		mysqli_close($dbc);
}
?>